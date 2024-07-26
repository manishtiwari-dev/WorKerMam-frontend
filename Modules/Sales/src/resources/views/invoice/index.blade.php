<x-app-layout>
    @section('title', 'Invoice')
   

     <!--start add modal-->
     <div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modalselect2" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add Income</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> 
                    
                </div>
                <div class="modal-body">
                <form action="{{ route('accounts.transaction.store') }}" method="post" class="needs-validation" novalidate
                enctype="multipart/form-data">
                @csrf
                 
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 ps-4">
                            <div class="  border rounded p-3"> 
                            <div class="row">
                                <div class="col-md-4">
                                    <div><label for="category" class="form-label mt-3">{{ __('sales.txn_head') }}<span class="text-danger">*</span></label></div>

                                        
                                        <input type="hidden" name="source_id" id="invoiceDataId"/>
                                        <input type="hidden" name="source" value="3"/>
                                        <input type="hidden" name="invoicePage" value="inv"/>
                                    
                                        <input type="hidden" name="txn_type" value="income">
                                        <div><select name="txn_head" id="txn_head" class="form-control select2 w-100" required>
                                            <option selected disabled value="">
                                                {{ __('sales.select_txn_head') }}</option>
                                            @if (!empty($content->crm_txn_income))
                                                @foreach ($content->crm_txn_income as $crm_txn)
                                                    <option value="{{ $crm_txn->id }}">{{ $crm_txn->head_title }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select> 
                                        <div class="invalid-feedback">
                                            Please Select Transaction Head
                                        </div> 
                                        </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="category" class="form-label mt-3">{{ __('sales.txn_category') }}<span
                                            class="text-danger">*</span></label>
 
                                        <select name="txn_category" id="category" class="form-control select2" required>
                                            <option selected disabled value="">Select Transaction Category</option>
                                            @if (!empty($content->crm_income_category))
                                                @foreach ($content->crm_income_category as $crm_expense)
                                                    <option value="{{ $crm_expense->id }}">{{ $crm_expense->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select> 
                                        <div class="invalid-feedback">
                                            Please Select Transaction Category
                                        </div>                                     
                                </div>

                                <div class="col-md-4">
                                    <label for="name" class="form-label mt-3">{{ __('sales.accounts') }}
                                        <span class="text-danger">*</span></label>
                                    <select name="account_id" id="account" class="form-control select2" required>
                                        <option selected disabled value="">{{ __('sales.select_account') }}
                                        </option>
                                        @if (!empty($content->accounts))
                                            @foreach ($content->accounts as $account)
                                                <option value="{{ $account->id }}">{{ $account->account_title }} - {{ $account->account_number }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ __('sales.account_error') }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="date" class="form-label mt-3">{{ __('sales.txn_date') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="txn_date" id="date" class="form-control datepicker"
                                        placeholder="Please Select Date" required />
                                    <div class="invalid-feedback">
                                        {{ __('sales.expense_error') }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="category" class="form-label mt-3">{{ __('sales.txn_title') }}<span
                                            class="text-danger">*</span></label>
                                    <input name="txn_title" type="text" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Please Enter Title
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="amount" class="form-label mt-3">{{ __('sales.amount') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="number" step="0.0001" placeholder="{{ __('sales.ammount_placeholder') }}"
                                        name="amount" id="amount" class="form-control" required />
                                    <div class="invalid-feedback">
                                        {{ __('sales.ammount_error') }}
                                    </div>
                                </div>  

                                 
                                <div class="col-md-12">
                                    <label for="note"
                                        class="form-label mt-3">{{ __('sales.note') }}</label>
                                    <textarea name="note" class="form-control"></textarea>
                                    <div class="invalid-feedback">
                                        {{ __('sales.note_error') }}
                                    </div>
                                </div>

                                <div class="col-md-12">

                                    <label for="file"
                                        class="form-label mt-3">{{ __('sales.attach_receipt') }} </label>

                                    <input type="file" class="form-control dropify" data-height="100"
                                        name="attachment" >
                                    <div class="invalid-feedback">
                                        {{ __('sales.file_error') }}
                                    </div>
                                </div>
                                </div>
                            </div> 
                            <div class="border p-3 rounded">
                                <div class="border-bottom">
                                    <h5>Remittance Details</h5>
                                </div> 
                                    <div class="row mt-3">
                                        
                                        <div class="col-md-4">
                                            <label for="sent_amount" class="form-label">{{ __('sales.sent_amount') }}<span
                                            class="text-danger"></span></label>
                                            <input type="number" placeholder="{{ __('sales.sent_amount_placeholder') }}"
                                                name="sent_amt" id="sent_amount" class="form-control"  step="any"/>
                                            
                                        </div>
                                        <div class="col-md-4">
                                            <label for="received_amount" class="form-label">{{ __('sales.received_amount') }}<span
                                            class="text-danger"></span></label>
                                            <input type="number" placeholder="{{ __('sales.received_amount_placeholder') }}"
                                                name="received_amt" id="received_amount" class="form-control"  step="any"/>
                                           
                                        </div>
                                        <div class="col-md-4">
                                            <label for="charges" class="form-label">{{ __('sales.charges') }}<span
                                            class="text-danger"></span></label>
                                            <input type="number" placeholder="{{ __('sales.charges_placeholder') }}"
                                                name="charges" id="charges" class="form-control" step="any" />
                                            
                                        </div>
                                        <div class="col-md-4">
                                            <label for="payment_method" class="form-label">{{ __('sales.payment_method') }}<span
                                            class="text-danger"></span></label>
                                            <select class="form-control" name="payment_method_id" id="payment_method" >
                                            <option selected value="" disabled>Select Payment Method</option>
                                            @if(!empty($content->payment_method))
                                            @foreach($content->payment_method as $key=>$payment)   
                                                <option value="{{$payment->payment_method_id}}">{{$payment->method_name}}</option>
                                            @endforeach
                                            @endif
                                            </select>
                                            
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exchange_rate" class="form-label">{{ __('sales.exchange_rate') }}<span
                                            class="text-danger"></span></label>
                                            <input type="number" placeholder="{{ __('sales.exchange_rate_placeholder') }}"
                                                name="exchange_rate" id="exchange_rate" class="form-control"  step="any"/>
                                            
                                        </div>
                                        <div class="col-md-4">
                                            <label for="bank_charge" class="form-label">{{ __('sales.bank_charge') }}<span
                                            class="text-danger"></span></label>
                                            <input type="number" placeholder="{{ __('sales.bank_charge_placeholder') }}"
                                                name="bank_charge" id="bank_charge" class="form-control"  step="any"/>
                                            
                                        </div>
                                    </div> 
                            </div> 
                        </div>
                        <div class="row mt-5">
                        <div class="col-md-4 col-lg-4 col-6  ml-md-0 mt-2 mt-lg-0">
                            <input type="submit" id="submit" name="send" class="btn btn-primary"
                                value="Submit">
                            <a href="{{ route('sales.invoice.index') }}"
                                class="btn btn-secondary mx-1">Cancel</a>
                        </div>
                    </div>
                    </div>

                    
                    <!--end row-->
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
    <!--end add modal-->
   @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true') 

    <div class="row">
        <div class="col-12">

            <div class="card contact-content-body">
                <div class="card-header py-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <h6 class="tx-15 mg-b-0">Invoice List</h6>
                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true') 
                        <a href="{{ route('sales.invoice.create') }}" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mg-r-5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>Add Invoice</i></a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-lg-3 mb-2">
                            <label>Invoice Number</label>
                            <input type="text" placeholder="Search..." class="form-control select-filter"
                                name="invoice_number" id="search" value="{{$content->search}}">
                        </div>
                        <div class="col-lg-3 mb-2">
                            <label>Customer</label>
                           <div>
                            <select class="form-control select2 select-filter" name="client_id" id="cliend_id">
                                    <option value="">All Customer</option>
                                    @if (!empty($content->customer))
                                        @foreach ($content->customer as $ls_data)
                                            <option value="{{ $ls_data->customer_id }}" @if($ls_data->customer_id==$content->client) selected @endif> {{ $ls_data->first_name }} <br>  {{ $ls_data->company_name }} 
                                                <br> <span style="font-size:3px;">({{ $ls_data->email ?? '' }})</span>
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                           </div>
                        </div>
                        <div class="col-lg-2 mb-2 ">
                           <div class="tagselect">
                                <label>Status</label>
                                <select class="form-control select-filter " data-placeholder="Invoice Status" name="status"
                                    id="status"> 
                                    <option value="">All Status</option>
                                    <option value="unpaid" @if($content->status=="unpaid") selected @endif> UnPaid </option>
                                    <option value="sent" @if($content->status=="sent") selected @endif> Sent </option>
                                    <option value="paid" @if($content->status=="paid") selected @endif> Paid </option>
                                </select>
                           </div>
                        </div>
                        <div class="col-lg-2 mb-2">
                            <label> Date Range </label>
                            <input type="text" id="datatableRange" name="datatableRange" class="form-control"
                                placeholder="{{ __('common.daterange_placeholder') }}" />
                        </div>
                        <div class="col-lg-2 mt-4">
                            <label> </label>
                            <a class="btn btn-primary px-5" href="{{ route('sales.invoice.index') }}"
                                role="button">{{ __('common.reset') }}</a>
                        </div>
                    </div>

                    <div class="table-responsive" id="customer_listing">
                        <table class="table  table_wrapper">
                            <thead>
                                <tr>
                                    <th class="border-bottom" style="min-width:60px;">{{ __('common.sl_no') }}</th>
                                    <th class="border-bottom" style="min-width: 150px;">Invoice Date</th>
                                    <th> Invoice No </th>  
                                    <th>{{__('crm.customer_details')}}</th> 
                                    <th> Grand Total </th>
                                    <th> Status </th>
                                    <th class="text-center"> Action </th>
                                </tr>
                            </thead>
                            <tbody>  
                                @forelse($content->app_invoice_list as $key => $app_invoice)

                                @php
                                    $acc_amt = 0;
                                    foreach($app_invoice->acc_transaction as $acc_txn){ 
                                        $acc_amt += $acc_txn->amount;
                                    }

                                    $due = $app_invoice->final_cost - $acc_amt;
                                    
                                @endphp
                                    <tr>
                                        <td class="">{{ $key + 1 }}</td>
                                        <td class="">
                                            {{ \Carbon\Carbon::parse($app_invoice->invoice_date)->format('d-M-Y') }}
                                        </td>
                                        <td>{{ $app_invoice->invoice_number }}</td>
                                         

                                        <td>
                                            <h6 class="tx-semibold mg-b-0">{{ $app_invoice->customer->first_name ?? '' }}</h6> <span class="tx-color-03">{{ $app_invoice->customer->company_name ?? ''}}</span>
                                            @if(!empty($app_invoice->customer->company_name))<br />@endif
                                            <span class="tx-color-03">{{ $app_invoice->customer->email ?? ''}}</span>
                                        </td> 

                                        <td  data-bs-toggle="tooltip" data-bs-html="true" title="Txn Date  Amount 
                                            @foreach($app_invoice->acc_transaction as $acc_txn) 
                                                {{$acc_txn->txn_date}} {{$acc_txn->amount}} 
                                            @endforeach">
                                        
                                            {{ $app_invoice->final_cost }}<br/> 
                                            @if($acc_amt < 0)
                                                <span class="badge text-bg-danger">Paid: {{$acc_amt}}</span>
                                            @else
                                                <span class="badge text-bg-success"> Paid: {{$acc_amt}}</span>
                                            @endif
                                            <br/>
                                            @if($due > 0)
                                                <span class="badge text-bg-danger"> Due: {{$due}}</span>
                                            @else
                                                <span class="badge text-bg-success"> Due: {{$due}}</span>
                                            @endif 
                                        </td>
                                        <td> 
                                        <div class="custom-control custom-switch pl-0">
                                        <select class="form-select form-control change_status" id="customSwitch" name="status_name"  data-id="{{$app_invoice->id}}">
                                        <option value ="">{{__('crm.select_status')}}</option>
                                        <option  value ="unpaid" {{$app_invoice->status == 'unpaid' ? 'selected' : '' }}>
                                            Unpaid
                                            </option>
                                            <option value="sent" {{$app_invoice->status == 'sent' ? 'selected' : '' }}>
                                            Sent
                                            </option>
                                            <option value="paid" {{$app_invoice->status == 'paid' ? 'selected' : '' }}>
                                            Paid
                                            </option> 
                                            <option value="paid" >
                                                Re-Paid
                                            </option>
                                        </select>                                        
                                        </div>
                                        </td>
                                        <td class="d-flex align-items-center gap-2 justify-content-center">
                                            <a href="{{ url('sales/invoice/details/' . $app_invoice->id) }}"
                                                value=""
                                                class="btn btn-sm  d-flex align-items-center mg-r-5 px-0"><i
                                                    data-feather="eye"></i></a>
                                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true') 
                                            <a href="{{ route('sales.invoice.edit', $app_invoice->id) }}"
                                                class="btn btn-sm  table_btn px-0"><i
                                                    data-feather="edit-2"></i></a>
                                               @endif
                                            <a href="{{ route('sales.download-invoice' , $app_invoice->invoice_number) }}"
                                                value=""
                                                class="btn btn-sm d-flex align-items-center px-0 mg-r-5"><i
                                                    data-feather="download"></i></a>

                                                    <a href="{{route('sales.invoice.dublicate') . '?duplicate_inv=' . $app_invoice->id}}" class="px-0 btn btn-circle"  data-toggle="tooltip" data-original-title="' . __('app.duplicate') . '"><i class="fa fa-clone" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <h5 class="text-center mb-0 py-1">No Record Found !.</h5>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- @dd($content) --}}
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif



    @push('scripts')
    
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> 
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
 
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>
        <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
        <script>


            $('.select2').select2({});
            $('.dropify').dropify();
            $(function() {
                // tableWebContent();
                var start = moment();
                var end = moment();

                function cb(start, end) {
                    $('#datatableRange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }

                $('#datatableRange').daterangepicker({
                    autoUpdateInput: false,
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last 6 Month': [moment().subtract(6, 'month'), moment()],
                        'Last Year': [moment().subtract(1, 'year'), moment()]
                    },
                    locale: {
                        format: 'YYYY-MM-D'
                    }
                }, cb);

                cb(start, end);
            });

            $(document).ready(function() {
                $('input[name="datatableRange"]').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                        'YYYY-MM-DD'));
                    ajaxSubmitData();
                });

                $("#search").on('keyup', function(e) {
                    var status = $("#status").val();
                    var cliend_id = $("#cliend_id").val();
                    tableWebContent('', '', this.value, cliend_id, status);
                });

            });

            function ajaxSubmitData() {
                var dateRangePicker = $('#datatableRange').data('daterangepicker');
                var startDate = $('#datatableRange').val();

                if (startDate == '') {
                    startDate = null;
                    endDate = null;
                } else {
                    startDate = dateRangePicker.startDate.format('YYYY-MM-DD');
                    endDate = dateRangePicker.endDate.format('YYYY-MM-DD');
                }

                if (startDate != '' && endDate != '')
                    $("#order_listing").html('');

                $("#order_listing").html('');
                tableWebContent(startDate, endDate);
            }

            $(document).ready(function() {
                $("#cliend_id").on('change', function(e) {
                    var status = $("#status").val();
                    var search = $("#search").val();
                    tableWebContent('', '', search, this.value, status);
                });

            });

            $(document).ready(function() {
                $("#status").on('change', function(e) {
                    var cliend_id = $("#cliend_id").val();
                    var search = $("#search").val();
                    tableWebContent('', '', search, cliend_id, this.value);
                });

            });


            function tableWebContent(startDate = '', endDate = '', search = '', client = '', status = '') {

                const url = "{{ route('sales.invo-filter') }}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        start_date: startDate,
                        end_date: endDate,
                        search: search,
                        source: '1',
                        client: client,
                        status: status
                    },
                    dataType: "json",
                    success: function(result) {
                        $("#customer_listing").html(result.html);
                    }
                });
            }
            


            $(document).on('change','.change_status',function(e){
                let status = $(this).val();
                var quotation_id =  $(this).data('id');

               
                $("#quotationVal").val(quotation_id);
                if (status === 'paid') {

                    $('#invoiceModal').modal('show');
                    $('.select2').select2({
                        dropdownParent: $('#invoiceModal')
                    });  
                    $('.datepicker').datepicker('setDate', new Date());
                    
                    $(function() {
                        $('.datepicker').datepicker({
                            dateFormat: 'dd-mm-yy',
                            onSelect: function() {
                                var selected = $(this).datepicker("getDate");
                            }
                        });
                       
                    });

                    $("#statusVal").val(status);
                    $("#invoiceDataId").val(quotation_id);

                } else {  
                    invoicechange(status, quotation_id);
                }
            });
 
 
            function invoicechange(status, quotation_id){
                  
                $("#invoiceDataId").val(quotation_id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }); 
                 
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('sales/invoice-changeStatus') }}",
                    data: {
                        status: status,
                        quotation_id : quotation_id
                    },
                    success: function(data) {
                        Toaster('success','Status Changed ');
                    }
                });
            }; 

            $(document).ready(function() { 
                $('#received_amount').on('blur', function() {
                    var recAmt = $(this).val();
                    var sentAmt = $("#sent_amount").val();
                    var charge = sentAmt-recAmt;
                    $("#charges").val(charge);
                });
            });


        </script>
    @endpush
</x-app-layout>
