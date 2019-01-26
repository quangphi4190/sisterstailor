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
    <div class="container">
        <form action="{{route('order.confirm')}}" method="post" class="billing-form">
            {{csrf_field()}}
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <h3 class="billing-title mt-20 mb-10">Order Details</h3>
                    <div class="row">
                        <div class="col-lg-12">
                            <input name="name" type="text" placeholder="Full Name" onfocus="this.placeholder=''"
                                   onblur="this.placeholder = 'Full Name'" required class="common-input">
                        </div>
                        <div class="col-lg-6">
                            <input name="sdt" type="text" placeholder="Phone number*" onfocus="this.placeholder=''"
                                   onblur="this.placeholder = 'Phone number*'" required class="common-input">
                        </div>
                        <div  class="col-lg-6">
                            <input name="email" type="email" placeholder="Email Address*" onfocus="this.placeholder=''"
                                   onblur="this.placeholder = 'Email Address*'" required class="common-input">
                        </div>
                        <div class="col-lg-12">
                            <input name="address"  type="text" placeholder="Address" onfocus="this.placeholder=''"
                                   onblur="this.placeholder = 'Address'" required class="common-input">
                        </div>
                        <div class="col-lg-12">
                        <textarea name="notes" placeholder="Order Notes" onfocus="this.placeholder=''"
                                  onblur="this.placeholder = 'Order Notes'" required class="common-textarea"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="order-wrapper mt-50">
                        <h3 class="billing-title mb-10">Your Order</h3>
                        <div class="order-list">
                            <div class="list-row d-flex justify-content-between">
                                <div>Product</div>
                                <div>Total</div>
                            </div>
                            @foreach($data as $key=>$value)
                            <div class="list-row d-flex justify-content-between">
                                <div class="cl-1">{{$value->name}}</div>
                                <div class="cl-2">x{{$value->quantity}}</div>
                                <div class="cl-3">${{$value->total}}</div>
                            </div>
                            @endforeach
                            <div class="list-row d-flex justify-content-between">
                                <h6>Total</h6>
                                <div class="total">${{$total}}</div>
                                <input type="hidden" name="total" value="{{$total}}">
                            </div>
                            <button type="submit" class="view-btn color-2 w-100 mt-20"><span>Proceed to Checkout</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div style="height: 75px"></div>
@stop
