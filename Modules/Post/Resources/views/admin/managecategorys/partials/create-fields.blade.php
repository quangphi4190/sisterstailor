<div class="box-body">
    @mediaSingle('Image', $managecategorys)
    <div class="row d-flex">
        <div class="col-md-12 p-2">
            <div class="form-group dropdown">
                <label for="category_id">Danh mục</label>
                <select name="category_id" id="category_id" class="form-control fom-category">
                    <option value="">Chọn danh mục</option>
                    <?php foreach ($postCategorys as $post) {?>
                        <option value="{{$post->id}}">{{$post->name}} </option>
                    <?php }?>
                </select>
                
            </div>
         </div>
        <div class="p-2 c-btn-add"><button type="button" style="height: 35px;" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg" id="addCategory" title="Thêm danh mục"><i class="fa fa-plus" aria-hidden="true"></i></button></div>
    </div>
    
    {!! Form::normalInput('name', 'Tên tiêu đề', $errors) !!}
    <div class="form-group dropdown">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">               
                <option value="1">Kích hoạt</option>
                <option value="2">Chưa kích hoạt</option>           
            </select>
    </div>
    {!! Form:: normalTextarea('description', 'Nội dung', $errors) !!} 
</div>