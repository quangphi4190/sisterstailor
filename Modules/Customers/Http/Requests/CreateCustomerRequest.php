<?php

namespace Modules\Customers\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateCustomerRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'customer_type' => 'required',
           
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
