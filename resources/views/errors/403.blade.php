@extends('errors.illustrated-layout')

@section('code', '403')
@section('title', __('Forbidden'))
@section('message', __('Forbidden'))
@section('image',asset('images/errors/error-1.png'))
@section('redirect_url', route('login'))
@section('redirect_title', __('Admin Home'))
