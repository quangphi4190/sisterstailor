<div class="box-body">
    @mediaSingle('Image_baner', $banner)     
    {!! Form::normalInput('name', 'Tên banner', $errors, $banner) !!}
    {!! Form::normalInput('limk', 'Link', $errors, $banner) !!}
    <div class="form-group dropdown">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">               
                <option <?php echo $status == 1 ? 'selected' : '' ?>  value="1">Kích hoạt</option>
                <option <?php echo $status == 2? 'selected' : '' ?> value="2">Chưa kích hoạt</option>           
            </select>
    </div>
    </div>
    {!! Form:: normalTextarea('description', 'Nội dung', $errors, $banner) !!}
</div>
