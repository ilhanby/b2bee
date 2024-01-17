@extends('errors.illustrated-layout')

@section('code', '401')
@section('title', __('Unauthorized'))
@section('message', __('Unauthorized'))
@section('image',asset('images/errors/error-1.png'))
@section('redirect_url', route('login'))
@section('redirect_title', __('Admin Home'))
