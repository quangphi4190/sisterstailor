<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Shop</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
    CSS
    ============================================= -->
    <link rel="stylesheet" href="{{asset('themes/sisterstailor/css/linearicons.css')}}">
    <link rel="stylesheet" href="{{asset('themes/sisterstailor/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('themes/sisterstailor/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('themes/sisterstailor/css/ion.rangeSlider.css')}}" />
    <link rel="stylesheet" href="{{asset('themes/sisterstailor/css/ion.rangeSlider.skinFlat.css')}}" />
    <link rel="stylesheet" href="{{asset('themes/sisterstailor/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('themes/sisterstailor/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('themes/sisterstailor/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('themes/sisterstailor/css/style.css')}}">
</head>
<body>

<!-- Start Header Area -->
<header class="default-header">
    <div class="menutop-wrap">
        <div class="menu-top container">
            <div class="d-flex justify-content-between align-items-center">
                <ul class="list">
                    <li><a href="tel:+12312-3-1209">+12312-3-1209</a></li>
                    <li><a href="mailto:support@colorlib.com">support@colorlib.com</a></li>
                </ul>
                <ul class="list">                   
                    <li><a href="#">Sign Up</a></li>
                    <li><a href="#">Sign In</a></li>
                </ul>
            </div>            
        </div>
    </div>
    <nav class="navbar navbar-expand-lg  navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{asset('themes/sisterstailor/img/logo.png')}}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li><a href="{{route('homepage')}}">Home</a></li>
                    <li><a href="#catagory">Category</a></li>
                    <li><a href="#men">Men</a></li>
                    <li><a href="#women">Women</a></li>
                    <li><a href="#latest">latest</a></li>
                    <!-- Dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Pages
                        </a>
                        <div class="dropdown-menu">
                        @foreach ($category as $categories)
                            <a class="dropdown-item"  href="{{route('products.index',[$categories->slug])}}">{{$categories->name}}</a>
                        @endforeach
                            <!-- <a class="dropdown-item" href="single.html">Single</a>
                            <a class="dropdown-item" href="cart.html">Cart</a>
                            <a class="dropdown-item" href="checkout.html">Checkout</a>
                            <a class="dropdown-item" href="confermation.html">Confermation</a>
                            <a class="dropdown-item" href="login.html">Login</a>
                            <a class="dropdown-item" href="tracking.html">Tracking</a>
                            <a class="dropdown-item" href="generic.html">Generic</a>
                            <a class="dropdown-item" href="elements.html">Elements</a> -->
                        </div>
                    </li>
                </ul>
                <div class="headerItem_37vW">
                <a class="headerCart_3pLj" href="{{url('/orders')}}">
                    <svg viewBox="0 0 24 24" width="1em" height="1em" class="undefined icon-large icon-inverse">
                        <path fill-rule="evenodd" d="M8 18c-1.104 0-1.99.895-1.99 2 0 1.104.886 2 1.99 2a2 2 0 0 0 0-4m10 0c-1.104 0-1.99.895-1.99 2 0 1.104.886 2 1.99 2a2 2 0 0 0 0-4M4 2H1.999v1.999H4l3.598 7.588-1.353 2.451A2 2 0 0 0 8 17h12v-2H8.423a.249.249 0 0 1-.249-.25l.03-.121L9.102 13h7.449c.752 0 1.408-.415 1.75-1.029l3.574-6.489A1 1 0 0 0 21 3.999H6.213l-.406-.854A1.997 1.997 0 0 0 4 2">
                        </path>
                    </svg><span class="badge_2k15 badgeNumber_ebbk">{{$countCart}}</span>
                </a>
            </div>
            </div>
        </div>
    </nav>
</header>
<!-- End Header Area -->
@yield('content')
<!-- start banner Area -->

<!-- End brand Area -->

<!-- start footer Area -->
<footer class="footer-area section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-3  col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>About Us</h6>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.
                    </p>
                </div>
            </div>
            <div class="col-lg-3  col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Newsletter</h6>
                    <p>Stay update with our latest</p>
                    <div class="" id="mc_embed_signup">

                        <form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">

                            <div class="d-flex flex-row">

                                <input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '" required="" type="email">


                                <button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                                <div style="position: absolute; left: -5000px;">
                                    <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                                </div>

                                <!-- <div class="col-lg-4 col-md-4">
                                    <button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
                                </div>  -->
                            </div>
                            <div class="info"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3  col-md-6 col-sm-6">
                <div class="single-footer-widget mail-chimp">
                    <h6 class="mb-20">Instragram Feed</h6>
                    <ul class="instafeed d-flex flex-wrap">
                        <li><img src="{{asset('themes/sisterstailor/img/i1.jpg')}}" alt=""></li>
                        <li><img src="{{asset('themes/sisterstailor/img/i2.jpg')}}" alt=""></li>
                        <li><img src="{{asset('themes/sisterstailor/img/i3.jpg')}}" alt=""></li>
                        <li><img src="{{asset('themes/sisterstailor/img/i4.jpg')}}" alt=""></li>
                        <li><img src="{{asset('themes/sisterstailor/img/i5.jpg')}}" alt=""></li>
                        <li><img src="{{asset('themes/sisterstailor/img/i6.jpg')}}" alt=""></li>
                        <li><img src="{{asset('themes/sisterstailor/img/i7.jpg')}}" alt=""></li>
                        <li><img src="{{asset('themes/sisterstailor/img/i8.jpg')}}" alt=""></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Follow Us</h6>
                    <p>Let us be social</p>
                    <div class="footer-social d-flex align-items-center">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                        <a href="#"><i class="fa fa-behance"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">

            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            <p class="footer-text m-0">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </div>
    </div>
</footer>
<!-- End footer Area -->

<script src="{{asset('themes/sisterstailor/js/vendor/jquery-2.2.4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="{{asset('themes/sisterstailor/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('themes/sisterstailor/js/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{asset('themes/sisterstailor/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('themes/sisterstailor/js/jquery.sticky.js')}}"></script>
<script src="{{asset('themes/sisterstailor/js/ion.rangeSlider.js')}}"></script>
<script src="{{asset('themes/sisterstailor/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('themes/sisterstailor/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('themes/sisterstailor/js/main.js')}}"></script>

<script type="text/javascript">
		$(document).ready(function(){
			$('select[name="slug"]').change(function(){ 
                var url = '{{route("products.product.get_slug")}}';
				var token = '{{ csrf_token() }}';
				$.post(url,{slug:$(this).val(), _token:token},function(data){
					$('.product-defail').html(data);
                    
				});
			});
		});
	</script>
</body>
</html>