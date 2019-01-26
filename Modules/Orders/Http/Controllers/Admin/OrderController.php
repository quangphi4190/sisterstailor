<?php

namespace Modules\Orders\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Orders\Entities\Order;
use Modules\Orders\Entities\Order_details;
use Modules\Orders\Http\Requests\CreateOrderRequest;
use Modules\Orders\Http\Requests\UpdateOrderRequest;
use Modules\Orders\Repositories\OrderRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Support\Facades\Input;
class OrderController extends AdminBaseController
{
    /**
     * @var OrderRepository
     */
    private $order;

    public function __construct(OrderRepository $order)
    {
        parent::__construct();

        $this->order = $order;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = $this->order->all();

        return view('orders::admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('orders::admin.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateOrderRequest $request
     * @return Response
     */
    public function store(CreateOrderRequest $request)
    {
        $this->order->create($request->all());

        return redirect()->route('admin.orders.order.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('orders::orders.title.orders')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Order $order
     * @return Response
     */
    public function edit(Order $order)
    {
        return view('orders::admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Order $order
     * @param  UpdateOrderRequest $request
     * @return Response
     */
    public function update(Order $order, UpdateOrderRequest $request)
    {
        $this->order->update($order, $request->all());

        return redirect()->route('admin.orders.order.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('orders::orders.title.orders')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Order $order
     * @return Response
     */
    public function destroy(Order $order)
    {
        $this->order->destroy($order);

        return redirect()->route('admin.orders.order.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('orders::orders.title.orders')]));
    }

    public function view_detail(){
        $orderId = Input::get('id','');
        $order = Order::where('id',$orderId)->first();
        $order_defails = Order_details::select('orders__orders.*','orders__order_details.*','products__products.name as nameProduct')->where('order_id',$orderId)
            ->leftjoin('orders__orders', 'orders__orders.id', '=', 'orders__order_details.order_id')
            ->leftjoin('products__products', 'products__products.id', '=', 'orders__order_details.product_id')->get();

        return view('orders::admin.orders.modal-view-detail',compact('order','order_defails'));
    }
}
