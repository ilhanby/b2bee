@extends('layouts.auth')

@section('css')@endsection

@section('content')
    <h1 class="auth-title">{{__('admin.verify_email')}}</h1>

    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('admin.fresh_verification_link') }}
        </div>
    @endif

    <form action="{{route('verification.send')}}" method="POST">
        @csrf

        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3">{{__('admin.send_link')}}</button>
    </form>
@endsection

@section('js')@endsection

