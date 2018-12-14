
@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('customers::customers.title.create customer') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.customers.customer.index') }}">{{ trans('customers::customers.title.customers') }}</a></li>
        <li class="active">{{ trans('customers::customers.title.create customer') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.customers.customer.store'], 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('customers::admin.customers.partials.create-fields', ['lang' => $locale])
                        </div>
                    @endforeach

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">Thêm mới</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.customers.customer.index')}}"><i class="fa fa-times"></i> Hủy</a>
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
