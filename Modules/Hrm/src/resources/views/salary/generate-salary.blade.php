@php
    
    $api_token = App\Helper\Helper::getCurrentuserToken();
    $userdata = Cache::get('userdata-' . $api_token);
    
@endphp

<x-app-layout>
    @section('title', 'Salary')
    <div class="contact-content">
        <div class="layout-specing">
            <div class="card contact-content-body">
                <form action="{{ route('hrm.salary-generate-page') }}" id="userForm" method="POST" class="needs-validation"
                    novalidate>
                    @csrf
                    <div class="card-header d-flex align-items-center justify-content-between py-3  px-3">
                        <h6 class="tx-15 mb-0">{{ __('hrm.generate_salary') }}</h6>
                    </div>
                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <div class="form-row row">
                            @php
                                $currentmonth = date('m'); 
                            @endphp
                              <div class="form-group col-md-6 col-lg-6">
                                    <label class="form-label">{{ __('hrm.month') }} <span
                                                class="text-danger mg-l-5">*</span></label>
                                    <select class="form-control" name="month" id="month" required>
                                            <option value="">Select month</option>
                                            <option value="" selected disabled>Select Month</option>
                                            <option value="01" {{($currentmonth == '01')?'selected':''}} >Jaunary</option>
                                            <option value="02" {{($currentmonth == '02')?'selected':''}}>February</option>
                                            <option value="03" {{($currentmonth == '03')?'selected':''}}>March</option>
                                            <option value="04" {{($currentmonth == '04')?'selected':''}}>April</option>
                                            <option value="05" {{($currentmonth == '05')?'selected':''}}>May</option>
                                            <option value="06" {{($currentmonth == '06')?'selected':''}}>June</option>
                                            <option value="07" {{($currentmonth == '07')?'selected':''}}>July</option>
                                            <option value="08" {{($currentmonth == '08')?'selected':''}}>August</option>
                                            <option value="09" {{($currentmonth == '09')?'selected':''}}>September</option>
                                            <option value="10" {{($currentmonth == '10')?'selected':''}}>October</option>
                                            <option value="11" {{($currentmonth == '11')?'selected':''}}>November</option>
                                            <option value="12" {{($currentmonth == '12')?'selected':''}}>December</option>
                                    </select>

                                    <div class="invalid-feedback">
                                          {{ __('hrm.month_error') }}
                                    </div>
                              </div>
                            @php
                                $currentYear = date('Y');
                            @endphp
                              <div class="form-group col-md-6 col-lg-6">
                                    <label class="form-label">{{ __('hrm.year') }} <span
                                                class="text-danger mg-l-5">*</span></label>
                                    
                                    <select class="form-control" name="year" id="year" required>
                                        <option value="">Select Year</option>
                                          @for($i=2020; $i<=2040; $i++)
                                          <option value="{{$i}}"  {{($i==$currentYear)?'selected':''}}>{{$i}}</option>
                                          @endfor
                                    </select>

                                    <div class="invalid-feedback">
                                          {{ __('hrm.year_error') }}
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
