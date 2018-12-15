<?php

namespace Modules\Thongke\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Thongke\Entities\Thongketime;
use Modules\Thongke\Http\Requests\CreateThongketimeRequest;
use Modules\Thongke\Http\Requests\UpdateThongketimeRequest;
use Modules\Thongke\Repositories\ThongketimeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Invoices\Entities\Invoice;
use Illuminate\Support\Facades\Input;
use DB;
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
        $fromDate = date('Y-m-d', strtotime(str_replace('/', '-', Input::get('fromDate', date('Y-m-01', time())))));
        $toDate = date('Y-m-d', strtotime(str_replace('/', '-', Input::get('toDate', date('Y-m-d')))));
        $thongketimes='';
        $inputs = Input::all();
        if ($fromDate && $toDate) {
            $thongketimes = Invoice::select('invoices__invoices.*','customers__customers.firstname','customers__customers.lastname','hotel__hotels.name','tourguide__tourguides.firstname as Tfirstname','tourguide__tourguides.lastname as Tlastname')
            ->leftJoin('customers__customers', 'invoices__invoices.customer_id', '=', 'customers__customers.id')
            ->leftJoin('hotel__hotels', 'invoices__invoices.hotel_id', '=', 'hotel__hotels.id')
            ->leftJoin('tourguide__tourguides', 'invoices__invoices.tour_guide_id', '=', 'tourguide__tourguides.id')
            ->whereBetween(DB::raw("DATE_FORMAT(invoices__invoices.order_date,'%Y-%m-%d')"), array($fromDate, $toDate))->orderBy('invoices__invoices.id', 'DESC')->get();           
           
        }

        return view('thongke::admin.thongketimes.index', compact('thongketimes','fromDate','toDate'));
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
