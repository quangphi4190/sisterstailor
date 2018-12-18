@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('thongke::thongkedays.title.thongkedays') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('thongke::thongkedays.title.thongkedays') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">            
            <div class="box box-primary">
                <div class="box-header">
                {!! Form::open(['route' => ['admin.thongke.thongkeday.index'], 'method' => 'get']) !!}         
                    <div class="input-date-tk col-md-5 col-sm-12 d-flex flex-row">
                        <div class="col-md-6 ">
                            <div class='input-group date' id='datetimepickeroder'>
                                <input type='text' class="form-control c-form-date datetime-picker" name="order_date" id="order_date" value ="{{ $day? date('d/m/Y', strtotime(str_replace('/', '-', $day))) : '' }}"/>
                                <span class="input-group-addon c-input-addon">
                                    <span class="glyphicon glyphicon-calendar c-icon"></span>
                                </span>
                            </div>                     
                        </div>
                        <div class="col-md-2 btn-thongke">
                            <button type="submit" class="btn btn-info">Thống kê</button>
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
                                <th>{{ trans('customers::customers.title.product') }}</th>
                                <th>{{ trans('customers::customers.title.order date') }}</th>
                                <th>{{ trans('customers::customers.title.delivery date') }}</th>
                                <th>{{ trans('customers::customers.title.billing name') }}</th>
                                <th>{{ trans('customers::customers.title.billing phone') }}</th>
                                <th>{{ trans('customers::customers.title.status') }}</th>
                                <th>{{ trans('customers::customers.title.note') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($thongkedays)):$stt=1; ?>
                            <?php foreach ($thongkedays as $thongkeday): ?>
                            <tr>
                            <td> {{ $stt++ }} </td>
                                <td> {{ $thongkeday->product }} </td>
                                <td> {{ date('d/m/Y H:i:s', strtotime(str_replace('/', '-', $thongkeday->order_date)))  }} </td>
                                <td> {{ date('d/m/Y H:i:s', strtotime(str_replace('/', '-', $thongkeday->delivery_date)))  }} </td>
                                <td> {{ $thongkeday->billing_name }} </td>
                                <td> {{ $thongkeday->billing_phone }} </td>
                                <td>  
                                    <?php
                                    if($thongkeday->status == 0) {
                                         echo "Đơn hàng mới";   
                                    }elseif($thongkeday->status == 1) {
                                        echo "Chờ xử lý";   
                                    }elseif($thongkeday->status == 2) {
                                        echo "Đã xử lý"; 
                                    }elseif($thongkeday->status == 3) {
                                        echo "Chờ thanh toán";
                                    }elseif($thongkeday->status == 4) {
                                        echo "Đã thanh toán";
                                    }elseif($thongkeday->status == 5){
                                        echo "Đã hoàn thành";
                                    }else {
                                        echo "Đã hủy";
                                    }
                                    ?>
                                </td>       
                                <td> {{ $thongkeday->note }} </td>      
                                
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>                            
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
        <dd>{{ trans('thongke::thongkedays.title.create thongkeday') }}</dd>
    </dl>
@stop

@push('js-stack')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Optional theme -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.thongke.thongkeday.create') ?>" }
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
                "order": [[ 0, "asc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
    <script type="text/javascript">
      $(function () {
        $('#datetimepickeroder').datetimepicker({
            // defaultDate: new Date(),
            showTodayButton: true,
            format: 'DD/MM/YYYY',
            sideBySide: true,
            // minDate: new Date("{!! date('Y-m-d 00:00:00') !!}")
        });
        

    });
    </script>
@endpush
