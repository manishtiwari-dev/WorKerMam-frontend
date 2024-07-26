@php
    
    $api_token = App\Helper\Helper::getCurrentuserToken();
    $userdata = Cache::get('userdata-' . $api_token);
    
@endphp

<x-app-layout>
    @section('title', 'Salary')
    <div class="contact-content">
        <div class="layout-specing">
            <div class="card contact-content-body">
                <form action="{{ route('hrm.salary.store') }}" id="userForm" method="POST" class="needs-validation"
                    novalidate>
                    @csrf
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
                                                <option value="{{$staff->staff_id}}">{{$staff->staff_name}}</option>
                                          @endforeach
                                          @endif
                                    </select>

                                    <div class="invalid-feedback">
                                          {{ __('hrm.employee_error') }}
                                    </div>
                              </div>
                              <div class="form-group col-md-6 col-lg-6">
                                    <label class="form-label">{{ __('hrm.month') }} <span
                                                class="text-danger mg-l-5">*</span></label>
                                    <select class="form-control select2" name="month" id="month" required>
                                          <option value="01">January</option>
                                          <option value="02">February</option>
                                          <option value="03">March</option>
                                          <option value="04">April</option>
                                          <option value="05">May</option>
                                          <option value="06">June</option>
                                          <option value="07">July</option>
                                          <option value="08">August</option>
                                          <option value="09">September</option>
                                          <option value="10">October</option>
                                          <option value="11">November</option>
                                          <option value="12">December</option>
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
                                          <option value="{{$i}}">{{$i}}</option>
                                          @endfor
                                    </select>

                                    <div class="invalid-feedback">
                                          {{ __('hrm.year_error') }}
                                    </div>
                              </div>

                              <div class="form-group col-md-6 col-lg-6">
                                    <label class="form-label">{{ __('hrm.amount') }} <span
                                                class="text-danger mg-l-5">*</span></label>
                                    <input name="amount" id="amount" type="text"
                                          class="form-control"
                                          placeholder="{{ __('hrm.amount_placeholder') }}" required>

                                    <div class="invalid-feedback">
                                          {{ __('hrm.amount_error') }}
                                    </div>
                              </div>

                              <div class="form-group col-md-6 col-lg-6">
                                    <label class="form-label">{{ __('hrm.payment_date') }} <span
                                                class="text-danger mg-l-5">*</span></label>
                                    <input name="payment_date" id="payment_date" type="text"
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
                                          <option value="1">Paid</option>
                                          <option value="0">Pending</option>
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
                    dateFormat: 'dd/mm/yy',
                    onSelect: function() {
                        var selected = $(this).datepicker("getDate");
                    }
                });

            });

        </script> 
    @endpush
</x-app-layout>
