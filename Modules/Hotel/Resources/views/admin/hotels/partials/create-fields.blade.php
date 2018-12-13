<div class="box-body">
    {!! Form::normalInput('name', 'Tên Khách Sạn', $errors) !!}
    {!! Form::normalInput('phone', 'Số Điện Thoại', $errors) !!}
    {!! Form::normalInput('email', 'E-Mail', $errors) !!}
    {!! Form::normalInput('address', 'Địa Chỉ', $errors) !!}
    <div class="form-group dropdown">
        <label for="country_id">Quốc Gia</label>
        <select id="country_id" name="country_id" class="form-control">
            <option value="">Select country</option>
            <?php foreach ($countries as $countrie) {?>
            <option value="{{$countrie->id}}">{{$countrie->name}}</option>
            <?php }?>
        </select>
    </div>

    <div class="form-group dropdown">
        <label for="state_id">Tỉnh</label>
        <select name="state_id" class="form-control">
        <option value="">Select state</option>
        </select>
    </div>
    <div class="form-group dropdown">
        <label for="city_id">Thành Phố</label>
        <select name="city_id" class="form-control">
            <option value="">Select city</option>
        </select>
    </div>
    {!! Form::normalInput('contact_name', 'Tên Người Liên Hệ', $errors) !!}
    {!! Form::normalInput('contact_phone', 'Số Điện Thoại Người Liên Hệ', $errors) !!}
    {!! Form::normalInput('contact_mail', 'E-Mail Người Liên Hệ', $errors) !!}
    <div class="form-group dropdown">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">
                <option value="">Chọn trạng thái</option>
                <option value="1">Kích hoạt</option>
                <option value="2">Chưa kích hoạt</option>           
            </select>
    </div>
</div>
