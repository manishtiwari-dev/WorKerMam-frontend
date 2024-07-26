<x-app-layout> 
    <div class="container-fluid">
        <div class="layout-specing">       
            <div class="row ">
                <div class="col-md-12 col-lg-12 my-2 lead_list">
                    <div class="card rounded shadow pb-5">
                        <div class=" border-0 quotation_form">
                            <div class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('settings.setting_group_key_list')}}</h5>
                                <div>
                                    <button class="btn btn-primary " id="addbutton"><i data-feather="plus" class="lead_icon mg-r-5"></i>{{ __('settings.add_group_key')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-outline">
                            <div class="col-lg-12 px-4 pt-4" id="form1">
                                <div class="row align-item-center">
                                    <div class="col-sm-2">
                                        <select class="form-select" aria-label="Default select example">
                                            <option>10</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 mt-3">
                                <div class="table-responsive shadow rounded ">
                                    <table class="table table-center bg-white mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom" style="min-width:70px;">{{ __('common.sl_no')}}</th>
                                                <th class="border-bottom" style="min-width: 100px;">{{ __('settings.setting_name')}}</th>
                                                <th class="border-bottom" style="min-width: 100px;">{{ __('settings.setting_key')}}</th>
                                                <th class="border-bottom" style="min-width: 100px;">{{ __('settings.setting_option')}}</th>
                                                <th class="border-bottom" style="min-width: 100px;">{{ __('settings.option_type')}}</th>
                                                <th class="border-bottom" style="min-width: 100px;">{{ __('settings.sort_order')}}</th>
                                                <th class="border-bottom" style="min-width: 100px;">{{ __('common.status')}}</th>
                                                <th class=" text-center border-bottom" style="min-width: 100px;">{{ __('common.action')}}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="Search_Tr">
                                            <!-- Start -->
                                            @if (!empty($setting_key_list))
                                            @foreach ($setting_key_list as $key => $setting_key)
                                            <tr>
                                                <td class="">{{ $key + 1 }}</td>
                                                <td class="">{{ $setting_key->setting_key }}</td>
                                                <td class="">{{ $setting_key->setting_name }}</td>
                                                <td class="">{{ $setting_key->setting_options }}</td>
                                                <td class="">{{ $setting_key->option_type }}</td>
                                                <td class="">
                                                    <input type="number" class="col-xs-1 Setting_Sort_Order width1" data-id="{{ $setting_key->setting_id }}" value="{{ $setting_key->sort_order }}" placeholder="" style="width:50px;">
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input id="loader" data-id="{{ $setting_key->setting_id }}" class="form-check-input toggle-class" type="checkbox" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $setting_key->status ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                                <td class="p-3 d-flex">
                                                    <input type="hidden" value="{{ $setting_key->group_id }}" name="" id="group_Id">
                                                    <button class="btn btn-primary btn-xs btn-icon table_btn" id="editbutton" value="{{ $setting_key->setting_id }}" data-toggle="modal" data-target="#open_modal_edit">
                                                        <i class="uil uil-edit"></i>
                                                    </button>
                                                    <button href="javascript:void(0)" id="delete_btn" data-id="{{ $setting_key->setting_id }}" data-toggle="modal" data-target="#delete_modal" class="btn btn-danger btn-xs btn-icon del_btn"><i class="uil uil-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->                  
                    <!--paginaion open -->
                    <div class="row text-center px-2  mb-4" id="pagination_setting_group_key">
                        <div class="col-12 mt-4">
                            <div class="d-md-flex align-items-center text-center justify-content-between">
                                <span class="text-muted me-3">Showing {{$setting_key_list->currentPage();}} -
                                    {{$setting_key_list->lastItem();}} out of {{$setting_key_list->total()}}</span>
                                <ul class="pagination mb-0 justify-content-center mt-4 mt-sm-0">
                                    {{ $setting_key_list->links() }}
                                </ul>
                            </div>
                        </div>
                    </div><!--paginaion close --> 
                </div><!--end row-->               
            </div>
        </div>
        <!--start add modal-->
        <div class="modal fade" id="open_modal" tabindex="-1" aria-labelledby="                      exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header border-bottom p-3">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('settings.add_setting_group_key')}}
                        </h5>
                        <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal">
                            <i class="uil uil-times fs-4 text-dark">
                            </i>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <form id="userForm" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('settings.group')}}
                                            <span class="text-danger">*
                                            </span>
                                        </label>
                                        <div class="form-icon position-relative">
                                            <select class="form-select form-control" name="group_id" id="add_group_id" required="">
                                                <option selected disabled value="" disabled>
                                                    {{ __('settings.group_select')}}
                                                </option>
                                                @foreach ($setting_group_list as $setting_list)
                                                <option value="{{ $setting_list->group_id }}" {{ $setting_list->group_id == $id ? 'selected' : '' }}>
                                                    {{ $setting_list->group_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{ __('settings.group_select')}}
                                            </div>
                                            <span style="color:red;">
                                                @error('group_name')
                                                {{ $message }}
                                                @enderror
                                            </span>
                                            <br>
                                        </div>
                                    </div>
                                </div><!--end col-->    
                                <div class="">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('settings.option_type')}}
                                            <span class="text-danger">*
                                            </span>
                                        </label>
                                        <div class="form-icon position-relative">
                                            <select class="form-select form-control" name="option_type" id="Add_option_type" required="">
                                                <option selected disabled value="" disabled>
                                                    {{ __('settings.option_type_select')}}
                                                </option>
                                                <option value="text">text</option>
                                                <option value="dropdown">dropdown</option>
                                                <option value="radio">radio</option>
                                                <option value="textarea">textarea</option>
                                                <option value="checkbox">checkbox</option>
                                                <option value="image">image</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                {{ __('settings.option_type_select')}}
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->       
                                <div class="">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('settings.setting_key')}}
                                            <span class="text-danger">*
                                            </span>
                                        </label>
                                        <div class="form-icon position-relative">
                                            <input name="setting_key" id="add_setting_key" type="text" class="form-control" placeholder="{{ __('settings.setting_key_placeholder')}}" required>
                                            <div class="invalid-feedback">
                                                {{ __('settings.setting_key_error')}}
                                            </div>
                                            <span style="color:red;">
                                                @error('group_name')
                                                {{ $message }}
                                                @enderror
                                            </span>
                                            <br>
                                        </div>
                                    </div>
                                </div><!--end col--> 
                                <div class="">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('settings.setting_name')}}
                                            <span class="text-danger">*
                                            </span>
                                        </label>
                                        <div class="form-icon position-relative">
                                            <input name="setting_name" id="add_setting_name" type="text" class="form-control" placeholder="{{ __('settings.setting_name_placeholder')}}" required>
                                            <div class="invalid-feedback">
                                                {{ __('settings.setting_name_error')}}
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </div><!--end col-->      
                                <div class="">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('settings.setting_option')}}
                                        </label>
                                        <div class="form-icon position-relative">
                                            <input name="setting_option" id="add_setting_option" type="text" class="form-control" placeholder="{{ __('settings.setting_option_placeholder')}}" required>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('settings.setting_hint')}}
                                        </label>
                                        <div class="form-icon position-relative">
                                            <input name="setting_hint" id="add_setting_hint" type="text" class="form-control" placeholder="{{ __('settings.setting_hint_placeholder')}}" required>
                                        </div>
                                    </div>
                                </div><!--end col-->     
                            </div><!--end row-->
                            <div class="row">
                                <div class="col-sm-12" required>
                                    <input type="submit" id="submit" name="send" class="btn btn-primary" value="{{ __('common.submit')}}">
                                </div>                              
                            </div><!--end row-->                      
                        </form>
                    </div>
                </div>
            </div>
        </div><!--end add modal-->
        
        <!-- start updated modal-->
        <div class="modal fade" id="open_modal_edit" tabindex="-1" aria-labelledby="                      exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header border-bottom p-3">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('settings.update_setting_group_key')}}
                        </h5>
                        <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal">
                            <i class="uil uil-times fs-4 text-dark">
                            </i>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <form id="update_userForm" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <input name="setting_id" id="setting_id" type="hidden" class="form-control ps-5">
                            <div class="row">
                                <div class="">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('settings.group')}}
                                            <span class="text-danger">*
                                            </span>
                                        </label>
                                        <div class="form-icon position-relative">
                                            <select class="form-select form-control" name="group_id" id="update_group_id" required="">
                                                <option selected disabled value="" disabled>
                                                    {{ __('settings.group_select')}}
                                                </option>
                                                @foreach ($setting_group_list as $setting_list)
                                                <option value="{{ $setting_list->group_id }}">
                                                    {{ $setting_list->group_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{ __('settings.group_select')}}
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </div><!--end col-->  
                                <div class="">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('settings.option_type')}}
                                            <span class="text-danger">*
                                            </span>
                                        </label>
                                        <div class="form-icon position-relative">
                                            <select class="form-select form-control" name="option_type" id="update_option_type" required>
                                                <option selected disabled value="" disabled>
                                                    {{ __('settings.option_type_select')}}
                                                </option>
                                                <option value="text">text</option>
                                                <option value="dropdown">dropdown</option>
                                                <option value="radio">radio</option>
                                                <option value="textarea">textarea</option>
                                                <option value="checkbox">checkbox</option>
                                                <option value="image">image</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                {{ __('settings.option_type_select')}}
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->  
                                <div class="">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('settings.setting_key')}}
                                            <span class="text-danger">*
                                            </span>
                                        </label>
                                        <div class="form-icon position-relative">
                                            <input name="setting_key" id="update_setting_key" type="text" class="form-control" placeholder="{{ __('settings.setting_key_placeholder')}}" required>
                                            <div class="invalid-feedback">
                                                {{ __('settings.setting_key_error')}}
                                            </div>
                                            <span style="color:red;">
                                                @error('group_name')
                                                {{ $message }}
                                                @enderror
                                            </span>
                                            <br>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('settings.setting_name')}}
                                            <span class="text-danger">*
                                            </span>
                                        </label>
                                        <div class="form-icon position-relative">
                                            <input name="setting_name" id="update_setting_name" type="text" class="form-control" placeholder="{{ __('settings.setting_name_placeholder')}}" required>
                                            <div class="invalid-feedback">
                                                {{ __('settings.setting_name_error')}}
                                            </div>
                                            <span style="color:red;">
                                                @error('group_name')
                                                {{ $message }}
                                                @enderror
                                            </span>
                                            <br>
                                        </div>
                                    </div>
                                </div><!--end col--> 
                                <div class="">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('settings.setting_option')}}
                                        </label>
                                        <div class="form-icon position-relative">
                                            <input name="setting_option" id="update_setting_option" type="text" class="form-control" placeholder="{{ __('settings.setting_option_placeholder')}}" required>
                                        </div>
                                    </div>
                                </div> <!--end col-->
                                <div class="">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('settings.setting_hint')}}
                                        </label>
                                        <div class="form-icon position-relative">
                                            <input name="setting_hint" id="update_setting_hint" type="text" class="form-control" placeholder="{{ __('settings.setting_hint_placeholder')}}" required>
                                        </div>
                                    </div>
                                </div><!--end col-->                               
                            </div><!--end row-->          
                            <div class="row">
                                <div class="col-sm-12" required>
                                    <input type="submit" id="btn_update" name="send" class="btn btn-primary" value="{{ __('common.update')}}">
                                </div><!--end col-->                              
                            </div>
                    </div><!--end row-->              
                    </form>
                </div>
            </div>
        </div>
    </div><!-- end updated mpdal-->

    <!--strat delete modal-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('settings.delete_setting_group_key')}}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <h5>{{ __('settings.deleted_data')}} </h5>
                    <input type="hidden" id="delete_gkey_id" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('common.no')}}</button>
                    <button type="submit" class="btn btn-primary delete_gkey">{{ __('common.yes')}} </button>
                </div>
            </div>
        </div>
    </div>
    <!--end delete modal-->

    @push('scripts')
    <script>
        // start jquery
        $(document).ready(function() {

            $(document).ready(function() {
                setTimeout(function() {
                    $("div.alert").remove();
                }, 3000);

            });
            $(document).ready(function() {
                $("#addbutton").on('click', function(e) {
                    e.preventDefault();
                    $("#open_modal").modal('show');
                });
            });
        });
    </script>
    <!--end status ajax-->

    <!--create ajax start-->
    <script>
        $(document).ready(function() {
            $("#submit").click(function(e) {
                e.preventDefault();
                var data = {
                    group_id: $("#add_group_id").val(),
                    setting_key: $("#add_setting_key").val(),
                    setting_name: $("#add_setting_name").val(),
                    setting_options: $("#add_setting_option").val(),
                    option_type: $("#Add_option_type").val(),
                    setting_hint: $("#add_setting_hint").val(),
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('app-setting-group-storekeydata') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        $("#pagination_setting_group_key").load(location.href + " #pagination_setting_group_key");
                        Toaster('Setting Group Added Successfully!');
                        setTimeout(function() {
                            location.reload(true);
                        }, 3000);
                        $('#addbutton').trigger("reset");
                        $('#open_modal').modal('hide');
                        $('.flash-message').html(response.success);
                        $('.flash-message').addClass('alert alert-success');
                        $('.flash-message').fadeOut(3000, function() {
                            location.reload(true);
                        });

                    },
                    error: function(response) {
                        var errors = data.responseJSON;
                        console.log(errors);
                        Toaster('app Setting Group Add Successfully');

                    }
                });
            });
        });

        // end add modal ajax
    </script>

    <script type="text/javascript">
        // start edit modal ajax
        $(document).on("click", "#editbutton", function(e) {
            e.preventDefault();
            var setting_id = $(this).val();
            // alert('hello');
            $('#open_modal_edit').modal('show');
            $.ajax({
                url: "{{ route('ajax-setting-group-key') }}",
                type: "GET",
                data: {
                    setting_id: setting_id
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == 400) {
                        $('#errorlist').html("");
                        $('#errorlist').addClass("alert alert-danger");
                        $('#errorlist').append('<li>' + response.message + '</li>');
                    } else {
                        $('#update_group_id').val(response.setting_key.group_id);
                        $('#update_option_type').val(response.setting_key.option_type);
                        $('#update_setting_key').val(response.setting_key.setting_key);
                        $('#update_setting_name').val(response.setting_key.setting_name);
                        $('#update_setting_option').val(response.setting_key.setting_options);
                        $('#update_setting_hint').val(response.setting_key.setting_hint);
                        $('#setting_id').val(setting_id);
                    }
                }
            });
        });
        // end edit modal ajax
    </script>

    <script type="text/javascript">
        // start update ajax
        $(document).on("click", "#btn_update", function(e) {
            e.preventDefault();

            $('#update_userForm').addClass('was-validated');
            if ($('#update_userForm')[0].checkValidity() === false) {
                event.stopPropagation();
            } else {
                var setting_id = $("#setting_id").val();
                var data = {
                    group_id: $('#update_group_id').val(),
                    option_type: $('#update_option_type').val(),
                    setting_key: $('#update_setting_key').val(),
                    setting_name: $('#update_setting_name').val(),
                    setting_option: $('#update_setting_option').val(),
                    setting_hint: $('#update_setting_hint').val(),
                    setting_id: $('#setting_id').val(),
                }
                console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('app-setting-group-key-update') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        $('#open_modal_edit').modal('hide');
                        Toaster('Setting Group Key Updated Successfully!');
                        setTimeout(function() {
                            location.reload(true);
                        }, 3000);

                    }
                });
            }
        });
        // end update ajax
    </script>

    <script type="text/javascript">
        // start sortorder ajax

        $(".Setting_Sort_Order").on("blur", function(e) {
            e.preventDefault();
            var setting_id = $(this).data('id');
            var sort_order = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ url('app-setting-group-key-sortorder') }}",
                data: {
                    setting_id: setting_id,
                    sort_order: sort_order
                },
                dataType: "json",
                success: function(data) {
                    Toaster('Sort order updated');
                    $('#Setting_Sort_Order').val(data.sort_order);
                    $('#Setting_Sort_Order').val(data.sort_order);

                }
            });
        });
        // end sortoeder ajax
    </script>

    <script type="text/javascript">
        // change status in ajax code start
        $('.toggle-class').change(function(e) {
            e.preventDefault();
            // alert('hihyu');
            let status = $(this).prop('checked') === true ? 1 : 0;
            let setting_id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('app-setting-group-key-status') }}",
                data: {
                    'status': status,
                    'setting_id': setting_id
                },
                success: function(data) {

                    // location.reload();
                    Toaster('App Setting Group Key Status Changed ');

                }
            });
        });
        // chenge status in ajax code end
    </script>

    <script type="text/javascript">
        // start delete modal ajax

        $(document).ready(function() {
            $('.del_btn').on('click', function(e) {
                e.preventDefault();
                var setting_id = $(this).data('id');
                var setting_id = $('#delete_gkey_id').val(setting_id);
                $('#delete_modal').modal('show');
            });

            $(document).on("click", ".delete_gkey", function() {
                var setting_id = $('#delete_gkey_id').val();
                $('#delete_modal').modal('hide');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ url('app-setting-group-key-delete') }}",
                    data: {
                        setting_id: setting_id
                    },
                    dataType: "json",
                    success: function(response) {
                        $("#pagination_setting_group_key").load(location.href + " #pagination_setting_group_key");
                        $('#delete_modal').modal('hide');
                        Toaster('Setting Group Key Deleted Successfully!');
                        setTimeout(function() {
                            location.reload(true);
                        }, 3000);

                    }
                });
            });
        });
        // end delete modal ajax
    </script>
    @endpush
    {{-- closed --}}
</x-app-layout>