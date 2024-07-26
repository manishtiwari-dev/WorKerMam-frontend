<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;600&display=swap');

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #000;
            text-decoration: none;
        }

        p {
            margin: 0
        }

        body {
            position: relative;
            width: 22cm;
            height: 26.7cm;
            margin: 0 auto;
            color: #555555;
            background: #FFFFFF;
            font-family: 'IBM Plex Sans', sans-serif;
            font-size: 16px;
            /* padding: 1rem; */
            box-sizing: border-box;
            line-height: 20px;

        }

        header {
            padding: 10px 0;
            margin-bottom: 20px;
        }

        #logo {
            float: left;
        }

        #logo img {
            height: 70px;
        }

        #company {
            float: right;
        }

        #address {
            width: 60%;
            float: left;
            padding-bottom: 1rem;
        }

        #invoice {
            float: right;
            text-align: right;
            width: 40%;
        }

        #invoice span {
            float: left
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table th {
            font-size: 14px;
        }

        table th,
        table td {
            padding: 10px 12px;
            text-align: center;
            border-top: 1px solid #f0f0f0;
        }

        table .desc {
            text-align: left;
        }

        table tfoot td {
            text-align: left;
            padding: 10px 35px;
            background: #FFFFFF;
            border-bottom: none;
            white-space: nowrap;
            border: none
        }

        .term {
            font-weight: bold;
        }

        footer {
            width: 100%;
            padding-top: 35px
        }
    </style>
</head>

<body>
    <header class="clearfix">
        <div id="logo" style="width:60%">
            <img src="{{ $order['companydetails']->website_logo }}"
                onerror="this.onerror=null; this.src='{{ asset(config('constkey.no_image')) }}'"
                style="margin-bottom: .5rem;" alt="logo_img"><br>
        </div>
        <div id="address" style="width:40%" style="float: right">
            <div> {{ $order['companydetails']->contact_company_name ?? '' }},<br>
                {{ $order['companydetails']->contact_address ?? '' }}<br>
                {{ $order['companydetails']->contact_city ?? '' }}<br>
                <div style="padding-bottom: 3px;"></div>
                @if ($order['companydetails']->contact_phone)
                    Phone: {{ $order['companydetails']->contact_phone }},<br>
                @endif
                @if ($order['companydetails']->contact_email)
                    E-mail: {{ $order['companydetails']->contact_email }}
                @endif
            </div>
        </div>
        <hr>
    </header>
    <main>
        <div class="clearfix" style="clear: both; display:block;">
            <div style="float: right; width:40%;text-align:left">
                <div style="margin-bottom:4px">
                    <div style=""> <span style="font-weight:600;">Invoice No
                            : </span>{{ $order['order_details']->order_number ?? '' }}</div>
                    <div style=""> <span style="font-weight:600;">Invoice Date :
                        </span> {{ \Carbon\Carbon::parse($order['order_details']->created_at)->format('d/m/Y') }}</div>
                </div>
            </div>
        </div>
        <div id="details" class="clearfix" style="margin-top: 10px;">

            <div id="address">
                {{-- @dd($order['order_details']->address[0]->customer_name) --}}
                <h4>BILLED TO</h4>
                <div>
                    {{ $order['order_details']->address[0]->customer_name ?? '' }}<br>
                    {{ $order['order_details']->address[0]->customer_address ?? '' }}
                    {{ $order['order_details']->address[0]->customer_city ?? '' }} <br>
                    {{ $order['order_details']->address[0]->customer_state ?? '' }}
                    {{ $order['order_details']->address[0]->customer_country ?? '' }}<br>
                    {{ $order['order_details']->address[0]->customer_postcode ?? '' }}<br>
                    <span>Tel:</span> {{ $order['order_details']->address[0]->customer_phone ?? '' }}
                </div>


            </div>
            <div id="invoice" style="text-align: left;">
                <h4>SHIP TO</h4>
                <div>
                    {{ $order['order_details']->address[1]->customer_name ?? '' }}<br>
                    {{ $order['order_details']->address[4]->customer_address ?? '' }}
                    {{ $order['order_details']->address[1]->customer_city ?? '' }} <br>
                    {{ $order['order_details']->address[1]->customer_state ?? '' }}
                    {{ $order['order_details']->address[1]->customer_country ?? '' }}<br>
                    {{ $order['order_details']->address[1]->customer_postcode ?? '' }}<br>
                    <span>Tel:</span> {{ $order['order_details']->address[1]->customer_phone ?? '' }}
                </div>
            </div>
        </div>
        @if (!empty($order['order_details']->item))
            <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 50px;" <thead>
                <tr style="background: #f4f4f4; border-bottom: 1px solid #f0f0f0;">
                    <th style="text-align:left; width:350px">ITEM</th>
                    <th class="unit" style="width:100px">UNIT PRICE</th>
                    <th class="qty" style="width:200px">QUANTITY</th>
                    @foreach ($order['order_details']->item as $key => $item)
                        @if (!empty($item->discount))
                            <th class="tx-center qty" style="width:100px;"> Discount %</th>
                        @else
                            <th class="tx-center qty" style="width:100px;"> </th>
                        @endif
                    @break
                @endforeach

                @foreach ($order['order_details']->item as $key => $value)
                    @if (!empty($value->tax_id))
                        <th class="tx-center qty">TAX %</th>
                    @else
                        <th class="tx-center qty"> </th>
                    @endif
                @break
            @endforeach
            <th class="total" style="width:100px">TOTAL</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($order['order_details']->item as $key => $order_item)
                <tr style="background: #ffffff; font-weight: 300;border-bottom: 1px solid #f0f0f0;">
                    <td class="desc">{{ $order_item->product_name ?? '' }}
                        @if (!empty($orderdetails['attrOptArray']) && !empty($order_item->product))
                            @foreach ($orderdetails['attrOptArray'][$order_item->product->product_id] as $attsubarr)
                                @foreach ($attsubarr as $attrkey => $attrVal)
                                    @if (!empty($attrVal))
                                        <p>{{ $attrkey }} : {{ $attrVal }}</p>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    </td>
                    <td class="unit">
                        {{ $order['currencyList'][0]->symbol_left }}{{ $order_item->unit_price }}</td>
                    <td class="qty">{{ $order_item->qty ?? '' }}</td>
                    @foreach ($order['order_details']->item as $key => $item)
                        @if (!empty($item->discount))
                            <td class="qty">{{ $order_item->discount ?? '' }}</td>
                        @else
                            <td class="qty"> </td>
                        @break
                    @endif
                @endforeach

                @foreach ($order['order_details']->item as $key => $value)
                    @if (!empty($value->tax_id))
                        <td class="text-center">{{ $order['currencyList'][0]->symbol_left }}
                            {{ $order_item->tax_amount ?? 0 }}</td>
                    @else
                        <td class="qty"></td>
                    @endif
                @break
            @endforeach
            <td class="total">
                {{ $order['currencyList'][0]->symbol_left }}{{ $order_item->total_price ?? '' }}</td>
        </tr>
    @endforeach
</tbody>
<tfoot style="border-top: 1px solid #f4f4f4;">
    @php
        $subtotal = $order['order_details']->sub_total;
        if (!empty($item->discount)) {
            $colspan = 5;
        } else {
            $colspan = 4;
        }
    @endphp
    <tr>
        <td colspan={{ $colspan }}></td>
        <td>Sub-Total</td>
        <td style="text-align:right;">{{ $order['currencyList'][0]->symbol_left }}{{ $subtotal }}
        </td>
    </tr>

    @if ($order['order_details']->discount_total != 0)
        <tr>
            <td colspan={{ $colspan }}></td>
            <td>COUPON DISCOUNT </td>
            <td style="text-align:right;">-
                {{ $order['currencyList'][0]->symbol_left }}{{ $order['order_details']->discount_total ?? '' }}
            </td>
        </tr>
    @endif

    @if ($order['order_details']->shipping_total != 0)
        <tr>
            <td colspan={{ $colspan }}></td>
            <td> SHIPPING_CHARGE</td>
            <td style="text-align:right;">
                {{ $order['currencyList'][0]->symbol_left }}
                {{ $order['order_details']->shipping_total ?? '' }}
            </td>
        </tr>
    @endif


    @if (!empty($order['order_details']->tax_details))
        @foreach (json_decode($order['order_details']->tax_details) as $taxKey => $taxVal)
            <tr>
                <td colspan={{ $colspan }}></td>
                <td>{{ $taxKey }} ({{ $order['order_details']->tax_type }})</td>
                <td style="text-align:right;">
                    {{ $order['currencyList'][0]->symbol_left }}{{ $taxVal }}</td>
            </tr>
        @endforeach
    @endif

    <tr>
        <td colspan={{ $colspan }}></td>
        <td style="background-color:#f4f4f4;font-weight: 600;">Total </td>
        <td style="text-align:right;background-color:#f4f4f4;">
            {{ $order['currencyList'][0]->symbol_left }}{{ $order['order_details']->grand_total ?? '' }}
        </td>
    </tr>
</tfoot>
</table>
@endif
</main>

<footer style="position:absolute;bottom:-280px">
<div style="float:left; width:50%">
@if ($order['companydetails']->termCondition)
<div class="term">Terms &amp; Conditions</div>
<p>{{ $order['companydetails']->termCondition }}
</p>
@endif
</div>
<div style="float:right">
@if ($order['companydetails']->bankdetails)
<div class="term">
    Bank Details</div>
<p> A/c No 111100231231 IFSC: FDADSDAS3213</p>
@endif
</div>
</div>
</div>
<div style="display:inline-table; border-top:1px solid #000;padding:1rem 0;margin: 1rem 0; width:100%">
<div style="float: left;">
<strong>Email :</strong> {{ $order['companydetails']->contact_email }}
</div>
<div style="float: right">
<strong>Call :</strong> {{ $order['companydetails']->contact_phone }}
</div>
</div>
</footer>
</body>

</html>
