<div class="box-body">
    <div class ="row">
        <div class ="col-sm-12">
            <div class="form-group">
                <label for="lastname">Họ và Tên : </label>
                <p>{{$contact->first_name.' '.$contact->last_name}}</p>
            </div>
            <div class="form-group">
                <label for="mail">Email :</label>
                <p>{{$contact->email}}</p>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại :</label>
                <p>{{$contact->phone}}</p>
            </div>
            <div class="form-group">
                <label for="gender">Nội Dung :</label>
                <p>{{$contact->description}}</p>
            </div>
        </div>
    </div>
</div>
