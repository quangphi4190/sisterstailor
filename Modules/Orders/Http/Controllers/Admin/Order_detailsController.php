<?php

namespace Modules\Orders\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Orders\Entities\Order_details;
use Modules\Orders\Http\Requests\CreateOrder_detailsRequest;
use Modules\Orders\Http\Requests\UpdateOrder_detailsRequest;
use Modules\Orders\Repositories\Order_detailsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class Order_detailsController extends AdminBaseController
{
    /**
     * @var Order_detailsRepository
     */
    private $order_details;

    public function __construct(Order_detailsRepository $order_details)
    {
        parent::__construct();

        $this->order_details = $order_details;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$order_details = $this->order_details->all();
        $order_details = Order_details::select('orders__order_details.*','products__products.name as product_name')
        ->leftjoin('products__products', 'products__products.id', '=', 'orders__order_details.product_id')->get();
        return view('orders::admin.order_details.index', compact('order_details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('orders::admin.order_details.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateOrder_detailsRequest $request
     * @return Response
     */
    public function store(CreateOrder_detailsRequest $request)
    {
        $this->order_details->create($request->all());

        return redirect()->route('admin.orders.order_details.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('orders::order_details.title.order_details')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Order_details $order_details
     * @return Response
     */
    public function edit(Order_details $order_details)
    {
        return view('orders::admin.order_details.edit', compact('order_details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Order_details $order_details
     * @param  UpdateOrder_detailsRequest $request
     * @return Response
     */
    public function update(Order_details $order_details, UpdateOrder_detailsRequest $request)
    {
        $this->order_details->update($order_details, $request->all());

        return redirect()->route('admin.orders.order_details.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('orders::order_details.title.order_details')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Order_details $order_details
     * @return Response
     */
    public function destroy(Order_details $order_details)
    {
        $this->order_details->destroy($order_details);

        return redirect()->route('admin.orders.order_details.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('orders::order_details.title.order_details')]));
    }
}
