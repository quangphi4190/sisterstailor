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
            'address'   =>  'required'
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
            'name.required'     =>  'Bạn Chưa Nhập Tên Khách Sạn Cần Thay Đổi',
            'phone.required'    =>  'Bạn Chưa Nhập Số Điện Thoại Cần Thay Đổi',
            'email.required'    =>  'Bạn Chưa Nhập E-Mail Cần Thay Đổi',
            'address.required'  =>  'Bạn Chưa Nhập Địa Chỉ Cần Thay Đổi'
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}
