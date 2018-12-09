<?php

namespace Modules\Invoices\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Invoices\Entities\Invoice;
use Modules\Invoices\Http\Requests\CreateInvoiceRequest;
use Modules\Invoices\Http\Requests\UpdateInvoiceRequest;
use Modules\Invoices\Repositories\InvoiceRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class InvoiceController extends AdminBaseController
{
    /**
     * @var InvoiceRepository
     */
    private $invoice;

    public function __construct(InvoiceRepository $invoice)
    {
        parent::__construct();

        $this->invoice = $invoice;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $invoices = $this->invoice->all();

        return view('invoices::admin.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('invoices::admin.invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateInvoiceRequest $request
     * @return Response
     */
    public function store(CreateInvoiceRequest $request)
    {
        $this->invoice->create($request->all());

        return redirect()->route('admin.invoices.invoice.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('invoices::invoices.title.invoices')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Invoice $invoice
     * @return Response
     */
    public function edit(Invoice $invoice)
    {
        return view('invoices::admin.invoices.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Invoice $invoice
     * @param  UpdateInvoiceRequest $request
     * @return Response
     */
    public function update(Invoice $invoice, UpdateInvoiceRequest $request)
    {
        $this->invoice->update($invoice, $request->all());

        return redirect()->route('admin.invoices.invoice.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('invoices::invoices.title.invoices')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Invoice $invoice
     * @return Response
     */
    public function destroy(Invoice $invoice)
    {
        $this->invoice->destroy($invoice);

        return redirect()->route('admin.invoices.invoice.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('invoices::invoices.title.invoices')]));
    }
}
