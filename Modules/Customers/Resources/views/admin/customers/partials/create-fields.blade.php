
<div class="box-body">
    {!! Form::normalInput('customer_type', 'Customer Type', $errors) !!}
    {!! Form::normalInput('firstname', 'Firstname', $errors) !!}
    {!! Form::normalInput('lastname', 'Lastname', $errors) !!}
    {!! Form::normalInput('mail', 'Email', $errors) !!}
    {!! Form::normalInput('phone', 'Phone', $errors) !!}
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
    {!! Form::normalInput('status', 'Status', $errors) !!}
    {!! Form::normalInput('custom_field1', 'Custom Field 1', $errors) !!}
    {!! Form::normalInput('custom_field2', 'Custom Field 2', $errors) !!}
    {!! Form::normalInput('custom_field3', 'Custom Field 3', $errors) !!}
</div>
