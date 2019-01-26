<?php

namespace Modules\Products\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
use Modules\Category\Entities\Category;
use Modules\Products\Entities\Products;
use Modules\Products\Http\Requests\CreateProductsRequest;
use Modules\Products\Http\Requests\UpdateProductsRequest;
use Modules\Products\Repositories\ProductsRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ProductsController extends AdminBaseController
{
    /**
     * @var ProductsRepository
     */
    private $products;

    public function __construct(ProductsRepository $products)
    {
        parent::__construct();

        $this->products = $products;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = $this->products->all();
        $categories =   Category::all();

        return view('products::admin.products.index',compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $products = new Products();
        $categoriesMen =   Category::where('parent_id',1)->get();
        $categoriesWomen =   Category::where('parent_id',2)->get();
        $categoriesOrther    =   Category::where('parent_id',Null)->whereNotIn('id',[1,2])->get();
        return view('products::admin.products.create',compact('products','categoriesMen','categoriesWomen','categoriesOrther'));
    }
    public function check($id){
        $soluong = Category::where('parent_id',$id)->get()->count();
        return $soluong > 0;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProductsRequest $request
     * @return Response
     */
    public function store(CreateProductsRequest $request)
    {
        $data = $request->all();
        $slug = str_slug($data['name']);
        $exist = $products = Products::where('slug', $slug)->first();
        if ($exist != null) {
            $id = 1;
            $slug = $slug . '-' . $id;
            while ($products = Products::where('slug', $slug)->first() != null) {
                $id++;
                $slug = $slug . '-' . $id;
            }
        }
        $data['slug'] = $slug;
        $price = $data['price'];
        $disprice = $data['price_discount'];
        if ($price <= $disprice){
            return redirect()->back()->withErrors('Giá khuyến mãi phải thấp hơn Đơn giá,vui lòng kiểm tra lại');
        }
        $this->products->create($data);

        return redirect()->route('admin.products.products.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('products::products.title.products')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Products $products
     * @return Response
     */
    public function edit(Products $products)
    {

        $categoriesMen =   Category::where('parent_id',1)->get();
        $categoriesWomen =   Category::where('parent_id',2)->get();
        $categoriesOrther    =   Category::where('parent_id',Null)->whereNotIn('id',[1,2])->get();
        $status = $products->status ? $products->status: '';
        if ($products->category_id != null){
            $category = Category::where('id',$products->category_id)->first();
        } else  {
            $category = "Chọn Sản Phẩm";
        }
        return view('products::admin.products.edit', compact('categoriesOrther','categoriesMen','categoriesWomen','products','status','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Products $products
     * @param  UpdateProductsRequest $request
     * @return Response
     */
    public function update(Products $products, UpdateProductsRequest $request)
    {

        $data = $request->all();
        $data['featured'] = intval($data['featured']);

        $price = $data['price'];
        $disprice = $data['price_discount'];
        if ($price <= $disprice){
            return redirect()->back()->withErrors('Giá khuyến mãi phải thấp hơn Đơn giá,vui lòng kiểm tra lại');
        }

        $this->products->update($products, $data);

        return redirect()->route('admin.products.products.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('products::products.title.products')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Products $products
     * @return Response
     */
    public function destroy(Products $products)
    {
        $this->products->destroy($products);

        return redirect()->route('admin.products.products.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('products::products.title.products')]));
    }
}
