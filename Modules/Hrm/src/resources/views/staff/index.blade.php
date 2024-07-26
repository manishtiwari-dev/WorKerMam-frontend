<x-app-layout>
    @section('title', $pageTitle) 
    @php 
        $statusColor = ['danger', 'success']; 
    @endphp 
    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
        <div class="card">
            <div class="tab-content">
                <div class="card-header d-flex align-items-center justify-content-between px-3">
                    <h5 class="tx-15 mb-0">{{ __('user-manager.employee_list') }}</h5>
                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                    <div>
                        <a href="{{ route('hrm.staff.create') }}" class="btn btn-md  btn-primary ">
                            <i data-feather="plus"></i> {{ __('user-manager.add_employee') }}
                        </a>
                        <a href="{{ route('hrm.import-create') }}" class="btn btn-md btn-primary">
                            <i data-feather="plus"></i> Import
                        </a>
                    </div>
                    @endif
                </div>
               
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group  col-md-4">
                            <select class="form-control select2" id="department" name="department">
                                <option value="all">All Department</option> 
                               @if(!empty($content->department_list))
                               @foreach ($content->department_list as $department)
                                   <option value="{{ $department->department_id }}">{{ $department->dept_name }}</option>
                               @endforeach 
                               @endif
                                
                            </select>
                        </div>
                        {{-- <div class="form-group col-md-4">
                            <select class="form-control select2" id="role" name="role">
                                <option value="all">All Role</option>
                                @if(!empty($content->role_list))
                                @foreach ($content->role_list as $role)
                                    <option value="{{ $role->roles_id }}">{{ $role->roles_name }}</option>
                                @endforeach
                                @endif
        
                            </select>
                        </div> --}}
                        <div class="form-group   col-md-4">
                            <select class="form-control select2" name="status" id="status">
                                <option value="all">All Status</option>
                                 <option value="1">Working</option>
                                 <option value="2">Terminated</option>
                            </select>
                        </div> 
                        <div class="form-group  col-md-4">
                            <input type="search" name="search" id="search" class="form-control fas fa-search" placeholder="Search..."/>
                        </div> 
                        <div class="col-lg-2 d-flex">
                            <div class="align-items-center ">
                                <a class="btn btn-primary px-5" href="{{ route('hrm.staff.index') }}"
                                    role="button">{{ __('common.reset') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive" id="staff_list">
                        <table class="table  table_wrapper ">
                            <thead>
                                <tr>
                                    <th>{{ __('common.sl_no') }}</th>
                                    <th>Employee id</th>
                                    <th>Staff Details</th>
                                    <th>Role</th>
                                    <th>Salary</th>
                                    <th>Joining Date</th>
                                    <th>Duration</th>
                                    <th>{{ __('common.status') }}</th>
                                    <th>{{ __('common.action') }}</th>
                                </tr>
                            </thead>
                            <tbody id="Search_Tr">
                                    @forelse($content->data as $key => $staff)
                                        @php
                                            if(!empty($staff->date_of_leaving)){
                                                $date_of_leaving = $staff->date_of_leaving;

                                                $leaving = \Carbon\Carbon::parse($date_of_leaving);
                                            }else{
                                                $leaving = now();
                                            }
                                            $joiningDate = $staff->date_of_joining; 
                                            // Convert the joining date string to a Carbon instance
                                            $joiningDate = \Carbon\Carbon::parse($joiningDate);
                                            // Calculate the difference in days
                                            $daysDifference = $leaving->diffInDays($joiningDate);
                                            //Calculate the difference in years, months, and days
                                            $diffInYearsMonthsDays = $leaving->diff($joiningDate);
                                        @endphp
                                        <tr>
                                            <td class="px-3">{{ $key + 1 }}</td>
                                            <td>{{ $staff->employee_id }}</td>
                                            <td>
                                                <ul class="list-unstyled media-list mg-b-15">

                                                    <li class="media align-items-center">
                                                        <a href="{{ route('hrm.staff.show', $staff->staff_id) }}">
                                                            <div class="avatar ">
                                                                <img src="{{ $staff->staff_photo }}"
                                                                    class="rounded-circle" alt="">
                                                            </div>
                                                        </a>
                                                        <div class="media-body pd-l-15">
                                                            <p class="tx-medium mg-b-2">
                                                                <a href="{{ route('hrm.staff.show', $staff->staff_id) }}"
                                                                    class="link-01">{{ $staff->staff_name }}</a>
                                                            </p>
                                                            <span class="tx-12 tx-color-03">
                                                                @if (!empty($staff->department->dept_name))
                                                                    {{ $staff->department->dept_name }}
                                                                @endif <br/>
                                                                @if (!empty($staff->designation->designation_name))
                                                                    {{ $staff->designation->designation_name }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>{{ $staff->role_name }}</td>
                                            <td>{{ $staff->salary }}</td>
                                            <td>{{ $staff->date_of_joining }}</td>
                                            <td>Years: {{ $diffInYearsMonthsDays->y }}, Months: {{ $diffInYearsMonthsDays->m }}, Days: {{ $diffInYearsMonthsDays->d }}</td>
                                            <td> 
                                                @if($staff->status == '2')
												    <span class="badge bg-danger">Terminated</span>
                                                @else
                                                    <span class="badge bg-success">Working</span>
                                                @endif
                                            </td>
                                            <td class="d-flex align-items-center gap-2 justify-content-center my-2">
                                                <a href="{{ route('hrm.staff.show', $staff->staff_id) }}"
                                                    id="staff_view" class="btn btn-sm table_btn py-1 px-2"><i
                                                        data-feather="eye"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9">
                                                <h5 class="text-center mb-0 py-1">{{ __('common.no_record') }}</h5>
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
                    'hrm.staff.index',
                ) !!}
                <!--Pagination End-->
            </div>
            <!--end row-->
        </div>
    @endif




    <!---- Staff Status Change modal start here--->
    <div class="modal fade effect-scale" id="statusModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Termination</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" method="POST" id="update_userForm" novalidate>
                        <input name="staff_id" id="staff_id" type="hidden" class="form-control">
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">Termination Reason<span class="text-danger">*</span></label>
                                <select name="termination_reason" id="termination_reason"
                                    class="form-control form-select">
                                    <option value="" selected disabled>Select Termination Reason</option>
                                    <option value=1>Left </option>
                                    <option value=2>Resigned</option>
                                    <option value=3>Fired</option>
                                    <option value=4>Others</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please Select termination Reason
                                </div>
                                <span class="text-danger">
                                    @error('dept_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">Remark Details<span class="text-danger">*</span></label>
                                <textarea name="remark_details" class="form-control" id="remark_details" cols="30" rows="5"></textarea>
                                <div class="invalid-feedback">
                                    please Enter Remark Details
                                </div>
                                <span class="text-danger">
                                    @error('dept_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <input type="Submit" id="submitBtn" name="send" class="btn btn-primary"
                            value="{{ __('common.submit') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!---- Staff status Change modal end here--->

    @push('scripts')
        <!-- search ajax-->
        <script>
            //staff verification status change jquery
            $('#staffVerStatus').change(function() {
                var data = {
                    staff_id: $('#staffVerStatus').data('id'),
                    type: 'verification',
                    verification_status: $('#staffVerStatus').val(),
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('hrm.staffStatus') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        Toaster(response.message);
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000);
                    }
                });
            });

            //staff status chanage jquery 
            $('.staffStatusChange').change(function(e) {
                var status = $(this).val();
                var staff_id = $(this).data('id');
                if (status == '2') {
                    $('#statusModal').modal('show');
                    $('#staff_id').val(staff_id);
                } else {
                    var data = {
                        staff_id: $('#staffStatus').data('id'),
                        type: 'staffStatus',
                        status: status,
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('hrm.staffStatus') }}",
                        data: data,
                        dataType: "json",
                        success: function(response) {
                            Toaster(response.message);
                            setTimeout(function() {
                                location.reload(true);
                            }, 1000);
                        }
                    });
                }
            });

            $('#submitBtn').on("click", function(e) {
                e.preventDefault();
                data = {
                    staff_id: $('#staffStatus').data('id'),
                    type: 'staffStatus',
                    staff_id: $('#staff_id').val(),
                    termination_reason: $('#termination_reason').val(),
                    remark_details: $('#remark_details').val(),
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('hrm.staffStatus') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        $('#statusModal').modal('hide');
                        Toaster(response.message);
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000);
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() { 
                $('#department,#status').on('change', function(e, data) {

                    if ($('#department').val() != "all") {

                        ajaxSubsmisstionData();
                    } else if ($('#status').val() != "all") {

                        ajaxSubsmisstionData();
                    } else {

                        ajaxSubsmisstionData();
                    }

                });
            });

            $(document).ready(function() {   
                $('#search').on('input', function() {
                    if ($('#search').val() != "all") { 
                        ajaxSubsmisstionData();
                    }   
                });
            });


            function ajaxSubsmisstionData() {
                var department = $('#department').val();
                // var role = $('#role').val();
                var status = $('#status').val();
                var search = $('#search').val();

                $("#staff_list").html('');
                tableWebContent(department, status, search);
            }

            function tableWebContent(department, status, search) {

            const url = "{{ route('hrm.staff-search') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    department: department,
                    status: status,
                    search: search,
                },
                dataType: "json",
                success: function(result) {
                    
                    $("#staff_list").html(result.html);
                }
            });
            }
        </script>
    @endpush
</x-app-layout>
