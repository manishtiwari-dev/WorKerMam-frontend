{{-- @dd ($order_details); --}}

<x-app-layout>
    @section('title', 'Orders')

    <div class="content bd-b py-0">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0 card-header">
            <div class="row align-items-center justify-content-end">
                <div class=" mg-t-20 mg-sm-t-0  gap-3 d-flex justify-content-end" style="">
                    <button class="btn btn-white print"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer mg-r-5">
                            <polyline points="6 9 6 2 18 2 18 9"></polyline>
                            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                            <rect x="6" y="14" width="12" height="8"></rect>
                        </svg> Print</button>
                    <a class="btn btn-primary mg-l-5"
                        href="https://dashboard.e-nnovation.net/sales/orders-details-pdf/IKCY161003"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-credit-card mg-r-5">
                            <rect x="1" y="4" width="22" height="16" rx="2"
                                ry="2"></rect>
                            <line x1="1" y1="10" x2="23" y2="10"></line>
                        </svg>Download</a>
                </div>
            </div>
        </div>

        <input type="hidden" value="{{ $order_details->order_id }}" id="order_id">
        <div class="content tx-13">
            <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                <div class="row">
                    <div class="col-sm-6 col-lg-8">
                        <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Billed From</label>
                        <p class="mg-b-0">{!! $invoice_biller_add ?? '' !!}</p>
                    </div><!-- col -->
                    <div class="col-sm-6  col-lg-4 ">
                        <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Ord. Information</label>
                        <ul class="list-unstyled lh-7">
                            <li class="d-flex justify-content-between">
                                <span>{{ __('crm.order_number') }}</span>
                                <span>#{{ $order_details->order_number }}</span>
                            </li>
    
                            <li class="d-flex justify-content-between">
                                <span>{{ __('crm.order_date') }}</span>
                                <span>{{ date('d M , Y', strtotime($order_details->created_at ?? '')) }}</span>
                            </li>
    
                        </ul>
                            

                    </div><!-- col -->
                    <div class="col-sm-6 col-lg-8 mg-t-40 mg-sm-t-0 mg-md-t-40">
                        <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Billed To</label>
                        <h6 class="tx-15 mg-b-10">{{ $order_details->billing->customer_name }}</h6>
                        <p class="mg-b-0">Email: {{ $order_details->billing->customer_email }}</p>
                        <p class="mg-b-0">Tel No: {{ $order_details->billing->customer_phone }}</p>
                        <p class="mg-b-0">
                            {{ $order_details->billing->customer_address }}
                            ,{{ $order_details->billing->customer_city }}
                            ,{{ $order_details->billing->customer_state }}<br />
                            {{ $order_details->billing->country_name }}
                            {{ $order_details->billing->customer_postcode }}
                        </p>
                    </div>
                    <div class="col-sm-6 col-lg-4 mg-t-40">
                        <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Ship To</label>
                        <h6 class="tx-15 mg-b-10">{{ $order_details->shipping->customer_name }}</h6>
                        <p class="mg-b-0">Email: {{ $order_details->shipping->customer_email }}</p>
                        <p class="mg-b-0">Tel No: {{ $order_details->shipping->customer_phone }}</p>
                        <p class="mg-b-0">
                            {{ $order_details->shipping->customer_address }}
                            ,{{ $order_details->shipping->customer_city }}
                            ,{{ $order_details->shipping->customer_state }}<br />
                            {{ $order_details->shipping->country_name }}
                            {{ $order_details->shipping->customer_postcode }}
                        </p>
                    </div><!-- col -->
                </div><!-- row -->

                <div class="table-responsive mg-t-40">
                    <table class="table table-invoice bd-b">
                        <thead>
                            <tr>
                                <th class="">Sl. No.</th>
                                <th class="wd-40p d-none d-sm-table-cell">{{ __('sales.item') }}</th>
                                <th class="tx-right">{{ __('sales.unit_price') }}</th>
                                <th class="tx-center">{{ __('sales.qty') }}</th>

                                @foreach ($order_details->item as $key => $item)
                                    @if (!empty($item->discount))
                                        <th class="tx-center qty" style="width:100p;"> Discount %</th>
                                    @else
                                        <th class="tx-center qty" style="width:100p;"> </th>
                                    @endif
                                @break
                            @endforeach

                            @foreach ($order_details->item as $key => $value)
                                @if (!empty($value->tax_id))
                                    <th class="tx-center qty">TAX %</th>
                                @else
                                    <th class="tx-center qty"></th>
                                @endif
                            @break
                        @endforeach

                        <th class="tx-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($order_details->item))
                        @foreach ($order_details->item as $key => $item)
                            <tr>
                                <td class="tx-nowrap">{{ $key + 1 }}</td>
                                <td class="d-none d-sm-table-cell">
                                    {{ $item->product_name }}<br />
                                    @if (!empty($item->attributes))
                                        @foreach ((array) $item->attributes as $attrkey => $attrVal)
                                            @if ($attrkey == count((array) $item->attributes) - 1)
                                                <span>{{ $attrkey }} : {{ $attrVal }}</span>,
                                            @else
                                                <span>{{ $attrkey }} : {{ $attrVal }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td class="tx-center">{{ $item->unit_price }}</td>
                                <td class="tx-center">{{ $item->qty }}</td>

                                @foreach ($order_details->item as $key => $value)
                                    @if (!empty($value->discount))
                                        <td class="tx-center">{{ $item->discount }}</td>
                                    @else
                                        <td class="tx-center"> </td>
                                    @endif
                                @break
                            @endforeach

                            @foreach ($order_details->item as $key => $value)
                                @if (!empty($value->tax_id))
                                    <td class="tx-center"> {{ $item->tax_amount }}</td>
                                @else
                                    <td class="tx-center"></td>
                                @endif
                            @break
                        @endforeach

                        <td class="tx-right">{{ $item->total_price }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<div class="row justify-content-between mt-4">
    <div class="col-sm-6 col-lg-6 order-2 order-sm-0 mg-t-40 mg-sm-t-0">
        <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Notes</label>
        <p>{!! $invoice_note ?? '' !!} </p>
    </div>
    <div class="col-sm-6 col-lg-4 order-1 order-sm-0">
        <ul class="list-unstyled lh-7 pd-r-10">
            <li class="d-flex justify-content-between">
                <span>Sub-Total</span>
                <span>{{ $order_details->sub_total }}</span>
            </li>
            @if ($order_details->discount_total != 0)
                <li class="d-flex justify-content-between">
                    <span>Discount</span>
                    <span>-{{ $order_details->discount_total }}</span>
                </li>
            @endif

            @if ($order_details->shipping_total != 0)
                <li class="d-flex justify-content-between">
                    <span>Shipping Charge</span>
                    <span>{{ $order_details->shipping_total ?? '' }}</span>
                </li>
            @endif

            @if ($order_details->tax_amount != 0)
                <li class="d-flex justify-content-between">
                    <span>Tax</span>
                    <span>{{ $order_details->tax_amount ?? '' }}</span>
                </li>
            @endif
            <li class="d-flex justify-content-between">
                <strong>Total</strong>
                <strong>{{ $order_details->grand_total ?? '' }}</strong>
            </li>
        </ul>

    </div>
</div>

</div>
</div>
</div>



@push('scripts')
<script>
    $(document).ready(function() {
        $('.selectsearch').select2({
            searchInputPlaceholder: 'Search options'
        });

        $(".print").click(function() {
            window.print();
            
        });
    });
</script>
@endpush
</x-app-layout>
