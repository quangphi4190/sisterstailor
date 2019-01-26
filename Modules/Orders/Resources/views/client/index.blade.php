@extends('layouts.master')
@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
                <div class="col-first">
                    <h1>Shopping Cart</h1>
                    <nav class="d-flex align-items-center justify-content-start">
                        <a href="{{ url('/') }}">Home<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                        <a href="{{url('/orders')}}">Shopping Cart</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <div class="container c-body-container">
        <div class="cart-title">
            <div class="row">
                <div class="col-md-2">
                    <h6 class="ml-15">Image</h6>
                </div>
                <div class="col-md-4">
                    <h6 class="">Product</h6>
                </div>
                <div class="col-md-2">
                    <h6>Price</h6>
                </div>
                <div class="col-md-2">
                    <h6>Quantity</h6>
                </div>
                <div class="col-md-2">
                    <h6>Total</h6>
                </div>
            </div>
        </div>
        @foreach($data as $key=>$value)
            <div class="cart-single-item product-{{$key}}">
                <div class="row align-items-center">
                    <div class="col-md-6 col-12">
                        <div class="product-item d-flex align-items-center">
                            <img src="{{ url($value->image->path) }}" class="img-fluid" alt="">
                            <h6>{{$value->name}}</h6>
                        </div>
                    </div>
                    <div class="col-md-2 col-6">
                        <div class="price">${{$value->price}}</div>
                        <input type="hidden" name="price" value="{{$value->price}}"/>
                    </div>
                    <div class="col-md-2 col-6">
                        <div class="quantity-container d-flex align-items-center mt-15">
                            <input type="text" class="quantity-amount qty-change" data-id="{{$key}}"
                                   value="{{$value->quantity}}"/>
                            <div class="arrow-btn d-inline-flex flex-column">
                                <button class="increase arrow" type="button" title="Increase Quantity"><span
                                            class="lnr lnr-chevron-up"></span></button>
                                <button class="decrease arrow" type="button" title="Decrease Quantity"><span
                                            class="lnr lnr-chevron-down"></span></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-12">
                        <div class="total">$<span class="total-{{$key}}">{{$value->total}}</span></div>
                    </div>
                </div>
            </div>
        @endforeach
        <hr>
        <div class="subtotal-area d-flex align-items-center justify-content-end">
            <div class="title text-uppercase">TOTAL</div>
            <div class="subtotal">$ <span>{{$total}}</span></div>
        </div>
        <div class="shipping-area d-flex justify-content-end">
            <a href="{{route('order.checkout')}}" class="view-btn color-2 mt-10" style="background: #dc3545!important;"><span
                        style="color:#fff!important">Orders</span></a>
        </div>
    </div>
    </div>
@stop
@push('js')
    <script>
        $(document).ready(function () {
            $('.quantity-amount').on('change', function () {
                let id = $(this).data('id');
                let quantity = $(this).val();
                if (quantity == 0) {
                    if (!confirm('Are you sure delete this product in cart?')) {
                        $(this).val(1);
                        return;
                    }
                }
                $.get('{{route('order.update_cart')}}?product=' + id + '&quantity=' + quantity, function (data) {
                    if (data.deleted) {
                        $('.product-' + id).remove();
                    } else {
                        $('.subtotal span').text(data.subtotal);
                        $('.total-' + id).text(data.price);
                        $('.badgeNumber_ebbk').text(data.total);
                    }
                }, 'json');

            });
        });
    </script>
@endpush