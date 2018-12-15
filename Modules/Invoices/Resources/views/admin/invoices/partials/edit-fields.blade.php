<?php
$status = [
    0 => 'Đơn hàng mới',
    1 => 'Chờ xử lý',
    2 => 'Đã xử lý',
    3 => 'Chờ thanh toán',
    4 => 'Đã thanh toán',
    5 => 'Đã hoàn thành',
    6 => 'Đã huỷ'
   
];
$date = date("d/m/Y H:m:s");
?>
<div class="box-body">
<div class = "row">
    <div class ="col-sm-6">
            <div class="form-group dropdown" id="khachhang">
                <label for="customer_id">Khách hàng</label>
                <select name="customer_id" id="customer_id" class="form-control">
                    <option value="">Chọn khách hàng</option>
                    <?php foreach ($customers_select as $c) {?>
                        <option data-id-custumer="{{$c->id}}" value="{{$c->id}}" <?php echo $customer_id == $invoice->customer_id ? 'selected' : '' ?>>{{$c->firstname .' '.$c->lastname}} </option>
                    <?php }?>
                </select>
            </div> 
            <div class="form-group dropdown">
                <label for="tour_guide_id">Hướng dẫn viên</label>
                <select name="tour_guide_id" id="tour_guide_id" class="form-control">
                    <option value="">Chọn hướng dẫn viên</option>
                    <?php foreach ($tourguides as $tourguide) {?>
                        <option <?php echo $tour_guide_id == $invoice->tour_guide_id ? 'selected' : '' ?>  value="{{$tourguide->id}}">{{$tourguide->firstname .' '.$tourguide->lastname}} </option>
                    <?php }?>
                </select>
            </div> 
            <div class="form-group dropdown">
                <label for="hotel_id">Khách sạn</label>
                <select name="hotel_id" id="hotel_id" class="form-control">
                    <option value="">Chọn khách sạn</option>
                    <?php foreach ($hotels as $hotel) {?>
                    <option value="{{$hotel->id}}" <?php echo $hotel_id == $invoice->hotel_id ? 'selected' : '' ?>  >{{$hotel->name}} </option>
                    <?php }?>
                </select>
            </div> 
    
            <div class="form-group "><label for="order_date">Ngày đặt hàng</label>
                <div class='input-group date' id='datetimepicker2'>
                    <input type='text' class="form-control c-form-date datetime-picker" name="order_date" id="order_date" value="{{$invoice->order_date ? $invoice->order_date : $date}}"/>
                    <span class="input-group-addon c-input-addon">
                        <span class="glyphicon glyphicon-calendar c-icon"></span>
                    </span>
                </div>   
            </div>
            {!! Form::normalInput('product', 'Sản phẩm', $errors,$invoice) !!}
            {!! Form::normalInput('price', 'Giá', $errors,$invoice) !!}
            {!! Form::normalInput('discount', 'Giảm giá', $errors,$invoice) !!}
            {!! Form::normalInput('payment_type', 'Hình thức thanh toán', $errors,$invoice) !!}
     </div>
    <div class ="col-sm-6">
        <div class="form-group ">
        <label for="order_date">Ngày giao hàng</label>
            <div class='input-group date' id='datetimepicker1'>
                <input type='text' class="form-control c-form-date datetime-picker" name="delivery_date" id="delivery_date" value="{{$invoice->delivery_date ? $invoice->delivery_date : $date }}"/>
                <span class="input-group-addon c-input-addon">
                    <span class="glyphicon glyphicon-calendar c-icon"></span>
                </span>
            </div>      
        </div>
        {!! Form::normalInput('delivery_address', 'Địa chỉ giao hàng', $errors,$invoice) !!}
        {!! Form::normalInput('delivery_name', 'Người giao hàng', $errors,$invoice) !!}
        {!! Form::normalInput('delivery_phone', 'Điện thoại giao hàn', $errors,$invoice) !!}
        {!! Form::normalInput('delivery_note', 'Ghi chú giao hàng', $errors,$invoice) !!}
        {!! Form::normalInput('billing_name', 'Tên người đứng hóa đơn', $errors,$invoice) !!}
        {!! Form::normalInput('billing_phone', 'Điện thoại người thanh toán', $errors,$invoice) !!}
        <div class="form-group dropdown">
        <label for="country_id">Trạng thái</label>
            <select id="status" name="status" class="form-control">
                <?php foreach ($status as $key => $value) { ?>     
                    <option <?php echo $status == $invoice->status ? 'selected' : '' ?> value="{{$key}}">{{$value}}</option>
                <?php }?>     
            </select>
        </div> 
    </div>
    {!! Form:: normalTextarea('note', 'Ghi chú', $errors,$invoice) !!} 
</div>

</div>
