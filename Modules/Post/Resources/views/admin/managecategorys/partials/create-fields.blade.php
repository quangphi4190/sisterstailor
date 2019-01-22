<div class="box-body">
    @mediaSingle('Image', $managecategorys)
    <div class="row d-flex">
        <div class="col-md-6 p-2">
            <div class="form-group dropdown">
                <label for="category_id">Danh mục</label>
                <select name="category_id" id="category_id" class="form-control fom-category">
                    <option value="">Chọn danh mục</option>
                    <?php foreach ($postCategorys as $post) {?>
                        <option value="{{$post->id}}">{{$post->name}} </option>
                    <?php }?>
                </select>
            </div>
            <div class="form-group dropdown">
                <label for="status">Trạng thái</label>
                <select id="status" name="status" class="form-control">
                    <option value="1">Kích hoạt</option>
                    <option value="2">Chưa kích hoạt</option>
                </select>
            </div>
         </div>
        <div class=" p-2 c-btn-add"><button type="button" style="height: 35px;" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg" id="addCategory" title="Thêm danh mục"><i class="fa fa-plus" aria-hidden="true"></i></button></div>
        <div class="col-md-6 p-2">
            <div class="form-group ">
                <label for="name">Tên tiêu đề</label>
                <input class="form-control" onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)" placeholder="Tên tiêu đề" name="name" type="text" id="name">
            </div>
            <div class="form-group ">
                <label for="slug">URL</label>
                <input class="form-control" placeholder="URL" name="slug" type="text" id="slug-text">
            </div>
        </div>
    </div>
    {!! Form:: normalTextarea('description', 'Nội dung', $errors) !!} 
</div>