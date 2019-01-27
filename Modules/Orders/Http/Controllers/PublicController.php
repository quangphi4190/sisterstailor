<?php namespace Modules\Orders\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Orders\Repositories\Order_detailsRepository;
use Modules\Orders\Repositories\OrderRepository;
use Modules\Products\Repositories\ProductsRepository;

class PublicController extends BasePublicController
{
    private $orders;
    private $products;
    private $order_detail;

    /**
     * @var FooterSliderRepository
     *
     * PublicController constructor.
     *
     * @param RoomRepository $ordersRepository
     */
    public function __construct(OrderRepository $orders, ProductsRepository $productsRepository, Order_detailsRepository $detailsRepository)
    {
        parent::__construct();
        $this->orders = $orders;
        $this->products = $productsRepository;
        $this->order_detail = $detailsRepository;
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

    public function checkout()
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
        return view('orders::client.checkout', compact('data', 'total'));

    }


    public function confirm_order(Request $request)
    {
        if (isset($_COOKIE['orders']))
            $cookie = $_COOKIE['orders'];
        else
            $cookie = '[]';
        $data = (array)json_decode($cookie);
        if (count($data) == 0) {
            return redirect(route('homepage'));
        }
        $order = $this->orders->create($request->except('_token'));
            if($order){
                $total = 0;
                foreach ($data as $key => $value) {
                    $product = $this->products->find($key);
                    $detail = $this->order_detail->create([
                        'order_id' => $order->id,
                        'product_id' => $key,
                        'quantity' => $data[$key]->quantity,
                        'price' => $product->price_discount > 0 ? $product->price_discount : $product->price,
                    ]);
                    $total += ($detail->price * $detail->quantity);
                }
            }

        $cookie_name = 'orders';
        unset($_COOKIE[$cookie_name]);

        $res = setcookie($cookie_name, '[]', time() - 3600);
        alert()->success('Successfully', 'Thank you. Your order has been received.')->autoClose(2000);
        return redirect(route('homepage'));
    }

    public function add_cart(Request $request)
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

    public function update_cart(Request $request)
    {
        $product = $this->products->find($request->product);

        $quantity = $request->quantity;
        if (isset($_COOKIE['orders']))
            $cookie = $_COOKIE['orders'];
        else
            $cookie = '[]';
        $data = (array)json_decode($cookie);
        $price = 0;
        if (isset($data[$product->id])) {
            if ($quantity == 0) {
                unset($data[$product->id]);
            } else {
                $data[$product->id]->quantity = $quantity;
                $data[$product->id]->price = $product->price_discount > 0 ? $product->price_discount : $product->price;
                $price = $data[$product->id]->quantity * $data[$product->id]->price;
            }
        } else {
            $data[$product->id] = new \stdClass();
            $data[$product->id]->quantity = $quantity;
            $data[$product->id]->price = $product->price_discount > 0 ? $product->price_discount : $product->price;

        }
        $total = 0;
        $subtotal = 0;
        foreach ($data as $key => $value) {
            $total += $value->quantity;
            $subtotal += ($value->quantity * $value->price);
        }
        $orders = json_encode($data);
        setcookie('orders', $orders, time() + 10 * 24 * 3600);
        return response()->json([
            'success' => true,
            'total' => $total,
            'deleted' => $quantity == 0,
            'price' => $price,
            'subtotal' => round($subtotal, 2)
        ]);
    }
}
