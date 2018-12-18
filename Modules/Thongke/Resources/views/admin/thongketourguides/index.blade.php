@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('thongke::thongketourguides.title.thongketourguides') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('thongke::thongketourguides.title.thongketourguides') }}</li>
    </ol>
@stop

@section('content')
<div class="row">
        <div class="col-xs-12">            
            <div class="box box-primary">
                <div class="box-header">
                {!! Form::open(['route' => ['admin.thongke.thongketourguide.index'], 'method' => 'get']) !!}         
                    <div class="input-date-tk col-md-5 col-sm-12 d-flex flex-row">
                        <div class="col-md-6 ">
                        <select name="tour_guide_id" id="tour_guide_id" class="form-control">
                            <option value="">Chọn hướng dẫn viên</option>
                            <?php foreach ($tourguides as $tourguide) {?>
                            <option <?php echo $tour_guide_id == $tourguide->id ? 'selected' : '' ?> value="{{$tourguide->id}}">{{$tourguide->firstname .' '.$tourguide->lastname}} </option>
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
                                <th>{{ trans('thongke::thongketourguides.title.name tourguide') }}</th>
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
                            <?php if (isset($thongketourguides)):$stt=1; ?>
                            <?php foreach ($thongketourguides as $thongketourguide): ?>
                            <tr>
                            <td> {{ $stt++ }} </td>
                                <td> {{ $thongketourguide->Tfirstname .' '.$thongketourguide->Tlastname }} </td>
                                <td> {{ $thongketourguide->product }} </td>
                                <td> {{ date('d/m/Y H:i:s', strtotime(str_replace('/', '-', $thongketourguide->order_date)))  }} </td>
                                <td> {{ date('d/m/Y H:i:s', strtotime(str_replace('/', '-', $thongketourguide->delivery_date)))  }} </td>
                                <td> {{ $thongketourguide->billing_name }} </td>
                                <td> {{ $thongketourguide->billing_phone }} </td>
                                <td>  
                                    <?php
                                    if($thongketourguide->status == 0) {
                                         echo "Đơn hàng mới";   
                                    }elseif($thongketourguide->status == 1) {
                                        echo "Chờ xử lý";   
                                    }elseif($thongketourguide->status == 2) {
                                        echo "Đã xử lý"; 
                                    }elseif($thongketourguide->status == 3) {
                                        echo "Chờ thanh toán";
                                    }elseif($thongketourguide->status == 4) {
                                        echo "Đã thanh toán";
                                    }elseif($thongketourguide->status == 5){
                                        echo "Đã hoàn thành";
                                    }else {
                                        echo "Đã hủy";
                                    }
                                    ?>
                                </td>       
                                <td> {{ $thongketourguide->note }} </td>      
                                
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
        <dd>{{ trans('thongke::thongketourguides.title.create thongketourguide') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.thongke.thongketourguide.create') ?>" }
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
