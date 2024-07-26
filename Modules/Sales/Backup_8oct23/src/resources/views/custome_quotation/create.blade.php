<x-app-layout>
    @section('title', 'Add-Quotation')
    <div class="card contact-content-body">
        <div class="tab-content add-quotation-wrapper">
            <form action="{{ route('sales.quotation.store') }}" method="post" class="needs-validation" novalidate>
                @csrf
                <div class="card-header d-flex align-items-center justify-content-between ">
                    <h6 class="tx-15 mb-0">{{ __('crm.add_quotation') }}</h6>
                </div>
                <div class="card-body">
                    <div class="row ">
                        <!-- Customer Start -->
                        <div class="col-lg-3 col-sm-6 mb-3 mb-lg-0">
                            <label for="country" class="form-label">
                                {{ __('crm.select_customer') }}<span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-control selectsearch" name="customer_id" id="customer_id" required="">
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
                        <input type="hidden" name="source" value="2">
                        <!-- Currency Start -->
                        <div class="col-lg-3 col-sm-6 mb-3 mb-lg-0">
                            <label for="country" class="form-label">{{ __('crm.select_currency') }}<span class="text-danger">*</span></label>
                            <select class="form-select form-control selectsearch" name="currency" id="currency" required>
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
                            <select class="form-select form-control selectsearch" name="default_tax_group" id="tax_group">
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
                            <select class="form-select form-control selectsearch" name="tax_type" id="price_enabled">
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
              
                     <div class="form-group row mt-3 mb-0">
                        <div class="col-sm-12 col-lg-2">
                        <label for="inputPassword" class="w-100 col-form-label">{{ __('crm.customer_address') }}</label>

                        </div>
                        <div class="col-sm-5 col-lg-6">
                            <select class="form-control selectsearch" name="billing_address_id" id="billing_address_id">
                                <!--Data Come Here From jquery-->
                            </select>
                        </div>
                      </div>
                    <!-- Customer Address End-->
                </div>
                   
                
                    <!--add more start--->
                    <div class="card-body mt-2 pt-0 pb-0">
                        <div class="tab-content">
                            <div class="card-header d-md-flex d-lg-flex align-items-center justify-content-end shadow-none px-0">
                               
                                <a href="javascript:void(0)" class="fw-bold addbuttom text-right" id="addbuttom">
                                    <button type="button" class="btn btn-md  btn-primary "><i data-feather=""
                                            class="mg-r-5"></i>{{ __('crm.add_item') }}</button>
                                </a>
                            </div>


                      
                                <div class="table-responsive add-more" id="">
                                    <table class="table table_wrapper create_table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    {{ __('crm.item_name') }}
                                                </th>
                                                <th>
                                                    {{ __('crm.sac_code') }}
                                                </th>
                                                <th>
                                                    {{ __('crm.price') }}
                                                </th>
                                                <th>
                                                    {{ __('crm.discount') }}(%)
                                                </th>
                                                <th class="tax_outer" style="width:150px">
                                                    {{ __('crm.tax') }}
                                                </th>
                                                <th>
                                                    {{ __('crm.amount') }}
                                                </th>
                                                <th></th>
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
                                                </td>
                                                <td class="text-center ">
                                                    <input name="sac_code[]" type="text"
                                                        class="form-control" id="sac_code_1" placeholder="{{ __('crm.sac_code') }}"
                                                        value="">
                                                    <div class="invalid-feedback">
                                                        {{ __('crm.sac_code_error') }}
                                                    </div>
                                                </td>
                                                <td class="text-center ">
                                                    <input name="unit_price[]" type="text" onkeyup="calculation(1)"
                                                        class="form-control unit_price" id="unit_price_1"
                                                        placeholder="{{ __('crm.price') }}" value="">
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
                                                    <select class="form-select form-control tax selectsearch tax_dropdown" onchange="calculation(1)" name="tax_group_id[]" id="tax_1">
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
                    </div>
                    <div class="card-body">
                     <div class="row">
                        <div class="col-lg-6 col-sm-12 ps-4">
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
                                <div class="col-lg-12 col-sm-12 d-flex gap-3 align-item-center px-3 py-2">
                                    <label class="quotation_label mb-0" for="">{{ __('crm.total') }}</label>
                                    <input name="final_cost" type="number" class="form-control" id="grandtotal"
                                        readonly>
                                </div>
                                <input type="hidden" name="total_tax" value="" id="total_tax">
                            </div>
                        </div>
                     </div>
                    
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-12 mt-2">
                            <input type="submit" id="submit"  class="btn btn-primary">
                            <a href="{{ route('sales.quotation.index') }}" class="btn btn-secondary mx-1">Cancel</a>
                        </div>
                     </div>
                    <!--end row-->
               
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
                          
                            <div class="invalid-feedback">
                                {{ __('crm.item_name_error') }}
                            </div>
                        </td>
                        
                        <td>
                            <input name="sac_code[]" type="text"  class="form-control" id="sac_code_${i}" placeholder="{{ __('crm.sac_code') }}" value="" required>
                            <div class="invalid-feedback">
                                {{ __('crm.sac_code') }}
                            </div>
                        </td>

                        <td>
                            <input name="unit_price[]" type="text" onkeyup="calculation(${i})" class="form-control unit_price" id="unit_price_${i}" placeholder="{{ __('crm.price') }}" value="" required>
                            <div class="invalid-feedback">
                                {{ __('crm.unit_price_error') }}
                            </div>
                        </td>
                    

                        <td>
                            <input name="discount[]" type="number" class="form-control discount" id="discount_${i}" placeholder="{{ __('crm.discount') }}" onkeyup="discount(${i})" value="" >
                            <div class="invalid-feedback">
                                {{ __('crm.discount_error') }}
                            </div>
                        </td>
                        <td class="text-center tax_outer">
                                <select class="form-select form-control tax  tax_dropdown selectsearch" onchange="calculation(${i})" name="tax_group_id[]" id="tax_${i}">
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
                                        <b>${DBCustomerAddress[i].crm_customer_address[j].customer_name}</b>(${DBCustomerAddress[i].crm_customer_address[j].customer_email}),
                                        ${DBCustomerAddress[i].crm_customer_address[j].street_address},${DBCustomerAddress[i].crm_customer_address[j].city},${DBCustomerAddress[i].crm_customer_address[j].state},
                                        ${DBCustomerAddress[i].crm_customer_address[j].country_name},${DBCustomerAddress[i].crm_customer_address[j].zipcode}
                                    </option>`;
                            
                        }
                    }
                }

                $('#billing_address_id').html(address_Html);
            }

        
            $(document).ready(function() {
                tax_grp_dropdown($('#tax_group').find(":selected").val());
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

        
           


            // calculate quantity and unit price 
            function calculation(i) {
              
            
                var unit_price = $('#unit_price_'+i).val();
        
                var data =0;
                
                if($('#discount_'+i).val().length>0)
                {   
                    var discountValue = $('#discount_'+i).val();
                    
                    var sub_total= unit_price;
                    var dis_value = (sub_total * discountValue) / 100;
                    
                    data = sub_total - dis_value;
                  
                }else
                {   
                  data = unit_price;
                }
          
                $('#amount_'+i).val(data);
                calculate_sub_total();
    
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
                var unit_price = $('#unit_price_' + i).val();
                var data = unit_price;
                var discount = data * discountValue / 100;
                data = data - discount;
                $('#amount_'+i).val(data);

                calculate_sub_total();
            
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
                        
                        amount= Number($(this).find('.unit_price').val());

                        var data = (amount*discount)/100; 
                        amount=amount-data;

                    }else{
                        amount =  Number($(this).find('.unit_price').val()); 
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
   
            }

        
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @endpush
</x-app-layout>
