
@extends('frontend.layout.master')

@section('body')
<style>
    .guest-left-dashboard {
    box-shadow: 0px 1px 2px 1px #e5e5e5;
    margin-top: 20px;
    padding: 13px 0px;
}
.guest-menu li {
    list-style: none;
    display: block;
    padding: 10px 16px;
    border-bottom: 1px dashed lightgray;
}
.guest-menu li.active {
    border-left: 6px solid green;
    color: green !important;
    background : lightgray;
}

.guest-menu li.active>.guest-menu li a {
    color: black !important;
}
.guest-menu li a{
    text-decoration: none;
    color:  black;
}
.guest-dashboard-body {
    box-shadow: 0px 1px 1px 1px lightgray;
    margin-top: 19px;
}
.profile-header{
    border-bottom: 1px solid lightgray;
}
.inputBorder{
    border: 1px solid;
    padding: 5px;
}
.saveButton{
    margin-top: 30px;
}
</style>
        </div>
    </div>
</div>
<!-- Navbar End -->



<div class="row container-fluid">
    <div class="col-3">
        <div class="guest-left-dashboard">
            <div class="guest-header" style="text-align: center;">
                <img src="{{asset('backend')}}/img/guestUserImage/{{Auth::guard('guest')->user()->image}}" height="100px" width="100px" class="rounded-circle"><br>
                <b>{{Auth::guard('guest')->user()->first_name}} {{Auth::guard('guest')->user()->last_name}}</b><br>
                <span>{{Auth::guard('guest')->user()->mobile}}</span>
            </div>
            @component('components.guest_sidebar')

            @endcomponent
        </div>
    </div>

    <div class="col-9">
        <div class="guest-dashboard-body">
            <h3 class="text-center">Orders</h3>
            <table class="table">
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Size</th>
                    <th scope="col">Color</th>
                    <th scope="col">Total price</th>
                </tr>
            @php
            $subtotal = 0;
            $shipping = 0;
            $cuppon = 0;
            $totalAmount = 0;
            @endphp
            @if($cart)
            @foreach ($cart as $c)

            <tr>
                <td>{{$c->product_name_en}}</td>
                <td>{{$c->size_name_en}} <br> {{$c->color_name_en}}</td>
                <td>{{$c->qty}}</td>
                <td>{{$c->price * $c->qty}} /-</td>
                @php
                    $subtotal = $subtotal+($c->price * $c->qty);
                @endphp
            </tr>
            @endforeach
            @endif
            <tr>
                <td colspan="3">Shipping Costs</td>
                @foreach($orders as $s)
                @php
                $shipping = $shipping + $s->shipping_cost;
                @endphp
                @endforeach

                <td> + {{$shipping}} /-</td>
            </tr>

            <tr>
                <td colspan="3">Cuppon Amount</td>
                @foreach($orders as $s)
                @php
                $cuppon = $cuppon + $s->cuppon_amount;
                @endphp
                @endforeach

                <td> - {{$cuppon}} /-</td>
            </tr>

            <tr>
                <td colspan="3">Total Amount</td>
               
                @php
                $totalAmount = $subtotal + $shipping;
                $totalAmount = $totalAmount - $cuppon;
                @endphp
                

                <td>{{$totalAmount}} /-</td>
            </tr>
            
            </table>
        </div>
    </div>
</div>








@endsection
