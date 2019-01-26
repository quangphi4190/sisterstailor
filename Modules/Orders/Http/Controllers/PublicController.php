<?php namespace Modules\Orders\Http\Controllers;


use App\Http\Requests\Request;
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
        $countCart = 0;
        $category = Category::whereIn('id', [1, 2])->get();
        return view('orders::client.index', compact('countCart', 'category'));
    }

    public function add_cart(\Illuminate\Http\Request $request)
    {
        $product = $this->products->find($request->product);
        $quantity = $request->quantity;
        $cookie =  $_COOKIE['orders'];
        $data = (array)json_decode($cookie);

        if(isset($data[$product->id])){
            $data[$product->id]['quantity']=$data[$product->id]['quantity'] + $quantity;
            $data[$product->id]['price']= $product->price_discount>0?$product->price_discount:$product->price;
        }else{
            $data[$product->id] = [
                'quantity'=>$quantity,
                'price'=>$product->price_discount>0?$product->price_discount:$product->price
            ];
        }
        $orders = json_encode($data);

        setcookie('orders', $orders, time() + 10*24*3600);

        return response()->json($orders);
    }

    public function get_cart()
    {
        $data = $_COOKIE['orders'];
        $orders = json_decode($data);
        dd($orders);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add_orders()
    {
        $inputs = Input::all();
        dd($inputs);
    }
}
