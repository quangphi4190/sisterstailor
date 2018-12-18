<?php

namespace Modules\Invoices\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateInvoiceRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
        

        //  'customer_id' => 'required',
        // 'tour_guide_id' => 'required',
        // 'hotel_id' => 'required',
        // 'order_date' => 'required',
        // 'product' => 'required',
        // 'price' => 'required',
        // 'discount' => 'required',
        // 'payment_type' => 'required',
        // 'delivery_date' => 'required',
        // 'delivery_address' => 'required',
        // 'delivery_name' => 'required',
        // 'delivery_phone' => 'required',
        // 'delivery_note' => 'required',
        // 'billing_name' => 'required',
        // 'billing_phone' => 'required',
        // 'status' => 'required',
        // 'note' => 'required'


        ];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [

            // 'product.required'     =>  'Vui lòng nhập tên sản phẩm',
            // 'price.required'    =>  'Vui lòng nhập giá',
            // 'payment_type.required'           =>  'Vui lòng nhập hình thức thanh toán',
            // 'delivery_address.required'            =>  'Vui lòng nhập địa chỉ giao hàng',
            // 'delivery_name.required'       =>  'Vui lòng nhập tên người giao hàng',
            // 'delivery_phone.required'         =>  'Vui lòng nhập số điện thoại người giao hàng',
            // 'billing_name.required'       =>  'Vui lòng nhập tên người đứng hóa đơn',
            // 'billing_phone.required'         =>  'Vui lòng nhập số điện thoại người thanh toám'

        ];
    }

    public function translationMessages()
    {
        return [];
    }
}
