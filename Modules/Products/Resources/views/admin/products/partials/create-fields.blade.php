<div class="box-body">
    @mediaSingle('Hình Ảnh', $products)
    @mediaMultiple('Hình Ảnh Khác', $products)
    {!! Form::normalInput('name', 'Tên Sản Phẩm', $errors) !!}
    <div class="form-group dropdown">
        <label for="state_id">Loại Sản Phẩm</label>
        <select id="category_id" name="category_id" class="form-control">
            <option value="">Chọn Loại Sản Phẩm</option>
            @foreach($categories as $c)
            <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
        </select>
    </div>
    {!! Form::normalInput('intro', 'Giới Thiệu Sản Phẩm', $errors) !!}
    {{--{!! Form::normalInput('gallery', 'Bộ Sưu Tập', $errors) !!}--}}
    {!! Form::normalTextarea('description', 'Nội Dung', $errors) !!}
    {!! Form::normalInput('price', 'Đơn Giá ($)', $errors) !!}
    {!! Form::normalInput('price_discount', 'Giá Khuyến Mãi ($)', $errors) !!}
    <div class="form-group dropdown">
        <label for="status">Trạng thái</label>
        <select id="status" name="status" class="form-control">
            <option value="1">Kích hoạt</option>
            <option value="2">Chưa kích hoạt</option>
        </select>
    </div>
</div>
