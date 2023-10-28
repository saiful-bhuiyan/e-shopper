<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EShopper</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{asset('frontend')}}/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('frontend')}}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('frontend')}}/css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.16.22/dist/css/uikit.min.css" />

</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="{{url('/')}}" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">@lang('frontend.e')</span>@lang('frontend.shopper')</h1>
                </a>
            </div>
            <div class="col-lg-5 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-2">

                <form method="post" action="{{url('change_lang')}}">
                    @csrf
                    <select class="form-control" name="lang" onchange="this.form.submit()">
                        <option {{ session()->get('locale') == 'en' ? 'selected' : '' }} value="en">English</option>
                        <option {{ session()->get('locale') == 'bn' ? 'selected' : '' }} value="bn">বাংলা</option>
                    </select>

                </form>
            </div>
            @if(Auth::guard('guest')->check())


            

            <div class="col-lg-2 col-6 text-right">
                <a href="@if(Auth::guard('guest')->check()){{url('wishlist')}}/{{Auth::guard('guest')->user()->id}}@endif" class="btn border">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge" id="totalWishList">0</span>
                </a>
                <a href="@if(Auth::guard('guest')->check()){{url('add_cart_user')}}/{{Auth::guard('guest')->user()->id}}@endif" class="btn border">
                    <i id="shopping_cart" class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge" id="totalProductCart">0</span>
                </a>
            </div>
            @endif
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid {{request()->Is('/') ? 'mb-5' : ''}}">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100 collapsed" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">@lang('frontend.categorie')</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class=" collapse {{request()->Is('/') ? 'show' : ''}} {{request()->Is('/') ? '' : 'position-absolute'}} navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical" style="{{request()->Is('/') ? '' : 'width: calc(100% - 30px); z-index: 1;background: white;'}}">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        @if($categorie)
                        @foreach($categorie as $c)
                        @php
                        $count = DB::table('sub_categories')->where('cat_id',$c->id)->count();
                        @endphp

                        @if($count > 0)
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">@if($lang == 'en'){{$c->cat_name_en}}@elseif($lang == 'bn'){{$c->cat_name_bn}}@endif <i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                @foreach($sub_categorie as $s)
                                @if($s->cat_id == $c->id)
                                <a href="{{url('sub_categorie_product')}}/{{$s->id}}" class="dropdown-item">@if($lang == 'en'){{$s->sub_cat_name_en}}@elseif($lang == 'bn'){{$s->sub_cat_name_bn}}@endif</a>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        @else
                        <a href="{{url('categorie_product')}}/{{$c->id}}" class="nav-item nav-link">@if($lang == 'en'){{$c->cat_name_en}}@elseif($lang == 'bn'){{$c->cat_name_bn}}@endif </a>
                        @endif
                        @endforeach
                        @endif
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">@lang('frontend.e')</span>@lang('frontend.shopper')</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{url('/')}}" class="nav-item nav-link {{request()->Is('/') ? 'active' : ''}}">@lang('frontend.home')</a>
                            <a href="{{url('/shop')}}" class="nav-item nav-link {{request()->Is('shop') ? 'active' : ''}}">@lang('frontend.shop')</a>
                            <a href="{{url('/contact')}}" class="nav-item nav-link {{request()->Is('contact') ? 'active' : ''}}">@lang('frontend.contact')</a>
                            @if(Auth::guard('guest')->check())
                            <a href="{{url('/checkout')}}/{{Auth::guard('guest')->user()->id}}" class="nav-item nav-link {{request()->Is('checkout') ? 'active' : ''}}">@lang('frontend.checkout')</a>
                            @endif
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                            @if(Auth::guard('guest')->check())
                            <a class="nav-item nav-link" href="{{url('guest_dashboard')}}">{{Auth::guard('guest')->user()->first_name}} {{Auth::guard('guest')->user()->last_name}}</a>
                            @else
                            <a href="{{url('login_guest')}}" class="nav-item nav-link">Login</a>
                            <a href="{{url('registration')}}" class="nav-item nav-link">Register</a>
                            @endif
                        </div>
                    </div>
                </nav>


                @if(request()->Is('/'))

                @elseif(request()->Is('guest_dashboard'))

                @else

                            </div>
                    </div>
                </div>
                <!-- Navbar End -->
            @endif

                <!-- section area start -->

                @yield('body')


    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">@lang('frontend.e')</span>@lang('frontend.shopper')</h1>
                </a>
                <p>Dolore erat dolor sit lorem vero amet. Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum dolore amet erat.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="{{url('/')}}"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="{{url('/shop')}}"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="{{url('/')}}"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="{{url('/shop')}}"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 py-4" placeholder="Your Email"
                                    required="required" />
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">Your Site Name</a>. All Rights Reserved. Designed
                    by
                    <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">HTML Codex</a><br>
                    Distributed By <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="{{asset('frontend')}}/img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('public')}}/lib/easing/easing.min.js"></script>
    <script src="{{asset('public')}}/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="{{asset('public')}}/mail/jqBootstrapValidation.min.js"></script>
    <script src="{{asset('public')}}/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="{{asset('public')}}/js/main.js"></script>
    <!-- UIkit JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.16.22/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.16.22/dist/js/uikit-icons.min.js"></script>


<script>

    $(document).ready(function(){

        countProductCart();
        countWishList();
        

    });


    function countProductCart()
    {
        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : '{{csrf_token()}}'
            },
            url : '{{url('getProductCart')}}',

            type : 'GET',

            success : function(data)
            {
                $('#totalProductCart').html(data);
            }
        });
    }

    function countWishList()
    {
        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : '{{csrf_token()}}'
            },
            url : '{{url('totalWishList')}}',

            type : 'GET',

            success : function(data)
            {
                $('#totalWishList').html(data);
            }
        });
    }

</script>


</body>


</html>
