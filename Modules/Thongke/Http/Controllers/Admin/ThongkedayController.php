<?php

namespace Modules\Thongke\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Thongke\Entities\Thongkeday;
use Modules\Thongke\Http\Requests\CreateThongkedayRequest;
use Modules\Thongke\Http\Requests\UpdateThongkedayRequest;
use Modules\Thongke\Repositories\ThongkedayRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Invoices\Entities\Invoice;
use Illuminate\Support\Facades\Input;
use DB;
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
        $thongkedays='';
        $inputs = Input::all();
        $day = date('Y-m-d', strtotime(str_replace('/', '-', Input::get('order_date', date('Y-m-d')))));
        if ($day != '') {
            $thongkedays = Invoice::select('invoices__invoices.*','customers__customers.firstname','customers__customers.lastname','hotel__hotels.name','tourguide__tourguides.firstname as Tfirstname','tourguide__tourguides.lastname as Tlastname')
            ->leftJoin('customers__customers', 'invoices__invoices.customer_id', '=', 'customers__customers.id')
            ->leftJoin('hotel__hotels', 'invoices__invoices.hotel_id', '=', 'hotel__hotels.id')
            ->leftJoin('tourguide__tourguides', 'invoices__invoices.tour_guide_id', '=', 'tourguide__tourguides.id')
            ->where(DB::raw("DATE_FORMAT(invoices__invoices.order_date,'%Y-%m-%d')"),'=',$day)->get();                
           
        }else { 
            $thongkedays = Invoice::select('invoices__invoices.*','customers__customers.firstname','customers__customers.lastname','hotel__hotels.name','tourguide__tourguides.firstname as Tfirstname','tourguide__tourguides.lastname as Tlastname')
            ->leftJoin('customers__customers', 'invoices__invoices.customer_id', '=', 'customers__customers.id')
            ->leftJoin('hotel__hotels', 'invoices__invoices.hotel_id', '=', 'hotel__hotels.id')
            ->leftJoin('tourguide__tourguides', 'invoices__invoices.tour_guide_id', '=', 'tourguide__tourguides.id')
            ->where(DB::raw("DATE_FORMAT(invoices__invoices.order_date,'%Y-%m-%d')"),'=',date('Y-m-d'))->get();
        }
     
        return view('thongke::admin.thongkedays.index', compact('thongkedays','day'));
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
