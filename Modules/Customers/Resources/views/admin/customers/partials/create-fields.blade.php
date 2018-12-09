
<div class="box-body">   
<div class ="row">
    <div class ="col-sm-6">
        {!! Form::normalInput('firstname', 'Họ', $errors) !!}
        {!! Form::normalInput('lastname', 'Tên', $errors) !!}
        {!! Form::normalInput('mail', 'Email', $errors) !!}
        {!! Form::normalInput('phone', 'Số điện thoại', $errors) !!}

        <div class="form-group dropdown">
            <label for="country_id">Giới tính</label>
            <select id="gender" name="gender" class="form-control">
                <option value="">Chọn giới tính</option>
                <option value="1">Nam</option>
                <option value="2">Nữ</option>           
            </select>
        </div>   
        
        {!! Form::normalInput('address', 'Địa chỉ', $errors) !!}
        <div class="form-group dropdown">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">
                <option value="">Chọn trạng thái</option>
                <option value="1">Kích hoạt</option>
                <option value="2">Chưa kích hoạt</option>           
            </select>
        </div>  
    </div>
    <div class ="col-sm-6">
        {!! Form::normalInput('customer_type', 'Loại khách hàng', $errors) !!}     
        <div class="form-group dropdown">
            <label for="country_id">Quốc gia</label>
            <select id="country_id" name="country_id" class="form-control">
                <option value="">Chọn quốc gia</option>
                <?php foreach ($countries as $countrie) {?>
                <option value="{{$countrie->id}}">{{$countrie->name}}</option>
                <?php }?>
            </select>
        </div>

        <div class="form-group dropdown">
            <label for="state_id">Tỉnh</label>
            <select name="state_id" class="form-control">
            <option value="">Chọn tỉnh</option>
            </select>
        </div>
        <div class="form-group dropdown">
            <label for="city_id">Thành phố</label>
            <select name="city_id" class="form-control">
                <option value="">Chọn thành phố</option>
            </select>
        </div>    
        {!! Form::normalInput('custom_field1', 'Thông tin khác 1', $errors) !!}
        {!! Form::normalInput('custom_field2', 'Thông tin khác 2', $errors) !!}
        {!! Form::normalInput('custom_field3', 'Thông tin khác 3', $errors) !!}
    </div>
</div>
</div>
