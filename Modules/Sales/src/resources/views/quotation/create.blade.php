<x-app-layout>

    @section('title', $title)

    <link rel="stylesheet" href="{{ asset('asset/css/iCheck/all.css') }}">
    <style>
        .was-validated .form-control:valid,
        .form-control.is-valid {
            padding-right: 0;
        }
    </style>



    <!--start add modal-->
    <div class="modal fade" id="addCustomerCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modalselect2" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('crm.add_customer') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sales.customer.store') }}" id="userForm" method="POST"
                        class="needs-validation" novalidate>
                        @csrf
                        <div class="card-body">
                            <div data-label="Example" class="df-example demo-forms">
                                <fieldset class="form-fieldset">
                                    <legend>{{ __('crm.primary_contact_info') }}</legend>
                                    <div class="form-row">
                                        <div class="form-group col-md-4 col-lg-4 col-12">
                                            <div>
                                                <label class="form-label">{{ __('crm.lead') }}</label>
                                            </div>
                                            <div>
                                                <select class="form-select form-control selectDrop w-100" name="lead_id"
                                                    id="cust_lead_id">
                                                    <option selected value="">Select Lead </option>

                                                    @if (!empty($content->leaddata))
                                                        @foreach ($content->leaddata as $leads)
                                                            <option value="{{ $leads->lead_id }}">
                                                                {{ $leads->contact_name }} - {{ $leads->contact_email }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div class="invalid-feedback">
                                                    {{ __('crm.source_error') }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4 col-lg-4 col-12">
                                            <label class="form-label">{{ __('crm.customer_name') }} <span
                                                    class="text-danger mg-l-5">*</span></label>
                                            <input type="text" class="form-control" id="first_name" name="first_name"
                                                placeholder="{{ __('crm.customer_name_placeholder') }}" required>
                                            <div class="invalid-feedback">
                                                {{ __('crm.customer_name_error') }}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4 col-lg-4 col-12">
                                            <label class="form-label">{{ __('crm.email') }} <span
                                                    class="text-danger mg-l-5">*</span></label>
                                            <input type="email" id="email" class="form-control"
                                                placeholder="{{ __('crm.customer_email_placeholder') }}" name="email"
                                                required>
                                            <div class="invalid-feedback">
                                                {{ __('crm.customer_email_error') }}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4 col-sm-12">
                                            <label class="form-label">{{ __('crm.company_name') }}</label>
                                            <input type="text" class="form-control" id="company_name"
                                                name="company_name"
                                                placeholder="{{ __('crm.company_name_placeholder') }}">
                                            <div class="invalid-feedback">
                                                {{ __('crm.company_name_error') }}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4 col-lg-4 col-12">
                                            <label class="form-label">{{ __('crm.contact_phone') }}</label>
                                            <input type="text" class="form-control"
                                                placeholder="{{ __('crm.phone_placeholder') }}" name="contact"
                                                id="contact_phone">
                                            <div class="invalid-feedback">
                                                {{ __('crm.contact_name_error') }}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4 col-lg-4 col-12">
                                            <label class="form-label">{{ __('crm.website') }}</label>
                                            <input type="text" class="form-control" id="website" name="website"
                                                placeholder="{{ __('crm.website_placeholder') }}">
                                            <div class="invalid-feedback">
                                                {{ __('crm.website_error') }}
                                            </div>
                                        </div>


                                        <div class="form-group col-md-4 col-lg-4 col-12">
                                            <label class="form-label">{{ __('crm.gender') }}</label>
                                            <select
                                                class="form-select form-control selectsearch @error('lead_id') is-invalid @enderror"
                                                name="gender" id="gender">
                                                <option selected value="" disabled>
                                                    {{ __('crm.gender_select') }}</option>
                                                <option value="1">Male</option>
                                                <option value="2">Female</option>
                                                <option value="3">Other</option>

                                            </select>
                                            <div class="invalid-feedback">
                                                {{ __('crm.gender_select') }}
                                            </div>
                                        </div>
                                        <input type="hidden" name="cust" value="0">

                                        <div class="form-group col-lg-4 col-md-6  col-12">
                                            <label class="form-label">Tax Id</label>
                                            <input type="text" name="tax_id" placeholder="Enter Tax Id"
                                                class="form-control">
                                        </div>

                                    </div>
                                </fieldset>
                            </div>
                        </div>


                        <div class="card-body">
                            <div data-label="Example" class="df-example demo-forms">
                                <fieldset class="form-fieldset">
                                    <legend>{{ __('crm.address_info') }}</legend>
                                    <div class="form-row">

                                        <div class="form-group col-lg-4 col-md-4 col-lg-4 col-12">
                                            <label class="form-label">{{ __('crm.street_address') }}</label>
                                            <input type="text" class="form-control" name="street_address"
                                                placeholder="{{ __('crm.street_address_placeholder') }}"
                                                id="street_address" value="">
                                            <div class="invalid-feedback">
                                                {{ __('crm.street_address_error') }}
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-lg-4 col-12">
                                            <label class="form-label">{{ __('crm.city') }}</label>
                                            <input type="text" class="form-control" id="city" name="city"
                                                placeholder="{{ __('crm.city_placeholder') }}">
                                            <div class="invalid-feedback">
                                                {{ __('crm.city_error') }}
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-lg-4 col-12">
                                            <label class="form-label">{{ __('crm.state') }}</label>
                                            <input type="text" class="form-control" id="state" name="state"
                                                placeholder="{{ __('crm.state_placeholder') }}">
                                            <div class="invalid-feedback">
                                                {{ __('crm.state_error') }}
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-lg-4 col-12">
                                            <label class="form-label">{{ __('crm.country') }}</label>
                                            <select
                                                class="form-control  select2 @error('countries_id') is-invalid @enderror "
                                                name="countries_id" id="countries_id">
                                                <option selected disable disabled value="">
                                                    {{ __('crm.country_select') }}</option>
                                                @if (!empty($content->countrydata))
                                                    @foreach ($content->countrydata as $countries)
                                                        <option value="{{ $countries->countries_id }}">
                                                            {{ $countries->countries_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-lg-4 col-12">
                                            <label class="form-label">{{ __('crm.zip') }}</label>
                                            <input type="text" class="form-control" id="zipcode" name="zipcode"
                                                placeholder="{{ __('crm.zip_placeholder') }}">
                                            <div class="invalid-feedback">
                                                {{ __('crm.zip_error') }}
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-lg-4 col-12">
                                            <label class="form-label">Phone</label>
                                            <input type="text" class="form-control" name="phone"
                                                placeholder="Phone">
                                        </div>

                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        <div class="btnclass">
                            <div class="col-sm-12 mb-3 mx-3 p-0">
                                <input type="submit" class="btn btn-primary" value="Submit">

                                <a href="javascript:void(0)" class="btn btn-secondary mx-1" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</a>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end add modal-->


    {{-- Ajax Modal Start for --}} 
    <div class="modal fade" id="addDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="icon-plus"></i>Add Service</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true"><i
                            class="fa fa-times"></i></button>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- Ajax Modal Ends --}}

    

    <!--main Content Start-->
    <div class="card">
        <div class="tab-content add-quotation-wrapper">

            <form action="{{ route('sales.quotation.store') }}" autocomplete="off" method="post"
                class="needs-validation" enctype="multipart/form-data" novalidate>
                @csrf

                <div class="card-header d-flex align-items-center justify-content-between py-3">
                    <h6 class="tx-15 mb-0">Add Quotation</h6>
                </div>

                <div class="card-body">
                    <div class="row ">
                        <!-- Customer Start -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label"> Quotation Number </label>
                                <input type="text" class="form-control" name="quotation_number"
                                    value="{{ $content->inv_prefix }}{{ $content->app_invoice }}" required>
                                <input type="hidden" name="quotation_starting_number" value=" ">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label"> Quotation Date </label>
                                <input type="text" class="form-control datepicker2"
                                    value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}" name="quotation_date"
                                    id="invoice_date" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label"> Expiry Date </label>
                                <input type="text" id="due_date" class="form-control datepicker1"
                                    name="due_date"
                                    value="{{ \Carbon\Carbon::now()->addDays($content->inv_due_after)->format('d/m/Y') }}"
                                    required>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-5 mb-3 ">

                            <label for="country" class="required"> {{ __('crm.select_customer') }}<span
                                    class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-lg-10">
                                    <select class="form-select form-control selectsearch " name="customer_id"
                                        id="customer_id" required>

                                        <option selected disabled value="">{{ __('crm.select_customer') }}
                                        </option>
                                        @if (!empty($content->customers))
                                            @foreach ($content->customers as $ls_data)
                                                <option value="{{ $ls_data->customer_id }}">
                                                    {{ $ls_data->first_name }}
                                                    <br /><span
                                                        style="font-size:3px;">({{ $ls_data->email ?? '' }})</span>
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">
                                        Please Select Customer
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <button type="button"
                                        class="btn btn-sm btn-primary d-flex align-items-center  mt-lg-0 mt-2"
                                        id="addButton">
                                        <span class=" d-sm-inline "><i class="fa fa-plus"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Customer End -->
                        <input type="hidden" value="{{ json_encode($content->customers) }}" id="dbCustomerData">
                        <!-- Currency Start -->

                        <div class="col-lg-2 col-sm-5 mb-3 mb-lg-0">
                            <label for="country" class="form-label">{{ __('crm.select_currency') }}<span
                                    class="text-danger">*</span></label>
                            <select class="form-select form-control selectsearch" name="currency" id="currency"
                                required>
                                <option selected value="" disabled>{{ __('crm.select_currency') }}
                                </option>
                                @if (!empty($content->currency))
                                    @foreach ($content->currency as $ls_data)
                                        <option value="{{ $ls_data }}"
                                            @if ($ls_data == $content->defaultCurrency) selected @endif> {{ $ls_data }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="invalid-feedback">
                                {{ __('crm.select_currency') }}
                            </div>
                        </div>
                        <!-- Currency End -->
                        <input type="hidden" value="{{ json_encode($content->TaxGroup) }}" id="dbtaxGroupData">

                        <!-- Tax-Group Start -->
                        <div class="col-lg-2 col-sm-5 my-2 my-md-0">
                            <label for="country" class="form-label">{{ __('crm.select_tax_group') }}</label>
                            <select class="form-select form-control selectsearch" name="default_tax_group"
                                id="tax_group_data">
                                @if (!empty($content->TaxGroup))
                                    <option selected value="">{{ __('crm.select') }}</option>
                                    @foreach ($content->TaxGroup as $taxgrp_data)
                                        <option value="{{ $taxgrp_data->tax_group_id }}">
                                            {{ $taxgrp_data->tax_group_name }}
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
                        <div class="col-lg-4 col-sm-5 my-2 my-md-0">
                            <label for="country" class="form-label">{{ __('crm.tax_included') }}</label>
                            <select class="form-select form-control selectsearch" name="tax_type" id="price_enabled">
                                <option value="" disabled>{{ __('crm.select') }}</option>
                                <option value="0">{{ __('crm.yes') }}</option>
                                <option value="1" selected>{{ __('crm.no') }}</option>
                            </select>
                            <div class="invalid-feedback">
                                {{ __('crm.select_any_option') }}
                            </div>
                        </div>
                        <!-- With price or not end -->
                        <!--Customer Address Start-->
                        <div class="col-lg-4 col-sm-5 my-2 my-md-0 mt-3">
                            <label for="inputPassword" class="form-label">{{ __('crm.customer_address') }}</label>
                            <select class="form-control selectsearch" name="billing_address_id"
                                id="billing_address_id">
                                <option value="" disabled selected>{{ __('crm.select') }}</option>
                            </select>
                        </div>
                        <!-- Customer Address End-->
                    </div>
                </div>

                <div class="card-body mt-4">

                    <input type="hidden" value="{{ $content->invoice_type }}" id="invoice_type" />
                    <!--add more start--->
                    @if ($content->invoice_type == 'products')

                        <div
                            class="card-header d-md-flex d-lg-flex align-items-center justify-content-between px-0 py-0 mb-4">
                            <h6 class="tx-15 mb-0">{{ __('crm.search_item') }}</h6>

                            <div class="dropdown_search w-50">
                                <input placeholder="{{ __('crm.search_item_placeholder') }}"
                                    class="form-control searchtext" name="searchtext" type="text"
                                    autocomplete="off" />
                                <!--Search-suggestion data come here-->
                                <div class="searchItem  position-relative d-none">
                                    <div class="searchItemList">

                                    </div>
                                </div>
                                <!--Search-suggestion data come here-->

                            </div>

                            <div class="mt-2 mt-lg-0 fw-bold">OR</div>

                            <div class="mt-2 mt-lg-0">
                                <a href="javascript:void(0)" class="fw-bold addbuttom" id="addbuttom">
                                    <button type="button" class="btn btn-md  btn-primary "><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-plus mg-r-5">
                                            <line x1="12" y1="5" x2="12" y2="19">
                                            </line>
                                            <line x1="5" y1="12" x2="19" y2="12">
                                            </line>
                                        </svg>{{ __('crm.add_item') }}</button>
                                </a>
                            </div>

                        </div>



                        <div class="table-responsive add-more" id="">
                            <table class="table table_wrapper create_table">
                                <thead>
                                    <tr>
                                        <th class="text-left" style="min-width:150px;">
                                            {{ __('crm.item_name') }}
                                        </th>
                                        <th class="text-center" style="min-width:100px;">
                                            {{ __('crm.qty') }}
                                        </th>
                                        <th class="text-center" style="min-width: 150px;">
                                            {{ __('crm.unit_price') }}
                                        </th>
                                        <th class="text-center" style="min-width: 150px;">
                                            {{ __('crm.discount') }}
                                        </th>
                                        <th class="text-center" style="min-width: 120px;">
                                            Sub Total
                                        </th>
                                        <th class="text-center tax_outer" style="min-width: 130px;">
                                            {{ __('crm.tax') }}
                                        </th>
                                        <th class="text-center" style="min-width: 120px;">
                                            Total Amt
                                        </th>
                                        <th style="min-width:75px;"></th>
                                    </tr>

                                </thead>
                                <input name="test" type="hidden" class="form-control addsub_total"
                                    id="sub_total" placeholder="" value="" required>
                                <tbody id="add">
                                    <!-- Start -->
                                    <tr class="addmore">
                                        <td>
                                            <input name="item_name[]" type="text" class="form-control"
                                                id="itemName_1" placeholder="{{ __('crm.item_name') }}"
                                                value="" required>
                                            <div class="invalid-feedback">
                                                {{ __('crm.item_name_error') }}
                                            </div>
                                            <input type="hidden" name="item_id[]">
                                            <input type="hidden" name="item_attributes[]">
                                        </td>
                                        <td class="text-center ">
                                            <input name="quantity[]" type="number" class="form-control quantity"
                                                id="quantity_1" placeholder="{{ __('crm.qty') }}" value=""
                                                onblur="calculation(1)" required>
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
                                        <input type="hidden" value='{{ json_encode([]) }}' data="json"
                                            id="bulk_price_1">
                                        <input type="hidden" value="1" id="min_prod_qty_1">
                                        <td class="text-center">
                                            <input name="discount[]" type="number" class="form-control discount"
                                                id="discount_1" onkeyup="discount(1)"
                                                placeholder="  {{ __('crm.discount') }}" value="">
                                            <div class="invalid-feedback">
                                                {{ __('crm.discount_error') }}
                                            </div>
                                        </td>
                                        <td>
                                            <input name="taxable_amount[]" type="text"
                                                class="form-control taxable_amount" id="taxable_amount_1"
                                                onkeyup="" placeholder="Sub Total">
                                        </td>



                                        <td class="text-center tax_outer">
                                            <select class="form-select form-control tax selectsearch tax_dropdown " style="width:100px"
                                                onchange="calculation(1)" name="tax_group_id[]" id="tax_1">
                                                <option selected value="">{{ __('crm.select') }}
                                                </option>
                                                @if (!empty($content->TaxGroup))
                                                    @foreach ($content->TaxGroup as $taxgrp_data)
                                                        <option value="{{ $taxgrp_data->tax_group_id }}">
                                                            {{ $taxgrp_data->tax_group_name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div id="taxcomponent_1"> </div>

                                            <div class="invalid-feedback">
                                                {{ __('crm.tax_error') }}
                                            </div>

                                        </td>
                                        <td class="text-center">
                                            <input name="item_cost[]" type="text" class="form-control amount"
                                                id="amount_1" placeholder="{{ __('crm.amount') }}" value=""
                                                readonly required>
                                            <div class="invalid-feedback">
                                                {{ __('crm.amount_error') }}
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm remove"
                                                value="1"><svg viewBox="0 0 24 24" width="24"
                                                    height="24" stroke="currentColor" stroke-width="2"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round"
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
                                <tbody class="border-top">
                                    <!-- Start -->
                                    <tr>
                                        <td>
                                            <b>Total</b>
                                        </td>
                                        <td class="text-center ">

                                        </td>
                                        <td class="text-center ">
                                            <input name="sub_total" id="finalUnitPrice" type="text"
                                                class="form-control" value="" readonly required>
                                        </td>
                                        <td>
                                            <input name="total_discount" type="number" id="total_Descount"
                                                class="form-control" value="" readonly required>
                                        </td>

                                        <td>
                                            <input name="total_taxable_amount" id="total_tax_amount" type="number"
                                                class="form-control" readonly required>
                                        </td>
                                        <td class="text-center tax_outer">
                                            <input name="total_tax" type="number" id="totaltaxAmount"
                                                class="form-control" value="" readonly required>
                                        </td>
                                        <td class="text-center">
                                            <input name="test" id="total_cost" type="number"
                                                class="form-control" readonly required>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>



                        <div class="row my-3 border p-2">
                            <input name="disc" type="hidden" class="form-control totalDiscount"
                                onkeyup="totalDisc()">
                            <div class="col-lg-3 col-sm-3">

                                <label for="inputPassword" class="form-label">{{ __('crm.shipping') }}</label>
                                <input name="shipping_cost" type="number" class="form-control" id="shipping"
                                    onkeyup="ship_disc()">
                                <div class="invalid-feedback">
                                    {{ __('crm.shipping_error') }}
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-4">

                                <label for="inputPassword" class="form-label">{{ __('crm.total') }}</label>
                                <input name="final_cost" type="number" class="form-control" id="grandtotal"
                                    readonly>
                            </div>
                            @if (!empty($content->taxTypeIds))
                                @foreach ($content->taxTypeIds as $taxTypeId)
                                    <span class="d-none" id='{{ 'tax_type_ID_XYD' . $taxTypeId }}'
                                        value="{{ $taxTypeId }}"></span>
                                    <span class="d-none" id='{{ 'tax_type_Val_XYD' . $taxTypeId }}'></span>
                                @endforeach
                            @endif
                            <span class="total_tax d-none"> </span>
                            <div class="col-lg-3 col-sm-5">
                                <label for="inputPassword" class="form-label">{{ __('crm.payment_term') }}</label>
                                <select class="form-select form-control payment_term_id" id="payment_term_id" name="payment_term_id">
                                    <option selected disabled value="">
                                        {{ __('crm.select_payment_term') }}</option>
                                    @if (!empty($content->paymentterms))
                                        @foreach ($content->paymentterms as $k => $ls_data)
                                            <option value="{{ $ls_data->terms_id }}" {{ $k == 0 ? 'selected' : '' }}>
                                                {{ $ls_data->terms_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-lg-3 col-sm-12 pt-3 ps-4" id="paymentTerm">
                                   
                            </div>
                            
                            <input type="hidden" name="total_tax" value="" id="total_tax">


                            <div class="col-lg-12 col-sm-12 pt-3">
                                <label for="grt" class="form-label">Details</label>
                                <textarea name="details" id="grt" rows="1" class="form-control"></textarea>
                                <div class="invalid-feedback">
                                    {{ __('crm.select_customer') }}
                                </div>
                            </div>
                            <!--end row-->

                        </div>

                        <input type="hidden" name="source" value="1">
                    @else
                        <div>
                            <div class="tab-content">
                                <div class="card-header d-md-flex d-lg-flex align-items-center justify-content-between py-2 px-0">
                                    <h6 class="tx-15 mb-0">{{ __('crm.search_item') }}</h6> 
                                    <div class="dropdown_search w-50">
                                        <div class="dropdown_search w-100">
                                            <div class="d-flex gap-3"> 
                                                <select class="form-control selectsearch search_services_item" id="searchservicestext" name="searchservicestext">
                                                    <option value="" disabled selected>Select Services</option>
                                                    @if(!empty($content->service_items))
                                                    @foreach ($content->service_items as $service)
                                                        <option value="{{$service->id}}">{{$service->item_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <button type="button"
                                                        class="btn btn-sm btn-primary d-flex align-items-center mt-lg-0 mt-2"
                                                        id="addService"> <span class=" d-sm-inline"><i
                                                                class="fa fa-plus"></i></span></button>
                                            </div>
                                        </div> 
                                        <!--Search-suggestion data come here-->
                                        <div class="searchItem  position-relative d-none">
                                            <div class="searchItemList">

                                            </div>
                                        </div>
                                        <!--Search-suggestion data come here-->

                                    </div>

                                    <div class="mt-2 mt-lg-0 fw-bold">OR</div>

                                    <div class="mt-2 mt-lg-0">
                                        <a href="javascript:void(0)" class="fw-bold addServicebuttom"
                                            id="addServicebuttom">
                                            <button type="button" class="btn btn-md  btn-primary "><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-plus mg-r-5">
                                                    <line x1="12" y1="5" x2="12"
                                                        y2="19"></line>
                                                    <line x1="5" y1="12" x2="19"
                                                        y2="12"></line>
                                                </svg>
                                                </i>{{ __('crm.add_item') }}</button>
                                        </a>
                                    </div>

                                </div> 
                                <div class="table-responsive add-more" id="">
                                    <table class="table table_wrapper create_table">
                                        <thead>
                                            <tr>
                                                <th class="text-left" style="min-width:150px;">
                                                    {{ __('crm.item_name') }}
                                                </th>

                                                <th class="text-center" style="min-width:100px;">
                                                    {{ __('crm.sac_code') }}
                                                </th>
                                                <th class="text-center" style="min-width: 150px;">
                                                    {{ __('crm.price') }}
                                                </th>
                                                <th class="text-center" style="min-width: 150px;">
                                                    {{ __('crm.discount') }}
                                                </th>
                                                <th class="text-center tax_outer" style="min-width: 120px;">
                                                    {{ __('crm.taxable_amount') }}
                                                </th>
                                                <th class="text-center tax_outer" style="min-width: 130px;">
                                                    {{ __('crm.tax') }}
                                                </th>
                                                <th class="text-center" style="min-width: 120px;">
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
                                                        id="itemName_1" placeholder="{{ __('crm.item_name') }}"
                                                        value="" required>
                                                    <div class="invalid-feedback">
                                                        {{ __('crm.item_name_error') }}
                                                    </div>
                                                    <input type="hidden" name="item_id[]">
                                                    <input type="hidden" name="item_attributes[]">
                                                </td>

                                                <input name="quantity[]" type="hidden" class="form-control quantity"
                                                    id="quantity_1" placeholder="{{ __('crm.qty') }}"
                                                    value="" onblur="calculation(1)" value="1" required>

                                                <td class="text-center ">
                                                    <input name="sac_code[]" type="text" class="form-control"
                                                        id="sac_code_1" placeholder="{{ __('crm.sac_code') }}"
                                                        value="">
                                                    <div class="invalid-feedback">
                                                        {{ __('crm.sac_code_error') }}
                                                    </div>
                                                </td>
                                                <td class="text-center ">
                                                    <input name="unit_price[]" type="text"
                                                        onkeyup="calculation(1)" class="form-control unit_price"
                                                        id="unit_price_1" placeholder="{{ __('crm.unit_price') }}"
                                                        value="">
                                                    <div class="invalid-feedback">
                                                        {{ __('crm.unit_price_error') }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <input name="discount[]" type="number"
                                                        class="form-control discount" id="discount_1"
                                                        onkeyup="calculation(1)"
                                                        placeholder="  {{ __('crm.discount') }}" value="">
                                                </td>
                                                <td>
                                                    <input name="taxable_amount[]" type="text"
                                                        class="form-control taxable_amount" id="taxable_amount_1"
                                                        onkeyup=""
                                                        placeholder="  {{ __('crm.taxable_amount_place') }}">
                                                </td>
                                                <td class="text-center tax_outer">
                                                    <select
                                                        class="form-select form-control tax selectsearch tax_dropdown"
                                                        onchange="calculation(1)" name="tax_group_id[]"
                                                        id="tax_1" style="width:100px">
                                                        <option selected value="">{{ __('crm.select') }}
                                                        </option>
                                                        @if (!empty($content->TaxGroup))
                                                            @foreach ($content->TaxGroup as $taxgrp_data)
                                                                <option value="{{ $taxgrp_data->tax_group_id }}">
                                                                    {{ $taxgrp_data->tax_group_name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <div id="taxcomponent_1"> </div>

                                                    <div class="invalid-feedback">
                                                        {{ __('crm.tax_error') }}
                                                    </div>

                                                </td>
                                                <input type="hidden" value='{{ json_encode([]) }}' data="json"
                                                    id="bulk_price_1">
                                                <input type="hidden" value="1" id="min_prod_qty_1">
                                                <td class="text-center">
                                                    <input name="item_cost[]" type="text"
                                                        class="form-control amount" id="amount_1"
                                                        placeholder="{{ __('crm.amount') }}" value="" readonly
                                                        required>

                                                    <div class="invalid-feedback">
                                                        {{ __('crm.amount_error') }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm remove"
                                                        value="1"><svg viewBox="0 0 24 24" width="24"
                                                            height="24" stroke="currentColor" stroke-width="2"
                                                            fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round" class="css-i6dzq1">
                                                            <line x1="18" y1="6" x2="6"
                                                                y2="18"></line>
                                                            <line x1="6" y1="6" x2="18"
                                                                y2="18"></line>
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tbody class="border-top">
                                            <!-- Start -->
                                            <tr>
                                                <td>
                                                    <b>Total</b>
                                                </td>
                                                <td class="text-center ">

                                                </td>
                                                <td class="text-center ">
                                                    <input name="sub_total" id="finalUnitPrice" type="text"
                                                        class="form-control" value="" readonly required>
                                                </td>
                                                <td>
                                                    <input name="total_discount" type="number" id="total_Descount"
                                                        class="form-control" value="" readonly required>
                                                </td>
                                                <td>
                                                    <input name="total_taxable_amount" id="total_tax_amount"
                                                        type="number" class="form-control" readonly required>
                                                </td>
                                                <td class="text-center tax_outer">
                                                    <input name="total_tax" type="number" id="totaltaxAmount"
                                                        class="form-control" value="" readonly required>
                                                </td>
                                                <td class="text-center">
                                                    <input name="final_cost" id="total_cost" type="number"
                                                        class="form-control" readonly required>
                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="row">

                                <!--end row-->
                                <div class="col-lg-6 col-sm-12 pt-SearchServices3 ps-4">
                                    <!-- col-lg-12 col-sm-12 gap-3 align-item-center d-flex -->

                                    <input name="sub" type="hidden" class="form-control addsub_total"
                                        id="sub_total" placeholder="" value="" required>
                                    <input name="disc" type="hidden" class="form-control totalDiscount"
                                        onkeyup="totalDisc()">
                                    <input name="shipping_cost" type="hidden" class="form-control" id="shipping"
                                        onkeyup="ship_disc()">
                                    @if (!empty($content->taxTypeIds))
                                        @foreach ($content->taxTypeIds as $taxTypeId)
                                            <span class="d-none" id='{{ 'tax_type_ID_XYD' . $taxTypeId }}'
                                                value="{{ $taxTypeId }}"></span>
                                            <span class="d-none" id='{{ 'tax_type_Val_XYD' . $taxTypeId }}'></span>
                                        @endforeach
                                    @endif <span class="total_tax d-none">0:00</span>

                                    <label class="quotation_label my-2"
                                        for="">{{ __('crm.payment_term') }}</label>

                                    <select class="form-select form-control select2 payment_term_id" id="payment_term_id" name="payment_term_id">
                                        <option selected disabled value="">
                                            {{ __('crm.select_payment_term') }}</option>
                                        @if (!empty($content->paymentterms))
                                            @foreach ($content->paymentterms as $k => $ls_data)
                                                <option value="{{ $ls_data->terms_id }}"
                                                    {{ $k == 0 ? 'selected' : '' }}>
                                                    {{ $ls_data->terms_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <input name="final" type="hidden" class="form-control" id="grandtotal"
                                        readonly>
                                    <input type="hidden" name="tx" value="" id="total_tax">

                                </div>
                                <div class="col-lg-4 col-sm-12 pt-3 ps-4" id="paymentTerm">
                                   
                                </div>


                                <div class="col-lg-12 col-sm-12 pt-3 ps-4">
                                    <label for="country" class="form-label">Quotation Details</label>
                                    <textarea name="details" rows="1" class="form-control">
                                        
                                    </textarea>
                                    <div class="invalid-feedback">
                                        {{ __('crm.select_customer') }}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <input type="hidden" name="source" value="2">
                    @endif
                    <div class="row mt-3">
                        <div class="col-md-4 col-lg-4 col-6  ml-md-0 mt-2 mt-lg-0">
                            <input type="submit" name="send" class="btn btn-primary btn-lg" value="Submit">
                            <a href="{{ route('sales.quotation.index') }}"
                                class="btn btn-secondary btn-lg mx-1">Cancel</a>
                        </div>
                    </div>
                </div>

               
                <!--end row-->
            </form>
        </div>
    </div>
    <!--main Content Start-->


    <!-- this is use toggle button -->
    @push('scripts')
        @php
            $dueDate = $content->inv_due_after;
        @endphp

        <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>

        <script>
            window.onload = function() {
                CKEDITOR.replace('details');
            };
        </script>

        <script src="{{ asset('asset/js/iCheck/icheck.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                $("#addButton").click(function() {

                    $("#addCustomerCreate").modal('show');
                    $('.selectDrop').select2({
                        dropdownParent: $('#addCustomerCreate')
                    });
                    $('#datepicker').datepicker({
                        dateFormat: 'dd/mm/yy',
                        onSelect: function() {
                            var selected = $(this).datepicker("getDate");
                        }
                    });
                });
                $("#addService").click(function() {
                    $("#addServiceCreate").modal('show');
                });

                $(document).ready(function() {
                    $('#addService').click(function() {  
                        var url = "{{ route('sales.service-data') }}";
                        $('.modal-title').html("<i class='icon-plus'></i> Add Services");
                        $.ajaxModal('#addDepartmentModal', url);
                        $('#addDepartmentModal').modal('show');
                    });
                });

                
            });

            $(document).ready(function() {
                $('.selectsearch').select2();
            });
        </script>
        <script type="text/javascript">
            $('input[type="checkbox"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
            });
            $(function() {
                $('.datepicker1').datepicker({
                    dateFormat: 'dd/mm/yy',
                    onSelect: function() {
                        var selected = $(this).datepicker("getDate");
                    }
                });
            });

            $(function() {
                $('.datepicker2').datepicker({
                    dateFormat: 'dd/mm/yy',
                    onSelect: function() {
                        var selected = $(this).datepicker("getDate");
                        var invoice_date = $(this).val();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "{{ route('sales.due-date-change') }}",
                            data: {
                                invoice_date: invoice_date
                            },
                            success: function(response) {
                                console.log(response);
                                $("#due_date").val(response.dueDate)

                            }
                        });
                    }
                });
            });

            var invoice_type = $("#invoice_type").val();

            var global_tax_html = "";
            var gloabal_tax_disabled = "";

            const items_attributes = [];


            // remove add more section
            $(document).on('click', '.remove', function(e) {
                e.preventDefault();
                $(this).closest('.addmore').remove();

                $('.addmore').each(function(key, val) {
                    calculation($(this).find('.remove').val());
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
                        <td>
                            <input name="taxable_amount[]" type="text"  class="form-control taxable_amount" id="taxable_amount_${i}" onkeyup="" placeholder="Sub Total">
                        </td>
                        <td class="text-center tax_outer">

                                <select class="form-select form-control tax  tax_dropdown selectsearch" onchange="calculation(${i})" name="tax_group_id[]" id="tax_${i}">
                                <!--Optionn Show from jquery-->  
                                ${global_tax_html}                    
                                </select>
                                <div id="taxcomponent_${i}">  </div>

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

                $("#addServicebuttom").on("click", function() {
                    var i = $('table tr').length;

                    var tax_group_data = $("#tax_group_data").val();
                    tax_grp_dropdown(tax_group_data);

                    html = `<tr class="addmore">
                        <td>
                            <input name="item_name[]" type="text" class="form-control" id="itemName_${i}" placeholder="{{ __('crm.item_name') }}" value="" required>
                             <div class="invalid-feedback">
                                {{ __('crm.item_name_error') }}
                            </div>
                            <input type="hidden" name="item_id[]"> 
                            <input type="hidden" name="item_attributes[]">
                           
                        </td> 
                            <input name="quantity[]" type="hidden" onblur="calculation(${i})" class="form-control quantity" id="quantity_${i}" placeholder="{{ __('crm.qty') }}" value="" required>
                        <td class="text-center ">
                            <input name="sac_code[]" type="text" class="form-control" id="sac_code_1" placeholder="{{ __('crm.sac_code') }}" value="">
                            <div class="invalid-feedback">
                                {{ __('crm.sac_code_error') }}
                            </div>
                        </td>
                        <td class="text-center ">
                            <input name="unit_price[]" type="text" onkeyup="calculation(${i})"
                                class="form-control unit_price" id="unit_price_${i}"
                                placeholder="{{ __('crm.unit_price') }}" value="">
                            <div class="invalid-feedback">
                                {{ __('crm.unit_price_error') }}
                            </div>
                        </td>
                        <td>
                            <input name="discount[]" type="number" class="form-control discount" id="discount_${i}" placeholder="{{ __('crm.discount') }}" onkeyup="calculation(${i})" value="" >
                            <div class="invalid-feedback">
                                {{ __('crm.discount_error') }}
                            </div>
                        </td>
 
                            <input type="hidden" value='${JSON.stringify([])}' data="jsonString"  id="bulk_price_${i}">
                            <input type="hidden" value="1"  id="min_prod_qty_${i}">


                        <td>
                            <input name="taxable_amount[]" type="text" class="form-control taxable_amount"
                                id="taxable_amount_${i}" onkeyup=""
                            placeholder="  {{ __('crm.taxable_amount_place') }}">
                        </td>

                        <td class="text-center tax_outer">
                            <select class="form-select form-control tax selectsearch tax_dropdown" onchange="calculation(${i})" name="tax_group_id[]" id="tax_${i}"> ${global_tax_html} </select>   
                            <div id="taxcomponent_${i}">  </div>               
                            <div class="invalid-feedback">
                                {{ __('crm.tax_error') }}
                            </div>

                        </td>
                              
                        <td> 
                            <input name="item_cost[]" type="text" class="form-control amount" id="amount_${i}" placeholder="{{ __('crm.amount') }}" value="" readonly required>
 
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
                    if (searchVal.length >= 3) {

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
                                    html += `<ul style="list-style-type:none;padding-left:0;">`;

                                    $.each(response[0].products, function(key, product) {

                                        html += `<li class="py-1">
                                        <a href="javascript:void(0)" style="color:black;" value="${product.product_id}" class="search_item">${product.productdescription[0].products_name}</a>
                                    </li>`;
                                    });

                                    html += `</ul>`;
                                }

                                $(".searchItemList").html(html);
                            },

                            error: function(error) {

                            },

                            complete: function(response) {
                                $('#generateLinkBtn').removeClass('disabled');
                                $('#generateLinkBtn').html('Generate Link');
                            }
                        });
                    }
                });


                //search services
                // $(document).on('keyup', '.searchservicestext', function(e) {
                //     e.preventDefault();
                //     var searchVal = $(this).val();
                //     $.ajaxSetup({
                //         headers: {
                //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //         }
                //     });
                //     $.ajax({
                //         url: '{{ route('sales.SearchServices') }}',
                //         method: 'POST',
                //         data: {
                //             search: searchVal
                //         },

                //         beforeSend: function() {
                //             $('.searchItem').removeClass('d-none');
                //             $('.searchItemList').html(
                //                 '<div class="mx-auto text-center"> <i class="fa fa-spinner"></i> Searching....</div>'
                //             );
                //         },

                //         success: function(response) {
                //             var html = ``;
                //             if ((response[0].services != '')) {
                //                 html += `<ul style="list-style-type:none";padding-left:0;>`;
                //                 $.each(response[0].services, function(key, service) {

                //                     html += `<li class="py-1">
                //                         <a href="javascript:void(0)" style="color:black;" value="${service.id}" class="search_services_item">${service.item_name}</a>
                //                     </li>`;

                //                 });
                //                 html += `</ul>`;
                //             }
                //             $(".searchItemList").html(html);
                //         },
                //         error: function(error) {

                //         },

                //         complete: function(response) {
                //             $('#generateLinkBtn').removeClass('disabled');
                //             $('#generateLinkBtn').html('Generate Link');
                //         }

                //     });
                // });
                // hide search suggestion box

                $('.searchItemList').on('mouseleave', function(e) {
                    $(".searchItemList").html('');
                    $('.searchItem').addClass('d-none');
                });

                $(window).scroll(function() {
                    $(".searchItemList").html('');
                    $('.searchItem').addClass('d-none');
                });
                
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
                                var currentSeconds = Math.floor(Date.now() / 1000);
                                var product_id = response.product_id+currentSeconds;
                                jQuery.unique(items_attributes)

                                html += `
                                <tr class="addmore">
                                <td colspan="12">
                                    <div >
                                    <table>
                                        <tr> 
                                        <td>
                                            <input name="item_name[]" type="text" class="form-control"
                                                id="itemName_${product_id}" placeholder="{{ __('crm.item_name') }}" value="${response.products_name}" required>
                                                <input type="hidden" name="item_id[]" value=${response.product_id}>
                                                <div class="invalid-feedback">
                                                {{ __('crm.item_name_error') }}
                                            </div>
                                        </td>
                                        <td class="text-center ">
                                            <input name="quantity[]" type="number"
                                                class="form-control quantity" id="quantity_${product_id}" placeholder="{{ __('crm.qty') }}"
                                                value="${response.product_qty}" onblur="calculation(${product_id})" required>
                                            <div class="invalid-feedback">
                                                {{ __('crm.quantity_error') }}
                                            </div>
                                        </td>
                                        <td class="text-center ">
                                            <input name="unit_price[]" type="text" onkeyup="calculation(${product_id},'','')"
                                                class="form-control unit_price" id="unit_price_${product_id}" placeholder="{{ __('crm.unit_price') }}"
                                                value="${response.attribute_sale_price}">
                                            <div class="invalid-feedback">
                                                {{ __('crm.unit_price_error') }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                        <input type="hidden" value='${JSON.stringify(response.bulkPrice)}' data="jsonString" id="bulk_price_${product_id}">
                                        <input type="hidden" value="${response.product_qty}" id="min_prod_qty_${response.product_id}">
                                            <input name="discount[]" type="number"
                                                class="form-control discount" id="discount_${product_id}"
                                                onkeyup="discount(${product_id})" placeholder="{{ __('crm.discount') }}" value="${response.discount}">
                                            <div class="invalid-feedback">
                                                {{ __('crm.discount_error') }}
                                            </div>
                                        </td>
                                        <td>
                                            <input name="taxable_amount[]" type="text"  class="form-control taxable_amount" id="taxable_amount_${product_id}" value="${response.sale_price}" onkeyup="" placeholder="Sub Total">
                                        </td>
                                        <td class="text-center tax_outer">    
                                                <select class="form-select form-control tax  tax_dropdown selectsearch" style="width:100px" onchange="calculation(${product_id})" name="tax_group_id[]" id="tax_${product_id}">
                                                <!--Optionn Show from jquery-->  
                                                ${global_tax_html}                    
                                                </select>   
                                                <div id="taxcomponent_${product_id}"></div>

                                                <div class="invalid-feedback">
                                                {{ __('crm.tax_error') }}
                                            </div>
                                        </td>
                                        <td class="text-center ">
                                            <input name="item_cost[]" type="number"
                                                class="form-control amount"  id="amount_${product_id}" placeholder="{{ __('crm.amount') }}"
                                                value="${response.sale_price}" readonly required>
                                            <div class="invalid-feedback">
                                                {{ __('crm.amount_error') }}
                                            </div>
                                        </td>
                                        <td>
                                        <button type="button" class="btn btn-danger btn-sm remove" value="${product_id}"><svg
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
                                            `<td>
                                                <div class="row g-3 align-items-center">
                                                    <div class="col-auto d-flex gap-2 mb-2">
                                                        <label for="staticEmail" class="col-form-label w-100">${attribute.option_name}</label> 
                                                        <select data=${attribute.products_id}_${response.sale_price} name="item_attributes[${attribute.products_id}][]" id="attribute_${product_id}" class="form-control   product_attributes">`;
                                        $.each(attribute.option_value_list, function(keys,
                                            optionvalues) {
                                            if (keys == 0)
                                                sele = "selected";
                                            else
                                                sele = "";

                                            html +=
                                                `<option ${sele} value="${attribute.options_id}_${ optionvalues.options_values_id }">${optionvalues.product_options_value.products_options_values_name}</option>`;
                                        });
                                        html += `</select>
                                                    </div>
                                                </div>
                                            </td>`;
                                    });
                                    html += ` </tr></table>`;
                                } else {

                                    html += ` <input type="hidden" name="item_attributes[]">`;
                                }
                                html += ` 
                                    </div>
                                    </td>
                                </tr>`;

                                $("#add").append(html);
                                calculation(product_id);
                                var old_price = $('#sub_total').val();
                                var newPrice = Number(old_price) + Number(response
                                    .attribute_sale_price);

                                $('#sub_total').val(newPrice);
                            };
                        },
                        error: function(error) {}
                    });
                });
                // Search item to details End

                //search servies
                $(document).on('change', '.search_services_item', function(e) {
                    
                    var services_id = $(this).val(); 

                    var html = '';

                    $('.searchItem').addClass('d-none');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '{{ route('sales.SearcServiceDetail') }}',
                        method: 'POST',
                        data: {
                            services_id: services_id
                        },
                        success: function(response) {
                            var htmlData = `<div class="d-flex gap-1 justify-content-between">`; 
                            var tax_amount = response.services.item_price;
                            var taxPer = 0;
                            if(response.taxGroup != null){
                            $.each(response.taxGroup.tax_info, function(index, DBInfo) {
                                if ($('#price_enabled').find(":selected").attr('value') == "1") {
                                    var tax_per = (tax_amount*DBInfo.tax_percent)/100;
                                }else{ 
                                    var tax_per =  tax_amount * Number(DBInfo.tax_percent) / (100 + Number(DBInfo.tax_percent)); 
                                    
                                }
                                taxPer+=tax_per;
                                htmlData += `<span class="tx-11">${DBInfo.tax_name} : ${tax_per.toFixed(2)}</span>`; 

                            });
                        }
                            htmlData += `</div>`;  

                            var response = response.services;
                            var item_price = response.item_price + taxPer;
                            tax_grp_dropdown(response.tax_group_id);
                            var currentSeconds = Math.floor(Date.now() / 1000);
                            var product_id = response.id+currentSeconds;

                            if (response != '') {

                                console.log(response);
                                html += `
                                            <tr class="addmore">
                                                <td style="min-width:300px;">
                                                    <input name="item_name[]" type="text" class="form-control"
                                                        id="itemName_${product_id}" placeholder="{{ __('crm.item_name') }}" value="${response.item_name}" required>
                                                        <input type="hidden" name="item_id[]" value=${response.id}>
                                                        <div class="invalid-feedback">
                                                        {{ __('crm.item_name_error') }}
                                                    </div>
                                                </td> 
                                                    <input name="quantity[]" type="hidden"
                                                        class="form-control quantity" id="quantity_${product_id}" placeholder="{{ __('crm.qty') }}"
                                                        value="1" onblur="calculation(${product_id})" required>
                                                    <input type="hidden" value='${JSON.stringify(0)}' data="jsonString" id="bulk_price_${product_id}">
                                                    <input type="hidden" value="0" id="min_prod_qty_${product_id}">
                                                <td class="text-center ">
                                                    <input name="sac_code[]" type="text" class="form-control"
                                                        id="sac_code_1" placeholder="{{ __('crm.sac_code') }}"
                                                        value="${response.item_saccode}">
                                                    <div class="invalid-feedback">
                                                        {{ __('crm.sac_code_error') }}
                                                    </div>
                                                </td>
                                                <td class="text-center ">
                                                    <input name="unit_price[]" type="text" onkeyup="calculation(${product_id},'','')"
                                                        class="form-control unit_price" id="unit_price_${product_id}" placeholder="{{ __('crm.unit_price') }}"
                                                        value="${response.item_price}">
                                                    <div class="invalid-feedback">
                                                        {{ __('crm.unit_price_error') }}
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <input name="discount[]" type="text" class="form-control discount" id="discount_${product_id}"  onkeyup="calculation(${product_id})" placeholder="{{ __('crm.discount') }}" value="">
                                                </td>

                                                <td>
                                                    <input name="taxable_amount[]" type="text" class="form-control taxable_amount"
                                                        value="${response.item_price} "id="taxable_amount_${product_id}" onkeyup=""
                                                    placeholder="  {{ __('crm.taxable_amount_place') }}" >
                                                </td>
                                                    
                                                <td class="text-center tax_outer">    
                                                        <select class="form-select form-control tax  tax_dropdown selectsearch" onchange="calculation(${product_id})" name="tax_group_id[]" id="tax_${product_id}">
                                                        <!--Optionn Show from jquery-->  
                                                        ${global_tax_html}                    
                                                        </select>
                                                        <div id="taxcomponent_${product_id}"></div>

                                                        <div class="invalid-feedback">
                                                        {{ __('crm.tax_error') }}
                                                    </div>
                                                </td> 

                                                <td class="text-center ">
                                                    <input name="item_cost[]" type="number"
                                                        class="form-control amount" id="amount_${product_id}" placeholder="{{ __('crm.amount') }}"
                                                        value="${item_price}" readonly required>
                                                    <div class="invalid-feedback">
                                                        {{ __('crm.amount_error') }}
                                                    </div>
                                                </td>
                                                    <input type="hidden" name="item_attributes[]"> 
 
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm remove" value="${product_id}"><svg
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
                                        `;

                                $("#add").append(html);
                                calculation(product_id);
                                var old_price = $('#sub_total').val();
                                var newPrice = Number(old_price) + Number(response
                                    .item_price);

                                $('#sub_total').val(newPrice);
                            };
                        },
                        error: function(error) {}
                    });
                });


            });

            // Show Customer Address Dropdown

            $(document).on('change', '#customer_id', function(e) {
                customerAddress($(this).val());
            });

            function customerAddress(customer_id = '') {
                var total_data = $('#dbCustomerData').val();
                var DBCustomerAddress = jQuery.parseJSON(total_data);

                var address_Html = `<option  value="" >{{ __('crm.select') }}</option>`;

                var tax_result = [];

                for (var i = 0; i < Object.keys(DBCustomerAddress).length; i++) {
                    if (DBCustomerAddress[i].customer_id == customer_id) {
                        for (var j = 0; j < Object.keys(DBCustomerAddress[i].crm_customer_address).length; j++) {
                            console.log(DBCustomerAddress);
                            address_Html += ` 
                                        <option value="${DBCustomerAddress[i].crm_customer_address[j].address_id}" selected>
                                        <b>${(DBCustomerAddress[i].crm_customer_address[j].customer_name != null) ? DBCustomerAddress[i].crm_customer_address[j].customer_name : ''}</b> (${(DBCustomerAddress[i].crm_customer_address[j].customer_email != null) ? DBCustomerAddress[i].crm_customer_address[j].customer_email:''}) ${(DBCustomerAddress[i].crm_customer_address[j].street_address != null) ? DBCustomerAddress[i].crm_customer_address[j].street_address+ ',':''}
                                        ${(DBCustomerAddress[i].crm_customer_address[j].city != null)?DBCustomerAddress[i].crm_customer_address[j].city+',':''}
                                        ${(DBCustomerAddress[i].crm_customer_address[j].state != null)? DBCustomerAddress[i].crm_customer_address[j].state+',':''}
                                        ${(DBCustomerAddress[i].crm_customer_address[j].country_name != '')? DBCustomerAddress[i].crm_customer_address[j].country_name+',':''} 
                                        ${(DBCustomerAddress[i].crm_customer_address[j].zipcode != null)?DBCustomerAddress[i].crm_customer_address[j].zipcode:''}

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
            $(document).on('change', '#tax_group_data', function(e) {
                tax_grp_dropdown($(this).val());
            });

            // Change price enable or not   

            $(document).on('change', '#price_enabled', function(e) {
                $('.addmore').each(function(key, val) {
                    calculation($(this).find('.remove').val());
                });
            });

            var taxes_types = [];

            function tax_calculater(tax_grp_id = '', amount = 0) {
                var total_tax_data = $('#dbtaxGroupData').val();
                var DBTax_grp_data = jQuery.parseJSON(total_tax_data);
 
                var final_price = 0;
                var totalTax = 0;
                var totalTaxPer = 0; 

                if (tax_grp_id != '') {
                    for (var i = 0; i < Object.keys(DBTax_grp_data).length; i++) {
                        for (var j = 0; j < Object.keys(DBTax_grp_data[i].tax_info).length; j++) {
                            if (DBTax_grp_data[i].tax_group_id == tax_grp_id) {
                                if (Number(DBTax_grp_data[i].tax_info[j].tax_type_id) == Number($("#tax_type_ID_XYD" +
                                        DBTax_grp_data[i].tax_info[j].tax_type_id).attr('value'))) {
                                    var Tax = 0;

                                    Tax = Number(DBTax_grp_data[i].tax_info[j].tax_percent);

                                    totalTaxPer += Tax;
                                   
                                    
                                    if ($('#price_enabled').find(":selected").attr('value') == "0") {
                                        // Tax = amount * Number(DBTax_grp_data[i].tax_info[j].tax_percent) / (100 + Number(
                                        //     DBTax_grp_data[i].tax_info[j].tax_percent));
 
                                        // totalTax += Tax;

                                        taxes_types[DBTax_grp_data[i].tax_info[j].tax_type_id] = (taxes_types[DBTax_grp_data[i]
                                            .tax_info[j].tax_type_id] ?? 0) + Tax;
                                    } else if ($('#price_enabled').find(":selected").attr('value') == "1") {
                                        // Tax = (amount * Number(DBTax_grp_data[i].tax_info[j].tax_percent)) / 100;
                                        // totalTax += Tax;

                                        taxes_types[DBTax_grp_data[i].tax_info[j].tax_type_id] = (taxes_types[DBTax_grp_data[i]
                                            .tax_info[j].tax_type_id] ?? 0) + Tax;


                                    }

                                    // if ($('#price_enabled').find(":selected").attr('value') == "0") {
                                    //     temp_amount = Number(amount) - Number(totalTax);
                                    //     final_price = temp_amount;
                                    // } else
                                    //     final_price = Number(totalTax) + Number(amount);



                                }
                            }
                        }
                    }


                    if ($('#price_enabled').find(":selected").attr('value') == "0") {
                        var totalTax = amount * (totalTaxPer / (100 + totalTaxPer));
 
                        temp_amount = Number(amount) - Number(totalTax);
                        final_price = temp_amount;
                    } else{
                        var  totalTax = (amount * totalTaxPer) / 100;

                        final_price = Number(totalTax) + Number(amount);
                    }



                } else {
                    final_price = Number(totalTax) + Number(amount);
                }

                var data = {
                    final_price: final_price,
                    totalTax: totalTax
                };
                return data;

            }

            // Make Tax Group Drop-Down 

            function tax_grp_dropdown(tax_grp_id = '') {
                var total_data = $('#dbtaxGroupData').val();
                var DBtaxGroup = jQuery.parseJSON(total_data);

                var tax_groupHtml = `<option  value="" >{{ __('crm.select') }}</option>`;

                var tax_result = [];

                for (var i = 0; i < Object.keys(DBtaxGroup).length; i++) {
                    tax_groupHtml +=
                        `<option data="${DBtaxGroup[i].tax_group_id}" ${tax_grp_id==DBtaxGroup[i].tax_group_id ? 'selected':''} value="${DBtaxGroup[i].tax_group_id}">${DBtaxGroup[i].tax_group_name}</option>`;
                }

                global_tax_html = tax_groupHtml;
            }
            // Attribute to price 

            $(document).on('change', '.product_attributes', function(e) {
                var opt_value = $(this).val().split('_');

                var current_id = $(this).attr('id').split('_')[1];

                var product_id = $(this).attr('data').split('_')[0];
                var sale_price = $(this).attr('data').split('_')[1];

                var option_id = opt_value[0];
                var option_value_id = opt_value[1];

                attribute_price(product_id, option_id, option_value_id, sale_price, current_id);
            });


            function attribute_price(product_id, options_id, options_values_id, sale_price, current_id) {
                let results = 0;
                for (var i = 0; i < items_attributes.length; i++) {
                    for (var j = 0; j < Object.keys(items_attributes[i]).length; j++) {
                        var attribute = items_attributes[i][j];
                        if (attribute.products_id == product_id && attribute.options_id == options_id && attribute
                            .options_values_id == options_values_id) {
                            results = attribute.options_values_price ?? 0;
                        }
                    }
                }
                if (results == 'null')
                    results = 0;

                $('#unit_price_' + current_id).val(Number(results) + Number(sale_price));

                calculation(current_id, results);
            }

            // calculate quantity and unit price 
            function calculation(i, attr_prc = 0, calcWholeprice = '') {
                $("#paymentTerm").empty();
                

                var quantity = $('#quantity_' + i).val();

                var dataType = $('#bulk_price_' + i).attr('data');

                if (dataType == "json")
                    var bulk_prices = jQuery.parseJSON($('#bulk_price_' + i).val());
                else
                    var bulk_prices = JSON.parse($('#bulk_price_' + i).val());

                var min_qty = $('#min_prod_qty_' + i).val();

                if (quantity < min_qty) {
                    $('#quantity_' + i).val(min_qty);
                }

                var quantity = $('#quantity_' + i).val();

                var tempPrice = 0;
                var tempQty = 0;

                if (calcWholeprice != '') {
                    if (!$.isEmptyObject(bulk_prices)) {
                        $.each(bulk_prices, function(key, bulk_val) {
                            if (quantity >= bulk_val.product_qty) {
                                tempPrice = bulk_val.sale_price.toFixed(3);
                                tempQty = bulk_val.product_qty;
                            }
                        });
                    }

                    var unit_price = $('#unit_price_' + i).val(Number(tempPrice) + Number(attr_prc));
                }

                var unit_price = $('#unit_price_' + i).val();

                var data = 0;

                if ($('#discount_' + i).val().length > 0) {
                    var discountValue = $('#discount_' + i).val();

                    var sub_total = quantity * unit_price;
                    data = sub_total - discountValue;

                } else {
                    if (quantity > 0 && unit_price > 0)
                        data = quantity * unit_price;
                    else
                        data = 0;
                }


                var tax_grp_id = $('#tax_' + i).find(":selected").attr('value');
                var tax_data = tax_calculater(tax_grp_id, data);

                if ($('#price_enabled').find(":selected").attr('value') == "1") {
                    $('#taxable_amount_' + i).val(parseFloat(data).toFixed(2));

                } else {
                    $('#taxable_amount_' + i).val(parseFloat(data - tax_data.totalTax).toFixed(3));

                }

                $('#amount_' + i).val(data);
                calculate_sub_total();
                ship_disc();


                $('.addmore').each(function() {
                    var tax_grp_id = $("#tax_" + i).val();


                    var total_tax_data = $('#dbtaxGroupData').val();
                    var DBTax_grp_data = jQuery.parseJSON(total_tax_data);
                    var tax_amount = $("#taxable_amount_" + i).val();


                    $("#taxcomponent_" + i).empty();
                    $.each(DBTax_grp_data, function(index, DBTax_grp) {
                        if (tax_grp_id == DBTax_grp.tax_group_id) {
                            var html = `<div class="d-flex gap-1 justify-content-between">`;
                            var Tax = 0;
                            var Uprice = $("#unit_price_" + i).val();
                            var Dprice = $("#discount_" + i).val();
                            var tax_amount = $("#taxable_amount_"+i).val();
                            // var Amount = Uprice - Dprice;
                            $.each(DBTax_grp.tax_info, function(index, DBInfo) {
                                // if ($('#price_enabled').find(":selected").attr('value') == "1") {
                                    var tax_per = (tax_amount * DBInfo.tax_percent) / 100;
                                // } else {
                                   
                                //     var tax_per = Amount * Number(DBInfo.tax_percent) / (100 + Number(
                                //         DBInfo.tax_percent));
                                // }

                                html += `<span class="tx-11">${DBInfo.tax_name} : ${tax_per.toFixed(2)}</span>`;

                            });
                            html += `</div>`;
                            $("#taxcomponent_" + i).append(html);
                        }
                    });
                });

                paymentTerms();

            }

            function totalDisc() {

                var sub_total = $('#sub_total').val();

                var discount = $('.totalDiscount').val();
                var tax_amount = $('.total_tax').text();

                if (discount.length > 0) {
                    // var dis_value = (sub_total * discount) / 100; 
                    var grand_total = sub_total - discount + Number(tax_amount);
                } else {
                    var tax_amount = $('.total_tax').text();
                    var grand_total = Number(sub_total) + Number(tax_amount);
                }


                $('#grandtotal').val(grand_total.toFixed(2));
                $('#total_cost').val(grand_total).toFixed(2);
                
            }

            // Per item discount calculation
            function discount(i) {

                var discountValue = $('#discount_' + i).val();
                var quantity = $('#quantity_' + i).val();
                var unit_price = $('#unit_price_' + i).val();
                var data = (quantity * unit_price);
                // var discount = data * discountValue / 100;
                // data = data - discount;
                data = data - discountValue;
                $('#amount_' + i).val(data);
                $('#taxable_amount_' + i).val(data);

                calculate_sub_total();
                ship_disc();
                paymentTerms();
            }

            // subtotal calculatation of all addmore items 
            function calculate_sub_total() {
                var sum = 0;
                var sub_total = 0;
                var totalTax = 0;
                var amount = 0;
                var desc = 0;
                var finalPrice = 0;

                $('.addmore').each(function() {

                    if ($(this).find('.discount').val().length > 0) {

                        var discount = $(this).find('.discount').val();

                        amount = Number($(this).find('.unit_price').val()) * Number($(this).find('.quantity').val());

                        // var data = (amount * discount) / 100;
                        // amount = amount - data;
                        if (discount != '')
                            amount = amount - discount;

                    } else {
                        amount = Number($(this).find('.unit_price').val()) * Number($(this).find('.quantity').val());
                    }

                    var tax_grp_id = $(this).find('.tax_dropdown').find(":selected").attr('value');
                    // tax_component(tax_group_id);
                    var tax_data = tax_calculater(tax_grp_id, amount);


                    totalTax += tax_data.totalTax;

                    if ($(this).find('.discount').val().length > 0)
                        desc = Number(desc) + Number(discount);

                    var FinalAmountPrice = Number($(this).find('.unit_price').val())

                    finalPrice = finalPrice + FinalAmountPrice

                    sum = sum + Number(tax_data.final_price);

                    if ($('#price_enabled').find(":selected").attr('value') == "1") {
                        $(this).find('.amount').val(tax_data.final_price);
                    }

                    if ($('#price_enabled').find(":selected").attr('value') == "1") {
                        $('#sub_total').val(parseFloat(sum - totalTax).toFixed(3));
                        $('#total_tax_amount').val(parseFloat(sum - totalTax));

                        $('#grandtotal').val(parseFloat(sum).toFixed(2));
                        $('#total_cost').val(parseFloat(sum).toFixed(2));
                    } else {
                        $('#sub_total').val(parseFloat(sum).toFixed(3));
                        $('#total_tax_amount').val(parseFloat(sum).toFixed(2));

                        $('#grandtotal').val(parseFloat(sum + totalTax).toFixed(2));
                        $('#total_cost').val(parseFloat(sum + totalTax).toFixed(2));
                    }

                    $('.total_tax').text(parseFloat(totalTax).toFixed(2));
                    $('#total_tax').val(parseFloat(totalTax).toFixed(2));
                    $('#totaltaxAmount').val(parseFloat(totalTax).toFixed(2));
                    $('#total_Descount').val(parseFloat(desc).toFixed(2));
                    $('#finalUnitPrice').val(parseFloat(finalPrice).toFixed(2));

                });
                ship_disc();
            }



            function ship_disc() {

                var sub_total = $('#sub_total').val();
                var discount = $('.totalDiscount').val();
                var grand_total = 0; 
                var shipping = $('#shipping').val();
                var tax_amount = Number($('.total_tax').text());
 

                if (discount.length > 0) { 
                    grand_total = sub_total - discount;
                } else {
                    var tax_amount = $('.total_tax').text();
                    grand_total = Number(sub_total) + Number(tax_amount);
                } 
                if (shipping.length > 0) {
                    var total_amount = Number(grand_total) + Number(shipping);
                    $('#grandtotal').val(total_amount.toFixed(2)); 
                } else {
                    $('#grandtotal').val(grand_total.toFixed(2)); 
                }

                paymentTerms();
                
            }
        </script>
        <script>
            // Save department
            $('#save-service').click(function(e) {
                e.preventDefault();
                $('#serviceFormStore').addClass('was-validated');
                if ($('#serviceFormStore')[0].checkValidity() === false) {
                    event.stopPropagation();
                } else {
                    $.ajax({
                        url: '{{ route('sales.servicesAdd') }}',
                        container: '#serviceFormStore',
                        type: "POST",
                        data: $('#serviceFormStore').serialize(),
                        success: function(response) {
                            Toaster("success", response.message);
                            $("#addServiceCreate").modal('hide');
                        }

                    });
                }
            })
        </script>
        <script>
            $(document).on('change', "#cust_lead_id", function(e) {
                e.preventDefault();
                var data = {
                    lead_id: $("#cust_lead_id").val(),
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('sales.customerDetails') }}",
                    data: data,
                    dataType: "json",

                    success: function(response) {
                        if (response.datalist != '') {
                            var data = response.datalist[0];
                            $("#first_name").val(data.contact_name ?? '');
                            $("#email").val(data.contact_email ?? '');
                            // $("#gender").val(data.crmlead_customer.gender ?? '');
                            $("#contact_phone").val(data.phone ?? '');
                            if (data.crm_lead_contact != '') {
                                $("#website").val(data.crm_lead_contact[0].website ?? '');
                                $("#company_name").val(data.crm_lead_contact[0].company_name ?? '');
                                $("#street_address").val(data.crm_lead_contact[0].street_address ?? '');
                                $("#city").val(data.crm_lead_contact[0].city ?? '');
                                $("#state").val(data.crm_lead_contact[0].state ?? '');
                                $("#zipcode").val(data.crm_lead_contact[0].zipcode ?? '');
                                // $("#countries_id option:selected").val(data.crm_lead_contact[0].countries_id);
                                $("#countries_id option[value=" + data.crm_lead_contact[0].countries_id +
                                    "]").attr('selected', 'selected');
                            }
                        } else {
                            var data = response.datalist[0];
                            $("#email").val('');
                            $("#contact_phone").val('');
                            $("#website").val('');
                            $("#company_name").val('');
                            $("#street_address").val('');
                            $("#city").val('');
                            $("#state").val('');
                            $("#zipcode").val('');
                            $("#countries_id option[value=" + data.crm_lead_contact[0].countries_id + "]");

                        }
                    },

                });
            });


            $(document).ready(function(){
                $('.payment_term_id').change(function(e){
                    e.preventDefault();
                    $("#paymentTerm").empty();
                    var data = {
                        payment_term_id: $(this).val(),
                        final_cost: $("#grandtotal").val(),
                    };
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('sales.PaymentTerm') }}",
                        data: data,
                        dataType: "json", 
                        success: function (response) {
                            var terms_data = response.data;
                            var ad_amount = parseFloat(terms_data.ad_amount).toFixed(2);
                            var bal_amount = parseFloat(terms_data.bal_amount).toFixed(2);

                            var html = `<h5 class="mt-4"> Advance : ${ad_amount} Balance : ${bal_amount} </h5>`;

                             $("#paymentTerm").append(html);
                        },

                    });
                });
            });

            // Per item discount calculation
            let debounceTimer;
            
            let requestInProgress = false;


             // Per item discount calculation
             function paymentTerms() {
                $("#paymentTerm").empty();
                if(!requestInProgress){
                    requestInProgress = true;
                
                    clearTimeout(debounceTimer);

                    debounceTimer = setTimeout(function() {
                    var data = {
                        payment_term_id: $("#payment_term_id").val(),
                        final_cost: $("#grandtotal").val(),
                    };
                    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('sales.PaymentTerm') }}",
                        data: data,
                        dataType: "json", 
                        success: function (response) {
                            var terms_data = response.data;
                            var ad_amount = parseFloat(terms_data.ad_amount).toFixed(2);
                            var bal_amount = parseFloat(terms_data.bal_amount).toFixed(2);

                            var html = `<h5 class="mt-4"> Advance : ${ad_amount} Balance : ${bal_amount} </h5>`;

                            $("#paymentTerm").append(html);
                        },
                        complete: function() {
                                    requestInProgress = false; // Set request status to false after completion
                                }

                    }); 
                }, 500);
                    }
            }
        </script>
    @endpush
</x-app-layout>
