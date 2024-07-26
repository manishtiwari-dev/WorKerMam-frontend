<x-app-layout>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent px-0 pb-0 fw-500">
        <li class="breadcrumb-item"><a href="#" class="text-dark tx-15">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('quotation.index') }}" class="text-dark tx-15">Quotation</a></li>

    </ol>
</nav>
    <div class="card">
        <div class="tab-content">
            <form action="{{route('quotation.update',$response->quotation_id)}}" method="post" class="needs-validation" novalidate>
            @csrf
                    @method('PUT')
                <div class="card-header d-flex align-items-center justify-content-between py-2 px-3">
                    <h6 class="tx-15 mb-0">{{ __('crm.update_quotation')}}</h6>
                    
                </div>
                <div class="card-body">
                    <div class="row ">
                        <div class="col-lg-5 col-sm-5 my-2 my-md-0">
                            <label for="country" class="form-label">
                                {{__('crm.select_customer')}}
                            </label>
                            <select class="form-select form-control" name="customer_id" id="" required="">
                                <option selected disabled value="" disabled>{{__('crm.select_customer')}}</option>
                                
                                @if(!empty($customer))
                                @foreach ($customer as $ls_data)
                                   

                                        <option value="@if(!empty($ls_data)){{ $ls_data->customer_id }}@endif" @if(!empty($response->crm_quotation_customer->customer_id)){{$ls_data->customer_id == $response->crm_quotation_customer->customer_id ? 'selected' : ''  }}@endif>{{ $ls_data->first_name }}</option>
                                @endforeach
                                @endif
                                
                            </select>
                            <div class="invalid-feedback">
                                {{__('crm.select_customer')}}
                            </div>
                        </div>
                        <div class="col-lg-5 col-sm-5 my-2 my-md-0">
                            <label for="country" class="form-label">{{ __('crm.select_currency')}}</label>
                            <select class="form-select form-control" name="currency" id="" required>
                                <option selected disabled value="" disabled>{{ __('crm.select_currency')}}</option>

                                @if(!empty($currency))
                                @foreach ($currency as $ls_data)
                                
                                <option value="@if(!empty($ls_data)){{ $ls_data->currencies_id }}@endif" {{$ls_data->currencies_id == $response->currency ? 'selected' : '' }}>{{ $ls_data->currencies_name }}</option>
                                    
                                @endforeach
                                @endif
                            </select>
                            <div class="invalid-feedback">
                                {{ __('crm.select_currency')}}
                            </div>
                        </div>
                    </div>
                    <!--add more start--->
                    <div class="card mt-3">
                        <div class="tab-content">
                            <div class="card-header d-md-flex d-lg-flex align-items-center justify-content-between py-2 px-3">
                                <h6 class="tx-15 mb-0">Item List</h6>
                               
                                <div class="dropdown_search">
                                        <form class="needs-validation" id="searchform" novalidate>
                                            <input placeholder="{{ __('crm.select_item_search')}}"
                                                class="form-control searchtext" name="searchtext" type="text" autocomplete="off"
                                                 />
                                           
                                        </form>
                                    </div>
                                    
                                    <div class="searchItem hide ">
                                    <div class="searchItemList">
                                       
                                    </div>
                                    </div>


                                <span>OR</span>
                                <a href="javascript:void(0)" class="fw-bold addbuttom" id="addbuttom" >
                                    <button type="button" class="btn btn-md  btn-primary "><i data-feather="" class="mg-r-5"></i>{{ __('crm.add_item')}}</button>
                                </a>
                            </div>
                            <div class="">
                                <div class="table-responsive add-more" id="">
                                    <table class="table table_wrapper create_table">
                                        <thead>
                                            <tr>
                                                <th class="text-left" style="min-width:198px;">
                                                    {{ __('crm.description')}}
                                                </th>
                                                <th class="text-center" style="min-width: 185px;">{{ __('crm.qty')}}</th>
                                                <th class="text-center" style="min-width: 187px;">
                                                    {{ __('crm.unit_price')}}
                                                </th>
                                                <th class="text-center" style="min-width: 193px;">{{ __('crm.discount')}}</th>
                                                <th class="text-center" style="min-width: 185px;"> {{ __('crm.amount')}}
                                                </th>
                                                <th style="min-width:76px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="add">
                                            <!-- Start -->

                                           
                                       <tr class="addmore">

                                                @php 
                                                $calc =0;
                                                @endphp

                                            @foreach($response->crm_quotation_item as $item)
                       
                                            @php
                                            $selected_item_name = $item->item_name;
                                            $selected_qty = $item->quantity;
                                            $selected_unit_price = $item->unit_price;
                                            $selected_discount = $item->discount;
                                            $selected_item_cost = $item->item_cost;
                                          
                                                           
                                            @endphp

                                            @php
                                            $calc++;
                                           if($calc ==1) continue;
                                           @endphp


                                           @endforeach

                                                <td>
                                                    <input name="item_name[]" type="text" class="form-control" id="itemName_1" placeholder="Item Name" value="{{$selected_item_name}}" required>
                                                    <div class="invalid-feedback">
                                                        {{ __('crm.item_name_error')}}
                                                    </div>
                                                </td>
                                                <td class="text-center ">
                                                    <input name="quantity[]" type="number" class="form-control quantity"  id="quantity_1" placeholder="" value="{{$selected_qty}}" onkeyup="calculation(1)" required>
                                                    <div class="invalid-feedback">
                                                        {{ __('crm.quantity_error')}}
                                                    </div>
                                                </td>
                                                <td class="text-center ">
                                                    <input name="unit_price[]" type="number" onkeyup="calculation(1)" class="form-control unit_price"  id="unit_price_1" placeholder="" value="{{$selected_unit_price}}" required>
                                                    <div class="invalid-feedback">
                                                        {{ __('crm.unit_price_error')}}
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <input name="discount[]" type="number" class="form-control discount"  id="discount_1" onkeyup="discount(1)" placeholder="" value="{{$selected_discount}}" required>
                                                    <div class="invalid-feedback">
                                                        {{ __('crm.discount_error')}}
                                                    </div>
                                                </td>
                                                <td class="text-center ">
                                                    <input name="item_cost[]" type="number" class="form-control amount" id="amount_1"  placeholder="" value="{{$selected_item_cost}}" readonly required>
                                                    <div class="invalid-feedback">
                                                        {{ __('crm.amount_error')}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm remove"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
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
                            <textarea name="note" rows="2" value="{{$response->note}}" class="form-control">{{$response->note}}</textarea>
                            <div class="invalid-feedback">
                                {{ __('crm.select_customer')}}
                            </div>
                        </div><!--end row-->                                  
                        <div class="col-lg-6 col-sm-12 ">
                            <div class="border quotation_wrapper rounded">
                                <div class="col-lg-12 col-sm-12 gap-3 align-item-center d-flex border-bottom px-3 py-2">
                                    <label class="mb-0 quotation_label" for="">{{ __('crm.sub_total')}}</label>
                                    <input name="sub_total" type="number" class="form-control addsub_total" id="sub_total" placeholder="" value="{{ $response->total_item_cost}}" required>
                                    <div class="invalid-feedback">
                                        {{ __('crm.sub_tatal_error')}}
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 gap-3 align-item-center d-flex border-bottom px-3 py-2">
                                    <label class="quotation_label mb-0" for="">{{ __('crm.discount')}}</label>
                                    <input name="total_discount" type="number" class="form-control totalDiscount" onkeyup="totalDisc()" value="{{ $response->quote_discount}}" required>
                                    <div class="invalid-feedback">
                                        {{ __('crm.discount_error')}}
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 gap-3 align-item-center d-flex border-bottom px-3 py-2">
                                    <label class="quotation_label mb-0" for="">{{ __('crm.shipping')}}</label>
                                    <input name="shipping_cost" type="number" value="{{ $response->shipping_cost}}"  class="form-control" id="shipping" onkeyup="ship_disc()" required>
                                    <div class="invalid-feedback">
                                        {{ __('crm.shipping_error')}}
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 gap-3 align-item-center d-flex border-bottom px-3 py-2">
                                    <label class="quotation_label mb-0" for="">{{ __('crm.tax')}}</label>
                                    <div class="d-flex gap-3 align-items-center justify-content-between w-100"> 
                                        <span>GST 27%</span>
                                        <span>0.00</span>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-sm-12 d-flex border-bottom px-3 py-2">
                                    <label class="quotation_label mb-0" for="">{{ __('crm.payment_term')}}</label>
                                    <select class="form-select form-control" name="payment_term_id" id="" >
                                    <option selected disabled value="" disabled>{{ __('crm.select_payment_term')}}</option>
                                            @if(!empty($paymentterms))
                                        @foreach ($paymentterms as $ls_data)

                                        <option value="@if(!empty($ls_data)){{ $ls_data->terms_id }}@endif" {{$ls_data->terms_id == $response->payment_term_id ? 'selected' : ''  }}>{{ $ls_data->terms_name }}</option>
                                        @endforeach
                                        @endif
                                        
                                    </select>
                                </div>
                                <div class="col-lg-12 col-sm-12 d-flex gap-3 align-item-center px-3 py-2">
                                    <label class="quotation_label mb-0" for="">{{ __('crm.total')}}</label>
                                    <input name="final_cost" type="number"  value="{{$response->final_cost}}" class="form-control" id="grandtotal" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-6 mx-sm-auto ml-md-0">
                        <input type="submit" id="submit" name="send" class="btn btn-primary" value="Submit">
                            <a href="{{ route('quotation.index')}}" class="btn btn-secondary mx-1">Cancel</a>
                        </div>
                    </div><!--end row-->
                </div>
            </form>
        </div>
    </div>
       
    <!-- this is use toggle button -->
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                var i = 1;
             
            
                $("#addbuttom").on("click", function() {
                    var i=$('table tr').length;
                    html = `<tr class="addmore">
                        <td>
                            <input name="item_name[]" type="text" class="form-control" id="itemName_${i}" placeholder="Item Name" value=" {{$selected_item_name
                            }}" required>

                            <div class="invalid-feedback">
                                {{ __('crm.item_name_error')}}
                            </div>
                        </td>
                        <td>
                            <input name="quantity[]" type="number" onkeyup="calculation(${i})" class="form-control quantity" id="quantity_${i}" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                {{ __('crm.quantity_error')}}
                            </div>
                        </td>
                        <td>
                            <input name="unit_price[]" type="number" onkeyup="calculation(${i})" class="form-control unit_price" id="unit_price_${i}" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                {{ __('crm.unit_price_error')}}
                            </div>
                        </td>
                        <td>
                            <input name="discount[]" type="number" class="form-control discount" id="discount_${i}" placeholder="" onkeyup="discount(${i})" value="" required>
                            <div class="invalid-feedback">
                                {{ __('crm.discount_error')}}
                            </div>
                        </td>
                        <td>
                            <input name="item_cost[]" type="number" class="form-control amount" id="amount_${i}" placeholder="" value="" readonly required>
                            <div class="invalid-feedback">
                                {{ __('crm.amount_error')}}
                            </div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                        </td>
                    </tr>`
                    $("#add").append(html);
                    i++;
                });
          


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
                        console.log(response[0].products)
                    var  html = ``;
                         if((response[0].products != '') ){
                           
                            $.each(response[0].products, function(key, product) {
                                console.log(product)  ;
                              html+=`  <ul>  
                                     <li>
                                        <a href="#">${product.productdescription[0].products_name }</a>
                                    </li> 
                                    </ul>`;

                            }); 
                        }     
                       
                        $(".searchItemList").append(html);
                    },
                    error: function(error) {
                       
                    }
                });
            });
            // hide search suggestion box
            $('.searchItemList').on('mouseleave', function(e) {
                $('.searchItem').addClass('hide');
            });



            $(window).scroll(function() {
                $('.searchItem').addClass('hide');
            });



          
            });
            // calculate quantity and unit price 
            function calculation(i){
                var unit_price = $('#unit_price_'+i).val();
                var quantity = $('#quantity_'+i).val();
                var data = quantity * unit_price;
                $('#amount_'+i).val(data);
                sub_total();
                ship_disc();
            }

            function totalDisc(){
                var sub_total = $('#sub_total').val();
                var discount = $('.totalDiscount').val();
                var dis_value = Math.round(sub_total * discount / 100);
                var grand_total = sub_total-dis_value;
                $('#grandtotal').val(grand_total);
            }

            // Per item discount calculation
            function discount(i){
                var discountValue = $('#discount_'+i).val();
                var quantity = $('#quantity_'+i).val();
                var unit_price = $('#unit_price_'+i).val();
                var data = (quantity * unit_price);
                var discount = Math.round(data * discountValue / 100);
                data = data - discount;
                $('#amount_'+i).val(data);
                sub_total();
                ship_disc();
            }
            // remove add more section
            $(document).on('click', '.remove', function(e) {
                e.preventDefault();
                $(this).closest('.addmore').remove();
            });

            // subtotal calculatation of all addmore items 
            function sub_total(){
                var sum = 0;
                $('.addmore').each(function() {
                    var amount = $(this).find('.amount').val();
                    sum = sum + Number(amount);
                    $('#sub_total').val(sum);
                    $('#grandtotal').val(sum);
                });
                ship_disc();
            }
            function ship_disc(){
                var g_total = $('#grandtotal').val();
                var shipping = $('#shipping').val();
                console.log(g_total);
                console.log(shipping);
                var t_amount = Number(g_total)+Number(shipping);
                console.log(t_amount);
                $('#grandtotal').val(t_amount);

            }
            // function findMember(str) {
            //  console.log('search: ' + str)
            // }

            // $('#target').keyup(function(e) {
            // clearTimeout(timeoutID);
            // const value = e.target.value
            // timeoutID = setTimeout(() => findMember(value), 500)
            // });



        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    @endpush
</x-app-layout>