<?php

namespace Modules\Hotel\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateHotelRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name'  =>  'required',
            'phone' =>  'required',
            'email' =>  'required',
            'address'   =>  'required',
            'contact_name'  =>  'required',
            'contact_phone' =>  'required',
            'contact_mail'  =>  'required',
            'status'        =>  'required'
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
