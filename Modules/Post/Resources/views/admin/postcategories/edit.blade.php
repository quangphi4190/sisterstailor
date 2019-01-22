@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('post::postcategories.title.edit postcategory') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.post.postcategory.index') }}">{{ trans('post::postcategories.title.postcategories') }}</a></li>
        <li class="active">{{ trans('post::postcategories.title.edit postcategory') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.post.postcategory.update', $postcategory->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                        <input hidden name = "id" value ="<?php echo $postcategory->id?>">
                            @include('post::admin.postcategories.partials.edit-fields', ['lang' => $locale])
                        </div>
                    @endforeach

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.post.postcategory.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
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
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.post.postcategory.index') ?>" }
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

        /* convet slug */
        function convertToSlug( str ) {

            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from = "àáäâèéëêệìíïîòóöôùúüûñçộđươợếẳứếăạọũảậễầểấờừờớẻắoã·/_,:;";
            var to   = "aaaaeeeeeiiiioooouuuuncoduooeaueaaouaaeaeaouooeaoa------";
            for (var i=0, l=from.length ; i<l ; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                .replace(/\s+/g, '-') // collapse whitespace and replace by -
                .replace(/-+/g, '-'); // collapse dashes


            $.ajax({
                type: 'POST',
                url: route('admin.post.postcategories.checkSlug'),
                data: {
                    _token: '{{ csrf_token() }}',
                    slug: str
                },
                success: function(data) {
                    if(data == 1){
                        $('#slug-text').val(str);
                    }else {
                        data = $.parseJSON(data);
                        $('#slug-text').val(data);
                    }

                },
                error: function () {

                }
            });


            //return str;
        }

    </script>
@endpush
