<?php

namespace Modules\Products\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Products\Entities\Categories;
use Modules\Products\Http\Requests\CreateCategoriesRequest;
use Modules\Products\Http\Requests\UpdateCategoriesRequest;
use Modules\Products\Repositories\CategoriesRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CategoriesController extends AdminBaseController
{
    /**
     * @var CategoriesRepository
     */
    private $categories;

    public function __construct(CategoriesRepository $categories)
    {
        parent::__construct();

        $this->categories = $categories;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$categories = $this->categories->all();

        return view('products::admin.categories.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('products::admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCategoriesRequest $request
     * @return Response
     */
    public function store(CreateCategoriesRequest $request)
    {
        $this->categories->create($request->all());

        return redirect()->route('admin.products.categories.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('products::categories.title.categories')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Categories $categories
     * @return Response
     */
    public function edit(Categories $categories)
    {
        return view('products::admin.categories.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Categories $categories
     * @param  UpdateCategoriesRequest $request
     * @return Response
     */
    public function update(Categories $categories, UpdateCategoriesRequest $request)
    {
        $this->categories->update($categories, $request->all());

        return redirect()->route('admin.products.categories.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('products::categories.title.categories')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Categories $categories
     * @return Response
     */
    public function destroy(Categories $categories)
    {
        $this->categories->destroy($categories);

        return redirect()->route('admin.products.categories.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('products::categories.title.categories')]));
    }
}
