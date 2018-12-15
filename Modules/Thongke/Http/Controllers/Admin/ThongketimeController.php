<?php

namespace Modules\Thongke\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Thongke\Entities\Thongketime;
use Modules\Thongke\Http\Requests\CreateThongketimeRequest;
use Modules\Thongke\Http\Requests\UpdateThongketimeRequest;
use Modules\Thongke\Repositories\ThongketimeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ThongketimeController extends AdminBaseController
{
    /**
     * @var ThongketimeRepository
     */
    private $thongketime;

    public function __construct(ThongketimeRepository $thongketime)
    {
        parent::__construct();

        $this->thongketime = $thongketime;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$thongketimes = $this->thongketime->all();

        return view('thongke::admin.thongketimes.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('thongke::admin.thongketimes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateThongketimeRequest $request
     * @return Response
     */
    public function store(CreateThongketimeRequest $request)
    {
        $this->thongketime->create($request->all());

        return redirect()->route('admin.thongke.thongketime.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('thongke::thongketimes.title.thongketimes')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Thongketime $thongketime
     * @return Response
     */
    public function edit(Thongketime $thongketime)
    {
        return view('thongke::admin.thongketimes.edit', compact('thongketime'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Thongketime $thongketime
     * @param  UpdateThongketimeRequest $request
     * @return Response
     */
    public function update(Thongketime $thongketime, UpdateThongketimeRequest $request)
    {
        $this->thongketime->update($thongketime, $request->all());

        return redirect()->route('admin.thongke.thongketime.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('thongke::thongketimes.title.thongketimes')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Thongketime $thongketime
     * @return Response
     */
    public function destroy(Thongketime $thongketime)
    {
        $this->thongketime->destroy($thongketime);

        return redirect()->route('admin.thongke.thongketime.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('thongke::thongketimes.title.thongketimes')]));
    }
}
