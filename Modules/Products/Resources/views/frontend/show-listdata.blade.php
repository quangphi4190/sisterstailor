<div class="container">
	<div class="row ">
		@foreach ($products as $p)
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
	</div>
</div>