@foreach($data as $p)
@if($cat_id == $p->cat_id)
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
            <a href="{{url('shop_details')}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Details</a>
        </div>
    </div>
</div>
@endif
@endforeach