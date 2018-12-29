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
        $nameCategory = Category::where('parent_id',$slug->id)->get();
        $category = Category::where('id','1')->orwhere('id','2')->get();
        $product_detail = Products::where('category_id',$slug->id)->paginate(9);
        // dd($product_detail);
        $soluongproduct_detail = $product_detail->count();
        $products   = Products::whereIn('category_id',$categoryMen)->Orwhere('category_id',$slug->id)->orderBy('id','DESC')->paginate(9);
        $soluongproducts =   Products::whereIn('category_id',$categoryMen)->count();
        //Menu right
        $childrenMen = Category::where('parent_id','1')->pluck('id');
        $childrenWomen = Category::where('parent_id','2')->pluck('id');
        $nameMen = Category::where('parent_id','1')->get();
        $nameWomen = Category::where('parent_id','2')->get();
        $productsMen = Products::whereIn('category_id',$childrenMen)->Orwhere('category_id','1')->get();
        $soluongMen = $productsMen->count();
        // dd($soluongMen);
        $productsWomen = Products::whereIn('category_id',$childrenWomen)->Orwhere('category_id','2')->get();
        $soluongWomen = $productsWomen->count();

        return view( 'products::frontend.index',compact('nameMen','soluongWomen','productsWomen','soluongMen','productsMen','nameWomen','products','childrenWomen','childrenMen','soluongproduct_detail','soluongproducts','countCart','nameCategory','category','product_detail'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

     public function detail($id){
         $countCart =0;
        $product_detail =Products::select('products__products.*','category__categories.name as categoryName')
            ->leftjoin('category__categories', 'category__categories.id', '=', 'products__products.category_id')
            ->where('products__products.id', $id)
            ->first();
        $category = Category::whereIn('id', [1, 2])->get();
        $category_for_ids = Products::select('products__products.*','category__categories.name as categoryName')
            ->leftjoin('category__categories', 'category__categories.id', '=', 'products__products.category_id')
            ->where('products__products.category_id', $product_detail->category_id)
            ->get();
        return view( 'products::frontend.detail',compact('product_detail','countCart','category','category_for_ids'));
     }
}
