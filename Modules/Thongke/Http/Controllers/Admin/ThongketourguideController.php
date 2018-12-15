<?php

namespace Modules\Thongke\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Thongke\Entities\Thongketourguide;
use Modules\Thongke\Http\Requests\CreateThongketourguideRequest;
use Modules\Thongke\Http\Requests\UpdateThongketourguideRequest;
use Modules\Thongke\Repositories\ThongketourguideRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ThongketourguideController extends AdminBaseController
{
    /**
     * @var ThongketourguideRepository
     */
    private $thongketourguide;

    public function __construct(ThongketourguideRepository $thongketourguide)
    {
        parent::__construct();

        $this->thongketourguide = $thongketourguide;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$thongketourguides = $this->thongketourguide->all();

        return view('thongke::admin.thongketourguides.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('thongke::admin.thongketourguides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateThongketourguideRequest $request
     * @return Response
     */
    public function store(CreateThongketourguideRequest $request)
    {
        $this->thongketourguide->create($request->all());

        return redirect()->route('admin.thongke.thongketourguide.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('thongke::thongketourguides.title.thongketourguides')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Thongketourguide $thongketourguide
     * @return Response
     */
    public function edit(Thongketourguide $thongketourguide)
    {
        return view('thongke::admin.thongketourguides.edit', compact('thongketourguide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Thongketourguide $thongketourguide
     * @param  UpdateThongketourguideRequest $request
     * @return Response
     */
    public function update(Thongketourguide $thongketourguide, UpdateThongketourguideRequest $request)
    {
        $this->thongketourguide->update($thongketourguide, $request->all());

        return redirect()->route('admin.thongke.thongketourguide.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('thongke::thongketourguides.title.thongketourguides')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Thongketourguide $thongketourguide
     * @return Response
     */
    public function destroy(Thongketourguide $thongketourguide)
    {
        $this->thongketourguide->destroy($thongketourguide);

        return redirect()->route('admin.thongke.thongketourguide.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('thongke::thongketourguides.title.thongketourguides')]));
    }
}
