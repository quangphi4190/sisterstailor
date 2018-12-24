<div class="box-body">
    @mediaSingle('image_advertisement', $advertisement)     
    {!! Form::normalInput('name', 'Tên quảng cáo', $errors) !!}
    <div class="form-group dropdown">
            <label for="position">Vị trí</label>
            <select id="position" name="position" class="form-control">               
                <option value="1">Top</option>
                <option value="2">Bottom</option> 
                <option value="3">Left</option>
                <option value="4">Right</option>            
            </select>
    </div>
    <div class="form-group dropdown">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">               
                <option value="1">Kích hoạt</option>
                <option value="2">Chưa kích hoạt</option>           
            </select>
    </div>
    {!! Form:: normalTextarea('note', 'Nội dung', $errors) !!}
</div>
