<style>
    .select2-wrapper .select2-container {
        width: 100% !important
    }
    
</style>
<x-app-layout>
    @section('title', 'Add Transaction')
    <div class="">
        
        <div class="tab-content">
            <form action="{{ route('accounts.transaction.store') }}" method="post" class="needs-validation" novalidate
                enctype="multipart/form-data">
                @csrf
                <div class="card-header d-flex align-items-center justify-content-between">
                @if($type == 'income')
                    <h6 class="tx-15 mb-0">Add Income</h6>
                @else
                    <h6 class="tx-15 mb-0">Add Expense</h6>
                @endif

                </div>
                <div class="card-body"> 
                    <div class="  border rounded p-3"> 
                    <div class="row">
                        <div class="col-md-4">
                            <label for="category" class="form-label mt-3">{{ __('sales.txn_head') }}<span
                                    class="text-danger">*</span></label>
                            @if($type == 'income')
                                <input type="hidden" name="txn_type" value="{{$type}}">
                                <select name="txn_head" id="txn_head" class="form-control select2" required>
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
                                    Please Select Head
                                </div>
                            @else
                                <input type="hidden" name="txn_type" value="{{$type}}">
                                <select name="txn_head" id="txn_head" class="form-control select2" required>
                                    <option selected disabled value="">
                                        {{ __('sales.select_txn_head') }}</option>
                                    @if (!empty($content->crm_txn_expense))
                                        @foreach ($content->crm_txn_expense as $crm_txn)
                                            <option value="{{ $crm_txn->id }}">{{ $crm_txn->head_title }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select> 
                                <div class="invalid-feedback">
                                    Please Select Head
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label for="category" class="form-label mt-3">{{ __('sales.txn_category') }}<span
                                    class="text-danger">*</span></label>

                            @if($type == 'income')
                                <select name="txn_category" id="category" class="form-control select2" required>
                                    <option selected disabled value="">Select Category</option>
                                    @if (!empty($content->crm_income_category))
                                        @foreach ($content->crm_income_category as $crm_expense)
                                            <option value="{{ $crm_expense->id }}">{{ $crm_expense->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select> 
                                <div class="invalid-feedback">
                                    Please Select Category
                                </div>
                            @else
                                <select name="txn_category" id="category" class="form-control select2" required>
                                    <option selected disabled value="">Select Category</option>
                                    @if (!empty($content->crm_expense_category))
                                        @foreach ($content->crm_expense_category as $crm_expense)
                                            <option value="{{ $crm_expense->id }}">{{ $crm_expense->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select> 
                                <div class="invalid-feedback">
                                    Please Select Category
                                </div>
                            @endif
                            
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
                                placeholder="Please Select Date" required value=""/>
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
                        @if($type == 'income')
                        <div class="col-md-4">
                            <label for="name" class="form-label mt-3">{{ __('sales.source') }} </label>
                            <select name="source" id="source_id" class="form-control select2">
                                <option selected disabled value="">{{ __('sales.select_source') }}
                                </option>
                                    <option value="1">Customer</option>
                                    <option value="2">Orders</option>
                                    <option value="3">Invoices</option>
                            </select>
                                
                        </div>
                        
                        @endif  

                        <div class="col-md-6">

                                <input type="hidden" name="radioInput" id="radioInput"/>
                            <div class="customer select2-wrapper" style="display: none">
                                <label for="customer"
                                    class="form-label mt-3 w-100">{{ __('sales.customer') }}<span
                                        class="text-danger"></span></label>
                                <select name="source_id" id="customer" class="form-control select2 w-100"
                                >
                                    <option selected disabled value="">{{ __('sales.select_customer') }}
                                    </option>
                                    @if (!empty($content->customers))
                                        @foreach ($content->customers as $customer)
                                            <option value="{{ $customer->customer_id }}">
                                                {{ $customer->first_name }} {{ $customer->last_name }}({{$customer->email}})
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="invalid-feedback">
                                    {{ __('sales.customer_error') }}
                                </div>
                            </div>
                            <div class="invoices select2-wrapper" style="display: none">
                                <label for="invoice" class="form-label mt-3">{{ __('sales.invoice') }}<span
                                        class="text-danger"></span></label>
                                <select name="source_id" id="invoice" class="form-control select2">
                                    <option selected disabled value="">{{ __('sales.select_invoice') }}
                                    </option>
                                    @if (!empty($content->invoices))
                                        @foreach ($content->invoices as $invoice)
                                            <option value="{{ $invoice->id }}">
                                                {{ $invoice->invoice_number }} {{$invoice->customer->company_name ?? ''}}  {{$invoice->customer->email ?? ''}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="invalid-feedback">
                                    {{ __('sales.invoice_error') }}
                                </div>
                            </div>
                            <div class="orders select2-wrapper" style="display: none">
                                <label for="order" class="form-label mt-3">{{ __('sales.order') }}<span
                                        class="text-danger"></span></label>
                                <select name="source_id" id="order" class="form-control select2">
                                    <option selected disabled value="">{{ __('sales.select_orders') }}
                                    </option>
                                    @if (!empty($content->orders))
                                        @foreach ($content->orders as $order)
                                            <option value="{{ $order->order_id }}">
                                                {{ $order->order_number }} </option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="invalid-feedback">
                                    {{ __('sales.customer_error') }}
                                </div>
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
                    @if($type == 'income')
                    <div class="border p-3 rounded mt-3">
                        <div class="border-bottom">
                            <h5>Remittance Details</h5>
                        </div> 
                            <div class="row mt-3">
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="sent_amount" class="form-label">{{ __('sales.sent_amount') }}<span
                                        class="text-danger"></span></label>
                                        <input type="number" placeholder="{{ __('sales.sent_amount_placeholder') }}"
                                            name="sent_amt" id="sent_amount" class="form-control" step="any"/>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="received_amount" class="form-label">{{ __('sales.received_amount') }}<span
                                        class="text-danger"></span></label>
                                        <input type="number" placeholder="{{ __('sales.received_amount_placeholder') }}"
                                            name="received_amt" id="received_amount" class="form-control" step="any"/>
                                    </div>
                                        
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="charges" class="form-label">{{ __('sales.charges') }}<span
                                        class="text-danger"></span></label>
                                        <input type="number" placeholder="{{ __('sales.charges_placeholder') }}"
                                            name="charges" id="charges" class="form-control" step="any"/>
                                    </div>
                                        
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 mb-lg-0">
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
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 mb-lg-0">
                                        <label for="exchange_rate" class="form-label">{{ __('sales.exchange_rate') }}<span
                                        class="text-danger"></span></label>
                                        <input type="number" placeholder="{{ __('sales.exchange_rate_placeholder') }}"
                                        name="exchange_rate" id="exchange_rate" class="form-control" step="any"/>
                                    </div>
                                        
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 mb-lg-0">
                                        <label for="bank_charge" class="form-label">{{ __('sales.bank_charge') }}<span
                                        class="text-danger"></span></label>
                                        <input type="number" placeholder="{{ __('sales.bank_charge_placeholder') }}"
                                            name="bank_charge" id="bank_charge" class="form-control" step="any"/>
                                    </div>
                                    
                                </div>
                            </div> 
                    </div>
                    @endif  
                    <!--end row-->
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 col-lg-4 col-6  ml-md-0 mt-2 mt-lg-0">
                        <input type="submit" id="submit" name="send" class="btn btn-primary"
                            value="Submit">
                        <a href="{{ route('accounts.transaction.index') }}"
                            class="btn btn-secondary mx-1">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <!-- this is use toggle button -->
    @push('scripts')
      
        <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
        <script>
            $('.selectsearch').select2({
                searchInputPlaceholder: 'Search options'
            });

            $('.dropify').dropify();
            $('.select2').select2({});
            $(function() {
                $('.datepicker').datepicker({
                    dateFormat: 'dd-mm-yy',
                    onSelect: function() {
                            var selected = $(this).datepicker("getDate");
                        }

                });
                $('.datepicker').datepicker('setDate', new Date());
            });

            // $(".customer").css("display", "block");
    
            $("#source_id").change(function() {
                var source_id = $(this).val();
                
                if(source_id == 1){
                    $(".customer").css("display","block"); 
                    $(".invoices").css("display","none");
                    $(".orders").css("display","none");
                }else if(source_id == 3){
                    $(".invoices").css("display","block");
                    $(".orders").css("display","none");
                    $(".customer").css("display","none"); 
                }else if(source_id == 2){
                    $(".invoices").css("display","none");
                    $(".customer").css("display","none");
                    $(".orders").css("display","block");
                } 
            });

          

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
