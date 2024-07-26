<x-app-layout>
    @section('title',  $pageTitle)

    {{-- @dd($data_list); --}}
    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
    <div class="card groupData-content-body">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="tx-15 mg-b-0">{{ __('newsletter.contact_group') }}</h6>


                <div class="d-flex gap-1">
                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                    <a href="#add_groupData_modal" data-bs-toggle="modal" class="btn btn-sm btn-bg"><i
                            data-feather="plus"></i>{{ __('newsletter.add_group') }}</a>
                    </a>

                    <a href="{{ route('marketing.contact-import') }}"
                    class="btn btn-sm btn-bg d-flex align-items-center mg-r-5"><i data-feather="plus"></i><span
                        class="d-none d-sm-inline mg-l-5">{{ __('newsletter.import') }}</span></a>
                    @endif
                  
                </div>
            </div>
        </div>
        @if (Session::has('message'))
            <div class="alert alert-danger">
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="card-body">

            <div class="row align-item-center mb-3 order-list-wrapper">

                <div class="col-lg-4">
                    <div class="form-icon position-relative d-flex">
                        <p class="mb-0 d-flex text-dark-grey align-items-center mr-3">{{ __('seo.date') }}
                        </p>
                        <input type="text" id="datatableRange" name="datatableRange" class="form-control"
                            placeholder="{{__('common.daterange_placeholder')}}" />
                    </div>
                </div>

                <div class="col-lg-6">
                    <input type="text" id="search" value="{{ $search ?? '' }}" class="form-control fas fa-search"
                        placeholder="{{ __('newsletter.search_placeholder') }}" aria-label="Search" style="width: 80%;"
                        name="search">
                </div>
                <div class="col-lg-1 d-flex justify-content-end">
                    <div class="align-items-center ">
                        <a class="btn btn-primary" href="{{ route('marketing.contact-group-list.index') }}" role="button">Reset</a>
                    </div>
                </div>
            </div>

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
                                
                                        <td>{{$content->current_page * $content->per_page + $key+1 - $content->per_page}}</td>                                          <td>{{ $groupData->group_name }}</td>
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
                                            <a href="{{ route('marketing.contact-list', $groupData->id) }}"
                                                value="{{ $groupData->id }}"
                                                class="btn btn-sm btn-white d-flex align-items-center mg-r-5 px-0"><i
                                                    data-feather="eye"></i></a>

                                              @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                            <button type="button" value="{{ $groupData->id }}"
                                                class="btn btn-sm btn-white d-flex align-items-center px-0"
                                                value="1" id="edit_btn" data-bs-toggle="modal"
                                                data-target="#edit_groupData_modal">
                                                <i data-feather="edit-2"></i></button>
                                                @endif
                                        </td>
                                     
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    <!--Pagination Start-->
                    {!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'marketing.contact-group-list.index') !!}
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
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('newsletter.add_contact') }}</h6>
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
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('newsletter.update_contact') }}</h6>
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
                            url: "{{ route('marketing.contact-group-list.store') }}",
                            data: data,
                            dataType: "json",

                            success: function(response) {
                                console.log(response);
                                Toaster(response.success);
                                setTimeout(function() {
                                    location.reload(true);
                                }, 1000);
                            }
                        });
                    }
                });

                //group status change ajax start here
                $('.toggle-class').change(function() {
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
                            console.log(data.success);
                            Toaster(data.success);
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
                        url: "{{ url('marketing.contact-edit') }}",
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
                        var data = {
                            group_name: $("#update_group_name").val(),
                            details: $("#update_details").val(),
                            group_id: $('#input_field').val(),
                        }
                        console.log(data);
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

            // Ajax Date Filter

            $(function() {
                // tableWebContent();
                var start = moment();
                var end = moment();

                function cb(start, end) {
                    $('#datatableRange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }

                $('#datatableRange').daterangepicker({
                    autoUpdateInput: false, 
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last 6 Month': [moment().subtract(6, 'month'), moment()],
                        'Last Year': [moment().subtract(1, 'year'), moment()]
                    },
                    locale: {
                        format: 'YYYY-MM-D'
                    }
                }, cb);

                cb(start, end);
            });

            $(document).ready(function() {
                $('input[name="datatableRange"]').on('apply.daterangepicker', function(ev, picker) {
                   $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                   ajaxSubmitData();
                });

                $("#search").on('keyup', function(e) {
                    if ((this.value).length >= 3 || (this.value).length == 0) {
                        tableWebContent('', '', this.value);
                    } 
                });

            });

            function ajaxSubmitData() {
                var dateRangePicker = $('#datatableRange').data('daterangepicker');
                var startDate = $('#datatableRange').val();

                if (startDate == '') {
                    startDate = null;
                    endDate = null;
                } else {
                    startDate = dateRangePicker.startDate.format('YYYY-MM-DD');
                    endDate = dateRangePicker.endDate.format('YYYY-MM-DD');
                }

                if (startDate != '' && endDate != '')
                    $("#order_listing").html('');

                $("#order_listing").html('');
                tableWebContent(startDate, endDate);
            }


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
        </script>

        <script type="text/javascript">
            //  toggle ajax start
            // $('.toggle-class').change(function() {
            //     let status = $(this).prop('checked') === true ? 1 : 0;
            //     let group_id = $(this).data('id');

            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            //     $.ajax({
            //         type: "POST",
            //         dataType: "json",
            //         url: "{{ route('marketing.changeContactGroupStatus') }}",
            //         data: {
            //             'status': status,
            //             'group_id': group_id
            //         },
            //         success: function(data) {
            //             Toaster('Contact Group Status Changed Successfully')
            //         }
            //     });
            // });
            //  toggle ajax end
        </script>

        <!-- start delete ajax-->
        <script>
            $(document).ready(function() {

                $(document).on("click", "#delete_btn", function() {
                    var group_id = $(this).val();
                    $('#delete_groupData_id').val(group_id);
                    $('#delete_groupData_modal').modal('show');
                });
                $(document).on('click', '.groupData_delete', function() {
                    var group_id = $('#delete_groupData_id').val();

                    $('#delete_groupData_modal').modal('hide');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('marketing.deleteContactGroup') }}/" + group_id,
                        data: {
                            group_id: group_id,

                        },
                        dataType: "json",
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
