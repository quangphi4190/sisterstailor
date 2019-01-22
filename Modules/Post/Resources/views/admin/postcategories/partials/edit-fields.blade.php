<div class="box-body">
    <div class="form-group ">
        <label for="name">Tên tiêu đề</label>
        <input class="form-control" onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)" placeholder="Tên tiêu đề" name="name" type="text" id="name" value="{{$postcategory->name}}">
    </div>
    <div class="form-group ">
        <label for="slug">URL</label>
        <input class="form-control" placeholder="URL" name="slug" type="text" id="slug-text" value="{{$postcategory->slug}}">
    </div>
    <div class="form-group dropdown">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">               
                <option <?php echo $status == 1 ? 'selected' : '' ?>  value="1">Kích hoạt</option>
                <option <?php echo $status == 2? 'selected' : '' ?> value="2">Chưa kích hoạt</option>           
            </select>
    </div>
</div>
