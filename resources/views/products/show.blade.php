<section id="basic-horizontal-layouts">
    <div class="row match-height">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
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
                        <tr>
                            <td>
                                <div class="text-center">
                                    {{ ($product['DefaultCategoryId'] ?? '' ) }}
                                    <br/>
                                    {{ ($product['DefaultCategoryPath'] ?? '' ) . ($product['DefaultCategoryName'] ?? '' ) }}
                                </div>
                            </td>
                            <td>{{ $product['ProductId'] ?? '' }}</td>
                            <td>
                                <img src="{{ TSOFT::$apiUrl . ($product['ImageUrl'] ?? '') }}"
                                     alt="{{ $product['ProductName'] ?? '' }}" width="50">
                            </td>
                            <td>{{ $product['ProductCode'] ?? ''}}</a></td>
                            <td>{{ $product['ProductName'] ?? '' }}</a></td>
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
</section>
