<div class="box-body">
    <div class="form-group dropdown">
        <label >Cấp Độ Hướng Dẫn Viên</label>
        <select  name="tour_guide_type" class="form-control">
        	<option value="{{$tourguide->tour_guide_type}}">{{$tourguide->tour_guide_type}}</option>
            <option value="Bình Thường">Bình Thường</option>
            <option value="Vip">Bình Thường</option>
        </select>
    </div>
    {!! Form::normalInput('firstname', 'Họ', $errors, $tourguide) !!}
    {!! Form::normalInput('lastname', 'Tên', $errors, $tourguide) !!}
    {!! Form::normalInput('email', 'E-Mail', $errors, $tourguide) !!}
    {!! Form::normalInput('phone', 'Số Điện Thoại', $errors, $tourguide) !!}
    {!! Form::normalInput('address', 'Địa Chỉ', $errors, $tourguide) !!}
    	@if ($tourguide->gender === 'Nam')
	    <div class="radio">    	
	      <label><input type="radio" name="gender" value="{{$tourguide->gender}}" checked>{{$tourguide->gender}}</label>
	    </div>
	    <div class="radio">
	      <label><input type="radio" name="gender" value="Nữ">Nữ</label>      
	    </div>
    	@else	    
	    <div class="radio">
	      <label><input type="radio" name="gender" value="Nam">Nam</label>      
	    </div>
	    <div class="radio">    	
	      <label><input type="radio" name="gender" value="{{$tourguide->gender}}" checked>{{$tourguide->gender}}</label>
	    </div>
	    @endif

    <div class="form-group dropdown">
        <label for="country_id">Country</label>
        <select id="country_id" name="country_id" class="form-control">
            <option value="">Select country</option>
            <?php foreach ($countries as $countrie) {?>
                <option value="{{$countrie->id}}" <?php echo $country_id == $countrie->id ? 'selected' : '' ?>>{{$countrie->name}}</option>
            <?php }?>
        </select>
    </div>

    <div class="form-group dropdown">
        <label for="state_id">State</label>
        <select name="state_id" class="form-control">
        <option value="">Select state</option>
            <?php foreach ($starteofContry as $state) {?>
                <option value="{{$state->id}}" <?php echo $state_id == $state->id ? 'selected' : '' ?>>{{$state->name}}</option>
            <?php }?>
        </select>
    </div>
    <div class="form-group dropdown">
        <label for="city_id">City</label>
        <select name="city_id" class="form-control">
            <option value="">Select city</option>
            <?php foreach ($cityOfState as $citi) {?>
                <option value="{{$citi->id}}" <?php echo $citi_id == $citi->id ? 'selected' : '' ?>>{{$citi->name}}</option>
            <?php }?>
        </select>
    </div>
    {!! Form::normalInput('company', 'Tên Công Ty', $errors, $tourguide) !!}
        <div class="form-group dropdown">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">
                <option value="">Chọn trạng thái</option>
                <option value="1" <?php echo $status== 1 ? 'selected' : ''?>>Kích hoạt</option>
                <option value="2" <?php echo $status== 2 ? 'selected' : ''?>>Chưa kích hoạt</option>           
            </select>
        </div>
    {!! Form::normalInput('custom_field1', 'Custom Field 1', $errors, $tourguide) !!}
    {!! Form::normalInput('custom_field2', 'Custom Field 2', $errors, $tourguide) !!}
    {!! Form::normalInput('custom_field3', 'Custom Field 3', $errors, $tourguide) !!}    
</div>
