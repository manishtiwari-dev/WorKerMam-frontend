<x-app-layout>
    @section('title', $pageTitle)

    {{-- @dd($data_list); --}}
    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
        <div class="card groupData-content-body">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="tx-15 mg-b-0">{{ __('newsletter.contact_group') }}</h6>

                    <div class="d-flex gap-1">
                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                            <a href="#add_groupData_modal" data-bs-toggle="modal" class="btn btn-sm btn-bg btn-primary">
                                <i data-feather="plus"></i>{{ __('newsletter.add_group') }}
                            </a>

                            <a href="{{ route('marketing.contact-import') }}"
                                class="btn btn-sm btn-bg d-flex align-items-center mg-r-5 btn-primary">
                                <i data-feather="plus"></i>
                                <span class=" d-sm-inline mg-l-5">{{ __('newsletter.import') }}</span>
                            </a>
                        @endif

                    </div>
                </div>
            </div>

            <div class="card-body">

                <!--Filter Start-->
                <div class="row align-item-center mb-3 order-list-wrapper">
                    <div class="col-lg-10 mb-2 mb-lg-0 mb-md-0">
                        <input type="text" id="search" value="{{ $search ?? '' }}"
                            class="form-control fas fa-search" placeholder="Search..." aria-label="Search"
                            name="search">
                    </div>
                    <div class="col-lg-2 d-flex">
                        <div class="align-items-center ">
                            <a class="btn btn-primary px-5" href="{{ route('marketing.contact-group') }}" role="button">
                                {{ __('common.reset') }}
                            </a>
                        </div>
                    </div>
                </div>
                <!--Filter End-->

                <div class="table-responsive" id="contactGroup_listing">
                    @if (!empty($content->data_list))
                        <table class="table  table_wrapper">
                            <thead>
                                <tr>
                                    <th>{{ __('common.sl_no') }}</th>
                                    <th>{{ __('newsletter.group_name') }}</th>
                                    {{-- <th>{{ __('newsletter.No_of_groupData') }}</th> --}}
                                    <th>{{ __('common.status') }}</th>
                                    <th class="text-center wd-10p">{{ __('common.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($content->data_list))
                                    @foreach ($content->data_list as $key => $groupData)
                                        <tr>
                                            <td>{{ $content->current_page * $content->per_page + $key + 1 - $content->per_page }}
                                            </td>
                                            <td>{{ $groupData->group_name }}</td>
                                            {{-- <td>{{ count($groupDatagroupcount->where('group_id',$groupData->id)) }}</td> --}}
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input toggle-class"
                                                        {{ $groupData->status == '1' ? 'checked' : '' }}
                                                        data-id="{{ $groupData->id }}"
                                                        id="customSwitch{{ $groupData->id }}">
                                                    <label class="custom-control-label"
                                                        for="customSwitch{{ $groupData->id }}"></label>
                                                </div>
                                            </td>

                                            <td class="align-items-center justify-content-center d-flex gap-2">
                                                <a href="{{ route('marketing.contact-group-view', $groupData->id) }}"
                                                    value="{{ $groupData->id }}"
                                                    class="btn btn-sm  d-flex align-items-center mg-r-5 px-0">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>

                                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                                    <button type="button" value="{{ $groupData->id }}"
                                                        class="btn btn-sm  d-flex align-items-center px-0 mg-r-5 px-0"
                                                        value="1" id="edit_btn" data-bs-toggle="modal"
                                                        data-target="#edit_groupData_modal">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </button>
                                                @endif

                                                <button class="btn btn-sm  d-flex align-items-center px-0"
                                                    id="delete_btn" data-target="#delete_modal" data-bs-toggle="modal"
                                                    value="{{ $groupData->id }}">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>

                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                        <!--Pagination Start-->
                        {!! \App\Helper\Helper::make_pagination(
                            $content->total_records,
                            $content->per_page,
                            $content->current_page,
                            $content->total_page,
                            'marketing.contact-group',
                            ['start_date' => $content->start_date, 'end_date' => $content->end_date],
                        ) !!}
                        <!--Pagination End-->

                    @endif
                </div>
            </div>
        </div>
    @endif

    <!--start add modal-->
    <div class="modal fade" id="add_groupData_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header py-2">
                    <h4 class="modal-title" id="exampleModalLabel">{{ __('contact.add_contact_group') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="add_form" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('newsletter.group_name') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input name="group_name" id="group_name" type="text" class="form-control"
                                    placeholder="{{ __('newsletter.group_name_placeholder') }}" required>
                                <div class="invalid-feedback">
                                    {{ __('newsletter.group_name_error') }}
                                </div>
                                <span style="color:red;">
                                    @error('group_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('newsletter.details') }}</label>
                                <input name="details" id="details" type="text" class="form-control"
                                    placeholder="{{ __('newsletter.details_placeholder') }}">
                                <div class="invalid-feedback">
                                    {{ __('newsletter.details_error') }}
                                </div>
                                <span style="color:red;">
                                    @error('details')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <!--end row-->
                        <input type="submit" name="send" class="btn btn-primary groupData_submit"
                            value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end add modal-->

    <!--start edit modal-->
    <div class="modal fade" id="edit_groupData_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('contact.update_contact_group') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="groupEdit_form" novalidate>
                        <input name="input_field" id="input_field" type="hidden">
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('newsletter.group_name') }}
                                    <span class="text-danger">*</span></label>
                                <input name="group_name" id="update_group_name" type="text" class="form-control"
                                    placeholder="{{ __('newsletter.group_name_placeholder') }}" required>
                                <div class="invalid-feedback">
                                    {{ __('newsletter.group_name_error') }}
                                </div>
                                <span style="color:red;">
                                    @error('group_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('newsletter.details') }}</label>
                                <input name="details" id="update_details" type="text" class="form-control"
                                    placeholder="{{ __('newsletter.details_placeholder') }}">
                                <div class="invalid-feedback">
                                    {{ __('newsletter.details_error') }}
                                </div>
                                <span style="color:red;">
                                    @error('details')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <input type="submit" name="send" id="groupUpBtn" class="btn btn-primary "
                            value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end edit modal-->

    <!--start delete modal-->
    <div class="modal fade" id="delete_groupData_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel5" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel5">{{ __('common.delete') }}
                        {{ __('newsletter.contact_group') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>{{ __('common.delete_confirmation') }}</h6>
                    <input type="hidden" id="delete_groupData_id" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('common.no') }}
                    </button>
                    <button type="submit" class="btn btn-primary groupData_delete">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--end delete modal-->

    @push('scripts')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>

        <script>
            $(document).ready(function() {
              
                // add group data ajax start here
                $(document).on('click', ".groupData_submit", function(e) {
                    e.preventDefault();
                    $('#add_form').addClass('was-validated');
                    if ($('#add_form')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        $('.groupData_submit').attr('disabled', 'true');
                        var data = {
                            group_name: $("#group_name").val(),
                            details: $("#details").val(),
                        };

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ route('marketing.contact-group-store') }}",
                            data: data,
                            dataType: "json",

                            success: function(response) {
                                Toaster(response.status, response.message);
                                setTimeout(function() {
                                    location.reload(true);
                                }, 1000);
                            }
                        });
                    }
                });

                //group status change ajax start here

                $(document).on('change', '.toggle-class', function(e) {

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
                        url: "{{ route('marketing.changeContactGroupStatus') }}",
                        data: {
                            'status': status,
                            'group_id': group_id
                        },
                        success: function(data) {
                            Toaster('success', data.success);
                        }
                    });
                });

                //edit group data ajax start here
                $(document).on("click", "#edit_btn", function(e) {
                    e.preventDefault();
                    var group_id = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('marketing.contact-group-edit') }}",
                        type: "POST",
                        data: {
                            'group_id': group_id
                        },
                        success: function(response) {
                            console.log(response['1']);
                            $('#update_group_name').val(response['1'].group_name);
                            $('#update_details').val(response['1'].description);
                            $('#input_field').val(response['1'].id);
                        }
                    });
                });

                //update group data ajax start here
                $(document).on("click", "#groupUpBtn", function(e) {
                    e.preventDefault();
                    $('#groupEdit_form').addClass('was-validated');
                    if ($('#groupEdit_form')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        $('#groupUpBtn').attr('disabled', 'true');
                        var data = {
                            group_name: $("#update_group_name").val(),
                            details: $("#update_details").val(),
                            group_id: $('#input_field').val(),
                        }
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: "POST",
                            url: "{{ route('marketing.contactGroupUpdate') }}",
                            data: data,
                            dataType: "json",
                            success: function(response) {
                                Toaster(response.success);
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            }
                        });
                    }
                });
            });



            $(document).ready(function() {
                $("#search").on('keyup', function(e) {
                    if ((this.value).length >= 3 || (this.value).length == 0) {
                        tableWebContent('', '', this.value);
                    } 
                });
            });


            function tableWebContent(startDate = '', endDate = '', search = '') {
                const url = "{{ route('marketing.contactGroupFilter') }}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        start_date: startDate,
                        end_date: endDate,
                        search: search,
                    },
                    dataType: "json",
                    success: function(result) {
                        $("#contactGroup_listing").html(result.html);
                    }
                });
            }


            //  start delete ajax

            $(document).ready(function() {

                $(document).on("click", "#delete_btn", function() {
                    var group_id = $(this).val();
                    $('#delete_groupData_id').val(group_id);
                    $('#delete_groupData_modal').modal('show');
                });

                $(document).on('click', '.groupData_delete', function() {
                    var group_id = $('#delete_groupData_id').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "GET",
                        url: "{{ url('marketing/deleteContactGroup') }}/" + group_id,

                        success: function(response) {
                            Toaster(response.success);
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
