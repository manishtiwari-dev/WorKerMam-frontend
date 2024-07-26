<x-app-layout>
    @section('title', $pageTitle)

    {{-- @php
        $ecmProCat = (array) $content->catSortArray;
        $productToCat = [];
        // @dd($ecmProCat);
    @endphp --}}

    <div class="card contact-content-body">
        <div class="tab-content">
            <div class="card-header">
                <h6 class="tx-15 mg-b-0">
                    @if (!empty($content->parentData))
                        {{ $content->parentData->categories_name }}
                    @else
                        Product List
                    @endif

                </h6>
            </div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                <div class="card-body">
                    <div data-label="Example" class="df-example demo-table">
                        {{-- {{ route('papachina-product.pc-products.index') }} --}}
                        <form action="{{ route('papachina-product.productShownew', $id) }} " method="get">
                            <div class="row mt-3 mb-3" id="search">
                                <input type="hidden" name="" id="CategoryId"
                                    value="{{ $content->parentData->categories_id }}">

                                <div class="form-group col-md-3 px-1">
                                    <div class="form-icon position-relative">
                                       
                                                <div class="search-form">
                                                    <input type="text" id="search" class="form-control fa fa-search"
                                            value="{{ $search ?? '' }}" placeholder="Search..." aria-label="Search"
                                            name="search" >
                                                    <button class="btn" id="searchBtn" type="submit"><i
                                                            data-feather="search"></i></button>
                                                </div>
                                    </div>
                                </div>
                                <small class="text-danger error_alert"></small>

                            </div>
                        </form>
                        <div class="table-responsive " id="prdCate">
                            <table class="table  table_wrapper " id="">
                                <thead>
                                    <tr>
                                        <th class="border-bottom col-sm-1">
                                            {{ __('common.sl_no') }}</th>
                                        <th class="border-bottom col-sm-1">
                                            Product Model</th>
                                        <th class="border-bottom col-sm-2">
                                            Product Name</th>
                                        <th class="border-bottom text-center col-sm-1">
                                            Sort Order</th>
                                        <th class="border-bottom text-center col-sm-1">
                                            {{ __('common.status') }}</th>

                                        <th class="text-center border-bottom col-sm-1">
                                            {{ __('common.action') }}
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @dd($content->PcProducts_list) --}}

                                    @if (!empty($content->PcProducts_list))
                                        @forelse ($content->PcProducts_list as $key=>$product)
                                            {{-- @dd($product) --}}

                                            @php
                                                if (isset($product->proID)) {
                                                    // Property exists, access it safely
                                                    $proID = $product->proID;
                                                } else {
                                                    // Property does not exist
                                                    $proID = 0;
                                                }
                                            @endphp

                                            @php
                                                if ($product->sortOrder == '') {
                                                    $ecmProCat = (array) $product->parentSortOrder[0]->sortOrder;
                                                } else {
                                                    $ecmProCat = (array) $product->sortOrder;
                                                }

                                            @endphp

                                            @php
                                                if (isset($ecmProCat[$proID])) {
                                                    $sortOrderValue = $ecmProCat[$proID];
                                                } else {
                                                    $sortOrderValue = 0;
                                                }
                                            @endphp
                                            <tr>
                                                <input type="hidden" value={{ $id }} id="catID">

                                                <td class="text-left ">
                                                    @php
                                                        $data = (int) $key + 1;
                                                        echo "$data";
                                                    @endphp
                                                </td>
                                                <td class="text-left "> {{ $product->products_model ?? '' }}</td>
                                                <td class="text-left ">
                                                    @if (!empty($product->productdescription))
                                                        @php $product_desc = $product->productdescription[0]; @endphp
                                                        {{ $product_desc->products_name ?? '' }}
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    {{-- {{ $product->proID}} --}}
                                                    <input type="number" class="col-xs-1 shortOrder width1"
                                                        data-id="{{ $product->products_id ?? '' }}" placeholder=""
                                                        value="{{ $sortOrderValue }} " style="width:50px;">
                                                </td>

                                                <th scope="col" class="text-center">

                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input toggle-class"
                                                            {{ $product->isavailable == 'Yes' ? 'checked' : '' }}
                                                            data-id="{{ $product->products_id }}"
                                                            id="customSwitch{{ $product->products_id }}">
                                                        <label class="custom-control-label"
                                                            for="customSwitch{{ $product->products_id }}"></label>
                                                    </div>
                                                </th>

                                                <td class="align-items-center justify-content-center d-flex gap-2">
                                                    <a href="{{ route('papachina-product.pc-products.show', $product->products_id) }}"
                                                        class="btn btn-sm  d-flex align-items-center px-0"><i
                                                            data-feather="eye"></i><span
                                                            class="d-sm-inline mg-l-5"></span></a>

                                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                        <a href="{{ route('papachina-product.pc-products.edit', $product->products_id) }}"
                                                            id="website_delete_btn"
                                                            class="btn btn-sm  d-flex align-items-center px-0"><i
                                                                data-feather="edit-2"></i><span
                                                                class="d-none d-sm-inline mg-l-5"></span></a>
                                                    @endif
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                    <h5 class="text-center my-2">No Record Found</h5>
                                                </td>
                                            </tr>
                                        @endforelse
                                    @endif
                                </tbody>
                            </table>

                            <!--Pagination Start-->
                            {!! \App\Helper\Helper::make_pagination(
                                $content->total_records,
                                $content->per_page,
                                $content->current_page,
                                $content->total_page,
                                'papachina-product.ProductToCatFilter',
                                [$content->parentData->categories_id],
                            ) !!}
                        </div>
                    </div>
                </div>
            @endif

            <!--Pagination End-->
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                // Product status toggle button jquery
                $('.toggle-class').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 0;
                    let products_id = $(this).data('id');

                    console.log(products_id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ url('papachina-product/changeProductStatus') }}",
                        data: {
                            'status': status,
                            'products_id': products_id
                        },
                        success: function(data) {
                            Toaster('success', data.success);
                        }
                    });
                });


                // product sort order update
                $(".shortOrder").on("blur", function(e) {
                    e.preventDefault();
                    var products_id = $(this).data('id');
                    var sort_order = $(this).val();
                    var catId = $('#catID').val();

                    console.log(catId);
                    console.log(sort_order);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('papachina-product.productCategorySortOrder') }}",
                        data: {
                            products_id: products_id,
                            sort_order: sort_order,
                            categories_id: catId
                        },
                        dataType: "json",
                        success: function(data) {
                            Toaster('success', data.success);
                        }
                    });
                });


                $("#search").on('keyup', function(e) {
                    if ((this.value).length >= 3 || (this.value).length == 0) {
                        tableContent(this.value);
                    }
                });
            });


            // function tableContent(input_search = '') {

            //     const url = "{{ route('papachina-product.ProductToCatFilter') }}";
            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            //     $.ajax({
            //         url: url,
            //         type: "POST",
            //         data: {
            //             categories_id: $("#CategoryId").val(),
            //             search: input_search,
            //         },
            //         dataType: "json",
            //         success: function(result) {
            //             console.log(result);
            //             $("#prdCate").html(result.html);
            //         }
            //     });
            // }

            function tableContent(search = '') {

                const url = "{{ route('papachina-product.ProductListFilter') }}";
                console.log(url);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        // categories_id: $("#CategoryId").val(),
                        search: search,

                    },
                    dataType: "json",
                    success: function(result) {
                        console.log(result);

                        $("#prdCate").html(result.html);
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
