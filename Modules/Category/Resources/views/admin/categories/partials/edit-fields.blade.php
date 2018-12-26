<div class="box-body">
    {!! Form::normalInput('name', 'Danh Mục Sản Phẩm', $errors, $category) !!}
    {!! Form::normalTextarea('description', 'Nội Dung', $errors, $category) !!}
    <div class="form-group dropdown">
        <label for="state_id">Loại Sản Phẩm</label>
        <select id="parent_id" name="parent_id" class="form-control">
            <option value="">Chọn Loại Sản Phẩm</option>
            @foreach($parent as $p)
                @if ($p->id == $category->id )
                    @else
                <option value="{{$p->id}}" <?php echo $p->id == $category->parent_id ? 'selected' : '' ?>>{{$p->name}}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>
