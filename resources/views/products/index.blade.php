@extends('layouts.app')
@section('title', __('admin.products'))
@section('css')

    <link rel="stylesheet" href="{{ asset('vendors/simple-datatables/style.css') }}">

@endsection
@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ __('admin.products') }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.products') }}</li>
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
                            <th>{{ __('admin.products.table.category') }}</th>
                            <th>{{ __('admin.products.table.id') }}</th>
                            <th>{{ __('admin.products.table.image') }}</th>
                            <th>{{ __('admin.products.table.code') }}</th>
                            <th>{{ __('admin.products.table.name') }}</th>
                            <th>{{ __('admin.products.table.price') }}</th>
                            <th>{{ __('admin.products.table.vat') }}</th>
                            <th>{{ __('admin.products.table.vat_included') }}</th>
                            <th>{{ __('admin.products.table.updated_at') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            @php
                                $variant = $product['RelatedProductsIds1']. ','. $product['RelatedProductsIds2']. ','. $product['RelatedProductsIds3'];
                            @endphp
                            <tr>
                                <td>
                                    <div class="text-center">
                                        {{ ($product['DefaultCategoryId'] ?? '' ) }}
                                        <br/>
                                        {{ ($product['DefaultCategoryPath'] ?? '' ) . ($product['DefaultCategoryName'] ?? '' ) }}
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0);"
                                       data-url="{{ route('admin.products.show', $variant) }}"
                                       data-bs-toggle="modal" type="button"
                                       data-bs-target="#product-modal-lg">{{ $product['ProductId'] ?? '' }}</a>
                                </td>
                                <td>
                                    <a href="javascript:void(0);"
                                       data-url="{{ route('admin.products.show', $variant) }}"
                                       data-bs-toggle="modal" type="button"
                                       data-bs-target="#product-modal-lg">
                                        <img src="{{ TSOFT::$apiUrl . ($product['ImageUrl'] ?? '') }}"
                                             alt="{{ $product['ProductName'] ?? '' }}"
                                             width="50">
                                    </a>
                                </td>
                                <td>
                                    <a href="javascript:void(0);"
                                       data-url="{{ route('admin.products.show', $variant) }}"
                                       data-bs-toggle="modal" type="button"
                                       data-bs-target="#product-modal-lg">{{ $product['ProductCode'] ?? '' }}</a>
                                </td>
                                <td>
                                    <a href="javascript:void(0);"
                                       data-url="{{ route('admin.products.show', $variant) }}"
                                       data-bs-toggle="modal" type="button"
                                       data-bs-target="#product-modal-lg">{{ $product['ProductName'] ?? '' }}</a>
                                </td>
                                <td>{{ $product['SellingPrice'] ? $product['SellingPrice'] . ' ' . $product['Currency'] : '' }}</td>
                                <td>%{{ $product['Vat'] ?? '' }}</td>
                                <td>{{ $product['SellingPriceVatIncluded'] ? $product['SellingPriceVatIncluded'] . ' ' . $product['Currency'] : '' }}</td>
                                <td>{{ $product['UpdateDate'] ?? '' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="product-modal-lg" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel20">{{ __('admin.products.detail') }}</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">{{ __('admin.loading') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">{{ __('admin.close') }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')

    <script src="{{ asset('vendors/simple-datatables/simple-datatables.js') }}"></script>

    <script>
        let dataTable = new simpleDatatables.DataTable(document.querySelector('#dataTable'));

        $(document).ready(function () {
            $('#product-modal-lg').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget);
                let url = button.data('url');
                let modal = $(this);
                modal.find('.modal-body').html('<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">{{ __('admin.loading') }}</span></div></div>');
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        modal.find('.modal-body').html(response);
                    }
                });
            });
        });
    </script>

@endsection
