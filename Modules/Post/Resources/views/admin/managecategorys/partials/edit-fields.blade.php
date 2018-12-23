<div class="box-body">
{!! Form::normalInput('name', 'Tên tiêu đề', $errors, $managecategorys) !!}
    <div class="form-group dropdown">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">               
                <option <?php echo $status == 1 ? 'selected' : '' ?>  value="1">Kích hoạt</option>
                <option <?php echo $status == 2? 'selected' : '' ?> value="2">Chưa kích hoạt</option>           
            </select>
    </div>
</div>
