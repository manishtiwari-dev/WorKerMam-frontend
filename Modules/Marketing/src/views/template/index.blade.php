<x-app-layout>
    @section('title',  $pageTitle)

<!--index table start-->
<div class="card contact-content-body">
    <div class="card-header">
        <div class="d-flex align-items-center justify-content-between">
            <h6 class="tx-15 mg-b-0">{{ __('newsletter.template_group')}}</h6>
            <a href="#open_modal" id="addbutton" data-bs-toggle="modal" class="btn btn-sm btn-bg"><i data-feather="plus"></i>{{ __('newsletter.add_group')}}</a>
        </div>
    </div>
    <div class="card-body">
        <div class="form-row">
            <div class="form-group col-2 col-lg-1 col-sm-3">
                <select class="form-control select2">
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
        </div>
        <div class="table-responsive"> 
            @if(!empty($content->data) && sizeof($content->data)>0)
            <table class="table  table_wrapper" id="template_data_reload">
                <thead>
                    <tr>
                        <th>{{ __('common.sl_no') }}</th>
                        <th>{{ __('newsletter.group_name')}}</th>
                        <th>{{ __('common.status') }}</th>
                        <th class="text-center wd-10p">{{ __('common.action') }}</th>
                    </tr>
                </thead>
                <tbody id="Search_Tr">
                    @if (!empty($content->data))
                    @foreach ($content->data as $key => $template_group)
                    <tr> 
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $template_group->group_name }}</td>
                        <td>
                            <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input toggle-class" {{ $template_group->status == '1' ? 'checked' : '' }} data-id="{{$template_group->id}}" id="customSwitch{{$template_group->id}}">
                            <label class="custom-control-label" for="customSwitch{{$template_group->id}}"></label>
                            </div>
                        </td>
                        <td class="d-flex align-items-center">
                            <a href="{{ route('TemplateLists', $template_group->id) }}"><button class="btn btn-sm btn-white d-flex align-items-center mg-r-5"><i data-feather="eye"></i></button></a>
                            <button class="btn btn-sm btn-white d-flex align-items-center mg-r-5"
                            value="{{ $template_group->id }}" id="editbutton" data-bs-toggle="modal" data-bs-target="#open_modal_edit">
                            <i data-feather="edit-2"></i></button>

                            <button data-id="{{ $template_group->id }}" data-bs-toggle="modal" data-bs-target="#delete_modal" class="btn btn-sm btn-white d-flex align-items-center mg-r-5 del_button"><i data-feather="trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            @else
            <div class="table-responsive">
                <table class="table border table_wrapper">
                    <thead>
                        <tr>
                            <th>{{ __('common.sl_no') }}</th>
                            <th>{{ __('newsletter.group_name') }}</th>
                            <th>{{ __('common.status') }}</th>
                            <th class="text-center wd-10p">{{ __('common.action') }}</th>
                        </tr>
                    </thead>
                    <tbody >
                        <tr>
                            <td>1</td>
                            <td>TEMPLATE</td>
                            <td>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input toggle-class" {{'1' == '1' ? 'checked' : '' }} data-id="1" id="customSwitch.'1'">
                                    <label class="custom-control-label" for="customSwitch.'1'"></label>
                                </div>
                            </td>
                            <td class="d-flex align-items-center">
                                <a href="{{ route('marketing.TemplateLists', '1') }}"><button class="btn btn-sm btn-white d-flex align-items-center mg-r-5"><i data-feather="eye"></i></button></a>

                                <button class="btn btn-sm btn-white d-flex align-items-center mg-r-5"
                                value="1" id="editbutton" data-bs-toggle="modal" data-bs-target="#open_modal_edit">
                                <i data-feather="edit-2"></i></button>

                                <button data-id="1" data-bs-toggle="modal" data-bs-target="#delete_modal" class="btn btn-sm btn-white d-flex align-items-center mg-r-5 del_button"><i data-feather="trash"></i></button>
                            </td>   
                        </tr>
                        <tr>
                            <td colspan="5">
                                <h5 class="text-center mb-0 py-1">{{ __('common.no_record') }}</h5>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
<!--end index table-->

<!--start add modal-->
<div class="modal fade" id="open_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">{{ __('newsletter.add_template_group')}}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="add_form" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <label class="form-label">{{ __('newsletter.group_name')}}
                            <span class="text-danger">*</span></label>
                            <input name="group_name" id="add_group_name" type="text" class="form-control" placeholder="{{ __('newsletter.group_name_placeholder')}}" required>
                            <div class="invalid-feedback">
                                {{ __('newsletter.group_name_error')}}
                            </div>
                            <span class="text-danger">
                                @error('group_name')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <label class="form-label">{{ __('newsletter.details')}}</label>
                            <input name="details" id="add_details" type="text" class="form-control" placeholder="{{ __('newsletter.details_placeholder')}}" >
                            <div class="invalid-feedback">
                                {{ __('newsletter.details_error')}}
                            </div>
                            <span class="text-danger">
                                @error('details')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <!--end row-->
                    <input type="submit" id="submit" name="send" class="btn btn-primary" value="{{ __('common.submit')}}">
                </form>
            </div>
        </div>
    </div>
</div> 
<!--end add modal-->
   
<!-- start edit modal-->
<div class="modal fade" id="open_modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">{{ __('newsletter.update_template_group')}}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="update_userForm" class="needs-validation" novalidate>
                    @csrf
                    <input name="hidden_id" id="hidden_id" type="hidden" class="form-control" placeholder="">
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <label class="form-label">{{ __('newsletter.group_name')}}
                            <span class="text-danger">*</span></label>
                            <input name="group_name" id="update_group_name" type="text" class="form-control" placeholder="{{ __('newsletter.group_name_placeholder')}}" required>
                            <div class="invalid-feedback">
                                {{ __('newsletter.group_name_error')}}
                            </div>
                            <span class="text-danger">
                                @error('group_name')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <label class="form-label">{{ __('newsletter.details')}}</label>
                            <input name="details" id="update_details" type="text" class="form-control" placeholder="{{ __('newsletter.details_placeholder')}}">
                            <div class="invalid-feedback">
                                {{ __('newsletter.details_error')}}
                            </div>
                            <span class="text-danger">
                                @error('details')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <!--end row-->
                    <input type="submit" id="update_btn" name="send" class="btn btn-primary" value="{{ __('common.update')}}">
                </form>
            </div>
        </div>
    </div>
</div> 
 <!-- end updated mpdal-->

<!--strat delete modal-->
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel5">{{ __('newsletter.delete_template_group')}}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>{{ __('common.delete_confirmation') }}</h6>
                <input type="hidden" id="delete_id" name="input_field_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                {{ __('common.no')}}
                </button>
                <button type="submit" class="btn btn-primary delete_gkey">{{ __('common.yes') }}</button>
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
            
        });

        // start add modal ajax
        $(document).on('click', "#submit",function(e) {
                e.preventDefault();
            $('#add_form').addClass('was-validated');
            if ($('#add_form')[0].checkValidity() === false) {
                event.stopPropagation();
            } else {
                var data = {
                    name: $("#add_group_name").val(),
                    description: $("#add_details").val(),
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('marketing.template-group-list.store') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        $("#template_data_reload").load(location.href + " #template_data_reload");
                        $("#reload_pagination_template").load(location.href + " #reload_pagination_template");
                        $('#addbutton').trigger("reset");
                        $('#open_modal').modal('hide')
                    },
                    error: function(response) {
                        var errors = data.responseJSON;
                        // console.log(errors);
                    }
                });
            }
            
        });

        // end add modal ajax

        // start edit modal ajax
        $(document).on("click", "#editbutton", function(e) {
            e.preventDefault();
            var id = $(this).val();
            $('#open_modal_edit').modal('show');
            $.ajax({
                url: "marketing/template-group-list/" + id + "/edit",
                type: "GET",
                success: function(response) {
                    console.log(response)
                    if (response.status == 400) {
                        $('#errorlist').html("");
                        $('#errorlist').addClass("alert alert-danger");
                        $('#errorlist').aapend('<li>' + response.message + '</li>');
                    } else {
                        $('#update_group_name').val(response.group_name);
                        $('#update_details').val(response.description);
                        $('#hidden_id').val(response.id);
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
                var id = $("#hidden_id").val();
                // alert(id);
                var data = {
                    name: $('#update_group_name').val(),
                    description: $('#update_details').val(),
                    id: $('#hidden_id').val(),
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('marketing/marketing/template-update') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        // location.reload();
                        $("#template_data_reload").load(location.href + " #template_data_reload");
                        $('#open_modal_edit').modal('hide');
                        Toaster(response.success);
                    }
                });
            }
        });
        // end update ajax

        // change status in ajax code start
        $('.toggle_class').change(function(e) {
            e.preventDefault();
            let status = $(this).prop('checked') === true ? 1 : 0;
            let id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('marketing/template-status') }}",
                data: {
                    'status': status,
                    'id': id
                },
                success: function(data) {
                    // location.reload();
                    Toaster(data.success);
                }
            });
        });
        // chenge status in ajax code end  


        $(document).ready(function() {
            $('.del_button').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var id = $('#delete_id').val(id);

                $('#delete_modal').modal('show');
            });

            $(document).on("click", ".delete_gkey", function() {
                var id = $('#delete_id').val();
                $('#delete_modal').modal('hide');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ url('marketing/template-delete') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        $("#template_data_reload").load(location.href + " #template_data_reload");
                        $("#reload_pagination_template").load(location.href + " #reload_pagination_template");
                        $('#delete_modal').modal('hide');
                        Toaster(response.success);

                    }
                });
            });
        });
        // end delete modal ajax
    </script>
    @endpush
</x-app-layout>
