@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('thongke::thongketimes.title.thongketimes') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('thongke::thongketimes.title.thongketimes') }}</li>
    </ol>
@stop

@section('content')
<div class="row">
        <div class="col-xs-12">            
            <div class="box box-primary">
                <div class="box-header">
                {!! Form::open(['route' => ['admin.thongke.thongketime.index'], 'method' => 'get']) !!}         
                    <div class="input-date-tk col-md-8 col-sm-12 d-flex flex-row">
                        <div class="col-md-8">
                            <div class = "col-md-6">
                                <div class='input-group date input-date' >
                                    <input type="text" autocomplete="off" class="form-control" placeholder="Từ ngày" name="fromDate" value="{{ $fromDate? date('d/m/Y', strtotime(str_replace('/', '-', $fromDate))) : '' }}">
                                    <span class="input-group-addon c-input-addon">
                                        <span class="glyphicon glyphicon-calendar c-icon"></span>
                                    </span>
                                </div>      
                                </div>
                                <div class = "col-md-6">
                                    <div class='input-group date input-date' >
                                        <input type="text" autocomplete="off" class="form-control input-date" placeholder="Đến ngày" name="toDate" value="{{ $toDate? date('d/m/Y', strtotime(str_replace('/', '-', $toDate))) : '' }}">
                                        <span class="input-group-addon c-input-addon">
                                            <span class="glyphicon glyphicon-calendar c-icon"></span>
                                        </span>
                                    </div>  
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
                            <?php if (isset($thongketimes)):$stt=1; ?>
                            <?php foreach ($thongketimes as $thongketime): ?>
                            <tr>
                            <td> {{ $stt++ }} </td>
                                <td> {{ $thongketime->product }} </td>
                                <td> {{ date('d/m/Y H:i:s', strtotime(str_replace('/', '-', $thongketime->order_date)))  }} </td>
                                <td> {{ date('d/m/Y H:i:s', strtotime(str_replace('/', '-', $thongketime->delivery_date)))  }} </td>
                                <td> {{ $thongketime->billing_name }} </td>
                                <td> {{ $thongketime->billing_phone }} </td>
                                <td>  
                                    <?php
                                    if($thongketime->status == 0) {
                                         echo "Đơn hàng mới";   
                                    }elseif($thongketime->status == 1) {
                                        echo "Chờ xử lý";   
                                    }elseif($thongketime->status == 2) {
                                        echo "Đã xử lý"; 
                                    }elseif($thongketime->status == 3) {
                                        echo "Chờ thanh toán";
                                    }elseif($thongketime->status == 4) {
                                        echo "Đã thanh toán";
                                    }elseif($thongketime->status == 5){
                                        echo "Đã hoàn thành";
                                    }else {
                                        echo "Đã hủy";
                                    }
                                    ?>
                                </td>       
                                <td> {{ $thongketime->note }} </td>      
                                
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
        <dd>{{ trans('thongke::thongketimes.title.create thongketime') }}</dd>
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
                    { key: 'c', route: "<?= route('admin.thongke.thongketime.create') ?>" }
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
