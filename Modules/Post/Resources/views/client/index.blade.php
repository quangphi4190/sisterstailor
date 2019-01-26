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
                    <h1>News </h1>
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
                    <div class="sorting"><h6>List News</h6></div>
                </div>
                <!-- End Filter Bar -->
                <!-- Start Best Seller -->
                <section>
                    <div class="container">
                        <div class="row mt-30">
                            <?php foreach ($news as $new) {

                                ?>
                                <div class="col-lg-12">
                                    <div class="single-search-product d-flex">
                                        @foreach ($new->files()->where('zone','Image')->get() as $file)
                                            <a title="View detail" href="{{ route('slugCategory.detail', [$new->slug]) }}" ><img class="w-img" src="{{$file->path}}" alt=""></a>
                                        @endforeach
                                        <div class="desc">
                                            <a href="{{ route('slugCategory.detail', [$new->slug]) }}" class="title" title="View detail">
                                                <h5>{{$new->name}}</h5>
                                            </a>
                                            <div class="category"> Category: <span><a href="#"><b>{{$new->categoryName}}</b></a></span></div>
                                            <div class="button-group-area">
                                                <a href="{{ route('slugCategory.detail', [$new->slug]) }}" class="genric-btn primary circle arrow">View more<span class="lnr lnr-arrow-right"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                    <div class="page-content col-md-12 col-sm-12 pd-t10">
                        {!! $news->render(); !!}
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
                            <li class="main-nav-list" ><a href="{{route('news.category',[$danhmuc->slug])}}"  ><span class="lnr lnr-arrow-right"></span>{{$danhmuc->name}}<span class="number" style="color:#f41068">({{$total}})</span></a></li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).on('click','.pagination a', function(e){
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            getPosts(page);
        });

        function getPosts(page)
        {
            $.ajax({
                type: "GET",
                url: '?page='+ page
            })
                .success(function(data) {
                    $('body').html(data);
                });
        }

    </script>

@stop