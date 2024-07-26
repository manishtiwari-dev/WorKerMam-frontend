<x-app-layout>
    @section('title', 'Role')
    @php
        // // dd($content);
        // if ($content->current_page > 1) {
        //     $sl_no = ($content->current_page - 1) * $content->per_page + 1;
        // } else {
        //     $sl_no = 1;
        // }
    @endphp
    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
        <div class="card contact-content-body">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="tx-15 mg-b-0">Role
                    </h6>
                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                        <a href="#add_role" class="btn btn-md  btn-primary align-items-center mg-r-5"
                            data-bs-toggle="modal"><i data-feather="plus"></i>
                            <span class="d-none d-sm-inline mg-l-5">Create Role

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
                                <th>No of Users </th>
                                <th>Sort Order</th>
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
                                    <tr>
                                        <td> {{ $key + 1 }}</td>
                                        <td class="text-truncate">{{ $list->roles_name ?? '' }}</td>
                                        <td class="text-truncate">{{ $list->userCount ?? '' }}</td>

                                        <td class="">

                                            <input type="number" class="col-xs-1 inputPassword2 width1 text-center"
                                                data-categories_id="{{ $list->roles_id }}" placeholder=""
                                                value="{{ $list->sort_order }}" style="width:50px;">
                                        </td>

                                        <td class="d-flex align-items-center gap-2 justify-content-center">
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                                @if ($list->is_editable == 1)
                                                    <a href="#edit_role" class="btn btn-sm  table_btn py-1 px-2 editBtn"
                                                        data-bs-toggle="modal" data-id="{{ $list->roles_id }}"><i
                                                            data-feather="edit-2"></i><span
                                                            class="d-sm-inline mg-l-5"></span>
                                                    </a>
                                                @endif
                                            @endif

                                        </td>
                                    </tr>
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

                    {{-- <!--Pagination Start-->
                    {!! \App\Helper\Helper::make_pagination(
                        $content->total_records,
                        $content->per_page,
                        $content->current_page,
                        $content->total_page,
                        'user-manage.userList',
                    ) !!}
                    <!--Pagination End--> --}}

                </div>
            </div>
        </div>
    @endif

    {{-- @dd($content->module_listItem->permission_list) --}}

    <!---  Add URL Modal Start Here ------------->
    <div class="modal fade" id="add_role" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title h4">Create Role</div> <button type="button" class="close"
                        data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" novalidate="" id="addForm" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" mb="20px"><label display="block" mb="5px"
                                        for="name"><b><b>NAME:</b></b></label><input id="name" type="text"
                                        class="form-control" placeholder="Enter your name" name="role_name"></div>
                            </div>
                        </div>
                        <div class="form-group" mb="20px"><label display="block" mb="5px"
                                for="permissionList"><b><b>Permission:</b></b></label>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <div class="row">
                                        @if (!empty($content->module_listItem->permission_list))
                                            @foreach ($content->module_listItem->permission_list as $key => $per_list)
                                                <div class="col-md-2 text-center text-uppercase"><b>
                                                        {{ \App\Helper\Helper::translation($per_list->permissions_name) }}
                                                    </b></div>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if (!empty($content->module_listItem->module_list))
                                    @foreach ($content->module_listItem->module_list as $key => $module_list)
                                        <div class="col-md-12">
                                            <fieldset class="form-fieldset">
                                                <legend>
                                                    {{ \App\Helper\Helper::translation($module_list->module_name) }}
                                                </legend>
                                                <div class="row">
                                                    @if (!empty($module_list->section_list))
                                                        @foreach ($module_list->section_list as $key => $section)
                                                            <div class="col-md-3"><label class="">
                                                                    <h6>{{ \App\Helper\Helper::translation($section->section_name) }}
                                                                    </h6>
                                                                </label></div>
                                                            <div class="col-md-9">
                                                                <div class="row">
                                                                    @if (!empty($content->module_listItem->permission_list))
                                                                        @foreach ($content->module_listItem->permission_list as $key => $per_list)
                                                                            <div class="col-md-2"><select
                                                                                    name="permission_{{ $section->section_id }}_{{ $per_list->permissions_id }}"
                                                                                    class="">

                                                                                    <option value="">Select
                                                                                    </option>
                                                                                    @if (isset($per_list->allow_permission))
                                                                                        @php
                                                                                            $allowPermissions = json_decode($per_list->allow_permission, true);
                                                                                        @endphp

                                                                                        @foreach ($allowPermissions as $allow => $value)
                                                                                            @if ($value !== '')
                                                                                                <option
                                                                                                    value="{{ $value }}">
                                                                                                    {{ ucfirst($allow) }}
                                                                                                </option>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    @endif

                                                                                </select>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                            </fieldset>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                        <div class="col-md-4">
                            <input type="submit" name="send" class="btn btn-primary addSettingButton"
                                value="{{ __('common.update') }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!---  Add URL Modal End Here ------------->

    <!---  Edit URL List Modal Start Here ------------->
    <div class="modal fade" id="edit_role" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header align-item-center">
                    <h6 class="modal-title" id="exampleModalLabel"> Update Role</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ajaxhtMldiv">

                </div>
            </div>
        </div>
    </div>
    <!---  Edit URL Modal End Here ------------->

    @push('scripts')
        <script>
            $(document).ready(function() {

                // Add sender Ajax Start Here
                $(document).on("click", ".addSettingButton", function(e) {
                    e.preventDefault();

                    // var EditSettingFormData = new FormData();
                    // var formData = $('#settingForm').serialize();

                    var addData = document.getElementById("addForm");
                    var formData = new FormData(addData);

                    console.log(formData);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/user-manage/role/store') }}",
                        data: formData,
                        dataType: "json",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            // if (response.status == 200) {
                            //     Notify(response.message, true);
                            //     setTimeout(function() {
                            //         location.reload(true);
                            //     }, 3000);
                            // }

                            Toaster('success', response.success);
                            $('#add_role').modal('hide');



                        }
                    });

                });
                // Add url Ajax End Here



                // Edit url Ajax Start


                $(document).on("click", ".editBtn", function(e) {
                    e.preventDefault();
                    var edit_id = $(this).data('id');
                    $.ajax({
                        url: "{{ route('user-manage.roleListEdit') }}",
                        type: "POST",
                        data: {
                            updateId: edit_id
                        },

                        success: function(result) {
                            console.log(result);


                            $(".ajaxhtMldiv").html(result.html);
                        }
                    });
                });
                //  Edit url Ajax End  Here

                // Upadate url Ajax Start Here

                $(document).on("click", ".updateButton", function(e) {

                    e.preventDefault();



                    var addData = document.getElementById("updateForm");
                    var formData = new FormData(addData);

                    console.log(formData);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/user-manage/role/update') }}",
                        data: formData,
                        dataType: "json",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            // if (response.status == 200) {
                            //     Notify(response.message, true);

                            // }
                            $('#edit_role').modal('hide');
                            Toaster('success', response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);


                        }
                    });

                });

                // Update Sender Ajax End Here





                //  sort order update
                $(".inputPassword2").on("blur", function(e) {
                    e.preventDefault();
                    var roles_id = $(this).data('categories_id');
                    var sort_order = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('user-manage.roleListSortorder') }}",
                        data: {
                            roles_id: roles_id,
                            sort_order: sort_order
                        },
                        dataType: "json",
                        success: function(data) {
                            Toaster("success", data.success);
                        }
                    });
                });

            });
        </script>
    @endpush

</x-app-layout>
