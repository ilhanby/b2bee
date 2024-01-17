@extends('layouts.auth')

@section('css')@endsection

@section('content')
    <h1 class="auth-title">{{__('admin.register')}}</h1>

    <form action="{{route('register')}}" method="POST">
        @csrf

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" class="form-control form-control-xl @error('name') is-invalid @enderror"
                   placeholder="{{__('admin.username')}}" name="name" value="{{old('name')}}" required
                   autocomplete="name" autofocus>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>

        @error('name')
        <div class="text-danger mb-3">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="email" class="form-control form-control-xl @error('email') is-invalid @enderror"
                   placeholder="{{__('admin.email')}}" name="email" value="{{ old('email') }}" required
                   autocomplete="email">
            <div class="form-control-icon">
                <i class="bi bi-envelope"></i>
            </div>
        </div>
        @error('email')
        <div class="text-danger mb-3">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" class="form-control form-control-xl @error('password') is-invalid @enderror"
                   placeholder="{{__('admin.password')}}" name="password"
                   required autocomplete="new-password">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
        </div>

        @error('password')
        <div class="text-danger mb-3">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" class="form-control form-control-xl" placeholder="{{__('admin.confirm_password')}}"
                   name="password_confirmation" required autocomplete="new-password">
            <div class="form-control-icon">
                <i class="bi bi-shield-check"></i>
            </div>
        </div>
        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3">{{__('admin.submit')}}</button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
        @if (Route::has('login'))
            <p class="text-gray-600">{{__('admin.do_have_an_account')}}
                <a href="{{route('login')}}" class="text-primary">{{__('admin.login')}}</a>
            </p>
        @endif
    </div>
@endsection

@section('js')@endsection

