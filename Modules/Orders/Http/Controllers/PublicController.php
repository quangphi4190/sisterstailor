<?php namespace Modules\Orders\Http\Controllers;


use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Orders\Entities\Order_details;
use Modules\Orders\Entities\Order_detailsTranslation;
use Modules\Orders\Repositories\OrderRepository;
use Modules\Orders\Entities\Order;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Input;

class PublicController extends BasePublicController {
    private $orders;
   
    /**
     * @var FooterSliderRepository
     *

     * PublicController constructor.
     *
     * @param RoomRepository $ordersRepository
     */
    public function __construct(OrderRepository $orders) {
        parent::__construct();
        $this->orders        = $orders;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
     $countCart =3;
      return view( 'orders::client.index',compact('countCart'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add_orders(){
        $inputs = Input::all();
        dd($inputs);
    }
}
