<div class="box-body">
<div class="row">
<div class="col-sm-6">
    <!-- <div class="form-group dropdown">
        <label >Cấp Độ Hướng Dẫn Viên</label>
        <select  name="tour_guide_type" class="form-control">
            <option value="Bình Thường">Bình Thường</option>
            <option value="Vip">Vip</option>
        </select>
    </div> -->
    {!! Form::normalInput('firstname', 'Họ và Tên', $errors) !!}
    <!-- {!! Form::normalInput('lastname', 'Tên', $errors) !!} -->
    {!! Form::normalInput('email', 'E-Mail', $errors) !!}
    {!! Form::normalInput('phone', 'Số Điện Thoại', $errors) !!}
    <!-- {!! Form::normalInput('address', 'Địa Chỉ', $errors) !!} -->
    </div>
    <div class="col-sm-6">
    <div class="form-group dropdown">
            <label for="gender">Giới tính</label>
            <select id="gender" name="gender" class="form-control">
                <option value="1">Nam</option>
                <option value="2">Nữ</option>           
            </select>
        </div>    
    {!! Form::normalInput('company', 'Tên Công Ty', $errors) !!}
    </div>
    <div class="col-sm-6">
    <div class="form-group dropdown">
        <label for="country_id">Quốc Gia</label>
        <select id="country_id" name="country_id" class="form-control">
            <option value="">Chọn Quốc Gia</option>
            <?php foreach ($countries as $countrie) {?>
            <option value="{{$countrie->id}}">{{$countrie->name}}</option>
            <?php }?>
        </select>
    </div>

    <!-- <div class="form-group dropdown">
        <label for="state_id">Tỉnh</label>
        <select name="state_id" class="form-control">
        <option value="">Chọn Tỉnh</option>
        </select>
    </div>

    <div class="form-group dropdown">
        <label for="city_id">Thành Phố</label>
        <select name="city_id" class="form-control">
            <option value="">Chọn Thành Phố</option>
        </select>
    </div>
        <div class="form-group dropdown">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">
                <option value="">Chọn trạng thái</option>
                <option value="1">Kích hoạt</option>
                <option value="2">Chưa kích hoạt</option>           
            </select>
        </div>
    {!! Form::normalInput('custom_field1', 'Thông Tin Khác 1', $errors) !!}
    {!! Form::normalInput('custom_field2', 'Thông Tin Khác 2', $errors) !!}
    {!! Form::normalInput('custom_field3', 'Thông Tin Khác 3', $errors) !!}  -->
    </div>
    </div>   
</div>
