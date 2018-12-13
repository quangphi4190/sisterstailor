<?php

namespace Modules\Hotel\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateHotelRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name'  =>  'required',
            'phone' =>  'required',
            'email' =>  'required',
            'address'   =>  'required',
            'status'        =>  'required',
            'country_id'    =>  'required',
            'state_id'      =>  'required',
            'city_id'       =>  'required',
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
            'name.required'     =>  'Bạn Chưa Nhập Tên Khách Sạn',
            'phone.required'    =>  'Bạn Chưa Nhập Số Điện Thoại',
            'email.required'    =>  'Bạn Chưa Nhập E-Mail',
            'address.required'           =>  'Bạn Chưa Nhập Địa Chỉ Khách Sạn',
            'status.required'            =>  'Bạn Chưa Chọn Trạng Thái',
            'country_id.required'       =>  'Bạn Chưa Nhập Quốc Gia',
            'state_id.required'         =>  'Bạn Chưa Nhập Tỉnh',
            'city_id.required'          =>  'Bạn Chưa Nhập Thành Phố'
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}
