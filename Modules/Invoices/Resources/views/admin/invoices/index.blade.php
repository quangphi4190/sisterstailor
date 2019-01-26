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
                                <th>Ngày đặt</th>
                                <th>Ngày khách rời</th>
                                <th>Người bán</th>
                                <th data-sortable="false">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if (isset($invoices)):
                            $stt = 1;
                            ?>
                            <?php foreach ($invoices as $invoice): ?>
                            <tr>
                                <td align="center">
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
                                <div class="dropdown mystyle">
                                    <select name="hotel_id" id="hotel_id" class="form-control fom-category" data-id="{{$invoice->id}}">
                                    @if ($invoice->hotel_id == 0)
                                        <option value="">Khác</option>
                                        @else
                                        <option value="{{$invoice->hotel_id}}">{{$invoice->name}}</option>
                                        @endif
                                        @foreach ($hotels as $hotel)
                                        <option value="{{$hotel->id}}">{{$hotel->name}}</option>
                                        @endforeach
                                    </select>
                                </div>                                    
                                        <!-- {{ $invoice->hotel_id == 0 ? 'Khác' :$invoice->name }} -->                                    
                                </td>
                                <td>
                                    <a class="tour_guide_{{$invoice->id}}" href="{{ route('admin.invoices.invoice.edit', [$invoice->id]) }}">
                                        {{ $invoice->tour_guide_id == 0 ? 'Khách lẻ' : $invoice->Tfirstname .' '.$invoice->Tlastname }}
                                    </a>
                                </td>
                                <td class="td-input">
                                    <input data-id="{{ $invoice->id }}" type="text" class="input-w group_code" name="group_code[]"
                                           value="{{ $invoice->group_code }}">
                                </td>
                                <td>

                                        ${{number_format($invoice->amount,1,'.',',') }}

                                </td>
                                <td>

                                        {{ date('d/m/Y', strtotime(str_replace('/', '-', $invoice->order_date))) }}

                                    <span class="label label-lg label-info">
                                        {{ date('H:i', strtotime(str_replace('/', '-', $invoice->order_date))) }}

                                    </span>message
                                </td>
                                <td>

                                        {{date('d/m/Y', strtotime(str_replace('/', '-', $invoice->delivery_date))) }}

                                </td>

                                <td>
                                    {{$invoice->seller}}
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <?php
                                            if ($invoice->status == 1){
                                        ?>
                                        <a href="javascript:;"
                                           class="btn btn-warning btn-flat btn-paid" data-id="{{$invoice->id}}" title="Thanh toán"><i class="fa fa-dollar"></i></a>
                                            <?php
                                                }else{
                                            ?>
                                            <a href="javascript:;"
                                               class="btn btn-success btn-flat"><i class="fa fa-check"></i></a>
                                            <?php } ?>
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
                                <th colspan="5" style="text-align: right" >Tổng tiền</th>
                                <th colspan="5" style="text-align: left"></th>
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
        <dd>{{ trans('invoices::invoices.title.create invoice') }}</dd>
    </dl>
@stop

@push('js-stack')
{!! Theme::script('vendor/jquery/chosen.jquery.js') !!}    
{!! Theme::style('css/chosen.css') !!}
{!! Theme::script('js/jquery.formula.js') !!}
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Optional theme -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://www.jqueryscript.net/demo/Custom-Thousands-Separator-jQuery-number-divider/dist/number-divider.js"></script>
    <script type="text/javascript">


        $(document).ready(function () {
            $(document).keypressAction({
                actions: [
                    {key: 'c', route: "<?= route('admin.invoices.invoice.create') ?>"}
                ]
            });
            $(".group_code").change(function () {
                var invoice_id = $(this).data('id');
                var group_code = $(this).val().length == 0?'remove':$(this).val();
                $.get('{{url('backend/invoices/invoices/get_group_info')}}/'+invoice_id + '/' + group_code, function (data) {
                        if(data.successful){
                            $('.hotel_'+invoice_id).text(data.hotel);
                            $('.tour_guide_'+invoice_id).text(data.tour_guide);
                        }else{
                            alert(data.message);
                        }
                }, 'json');

            });
            $('.btn-paid').on('click', function () {
                var btn = $(this);
                var invoice_id = $(this).data('id');
                $.get('{{url('backend/invoices/paid')}}/'+invoice_id, function (data) {
                    if(data.successful){
                        btn.removeClass('btn-paid');
                        btn.removeClass('btn-warning');
                        btn.addClass('btn-success');

                        btn.html('<i class="fa fa-check"></i>')
                    }else{
                        alert(data.message);
                    }
                }, 'json');
            })
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            function addCommas(nStr)
            {
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
            var api;
            $('.data-table').dataTable({
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
                "footerCallback": function ( row, data, start, end, display ) {
                   api  = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    // total = api
                    //     .column(5)
                    //     .data()
                    //     .reduce( function (a, b) {
                    //         return intVal(a) + intVal(b);
                    //     }, 0 );

                    // Total over this page
                    pageTotal = api
                        .column( 5, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Update footer
                    $( api.column( 5 ).footer() ).html(
                        '$'+addCommas(pageTotal.toFixed(1))
                    );
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
    <script type="text/javascript">
        $('select[name="hotel_id"]').chosen({no_results_text: "Không tìm thấy", width: "100%", search_contains:true});
        $('select[name="hotel_id"]').change(function(){
            var id = $(this).val();
            var invoId = $(this).data('id');
            var url = '{{route("admin.invoices.update_hotel")}}';
            var token = '{{ csrf_token() }}';
            $.post(url, {'id':id,'invoId':invoId,'_token':token}, function(data){               
                if(data){
                        swal("Cập nhật thông tin khách sạn thành công!", "", "success");  
                 }else{
                            swal("Cập nhật thông tin khách sạn that bại!", "", "success"); 
            };
        });
    });
    </script>
@endpush
