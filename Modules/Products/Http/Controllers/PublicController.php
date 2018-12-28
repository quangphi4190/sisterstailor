<?php namespace Modules\Products\Http\Controllers;


use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Products\Repositories\ProductsRepository;
use Modules\Products\Entities\Products;
use Modules\Products\Entities\ProductsTranslation;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Input;
class PublicController extends BasePublicController {
    private $products;

    /**
     * @var FooterSliderRepository
     *

    /**
     * PublicController constructor.
     *
     * @param RoomRepository $offerRepository
     * @param RoomCatRepository $offerCatRepository
     */
    public function __construct(ProductsRepository $products) {
        parent::__construct();
        $this->products        = $products;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $products = Products::all();
        return view( 'products::frontend.index',compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

     public function detail($id){
         $countCart =0;
        $product_detail =Products::where('id', $id)->first();
        return view( 'products::frontend.detail',compact('product_detail','countCart'));
     }
}
