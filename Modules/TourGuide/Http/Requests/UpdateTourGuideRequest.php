<?php

namespace Modules\TourGuide\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateTourGuideRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'firstname'         =>  'required',
            'lastname'          =>  'required',
            'email'             =>  'required',
            'phone'             =>  'required',
            'address'           =>  'required',
            'company'           =>  'required'
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
            'firstname.required'      =>  'Bạn Chưa Nhập Thông Tin Họ Cần Thay Đổi',
            'lastname.required'       =>  'Bạn Chưa Nhập Thông Tin Tên Cần Thay Đổi',
            'email.required'          =>  'Bạn Chưa Nhập Thông Tin E-Mail Cần Thay Đổi',
            'phone.required'          =>  'Bạn Chưa Nhập Thông Tin Số Điện Thoại Cần Thay Đổi',
            'address.required'        =>  'Bạn Chưa Nhập Thông Tin Địa Chỉ Cần Thay Đổi',
            'company.required'        =>  'Bạn Chưa Nhập Thông Tin Công Ty Cần Thay Đổi'
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}
