@extends('backend.layouts.master')
@section('body')
<!-- START PAGE CONTENT-->
<div class="page-heading">
    <h1 class="page-title">@lang('trend.product_trend_index')</h1>
    @component('components.beardcrumb')
    @slot('page_index')
    @lang('trend.product_trend_title')
    @endslot
    @slot('page_link')
    {{route('add_product_to_trend.create')}}
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
    {{route('add_product_to_trend.create')}}
    @endslot
    @endcomponent
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">

            <div class="ibox-title">@lang('trend.product_trend_title')</div>
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
                            <th>@lang('trend.trend_name')</th>
                            <th>@lang('common.status')</th>
                            <th>@lang('common.action')</th>
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
          ajax: "{{ route('add_product_to_trend.index') }}",
          columns: [
              {data: 'sl', name: 'sl'},
              {data: 'cat_id', name: 'cat_id'},
              {data: 'trend_id', name: 'trend_id'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

    });
  </script>

<script>

    // function trendStatusChange(id)
    // {
    //     // alert(id);

    //     if(id > 0)
    //     {
    //         var message = @json( __('trend.status_message') );
    //         var message_type = @json(__('common.success'));
    //         $.ajax({
    //             header : {
    //                 'X-CSRF-TOKEN' : '{{ csrf_token() }}'
    //             },

    //             url : '{{ url('trendStatusChange') }}/'+id,

    //             type : 'GET',

    //             success : function(data)
    //             {
    //                 toastr.success(message, message_type);
    //             }
    //         });
    //     }
    // }

  </script>



@endsection
