@php
    
    $api_token = App\Helper\Helper::getCurrentuserToken();
    $userdata = Cache::get('userdata-' . $api_token);
@endphp

<x-app-layout>
    @section('title', $pageTitle)

    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
        <div class="card contact-content-body">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="tx-15 mg-b-0">{{ __('hrm.leave_apply_list') }}</h6>
                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                        <a href="{{ route('hrm.leave-create') }}" class="btn btn-sm btn-bg  btn-primary"><i
                                data-feather="plus"></i>{{ __('hrm.apply_for_leave') }}</a>
                    @elseif (!empty($userdata->userType == 'subscriber'))
                        <a href="{{ route('hrm.leave-create') }}" class="btn btn-sm btn-bg btn-primary"><i
                                data-feather="plus"></i>{{ __('hrm.assign_for_leave') }}</a>
                    @else
                    @endif
                </div>
            </div>
            <div class="card-header"> 
                    <form class="form-inline justify-content-lg-end d-flex"> 
                            <div class="form-group mb-0 me-1">
                                <select class="form-control" id="statusMultiple" name="statusMultiple" >
                                    <option value="selectStatus">Select Leave Status</option>
                                    <option value="approved">Approved</option>
                                    <option value="pending" >Pending</option>
                                    <option value="rejected" >Rejected</option> 
                                </select>
                            </div> 

                        <button type="button" id="changeMultipleStatus" class="btn btn-primary">
                            @lang('app.apply')</button>

                    </form> 
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
                <div class="table-responsive" id="leaveList">
                    <table class="table  table_wrapper">
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="status" id="CheckCheckbox" class="float-right"></th>
                                @if($content->role != '')<th>{{ __('hrm.employee_name') }}</th>@endif
                                <th>{{ __('hrm.from_date') }}</th>

                                <th>{{ __('hrm.leave_type') }}</th>
                                <th>{{ __('hrm.leave_status') }}</th>
                                <th>{{ __('hrm.leave_pay') }}</th>

                                <th class="wd-10p text-center">{{ __('common.action') }}</th>
                            </tr>
                        </thead>

                        <tbody> 
                            @forelse($content->leave_list as $key => $leave)
                                <tr> 
                                    <td> <input type="checkbox" name="status" id="statusChange" class="statusChange float-right" value="{{ $leave->id }}"></td>
                                    @if($content->role != '')<td>{{ $leave->staff->staff_name ?? ''}}</td>@endif
                                    <td>{{ $leave->leave_date }}</td>

                                    <td>
                                        @if (!empty($leave->leave_type))
                                            {{ $leave->leave_type->leave_type_name ?? ''}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($leave->status == 'approved')
                                        <span class="badge text-bg-success">Approved</span>
                                        @elseif($leave->status == 'rejected')
                                        <span class="badge text-bg-danger">Rejected</span>
                                        @else
                                        <span class="badge text-bg-warning">Pending</span>
                                        @endif 
                                         
                                    </td>
                                    <td>
                                        <select class="form-control" id="leave_pay" name="leave_pay" data-id="{{ $leave->id }}">
                                            <option value="1" {{ ($leave->paid == '1')?'selected':'' }}>Paid</option>
                                            <option value="0" {{ ($leave->paid == '0')?'selected':'' }}>UnPaid</option>
                                        </select>
                                    </td>
                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                    <td class="align-items-center justify-content-center d-flex gap-2">
                                            <a href="{{ url('hrm/leave/edit/' . $leave->id) }}"
                                                data-task-id="{{ $leave->id }}"
                                                class="btn btn-sm  d-flex align-items-center px-0 mg-r-5"><i
                                                    data-feather="edit-2"></i><span
                                                    class="d-none d-sm-inline mg-l-5"></span>
                                            </a>

                                        </td>
                                    @endif
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
                </div>
            </div>
            <!--Pagination Start-->
            {!! \App\Helper\Helper::make_pagination(
                $content->total_records,
                $content->per_page,
                $content->current_page,
                $content->total_page,
                url('hrm/leave'),
            ) !!}
            <!--Pagination End-->
        </div>
    @endif
    @push('scripts')
    
    <script>

    $(document).ready(function() {
        // Check/uncheck all checkboxes when the master checkbox is clicked
        $('#CheckCheckbox').change(function() {
            $('.statusChange').prop('checked', $(this).prop('checked'));
        });

        // Check/uncheck the master checkbox based on the status of individual checkboxes
        $('.statusChange').change(function() {
            if ($('.statusChange:checked').length === $('.statusChange').length) {
                $('#CheckCheckbox').prop('checked', true);
            } else {
                $('#CheckCheckbox').prop('checked', false);
            }
        });
    });
        
        $(document).on('click','#changeMultipleStatus',function(e){
            e.preventDefault();

            const checkedValues = [];
            $('.statusChange:checked').each(function() {
                checkedValues.push($(this).val());
            });
            var status = $('#statusMultiple').val();

            if (checkedValues.length > 0) {
                if (status !== 'selectStatus') {
 
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('hrm.change-leave-Status') }}",
                        data: {
                            leave_id: checkedValues,
                            status : status
                        },
                        success: function (data) {
                            Toaster('success',data.message); 
                                location.reload(true); 
                        }
                    });
                } else {
                    Toaster('error', 'Please select any one status');
                }

            } else {

                Toaster("error", "Please check atleast one checkbox");
            }
        });

        $(document).on('change','#leave_pay',function(e){
            e.preventDefault();
            let leave_id = $(this).data('id');
            let status = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('hrm.changeleavePay') }}",
                data: {
                    leave_id: leave_id,
                    status : status
                },
                success: function (data) {
                    Toaster('success',data.message);
                }
            });
        });
    </script>

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

    const url = "{{ route('hrm.leave-record') }}";
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
            // <input type="checkbox" name="status" id="CheckCheckbox" class="float-right">
            var html = `<table class="table  table_wrapper">
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                @if($content->role != '')<th>{{ __('hrm.employee_name') }}</th>@endif
                                <th>{{ __('hrm.from_date') }}</th>

                                <th>{{ __('hrm.leave_type') }}</th>
                                <th>{{ __('hrm.leave_status') }}</th>
                                <th>{{ __('hrm.leave_pay') }}</th>

                                <th class="wd-10p text-center">{{ __('common.action') }}</th>
                            </tr>
                        </thead>

                        <tbody> `; 
                            $.each(result.leave_list, function(key, leave){
                                var taskId = leave.id;
                               html+=` <tr> 
                                    <td><input type="checkbox" name="status" id="statusChange" class="statusChange float-right" value="${ leave.id }"></td>`;
                                    if(result.role != ''){
                                        html+=`<td> ${ leave.staff.staff_name ?? ''} </td>`;
                                    }

                                    html+=`<td>${ leave.leave_date }</td>

                                    <td>
                                        
                                        ${ leave.leave_type.leave_type_name ?? ''}
                                      
                                    </td>
                                    <td>`;

                                        if(leave.status == 'approved'){
                                        html+=`<span class="badge text-bg-success">Approved</span>`;
                                        }else if(leave.status == 'rejected'){
                                            html+=`<span class="badge text-bg-danger">Rejected</span>`;
                                        }else{
                                            html+=`<span class="badge text-bg-warning">Pending</span>`;
                                        }

                                        
                                         
                                    html+=`</td>
                                    <td>
                                        <select class="form-control" id="leave_pay" name="leave_pay" data-id="${ leave.id }">
                                            <option value="1" ${ (leave.paid == '1')?'selected':'' }>Paid</option>
                                            <option value="0" ${ (leave.paid == '0')?'selected':'' }>UnPaid</option>
                                        </select>
                                    </td> 
                                    <td class="align-items-center justify-content-center d-flex gap-2">
                                        <a href="{{ url('hrm/leave/edit/') }}/${taskId}"
                                            data-task-id="${taskId}"
                                            class="btn btn-sm  d-flex align-items-center px-0 mg-r-5"><i class="fa fa-pencil" ></i><span
                                                class="d-none d-sm-inline mg-l-5"></span>
                                        </a>

                                        </td> 
                                </tr>`;
                            });
                        html+=`</tbody>
                    </table> `;
            $("#leaveList").html(html);
        }
    });
    }
</script>
    @endpush
</x-app-layout>
