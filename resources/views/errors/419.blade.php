@extends('errors.illustrated-layout')

@section('code', '419')
@section('title', __('Page Expired'))
@section('message', __('Page Expired'))
@section('image',asset('images/errors/error-3.png'))
@section('redirect_url', route('login'))
@section('redirect_title', __('Admin Home'))
