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
        $defen = $slug;
        
        $slug = Category::where('slug',$slug)->first();
        
        // dd($soluongproduct_detail);
        $categoryMen = Category::where('parent_id',$slug->id)->pluck('id');
        $nameCategory = Category::where('parent_id',$slug->id)->get();
        $category = Category::where('id','1')->orwhere('id','2')->get();
        $product_detail = Products::where('category_id',$slug->id)->where('status',1)->paginate(12);
        // dd($product_detail);
        $soluongproduct_detail = $product_detail->count();
        $products   = Products::where('status',1)->whereIn('category_id',$categoryMen)->Orwhere('category_id',$slug->id)->orderBy('id','DESC')->paginate(12);
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

        return view( 'products::frontend.index',compact('slug','nameMen','defen','soluongWomen','productsWomen','soluongMen','productsMen','nameWomen','products','childrenWomen','childrenMen','soluongproduct_detail','soluongproducts','countCart','nameCategory','category','product_detail'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

     public function detail($slug){
         $countCart =0;
        $product_detail =Products::select('products__products.*','category__categories.name as categoryName')
            ->leftjoin('category__categories', 'category__categories.id', '=', 'products__products.category_id')
            ->where('products__products.slug', $slug)
            ->first();
        $categoryProducts = Category::where('id',$product_detail->category_id)->first();
        $category = Category::whereIn('id', [1, 2])->get();
        $category_for_ids = Products::select('products__products.*','category__categories.name as categoryName')
            ->leftjoin('category__categories', 'category__categories.id', '=', 'products__products.category_id')
            ->where('products__products.category_id', $product_detail->category_id)
            ->orderBy('id','DESC')
            ->take(8)
            ->get();
        return view( 'products::frontend.detail',compact('categoryProducts','product_detail','countCart','category','category_for_ids'));
     }
     public function get_slug(){
        $slug = Input::get('slug','');
        if ($slug == 'men' || $slug == 'women'){
            $category = Category::where('category__categories.slug',$slug)->pluck('id');
            $childecategory = Category::whereIn('parent_id',$category)->pluck('id');
            $products = Products::whereIn('category_id',$childecategory)->OrWhere('category_id',$category)->get();
        } else{
        $category = Category::where('category__categories.slug',$slug)->get();
        $products = Products::where('category_id',$category['0']['id'])->get();
        }
        return view( 'products::frontend.show-listdata',compact('products'));
     }
}
