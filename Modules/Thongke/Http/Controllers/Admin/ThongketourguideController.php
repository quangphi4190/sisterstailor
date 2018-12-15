<?php

namespace Modules\Thongke\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Thongke\Entities\Thongketourguide;
use Modules\Thongke\Http\Requests\CreateThongketourguideRequest;
use Modules\Thongke\Http\Requests\UpdateThongketourguideRequest;
use Modules\Thongke\Repositories\ThongketourguideRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Invoices\Entities\Invoice;
use Illuminate\Support\Facades\Input;
use DB;
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
        $tourguides = DB::table('tourguide__tourguides')->get();
       
        $tourguideId =Input::get('tour_guide_id', '');
        $thongketourguides = Invoice::select('invoices__invoices.*','customers__customers.firstname','customers__customers.lastname','hotel__hotels.name as nameHotel','tourguide__tourguides.firstname as Tfirstname','tourguide__tourguides.lastname as Tlastname')
        ->leftJoin('customers__customers', 'invoices__invoices.customer_id', '=', 'customers__customers.id')
        ->leftJoin('hotel__hotels', 'invoices__invoices.hotel_id', '=', 'hotel__hotels.id')
        ->leftJoin('tourguide__tourguides', 'invoices__invoices.tour_guide_id', '=', 'tourguide__tourguides.id');
                        
        
        if($tourguideId) {
            $thongketourguides = $thongketourguides->where('invoices__invoices.tour_guide_id', $tourguideId );
        }
        $tour_guide_id = $tourguideId ? $tourguideId : '' ;
        $thongketourguides = $thongketourguides->get();
        return view('thongke::admin.thongketourguides.index', compact('thongketourguides','tourguides','tour_guide_id'));
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
