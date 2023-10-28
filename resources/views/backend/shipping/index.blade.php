@extends('backend.layouts.master')
@section('body')
<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">@lang('shipping.index_title')</h1>
    @component('components.beardcrumb')
    @slot('page_index')
    @lang('shipping.create_title')
    @endslot
    @slot('page_link')
    {{route('shipping.create')}}
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
    {{route('shipping.create')}}
    @endslot
    @endcomponent
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">

            <div class="ibox-title">@lang('shipping.index_title')</div>
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
                            <th>@lang('shipping.division_name')</th>
                            <th>@lang('shipping.district_name')</th>
                            <th>@lang('shipping.upazila_name')</th>
                            <th>@lang('shipping.charge')</th>
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
                    use App\Models\shipping;
                    use App\Models\division_information;
                    use App\Models\district_information;
                    use App\Models\upazila_information;
                    $trashed = shipping::onlyTrashed()->get();
                    $i = 1;
                    @endphp

                    <table class="table " id="example-table">
                        <thead>
                          <tr>
                            <th>@lang('common.sl')</th>
                            <th>@lang('shipping.division_name')</th>
                            <th>@lang('shipping.district_name')</th>
                            <th>@lang('shipping.upazila_name')</th>
                            <th>@lang('shipping.charge')</th>
                            <th>@lang('common.status')</th>
                            <th>@lang('common.action')</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @if($trashed)
                            @foreach ($trashed as $v)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>@if($v->division_id > 0)

                                    @php
                                    $div_info = division_information::where('id',$v->division_id)->first();
                                    @endphp

                                     {{$div_info->division_name}}

                                    @endif
                                </td>
                                <td>@if($v->district_id > 0)

                                    @php
                                    $dis_info = district_information::where('id',$v->district_id)->first();
                                    @endphp

                                     {{$dis_info->district_name}}

                                    @endif
                                </td>
                                <td>@if($v->upazila_id > 0)

                                    @php
                                    $upazila_info = upazila_information::where('id',$v->upazila_id)->first();
                                    @endphp

                                    {{$upazila_info->upazila_name}}

                                    @endif
                                </td>
                                <td>{{$v->charge}}</td>
                                <td>
                                    <a onclick="return confirmation();" class="btn btn-warning btn-sm" href="{{url('retrive_shipping')}}/{{$v->id}}"><i class="fa fa-repeat"></i></a>
                                    <a onclick="return confirmation();" class="btn btn-danger btn-sm" href="{{url('shipping_per_delete')}}/{{$v->id}}"><i class="fa fa-trash"></i></a>
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
          ajax: "{{ route('shipping.index') }}",
          columns: [
              {data: 'sl', name: 'sl'},
              {data: 'division_id', name: 'division_id'},
              {data: 'district_id', name: 'district_id'},
              {data: 'upazila_id', name: 'upazila_id'},
              {data: 'charge', name: 'charge'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

    });
  </script>

<script>

    function shippingStatusChange(id)
    {
        // alert(id);

        if(id > 0)
        {
            var message = @json( __('shipping.status_message') );
            var message_type = @json(__('common.success'));
            $.ajax({
                header : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },

                url : '{{ url('shippingStatusChange') }}/'+id,

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
