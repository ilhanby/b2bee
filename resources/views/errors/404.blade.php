@extends('errors.illustrated-layout')

@section('code', '404')
@section('title', __('Not Found'))
@section('message', __('Not Found'))
@section('image',asset('images/errors/error-2.png'))
@section('redirect_url', route('login'))
@section('redirect_title', __('Admin Home'))
