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
    {!! Form::open(['route' => ['order.add-orders'], 'method' => 'post']) !!}
    <div class="container">
                <div class="cart-title">
                    <div class="row">
                        <div class="col-md-2">
                            <h6 class="ml-15" >Image</h6>
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
                <div class="cart-single-item">
                    <div class="row align-items-center">
                        <div class="col-md-6 col-12">
                            <div class="product-item d-flex align-items-center">
                                <img src="{{ url('assets/media/ci1.jpg') }}"  class="img-fluid" alt="">
                                <h6>Pixelstore fresh Blackberry</h6>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="price" >$360.00</div>
                            <input type="hidden" name="price" value="$360.00" />
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="quantity-container d-flex align-items-center mt-15">
                                <input type="text" class="quantity-amount" name ="quantity[]" value="1" />
                                <div class="arrow-btn d-inline-flex flex-column">
                                    <button class="increase arrow" type="button" title="Increase Quantity"><span class="lnr lnr-chevron-up"></span></button>
                                    <button class="decrease arrow" type="button" title="Decrease Quantity"><span class="lnr lnr-chevron-down"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="total">$720.00</div>
                        </div>
                    </div>
                </div>
                <div class="cart-single-item">
                    <div class="row align-items-center">
                        <div class="col-md-6 col-12">
                            <div class="product-item d-flex align-items-center">
                                <img src="{{ url('assets/media/ci2.jpg') }}" class="img-fluid" alt="">
                                <h6>Pixelstore fresh Blackberry</h6>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="price">$360.00</div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="quantity-container d-flex align-items-center mt-15">
                                <input type="text" class="quantity-amount" name ="quantity[]" value="1" />
                                <div class="arrow-btn d-inline-flex flex-column">
                                    <button class="increase arrow" type="button" title="Increase Quantity"><span class="lnr lnr-chevron-up "></span></button>
                                    <button class="decrease arrow" type="button" title="Decrease Quantity"><span class="lnr lnr-chevron-down"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="total">$720.00</div>
                        </div>
                    </div>
                </div>
                <div class="cart-single-item">
                    <div class="row align-items-center">
                        <div class="col-md-6 col-12">
                            <div class="product-item d-flex align-items-center">
                                <img src="{{ url('assets/media/ci3.jpg') }}" class="img-fluid" alt="">
                                <h6>Pixelstore fresh Blackberry</h6>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="price">$360.00</div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="quantity-container d-flex align-items-center mt-15">
                                <input type="number" class="quantity-amount" value="1" />
                                
                                <div class="arrow-btn d-inline-flex flex-column">
                                    <button class="increase arrow" type="button" title="Increase Quantity"><span id="lnr-chevron-up" class="lnr lnr-chevron-up"></span></button>
                                    <button class="decrease arrow" type="button" title="Decrease Quantity"><span class="lnr lnr-chevron-down"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="total">$720.00</div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="subtotal-area d-flex align-items-center justify-content-end">
                    <div class="title text-uppercase">Subtotal</div>
                    <div class="subtotal">$2160.00</div>
                </div>
                <div class="shipping-area d-flex justify-content-end">
                     <button class="view-btn color-2 mt-10" style="background: #dc3545!important;"><span style="color:#fff!important">Orders</span></button>
                </div>
            </div>
        {!! Form::close() !!}
    @stop

@push('js-stack')
<script type="text/javascript">  
     

   
 </script>
 @endpush