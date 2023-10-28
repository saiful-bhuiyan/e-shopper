@extends('backend.layouts.master')
@section('body')
<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">@lang('user_order.index_title')</h1>
    @component('components.beardcrumb')
    @slot('page_index')
    @lang('user_order.create_title')
    @endslot
    @slot('page_link')
    {{url('user_order')}}
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
    {{url('user_order')}}
    @endslot
    @endcomponent
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">

            <div class="ibox-title">@lang('user_order.index_title')</div>
        </div>
        <div class="ibox-body">
            <ul class="nav nav-tabs tabs-line">
                <li class="nav-item">
                    <a class="nav-link active" href="#all" data-toggle="tab"><i class="fa fa-bars"></i> @lang('common.all')</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#deleted" data-toggle="tab"><i class="fa fa-trash"></i> @lang('common.deleted')</a>
                </li> -->
            </ul>

            <div class="tab-content">

                {{-- all --}}
                <div class="tab-pane fade show active" id="all">

                    <table class="table data-table" id="">
                        <thead>
                          <tr>
                            <th>@lang('common.sl')</th>
                            <th>@lang('user_order.user_name')</th>
                            <th>@lang('user_order.mobile')</th>
                            <th>@lang('user_order.product_info')</th>
                            <th>@lang('shipping.division_name')</th>
                            <th>@lang('shipping.district_name')</th>
                            <th>@lang('user_order.address')</th>
                            <th>@lang('user_order.total')</th>
                            <th>@lang('common.status')</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">

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
          ajax: "{{ url('user_order') }}",
          columns: [
              {data: 'sl', name: 'sl'},
              {data: 'name', name: 'name'},
              {data: 'mobile', name: 'mobile'},
              {data: 'product_info', name: 'product_info'},
              {data: 'division_id', name: 'division_id'},
              {data: 'district_id', name: 'district_id'},
              {data: 'address', name: 'address'},
              {data: 'total', name: 'total'},
              {data: 'status', name: 'status', orderable: false, searchable: false},
          ]
      });

    });
  </script>

<!-- <script>

    function productStatusChange(id)
    {
        // alert(id);

        if(id > 0)
        {
            var message = @json( __('user_order.status_message') );
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

  </script> -->



@endsection
