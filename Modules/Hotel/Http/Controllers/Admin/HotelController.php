<?php

namespace Modules\Hotel\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Hotel\Entities\Hotel;
use Modules\Hotel\Http\Requests\CreateHotelRequest;
use Modules\Hotel\Http\Requests\UpdateHotelRequest;
use Modules\Hotel\Repositories\HotelRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use DB;

class HotelController extends AdminBaseController
{
    /**
     * @var HotelRepository
     */
    private $hotel;

    public function __construct(HotelRepository $hotel)
    {
        parent::__construct();

        $this->hotel = $hotel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$hotels = $this->hotel->all();

        return view('hotel::admin.hotels.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $country = DB::table('countries')->get();
        $city = DB::table('cities')->get();
        $states = DB::table('states')->get();
        return view('hotel::admin.hotels.create',compact('country','city','states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateHotelRequest $request
     * @return Response
     */
    public function store(CreateHotelRequest $request)
    {
        $this->hotel->create($request->all());

        return redirect()->route('admin.hotel.hotel.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('hotel::hotels.title.hotels')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Hotel $hotel
     * @return Response
     */
    public function edit(Hotel $hotel)
    {
        return view('hotel::admin.hotels.edit', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Hotel $hotel
     * @param  UpdateHotelRequest $request
     * @return Response
     */
    public function update(Hotel $hotel, UpdateHotelRequest $request)
    {
        $this->hotel->update($hotel, $request->all());

        return redirect()->route('admin.hotel.hotel.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('hotel::hotels.title.hotels')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Hotel $hotel
     * @return Response
     */
    public function destroy(Hotel $hotel)
    {
        $this->hotel->destroy($hotel);

        return redirect()->route('admin.hotel.hotel.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('hotel::hotels.title.hotels')]));
    }
}
