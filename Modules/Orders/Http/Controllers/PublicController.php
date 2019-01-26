<?php namespace Modules\Orders\Http\Controllers;

use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Orders\Entities\Order_details;
use Modules\Orders\Entities\Order_detailsTranslation;
use Modules\Orders\Repositories\OrderRepository;
use Modules\Orders\Entities\Order;
use Modules\Products\Repositories\ProductsRepository;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Input;
use Modules\Category\Entities\Category;

class PublicController extends BasePublicController
{
    private $orders;
    private $products;

    /**
     * @var FooterSliderRepository
     *
     * PublicController constructor.
     *
     * @param RoomRepository $ordersRepository
     */
    public function __construct(OrderRepository $orders, ProductsRepository $productsRepository)
    {
        parent::__construct();
        $this->orders = $orders;
        $this->products = $productsRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (isset($_COOKIE['orders']))
            $cookie = $_COOKIE['orders'];
        else
            $cookie = '[]';
        $data = (array)json_decode($cookie);
        $total = 0;
        foreach ($data as $key => $value) {
            $product = $this->products->find($key);
            $data[$key]->image = $product->files()->where('zone', 'Hình Ảnh')->first();
            $data[$key]->name = $product->name;
            $data[$key]->slug = $product->slug;
            $data[$key]->total = $data[$key]->price * $data[$key]->quantity;
            $total += $data[$key]->total;
        }

        return view('orders::client.index', compact('data', 'total'));
    }

    public function confirm_order()
    {
        if (isset($_COOKIE['orders']))
            $cookie = $_COOKIE['orders'];
        else
            $cookie = '[]';
        $data = (array)json_decode($cookie);
        $total = 0;
        foreach ($data as $key => $value) {
            $product = $this->products->find($key);
            $data[$key]->image = $product->files()->where('zone', 'Hình Ảnh')->first();
            $data[$key]->name = $product->name;
            $data[$key]->slug = $product->slug;
            $data[$key]->total = $data[$key]->price * $data[$key]->quantity;
            $total += $data[$key]->total;
        }

    }
    public function submit_order(\Illuminate\Http\Request $request)
    {

    }

    public function add_cart(\Illuminate\Http\Request $request)
    {
        $product = $this->products->find($request->product);
        $quantity = $request->quantity;
        if (isset($_COOKIE['orders']))
            $cookie = $_COOKIE['orders'];
        else
            $cookie = '[]';
        $data = (array)json_decode($cookie);

        if (isset($data[$product->id])) {
            $data[$product->id]->quantity = $data[$product->id]->quantity + $quantity;
            $data[$product->id]->price = $product->price_discount > 0 ? $product->price_discount : $product->price;
        } else {
            $data[$product->id] = new \stdClass();
            $data[$product->id]->quantity = $quantity;
            $data[$product->id]->price = $product->price_discount > 0 ? $product->price_discount : $product->price;

        }
        $total = 0;
        foreach ($data as $key => $value) {
            $total += $value->quantity;
        }
        $orders = json_encode($data);

        setcookie('orders', $orders, time() + 10 * 24 * 3600);

        return response()->json([
            'success' => true,
            'total' => $total,
            'orders' => $orders]);
    }

    public function get_cart()
    {
        if (isset($_COOKIE['orders'])) {
            $data = $_COOKIE['orders'];
        } else {
            $data = '[]';
        }
        $orders = json_decode($data);
        $total = 0;
        foreach ($orders as $key => $value) {
            $total += $value->quantity;
        }
        return response()->json([
            'success' => true,
            'total' => $total,
            'orders' => $orders]);
    }
}
