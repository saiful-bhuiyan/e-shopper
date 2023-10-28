@extends('backend.layouts.master')
@section('body')
<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">@lang('trend.product_trend_index')</h1>
    @component('components.beardcrumb')
    @slot('page_index')
    @lang('trend.product_trend_index')
    @endslot
    @slot('page_link')
    {{route('add_product_to_trend.index')}}
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
    {{route('add_product_to_trend.index')}}
    @endslot
    @endcomponent
</div>
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">@lang('trend.create_title')</div>

                </div>
                <div class="ibox-body">
                    <form method="post" action="{{route('add_product_to_trend.store')}}">
                        @csrf
                        <div class="row">

                        <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                            <div>
                                <label for="defaultFormControlInput" class="form-label">@lang('categorie.cat_name') <span class="text-danger">*</span></label>
                                <select class="form-control" id="cat_id" name="cat_id" onchange="return GetSelectProduct()" required>
                                    <option>@lang('common.select_one') </option>
                                    @if($categorie)
                                    @foreach($categorie as $v)
                                    <option value="{{$v->id}}">@if($lang == 'en'){{$v->cat_name_en}}
                                        @elseif($lang == 'bn'){{$v->cat_name_bn}}@endif</option>
                                    @endforeach
                                    @endif
                                </select>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-12 m-3" >
                                <label for="product_data" class="form-label ">@lang("product.product_name")<span class="text-danger">*</span></label>
                                <div id="product_data" class="mt-3">

                                </div>
                            </div>


                            <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                            <div>
                                <label for="defaultFormControlInput" class="form-label">@lang('trend.trend_name') <span class="text-danger">*</span></label>
                                <select class="form-control" id="trend_id" name="trend_id" required>
                                    <option>@lang('common.select_one') </option>
                                    @if($trend_name)
                                    @foreach($trend_name as $v)
                                    <option value="{{$v->id}}">@if($lang == 'en'){{$v->trend_name_en}}
                                        @elseif($lang == 'bn'){{$v->trend_name_bn}}@endif</option>
                                    @endforeach
                                    @endif
                                </select>
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
                                    />
                                    <label class="form-check-label" for="inactive">@lang('common.inactive')</label>
                                </div>
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

    function GetSelectProduct()
    {
        let cat_id = $('#cat_id').val();

        //  alert(cat_id);

        if(cat_id != "")
        {
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{url('GetSelectProduct')}}/'+cat_id,

                type : 'GET',
                
                success : function(data)
                {
                    // alert(data);
                    $('#product_data').html(data);
                }
            })
        }
        else{
            let html = '';
            alert('Select Categorie');
            $('#product_data').html(html);
        }


    }

</script>
@endsection
