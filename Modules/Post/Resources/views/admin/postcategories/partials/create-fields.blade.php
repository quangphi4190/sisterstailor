<div class="box-body">
    <div class="form-group ">
        <label for="name">Tên danh mục</label>
        <input class="form-control" onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)" placeholder="Tên tiêu đề" name="name" type="text" id="name">
    </div>
    <div class="form-group ">
        <label for="slug">URL</label>
        <input class="form-control" placeholder="URL" name="slug" type="text" id="slug-text">
    </div>
    <div class="form-group dropdown">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">               
                <option value="1">Kích hoạt</option>
                <option value="2">Chưa kích hoạt</option>           
            </select>
    </div>
</div>
