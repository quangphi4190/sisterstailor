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
        
        
        // dd($soluongproduct_detail);
        $categoryMen = Category::where('parent_id',$slug->id)->pluck('id');
        $childrenMen = Category::where('parent_id','1')->get();
        $childrenWomen = Category::where('parent_id','2')->get();
        $nameCategory = Category::where('parent_id',$slug->id)->get();
        $category = Category::where('id','1')->orwhere('id','2')->get();
        $product_detail = Products::where('category_id',$slug->id)->get();
        $soluongproduct_detail = $product_detail->count();
        $products   = Products::whereIn('category_id',$categoryMen)->Orwhere('category_id',$slug->id)->orderBy('id','DESC')->get();
        // dd($products);
        $soluongproducts =   Products::whereIn('category_id',$categoryMen)->count();  
        // $men     = Products::whereIn('category_id',$categoryMen)->Orwhere('category_id','1')->orderBy('id','DESC')->take(4)->get();
        return view( 'products::frontend.index',compact('products','childrenWomen','childrenMen','soluongproduct_detail','soluongproducts','countCart','nameCategory','category','product_detail'));
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
