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



@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop
<!-- Model popup create cumtomes -->
<div class="modal fade bd-example-modal-lg" id="insertform" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <form method ="post" id ="insert_form">
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
      </form>
    </div>
  </div>
</div>
<div class="modal fade modalEditInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <form method ="post" id ="edit_form">
      <div class="modal-header c-header">
        <h5 class="modal-title c-text" id="exampleModalLongTitle">Chỉnh sửa thông tin khách hàng</h5>
        <button type="button" class="close c-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
        <div class="modal-body">
         
        </div>
      
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" data-dismiss="modal">Cập nhật</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>        
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End modal Edit Info -->
@push('js-stack')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Optional theme -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
{!! Theme::script('vendor/jquery/chosen.jquery.js') !!}    
{!! Theme::style('css/chosen.css') !!}

    <script type="text/javascript">
      $(function () {
        $('#datetimepicker1').datetimepicker({
            defaultDate: new Date(),
            showTodayButton: true,
            format: 'DD/MM/YYYY',
            sideBySide: true,
            minDate: new Date("{!! date('Y-m-d 00:00:00') !!}")
        });

        $('#datetimepicker2').datetimepicker({
            defaultDate: new Date(),
            showTodayButton: true,
            format: 'DD/MM/YYYY',
            sideBySide: true,
            minDate: new Date("{!! date('Y-m-d 00:00:00') !!}")
        });

    });
    </script>

  <script type="text/javascript">
   $('#insert_form').on('submit',function (e) { 
       e.preventDefault();
    var firstname = $('#firstname').val();
    var lastname = $('#lastname').val();
    var mail = $('#mail').val();
    var phone = $('#phone').val();
    var gender = $('#gender').val();
    var address = $('#address').val();
    var status = $('#status').val(); 
    var customer_type = $('#customer_type').val();
    var country_id = $('#country_id').val();
    var state_id = $('#state_id').val();
    var city_id = $('#city_id').val();
    var custom_field1 = $('#custom_field1').val();
    var custom_field2 = $('#custom_field2').val();
    var custom_field3 = $('#custom_field3').val();
    if(firstname =='') {
     swal({
        title: "Vui lòng nhập họ",
        text: "",
        icon: "warning",
        button: "Đồng ý",
    });
    } else if (lastname =='') {
        swal({
        title: "Vui lòng nhập tên",
        text: "",
        icon: "warning",
        button: "Đồng ý",
    });
    } else if (mail =='') {
        swal({
        title: "Vui lòng nhập email",
        text: "",
        icon: "warning",
        button: "Đồng ý",
    });
    } else if (phone == '') {
        swal({
        title: "Vui lòng nhập số điện thoại",
        text: "",
        icon: "warning",
        button: "Đồng ý",
    });
    } else if (address == '') {
        swal({
        title: "Vui lòng nhập địa chỉ",
        text: "",
        icon: "warning",
        button: "Đồng ý",
    });
    }
    else {
        $.ajax({
        type: 'POST',
        url: '{{url('backend/invoices/invoices/add/inser_form')}}',
        data: {
            _token: '{{ csrf_token() }}',
            firstname: firstname,
            lastname: lastname,
            mail: mail,
            phone: phone,
            gender: gender,
            address: address,
            status: status,
            customer_type: customer_type,
            country_id: country_id,
            state_id: state_id,
            city_id: city_id,
            custom_field1: custom_field1,
            custom_field2: custom_field2,
            custom_field3: custom_field3           
        },
        success: function(data) {              
            var $el = $("select#customer_id");
                $el.empty();
                $el.append("<option>Chọn khách hàng</option>");
                data = $.parseJSON(data);console.log(data);
                let i = 0, l = data.length;
                for(i; i < l; i++) {
                    let v = data[i];
                  $el.append("<option value='" + v.id + "'>" + v.firstname +' '+ v.lastname+ "</option>");
                  $('.blah').trigger("chosen:updated");
                }
                     
               
            swal("Thêm mới thành công!", "", "success");
            $('.bd-example-modal-lg').modal('hide');
        },
        error: function () {
            swal({
                title: "Thêm mới khách hàng lỗi",
                text: "",
                icon: "warning",
                button: "Đồng ý",
            });
        }
    });
    }
   
    
    });      
  </script>
  <script type="text/javascript">
   $('#edit_form').on('submit',function (e) { 
       e.preventDefault();   
    var id = $('#edit_form').find('input[name="id"]').val();
   var firstname = $('#edit_form').find('input[name="firstname"]').val();
   var lastname = $('#edit_form').find('input[name="lastname"]').val();
   var mail = $('#edit_form').find('input[name="mail"]').val();
   var phone = $('#edit_form').find('input[name="phone"]').val();
   var address = $('#edit_form').find('input[name="address"]').val();
   
    if(firstname =='') {
     swal({
        title: "Vui lòng nhập họ",
        text: "",
        icon: "warning",
        button: "Đồng ý",
    });
    } else if (lastname =='') {
        swal({
        title: "Vui lòng nhập tên",
        text: "",
        icon: "warning",
        button: "Đồng ý",
    });
    } else if (mail =='') {
        swal({
        title: "Vui lòng nhập email",
        text: "",
        icon: "warning",
        button: "Đồng ý",
    });
    } else if (phone == '') {
        swal({
        title: "Vui lòng nhập số điện thoại",
        text: "",
        icon: "warning",
        button: "Đồng ý",
    });
    } else if (address == '') {
        swal({
        title: "Vui lòng nhập địa chỉ",
        text: "",
        icon: "warning",
        button: "Đồng ý",
    });
    }
    else {
        $.ajax({
        type: 'POST',
        url: '{{url('backend/invoices/invoices/edit/edit_form')}}',
        data: {
            _token: '{{ csrf_token() }}',
            id: id,
            firstname: firstname,
            lastname: lastname,
            mail: mail,
            phone: phone,
            gender: gender,
            address: address,          
        },
        success: function(data) {
            swal("Cập nhật thông tin khách hàng thành công!", "", "success");
            $('.bd-example-modal-lg').modal('hide');
        },
        error: function () {
            swal({
                title: "Cập nhật thông tin khách hàng lỗi",
                text: "",
                icon: "warning",
                button: "Đồng ý",
            });
        }
    });
    }
   
    
    });      
  </script>
  <script type="text/javascript">
    
    // view info
     $('#viewInfoCusomer').click(function () {
        // lấy id
        url = '{{url('backend/invoices/invoices/get_info/info')}}';
        var id = $('.view-customer').val();
        if (id == ''){
            swal({
                title: "Vui lòng chọn khách hàng",
                text: "",
                icon: "warning",
                button: "Đồng ý",
            });
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
        url = '{{url('backend/invoices/invoices/get_info/edit-info')}}';
        var id = $('.view-customer').val();
        if (id == ''){
            swal({
                title: "Vui lòng chọn khách hàng",
                text: "",
                icon: "warning",
                button: "Đồng ý",
            });
           return false;
        }else {
        var token = '{{ csrf_token() }}';
            $.post(url,{'id':id,'_token':token}, function(data) {
                $('.modalEditInfo .modal-body').html(data);

                $('.modalEditInfo .modal-body').show();
                $('.modalEditInfo').modal('show');
            });
        }
    });
    // get id custumer
    $('select[name="customer_id"]').change(function () {
              $('.c-customer').addClass('info-cusomer');             
            var url = "{{ url('backend/invoices/invoices/get_id_customer') }}";
            var token = '{{ csrf_token() }}';
            val = $(this).val();
            let view_customer = val;
            $('.view-customer').val(view_customer);    
            $.post(url, {customer_id:$(this).val(), _token:token }, function(data){
                $('div[name="customerID"]').html(data);
                $('div[name="customerID"]').trigger("chosen:updated");
                       
            });
        });

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
    $('select[name="customer_id"], select[name="tour_guide_id"], select[name="hotel_id"],select[name="country_id"], select[name="state_id"], select[name="city_id"]').chosen({no_results_text: "Không tìm thấy", width: "100%", search_contains:true});

    $('select[name="country_id"]').change(function () {
            var url = "{{ url('backend/customers/customers/get_id') }}";
            var token = '{{ csrf_token() }}';

            $.post(url, {country_id:$(this).val(), _token:token, emptyOption:'Select State', }, function(data){                
                $('select[name="state_id"]').html(data);
                $('select[name="state_id"]').trigger("chosen:updated");
            });
        });
        // Get state
    $('select[name="state_id"]').change(function () {
        var url = "{{ url('backend/customers/customers/state/get_id_state') }}";
        var token = '{{ csrf_token() }}';

        $.post(url, {state_id:$(this).val(), _token:token, emptyOption:'Select City', }, function(data){            
            $('select[name="city_id"]').html(data);
            $('select[name="city_id"]').trigger("chosen:updated");
        });
    });     
    </script>
@endpush
