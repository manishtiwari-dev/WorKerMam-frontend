<x-app-layout>
    @section('title', $pageTitle)

    <div class="card contact-content-body">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="tx-15 mg-b-0">{{ __('sales.expense_list') }}</h6>
                <a href="{{ route('sales.expenses.create') }}" class="btn btn-sm btn-bg">
                    {{ __('sales.add_expense') }}</i></a>
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive" id="customer_listing">
                <table class="table  table_wrapper">
                    <thead>
                        <tr>
                            <th>{{ __('common.sl_no') }}</th>
                            <th>{{ __('sales.account') }}</th>
                            <th>{{ __('sales.expense_type') }}</th>
                            <th>{{ __('sales.amount') }}</th>
                            <th>{{ __('sales.payment_mode') }}</th>
                            <th style="width:15%;" class="text-center ">{{ __('common.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($content->app_transactions as $key => $transaction)
                            @if ($transaction->type == 'expense')
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $transaction->accounts->account_title ?? '' }}</td>
                                    <td>{{ $transaction->type }}</td>
                                    <td>{{ $transaction->amount }}</td>
                                   
                                <td  class=" ml-5">{{ $transaction->payment_method_id == 1 ? 'Online' : 'Offline' }}</td>


                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('sales.expenses.edit', $transaction->id) }}"
                                            class="btn btn-sm btn-white d-flex align-items-center mg-r-5"><i
                                                data-feather="edit-2"></i></a>

                                        <a href="#delete_modal" data-toggle="modal" id="delete_btn"
                                            class="btn btn-sm btn-white d-flex align-items-center mg-r-5"
                                            data-id="{{ $transaction->id }}"><i data-feather="trash"></i></a>

                                        {{-- 
                                 <button class="btn btn-sm btn-white d-flex align-items-center" id="delete_btn" data-target="#delete_modal" data-toggle="modal" value="{{$transaction->id}}"><i data-feather="trash"></i></button> --}}

                                        {{-- @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')  --}}
                                        {{-- <a href="{{ route('sales.expenses.edit', $transaction->id) }}" class="btn btn-sm btn-white table_btn py-1 px-2"><i data-feather="edit-2"></i></a> --}}
                                        {{-- @endif  --}}

                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="5">
                                    <h5 class="text-center mb-0 py-1">No Record Found !.</h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!--start delete modal-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel5">Delete Expense </h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>{{ __('common.delete_confirmation') }}</h6>
                    <input type="hidden" id="deleteExpenseId" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('common.no') }}
                    </button>
                    <button type="submit" class="btn btn-primary expenseDelBtn">{{ __('common.yes') }}</button>

                </div>
            </div>
        </div>
    </div>
    <!--end delete modal-->

    @push('scripts')
        <script>
            // $(document).on("click", "#delete_btn", function() {
            //     var expense_id = $(this).val();
            //     $('#deleteExpenseId').val(expense_id);
            // });
            // //delete modal confirmation data start here
            // $(document).on('click', '.expenseDelBtn', function() {
            //     var expense_id = $('#deleteExpenseId').val();
            //     console.log(expense_id);
            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            //     $.ajax({
            //         type: "POST",
            //         url: "{{ route('sales.deleteExpense') }}",
            //         data: {
            //             expense_id: expense_id,
            //         },
            //         dataType: "json",
            //         success: function(response) {
            //             Toaster('success', response.success);
            //             setTimeout(function() {
            //                 location.reload(true);
            //             }, 1000);
            //         }
            //     });
            // });







            //delete department ajax start here
            $(document).on("click", "#delete_btn", function() {
                var expense_id = $(this).data('id');
                console.log(expense_id);

                $('#deleteExpenseId').val(expense_id);
            });
            $(document).on('click', '.expenseDelBtn', function() {
                var expense_id = $('#deleteExpenseId').val();
                // console.log(expense_id);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('sales.deleteExpense') }}",
                    data: {
                        expense_id: expense_id
                    },
                    dataType: "json",
                    success: function(response) {

                        if (response.success) {
                            Toaster("success", response.success);

                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);
                            //  window.location.href =
                            //    "{{ route('hrm.department.index') }}";

                        } else {
                            Toaster("error", response.error);
                        }



                    }
                });

            });
        </script>
    @endpush

</x-app-layout>
