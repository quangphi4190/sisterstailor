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
        $defen = $slug;
        
        $slug = Category::where('slug',$slug)->first();
        $othercategoryId = Category::whereNotIn('id',[1,2])->where('parent_id',Null)->pluck('id');
        $productother = Products::whereIn('category_id',$othercategoryId)->get();
        $soluongproductsother = $productother->count();
        
        // dd($soluongproduct_detail);
        $categoryMen = Category::where('parent_id',$slug->id)->pluck('id');
        $nameCategory = Category::where('parent_id',$slug->id)->get();
        $products   = Products::where('status',1)->whereIn('category_id',$categoryMen)->Orwhere('category_id',$slug->id)->orderBy('id','DESC')->paginate(12);
        $soluongproducts =   $products->count();
        //Menu right
        $childrenMen = Category::where('parent_id','1')->pluck('id');
        $childrenWomen = Category::where('parent_id','2')->pluck('id');
        $productsMen = Products::where('status',1)->whereIn('category_id',$childrenMen)->Orwhere('category_id','1')->get();
        $soluongMen = $productsMen->count();
        // dd($soluongMen);


        $productsWomen = Products::where('status',1)->whereIn('category_id',$childrenWomen)->Orwhere('category_id','2')->get();
        $soluongWomen = $productsWomen->count();

        return view( 'products::frontend.index',compact('soluongproductsother','productother','slug','defen','soluongWomen','productsWomen','soluongMen','productsMen','products','childrenWomen','childrenMen','soluongproducts','countCart','nameCategory'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

     public function detail($slug){

        $product_detail =Products::select('products__products.*','category__categories.name as categoryName')
            ->leftjoin('category__categories', 'category__categories.id', '=', 'products__products.category_id')
            ->where('products__products.slug', $slug)
            ->first();
            if($product_detail->category_id != null) {
                $categoryProducts = Category::where('id',$product_detail->category_id)->first();
            }else {
        
                $categoryProducts= "";
            }
        $category_for_ids = Products::select('products__products.*','category__categories.name as categoryName')
            ->leftjoin('category__categories', 'category__categories.id', '=', 'products__products.category_id')
            ->where('products__products.category_id', $product_detail->category_id)
            ->orderBy('id','DESC')
            ->take(8)
            ->get();
        return view( 'products::frontend.detail',compact('categoryProducts','product_detail','countCart','category_for_ids'));
     }

}
