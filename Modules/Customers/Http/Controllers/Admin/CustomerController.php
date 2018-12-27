<?php

namespace Modules\Customers\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Customers\Entities\Customer;
use Modules\Customers\Http\Requests\CreateCustomerRequest;
use Modules\Customers\Http\Requests\UpdateCustomerRequest;
use Modules\Customers\Repositories\CustomerRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use DB;
use Illuminate\Support\Facades\Input;
use Modules\Invoices\Entities\Invoice;

class CustomerController extends AdminBaseController
{
    /**
     * @var CustomerRepository
     */
    private $customer;

    public function __construct(CustomerRepository $customer)
    {
        parent::__construct();

        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // $customers = $this->customer->all();
        $customers = Customer::select('customers__customers.id','customers__customers.firstname','customers__customers.lastname','customers__customers.gender','customers__customers.mail','customers__customers.phone','countries.name' )
        ->leftjoin('countries', 'countries.id', '=', 'customers__customers.country_id')->get();
        return view('customers::admin.customers.index', compact('customers','countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $countries = DB::table('countries')->get();
        return view('customers::admin.customers.create', compact('countries','states','cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCustomerRequest $request
     * @return Response
     */
    public function store(CreateCustomerRequest $request)
    {
        
        // $this->customer->create($request->all());
        $custumer = new Customer();
        $name = explode(' ', $request['fullname']);
        $custumer->lastname = $name[count($name) - 1];;
        $custumer->firstname = str_replace($name[count($name) - 1],'',$request['fullname']);
        $custumer->mail = $request['mail'] ? $request['mail'] :'';
        $custumer->phone = $request['phone'] ? $request['phone'] :'';
        $custumer->gender = $request['gender']? $request['gender'] :'';
        $custumer->status = 1;
        $custumer->country_id = $request['country_id'] ? $request['country_id']:'';
        $custumer->save();
        return redirect()->route('admin.customers.customer.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('customers::customers.title.customers')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Customer $customer
     * @return Response
     */
    public function edit(Customer $customer)
    {
     
        $countries = DB::table('countries')->get();
        $states = DB::table('states')->get();
        $cities = DB::table('cities')->get();
        $status = $customer->status ? $customer->status : '' ;
        $gender_id = $customer->gender ? $customer->gender : '' ;
        $customer_type = $customer->customer_type ? $customer->customer_type : '' ;
        $country_id = $customer->country_id ? $customer->country_id : '' ;
        $state_id = $customer->state_id ? $customer->state_id : '';
        $citi_id = $customer->city_id ? $customer->city_id :'';
        $starteofContry = DB::table('states')->where('states.country_id', '=' ,$country_id)->get();
        $cityOfState = DB::table('cities')->where('cities.state_id', '=' ,$state_id)->get(); 
        return view('customers::admin.customers.edit', compact('customer','countries','customer_type','starteofContry','cityOfState','country_id','state_id','citi_id','gender_id','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Customer $customer
     * @param  UpdateCustomerRequest $request
     * @return Response
     */
    public function update(Customer $customer, UpdateCustomerRequest $request)
    {
        $name = explode(' ', $request['fullname']);
        $lastname = $name[count($name) - 1];;
        $firstname = str_replace($name[count($name) - 1],'',$request['fullname']);
        $mail = $request['mail'] ? $request['mail'] :'';
        $phone = $request['phone'] ? $request['phone'] :'';
        $gender = $request['gender']? $request['gender'] :'';
        $status = 1;
        $country_id = $request['country_id'] ? $request['country_id']:'';
        Customer::where('id', $request['id'])->update(array('lastname'=>$lastname,'firstname'=>$firstname,'mail'=>$mail,'phone'=>$phone,'gender'=>$gender,'country_id'=>$country_id,'status'=>$status));

        // $this->customer->update($customer, $request->all());

        return redirect()->route('admin.customers.customer.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('customers::customers.title.customers')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Customer $customer
     * @return Response
     */
    public function destroy(Customer $customer)
    {
        $this->customer->destroy($customer);

        return redirect()->route('admin.customers.customer.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('customers::customers.title.customers')]));
    }

    public function get_id()
    { 
        $countryId = Input::get('country_id', ''); 
        $strSelectorOption = '<option value="">'.trans('Chọn tỉnh thành').'</option>';
        
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
        $strSelectorOption = '<option value="">'.trans('Chọn thành phố').'</option>';
        
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
    public function view(Customer $customer)
    {
        
      $list_invoice = Invoice::where('invoices__invoices.customer_id',$customer->id)->get();    
        return view('customers::admin.customers.view', compact('list_invoice'));
    }
}
