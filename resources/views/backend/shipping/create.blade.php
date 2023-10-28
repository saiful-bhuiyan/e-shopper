@extends('backend.layouts.master')
@section('body')
<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">@lang('shipping.create_title')</h1>
    @component('components.beardcrumb')
    @slot('page_index')
    @lang('shipping.create_title')
    @endslot
    @slot('page_link')
    {{route('shipping.index')}}
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
    {{route('shipping.index')}}
    @endslot
    @endcomponent
</div>
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">@lang('shipping.create_title')</div>

                </div>
                <div class="ibox-body">
                    <form method="post" action="{{route('shipping.store')}}">
                        @csrf
                        <div class="row">

                            <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                                <div>
                                <label for="defaultFormControlInput" class="form-label">@lang('shipping.division_name') <span class="text-danger">*</span></label>
                                <select class="form-control" name="division_id" id="division_id" onchange="return GetDistrict()" required>
                                    <option value="">@lang('common.select_one') </option>
                                    @if($division)
                                    @foreach($division as $v)
                                    <option value="{{$v->id}}">{{$v->division_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                                <div>
                                <label for="defaultFormControlInput" class="form-label">@lang('shipping.district_name') <span class="text-danger">*</span></label>
                                <select class="form-control" name="district_id" id="district_id" onchange="return GetUpazila()" required>
                                    <option value="">@lang('common.select_one') </option>
                                    
                                </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                                <div>
                                <label for="defaultFormControlInput" class="form-label">@lang('shipping.upazila_name') <span class="text-danger">*</span></label>
                                <select class="form-control" name="upazila_id" id="upazila_id" required>
                                    <option value="">@lang('common.select_one') </option>
                                    
                                </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12" id="inputSingleBox">
                                <div>
                                <label for="defaultFormControlInput" class="form-label">@lang('shipping.charge') <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="defaultFormControlInput"
                                    placeholder="@lang('shipping.charge')"
                                    aria-describedby="defaultFormControlHelp"
                                    name="charge"
                                    required
                                />
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

<script>

    function GetDistrict()
    {
        let division_id = $('#division_id').val();

        if(division_id != "")
        {
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{url('GetDistrict')}}/'+division_id,

                type : 'GET',
                
                success : function(data)
                {
                     $('#district_id').html(data);
                }
            })
        }
        else{
            let html = '';
            alert('Select Division');
            $('#district_id').html(html);
        }


    }

    function GetUpazila()
    {
        let division_id = $('#division_id').val();
        let district_id = $('#district_id').val();

        if(district_id != "" && division_id != "")
        {
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{url('GetUpazila')}}/'+district_id,

                type : 'GET',
                
                success : function(data)
                {
                    $('#upazila_id').html(data);
                }
            })
        }
        else{
            let html = '';
            alert('Select District');
            $('#upazila_id').html(html);
        }


    }

</script>
<!-- END PAGE CONTENT-->
@endsection
