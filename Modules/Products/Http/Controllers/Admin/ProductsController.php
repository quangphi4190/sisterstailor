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
        $categories =   Category::all();
        return view('products::admin.products.create',compact('products','categories'));
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
        $exist = $category = Category::where('slug', $slug)->first();
        if ($exist != null) {
            $id = 1;
            $slug = $slug . '-' . $id;
            while ($category = Category::where('slug', $slug)->first() != null) {
                $id++;
                $slug = $slug . '-' . $id;
            }
        }


        $data['slug'] = $slug;
        $this->products->create($request->all());

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
        $status = $products->status ? $products->status: '';
        $category = Category::where('id',$products->category_id)->get();
        dd($category);die();
        return view('products::admin.products.edit', compact('products','status','category'));
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
        $this->products->update($products, $request->all());

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
