@extends('layouts.master')
@section('content')
	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center">
				<div class="col-first">
					<h1>Shop Fashion {{$slug->name}}</h1>
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
					<a onclick="girdFunction()"class="grid-btn active"><i class="fa fa-th" aria-hidden="true"></i></a>
					<a class="list-btn" onclick="listFunction()"><i class="fa fa-th-list" aria-hidden="true"></i></a>
					<div class="sorting">
					<form method="post"  >
						<select name="slug">
							<option value="{{$defen}}">All Products</option>

						@foreach ($nameCategory as $n)
							<option value="{{$n->slug}}">{{$n->name}}</option>
							@endforeach
						</select>
					</form>
					</div>
				</div>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<section class="lattest-product-area pb-40 category-list">
				<div class="container">
					<div id="products" class="row product-defail">
					@if ($soluongproducts == 0 && $soluongproduct_detail == 0)
					<div class="content">
						<h3 style="text-algin:center;">Không có sản phẩm nào</h3>
					</div>
						@elseif ($soluongproducts == 0)
					@foreach ($product_detail as $p)
						@if ($p->status == '1')
						<div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
							<div class="content">
								<div class="content-overlay"></div>
								@foreach ($p->files()->where('zone','Image')->get() as $file)
									<img class="content-image img-fluid d-block mx-auto" src="{{$file->path}}" alt="">
									@endforeach
								<div class="content-details fadeIn-bottom">
									<div class="bottom d-flex align-items-center justify-content-center">
										<a href="{{route('product.detail',[$p->slug])}}"><span class="lnr lnr-layers"></span></a>
										<a href="#" onclick="addCart(2)"><span class="lnr lnr-cart"></span></a>
					<div class="container">
						<div class="row product-defail list-c" hidden>
							@foreach ($products as $t)
								<div class="col-lg-12">
									<div class="single-search-product d-flex">
										@foreach ($t->files()->where('zone','Image')->get() as $file)
											<a title="View detail" href="{{ route('product.detail', [$t->slug]) }}" ><img class="img-list" src="{{$file->path}}" alt=""></a>
										@endforeach

										<div class="price pd-l20">
											<a href="{{ route('product.detail', [$t->slug]) }}" class="title" title="View detail">
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

						</div>
					</div>
				<div class="container">
					<div class="row product-defail gird-c">
					@if (sizeof($products) < 0 )
						<div class="content">
							<h3 style="text-algin:center;">Không có sản phẩm nào</h3>
						</div>
					@else
						@foreach ($products as $t)
							@if ($t->status == '1')
						<div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
							<div class="content">
								<div class="content-overlay"></div>
								@foreach ($t->files()->where('zone','Image')->get() as $file)
									<img class="content-image img-fluid d-block mx-auto" src="{{$file->path}}" alt="">
									@endforeach
								<div class="content-details fadeIn-bottom">
									<div class="bottom d-flex align-items-center justify-content-center">
										<a href="{{route('product.detail',[$t->slug])}}"><span class="lnr lnr-layers"></span></a>
										<a href="#" onclick="addCart(2)"><span class="lnr lnr-cart"></span></a>
									</div>

							<div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
								<div class="content">
									<a href="{{ route('product.detail', [$t->slug]) }}" title="View detail" >
										<div class="content-overlay"></div>
										@foreach ($t->files()->where('zone','Image')->get() as $file)
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

				@if ($soluongproducts == 0)
					<div class="container">
						<div class="row">{{$product_detail->links()}}</div>
					</div>
				@else
					<div class="container">
						<div class="row">{{$products->links()}}</div>
					</div>
				@endif
				</div>
				</section>
				<!-- End Best Seller -->
			</div>
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head">Categories</div>
					<ul class="main-categories">
						<li class="main-nav-list"><a data-toggle="collapse" href="#fruitsVegetable" aria-expanded="false" aria-controls="fruitsVegetable"><span class="lnr lnr-arrow-right"></span>Men<span class="number">{{$soluongMen}}</span></a>
							<ul class="collapse" id="fruitsVegetable" data-toggle="collapse" aria-expanded="false" aria-controls="fruitsVegetable">
                                <?php $sl = 0;
                                foreach ($nameMen as $m){
                                $tong =0;
                                for ($i=0;$i<=$soluongMen;$i++){
                                    if (isset($productsWomen[$i])){
                                        if ($m->id == $productsMen[$i]['category_id']){
                                            $tong++;
                                        }
                                    }
                                }
                                ?>
								<li class="main-nav-list"><a href="{{route('products.index',[$m->slug])}}" alt="_blank" ><span class="lnr lnr-arrow-right"></span>{{$m->name}}<span class="number" style="color:#f41068">({{$tong}})</span></a></li>
                                <?php }?>
							</ul>
						</li>

						<li class="main-nav-list"><a data-toggle="collapse" href="#meatFish" aria-expanded="false" aria-controls="meatFish"><span class="lnr lnr-arrow-right"></span>Women<span class="number">{{$soluongWomen}}</span></a>
							<ul class="collapse" id="meatFish" data-toggle="collapse" aria-expanded="false" aria-controls="meatFish">
                                <?php
                                foreach ($nameWomen as $w){
                                $tong =0;
                                for ($i=0;$i<$soluongWomen;$i++){
                                    if (isset($productsWomen[$i])){
                                        if ($w->id == $productsWomen[$i]['category_id']){
                                            $tong++;
                                        }
                                    }
                                }
                                ?>
								<li class="main-nav-list"><a href="{{route('products.index',[$w->slug])}}" alt="_blank" ><span class="lnr lnr-arrow-right"></span>{{$w->name}}<span class="number" style="color:#f41068">({{$tong}})</span></a></li>
                                <?php }?>
							</ul>
						</li>
						<li class="main-nav-list"><a data-toggle="collapse" href="#cooking" aria-expanded="false" aria-controls="cooking"><span class="lnr lnr-arrow-right"></span>Other Category<span class="number">{{$soluongproductsother}}</span></a>
							<ul class="collapse" id="cooking" data-toggle="collapse" aria-expanded="false" aria-controls="cooking">
                                <?php
                                foreach ($othercategory as $other){
                                $tong =0;
                                for ($i=0;$i<$soluongproductsother;$i++){
                                    if (isset($productother[$i])){
                                        if ($other->id == $productother[$i]['category_id']){
                                            $tong++;
                                        }
                                    }
                                }
                                ?>
								<li class="main-nav-list"><a href="{{route('products.index',[$other->slug])}}" alt="_blank" ><span class="lnr lnr-arrow-right"></span>{{$other->name}}<span class="number" style="color:#f41068">({{$tong}})</span></a></li>
                                <?php }?>
							</ul>
						</li>
					<div class="head category"><a href="<?php echo $category['0']['id'] == 1 ? route('products.index',$category['0']['slug']):'' ?>" >Men</a><span class="number" style="color:#f41068;margin-left:5%;">({{$soluongMen}})</span></div>
					<ul class="main-categories">
					<?php $sl = 0;
						foreach ($nameMen as $m){
							$tong =0;
							for ($i=0;$i<=$soluongMen;$i++){
								if (isset($productsWomen[$i])){
									if ($m->id == $productsMen[$i]['category_id']){
										$tong++;
									}
								}
							}
							?>

						<li class="main-nav-list"><a href="{{route('products.index',[$m->slug])}}" alt="_blank" ><span class="lnr lnr-arrow-right"></span>{{$m->name}}<span class="number" style="color:#f41068">({{$tong}})</span></a></li>
						<?php }?>
					</ul>
				</div>
				<div class="sidebar-categories">
					<div class="head category">
						<a href="<?php echo $category['1']['id'] == 2 ? route('products.index',$category['1']['slug']):'' ?>" >WoMen</a>
						<span class="number" style="color:#f41068;margin-left:5%;">
							({{$soluongWomen}})
						</span></div>
					<ul class="main-categories">
					<?php
						foreach ($nameWomen as $w){
							$tong =0;
							for ($i=0;$i<=$soluongWomen;$i++){
								if (isset($productsWomen[$i])){
									if ($w->id == $productsWomen[$i]['category_id']){
										$tong++;
									}
								}

							}
							?>


						<li class="main-nav-list"><a href="{{route('products.index',[$w->slug])}}" alt="_blank" ><span class="lnr lnr-arrow-right"></span>{{$w->name}}<span class="number" style="color:#f41068">({{$tong}})</span></a></li>
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