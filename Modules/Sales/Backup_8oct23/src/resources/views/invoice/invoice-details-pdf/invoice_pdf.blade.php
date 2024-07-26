<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>INVOICE - INVOICE_NO</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;600&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #000;
            text-decoration: none;
        }

        body {
            position: relative;
            width: 21cm;
            height: 26.7cm;
            margin: 0 auto;
            color: #717171;
            background: #FFFFFF;
            /* font-family: 'IBM Plex Sans', sans-serif; */
            font-family: 'Roboto', sans-serif;
            font-size: 15px;
            padding: 2rem 3rem;
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
            height: 60px;
        }

        #company {
            float: right;
            text-align: right;
        }

        #address {
            width: 50%;
            float: left;
            padding-bottom: 1rem;
        }

        h2.name {
            font-size: 1.4em;
            font-weight: normal;
            margin: 0;
        }

        #invoice {
            float: right;
            text-align: right;
            width: 50%;
        }

        #invoice h1 {
            color: #0087C3;
            font-size: 2.4em;
            line-height: 1em;
            font-weight: normal;
            margin: 0 0 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 10px;
        }

        table th {
            font-size: 14px;
        }

        table th,
        table td {
            padding: 10px 0px;
            text-align: center;
            border-top: 1px solid #f0f0f0;
        }

        table .desc {
            text-align: left;
        }

        table tfoot td {
            text-align: left;
            border-bottom: none;
            white-space: nowrap;
            border: none;
        }

        .term {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header class="clearfix">
        <div id="logo" style="width:60%">
            <img src="{{ $data->invoice_data->invoice_logo ?? '' }}" style="margin-bottom: .5rem;"
                alt="{{ $data->quote_detail->invoice_number ?? '' }}"><br>
            <!--<span>Email:info@gmail.com</span><br>-->
            <!--<span> Phone no. +123 344 4343</span>-->
        </div>
        <div id="company" style="width:40%">
            <div>
                {{ $data->invoice_data->invoice_biller_address ?? '' }}<br>
                <span>Email: {{ $data->invoice_data->business_email ?? '' }}</span><br>
                <span> Phone no. {{ $data->invoice_data->contact_phone ?? '' }}</span>
            </div>
        </div>

    </header>
    <main style="border-top: 1px solid #f0f0f0;padding-top:20px;">
        <div id="details" class="clearfix">
            @if (!empty($data->quote_detail->crm_quotation_address))
                <div id="address">
                    <div style=" margin-bottom:8px;font-size: 14px;font-weight: 600;">TO</div>
                    <div> {{ $data->quote_detail->crm_quotation_address->customer_name }},<br>
                        {{ $data->quote_detail->crm_quotation_address->street_address ?? '' }},<br>
                        {{ $data->quote_detail->crm_quotation_address->city ?? '' }},
                        {{ $data->quote_detail->crm_quotation_address->state ?? '' }}
                        {{ $data->quote_detail->crm_quotation_address->zipcode ?? '' }}<br>
                        {{ $data->quote_detail->crm_quotation_address->country_name ?? '' }}<br>
                        <div style="padding-bottom: 3px;"></div>
                        Phone: {{ $data->quote_detail->crm_quotation_address->phone ?? '' }},<br>
                        E-mail: {{ $data->quote_detail->crm_quotation_address->customer_email ?? '' }}
                    </div>
                </div>
            @endif
            <div id="invoice">
                <div style="margin-bottom: 4px;"> <span style="text-align:left; font-weight: 600">Invoice No: </span>
                    {{ $data->quote_detail->invoice_number }}</div>
                <div> <span style="font-weight: 600">Date:
                    </span>{{ \Carbon\Carbon::parse($data->quote_detail->created_at)->format('d-m-Y') }}</div>
            </div>
        </div>
        <div style="height: 18cm;">
            
        @if($data->invoice_type != 'services')
            <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 22px;">
                <thead>
                    <tr>
                        <th style="text-align:center;"> {{ __('sales.sl_no') }}</th>
                        <th class="qty" style="width:20%;">{{ __('sales.item') }}</th>
                        <th class="price" style="text-align: center;width:20%;">{{ __('crm.sac_code') }}</th>
                        <th class="total" style="text-align:center;">{{ __('sales.unit_price') }}</th>
                        @foreach ($data->quote_detail->crm_invoice_item as $key => $item)
                                @if (!empty($item->discount))
                                    <th styel="text-align:center;">{{ __('sales.discount') }} %</th>
                                @break
                            @endif
                        @endforeach
                        <th styel="text-align:center;">{{ __('sales.item_cost') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($data->quote_detail->crm_invoice_item))
                        @foreach ($data->quote_detail->crm_invoice_item as $key => $item)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="desc">
                                    {{ $item->item_name }}<br />

                                </td>
                                <td class="qty">{{ $item->sac_code ?? '' }}</td>
                                <td class="price" style="text-align: center;">
                                    {{ $data->quote_detail->currency_symbol }} {{ $item->unit_price ?? '' }}</td>
                                @if (!empty($item->discount))
                                    <td class="text-center">{{ $item->discount ?? '' }}</td>
                                @endif
                                <td class="tx-center total">{{ $data->quote_detail->currency_symbol }}
                                    {{ $item->item_cost ?? '' }}</td>

                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        @else
            <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 22px;">
                <thead>
                    <tr>
                        <th style="text-align:center;"> {{ __('sales.sl_no') }}</th>
                        <th class="qty" style="width:20%;">{{ __('sales.item') }}</th>
                        <th class="price" style="text-align: center;width:20%;">{{ __('crm.sac_code') }}</th> 
                        <th styel="text-align:center;">{{ __('sales.item_cost') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($data->quote_detail->crm_invoice_item))
                        @foreach ($data->quote_detail->crm_invoice_item as $key => $item)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="desc">
                                    {{ $item->item_name }}<br />

                                </td>
                                <td class="qty">{{ $item->sac_code ?? '' }}</td>
                                 
                                <td class="tx-center total">{{ $data->quote_detail->currency_symbol }}
                                    {{ $item->item_cost ?? '' }}</td>

                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        @endif

            <table>
                <thead style="border-top: 1px solid #f0f0f0;text-align: right;">
                    <tr>
                        <td style="width:50%; border:none;">&nbsp;</td>
                        <td>{{ __('crm.sub_total') }}</td>
                        <td style="text-align:right">{{ $data->quote_detail->currency_symbol }}
                            {{ $data->quote_detail->subtotal ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="width:50%; border:none;">&nbsp;</td>
                        <td>{{ __('crm.total_tax') }}</td>
                        <td style="text-align:right">{{ $data->quote_detail->currency_symbol }}
                            {{ $data->quote_detail->total_tax ?? '' }}</td>
                    </tr>
                    @if ($data->quote_detail->discount)
                        <tr>
                            <td style="width:50%; border:none;">&nbsp;</td>
                            <td>{{ __('crm.discount') }} %</td>
                            <td style="text-align:right">-{{ $data->quote_detail->discount ?? '' }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td style="width:50%; border:none;">&nbsp;</td>
                        <td style="font-weight: 600;">{{ __('crm.total_due') }}</td>
                        <td style="text-align:right">{{ $data->quote_detail->currency_symbol }}
                            {{ $data->quote_detail->final_cost ?? '' }}</td>
                    </tr>
                </thead>
            </table>
        </div>

</main>
<footer>
    @if (!empty($data->invoice_data->term_condition))
        <div style="float:left; width:50%">
            <div class="term">Terms &amp; Conditions</div>
            <p>{{ $data->invoice_data->term_condition ?? '' }}</p>
        </div>
    @endif
    @if (!empty($data->invoice_data->bank_account))
        <div style="float:right">
            <div class="term">
                {{ __('crm.bank_detail') }}</div>
            <p> {{ $data->invoice_data->bank_account }}</p>
        </div>
    @endif
    </div>
    </div>
    <div style="display:inline-table; border-top:1px solid #000;padding:1rem 0;margin: 1rem 0; width:100%">
        <div style="float: left;">
            <strong>{{ __('crm.call') }} : </strong> {{ $data->invoice_data->contact_phone ?? '' }}
        </div>
        <!--<span style="margin-left:60px">-->
        <!--<strong>Fax : </strong>  +012340-908- 890-->
        <!--</span>-->
        <div style="float: right">
            <strong>{{ __('crm.email') }} : </strong> {{ $data->invoice_data->business_email ?? '' }}
        </div>
    </div>
</footer>
</body>

</html>
