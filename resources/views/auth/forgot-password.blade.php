@extends('layouts.auth')

@section('css')@endsection

@section('content')
    <h1 class="auth-title">{{__('admin.forgot_password')}}</h1>

    <form action="{{route('password.email')}}" method="POST">
        @csrf
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="email" class="form-control form-control-xl @error('email') is-invalid @enderror"
                   placeholder="{{__('admin.email')}}" name="email" value="{{ old('email') }}" required
                   autocomplete="email" autofocus>
            <div class="form-control-icon">
                <i class="bi bi-envelope"></i>
            </div>
        </div>

        @error('email')
        <div class="text-danger mb-3">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3">{{__('admin.send_password_reset_link')}}</button>
    </form>
@endsection

@section('js')@endsection

