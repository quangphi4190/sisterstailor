@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('advertisements::advertisements.title.advertisements') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('advertisements::advertisements.title.advertisements') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.advertisements.advertisement.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('advertisements::advertisements.button.create advertisement') }}
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
                                <th>{{ trans('advertisements::advertisements.title.image') }}</th>
                                <th>{{ trans('advertisements::advertisements.title.name') }}</th>                                
                                <th>{{ trans('advertisements::advertisements.title.position') }}</th>
                                <th>{{ trans('advertisements::advertisements.title.note') }}</th>
                                <th>{{ trans('advertisements::advertisements.title.status') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($advertisements)):$i=1; ?>
                            <?php foreach ($advertisements as $advertisement): ?>
                            @php($image_advertisements = $advertisement->files()->where('zone', 'image_advertisement')->get())
                            <tr>
                                <td>
                                    {{$i++}}
                                </td>
                                <td>
                                    @foreach($image_advertisements as $image)
                                    <div style="width: 100px; height: 100px;">
                                        <img style="height: 100px;" class="img-responsive" src="{{$image->path_string}}">
                                    </div>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('admin.advertisements.advertisement.edit', [$advertisement->id]) }}">
                                        {{ $advertisement->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.advertisements.advertisement.edit', [$advertisement->id]) }}">                                        
                                        <?php
                                        if ($advertisement->position == 1) {
                                             echo "Top";   
                                        }elseif ($advertisement->position == 2) {
                                            echo "Bottom"; 
                                        }elseif ($advertisement->position == 3) {
                                            echo "Left"; 
                                        }elseif ($advertisement->position == 4){
                                            echo "Right"; 
                                        }else {
                                            echo ""; 
                                        }
                        
                                        ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.advertisements.advertisement.edit', [$advertisement->id]) }}">
                                        {!!(str_limit(strip_tags($advertisement->note), 100)) !!}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.advertisements.advertisement.edit', [$advertisement->id]) }}">
                                    {{ $advertisement->status == 1?'Đã kích hoạt' : 'Chưa kích hoạt' }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.advertisements.advertisement.edit', [$advertisement->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.advertisements.advertisement.destroy', [$advertisement->id]) }}"><i class="fa fa-trash"></i></button>
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
        <dd>{{ trans('advertisements::advertisements.title.create advertisement') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.advertisements.advertisement.create') ?>" }
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
