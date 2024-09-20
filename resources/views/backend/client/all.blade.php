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

   .clickable {
      cursor: pointer;
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
            <hr class="mt-5 mb-0">
            <div class="card-datatable table-responsive">
               <table class="po-datatables table table-bordered hover">
                  <thead>
                     <tr>
                        <th>PO#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Status</th>
                        {{--<th>Tagged</th>--}}
                        <th>User Created</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     
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
   var baseUrl = "{{ url('/') }}";

   var editPermission = false;
   @if (Auth::user()->user_role != 'option_select' && $view == 1)
      var editPermission = true;
   @endif


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
       $('#history-modal').modal('show');
   }

   $(function () {
      var ajaxData = { 
         _token: "{{ csrf_token() }}"
      };

      var columnData = [
         { "data": "po_number", "orderable": true, 'className': 'clickable' },
         { "data": "name", "orderable": true, 'className': 'clickable' },
         { "data": "product_name", "orderable": true, 'className': 'clickable' },
         { "data": "created_at", "orderable": true, 'className': 'clickable' },
         { "data": "client_status", "orderable": true, 'className': 'clickable' },
         { "data": "user_create", "orderable": true, 'className': 'clickable' },
         { "data": "action_button", "orderable": false },
      ];

      $('.po-datatables').DataTable({
         "processing": true,
         "serverSide": true,
         "order": [[0, 'desc']],
         "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
         "ajax":{
            "url": "{{ url('pos/datatables') }}",
            "dataType": "json",
            "type": "GET",
            "data": ajaxData,
         },
         columnDefs: [
            {
                  targets: [0, 1, 2, 3, 4, 5],
                  createdCell: function (td, cellData, rowData, row, col) {
                     if (editPermission) {
                        $(td).attr('onclick', "window.location.href='" + baseUrl + "/pos/" + rowData.id + "/view'");
                     }
                  }
            }
         ],
         "columns": columnData,
      });

       
   });

   
</script>
@endsection