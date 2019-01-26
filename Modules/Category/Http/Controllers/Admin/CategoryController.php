<?php

namespace Modules\Category\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Category\Entities\Category;
use Modules\Products\Entities\Products;
use Modules\Category\Http\Requests\CreateCategoryRequest;
use Modules\Category\Http\Requests\UpdateCategoryRequest;
use Modules\Category\Repositories\CategoryRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CategoryController extends AdminBaseController
{
    /**
     * @var CategoryRepository
     */
    private $category;

    public function __construct(CategoryRepository $category)
    {
        parent::__construct();

        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->category->all();
        $parent = Category::all();

        return view('category::admin.categories.index', compact('categories','parent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $parent = Category::where('parent_id',Null)->get();
        return view('category::admin.categories.create',compact('parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCategoryRequest $request
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
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

        $this->category->create($data);

        return redirect()->route('admin.category.category.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('category::categories.title.categories')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        $parent = Category::all();
        return view('category::admin.categories.edit', compact('category','parent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Category $category
     * @param  UpdateCategoryRequest $request
     * @return Response
     */
    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $this->category->update($category, $request->all());

        return redirect()->route('admin.category.category.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('category::categories.title.categories')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return Response
     */


    public function destroy(Category $category)
    {
        $products = Products::where('category_id',$category->id)->get()->count();
        if ($category->id  > '2' && $products == 0) {
        $this->category->destroy($category);

        return redirect()->route('admin.category.category.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('category::categories.title.categories')]));
        }
        return redirect()->route('admin.category.category.index')
            ->withError('Xóa danh mục sản phẩm thất bại. Vẫn còn sản phẩm trong danh mục hoặc là danh mục mặc định. Xin kiểm tra lại.');
    }
    
}
