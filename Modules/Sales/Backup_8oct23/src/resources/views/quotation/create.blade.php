<x-app-layout>
    @section('title', 'Add Quotation')
    <div class="card">
        <div class="tab-content add-quotation-wrapper">
            <form action="{{ route('sales.quotation.store') }}" method="post" class="needs-validation" novalidate>
                @csrf
                <div class="card-header d-flex align-items-center justify-content-between py-2 px-3">
                    <h6 class="tx-15 mb-0">{{ __('crm.add_quotation') }}</h6>

                </div>
                <div class="card-body">
                    <div class="row ">
                        <!-- Customer Start -->
                        <div class="col-lg-3 col-sm-6 mb-3 mb-lg-0">
                            <label for="country" class="form-label">
                                {{ __('crm.select_customer') }}<span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-control select2" name="customer_id" id="customer_id" required="">
                                <option selected disabled value="" >{{ __('crm.select_customer') }}</option>
                                @if (!empty($customer))
                                    @foreach ($customer as $ls_data)
                                        <option value="{{ $ls_data->customer_id }}"> {{ $ls_data->first_name }} <br/><span style="font-size:3px;">({{$ls_data->email ?? ''}})</span></option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="invalid-feedback">
                                {{ __('crm.select_customer') }}
                            </div>
                        </div>
                        <!-- Customer End -->
                        <input type="hidden" value="{{json_encode($customer)}}" id="dbCustomerData">
                        <!-- Currency Start -->
                        <input type="hidden" name="source" value="1">
                        <div class="col-lg-3 col-sm-6 mb-3 mb-lg-0">
                            <label for="country" class="form-label">{{ __('crm.select_currency') }}<span class="text-danger">*</span></label>
                            <select class="form-select form-control select2" name="currency" id="currency" required>
                                <option selected  value="" disabled>{{ __('crm.select_currency') }}
                                </option>
                                @if (!empty($currency))
                                    @foreach ($currency as $ls_data)
                                        <option value="{{ $ls_data }}" @if($ls_data==$defaultCurrency) selected @endif > {{ $ls_data }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="invalid-feedback">
                                {{ __('crm.select_currency') }}
                            </div>
                        </div>
                        <!-- Currency End -->

                        <input type="hidden" value="{{json_encode($TaxGroup)}}" id="dbtaxGroupData">

                        <!-- Tax-Group Start -->
                        <div class="col-lg-3 col-sm-6 my-2 my-md-0">
                            <label for="country" class="form-label">{{ __('crm.select_tax_group') }}</label>
                            <select class="form-select form-control select2" name="default_tax_group" id="tax_group">
                            @if (!empty($TaxGroup))
                            <option selected  value="" >{{ __('crm.select') }}</option>
                                @foreach ($TaxGroup as $taxgrp_data)
                                    <option value="{{ $taxgrp_data->tax_group_id }}"> {{ $taxgrp_data->tax_group_name }}
                                    </option>
                                @endforeach
                            @endif
                            </select>
                            <div class="invalid-feedback">
                                {{ __('crm.select_tax_group') }}
                            </div>
                        </div>
                        <!-- Tax-Group End -->
                        
                       
                        <!-- With price or not Start -->
                        <div class="col-lg-3 col-sm-6 my-2 my-md-0">
                            <label for="country" class="form-label">{{ __('crm.tax_included') }}</label>
                            <select class="form-select form-control select2" name="tax_type" id="price_enabled">
                                <option value="" disabled>{{ __('crm.select') }}</option>
                                <option value="yes">{{ __('crm.yes') }}</option>
                                <option  value="no" selected>{{ __('crm.no') }}</option>
                            </select>
                            <div class="invalid-feedback">
                                {{ __('crm.select_any_option') }}
                            </div>
                      </div>
                     <!-- With price or not end -->
                    </div>

                    <!--Customer Address Start-->
                    <div class="form-group row mt-0 mt-lg-3 mb-0">
                        <div class="col-sm-12 col-lg-2">
                        <label for="inputPassword" class="w-100 col-form-label">{{ __('crm.customer_address') }}</label>
                        </div>
                        <div class="col-sm-5 col-lg-6">
                            <select class="form-control select2" name="billing_address_id" id="billing_address_id">
                                <!--Data Come Here From jquery-->
                            </select>
                        </div>
                      </div>
                    <!-- Customer Address End-->
                </div>
                    <!--add more start--->
                    <div class="card-body mt-2">
                        <div class="tab-content">
                            <div class="card-header d-md-flex d-lg-flex align-items-center justify-content-between py-2 px-0">
                                <h6 class="tx-15 mb-0">{{ __('crm.search_item') }}</h6>

                                <div class="dropdown_search w-50">
                                    <form class="needs-validation" id="searchform" novalidate>
                                        <input placeholder="{{ __('crm.search_item_placeholder') }}"
                                            class="form-control searchtext" name="searchtext" type="text"
                                            autocomplete="off" />
                                    </form>
                                </div>

                                <div class="mt-2 mt-lg-0">OR</div>

                                <div  class="mt-2 mt-lg-0">
                                    <a href="javascript:void(0)" class="fw-bold addbuttom" id="addbuttom">
                                        <button type="button" class="btn btn-md  btn-primary "><i data-feather=""
                                                class="mg-r-5"></i>{{ __('crm.add_item') }}</button>
                                    </a>
                                </div>

                            </div>

                            <!--Search-suggestion data come here-->
                            <div class="searchItem d-none">
                                <div class="searchItemList"
                                    style="max-height: 300px;z-index: 999;overflow-y: scroll;padding: 13px 10px;border-radius: 2px 2px 20px 20px;background: rgb(240, 240, 240);">

                                </div>
                            </div>
                            <!--Search-suggestion data come here-->

                            <div class="table-responsive add-more" id="">
                                <table class="table table_wrapper create_table">
                                    <thead>
                                        <tr>
                                            <th class="text-left" style="min-width:200px;">
                                                {{ __('crm.item_name') }}
                                            </th>
                                            <th class="text-left" style="min-width:100px;">
                                                {{ __('crm.qty') }}
                                            </th>
                                            <th class="text-left" style="min-width: 150px;">
                                                {{ __('crm.unit_price') }}
                                            </th>
                                            <th class="text-left" style="min-width: 100px;">
                                                {{ __('crm.discount') }}(%)
                                            </th>
                                            <th class="text-left tax_outer" style="min-width: 150px;">
                                                {{ __('crm.tax') }}
                                            </th>
                                            <th class="text-left" style="min-width: 135px;">
                                                {{ __('crm.amount') }}
                                            </th>
                                            <th style="min-width:75px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="add">
                                        <!-- Start -->
                                        <tr class="addmore">
                                            <td>
                                                <input name="item_name[]" type="text" class="form-control"
                                                    id="itemName_1" placeholder="{{ __('crm.item_name') }}" value="" required>
                                                <div class="invalid-feedback">
                                                    {{ __('crm.item_name_error') }}
                                                </div>
                                                <input type="hidden" name="item_id[]">
                                                <input type="hidden" name="item_attributes[]">
                                            </td>
                                            <td class="text-center ">
                                                <input name="quantity[]" type="number"
                                                    class="form-control quantity" id="quantity_1" placeholder="{{ __('crm.qty') }}"
                                                    value="" onblur="calculation(1)" required>
                                                <div class="invalid-feedback">
                                                    {{ __('crm.quantity_error') }}
                                                </div>
                                            </td>
                                            <td class="text-center ">
                                                <input name="unit_price[]" type="text" onkeyup="calculation(1)"
                                                    class="form-control unit_price" id="unit_price_1"
                                                    placeholder="{{ __('crm.unit_price') }}" value="">
                                                <div class="invalid-feedback">
                                                    {{ __('crm.unit_price_error') }}
                                                </div>
                                            </td>
                                            <input type="hidden" value='{{json_encode([])}}' data="json" id="bulk_price_1">
                                            <input type="hidden" value="1"  id="min_prod_qty_1">
                                            <td class="text-center">
                                                <input name="discount[]" type="number"
                                                    class="form-control discount" id="discount_1"
                                                    onkeyup="discount(1)" placeholder="  {{ __('crm.discount') }}" value="">
                                                <div class="invalid-feedback">
                                                    {{ __('crm.discount_error') }}
                                                </div>
                                            </td>
                                            <td class="text-center tax_outer">
                                                <select class="form-select form-control tax select2 tax_dropdown" onchange="calculation(1)" name="tax_group_id[]" id="tax_1">
                                                <option selected  value="" >{{ __('crm.select') }}</option>
                                                @if (!empty($TaxGroup))
                                                    @foreach ($TaxGroup as $taxgrp_data)
                                                        <option value="{{ $taxgrp_data->tax_group_id }}"> {{ $taxgrp_data->tax_group_name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                                </select>

                                                <div class="invalid-feedback">
                                                    {{ __('crm.tax_error') }}
                                                </div>

                                            </td>
                                            <td class="text-center">
                                                <input name="item_cost[]" type="text"
                                                    class="form-control amount" id="amount_1" placeholder="{{ __('crm.amount') }}"
                                                    value="" readonly required>
                                                <div class="invalid-feedback">
                                                    {{ __('crm.amount_error') }}
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm remove" value="1"><svg
                                                        viewBox="0 0 24 24" width="24" height="24"
                                                        stroke="currentColor" stroke-width="2" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="css-i6dzq1">
                                                        <line x1="18" y1="6" x2="6"
                                                            y2="18"></line>
                                                        <line x1="6" y1="6" x2="18"
                                                            y2="18"></line>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 pt-3 ps-4">
                              <label for="country" class="form-label">Note</label>
                               <textarea name="note" rows="2" class="form-control"></textarea>
                                <div class="invalid-feedback">
                                {{ __('crm.select_customer') }}
                               </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 ">
                            <div class="border quotation_wrapper rounded">
                                <div
                                    class="col-lg-12 col-sm-12 gap-3 align-item-center d-flex border-bottom px-3 py-2">
                                    <label class="mb-0 quotation_label"
                                        for="">{{ __('crm.sub_total') }}</label>
                                    <input name="sub_total" type="text" class="form-control addsub_total"
                                        id="sub_total" placeholder="" value="" required>
                                    <div class="invalid-feedback">
                                        {{ __('crm.sub_tatal_error') }}
                                    </div>
                                </div>
                                <div
                                    class="col-lg-12 col-sm-12 gap-3 align-item-center d-flex border-bottom px-3 py-2">
                                    <label class="quotation_label mb-0"
                                        for="">{{ __('crm.discount') }}</label>
                                    <input name="total_discount" type="number" class="form-control totalDiscount"
                                        onkeyup="totalDisc()">
                                    <div class="invalid-feedback">
                                        {{ __('crm.discount_error') }}
                                    </div>
                                </div>
                                <div
                                    class="col-lg-12 col-sm-12 gap-3 align-item-center d-flex border-bottom px-3 py-2">
                                    <label class="quotation_label mb-0"
                                        for="">{{ __('crm.shipping') }}</label>
                                    <input name="shipping_cost" type="number" class="form-control" id="shipping"
                                        onkeyup="ship_disc()">
                                    <div class="invalid-feedback">
                                        {{ __('crm.shipping_error') }}
                                    </div>
                                </div>

                                <div class="col-lg-12 col-sm-12 gap-3 align-item-center d-flex border-bottom px-3 py-2">
                                    <label class="quotation_label mb-0" for="">{{ __('crm.tax') }}</label>
                                    <div class="d-flex gap-5 align-items-center justify-content-center w-100" >
                                        @if (!empty($taxTypeIds))
                                            @foreach ($taxTypeIds as $taxTypeId)
                                                <span class="d-none" id='{{"tax_type_ID_XYD".$taxTypeId}}' value="{{$taxTypeId}}"></span>
                                                <span class="d-none" id='{{"tax_type_Val_XYD".$taxTypeId}}'></span>
                                            @endforeach
                                        @endif 
                                        <span class="">Total Tax</span>
                                        <span class="total_tax"> </span>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-sm-12 d-flex border-bottom px-3 py-2 gap-3">
                                    <label class="quotation_label mb-0"
                                        for="">{{ __('crm.payment_term') }}</label>
                                    <select class="form-select form-control" name="payment_term_id" >
                                        <option selected disabled value="" >
                                            {{ __('crm.select_payment_term') }}</option>
                                        @if (!empty($paymentterms))
                                            @foreach ($paymentterms as $ls_data)
                                                <option value="{{ $ls_data->terms_id }}"> {{ $ls_data->terms_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-12 col-sm-12 d-flex gap-2 align-item-center px-3 py-2">
                                    <label class="quotation_label mb-0" for="">{{ __('crm.total') }}</label>
                                    <input name="final_cost" type="number" class="form-control" id="grandtotal"
                                        readonly>
                                </div>
                                <input type="hidden" name="total_tax" value="" id="total_tax">
                            </div>
                         </div>
                        </div>   
                        <!--end row-->
                          
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4 col-lg-4 col-6  ml-md-0 mt-2 mt-lg-0">
                            <input type="submit" id="submit" name="send" class="btn btn-primary btn-lg"
                                value="Submit">
                            <a href="{{ route('sales.quotation.index') }}" class="btn btn-secondary btn-lg mx-1">Cancel</a>
                        </div>
                    </div>
                    
                    <!--end row-->
                
            </form>
        </div>
    </div>
    
    {{-- Products --}}
    {{-- <input type="hidde" value="{{json_encode($products)}}" id="all_products"> --}}
    {{-- End of Products --}}

    <!-- this is use toggle button -->
    @push('scripts')
        <script type="text/javascript">

            var global_tax_html="";
            var gloabal_tax_disabled="";

          

            const items_attributes=[];


             // remove add more section
            $(document).on('click', '.remove', function(e) {
                e.preventDefault();
                $(this).closest('.addmore').remove();

                $('.addmore').each(function(key,val) {
                    calculation( $(this).find('.remove').val());
                });
            });


            $(document).ready(function() {

                var i = 1;
                $("#addbuttom").on("click", function() {
                    var i = $('table tr').length;
                    html = `<tr class="addmore">
                        <td>
                            <input name="item_name[]" type="text" class="form-control" id="itemName_${i}" placeholder="{{ __('crm.item_name') }}" value="" required>
                            <input type="hidden" name="item_id[]">
                            <input type="hidden" name="item_attributes[]">
                            <div class="invalid-feedback">
                                {{ __('crm.item_name_error') }}
                            </div>
                        </td>
                        <td>
                            <input name="quantity[]" type="number" onblur="calculation(${i})" class="form-control quantity" id="quantity_${i}" placeholder="{{ __('crm.qty') }}" value="" required>
                            <div class="invalid-feedback">
                                {{ __('crm.quantity_error') }}
                            </div>
                        </td>
                        <td>
                            <input name="unit_price[]" type="text" onkeyup="calculation(${i})" class="form-control unit_price" id="unit_price_${i}" placeholder="{{ __('crm.unit_price') }}" value="" required>
                            <div class="invalid-feedback">
                                {{ __('crm.unit_price_error') }}
                            </div>
                        </td>
                        <input type="hidden" value='${JSON.stringify([])}' data="jsonString"  id="bulk_price_${i}">
                        <input type="hidden" value="1"  id="min_prod_qty_${i}">

                        <td>
                            <input name="discount[]" type="number" class="form-control discount" id="discount_${i}" placeholder="{{ __('crm.discount') }}" onkeyup="discount(${i})" value="" >
                            <div class="invalid-feedback">
                                {{ __('crm.discount_error') }}
                            </div>
                        </td>
                        <td class="text-center tax_outer">

                                <select class="form-select form-control tax  tax_dropdown select2" onchange="calculation(${i})" name="tax_group_id[]" id="tax_${i}">
                                <!--Optionn Show from jquery-->  
                                ${global_tax_html}                    
                                </select>

                            <div class="invalid-feedback">
                                {{ __('crm.tax_error') }}
                            </div>
                        </td>
                        <td>
                            <input name="item_cost[]" type="number" class="form-control amount" id="amount_${i}" placeholder="{{ __('crm.amount') }}" value="" readonly required>
                            <div class="invalid-feedback">
                                {{ __('crm.amount_error') }}
                            </div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove" value="${i}"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                        </td>
                    </tr>`
                    $("#add").append(html);
                    i++;
                });


                // Search-suggestion start 

                $(document).on('keyup', '.searchtext', function(e) {
                    e.preventDefault();
                    var searchVal = $(this).val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '{{ route('sales.SearchSuggestion') }}',
                        method: 'POST',
                        data: {
                            search: searchVal
                        },

                        beforeSend: function() {
                            $('.searchItem').removeClass('d-none');
                            $('.searchItemList').html(
                                '<div class="mx-auto text-center"> <i class="fa fa-spinner"></i> Searching....</div>'
                            );
                        },

                        success: function(response) {
                            var html = ``;
                            if ((response[0].products != '')) {
                                $.each(response[0].products, function(key, product) {
                                    html += `<ul style="list-style-type:none">  
                                     <li>
                                        <a href="javascript:void(0)" style="color:black;" value="${product.product_id}" class="search_item">${product.productdescription[0].products_name}</a>
                                    </li> 
                                    </ul>`;
                                });
                            }
                            // $('.searchItem').removeClass('d-none');
                            $(".searchItemList").html(html);
                        },
                        error: function(error) {

                        },

                        complete: function(response) {
                            $('#generateLinkBtn').removeClass('disabled');
                            $('#generateLinkBtn').html('Generate Link');
                         }

                    });
                });

                // hide search suggestion box

                $('.searchItemList').on('mouseleave', function(e) {
                    $(".searchItemList").html('');
                    $('.searchItem').addClass('d-none');
                });

                $(window).scroll(function() {
                    $(".searchItemList").html('');
                    $('.searchItem').addClass('d-none');
                });

                // Search-suggestion start 

                // Search item to details Start

                $(document).on('click', '.search_item', function(e) {

                    var product_id = $(this).attr('value');
                    var html = '';

                    $('.searchItem').addClass('d-none');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '{{ route('sales.SearchItemDetail') }}',
                        method: 'POST',
                        data: {
                            product_id: product_id
                        },
                        success: function(response) {
                            if (response != '') {

                                if (response.product_attribute != '') {
                                    items_attributes.push(response.product_attribute);
                                }
                                jQuery.unique( items_attributes )
                            
                                html += `
                                <tr class="addmore">
                                <td colspan="7">
                                    <div style="border:1px solid #f5f5f5;">
                                    <table>
                                        <tr>
                                        <td style="min-width:300px;">
                                            <input name="item_name[]" type="text" class="form-control"
                                                id="itemName_1456823664${response.product_id}" placeholder="{{ __('crm.item_name') }}" value="${response.products_name}" required>
                                                <input type="hidden" name="item_id[]" value=${response.product_id}>
                                                <div class="invalid-feedback">
                                                {{ __('crm.item_name_error') }}
                                            </div>
                                        </td>
                                        <td class="text-center ">
                                            <input name="quantity[]" type="number"
                                                class="form-control quantity" id="quantity_1456823664${response.product_id}" placeholder="{{ __('crm.qty') }}"
                                                value="${response.product_qty}" onblur="calculation(1456823664${response.product_id})" required>
                                            <div class="invalid-feedback">
                                                {{ __('crm.quantity_error') }}
                                            </div>
                                        </td>
                                        <td class="text-center ">
                                            <input name="unit_price[]" type="text" onkeyup="calculation(1456823664${response.product_id},'','')"
                                                class="form-control unit_price" id="unit_price_1456823664${response.product_id}" placeholder="{{ __('crm.unit_price') }}"
                                                value="${response.attribute_sale_price}">
                                            <div class="invalid-feedback">
                                                {{ __('crm.unit_price_error') }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                        <input type="hidden" value='${JSON.stringify(response.bulkPrice)}' data="jsonString" id="bulk_price_1456823664${response.product_id}">
                                        <input type="hidden" value="${response.product_qty}" id="min_prod_qty_1456823664${response.product_id}">
                                            <input name="discount[]" type="number"
                                                class="form-control discount" id="discount_1456823664${response.product_id}"
                                                onkeyup="discount(1456823664${response.product_id})" placeholder="{{ __('crm.discount') }}" value="">
                                            <div class="invalid-feedback">
                                                {{ __('crm.discount_error') }}
                                            </div>
                                        </td>
                                        <td class="text-center tax_outer">    
                                                <select class="form-select form-control tax  tax_dropdown select2" onchange="calculation(1456823664${response.product_id})" name="tax_group_id[]" id="tax_1456823664${response.product_id}">
                                                <!--Optionn Show from jquery-->  
                                                ${global_tax_html}                    
                                                </select>

                                                <div class="invalid-feedback">
                                                {{ __('crm.tax_error') }}
                                            </div>
                                        </td>
                                        <td class="text-center ">
                                            <input name="item_cost[]" type="number"
                                                class="form-control amount" id="amount_1456823664${response.product_id}" placeholder="{{ __('crm.amount') }}"
                                                value="${response.attribute_sale_price}" readonly required>
                                            <div class="invalid-feedback">
                                                {{ __('crm.amount_error') }}
                                            </div>
                                        </td>
                                        <td>
                                        <button type="button" class="btn btn-danger btn-sm remove" value="1456823664${response.product_id}"><svg
                                                viewBox="0 0 24 24" width="24" height="24"
                                                stroke="currentColor" stroke-width="2" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="css-i6dzq1">
                                                <line x1="18" y1="6" x2="6"
                                                    y2="18"></line>
                                                <line x1="6" y1="6" x2="18"
                                                    y2="18"></line>
                                            </svg>
                                        </button>
                                    </td>
                                    </tr> 
                                    </table>`;

                                if (response.productAttribute != '') {
                                    html += `<table><tr>`;
                                    $.each(response.productAttribute, function(key, attribute) {
                                        html +=
                                            `<td style="min-width:300px;">
                                            <div class="form-group row">
                                            <label for="staticEmail" class="col-lg-3 col-form-label">${attribute.option_name}</label>
                                            <select data=${attribute.products_id}_${response.sale_price} name="item_attributes[${attribute.products_id}][]" id="attribute_1456823664${response.product_id}" class="form-control col-lg-5 product_attributes">`;

                                              $.each(attribute.option_value_list, function(keys,optionvalues) {
                                                if(keys==0)
                                                sele="selected";
                                                else
                                                sele="";

                                            html +=`<option ${sele} value="${attribute.options_id}_${ optionvalues.options_values_id }">${optionvalues.product_options_value.products_options_values_name}</option>`;
                                        });
                                        html += `</select>
                                       </div>
                                      </td>`;
                                    });
                                    html += ` </tr></table>`;
                                }
                                html += ` 
                                     </div>
                                    </td>
                                </tr>`;

                                $("#add").prepend(html);

                                var old_price= $('#sub_total').val();
                                var newPrice=Number(old_price)+Number(response.attribute_sale_price);

                                $('#sub_total').val(newPrice);
                            };
                        },
                        error: function(error) {}
                    });
                });
                // Search item to details End


                // Hide and  show tax option

                // price_enabled=$('#price_enabled').find(":selected").val();
                // if(price_enabled=="no")
                // {
                // //   $('.tax_outer').addClass('d-none');
                // //   gloabal_tax_disabled="d-none";
                // }
                
            });

            // Show Customer Address Dropdown

            $(document).on('change', '#customer_id', function(e) {
                customerAddress($(this).val());
            });

            function customerAddress(customer_id=''){
                var total_data=$('#dbCustomerData').val();
                var DBCustomerAddress=jQuery.parseJSON(total_data);
    
                var address_Html=`<option  value="" >{{ __('crm.select') }}</option>`;

                var tax_result=[];

                for (var i=0 ; i < Object.keys(DBCustomerAddress).length; i++)
                {   
                    if(DBCustomerAddress[i].customer_id==customer_id)
                    {
                        for (var j=0 ; j < Object.keys(DBCustomerAddress[i].crm_customer_address).length; j++)
                        {      
                        address_Html+=`<option value="${DBCustomerAddress[i].crm_customer_address[j].address_id}">
                                        <b>${DBCustomerAddress[i].crm_customer_address[j].customer_name }</b>(${DBCustomerAddress[i].crm_customer_address[j].customer_email}),
                                        ${DBCustomerAddress[i].crm_customer_address[j].street_address},${DBCustomerAddress[i].crm_customer_address[j].city},${DBCustomerAddress[i].crm_customer_address[j].state},
                                        ${DBCustomerAddress[i].crm_customer_address[j].country_name},${DBCustomerAddress[i].crm_customer_address[j].zipcode}
                                    </option>`;
                            
                        }
                    }
                }

                $('#billing_address_id').html(address_Html);
            }

        
            $(document).ready(function() {
                tax_grp_dropdown();
            });

            // Show Selected Dropdown
            $(document).on('change', '#tax_group', function(e) {
                tax_grp_dropdown($(this).val());
            });

            // Change price enable or not   

            $(document).on('change', '#price_enabled', function(e) {
                $('.addmore').each(function(key,val) {
                    calculation( $(this).find('.remove').val());
                });
            });

            var taxes_types = [];

            function tax_calculater(tax_grp_id='',amount=0){
                
                var total_tax_data=$('#dbtaxGroupData').val();
                var DBTax_grp_data=jQuery.parseJSON(total_tax_data);

                var final_price=0;
                var totalTax=0;
                
                if(tax_grp_id !='')
                {   
                    for (var i=0 ; i < Object.keys(DBTax_grp_data).length; i++)
                    {   
                        for (var j=0 ; j< Object.keys(DBTax_grp_data[i].tax_info).length; j++)
                        {   
                            if(DBTax_grp_data[i].tax_group_id==tax_grp_id)
                            {
                                if(Number(DBTax_grp_data[i].tax_info[j].tax_type_id)==Number($("#tax_type_ID_XYD"+DBTax_grp_data[i].tax_info[j].tax_type_id).attr('value')))
                                {   
                                    var Tax=0;
                                    // var totalTax=Number($("#tax_type_ID_XYD"+DBTax_grp_data[i].tax_info[j].tax_type_id).attr('value'));
                                    if($('#price_enabled').find(":selected").attr('value')=="yes")
                                    {   
                                        Tax= amount * Number(DBTax_grp_data[i].tax_info[j].tax_percent)/(100 + Number(DBTax_grp_data[i].tax_info[j].tax_percent));
                                        totalTax+=Tax;

                                        taxes_types[DBTax_grp_data[i].tax_info[j].tax_type_id]= (taxes_types[DBTax_grp_data[i].tax_info[j].tax_type_id] ?? 0) + Tax;
                                    }
                                    else if($('#price_enabled').find(":selected").attr('value')=="no")
                                    {  
                                        Tax=(amount*Number(DBTax_grp_data[i].tax_info[j].tax_percent))/100;
                                        totalTax+=Tax;
                
                                        taxes_types[DBTax_grp_data[i].tax_info[j].tax_type_id]= (taxes_types[DBTax_grp_data[i].tax_info[j].tax_type_id] ?? 0) + Tax;
                                        
                                        // console.log("id"+taxes_types[DBTax_grp_data[i].tax_info[j].tax_type_id]);
                                    }
                                    
                                    if($('#price_enabled').find(":selected").attr('value')=="yes")
                                    {   
                                        temp_amount = Number(amount) - Number(totalTax);
                                        final_price = temp_amount;
                                    }
                                    else
                                        final_price=Number(totalTax)+Number(amount);
                                    
                                    // var oldTaxval=$("#tax_type_Val_XYD"+DBTax_grp_data[i].tax_info[j].tax_type_id).text();

                                    // $("#tax_type_ID_XYD"+DBTax_grp_data[i].tax_info[j].tax_type_id).text(DBTax_grp_data[i].tax_info[j].tax_name);
                                    // $("#tax_type_ID_XYD"+DBTax_grp_data[i].tax_info[j].tax_type_id).removeClass('d-none');

                                    // $("#tax_type_Val_XYD"+DBTax_grp_data[i].tax_info[j].tax_type_id).text(taxes_types[DBTax_grp_data[i].tax_info[j].tax_type_id]);
                                    // $("#tax_type_Val_XYD"+DBTax_grp_data[i].tax_info[j].tax_type_id).removeClass('d-none');
                                    
                                }
                            }
                        }
                    }
                }
                else
                {
                    final_price=Number(totalTax)+Number(amount);
                }
             
              var data = {final_price:final_price, totalTax:totalTax};
              return data;

            }
            
            // Make Tax Group Drop-Down 

            function tax_grp_dropdown(tax_grp_id=''){
                var total_data=$('#dbtaxGroupData').val();
                var DBtaxGroup=jQuery.parseJSON(total_data);
        
                var tax_groupHtml=`<option  value="" >{{ __('crm.select') }}</option>`;

                var tax_result=[];

                for (var i=0 ; i < Object.keys(DBtaxGroup).length; i++)
                {   
                    tax_groupHtml+=`<option data="${DBtaxGroup[i].tax_group_id}" ${tax_grp_id==DBtaxGroup[i].tax_group_id ? 'selected':''} value="${DBtaxGroup[i].tax_group_id}">${DBtaxGroup[i].tax_group_name}</option>`;
                }

                global_tax_html=tax_groupHtml;
            }

        
            // Attribute to price 

            $(document).on('change', '.product_attributes', function(e) {
                var opt_value=$(this).val().split('_');

                var current_id=$(this).attr('id').split('_')[1];

                var product_id=$(this).attr('data').split('_')[0];
                var sale_price=$(this).attr('data').split('_')[1];

                var option_id=opt_value[0];
                var option_value_id=opt_value[1];

                attribute_price(product_id,option_id,option_value_id,sale_price,current_id);
            });
           

            function attribute_price(product_id,options_id,options_values_id,sale_price,current_id) {
                let results=0;
                for (var i=0 ; i < items_attributes.length ; i++)
                {       
                    for (var j=0 ; j < Object.keys(items_attributes[i]).length ; j++)
                    {  
                        var attribute=items_attributes[i][j];
                        if (attribute.products_id ==product_id && attribute.options_id ==options_id  && attribute.options_values_id ==options_values_id) {
                            results = attribute.options_values_price ?? 0;
                        }
                   }
                }
                if(results=='null')
                results=0;

                $('#unit_price_'+current_id).val(Number(results)+Number(sale_price));
                
                calculation(current_id,results);
            }

            // calculate quantity and unit price 
            function calculation(i,attr_prc=0,calcWholeprice='') {
                var quantity = $('#quantity_'+i).val();

                var dataType=$('#bulk_price_'+i).attr('data');

                if(dataType=="json")
                var bulk_prices=jQuery.parseJSON($('#bulk_price_'+i).val());
                else
                var bulk_prices=JSON.parse($('#bulk_price_'+i).val());

                var min_qty=$('#min_prod_qty_'+i).val();
                
                if(quantity<min_qty)
                {
                    $('#quantity_'+i).val(min_qty);
                }

                var quantity = $('#quantity_'+i).val();

                var tempPrice = 0;
                var tempQty = 0;
                
                if(calcWholeprice!=''){
                    if(!$.isEmptyObject(bulk_prices))
                    {   
                        $.each(bulk_prices, function (key, bulk_val) {  
                            if (quantity >= bulk_val.product_qty) {
                                tempPrice = bulk_val.sale_price.toFixed(3);
                                tempQty = bulk_val.product_qty;
                            }
                        });
                    } 

                   var unit_price = $('#unit_price_'+i).val(Number(tempPrice)+Number(attr_prc));
                }
            
                var unit_price = $('#unit_price_'+i).val();
        
                var data =0;
                
                if($('#discount_'+i).val().length>0)
                {   
                    var discountValue = $('#discount_'+i).val();
                    
                    var sub_total= quantity * unit_price;
                    var dis_value = (sub_total * discountValue) / 100;
                    
                    data = sub_total - dis_value;
                  
                }else
                {
                    if(quantity>0 && unit_price>0)
                    data = quantity * unit_price;
                    else
                    data = 0;
                }
                
                // $('#amount_'+i).val(data);

                // sub_total();
                // ship_disc();
                    
                // var unit_price = $('#unit_price_' + i).val();
                // var quantity = $('#quantity_' + i).val();
        
                // var data = quantity * unit_price;
                $('#amount_' + i).val(data);

                calculate_sub_total();
                ship_disc();

            }

            function totalDisc() {
                var sub_total = $('#sub_total').val();
                var discount = $('.totalDiscount').val();

                if(discount.length>0)
                {
                  var dis_value = (sub_total * discount) / 100;
                  var grand_total = sub_total - dis_value;
                }
                else
                {
                  var tax_amount=$('.total_tax').text();
                  var grand_total = Number(sub_total)+Number(tax_amount);
                }
                $('#grandtotal').val(grand_total);
            }

            // Per item discount calculation
            function discount(i) {
       
                var discountValue = $('#discount_' + i).val();
                var quantity = $('#quantity_' + i).val();
                var unit_price = $('#unit_price_' + i).val();
                var data = (quantity * unit_price);
                var discount = data * discountValue / 100;
                data = data - discount;
                $('#amount_'+i).val(data);

                calculate_sub_total();
                ship_disc();
            }
           
            // subtotal calculatation of all addmore items 
            function calculate_sub_total() {
                var sum = 0;
                var sub_total = 0;
                var totalTax=0;
                var amount=0;

                $('.addmore').each(function() {
                    
                    if($(this).find('.discount').val().length > 0){

                        var discount=$(this).find('.discount').val();
                        
                        amount= Number($(this).find('.unit_price').val()) *  Number($(this).find('.quantity').val());

                        var data = (amount*discount)/100; 
                        amount=amount-data;

                    }else{
                        amount =  Number($(this).find('.unit_price').val()) *  Number($(this).find('.quantity').val()); 
                    }

                    var tax_grp_id = $(this).find('.tax_dropdown').find(":selected").attr('value');
                    
                    var tax_data=tax_calculater(tax_grp_id,amount);
                
                    totalTax +=tax_data.totalTax;
                 
                    sum = sum + Number(tax_data.final_price);
                
                    if($('#price_enabled').find(":selected").attr('value')=="no" )
                    {
                        $(this).find('.amount').val(tax_data.final_price);  
                    }

                    if($('#price_enabled').find(":selected").attr('value')=="no")
                    {
                        $('#sub_total').val(parseFloat(sum-totalTax).toFixed(3));
                        $('#grandtotal').val(parseFloat(sum).toFixed(3));
                    }
                    else
                    {
                        $('#sub_total').val(parseFloat(sum).toFixed(3));
                        $('#grandtotal').val(parseFloat(sum+totalTax).toFixed(3));
                    }

                    $('.total_tax').text(parseFloat(totalTax).toFixed(2));
                    $('#total_tax').val(parseFloat(totalTax).toFixed(2));
               
                });
                ship_disc();
            }

            function ship_disc() {

                var sub_total = $('#sub_total').val();
                var discount = $('.totalDiscount').val();
                var grand_total=0;
                // var g_total = $('#grandtotal').val();
                var shipping = $('#shipping').val();
                var tax_amount=Number($('.total_tax').text());

                // var t_amount = Number(g_total) + Number(shipping);
                // $('#grandtotal').val(t_amount);

                if(discount.length>0)
                {
                    var dis_value = (sub_total * discount) / 100;
                    grand_total = sub_total - dis_value;
                }
                else
                {
                    var tax_amount=$('.total_tax').text();
                    grand_total = Number(sub_total)+Number(tax_amount);
                }

                if(shipping.length>0)
                {   
                    var total_amount = Number(grand_total) + Number(shipping);
                    $('#grandtotal').val(total_amount);
                }
                else
                {
                    $('#grandtotal').val(grand_total);
                }                
            }
            
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @endpush
</x-app-layout>
