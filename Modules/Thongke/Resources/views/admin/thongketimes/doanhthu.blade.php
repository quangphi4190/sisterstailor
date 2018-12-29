@extends('layouts.master')
<style>
    tfoot tr th {
        text-align: right;
    }
</style>
@section('content-header')
    <h1>
        {{ trans('thongke::thongketimes.title.thong ke') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i
                        class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('thongke::thongketimes.title.thong ke') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    {!! Form::open(['route' => ['admin.thongke.thong_ke_doanh_thu'], 'method' => 'get']) !!}
                    <div class="input-date-tk ">
                        <div class="col-md-12">
                            <div class="col-md-3 row d-flex flex-row">
                                <label class="l-white-sp">Từ ngày</label>
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
                                <label class="l-white-sp">Đến ngày</label>
                                <div class='input-group date input-date'>
                                    <input type="text" autocomplete="off" class="form-control input-date"
                                           placeholder="Đến ngày" name="toDate"
                                           value="{{ $toDate? date('d/m/Y', strtotime(str_replace('/', '-', $toDate))) : '' }}">
                                    <span class="input-group-addon c-input-addon">
                                            <span class="glyphicon glyphicon-calendar c-icon"></span>
                                        </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="tour_guide_id" id="tour_guide_id" class="form-control">
                                    <option value="">Chọn hướng dẫn viên</option>
                                    <?php foreach ($tourguides as $tourguide) {?>
                                    <option
                                        <?php echo $tourguideId == $tourguide->id ? 'selected' : '' ?> value="{{$tourguide->id}}">{{$tourguide->firstname .' '.$tourguide->lastname}} </option>
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
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Khách hàng</th>
                                <th>Ngày đặt</th>
                                <th>Giờ</th>
                                <th>Ngày rời</th>
                                <th>Hướng dẫn</th>
                                <th>Người bán</th>
                                <th>Đơn giá</th>
                                <th>Giảm giá</th>
                                <th>Thành tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($thongkes)):$stt = 1;   $tongtien = 0;?>
                            <?php foreach ($thongkes as $thongke):?>
                            <tr>
                                <td align="center"> {{ $stt++ }} </td>
                                <td> {{ $thongke->firstname .' '.$thongke->lastname}} </td>
                                <td> {{ date('d/m/Y', strtotime(str_replace('/', '-', $thongke->order_date)))  }} </td>
                                <td> {{ date('H:i', strtotime(str_replace('/', '-', $thongke->order_date)))  }} </td>
                                <td> {{ date('d/m/Y', strtotime(str_replace('/', '-', $thongke->delivery_date)))  }} </td>
                                <td> {{ $thongke->tour_guide_id == 0 ? 'Khách lẻ' : $thongke->Tfirstname .' '.$thongke->Tlastname}} </td>
                                <td> {{ $thongke->seller }} </td>
                                <td align="right"> $ {{ number_format($thongke->price,1,'.',',')}} </td>
                                <td align="right"> $ {{ number_format(floatval($thongke->discount),1,'.',',')}} </td>
                                <td align="right"> $ {{ number_format($thongke->amount,1,'.',',')}} </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
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
        <dd>{{ trans('thongke::thongketimes.title.create thongketime') }}</dd>
    </dl>
@stop

@push('js-stack')
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Optional theme -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).keypressAction({
                actions: [
                    {key: 'c', route: "<?= route('admin.thongke.thongketime.create') ?>"}
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            function addCommas(nStr) {
                nStr += '';
                var x = nStr.split('.');
                var x1 = x[0];
                var x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }

            var table = $('.data-table').dataTable({
                "paginate": false,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[0, "asc"]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                },

                "footerCallback": function (row, data, start, end, display) {
                    api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                                i : 0;
                    };


                    price = api
                        .column(7, {page: 'current'})
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0).toFixed(1);;

                    // Update footer
                    $(api.column(7).footer()).html(
                        '$' + addCommas(price)
                    );
                    discount = api
                        .column(8, {page: 'current'})
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0).toFixed(1);;

                    // Update footer
                    $(api.column(8).footer()).html(
                        '$' + addCommas(discount)
                    );
                    amount = api
                        .column(9, {page: 'current'})
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0).toFixed(1);

                    // Update footer
                    $(api.column(9).footer()).html(
                        '$' + addCommas(amount)
                    );
                },
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
