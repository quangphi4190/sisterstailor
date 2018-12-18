@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('invoices::invoices.title.invoices') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i
                        class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('invoices::invoices.title.invoices') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.invoices.invoice.create') }}" class="btn btn-primary btn-flat"
                       style="padding: 4px 10px;">
                        <i class="fa fa-plus"></i> {{ trans('invoices::invoices.button.create invoice') }}
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
                                <th>Tên người đứng hóa đơn</th>
                                <th>Số điện thoại thanh toán</th>
                                <th>Ghi chú</th>
                                <th data-sortable="false">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($invoices)): 
                                  $stt=1;  
                                ?>
                            <?php foreach ($invoices as $invoice): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.invoices.invoice.edit', [$invoice->id]) }}">
                                        {{ $stt ++}}
                                    </a>
                                </td>
                               
                                <td>
                                    <a href="{{ route('admin.invoices.invoice.edit', [$invoice->id]) }}">
                                        {{ $invoice->billing_name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.invoices.invoice.edit', [$invoice->id]) }}">
                                        {{ $invoice->billing_phone }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.invoices.invoice.edit', [$invoice->id]) }}">
                                        <?php echo $invoice->note; ?>
                                    </a>
                                </td>                               
                               
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.invoices.invoice.edit', [$invoice->id]) }}"
                                           class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal"
                                                data-target="#modal-delete-confirmation"
                                                data-action-target="{{ route('admin.invoices.invoice.destroy', [$invoice->id]) }}">
                                            <i class="fa fa-trash"></i></button>
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
        <dd>{{ trans('invoices::invoices.title.create invoice') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).keypressAction({
                actions: [
                    {key: 'c', route: "<?= route('admin.invoices.invoice.create') ?>"}
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
                "order": [[0, "asc"]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@endpush
