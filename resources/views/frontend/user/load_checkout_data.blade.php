@php
$subtotal = 0;
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
    <td colspan="3" style="text-align: right">
        Sub Total
    </td>
    <td>{{$subtotal}}/-</td>
</tr>
<tr>
    <td colspan="3" style="text-align: right">
        Shipping Cost
    </td>
    <td>
        @if($draft_order->shipping_cost)
        {{$draft_order->shipping_cost}}
        @else 
        <span class="text-danger">Select Your District</span>
        @endif
    </td>
    <tr>
    <td colspan="3" style="text-align: right">
        Apply Cuppon
    </td>
    <td>
        @if($draft_order->cuppon_amount)
        {{$draft_order->cuppon_amount}}
        @else 
        <input type="text" class="form-control" id="cuppon_code" name="cuppon_code" onchange="MatchCuppon()">
        @endif
    </td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:right">Grand Total</td>
        <td>{{($subtotal + $draft_order->shipping_cost) - $draft_order->cuppon_amount}}</td>
    </tr>
</tr>