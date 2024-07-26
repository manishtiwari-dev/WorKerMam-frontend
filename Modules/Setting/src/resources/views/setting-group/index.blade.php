<x-app-layout>  
    <div class="container-fluid">
        <div class="layout-specing">         
            <div class="row ">
                <div class="col-md-12 col-lg-12 my-2 lead_list">
                    <div class="card rounded shadow pb-5">
                        <div class=" border-0 quotation_form">
                            <div class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mb-0">{{ __('settings.setting_group_list')}}</h5>
                                <div>
                                    <button class="btn btn-primary" id="addbutton"><i data-feather="plus" class="lead_icon mg-r-5"></i>{{ __('settings.add_group')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-outline">
                            <div class="col-lg-12 px-4 pt-4" id="form1">
                                <div class="row align-item-center">
                                    <div class="col-sm-2">
                                        <select class="form-select" aria-label="Default select example">
                                            <option>10</option>
                                            <option>20</option>
                                            <option>30</option>
                                            <option>40</option>
                                            <option>50</option>
                                        </select>
                                            {{-- {!! Form::open([ 'url' => route('setting_group_list'), 'method' => 'get' ]) !!}
                                            {!! Form::select( 'per_page', [ '10' => '10', '20' => '20', '30' => '30', '100' => '100'], '10', array('onchange' => "submit()") ) !!}    
                                            {!! Form::close() !!} --}}
                                    </div>
                                    <div class="col-lg-4 float-end"><input type="text" id="Search" class="form-control col-lg-3 fas fa-search" placeholder="{{ __('settings.search_placeholder')}}" aria-label="Search">
                                    </div>
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="table-responsive shadow rounded ">
                                    <table class="table table-center bg-white mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom" style="min-width:70px;">{{ __('common.sl_no')}}</th>
                                                <th class="border-bottom" style="min-width: 150px;">{{ __('settings.group_name')}}</th>
                                                <th class="border-bottom" style="min-width: 150px;">{{ __('settings.access_privilege')}}</th>
                                                <th class="border-bottom" style="min-width: 150px;">{{ __('settings.sort_order')}}</th>
                                                <th class="border-bottom" style="min-width: 100px;">{{ __('common.status')}}</th>
                                                <th class="text-center border-bottom" style="min-width: 150px;">{{ __('common.action')}}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="Search_Tr">
                                            <!-- Start -->
                                            @if (!empty($setting_group_list))
                                            @foreach ($setting_group_list as $key => $setting_group)
                                            <tr>
                                                <td class="">{{ $key + 1 }}</td>
                                                <td class="">{{ $setting_group->group_name }}</td>
                                                <td class="">
                                                    @if ($setting_group->access_privilege == 0)
                                                    {{ 'Common' }}
                                                    @endif
                                                    @if ($setting_group->access_privilege == 1)
                                                    {{ 'Admin' }}
                                                    @endif
                                                    @if ($setting_group->access_privilege == 2)
                                                    {{ 'Super Admin' }}
                                                    @endif
                                                </td>

                                                <td class="">
                                                    <input type="number" class="col-xs-1 setting_sort_order width1" data-id="{{ $setting_group->group_id }}" value="{{ $setting_group->sort_order }}" placeholder="" style="width:50px;">
                                                </td>

                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input id="loader" data-id="{{ $setting_group->group_id }}" class="form-check-input toggle-class" type="checkbox" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $setting_group->status ? 'checked' : '' }}>
                                                    </div>
                                                </td>

                                                <td class="p-3 d-flex">
                                                    <a href="{{ route('app-setting-group-key', $setting_group->group_id) }}" class="btn btn-primary btn-xs btn-icon table_btn"><i class="uil uil-eye"></i></a>

                                                    <button class="btn btn-primary btn-xs btn-icon table_btn edit_temp_btn" id="editbutton" value="{{ $setting_group->group_id }}" data-toggle="modal" data-target="#open_modal_edit">
                                                        <i class="uil uil-edit">
                                                        </i>
                                                    </button>
                                                    <button href="javascript:void(0)" id="delete_btn" data-id="{{ $setting_group->group_id }}" data-toggle="modal" data-target="#delete_modal" class="btn btn-danger btn-xs btn-icon del_button"><i class="uil uil-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>                          
                        </div>
                    
                    <!--paginaion open -->
                    <div class="row text-center px-4" id="pagination_setting_group">
                        <div class="col-12">
                            <div class="d-md-flex align-items-center text-center justify-content-between">
                                <span class="text-muted me-3">Showing {{$setting_group_list->currentPage();}} -
                                    {{$setting_group_list->lastItem();}} out of {{$setting_group_list->total()}}</span>
                                <ul class="pagination mb-0 justify-content-center mt-4 mt-sm-0">
                                    {{ $setting_group_list->links() }}
                                </ul>
                            </div>
                        </div>
                    </div><!--paginaion close --> 
                </div>
                </div>
            </div><!--end col-->           
        </div>
    </div><!--end row-->
    
    <!--start add modal-->
    <div class="modal fade" id="open_modal" tabindex="-1" aria-labelledby="  exampleModalLabel" aria-hidden="    true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header border-bottom p-3">
                    <h5 class="modal-title" id="exampleModalLabel"> {{ __('settings.add_setting_group')}}
                    </h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal">
                        <i class="uil uil-times fs-4 text-dark">
                        </i>
                    </button>
                </div>
                <div class="modal-body ">
                    <form id="userForm" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('settings.group')}}
                                        <span class="text-danger">*
                                        </span>
                                    </label>
                                    <div class="form-icon position-relative">
                                        <input name="group_name" id="add_group_name" type="text" class="form-control" placeholder="{{ __('settings.Group_placeholder')}}" required>
                                        <div class="invalid-feedback">
                                            {{ __('settings.group_error')}}
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
                                    <label class="form-label">{{ __('settings.access_privilege')}}
                                        <span class="text-danger">*
                                        </span>
                                    </label>
                                    <div class="form-icon position-relative">

                                        <select class="form-select form-control" name="access_privilege" id="Add_access_privilege" required="">
                                            <option selected disabled value="" disabled>{{ __('settings.access_previlege_select')}}</option>
                                            <option value="0">Common</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Super Admin</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            {{ __('settings.access_previlege_select')}}
                                        </div>
                                        <!-- laravel velidation open -->
                                        <span style="color:red;">
                                            @error('access_privilege')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                        <br>
                                        <!-- laravel velidation end -->
                                    </div>
                                </div>
                            </div> <!--end col-->           
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
    
    <!-- start edit modal-->
    <div class="modal fade" id="open_modal_edit" tabindex="-1" aria-labelledby="  exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header border-bottom p-3">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('settings.update_setting_group')}} </h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal">
                        <i class="uil uil-times fs-4 text-dark">
                        </i>
                    </button>
                </div>
                <div class="modal-body ">
                    <form id="update_userForm" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <input name="group_id" id="group_id" type="hidden" class="form-control ps-5" placeholder="">
                        <div class="row">
                            <div class="">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('settings.group')}}
                                        <span class="text-danger">*
                                        </span>
                                    </label>
                                    <div class="form-icon position-relative">
                                        <input name="group_name" id="update_group_name" type="text" class="form-control" placeholder="{{ __('settings.group_placeholder')}}" required>
                                        <div class="invalid-feedback">
                                            {{ __('settings.group_error')}}
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
                                    <label class="form-label">{{ __('settings.access_privilege')}}
                                        <span class="text-danger">*
                                        </span>
                                    </label>
                                    <div class="form-icon position-relative">
                                        <select class="form-select form-control" name="access_privilege" id="update_access_privilege" required="">
                                            <option selected disabled value="" disabled>{{ __('settings.access_privilege_select')}}</option>

                                            <option value="0">Common</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Super Admin</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            {{ __('settings.access_privilege_select')}}
                                        </div>
                                        <!-- laravel velidation open -->
                                        <span style="color:red;">
                                            @error('access_privilege')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                        <br>
                                        <!-- laravel velidation end -->
                                    </div>
                                </div>
                            </div><!--end col-->
                            
                        </div><!--end col-->
                        <div class="row">
                            <div class="col-sm-12" required>
                                <input type="submit" id="update_btn" name="send" class="btn btn-primary" value="{{ __('common.update')}}">
                            </div>          
                        </div> <!--end row-->   
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- end updated mpdal-->

    <!--strat delete modal-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('settings.delete_setting_group')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <h5>{{ __('settings.deleted_data')}} </h5>
                    <input type="hidden" id="delete_id" name="input_field_id">
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
            $("#Search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#Search_Tr tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

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

        // start add modal ajax
        $(document).ready(function() {
            $('#submit').on('submit', function(e) {
                e.preventDefault();
                var data = {
                    group_name: $("#add_group_name").val(),
                    access_privilege: $("#Add_access_privilege").val(),
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('app-setting-group.store') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        $("#pagination_setting_group").load(location.href + " #pagination_setting_group");
                        $('#addbutton').trigger("reset");
                        $('#open_modal').modal('hide')
                    },
                    error: function(response) {
                        var errors = data.responseJSON;
                        console.log(errors);

                    }
                });
            });
        });

        // end add modal ajax

        // start edit modal ajax
        $(document).on("click", "#editbutton", function(e) {
            e.preventDefault();
            var group_id = $(this).val();
            $('#open_modal_edit').modal('show');
            $.ajax({
                url: "app-setting-group/" + group_id + "/edit",
                type: "GET",
                success: function(response) {
                    if (response.status == 400) {
                        $('#errorlist').html("");
                        $('#errorlist').addClass("alert alert-danger");
                        $('#errorlist').aapend('<li>' + response.message + '</li>');
                    } else {
                        $('#update_group_name').val(response.group_name);
                        $('#update_access_privilege').val(response.access_privilege);
                        $('#group_id').val(group_id);
                    }
                }
            });
        });
        // end edit modal ajax

        // start update ajax
        $(document).on("click", "#update_btn", function(e) {
            e.preventDefault();
            $('#update_userForm').addClass('was-validated');
            if ($('#update_userForm')[0].checkValidity() === false) {
                event.stopPropagation();
            } else {
                var group_id = $("#group_id").val();
                var data = {
                    group_name: $('#update_group_name').val(),
                    access_privilege: $('#update_access_privilege').val(),
                    group_id: $('#group_id').val(),
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('app-setting-group-update') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        $('#open_modal_edit').modal('hide');
                        Toaster('Setting Group Updated Successfully!');
                        setTimeout(function() {
                            location.reload(true);
                        }, 3000);
                    }
                });
            }
        });
        // end update ajax

        // start sortorder ajax

        $(".setting_sort_order").on("blur", function(e) {
            e.preventDefault();
            var group_id = $(this).data('id');
            var sort_order = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ url('app-setting-group-sortorder') }}",
                data: {
                    group_id: group_id,
                    sort_order: sort_order
                },
                dataType: "json",
                success: function(data) {

                    Toaster('Sort order updated ');
                    $('#setting_sort_order').val(data.sort_order);
                    $('#setting_sort_order').val(data.sort_order);
                }
            });
        });
        // end sortoeder ajax

        // change status in ajax code start
        $('.toggle-class').change(function(e) {
            e.preventDefault();
            let status = $(this).prop('checked') === true ? 1 : 0;
            let group_id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('app-setting-group-status-change') }}",
                data: {
                    'status': status,
                    'group_id': group_id
                },
                success: function(data) {
                    // location.reload();
                    Toaster('App Setting Group Status Changed ');
                }
            });
        });
        // chenge status in ajax code end  


        $(document).ready(function() {
            $('.del_button').on('click', function(e) {
                e.preventDefault();
                var group_id = $(this).data('id');
                var group_id = $('#delete_id').val(group_id);
                $('#delete_modal').modal('show');
            });

            $(document).on("click", ".delete_gkey", function() {
                var group_id = $('#delete_id').val();
                $('#delete_modal').modal('hide');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ url('app-setting-group-delete') }}",
                    data: {
                        group_id: group_id
                    },
                    dataType: "json",
                    success: function(response) {
                        $("#pagination_setting_group").load(location.href + " #pagination_setting_group");
                        $('#delete_modal').modal('hide');
                        Toaster('Setting Group Deleted Successfully!');
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
    <!-- closed -->
</x-app-layout>
<!--end row-->