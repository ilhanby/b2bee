@extends('layouts.app')
@section('title', __('admin.profile'))
@section('css')@endsection
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{__('admin.profile')}}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">{{__('admin.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('admin.profile')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('admin.account_settings')}}</h4>
                        <div class="alert alert-warning p-3 mt-5" role="alert">
                            {{ __('admin.profile.update.help') }}
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" action="{{route('admin.profile.update')}}">
                                @csrf

                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <label for="username">{{__('admin.username')}}</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="username"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   placeholder="{{__('admin.username')}}" name="name"
                                                   value="{{Auth::user()->name}}" required autocomplete="name"
                                                   autofocus>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="email">{{__('admin.email')}}</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="email" id="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   placeholder="{{__('admin.email')}}" name="email"
                                                   value="{{Auth::user()->email}}" required autocomplete="email">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="password">{{__('admin.password')}}</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="password" id="password" name="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   placeholder="{{__('admin.password')}}" autocomplete="new-password">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="password">{{__('admin.confirm_password')}}</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="password" id="password" name="password_confirmation"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   placeholder="{{__('admin.confirm_password')}}"
                                                   autocomplete="new-password">
                                        </div>

                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">
                                                {{__('admin.submit')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('admin.profile.two_factor_authentication')}}</h4>
                        <div class="alert alert-warning p-3 mt-5" role="alert">
                            {{ __('admin.profile.two_factor_authentication.help') }}
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" action="{{route('two-factor.enable')}}">
                                @csrf

                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <label for="username">{{__('admin.status')}}</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            @if(auth()->user()->two_factor_secret)
                                                @method("DELETE")

                                                <div class="pb-5">
                                                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                                                </div>

                                                <div>
                                                    <h3>{{__('admin.profile.recovery_codes')}}:</h3>
                                                    <ul>
                                                        @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                                                            <li>{{ $code }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>

                                                <button type="submit" class="btn btn-danger me-1 mb-1">
                                                    {{__('admin.disable')}}
                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-primary me-1 mb-1">
                                                    {{__('admin.enable')}}
                                                </button>
                                            @endif
                                        </div>
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
@section('js')@endsection
