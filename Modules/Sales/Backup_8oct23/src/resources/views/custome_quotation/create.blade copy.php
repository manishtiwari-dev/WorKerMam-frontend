<x-app-layout>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0 pb-0 fw-500">
            <li class="breadcrumb-item"><a href="#" class="text-dark tx-15">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('quotation.index') }}"
                    class="text-dark tx-15">Quotation</a>
            </li>
        </ol>
    </nav>
    <div class="card">
        <div class="tab-content">
            <form action="{{ route('quotation.store') }}" method="post" class="needs-validation" novalidate>
                @csrf
                <div class="card-header d-flex align-items-center justify-content-between py-2 px-3">
                    <h6 class="tx-15 mb-0">{{ __('crm.add_quotation') }}</h6>

                </div>
                <div class="card-body">
                    <div class="row ">
                        <!-- Customer Start -->
                        <div class="col-lg-4 col-sm-5 my-2 my-md-0">
                            <label for="country" class="form-label">
                                {{ __('crm.select_customer') }}<span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-control selectsearch" name="customer_id" id="" required="">
                                <option selected disabled value="" disabled>{{ __('crm.select_customer') }}
                                </option>

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

                        <!-- Currency Start -->
                        <div class="col-lg-4 col-sm-5 my-2 my-md-0">
                            <label for="country" class="form-label">{{ __('crm.select_currency') }}<span class="text-danger">*</span></label>
                            <select class="form-select form-control selectsearch" name="currency" id="" required>
                                <option selected disabled value="" disabled>{{ __('crm.select_currency') }}
                                </option>

                                @if (!empty($currency))
                                    @foreach ($currency as $ls_data)
                                        <option value="{{ $ls_data->currencies_id }}"> {{ $ls_data->currencies_name }}
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
                        <div class="col-lg-2 col-sm-5 my-2 my-md-0">
                            <label for="country" class="form-label">{{ __('crm.select_tax_group') }}</label>
                            <select class="form-select form-control selectsearch" name="tax_group" id="tax_group" >
                               <!-- Data Come here From jquery -->
                            </select>
                            <div class="invalid-feedback">
                                {{ __('crm.select_tax_group') }}
                            </div>
                        </div>
                        <!-- Tax-Group End -->
                        
                       
                        <!-- With price or not Start -->
                        <div class="col-lg-2 col-sm-5 my-2 my-md-0">
                            <label for="country" class="form-label">{{ __('crm.tax_included') }}</label>
                            <select class="form-select form-control selectsearch" name="price_enabled" id="price_enabled">
                                <option  selected value="">{{ __('crm.select') }}</option>
                                <option value="yes">{{ __('crm.yes') }}</option>
                                <option  value="no">{{ __('crm.no') }}</option>
                            </select>
                            <div class="invalid-feedback">
                                {{ __('crm.select_any_option') }}
                            </div>
                      </div>
                     <!-- With price or not end -->

                    </div>
                    <!--add more start--->
                    <div class="card mt-4">
                        <div class="tab-content">
                            <div class="card-header d-md-flex d-lg-flex align-items-center justify-content-between py-2 px-3">
                                <h6 class="tx-15 mb-0">{{ __('crm.search_item') }}</h6>

                                <div class="dropdown_search w-50">
                                    <form class="needs-validation" id="searchform" novalidate>
                                        <input placeholder="{{ __('crm.select_item_search') }}"
                                            class="form-control searchtext" name="searchtext" type="text"
                                            autocomplete="off" />
                                    </form>
                                </div>

                                <span>OR</span>
                                <a href="javascript:void(0)" class="fw-bold addbuttom" id="addbuttom">
                                    <button type="button" class="btn btn-md  btn-primary "><i data-feather=""
                                            class="mg-r-5"></i>{{ __('crm.add_item') }}</button>
                                </a>
                            </div>

                            <!--Search-suggestion data come here-->
                            <div class="searchItem d-none">
                                <div class="searchItemList"
                                    style="max-height: 300px;z-index: 999;overflow-y: scroll;padding: 13px 10px;border-radius: 2px 2px 20px 20px;background: white;">

                                </div>
                            </div>
                            <!--Search-suggestion data come here-->

                            <div class="">
                                <div class="table-responsive add-more" id="">
                                    <table class="table table_wrapper create_table">
                                        <thead>
                                            <tr>
                                                <th class="text-left" style="min-width:300px;">
                                                    {{ __('crm.item_name') }}
                                                </th>
                                                <th class="text-center" style="min-width:100px;">
                                                    {{ __('crm.qty') }}
                                                </th>
                                                <th class="text-center" style="min-width: 150px;">
                                                    {{ __('crm.unit_price') }}
                                                </th>
                                                <th class="text-center" style="min-width: 100px;">
                                                    {{ __('crm.discount') }}
                                                </th>
                                                <th class="text-center tax_outer" style="min-width: 150px;">
                                                    {{ __('crm.tax') }}
                                                </th>
                                                <th class="text-center" style="min-width: 135px;">
                                                    {{ __('crm.amount') }}
                                                </th>
                                                <th style="min-width:76px;"></th>
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
                                                        value="" onkeyup="calculation(1)" required>
                                                    <div class="invalid-feedback">
                                                        {{ __('crm.quantity_error') }}
                                                    </div>
                                                </td>
                                                <td class="text-center ">
                                                    <input name="unit_price[]" type="number" onkeyup="calculation(1)"
                                                        class="form-control unit_price" id="unit_price_1"
                                                        placeholder="{{ __('crm.unit_price') }}" value="">
                                                    <div class="invalid-feedback">
                                                        {{ __('crm.unit_price_error') }}
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <input name="discount[]" type="number"
                                                        class="form-control discount" id="discount_1"
                                                        onkeyup="discount(1)" placeholder="  {{ __('crm.discount') }}" value="">
                                                    <div class="invalid-feedback">
                                                        {{ __('crm.discount_error') }}
                                                    </div>
                                                </td>
                                                <td class="text-center tax_outer">
                                                    {{-- <input name="tax[]" type="number" class="form-control tax"
                                                        id="tax_1" onkeyup="tax(1)" placeholder=" {{ __('crm.tax') }}"
                                                        value=""> --}}
                                                    <select class="form-select form-control tax  tax_dropdown selectsearch" onchange="calculation(1)" name="tax[]" id="tax_1">
                                                      
                                                    </select>

                                                    <div class="invalid-feedback">
                                                        {{ __('crm.tax_error') }}
                                                    </div>

                                                </td>
                                                <td class="text-center">
                                                    <input name="item_cost[]" type="number"
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
                        <!--end row-->
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
                                <div
                                    class="col-lg-12 col-sm-12 gap-3 align-item-center d-flex border-bottom px-3 py-2">
                                    <label class="quotation_label mb-0" for="">{{ __('crm.tax') }}</label>
                                    <div class="d-flex gap-5 align-items-center justify-content-center w-100" >
                                        <span class="total_tax">GST</span>
                                        <span class="total_tax">0.00</span>
                                        <span class="total_tax">CGST</span>
                                        <span class="total_tax">0.00</span>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-sm-12 d-flex border-bottom px-3 py-2">
                                    <label class="quotation_label mb-0"
                                        for="">{{ __('crm.payment_term') }}</label>
                                    <select class="form-select form-control" name="payment_term_id" id="">
                                        <option selected disabled value="" disabled>
                                            {{ __('crm.select_payment_term') }}</option>
                                        @if (!empty($paymentterms))
                                            @foreach ($paymentterms as $ls_data)
                                                <option value="{{ $ls_data->terms_id }}"> {{ $ls_data->terms_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-12 col-sm-12 d-flex gap-3 align-item-center px-3 py-2">
                                    <label class="quotation_label mb-0" for="">{{ __('crm.total') }}</label>
                                    <input name="final_cost" type="number" class="form-control" id="grandtotal"
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-6 mx-sm-auto ml-md-0">
                            <input type="submit" id="submit" name="send" class="btn btn-primary"
                                value="Submit">
                            <a href="{{ route('quotation.index') }}" class="btn btn-secondary mx-1">Cancel</a>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </form>
        </div>
    </div>

    <!-- this is use toggle button -->
    @push('scripts')
        <script type="text/javascript">

            var global_tax_html="";
            var gloabal_tax_disabled="";

            $('.selectsearch').select2({
            searchInputPlaceholder: 'Search options'
            });

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
                            <input name="quantity[]" type="number" onkeyup="calculation(${i})" class="form-control quantity" id="quantity_${i}" placeholder="{{ __('crm.qty') }}" value="" required>
                            <div class="invalid-feedback">
                                {{ __('crm.quantity_error') }}
                            </div>
                        </td>
                        <td>
                            <input name="unit_price[]" type="number" onkeyup="calculation(${i})" class="form-control unit_price" id="unit_price_${i}" placeholder="{{ __('crm.unit_price') }}" value="" required>
                            <div class="invalid-feedback">
                                {{ __('crm.unit_price_error') }}
                            </div>
                        </td>
                        <td>
                            <input name="discount[]" type="number" class="form-control discount" id="discount_${i}" placeholder="{{ __('crm.discount') }}" onkeyup="discount(${i})" value="" required>
                            <div class="invalid-feedback">
                                {{ __('crm.discount_error') }}
                            </div>
                        </td>
                        <td class="text-center tax_outer ${gloabal_tax_disabled}">

                                <select class="form-select form-control tax  tax_dropdown selectsearch" onchange="calculation(${i})" name="tax[]" id="tax_${i}">
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
                        url: '{{ route('SearchSuggestion') }}',
                        method: 'POST',
                        data: {
                            search: searchVal
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
                            $('.searchItem').removeClass('d-none');
                            $(".searchItemList").append(html);
                        },
                        error: function(error) {

                        }
                    });
                });

                // hide search suggestion box

                $('.searchItemList').on('mouseleave', function(e) {
                    $('.searchItem').addClass('d-none');
                });

                $(window).scroll(function() {
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
                        url: '{{ route('SearchItemDetail') }}',
                        method: 'POST',
                        data: {
                            product_id: product_id
                        },
                        success: function(response) {
                            // console.log(response);

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
                                                value="${response.product_qty}" onkeyup="calculation(1456823664_${response.product_id})" required>
                                            <div class="invalid-feedback">
                                                {{ __('crm.quantity_error') }}
                                            </div>
                                        </td>
                                        <td class="text-center ">
                                            <input name="unit_price[]" type="number" onkeyup="calculation(1456823664_${response.product_id})"
                                                class="form-control unit_price" id="unit_price_1456823664${response.product_id}" placeholder="{{ __('crm.unit_price') }}"
                                                value="${response.attribute_sale_price}">
                                            <div class="invalid-feedback">
                                                {{ __('crm.unit_price_error') }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <input name="discount[]" type="number"
                                                class="form-control discount" id="discount_1456823664${response.product_id}"
                                                onkeyup="discount(1456823664${response.product_id})" placeholder="{{ __('crm.discount') }}" value="">
                                            <div class="invalid-feedback">
                                                {{ __('crm.discount_error') }}
                                            </div>
                                        </td>
                                        <td class="text-center tax_outer ${gloabal_tax_disabled}">    
                                                <select class="form-select form-control tax  tax_dropdown selectsearch" onchange="calculation(1456823664${response.product_id})" name="tax[]" id="tax_1456823664${response.product_id}">
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
                                        <button type="button" class="btn btn-danger btn-sm remove"><svg
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

                price_enabled=$('#price_enabled').find(":selected").val();
                if(price_enabled=="no")
                {
                //   $('.tax_outer').addClass('d-none');
                //   gloabal_tax_disabled="d-none";
                }
                
            });

            // Hide and  show tax option
            $(document).on('change', '#price_enabled', function(e) {
                if($(this).val()=="yes")
                {
                    // $('.tax_outer').removeClass('d-none');
                    // gloabal_tax_disabled="";
                    calculation(1);
                }
                else
                {
                    // $('.tax_outer').addClass('d-none');
                    // gloabal_tax_disabled="d-none";
                    calculation(0);
                }
            });

            // Change Tax Group then change tax percentage 
            // $(document).ready(function() {
            //     var total_data=$('#dbtaxGroupData').val();
            //     var DBtaxGroup=jQuery.parseJSON(total_data);
            //     console.log(DBtaxGroup);
            // });

            $(document).ready(function() {
               var total_data=$('#dbtaxGroupData').val();
               var DBtaxGroup=jQuery.parseJSON(total_data);
               var taxGroupId=$(this).val();

               var tax_groupHtml=`<option selected  value="" >{{ __('crm.select') }}</option>`;

               var tax_result=[];

               for (var i=0 ; i < Object.keys(DBtaxGroup).length; i++)
                {   
                    // console.log(DBtaxGroup[i]);
                    tax_groupHtml+=`<option data="${DBtaxGroup[i].tax_group_id}" value="${DBtaxGroup[i].tax_group_id}">${DBtaxGroup[i].tax_group_name}</option>`;

                    // for (var j=0 ; j < Object.keys(DBtaxGroup[i].tax_info).length ; j++)
                    // {  
                    //     if(taxGroupId==DBtaxGroup[i].tax_info[j].tax_group_id)
                    //     {
                    //         tax_result.push(DBtaxGroup[i].tax_info[j]);
                    //     }
                    // }
                }


                // $.each(tax_result, function(key, value) {
                //     tax_percentHtml+=`<option ${key==0 ? 'selected' :''} data="${value.tax_percent}" value="${value.tax_id}">${value.tax_name}</option>`;
                // });

                global_tax_html=tax_groupHtml;
                $("#tax_group").html(tax_groupHtml);
                $(".tax_dropdown").html(tax_groupHtml);

               if(taxGroupId=='')
                $("#tax_percentage").prop("disabled", true);
            
            });

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

                calculation(current_id);

            }

            // calculate quantity and unit price 
            function calculation(i) {
                var unit_price = $('#unit_price_' + i).val();
                var quantity = $('#quantity_' + i).val();
        
                var data = quantity * unit_price;
                $('#amount_' + i).val(data);
                sub_total();
                ship_disc();
            }

            function totalDisc() {
                var sub_total = $('#sub_total').val();
                var discount = $('.totalDiscount').val();
                var dis_value = Math.round(sub_total * discount / 100);
                var grand_total = sub_total - dis_value;
                $('#grandtotal').val(grand_total);
            }

            // Per item discount calculation
            function discount(i) {
                var discountValue = $('#discount_' + i).val();
                var quantity = $('#quantity_' + i).val();
                var unit_price = $('#unit_price_' + i).val();
                var data = (quantity * unit_price);
                var discount = Math.round(data * discountValue / 100);
                data = data - discount;
                $('#amount_' + i).val(data);
                sub_total();
                ship_disc();
            }
           
            // subtotal calculatation of all addmore items 
            function sub_total() {
                var sum = 0;
                var totalTax=0;

                $('.addmore').each(function() {
                    var amount = $(this).find('.amount').val();
                    var tax = $(this).find('.tax_dropdown').find(":selected").attr('data');

                    if(tax!= '')
                    {
                        if($('#price_enabled').val()=="yes")
                        {
                            totalTax+=(amount*tax)/100;
                        }
                    }

                    sum = sum + Number(amount);
                    $('#sub_total').val(sum);
                    $('.total_tax').text(totalTax);
                    $('#grandtotal').val(sum);
                });
                ship_disc();
            }

            function ship_disc() {
                var g_total = $('#grandtotal').val();
                var shipping = $('#shipping').val();
                // console.log(g_total);
                // console.log(shipping);
                var t_amount = Number(g_total) + Number(shipping);
                // console.log(t_amount);
                $('#grandtotal').val(t_amount);

            }
            
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @endpush
</x-app-layout>
