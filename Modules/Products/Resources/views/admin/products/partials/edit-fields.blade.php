<div class="box-body">
    @mediaSingle('Hình Ảnh', $products)
    @mediaMultiple('Hình Ảnh Khác', $products)
    {!! Form::normalInput('name', 'Tên Sản Phẩm', $errors, $products) !!}
    <div class="form-group dropdown">
        <label for="state_id">Loại Sản Phẩm</label>
        <select id="category_id" name="category_id" class="form-control">
            <option value="1">Chọn Loại Sản Phẩm</option>
        </select>
    </div>
    {!! Form::normalInput('intro', 'Giới Thiệu Sản Phẩm', $errors, $products) !!}
    {{--{!! Form::normalInput('gallery', 'Bộ Sưu Tập', $errors, $products) !!}--}}
    {!! Form::normalTextarea('description', 'Nội Dung', $errors, $products) !!}
    {!! Form::normalInput('price', 'Đơn Giá ($)', $errors, $products) !!}
    {!! Form::normalInput('price_discount', 'Giá Khuyến Mãi ($)', $errors, $products) !!}
    <div class="form-group dropdown">
        <label for="status">Trạng thái</label>
        <select id="status" name="status" class="form-control">
            <option value="1" <?php echo $status== 1 ? 'selected' : ''?>>Kích hoạt</option>
            <option value="2" <?php echo $status== 2 ? 'selected' : ''?>>Chưa kích hoạt</option>
        </select>
    </div>
    <div class="form-group dropdown">
        <label for="status">Sản Phẩm nổi bật</label>
        <select id="featured" name="featured" class="form-control">
            <option value="1"<?php echo $products->featured == 1 ? 'selected' : ''?>>Kích hoạt</option>
            <option value="0"<?php echo $products->featured == 0 ? 'selected' : ''?>>Chưa kích hoạt</option>
        </select>
    </div>
</div>
