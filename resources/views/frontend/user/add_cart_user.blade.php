@extends('frontend.layout.master')
@section('body')

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shopping Cart</p>
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
                    <tbody class="showcartdata">

                    </tbody>
                </table>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="col-lg-4">
                    <button class="btn btn-block btn-primary my-3 py-3"><a class="text-decoration-none text-light" href="{{url('checkout')}}/{{Auth::guard('guest')->user()->id}}">Proceed To Checkout</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

    <script>
        $(document).ready(function(){
            loadCartData();
        });
    </script>

    <script>



    function loadCartData()
    {
        $.ajax({
            headers : {
                'X-CSRF-TOKEN' : '{{csrf_token()}}'
            },

            url : '{{url('getCartData')}}',

            type : 'get',

            success : function(data)
            {
                $('.showcartdata').html(data);
            }
        });
    }

    </script>

<script>

function quantityUpdate(id)
{
    var quantity = $('#productQty-'+id).val();

    // alert(quantity);

    $.ajax({
        headers : {
            'X-CSRF-TOKEN' : '{{csrf_token()}}'
        },

        url : '{{url('productQtyUpdate')}}/'+id,

        type : 'GET',

        data : {quantity},

        success : function(data)
        {
            // alert(data);
            loadCartData();
        }
    });
}
</script>
<script>

function deleteProduct(id)
{
    if(confirm('Are You Sure ?'))
    {
        $.ajax({
        headers : {
            'X-CSRF-TOKEN' : '{{csrf_token()}}'
        },

        url : '{{url('deleteProduct')}}/'+id,

        type : 'GET',

        success : function(data)
        {
            // alert(data);
            loadCartData();
        }
    });
    }

}
</script>

@endsection
