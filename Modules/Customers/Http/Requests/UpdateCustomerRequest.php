<?php

namespace Modules\Customers\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateCustomerRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'customer_type' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'mail' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'status' => 'required',
            'custom_field1' => 'required',
            'custom_field2' => 'required',
            'custom_field3' => 'required'
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
