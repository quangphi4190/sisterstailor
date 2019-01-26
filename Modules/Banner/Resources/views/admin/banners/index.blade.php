@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('banner::banners.title.banners') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('banner::banners.title.banners') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.banner.banner.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('banner::banners.button.create banner') }}
                    </a>
                </div>
            </div>
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
                                <th>{{ trans('banner::banners.title.image') }}</th>
                                <th>{{ trans('banner::banners.title.name') }}</th>
                                <th>{{ trans('banner::banners.title.description') }}</th>
                                <th>{{ trans('banner::banners.title.link') }}</th>
                                <th>{{ trans('banner::banners.title.status') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($banners)): $i=1?>
                            <?php foreach ($banners as $banner): ?>
                            @php($image_banners = $banner->files()->where('zone', 'Image_baner')->get())
                            
                            <tr>
                                <td>
                                    {{$i++}}
                                </td>
                                <td >
                                    
                                    @foreach($image_banners as $image)
                                    <div style="width: 100px; height: 100px;">
                                        <img style="width: 100%; height:100%" class="img-responsive" src="{{$image->path_string}}">
                                    </div>
                                    @endforeach
                                    
                                </td>
                                <td>
                                    <a href="{{ route('admin.banner.banner.edit', [$banner->id]) }}">
                                        {{ $banner->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.banner.banner.edit', [$banner->id]) }}">
                                         {!!(str_limit(strip_tags($banner->description), 100)) !!}
                                        
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.banner.banner.edit', [$banner->id]) }}">
                                        {{ $banner->link }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.banner.banner.edit', [$banner->id]) }}">
                                        {{ $banner->status == 1?'Đã kích hoạt' : 'Chưa kích hoạt' }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.banner.banner.edit', [$banner->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.banner.banner.destroy', [$banner->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <!-- <tr>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th>{{ trans('core::core.table.actions') }}</th>
                            </tr> -->
                            </tfoot>
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
        <dd>{{ trans('banner::banners.title.create banner') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.banner.banner.create') ?>" }
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
