<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #000;
            text-decoration: none;
        }

        .text-black {
            color: #000
        }

        body {
            position: relative;
            /* width: 21cm;
      height: 26.7cm; */
            margin: 0 auto;
            color: #4f4f4f;
            background: #FFFFFF;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
            box-sizing: border-box;
            line-height: 1.3;
        }

        header {
            padding: 10px 0;
        }

        #logo {
            float: left;
        }

        #logo img {
            width: 180px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 10px;
            border-color: #c3c2c2
        }

        table th {
            font-size: 14px;
            background: #ebebeb;
            -webkit-print-color-adjust: exact;
        }

        table th,
        table td {
            padding: 6px 10px;
            border-top: 1px solid #c3c2c2;
            text-align: left;
            color: #000
        }

        ul {
            list-style: none;
            padding: 0
        }

        .text-center {
            text-align: center
        }

        .description-table th {
            font-size: 13px;
        }

        .description-table th,
        .description-table td {
            text-align: center;
            padding: 3px 8px;
        }

        .text-left {
            text-align: left !important;
        }

        .width-150 {
            width: 150px
        }

        .invoice-wrapper th,
        .invoice-wrapper td {
            border: 1px solid #c3c2c2;
        }
    </style>
</head>

<body>

    <header class="clearfix">
        <div id="logo" style="width:70%">
            <img src="{{ $data->invoice_data->invoice_logo ?? '' }}" style="margin-bottom: .5rem;"
                alt="{{ $data->quote_detail->invoice_number ?? '' }}">
        </div>

    </header>
    <!--  -->

    @php
        $inv_details = json_decode($data->quote_detail->details);
    @endphp

    <table cellspacing="0" cellpadding="0" class="invoice-wrapper">
        <tr>
            <td rowspan="3" style="width:400px; border: none;">
                <div class="text-black" style="font-size: 22px;font-weight: 600;">{{ $data->quote_detail->invoice_title ?? ''}}</div>
            </td>
            <th class="width-150">Invoice No.</th>
            <td colspan="3"> {{ $data->quote_detail->invoice_number }}</td>
        </tr>
        <tr>
            <th class="width-150">Invoice Date</th>
            <td colspan="3">{{ \Carbon\Carbon::parse($data->quote_detail->invoice_date)->format('d-M-Y') }} </td>
        </tr>

        <tr>
            <th class="width-150">Due Date</th>
            <td colspan="3">{{ \Carbon\Carbon::parse($data->quote_detail->due_date)->format('d-M-Y') }}</td>
        </tr>

    </table>
    <table cellspacing="0" cellpadding="0" border>
        @if ($data->invoice_type != 'services')
            <tr>
                <th colspan="6" class="text-center" style="width:180px;">Billed To</th>
                <th class="text-center" colspan="6">Shipped To</th>
            </tr>
            <tr>
                <th class="width-150">Name</th>
                <td colspan="5">
                    {{ ($data->quote_detail->customer->company_name) != '' ? $data->quote_detail->customer->company_name : $data->quote_detail->customer->first_name }}
                </td>
                <td colspan="5">
                    {{ ($data->quote_detail->customer->company_name != '') ? $data->quote_detail->customer->company_name : $data->quote_detail->customer->first_name }}
                </td>
            </tr>
            <tr>
                <th class="width-150">Address</th>
                <td colspan="5">
                    @if (!empty($data->address_list))
                        @if (!empty($data->address_list[0]->street_address ?? ''))
                            {{ $data->address_list[0]->street_address ?? '' }},
                        @endif
                        <br />
                        @if (!empty($data->address_list[0]->city))
                            {{ $data->address_list[0]->city }},
                            @endif @if (!empty($data->address_list[0]->state))
                                {{ $data->address_list[0]->state }},
                            @endif <br />
                            @if (!empty($data->address_list[0]->country_name))
                                {{ $data->address_list[0]->country_name }},
                                @endif @if (!empty($data->address_list[0]->zipcode))
                                    {{ $data->address_list[0]->zipcode }}
                                @endif
                            @endif
                </td>
                <td colspan="5">
                    @if (!empty($data->address_list))
                        @if (!empty($data->address_list[0]->street_address))
                            {{ $data->address_list[0]->street_address }},
                        @endif
                        <br />
                        @if (!empty($data->address_list[0]->city))
                            {{ $data->address_list[0]->city }},
                            @endif @if (!empty($data->address_list[0]->state))
                                {{ $data->address_list[0]->state }},
                            @endif <br />
                            @if (!empty($data->address_list[0]->country_name))
                                {{ $data->address_list[0]->country_name }},
                                @endif @if (!empty($data->address_list[0]->zipcode))
                                    {{ $data->address_list[0]->zipcode }}
                                @endif
                            @endif
                </td>
            </tr>
            @if ($inv_details->contact == 'yes')
                <tr>
                    <th class="width-150">Contact</th>
                    <td colspan="5"> 
                        {{$data->quote_detail->customer->contact ?? ''}}
                    </td>
                    <td colspan="5">
                        {{$data->quote_detail->customer->contact ?? ''}}
                    </td>
                </tr>
            @endif
            <tr>
                <th rowspan="2" class="width-150">GSTIN</th>
                <td colspan="5" rowspan="2"> {{ $data->quote_detail->customer->tax_id }}</td>
            </tr>
            <tr>
                <th class="width-150">Place of Supply</th>
                <td colspan="5">
                    @if (!empty($data->address_list))
                        {{ (trim($data->address_list[0]->state) != '')? $data->address_list[0]->state.',' :'' }} {{ $data->address_list[0]->country_name }}
                    @endif
                </td>
            </tr>
        @else
            <tr>
                <th colspan="6" class="text-center" style="width:180px;">Billed To</th>
                <th class="text-center" colspan="6">Shipped To</th>
            </tr>
            @if (!empty($data->address_list))
                <tr>
                    <th class="width-150">Name</th>
                    <td colspan="5">
                        {{ ($data->quote_detail->customer->company_name != '') ? $data->quote_detail->customer->company_name : $data->quote_detail->customer->first_name }}
                    </td>

                    <td colspan="5">
                        {{ ($data->quote_detail->customer->company_name != '') ? $data->quote_detail->customer->company_name : $data->quote_detail->customer->first_name }}
                    </td>
                </tr>
                <tr>
                    <th class="width-150">Address</th>
                    <td colspan="5">
                        @if (!empty($data->address_list))
                            @if (!empty($data->address_list[0]->street_address))
                                {{ $data->address_list[0]->street_address }},
                                <br />
                                @endif @if (!empty($data->address_list[0]->city))
                                    {{ $data->address_list[0]->city }},
                                    @endif @if (!empty($data->address_list[0]->state))
                                        {{ $data->address_list[0]->state }},<br />
                                        @endif @if (!empty($data->address_list[0]->country_name))
                                            {{ $data->address_list[0]->country_name }},
                                            @endif @if (!empty($data->address_list[0]->zipcode))
                                                {{ $data->address_list[0]->zipcode }}
                                            @endif
                                        @endif
                    </td>
                    <td colspan="5">
                        @if (!empty($data->address_list))
                            @if (!empty($data->address_list[0]->street_address))
                                {{ $data->address_list[0]->street_address }},
                                <br />
                                @endif @if (!empty($data->address_list[0]->city))
                                    {{ $data->address_list[0]->city }},
                                    @endif @if (!empty($data->address_list[0]->state))
                                        {{ $data->address_list[0]->state }},<br />
                                        @endif @if (!empty($data->address_list[0]->country_name))
                                            {{ $data->address_list[0]->country_name }},
                                            @endif @if (!empty($data->address_list[0]->zipcode))
                                                {{ $data->address_list[0]->zipcode }}
                                            @endif
                                        @endif
                    </td>
                </tr>
                @if ($inv_details->contact == 'yes')
                    <tr>
                        <th class="width-150">Contact</th>
                        <td colspan="5">
                            {{$data->quote_detail->customer->contact ?? ''}}
                        </td>
                        <td colspan="5">
                            {{$data->quote_detail->customer->contact ?? ''}}
                        </td>
                    </tr>
                @endif
                <tr>
                    <th rowspan="2" class="width-150">GSTIN</th>
                    <td colspan="5" rowspan="2"> {{ $data->quote_detail->customer->tax_id }}</td>
                </tr>
                <tr>
                    <th class="width-150">Place of Supply</th>
                    <td colspan="5">
                        @if (!empty($data->address_list))
                        {{ (trim($data->address_list[0]->state) != '')? $data->address_list[0]->state.',' :'' }} {{ $data->address_list[0]->country_name }}
                        @endif
                    </td>
                </tr>
            @endif


        @endif
    </table>
    @if ($data->invoice_type != 'services')
        <table class="description-table" cellspacing="0" cellpadding="0" border style="margin-top:1rem">

            <tr>
                <th style="width:8%" rowspan="2">Sr.No.</th>
                <th rowspan="2">Service Description</th>
                <th rowspan="2">HSN</th>
                <th rowspan="2">Gross Value</th>
                <th rowspan="2">Discount Amt</th>
                <th rowspan="2">Taxable Value</th>

                <th colspan="2" class="text-center">CGST</th>
                <th colspan="2" class="text-center">SGST/UGST</th>
                <th colspan="2" class="text-center"> IGST</th>

                <th rowspan="2">Total Amt</th>
            </tr>

            <tr>
                <th>Rate</th>
                <th>Amt</th>
                <th>Rate</th>
                <th>Amt</th>
                <th>Rate</th>
                <th>Amt</th>
            </tr>

            @if (!empty($data->quote_detail->crm_invoice_item))
                @foreach ($data->quote_detail->crm_invoice_item as $key => $item)
                    @if (!empty($item->tax_component))
                        @php
                            $tax = $item->tax_component;
                            $tax_components = [];
                            $tax_array = json_decode($tax, true);
                            foreach ($tax_array as $tax_item) {
                                $taxName = key($tax_item);
                                $tax_components[$taxName] = $tax_item[$taxName];
                            }
                        @endphp
                    @endif
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->sac_code }}</td>
                        <td>{{ $item->unit_price }}</td>
                        <td>{{ $item->discount }}</td>
                        <td>{{ $item->item_cost }}</td>
                        @if (!empty($tax_components['CGST']))
                            <td>{{ $tax_components['CGST']['Rate'] != 0 ? $tax_components['CGST']['Rate'] : '' }}{{ $tax_components['CGST']['Rate'] != 0 ? '%' : '' }}
                            </td>
                            <td>{{ $tax_components['CGST']['Value'] != 0 ? $tax_components['CGST']['Value'] : '' }}
                            </td>
                        @else
                            <td></td>
                            <td></td>
                        @endif
                        @if (!empty($tax_components['SGST']))
                            <td>{{ $tax_components['SGST']['Rate'] != 0 ? $tax_components['SGST']['Rate'] : '' }}{{ $tax_components['SGST']['Rate'] != 0 ? '%' : '' }}
                            </td>
                            <td>{{ $tax_components['SGST']['Value'] != 0 ? $tax_components['SGST']['Value'] : '' }}
                            </td>
                        @else
                            <td></td>
                            <td></td>
                        @endif
                        @if (!empty($tax_components['IGST']))
                            <td>{{ $tax_components['IGST']['Rate'] != 0 ? $tax_components['IGST']['Rate'] : '' }}{{ $tax_components['IGST']['Rate'] != 0 ? '%' : '' }}
                            </td>
                            <td>{{ $tax_components['IGST']['Value'] != 0 ? $tax_components['IGST']['Value'] : '' }}
                            </td>
                        @else
                            <td></td>
                            <td></td>
                        @endif
                        <td>{{ $item->final_amount }}</td>
                    </tr>
                @endforeach
            @endif
            @if (!empty($data->quote_detail->tax_component))
                @php
                    $taxs = $data->quote_detail->tax_component;

                    $tax_arr = json_decode($taxs, true);
                    foreach ($tax_arr as $tax_items) {
                        $taxName = key($tax_items);
                        $tax_component[$taxName] = $tax_items[$taxName];
                    }

                @endphp
            @endif
            <tr>
                <th colspan="3" class="text-left">Total</th>
                <td>{{ $data->quote_detail->subtotal }}</td>
                <td>{{ $data->quote_detail->discount }}</td>
                <td>{{ $data->quote_detail->taxable_value }}</td>
                @if (!empty($tax_component['CGST']))
                    <td></td>
                    <td>{{ $tax_component['CGST']['Value'] ?? '' }}</td>
                @else
                    <td></td>
                    <td></td>
                @endif
                @if (!empty($tax_component['SGST']))
                    <td></td>
                    <td>{{ $tax_component['SGST']['Value'] ?? '' }}</td>
                @else
                    <td></td>
                    <td></td>
                @endif
                @if (!empty($tax_component['IGST']))
                    <td></td>
                    <td>{{ $tax_component['IGST']['Value'] ?? '' }}</td>
                @else
                    <td></td>
                    <td></td>
                @endif
                <td>{{ $data->quote_detail->final_cost }}</td>
            </tr>

            <tr>
                <th colspan="3" class="text-left">Total Value in Figure </th>
                <td colspan="10" class="text-left"><strong>{{ $data->quote_detail->currency_symbol }}
                        {{ $data->quote_detail->final_cost }}</strong></td>
            </tr>
            <tr>
                <th colspan="3" class="text-left">Total Value in Words</th>
                <td colspan="10" class="text-left"><strong> {{ $data->currencyName ?? '' }}
                        {{ \App\Helper\Helper::numberToWords($data->quote_detail->final_cost) }} Only</strong></td>
            </tr>
        </table>
    @else
        <table class="description-table" cellspacing="0" cellpadding="0" border style="margin-top:1rem">

            <tr>
                <th style="width:8%" rowspan="2">Sr.No.</th>
                <th rowspan="2">Service Description</th>
                <th rowspan="2">HSN</th>
                <th rowspan="2">Gross Value</th>
                <th rowspan="2">Discount Amt</th>
                <th rowspan="2">Taxable Value</th>

                <th colspan="2" class="text-center">CGST</th>
                <th colspan="2" class="text-center">SGST/UGST</th>
                <th colspan="2" class="text-center"> IGST</th>

                <th rowspan="2">Total Amt</th>
            </tr>

            <tr>
                <th>Rate</th>
                <th>Amt</th>
                <th>Rate</th>
                <th>Amt</th>
                <th>Rate</th>
                <th>Amt</th>
            </tr>

            @if (!empty($data->quote_detail->crm_invoice_item))
                @foreach ($data->quote_detail->crm_invoice_item as $key => $item)
                    @if (!empty($item->tax_component))
                        @php
                            $tax = $item->tax_component;
                            $tax_components = [];
                            $tax_array = json_decode($tax, true);
                            foreach ($tax_array as $tax_item) {
                                $taxName = key($tax_item);
                                $tax_components[$taxName] = $tax_item[$taxName];
                            }
                        @endphp
                    @endif
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->sac_code }}</td>
                        <td>{{ $item->unit_price }}</td>
                        <td>{{ $item->discount }}</td>
                        <td>{{ $item->item_cost }}</td>
                        @if (!empty($tax_components['CGST']))
                            <td>{{ $tax_components['CGST']['Rate'] != 0 ? $tax_components['CGST']['Rate'] : '' }}{{ $tax_components['CGST']['Rate'] != 0 ? '%' : '' }}
                            </td>
                            <td>{{ $tax_components['CGST']['Value'] != 0 ? $tax_components['CGST']['Value'] : '' }}
                            </td>
                        @else
                            <td></td>
                            <td></td>
                        @endif
                        @if (!empty($tax_components['SGST']))
                            <td>{{ $tax_components['SGST']['Rate'] != 0 ? $tax_components['SGST']['Rate'] : '' }}{{ $tax_components['SGST']['Rate'] != 0 ? '%' : '' }}
                            </td>
                            <td>{{ $tax_components['SGST']['Value'] != 0 ? $tax_components['SGST']['Value'] : '' }}
                            </td>
                        @else
                            <td></td>
                            <td></td>
                        @endif
                        @if (!empty($tax_components['IGST']))
                            <td>{{ $tax_components['IGST']['Rate'] != 0 ? $tax_components['IGST']['Rate'] : '' }}{{ $tax_components['IGST']['Rate'] != 0 ? '%' : '' }}
                            </td>
                            <td>{{ $tax_components['IGST']['Value'] != 0 ? $tax_components['IGST']['Value'] : '' }}
                            </td>
                        @else
                            <td></td>
                            <td></td>
                        @endif
                        <td>{{ $item->final_amount }}</td>
                    </tr>
                @endforeach
            @endif


            @if (!empty($data->quote_detail->tax_component))
                @php
                    $taxs = $data->quote_detail->tax_component;

                    $tax_arr = json_decode($taxs, true);
                    foreach ($tax_arr as $tax_items) {
                        $taxName = key($tax_items);
                        $tax_component[$taxName] = $tax_items[$taxName];
                    }

                @endphp
            @endif
            <tr>
                <th colspan="3" class="text-left">Total</th>
                <td>{{ $data->quote_detail->subtotal }}</td>
                <td>{{ $data->quote_detail->discount }}</td>
                <td>{{ $data->quote_detail->taxable_value }}</td>
                @if (!empty($tax_component['CGST']))
                    <td></td>
                    <td>{{ $tax_component['CGST']['Value'] ?? '' }}</td>
                @else
                    <td></td>
                    <td></td>
                @endif
                @if (!empty($tax_component['SGST']))
                    <td></td>
                    <td>{{ $tax_component['SGST']['Value'] ?? '' }}</td>
                @else
                    <td></td>
                    <td></td>
                @endif
                @if (!empty($tax_component['IGST']))
                    <td></td>
                    <td>{{ $tax_component['IGST']['Value'] ?? '' }}</td>
                @else
                    <td></td>
                    <td></td>
                @endif
                <td>{{ $data->quote_detail->final_cost }}</td>
            </tr>

            <tr>
                <th colspan="3" class="text-left">Total Value in Figure </th>
                <td colspan="10" class="text-left"><strong>{{ $data->quote_detail->currency_symbol }}
                        {{ $data->quote_detail->final_cost }}</strong></td>
            </tr>
            <tr>
                <th colspan="3" class="text-left">Total Value in Words</th>
                <td colspan="10" class="text-left"><strong> {{ $data->currencyName ?? '' }} {{ \App\Helper\Helper::numberToWords($data->quote_detail->final_cost) }} Only</strong></td>
            </tr>
        </table>
    @endif


    <table cellspacing="0" cellpadding="0" border style="margin-top:1.5rem; display: none;">
        <tr>
            <th colspan="4" style="text-align: center;">Details of Supplier</th>

        </tr>
        <tr>
            <th class="width-150">GSTIN</th>
            <td colspan="3"></td>
        </tr>
        <tr>
            <th class="width-150">Address</th>
            <td></td>
            <th class="text-center width-150">State Code</th>
            <td></td>
        </tr>
        <tr>
            <th class="width-150">Email Id</th>
            <td colspan="3"></td>
        </tr>
        <tr>
            <th class="width-150">Website</th>
            <td colspan="3"></td>
        </tr>
        <tr>
            <th class="width-150">CIN</th>
            <td colspan="3"></td>
        </tr>
        <tr>
            <th class="width-150">PAN</th>
            <td colspan="3"></td>
        </tr>
    </table>

    <table cellspacing="0" cellpadding="0" border style="margin-top:1rem">
        <tr>
            <th style="text-align: center;" colspan="3">Payment Details</th>
        </tr>

        
        @if ($inv_details->bank_account == 'yes')
            <tr>
                <td style="width:220px"><strong>By Bank Transfer to:</strong></th>
                <td colspan="2">
                    <!-- <ul style="margin:0"> -->
                    {!! $data->invoice_data->bank_account !!}
                    <!-- </ul> -->
                </td>
            </tr>
        @endif

        <!-- <tr>
      <td style="width:220px">
        <strong>UPI Payment</strong>
      </td>
      <td >
        <p style="margin: 0;"> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Animi exercitationem modi amet odio iure.</p>
      </td>
      <td>
        <img src="{{ asset('asset/qr_code.webp') }}">
      </td>
    </tr> -->
        @if ($inv_details->term_and_condition == 'yes')
            <tr>
                <td style="width:220px">
                    <strong>Terms & Condition</strong>
                </td>
                <td colspan="2">
                    <p style="margin: 0;">{{ $data->invoice_data->term_condition ?? '' }}</p>
                </td>
            </tr>
        @endif

        @if ($inv_details->declaration == 'yes')
            <tr>
                <td style="width:220px">
                    <strong>Declaration</strong>
                </td>
                <td colspan="2">
                    <p style="margin: 0;"> {{ $data->invoice_data->invoice_declaration ?? '' }}</p>
                </td>
            </tr>
        @endif

    </table>
    @if (isset($inv_details->notes) && $inv_details->notes == 'yes')
        <p style="margin-top:0">{!! $data->invoice_data->invoice_note ?? '' !!}</p>
    @endif
    <div style="text-align: center;">
        @if ($inv_details->footer_info == 'yes')
            {!! $data->invoice_data->invoice_footer_info ?? '' !!}
        @endif

    </div>
</body>

</html>
