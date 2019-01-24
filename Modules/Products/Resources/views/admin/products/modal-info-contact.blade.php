<div class="box-body">
    <div class ="row">
        <div class ="col-sm-6 " disabled="disabled">
            <div class="form-group ">
                <label for="lastname">Họ</label>
                <input class="form-control" name="lastname" type="text" value="{{$customer->lastname}}" id="lastname" readonly>
            </div>
            <div class="form-group ">
                <label for="firstname">Tên</label>
                <input class="form-control" name="firstname" type="text" value="{{$customer->firstname}}" id="firstname" readonly>
            </div>
            <div class="form-group ">
                <label for="mail">Email</label>
                <input class="form-control" name="mail" type="text" value="{{$customer->mail}}" id="mail" readonly>
            </div>
            <div class="form-group ">
                <label for="phone">Số điện thoại</label>
                <input class="form-control" name="phone" type="text" value="{{$customer->phone}}" id="phone" readonly>
            </div>
            <div class="form-group ">
                <label for="gender">Giới tính</label>
                <input class="form-control" name="gender" type="text" value="{{$customer->gender == 1 ? 'Nam':'Nữ'}}" id="gender" readonly>
            </div>
            <div class="form-group ">
                <label for="address">Địa chỉ</label>
                <input class="form-control" name="address" type="text" value="{{$customer->address}}" id="address" readonly>
            </div>
            <div class="form-group ">
                <label for="status">Trạng thái</label>
                <input class="form-control" name="status" type="text" value="{{$customer->status == 1 ? 'Đang hoạt động' : 'Chưa kích hoạt'}}" id="status" readonly>
            </div>
        </div>
        <div class ="col-sm-6">
            <div class="form-group ">
                <label for="customer_type">Loại khách hàng</label>
                <input class="form-control" name="customer_type" type="text" value="{{$customer->customer_type}}" id="customer_type" readonly>
            </div>
            <div class="form-group ">
                <label for="country_id">Quốc gia</label>
                <input class="form-control" name="country_id" type="text" value="{{$customer->country_id ? $name_country->name :''}}" id="country_id" readonly>
            </div>
            <div class="form-group ">
                <label for="state_id">Tỉnh</label>
                <input class="form-control" name="state_id" type="text" value="{{$customer->state_id ? $name_state->name :''}}" id="state_id" readonly>
            </div>
            <div class="form-group ">
                <label for="city_id">Thành phố</label>
                <input class="form-control" name="city_id" type="text" value="{{$customer->city_id ? $name_city->name :''}}" id="city_id" readonly>
            </div>
            <div class="form-group ">
                <label for="custom_field1">Thông tin khác 1</label>
                <input class="form-control" name="custom_field1" type="text" value="{{$customer->custom_field1}}" id="custom_field1" readonly>
            </div>
            <div class="form-group ">
                <label for="custom_field2">Thông tin khác 2</label>
                <input class="form-control" name="custom_field2" type="text" value="{{$customer->custom_field2}}" id="custom_field2" readonly>
            </div>
            <div class="form-group ">
                <label for="custom_field2">Thông tin khác 3</label>
                <input class="form-control" name="custom_field2" type="text" value="{{$customer->custom_field2}}" id="custom_field2" readonly>
            </div>
        </div>
    </div>
</div>
