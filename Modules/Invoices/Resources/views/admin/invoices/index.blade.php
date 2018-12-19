@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('invoices::invoices.title.invoices') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i
                        class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('invoices::invoices.title.invoices') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.invoices.invoice.create') }}" class="btn btn-primary btn-flat"
                       style="padding: 4px 10px;">
                        <i class="fa fa-plus"></i> {{ trans('invoices::invoices.button.create invoice') }}
                    </a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                    {!! Form::open(['route' => ['admin.invoices.invoice.index'], 'method' => 'get']) !!}
                    <div class="input-date-tk ">
                        <div class="col-md-12">
                            <div class="col-md-3 row d-flex flex-row">
                                <label class ="l-white-sp">Từ ngày</label>
                                <div class='input-group date input-date'>
                                    <input type="text" autocomplete="off" class="form-control" placeholder="Từ ngày"
                                           name="fromDate"
                                           value="{{ $fromDate? date('d/m/Y', strtotime(str_replace('/', '-', $fromDate))) : '' }}">
                                    <span class="input-group-addon c-input-addon">
                                        <span class="glyphicon glyphicon-calendar c-icon"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3 d-flex flex-row">
                                <label class ="l-white-sp">Đến ngày</label>
                                <div class='input-group date input-date'>
                                    <input type="text" autocomplete="off" class="form-control input-date"
                                           placeholder="Đến ngày" name="toDate"
                                           value="{{ $toDate? date('d/m/Y', strtotime(str_replace('/', '-', $toDate))) : '' }}">
                                    <span class="input-group-addon c-input-addon">
                                            <span class="glyphicon glyphicon-calendar c-icon"></span>
                                        </span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select name="tour_guide_id" id="tour_guide_id" class="form-control">
                                    <option value="">Chọn hướng dẫn viên</option>
                                    <?php foreach ($tourguides as $tourguide) {?>
                                    <option
                                        <?php echo $tourguideId == $tourguide->id ? 'selected' : '' ?> value="{{$tourguide->id}}">{{$tourguide->firstname .' '.$tourguide->lastname}} </option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="hotel_id" id="hotel_id" class="form-control">
                                    <option value="">Chọn khách sạn</option>
                                    <?php foreach ($hotels as $hotel) {?>
                                    <option
                                        <?php echo $hotelId == $hotel->id ? 'selected' : '' ?> value="{{$hotel->id}}">{{$hotel->name}} </option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-md-2 btn-thongke">
                                <button type="submit" class="btn btn-info">Thống kê</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">

                        <table class="data-table table table-bordered table-hover table-input">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Khách hàng</th>
                                <th>Khách sạn</th>
                                <th>Hướng dẫn viên</th>
                                <th>Mã đoàn</th>
                                <th>Số tiền</th>
                                <th>Ngày đặt hàng</th>
                                <th>Ngày khách rời</th>
                                <th data-sortable="false">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- {!! Form::open(['route' => ['admin.invoices.invoice.updateGroupCode'], 'method' => 'get','id' => 'UpdateGroupCode']) !!} -->
                            <?php if (isset($invoices)):
                            $stt = 1;$tongtien = 0;
                            ?>
                            <?php foreach ($invoices as $invoice): ?>
                            <?php
                            $tongtien = $tongtien + $invoice->amount;
                            ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.invoices.invoice.edit', [$invoice->id]) }}">
                                        {{ $stt ++}}
                                    </a>
                                </td>


                                <td>
                                    <a href="{{ route('admin.invoices.invoice.edit', [$invoice->id]) }}">
                                        {{ $invoice->firstname .' '.$invoice->lastname  }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.invoices.invoice.edit', [$invoice->id]) }}">
                                        {{ $invoice->hotel_id == 0 ? 'Khác' :$invoice->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.invoices.invoice.edit', [$invoice->id]) }}">
                                        {{ $invoice->tour_guide_id == 0 ? 'Khách lẻ' : $invoice->Tfirstname .' '.$invoice->Tlastname }}
                                    </a>
                                </td>
                                <td class="td-input">
                                    <input type="hidden" name="id[]" value="{{ $invoice->id }}">
                                    <input type="text" class="input-w" name="group_code[]"
                                           value="{{ $invoice->group_code }}">
                                </td>
                                <td>
                                    <a href="{{ route('admin.invoices.invoice.edit', [$invoice->id]) }}">
                                        {{number_format($invoice->amount,0,',',',') }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.invoices.invoice.edit', [$invoice->id]) }}">
                                        {{ date('d/m/Y H:i:s', strtotime(str_replace('/', '-', $invoice->order_date))) }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.invoices.invoice.edit', [$invoice->id]) }}">
                                        {{date('d/m/Y', strtotime(str_replace('/', '-', $invoice->delivery_date))) }}
                                    </a>
                                </td>


                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.invoices.invoice.edit', [$invoice->id]) }}"
                                           class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal"
                                                data-target="#modal-delete-confirmation"
                                                data-action-target="{{ route('admin.invoices.invoice.destroy', [$invoice->id]) }}">
                                            <i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Tổng tiền</th>
                                <th colspan="8">{{ number_format($tongtien,0,',',',')}} vnđ</th>
                            </tr>
                            </tfoot>
                        </table>
                    <!-- {!! Form::close() !!} -->
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('invoices::invoices.title.create invoice') }}</dd>
    </dl>
@stop

@push('js-stack')
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Optional theme -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        function

        delete($clientId)
        {

        }
        $(".input-w").change(function () {
            $('#UpdateGroupCode').submit();

        });

        $(document).ready(function () {
            $(document).keypressAction({
                actions: [
                    {key: 'c', route: "<?= route('admin.invoices.invoice.create') ?>"}
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[0, "asc"]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(function () {

            $('.input-date').datetimepicker({
                format: 'DD/MM/YYYY',
                useCurrent: false,
                // maxDate : 'now'
            });
            $('.input-date[name="fromDate"]').on("dp.change", function (e) {
                $('.input-date[name="toDate"]').data("DateTimePicker").minDate(e.date);
            });
            $('.input-date[name="toDate"]').on("dp.change", function (e) {
                $('.input-date[name="fromDate"]').data("DateTimePicker").maxDate(e.date);
            });

        });
    </script>
@endpush
