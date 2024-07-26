<x-app-layout>
    @section('title', 'Tax Setting')
    <div class="d-lg-none d-block">
        <h4>{{ $pageTitle }}</h4>
    </div>

    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
        <div class="card contact-content-body">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="tx-15 mg-b-0">{{ __('user-manager.tax-group') }}</h6>

                    <div class="d-flex gap-1">
                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                            <a href="javascript:voide(0);" id="addTaxGroup" class="btn btn-sm btn-primary btn-outline"><i
                                    class="fa fa-plus mg-r-5"></i>{{ __('user-manager.add_tax_group') }}
                            </a>
                            <a href="javascript:voide(0);" id="addTaxType" class="btn btn-sm btn-primary btn-outline"><i
                                    class="fa fa-plus"></i>{{ __('user-manager.add_tax_type') }}</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-row">
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
                        <input type="text" class="form-control" id="Search"
                            placeholder="{{ __('newsletter.search_placeholder') }}">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table  table_wrapper">
                        <thead>
                            <tr>
                                <th>{{ __('common.sl_no') }}</th>
                                <th>{{ __('user-manager.tax-group') }}</th>
                                <th>{{ __('user-manager.tax-component') }}</th>
                                <th>{{ __('common.status') }}</th>
                                <th class="text-center wd-10p">{{ __('common.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($content->data))
                                @forelse($content->data as $key=>$data_list)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data_list->tax_group_name }}</td>

                                        <td>
                                            @if (!empty($data_list->tax_info))
                                                @foreach ($data_list->tax_info as $key => $perlist)
                                                    @if (!empty($perlist->tax_typedetails))
                                                        {{ $perlist->tax_typedetails->tax_name }}
                                                    @endif{{ $perlist->tax_percent }}%
                                                @endforeach
                                            @endif
                                        </td>

                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input toggle-class"
                                                    {{ $data_list->status == '1' ? 'checked' : '' }}
                                                    data-id="{{ $data_list->tax_group_id }}"
                                                    id="customSwitch{{ $data_list->tax_group_id }}">
                                                <label class="custom-control-label"
                                                    for="customSwitch{{ $data_list->tax_group_id }}"></label>
                                            </div>
                                        </td>
                                        <td class="d-flex align-items-center gap-2 justify-content-center">
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                                <a href="{{ route('system-setting.tax-setting-view', $data_list->tax_group_id) }}"
                                                    class="btn btn-sm  table_btn py-1 px-2"> <i class="fa fa-eye"
                                                        aria-hidden="true"></i> </a>

                                                <a href="#designation_edit" class="btn btn-sm  table_btn py-1 px-2"
                                                    data-id="{{ $data_list->tax_group_id }}" id="editmodal"
                                                    data-bs-toggle="modal"><i data-feather="edit-2"></i></a>
                                            @endif

                                            <a href="#delete_modal" data-bs-toggle="modal" id="delete_btn"
                                                class="btn btn-sm  table_btn d-flex align-items-center mg-r-5  px-0"
                                                data-id="{{ $data_list->tax_group_id }}"><i
                                                    data-feather="trash"></i></a>
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
        </div>
    @endif


    <!--start designation delete modal-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel5">{{ __('user-manager.delete_designation') }}</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>{{ __('user-manager.are_you_sure') }}</h6>
                    <input type="hidden" id="delete_designation_id" name="input_field_id">
                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary delete_submit_btn">{{ __('common.yes') }}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('common.no') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--end designation delete modal-->



    {{-- Ajax Modal Start for --}}
    <div class="modal fade" id="addDepartmentModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="icon-plus"></i> @lang('app.department')</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true"><i
                            class="fa fa-times"></i></button>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- Ajax Modal Ends --}}


    <!-- start designation edit modal -->
    <div class="modal fade" id="designation_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Update Tax Group</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_userForm" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <input name="designation_id" id="design_id" type="hidden" class="form-control">
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">@lang('user-manager.tax-group-name')<span class="text-danger">*</span></label>
                                <input name="tax_group_name" id="edit_design_name" type="text"
                                    class="form-control" placeholder="@lang('user-manager.tax-group-name')" required>
                                <span class="text-danger">
                                    @error('tax_group_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('user-manager.tax_group_name') }}
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






    @push('scripts')
        <script>
            $(document).ready(function() {




                $(document).on("click", "#editmodal", function(e) {
                    e.preventDefault();
                    var tax_group_id = $(this).data('id');
                    $.ajax({
                        url: "tax-setting/" + tax_group_id + "/edit",
                        type: "GET",
                        success: function(response) {
                            console.log(response);
                            $('#edit_design_name').val(response.tax_group_name);
                            $('#design_id').val(response.tax_group_id);
                        }
                    });
                });


                //    start designation-update ajax
                $(document).on("click", "#update_btn", function(e) {
                    e.preventDefault();
                    $('#update_userForm').addClass('was-validated');
                    if ($('#update_userForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            tax_group_id: $("#design_id").val(),
                            tax_group_name: $("#edit_design_name").val(),
                        }
                        console.log(data);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ url('system-setting/tax-group/update') }}",
                            data: data,
                            dataType: "json",
                            success: function(response) {
                                console.log(response);
                                Toaster('success', response.success);
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            }
                        });
                    }
                });
                //  end designation-update ajax


                // change status open
                $('.toggle-class').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 0;
                    console.log(status);
                    let id = $(this).data('id');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('system-setting.changeStatus') }}",
                        data: {
                            'status': status,
                            'id': id
                        },
                        success: function(response) {

                            if (response.success) {
                                Toaster("success", response.success);

                                setTimeout(function() {
                                    location.reload(true);
                                }, 3000);
                                window.location.href =
                                    "{{ route('system-setting.tax-setting') }}";

                            } else {
                                Toaster("error", response.error);
                            }
                        }
                    });
                });


                // start designation-delete ajax
                $(document).on("click", "#delete_btn", function() {
                    var designation_id = $(this).data('id');
                    $('#delete_designation_id').val(designation_id);
                });
                // $(document).on('click', '.delete_submit_btn', function () {
                //     var tax_group_id = $('#delete_designation_id').val();

                //     $.ajaxSetup({
                //         headers: {
                //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //         }
                //     });
                //     $.ajax({
                //         type: "POST",
                //         url: "{{ url('system-setting/tax-setting/delete') }}/"+tax_group_id,
                //         data: {
                //             id: tax_group_id
                //         },
                //         dataType: "json",
                //         success: function (response) {
                //             Toaster(response);
                //             setTimeout(function(){
                //                 location.reload();
                //             },1000);
                //         }
                //     });
                // });


                $(document).on("click", ".delete_submit_btn", function(e) {
                    e.preventDefault();
                    var id = $('#delete_designation_id').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: "{{ route('system-setting.tax-group-delete') }}",
                        data: {
                            tax_group_id: id
                        },
                        dataType: "json",
                        success: function(response) {
                            Toaster('success', response.success);
                            setTimeout(function() {
                                location.reload();
                            }, 1000);

                        }
                    });
                });





                // end designation-delete ajax

            });
        </script>

        <script>
            $(document).ready(function() {

                $('#addTaxGroup').click(function() {
                    var url = "{{ route('system-setting.tax-group.create') }}";
                    $('.modal-title').html("<i class='icon-plus'></i>");

                    $.ajaxModal('#addDepartmentModal', url);
                    $('#addDepartmentModal').modal('show');
                });

                $('#addTaxType').click(function() {
                    var url = "{{ route('system-setting.tax-type.create') }}";
                    $('.modal-title').html("<i class='icon-plus'></i>");
                    $.ajaxModal('#addDepartmentModal', url);
                    $('#addDepartmentModal').modal('show');

                });


            });
        </script>
    @endpush
</x-app-layout>
