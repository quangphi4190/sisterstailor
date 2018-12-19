<div class="box-body">
    {!! Form::normalInput('name', 'Tên Khách Sạn', $errors,$hotel) !!}
    {!! Form::normalInput('phone', 'Số Điện Thoại', $errors,$hotel) !!}
    {!! Form::normalInput('email', 'E-Mail', $errors,$hotel) !!}
    {!! Form::normalInput('address', 'Địa Chỉ', $errors,$hotel) !!}
    <!-- {!! Form::normalInput('contact_name', 'Tên Người Liên Hệ', $errors,$hotel) !!}
    {!! Form::normalInput('contact_phone', 'Số Điện Thoại Người Liên Hệ', $errors,$hotel) !!}     -->    
    <!-- {!! Form::normalInput('contact_mail', 'E-Mail Người Liên Hệ', $errors,$hotel) !!}     -->
    <!-- <div class="form-group dropdown">
        <label for="country_id">Quốc Gia</label>
        <select id="country_id" name="country_id" class="form-control">
            <option value="">Chọn Quốc Gia</option>
            <!-- <?php foreach ($countries as $countrie) {?>
                <option value="{{$countrie->id}}" <?php echo $country_id == $countrie->id ? 'selected' : '' ?>>{{$countrie->name}}</option>
            <?php }?> -->
        </select>
    </div> -->

    <!-- <div class="form-group dropdown">
        <label for="state_id">Tỉnh</label>
        <select name="state_id" class="form-control">
        <option value="">Chọn Tỉnh Thành</option>
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
    </div> -->
    <!-- <div class="form-group dropdown">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">
                <option value="">Chọn trạng thái</option>
                <option value="1" <?php echo $status== 1 ? 'selected' : ''?>>Kích hoạt</option>
                <option value="2" <?php echo $status== 2 ? 'selected' : ''?>>Chưa kích hoạt</option>           
            </select>
    </div> -->
</div>
