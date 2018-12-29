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
<?php $img = $product_detail->files()->where('zone','Image')->first();?>
<?php $img_other = $product_detail->files()->where('zone','Image_Other')->first();?>
<!-- Container for the image gallery -->
<div class="container mr-b60">
    <div class="product-quick-view">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <!-- Full-width images with number text -->
                <?php if($img){?>
                <div class="mySlides">
                    <div class="numbertext">1 / 2</div>
                    <img src="{!! $img->path !!}" style="width:100%">
                </div>
                <?php }?>
                <?php if($img_other){?>
                <div class="mySlides">
                    <div class="numbertext">2 / 2</div>
                    <img src="{!! $img_other->path !!}" style="width:100%">
                </div>
                <?php }?>

                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
                <div class="caption-container">
                    <p id="caption"></p>
                </div>
                <?php if($img){?>
                <div class="column">
                    <img class="demo cursor" src="{!! $img->path !!}" style="width:100%;height: 120px" onclick="currentSlide(1)" alt="{{$product_detail->name}}">
                </div>
                <?php } ?>
                <?php if($img_other){?>
                <div class="column">
                    <img class="demo cursor" src="{!! $img_other->path !!}" style="width:100%;height: 120px" onclick="currentSlide(2)" alt="{{$product_detail->name}}">
                </div>
                <?php }?>
            </div>
            <div class="col-lg-6 mg-t20">
                <div class="quick-view-content">
                    <div class="top">
                        <h3 class="head">{{$product_detail->name}}</h3>
                        <div class="price d-flex align-items-center"><span class="lnr lnr-tag"></span> <span class="ml-10">${{$product_detail->price}}</span></div>
                        <div class="category">Category: <span>{{$product_detail->categoryName}}</span></div>
                    <!-- <div class="available">Availibility: <span>In Stock</span></div> -->
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
    <hr>
    <section class="pb-100">
        <div class="container">
            <div class="organic-section-title text-center">
                <h3>Most Searched Products</h3>
            </div>
            <div class="row mt-30">
                @foreach ($category_for_ids as $category_for_id)
                <div class="col-lg-3 col-md-4 col-sm-6">

                        <div class="single-search-product d-flex">
                            @foreach ($category_for_id->files()->where('zone','Image')->get() as $fileID)
                                <a href="{{ route('product.detail', [$category_for_id->id]) }}"><img class="h80" src="{!! $fileID->path !!}" alt=""></a>
                            @endforeach
                            <div class="desc">
                                <a href="{{ route('product.detail', [$category_for_id->id]) }}" class="title">{{$category_for_id->name}}</a>
                                <div class="price"><span class="lnr lnr-tag"></span> ${{$category_for_id->price}}</div>
                            </div>
                        </div>


                </div>
                @endforeach
            </div>
        </div>
    </section>


</div>
    

<script>
    var slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        var captionText = document.getElementById("caption");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        captionText.innerHTML = dots[slideIndex-1].alt;
    }</script>
@stop