<?php

namespace Modules\Thongke\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Thongke\Entities\Thongkeday;
use Modules\Thongke\Http\Requests\CreateThongkedayRequest;
use Modules\Thongke\Http\Requests\UpdateThongkedayRequest;
use Modules\Thongke\Repositories\ThongkedayRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ThongkedayController extends AdminBaseController
{
    /**
     * @var ThongkedayRepository
     */
    private $thongkeday;

    public function __construct(ThongkedayRepository $thongkeday)
    {
        parent::__construct();

        $this->thongkeday = $thongkeday;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$thongkedays = $this->thongkeday->all();

        return view('thongke::admin.thongkedays.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('thongke::admin.thongkedays.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateThongkedayRequest $request
     * @return Response
     */
    public function store(CreateThongkedayRequest $request)
    {
        $this->thongkeday->create($request->all());

        return redirect()->route('admin.thongke.thongkeday.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('thongke::thongkedays.title.thongkedays')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Thongkeday $thongkeday
     * @return Response
     */
    public function edit(Thongkeday $thongkeday)
    {
        return view('thongke::admin.thongkedays.edit', compact('thongkeday'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Thongkeday $thongkeday
     * @param  UpdateThongkedayRequest $request
     * @return Response
     */
    public function update(Thongkeday $thongkeday, UpdateThongkedayRequest $request)
    {
        $this->thongkeday->update($thongkeday, $request->all());

        return redirect()->route('admin.thongke.thongkeday.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('thongke::thongkedays.title.thongkedays')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Thongkeday $thongkeday
     * @return Response
     */
    public function destroy(Thongkeday $thongkeday)
    {
        $this->thongkeday->destroy($thongkeday);

        return redirect()->route('admin.thongke.thongkeday.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('thongke::thongkedays.title.thongkedays')]));
    }
}
