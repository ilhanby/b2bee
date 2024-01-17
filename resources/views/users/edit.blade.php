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
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.users.index') }}">{{ __('admin.users') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.edit') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('admin.users.edit') }}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('admin.users.update', $user->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name-column">{{ __('admin.users.edit.name') }}</label>
                                            <input type="text" id="name-column" class="form-control" name="name"
                                                value="{{ old('name') ?? $user->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-column">{{ __('admin.users.edit.email') }}</label>
                                            <input type="email" id="email-column" class="form-control" name="email"
                                                value="{{ old('email') ?? $user->email }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="password-column">{{ __('admin.users.edit.password') }}</label>
                                            <input type="password" id="password-column" class="form-control"
                                                name="password">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="confirmation-column">
                                                {{ __('admin.users.edit.confirm_password') }}
                                            </label>
                                            <input type="password" id="confirmation-column" class="form-control"
                                                name="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="alert alert-warning p-3" role="alert">
                                            {{ __('admin.profile.update.help') }}
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="status-column">{{ __('admin.users.edit.status') }}</label>
                                            <select class="form-select" id="status-column" name="status" required>
                                                <option value="active" {{ $user->status == 1 ? 'selected' : '' }}>
                                                    {{ __('admin.active') }}</option>
                                                <option value="inactive" {{ $user->status == 0 ? 'selected' : '' }}>
                                                    {{ __('admin.inactive') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit"
                                            class="btn btn-primary me-1 mb-1">{{ __('admin.submit') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')

    <script src="{{ asset('vendors/simple-datatables/simple-datatables.js') }}"></script>

    <script>
        let dataTable = new simpleDatatables.DataTable(document.querySelector('#dataTable'));
    </script>

@endsection
