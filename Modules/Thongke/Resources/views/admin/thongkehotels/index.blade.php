@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('thongke::thongkehotels.title.thongkehotels') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('thongke::thongkehotels.title.thongkehotels') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">            
            <div class="box box-primary">
                <div class="box-header">
                {!! Form::open(['route' => ['admin.thongke.thongkehotel.index'], 'method' => 'get']) !!}         
                    <div class="input-date-tk col-md-5 col-sm-12 d-flex flex-row">
                        <div class="col-md-6 ">
                        <select name="hotel_id" id="hotel_id" class="form-control">
                                <option value="">Chọn khách sạn</option>
                                <?php foreach ($hotels as $hotel) {?>
                                    <option <?php echo $hotel_id == $hotel->id ? 'selected' : '' ?> value="{{$hotel->id}}">{{$hotel->name}} </option>
                                 <?php }?>
                                </select>                     
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
                                <th>{{ trans('customers::customers.title.name hotel') }}</th>
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
                            <?php if (isset($thongkehotels)):$stt=1; ?>
                            <?php foreach ($thongkehotels as $thongkehotel): ?>
                            <tr>
                            <td> {{ $stt++ }} </td>
                                <td> {{ $thongkehotel->nameHotel }} </td>
                                <td> {{ $thongkehotel->product }} </td>
                                <td> {{ date('d/m/Y H:i:s', strtotime(str_replace('/', '-', $thongkehotel->order_date)))  }} </td>
                                <td> {{ date('d/m/Y H:i:s', strtotime(str_replace('/', '-', $thongkehotel->delivery_date)))  }} </td>
                                <td> {{ $thongkehotel->billing_name }} </td>
                                <td> {{ $thongkehotel->billing_phone }} </td>
                                <td>  
                                    <?php
                                    if($thongkehotel->status == 0) {
                                         echo "Đơn hàng mới";   
                                    }elseif($thongkehotel->status == 1) {
                                        echo "Chờ xử lý";   
                                    }elseif($thongkehotel->status == 2) {
                                        echo "Đã xử lý"; 
                                    }elseif($thongkehotel->status == 3) {
                                        echo "Chờ thanh toán";
                                    }elseif($thongkehotel->status == 4) {
                                        echo "Đã thanh toán";
                                    }elseif($thongkehotel->status == 5){
                                        echo "Đã hoàn thành";
                                    }else {
                                        echo "Đã hủy";
                                    }
                                    ?>
                                </td>       
                                <td> {{ $thongkehotel->note }} </td>      
                                
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
        <dd>{{ trans('thongke::thongkehotels.title.create thongkehotel') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.thongke.thongkehotel.create') ?>" }
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
@endpush
