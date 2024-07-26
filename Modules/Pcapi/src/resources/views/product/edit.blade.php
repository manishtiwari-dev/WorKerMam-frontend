<x-app-layout>
    @section('title', 'Pc Product')
    @php


        if (!empty($data)) {
            $enProd = (array) $data->proDescArray;
            $seoData = (array) $data->seo;
            $pcProduct=(array) $data->PcProduct;
            $Ecmprice = (array) $data->Saleprice;
            $ecmProduct = $data->ecm_product_detail;
        }
    @endphp

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    @endpush

    <div class="card contact-content-body">
        <div class="tab-content">
            <div class="card-header">
                @if (!empty($data->language))
                    @foreach ($data->language as $key => $lang)
                        <h6 class="tx-15 mg-b-0">
                            @if (!empty($enProd[$lang->languages_id]))
                                {{ $enProd[$lang->languages_id]->products_name }}
                                @else
                                Edit Products
                            @endif
                        </h6>
                    @endforeach
                @endif
            </div>

            <div class="card-body">
                <form action="{{ route('papachina-product.pc-products.update', $pcProduct['products_id']) }}"
                    class="needs-validation" method="POST" novalidate>
                    @csrf
                    {{ method_field('PUT') }}

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @if (!empty($data->language))
                            @foreach ($data->language as $key => $lang)
                                <li class="nav-item">
                                    <a class="nav-link @if ($key == 0) active @endif"
                                        id="category-tab-{{ $lang->languages_id }}" data-bs-toggle="tab"
                                        href="#category-content-{{ $lang->languages_id }}" role="tab"
                                        aria-controls="home" aria-selected="true">{{ $lang->languages_name }}</a>
                                </li>
                            @endforeach
                        @endif

                    </ul>

                    <div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="myTabContent">
                        {{-- @dd($data->language); --}}
                        @if (!empty($data->language))
                            @foreach ($data->language as $key => $lang)
                                <div class="tab-pane fade show @if ($key == 0) active @endif"
                                    id="category-content-{{ $lang->languages_id }}" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="form-row">
                                        <div class="form-group col-lg-12 p-0">
                                            <label class="form-label">Product Description</label>
                                            <textarea name="products_description_{{ $lang->languages_id }}" id="" class="form-control summernote"
                                                value="">{{ $enProd[$lang->languages_id]->products_description ?? '' }}</textarea>
                                            <div class="invalid-feedback">
                                                Please Enter Product Description
                                            </div>
                                            <span class="text-danger">
                                                @error('products_description')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card mt-1">
                                        <div class="form-row">
                                            <div class="form-group col-lg-12 col-sm-12 px-0">
                                                <label class="form-label">Seo Title</label>
                                                <input name="seometa_title_{{ $lang->languages_id }}" type="text"
                                                    value="{{ $seoData[$lang->languages_id]->seometa_title ?? '' }}"
                                                    class="form-control" placeholder="Enter Seo Title">
                                                <div class="invalid-feedback">
                                                    Please Enter Seo Title
                                                </div>
                                                <span class="text-danger">
                                                    @error('seometa_title')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-12 col-sm-12 px-0 mb-0">
                                                <label class="form-label">Seo meta description</label>
                                                <textarea name="seometa_description_{{ $lang->languages_id }}" type="text" class="form-control"
                                                    placeholder="Enter seo meta description">{{ $seoData[$lang->languages_id]->seometa_desc ?? '' }}</textarea>
                                                <div class="invalid-feedback">
                                                    Please Enter Seo meta description
                                                </div>
                                                <span class="text-danger">
                                                    @error('seometa_description')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="card mt-4">
                        <h6 class="tx-15 mg-b-0">
                            Product Details
                        </h6>
                        <div class="card-header px-0 pb-0">
                            <div class="form-row">
                                <div class="form-group col-lg-6 col-sm-12">
                                    <label class="form-label">Product Slug</label>
                                    <input name="product_slug" type="text" class="form-control"
                                        placeholder="Enter Product Slug" value="{{ $ecmProduct->product_slug ?? '' }}">
                                    @if (!empty($data->language))
                                        @foreach ($data->language as $key => $lang)
                                            @if (!empty($enProd[$lang->languages_id]))
                                                <input type="hidden"
                                                    value="{{ $enProd[$lang->languages_id]->products_name ?? '' }}"
                                                    name="proslug" />
                                            @endif
                                        @endforeach
                                    @endif
                                    <div class="invalid-feedback">
                                        Please Enter Product Slug
                                    </div>
                                    <span class="text-danger">
                                        @error('products_description')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-lg-6 col-sm-12">
                                    <label class="form-label">Sort Order</label>
                                    <input name="sort_order" type="number" class="form-control"
                                        placeholder="Enter Sort Order" value="{{ $ecmProduct->sort_order ?? '' }}"
                                        required>
                                    <div class="invalid-feedback">
                                        Please Enter Sort Order
                                    </div>
                                    <span class="text-danger">
                                        @error('products_description')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card mt-1">
                        <h6 class="tx-15 mg-b-0">
                            Product Setting
                        </h6>
                        <div class="card-header pb-0">
                            <div class="form-row">
                                <div class="form-group d-flex gap-4">
                                    {{-- <label class="form-label">{{ __('hrm.mark_attendence') }} <span
                                            class="text-danger mg-l-5"></label> </br> --}}
                                    <div>
                                        <input type="radio" id="pc_products" name="pc_price" value="1" checked>
                                        <label for="Choice1">Papachina Price</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="setUp_price" name="pc_price" value="0">
                                        <label for="Choice2">Setup Own price (including shipping + other
                                            charges)</label>
                                    </div>

                                    <div class="invalid-feedback">
                                        {{ __('hrm.reason_error') }}
                                    </div>
                                </div>

                                <div class="form-group col-lg-6 col-sm-12 pcQtylist">

                                </div>

                                @if (!empty($data->bulkPrice))
                                    @foreach ($data->bulkPrice as $country => $pricelist)
                                        <div class="form-group col-lg-12 col-sm-12 qtylist">

                                            <div class="card mg-b-20 mg-lg-b-25 ">
                                                <div
                                                    class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                                                    <h6 class="tx- tx-semibold mg-b-0">{{ $country }}</h6>
                                                </div><!-- card-header -->
                                                <div class="card-body ">
                                                    <div class="media d-block d-sm-flex">
                                                        <div class="media-body">
                                                            <div class="table-responsive">
                                                                <div class="table-responsive">
                                                                    <table class="products_details">
                                                                        <tr>
                                                                            <td>QTY</td>
                                                                            @foreach ($pricelist as $key => $producprice)
                                                                                <input type="hidden" name="qty[]"
                                                                                    value="{{ $producprice->product_qty }}">
                                                                                <td>{{ $producprice->product_qty }}
                                                                                </td>
                                                                            @endforeach
                                                                        </tr>

                                                                        <tr>
                                                                            <td>Price</td>
                                                                            @foreach ($pricelist as $key => $producprice)
                                                                                <td class="text-center p-0">
                                                                                    {{--                                                               
                                                               @dd($Ecmprice[$producprice->product_qty]->sale_price) --}}
                                                                                    <input type="number"
                                                                                        name="sale_price[]"
                                                                                        class="form-control col-xs-1  width1 sale_price"
                                                                                        value="{{ $Ecmprice[$producprice->product_qty]->sale_price ?? 0 }}"
                                                                                        placeholder="" required>

                                                                                    <span class="text-danger">
                                                                                        @error('sale_price_{{ $key }}')
                                                                                            {{ $message }}
                                                                                        @enderror
                                                                                    </span>

                                                                                    <div class="invalid-feedback">
                                                                                        Please Enter Price
                                                                                    </div>

                                                                                </td>
                                                                                {{-- @endforeach --}}
                                                                            @endforeach

                                                                        </tr>

                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- media -->
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <div class="p-0">
                            <input type="submit" name="send" class="btn btn-primary"
                                value="{{ __('common.update') }}">
                        </div>
                        <div class="p-0">
                            <a href="{{ route('papachina-product.pc-products.index') }}">
                                <input type="button" name="send" class="btn btn-light"
                                    value="{{ __('common.cancel') }}">
                            </a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

        <script>
            $(document).ready(function() {
                $('.summernote').summernote({
                    placeholder: 'Enter Product Description',
                    height: 150
                });
            });



            $(document).ready(function() {
                $("#pc_products").click(function(event) {
                    $('.sale_price').removeAttr('required');
                    $(".qtylist").hide();

                });
            });
            //select price
            $(document).ready(function() {
                $("#setUp_price").click(function(event) {

                    $('.sale_price').attr('required', 'true');

                    $(".qtylist").show();

                });
            });
            $(document).ready(function() {

                if ($('#pc_products').is(':checked')) {
                    $('.qtylist').hide();
                    $('.sale_price').removeAttr('required');
                }

            });
        </script>
    @endpush
</x-app-layout>
