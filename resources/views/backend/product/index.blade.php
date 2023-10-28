@extends('backend.layouts.master')
@section('body')
<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">@lang('product.index_title')</h1>
    @component('components.beardcrumb')
    @slot('page_index')
    @lang('product.create_title')
    @endslot
    @slot('page_link')
    {{route('product.create')}}
    @endslot


    @slot('btn_class')
    btn-info
    @endslot


    @slot('btn_target')

    @endslot
    @slot('icon')
    fa fa-plus
    @endslot


    @slot('btn_name')
    @lang('common.create')
    @endslot
    @slot('btn_link')
    {{route('product.create')}}
    @endslot
    @endcomponent
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">

            <div class="ibox-title">@lang('product.index_title')</div>
        </div>
        <div class="ibox-body">
            <ul class="nav nav-tabs tabs-line">
                <li class="nav-item">
                    <a class="nav-link active" href="#all" data-toggle="tab"><i class="fa fa-bars"></i> @lang('common.all')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#deleted" data-toggle="tab"><i class="fa fa-trash"></i> @lang('common.deleted')</a>
                </li>
            </ul>

            <div class="tab-content">

                {{-- all --}}
                <div class="tab-pane fade show active" id="all">

                    <table class="table data-table" id="">
                        <thead>
                          <tr>
                            <th>@lang('common.sl')</th>
                            <th>@lang('categorie.cat_name')</th>
                            <th>@lang('sub_categorie.sub_cat_name')</th>
                            <th>@lang('product.product_name')</th>
                            <th>@lang('product.reguler_price')</th>
                            <th>@lang('product.discount_amount')</th>
                            <th>@lang('common.status')</th>
                            <th>@lang('common.action')</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">

                        </tbody>
                      </table>

                </div>


                {{-- deleted --}}
                <div class="tab-pane" id="deleted">

                    @php
                    use App\Models\product;
                    use App\Models\categorie;
                    use App\Models\sub_categorie;
                    $trashed = product::onlyTrashed()->get();
                    $i = 1;
                    @endphp

                    <table class="table " id="example-table">
                        <thead>
                          <tr>
                            <th>@lang('common.sl')</th>
                            <th>@lang('categorie.cat_name')</th>
                            <th>@lang('sub_categorie.sub_cat_name')</th>
                            <th>@lang('product.product_name')</th>
                            <th>@lang('product.reguler_price')</th>
                            <th>@lang('product.discount_amount')</th>
                            <th>@lang('product.image')</th>
                            <th>@lang('common.action')</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @if($trashed)
                            @foreach ($trashed as $v)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>@if($v->cat_id > 0)

                                    @php
                                    $cat_info = categorie::where('id',$v->cat_id)->first();
                                    @endphp

                                    @if($lang == 'en') {{$cat_info->cat_name_en}} @elseif($lang == 'bn') {{$cat_info->cat_name_bn}} @endif

                                    @endif
                                </td>
                                <td>@if($v->sub_cat_id > 0)

                                    @php
                                    $sub_cat_info = sub_categorie::where('id',$v->sub_cat_id)->first();
                                    @endphp

                                    @if($lang == 'en') {{$sub_cat_info->sub_cat_name_en}} @elseif($lang == 'bn') {{$sub_cat_info->sub_cat_name_bn}} @endif

                                    @endif
                                </td>
                                <td>
                                    @if($lang == 'en') {{$v->product_name_en}} @elseif($lang == 'bn') {{$v->product_name_bn}} @endif
                                </td>
                                <td>{{$v->regular_price}}</td>
                                <td>{{$v->discount_amount}}</td>
                                <td>
                                  @php
                                    $path = public_path().'/backend/img/productImage'.$v->image;
                                  @endphp
                                  @if(file_exists($path))
                                  <img src="{{asset('productImage')}}/{{$v->image}}" alt="" style="height : 80px;width : 80px;">
                                  @endif
                                </td>
                                <td>
                                    <a onclick="return confirmation();" class="btn btn-warning btn-sm" href="{{url('retrive_product')}}/{{$v->id}}"><i class="fa fa-repeat"></i></a>
                                    <a onclick="return confirmation();" class="btn btn-danger btn-sm" href="{{url('product_per_delete')}}/{{$v->id}}"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                      </table>

                </div>

            </div>

        </div>
    </div>

</div>
<!-- END PAGE CONTENT-->

<script type="text/javascript">
    $(function () {

      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('product.index') }}",
          columns: [
              {data: 'sl', name: 'sl'},
              {data: 'cat_id', name: 'cat_id'},
              {data: 'sub_cat_id', name: 'sub_cat_id'},
              {data: 'product_name', name: 'product_name'},
              {data: 'regular_price', name: 'regular_price'},
              {data: 'discount_amount', name: 'discount_amount'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

    });
  </script>

<script>

    function productStatusChange(id)
    {
        // alert(id);

        if(id > 0)
        {
            var message = @json( __('product.status_message') );
            var message_type = @json(__('common.success'));
            $.ajax({
                header : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{ url('productStatusChange') }}/'+id,

                type : 'GET',

                success : function(data)
                {
                    toastr.success(message, message_type);
                }
            });
        }
    }

  </script>



@endsection
