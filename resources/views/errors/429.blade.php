@extends('errors.illustrated-layout')

@section('code', '429')
@section('title', __('Too Many Requests'))
@section('message', __('Too Many Requests'))
@section('image',asset('images/errors/error-3.png'))
@section('redirect_url', route('login'))
@section('redirect_title', __('Admin Home'))
