<?php

namespace Modules\Post\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Post\Entities\Postcategory;
use Modules\Post\Http\Requests\CreatePostcategoryRequest;
use Modules\Post\Http\Requests\UpdatePostcategoryRequest;
use Modules\Post\Repositories\PostcategoryRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Support\Facades\Input;
use DB;
class PostcategoryController extends AdminBaseController
{
    /**
     * @var PostcategoryRepository
     */
    private $postcategory;

    public function __construct(PostcategoryRepository $postcategory)
    {
        parent::__construct();

        $this->postcategory = $postcategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $postcategories = $this->postcategory->all();
          
        return view('post::admin.postcategories.index', compact('postcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('post::admin.postcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePostcategoryRequest $request
     * @return Response
     */
    public function store(CreatePostcategoryRequest $request)
    {

        $data = $request->all();
        $slug = str_slug($data['name']);
        $exist = $post = Postcategory::where('slug', $slug)->first();
        if ($exist != null) {
            $id = 1;
            $slug = $slug . '-' . $id;
            while ($post = Postcategory::where('slug', $slug)->first() != null) {
                $id++;
                $slug = $slug . '-' . $id;
            }
        }


        $data['slug'] = $slug;
         $this->postcategory->create($request->all());

        // $postcategory = new Postcategory();
        // $postcategory->name = $request['name'];      
        // $postcategory->status = $request['status'];     
        // $postcategory->save();


        return redirect()->route('admin.post.postcategory.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('post::postcategories.title.postcategories')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Postcategory $postcategory
     * @return Response
     */
    public function edit(Postcategory $postcategory)
    {
        $status =$postcategory->status;
        return view('post::admin.postcategories.edit', compact('postcategory','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Postcategory $postcategory
     * @param  UpdatePostcategoryRequest $request
     * @return Response
     */
    public function update(Postcategory $postcategory, UpdatePostcategoryRequest $request)
    {
         $this->postcategory->update($postcategory, $request->all());
     
        // $name = $request['name'];
        // $status = $request['status'];
        // Postcategory::where('id', $request['id'])->update(array('name'=>$name,'status'=>$status));

        return redirect()->route('admin.post.postcategory.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('post::postcategories.title.postcategories')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Postcategory $postcategory
     * @return Response
     */
    public function destroy(Postcategory $postcategory)
    {
        $this->postcategory->destroy($postcategory);

        return redirect()->route('admin.post.postcategory.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('post::postcategories.title.postcategories')]));
    }

    public function checkSlug(){
        $date = date('d-m-Y');
        $inputs = Input::all();
        $check= DB::table('post__postcategories')->where('status', 1)->where('slug',$inputs['slug'])->first();
        if ($check) {
            $slug =$check->slug.'-'.$date;
            die(json_encode($slug));
        } else {
            die(json_encode(1));
        }
    }
}
