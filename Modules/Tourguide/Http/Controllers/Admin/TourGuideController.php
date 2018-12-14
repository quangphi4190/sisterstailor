<?php

namespace Modules\Tourguide\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Tourguide\Entities\TourGuide;
use Modules\Tourguide\Http\Requests\CreateTourGuideRequest;
use Modules\Tourguide\Http\Requests\UpdateTourGuideRequest;
use Modules\Tourguide\Repositories\TourGuideRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use DB;
use Illuminate\Support\Facades\Input;

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
        $tourguides = $this->tourguide->all();
        $countries = DB::table('countries')->get();
        return view('tourguide::admin.tourguides.index', compact('tourguides','countries'));
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
        return view('tourguide::admin.tourguides.create',compact('countries','cities','states'));
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
        $countries = DB::table('countries')->get();
        $states = DB::table('states')->get();
        $cities = DB::table('cities')->get();
        $status = $tourguide->status ? $tourguide->status: '';
        $gender_id = $tourguide->gender ? $tourguide->gender : '' ;
        $country_id = $tourguide->country_id ? $tourguide->country_id : '' ;
        $state_id = $tourguide->state_id ? $tourguide->state_id : '';
        $citi_id = $tourguide->city_id ? $tourguide->city_id :'';
        $starteofContry = DB::table('states')->where('states.country_id', '=' ,$country_id)->get();
        $cityOfState = DB::table('cities')->where('cities.state_id', '=' ,$state_id)->get();
        return view('tourguide::admin.tourguides.edit', compact('tourguide','status','countries','starteofContry','cityOfState','country_id','state_id','citi_id','gender_id'));
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
