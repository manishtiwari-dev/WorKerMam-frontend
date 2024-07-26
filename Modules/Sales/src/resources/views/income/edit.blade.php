<x-app-layout>
    @section('title', 'Update Expenses')
    <div class="">
        <div class="tab-content">
            <form action="{{ route('sales.income.update', $appTransaction->id) }}" method="post" class="needs-validation"
                novalidate>
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 ps-4">
                            <div class="row  border rounded py-3">
                                <div class="col-md-12">
                                    <div class="border-bottom">
                                        <h5>Update New Expense</h5>
                                    </div>
                                    <label for="file" class="form-label mt-3">{{ __('sales.attach_receipt') }}<span
                                            class="text-danger">*</span></label>
                                    @php
                                        $imageUrl = $appTransaction->attachment;
                                    @endphp
                                    <input type="file" class="form-control dropify" name="attachment"
                                        data-default-file="{{ $file_url }}{{ $imageUrl ?? '' }}">
                                    <div class="invalid-feedback">
                                        {{ __('sales.file_error') }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="date" class="form-label mt-3">{{ __('sales.expense_date') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" value="{{ \Carbon\Carbon::parse($appTransaction->trans_date )->format('d-m-Y') }}"  name="date"
                                        id="date" class="form-control datepicker" placeholder="Please Select Date"
                                        required />
                                    <div class="invalid-feedback">
                                        {{ __('sales.expense_error') }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="name" class="form-label mt-3">{{ __('sales.account') }}
                                        <span class="text-danger">*</span></label>
                                    <select name="account" id="account" class="form-control" required>
                                        <option selected disabled>{{ __('sales.select_account') }}</option>
                                        @if (!empty($accounts))
                                            @foreach ($accounts as $account)
                                                <option
                                                    {{ $appTransaction->account_id == $account->id ? 'selected' : '' }}
                                                    value="{{ $account->id }}">{{ $account->account_title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ __('sales.account_error') }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="name" class="form-label mt-3">{{ __('sales.expense_name') }}
                                        <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="{{ __('sales.expense_name_placeholder') }}"
                                        name="name" id="name" class="form-control" required />
                                    <div class="invalid-feedback">
                                        {{ __('sales.name_error') }}
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <label for="category"
                                        class="form-label mt-3">{{ __('sales.expense_category') }}<span
                                            class="text-danger">*</span></label>
                                    <select name="category" id="category" class="form-control select2" required>
                                        <option selected disabled>{{ __('sales.select_expense_category') }}</option>
                                        @if (!empty($crm_expense_category))
                                            @foreach ($crm_expense_category as $crm_expense)
                                                <option value="{{ $crm_expense->id }}">{{ $crm_expense->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ __('sales.category_error') }}
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <label for="amount" class="form-label mt-3">{{ __('sales.expense_amount') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="number" value="{{ $appTransaction->amount }}"
                                        placeholder="{{ __('sales.ammount_placeholder') }}" name="amount"
                                        id="amount" class="form-control" required />
                                    <div class="invalid-feedback">
                                        {{ __('sales.ammount_error') }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="customer" class="form-label mt-3">{{ __('sales.customer') }}<span
                                            class="text-danger">*</span></label>
                                    <select name="payer_payee_id" id="customer" class="form-control select2" required>
                                        <option selected disabled>{{ __('sales.select_customer') }}</option>
                                        @if (!empty($customers))
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->customer_id }}"   {{ $appTransaction->payer_payee_id == $customer->customer_id ? 'selected' : '' }}>
                                                    {{ $customer->first_name }} {{ $customer->last_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ __('sales.customer_error') }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="note"
                                        class="form-label mt-3">{{ __('sales.expense_note') }}</label>
                                    <textarea name="note" class="form-control">{{$appTransaction->note ?? ''}}</textarea>
                                    <div class="invalid-feedback">
                                        {{ __('sales.note_error') }}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--end row-->
                        <div class="col-lg-6 col-sm-12 ps-4">
                            <div class="border p-3 rounded">
                                <div class="border-bottom">
                                    <h5>Advance Option</h5>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="quotation_label"
                                            for="currency">{{ __('sales.currency') }}</label>
                                        <select class="form-control select2" name="currency" id="currency" required>
                                            <option selected disabled>{{ __('sales.select_currency') }}</option>
                                            @if (!empty($currency))
                                                @foreach ($currency as $ls_data)
                                                    <option value="{{ $ls_data }}">
                                                        {{ $ls_data }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="invalid-feedback">
                                            {{ __('sales.currency_error') }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="tax_group_id" for="currency"> {{ __('sales.tax') }}</label>
                                        <select class="form-control select2" name="tax_group_id" id="tax">
                                            <option selected value="">{{ __('sales.select_tax') }}</option>
                                            @if (!empty($TaxGroup))
                                                @foreach ($TaxGroup as $taxgrp_data)
                                                    <option value="{{ $taxgrp_data->tax_group_id }}">
                                                        {{ $taxgrp_data->tax_group_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>

                                        <div class="invalid-feedback">
                                            {{ __('sales.tax_error') }}
                                        </div>

                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="quotation_label" for="">Payment Method
                                        </label>
                                        <select class="form-control select2" name="payment_method_id" required>
                                            <option selected disabled>{{ __('sales.payment_method') }}</option>
                                            
                                            <option value="1" {{$appTransaction->payment_method_id == 1  ? 'selected' : '' }}> Online </option>
                                            <option value="2" {{($appTransaction->payment_method_id == 2  ? 'selected' : '') }}> Offline </option>
                                            





                                            {{-- @if (!empty($paymentMethodList))
                                            @foreach ($paymentMethodList as $paymentMethods)
                                            
                                                <option value="{{ $paymentMethods->payment_method_id }}" {{  $appTransaction->payment_method_id== $paymentMethods->payment_method_id ? 'selected' : '' }} >
                                                    {{ $paymentMethods->method_name }}
                                                </option>
                                            @endforeach
                                        @endif --}}
                                        </select>
                                        <div class="invalid-feedback">
                                            {{ __('sales.payment_mode') }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="quotation_label" for="">{{ __('sales.reference') }}
                                        </label>
                                        <input name="reference" value="{{ $appTransaction->reference }}"
                                            type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="recurring" for="recurring"> {{ __('sales.recurring') }}</label>
                                        <select class="form-control select2" name="recurring" id="recurring">
                                            <option selected value="">{{ __('sales.select_recurring') }}
                                            </option>
                                            <option value="1 month">Monthly</option>
                                            <option value="7 days"> Weekly</option>
                                            <option value="14 days"> Bi Weekly</option>
                                            <option value="1 day"> Everyday</option>
                                            <option value="30 days"> Every 30 Days</option>
                                            <option value="2 month"> Every 2 Month</option>
                                            <option value="3 month"> Quarterly</option>
                                            <option value="6 month"> Every 6 Month</option>
                                            <option value="1 year"> Yearly</option>
                                        </select>

                                        <div class="invalid-feedback">
                                            {{ __('sales.recurring_error') }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="no_of_rotaion" for="no_of_rotaion">
                                            {{ __('sales.no_of_rotaion') }}</label>
                                        <select class="form-control select2" name="no_of_rotaion" id="no_of_rotaion">
                                            <option selected value="">{{ __('sales.select_no_of_rotation') }}
                                            </option>
                                            @for ($i = 1; $i <= 100; $i++)
                                                <option value="{{ $i }}">{{ $i }}
                                                </option>
                                            @endfor
                                        </select>

                                        <div class="invalid-feedback">
                                            {{ __('sales.no_of_rotaion_error') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4 col-lg-4 col-6 mx-sm-auto ml-md-0">
                            <input type="submit" id="submit" name="send" class="btn btn-primary"
                                value="Submit">
                            <a href="{{ route('sales.income.index') }}" class="btn btn-secondary mx-1">Cancel</a>
                        </div>
                    </div>
                    <!--end row-->
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
                });

            });
        </script>
    @endpush
</x-app-layout>
