@extends('errors.illustrated-layout')

@section('code', '405')
@section('title', __('Method Not Allowed'))
@section('message', __('Method Not Allowed'))
@section('image',asset('images/errors/error-3.png'))
@section('redirect_url', route('login'))
@section('redirect_title', __('Admin Home'))
