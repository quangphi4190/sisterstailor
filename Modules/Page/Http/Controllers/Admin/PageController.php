<?php

namespace Modules\Page\Http\Controllers\Admin;

use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Page\Entities\Page;
use Modules\Page\Http\Requests\CreatePageRequest;
use Modules\Page\Http\Requests\UpdatePageRequest;
use Modules\Page\Repositories\PageRepository;
use Illuminate\Support\Facades\Input;
use DB;
class PageController extends AdminBaseController
{
    /**
     * @var PageRepository
     */
    private $page;

    public function __construct(PageRepository $page)
    {
        parent::__construct();

        $this->page = $page;
    }

    public function index()
    {
        return view('page::admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('page::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePageRequest $request
     * @return Response
     */
    public function store(CreatePageRequest $request)
    {
        $this->page->create($request->all());

        return redirect()->route('admin.page.page.index')
            ->withSuccess(trans('page::messages.page created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Page $page
     * @return Response
     */
    public function edit(Page $page)
    {
        return view('page::admin.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Page $page
     * @param  UpdatePageRequest $request
     * @return Response
     */
    public function update(Page $page, UpdatePageRequest $request)
    {
        $this->page->update($page, $request->all());

        if ($request->get('button') === 'index') {
            return redirect()->route('admin.page.page.index')
                ->withSuccess(trans('page::messages.page updated'));
        }

        return redirect()->back()
            ->withSuccess(trans('page::messages.page updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     * @return Response
     */
    public function destroy(Page $page)
    {
        $this->page->destroy($page);

        return redirect()->route('admin.page.page.index')
            ->withSuccess(trans('page::messages.page deleted'));
    }

    public function addCart(){
        $cartID = Input::get('cartID',''); 
        $products__categorie = DB::table('products__categories')->select('products__categories.*','products__products.price','products__products.name as productName')->where('products__categories.id', '=' ,$cartID)
        ->leftjoin('products__products', 'products__products.id', '=', 'products__categories.parent_id')
        ->first();
     
        $minutes = 30;
        $name_cookie = cookie('name', $products__categorie->name, $minutes);
        $description_cookie = cookie('description', $products__categorie->description, $minutes);
        $price_cookie = cookie('price', $products__categorie->price, $minutes);
        $id = cookie('price', $products__categorie->id, $minutes);
     
        die(json_encode($products__categorie));
     }
}
