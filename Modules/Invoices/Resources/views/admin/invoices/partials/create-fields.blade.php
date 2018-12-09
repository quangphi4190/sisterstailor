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
        <!-- {!! Form::normalInput('customer_id', 'Customer', $errors) !!} -->
        <div class="form-group dropdown" id="khachhang">
            <label for="customer_id">Khách hàng</label>
            <select name="customer_id" id="customer_id" class="form-control">
                <option value="">Chọn khách hàng</option>
                <?php foreach ($customers_select as $c) {?>
                    <option data-id-custumer="{{$c->id}}" value="{{$c->id}}">{{$c->firstname .' '.$c->lastname}} </option>
                <?php }?>
            </select>
        </div> 
    </div>
    
    <div class ="col-sm-2" style = "padding-top:25px;">
        <div class="btn-group" name="btngroupModal" role="group" aria-label="Basic example">
            <button type="button" id="editInfoCusomer" class="btn btn-secondary" data-toggle="modal" data-target=".modalEditInfo"><i class="fa fa-pencil" aria-hidden="true"></i></button>            
            <button type="button" id="viewInfoCusomer" class="btn btn-secondary" data-toggle="modal" data-target=".modalInfo"><i class="fa fa-eye" aria-hidden="true">
                </i></button>
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
        </div>
    </div>
    <div class ="col-sm-6">
        {!! Form::normalInput('delivery_date', 'Ngày giao hàng', $errors) !!}
    </div>
</div>
<div class = "row">
    <div class ="col-sm-6">
          <div name ="customerID" class="c-customer"></div>
    </div>
</div>
<div class = "row">
    <div class ="col-sm-6">   
    <div class="form-group dropdown">
            <label for="tour_guide_id">Hướng dẫn viên</label>
            <select name="tour_guide_id" id="tour_guide_id" class="form-control">
                <option value="">Chọn hướng dẫn viên</option>
                <?php foreach ($tourguides as $tourguide) {?>
                    <option value="{{$tourguide->id}}">{{$tourguide->firstname .' '.$tourguide->lastname}} </option>
                <?php }?>
            </select>
      </div> 
    <div class="form-group dropdown">
        <label for="hotel_id">Khách sạn</label>
        <select name="hotel_id" id="hotel_id" class="form-control">
            <option value="">Chọn khách sạn</option>
            <?php foreach ($hotels as $hotel) {?>
                <option value="{{$hotel->id}}">{{$hotel->name}} </option>
            <?php }?>
        </select>
    </div> 
    {!! Form::normalInput('order_date', 'Ngày đặt hàng', $errors) !!}
    {!! Form::normalInput('product', 'Sản phẩm', $errors) !!}
    {!! Form::normalInput('price', 'Giá', $errors) !!}
    {!! Form::normalInput('discount', 'Giảm giá', $errors) !!}
    {!! Form::normalInput('payment_type', 'Hình thức thanh toán', $errors) !!}
    </div>
    <div class ="col-sm-6">
    {!! Form::normalInput('delivery_address', 'Địa chỉ giao hàng', $errors) !!}
    {!! Form::normalInput('delivery_name', 'Tên người giao hàng', $errors) !!}
    {!! Form::normalInput('delivery_phone', 'Điện thoại giao hàng', $errors) !!}
    {!! Form::normalInput('delivery_note', 'Ghi chú giao hàng', $errors) !!}
    {!! Form::normalInput('billing_name', 'Tên người đứng hóa đơn', $errors) !!}
    {!! Form::normalInput('billing_phone', 'Điện thoại người thanh toán', $errors) !!}   
    <div class="form-group dropdown">
        <label for="country_id">Trạng thái</label>
        <select id="status" name="status" class="form-control">
            <option value="">Chọn trạng thái</option>
            <?php foreach ($status as $key => $value) { ?>     
                <option value="{{$key}}">{{$value}}</option>
            <?php }?>     
        </select>
    </div>    
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
<div class="modal fade modalEditInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
    </div>
  </div>
</div>
<!-- End modal Edit Info -->
