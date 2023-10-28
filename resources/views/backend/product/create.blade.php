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
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">@lang('product.create_title')</div>

                </div>
                <div class="ibox-body">
                    <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                        <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                                <div>
                                <label for="defaultFormControlInput" class="form-label">@lang('product.categorie') <span class="text-danger">*</span></label>
                                <select class="form-control" name="cat_id" required id="cat_id" onchange="return GetSubCategorie()">
                                    <option value="">@lang('common.select_one') </option>
                                    @if($cat_name)
                                    @foreach($cat_name as $v)
                                    <option value="{{$v->id}}">@if($lang == 'en'){{$v->cat_name_en}}
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
                                    <option value="">@lang('common.select_one') </option>
         
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
                                ></textarea>
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
                                ></textarea>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                                <div>
                                <label for="defaultFormControlInput" class="form-label">@lang('product.information')</label>
                                <textarea
                                    type="text"
                                    class="form-control"
                                    id="defaultFormControlInput"
                                    placeholder="@lang('product.information')"
                                    aria-describedby="defaultFormControlHelp"
                                    name="information"
                                ></textarea>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                            <label for="defaultFormControlInput" class="form-label ">@lang('size.size_name')<span class="text-danger">*</span></label>
                                <div class="row">
                                @if($size)
                                @foreach($size as $v)
                                    <div class="checkbox form-check col-lg-3 col-md-4 col-sm-6">
                                        <label>
                                            <input type="checkbox" name="size[]" value="{{$v->id}}">
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
                                    <div class="checkbox form-check col-lg-3 col-md-4 col-sm-6">
                                        <label>
                                            <input type="checkbox" name="color[]" value="{{$v->id}}">
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
                                <div class="form-check ml-3">
                                    <input
                                    class="form-check-input"
                                    type="radio"
                                    name="status"
                                    id="active"
                                    value="1"
                                    checked
                                    />
                                    <label class="form-check-label" for="active">@lang('common.active')</label>
                                </div>
                                <div class="form-check ml-3">
                                    <input
                                    class="form-check-input"
                                    type="radio"
                                    name="status"
                                    id="inactive"
                                    value="0"
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

<script>

    function GetSubCategorie()
    {
        let cat_id = $('#cat_id').val();

        // alert(cat_id);

        if(cat_id != "")
        {
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{url('GetSubCategorie')}}/'+cat_id,

                type : 'GET',
                
                success : function(data)
                {
                    // alert(data);
                    $('#sub_cat_id').html(data);
                }
            })
        }
        else{
            let html = '';
            alert('Select Categorie');
            $('#sub_cat_id').html(html);
        }


    }

</script>

@endsection
