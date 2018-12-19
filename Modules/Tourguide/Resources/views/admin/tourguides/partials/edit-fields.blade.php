<div class="box-body">
<div class="row">
    <div class="col-sm-6">
    <!-- <div class="form-group dropdown">
        <label >Cấp Độ Hướng Dẫn Viên</label>
        <select  name="tour_guide_type" class="form-control">
        	<option value="{{$tourguide->tour_guide_type}}">{{$tourguide->tour_guide_type}}</option>
            <option value="Bình Thường">Bình Thường</option>
            <option value="Vip">Bình Thường</option>
        </select>
    </div> -->
    {!! Form::normalInput('firstname', 'Họ và Tên', $errors, $tourguide) !!}
    <!-- {!! Form::normalInput('lastname', 'Tên', $errors, $tourguide) !!} -->
    {!! Form::normalInput('email', 'E-Mail', $errors, $tourguide) !!}
    {!! Form::normalInput('phone', 'Số Điện Thoại', $errors, $tourguide) !!}
    <!-- {!! Form::normalInput('address', 'Địa Chỉ', $errors, $tourguide) !!} -->
    </div>
    <div class="col-sm-6">
    <div class="form-group dropdown">
            <label for="country_id">Giới tính</label>
            <select id="gender" name="gender" class="form-control">
                <option value="1" <?php echo $gender_id == 1 ? 'selected' : ''?>>Nam</option>
                <option value="2" <?php echo $gender_id == 2 ? 'selected' : ''?>>Nữ</option>           
            </select>
    </div>
    {!! Form::normalInput('company', 'Tên Công Ty', $errors, $tourguide) !!}
    </div>
    <div class="col-sm-6">
    <div class="form-group dropdown">
        <label for="country_id">Quốc Gia</label>
        <select id="country_id" name="country_id" class="form-control">
            <option value="">Chọn Quốc Gia</option>
            <?php foreach ($countries as $countrie) {?>
                <option value="{{$countrie->id}}" <?php echo $country_id == $countrie->id ? 'selected' : '' ?>>{{$countrie->name}}</option>
            <?php }?>
        </select>
    </div>

    <!-- <div class="form-group dropdown">
        <label for="state_id">Tỉnh</label>
        <select name="state_id" class="form-control">
        <option value="">Chọn Tỉnh</option>
            <?php foreach ($starteofContry as $state) {?>
                <option value="{{$state->id}}" <?php echo $state_id == $state->id ? 'selected' : '' ?>>{{$state->name}}</option>
            <?php }?>
        </select>
    </div>
    <div class="form-group dropdown">
        <label for="city_id">Thành Phố</label>
        <select name="city_id" class="form-control">
            <option value="">Chọn Thành Phố</option>
            <?php foreach ($cityOfState as $citi) {?>
                <option value="{{$citi->id}}" <?php echo $citi_id == $citi->id ? 'selected' : '' ?>>{{$citi->name}}</option>
            <?php }?>
        </select>
    </div>
        <div class="form-group dropdown">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">
                <option value="">Chọn trạng thái</option>
                <option value="1" <?php echo $status== 1 ? 'selected' : ''?>>Kích hoạt</option>
                <option value="2" <?php echo $status== 2 ? 'selected' : ''?>>Chưa kích hoạt</option>           
            </select>
        </div>
    {!! Form::normalInput('custom_field1', 'Thông Tin Khác 1', $errors, $tourguide) !!}
    {!! Form::normalInput('custom_field2', 'Thông Tin Khác 2', $errors, $tourguide) !!}
    {!! Form::normalInput('custom_field3', 'Thông Tin Khác 3', $errors, $tourguide) !!} -->
    </div> 
    </div>   
</div>
