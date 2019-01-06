@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('invoices::invoices.title.edit invoice') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.invoices.invoice.index') }}">{{ trans('invoices::invoices.title.invoices') }}</a></li>
        <li class="active">{{ trans('invoices::invoices.title.edit invoice') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.invoices.invoice.update', $invoice->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                        <input hidden name = "id" value ="<?php echo $invoice->id?>">
                            @include('invoices::admin.invoices.partials.edit-fields', ['lang' => $locale])
                        </div>
                    @endforeach

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">Cập nhật</button>
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

@push('js-stack')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Optional theme -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
{!! Theme::script('js/jquery.formula.js') !!}
<script type="text/javascript">
      $(function () {
           // amount
        $(document).on('change', '.input-calc, #price', function () {
            price =  $('#price').val() ? $('#price').val() : 0;
            discount = $('#discount').val() ? $('#discount').val() : 0;
            totalAmount =parseFloat(price)-parseFloat(discount);
            var v = totalAmount.toFixed(1);
            document.getElementById("amount").value = v;
        });
        // Get Mã đoàn
        $('select[name="tour_guide_id"]').change(function () {                     
            var url= route('admin.invoices.invoices.get_tour_guide_id');
            var token = '{{ csrf_token() }}';
           var group_code =$('#group_code');
            $.post(url, {tour_guide_id:$(this).val(), _token:token }, function(data){               
                data = $.parseJSON(data);
                group_code.val(data);
            });
        });
        $('#datetimepicker1').datetimepicker({
            defaultDate: new Date(),
            showTodayButton: true,
            format: 'DD/MM/YYYY',
            sideBySide: true,
            // minDate: new Date("{!! date('Y-m-d') !!}")
        });

        $('#datetimepicker2').datetimepicker({
            defaultDate: new Date(),
            showTodayButton: true,
            format: 'DD/MM/YYYY HH:mm',
            sideBySide: true,
            // minDate: new Date("{!! date('Y-m-d 00:00:00') !!}")
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
@endpush
