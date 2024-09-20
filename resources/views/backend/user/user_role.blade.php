@extends('backend.layouts.layout')

@section('headInlineTag')

{{-- Write Style,link external CSS files --}}
<style>
/* Gul here Display eXport button hide via css */
.buttons-collection {

   display: none;

}
</style>

@endsection

@section('pageName', __('Users Role'))
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active">{{ __('User Role') }}</li>
@endSection



@section('route', route('user.users_role'))


@section('content')

<section id="basic-datatable">
   <a href="/user/role-create" class="btn-icon btn btn-success btn-rounds"
      style="margin-left: 1352px;margin-top: -50px;"><i data-feather="plus"></i> Create</a>
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-datatable">

               <table class="datatables-basic table table-bordered">
                  <thead>
                     <tr>
                        <th width="8%">S#</th>
                        <th>user_role</th>
                        <th>view</th>
                        <th>change_status</th>
                        <th>edit</th>
                        <th width="10%">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($user_role as $item)
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->user_role }}</td>
                        <td><input disabled type="checkbox" id="view" name="view" {{ $item->view==1 ? 'checked': '' }}>
                        </td>
                        <td><input disabled type="checkbox" id="view" name="view"
                              {{ $item->change_status==1 ? 'checked': '' }}></td>
                        <td><input disabled type="checkbox" id="view" name="view" {{ $item->edit==1 ? 'checked': '' }}>
                        </td>

                        <td>
                           <div class="btn-group">
                              <button
                                 class="btn btn-sm btn-secondary dropdown-toggle waves-effect waves-float waves-light"
                                 type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="true">
                                 Action
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3"
                                 data-popper-placement="top-start"
                                 style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(0px, -40.4px);">

                                 <a class="dropdown-item"
                                    href="{{ route('user_role.edit', ['id' => $item->id]) }}">Edit</a>


                                 <a class="dropdown-item delete_user" href="#" data-bs-toggle="modal"
                                    data-bs-target="#delete_user_role" data-user_id="{{ $item->id }}">Delete</a>

                              </div>
                           </div>
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
<div class="modal fade" id="delete_user_role" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <form method="post" action="{{ route('user.role_delete') }}">
            @csrf
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
               <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <div class="row">
                     <div class="col-md-12">
                        <input type="hidden" id="user_id" name="user_id">
                        <p>Are you sure you wan't to Delete this User?</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
               <button class="btn btn-danger" type="submit">Delete</button>
            </div>
         </form>
      </div>
   </div>
</div>
{{-- Include Delete User Modal --}}
@include('backend.user.delete')
@endsection

@section('jsOutside')

{{-- Write script,link external JS files --}}
{{-- Include Custom js File --}}
@include('backend.custom_js.init_js')
@endsection