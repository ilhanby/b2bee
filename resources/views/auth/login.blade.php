@extends('layouts.auth')

@section('css')@endsection

@section('content')
    <h1 class="auth-title">{{__('admin.login')}}</h1>

    <form action="{{route('login')}}" method="POST">
        @csrf

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

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" class="form-control form-control-xl @error('password') is-invalid @enderror"
                   placeholder="{{__('admin.password')}}" name="password"
                   required autocomplete="current-password">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
        </div>

        @error('password')
        <div class="text-danger mb-3">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <div class="form-check form-check-lg d-flex align-items-end">
            <input class="form-check-input me-2" type="checkbox" name="remember"
                   id="flexCheckDefault" {{old('remember') ? 'checked' : ''}}>
            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                {{__('admin.remember_me')}}
            </label>
        </div>

        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3">{{__('admin.submit')}}</button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
        @if (Route::has('register'))
            <p class="text-gray-600">{{__('admin.don_not_have_an_account')}}
                <a href="{{route('register')}}" class="text-primary">{{__('admin.register')}}</a>
            </p>
        @endif
        @if (Route::has('password.request'))
            <p><a class="font-bold" href="{{route('password.request')}}">{{__('admin.forgot_password')}}</a></p>
        @endif
    </div>
@endsection

@section('js')@endsection

