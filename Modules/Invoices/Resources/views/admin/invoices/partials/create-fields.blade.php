<?php
$status = [
    0 => 'Đơn hàng mới',
    1 => 'Chờ xử lý',
    2 => 'Đã xử lý',
    3 => 'Chờ thanh toán',
    4 => 'Đã thanh toán',
    5 => 'Đã hoàn thành',
    6 => 'Đã huỷ'
   
]
?>
<div class="box-body">
<p hidden class="view-customer"></p>
<div class = "row">
    <div class ="col-sm-4">
        <div class="form-group dropdown" id="khachhang">
            <label for="customer_id">Khách hàng</label>
            <select name="customer_id" id="customer_id" class="form-control blah">
                <option value="">Chọn khách hàng</option>
                <?php foreach ($customers_select as $c) {?>
                    <option data-id-custumer="{{$c->id}}" value="{{$c->id}}">{{$c->firstname .' '.$c->lastname}} </option>
                <?php }?>
            </select>
        </div> 
    </div>
    
    <div class ="col-sm-2" style = "padding-top:25px;">
        <div class="btn-group" name="btngroupModal" role="group" aria-label="Basic example">
            <button type="button" id="editInfoCusomer" class="btn btn-secondary h-btn" data-toggle="modal" data-target=".modalEditInfo"><i class="fa fa-pencil" aria-hidden="true"></i></button>            
            <button type="button" id="viewInfoCusomer" class="btn btn-secondary h-btn" data-toggle="modal" data-target=".modalInfo"><i class="fa fa-eye" aria-hidden="true">
                </i></button>
            <button type="button" class="btn btn-secondary h-btn" data-toggle="modal" data-target=".bd-example-modal-lg">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
        </div>
    </div>
    <div class ="col-sm-6">
        <div class="form-group dropdown">
            <label for="payment_type">Hình thức thanh toán</label>
            <select name="payment_type" id="payment_type" class="form-control">           
                <option value="Tiền mặt">Tiền mặt</option>
                <option value="Thẻ">Thẻ </option>
                <option value="Cả hai">Cả hai </option>
                <option value="Khác">Khác </option>
            </select>
        </div> 
    </div>
</div>
<div class = "row">
    <div class ="col-sm-6">
          <div name ="customerID" class="c-customer" id="showInfo"></div>
    </div>
</div>
<div class = "row">
    <div class ="col-sm-6">   
        <div class="d-flex flex-row pd-t26">
            <div class ="col-sm-4 p_o">
                <label class="containera">Khách đoàn
                    <input type="checkbox" name="is_group">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="col-sm-8 d-flex p_o">
                <label class="l-white-sp" for="group_code">Mã đoàn</label>
                <input placeholder="Mã đoàn" name="group_code" type="text" id="group_code" class="form-control">
            </div>      
        </div>
        
        <div class="form-group dropdown">
                <label for="tour_guide_id">Hướng dẫn viên</label>
                <select name="tour_guide_id" id="tour_guide_id" class="form-control">
                    <option value="0">Khách lẻ</option>
                    <?php foreach ($tourguides as $tourguide) {?>
                        <option value="{{$tourguide->id}}">{{$tourguide->firstname .' '.$tourguide->lastname}} - {{$tourguide->phone}} </option>
                    <?php }?>
                </select>
        </div> 
       

        <div class="row d-flex">       
            <div class="col-md-6 p-2">
                <div class="form-group dropdown">
                    <label for="hotel_id">Khách sạn</label>
                    <select name="hotel_id" id="hotel_id" class="form-control">
                        <option value="0">Khác</option>
                        <?php foreach ($hotels as $hotel) {?>
                            <option value="{{$hotel->id}}">{{$hotel->name}} </option>
                        <?php }?>
                    </select>
                </div> 
            </div>
            <div class ="col-md-6">
                <div class="form-group "><label for="delivery_address">Số phòng</label>
                <input class="form-control" placeholder="Số phòng" name="delivery_address" type="text" id="delivery_address"></div>
            </div>
        </div>   

        <div class="form-group "><label for="order_date">Ngày đặt hàng</label>
            <div class='input-group date' id='datetimepickerdathang'>
                <input type='text' class="form-control c-form-date datetime-picker" name="order_date" id="order_date"/>
                <span class="input-group-addon c-input-addon">
                    <span class="glyphicon glyphicon-calendar c-icon"></span>
                </span>
            </div>   
        </div>
        <div class="form-group "><label for="order_date">Ngày khách rời</label>
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control c-form-date datetime-picker" name="delivery_date" id="delivery_date"/>
                    <span class="input-group-addon c-input-addon">
                        <span class="glyphicon glyphicon-calendar c-icon"></span>
                    </span>
                </div>      
        </div>
        
    </div>
    <div class ="col-sm-6">
        {!! Form::normalInput('seller', 'Người bán', $errors) !!}
       
       
        <div class="form-group ">
            <label for="price">Giá</label>
            <!-- <input placeholder="Giá" name="price" type="number"  id="price" value="0" step=".01" class="form-control"> -->
            <input type="text" class="form-control" name="price" value="0" step=".01" data-variavel="price"   >
        </div>
        <div class="form-group ">
            <label for="discount">Giảm giá</label>
            <!-- <input placeholder="Giảm giá" name="discount" type="number" value="0" step=".01" id="discount" class="input-calc form-control"> -->
            <input type="text" class="form-control" name="discount" data-variavel="discount" value="0" step=".01">
        </div>
        <div class="form-group">
            <label for="amount">Thành tiền</label>
            <!-- <input placeholder="Thành tiền" name="amount" type="text" id="amount" step=".01" value="0" class="form-control" readonly> -->
            <input type="text" class="form-control" name="amount" data-formula="#price# - #discount#" step=".01" value="0" readonly>
        </div>
    <!-- {!! Form::normalInput('delivery_address', 'Địa chỉ giao hàng', $errors) !!} -->
    <!-- {!! Form::normalInput('delivery_name', 'Tên người giao hàng', $errors) !!}
    {!! Form::normalInput('delivery_phone', 'Điện thoại giao hàng', $errors) !!}
    {!! Form::normalInput('delivery_note', 'Ghi chú giao hàng', $errors) !!}
    {!! Form::normalInput('billing_name', 'Tên người đứng hóa đơn', $errors) !!}
    {!! Form::normalInput('billing_phone', 'Điện thoại người thanh toán', $errors) !!}    -->
    
    </div>
</div>
  {!! Form:: normalTextarea('note', 'Ghi chú', $errors) !!} 
</div>
<!-- Model view -->
<div class="modal fade modalInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header c-header">
        <h5 class="modal-title c-text" id="exampleModalLongTitle">Thông tin khách hàng</h5>
        <button type="button" class="close c-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>        
      </div>
    </div>
  </div>
</div>
<!-- model end view -->
<!-- modal Edit Info -->

