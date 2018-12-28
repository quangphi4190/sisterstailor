<?php namespace Modules\Products\Http\Controllers;


use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Products\Repositories\ProductsRepository;
use Modules\Products\Entities\Products;
use Modules\Products\Entities\ProductsTranslation;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Input;
use Modules\Category\Entities\Category;
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
    public function index($slug) {
        $countCart =0;
        $slug = Category::where('slug',$slug)->first();
        $categoryMen = Category::where('parent_id',$slug->id)->pluck('id');
        $nameCategory = Category::where('parent_id',$slug->id);
        $category = Category::where('id','1')->orwhere('id','2')->get();
        
        // $categoryWomen = Category::where('parent_id','2')->pluck('id');  

        $products   = Products::whereIn('category_id',$categoryMen)->orderBy('id','DESC')->get();
        // $men     = Products::whereIn('category_id',$categoryMen)->Orwhere('category_id','1')->orderBy('id','DESC')->take(4)->get();
        return view( 'products::frontend.index',compact('products','countCart','nameCategory','category'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
}
