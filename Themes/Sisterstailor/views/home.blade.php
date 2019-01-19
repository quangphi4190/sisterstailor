@extends('layouts.master')
@section('content')
<section class="banner-area relative" id="home">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    @foreach ($banner as $banne)
        <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" class="{{$loop->first ? 'active':''}}"></li>
    @endforeach
    </ol>
    <div class="carousel-inner">
    @foreach ($banner as $banne)
        <div class="carousel-item {{$loop->first ? 'active':''}}">
        @foreach ($banne->files()->where('zone','Image_baner')->get() as $file)
            <img class="d-block w-100" src="{{$file->path}}" alt="First slide">
            @endforeach
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>
</section>
    <!-- End banner Area -->

    <!-- Start category Area -->
    <section class="category-area section-gap section-gap" id="catagory">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-40">
                    <div class="title text-center">
                        <h1 class="mb-10">Featured Products</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($featured as $fea)
                <div class="col-lg-3 col-md-6 single-product">
                    <div class="content">
                        <div class="content-overlay"></div>
                        @foreach ($fea->files()->where('zone','Hình Ảnh')->get() as $files)
                            <img class="content-image img-fluid d-block mx-auto" src="{{$files->path}}" alt="">
                        @endforeach
                        <div class="content-details fadeIn-bottom">
                            <div class="bottom d-flex align-items-center justify-content-center">
                                <a href="{{route('product.detail',$fea->slug)}}"><span class="lnr lnr-layers"></span></a>
                                <a href="#" onclick="addCart(2)"><span class="lnr lnr-cart"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="price">
                        <h5><a class="name-products" href="{{route('product.detail',$fea->slug)}}" >{{$fea->name}}</a></h5>
                        @if ($fea->price_discount == '0')
                            <h3>{{number_format($fea->price)}}</h3>
                        @else
                            <del style="color:black;">$ {{number_format($fea->price)}}</del>
                            <h3>$ {{number_format($fea->price_discount)}}</h3>
                        @endif
                    </div>
                </div>
                    @endforeach
            </div>
        </div>
    </section>
    <!-- End category Area -->

    <!-- Start men-product Area -->
    <section class="men-product-area section-gap relative" id="men">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-40">
                    <div class="title text-center">
                        <h1 class="text-white mb-10">New realeased Products for Men</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($men as $m)
                    @if ($m->status == '1')
                <div class="col-lg-3 col-md-6 single-product">
                    <div class="content">
                        <div class="content-overlay"></div>
                        @foreach ($m->files()->where('zone','Image')->get() as $filemen)
                            <img class="content-image img-fluid d-block mx-auto xx" src="{{$filemen->path}}" alt="">
                        @endforeach
                        <div class="content-details fadeIn-bottom">
                            <div class="bottom d-flex align-items-center justify-content-center">
                                <!-- <a href="#"><span class="lnr lnr-heart"></span></a> -->
                                <a href="{{ route('product.detail', [$m->slug]) }}"><span class="lnr lnr-layers"></span></a>
                                <a href="#" onclick="addCart(2)" ><span class="lnr lnr-cart"></span></a>
                                <!-- <a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a> -->
                            </div>
                        </div>
                    </div>
                    <div class="price">
                        <h5 class="text-white"><a style="color: white" href="{{route('product.detail',$m->slug)}}">{{$m->name}}</a></h5>
                        @if ($m->price_discount == '0')
                        <h3 class="text-white">$ {{number_format($m->price)}}</h3>
                        @else
                            <del class="text-white">$ {{number_format($m->price)}}</del>
                            <h3 class="text-white">$ {{number_format($m->price_discount)}}</h3>
                            @endif
                    </div>
                </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- End men-product Area -->

    <!-- Start women-product Area -->
    <section class="women-product-area section-gap" id="women">
        <div class="container">
            <div class="countdown-content pb-40">
                <div class="title text-center">
                    <h1 class="mb-10">New realeased Products for Women</h1>
                </div>
            </div>
            <div class="row">
                @foreach ($women as $w)
                    @if ($w->status == '1')
                <div class="col-lg-3 col-md-6 single-product">
                    <div class="content">
                        <div class="content-overlay"></div>
                        @foreach ($w->files()->where('zone','Image')->get() as $filewomen)
                            <img class="content-image img-fluid d-block mx-auto" src="{{$filewomen->path}}" alt="">
                        @endforeach
                        <div class="content-details fadeIn-bottom">
                            <div class="bottom d-flex align-items-center justify-content-center">
                                <a href="{{route('product.detail', [$w->slug])}}"><span class="lnr lnr-layers"></span></a>
                                <a href="#" onclick="addCart(2)"><span class="lnr lnr-cart"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="price">
                        <h5><a class="name-products" href="{{route('product.detail',$w->slug)}}">{{$w->name}}</a></h5>
                        @if ($w->price_discount == '0')
                        <h3>{{number_format($w->price)}}</h3>
                            @else
                            <del style="color:black;">$ {{number_format($w->price)}}</del>
                            <h3>$ {{number_format($w->price_discount)}}</h3>
                            @endif
                    </div>
                </div>
                    @endif
                    @endforeach
            </div>
        </div>
    </section>
    <!-- End women-product Area -->

    <!-- Start Count Down Area -->
    <!-- End Count Down Area -->

    <!-- Start related-product Area -->

<script>
function addCart($cartId) {
    var cartID =$cartId;
    $.ajax({
        type: "POST",
        url: '{{route('admin.page.page.addCart')}}',
        data: {
            _token: '{{ csrf_token() }}',
            cartID: cartID,            
                 
        },
        success: function(data) {          
            let numberCart =1;    
            $('.badgeNumber_ebbk').html(numberCart);
        },
        error: function () {
           
        }
    });
   
}
</script>
@stop