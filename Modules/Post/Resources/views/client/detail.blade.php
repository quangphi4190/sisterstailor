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
                    <h1>{{$new_detail->categoryName}} </h1>
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
                    <div class="sorting"><a href="{{route('news.category',[$new_detail->SlugCategory])}}" alt='' title="<?php echo $new_detail->categoryName ?>"><h6>{{$new_detail->categoryName}}</h6></a></div>
                </div>
                <!-- End Filter Bar -->
                <!-- Start Best Seller -->
                <section>
                    <div class="container">
                        <div class="row mt-30">
                            <div class="desc mg-b50">
                               <h5>{{$new_detail->name}}</h5>
                                <div>
                                    <?php echo $new_detail->description ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
                <!-- End Best Seller -->
                <?php if(sizeof($listCategorys)>0){?>
                    <div class="billing-form mg-b50">
                        <div class="row">
                            <div class="col-12">
                                <div class="order-wrapper mt-50">
                                    <h3 class="billing-title mb-10">News with categories</h3>
                                    <div class="order-list">
                                        <?php foreach ($listCategorys as $list){?>
                                            <div class="d-flex justify-content-between">
                                                <a href="{{ route('slugCategory.detail', [$list->slug]) }}" title="{{$list->name}}" class="circle arrow"><span class="lnr lnr-arrow-right"></span> {{$list->name}}</a>
                                            </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>
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
                        <li class="main-nav-list"><a href="{{route('news.category',[$danhmuc->slug,$danhmuc->slug])}}" alt="_blank" class="<?php echo $new_detail->IdCategory == $danhmuc['id'] ? 'active-menu':''?>" ><span class="lnr lnr-arrow-right"></span>{{$danhmuc->name}}<span class="number" style="color:#f41068">({{$total}})</span></a></li>
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