<?php
use Modules\Post\Entities\Managecategorys;
?>
@extends('layouts.master')
@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb mg-b10">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
                <div class="col-first">
                    <h1>{{$getCategory->name}} </h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8 col-md-7">
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting"><h6>{{$getCategory->name}}</h6></div>
                </div>
                <!-- End Filter Bar -->
                <!-- Start Best Seller -->
                <section>
                    <div class="container">

                        <div class="row mt-30">
                            <?php if(sizeof($categorys)>0){ ?>
                            <?php foreach ($categorys as $c) {

                                ?>
                                <div class="col-lg-12">
                                    <div class="single-search-product d-flex">
                                        @foreach ($c->files()->where('zone','Image')->get() as $file)
                                            <a title="View detail" href="{{ route('slugCategory.detail', [$c->slug]) }}" ><img class="w-img" src="{{$file->path}}" alt=""></a>
                                        @endforeach
                                        <div class="desc">
                                            <a href="{{ route('slugCategory.detail', [$c->slug]) }}" class="title" title="View detail">
                                                <h5>{{$c->name}}</h5>
                                            </a>
                                            <div class="category"> Category: <span><a href="#"><b>{{$c->categoryName}}</b></a></span></div>
                                            <div class="button-group-area">
                                                <a href="{{ route('slugCategory.detail', [$c->slug]) }}" class="genric-btn primary circle arrow">View more<span class="lnr lnr-arrow-right"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                            <?php } else {?>
                            <div class="content">
                                <p style="text-algin:center;">Không có tin tức mới</p>
                            </div>
                            <?php }?>
                        </div>
                    </div>


                </section>
                <!-- End Best Seller -->
            </div>
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="sidebar-categories mg-b50">
                    <div class="head category">
                        <a href="javascript:;" >News category</a>
                        <span class="number" style="color:#f41068;margin-left:5%;">
							({{sizeof($danhmuctintucs)}})
						</span></div>
                    <ul class="main-categories">
                        <?php
                        foreach ($danhmuctintucs as $danhmuc){

                            $total = Managecategorys::where('category_id',$danhmuc['id'])->count();
                            ?>
                        <li class="main-nav-list" ><a href="{{route('news.category',[$danhmuc->slug])}}"  class="<?php echo $getCategory->id == $danhmuc['id'] ? 'active-menu':''?>"  ><span class="lnr lnr-arrow-right"></span>{{$danhmuc->name}}<span class="number" style="color:#f41068">({{$total}})</span></a></li>
                        <?php }?>
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