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

@section('pageName', __('User'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">{{ __('User') }}</li>
@endSection



@section('route', route('user.create'))


@section('content')

    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-datatable">
                        <table class="datatables-basic table table-bordered">
                            <thead>
                                <tr>
                                    <th width="8%">S#</th>
                                    <th>Name</th>
                                    <th>Email</th>

                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>

                                        <td>
                                            <div class="btn-group">
                                                <button
                                                    class="btn btn-sm btn-secondary dropdown-toggle waves-effect waves-float waves-light"
                                                    type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown"
                                                    aria-expanded="true">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3"
                                                    data-popper-placement="top-start"
                                                    style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(0px, -40.4px);">

                                                    <a class="dropdown-item"
                                                        href="{{ route('user.edit', ['id' => $item->id]) }}">Edit</a>


                                                    <a class="dropdown-item delete_user" href="#"
                                                        data-bs-toggle="modal" data-bs-target="#delete_user"
                                                        data-user_id="{{ $item->id }}">Delete</a>

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

    {{-- Include Delete User Modal --}}
    @include('backend.user.delete')
@endsection

@section('jsOutside')

    {{-- Write script,link external JS files --}}
    {{-- Include Custom js File --}}
    @include('backend.custom_js.init_js')
@endsection
