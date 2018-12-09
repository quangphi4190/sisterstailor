@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('invoices::invoices.title.create invoice') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.invoices.invoice.index') }}">{{ trans('invoices::invoices.title.invoices') }}</a></li>
        <li class="active">{{ trans('invoices::invoices.title.create invoice') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.invoices.invoice.store'], 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('invoices::admin.invoices.partials.create-fields', ['lang' => $locale])
                        </div>
                    @endforeach

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">Thêm mới</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.invoices.invoice.index')}}"><i class="fa fa-times"></i> Hủy</a>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
    </div>
    {!! Form::close() !!}
@stop

<!-- Model popup create cumtomes -->
<div class="modal fade bd-example-modal-lg" id="insertform" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    {!! Form::open(['method' => 'post','id'=>'insert_form']) !!}     
      <div class="modal-header c-header">
        <h5 class="modal-title c-text" id="exampleModalLongTitle">Thêm khách hàng</h5>
        <button type="button" class="close c-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
        <div class="modal-body">
            @include('customers::admin.customers.partials.create-fields', ['lang' => $locale])
        </div>
      
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Thêm mới</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>        
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

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
<!-- {!! Theme::script('vendor/jquery/jquery-ui.min.js') !!} -->
{!! Theme::script('vendor/autocomplete/jquery.easy-autocomplete.min.js') !!} 
{!! Theme::style('css/easy-autocomplete.min.css') !!}
{!! Theme::script('vendor/jquery/chosen.jquery.js') !!}    
{!! Theme::style('css/chosen.css') !!}
    <script type="text/javascript">
    var options = {
	data: <?php echo json_encode($arrInvoi) ?>,

	getValue: "fullname",

    template: {
		type: "custom",
		method: function(value, item) {
			return value + " | " + item.phone + " | " + item.address;
		}
	}
    
    };  
    // view info
     $('#viewInfoCusomer').click(function () {
        // lấy id
        url = '{{url('en/backend/invoices/invoices/get_info/info')}}';
        var id = $('.view-customer').val();
        if (id == ''){
           alert('Vui lòng chọn khách khàng');
          return false;
        }else {
            var token = '{{ csrf_token() }}';
            $.post(url,{'id':id,'_token':token}, function(data) {
                $('.modalInfo .modal-body').html(data);

                $('.modalInfo .modal-body').show();
                $('.modalInfo').modal('show');
            });
        }
        
    });

    // editInfoCusomer
    $('#editInfoCusomer').click(function () {
        // lấy id
        url = '{{url('en/backend/invoices/invoices/get_info/edit-info')}}';
        var id = $('.view-customer').val();
        if (id == ''){
           alert('Vui lòng chọn khách khàng');
           return false;
        }else {
        var token = '{{ csrf_token() }}';
            $.post(url,{'id':id,'_token':token}, function(data) {
                $('.modalEditInfo .modal-content').html(data);

                $('.modalEditInfo .modal-content').show();
                $('.modalEditInfo').modal('show');
            });
        }
    });
    // get id custumer
    $('select[name="customer_id"]').change(function () {
              $('.c-customer').addClass('info-cusomer');             
            var url = "{{ url('en/backend/invoices/invoices/get_id_customer') }}";
            var token = '{{ csrf_token() }}';
            val = $(this).val();
            let view_customer = val;
            $('.view-customer').val(view_customer);    
            $.post(url, {customer_id:$(this).val(), _token:token }, function(data){
                $('div[name="customerID"]').html(data);
                $('div[name="customerID"]').trigger("chosen:updated");
                       
            });
        });

    $("#customer_id").easyAutocomplete(options);
    </script>
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.invoices.invoice.index') ?>" }
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
    $('select[name="customer_id"], select[name="tour_guide_id"], select[name="hotel_id"],select[name="country_id"], select[name="state_id"], select[name="city_id"]').chosen({no_results_text: "{{trans('common.txt_not_found')}}", width: "100%", search_contains:true});

    $('select[name="country_id"]').change(function () {
            var url = "{{ url('en/backend/customers/customers/get_id') }}";
            var token = '{{ csrf_token() }}';

            $.post(url, {country_id:$(this).val(), _token:token, emptyOption:'Select State', }, function(data){                
                $('select[name="state_id"]').html(data);
                $('select[name="state_id"]').trigger("chosen:updated");
            });
        });
        // Get state
    $('select[name="state_id"]').change(function () {
        var url = "{{ url('en/backend/customers/customers/state/get_id_state') }}";
        var token = '{{ csrf_token() }}';

        $.post(url, {state_id:$(this).val(), _token:token, emptyOption:'Select City', }, function(data){            
            $('select[name="city_id"]').html(data);
            $('select[name="city_id"]').trigger("chosen:updated");
        });
    });
            

      $('#insert_form').submit(function (e) {
        e.preventDefault();
        var formData = new FormData($('#insert_form')[0]);

        $.ajax({
            url: '{{ url('en/backend/customers/customers/insert/inser_form') }}',
            type: 'POST',
            data: formData,
            success: function(msg){
                alert(msg);
            }
            contentType: false,
            processData: false

        });
        });

    </script>
@endpush
