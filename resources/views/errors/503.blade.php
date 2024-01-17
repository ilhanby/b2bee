@extends('errors.illustrated-layout')

@section('code', '503')
@section('title', __('Service Unavailable'))
@section('message', __('Service Unavailable'))
@section('image',asset('images/errors/error-1.png'))
@section('redirect_url', route('login'))
@section('redirect_title', __('Admin Home'))
