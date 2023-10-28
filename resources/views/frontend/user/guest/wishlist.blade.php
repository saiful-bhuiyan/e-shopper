@extends('frontend.layout.master')
@section('body')

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Wish List</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Wish List</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-12 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>@lang('product.product_name')</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="showWishList">

                    </tbody>
                </table>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="col-lg-4">
                    <button class="btn btn-block btn-primary my-3 py-3"><a class="text-decoration-none text-light" href="{{url('wishListToCart')}}/{{Auth::guard('guest')->user()->id}}">Add To Cart</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

<script>
    $(document).ready(function(){
        loadWishList();
    });
</script>

<script>

    function loadWishList()
    {
        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : '{{csrf_token()}}'
            },

            url : '{{url('getWishList')}}',

            type : 'get',

            success : function(data)
            {
                $('.showWishList').html(data);
            }
        });
    }

</script>


<script>

function WishListDelete(id)
{
    if(confirm('Are You Sure ?'))
    {
        $.ajax({
        headers : {
            'X-CSRF-TOKEN' : '{{csrf_token()}}'
        },

        url : '{{url('WishListDelete')}}/'+id,

        type : 'GET',

        success : function(data)
        {
            
            loadWishList();
        }
    });
    }

}
</script>

@endsection
