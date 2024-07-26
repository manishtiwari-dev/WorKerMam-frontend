<x-app-layout>
    @section('title', 'Price Calculator')

    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
        @php
            $product_list = (array) $content->PcProducts_list ?? '';
        @endphp

        <div class="contact-content">
            <div class="layout-specing">
                <div class="card contact-content-body">

                    <div class="card-header d-flex align-items-center justify-content-between py-3 px-3">
                        <h6 class="tx-15 mg-b-0">{{ __('papachina.price_calculator') }}</h6>

                    </div>
                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <div class="form-row">
                                <div class="form-group col-6 ">
                                    <label class="form-label">Country List</label>
                                    <select
                                        class="form-control department select2 @error('countries_id') is-invalid @enderror "
                                        id="countries_id" name="countries_id">
                                        <option selected disable value="" disabled>
                                            Select Country
                                        </option>

                                        @if (!empty($content->country))
                                            @foreach ($content->country as $key => $data)
                                                <option value="{{ $data->countries_id }}">
                                                    {{ $data->countries_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="text-danger country_error_alert"></small>
                                </div>

                                <div class="form-group col-6 skillselect">
                                    <label class="form-label">Product List</label>
                                    <select class="form-control select2  products  " id="productsList"
                                        name="product_id">
                                        <option selected disable value="" disabled>
                                            Select Product
                                        </option>
                                        @if (!empty($product_list))
                                            @foreach ($product_list as $key => $product)
                                                <option value="{{ $product->products_id }}">
                                                    {{ $product->productdescription[0]->products_name ?? '' }}
                                                    ({{ $product->products_model ?? '' }})
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="text-danger product_error_alert"></small>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="products ajaxhtmlDiv" id="product_listing">
                        {{-- html come from ajax --}}
                    </div>

                </div>

            </div>

        </div>
        </div>
        </div>

    @endif

    @push('scripts')
        <script type="text/javascript">
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict'
                var forms = document.querySelectorAll('.needs-validation')
                // Loop over them and prevent submission
                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
            })()
        </script>

        <script>
            // This work On Change of Any Status.



            $(document).on('change', "#productsList", function() {
                let products_id = $(this).val();
                let countries_id = $("#countries_id").val();
                $(".product_error_alert").text("");
                if (countries_id == null)
                    $(".country_error_alert").text("Please select a country.");
                else {
                    tableContent(products_id, countries_id);
                    $(".products").css("display", "block");
                }
            });


            $(document).ready(function() {

                $('#countries_id').on('change', function() {
                    $(".country_error_alert").text("");
                    var countries_id = $('#countries_id').val();
                    var products_id = $('#productsList').val();

                    if (products_id == null)
                        $(".product_error_alert").text("Please select a product.");
                    else {
                        tableContent(products_id, countries_id);
                        $(".products").css("display", "block");
                    }

                });
            });


            function tableContent(productID = '', countryId = '') {

                const url = "{{ route('papachina-product.priceproductDetails') }}";
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
                        products_id: productID,
                        countries_id: countryId
                    },
                    dataType: "json",
                    success: function(result) {
                        $(".ajaxhtmlDiv").html(result.html);
                    }
                });
            }
            
        </script>
    @endpush
</x-app-layout>
