<?php

namespace Modules\Invoices\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateInvoiceRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
        'customer_id' => 'required',
        'tour_guide_id' => 'required',
        'hotel_id' => 'required',
        'order_date' => 'required',
        'product' => 'required',
        'price' => 'required',
        'discount' => 'required',
        'payment_type' => 'required',
        'delivery_date' => 'required',
        'delivery_address' => 'required',
        'delivery_name' => 'required',
        'delivery_phone' => 'required',
        'delivery_note' => 'required',
        'billing_name' => 'required',
        'billing_phone' => 'required',
        'status' => 'required',
        'note' => 'required'
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
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
