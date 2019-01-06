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
                        <option value="{{$c->id}}" <?php echo $customer_id == $c->id ? 'selected' : '' ?>>{{$c->firstname .' '.$c->lastname}} </option>
                    <?php }?>
                </select>
            </div> 
            <div class="d-flex flex-row pd-t26">
            <div class ="col-sm-4 p_o">
                <label class="containera">Khách đoàn
                    <input type="checkbox" name="is_group"<?php echo $invoice->is_group == 1 ? 'checked' : '';?> >
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="col-sm-8 d-flex p_o">
                <label class="l-white-sp" for="group_code">Mã đoàn</label>
                <input placeholder="Mã đoàn" name="group_code" type="text" id="group_code" class="form-control" value="{{$invoice->group_code}}">
            </div>      
        </div>
            <div class="form-group dropdown">
                <label for="tour_guide_id">Hướng dẫn viên</label>
                <select name="tour_guide_id" id="tour_guide_id" class="form-control">
                    <option value="">Chọn hướng dẫn viên</option>
                    <?php foreach ($tourguides as $tourguide) {?>
                        <option <?php echo $tour_guide_id == $tourguide->id ? 'selected' : '' ?>  value="{{$tourguide->id}}">{{$tourguide->firstname .' '.$tourguide->lastname}} - {{$tourguide->phone}} </option>
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
                            <option value="{{$hotel->id}}" <?php echo $hotel_id == $hotel->id ? 'selected' : '' ?>  >{{$hotel->name}} </option>
                        <?php }?>
                    </select>
                </div> 
            </div>
            <div class ="col-md-6">
                <div class="form-group "><label for="delivery_address">Số phòng</label>
                <input class="form-control" placeholder="Số phòng" name="delivery_address" type="text" id="delivery_address" value="{{$invoice->delivery_address}}"></div>
            </div>
        </div>   


            <div class="form-group "><label for="order_date">Ngày đặt hàng</label>
                <div class='input-group date' id='datetimepicker2'>
                    <input type='text' class="form-control c-form-date datetime-picker" name="order_date" id="order_date" value="{{date('d/m/Y H:i:s', strtotime(str_replace('/', '-', $invoice->order_date)))}}"/>
                    <span class="input-group-addon c-input-addon">
                        <span class="glyphicon glyphicon-calendar c-icon"></span>
                    </span>
                </div>   
            </div>
            <div class="form-group ">
        <label for="order_date">Ngày khách rời</label>
            <div class='input-group date' id='datetimepicker1'>
                <input type='text' class="form-control c-form-date datetime-picker" name="delivery_date" id="delivery_date" value="{{date('d/m/Y', strtotime(str_replace('/', '-', $invoice->delivery_date)))}}"/>
                <span class="input-group-addon c-input-addon">
                    <span class="glyphicon glyphicon-calendar c-icon"></span>
                </span>
            </div>      
        </div>
           
     </div>
    <div class ="col-sm-6">        
        <div class="form-group dropdown">
            <label for="payment_type">Hình thức thanh toán</label>
            <select name="payment_type" id="payment_type" class="form-control">           
                <option {{$invoice->payment_type==='Tiền mặt'?'selected':''}} value="Tiền mặt">Tiền mặt</option>
                <option value="Thẻ" {{$invoice->payment_type==='Thẻ'?'selected':''}}>Thẻ</option>
                <option value="Cả hai" {{$invoice->payment_type==='Cả hai'?'selected':''}}>Cả hai</option>
                <option value="Khác" {{$invoice->payment_type==='Khác'?'selected':''}}>Khác</option>
            </select>
        </div> 
       
        <div class="form-group ">
            <label for="seller">Người bán</label>
            <input placeholder="Người bán" name="seller" type="text" id="seller" class="form-control" value="{{$invoice->seller}}">
         </div>
         {!! Form::normalInput('product', 'Sản phẩm', $errors,$invoice) !!}

         <div class="form-group ">
            <label for="price">Giá</label>
            <!-- <input placeholder="Giá" name="price" type="number"  id="price" step=".01" class="form-control" value ="{{$invoice->price}}"> -->
            <input type="text" class="form-control" name="price" step=".01" data-variavel="price"  value ="{{$invoice->price}}"  >

        </div>
        <div class="form-group ">
            <label for="discount">Giảm giá</label>
            <!-- <input placeholder="Giảm giá" name="discount" type="number" id="discount"  step=".01"  class="input-calc form-control" value ="{{$invoice->discount}}"> -->
            <input type="text" class="form-control" name="discount" data-variavel="discount" value="{{$invoice->discount}}" step=".01">
        </div>
       
        <div class="form-group">
            <label for="amount">Thành tiền</label>
            <!-- <input placeholder="Thành tiền" name="amount" type="text" readonly id="amount"  step=".01"  class="form-control" value="{{$invoice->amount}}"> -->
            <input type="text" class="form-control" name="amount" data-formula="#price# - #discount#" step=".01" value="{{$invoice->amount}}" readonly>
        </div>
    </div>
   
</div>
{!! Form:: normalTextarea('note', 'Ghi chú', $errors,$invoice) !!} 
</div>
