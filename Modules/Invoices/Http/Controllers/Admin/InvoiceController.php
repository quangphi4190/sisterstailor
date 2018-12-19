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
use Modules\Customers\Http\Requests\CreateCustomerRequest;
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
        // $invoices = $this->invoice->all();
        $fromDate = date('Y-m-d', strtotime(str_replace('/', '-', Input::get('fromDate', date('Y-m-01', time())))));
        $toDate = date('Y-m-d', strtotime(str_replace('/', '-', Input::get('toDate', date('Y-m-d')))));
        $tourguideId =Input::get('tour_guide_id', '');
        $hotelId =Input::get('hotel_id','');
        $tourguides = DB::table('tourguide__tourguides')->get();
        $hotels = DB::table('hotel__hotels')->get();
        $invoices = Invoice::select('invoices__invoices.id','invoices__invoices.tour_guide_id','invoices__invoices.hotel_id','invoices__invoices.group_code','invoices__invoices.amount','invoices__invoices.order_date',
        'invoices__invoices.delivery_date','customers__customers.firstname','customers__customers.lastname',
        'tourguide__tourguides.firstname as Tfirstname','tourguide__tourguides.lastname as Tlastname','hotel__hotels.name' )
        ->leftjoin('customers__customers', 'customers__customers.id', '=', 'invoices__invoices.customer_id')
        ->leftjoin('hotel__hotels', 'hotel__hotels.id', '=', 'invoices__invoices.hotel_id')
        ->leftjoin('tourguide__tourguides', 'tourguide__tourguides.id', '=', 'invoices__invoices.tour_guide_id')
        ;
       
        if ($fromDate && $toDate) {
            $invoices = $invoices->whereBetween(DB::raw("DATE_FORMAT(invoices__invoices.order_date,'%Y-%m-%d')"), array($fromDate, $toDate));  
        }
        if ($tourguideId) {
            $invoices = $invoices->where('invoices__invoices.tour_guide_id', $tourguideId );
        }
        if($hotelId) {
            $invoices = $invoices->where('invoices__invoices.hotel_id',$hotelId);
        }
        $invoices =$invoices->get();
        return view('invoices::admin.invoices.index', compact('invoices','fromDate','toDate','tourguides','tourguideId','hotels','hotelId'));
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
       
        // $this->invoice->create($request->all());
        $is_group = Input::get('is_group',null);

        $is_group = ($is_group) ? 1 : 0;
        $invoice = new Invoice();
        $invoice->customer_id = $request['customer_id'];
        $invoice->tour_guide_id = $request['tour_guide_id'];
        $invoice->hotel_id = $request['hotel_id'];
        $invoice->order_date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $request['order_date'])));
        $invoice->product = $request['product'];
        $invoice->price = $request['price'];
        $invoice->discount = $request['discount'];
        $invoice->payment_type = $request['payment_type'];
        $invoice->delivery_date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $request['delivery_date'])));
        $invoice->status = 1;
        $invoice->is_group = $is_group;
        $invoice->group_code = $request['group_code'];
        $invoice->seller = $request['seller'];
        $invoice->amount = $request['amount'];
        $invoice->note = $request['note'];
        $invoice->save();

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
        $customers_select = Customer::select('customers__customers.id','customers__customers.lastname','customers__customers.address','customers__customers.phone','customers__customers.firstname')->get();
        $tourguides = DB::table('tourguide__tourguides')->get();
        $hotels = DB::table('hotel__hotels')->get();
        $status = $invoice->status ? $invoice->status : '' ;
        $customer_id = $invoice->customer_id ? $invoice->customer_id : '' ;
        $tour_guide_id = $invoice->tour_guide_id ? $invoice->tour_guide_id : '' ;
        $hotel_id = $invoice->hotel_id ? $invoice->hotel_id : '' ;
        
        return view('invoices::admin.invoices.edit', compact('invoice','customers_select','tourguides','hotels','status','tour_guide_id','hotel_id','customer_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Invoice $invoice
     * @param  UpdateInvoiceRequest $request
     * @return Response
     */
    public function update(Invoice $invoice, UpdateInvoiceRequest $request)
    {
        
        $invoice = Invoice::find($request['id']);
        $is_group = isset($request['is_group'])? 1 : 0;  
        $customer_id = $request['customer_id'] ? $request['customer_id']:'';
        $group_code = $request['group_code'] ? $request['group_code'] :'';
        $tour_guide_id = $request['tour_guide_id'] ? $request['tour_guide_id'] :'';
        $hotel_id = $request['hotel_id'] ? $request['hotel_id'] :'';
        $order_date = $request['order_date'] ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $request['order_date']))) :'';
        $delivery_date = $request['delivery_date'] ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $request['delivery_date']))) :'';
        $payment_type = $request['payment_type'] ? $request['payment_type'] :'';
        $seller = $request['seller'] ? $request['seller']: '';    
        $product = $request['product'] ? $request['product'] :'';    
        $price = $request['price'] ? $request['price'] : '';    
        $discount = $request['discount'] ? $request['discount']:'';
        $amount = $request['amount'] ?$request['amount']:'';     
        $note = $request['note'] ?$request['note'] :'';     
        // $this->invoice->update($invoice, $request->all());
        Invoice::where('id', $request['id'])->update(array('is_group'=>$is_group,'customer_id'=>$customer_id,'group_code'=>$group_code,'tour_guide_id'=>$tour_guide_id,'hotel_id'=>$hotel_id,'order_date'=>$order_date,'delivery_date'=>$delivery_date,'payment_type'=>$payment_type,'status' => 1,'note'=> $note,'amount'=> $amount,'discount'=>$discount,'price'=>$price,'product'=>$product,'seller'=>$seller));

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
        $customer_type = $customer->customer_type ? $customer->customer_type : '' ;
        $state_id = $customer->state_id ? $customer->state_id : '';
        $citi_id = $customer->city_id ? $customer->city_id :'';
        $starteofContry = DB::table('states')->where('states.country_id', '=' ,$country_id)->get();
        $cityOfState = DB::table('cities')->where('cities.state_id', '=' ,$state_id)->get(); 

        return view('invoices::admin.invoices.modal-edit-customer', compact('customer','countries','customer_type','status','states','cities','country_id','gender_id','state_id','cityOfState','starteofContry','citi_id'));
    }
     public function inser_form (){       
        $inputs = Input::all();
        $custumer = new Customer();
        $name = explode(' ', $inputs['fullname']);
        $custumer->lastname = $name[count($name) - 1];;
        $custumer->firstname = str_replace($name[count($name) - 1],'',$inputs['fullname']);
        $custumer->mail = $inputs['mail'] ? $inputs['mail'] :'';
        $custumer->phone = $inputs['phone'] ? $inputs['phone'] :'';
        $custumer->gender = $inputs['gender']? $inputs['gender'] :'';
        $custumer->status = 1;
        $custumer->country_id = $inputs['country_id'] ? $inputs['country_id']:'';
        $custumer->save();

        $customers_select = Customer::select('customers__customers.id','customers__customers.lastname','customers__customers.address','customers__customers.phone','customers__customers.firstname')->get();
        die(json_encode($customers_select));
    }

    public function edit_form (){
        $inputs = Input::all();
        $name = explode(' ', $inputs['fullname']);
        $lastname = $name[count($name) - 1];;
        $firstname = str_replace($name[count($name) - 1],'',$inputs['fullname']);
        $mail = $inputs['mail'] ? $inputs['mail'] :'';
        $phone = $inputs['phone'] ? $inputs['phone'] :'';
        $gender = $inputs['gender']? $inputs['gender'] :'';
        $status = 1;
        $country_id = $inputs['country_id'] ? $inputs['country_id']:'';
        Customer::where('id', $inputs['id'])->update(array('lastname'=>$lastname,'firstname'=>$firstname,'mail'=>$mail,'phone'=>$phone,'gender'=>$gender,'country_id'=>$country_id,'status'=>$status));
        $customers_select = Customer::select('customers__customers.id','customers__customers.lastname','customers__customers.address','customers__customers.phone','customers__customers.firstname')->get();
        die(json_encode($customers_select));
    }

    public function updateGroupCode () {
        $inputs = Input::all();
        $ids =Input::get('id','');
        $group_code =Input::get('group_code','');
        for($i=0; $i< sizeof($ids); $i++) {
            Invoice::where('id', $ids[$i])->update(array('group_code' => $group_code[$i]));
        }
        return redirect()->route('admin.invoices.invoice.index')
        ->withSuccess(trans('core::core.messages.updated group_code', ['name' => trans('invoices::invoices.title.invoices')]));
    }
    public function genUserName($fullname)
    {
      if (!$fullname) return '';
      $str = str_replace(" ", "", $fullname);
      $unicode = array(
         'a' => array('á', 'à', 'ả', 'ã', 'ạ', 'ă', 'ắ', 'ặ', 'ằ', 'ẳ', 'ẵ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ'),
         'A' => array('Á', 'À', 'Ả', 'Ã', 'Ạ', 'Ă', 'Ắ', 'Ặ', 'Ằ', 'Ẳ', 'Ẵ', ' ', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ'),
         'd' => array('đ'),
         'D' => array('Đ'),
         'e' => array('é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ'),
         'E' => array('É', 'È', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê', 'Ế', 'Ề', 'Ể', 'Ễ', 'Ệ'),
         'i' => array('í', 'ì', 'ỉ', 'ĩ', 'ị'),
         'I' => array('Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị'),
         'o' => array('ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ'),
         'O' => array('Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ố', 'Ồ', 'Ổ', 'Ỗ', 'Ộ', 'Ơ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ'),
         'u' => array('ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự'),
         'U' => array('Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ư', 'Ứ', 'Ừ', 'Ử', 'Ữ', 'Ự'),
         'y' => array('ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ'),
         'Y' => array('Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ'),
         '-' => array(' ', '&quot;', '.', '-–-')
      );
      foreach ($unicode as $nonUnicode => $uni) {
         foreach ($uni as $value)
            $str = @str_replace($value, $nonUnicode, $str);
         $str = preg_replace("/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/", "-", $str);
         $str = preg_replace("/-+-/", "-", $str);
         $str = preg_replace("/^\-+|\-+$/", "", $str);
      }
      return strtolower($str);
    }
    
    function get_tour_guide_id()
    { 
        $tour_guide_id = Input::get('tour_guide_id', ''); 
        $tour_guide = DB::table('tourguide__tourguides')->where('tourguide__tourguides.id', '=' ,$tour_guide_id)->first();
       
        $orderTour = DB::table('tourguide__tourguides')
                ->orderBy('id', 'desc')
                ->get();
        $maso = "00".$orderTour[0]->id;
        $fullname = $tour_guide->firstname.' '.$tour_guide->lastname;
        $fullname = $this->genUserName($fullname);
        $code =$fullname.$maso;
        echo json_encode($code);
   
    }

}
