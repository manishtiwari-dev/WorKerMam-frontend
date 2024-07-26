<x-app-layout>

    @push('scripts')
        <link rel="stylesheet" href="//cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('asset/css/bootstrap-material-datetimepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('asset/css/bootstrap-datepicker.min.css') }}">
<!-- 
        <style>
            .mb-20 {
                margin-bottom: 20px
            }

            .datepicker {
                z-index: 9999 !important;
            }

            .select2-container--default .select2-selection--single,
            .select2-selection .select2-selection--single {
                width: 100%;
            }

            .select2-search {
                width: 100%;
            }

            .select2.select2-container {
                width: 100% !important;
            }

            .select2-search__field {
                width: 100% !important;
                display: block;
                padding: .375rem .75rem !important;
                font-size: 1rem;
                line-height: 1.5;
                color: #495057;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid #ced4da;
                transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            }

            .d-block {
                display: block;
            }

            .upcomingdata {
                height: 37.5rem;
                overflow-x: scroll;
            }

            .notify-button {
                height: 1.5em;
                font-size: 0.730rem !important;
                line-height: 0.5 !important;
            }

            .scheduleul {
                padding: 0 15px 0 11px;
            }
        </style> -->
        @section('title', 'Interview Schedule')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <a href="javascript:;" id="toggle-filter"
                                        class="btn btn-outline btn-danger btn-sm toggle-filter">
                                        <i class="fa fa-sliders"></i> @lang('app.filterResults')
                                    </a>
                                    <a href="{{ route('recruit.interview-schedule.index') }}"
                                        class="btn btn-outline btn-primary btn-sm">
                                        <i class="fa fa-calendar"></i> @lang('modules.interviewSchedule.calendarView')
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <form class="form-inline justify-content-lg-end d-flex">
                                    <div class="form-group mb-0 me-1 w-50">
                                        <select name="statusMultiple" id="statusMultiple" class="select2 form-control"
                                            style="width:100%;">
                                            <option value="selectStatus">@lang('modules.interviewSchedule.selectStatus')</option>
                                            <option value="rejected">@lang('app.rejected')</option>
                                            <option value="hired">@lang('app.hired')</option>
                                            <option value="pending">@lang('app.pending')</option>
                                            <option value="canceled">@lang('app.canceled')</option>
                                        </select>
                                    </div>

                                    <button type="button" id="changeMultipleStatus" class="btn btn-primary">
                                        @lang('app.apply')</button>

                                </form>

                            </div>
                        </div>

                        <div class="row b-b b-t mb-3" style="display: none; background: #fbfbfb;" id="ticket-filters">
                            <div class="col-md-12">
                                <h4 class="mt-2">@lang('app.filterBy') <a href="javascript:;"
                                        class="pull-right toggle-filter"></a></h4>
                            </div>
                            <div class="col-md-12">

                                <form action="" class="row" id="filter-form" style="width: 100%;">
                                    <div class="col-md-4">
                                        <div class="example">
                                            <div class="input-daterange input-group" id="date-range">
                                                <input type="text" class="form-control" id="start-date"
                                                    placeholder="Show Results From" value="" />
                                                <span
                                                    class="input-group-addon bg-info b-0 text-white p-1">@lang('app.to')</span>
                                                <input type="text" class="form-control" id="end-date"
                                                    placeholder="Show Results To" value="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control select2" name="applicationID" id="applicationID"
                                                data-style="form-control">
                                                <option value="all">@lang('modules.interviewSchedule.allCandidates')</option>
                                                @forelse($candidates as $candidate)
                                                    <option value="{{ $candidate->id }}">
                                                        {{ ucfirst($candidate->full_name) }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control select2" name="status" id="status"
                                                data-style="form-control">
                                                <option value="all">@lang('modules.interviewSchedule.allStatus')</option>
                                                <option value="pending">@lang('app.pending')</option>
                                                <option value="rejected">@lang('app.rejected')</option>
                                                <option value="hired">@lang('app.hired')</option>
                                                <option value="canceled">@lang('app.canceled')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button type="button" id="apply-filters" class="btn btn-sm btn-primary">
                                                @lang('app.apply')</button>
                                            <a class="btn btn-primary btn-sm" href="" role="button"><i
                                                    class="fa fa-refresh"></i> {{ __('common.reset') }}</a>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive mt-2">
                            {{-- <table id="myTable" class="table table-bordered table-striped"> --}}
                            <table id="myTable" class="table table_wrapper">
                                <thead>
                                    <tr>

                                        <th>#</th>
                                        <th>@lang('app.candidate')</th>
                                        <th>@lang('menu.interviewDate')</th>
                                        <th>@lang('menu.status')</th>
                                        <th>@lang('app.action')</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--start delete modal-->
        <div class="modal fade effect-scale" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">{{ __('seo.delete_submission') }}</h6>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="delete_job_id" name="input_field_id">
                        <p class="mg-b-0">{{ __('common.delete_confirmation') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('common.no') }}
                        </button>
                        <button type="button" class="btn btn-primary delete_submit_btn"
                            id="">{{ __('common.yes') }}</button>
                    </div>
                </div>
            </div>
        </div>

        <!--End delete modal-->


        {{-- Ajax Modal Start for --}}
        <div class="modal fade bs-modal-md in" id="scheduleDetailModal" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" id="modal-data-application">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
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

        {{-- Ajax Modal Start for --}}
        <div class="modal fade bs-modal-md in" id="scheduleEditModal" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" id="modal-data-application">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
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


        @push('scripts')

        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

        <!-- Load DataTables FixedHeader extension -->
        <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
            <script type="text/javascript" charset="utf8" src="{{ asset('asset/js/responsive.bootstrap.min.js') }}"></script>
            <script type="text/javascript" charset="utf8" src="{{ asset('asset/js/moment.js') }}"></script>

            <script type="text/javascript" charset="utf8"
                src="https://lab2.invoidea.in/recruit/public/assets/node_modules/blockUI/jquery.blockUI.js"></script>



            <script>
                $(document).ready(function() {

                    $(document).on("click", "#delete_btn", function() {
                        var job_id = $(this).attr("data-id");

                        $('#delete_job_id').val(job_id);
                        $('#delete_modal').modal('show');
                    });

                    $(document).on('click', '.delete_submit_btn', function() {
                        var job_id = $('#delete_job_id').val()

                        $('#delete_modal').modal('show');

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ url('recruit/interview-schedule') }}/" + job_id,
                            data: {
                                job_id: job_id,
                                _method: 'DELETE'
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.success) {
                                    Toaster("success", response.success);


                                    setTimeout(function() {
                                        location.reload(true);
                                    }, 3000);
                                    window.location.href =
                                        "{{ route('recruit.interview-schedule.table-view') }}";

                                } else {
                                    Toaster("error", response.error);
                                }
                            }
                        });

                    });
                });
            </script>

            <script>
                $(".select2").select2({
                    formatNoMatches: function() {
                        return "{{ __('messages.noRecordFound') }}";
                    }
                });
                $(".select2").select2({
                    formatNoMatches: function() {
                        return "{{ __('messages.noRecordFound') }}";
                    }
                });
                $('#start-date').datepicker({
                    dateFormat: 'yy/mm/dd',
                    onSelect: function() {
                        var selected = $(this).datepicker("getDate");
                    }
                });

                $('#end-date').datepicker({
                    dateFormat: 'yy/mm/dd',
                    onSelect: function() {
                        var selected = $(this).datepicker("getDate");
                    }
                });


                var table = $('#myTable').dataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax: {
                        'url': '{!! route('recruit.interview-schedule.data') !!}',
                        'data': function(d) {
                            return $.extend({}, d, {
                                startDate: $('#start-date').val(),
                                endDate: $('#end-date').val(),
                                status: $('#status').val(),
                                applicationID: $('#applicationID').val(),
                            });
                        }
                    },
                    // language: languageOptions(),
                    "fnDrawCallback": function(oSettings) {
                        $("body").tooltip({
                            selector: '[data-toggle="tooltip"]'
                        });
                    },
                    columns: [{
                            data: 'checkbox',
                            name: 'checkbox',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'full_name',
                            name: 'full_name'
                        },
                        {
                            data: 'schedule_date',
                            name: 'schedule_date'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        }
                    ],
                    buttons: [
                        'selectAll',
                        'selectNone'
                    ],
                    order: [
                        [1, 'asc']
                    ]
                });
                new $.fn.dataTable.FixedHeader(table);



                // Handle click on "Select all" control
                $('#example-select-all').on('click', function() {
                    // Check/uncheck all checkboxes in the table
                    $('input[type="checkbox"]').prop('checked', this.checked);
                });

                // Employee Response on schedule
                $('#changeMultipleStatus').on('click', function() {
                    var msg;
                    var status = $('#statusMultiple').val();
                    var selectedArray = [];
                    $('tbody .checkbox input:checked').each(function() {
                        selectedArray.push($(this).val());
                    });
                    if (selectedArray.length > 0) {
                        if (status !== 'selectStatus') {
                            swal({
                                    title: `Are you sure you want to Change the Status`,
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                })
                                .then((isConfirm) => {
                                    if (isConfirm) {
                                        changeMultipleStatus(status, 'yes')
                                    } else {
                                        changeMultipleStatus(status, 'no')
                                    }
                                });
                        } else {
                            Toaster('error', 'Please select any one status', "error");
                        }
                    } else {

                        Toaster("error", "Please check atleast one checkbox");
                    }
                });

                function changeMultipleStatus(status, mailToCandidate) {
                    var selectedArray = [];
                    $('tbody .checkbox input:checked').each(function() {
                        selectedArray.push($(this).val());
                    });

                    var token = "{{ csrf_token() }}";
                    var url = "{{ route('recruit.interview-schedule.change-status-multiple') }}";
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            '_token': token,
                            "id": selectedArray,
                            "status": status,
                            'mailToCandidate': mailToCandidate
                        },
                        container: '#myTable',
                        success: function(response) {
                            Toaster('success', response.success);

                            $.unblockUI();
                            table._fnDraw();
                            $('#example-select-all').prop('checked', false);


                        }
                    });
                }

                // Edit Data
                $('body').on('click', '.edit-data', function() {

                    var id = $(this).data('row-id');
                    var url = "{{ route('recruit.interview-schedule.edit', ':id') }}";
                    url = url.replace(':id', id);
                    // alert(url);
                    $('#modelHeading').html('Schedule');
                    $('#scheduleDetailModal').modal('hide');
                    $.ajaxModal('#scheduleDetailModal', url);
                    $('#scheduleDetailModal').modal('show');
                });
                // View Data
                $('body').on('click', '.view-data', function() {
                    var id = $(this).data('row-id');

                    var url = "{{ route('recruit.interview-schedule.show', ':id') }}?table=yes";
                    url = url.replace(':id', id);
                    $('#modelHeading').html('Schedule');
                    $('#scheduleDetailModal').modal('hide');
                    $.ajaxModal('#scheduleDetailModal', url);
                    $('#scheduleDetailModal').modal('show');
                });

                // Delete Data


                // Apply Filter
                $('#apply-filters').click(function() {
                    table._fnDraw();
                });



                // Reset Filters
                $('#reset-filters').click(function() {
                    $('#filter-form')[0].reset();
                    $('#status').val('all');
                    $('#status').select2();
                    $('#applicationID').val('all');
                    $('#applicationID').select2();
                    table._fnDraw();
                })

                $('body').on('click', '.cancel-meeting', function() {
                    var id = $(this).data('meeting-id');
                    swal({
                        title: "@lang('errors.areYouSure')",
                        text: "@lang('errors.cancelWarning')",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "@lang('app.yes')",
                        cancelButtonText: "@lang('app.no')",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    }, function(isConfirm) {
                        if (isConfirm) {

                            var url = "";
                            url = url.replace(':id', id);
                            var token = "{{ csrf_token() }}";
                            $.ajax({
                                type: 'POST',
                                url: url,
                                data: {
                                    '_token': token,
                                    'id': id
                                },
                                success: function(response) {
                                    if (response.status == "success") {
                                        window.location.reload();
                                    }
                                }
                            });
                        }
                    });
                });

                // Filte Toggle
                $('.toggle-filter').click(function() {
                    $('#ticket-filters').toggle('slide');
                })
            </script>
        @endpush
    </x-app-layout>
