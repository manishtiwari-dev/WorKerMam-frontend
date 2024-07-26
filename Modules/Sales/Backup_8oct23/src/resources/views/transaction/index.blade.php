<x-app-layout>
    @section('title', 'Transaction')
    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true') 
    <div class="card contact-content-body">
        <div class="card-header">

            <div class="d-flex align-items-center justify-content-between">
                <h6 class="tx-15 mg-b-0">{{ __('sales.transaction_list') }}</h6>

                <div class="d-flex gap-2">
                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true') 

                    <a href="{{ route('accounts.transaction.create',['type=expense']) }}" class="btn btn-sm btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mg-r-5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>{{ __('sales.add_expense') }}</i></a>
                    <a href="{{ route('accounts.transaction.create',['type=income']) }}" class="btn btn-sm btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mg-r-5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>{{ __('sales.add_income') }}</i></a>
                    <a class="pull-right" onclick="exportJobApplication()"><button class="btn btn-sm btn-primary"
                            type="button">
                            <i class="fa fa-upload"></i> Export</button></a> 
                            @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 mb-2">
                    <label>Head</label>
                    <select class="form-control select2 select-filter" name="txnhead" id="txnhead">
                        <option value="all">All Head</option>
                        @if(!empty($content->txnheads))
                        @foreach($content->txnheads as $txnhead)
                        <option value="{{$txnhead->id}}"> {{$txnhead->head_title}} </option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-lg-3 mb-2 tagselect">
                    <label>Category</label>
                    <select class="form-control select-filter " data-placeholder="Invoice Status" name="txncategory"
                        id="txncategory">
                        <option value="all">All Category</option>
                        @if(!empty($content->TxnCategory))
                        @foreach($content->TxnCategory as $category)
                        <option value="{{$category->id}}"> {{$category->name}} </option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-lg-3 mb-2 tagselect">
                    <label>Accounts</label>
                    <select class="form-control select-filter " data-placeholder="Invoice Status" name="accounts"
                        id="accounts">
                        <option value="all">All Accounts</option>
                        @if(!empty($content->accounts))
                        @foreach($content->accounts as $account)
                        <option value="{{$account->id}}"> {{$account->account_title}} </option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-lg-3">
                    <label> Date Range </label>
                    <input type="text" id="datatableRange" name="datatableRange" class="form-control"
                        placeholder="{{ __('common.daterange_placeholder') }}" />
                </div>
                <input type="hidden" id="startDate" value="all"/>
                <input type="hidden" id="endDate" value="all"/>
                <div class="col-lg-6 mt-4">
                    <label> </label>
                    <a class="btn btn-primary px-5" href="{{ route('accounts.transaction.index') }}"
                        role="button">{{ __('common.reset') }}</a>
                </div>
            </div>
            <hr>
            <div class="table-responsive" id="customer_listing">
                <table class="table border table_wrapper">
                    <thead>
                        <tr>
                            <th>{{ __('common.sl_no') }}</th>
                            <th>{{ __('sales.txnDate') }}</th>
                            <th>{{ __('sales.txn_title') }}</th>
                            <th>{{ __('sales.amount') }}</th> 
                            <th>{{ __('sales.txn_type') }}</th> 
                            <th>Accounts</th>
                            <th>{{ __('common.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($content->app_transactions as $key => $transaction)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($transaction->txn_date)->format('d-M-Y') }}</td> 
                                
                                <td>{{ $transaction->txn_title }}</td>                    
                                <td>{{ $transaction->amount }} </td> 
                                <td>
                                    <span class="badge  {{($transaction->dr_cr == 'dr')?'text-bg-danger':'text-bg-success'}}">{{($transaction->dr_cr == 'cr')?'Cr':'Dr'}}</span>
                                </td>
                                <!-- <td></td> -->
                                <td>{{$transaction->accounts->account_title ?? ''}}</td>
                                <td class="d-flex align-items-center  gap-2"> 
                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                        <a href="{{ route('accounts.transaction.edit', $transaction->id) }}"
                                            class="btn btn-sm  table_btn py-1 px-2"><i
                                                data-feather="edit-2"></i></a>
                                    @endif

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
                  {!! \App\Helper\Helper::make_pagination(
                    $content->total_records,
                    $content->per_page,
                    $content->current_page,
                    $content->total_page,
                    'accounts.transaction.index',
                    ['start_date' => $content->start_date, 'end_date' => $content->end_date],
                ) !!}
            </div>
        </div>
    </div>
    @endif

    <!--start delete modal-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel5">Delete Transaction </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>{{ __('common.delete_confirmation') }}</h6>
                    <input type="hidden" id="deleteExpenseId" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('common.no') }}
                    </button>
                    <button type="submit" class="btn btn-primary expenseDelBtn">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--end delete modal-->

    @push('scripts')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>
        <script>
            $(document).on("click", "#delete_btn", function() {
                var expense_id = $(this).val();
                $('#deleteExpenseId').val(expense_id);
            });

            //delete modal confirmation data start here
            $(document).on('click', '.expenseDelBtn', function() {
                var transaction_id = $('#deleteExpenseId').val();
                console.log(transaction_id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('accounts.destroy') }}",
                    data: {
                        transaction_id: transaction_id,
                    },
                    dataType: "json",
                    success: function(response) {
                        Toaster('success', response.success);
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000);
                    }
                });
            });
        </script>

        <script>
            $('.select2').select2({});

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
                $("#startDate").val(startDate);
                $("#endDate").val(endDate);
                tableWebContent(startDate, endDate);

            }

            $(document).ready(function() {
                $("#txnhead").on('change', function(e) {
                    var txncategory = $("#txncategory").val();
                    var accounts = $("#accounts").val();
                    tableWebContent('', '', this.value, txncategory, accounts);
                });
            });
            $(document).ready(function() {
                $("#txncategory").on('change', function(e) {
                    var txnhead = $("#txnhead").val();
                    var accounts = $("#accounts").val();
                    tableWebContent('', '', txnhead, this.value, accounts);
                });
            });
            $(document).ready(function() {
                $("#accounts").on('change', function(e) {
                    var txncategory = $("#txncategory").val();
                    var txnhead = $("#txnhead").val();
                    tableWebContent('', '', txnhead, txncategory, this.value);
                });
            });


            function tableWebContent(startDate = '', endDate = '', txnhead = '', txncategory = '',accounts='' ) {

                const url = "{{ route('accounts.txn-filter') }}";
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
                        txnhead: txnhead,
                        txncategory: txncategory,
                        accounts: accounts,
                    },
                    dataType: "json",
                    success: function(result) {
                        $("#customer_listing").html(result.html);
                    }
                });
            }



            function exportJobApplication() {
                var endDate = $("#endDate").val();
                var startDate = $("#startDate").val();
                
                var txnhead = $('#txnhead').val();
                
                var txncategory = $('#txncategory').val();

                var accounts = $('#accounts').val();
 



                var url =
                    '{{ route('accounts.txn-export', [':txnhead', ':txncategory', ':accounts', ':startDate' , ':endDate']) }}';
                url = url.replace(':txnhead', txnhead);
                url = url.replace(':txncategory', txncategory);
                url = url.replace(':accounts', accounts);
                url = url.replace(':startDate', startDate);
                url = url.replace(':endDate', endDate);

                

                window.location.href = url;
            }
        </script>
    @endpush


</x-app-layout>
