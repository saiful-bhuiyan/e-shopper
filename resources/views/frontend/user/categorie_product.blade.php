@extends('frontend.layout.master')
@section('body')

<style>
    img#loading {position: absolute;left: 360px;top: 42px;z-index: 99;opacity: 0.2;}

div#filterProduct {
    position: relative;
}
</style>

    <!-- Page Header Start -->
    <input type="hidden" id="cat_id" name="cat_id" value="{{$categories->id}}">
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">@lang('frontend.shop_by_categorie')</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{url('/')}}">@lang('frontend.home')</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">@if($lang == 'en'){{$categories->cat_name_en}}@elseif($lang == 'bn'){{$categories->cat_name_bn}}@endif</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            
             <!-- Shop Sidebar Start -->
             <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
                    <form>
                        
                        @if($p_range)
                        @foreach($p_range as $p)
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="range" id="range-{{$p->id}}" onclick="return filterProductByRange({{$p->id}})">
                        <label class="form-check-label" for="range-{{$p->id}}">
                           {{$p->from}} - {{$p->to}}
                        </label>
                        </div>
                        @endforeach
                        @endif
                        
                    </form>
                </div>
                <!-- Price End -->
                
                <!-- Color Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by color</h5>
                    
                        
                        @if($color)
                        @foreach($color as $c)
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="color" id="color-{{$c->id}}" onclick="return filterProductByColor({{$c->id}})">
                        <label class="form-check-label" for="color-{{$c->id}}">
                            @if($lang == 'en'){{$c->color_name_en}}@elseif($lang == 'bn'){{$c->color_name_bn}}@endif
                        </label>
                        </div>
                        @endforeach
                        @endif
                    
                </div>
                <!-- Color End -->

                <!-- Size Start -->
                <div class="mb-5">
                    <h5 class="font-weight-semi-bold mb-4">Filter by size</h5>
                
                        
                        <!-- <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-1">
                            <label class="custom-control-label" for="size-1">XS</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div> -->
                        @foreach($size as $s)
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="size" id="size-{{$s->id}}" onclick="return filterProductBySize({{$s->id}})">
                        <label class="form-check-label" for="size-{{$s->id}}">
                            @if($lang == 'en'){{$s->size_name_en}}@elseif($lang == 'bn'){{$s->size_name_bn}}@endif
                        </label>
                        </div>
                        @endforeach
                    
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->

            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search by name">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <div class="dropdown ml-4">
                                <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                            Sort by
                                        </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="filterProduct">
                    <img src="{{asset('loading.gif')}}" alt="" class="img-fluid" id="loading">
                    @if($total_products > 0)
                    @foreach($products as $p)

                    @php 
                    $productImage = DB::table('product_image_infos')->where('product_id',$p->id)->first();
                    @endphp
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="{{asset('backend/img/productImage')}}/{{$productImage->image}}" alt="">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">@if($lang == 'en'){{$p->product_name_en}}@elseif($lang == 'bn'){{$p->product_name_bn}}@endif</h6>
                                <div class="d-flex justify-content-center">
                                    @if($p->discount_amount > 0)
                                    <h6>${{$p->regular_price - $p->discount_amount}}</h6><h6 class="text-muted ml-2"><del>$ {{$p->regular_price}}</del></h6>
                                    @else 
                                    <h6>${{$p->regular_price}}</h6>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="{{url('shop_details')}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                              
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else 
                    
                        <div class="col-12 text-center">
                        <img src="{{asset('/no-product-found.png')}}" alt="" style="height : 200px;">
                        </div>
                    
                    @endif

                   
                    <!-- <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                          <ul class="pagination justify-content-center mb-3">
                            <li class="page-item disabled">
                              <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                              </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                              <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                              </a>
                            </li>
                          </ul>
                    ()    </nav>
                    </div> -->
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

    <script type="text/javascript">
        
        

            $('img#loading').hide();
    
        function filterProductByColor(id)
        {
            let cat_id = $('#cat_id').val();

            let color_id = id;

            // alert(id);

            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },

                url : '{{url('filterCatProductByColor')}}',

                type : 'POST',

                data : {cat_id,color_id},

                beforeSend : function(e)
                {
                    $('#loading').show();
                },

                success : function(data)
                {
                    // alert(data);
                    $('#filterProduct').html(data);
                }

            });
        }
        function filterProductBySize(id)
        {
            let cat_id = $('#cat_id').val();

            let size_id = id;

            // alert(id);

            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },

                url : '{{url('filterCatProductBySize')}}',

                type : 'POST',

                data : {cat_id,size_id},

                beforeSend : function(e)
                {
                    $('#loading').show();
                },

                success : function(data)
                {
                    // alert(data);
                    $('#filterProduct').html(data);
                }

            });
        }
        function filterProductByRange(id)
        {
            let cat_id = $('#cat_id').val();

            let range_id = id;

            // alert(id);

            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },

                url : '{{url('filterProductByRange')}}',

                type : 'POST',

                data : {cat_id,range_id},

                beforeSend : function(e)
                {
                    $('#loading').show();
                },

                success : function(data)
                {
                    // alert(data);
                    $('#filterProduct').html(data);
                }

            });
        }

    </script>

    @endsection