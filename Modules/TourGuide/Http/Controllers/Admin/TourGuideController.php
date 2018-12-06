<?php

namespace Modules\TourGuide\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\TourGuide\Entities\TourGuide;
use Modules\TourGuide\Http\Requests\CreateTourGuideRequest;
use Modules\TourGuide\Http\Requests\UpdateTourGuideRequest;
use Modules\TourGuide\Repositories\TourGuideRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class TourGuideController extends AdminBaseController
{
    /**
     * @var TourGuideRepository
     */
    private $tourguide;

    public function __construct(TourGuideRepository $tourguide)
    {
        parent::__construct();

        $this->tourguide = $tourguide;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$tourguides = $this->tourguide->all();

        return view('tourguide::admin.tourguides.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tourguide::admin.tourguides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTourGuideRequest $request
     * @return Response
     */
    public function store(CreateTourGuideRequest $request)
    {
        $this->tourguide->create($request->all());

        return redirect()->route('admin.tourguide.tourguide.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('tourguide::tourguides.title.tourguides')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  TourGuide $tourguide
     * @return Response
     */
    public function edit(TourGuide $tourguide)
    {
        return view('tourguide::admin.tourguides.edit', compact('tourguide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TourGuide $tourguide
     * @param  UpdateTourGuideRequest $request
     * @return Response
     */
    public function update(TourGuide $tourguide, UpdateTourGuideRequest $request)
    {
        $this->tourguide->update($tourguide, $request->all());

        return redirect()->route('admin.tourguide.tourguide.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('tourguide::tourguides.title.tourguides')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  TourGuide $tourguide
     * @return Response
     */
    public function destroy(TourGuide $tourguide)
    {
        $this->tourguide->destroy($tourguide);

        return redirect()->route('admin.tourguide.tourguide.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('tourguide::tourguides.title.tourguides')]));
    }
}
