@extends('backend.layouts.layout')

@section('headInlineTag')

{{-- Write Style,link external CSS files --}}
<style>
   /* Gul here
                                Display eXport button hide via css */
   .buttons-collection {

      display: none;

   }
   table.dataTable>thead .sorting:before, table.dataTable>thead .sorting_asc:before, table.dataTable>thead .sorting_desc:before, table.dataTable>thead .sorting_asc_disabled:before, table.dataTable>thead .sorting_desc_disabled:before {
      right: 0em !important;
      content: "" !important;
   }
   table.dataTable>thead .sorting:after, table.dataTable>thead .sorting_asc:after, table.dataTable>thead .sorting_desc:after, table.dataTable>thead .sorting_asc_disabled:after, table.dataTable>thead .sorting_desc_disabled:after {
      right: 0em !important;
      content: "" !important;
   }

   div.dataTables_wrapper div.dataTables_filter label {
      display: block;
   }

   div.dataTables_wrapper div.dataTables_filter input {
      width: 80% !important;
   }
</style>

@endsection

@section('pageName', __('Sell Your Bags'))
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active">{{ __('Pos') }}</li>
@endSection

@php
if(Auth::user()->user_role != 'option_select'){
$data = json_decode(@$data,true)[0] ? json_decode(@$data,true)[0] : '';
$view = @$data['view'] ? @$data['view'] : '';
$changeStatus = @$data['change_status'] ? @$data['change_status'] : '';
$edit = @$data['edit'] ? @$data['edit'] : '';
}
@endphp

@section('content')

@php $statusList = @include(app_path('status.php')); @endphp

<section id="basic-datatable">
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-datatable table-responsive">
               <table class="datatables-basic table table-bordered hover">
                  <thead>
                     <tr>
                        <th>PO#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th class="d-none">Email</th>
                        <th class="d-none">SKU</th>
                        <th class="d-none">Tracking</th>
                        <th>Date</th>
                        <th>Status</th>
                        {{--<th>Tagged</th>--}}
                        <th>User Created</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($list as $item)
                     @php
                        $onclickEvent = '';
                        if (Auth::user()->user_role != 'option_select' && $view == 1) {
                           $onclickEvent = "window.location.href='". route('client.view', ['id' => $item->id]) ."'";
                           $onclickEvent = 'onclick='. $onclickEvent;
                        }
                     @endphp

                     <tr>
                        <td class="cursor-pointer" {{ $onclickEvent }}>{{ $item->po_number }}</td>
                        <td class="cursor-pointer" {{ $onclickEvent }}>{{ $item->name }}</td>
                        <td class="cursor-pointer" {{ $onclickEvent }}>
                           {{ $item->product->implode('name', "\n") }}
                        </td>
                        <td class="cursor-pointer d-none" {{ $onclickEvent }}>{{ $item->email }}</td>
                        <td class="cursor-pointer d-none" {{ $onclickEvent }}>{{ $item->product->implode('sku', "\n") }}</td>
                        <td class="cursor-pointer d-none" {{ $onclickEvent }}>{{ $item->tracking }}</td>
                        <td class="cursor-pointer" {{ $onclickEvent }}>{{ date('m-d-Y H:i:s', strtotime($item->created_at)) }}</td>
                        <td class="cursor-pointer" {{ $onclickEvent }}><span class="badge rounded-pill {{ isset($statusList[$item->client_status]) ? $statusList[$item->client_status] : 'badge-light-secondary' }}" text-capitalized="">{{ $item->client_status }}</span></td>
                        {{--@if ($item->client_status == 'Approved')
                        <td class="cursor-pointer" {{ $onclickEvent }}><span class="badge rounded-pill badge-light-primary" text-capitalized="">Approved</span>
                        </td>
                        @elseif($item->client_status == 'Pending')
                        <td class="cursor-pointer" {{ $onclickEvent }}><span class="badge rounded-pill badge-light-secondary" text-capitalized="">Pending</span>
                        </td>
                        @elseif($item->client_status == 'Rejected')
                        <td class="cursor-pointer" {{ $onclickEvent }}><span class="badge rounded-pill badge-light-danger" text-capitalized="">Rejected</span></td>
                        @else
                        <td class="cursor-pointer" {{ $onclickEvent }}><span class="badge rounded-pill badge-light-secondary" text-capitalized="">{{ $item->client_status }}</span></td>
                        @endif--}}
                        {{--<td class="text-center"><input type="checkbox" {{ $item->tagged == 1 ? 'checked' : '' }} onclick="handleTagged({{ $item->id }})"></td>--}}
                        <td class="cursor-pointer" {{ $onclickEvent }}>{{ $item->user_create }}</td>
                        <td class="text-center">
                           {{--<button class="btn btn-sm btn-primary" style="padding: 0.486rem .5rem;" onclick="fetchConditionReport({{ $item->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Condition Report"> <i class="fas fa-pen-to-square"></i></button>--}}
                           <button class="btn btn-sm btn-outline-primary" style="padding: 0.486rem .5rem;" onclick="showHistory({{ $item->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Log"> {{ $item->update_log_count }}</button>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</section>

<div class="modal fade" id="history-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Update Histories</h5>
                   <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <div class="row">
                     <div class="col-md-12">
                           <table class="table">
                              <thead>
                                 <th>Date</th>
                                 <th>Field</th>
                                 <th>Old Value</th>
                                 <th>New Value</th>
                                 <th>Updated By</th>
                              </thead>
                              <tbody id="history-table-body">
                              </tbody>
                           </table>
                     </div>
                  </div>
               </div>
               {{-- <div class="modal-footer">
                   <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                   <button class="btn btn-success" type="submit">Update</button>
               </div> --}}
       </div>
   </div>
</div>

{{-- Include Delete Role Modal --}}
{{-- @include('user.delete') --}}
@include('backend.client.modal.edit_product_unit')
{{-- @include('backend.client.modal.edit_product_details') --}}

@include('backend.client.modal.condition_report_modal')

@endsection

@section('jsOutside')

{{-- Write script,link external JS files --}}
{{-- Include Custom js File --}}
@include('backend.custom_js.init_js')

<script>
   var url = "{{ url('pos/tagged') }}";
   function handleTagged(id) {
      $.get(url + '/' + id, function () {
         // alert('Tagged successfully');
      });
   }

   function showHistory(id) {
        var url = "{{ url('pos/update-history') }}";

        $.get(url + '/' + id, function (res) {
            $('#history-table-body').empty();
            $('#history-table-body').html(res);
        });
    //    alert(id);
       $('#history-modal').modal('show');
   }

   
</script>
@endsection