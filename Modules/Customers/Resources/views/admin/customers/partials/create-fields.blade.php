
<div class="box-body">   
    <div class ="row">
        <div class ="col-sm-6">
            <div class="form-group ">
                <label for="firstname">Họ và tên</label>
                <input placeholder="Họ và tên" name="fullname" type="text" id="fullname" class="form-control">
            </div>       

            <div class="form-group dropdown">
                <label for="gender">Giới tính</label>
                <select id="gender" name="gender" class="form-control">
                    <option value="1">Nam</option>
                    <option value="2">Nữ</option>           
                </select>
            </div>   
            
            <!-- {!! Form::normalInput('address', 'Địa chỉ', $errors) !!} -->
            <!-- <div class="form-group dropdown">
                <label for="status">Trạng thái</label>
                <select id="status" name="status" class="form-control">
                    <option value="">Chọn trạng thái</option>
                    <option value="1">Kích hoạt</option>
                    <option value="2">Chưa kích hoạt</option>           
                </select>
            </div>   -->
        </div>
        <div class ="col-sm-6">
            {!! Form::normalInput('mail', 'Email', $errors) !!}
            {!! Form::normalInput('phone', 'Số điện thoại', $errors) !!}
            <!-- <div class="form-group dropdown">
                <label for="customer_type">Loại khách hàng</label>
                <select id="customer_type" name="customer_type" class="form-control">
                    <option value="1">Bình thường</option>
                    <option value="2">VIP</option>           
                </select>
            </div>  -->        

            <!-- <div class="form-group dropdown">
                <label for="state_id">Tỉnh</label>
                <select id="state_id" name="state_id" class="form-control">
                <option value="">Chọn tỉnh</option>
                </select>
            </div>
            <div class="form-group dropdown">
                <label for="city_id">Thành phố</label>
                <select id="city_id" name="city_id" class="form-control">
                    <option value="">Chọn thành phố</option>
                </select>
            </div>     -->
            <!-- {!! Form::normalInput('custom_field1', 'Thông tin khác 1', $errors) !!}
            {!! Form::normalInput('custom_field2', 'Thông tin khác 2', $errors) !!}
            {!! Form::normalInput('custom_field3', 'Thông tin khác 3', $errors) !!} -->
        </div>   
        <div class="col-md-12">
            <div class="form-group dropdown">
                <label for="country_id">Quốc gia</label>
                <select id="country_id" name="country_id" class="form-control">
                    <option value="">Chọn quốc gia</option>
                    <?php foreach ($countries as $countrie) {?>
                    <option value="{{$countrie->id}}">{{$countrie->name}}</option>
                    <?php }?>
                </select>
             </div>
        </div>    
    </div>
 
</div>
