<x-app-layout>
  
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row">
                <div class="col-md-12 col-lg-12 my-0">
                    <div class="card rounded shadow pb-1">
                        <div class=" border-0 quotation_form">
                            <div
                                class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('settings.emial_group_list')}}</h5>
                                <div>
                                    <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#add_modal"
                                        id="add_group_btn"><i data-feather="plus" class="lead_icon mg-r-5"></i>{{
                                        __('settings.add_email_group')}}</button></a>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 mt-1">
                            <div class="table-responsive shadow rounded" id="email_group_table">
                                <table class="table table-center bg-white mb-0">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom p-3">{{ __('common.sl_no')}}</th>
                                            <th class="border-bottom p-3" style="min-width: 220px;">{{
                                                __('settings.group_name')}}</th>
                                            <th class="border-bottom p-3" style="min-width: 220px;">{{
                                                __('settings.group_key')}}</th>
                                            <th class="text-center border-bottom p-3">{{ __('common.action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Start -->

                                        @if(!empty($email_group))
                                        @foreach($email_group as $key =>$group)
                                        <tr>
                                            <th class="p-3">{{$key+1}}</th>
                                            <td class="p-3">{{$group->group_name}}</td>
                                            <td class="p-3">{{$group->group_key}}</td>
                                            <td>
                                                <div class="d-flex align-items-center p-3">
                                                    <a href="{{route('email-template',$group->group_id)}}"
                                                        class="btn btn-primary btn-xs btn-icon view_btn"><i
                                                            class="uil uil-eye"></i></a>
                                                    <button type="button"
                                                        class="btn btn-primary btn-xs btn-icon table_btn edit_temp_btn"
                                                        id="edit_btn" value="{{$group->group_id}}" data-toggle="modal"
                                                        data-target="#edit_Template"><i
                                                            class="uil uil-edit"></i></button>
                                                    <button type="button" id="delete_btn" value="{{$group->group_id}}"
                                                        class="btn btn-danger btn-xs btn-icon delete-confirm"><i
                                                            class="uil uil-trash-alt"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>

                                <!--start createForm modal-->
                                <div class="modal fade" id="add_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="mb-0">{{ __('settings.add_email_group')}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">X</button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="create_form" class="needs-validation" novalidate>
                                                    <div class="mb-3">
                                                        <label class="form-label">{{ __('settings.group_name')}}<span
                                                                class="text-danger">*</span></label>
                                                        <input name="create_group_name" id="create_group_name"
                                                            type="text" class="form-control "
                                                            placeholder="{{ __('settings.group_placeholder')}}"
                                                            required>
                                                        <span class="text-danger add_group_name"></span>
                                                        <div class="invalid-feedback">
                                                            {{ __('settings.group_name_error')}}
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">{{ __('settings.group_key')}}<span
                                                                class="text-danger">*</span></label>
                                                        <input name="create_group_key" id="create_group_key" type="text"
                                                            class="form-control "
                                                            placeholder="{{ __('settings.group_key_placeholer')}} "
                                                            required>
                                                        <span class="text-danger"></span>
                                                        <div class="invalid-feedback">
                                                            {{ __('settings.group_key_error')}}
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <input type="submit" id="add_submit_btn" name="send"
                                                            class="btn btn-primary" value="{{ __('common.submit')}}">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end createForm modal-->

                                <!--start updateForm modal-->
                                <div class="modal fade" id="edit_modal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="mb-0">{{ __('settings.update_email_group')}} </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">X</button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="edit_form_id" class="needs-validation" novalidate>
                                                    <input type="hidden" class="form-control name" id="edit_group">
                                                    <div class="mb-3">
                                                        <label class="form-label">{{ __('settings.group_name')}}<span
                                                                class="text-danger">*</span></label>
                                                        <input name="group_name" id="group_name" type="text"
                                                            class="form-control"
                                                            placeholder="{{ __('settings.group_placeholder')}}"
                                                            required>
                                                        <div class="invalid-feedback">
                                                            {{ __('settings.group_name_error')}}
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">{{ __('settings.group_key')}}<span
                                                                class="text-danger">*</span></label>
                                                        <input name="group_key" id="group_key" type="text"
                                                            class="form-control"
                                                            placeholder="{{ __('settings.group_key_placeholer')}} "
                                                            required>
                                                        <div class="invalid-feedback">
                                                            {{ __('settings.group_key_error')}}
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <input type="submit" id="update_btn" name="send"
                                                            class="btn btn-primary  " value="{{ __('common.update')}}">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end updateForm modal-->

                                <!--start delete modal-->
                                <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{
                                                    __('settings.delete_email_group')}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">X</button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Are you sure want to delete ?</h5>
                                                <input type="hidden" id="delete_group_id" name="input_field_id">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">{{ __('settings.close')}}</button>
                                                <button type="submit" class="btn btn-primary delete_group">{{
                                                    __('common.delete')}} </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end delete modal-->
                            </div>
                                <!--paginaion open -->
                            <div class="row text-center px-2  mb-4">
                                <!-- PAGINATION START -->
                                <div class="col-12 mt-4">
                                    <div class="d-md-flex align-items-center text-center justify-content-between">
                                        <span class="text-muted me-3">Showing {{$email_group->currentPage();}} -
                                            {{$email_group->lastItem();}} out of {{$email_group->total()}}</span>
                                        <ul class="pagination mb-0 justify-content-center mt-4 mt-sm-0">
                                            {{ $email_group->links() }}
                                        </ul>
                                    </div>
                                </div>
                                <!-- PAGINATION END -->
                            </div>
                            <!--paginaion close -->
                        </div>
                        <!--end col-->
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!--end container-->


    @push('scripts')


    <!-- start add ajax -->
    <script>
        $(document).ready(function () {
            $("#add_group_btn").on('click', function (e) {
                e.preventDefault();
                $("#add_modal").modal('show');

            });
       
            $(document).on('submit', '#create_form', function(e){
                e.preventDefault();
           
                var data = {
                    group_name: $("#create_group_name").val(),
                    group_key: $("#create_group_key").val(),
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{route('email-group.store')}}",
                    data: data,
                    dataType: "json",

                    success: function (response) {
                        Toaster(response.success);
                        $('#add_modal').modal('hide');
                        $('#add_group_btn').trigger('reset')
                        $("#email_group_table").load(location.href + " #email_group_table");
                        $('.flash-message').fadeOut(3000, function() {
                            location.reload(true);
                        });
                        if (response.status == 400) {
                            $.each(response.errors, function (key, err_val) {
                                $('.add_' + key).text(err_val);

                            });
                        };
                    },
                    error: function (response) {
                        let errortext = response.responseJSON;
                        $.each(errortext, function (i, v) {
                            console.log(v.group_key);
                        });
                    }

                });
            });
        });
    </script>
    <!-- end add ajax -->

    <!--edit ajax-->
    <script>
        $(document).on("click", "#edit_btn", function (e) {
            e.preventDefault();
            var groupId = $(this).val();

            $('#edit_modal').modal('show');

            $.ajax({
                url: "email-group/" + groupId + "/edit",
                type: "GET",
                success: function (response) {
                    if (response.status == 400) {
                        $('#errorlist').html("");
                        $('#errorlist').addClass("alert alert-danger");
                        $('#errorlist').append('<li>' + response.message + '</li>');

                    } else {
                        $('#group_name').val(response.group_name);
                        $('#group_key').val(response.group_key);
                        $('#edit_group').val(groupId);

                    }
                }
            });

        });
    </script>
    <!--end edit ajax-->

    <!--start update ajax-->
    <script>
        $(document).ready(function () {


            $(document).on("submit", "#edit_form_id", function (e) {
                e.preventDefault();

                var groupid = $("#edit_group").val();

                var data = {
                    group_name: $('#group_name').val(),
                    group_key: $('#group_key').val(),
                    group_id: $('#edit_group').val(),
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{route('updatedata')}}",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        $('#edit_form').trigger("reset");
                        $('#edit_modal').modal('hide');
                        Toaster('Group Updated Successfully!');
                              setTimeout(function () {
                                location.reload(true);
                                }, 3000);
                    }
                });
            });
        });
    </script>
    <!--end update ajax-->

    <!-- start delete ajax-->
    <script>
        $(document).ready(function () {

            $(document).on("click", "#delete_btn", function () {
                var group_id = $(this).val();

                $('#delete_group_id').val(group_id);
                $('#delete_modal').modal('show');
            });

            $(document).on('click', '.delete_group', function () {
                var group_id = $('#delete_group_id').val();
                // console.log(group_id);
                $('#delete_modal').modal('show');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{route('ajax-groupDelete')}}",
                    data: {
                        group_id: group_id
                    },
                    dataType: "json",
                    success: function (response) {
                     
                        Toaster('Group Deleted Successfully!');
                                  setTimeout(function () {
                                    location.reload(true);
                                    }, 3000);
                        $('#delete_modal').modal('hide');

                    }
                });
            });
        });
    </script>
    <!--end delete ajax-->
    @endpush

</x-app-layout>