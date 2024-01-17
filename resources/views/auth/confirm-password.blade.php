@extends('layouts.auth')

@section('css')@endsection

@section('content')
    <h1 class="auth-title">{{__('admin.confirm_password')}}</h1>

    <form action="{{route('password.confirm')}}" method="POST">
        @csrf

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" class="form-control form-control-xl @error('password') is-invalid @enderror"
                   placeholder="{{__('admin.password')}}" name="password" required
                   autocomplete="current-password" autofocus>
            <div class="form-control-icon">
                <i class="bi bi-shield-check"></i>
            </div>
        </div>

        @error('password')
        <div class="text-danger mb-3">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3">{{__('admin.submit')}}</button>
    </form>
@endsection

@section('js')@endsection

