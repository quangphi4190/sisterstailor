@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('customers::customers.title.customers') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('customers::customers.title.customers') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.customers.customer.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-plus"></i> {{ trans('customers::customers.button.create customer') }}
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
                                <th>Họ tên</th>
                                <th>Giới tính</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>                                
                                <th>Loại khách hàng</th>
                                <th>Trạng thái</th>
                                <th data-sortable="false">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($customers)):
                             $stt=1;   
                             ?>
                            <?php foreach ($customers as $customer): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.customers.customer.edit', [$customer->id]) }}">
                                        {{ $stt++ }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.customers.customer.edit', [$customer->id]) }}">
                                        {{ $customer->firstname.' '.$customer->lastname }}
                                    </a>
                                </td>                               
                                <td>
                                    <a href="{{ route('admin.customers.customer.edit', [$customer->id]) }}">
                                       <?php if( $customer->gender == 1) {
                                           echo 'Nam';
                                        } elseif ($customer->gender == 2) {
                                               echo 'Nữ';
                                         } else {
                                               echo 'N/A';
                                         }
                                           ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.customers.customer.edit', [$customer->id]) }}">
                                        {{ $customer->address }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.customers.customer.edit', [$customer->id]) }}">
                                        {{ $customer->phone }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.customers.customer.edit', [$customer->id]) }}">
                                        {{ $customer->mail }}
                                    </a>
                                </td>                               
                                <td>
                                    <a href="{{ route('admin.customers.customer.edit', [$customer->id]) }}">
                                        {{ $customer->customer_type == 1 ? 'Bình Thường' : 'VIP'}}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.customers.customer.edit', [$customer->id]) }}">
                                        {{ $customer->status == 1 ? 'Đang hoạt động' : 'Chưa kích hoạt'}}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.customers.customer.view', [$customer->id]) }}" title="{{ trans('customers::customers.title.view customer') }}" class="btn btn-default btn-flat"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('admin.customers.customer.edit', [$customer->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.customers.customer.destroy', [$customer->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            {{--<tr>--}}
                                {{--<th>{{ trans('core::core.table.created at') }}</th>--}}
                                {{--<th>{{ trans('core::core.table.actions') }}</th>--}}
                            {{--</tr>--}}
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
        <dd>{{ trans('customers::customers.title.create customer') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.customers.customer.create') ?>" }
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
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@endpush
