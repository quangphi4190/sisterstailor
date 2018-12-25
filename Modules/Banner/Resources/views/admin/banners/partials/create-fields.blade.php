<div class="box-body">
    @mediaSingle('Image_baner', $banner)     
    {!! Form::normalInput('name', 'Tên banner', $errors) !!}
    {!! Form::normalInput('limk', 'Link', $errors) !!}

    <div class="form-group dropdown">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">               
                <option value="1">Kích hoạt</option>
                <option value="2">Chưa kích hoạt</option>           
            </select>
    </div>
    {!! Form:: normalTextarea('description', 'Nội dung', $errors) !!}
</div>
