@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('post::managecategorys.title.edit category') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.post.managecategorys.index') }}">{{ trans('post::managecategorys.title.managecategorys') }}</a></li>
        <li class="active">{{ trans('post::managecategorys.title.edit managecategorys') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.post.managecategorys.update', $managecategorys->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('post::admin.managecategorys.partials.edit-fields', ['lang' => $locale])
                        </div>
                    @endforeach

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.post.managecategorys.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
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
                    { key: 'b', route: "<?= route('admin.post.managecategorys.index') ?>" }
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
    $('select[name="category_id"]').chosen({no_results_text: "Không tìm thấy", width: "100%", search_contains:true});
    $('#addCategory').on('submit',function (e) { 
            e.preventDefault();
            var category_name = $('#category_name').val();      
            $.ajax({
                type: 'POST',
                url: route('admin.post.managecategorys.addCategory'),
                data: {
                    _token: '{{ csrf_token() }}',
                    category_name: category_name
                },
                success: function(data) {              
                    var $el = $("select#category_id");
                        $el.empty();
                        $el.append("<option>Chọn danh mục</option>");
                        data = $.parseJSON(data);
                        let i = 0, l = data.length;
                        for(i; i < l; i++) {
                            let v = data[i];console.log(v.name);
                            $el.append("<option value='" + v.id + "'>" + v.name + "</option>");
                            $('.fom-category').trigger("chosen:updated");
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
          });

    /* convet slug */
    function convertToSlug( str ) {

        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();

        // remove accents, swap ñ for n, etc
        var from = "àáäâèéëêệìíïîòóöôùúüûñçộđươợếẳứếăạọũảậễầểấờừờớẻắ·/_,:;";
        var to   = "aaaaeeeeeiiiioooouuuuncoduooeaueaaouaaeaeaouooea------";
        for (var i=0, l=from.length ; i<l ; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '-') // collapse whitespace and replace by -
            .replace(/-+/g, '-'); // collapse dashes

        var slug = $('#slug-text').val();
        $.ajax({
            type: 'POST',
            url: route('admin.post.managecategorys.checkSlug'),
            data: {
                _token: '{{ csrf_token() }}',
                slug: str
            },
            success: function(data) {console.log('21312321');
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
