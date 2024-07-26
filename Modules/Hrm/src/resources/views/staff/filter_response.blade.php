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
            @forelse($data as $key => $staff)
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
                            class="fa fa-eye" aria-hidden="true"></i></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <h5 class="text-center mb-0 py-1">{{ __('common.no_record') }}</h5>
                    </td>
                </tr>
            @endforelse 
    </tbody>
</table>

 <!--Pagination Start-->
 {!! \App\Helper\Helper::make_pagination(
    $total_records,
    $per_page,
    $current_page,
    $total_page,
    'hrm.staff.index',
) !!}
<!--Pagination End-->