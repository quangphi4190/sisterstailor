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
use Illuminate\Support\Facades\Input;

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
        $hotels = $this->hotel->all();
        $countries = DB::table('countries')->get();
        return view('hotel::admin.hotels.index', compact('hotels','countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $countries = DB::table('countries')->get();
        $cities = DB::table('cities')->get();
        $states = DB::table('states')->get();
        return view('hotel::admin.hotels.create',compact('countries','cities','states'));
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
        $countries = DB::table('countries')->get();
        $states = DB::table('states')->get();
        $cities = DB::table('cities')->get();
        $status = $hotel->status ? $hotel->status : '' ;
        $country_id = $hotel->country_id ? $hotel->country_id : '' ;
        $state_id = $hotel->state_id ? $hotel->state_id : '';
        $citi_id = $hotel->city_id ? $hotel->city_id :'';
        $starteofContry = DB::table('states')->where('states.country_id', '=' ,$country_id)->get();
        $cityOfState = DB::table('cities')->where('cities.state_id', '=' ,$state_id)->get();
        return view('hotel::admin.hotels.edit', compact('hotel','status','countries','starteofContry','cityOfState','country_id','state_id','citi_id'));
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
    public function get_id()
    { 
        $countryId = Input::get('country_id', ''); 
        $strSelectorOption = '<option value="">'.trans('Select State').'</option>';
        
        // get state id
        if (!$countryId) {
           return $strSelectorOption;
        }
        
        $starteofContry = DB::table('states')->where('states.country_id', '=' ,$countryId)->get();        
        foreach($starteofContry as $state) {
           $strSelectorOption .= '<option value="'.$state->id.'">'.$state->name.'</option>';
        }
        
        return $strSelectorOption;
        

    }
    public function get_id_state()
    { 
        $state_id = Input::get('state_id', ''); 
        $strSelectorOption = '<option value="">'.trans('Select city').'</option>';
        
        // get city id
        if (!$state_id) {
           return $strSelectorOption;
        }
        
        $cityOfState = DB::table('cities')->where('cities.state_id', '=' ,$state_id)->get();      
        foreach($cityOfState as $city) {
           $strSelectorOption .= '<option value="'.$city->id.'">'.$city->name.'</option>';
        }
        
       return $strSelectorOption;

    }
}
