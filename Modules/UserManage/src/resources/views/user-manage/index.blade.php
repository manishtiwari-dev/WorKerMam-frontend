<x-app-layout>
    @section('title', 'User')
    @php
        // dd($content);
        if ($content->current_page > 1) {
            $sl_no = ($content->current_page - 1) * $content->per_page + 1;
        } else {
            $sl_no = 1;
        }
        $api_token = request()->cookie('api_token');
        $userdata = Cache::get('userdata-' . $api_token);

    @endphp


    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
        <div class="card contact-content-body">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="tx-15 mg-b-0">User
                    </h6>
                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                        <a href="#add_paymentTerm" class="btn btn-md  btn-primary align-items-center mg-r-5"
                            data-bs-toggle="modal"><i data-feather="plus"></i>
                            <span class="d-none d-sm-inline mg-l-5">Create User

                            </span>
                        </a>
                    @endif
                </div>
            </div>
            <div class="card-body">

                {{-- <div class="row align-item-center mb-3 order-list-wrapper">
                    <div class="col-lg-4">
                        <input type="text" id="search" value="" class="form-control fas fa-search"
                            placeholder="Search..." aria-label="Search" name="search">
                    </div>
                    <div class="col-lg-2 mt-2 mt-lg-0">
                        <div class="align-items-center ">
                            <a class="btn btn-block btn-lg  btn-primary"
                                href="{{ route('website-setting.custom-link.customUrl') }}" role="button"><i
                                    class="fa fa-refresh" aria-hidden="true"></i>
                                {{ __('common.reset') }}</a>
                        </div>
                    </div>
                </div> --}}
                {{-- @dd($content) --}}

                <div class="table-responsive" id="url_listing">

                    <table class="table  table_wrapper">
                        <thead>
                            <tr>
                                <th>{{ __('common.sl_no') }}</th>
                                <th>Name</th>
                                <th>Email </th>
                                <th>Role </th>
                                <th>Status </th>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                    <th class="wd-10p text-center">
                                        {{ __('common.action') }}
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>

                            @if (sizeof($content->data) > 0)
                                @foreach ($content->data as $key => $list)
                                    {{-- @if ($list->role_name != 'Super Admin') --}}
                                    <tr>
                                        <td> {{ $sl_no++ }}</td>
                                        <td class="text-truncate">{{ $list->name ?? '' }}</td>
                                        <td class="text-truncate">{{ $list->email ?? '' }}</td>
                                        <td class="text-truncate">{{ $list->role_name ?? '' }}</td>

                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input urlToggleBtn"
                                                    {{ $list->status == '1' ? 'checked' : '' }}
                                                    data-id="{{ $list->id }}" id="customSwitch{{ $list->id }}">
                                                <label class="custom-control-label"
                                                    for="customSwitch{{ $list->id }}"></label>
                                            </div>
                                        </td>

                                        <td class="d-flex align-items-center gap-2 justify-content-center">



                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                                <a href="#edit_url" class="btn btn-sm  table_btn py-1 px-2 editBtn"
                                                    data-bs-toggle="modal" data-id="{{ $list->id }}"><i
                                                        data-feather="edit-2"></i><span
                                                        class="d-sm-inline mg-l-5"></span>
                                                </a>
                                            @endif


                                        </td>
                                    </tr>
                                    {{-- @endif --}}
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">
                                        <h5 class="text-center mb-0 py-1">{{ __('common.no_record') }}</h5>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <!--Pagination Start-->
                    {!! \App\Helper\Helper::make_pagination(
                        $content->total_records,
                        $content->per_page,
                        $content->current_page,
                        $content->total_page,
                        'user-manage.userList',
                    ) !!}
                    <!--Pagination End-->

                </div>
            </div>
        </div>
    @endif

    <!---  Add URL Modal Start Here ------------->
    <div class="modal fade" id="add_paymentTerm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header align-item-center">
                    <h6 class="modal-title" id="exampleModalLabel">Create User
                    </h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_paymentTerm_form" class="needs-validation" novalidate>


                        <input type="hidden" value="{{ $userdata->userType }}" name="userType" id="addUsertype">
                        <div class="form-group">
                            <label for="terms_name"> Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control url_input" id="name" name="name"
                                placeholder="Term Name" required>
                            <span style="color:red;">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                please enter a name
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control url_input" id="email" name="email"
                                placeholder="Email" required>
                            <span style="color:red;">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                please enter a email
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control url_input" id="password" name="password"
                                placeholder="Password" required>
                            <span style="color:red;">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                please enter a password
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="seometa_desc">Role<span class="text-danger">*</span></label>
                            <select class=" form-control" name="role_name" id="role_name">

                                @if (!empty($content->roles_list))
                                    @foreach ($content->roles_list as $key => $list)
                                        <option value="{{ $list->roles_id }}">{{ $list->roles_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('role_name')
                                {{ $message }}
                            @enderror
                            </span>
                            <div class="invalid-feedback">
                                please select a role
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary"
                            id="addBtn">{{ __('common.submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!---  Add URL Modal End Here ------------->


    <!---  Edit URL List Modal Start Here ------------->
    <div class="modal fade" id="edit_url" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header align-item-center">
                    <h6 class="modal-title" id="exampleModalLabel"> Update User</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_url_form" class="needs-validation" novalidate>
                        <input type="hidden" value="{{ $userdata->userType }}" name="userType" id="editUsertype">
                        <div class="form-group">
                            <label for="terms_name"> Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control url_input" id="edit_name" name="name"
                                placeholder=" Name" required>
                            <span style="color:red;">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                please enter a name
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control url_input" id="edit_email" name="email"
                                placeholder="Email" required>
                            <span style="color:red;">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                please enter a email
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control url_input" id="edit_password" name="password"
                                placeholder="Password">

                        </div>

                        <div class="form-group ">
                            <label for="seometa_desc">Role<span class="text-danger">*</span></label>
                            <select class=" form-control" id="edit_role" name="role_name" id="role_name">

                                {{-- @if (!empty($content->roles_list))
                                    @foreach ($content->roles_list as $key => $list)
                                        <option value="{{ $list->roles_id }}">{{ $list->roles_name }}</option>
                                    @endforeach
                                @endif --}}
                            </select>
                            @error('role_name')
                                {{ $message }}
                            @enderror
                            </span>
                            <div class="invalid-feedback">
                                please select a role
                            </div>
                        </div>


                        {{-- <div class="form-group">
                            <label for="seometa_desc">{{ __('common.status') }}<span
                                    class="text-danger">*</span></label>
                            <select class="form-select form-control" name="status" id="edit_status">
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
                            </select>
                            @error('status')
                                {{ $message }}
                            @enderror
                            </span>
                            <div class="invalid-feedback">
                                please select a status
                            </div>
                        </div> --}}

                        <input type="hidden" class="edit_id" value="">
                        <button type="button" class="btn btn-primary"
                            id="updateUrlBtn">{{ __('common.submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!---  Edit URL Modal End Here ------------->



    @push('scripts')
        <script>
            $(document).ready(function() {

                // Add sender Ajax Start Here
                $('#addBtn').on("click", function(e) {
                    e.preventDefault();
                    $('#add_paymentTerm_form').addClass('was-validated');
                    if ($('#add_paymentTerm_form')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        $('#addBtn').attr('disabled', 'true');
                        var formData = {
                            name: $("#name").val(),
                            email: $("#email").val(),
                            password: $("#password").val(),
                            role_name: $("#role_name").val(),
                            userType: $("#addUsertype").val(),


                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('user-manage.userStore') }}",
                            type: "POST",
                            data: formData,
                            dataType: "json",

                            success: function(response) {
                                Toaster('success', response.message);
                                setTimeout(function() {
                                    location.reload(true);
                                }, 1000);
                            },
                        });
                    }
                });
                // Add url Ajax End Here



                // Edit url Ajax Start

                $(document).on("click", ".editBtn", function(e) {
                    e.preventDefault();
                    var edit_id = $(this).data('id');
                    var subsHtml = `<option selected  value="" >Select</option>`;
                    $.ajax({
                        url: "{{ route('user-manage.userEdit') }}",
                        type: "POST",
                        data: {
                            user_id: edit_id
                        },

                        success: function(response) {
                            console.log(response.edit_data.userdetail);
                            $('.edit_id').val(edit_id);
                            $('#edit_name').val(response.edit_data.userdetail.first_name);
                            $('#edit_email').val(response.edit_data.userdetail.email);
                            // $('#edit_password').val(response.edit_data.password);
                            //  $("#edit_role").val(response.edit_data.role_name);
                            //  $("#edit_status").val(response.edit_data.userdetail.status);

                            var role_data = response.edit_data.userdetail.roles[0];
                            console.log(role_data);
                            $.each(response.edit_data.roles_list, function(keys, subs) {
                                subsHtml +=
                                    `<option  ${subs.roles_id ==  role_data.roles_id ? 'selected' :''}  value="${subs.roles_id}">${subs.roles_name}</option>`;
                            });

                            $("#edit_role").html(subsHtml);
                        }
                    });
                });
                //  Edit url Ajax End  Here

                // Upadate url Ajax Start Here

                $('#updateUrlBtn').on("click", function(e) {
                    e.preventDefault();
                    $('#update_url_form').addClass('was-validated');
                    if ($('#update_url_form')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        $('#updateUrlBtn').attr('disabled', 'true');
                        var formData = {
                            name: $("#edit_name").val(),
                            email: $("#edit_email").val(),
                            password: $("#edit_password").val(),
                            role_name: $("#edit_role").val(),
                            user_id: $(".edit_id").val(),
                            userType: $("#editUsertype").val(),
                        };

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('user-manage.userUpdate') }}",
                            type: "POST",
                            data: formData,
                            dataType: "json",

                            success: function(response) {
                                Toaster('success', response.message);
                                setTimeout(function() {
                                    location.reload(true);
                                }, 1000);
                            },
                        });
                    }
                });

                // Update Sender Ajax End Here




                //Sender List Change Status Ajax Start Here 
                $(document).on("change", ".urlToggleBtn", function(e) {
                    let id = $(this).data('id');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('user-manage.userChangeStatus') }}",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            Toaster('success', response.message);

                        }
                    });
                });

                //Sender List Change Status Ajax End Here 

                // Search Filter Start Here



                // Date and Search Filter End Here

            });
        </script>
    @endpush

</x-app-layout>
