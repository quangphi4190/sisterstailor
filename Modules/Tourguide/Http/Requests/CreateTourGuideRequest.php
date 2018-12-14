<?php

namespace Modules\Tourguide\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateTourGuideRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'firstname'         =>  'required',
            'lastname'          =>  'required',
            'phone'             =>  'required',
            'country_id'        =>  'required',
            'state_id'          =>  'required',
            'city_id'           =>  'required'
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
            'firstname.required'      =>  'Bạn Chưa Nhập Thông Tin Họ',
            'lastname.required'       =>  'Bạn Chưa Nhập Thông Tin Tên',
            'phone.required'          =>  'Bạn Chưa Nhập Thông Tin Số Điện Thoại',
            'country_id.required'     =>  'Bạn Chưa Nhập Thông Tin Quốc Gia',
            'state_id.required'       =>  'Bạn Chưa Nhập Thông Tin Tỉnh',
            'city_id.required'        =>  'Bạn Chưa Nhập Thông Tin Thành Phố',
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}
