@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('post::managecategorys.title.managecategorys') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('post::managecategorys.title.managecategorys') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.post.managecategorys.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('post::managecategorys.button.create managecategorys') }}
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
                                <th>{{ trans('post::managecategorys.title.name') }}</th>
                                <th>{{ trans('post::managecategorys.title.post name') }}</th>
                                <th>{{ trans('post::managecategorys.title.status') }}</th>                                
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($managecategorys)):$i=1 ?>
                            <?php foreach ($managecategorys as $managecategorys): ?>
                            <tr>
                                <td>
                                    {{$i++}}
                                </td>
                                <td>
                                    <a href="{{ route('admin.post.managecategorys.edit', [$managecategorys->id]) }}">
                                        {{ $managecategorys->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.post.managecategorys.edit', [$managecategorys->id]) }}">
                                        {{ $managecategorys->name_postCategory }}
                                    </a>
                                </td>
                               <td>
                                    <a href="{{ route('admin.post.managecategorys.edit', [$managecategorys->id]) }}">
                                        {{ $managecategorys->status ==1 ?'Đã kích hoạt' : 'Chưa kích hoạt'}}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.post.managecategorys.edit', [$managecategorys->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.post.managecategorys.destroy', [$managecategorys->id]) }}"><i class="fa fa-trash"></i></button>
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
        <dd>{{ trans('post::managecategorys.title.create managecategorys') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.post.managecategorys.create') ?>" }
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
