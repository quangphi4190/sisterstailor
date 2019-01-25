<div class="box-body">
    <div class ="row">
        <div class ="col-sm-12">
            <div class="form-group">
                <label for="lastname">Họ và Tên : </label>
                <p>{{$contactdefail->first_name.' '.$contactdefail->last_name}}</p>
            </div>
            <div class="form-group">
                <label for="mail">Email :</label>
                <p>{{$contactdefail->email}}</p>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại :</label>
                <p>{{$contactdefail->phone}}</p>
            </div>
            <div class="form-group">
                <label for="gender">Nội Dung :</label>
                <p>{{$contactdefail->description}}</p>
            </div>
        </div>
    </div>
</div>
