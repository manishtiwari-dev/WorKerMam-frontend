<x-app-layout>
    @section('title', 'Quotation'.' | '.$quotation->quotation_no)
    <div class="content bd-b noprint mt-0 bg-white">
        <div class="pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                   
                </div>
                <div class="mg-t-20 mg-sm-t-0">
                    <button class="btn btn-white print"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer mg-r-5">
                            <polyline points="6 9 6 2 18 2 18 9"></polyline>
                            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                            <rect x="6" y="14" width="12" height="8"></rect>
                        </svg> Print</button>

                    <a class="btn btn-primary mg-l-5 shareBtn"  data-toggle="modal" data-target="#exampleModal"  href="javascript:void();"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-share-2 mg-r-5">
                            <rect x="1" y="4" width="22" height="16" rx="2"
                                ry="2"></rect>
                            <line x1="1" y1="10" x2="23" y2="10"></line>
                        </svg>SHARE</a>

                     

                    <!-- <button class="btn btn-primary mg-l-5"> </button> -->
                    <a class="btn btn-primary mg-l-5"
                        href="{{ route('sales.quote-download-pdf',$quotation->quotation_no)}}"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-download mg-r-5">
                            <rect x="1" y="4" width="22" height="16" rx="2"
                                ry="2"></rect>
                            <line x1="1" y1="10" x2="23" y2="10"></line>
                        </svg>Download</a>
                </div>
            </div>
        </div><!-- container -->
    </div>
    <div class="content tx-13 bg-white" id="invoice">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="row">
                <div class="col-sm-6">
                    <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Billed From</label>
                    <h6 class="tx-15 mg-b-10">
                        @if (!empty($invoice_data->company_name))
                            {{ $invoice_data->company_name}}
                        @endif
                    </h6>
                    @if (!empty($invoice_data->invoice_biller_address))
                    <p class="mg-b-0">
                        {{ $invoice_data->invoice_biller_address }}
                    </p>
                    @endif
                    @if (!empty($invoice_data->contact_phone))
                    <p class="mg-b-0">Tel No:
                        {{$invoice_data->contact_phone}}
                    </p>
                    @endif
                    @if (!empty($invoice_data->business_email))
                    <p class="mg-b-0">Email:
                        {{$invoice_data->business_email}}
                        @endif
                    </p>
                </div>
                <div class="col-sm-6 tx-right d-none d-md-block">
                    {{-- <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Invoice Number</label>
                    <h1 class="tx-normal tx-color-04 mg-b-10 tx-spacing--2">#{{ $quotation->quotation_no}}</h1> --}}
                </div>
                <div class="col-sm-6 col-lg-8 mg-t-40 mg-sm-t-0 mg-md-t-40">
                    @if (!empty($invoice_data->customer_address))
                    <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Billed To</label>
                    @if (!empty($invoice_data->customer_address->customer_name))
                        <h6 class="tx-15 mg-b-10">
                            {{ $invoice_data->customer_address->customer_name}}
                        </h6>
                    @endif
                    @if (!empty($invoice_data->customer_address->company_name))
                      {{ $invoice_data->customer_address->company_name}}
                    @endif
                    @if (!empty($invoice_data->customer_address))
                    <p class="mg-b-0">
                        {{ $invoice_data->customer_address->street_address }},{{ $invoice_data->customer_address->city}},{{ $invoice_data->customer_address->state}}, {{$invoice_data->customer_address->country_name}},{{$invoice_data->customer_address->zipcode}}
                    </p>
                    @endif
                    @if (!empty($invoice_data->customer_address->phone))
                    <p class="mg-b-0">Tel No:
                        {{$invoice_data->customer_address->phone ?? ''}}
                    </p>
                    @endif
                    @if (!empty($invoice_data->customer_address->customer_email))
                    <p class="mg-b-0">Email:
                        {{$invoice_data->customer_address->customer_email ?? ''}}
                        @endif
                    </p>
                    @endif
                </div>
                <div class="col-sm-6 col-lg-4 mg-t-40">
                    <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Inv.
                        Information</label>
                    <ul class="list-unstyled lh-7">
                        <li class="d-flex justify-content-between">
                            <span>{{ __('crm.quotation_number') }}</span>
                            <span>{{ $quotation->quotation_no }}</span>
                        </li>

                        <li class="d-flex justify-content-between">
                            <span>Issue Date</span>
                            <span>{{ \Carbon\Carbon::parse($quotation->created_at)->format('d/m/Y') }}</span>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="table-responsive mg-t-40">
                <table class="table table-invoice bd-b">
                    <thead>
                        <tr>
                            <th class="">{{ __('sales.sl_no') }}</th>
                            <th class="wd-40p d-none d-sm-table-cell">{{ __('sales.item') }}</th>
                            <th class="tx-center">{{ __('crm.sac_code') }}</th>
                            <th class="tx-center">{{ __('sales.unit_price') }}</th>
                         
                            @foreach ($quotation->crm_quotation_item as $key => $item)
                                @if(!empty($item->discount))
                                <th class="tx-center">{{ __('sales.discount') }} %</th>
                                @break
                                @endif
                            @endforeach
                            @if($quotation->tax_type==1)
                                @foreach ($quotation->crm_quotation_item as $key => $item)
                                    @if(!empty($item->tax_group_id))
                                        <th class="tx-center">{{ __('sales.tax') }} %</th>
                                    @break
                                    @endif
                                @endforeach
                            @endif
                            <th class="tx-center">{{ __('sales.item_cost') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($quotation->crm_quotation_item))
                            @foreach ($quotation->crm_quotation_item as $key => $item)
                                @php
                                     $dbAttribute= !empty($item->attributes) ? json_decode($item->attributes) :NULL;
                                @endphp
                                <tr>
                                    <td class="tx-nowrap">{{ $key + 1 }}</td>
                                    <td class="d-none d-sm-table-cell tx-color-03"> 
                                        {{ $item->item_name }}<br/>
                                        @if(!empty($item->product_data))
                                            @if($item->product_data->productAttribute)
                                               @foreach($item->product_data->productAttribute as $key=>$attribute)
                                                    {{$attribute->option_name}} :  
                                                    @foreach($attribute->option_value_list as $optionvalues)
                                                        @if(in_array($attribute->options_id.'_'.$optionvalues->options_values_id,$dbAttribute))
                                                          {{$optionvalues->product_options_value->products_options_values_name}} &nbsp;&nbsp;&nbsp;
                                                        @endif
                                                    @endforeach
                                               @endforeach
                                               
                                            @endif
                                        @endif
                                    </td>
                                    <td class="tx-center">{{ $item->sac_code ?? '' }}</td>
                                    <td class="tx-center">{{$quotation->currency_symbol}} {{ $item->unit_price ?? '' }}</td>
                                    @if(!empty($item->discount))
                                    <td class="tx-center">{{ $item->discount ?? '' }}</td>
                                    @endif
                                    @if($quotation->tax_type==1 && !empty($item->tax_group_name))
                                    <td class="tx-center">{{$item->tax_group_name ?? ''}}</td>
                                    @endif
                                    <td class="tx-center">{{$quotation->currency_symbol}} {{ $item->item_cost ?? ''}}</td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>

            <div class="row justify-content-between mt-4">
                <div class="col-sm-6 col-lg-6 order-2 order-sm-0 mg-t-40 mg-sm-t-0">
                  <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">{{ __('crm.notes') }}</label>
                  <p>{!! $invoice_data->invoice_note ?? '' !!}</p>
                </div><!-- col -->
                <div class="col-sm-6 col-lg-4 order-1 order-sm-0">
                  <ul class="list-unstyled lh-7 pd-r-10">
                    <li class="d-flex justify-content-between">
                      <span>{{ __('crm.sub_total') }}</span>
                      <span>{{$quotation->currency_symbol}} {{$quotation->subtotal ?? ''}}</span>
                    </li>
                    <li class="d-flex justify-content-between">
                      <span>{{ __('crm.total_tax') }}</span>
                      <span>{{$quotation->currency_symbol}} {{$quotation->total_tax ?? ''}}</span>
                    </li>
                    @if($quotation->discount)
                    <li class="d-flex justify-content-between">
                      <span>{{ __('crm.discount') }} %</span>
                      <span>-{{$quotation->discount ?? ''}}</span>
                    </li>
                    @endif
                    <li class="d-flex justify-content-between">
                      <strong>{{ __('crm.total_due') }}</strong>
                      <strong>{{$quotation->currency_symbol}} {{$quotation->final_cost ?? ''}}</strong>
                    </li>
                  </ul>
      
                </div>
              </div>

        </div>
    </div>

    <!--Share Pop Up Start-->
 
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content col-12">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('crm.share') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="icon-container2 d-flex">
                <div class="smd">
                    <i class="img-thumbnail fab fa-whatsapp fa-2x"
                        style="color:  #25D366;background-color: #cef5dc;"></i>
                    <p>Whatsapp</p>
                </div>
                <div class="smd">
                    <i class="img-thumbnail fab fa fa-envelope fa-2x"
                        style="color: #ff4343;background-color: #ffdede;"></i>
                    <p>Mail</p>
                </div>
            </div>
            <div class="modal-footer">
                <label style="font-weight: 600">Page Link <span class="message"></span></label><br />
                <div class="row">
                    <input class="col-10 ur" type="url" placeholder="https://www.arcardio.app/acodyseyy"
                        id="myInput" value="{{'https://dev01.e-nnovation.net/portal/quotation/'.$quotation->quotation_no}}" aria-describedby="inputGroup-sizing-default" style="height: 40px;">
                    <button class="cpy" onclick="myFunction()"><i class="far fa-clone"></i></button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!--Share Pop Up End-->

    @push('styles')
    <style>
        @media print {
            .noprint {
            visibility: hidden;
            }

            html, body {
                height:100%; 
                margin: 0 !important; 
                padding: 0 !important;
                overflow: hidden;
                overflow-y: hidden;
            }
            #invoice{
                margin-top:0px;
            }
        }

        /* pop up css */
        

        .img-thumbnail {
        border-radius: 33px;
        width: 61px;
        height: 61px;
        }

        .fab:before {
        position: relative;
        top: 13px;
        }

        .smd {
        width: 200px;
        font-size: small;
        text-align: center;
        }

        .modal-footer {
        display: block;
        }

        .ur {
        border: none;
        background-color: #e6e2e2;
        border-bottom-left-radius: 4px;
        border-top-left-radius: 4px;
        }

        .cpy {
        border: none;
        background-color: #e6e2e2;
        border-bottom-right-radius: 4px;
        border-top-right-radius: 4px;
        cursor: pointer;
        }

        .ur.focus,
        .ur:focus {
        outline: 0;
        box-shadow: none !important;
        }

        .message{
                font-size: 11px;
        color: #ee5535;
        }


    </style>
    @endpush

    @push('scripts')
        <script>
            $(document).ready(function() {
                $(".print").click(function() {
                    window.print();
                });
            });
            function myFunction() {
                    var copyText = document.getElementById("myInput");

                    // Select the text field
                    copyText.select();
                    copyText.setSelectionRange(0, 99999); // For mobile devices

                    // Copy the text inside the text field
                    navigator.clipboard.writeText(copyText.value);

                    $(".message").text("link copied");
            }
        </script>
    @endpush
</x-app-layout>
