<div class="box-body">
<div class ="row">
    <div class ="col-sm-6">
        <div class="form-group ">
            <label for="firstname">Họ và tên</label>
            <input placeholder="Họ và tên" name="fullname" type="text" id="fullname" class="form-control" value="{{$customer->firstname .' '.$customer->lastname}}">
        </div>   
        <div class="form-group dropdown">
            <label for="country_id">Giới tính</label>
            <select id="gender" name="gender" class="form-control">
                <option value="1" <?php echo $gender_id == 1 ? 'selected' : ''?>>Nam</option>
                <option value="2" <?php echo $gender_id == 2 ? 'selected' : ''?>>Nữ</option>           
            </select>
        </div>
        <!-- {!! Form::normalInput('address', 'Địa chỉ', $errors, $customer) !!} -->
        <!-- <div class="form-group dropdown">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">
                <option value="">Chọn trạng thái</option>
                <option value="1"  <?php echo $status == 1 ? 'selected' : ''?>>Đã kích hoạt</option>
                <option value="2"  <?php echo $status == 2 ? 'selected' : ''?>>Chưa kích hoạt</option>           
            </select>
        </div>  -->
    </div>
    <div class ="col-sm-6">
        {!! Form::normalInput('mail', 'Email', $errors, $customer) !!}
        {!! Form::normalInput('phone', 'Số điện thoại', $errors, $customer) !!}
        <!-- <div class="form-group dropdown">
            <label for="customer_type">Loại khách hàng</label>
            <select id="customer_type" name="customer_type" class="form-control">
                <option value="1" <?php echo $customer_type == 1 ? 'selected' : ''?>>Bình thường</option>
                <option value="2" <?php echo $customer_type == 2 ? 'selected' : ''?>>VIP</option>           
            </select>
        </div>  -->
        

        <!-- <div class="form-group dropdown">
            <label for="state_id">Tỉnh</label>
            <select name="state_id" id ="state_id" class="form-control">
            <option value="">Chọn tỉnh</option>
                <?php foreach ($starteofContry as $state) {?>
                    <option value="{{$state->id}}" <?php echo $state_id == $state->id ? 'selected' : '' ?>>{{$state->name}}</option>
                <?php }?>
            </select>
        </div>
        <div class="form-group dropdown">
            <label for="city_id">Thành phố</label>
            <select name="city_id" id="city_id" class="form-control">
                <option value="">Chọn thành phố</option>
                <?php foreach ($cityOfState as $citi) {?>
                    <option value="{{$citi->id}}" <?php echo $citi_id == $citi->id ? 'selected' : '' ?>>{{$citi->name}}</option>
                <?php }?>
            </select>
        </div>

        {!! Form::normalInput('custom_field1', 'Thông tin khác 1', $errors, $customer) !!}
        {!! Form::normalInput('custom_field2', 'Thông tin khác 2', $errors, $customer) !!}
        {!! Form::normalInput('custom_field3', 'Thông tin khác 3', $errors, $customer) !!} -->
    </div>
    <div class="col-md-12">
        <div class="form-group dropdown">
            <label for="country_id">Quốc gia</label>
            <select id="country_id" name="country_id" class="form-control">
                <option value="">Chọn quốc gia</option>
                <?php foreach ($countries as $countrie) {?>
                    <option value="{{$countrie->id}}" <?php echo $country_id == $countrie->id ? 'selected' : '' ?>>{{$countrie->name}}</option>
                <?php }?>
            </select>
        </div>
     </div>
</div>    
</div>
