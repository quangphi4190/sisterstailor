<!-- <link rel="stylesheet" href="{{asset('themes/sisterstailor/css/owl.carousel.css')}}"> -->
@extends('layouts.master')
@section('content')

<section class="banner-area organic-breadcrumb">
                <div class="container">
                    <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
                        <div class="col-first">
                            <h1>Product details</h1>
                             <nav class="d-flex align-items-center justify-content-start">
                                <a href="index.html">Home<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                <a href="single.html">Product details</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
    <!-- End banner Area -->

    <!-- Start category Area -->
    <div class="container">
            <div class="product-quick-view">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="quick-view-carousel-details">
                                    <div class="item" style="background: url({!! asset('themes/images/q1.jpg') !!})">

                                    </div>
                                    <div class="item" style="background: url({!! asset('themes/images/q1.jpg') !!})">

                                    </div>
                                    <div class="item" style="background: url({!! asset('themes/images/q1.jpg') !!})">

                                    </div>
                               </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="quick-view-content">
                                <div class="top">
                                    <h3 class="head">Faded SkyBlu Denim Jeans</h3>
                                    <div class="price d-flex align-items-center"><span class="lnr lnr-tag"></span> <span class="ml-10">$149.99</span></div>
                                    <div class="category">Category: <span>Household</span></div>
                                    <div class="available">Availibility: <span>In Stock</span></div>
                                </div>
                                <div class="middle">
                                    <p class="content">Mill Oil is an innovative oil filled radiator with the most modern technology. If you are looking for something that can make your interior look awesome, and at the same time give you the pleasant warm feeling during the winter.</p>
                                </div>
                                <div >
                                    <div class="quantity-container d-flex align-items-center mt-15">
                                        Quantity:
                                        <input type="text" class="quantity-amount ml-15" value="1" />
                                        <div class="arrow-btn d-inline-flex flex-column">
                                            <button class="increase arrow" type="button" title="Increase Quantity"><span class="lnr lnr-chevron-up"></span></button>
                                            <button class="decrease arrow" type="button" title="Decrease Quantity"><span class="lnr lnr-chevron-down"></span></button>
                                        </div>

                                    </div>
                                    <div class="d-flex mt-20">
                                        <a href="#" class="view-btn color-2"><span>Add to Cart</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
             </div>
    </div>
    


@stop