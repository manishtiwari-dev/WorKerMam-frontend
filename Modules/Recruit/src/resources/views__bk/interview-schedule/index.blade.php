<x-app-layout>
    <link rel="stylesheet" href="//cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap-material-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap-datepicker.min.css') }}">
    <style>
        /* .mb-20 {
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



        .scheduleul {
            padding: 0 15px 0 11px;
        } */
    </style>
    @section('title', 'Interview Schedule')
    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
        <div class="row">
            <div class="col-md-12 mb-2">

                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                    <a href="{{ route('recruit.interview-schedule.table-view') }}"
                        class="btn btn-sm btn-primary">@lang('app.tableView') <i class="fa fa-table"></i></a>
                @endif

                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                    <a href="#" data-bs-toggle="modal" onclick="createSchedule()"
                        class="btn btn-sm btn-success waves-effect waves-light">
                        <i class="ti-plus"></i>
                        @lang('modules.interviewSchedule.addInterviewSchedule')
                    </a>
                @endif

            </div>
        </div>
    @endif
    <div class="row">

        <div class="col-lg-8 ">
            <div class="card">
                <div class="card-body">
                    <div id="calendar"></div>
                    </dmulti-select.css>
                </div>
            </div>
        </div> 
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header d-flex p-0 ui-sortable-handle">
                    <h4 class="card-title p-3 mb-0">
                        <i class="fa fa-file"></i>
                        @lang('modules.interviewSchedule.interviewSchedule')
                    </h4>
                </div><!-- /.card-header -->
                <div id="upcoming-schedules" class="card-body">
                    
                    @include('Recruit::interview-schedule.upcoming-schedule', [
                        'upComingSchedules' => $content->upComingSchedules,
                    ])
                </div><!-- /.card-body -->
            </div>
        </div>  
    </div>
        {{-- Ajax Modal Start for --}}
        <div class="modal fade bs-modal-md in" id="scheduleDetailModal" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" id="modal-data-application">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        <span class="caption-subject font-red-sunglo bold
                            uppercase"
                            id="modelHeading"></span>
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
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <span class="caption-subject font-red-sunglo bold
                            uppercase"
                            id="modelHeading"></span>
                    </div>
                    <div class="modal-body">
                        Loading...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn blue">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        {{-- Ajax Modal Ends --}}
        {{-- @dd($content->schedules) --}}

        @push('scripts')
            <script>
                userCanAdd = true;
                userCanEdit = true;
                //  
                taskEvents = [
                    @foreach ($content->schedules as $schedule)
                        {
                            id: '{{ ucfirst($schedule->id) }}',
                            title: '{{ $schedule->job_application->job->title ?? '' }} on {{ $schedule->job_application->full_name }}',
                            start: '{{ $schedule->schedule_date }}',
                            end: '{{ $schedule->schedule_date }}',
                        },
                    @endforeach
                ];
                var scheduleLocale = 'en';
            </script>
            <script src="//cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
            <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
            <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
            <link rel="stylesheet" href="{{ asset('asset/css/fullcalendar.css') }}">
            <script type="text/javascript" charset="utf8" src="{{ asset('asset/js/moment.js') }}"></script>
            <script type="text/javascript" charset="utf8" src="{{ asset('asset/js/fullcalendar.min.js') }}"></script>
            <script type="text/javascript" charset="utf8" src="{{ asset('asset/js/jquery.fullcalendar.js') }}"></script>
            <script type="text/javascript" charset="utf8" src="{{ asset('asset/js/locale-all.js') }}"></script>
            <script type="text/javascript" charset="utf8" src="{{ asset('asset/js/schedule-calendar.js') }}"></script>


            <script>
                // Schedule create modal view


                // Schedule create modal view
                function editUpcomingSchedule(event, id) { 
                    if (!$(event.target).closest('.editSchedule').length) {
                        return false;
                    } 
                    var url = "{{ route('recruit.interview-schedule.edit', ':id') }}";
                    url = url.replace(':id', id);
                    $('#modelHeading').html('Schedule');
                    $('#scheduleEditModal').modal('hide');
                    $.ajaxModal('#scheduleEditModal', url);
                }


                // Update Schedule
                function reloadSchedule() {
                    $.ajax({
                        url: '{{ route('recruit.interview-schedule.index') }}',
                        container: '#updateSchedule',
                        type: "GET",
                        success: function(response) {
                            $('#upcoming-schedules').html(response.data);

                            taskEvents = [];
                            response.scheduleData.forEach(function(schedule) {
                                const taskEvent = {
                                    id: schedule.id,
                                    title: schedule.job_application.job.title + ' on ' + schedule
                                        .job_application.full_name,
                                    start: schedule.schedule_date,
                                    end: schedule.schedule_date,
                                };
                                taskEvents.push(taskEvent);
                            });

                            $.CalendarApp.reInit();
                        }
                    })
                }

                $('body').on('click', '.deleteSchedule', function(event) {
                    var id = $(this).data('schedule-id');
                    if (!$(event.target).closest('.deleteSchedule').length) {
                        return false;
                    }
                    swal({
                            title: `Are you sure you want to delete this record?`,
                            text: "If you delete this, it will be gone forever.",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((isConfirm) => {
                            if (isConfirm) {

                                var url = "{{ route('recruit.interview-schedule.destroy', ':id') }}";
                                url = url.replace(':id', id);

                                var token = "{{ csrf_token() }}";

                                $.ajax({
                                    type: 'POST',
                                    url: url,
                                    data: {
                                        '_token': token,
                                        '_method': 'DELETE'
                                    },
                                    success: function(response) { 
                                        if (response.success) {
                                            Toaster("success", response.success);

                                            setTimeout(function() {
                                                location.reload(true);
                                            }, 3000);
                                            window.location.href =
                                                "{{ route('recruit.interview-schedule.index') }}";

                                        } else {
                                            Toaster("error", response.error);
                                        }
                                    }
                                });
                            }
                        });
                });

                // Employee Response on schedule
                function employeeResponse(id, type) {
                    var msg;

                    if (type == 'accept') {
                        msg = "@lang('errors.acceptSchedule')";
                    } else {
                        msg = "@lang('errors.refuseSchedule')";
                    }
                    swal({
                        title: "@lang('errors.areYouSure')",
                        text: msg,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "@lang('app.yes')",
                        cancelButtonText: "@lang('app.cancel')",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    }, function(isConfirm) {
                        if (isConfirm) {
                            var url = "{{ route('recruit.interview-schedule.response', [':id', ':type']) }}";
                            url = url.replace(':id', id);
                            url = url.replace(':type', type);

                            // update values for all tasks
                            $.ajax({
                                url: url,
                                type: 'GET',
                                success: function(response) {
                                    if (response.status == 'success') {
                                        window.location.reload();
                                    }
                                }
                            });
                        }
                    });
                }

                // schedule detail
                var getScheduleDetail = function(event, id) {

                    if ($(event.target).closest('.editSchedule, .deleteSchedule, .responseButton').length) {
                        return false;
                    }

                    var url = '{{ route('recruit.interview-schedule.show', ':id') }}';
                    url = url.replace(':id', id);

                    $('#modelHeading').html('Schedule');
                    $.ajaxModal('#scheduleDetailModal', url);
                    $('#scheduleDetailModal').modal('show');
                }


                // Schedule create modal view
                function createSchedule(scheduleDate) {
                    if (typeof scheduleDate === "undefined") {
                        scheduleDate = '';
                    }
                    var url = '{{ route('recruit.interview-schedule.create') }}?date=' + scheduleDate;
                    $('#modelHeading').html('Schedule');
                    $.ajaxModal('#scheduleDetailModal', url);
                    $('#scheduleDetailModal').modal('show');
                }



                function addScheduleModal(start, end, allDay) {
                    var scheduleDate;
                    if (start) {
                        var sd = new Date(start);
                        var curr_date = sd.getDate();
                        if (curr_date < 10) {
                            curr_date = '0' + curr_date;
                        }
                        var curr_month = sd.getMonth();
                        curr_month = curr_month + 1;
                        if (curr_month < 10) {
                            curr_month = '0' + curr_month;
                        }
                        var curr_year = sd.getFullYear();
                        scheduleDate = curr_year + '-' + curr_month + '-' + curr_date;
                    }

                    createSchedule(scheduleDate);
                }
                $(function() {
                    $('.datepicker').datepicker({
                        dateFormat: 'dd/mm/yy',
                        onSelect: function() {
                            var selected = $(this).datepicker("getDate");
                        }
                    });

                });
            </script>
        @endpush
</x-app-layout>
