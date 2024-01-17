@extends('layouts.auth')

@section('css')@endsection

@section('content')
    <h1 class="auth-title">{{__('admin.two_factor_authentication')}}</h1>

    <form action="{{route('two-factor.login')}}" method="POST">
        @csrf

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" class="form-control form-control-xl @error('code') is-invalid @enderror"
                   placeholder="{{__('admin.two_factor_authentication.code')}}" name="code" required
                   autocomplete="off" autofocus>
            <div class="form-control-icon">
                <i class="bi bi-shield-check"></i>
            </div>
        </div>

        @error('code')
        <div class="text-danger mb-3">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3">{{__('admin.submit')}}</button>
    </form>

    @if (env('FORTIFY_TWO_FACTOR_RECOVERY'))
        <hr class="mt-4 mb-4"/>
        <p class="auth-subtitle mb-5">{{__('admin.two_factor_authentication.recovery_codes.help')}}</p>

        <form action="{{route('two-factor.login')}}" method="POST">
            @csrf

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="form-group position-relative has-icon-left mb-4">
                <input type="text" class="form-control form-control-xl @error('recovery_code') is-invalid @enderror"
                       placeholder="{{__('admin.two_factor_authentication.recovery_code')}}" name="recovery_code"
                       required autocomplete="off" autofocus>
                <div class="form-control-icon @error('recovery_code') is-invalid @enderror">
                    <i class="bi bi-file-lock"></i>
                </div>
            </div>

            @error('recovery_code')
            <div class="text-danger mb-3">
                <strong>{{ $message }}</strong>
            </div>
            @enderror

            <button class="btn btn-outline-danger btn-block btn-lg shadow-lg mt-3">{{__('admin.recover')}}</button>
        </form>
    @endif
@endsection

@section('js')@endsection

