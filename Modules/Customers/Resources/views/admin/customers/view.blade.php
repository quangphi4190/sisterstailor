@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('customers::customers.title.list invoice customer') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.customers.customer.index') }}">{{ trans('customers::customers.title.customers') }}</a></li>
        <li class="active">{{ trans('customers::customers.title.view customer') }}</li>
    </ol>
@stop

@section('content')
   
<div class="row">
        <div class="col-xs-12">            
            <div class="box box-primary">
                <div class="box-header">
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
                            <?php if (isset($list_invoice)):
                             $stt=1;   
                             ?>
                            <?php foreach ($list_invoice as $invoice): ?>
                            <tr>
                                <td> {{ $stt++ }} </td>
                                <td> {{ $invoice->product }} </td>
                                <td> {{ date('d/m/Y H:i:s', strtotime(str_replace('/', '-', $invoice->order_date)))  }} </td>
                                <td> {{ date('d/m/Y H:i:s', strtotime(str_replace('/', '-', $invoice->delivery_date)))  }} </td>
                                <td> {{ $invoice->billing_name }} </td>
                                <td> {{ $invoice->billing_phone }} </td>
                                <td>  
                                    <?php
                                    if($invoice->status == 0) {
                                         echo "Đơn hàng mới";   
                                    }elseif($invoice->status == 1) {
                                        echo "Chờ xử lý";   
                                    }elseif($invoice->status == 2) {
                                        echo "Đã xử lý"; 
                                    }elseif($invoice->status == 3) {
                                        echo "Chờ thanh toán";
                                    }elseif($invoice->status == 4) {
                                        echo "Đã thanh toán";
                                    }elseif($invoice->status == 5){
                                        echo "Đã hoàn thành";
                                    }else {
                                        echo "Đã hủy";
                                    }
                                    ?>
                                </td>       
                                <td> {{ $invoice->note }} </td>                                
                            </tr>
                            <?php endforeach; ?>
                                <?php else:?>
                                <tr>
                                    <td colspan="8">{{ trans('customers::customers.title.no data') }}</td>
                                </tr>
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
@stop
@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
{!! Theme::script('vendor/jquery/chosen.jquery.js') !!}    
{!! Theme::style('css/chosen.css') !!}
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.customers.customer.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>

    <script type="text/javascript">  
        $('select[name="country_id"], select[name="state_id"], select[name="city_id"]').chosen({no_results_text: "Không tìm thấy", width: "100%", search_contains:true});
    
        $('select[name="country_id"]').change(function () {
                var url= route('admin.customers.customer.get_id');
                var token = '{{ csrf_token() }}';
    
                $.post(url, {country_id:$(this).val(), _token:token, emptyOption:'Chọn tỉnh', }, function(data){
                    
                    $('select[name="state_id"]').html(data);
                    $('select[name="state_id"]').trigger("chosen:updated");
                });
            });
            // Get state
        $('select[name="state_id"]').change(function () {
            var url= route('admin.customers.customer.get_id_state');
            var token = '{{ csrf_token() }}';

            $.post(url, {state_id:$(this).val(), _token:token, emptyOption:'Chọn thành phố', }, function(data){
                
                $('select[name="city_id"]').html(data);
                $('select[name="city_id"]').trigger("chosen:updated");
            });
        });
            
    </script>
@endpush
