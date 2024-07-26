<x-app-layout>
    @section('title', 'Pc Product')

    @php
        //    if(!empty($prodetails))
        if ($prodetails != '') {
            $productDetails = $prodetails->productDetails ?? '';
            $product_colors = (array) $productDetails->product_colors ?? '';
            $imprint_colors = (array) $productDetails->imprint_colors ?? '';
            $imprint_positions = (array) $productDetails->imprint_positions ?? '';
        } else {
            $productDetails = '';
            $product_colors = '';
            $imprint_colors = '';
            $imprint_positions = '';
        }

    @endphp



    <div class="container-fluid mt-5 mb-5">
        <div class="">
            <div class="row g-0">

                <div class="col-md-4">
                    <div class="d-flex flex-column justify-content-center">
                        <div class="product_carousel mb-2"> <img class="img-fluid"
                                src="@if (!empty($productDetails->image)) {{ $productDetails->image }} @endif"
                                id="main_product_image" width="350"> </div>
                        {{-- <div class="thumbnail_images">
                                    <ul id="thumbnail">
                                        <li><img onclick="changeImage(this)" src="images/product2.webp" width="70">
                                        </li>
                                        <li><img onclick="changeImage(this)" src="images/product1.webp" width="70">
                                        </li>
                                        <li><img onclick="changeImage(this)" src="images/product3.webp" width="70">
                                        </li>
                                    </ul>
                                </div> --}}
                    </div>
                    <div>
                        {{-- @if (!empty($language))
                        @foreach ($language as $key => $lang) --}}
                        <div class="card mg-b-20 mg-lg-b-25">
                            <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                                <h6 class="  mg-b-0">Product Description
                                </h6>
                            </div><!-- card-header -->
                            <div class="card-body pd-25">
                                <div class="media d-block d-sm-flex">
                                    <div class="media-body">
                                        <div>
                                            <h5>Product Name: {{ $productDetails->products_name ?? '' }}</h5>
                                        </div>
                                        <p class=""> {{ $productDetails->products_description ?? '' }}</p>
                                    </div>
                                </div><!-- media -->

                            </div>

                        </div><!-- card -->
                        {{-- @endforeach
                        @endif --}}
                    </div>
                    <div>

                    </div>

                </div>
                <div class="col-md-8">
                    <div class="media-body mg-t-40 mg-lg-t-0 pd-lg-x-10">
                        <div class="card mg-b-20 mg-lg-b-25">
                            <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                                <h6 class=" tx-semibold mg-b-0">Product Information</h6>
                                <div class="product_btn text-right">
                                    @if (!empty($productDetails))
                                        <a
                                            href="{{ route('papachina-product.pc-products.edit', $productDetails->products_id) }}">
                                            <button class="btn btn-xs btn-primary flex-fill mg-l-10">Edit
                                                Product</button> </a>
                                    @endif


                                </div>
                            </div><!-- card-header -->
                            <div class="card-body ">
                                <div class="media d-block d-sm-flex">

                                    <div class="media-body pd-t-25  ">
                                        <div class="d-flex justify-content-between mb-3">
                                            <div>
                                                <h5 class="mb-0">
                                                    @if (!empty($productDetails->name))
                                                        {{ $productDetails->name }}
                                                    @endif
                                                </h5>
                                            </div>
                                            <div>
                                                @if (!empty($productDetails->status))
                                                    @if ($productDetails->status == 1)
                                                        <span class="badge badge-pill badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-pill badge-danger">Deactive</span>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="products_details" cellspacing="0" rules="all"
                                                border="1" id="ContentPlaceHolder1_gvAttr"
                                                style="border-collapse:collapse;">
                                                <tbody>
                                                    <tr>
                                                        <td>Name :</td>
                                                        <td>
                                                            @if (!empty($productDetails->name))
                                                                {{ $productDetails->name }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Model No :</td>
                                                        <td>
                                                            @if (!empty($productDetails->products_model))
                                                                {{ $productDetails->products_model }}
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>Product Weight :</td>
                                                        <td>
                                                            @if (!empty($productDetails->p_weight))
                                                                {{ $productDetails->p_weight }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @if (!empty($productDetails->p_width))
                                                        <tr>
                                                            <td>Product Height :</td>
                                                            <td>{{ $productDetails->p_height }}</td>
                                                        </tr>
                                                    @endif
                                                    @if (!empty($productDetails->p_width))
                                                        <tr>
                                                            <td>Product Width :</td>
                                                            <td>{{ $productDetails->p_width }}
                                                                {{ $productDetails->p_unit }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @if (!empty($productDetails->p_length))
                                                        <tr>
                                                            <td>Product Length :</td>
                                                            <td>{{ $productDetails->p_length }}
                                                                {{ $productDetails->p_unit }}

                                                            </td>
                                                        </tr>
                                                    @endif

                                                    <tr>
                                                        @if (!empty($productDetails->carton_weight))
                                                            <td>Carton Weight</td>
                                                            <td>

                                                                {{ $productDetails->carton_weight }}

                                                            </td>
                                                    </tr>
                                                    @endif
                                                    @if (!empty($productDetails->carton_height))
                                                        <tr>
                                                            <td>Carton Height :</td>
                                                            <td>

                                                                {{ $productDetails->carton_height }}

                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @if (!empty($productDetails->carton_length))
                                                        <tr>
                                                            <td>Carton Length</td>
                                                            <td>

                                                                {{ $productDetails->carton_length }}

                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @if (!empty($productDetails->carton_width))
                                                        <tr>

                                                            <td>Carton Width :</td>
                                                            <td>
                                                                {{ $productDetails->carton_width }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @if (!empty($productDetails->imprint_method))
                                                        <tr>
                                                            <td>Imprint Method :</td>
                                                            <td>

                                                                {{ $productDetails->imprint_method }}

                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div><!-- media -->
                            </div>
                        </div>



                        <div class="card mg-b-20 mg-lg-b-25 mt-4">
                            <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                                <h6 class="tx- tx-semibold mg-b-0">Product Attribute</h6>
                            </div>

                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-lg-12 mx-auto">
                                        <div class="media-body">
                                            <div class="table-responsive">
                                                <table class="module_details mb-4   products_details" cellspacing="0"
                                                    rules="all" border="1px" id=""
                                                    style="border-collapse: collapse;">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center"
                                                                style="width: 17%; position: relative;">
                                                                <span>Product Color </span>
                                                            </th>
                                                            <td style="padding: 10px;">
                                                                <ul>
                                                                    @if ($product_colors != null)
                                                                        @foreach ($product_colors as $key => $prod_color_name)
                                                                            <li> {{ $prod_color_name }}</li>
                                                                        @endforeach
                                                                    @endif

                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center"
                                                                style="width: 3%; position: relative;">
                                                                <span>Imprint Color</span>
                                                            </th>
                                                            <td style="padding: 10px;">
                                                                <ul>
                                                                    @if ($imprint_colors != null)
                                                                        @foreach ($imprint_colors as $key => $imprint_color_name)
                                                                            <li> {{ $imprint_color_name }}</li>
                                                                        @endforeach
                                                                    @endif

                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center"
                                                                style="width: 3%; position: relative;">
                                                                <span>Imprint Position</span>
                                                            </th>
                                                            <td style="padding: 10px;">
                                                                <ul>
                                                                    @if ($imprint_positions != null)
                                                                        @foreach ($imprint_positions as $key => $imprint_positions_name)
                                                                            <li> {{ $imprint_positions_name }}</li>
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card -->





                        @if ($bulkPrice != null)
                            @foreach ($bulkPrice as $country => $pricelist)
                                <div class="card mg-b-20 mg-lg-b-25">
                                    <div
                                        class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                                        <h6 class="tx- tx-semibold mg-b-0">{{ $country }} - ( Price including
                                            shipping and Excluding your Profit margin)</h6>
                                    </div><!-- card-header -->
                                    <div class="card-body ">
                                        <div class="media d-block d-sm-flex">
                                            <div class="media-body w-100">
                                                <div class="table-responsive">
                                                    <table class="products_details">
                                                        <tr>
                                                            <td>QTY</td>
                                                            @foreach ($pricelist as $producprice)
                                                                <td>{{ $producprice->product_qty }}</td>
                                                            @endforeach
                                                        </tr>

                                                        <tr>
                                                            <td>Price</td>
                                                            @foreach ($pricelist as $producprice)
                                                                <td>{{ $currencyList[0]->symbol_left }}{{ $producprice->sale_price}}
                                                                </td>
                                                            @endforeach
                                                        </tr>

                                                    </table>

                                                </div>
                                            </div>
                                        </div><!-- media -->
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
