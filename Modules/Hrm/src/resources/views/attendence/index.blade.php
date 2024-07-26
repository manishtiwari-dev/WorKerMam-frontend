@php

    $api_token = App\Helper\Helper::getCurrentuserToken();
    $userdata = Cache::get('userdata-' . $api_token);
@endphp
{{-- @dd($data_list) --}}
<x-app-layout>
    @section('title', $pageTitle)
    <style>
        #attendence_listing th,
        #attendence_listing td {
            white-space: nowrap;
        }
    </style>

    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
        <div class="card contact-content-body">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="tx-15 mg-b-0">{{ __('hrm.attendence_list') }}</h6>
                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                        <div>
                            <a href="{{ route('hrm.attendance-create') }}" class="btn btn-sm btn-bg btn-primary"><i
                                    data-feather="plus"></i>{{ __('hrm.mark_attendence') }}</a>
                            <a class="btn btn-sm btn-bg  btn-primary" onclick="exportAttendance()"><i
                                    data-feather="plus"></i> {{ __('hrm.export') }}</a>
                        </div>
                    @endif
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
                            <option value="all">Select Month</option>
                            <option @if ($content->month == '01') selected @endif value="1">January</option>
                            <option @if ($content->month == '02') selected @endif value="2">Feb</option>
                            <option @if ($content->month == '03') selected @endif value="3">Mar</option>
                            <option @if ($content->month == '04') selected @endif value="4">Apr</option>
                            <option @if ($content->month == '05') selected @endif value="5">May</option>
                            <option @if ($content->month == '06') selected @endif value="6">June</option>
                            <option @if ($content->month == '07') selected @endif value="7">July</option>
                            <option @if ($content->month == '08') selected @endif value="8">Aug</option>
                            <option @if ($content->month == '09') selected @endif value="9">Sept</option>
                            <option @if ($content->month == '10') selected @endif value="10">Oct</option>
                            <option @if ($content->month == '11') selected @endif value="11">Nov</option>
                            <option @if ($content->month == '12') selected @endif value="12">Dec</option>

                        </select>
                    </div>
                    <div class="form-group   col-md-4">
                        <select class="form-control select2" name="year" id="year">
                            <option value="all">Select Year</option>
                            @for ($i = $content->year; $i >= $content->year - 4; $i--)
                                <option @if ($i == $content->year) selected @endif value="{{ $i }}">
                                    {{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table  table_wrapper" id="attendence_listing">
                        <thead>
                            @php
                                $date = 0;
                            @endphp

                            <tr>
                                <th>{{ __('hrm.employee_name') }}</th>
                                @for ($date = 1; $date <= $content->days; $date++)
                                    <th>{{ $date }}</th>
                                @endfor

                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($content->employeeAttendence))
                                @foreach ($content->employeeAttendence as $key => $values)
                                    @php
                                        $input = explode('#', $key);

                                    @endphp

                                    <tr>
                                        <td>{{ $input[1] }}</td>

                                        @foreach ($values as $date => $status)
                                            <td>
                                                @if ($status == 'Present')
                                                    <a href="javascript:void(0);" id="PresentAttend"
                                                        data-id="{{ $input[0] }}" data-date="{{ $date }}"
                                                        class="PresentModal">
                                                        <i class="fa fa-check text-primary" aria-hidden="true"></i>
                                                    </a>
                                                @elseif($status == 'Absent')
                                                    {{-- <a href="#attendance" data-bs-toggle="modal" id="AbsentAttend" data-id="{{ $input[0] }}" data-date="{{ $date }}"><i class="fa fa-times text-muted" aria-hidden="true"></i></a> --}}
                                                    <i class="fa fa-times text-muted" aria-hidden="true"></i>
                                                @elseif($status == 'Leave')
                                                    <i class="fa fa-leaf text-warning" aria-hidden="true"></i>
                                                @elseif($status == 'Holiday')
                                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                @else
                                                    {{ $status }}
                                                @endif
                                            </td>
                                        @endforeach

                                    </tr>

                                    <tr>

                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <!--------------Add Result Modal --------------->
    <div class="modal fade" id="attendance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Attendance Details</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="" id="tablelist">
                        <form action="{{ route('hrm.attendUpdate') }}" method="POST" class="needs-validation"
                            novalidate>
                            @csrf
                            <h6 id="markDate" class="mb-3"></h6>
                            <div class="form-row">
                                <input name="attend_id" id="attend_id" type="hidden" class="form-control">
                                <input name="req_month" id="req_month" type="hidden" class="form-control"
                                    value="{{ $content->req_month }}">
                                <input name="req_year" id="req_year" type="hidden" class="form-control"
                                    value="{{ $content->req_year }}">
                                <input name="mart_attend_date" id="mart_attend_date" type="hidden"
                                    class="form-control">

                                <div class="form-group col-lg-4">
                                    <label class="form-label">{{ __('hrm.clock_in') }}<span
                                            class="text-danger">*</span></label>
                                    <input name="clock_in" id="clock_in" type="text" class="form-control"
                                        placeholder="{{ __('hrm.clock_in_placeholder') }}" required>

                                    <div class="invalid-feedback">
                                        {{ __('hrm.clock_in_error') }}
                                    </div>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label class="form-label">{{ __('hrm.clock_out') }}<span
                                            class="text-danger">*</span></label>
                                    <input name="clock_out" id="clock_out" type="text" class="form-control"
                                        placeholder="{{ __('hrm.clock_out_placeholder') }}" required>

                                    <div class="invalid-feedback">
                                        {{ __('hrm.clock_out_error') }}
                                    </div>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label class="form-label">{{ __('hrm.clock_in_ip') }} </label>
                                    <input name="clock_in_ip" id="clock_in_ip" type="text" class="form-control"
                                        placeholder="{{ __('hrm.clock_in_ip_placeholder') }}">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label class="form-label">{{ __('hrm.clock_out_ip') }} </label>
                                    <input name="clock_out_ip" id="clock_out_ip" type="text" class="form-control"
                                        placeholder="{{ __('hrm.clock_out_ip_placeholder') }}">

                                </div>

                                <div class="form-group col-lg-4">
                                    <label class="form-label">{{ __('hrm.working_from') }} </label>
                                    <select class="form-control" name="working_from" id="working_from_value"
                                        required>
                                        <option value="" selected disabled>Select Work From</option>
                                        <option value="office">Office</option>
                                        <option value="home">Home</option>
                                        <option value="onsite">Onsite</option>
                                        <option value="offsite">Offsite</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label class="form-label">{{ __('hrm.status') }}</label>
                                    <select class="form-control" name="present_status" id="present_status" required>
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="present">Present</option>
                                        <option value="absent">Absent</option>
                                    </select>
                                </div>

                                <input type="hidden" id="lateInput" name="lateInput" value="no">
                                <input type="hidden" id="half_day_input" name="half_day_input" value="no">

                                <div class="form-group col-lg-4">
                                    <label class="form-label">{{ __('hrm.late') }} </label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input toggle-late"
                                            name="late" data-id=" " id="late" value="">
                                        <label class="custom-control-label" for="late"></label>
                                    </div>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label class="form-label">{{ __('hrm.half_day') }} </label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="half_day"
                                            class="custom-control-input half_day_toggle" data-id=""
                                            id="half_day">
                                        <label class="custom-control-label" for="half_day"></label>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" id="update_btn" class="btn btn-primary"
                                value="{{ __('common.update') }}">
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
    @push('scripts')
        <!-- Include Bootstrap DateTimePicker CDN -->

        <!-- Bootstrap Timepicker -->

        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.PresentModal').click(function() {
                    $("#attendance").modal("show");
                    $('#clock_in').timepicker({
                        showMeridian: false,
                        defaultTime: false
                    });
                    $('#clock_out').timepicker({
                        showMeridian: false,
                        defaultTime: false
                    });
                });
            });


            $(document).ready(function() {
                $('.half_day_toggle').change(function() {
                    var lateCheckbox = $(this);
                    var lateInput = $('#half_day_input');

                    if (lateCheckbox.is(':checked')) {
                        lateInput.val('yes');
                    } else {
                        lateInput.val('no');
                    }
                });
            });

            $(document).ready(function() {
                $('.toggle-late').change(function() {
                    var lateCheckbox = $(this);
                    var lateInput = $('#lateInput');

                    if (lateCheckbox.is(':checked')) {
                        lateInput.val('yes');
                    } else {
                        lateInput.val('no');
                    }
                });
            });


            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict'
                var forms = document.querySelectorAll('.needs-validation')
                // Loop over them and prevent submission
                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
            })()

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

                const url = "{{ route('hrm.attendance-data') }}";
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
                        $("#req_month").val(result.req_month);
                        $("#req_year").val(result.req_year);
                        var html = `
                                <table class="table table-center bg-white mb-0">
                                <thead>
                                <th class="wd-15p" style="">Employee Name</th>`;

                        for (let i = 1; i <= result.daysInMonth; i++) {


                            html += ` <th>${ i }</th>`;

                        };
                        html += `</thead>`;

                        $.each(result.employeeAttendence, function(key, values) {
                            var result = key.split('#');

                            html += `<tr>
                                        <td>${ result[1] }</td> `;

                            $.each(values, function(date, status) {

                                html += `<td>
${(status == 'Present') ? `<a href='#attendance' data-bs-toggle='modal' id='PresentAttend' data-id='${result[0]}' data-date='${date}'><i class='fa fa-check text-primary' aria-hidden='true'></i></a>` : (status == 'Absent') ? '<i class="fa fa-times text-muted" aria-hidden="true"></i>' : (status == 'Leave') ? '<i class="fa fa-leaf text-warning" aria-hidden="true"></i>' : (status == 'Holiday') ? '<i class="fa fa-star text-warning" aria-hidden="true"></i>' : status}
</td>`;

                            });
                            html += `</tr>`;
                        });
                        html += `</table>
                        </div>`;
                        $("#attendence_listing").html(html);
                    }
                });

            }
        </script>
        <script>
            function exportAttendance() {

                var staff = $("#user_id").val();
                var month = $("#month").val();
                var year = $('#year').val();




                var url =
                    '{{ route('hrm.export-attendance', [':staff', ':month', ':year']) }}';
                url = url.replace(':staff', staff);
                url = url.replace(':month', month);
                url = url.replace(':year', year);



                window.location.href = url;
            }
        </script>

        <script>
            $(document).on("click", "#AbsentAttend", function(e) {
                e.preventDefault();

                var staff_id = $(this).data("id");
                var dateVal = $(this).data("date");
                var req_month = $("#req_month").val();
                var req_year = $("#req_year").val();

                var data = {
                    staff_id: staff_id,
                    date: dateVal,
                    req_month: req_month,
                    req_year: req_year
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('hrm.attendDetails') }}",
                    type: "POST",
                    data: data,
                    success: function(response) {

                        var dateAttribute = req_year + "-" + req_month + "-" + dateVal;
                        var date = "Date - " + dateAttribute;

                        $("#mart_attend_date").val(dateAttribute);
                        $("#markDate").text(date);
                    },


                });
            });
            $(document).on("click", "#PresentAttend", function(e) {
                e.preventDefault();


                var staff_id = $(this).data("id");
                var date = $(this).data("date");
                var req_month = $("#req_month").val();
                var req_year = $("#req_year").val();

                var data = {
                    staff_id: staff_id,
                    date: date,
                    req_month: req_month,
                    req_year: req_year
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('hrm.attendDetails') }}",
                    type: "POST",
                    data: data,
                    success: function(response) {
                        var record = response.data.attendance;
                        console.log(record.working_from);
                        var date = new Date(record.clock_in_time);
                        var formattedDate = date.toLocaleDateString('en-CA');
                        var date = "Date - " + formattedDate;

                        var dateTime = new Date(record.clock_in_time);
                        var clock_in_time = dateTime.toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        });

                        var dateTime = new Date(record.clock_out_time);
                        var clock_out_time = dateTime.toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        });



                        $("#mart_attend_date").val(formattedDate);
                        $("#markDate").text(date);
                        $("#clock_in").val(clock_in_time);
                        $("#clock_in_ip").val(record.clock_in_ip);
                        $("#clock_out").val(clock_out_time);
                        $("#clock_out_ip").val(record.clock_out_ip);
                        $("#working_from_value").val(record.working_from);
                        $("#present_status").val(record.status);
                        $("#attend_id").val(record.id);
                        if (record.late == "yes") {
                            $('.toggle-late').prop('checked', true);
                        }
                        if (record.half_day == "yes") {
                            $('.half_day_toggle').prop('checked', true);
                        }
                    },


                });
            });

            // $('body').on('click', '.delete-department', function() {
            //     var id = $("#eventsid").val();
            //     swal({
            //             title: `Are you sure you want to delete this record?`,
            //             text: "If you delete this, it will be gone forever.",
            //             icon: "warning",
            //             buttons: true,
            //             dangerMode: true,
            //         })
            //         .then((isConfirm) => {
            //             if (isConfirm) {

            //                 var url = "{{ route('hrm.holiday.destroy', ':id') }}";
            //                 url = url.replace(':id', id);

            //                 var token = "{{ csrf_token() }}";

            //                 $.ajax({
            //                     type: 'POST',
            //                     url: url,
            //                     data: {
            //                         '_token': token,
            //                         '_method': 'DELETE'
            //                     },
            //                     success: function(response) {
            //                          Toaster('success' , response);
            //                         setTimeout(function() {
            //                             location.reload(true);
            //                         }, 2000);

            //                     }
            //                 });
            //             }
            //         });
            // });
        </script>
    @endpush
</x-app-layout>
