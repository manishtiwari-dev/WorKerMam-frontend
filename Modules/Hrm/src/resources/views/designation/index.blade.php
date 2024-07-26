<x-app-layout>
    @section('title', $pageTitle)

    {{-- @dd($data); --}}


    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')

    <div class="card contact-content-body">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="tx-15 mg-b-0">Designation List</h6>
                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                    <a href="#designation_add" data-bs-toggle="modal" class="btn btn-sm btn-bg btn-primary"><i data-feather="plus"
                            class="mg-r-5"></i>{{ __('user-manager.add_designation') }}</a>
                @endif
            </div>
        </div>
            <div class="card-body">
                {{-- <form action="{{ route('hrm.designation.index') }}" method="get">

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

                <div class="table-responsive">
                    <table class="table  table_wrapper">
                        <thead>
                            <tr>
                                <th>{{ __('common.sl_no') }}</th>
                                <th >{{ __('user-manager.designation') }}</th>
                                <th >{{ __('common.status') }}</th>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                <th class="text-center ">{{ __('common.action') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($content->data))
                                @forelse($content->data as $key=>$designation)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $designation->designation_name }}</td>
                                        <td  class=" justify-content-center">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input toggle-class"
                                                    {{ $designation->status == '1' ? 'checked' : '' }}
                                                    data-id="{{ $designation->designation_id }}"
                                                    id="customSwitch{{ $designation->designation_id }}">
                                                <label class="custom-control-label"
                                                    for="customSwitch{{ $designation->designation_id }}"></label>
                                            </div>
                                        </td>
                                     
                                        <td class="align-items-center justify-content-center d-flex gap-2">
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                                <a href="#designation_edit"
                                                    class="btn btn-sm  d-flex align-items-center px-0 mg-r-5"
                                                    data-id="{{ $designation->designation_id }}" id="editmodal"
                                                    data-bs-toggle="modal"><i data-feather="edit-2"></i>
                                                </a>
                                            @endif
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'remove') == 'true')
                                            <a href="" data-bs-toggle="modal" id="delete_btn"
                                                class="btn btn-sm  d-flex align-items-center px-0 "
                                                data-id="{{ $designation->designation_id }}"><i
                                                    data-feather="trash"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <h5 class="text-center mb-0 py-1">No Record Found !.</h5>
                                        </td>
                                    </tr>
                                @endforelse
                            @endif
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
            route('hrm.designation.index'),
        ) !!}
        <!--Pagination End-->
    </div>
    @endif
    <!-- start designation add modal -->
    <div class="modal fade" id="designation_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('user-manager.add_designation') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add_userForm" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('user-manager.designation') }}<span
                                        class="text-danger">*</span></label>
                                <input name="designation_name" id="designation_name" type="text" class="form-control"
                                    placeholder="{{ __('user-manager.designation_placeholder') }}" required>
                                {{-- <div class="invalid-feedback">
                                Please Enter Designation Name
                            </div> --}}
                                <span class="text-danger">
                                    @error('designation_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('user-manager.designation_name_error') }}
                                </div>
                            </div>
                        </div>
                        <input type="submit" id="add_submit_btn" name="send" class="btn btn-primary"
                            value=" {{ __('common.submit') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end designation add modal -->


    <!-- start designation edit modal -->
    <div class="modal fade" id="designation_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('user-manager.update_designation') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="update_userForm" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <input name="designation_id" id="design_id" type="hidden" class="form-control">
                        <div>
                            <div class="form-group">
                                <label class="form-label">{{ __('user-manager.designation') }}<span
                                        class="text-danger">*</span></label>
                                <input name="designation_name" id="edit_design_name" type="text"
                                    class="form-control"
                                    placeholder="{{ __('user-manager.designation_placeholder') }}" required>
                                <span class="text-danger">
                                    @error('designation_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('user-manager.designation_name_error') }}
                                </div>
                            </div>
                        </div>
                        <input type="submit" id="update_btn" class="btn btn-primary"
                            value="{{ __('common.update') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end designation edit modal -->

    <!--start designation delete modal-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel5">{{ __('user-manager.delete_designation') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>{{ __('user-manager.are_you_sure') }}</h6>
                    <input type="hidden" id="delete_designation_id" name="input_field_id">
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
    <!--end designation delete modal-->
    @push('scripts')
        <script>
            $(document).ready(function() {

                // start designation-add ajax
                $(document).on('click', "#add_submit_btn", function(e) {
                    e.preventDefault();
                    $('#add_userForm').addClass('was-validated');
                    if ($('#add_userForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            designation_name: $("#designation_name").val(),
                        };
                        console.log(data);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ route('hrm.designation.store') }}",
                            data: data,
                            dataType: "json",
                            success: function(response) {


                                if (response.success) {
                                 Toaster("success", response.success);

                                 setTimeout(function() {
                                     location.reload(true);
                                 }, 3000);
                                 window.location.href =
                                     "{{ route('hrm.designation.index') }}";

                             } else {
                                 Toaster("error", response.error);
                             }


                                // Toaster(response);
                                // setTimeout(function() {
                                //     location.reload();
                                // }, 1000)
                            },
                        });
                    }
                });

                // start designation-edit ajax
                $(document).on("click", "#editmodal", function(e) {
                    e.preventDefault();
                    var designation_id = $(this).data('id');
                    $.ajax({
                        url: "designation/" + designation_id + "/edit",
                        type: "GET",
                        success: function(response) {
                            console.log(response);
                            $('#edit_design_name').val(response.designation_name);
                            $('#design_id').val(response.designation_id);
                        }
                    });
                });
                // end designation-edit ajax


                // start designation-update ajax
                $(document).on("click", "#update_btn", function(e) {
                    e.preventDefault();
                    $('#update_userForm').addClass('was-validated');
                    if ($('#update_userForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            designation_id: $("#design_id").val(),
                            designation_name: $("#edit_design_name").val(),
                        }
                        console.log(data);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ url('hrm/designation/Update') }}",
                            data: data,
                            dataType: "json",
                            success: function(response) {
                                console.log(response);
                                if (response.success) {
                                 Toaster("success", response.success);

                                 setTimeout(function() {
                                     location.reload(true);
                                 }, 3000);
                                 window.location.href =
                                     "{{ route('hrm.designation.index') }}";

                             } else {
                                 Toaster("error", response.error);
                             }
                            }
                        });
                    }
                });
                // end designation-update ajax


                // start designation-status ajax
                $('.toggle-class').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 0;
                    let designation_id = $(this).data('id');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('hrm.changedesignationStatus') }}",
                        data: {
                            'status': status,
                            'designation_id': designation_id
                        },
                        success: function(response) {
                           
                            if (response.success) {
                                 Toaster("success", response.success);

                                 setTimeout(function() {
                                     location.reload(true);
                                 }, 3000);
                                 window.location.href =
                                     "{{ route('hrm.designation.index') }}";

                             } else {
                                 Toaster("error", response.error);
                             }
                        }
                    });
                });
                // end designation-status ajax


                // start designation-delete ajax
                $(document).on("click", "#delete_btn", function() {
                    var designation_id = $(this).data('id');
                    $('#delete_designation_id').val(designation_id);
                    $('#delete_modal').modal('show');

                });
                $(document).on('click', '.delete_submit_btn', function() {
                    var designation_id = $('#delete_designation_id').val();
                    $('#delete_modal').modal('show');


                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('hrm/designationDestroy') }}/" + designation_id,
                        data: {
                            designation_id: designation_id
                        },
                        dataType: "json",
                        success: function(response) {

                            if (response.success) {
                                 Toaster("success", response.success);

                                 setTimeout(function() {
                                     location.reload(true);
                                 }, 3000);
                                 window.location.href =
                                     "{{ route('hrm.designation.index') }}";

                             } else {
                                 Toaster("error", response.error);
                             }





                            // Toaster(response);
                            // setTimeout(function() {
                            //     location.reload();
                            // }, 1000);
                        }
                    });
                });
                // end designation-delete ajax

            });
        </script>
    @endpush
</x-app-layout>
