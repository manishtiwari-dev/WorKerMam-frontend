<table class="table  table_wrapper  mb-0">
    <thead>
        <tr>
        <tr>
            <th class="border-bottom" style="min-width:60px;">{{ __('common.sl_no') }}</th>
            <th class="border-bottom" style="min-width: 150px;">Invoice Date</th>
            <th> Invoice No</th>  
            <th>{{__('crm.customer_details')}}</th> 
            <th> Grand Total </th>
            <th> Status </th>
            <th class="text-center"> Action </th>
        </tr>
        </tr>
    </thead>
    <tbody id="Search_Tr">

        <!-- Start -->
        @if (!empty($content->app_invoice_list))
            @foreach ($content->app_invoice_list as $key => $invoice)
                @php
                    $acc_amt = 0;
                    foreach($invoice->acc_transaction as $acc_txn){ 
                        $acc_amt += $acc_txn->amount;
                    }

                    $due = $invoice->final_cost - $acc_amt;
                    
                @endphp
                <tr>
                    <td class="">{{ $key + 1 }}</td>
                    <td class="">
                        {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d-M-Y') }}
                    </td>
                    <td>{{ $invoice->invoice_number }}</td>
                     

                    <td>
                        <h6 class="tx-semibold mg-b-0">{{ $invoice->customer->first_name ?? '' }}</h6> <span class="tx-color-03">{{ $invoice->customer->company_name ?? ''}}</span>
                        @if(!empty($invoice->customer->company_name))<br />@endif
                        <span class="tx-color-03">{{ $invoice->customer->email ?? ''}}</span>
                    </td>

                    <td  data-toggle="tooltip"
                            data-html="true" id="myButton" title="<tr>
                                <th>Txn Date</th> 
                                <th>Amount</th
                            </tr> 
                            @foreach($invoice->acc_transaction as $acc_txn)
                            <tr>
                                <td>{{$acc_txn->txn_date}}</td>
                                <td>{{$acc_txn->amount}}</td>
                            </tr> 
                            @endforeach">{{ $invoice->final_cost }}<br/>Paid: {{$acc_amt}} <br/>
                                Due: {{$due}}
                    </td> 
                    <td> 
                        <div class="custom-control custom-switch pl-0">
                        <select class="form-select form-control change_status" id="customSwitch" name="status_name"  data-id="{{$invoice->id}}">
                        <option value ="">{{__('crm.select_status')}}</option>
                        <option  value ="unpaid" {{$invoice->status == 'unpaid' ? 'selected' : '' }}>
                            Unpaid
                            </option>
                            <option value="sent" {{$invoice->status == 'sent' ? 'selected' : '' }}>
                            Sent
                            </option>
                            <option value="paid" {{$invoice->status == 'paid' ? 'selected' : '' }}>
                            Paid
                            </option> 
                        </select>                                        
                        </div>
                    </td>
                    <td class="d-flex align-items-center gap-2 justify-content-center">
                        <a href="{{ url('sales/invoice/details/' . $invoice->id) }}" value=""
                            class="btn btn-sm d-flex align-items-center mg-r-5"><i class="fa fa-eye"></i></a>

                        <a href="{{ route('sales.invoice.edit', $invoice->id ) }}"
                            class="btn btn-sm  table_btn py-1 px-2"><i class="fa fa-pencil" ></i></a>

                        <a href="{{ route('sales.download-invoice' , $invoice->invoice_number) }}" value="" class="btn btn-sm d-flex align-items-center mg-r-5"><i class="fa fa-download" ></i></a> 

                        <a href="{{route('sales.invoice.dublicate') . '?duplicate_inv=' . $invoice->id}}" class="btn btn-circle"  data-toggle="tooltip" data-original-title="' . __('app.duplicate') . '"><i class="fa fa-clone" aria-hidden="true"></i></a>

                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6">
                    <h5 class="text-center mb-0 py-1">No Record Found !.</h5>
                </td>
            </tr>
        @endif
    </tbody>
</table>
<!--Pagination Start-->
{!! \App\Helper\Helper::make_pagination(
    $content->total_records,
    $content->per_page,
    $content->current_page,
    $content->total_page,
    'sales.invoice.index',
    ['start_date' => $content->start_date,
     'end_date' => $content->end_date,
     'client' => $content->client,
     'status' => $content->status,
     'search'=>$content->search],
) !!}
<!--Pagination End-->
