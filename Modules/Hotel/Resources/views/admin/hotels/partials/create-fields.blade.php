<div class="box-body">
    {!! Form::normalInput('name', trans('hotel::hotels.form.name'), $errors) !!}
    {!! Form::normalInput('phone', trans('hotel::hotels.form.phone'), $errors) !!}
    {!! Form::normalInput('email', trans('hotel::hotels.form.email'), $errors) !!}
    {!! Form::normalInput('address', trans('hotel::hotels.form.address'), $errors) !!}
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
    {!! Form::normalInput('contact_name', trans('hotel::hotels.form.contact_name'), $errors) !!}
    {!! Form::normalInput('contact_phone', trans('hotel::hotels.form.contact_phone'), $errors) !!}
    {!! Form::normalInput('contact_mail', trans('hotel::hotels.form.contact_mail'), $errors) !!}
    {!! Form::normalInput('status', trans('hotel::hotels.form.status'), $errors) !!}
</div>
