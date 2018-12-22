<?php

namespace Modules\Post\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Post\Entities\Managecategorys;
use Modules\Post\Http\Requests\CreateManagecategorysRequest;
use Modules\Post\Http\Requests\UpdateManagecategorysRequest;
use Modules\Post\Repositories\ManagecategorysRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

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
        //$managecategorys = $this->managecategorys->all();

        return view('post::admin.managecategorys.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('post::admin.managecategorys.create');
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
        return view('post::admin.managecategorys.edit', compact('managecategorys'));
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
}
