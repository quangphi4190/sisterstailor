<?php

namespace Modules\Thongke\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Invoices\Repositories\InvoiceRepository;
use Modules\Thongke\Entities\Thongketime;
use Modules\Thongke\Http\Requests\CreateThongketimeRequest;
use Modules\Thongke\Http\Requests\UpdateThongketimeRequest;
use Modules\Thongke\Repositories\ThongketimeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Invoices\Entities\Invoice;
use Illuminate\Support\Facades\Input;
use DB;
use Modules\Tourguide\Repositories\TourGuideRepository;

class ThongketimeController extends AdminBaseController
{
    /**
     * @var ThongketimeRepository
     */
    private $thongketime;
    private $invoice;
    private $tour_guide;

    public function __construct(ThongketimeRepository $thongketime, InvoiceRepository $invoiceRepository, TourGuideRepository $tourGuideRepository)
    {
        parent::__construct();

        $this->thongketime = $thongketime;
        $this->invoice = $invoiceRepository;
        $this->tour_guide = $tourGuideRepository;
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
        $tourguideId = Input::get('tour_guide_id', '');
        $hotelId = Input::get('hotel_id', '');
        $tourguides = DB::table('tourguide__tourguides')->get();
        $hotels = DB::table('hotel__hotels')->get();

        $inputs = Input::all();

        $thongkes = Invoice::select('invoices__invoices.id', 'invoices__invoices.tour_guide_id', 'invoices__invoices.hotel_id', 'invoices__invoices.group_code', 'invoices__invoices.amount', 'invoices__invoices.note', 'invoices__invoices.order_date',
            'invoices__invoices.delivery_date', 'customers__customers.firstname', 'customers__customers.lastname',
            'tourguide__tourguides.firstname as Tfirstname', 'tourguide__tourguides.lastname as Tlastname', 'hotel__hotels.name', 'invoices__invoices.seller')
            ->leftjoin('customers__customers', 'customers__customers.id', '=', 'invoices__invoices.customer_id')
            ->leftjoin('hotel__hotels', 'hotel__hotels.id', '=', 'invoices__invoices.hotel_id')
            ->leftjoin('tourguide__tourguides', 'tourguide__tourguides.id', '=', 'invoices__invoices.tour_guide_id');

        if ($fromDate && $toDate) {
            $thongkes = $thongkes->whereBetween(DB::raw("DATE_FORMAT(invoices__invoices.order_date,'%Y-%m-%d')"), array($fromDate, $toDate));
        }
        if ($tourguideId) {
            $thongkes = $thongkes->where('invoices__invoices.tour_guide_id', $tourguideId);
        }
        if ($hotelId) {
            $thongkes = $thongkes->where('invoices__invoices.hotel_id', $hotelId);
        }
        $thongkes = $thongkes->get();
        return view('thongke::admin.thongketimes.index', compact('thongkes', 'fromDate', 'toDate', 'hotelId', 'tourguideId', 'hotels', 'tourguides'));
    }

    public function khachdoan()
    {
        $fromDate = date('Y-m-d', strtotime(str_replace('/', '-', Input::get('fromDate', date('Y-m-01', time())))));
        $toDate = date('Y-m-d', strtotime(str_replace('/', '-', Input::get('toDate', date('Y-m-d')))));
        $tourguideId = Input::get('tour_guide_id', '');
        $hotelId = Input::get('hotel_id', '');
        $tourguides = DB::table('tourguide__tourguides')->get();
        $hotels = DB::table('hotel__hotels')->get();

        $firstQuery = 'SELECT customer_id, tour_guide_id, hotel_id, SUM(amount) as amount, order_date, group_code, seller, delivery_date, 
customers__customers.firstname, customers__customers.lastname, 
tourguide__tourguides.firstname as Tfirstname, tourguide__tourguides.lastname as Tlastname, 
hotel__hotels.`name` 
FROM invoices__invoices  
LEFT JOIN customers__customers ON customer_id = customers__customers.id 
LEFT JOIN tourguide__tourguides ON tour_guide_id = tourguide__tourguides.id 
LEFT JOIN hotel__hotels ON hotel_id = hotel__hotels.id 
WHERE group_code!=\'\'';

        $lastQuery = ' GROUP BY customer_id 
ORDER BY order_date ASC;';


        $where = '';
        if ($fromDate && $toDate) {
            $where = " AND (DATE_FORMAT(invoices__invoices.order_date,'%Y-%m-%d') BETWEEN '" . $fromDate . "' AND '" . $toDate . "') ";
        }


        if ($tourguideId) {
            $where = $where . ' AND tour_guide_id=' . $tourguideId;
        }
        if ($hotelId) {
            $where = $where . ' AND hotel_id=' . $hotelId;
        }

        $thongkes = DB::select($firstQuery . $where . $lastQuery);
        return view('thongke::admin.thongketimes.khachdoan', compact('thongkes', 'fromDate', 'toDate', 'hotelId', 'tourguideId', 'hotels', 'tourguides'));
    }

    function thong_ke_doanh_thu()
    {

        $fromDate = date('Y-m-d', strtotime(str_replace('/', '-', Input::get('fromDate', date('Y-m-01', time())))));
        $toDate = date('Y-m-d', strtotime(str_replace('/', '-', Input::get('toDate', date('Y-m-d')))));
        $tourguideId = Input::get('tour_guide_id', '');
        $tourguides = DB::table('tourguide__tourguides')->get();


        $inputs = Input::all();

        $thongkes = Invoice::select('invoices__invoices.id', 'invoices__invoices.tour_guide_id', 'invoices__invoices.hotel_id', 'invoices__invoices.amount', 'invoices__invoices.price', 'invoices__invoices.discount', 'invoices__invoices.order_date',
            'invoices__invoices.delivery_date', 'customers__customers.firstname', 'customers__customers.lastname',
            'tourguide__tourguides.firstname as Tfirstname', 'tourguide__tourguides.lastname as Tlastname', 'invoices__invoices.seller')
            ->leftjoin('customers__customers', 'customers__customers.id', '=', 'invoices__invoices.customer_id')
            ->leftjoin('tourguide__tourguides', 'tourguide__tourguides.id', '=', 'invoices__invoices.tour_guide_id');
        if ($fromDate && $toDate) {
            $thongkes = $thongkes->whereBetween(DB::raw("DATE_FORMAT(invoices__invoices.order_date,'%Y-%m-%d')"), array($fromDate, $toDate));
        }
        if ($tourguideId) {
            $thongkes = $thongkes->where('invoices__invoices.tour_guide_id', $tourguideId);
        }
        $thongkes = $thongkes->get();
        return view('thongke::admin.thongketimes.doanhthu', compact('thongkes', 'fromDate', 'toDate', 'hotelId', 'tourguideId', 'hotels', 'tourguides'));
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

    function get_tour_guide($group_code)
    {
        $invoice = $this->invoice->findByAttributes([
            'group_code' => $group_code
        ]);
        if ($invoice == null) {
            echo json_encode([
                'successful' => 0,
                'mes' => ''
            ]);
            die();
        }

        $guide = $this->tour_guide->find($invoice->tour_guide_id);
        if ($guide == null) {
            echo json_encode([
                'successful' => 0,
                'mes' => ''
            ]);
            die();
        }

        echo json_encode([
            'successful' => 1,
            'name' => $guide->firstname . ' ' . $guide->lastname,
            'phone' => $guide->phone
        ]);
        die();
    }

}
