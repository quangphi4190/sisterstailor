<div class="box-body">
    {!! Form::normalInput('name', 'Danh Mục Sản Phẩm', $errors) !!}
    {!! Form::normalTextarea('description', 'Nội Dung', $errors) !!}
    <div class="form-group dropdown">
        <label for="state_id">Loại Sản Phẩm</label>
        <select id="parent_id" name="parent_id" class="form-control">
            <option value="">Chọn Loại Sản Phẩm</option>
            @foreach($parent as $p)
                <option value="{{$p->id}}">{{$p->name}}</option>
            @endforeach
        </select>
    </div>
</div>
