@extends('frontend.layout.master')
@section('body')


 <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shop Details</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop Details</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    @if($data)

    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active text-center">
                            <img class="" style="width: 400px;height:450px;" src="{{asset('backend/img/productImage')}}/{{$activeImage->image}}" alt="Image">
                        </div>
                    @if($image)
                    @foreach($image as $i)
                        <div class="carousel-item text-center">
                            <img class="justify-content-center" style="width: 400px;height:450px" src="{{asset('backend/img/productImage')}}/{{$i->image}}" alt="Image">
                        </div>
                    @endforeach
                    @endif
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">@if($lang == 'en'){{$data->product_name_en}}@elseif($lang == 'bn'){{$data->product_name_bn}}@endif</h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">(50 Reviews)</small>
                </div>
                <div class="d-flex">
                    @if($data->discount_amount > 0)
                    <h4>${{$data->regular_price - $data->discount_amount}}</h4><h5 class="text-muted ml-2"><del>$ {{$data->regular_price}}</del></h5>
                    @else
                    <h4>$0</h4>
                    @endif
                </div>
                <p class="mb-4">{{$data->short_details}}</p>
                <form method="post" id="add_to_cart">

                <div class="d-flex mb-3">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>

                    @if($size)
                        @foreach($size as $s)
                            @php
                            $size_data = DB::table('size_settings')->where('id',$s->size_id)->first();
                            @endphp
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input size_id" id="size-{{$s->size_id}}" name="size" value="{{$s->size_id}}">
                                <label class="custom-control-label" for="size-{{$s->size_id}}">
                                    @if($lang == 'en'){{$size_data->size_name_en}}
                                    @elseif($lang == 'bn'){{$size_data->size_name_bn}}
                                    @endif
                                </label>
                            </div>
                        @endforeach
                    @endif

                </div>
                <div class="d-flex mb-4">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Colors:</p>

                        @if($color)
                        @foreach($color as $c)
                            @php
                            $color_data = DB::table('colors')->where('id',$c->color_id)->first();
                            @endphp
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-{{$c->color_id}}" name="color" value="{{$c->color_id}}">
                                <label class="custom-control-label" for="color-{{$c->color_id}}">
                                    @if($lang == 'en'){{$color_data->color_name_en}}
                                    @elseif($lang == 'bn'){{$color_data->color_name_bn}}
                                    @endif
                                </label>
                            </div>
                        @endforeach
                        @endif

                </div>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-minus" id="minus">
                            <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary text-center" id="sum" value="1" name="qty">
                        <input type="hidden" name="product_id" id="product_id" value="{{$data->id}}">
                        <input type="hidden" name="price" id="price" value="{{$data->regular_price - $data->discount_amount}}">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-plus" id="plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    <button type="button" id="AddWishList" class="btn btn-primary mx-3 px-3"><i class="fa fa-shopping-cart mr-1"></i>Add To Wishlist</button>
                </div>
            </form>
                <div class="d-flex pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                    <div class="d-inline-flex">
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
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Information</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Product Description</h4>
                        <p>{{$data->description}}</p>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-2">
                        <h4 class="mb-3">Additional Information</h4>
                        <p>{{$data->information}}</p>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">1 review for "Colorful Stylish Shirt"</h4>
                                <div class="media mb-4">
                                    <img src="{{asset('frontend')}}/img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                    <div class="media-body">
                                        <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                        <div class="text-primary mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">Leave a review</h4>
                                <small>Your email address will not be published. Required fields are marked *</small>
                                <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">Your Rating * :</p>
                                    <div class="text-primary">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <form>
                                    <div class="form-group">
                                        <label for="message">Your Review *</label>
                                        <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Your Name *</label>
                                        <input type="text" class="form-control" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Your Email *</label>
                                        <input type="email" class="form-control" id="email">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        $('#add_to_cart').on('submit',function(e){
            e.preventDefault();
            var datas = $(this).serialize();
            // alert(data);
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },
                url : '{{url('productCart')}}',

                type : 'POST',

                data : datas,

                success : function(data)
                {
                    // alert(data);
                    if(data == 1)
                    {
                        
                        UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Product Added To Cart'});
                        countProductCart();
                        $( "#shopping_cart" ).effect( "shake" );
                    }
                    else if(data == 2)
                    {
                        UIkit.notification({message: '<span uk-icon=\'icon: warning\'></span> দয়া করে লগিন করুন !'});
                    }
                    else if(data == 3)
                    {
                        UIkit.notification({message: '<span uk-icon=\'icon: warning\'></span>Please Select Color & Size'});
                    }
                    else
                    {
                        UIkit.notification({message: '<span uk-icon=\'icon: warning\'></span> Product Does Not Add To Cart'});
                    }
                }
            });
        });

        $('#AddWishList').on('click',function(e){
            e.preventDefault();
            var datas = $('#add_to_cart').serialize();
            // alert(data);
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },
                url : '{{url('AddWishList')}}',

                type : 'POST',

                data : datas,

                success : function(data)
                {
                    // alert(data);
                    if(data == 1)
                    {
                        
                        UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Product Added To Wish list'});
                        countProductCart();
                        $( "#shopping_cart" ).effect( "shake" );
                    }
                    else if(data == 2)
                    {
                        UIkit.notification({message: '<span uk-icon=\'icon: warning\'></span> দয়া করে লগিন করুন !'});
                    }
                    else if(data == 3)
                    {
                        UIkit.notification({message: '<span uk-icon=\'icon: warning\'></span>Please Select Color & Size'});
                    }
                    else
                    {
                        UIkit.notification({message: '<span uk-icon=\'icon: warning\'></span> Product Does Not Add To Wish List'});
                    }
                }
            });
        });


        $('#plus').click(function(){
            var number = $('#sum').val();
            var sum=parseInt(number);
            if(sum > 0){
                $('#sum').val(sum+1);
            }
        })

        $('#minus').click(function(){
            var number = $('#sum').val();
            var sum=parseInt(number);
            if(sum > 1){
                $('#sum').val(sum-1);
            }
        })
    </script>

    <!-- Shop Detail End -->

    @endif



    
    <!-- Products End -->

    @endsection
