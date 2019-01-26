@extends('layouts.master')
@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
                
                    <h1>Category {{$slug->name}}</h1>
                
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8 col-md-7">
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <a onclick="girdFunction()"class="grid-btn active"><i class="fa fa-th" aria-hidden="true"></i></a>
                    <a class="list-btn" onclick="listFunction()"><i class="fa fa-th-list" aria-hidden="true"></i></a>
                    <!-- <div class="sorting">
                        <form method="post"  >
                            <select name="slug">
                                <option value="{{$defen}}">All Products</option>

                                @foreach ($nameCategory as $n)
                                    <option value="{{$n->slug}}">{{$n->name}}</option>
                                @endforeach
                            </select>
                        </form>
                    </div> -->
                </div>
                <!-- End Filter Bar -->
                <!-- Start Best Seller -->
                <section class="lattest-product-area pb-40 category-list">
                    <div class="container">
                        <div class="row product-defail list-c" hidden>
                            @if ($soluongproducts === 0)
                            <div class="content">
                                <h3 style="text-algin:center;">No Products</h3>
                            </div>
                            @else
                            @foreach ($products as $t)
                                <div class="col-lg-12">
                                    <div class="single-search-product d-flex">
                                        @foreach ($t->files()->where('zone','Hình Ảnh')->get() as $file)
                                            <a title="View detail" href="{{ route('product.detail',[$t->slug])}}" ><img class="img-list" src="{{$file->path}}" alt=""></a>
                                        @endforeach

                                        <div class="price pd-l20">
                                            <a href="{{ route('product.detail',[$t->slug])}}" class="title" title="View detail">
                                                <h5>{{$t->name}}</h5>
                                            </a>
                                            @if ($t->price_discount == '0')
                                                <h3>$ {{$t->price}}</h3>
                                            @else
                                                <div class="d-flex align-items-center pd-t10">
                                                    <h3 class="pd-r10">$ {{$t->price_discount}}</h3>
                                                    <del class="f-size">$ {{$t->price}}</del>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                            @endforeach
                                @endif

                        </div>
                    </div>
                    <div class="container">
                        <div class="row product-defail gird-c">
                            @if ($soluongproducts === 0)
                                <div class="content">
                                    <h3 style="text-algin:center;">No Products</h3>
                                </div>
                            @else
                                @foreach ($products as $t)
                                    <div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
                                        <div class="content">
                                            <a href="{{ route('product.detail', [$t->slug]) }}" title="View detail" >
                                                <div class="content-overlay"></div>
                                                @foreach ($t->files()->where('zone','Hình Ảnh')->get() as $file)
                                                    <img class="content-image img-fluid d-block mx-auto" src="{{$file->path}}" alt="">
                                                @endforeach
                                            </a>
                                        </div>
                                        <div class="price ">
                                            <a href="{{ route('product.detail', [$t->slug]) }}" class="title" title="View detail">
                                                <h5>{{$t->name}}</h5>
                                            </a>
                                            @if ($t->price_discount == '0')
                                                <h3>$ {{$t->price}}</h3>
                                            @else
                                                <div class="d-flex align-items-center">
                                                    <h3 class="pd-r10">$ {{$t->price_discount}}</h3>
                                                    <del class="f-size">$ {{$t->price}}</del>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                            <div class="container">
                                <div class="row">{{$products->links()}}</div>
                            </div>
                    </div>
                </section>
                <!-- End Best Seller -->
            </div>
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="sidebar-categories">
                    <div class="head">Categories</div>
                    <ul class="main-categories">
                    @foreach ($category as $Men)
                    @if ($Men->id == 1)
                        <li class="main-nav-list category-defail"><a href="{{route('products.index',$Men->slug)}}">Men</a>
                    @endif
                    @endforeach   
                            <ul id="fruitsVegetable">
                                <?php $sl = 0;
                                foreach ($nameMen as $m){
                                ?>
                                <li class="main-nav-list"><a href="{{route('products.index',$m->slug)}}" ><span class="lnr lnr-arrow-right"></span>{{$m->name}}</a></li>
                                <?php }?>
                            </ul>
                        </li>
                    @foreach ($category as $Women)                    
                        @if ($Women->id == 2)

                        <li class="main-nav-list category-defail"><a href="{{route('products.index',$Women->slug)}}" >Women</a>
                        @endif
                    @endforeach    
                            <ul id="meatFish">
                                <?php
                                foreach ($nameWomen as $w){
                                
                                ?>
                                <li class="main-nav-list"><a href="{{route('products.index',$w->slug)}}" ><span class="lnr lnr-arrow-right"></span>{{$w->name}}</a></li>
                                <?php }?>
                            </ul>
                        </li>
                        <li class="main-nav-list category-defail"><a href="" aria-expanded="false" aria-controls="cooking" >Other Category</a>
                            <ul id="cooking">
                                <?php
                                foreach ($othercategory as $other){
                                ?>
                                <li class="main-nav-list"><a href="{{route('products.index',$other->slug)}}" ><span class="lnr lnr-arrow-right"></span>{{$other->name}}</a></li>
                                <?php }?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        function listFunction() {
            $(".gird-c").attr("hidden",true);

            $(".grid-btn").removeClass('active');
            $(".list-c").attr("hidden",false);
            $(".list-btn").addClass('active');
        }
        function girdFunction() {
            $(".gird-c").attr("hidden",false);

            $(".grid-btn").addClass('active');
            $(".list-c").attr("hidden",true);
            $(".list-btn").removeClass("active");
        }

    </script>

@stop