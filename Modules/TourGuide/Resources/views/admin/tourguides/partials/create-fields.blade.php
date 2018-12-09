<div class="box-body">
    <div class="form-group dropdown">
        <label >Cấp Độ Hướng Dẫn Viên</label>
        <select  name="tour_guide_type" class="form-control">
            <option value="Bình Thường">Bình Thường</option>
            <option value="Vip">Bình Thường</option>
        </select>
    </div>
    {!! Form::normalInput('firstname', 'Họ', $errors) !!}
    {!! Form::normalInput('lastname', 'Tên', $errors) !!}
    {!! Form::normalInput('email', 'E-Mail', $errors) !!}
    {!! Form::normalInput('phone', 'Số Điện Thoại', $errors) !!}
    {!! Form::normalInput('address', 'Địa Chỉ', $errors) !!}
    <div class="radio">
      <label><input type="radio" name="gender" value="Nam" checked>Nam</label>
    </div>
    <div class="radio">
      <label><input type="radio" name="gender" value="Nữ">Nữ</label>
    </div>

    <div class="form-group dropdown">
        <label for="country_id">Country</label>
        <select id="country_id" name="country_id" class="form-control">
            <option value="">Select country</option>
            <?php foreach ($countries as $countrie) {?>
            <option value="{{$countrie->id}}">{{$countrie->name}}</option>
            <?php }?>
        </select>
    </div>

    <div class="form-group dropdown">
        <label for="state_id">State</label>
        <select name="state_id" class="form-control">
        <option value="">Select state</option>
        </select>
    </div>

    <div class="form-group dropdown">
        <label for="city_id">City</label>
        <select name="city_id" class="form-control">
            <option value="">Select city</option>
        </select>
    </div>
    {!! Form::normalInput('company', 'Tên Công Ty', $errors) !!}
    {!! Form::normalInput('status', 'Trạng Thái', $errors) !!}
    {!! Form::normalInput('custom_field1', 'Custom Field 1', $errors) !!}
    {!! Form::normalInput('custom_field2', 'Custom Field 2', $errors) !!}
    {!! Form::normalInput('custom_field3', 'Custom Field 3', $errors) !!}    
</div>
