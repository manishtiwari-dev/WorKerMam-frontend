<x-app-layout>
    @section('title', $pageTitle)

    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')

    <div class="card contact-content-body">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="tx-15 mg-b-0">{{ __('user-manager.department_list') }}</h6>
                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                    <a href="#departmentadd" data-bs-toggle="modal" class="btn btn-sm btn-bg btn-primary"><i
                            data-feather="plus"></i>{{ __('user-manager.add_department') }}</a>
                @endif
            </div>
        </div>
            <div class="card-body">
                {{-- <form action="{{ route('hrm.department.index') }}" method="get">

                    <div class="row mt-3 mb-3" id="search">
                        <div class="form-group col-2 col-lg-1 col-sm-3">
                            <select class="form-control">
                                <option>10</option>
                                <option>20</option>
                                <option>30</option>
                                <option>40</option>
                                <option>50</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <div class="search-form">
                                <input type="search" name="search" id="searchbar" class="form-control"
                                    placeholder="Search Here">
                                <button class="btn" id="searchBtn" type="submit"><i
                                        data-feather="search"></i></button>
                            </div>
                        </div>

                    </div>
                </form> --}}
                {{-- <div class="form-row">
                <div class="form-group col-2 col-lg-1 col-sm-3">
                    <select class="form-control">
                        <option>10</option>
                        <option>20</option>
                        <option>30</option>
                        <option>40</option>
                        <option>50</option>
                    </select>
                </div>
                <div class="form-group mg-l-5">
                    <input type="text" class="form-control" id="Search" placeholder="{{ __('newsletter.search_placeholder')}}">
                </div>
            </div> --}}
                <div class="table-responsive">
                    <table class="table  table_wrapper">
                        <thead>
                            <tr>
                                <th>{{ __('common.sl_no') }}</th>
                                <th >{{ __('user-manager.department_name') }}</th>
                                {{-- <th>{{__('user-manager.department_details')}}</th> --}}
                                <th>{{ __('common.status') }}</th>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                <th style="width:15%;" class="text-center ">{{ __('common.action') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                                @forelse ($content->data as $key => $department)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $department->dept_name }}</td>
                                        {{-- <td>{{ $department->dept_details }}</td> --}}
                                        <td  class=" justify-content-center">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input toggle-class"
                                                    {{ $department->status == '1' ? 'checked' : '' }}
                                                    data-id="{{ $department->department_id }}"
                                                    id="customSwitch{{ $department->department_id }}">
                                                <label class="custom-control-label"
                                                    for="customSwitch{{ $department->department_id }}"></label>
                                            </div>
                                        </td>
                                        <td class="align-items-center justify-content-center gap-2 d-flex">
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                                <a href="#department_edit"
                                                    class="btn btn-sm  px-0 d-flex align-items-center mg-r-5"
                                                    data-id="{{ $department->department_id }}" id="editmodal"
                                                    data-bs-toggle="modal"><i data-feather="edit-2"></i>
                                                </a>
                                            @endif
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'remove') == 'true')
                                                <a href="#delete_modal" data-bs-toggle="modal" id="delete_btn"
                                                    class="btn btn-sm px-0 d-flex align-items-center "
                                                    data-id="{{ $department->department_id }}"><i
                                                        data-feather="trash"></i>
                                                </a>
                                            @endif
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
                </div>
            </div>
      
        <!--Pagination Start-->
        {!! \App\Helper\Helper::make_pagination(
            $content->total_records,
            $content->per_page,
            $content->current_page,
            $content->total_page,
            route('hrm.department.index'),
        ) !!}
        <!--Pagination End-->
    </div>
@endif
    <!----- Department add modal start here ------------>
    <div class="modal fade" id="departmentadd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('user-manager.add_department') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" method="POST" id="userForm" novalidate>
                        <input name="department_id" id="department_id" type="hidden" class="form-control">
                        <div>
                            <div class="form-group">
                                <label class="form-label"> {{ __('user-manager.department_name') }}<span
                                        class="text-danger">*</span></label>
                                <input name="department_name" id="department_name" type="text" class="form-control"
                                    placeholder="{{ __('user-manager.department_name_placeholder') }}" required>
                                <div class="invalid-feedback">
                                    {{ __('user-manager.name_error') }}
                                </div>
                                <span class="text-danger">
                                    @error('dept_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <input type="submit" id="submit" name="send" class="btn btn-primary"
                            value="{{ __('common.submit') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----- Department add modal end here ------------>

    <!----- Department edit modal start here ------------>
    <div class="modal fade" id="department_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('user-manager.update_department') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" method="POST" id="update_userForm" novalidate>
                        <input name="department_id" id="department_id" type="hidden" class="form-control">
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label"> {{ __('user-manager.department_name') }}<span
                                        class="text-danger">*</span></label>
                                <input name="dept_name" id="dept_name" type="text" class="form-control"
                                    placeholder="{{ __('user-manager.department_name_placeholder') }}" required>
                                <div class="invalid-feedback">
                                    {{ __('user-manager.name_error') }}
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
                                <label class="form-label">Status<span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control form-select" required>
                                    <option value="" selected disabled>Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <div class="invalid-feedback">
                                    {{ __('user-manager.name_error') }}
                                </div>
                                <span class="text-danger">
                                    @error('dept_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <input type="Submit" id="update_btn" name="send" class="btn btn-primary"
                            value="{{ __('common.update') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----- Department edit modal start here ------------>

    <!----- Department delete modal start here ------------>
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel5">{{ __('user-manager.delete_department') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>{{ __('user-manager.are_you_sure') }}</h6>
                    <input type="hidden" id="delete_department_id" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('common.no') }}
                    </button>
                    <button type="submit" class="btn btn-primary delete_submit_btn">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!----- Department delete modal start here ------------>

    @push('scripts')
        <script>
            // start aad modal ajax
            $(document).ready(function() {
                $(document).on('click', "#submit", function(e) {
                    e.preventDefault();
                    $('#userForm').addClass('was-validated');
                    if ($('#userForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            dept_name: $("#department_name").val(),
                            dept_details: $("#department_details").val(),
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ route('hrm.department.store') }}",
                            data: data,
                            dataType: "json",
                            success: function(response) {
                                if (response.success) {
                                 Toaster("success", response.success);

                                 setTimeout(function() {
                                     location.reload(true);
                                 }, 3000);
                                 window.location.href =
                                     "{{ route('hrm.department.index') }}";

                             } else {
                                 Toaster("error", response.error);
                             }


                            },
                        });
                    }
                });
            });


            // start edit modal ajax
            $(document).on("click", "#editmodal", function(e) {
                e.preventDefault();
                var department_id = $(this).data('id');
                $.ajax({
                    url: "department/" + department_id + "/edit",
                    type: "GET",
                    success: function(response) {
                        console.log(response);
                        $('#dept_name').val(response.data.dept_name);
                        $('#department_id').val(response.data.department_id);
                        $('#status').val(response.data.status);
                    }
                });
            });

            //  modal update code start
            $(document).on("click", "#update_btn", function(e) {
                e.preventDefault();
                $('#update_userForm').addClass('was-validated');
                if ($('#update_userForm')[0].checkValidity() === false) {
                    event.stopPropagation();
                } else {
                    var data = {
                        department_id: $('#department_id').val(),
                        dept_name: $('#dept_name').val(),
                        status: $('#status').val(),
                    }
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('hrm.dptUpdate') }}",
                        data: data,
                        dataType: "json",
                        success: function(response) {

                            if (response.success) {
                                 Toaster("success", response.success);

                                 setTimeout(function() {
                                     location.reload(true);
                                 }, 3000);
                                 window.location.href =
                                     "{{ route('hrm.department.index') }}";

                             } else {
                                 Toaster("error", response.error);
                             }



                            // Toaster(response);
                            // setTimeout(function() {
                            //     location.reload();
                            // }, 1000);
                        }
                    });
                }
            });

            // change status open
            $('.toggle-class').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let department_id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('hrm.dptStatus') }}",
                    data: {
                        'status': status,
                        'department_id': department_id
                    },
                    success: function(response) {
                     
                        if (response.success) {
                                 Toaster("success", response.success);

                                 setTimeout(function() {
                                     location.reload(true);
                                 }, 3000);
                                 window.location.href =
                                     "{{ route('hrm.department.index') }}";

                             } else {
                                 Toaster("error", response.error);
                             }
                    }
                });
            });

            //delete department ajax start here
            $(document).on("click", "#delete_btn", function() {
                var department_id = $(this).data('id');
                $('#delete_department_id').val(department_id);
            });
            $(document).on('click', '.delete_submit_btn', function() {
                var department_id = $('#delete_department_id').val();
                console.log(department_id);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('hrm/dptdestroy') }}/" + department_id,
                    data: {
                        department_id: department_id
                    },
                    dataType: "json",
                    success: function(response) {

                        if (response.success) {
                                 Toaster("success", response.success);

                                 setTimeout(function() {
                                     location.reload(true);
                                 }, 3000);
                                 window.location.href =
                                     "{{ route('hrm.department.index') }}";

                             } else {
                                 Toaster("error", response.error);
                             }


                        
                    }
                });

            });
        </script>
    @endpush
</x-app-layout>
