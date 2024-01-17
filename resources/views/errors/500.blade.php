@extends('errors.illustrated-layout')

@section('code', '500')
@section('title', __('Server Error'))
@section('message', __('Server Error'))
@section('image',asset('images/errors/error-3.png'))
@section('redirect_url', route('login'))
@section('redirect_title', __('Admin Home'))
