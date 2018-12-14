<div class="box-body">
<div class="row">
    <div class="col-sm-6">
    {!! Form::normalInput('name', trans('hotel::hotels.form.name'), $errors,$hotel) !!}
    {!! Form::normalInput('phone', trans('hotel::hotels.form.phone'), $errors,$hotel) !!}
    {!! Form::normalInput('email', trans('hotel::hotels.form.email'), $errors,$hotel) !!}
    {!! Form::normalInput('address', trans('hotel::hotels.form.address'), $errors,$hotel) !!}
    {!! Form::normalInput('contact_name', trans('hotel::hotels.form.contact_name'), $errors,$hotel) !!}
    {!! Form::normalInput('contact_phone', trans('hotel::hotels.form.contact_phone'), $errors,$hotel) !!}    
    </div>
    <div class="col-sm-6">
    {!! Form::normalInput('contact_mail', trans('hotel::hotels.form.contact_mail'), $errors,$hotel) !!}    
    <div class="form-group dropdown">
        <label for="country_id">Quốc Gia</label>
        <select id="country_id" name="country_id" class="form-control">
            <option value="">Chọn Quốc Gia</option>
            <?php foreach ($countries as $countrie) {?>
                <option value="{{$countrie->id}}" <?php echo $country_id == $countrie->id ? 'selected' : '' ?>>{{$countrie->name}}</option>
            <?php }?>
        </select>
    </div>

    <div class="form-group dropdown">
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
    </div>
    <div class="form-group dropdown">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">
                <option value="">Chọn trạng thái</option>
                <option value="1" <?php echo $status== 1 ? 'selected' : ''?>>Kích hoạt</option>
                <option value="2" <?php echo $status== 2 ? 'selected' : ''?>>Chưa kích hoạt</option>           
            </select>
    </div>
    </div>
    </div>
</div>
