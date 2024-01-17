@extends('layouts.app')
@section('title', __('admin.categories'))
@section('css')

    <link rel="stylesheet" href="{{ asset('vendors/simple-datatables/style.css') }}">

@endsection
@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ __('admin.categories') }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.categories') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="dataTable">
                        <thead>
                        <tr>
                            <th>{{ __('admin.categories.table.id') }}</th>
                            <th>{{ __('admin.categories.table.code') }}</th>
                            <th>{{ __('admin.categories.table.name') }}</th>
                            <th>{{ __('admin.categories.table.created_at') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $item)
                            <tr>
                                <td>{{ $item['CategoryId'] ?? '' }}</a></td>
                                <td>{{ $item['CategoryCode'] ?? '' }}</td>
                                <td>{{ $item['CategoryName'] ?? '' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item['CreateDate'])->format('d-m-Y-H-i-s') ?? '' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')

    <script src="{{ asset('vendors/simple-datatables/simple-datatables.js') }}"></script>

    <script>
        let dataTable = new simpleDatatables.DataTable(document.querySelector('#dataTable'));
    </script>

@endsection
