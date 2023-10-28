@if($cart)
@foreach($cart as $c)
<tr>
    <td class="" style="text-align: left;">
    @if($lang == 'en'){{$c->product_name_en}}@elseif($lang == 'bn'){{$c->product_name_bn}}@endif <br>
    Size : <b>{{$c->size_name_en}}</b> <br>
    Color : <b>{{$c->color_name_en}}</b> <br>
    </td>
    <td class="align-middle">{{$c->price}}</td>
    <td class="align-middle">
        <div class="input-group quantity mx-auto" style="width: 100px;">
            
            <input type="text" class="form-control form-control-sm bg-secondary text-center" value="{{$c->qty}}" id="productQty-{{$c->id}}" onchange="return quantityUpdate({{$c->id}})">
            
        </div>
    </td>
    <td class="align-middle">{{$c->price * $c->qty}}</td>
    <td class="align-middle"><button class="btn btn-sm btn-primary" onclick="return deleteProduct({{$c->id}})"><i class="fa fa-times"></i></button></td>
</tr>

@endforeach
@endif


