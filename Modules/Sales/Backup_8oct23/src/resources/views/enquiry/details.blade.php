@php
    
    $api_token = request()->cookie('api_token');
    
    $userdata = Cache::get('userdata-' . $api_token);
    
@endphp
<x-app-layout>
    @section('title', 'Enquiry-' . $enquiry_list->enquiry_no)
    <div class="card contact-content-body">
        <div class="tab-content">
            <div id="website" class="tab-pane show active">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">{{ __('crm.enquiry') }} #{{ $enquiry_list->enquiry_no }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="content tx-13">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="bd pd-20">
                                    <label
                                        class="tx-sans tx-10 tx-medium tx-spacing-1 tx-uppercase tx-color-03 mg-b-10">Contact
                                        Details</label>
                                    <ul class="list-unstyled lh-7">
                                        @if ($userdata->userType != 'subscriber')
                                            <li class="d-flex justify-content-between">
                                                <span>{{ __('common.name') }}</span>
                                                <span>{{ $enquiry_list->customer_name }}</span>
                                            </li>
                                            <li class="d-flex justify-content-between">
                                                <span>{{ __('crm.email') }}</span>
                                                <span>{{ $enquiry_list->customer_email }}</span>
                                            </li>
                                        @else
                                            <li class="d-flex justify-content-between">
                                                <span>{{ __('common.name') }}</span>
                                                <span>{{ $enquiry_list->customers_name }}</span>
                                            </li>
                                            <li class="d-flex justify-content-between">
                                                <span>{{ __('crm.email') }}</span>
                                                <span>{{ $enquiry_list->email_address }}</span>
                                            </li>
                                        @endif
                                        <li class="d-flex justify-content-between">
                                            <span>{{ __('crm.phone') }}</span>
                                            <span>{{ $enquiry_list->phone }}</span>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6 mg-t-20 mg-sm-t-0">
                                <div class="bd pd-20">
                                    <label
                                        class="tx-sans tx-10 tx-medium tx-spacing-1 tx-uppercase tx-color-03 mg-b-10">Other
                                        details </label>
                                    <ul class="list-unstyled lh-7">
                                        <li class="d-flex justify-content-between">
                                            <span>{{ __('common.date') }}</span>
                                            <span>{{ \Carbon\Carbon::parse($enquiry_list->created_at)->format('F d,Y') }}</span>
                                        </li>
                                        @if ($userdata->userType == 'subscriber')
                                            <li class="d-flex justify-content-between">
                                                <span>Enquiry Type</span>
                                                <span>{{ ucfirst($enquiry_list->enquiry_type) }}</span>
                                            </li>
                                        @endif
                                        <li class="d-flex justify-content-between">
                                            <span>{{ __('crm.country') }}</span>
                                            <span>{{ $enquiry_list->country_name ?? '' }}</span>
                                        </li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="card my-3">
                            <div class="card-header">Message</div>
                            <div class="card-body">{{ $enquiry_list->message }}</div>
                        </div>
                        @if ($userdata->userType == 'subscriber')

                            @if (!empty($enquiry_list->enquiry_product))
                                <div class="card my-3">
                                    <div class="card-header">Product Details</div>
                                    <div class="card-body">
                                        <div class="mg-t-2">
                                            <table class="table-responsive table table-invoice bd-b">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-40p  d-sm-table-cell">Product Name</th>
                                                        <th class="tx-center">Quantity</th>
                                                        @if (!empty($attributes_data))
                                                            <th class="tx-right">Attributes</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class=" d-sm-table-cell tx-color-03">
                                                            <a href="{{ $website_url . '/product/' . $enquiry_list->enquiry_product->products->product_slug ?? '' }}"
                                                                target="_blank">
                                                                {{ $enquiry_list->enquiry_product->products->product_name ?? '' }}
                                                                <i class="fa fa-external-link"
                                                                    aria-hidden="true"></i></a>
                                                        </td>
                                                        <td class="tx-center">
                                                            {{ $enquiry_list->enquiry_product->products_qty }}
                                                        </td>
                                                        @if (!empty($attributes_data))
                                                            <td class="tx-right">
                                                                @foreach ((array) $attributes_data as $attributeKey => $attrValArray)
                                                                    {{ $attributeKey }}:

                                                                    @foreach ($attrValArray as $key => $attrVal)
                                                                        @if ($key == count($attrValArray) - 1)
                                                                            {{ $attrVal }}
                                                                        @else
                                                                            {{ $attrVal }},
                                                                        @endif
                                                                    @endforeach
                                                                    @if (!$loop->last)
                                                                        <br />
                                                                    @endif
                                                                @endforeach
                                                                <br />
                                                            </td>
                                                        @endif
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
