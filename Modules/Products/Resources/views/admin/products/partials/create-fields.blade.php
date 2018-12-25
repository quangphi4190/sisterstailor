<div class="box-body">
    @mediaSingle('Image', $products)
    @mediaMultiple('Image_Other', $products)
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
    {!! Form::normalInput('gallery', 'Bộ Sưu Tập', $errors) !!}
    {!! Form::normalTextarea('description', 'Nội Dung', $errors) !!}
    {!! Form::normalInput('price', 'Giá (VND)', $errors) !!}
    {!! Form::normalInput('price_discount', 'Giảm Giá (VND)', $errors) !!}
</div>
