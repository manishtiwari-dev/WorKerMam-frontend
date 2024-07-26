<x-app-layout>
    @section('title', 'Salary')
        {{-- @dd($pageAccess) --}}

    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
        <div class="card contact-content-body">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="tx-15 mg-b-0">{{ __('hrm.salary_list') }}</h6> 
                    <div>
                        <a href="#GenerateSalary" data-bs-toggle="modal" class="btn btn-sm btn-bg btn-primary"><i
                            data-feather="plus"></i>{{ __('hrm.generate_salary') }}</a> 
                        <a class="btn btn-sm btn-bg  btn-primary" onclick="exportSalary()"><i data-feather="plus"></i> {{ __('hrm.export') }}</a>   
                    </div> 
                </div>
            </div> 
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group  col-md-4">
                        <select class="form-control select2" id="user_id" name="user_id">
                            <option value="all">All</option>
                            @if (!empty($content->user_data))
                                @foreach ($content->user_data as $key => $user_list)
                                    <option value="{{ $user_list->staff_id }}">{{ $user_list->staff_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <select class="form-control select2" id="month" name="month">
                            <option value="all">All Month</option>
                            <option @if ($content->month == '01') selected @endif value="1">January</option>
                            <option @if ($content->month == '02') selected @endif value="2">February</option>
                            <option @if ($content->month == '03') selected @endif value="3">March</option>
                            <option @if ($content->month == '04') selected @endif value="4">April</option>
                            <option @if ($content->month == '05') selected @endif value="5">May</option>
                            <option @if ($content->month == '06') selected @endif value="6">June</option>
                            <option @if ($content->month == '07') selected @endif value="7">July</option>
                            <option @if ($content->month == '08') selected @endif value="8">August</option>
                            <option @if ($content->month == '09') selected @endif value="9">September</option>
                            <option @if ($content->month == '10') selected @endif value="10">October</option>
                            <option @if ($content->month == '11') selected @endif value="11">November</option>
                            <option @if ($content->month == '12') selected @endif value="12">December</option>
    
                        </select>
                    </div>
                    <div class="form-group   col-md-4">
                        <select class="form-control select2" name="year" id="year">
                            <option value="all">All Year</option>
                            @for($i=2020; $i<=2040; $i++)
                                <option @if ($i == $content->year) selected @endif value="{{ $i }}">
                                    {{ $i }}</option>
                            @endfor
                        </select>
                    </div> 
                </div>
                <div class="table-responsive" id="salaryTable">
                    <table class="table  table_wrapper">
                        <thead>
                            <tr>
                                <th>{{ __('common.sl_no') }}</th>
                                <th>{{ __('hrm.employee') }}</th>
                                <th>{{ __('hrm.base_salary') }}</th>
                                <th>{{ __('hrm.total_days') }}</th>
                                <th>{{ __('hrm.total_leave') }}</th>
                                <th>{{ __('hrm.paid_leave') }}</th>
                                <th>{{ __('hrm.paid_days') }}</th> 
                                <th>{{ __('hrm.net_salary') }}</th>  
                                <th>{{ __('hrm.payment_status') }}</th>  
                                <th>{{ __('common.action') }}</th>  
                            </tr>
                        </thead>

                        <tbody>
                              @forelse($content->salarylist as $key=>$salary) 
                              <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$salary->staff->staff_name ?? ''}}</td>
                                    <td>{{$salary->remuneration->remuneration_value ?? ''}}</td>
                                    <td>{{$salary->total_days}}</td>
                                    <td>{{$salary->total_leave}}</td>
                                    <td>{{$salary->paid_leave}}</td>
                                    <td>{{$salary->paid_days}}</td>
                                    <td>{{$salary->salary_amount}}</td> 
                                    <td>  
                                        <select class="form-control" name="status" id="statusChange" data-id="{{ $salary->id }}">
                                            <option value="1" {{ ($salary->payment_status == 1)? 'selected':'' }}>Paid</option>
                                            <option value="0" {{ ($salary->payment_status == 0)? 'selected':'' }}>Pending</option>
                                        </select>
                                    </td> 
                                    <td>
                                        <a href="{{ route('hrm.salary.edit', $salary->id) }}"   
                                            class="btn btn-sm px-0"><i
                                                data-feather="edit-2"></i><span
                                                class="d-none d-sm-inline mg-l-5"></span></a>
                                    </td>
                              </tr>
                              @empty
                              <tr>
                                    <td colspan="8" class="text-center">No Record Found !</td>
                              </tr>
                              @endforelse
                              <tr> 
                                     
                              </tr> 
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    @endif


    <!-- Start Add Department Modal --> 
    <div class="modal fade" id="GenerateSalary" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('hrm.generate_salary') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('hrm.salary-generate-page') }}" id="userForm" method="POST" class="needs-validation"
                    novalidate>
                    @csrf  
                    <div data-label="Example" class="df-example demo-forms">
                        <div class="form-row row">
                        @php
                            $currentmonth = date('m'); 
                        @endphp
                            <div class="form-group col-md-6 col-lg-6">
                                <label class="form-label">{{ __('hrm.month') }} <span
                                            class="text-danger mg-l-5">*</span></label>
                                <select class="form-control" name="month" id="" required> 
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
                                
                                <select class="form-control" name="year" id="" required>
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
                        </div>
                    </div> 
                </form>
                </div>
            </div>
        </div>
    </div>
<!-- End Add Department Modal -->

    @push('scripts')
        <script>
            $(document).ready(function() {

                $('#user_id,#month,#year').on('change', function(e, data) {

                    if ($('#user_id').val() != "all") {

                        ajaxSubsmisstionData();
                    } else if ($('#month').val() != "all") {

                        ajaxSubsmisstionData();
                    } else if ($('#year').val() != "all") {

                        ajaxSubsmisstionData();
                    } else {

                        ajaxSubsmisstionData();
                    }

                });
            });


            function ajaxSubsmisstionData() {
                var user_id = $('#user_id').val();
                var month = $('#month').val();
                var year = $('#year').val();
                $("#attendence_listing").html('');
                tableWebContent(user_id, month, year);
            }

            function tableWebContent(user_id, month, year) {

            const url = "{{ route('hrm.salary-record') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    user_id: user_id,
                    month: month,
                    year: year,
                },
                dataType: "json",
                success: function(result) {
                    console.log(result);
                    var html = `
                    <table class="table  table_wrapper">
                    <thead>
                        <tr>
                            <th>{{ __('common.sl_no') }}</th>
                            <th>{{ __('hrm.employee') }}</th>  
                            <th>{{ __('hrm.base_salary') }}</th> 
                            <th>{{ __('hrm.total_days') }}</th>
                            <th>{{ __('hrm.total_leave') }}</th>
                            <th>{{ __('hrm.paid_leave') }}</th>
                            <th>{{ __('hrm.paid_days') }}</th> 
                            <th>{{ __('hrm.net_salary') }}</th>  
                            <th>{{ __('hrm.payment_status') }}</th>  
                        </tr>
                    </thead>

                    <tbody>`; 
                        $.each(result.salarylist, function(key, salary){
                            console.log(salary);
                            var staffsalary = salary.remuneration ? salary.remuneration.remuneration_value : '';
                            html += `<tr>
                                <td>${key+1}</td>
                                <td>${salary.staff.staff_name ?? ''}</td>
                                <td>${staffsalary}</td>
                                <td>${salary.total_days}</td>
                                <td>${salary.total_leave}</td>
                                <td>${salary.paid_leave}</td>
                                <td>${salary.paid_days}</td>
                                <td>${salary.salary_amount}</td> 
                                <td>  
                                    <select class="form-control" name="status" id="statusChange" data-id="${salary.id }}">
                                        <option value="1" ${ (salary.payment_status == 1)? 'selected':'' }>Paid</option>
                                        <option value="0" ${ (salary.payment_status == 0)? 'selected':'' }>Pending</option>
                                    </select>`;
                                html += `</td>
                                
                            </tr>`;
                            
                        });
                            html += `<tr> 
                                    
                            </tr> 
                    </tbody>
                </table>
                    `;
                    $("#salaryTable").html(html);
                }
            });
            }
        </script>
        <script>
            
            $(document).on('change','#statusChange',function(e){
                e.preventDefault();
                let id = $(this).data('id');
                let status = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('hrm.change-status') }}",
                    data: {
                        salary_id: id,
                        status : status
                    },
                    success: function (data) {
                        Toaster('success',data.message);
                    }
                });
        });
        </script>

        <script>
            function exportSalary() {

                var user_id = $("#user_id").val();
                var month = $("#month").val();
                var year = $('#year').val(); 
 



                var url =
                    '{{ route('hrm.export-salary', [':user_id', ':month', ':year']) }}';
                url = url.replace(':user_id', user_id);
                url = url.replace(':month', month);
                url = url.replace(':year', year); 

                

                window.location.href = url;
            }
        </script>
    @endpush
</x-app-layout>
