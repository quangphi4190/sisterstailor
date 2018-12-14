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
            'email'             =>  'required',
            'phone'             =>  'required',
            'address'           =>  'required',
            'company'           =>  'required',
            'status'           =>  'required',
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
            'email.required'          =>  'Bạn Chưa Nhập Thông Tin E-Mail',
            'phone.required'          =>  'Bạn Chưa Nhập Thông Tin Số Điện Thoại',
            'address.required'        =>  'Bạn Chưa Nhập Thông Tin Địa Chỉ',
            'company.required'        =>  'Bạn Chưa Nhập Thông Tin Công Ty',
            'country_id.required'     =>  'Bạn Chưa Nhập Thông Tin Quốc Gia',
            'state_id.required'       =>  'Bạn Chưa Nhập Thông Tin Tỉnh',
            'city_id.required'        =>  'Bạn Chưa Nhập Thông Tin Thành Phố',
            'status.required'         =>  'Bạn Chưa Chọn Trạng Thái'
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}