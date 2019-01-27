<!-- <link rel="stylesheet" href="{{asset('themes/sisterstailor/css/owl.carousel.css')}}"> -->
@extends('layouts.master')
@section('content')

    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
                <h1>{{$product_detail->name}}</h1>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start category Area -->
    <?php $img = $product_detail->files()->where('zone', 'Hình Ảnh')->first();?>
    <?php $img_other = $product_detail->files()->where('zone', 'Hình Ảnh Khác')->first();?>
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
                        <img class="demo cursor" src="{!! $img->path !!}" style="width:100%;height: 120px"
                             onclick="currentSlide(1)" alt="{{$product_detail->name}}">
                    </div>
                    <?php } ?>
                    <?php if($img_other){?>
                    <div class="column">
                        <img class="demo cursor" src="{!! $img_other->path !!}" style="width:100%;height: 120px"
                             onclick="currentSlide(2)" alt="{{$product_detail->name}}">
                    </div>
                    <?php }?>
                </div>
                <div class="col-lg-6 mg-t20">

                    <div class="quick-view-content">
                        <div class="top">
                            <h3 class="head">{{$product_detail->name}}</h3>
                            @if ($product_detail->price_discount > '0')
                                <div class="price d-flex align-items-center">
                                    <span class="lnr lnr-tag"></span>
                                    <span class="ml-10">${{number_format($product_detail->price_discount,2,",",".")}}</span>
                                    <del style="margin-left: 0.5em">
                                        ${{number_format($product_detail->price,2,",",".")}}</del>
                                </div>
                            @else
                                <div class="price d-flex align-items-center">
                                    <span class="lnr lnr-tag"></span>
                                    <span class="ml-10">${{$product_detail->price}}</span>
                                </div>
                            @endif

                            @if ($product_detail->category_id != null)
                                <div class="category">Category: <span><a
                                                href="{{route('products.index',$categoryProducts->slug)}}">{{$product_detail->categoryName}}</a></span>
                                </div>
                            @else
                                <div class="category">Category: <span></span>
                                </div>
                            @endif

                            <div class="middle">
                                <p class="content"><?php echo $product_detail->intro;?></p>
                            </div>
                            <div>
                                <div class="quantity-container d-flex align-items-center mt-15">
                                    Quantity:
                                    <input type="text" id="quantity" class="quantity-amount ml-15" value="1"/>
                                    <div class="arrow-btn d-inline-flex flex-column">
                                        <button class="increase arrow" type="button" title="Increase Quantity"><span
                                                    class="lnr lnr-chevron-up"></span></button>
                                        <button class="decrease arrow" type="button" title="Decrease Quantity"><span
                                                    class="lnr lnr-chevron-down"></span></button>
                                    </div>
                                </div>
                                <div class="d-flex mt-20">
                                    <button type="button" id="btn-add-cart" class="view-btn color-2">
                                        <span>Add to Cart</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <hr>
                <section class="pb-100">
                    <div class="container">
                        <div class="organic-section-title text-center">
                            <h3>Related Products</h3>
                        </div>
                        <div class="row mt-30">
                            @foreach ($category_for_ids as $category_for_id)
                                <div class="col-lg-3 col-md-4 col-sm-6">

                                    <div class="single-search-product d-flex">
                                        @foreach ($category_for_id->files()->where('zone','Hình Ảnh')->get() as $fileID)
                                            <a href="{{ route('product.detail', [$category_for_id->slug]) }}"><img
                                                        class="h80"
                                                        title="View detail"
                                                        src="{!! $fileID->path !!}"
                                                        alt=""></a>
                                        @endforeach
                                        <div class="desc">
                                            <a href="{{ route('product.detail', [$category_for_id->slug]) }}"
                                               class="title"
                                               title="View detail">{{$category_for_id->name}}</a>
                                            <div class="price"><span class="lnr lnr-tag"></span>
                                                ${{$category_for_id->price}}
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>


            </div>

        </div>
    </div>

    <script type="text/javascript">
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
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            captionText.innerHTML = dots[slideIndex - 1].alt;
        }
    </script>

@stop
@push('js')
    <script>
        $('#btn-add-cart').on('click', function () {
            var quantity = $('#quantity').val();
            $.get('{{route('order.add_cart')}}' + '?product={{$product_detail->id}}&quantity=' + quantity, function (data) {
                if (data.success) {
                    swal("Add to cart successfully!", "", "success");
                    $('.badgeNumber_ebbk').text(data.total);
                } else {
                    swal("Add to cart failed. Please try again!", "", "error");
                }
            }, 'json')
        });
    </script>
@endpush