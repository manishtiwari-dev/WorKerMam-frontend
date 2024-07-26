@php
    
    $api_token = App\Helper\Helper::getCurrentuserToken();
    $userdata = Cache::get('userdata-' . $api_token);
    
@endphp

<x-app-layout>
    @section('title', 'Salary') 
    <div class="contact-content">
        <div class="layout-specing">
            <div class="card contact-content-body">
            <form action="{{ route('hrm.salary.update', $salary->id) }}" method="post" class="needs-validation"
                novalidate>
                @csrf
                @method('PUT')
                    <div class="card-header d-flex align-items-center justify-content-between py-3  px-3">
                        <h6 class="tx-15 mb-0">{{ __('hrm.add_salary') }}</h6>
                    </div>
                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <div class="form-row row">
                                <div class="form-group col-md-6 col-lg-6">
                                    <label class="form-label">{{ __('hrm.employee') }} <span
                                                class="text-danger mg-l-5">*</span></label>
                                    <select class="form-control" name="employee" id="employee" required>
                                            <option value="" selected disabled>{{ __('hrm.employee_placeholder') }}</option>
                                            @if(!empty($stafflist))
                                            @foreach($stafflist as $staff)
                                                <option value="{{$staff->staff_id}}" {{($salary->staff_id == $staff->staff_id)?'selected':''}}>{{$staff->staff_name}}</option>
                                            @endforeach
                                            @endif
                                    </select>

                                    <div class="invalid-feedback">
                                            {{ __('hrm.employee_error') }}
                                    </div>
                                </div>
 

                                <div class="form-group col-md-6 col-lg-6">
                                    <label class="form-label">{{ __('hrm.total_days') }} <span
                                                class="text-danger mg-l-5">*</span></label>
                                    <input name="total_days"  id="total_days" value="{{ $salary->total_days }}" type="number"
                                        class="form-control"
                                        placeholder="{{ __('hrm.total_days_placeholder') }}" required>

                                    <div class="invalid-feedback">
                                        {{ __('hrm.total_days_error') }}
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-lg-6">
                                    <label class="form-label">{{ __('hrm.total_leave') }} <span
                                                class="text-danger mg-l-5">*</span></label>
                                    <input name="total_leave"  id="total_leave" value="{{ $salary->total_leave }}" type="number"
                                        class="form-control"
                                        placeholder="{{ __('hrm.total_leave_placeholder') }}" required>

                                    <div class="invalid-feedback">
                                        {{ __('hrm.total_leave_error') }}
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-lg-6">
                                    <label class="form-label">{{ __('hrm.paid_leave') }} <span
                                                class="text-danger mg-l-5">*</span></label>
                                    <input name="paid_leave"  id="paid_leave" value="{{ $salary->paid_leave }}" type="number"
                                        class="form-control"
                                        placeholder="{{ __('hrm.paid_leave_placeholder') }}" required>

                                    <div class="invalid-feedback">
                                        {{ __('hrm.paid_leave_error') }}
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-lg-6">
                                    <label class="form-label">{{ __('hrm.paid_days') }} <span
                                                class="text-danger mg-l-5">*</span></label>
                                    <input name="paid_days"  id="paid_days" value="{{ $salary->paid_days }}" type="number"
                                        class="form-control"
                                        placeholder="{{ __('hrm.paid_days_placeholder') }}" required>

                                    <div class="invalid-feedback">
                                        {{ __('hrm.paid_days_error') }}
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-lg-6">
                                    <label class="form-label">{{ __('hrm.net_salary') }} <span
                                                class="text-danger mg-l-5">*</span></label>
                                    <input name="net_salary" id="net_salary" type="number"
                                        class="form-control"
                                        placeholder="{{ __('hrm.net_salary_placeholder') }}" value="{{$salary->salary_amount}}" required>

                                    <div class="invalid-feedback">
                                        {{ __('hrm.net_salary_error') }}
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-lg-6">
                                        <label class="form-label">{{ __('hrm.month') }} <span
                                                    class="text-danger mg-l-5">*</span></label>
                                        <select class="form-control" name="month" id="month" required>
                                            <option value="01" {{($salary->salary_month == '01')?'selected':''}}>January</option>
                                            <option value="02" {{($salary->salary_month == '02')?'selected':''}}>February</option>
                                            <option value="03" {{($salary->salary_month == '03')?'selected':''}}>March</option>
                                            <option value="04" {{($salary->salary_month == '04')?'selected':''}}>April</option>
                                            <option value="05" {{($salary->salary_month == '05')?'selected':''}}>May</option>
                                            <option value="06" {{($salary->salary_month == '06')?'selected':''}}>June</option>
                                            <option value="07" {{($salary->salary_month == '07')?'selected':''}}>July</option>
                                            <option value="08" {{($salary->salary_month == '08')?'selected':''}}>August</option>
                                            <option value="09" {{($salary->salary_month == '09')?'selected':''}}>September</option>
                                            <option value="10" {{($salary->salary_month == '10')?'selected':''}}>October</option>
                                            <option value="11" {{($salary->salary_month == '11')?'selected':''}}>November</option>
                                            <option value="12" {{($salary->salary_month == '12')?'selected':''}}>December</option>
                                        </select>

                                        <div class="invalid-feedback">
                                            {{ __('hrm.month_error') }}
                                        </div>
                                </div>

                                <div class="form-group col-md-6 col-lg-6">
                                        <label class="form-label">{{ __('hrm.year') }} <span
                                                    class="text-danger mg-l-5">*</span></label>
                                        
                                        <select class="form-control" name="year" id="year" required>
                                            @for($i=2020; $i<=2040; $i++)
                                            <option value="{{$i}}" {{($salary->salary_year == $i)?'selected':''}}>{{$i}}</option>
                                            @endfor
                                        </select>

                                        <div class="invalid-feedback">
                                            {{ __('hrm.year_error') }}
                                        </div>
                                </div>

                                

                                <div class="form-group col-md-6 col-lg-6">
                                        <label class="form-label">{{ __('hrm.payment_date') }} <span
                                                    class="text-danger mg-l-5">*</span></label>
                                        <input name="payment_date" value="{{ \Carbon\Carbon::parse($salary->payment_date)->format('d/m/Y') }}
                                        " id="payment_date" type="text"
                                            class="form-control datepicker1"
                                            placeholder="{{ __('hrm.payment_date_placeholder') }}" required>

                                        <div class="invalid-feedback">
                                            {{ __('hrm.payment_date_error') }}
                                        </div>
                                </div>

                                <div class="form-group col-md-6 col-lg-6">
                                        <label class="form-label">{{ __('hrm.payment_status') }} <span
                                                    class="text-danger mg-l-5">*</span></label>
                                        <select name="payment_status" class="form-control" id="payment_status" required>
                                            <option value="1" {{($salary->payment_status == 1)?'selected':''}}>Paid</option>
                                            <option value="0" {{($salary->payment_status == 0)?'selected':''}}>Pending</option>
                                        </select>

                                        <div class="invalid-feedback">
                                            {{ __('hrm.payment_status_error') }}
                                        </div>
                                </div>

                            </div>
                        </div>
                        <div class="">
                            <div class="col-sm-12 mb-3 mx-3 p-0">
                                <input type="submit" id="submit" name="send" class="btn btn-primary" value="Submit">
                                <a href="{{ route('hrm.salary.index') }}" class="btn btn-secondary mx-1">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script> 
            $(function() {
                $('.datepicker1').datepicker({
                    multidate: true,
                    format: 'dd/mm/yy' ,
                    onSelect: function() {
                        var selected = $(this).datepicker("getDate");
                    }
                });

            });
        </script> 
    @endpush
</x-app-layout>
