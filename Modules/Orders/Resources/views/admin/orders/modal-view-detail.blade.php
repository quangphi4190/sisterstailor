<div class="box-body">
        <div class="row p-t10">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-lg-3">Họ và tên:</div>
                    <div class="col-lg-9 order-db">{{$order->name}}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3">Điện thoại:</div>
                    <div class="col-lg-9 order-db">{{$order->sdt}}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3">Email:</div>
                    <div class="col-lg-9 order-db">{{$order->email}}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-lg-4">Địa chỉ:</div>
                    <div class="col-lg-8 order-db">{{$order->address}}</div>
                </div>
                <div class="row">
                    <div class="col-lg-4">Tổng tiền:</div>
                    <div class="col-lg-8 order-db">${{$order->total}}</div>
                </div>
                <div class="row">
                    <div class="col-lg-4">Ngày đặt hàng:</div>
                    <div class="col-lg-8 order-db">{{ date('d/m/Y', strtotime(str_replace('/', '-', $order->created_at)))}}</div>
                </div>
            </div>
        </div>


    <div class="billing-order">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $stt=1;
                foreach ($order_defails as $defail) {?>
                <tr>
                    <td>{{$stt++}}</td>
                    <td>{{$defail->nameProduct}}</td>
                    <td>{{$defail->quantity}}</td>
                    <td>${{$defail->price}}</td>
                </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>

</div>

