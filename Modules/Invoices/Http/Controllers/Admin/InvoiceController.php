<?php

namespace Modules\Invoices\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Invoices\Entities\Invoice;
use Modules\Invoices\Http\Requests\CreateInvoiceRequest;
use Modules\Invoices\Http\Requests\UpdateInvoiceRequest;
use Modules\Invoices\Repositories\InvoiceRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use DB;
use Modules\Customers\Entities\Customer;
use Illuminate\Support\Facades\Input;

class InvoiceController extends AdminBaseController
{
    /**
     * @var InvoiceRepository
     */
    private $invoice;

    public function __construct(InvoiceRepository $invoice)
    {
        parent::__construct();

        $this->invoice = $invoice;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $invoices = $this->invoice->all();

        return view('invoices::admin.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $invoices_auto = Invoice::groupBy('customer_id')->pluck('customer_id')->toArray();
        $customers = Customer::select('customers__customers.phone','customers__customers.lastname','customers__customers.address')->whereIn('customers__customers.id',$invoices_auto)->get()->toArray();
        $customers_select = Customer::select('customers__customers.id','customers__customers.lastname','customers__customers.address','customers__customers.phone','customers__customers.firstname')->get();

        $arrInvoi =$customers;
        $invoices = $this->invoice->all();
        $countries = DB::table('countries')->get();
        $countries = DB::table('countries')->get();
        $tourguides = DB::table('tourguide__tourguides')->get();
        $hotels = DB::table('hotel__hotels')->get();
        return view('invoices::admin.invoices.create',compact('countries','invoices','arrInvoi','customers_select','tourguides','hotels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateInvoiceRequest $request
     * @return Response
     */
    public function store(CreateInvoiceRequest $request)
    {
        $this->invoice->create($request->all());

        return redirect()->route('admin.invoices.invoice.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('invoices::invoices.title.invoices')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Invoice $invoice
     * @return Response
     */
    public function edit(Invoice $invoice)
    {
        return view('invoices::admin.invoices.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Invoice $invoice
     * @param  UpdateInvoiceRequest $request
     * @return Response
     */
    public function update(Invoice $invoice, UpdateInvoiceRequest $request)
    {die('sdasdads');
        $this->invoice->update($invoice, $request->all());

        return redirect()->route('admin.invoices.invoice.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('invoices::invoices.title.invoices')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Invoice $invoice
     * @return Response
     */
    public function destroy(Invoice $invoice)
    {
        $this->invoice->destroy($invoice);

        return redirect()->route('admin.invoices.invoice.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('invoices::invoices.title.invoices')]));
    }

    public function get_id_customer () {
        $customerId = Input::get('customer_id', ''); 
        $strlable = '';
        
        // get customer id
        if (!$customerId) {
           return $strlable;
        }
        $customer = Customer::where('customers__customers.id', '=' ,$customerId)->first();  
        $strlable .= '<div class="col-sm-6 p-t10">';
        $strlable .= '<div class="p-2 m-b10"><span>Họ và tên: </span>' .$customer->firstname. ' '.$customer->lastname.'</div>';
        $strlable .= '<div class="p-2 m-b10"><span>Số điện thoại: </span>' .$customer->phone.'</div>';        
        $strlable .= '</div>';
        $strlable .= '<div class="col-sm-6 p-t10">';
        $strlable .= '<div class="p-2 m-b10"><span>Email: </span>' .$customer->mail.'</div>';
        $strlable .= '<div class="p-2 m-b10"><span>Địa chỉ: </span>' .$customer->address.'</div>';        
        $strlable .= '</div>';

        return $strlable;
    }

    public function get_info (){ 
        $input = Input::all();
        $customerId= Input::get('id','');  
        $customer = Customer::where('customers__customers.id', '=' ,$customerId)->first();
        //dd($customer);
        $name_country ='';
        $name_state ='';
        $name_city ='';
     
        if($customer->country_id){
            $name_country = DB::table('countries')->where('countries.id', '=' ,$customer->country_id)->first();
        }
        if($customer->state_id){
            $name_state =  DB::table('states')->where('states.id', '=' ,$customer->state_id)->first();
        }
        if($customer->city_id){
            $name_city =  DB::table('cities')->where('cities.id', '=' ,$customer->city_id)->first();
        }
        
        
        return view('invoices::admin.invoices.modal-info-customer', compact('customer','name_country','name_city','name_state','gender_id'));
    }

    public function edit_info (){ 
        $input = Input::all();
        $customerId= Input::get('id','');  
        $customer = Customer::where('customers__customers.id', '=' ,$customerId)->first();
        $countries = DB::table('countries')->get();
        $states = DB::table('states')->get();//dd($states->toArray());
        $cities = DB::table('cities')->get();
        $status = $customer->status ? $customer->status : '' ;
        $gender_id = $customer->gender ? $customer->gender : '' ;
        $country_id = $customer->country_id ? $customer->country_id : '' ;
        $state_id = $customer->state_id ? $customer->state_id : '';
        $citi_id = $customer->city_id ? $customer->city_id :'';
        $starteofContry = DB::table('states')->where('states.country_id', '=' ,$country_id)->get();
        $cityOfState = DB::table('cities')->where('cities.state_id', '=' ,$state_id)->get(); 

        return view('invoices::admin.invoices.modal-edit-customer', compact('customer','countries','status','states','cities','country_id','gender_id','state_id','cityOfState','starteofContry','citi_id'));
    }
    
    public function inser_form () {
        die('áddddddddddd');
    }
}
