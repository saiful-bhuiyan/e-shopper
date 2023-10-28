@extends('backend.layouts.master')
@section('body')
<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">@lang('product.create_title')</h1>
    @component('components.beardcrumb')
    @slot('page_index')
    @lang('product.create_title')
    @endslot
    @slot('page_link')
    {{route('product.index')}}
    @endslot


    @slot('btn_class')
    btn-info
    @endslot


    @slot('btn_target')

    @endslot
    @slot('icon')
    fa fa-eye
    @endslot


    @slot('btn_name')
    @lang('common.view')
    @endslot
    @slot('btn_link')
    {{route('product.index')}}
    @endslot
    @endcomponent
</div>


@php 
use App\Models\product_size_info;
use App\Models\product_color_info;
@endphp
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">@lang('product.create_title')</div>

                </div>
                <div class="ibox-body">
                    <form method="post" action="{{route('product.update',$data->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">

                        <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                                <div>
                                <label for="defaultFormControlInput" class="form-label">@lang('product.categorie') <span class="text-danger">*</span></label>
                                <select class="form-control" name="cat_id" required id="cat_id" onchange="return GetSubCategorie()">
                                    <option value="">@lang('common.select_one') </option>
                                    @if($cat_name)
                                    @foreach($cat_name as $v)
                                    <option value="{{$v->id}}" @if($data->cat_id == $v->id) selected @endif>
                                        @if($lang == 'en'){{$v->cat_name_en}}
                                        @elseif($lang == 'bn'){{$v->cat_name_bn}}@endif</option>
                                    @endforeach
                                    @endif
                                    
                                </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                                <div>
                                <label for="defaultFormControlInput" class="form-label">@lang('product.sub_categorie') <span class="text-danger">*</span></label>
                                <select class="form-control" name="sub_cat_id" required id="sub_cat_id">
                                    <option value="" >@lang('common.select_one') </option>
                                   @if($sub_categorie)
                                   @foreach($sub_categorie as $v)
                                   <option value="{{$v->id}}" @if($data->sub_cat_id == $v->id) selected @endif>
                                        @if($lang == 'en'){{$v->sub_cat_name_en}}
                                        @elseif($lang == 'bn'){{$v->sub_cat_name_bn}}@endif</option>
                                   @endforeach
                                   @endif

                                </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                                <div>
                                <label for="defaultFormControlInput" class="form-label">@lang('product.product_name_en') <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="defaultFormControlInput"
                                    placeholder="@lang('product.product_name_en')"
                                    aria-describedby="defaultFormControlHelp"
                                    name="product_name_en"
                                    value="{{$data->product_name_en}}"
                                    required
                                />
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                                <div>
                                <label for="defaultFormControlInput" class="form-label">@lang('product.product_name_bn') <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="defaultFormControlInput"
                                    placeholder="@lang('product.product_name_bn')"
                                    aria-describedby="defaultFormControlHelp"
                                    name="product_name_bn"
                                    value="{{$data->product_name_bn}}"
                                    required
                                />
                                </div>
                            </div>

                            

                            <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                                <div>
                                <label for="defaultFormControlInput" class="form-label">@lang('product.reguler_price') <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="defaultFormControlInput"
                                    placeholder="@lang('product.reguler_price')"
                                    aria-describedby="defaultFormControlHelp"
                                    name="regular_price"
                                    value="{{$data->regular_price}}"
                                    required
                                />
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                                <div>
                                <label for="defaultFormControlInput" class="form-label">@lang('product.discount_amount') <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="defaultFormControlInput"
                                    placeholder="@lang('product.discount_amount')"
                                    aria-describedby="defaultFormControlHelp"
                                    name="discount_amount"
                                    value="{{$data->discount_amount}}"
                                    required
                                />
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                                <div>
                                <label for="defaultFormControlInput" class="form-label">@lang('product.min_quantity') <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="defaultFormControlInput"
                                    placeholder="@lang('product.min_quantity')"
                                    aria-describedby="defaultFormControlHelp"
                                    name="min_quantity"
                                    value="{{$data->min_quantity}}"
                                    required
                                />
                                </div>
                            </div>


                            <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                                <div>
                                <label for="defaultFormControlInput" class="form-label">@lang('product.short_details')</label>
                                <textarea
                                    type="text"
                                    class="form-control"
                                    id="defaultFormControlInput"
                                    placeholder="@lang('product.short_details')"
                                    aria-describedby="defaultFormControlHelp"
                                    name="short_details"
                                    value=""
                                >{{$data->short_details}}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                                <div>
                                <label for="defaultFormControlInput" class="form-label">@lang('product.description')</label>
                                <textarea
                                    type="text"
                                    class="form-control"
                                    id="defaultFormControlInput"
                                    placeholder="@lang('product.description')"
                                    aria-describedby="defaultFormControlHelp"
                                    name="description"
                                >{{$data->description}}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                                <div>
                                <label for="defaultFormControlInput" class="form-label">@lang('product.information') </label>
                                <textarea
                                    type="text"
                                    class="form-control"
                                    id="defaultFormControlInput"
                                    placeholder="@lang('product.information')"
                                    aria-describedby="defaultFormControlHelp"
                                    name="information"
                                >{{$data->information}}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                            <label for="defaultFormControlInput" class="form-label ">@lang('size.size_name')<span class="text-danger">*</span></label>
                                <div class="row">
                                @if($size)
                                @foreach($size as $v)

                                @php 
                                

                                $check = product_size_info::where('size_id',$v->id)->where('product_id',$product_id)->first();
                                if($check)
                                {
                                    $checkSizeId = $check->size_id;
                                }
                                else
                                {
                                    $checkSizeId = NULL;
                                }
                                @endphp

                                    <div class="checkbox form-check col-lg-3 col-md-4 col-sm-6">
                                        <label>
                                            <input @if($checkSizeId == $v->id) checked @endif type="checkbox" name="size[]" value="{{$v->id}}">
                                            @if($lang == 'en'){{$v->size_name_en}}
                                            @elseif($lang == 'bn'){{$v->size_name_bn}}@endif
                                        </label>
                                    </div>
                                @endforeach
                                @endif
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                            <label for="defaultFormControlInput" class="form-label ">@lang('color.color_name')<span class="text-danger">*</span></label>
                                <div class="row">
                                @if($color)
                                @foreach($color as $v)

                                @php 
                                $checkColor = product_color_info::where('product_id',$product_id)->where('color_id',$v->id)->first();
                                if($checkColor)
                                {
                                    $checkColorId = $checkColor->color_id;
                                }
                                else
                                {
                                    $checkColorId = NULL;
                                }
                                @endphp
                                    <div class="checkbox form-check col-lg-3 col-md-4 col-sm-6">
                                        <label>
                                            <input @if($checkColorId == $v->id) checked @endif type="checkbox" name="color[]" value="{{$v->id}}">
                                            @if($lang == 'en'){{$v->color_name_en}}
                                            @elseif($lang == 'bn'){{$v->color_name_bn}}@endif
                                        </label>
                                    </div>
                                @endforeach
                                @endif
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12 mt-3">
                            <label for="defaultFormControlInput" class="form-label">@lang('common.status')</label>
                                <div class="form-check form-check">
                                    <input
                                    class="form-check-input"
                                    type="radio"
                                    name="status"
                                    id="active"
                                    value="1"
                                    checked
                                    @if($data->status == 1) checked @endif
                                    />
                                    <label class="form-check-label" for="active">@lang('common.active')</label>
                                </div>
                                <div class="form-check form-check">
                                    <input
                                    class="form-check-input"
                                    type="radio"
                                    name="status"
                                    id="inactive"
                                    value="0"
                                    @if($data->status == 0) checked @endif
                                    />
                                    <label class="form-check-label" for="inactive">@lang('common.inactive')</label>
                                </div>
                            </div>

                            <div class="col-lg-12 mt-3">
                                <label>@lang('product.image')</label>
                                <input type="file" class="form-control" name="image[]" multiple>
                            </div>


                            <div class="col-12 mt-4 " id="inputSingleBox">
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus-square"></i> @lang('common.submit')</button>
                            </div>

                    </div>

                </form>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- END PAGE CONTENT-->
@endsection
