@extends('layouts.master')
@section('content')
	<!-- End Header Area -->

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center">
				<div class="col-first">
					<h1>Shop Category page</h1>
					<nav class="d-flex align-items-center justify-content-start">
						<a href="{{route('homepage')}}">Home<i class="fa fa-caret-right" aria-hidden="true"></i></a>
						<a href="#">Fashon Category</a>
					</nav>
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
					<a href="#" class="grid-btn active"><i class="fa fa-th" aria-hidden="true"></i></a>
					<a href="#" class="list-btn"><i class="fa fa-th-list" aria-hidden="true"></i></a>
					<div class="sorting">
						<select>
						@foreach ($nameCategory as $n)
							<option value="{{$n->slug}}">{{$n->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="sorting mr-auto">
						<select>
							<option value="6">Show 6</option>
							<option value="12">Show 12</option>
							<option value="18">Show 18</option>
						</select>
					</div>
				</div>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
					@if ($soluongproducts == 0 && $soluongproduct_detail == 0)
					<div class="content">
						<h3 style="text-algin:center;">Không có sản phẩm nào</h3>
					</div>
						@elseif ($soluongproducts == 0)
					@foreach ($product_detail as $p)
						<div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
							<div class="content">
								<div class="content-overlay"></div>
								@foreach ($p->files()->where('zone','Image')->get() as $file)
									<img class="content-image img-fluid d-block mx-auto" src="{{$file->path}}" alt="">
									@endforeach
								<div class="content-details fadeIn-bottom">
									<div class="bottom d-flex align-items-center justify-content-center">
										<a href="#"><span class="lnr lnr-heart"></span></a>
										<a href="#"><span class="lnr lnr-layers"></span></a>
										<a href="#"><span class="lnr lnr-cart"></span></a>
										<a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
									</div>
								</div>
							</div>
							<div class="price">
								<h5>{{$p->name}}</h5>
								@if ($p->price_discount == '0')
									<h3>$ {{$p->price}}</h3>
								@else
									<del>$ {{$p->price_discount}}</del>
									<h3>$ {{$p->price}}</h3>
									@endif
							</div>
						</div>
						@endforeach
						@else
						@foreach ($products as $t)
						<div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
							<div class="content">
								<div class="content-overlay"></div>
								@foreach ($t->files()->where('zone','Image')->get() as $file)
									<img class="content-image img-fluid d-block mx-auto" src="{{$file->path}}" alt="">
									@endforeach
								<div class="content-details fadeIn-bottom">
									<div class="bottom d-flex align-items-center justify-content-center">
										<a href="#"><span class="lnr lnr-heart"></span></a>
										<a href="#"><span class="lnr lnr-layers"></span></a>
										<a href="#"><span class="lnr lnr-cart"></span></a>
										<a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
									</div>
								</div>
							</div>
							<div class="price">
								<h5>{{$t->name}}</h5>
								@if ($t->price_discount == '0')
									<h3>$ {{$t->price}}</h3>
								@else
									<del>$ {{$t->price_discount}}</del>
									<h3>$ {{$t->price}}</h3>
									@endif
							</div>
						</div>
						@endforeach
						<div>{{$products->links()}}</div>
						
						@endif
						<!-- <div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
							<div class="content">
								<div class="content-overlay"></div>
								<img class="content-image img-fluid d-block mx-auto" src="img/l6.jpg" alt="">
								<div class="content-details fadeIn-bottom">
									<div class="bottom d-flex align-items-center justify-content-center">
										<a href="#"><span class="lnr lnr-heart"></span></a>
										<a href="#"><span class="lnr lnr-layers"></span></a>
										<a href="#"><span class="lnr lnr-cart"></span></a>
										<a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
									</div>
								</div>
							</div>
							<div class="price">
								<h5>Long Sleeve shirt</h5>
								<h3>$150.00</h3>
							</div>
						</div>
						<div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
							<div class="content">
								<div class="content-overlay"></div>
								<img class="content-image img-fluid d-block mx-auto" src="img/l7.jpg" alt="">
								<div class="content-details fadeIn-bottom">
									<div class="bottom d-flex align-items-center justify-content-center">
										<a href="#"><span class="lnr lnr-heart"></span></a>
										<a href="#"><span class="lnr lnr-layers"></span></a>
										<a href="#"><span class="lnr lnr-cart"></span></a>
										<a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
									</div>
								</div>
							</div>
							<div class="price">
								<h5>Long Sleeve shirt</h5>
								<h3>$150.00</h3>
							</div>
						</div>
						<div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
							<div class="content">
								<div class="content-overlay"></div>
								<img class="content-image img-fluid d-block mx-auto" src="img/l8.jpg" alt="">
								<div class="content-details fadeIn-bottom">
									<div class="bottom d-flex align-items-center justify-content-center">
										<a href="#"><span class="lnr lnr-heart"></span></a>
										<a href="#"><span class="lnr lnr-layers"></span></a>
										<a href="#"><span class="lnr lnr-cart"></span></a>
										<a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
									</div>
								</div>
							</div>
							<div class="price">
								<h5>Long Sleeve shirt</h5>
								<h3>$150.00</h3>
							</div>
						</div>
						<div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
							<div class="content">
								<div class="content-overlay"></div>
								<img class="content-image img-fluid d-block mx-auto" src="img/l6.jpg" alt="">
								<div class="content-details fadeIn-bottom">
									<div class="bottom d-flex align-items-center justify-content-center">
										<a href="#"><span class="lnr lnr-heart"></span></a>
										<a href="#"><span class="lnr lnr-layers"></span></a>
										<a href="#"><span class="lnr lnr-cart"></span></a>
										<a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
									</div>
								</div>
							</div>
							<div class="price">
								<h5>Long Sleeve shirt</h5>
								<h3>$150.00</h3>
							</div>
						</div>
						<div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
							<div class="content">
								<div class="content-overlay"></div>
								<img class="content-image img-fluid d-block mx-auto" src="img/l8.jpg" alt="">
								<div class="content-details fadeIn-bottom">
									<div class="bottom d-flex align-items-center justify-content-center">
										<a href="#"><span class="lnr lnr-heart"></span></a>
										<a href="#"><span class="lnr lnr-layers"></span></a>
										<a href="#"><span class="lnr lnr-cart"></span></a>
										<a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
									</div>
								</div>
							</div>
							<div class="price">
								<h5>Long Sleeve shirt</h5>
								<h3>$150.00</h3>
							</div>
						</div>
						<div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
							<div class="content">
								<div class="content-overlay"></div>
								<img class="content-image img-fluid d-block mx-auto" src="img/l5.jpg" alt="">
								<div class="content-details fadeIn-bottom">
									<div class="bottom d-flex align-items-center justify-content-center">
										<a href="#"><span class="lnr lnr-heart"></span></a>
										<a href="#"><span class="lnr lnr-layers"></span></a>
										<a href="#"><span class="lnr lnr-cart"></span></a>
										<a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
									</div>
								</div>
							</div>
							<div class="price">
								<h5>Long Sleeve shirt</h5>
								<h3>$150.00</h3>
							</div>
						</div>
						<div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
							<div class="content">
								<div class="content-overlay"></div>
								<img class="content-image img-fluid d-block mx-auto" src="img/l7.jpg" alt="">
								<div class="content-details fadeIn-bottom">
									<div class="bottom d-flex align-items-center justify-content-center">
										<a href="#"><span class="lnr lnr-heart"></span></a>
										<a href="#"><span class="lnr lnr-layers"></span></a>
										<a href="#"><span class="lnr lnr-cart"></span></a>
										<a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
									</div>
								</div>
							</div>
							<div class="price">
								<h5>Long Sleeve shirt</h5>
								<h3>$150.00</h3>
							</div>
						</div>
						<div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
							<div class="content">
								<div class="content-overlay"></div>
								<img class="content-image img-fluid d-block mx-auto" src="img/l8.jpg" alt="">
								<div class="content-details fadeIn-bottom">
									<div class="bottom d-flex align-items-center justify-content-center">
										<a href="#"><span class="lnr lnr-heart"></span></a>
										<a href="#"><span class="lnr lnr-layers"></span></a>
										<a href="#"><span class="lnr lnr-cart"></span></a>
										<a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
									</div>
								</div>
							</div>
							<div class="price">
								<h5>Long Sleeve shirt</h5>
								<h3>$150.00</h3>
							</div>
						</div>
						<div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
							<div class="content">
								<div class="content-overlay"></div>
								<img class="content-image img-fluid d-block mx-auto" src="img/l5.jpg" alt="">
								<div class="content-details fadeIn-bottom">
									<div class="bottom d-flex align-items-center justify-content-center">
										<a href="#"><span class="lnr lnr-heart"></span></a>
										<a href="#"><span class="lnr lnr-layers"></span></a>
										<a href="#"><span class="lnr lnr-cart"></span></a>
										<a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
									</div>
								</div>
							</div>
							<div class="price">
								<h5>Long Sleeve shirt</h5>
								<h3>$150.00</h3>
							</div>
						</div>
						<div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
							<div class="content">
								<div class="content-overlay"></div>
								<img class="content-image img-fluid d-block mx-auto" src="img/l6.jpg" alt="">
								<div class="content-details fadeIn-bottom">
									<div class="bottom d-flex align-items-center justify-content-center">
										<a href="#"><span class="lnr lnr-heart"></span></a>
										<a href="#"><span class="lnr lnr-layers"></span></a>
										<a href="#"><span class="lnr lnr-cart"></span></a>
										<a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
									</div>
								</div>
							</div>
							<div class="price">
								<h5>Long Sleeve shirt</h5>
								<h3>$150.00</h3>
							</div>
						</div>
						<div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 single-product">
							<div class="content">
								<div class="content-overlay"></div>
								<img class="content-image img-fluid d-block mx-auto" src="img/l8.jpg" alt="">
								<div class="content-details fadeIn-bottom">
									<div class="bottom d-flex align-items-center justify-content-center">
										<a href="#"><span class="lnr lnr-heart"></span></a>
										<a href="#"><span class="lnr lnr-layers"></span></a>
										<a href="#"><span class="lnr lnr-cart"></span></a>
										<a href="#" data-toggle="modal" data-target="#exampleModal"><span class="lnr lnr-frame-expand"></span></a>
									</div>
								</div>
							</div>
							<div class="price">
								<h5>Long Sleeve shirt</h5>
								<h3>$150.00</h3>
							</div>
						</div> -->
						
					</div>
				</section>
				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				@if ($soluongproducts == 0)
				<div class="content">
					{{$product_detail->links()}}
				</div>
				@else
				<div class="content">
					{{$products->links()}}
				</div>
				@endif
				<!-- End Filter Bar -->
			</div>
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head">Men<span class="number" style="color:#f41068;margin-left:5%;">({{$soluongMen}})</span></div>
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
					<div class="head">WoMen<span class="number" style="color:#f41068;margin-left:5%;">({{$soluongWomen}})</span></a></div>
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
			
				<!-- <div class="sidebar-filter mt-50">
					<div class="top-filter-head">Product Filters</div>
					<div class="common-filter">
						<div class="head">Active Filters</div>
						<ul>
							<li class="filter-list"><i class="fa fa-window-close" aria-hidden="true"></i>Gionee (29)</li>
							<li class="filter-list"><i class="fa fa-window-close" aria-hidden="true"></i>Black with red (09)</li>
						</ul>
					</div>
					<div class="common-filter">
						<div class="head">Brands</div>
						<form action="#">
							<ul>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="apple" name="brand"><label for="apple">Apple<span>(29)</span></label></li>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="asus" name="brand"><label for="asus">Asus<span>(29)</span></label></li>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="gionee" name="brand"><label for="gionee">Gionee<span>(19)</span></label></li>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="micromax" name="brand"><label for="micromax">Micromax<span>(19)</span></label></li>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="samsung" name="brand"><label for="samsung">Samsung<span>(19)</span></label></li>
							</ul>
						</form>
					</div>
					<div class="common-filter">
						<div class="head">Color</div>
						<form action="#">
							<ul>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="black" name="color"><label for="black">Black<span>(29)</span></label></li>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="balckleather" name="color"><label for="balckleather">Black Leather<span>(29)</span></label></li>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="blackred" name="color"><label for="blackred">Black with red<span>(19)</span></label></li>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="gold" name="color"><label for="gold">Gold<span>(19)</span></label></li>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="spacegrey" name="color"><label for="spacegrey">Spacegrey<span>(19)</span></label></li>
							</ul>
						</form>
					</div>
					<div class="common-filter">
						<div class="head">Price</div>
						<div class="price-range-area">
							<div id="price-range"></div>
							<div class="value-wrapper d-flex">
								<div class="price">Price:</div>
								<span>$</span><div id="lower-value"></div> <div class="to">to</div>
								<span>$</span><div id="upper-value"></div>
							</div>
						</div>
					</div>
				</div> -->
			<!-- </div> -->
		</div>
	</div>

	<!-- Start Most Search Product Area -->
	<section class="section-half">
		<div class="container">
			<div class="organic-section-title text-center">
				<h3>Most Searched Products</h3>
			</div>
			<div class="row mt-30">
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="single-search-product d-flex">
						<a href="#"><img src="img/r1.jpg" alt=""></a>
						<div class="desc">
							<a href="#" class="title">Pixelstore fresh Blueberry</a>
							<div class="price"><span class="lnr lnr-tag"></span> $240.00</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="single-search-product d-flex">
						<a href="#"><img src="img/r2.jpg" alt=""></a>
						<div class="desc">
							<a href="#" class="title">Pixelstore fresh Cabbage</a>
							<div class="price"><span class="lnr lnr-tag"></span> $189.00</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="single-search-product d-flex">
						<a href="#"><img src="img/r3.jpg" alt=""></a>
						<div class="desc">
							<a href="#" class="title">Pixelstore fresh Raspberry</a>
							<div class="price"><span class="lnr lnr-tag"></span> $189.00</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="single-search-product d-flex">
						<a href="#"><img src="img/r4.jpg" alt=""></a>
						<div class="desc">
							<a href="#" class="title">Pixelstore fresh Kiwi</a>
							<div class="price"><span class="lnr lnr-tag"></span> $189.00</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="single-search-product d-flex">
						<a href="#"><img src="img/r5.jpg" alt=""></a>
						<div class="desc">
							<a href="#" class="title">Pixelstore Bell Pepper</a>
							<div class="price"><span class="lnr lnr-tag"></span> $120.00</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="single-search-product d-flex">
						<a href="#"><img src="img/r6.jpg" alt=""></a>
						<div class="desc">
							<a href="#" class="title">Pixelstore fresh Blackberry</a>
							<div class="price"><span class="lnr lnr-tag"></span> $120.00</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="single-search-product d-flex">
						<a href="#"><img src="img/r7.jpg" alt=""></a>
						<div class="desc">
							<a href="#" class="title">Pixelstore fresh Brocoli</a>
							<div class="price"><span class="lnr lnr-tag"></span> $120.00</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="single-search-product d-flex">
						<a href="#"><img src="img/r8.jpg" alt=""></a>
						<div class="desc">
							<a href="#" class="title">Pixelstore fresh Carrot</a>
							<div class="price"><span class="lnr lnr-tag"></span> $120.00</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="single-search-product d-flex">
						<a href="#"><img src="img/r9.jpg" alt=""></a>
						<div class="desc">
							<a href="#" class="title">Pixelstore fresh Strawberry</a>
							<div class="price"><span class="lnr lnr-tag"></span> $240.00</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="single-search-product d-flex">
						<a href="#"><img src="img/r10.jpg" alt=""></a>
						<div class="desc">
							<a href="#" class="title">Prixma MG2 Light Inkjet</a>
							<div class="price"><span class="lnr lnr-tag"></span> $240.00</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="single-search-product d-flex">
						<a href="#"><img src="img/r11.jpg" alt=""></a>
						<div class="desc">
							<a href="#" class="title">Pixelstore fresh Cherry</a>
							<div class="price"><span class="lnr lnr-tag"></span> $240.00 <del>$340.00</del></div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="single-search-product d-flex">
						<a href="#"><img src="img/r12.jpg" alt=""></a>
						<div class="desc">
							<a href="#" class="title">Pixelstore fresh Beans</a>
							<div class="price"><span class="lnr lnr-tag"></span> $240.00 <del>$340.00</del></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Most Search Product Area -->

	<!-- start footer Area -->
@stop