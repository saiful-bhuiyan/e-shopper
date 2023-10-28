@extends('frontend.layout.master')
@section('body')

 <!-- Page Header Start -->
 <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">@lang('frontend.checkout')</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">@lang('frontend.home')</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">@lang('frontend.checkout')</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <form method="post" action="{{url('submitOrder')}}">
        @csrf
        
        <div class="row px-xl-5">
            <div class="col-lg-7">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Shipping Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" placeholder="Your name" name="name">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" placeholder="example@email.com" name="email">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" placeholder="+123 456 789" name="mobile_no">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Division</label>
                            <select class="form-control" name="division_id" id="division_id" onchange="return loadDistrict()">
                                <option value="">Select One</option>
                                @if($division)
                                @foreach($division as $d)
                                <option value="{{$d->id}}">{{$d->division_name}}</opiton>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>District</label>
                            <select class="form-control" name="district_id" id="district_id" onchange="loadUpazila();shipingCostUpdate();">
                                <option value="">Select One</option>
                               
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Upazila</label>
                            <select class="form-control" name="upazila_id" id="upazila_id" >
                                <option value="">Select One</option>
                               
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line </label>
                            <input class="form-control" type="text" placeholder="123 Street" name="address">
                        </div>
                    </div>
                    
                </div>





                
            </div>
            <div class="col-lg-5">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Products</h5>
                        <table class="table table-bordered" id="checkoutData">
                            

                        </table>

                        <hr class="mt-0">
                    </div>
                
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Payment</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment_method" id="paypal" value="cash">
                                <label class="custom-control-label" for="paypal">Cash</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- Checkout End -->

    <script>

        function loadCheckoutData()
        {
            var guest_id = $('#guest_id').val();
            $.ajax({
                'headers' : {
                    'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },

                url : '{{url('loadCheckoutData')}}',

                type : 'GET',

                success : function(data)
                {
                    $('#checkoutData').html(data);
                }
            })
        }

        loadCheckoutData();

        function loadDistrict()
        {
            var division_id = $('#division_id').val();

            // alert(division_id);

            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },

                url : '{{url('loadDistrict')}}',

                type : 'POST',

                data : {division_id},

                success : function(data)
                {
                    $('#district_id').html(data);
                }
            });
        }

        function loadUpazila()
        {
            var district_id = $('#district_id').val();

            // alert(district_id);

            // alert(division_id);

            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },

                url : '{{url('loadUpazila')}}',

                type : 'POST',

                data : {district_id},

                success : function(data)
                {
                    // alert(data);
                    $('#upazila_id').html(data);
                }
            });
        }
        function shipingCostUpdate()
        {
            var district_id = $('#district_id').val();

            // alert(division_id);

            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },

                url : '{{url('shipingCostUpdate')}}',

                type : 'POST',

                data : {district_id},

                success : function(data)
                {
                    loadCheckoutData();
                }
            });
        }


        function MatchCuppon()
        {
            var cuppon_code = $('#cuppon_code').val();

            // alert(cuppon_code);

            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{csrf_token()}}'
                },

                url : '{{url('updateCupponAmount')}}',

                type : 'POST',

                data : {cuppon_code},

                success : function(data)
                {
                    if(data != 1)
                    {
                        alert('Cuppon Does Not Matched');
                    }
                    loadCheckoutData();
                }
            })
        }

    </script>


    @endsection
