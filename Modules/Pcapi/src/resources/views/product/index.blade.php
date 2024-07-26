<x-app-layout>
    @section('title', $pageTitle)

    <div class="card contact-content-body">
        <div class="tab-content">
            <div class="card-header">
                <h6 class="tx-15 mg-b-0">
                    @if (!empty($proTitle))
                        {{ $proTitle->categories_name }}
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

                        {{-- <form action="{{ route('papachina-product.pc-products.index') }}" method="get">

                            <div class="row mt-3 mb-3" id="search">
                                <div class="col-sm-3">
                                    <div class="search-form">
                                        <input type="search" name="search" id="searchbar" class="form-control"
                                            placeholder="Search Here">
                                        <button class="btn" id="searchBtn" type="submit"><i
                                                data-feather="search"></i></button>
                                    </div>
                                </div>

                            </div>
                        </form> --}}

                        <!--Filter Start-->
                        <div class="card-header row align-item-center mb-3 p-0  order-list-wrapper">

                            <!--Search Start-->
                            <div class="col-lg-6 mb-3 mb-lg-0 mb-md-0">
                                <label>Search</label>
                                <input type="text" id="search" class="form-control fas fa-search"
                                    value="{{ $search ?? '' }}" placeholder="Search..." aria-label="Search"
                                    name="search">
                            </div>
                            <!--Search End-->

                            <!--Approval Status Start-->
                            {{-- <div class="col-lg-6">
                                <div class="form-icon position-relative  mb-3">
                                    <label>
                                        Status
                                    </label>
                                    <select class="form-select form-control statusDropDown" id="StatusList"
                                        aria-label="Default select example">
                                        <option selected value="">Select</option>
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div>
                            </div> --}}
                            <!--Approval Status End-->

                            <div class="col-lg-6">
                                <div class="form-icon position-relative mb-3">
                                    <label>
                                        Category
                                    </label>
                                    <select
                                        class="form-select form-control catDropdown   select2 @error('categories_id') is-invalid @enderror"
                                        name="categories_id" id="CatId" aria-label="Default select example">
                                        <option selected value="">All Category</option>
                                        @if (!empty($content->category))
                                            @foreach ($content->category as $key => $parentData)
                                                <option value="{{ $parentData->categories_id }}">
                                                    {{ $parentData->category_name }}</option>
                                                @if (!empty($parentData->sub_category))
                                                    @foreach ($parentData->sub_category as $key => $subparentData)
                                                        <option value="{{ $subparentData->categories_id }}">
                                                            ---{{ $subparentData->category_name }}</option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>

                                </div>
                            </div>

                            {{-- <div class="col-lg-2 d-flex">
                                <div class="align-items-center reset-btn">
                                    <a class="btn btn-primary "
                                        href="{{ route('papachina-product.pc-products.index') }}" role="button"><i
                                            class="fa fa-refresh" aria-hidden="true"></i> {{ __('common.reset') }}</a>
                                </div>
                            </div> --}}

                        </div>
                        <!--Filter End-->
                        <div class="table-responsive">
                        <table class="table  table_wrapper allWebsite" id="product_listing">
                            <thead>
                                <tr>
                                    <th class="border-bottom col-sm-1">
                                        {{ __('common.sl_no') }}</th>

                                        <th class="border-bottom col-sm-1">
                                            Product Image</th>
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
                                @forelse ($content->PcProducts_list as $key=>$product)
                                    <tr>
                                        {{-- <td class="text-left ">
                                         
                                         
                                         
                                         @php
                                                $data = (int) $key + 1;
                                                echo "$data";
                                            @endphp
                                        </td> --}}


                                        <td>{{$content->current_page * $content->per_page + $key+1 - $content->per_page}}</td>

                                        <td class="text-left "></td>

                                        <td class="text-left "> {{ $product->products_model }}</td>
                                        <td class="text-left ">
                                            @if (!empty($product->productdescription))
                                                @php $product_desc = $product->productdescription[0]; @endphp
                                                {{ $product_desc->products_name ?? '' }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <input type="number" class="col-xs-1 inputPassword2 width1"
                                                data-id="{{ $product->products_id }}" placeholder=""
                                                value="{{ $product->sortOrder }}" style="width:50px;">
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

                                        <td class="align-items-center justify-content-center gap-2 d-flex">
                                            <a href="{{ route('papachina-product.pc-products.show', $product->products_id) }}"
                                                class="btn btn-sm d-flex align-items-center px-0"><i
                                                    data-feather="eye"></i><span class="d-sm-inline mg-l-5"></span></a>

                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                <a href="{{ route('papachina-product.pc-products.edit', $product->products_id) }}"
                                                    id="website_delete_btn"
                                                    class="btn btn-sm d-flex align-items-center px-0"><i
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

                            </tbody>
                        </table>
                        </div>

                        <!-- Pagination Start-->
                        {{-- @dd($PcProducts_list); --}}
                        {{-- {!! $PcProducts_list->links() !!} --}}
                        <!--End of Pagination-->
                    </div>
                </div>
            @endif

            <!--Pagination Start-->
            {!! \App\Helper\Helper::make_pagination(
                $content->total_records,
                $content->per_page,
                $content->current_page,
                $content->total_page,
                'papachina-product.pc-products.index',
            ) !!}
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
                        url: "{{ url('papachina-product/pchangeStatus') }}",
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
                $(".inputPassword2").on("blur", function(e) {
                    e.preventDefault();
                    var products_id = $(this).data('id');
                    var sort_order = $(this).val();
                    console.log(products_id);
                    console.log(sort_order);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('papachina-product.pSortOrder') }}",
                        data: {
                            products_id: products_id,
                            sort_order: sort_order
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

            //     $(document).ready(function() {
            //     $("#Search").on("keyup", function() {
            //         var value = $(this).val().toLowerCase();
            //         $("#Search_Tr tr").filter(function() {
            //             $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            //         });
            //     });
            // });



        

          

            // This work On Change of Any Status.
            $(document).on('change', ".statusDropDown", function() {
                tableContent();
            });


            // This work On Change of Any Status.
            $(document).on('change', ".catDropdown", function() {
                tableContent();
            });


          


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
                        categories_id: $("#CatId").val(),
                        search: search,
                        products_status: $("#StatusList").val(),
                    },
                    dataType: "json",
                    success: function(result) {
                        console.log(result);

                        $("#product_listing").html(result.html);
                    }
                });
            }

            
        </script>
    @endpush
</x-app-layout>
