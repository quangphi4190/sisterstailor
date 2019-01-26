<div class="box-body">
    @mediaSingle('Hình Ảnh', $products)
    @mediaMultiple('Hình Ảnh Khác', $products)
    {!! Form::normalInput('name', 'Tên Sản Phẩm', $errors) !!}
    <div class="form-group dropdown">
        <label for="state_id">Loại Sản Phẩm</label>
        <select id="category_id" name="category_id" class="form-control">
            <option value="">Chọn Loại Sản Phẩm</option>
            <option value=""disabled >Men</option>
            @foreach($categoriesMen as $c)
            <option value="{{$c->id}}">--{{$c->name}}</option>
            @endforeach
            <option value=""disabled >Women</option>
            @foreach($categoriesWomen as $w)
            <option value="{{$w->id}}">--{{$w->name}}</option>
            @endforeach
            <option value=""disabled >Other</option>
            @foreach($categoriesOrther as $o)
            <option value="{{$o->id}}">--{{$o->name}}</option>
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
    <div class="form-group dropdown">
        <label for="status">Sản Phẩm nổi bật</label>
        <select id="featured" name="featured" class="form-control">
            <option value="1">Kích hoạt</option>
            <option value="0">Chưa kích hoạt</option>
        </select>
    </div>
</div>
