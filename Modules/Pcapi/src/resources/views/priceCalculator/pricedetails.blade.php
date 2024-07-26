@php
    // dd($content);
    if ($content->prodetails != '') {
        $productDetails = $content->prodetails->productDetails ?? '';
        $bulkPrice = $content->bulkPrice;

        $imprint_colors = !empty($productDetails->imprint_colors) ? (array)$productDetails->imprint_colors : [];
        $imprint_positions = !empty($productDetails->imprint_positions) ? (array) $productDetails->imprint_positions : [];
    } else {
        $productDetails = '';
        $imprint_colors = [];
        $imprint_positions = [];
    }

@endphp

@if (!empty($content->prodetails))
    <div class="card mg-b-20 mg-lg-b-25">
        @if ($content->bulkPrice != null)
            @foreach ($content->bulkPrice as $country => $pricelist)
                <div class="card-body ">
                    <div class="media d-block d-sm-flex">
                        <div class="media-body w-100">
                            <div class="table-responsive">
                                <p><b>Price Excluding shipping and your Profit margin</b></p>
                                <table class="products_details">

                                    @php
                                        $minProductQty=0;
                                        // Extract the 'product_qty' values into a separate array
                                        $productQtys = array_column((array)$pricelist, 'product_qty');
                                        // Find the minimum product quantity
                                        $minProductQty = min($productQtys);
                                    @endphp
                                    <input type="hidden" value="{{$minProductQty}}" id="minimum_qty">
                                    
                                    <tr>
                                        <td>QTY</td>
                                        @foreach ($pricelist as $producprice)
                                            <td>{{ $producprice->product_qty }}</td>
                                        @endforeach
                                    </tr>
                                    
                                    <tr>
                                        <td>Price</td>

                                        @foreach ($pricelist as $producprice)
                                            <td>
                                                @if (!empty($content->currencyList[0]->symbol_left) && $producprice->sale_price > 0)
                                                    {{ $content->currencyList[0]->symbol_left }}{{ $producprice->sale_price }}
                                                @endif
                                            </td>
                                        @endforeach

                                    </tr>

                                </table>

                            </div>
                        </div>
                    </div><!-- media -->
                </div>
            @endforeach
        @endif

    </div>
    <div class="row">
        <div class="col-md-8">
            <form id="calculate_update_userForm" class="needs-validation" novalidate>
                <input type="hidden" value="{{ $productDetails->products_id }}" name="products_id"
                    id="sel_products_id" />
                <div class="card ">
                    <div class="card-body ">
                        <div class="media-body">
                            <div class="table-responsive">
                                <table class="module_details mb-1   products_details" cellspacing="0" rules="all"
                                    border="1px" id="" style="border-collapse: collapse;">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 12%; position: relative;">
                                                <span>Quantity</span>
                                            </th>
                                            <td style="padding: 10px; width: 17%; position: relative;">
                                                <input type="text" class="form-control" name="qty" id="qty"
                                                    placeholder="Enter Quantity" required>
                                                <div class="invalid-feedback">
                                                    <p>Enter Qty</p>
                                                </div>
                                                <p class="qty_error text-danger"></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-center" style="width: 3%; position: relative;">
                                                <span>Imprint Color</span>
                                            </th>
                                            <td style="padding: 10px;">
                                                <select class="form-control select2 " id="imprint_color"
                                                    name="imprint_color">
                                                    @if ($imprint_colors != null && sizeof($imprint_colors)>0)
                                                        @foreach ($imprint_colors as $key => $imprint_color_name)
                                                            <option value="{{ $imprint_color_name }}">
                                                                {{ $imprint_color_name }}
                                                            </option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </td>
                                        </tr>
                                        <tr>

                                            <th class="text-center" style="width: 3%; position: relative;">
                                                <span>Imprint Location</span>
                                            </th>
                                            <td style="padding: 10px;">

                                                <select class="form-control select2 " id="imprint_location"
                                                    name="imprint_location">
                                                    @if ($imprint_positions != null && sizeof($imprint_positions)>0)
                                                        @foreach ($imprint_positions as $key => $imprint_positions_name)
                                                            <option value="{{ $imprint_positions_name }}">
                                                                {{ $imprint_positions_name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 text-center">
                    <div class="col-sm-5">
                        <button type="button" class="btn btn-primary" id="calculator_update_btn">Calculator</button>
                    </div>
                </div>
            </form>
            <div class="row mt-2  ajaxCalculatorHtmlDiv">
                {{-- ajax calculatorhtml show --}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-flex flex-column justify-content-center">
                <div class="card">
                    <div class="card-body ">
                        <div class="product_carousel mb-2"> <img class="img-fluid"
                                src="@if (!empty($productDetails->image)) {{ $productDetails->image }} @endif"
                                id="main_product_image" width="350">
                        </div>
                        @if (!empty($productDetails->name))
                            {{ $productDetails->name }}
                        @endif
                        <div class="table-responsive">
                            <table class="" cellspacing="0" rules="all" id="ContentPlaceHolder1_gvAttr">
                                <tbody>
                                    <tr>
                                        <td>Model No :</td>
                                        <td>
                                            @if (!empty($productDetails->products_model))
                                                {{ $productDetails->products_model }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Material:</td>
                                        <td>
                                            @if (!empty($productDetails->material))
                                                {{ $productDetails->material }}
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- <tr>
                                    <td>Featured:</td>
                                    <td>
                                        {{ $productDetails->products_description ?? ''}}
                                    </td>
                                </tr> --}}

                                    @if (!empty($productDetails->imprint_method))
                                        <tr>
                                            <td>Imprint Method :</td>
                                            <td>

                                                {{ $productDetails->imprint_method }}

                                            </td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <td>Product Size :</td>
                                        <td>

                                            {{ $productDetails->p_weight ?? '' }} X
                                            {{ $productDetails->p_width ?? '' }}
                                            X {{ $productDetails->p_length ?? '' }}
                                            {{ $productDetails->p_unit ?? '' }}

                                        </td>
                                    </tr>

                                    @if (!empty($productDetails->qty_per_carton))
                                        <tr>
                                            <td>Qty Per Carton :</td>
                                            <td>
                                                {{ $productDetails->qty_per_carton }}

                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($productDetails->carton_weight))
                                        <tr>

                                            <td>Carton Weight</td>
                                            <td>
                                                {{ $productDetails->carton_weight }}
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>Carton Size :</td>
                                        <td>
                                            {{ $productDetails->carton_height ?? '' }}X
                                            {{ $productDetails->carton_length ?? '' }}
                                            {{ $productDetails->carton_widthcarton_width ?? '' }}
                                            {{ $productDetails->p_unit ?? '' }}

                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="">
        <h6 class="text-center">No Records</h6>
    </div>

@endif

<!-- shipping  ajax-->

<script>

    var minimum_qty = $("#minimum_qty").val();
    var place_status=false;

    $(document).on("keyup", "#qty", function(e) {
        var qty = $(this).val();
        qty = parseFloat(qty);
        if(qty < minimum_qty) {
            place_status=false;
            $('.qty_error').text("Please enter minimum "+minimum_qty+" qty.");
        } else{
            place_status=true;
            $('.qty_error').text(" ");
        }
    });

    $(document).on("click", "#calculator_update_btn", function(e) {
        e.preventDefault();
        $('#calculate_update_userForm').addClass('was-validated');
        if ($('#calculate_update_userForm')[0].checkValidity() === false) {
            event.stopPropagation();
        }
        // var ot let countries_id = $("#countries_id").val();her_data = $('#calculate_update_userForm').serialize();
        else {
            let products_id = $("#sel_products_id").val();
            let countries_id = $("#countries_id").val();
            let imprint_location = $("#imprint_location").val();
            let imprint_color = $("#imprint_color").val();
            let qty = $("#qty").val();
        
            if(place_status==true) { 
             
                $(".ajaxCalculatorHtmlDiv").empty();
                var loader =
                    '<div class="preloader pl-lg pls-primary text-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><linearGradient id="a7"><stop offset="0" stop-color="#020001" stop-opacity="0"></stop><stop offset="1" stop-color="#020001"></stop></linearGradient><circle fill="none" stroke="url(#a7)" stroke-width="15" stroke-linecap="round" stroke-dasharray="0 44 0 44 0 44 0 44 0 44 0 360" cx="100" cy="100" r="70" transform-origin="center"><animateTransform type="rotate" attributeName="transform" calcMode="discrete" dur="2" values="360;324;288;252;216;180;144;108;72;36" repeatCount="indefinite"></animateTransform></circle></svg></div>';

                $(".ajaxCalculatorHtmlDiv").html(loader);
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('papachina-product.calculateShipping') }}",

                    type: "POST",
                    data: {
                        products_id: products_id,
                        qty: qty,
                        imprint_location: imprint_location,
                        imprint_color: imprint_color,
                        countries_id: countries_id
                    },
                    dataType: "json",
                    success: function(result) {
                        //console.log(result);
                        $(".ajaxCalculatorHtmlDiv").html(result.html);

                    },
                    error: function(xhr, status, error) {
                        // Handle error if necessary
                        console.error(xhr, status, error);
                        $(".ajaxCalculatorHtmlDiv").html("An error occurred while fetching data.");
                    }
                });

            } else {
                $('.qty_error').text("Please enter minimum "+minimum_qty+" qty.");
            } 
        }
    });
</script>
<!--end update  ajax-->
