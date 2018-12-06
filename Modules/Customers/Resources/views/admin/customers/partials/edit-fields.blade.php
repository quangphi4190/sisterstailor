<div class="box-body">
    {!! Form::normalInput('customer_type', 'Customer Type', $errors, $customer) !!}
    {!! Form::normalInput('firstname', 'Firstname', $errors, $customer) !!}
    {!! Form::normalInput('lastname', 'Lastname', $errors, $customer) !!}
    {!! Form::normalInput('mail', 'Email', $errors, $customer) !!}
    {!! Form::normalInput('phone', 'Phone', $errors, $customer) !!}
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
    {!! Form::normalInput('status', 'Status', $errors, $customer) !!}
    {!! Form::normalInput('custom_field1', 'Custom Field 1', $errors, $customer) !!}
    {!! Form::normalInput('custom_field2', 'Custom Field 2', $errors, $customer) !!}
    {!! Form::normalInput('custom_field3', 'Custom Field 3', $errors, $customer) !!}
</div>
