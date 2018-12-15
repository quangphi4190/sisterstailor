<?php

namespace Modules\Thongke\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Thongke\Entities\Thongkehotel;
use Modules\Thongke\Http\Requests\CreateThongkehotelRequest;
use Modules\Thongke\Http\Requests\UpdateThongkehotelRequest;
use Modules\Thongke\Repositories\ThongkehotelRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Invoices\Entities\Invoice;
use Illuminate\Support\Facades\Input;
use DB;
class ThongkehotelController extends AdminBaseController
{
    /**
     * @var ThongkehotelRepository
     */
    private $thongkehotel;

    public function __construct(ThongkehotelRepository $thongkehotel)
    {
        parent::__construct();

        $this->thongkehotel = $thongkehotel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $inputs = Input::all();
        
        $hotelId =Input::get('hotel_id','');
        $hotels = DB::table('hotel__hotels')->get();
        $thongkehotels = Invoice::select('invoices__invoices.*','customers__customers.firstname','customers__customers.lastname','hotel__hotels.name as nameHotel','tourguide__tourguides.firstname as Tfirstname','tourguide__tourguides.lastname as Tlastname')
        ->leftJoin('customers__customers', 'invoices__invoices.customer_id', '=', 'customers__customers.id')
        ->leftJoin('hotel__hotels', 'invoices__invoices.hotel_id', '=', 'hotel__hotels.id')
        ->leftJoin('tourguide__tourguides', 'invoices__invoices.tour_guide_id', '=', 'tourguide__tourguides.id');
                        
        
        if($hotelId) {
            $thongkehotels = $thongkehotels->where('invoices__invoices.hotel_id',$hotelId);
        }
        $thongkehotels = $thongkehotels->orderBy('hotel__hotels.name', 'ASC')->get();
        $hotel_id = $hotelId ? $hotelId : '' ;
        return view('thongke::admin.thongkehotels.index', compact('thongkehotels','hotels','hotel_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('thongke::admin.thongkehotels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateThongkehotelRequest $request
     * @return Response
     */
    public function store(CreateThongkehotelRequest $request)
    {
        $this->thongkehotel->create($request->all());

        return redirect()->route('admin.thongke.thongkehotel.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('thongke::thongkehotels.title.thongkehotels')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Thongkehotel $thongkehotel
     * @return Response
     */
    public function edit(Thongkehotel $thongkehotel)
    {
        return view('thongke::admin.thongkehotels.edit', compact('thongkehotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Thongkehotel $thongkehotel
     * @param  UpdateThongkehotelRequest $request
     * @return Response
     */
    public function update(Thongkehotel $thongkehotel, UpdateThongkehotelRequest $request)
    {
        $this->thongkehotel->update($thongkehotel, $request->all());

        return redirect()->route('admin.thongke.thongkehotel.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('thongke::thongkehotels.title.thongkehotels')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Thongkehotel $thongkehotel
     * @return Response
     */
    public function destroy(Thongkehotel $thongkehotel)
    {
        $this->thongkehotel->destroy($thongkehotel);

        return redirect()->route('admin.thongke.thongkehotel.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('thongke::thongkehotels.title.thongkehotels')]));
    }
}
