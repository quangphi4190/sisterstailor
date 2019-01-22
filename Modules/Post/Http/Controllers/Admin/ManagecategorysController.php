<?php

namespace Modules\Post\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Post\Entities\Managecategorys;
use Modules\Post\Http\Requests\CreateManagecategorysRequest;
use Modules\Post\Http\Requests\UpdateManagecategorysRequest;
use Modules\Post\Repositories\ManagecategorysRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Post\Entities\Postcategory;
use DB;
use Illuminate\Support\Facades\Input;

class ManagecategorysController extends AdminBaseController
{
    /**
     * @var ManagecategorysRepository
     */
 
    private $managecategorys;

    public function __construct(ManagecategorysRepository $managecategorys)
    {
        parent::__construct();

        $this->managecategorys = $managecategorys;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // $managecategorys = $this->managecategorys->all();
        $managecategorys = Managecategorys::select('post__managecategorys.*','post__postcategories.name as name_postCategory' )
        ->leftjoin('post__postcategories', 'post__postcategories.id', '=', 'post__managecategorys.category_id')->get();
        return view('post::admin.managecategorys.index', compact('managecategorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $postCategorys = DB::table('post__postcategories')->where('status', 1)->get();
        $managecategorys = new Managecategorys();
        return view('post::admin.managecategorys.create',compact('managecategorys','postCategorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateManagecategorysRequest $request
     * @return Response
     */
    public function store(CreateManagecategorysRequest $request)
    {
        
        $this->managecategorys->create($request->all());

        return redirect()->route('admin.post.managecategorys.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('post::managecategorys.title.managecategorys')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Managecategorys $managecategorys
     * @return Response
     */
    public function edit(Managecategorys $managecategorys)
    {
        $postCategorys = DB::table('post__postcategories')->where('status', 1)->get();
        $category_id = $managecategorys->category_id;
        $status = $managecategorys['status'];
        return view('post::admin.managecategorys.edit', compact('managecategorys','status','category_id','postCategorys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Managecategorys $managecategorys
     * @param  UpdateManagecategorysRequest $request
     * @return Response
     */
    public function update(Managecategorys $managecategorys, UpdateManagecategorysRequest $request)
    {
        $this->managecategorys->update($managecategorys, $request->all());

        return redirect()->route('admin.post.managecategorys.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('post::managecategorys.title.managecategorys')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Managecategorys $managecategorys
     * @return Response
     */
    public function destroy(Managecategorys $managecategorys)
    {
        $this->managecategorys->destroy($managecategorys);

        return redirect()->route('admin.post.managecategorys.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('post::managecategorys.title.managecategorys')]));
    }

    public function addCategory (){       
        $inputs = Input::all();
        $category = new Postcategory();      
        $category->name = $inputs['category_name'] ? $inputs['category_name'] :'';      
        $category->status = 1;
        $category->save();

        $postCategorys = DB::table('post__postcategories')->where('status', 1)->get();
        die(json_encode($postCategorys));
    }
     public function checkSlug(){
        $date = date('d-m-Y');
         $inputs = Input::all();
         $check= DB::table('post__managecategorys')->where('status', 1)->where('slug',$inputs['slug'])->first();
         if ($check) {
             $slug =$check->slug.'-'.$date;
             die(json_encode($slug));
         } else {
             die(json_encode(1));
         }
     }
}
