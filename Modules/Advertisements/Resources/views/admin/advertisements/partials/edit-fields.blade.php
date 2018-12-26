<div class="box-body">
    @mediaSingle('image_advertisement', $advertisement)     
    {!! Form::normalInput('name', 'Tên quảng cáo', $errors, $advertisement) !!}
    <div class="form-group dropdown">
            <label for="position">Vị trí</label>
            <select id="position" name="position" class="form-control">               
                <option <?php echo $position == 1 ? 'selected' : '' ?> value="1">Top</option>
                <option <?php echo $position == 2 ? 'selected' : '' ?> value="2">Bottom</option> 
                <option <?php echo $position == 3 ? 'selected' : '' ?> value="3">Left</option>
                <option <?php echo $position == 4 ? 'selected' : '' ?> value="4">Right</option>            
            </select>
    </div>
    <div class="form-group dropdown">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">               
                <option <?php echo $status == 1 ? 'selected' : '' ?> value="1">Kích hoạt</option>
                <option <?php echo $status == 2 ? 'selected' : '' ?> value="2">Chưa kích hoạt</option>           
            </select>
    </div>
    {!! Form:: normalTextarea('note', 'Nội dung', $errors, $advertisement) !!}
</div>
