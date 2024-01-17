@extends('layouts.app')
@section('title', __('admin.users'))
@section('css')

    <link rel="stylesheet" href="{{ asset('vendors/simple-datatables/style.css') }}">

@endsection
@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ __('admin.users') }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.users') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="card">
                <div class="card-body">
                    <div class="justify-content-end text-end">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-2">
                            <i class="icon-mid bi bi-plus"></i>
                            {{ __('admin.add') }}
                        </a>
                    </div>
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>{{ __('admin.users.table.id') }}</th>
                                <th>{{ __('admin.users.table.name') }}</th>
                                <th>{{ __('admin.users.table.email') }}</th>
                                <th>{{ __('admin.users.table.status') }}</th>
                                <th>{{ __('admin.users.table.updated_at') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->status == 1)
                                            <span class="badge bg-success">{{ __('admin.active') }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ __('admin.inactive') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->updated_at }}</td>
                                    <td>
                                        @if (auth()->user()->id != $user->id)
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">
                                                <i class="icon-mid bi bi-pencil-square"></i>
                                            </a>
                                            @if ($user->is_delete == 1)
                                                <a href="javascript:void(0)" class="btn btn-danger"
                                                    data-id="{{ $user->id }}">
                                                    <i class="icon-mid bi bi-trash"></i>
                                                </a>
                                            @endif
                                        @else
                                            <a href="{{ route('admin.profile') }}" class="btn btn-primary">
                                                <i class="icon-mid bi bi-pencil-square"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')

    <script src="{{ asset('vendors/simple-datatables/simple-datatables.js') }}"></script>

    <script>
        let dataTable = new simpleDatatables.DataTable(document.querySelector('#dataTable'));

        $(document).ready(function() {
            $(document).on('click', '.btn-danger', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: '{{ __('admin.message.are_you_sure') }}',
                    text: '{{ __('admin.message.are_you_sure.delete') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ __('admin.delete') }}',
                    cancelButtonText: '{{ __('admin.cancel') }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/users/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: id
                            },
                            cache: false,
                            success: function(data) {
                                Swal.fire(
                                    data.title,
                                    data.message,
                                    data.status
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>

@endsection
