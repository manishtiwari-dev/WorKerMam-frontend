<x-app-layout>

    @push('scripts')
         
    @endpush
    @section('title', 'Job Application')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between py-2">
                        <h6 class="tx-15 mg-b-0">Job Application</h6>
                        <a href="{{ route('recruit.job-applications.create') }}"
                            class="btn btn-primary btn-sm"><i data-feather="plus"></i><span
                                class="d-none d-sm-inline mg-l-5"> @lang('modules.AddJobApplication')</span></a>

                    </div>
                </div>
                <div class="card-body pb-0">
                    <div class="row clearfix">
                        <div class="col-md-12 mb-20">
                            <a href="javascript:;" id="toggle-filter"
                                class="btn btn-outline btn-success btn-sm toggle-filter"><i class="fa fa-sliders"></i>
                                @lang('app.filterResults')</a>
                            <a href="{{ route('recruit.job-applications.index') }}"
                                class="btn btn-primary">
                                <i class="fa fa-columns"></i> @lang('modules.jobApplication.boardView')
                            </a>

                            <a href="{{ route('recruit.job-application-import') }}"
                                class="pull-right btn btn-primary mg-l-5"><i
                                    data-feather="plus"></i><span class="d-none d-sm-inline mg-l-5"> Import</span></a>
                            <a class="pull-right" onclick="exportJobApplication()"><button
                                    class="btn btn-sm btn-primary" type="button">
                                    <i class="fa fa-upload"></i> @lang('menu.export')
                                </button></a>
                        </div>
                    </div>
                    <div class="row b-b b-t mb-3" style="display: none; background: #fbfbfb;" id="ticket-filters">
                        <div class="col-md-12">
                            <h4 class="mt-2">@lang('app.filterBy') <a href="javascript:;"
                                    class="pull-right toggle-filter"><i class="fa fa-times-circle-o"></i></a></h4>
                        </div>
                        <div class="col-md-12">
                            <form id="filter-form" class="row">
                                <div class="col-md-4">
                                    <div class="example">
                                        <div class="input-daterange input-group" id="date-range">
                                            <input type="text" class="form-control" id="start-date"
                                                placeholder="Show Results From"
                                                value="{{ now()->subDays(30)->format('Y-m-d') }}" autocomplete="off" />
                                            <span
                                                class="input-group-addon bg-info b-0 text-white p-2 bg-dark">@lang('app.to')</span>
                                            <input type="text" class="form-control" id="end-date"
                                                placeholder="Show Results To" value="{{ now()->format('Y-m-d') }}"
                                                autocomplete="off" />
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="select2" name="status" id="status" data-style="form-control">
                                            <option value="all">@lang('modules.jobApplication.allStatus')</option>
                                            @forelse($boardColumns as $status)
                                                <option value="{{ $status->id }}">{{ ucfirst($status->status) }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="select2" name="jobs" id="jobs" data-style="form-control">
                                            <option value="all">@lang('modules.jobApplication.allJobs')</option>
                                            @forelse($jobs as $job)
                                                <option title="{{ ucfirst($job->title) }}" value="{{ $job->id }}">
                                                    {{ ucfirst($job->title) }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="select2" name="location" id="location"
                                            data-style="form-control">
                                            <option value="all">@lang('modules.jobApplication.allLocation')</option>
                                            @forelse($locations as $location)
                                                <option value="{{ $location->id }}">{{ ucfirst($location->location) }}
                                                </option>
                                            @empty
                                            @endforelse

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8 select-dropdown">
                                    <div class="form-group">
                                        <select class="select2" name="skill[]" data-placeholder="Select Skills"
                                            multiple="multiple" id="skill" data-style="form-control">
                                            @forelse($skills as $skill)
                                                <option value="{{ $skill->id }}">{{ ucfirst($skill->name) }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="select2" name="question" id="questions"
                                            data-style="form-control">
                                            <option value="all">@lang('modules.jobApplication.allQuestion')</option>
                                            @forelse($questions as $question)
                                                <option value="{{ $question->id }}">
                                                    {{ ucfirst($question->question) }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" id="question_value">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="question_value"
                                            id="question-value" placeholder="Enter question value">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" id="apply-filters" class="btn btn-sm btn-primary"><i
                                                class="fa fa-check"></i> @lang('app.apply')</button>
                                        <a class="btn btn-primary btn-sm" href="" role="button"><i
                                                class="fa fa-refresh"></i> {{ __('common.reset') }}</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive m-t-40">
                        {{-- <table id="myTable" class="table table-bordered table-striped"> --}}
                            <table id="myTable" class="table table_wrapper">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>@lang('modules.jobApplication.applicantDetails')</th> 
                                    <th>@lang('menu.jobs')</th>
                                    <th>@lang('menu.locations')</th>
                                    <th>@lang('app.status')</th>
                                    <th>@lang('app.action')</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('Recruit::application-setting.modal')
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
    <div class="modal fade bs-modal-lg in" id="application-lg-modal" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                        @lang('app.cancel')</button>
                    <button type="button" class="btn btn-success"><i class="fa fa-check"></i>
                        @lang('app.save')</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--start delete modal-->
    <div class="modal fade job_application" id="job_application" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">@lang('menu.jobApplications')</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body job-application-details">

                </div>

            </div>
        </div>
    </div>
    @push('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Load DataTables FixedHeader extension -->
    <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>

        <script type="text/javascript" charset="utf8" src="{{ asset('asset/js/responsive.bootstrap.min.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('asset/js/moment.js') }}"></script>

        <script>
            $('#start-date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            })
            $('#end-date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            })
            $('#question_value').hide();
            $('#questions').change(function() {
                $('#question_value').show();
            })

            $('#start-date').datepicker().on('changeDate', function(e) {
                $('#end-date').datepicker('setStartDate', $(this).datepicker('getDate'));
            });

            $('#end-date').datepicker().on('changeDate', function(e) {
                $('#start-date').datepicker('setEndDate', $(this).datepicker('getDate'));
            });

            var table;
            tableLoad('load');
            // For select 2
            $(".select2").select2({
                width: '100%'
            });
            $('#reset-filters').click(function() {
                $('#filter-form')[0].reset();
                $('#filter-form').find('select').select2('render');
                tableLoad('load');
            })
            $('#apply-filters').click(function() {
                tableLoad('filter');
            });

            function tableLoad(type) {
                var status = $('#status').val();
                var jobs = $('#jobs').val();
                var skill = $('#skill').val();
                var questions = $('#questions').val();
                var location = $('#location').val();
                var startDate = $('#start-date').val();
                var endDate = $('#end-date').val();
                var question_value = $('#question-value').val();

                table = $('#myTable').dataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax: '{!! route('recruit.job-applications.data') !!}?status=' + status + '&location=' + location + '&startDate=' +
                        startDate + '&endDate=' + endDate + '&jobs=' + jobs + '&skill=' + skill + '&questions=' +
                        questions + '&question_value=' + question_value,
                    // language: languageOptions(),
                    "fnDrawCallback": function(oSettings) {
                        $("body").tooltip({
                            selector: '[data-toggle="tooltip"]'
                        });
                    }, 
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'date',
                            name: 'date',
                        },
                        {
                            data: 'full_name',
                            name: 'full_name',
                        }, 
                        {
                            data: 'title',
                            name: 'title',
                            width: 30
                        },
                        {
                            data: 'location',
                            name: 'location',
                        },
                        {
                            data: 'status',
                            name: 'status',
                        },
                        {
                            data: 'action',
                            name: 'action',
                        }
                    ]
                });
                new $.fn.dataTable.FixedHeader(table);
            }

            $('body').on('click', '.sa-params,.delete-document', function() {
                var id = $(this).data('row-id');
                const deleteDocClassPresent = $(this).hasClass('delete-document');
                const saParamsClassPresent = $(this).hasClass('sa-params');

                swal({
                        title: `Are you sure you want to delete this record?`,
                        text: "If you delete this, it will be gone forever.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((isConfirm) => {
                        if (isConfirm) {
                            let url = '';

                            if (deleteDocClassPresent) {
                                url = "{{ route('recruit.documents.destroy', ':id') }}";
                            }
                            if (saParamsClassPresent) {
                                url = "{{ route('recruit.job-applications.destroy', ':id') }}";
                            }

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
                                        Toaster(response.success);

                                        setTimeout(function() {
                                            location.reload(true);
                                        }, 3000);
                                        window.location.href =
                                            "{{ route('recruit.job-applications.table') }}";

                                    } else {
                                        Toaster(response.error);
                                    }
                                    // if (response.success) {
                                    //     $.unblockUI();
                                    //     if (deleteDocClassPresent) {
                                    //         docTable._fnDraw();
                                    //     }
                                    //     if (saParamsClassPresent) {
                                    //         table._fnDraw();
                                    //     }
                                    // }
                                }
                            });
                        }
                    });
            });

            table.on('click', '.show-detail', function() {
                $('#job_application').modal('show');
                var id = $(this).data('row-id');
                var url = "{{ route('recruit.job-applications.show', ':id') }}";
                url = url.replace(':id', id);

                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(response) {
                        if (response.status == "success") {
                            console.log(response);
                            $('.job-application-details').html(response.view);
                        }
                    }
                });
            });

            $('.toggle-filter').click(function() {
                $('#ticket-filters').toggle('slide');
            });

            $('body').on('click', '.show-document', function() {
                const type = $(this).data('modal-name');

                const id = $(this).data('row-id');

                const url = "{{ route('recruit.documents.index') }}?documentable_type=" + type + "&documentable_id=" +
                    id;

                $.ajaxModal('#application-lg-modal', url);
                $('#application-lg-modal').modal('show');
            })

            function exportJobApplication() {
                var startDate;
                var endDate;
                var status = $('#status').val();
                var jobs = $('#jobs').val();
                var location = $('#location').val();

                startDate = $('#start-date').val();
                endDate = $('#end-date').val();

                if (startDate == '' || startDate == null) {
                    startDate = 0;
                }

                if (endDate == '' || endDate == null) {
                    endDate = 0;
                }

                var url =
                    '{{ route('recruit.job-applications.export', [':status', ':location', ':startDate', ':endDate', ':jobs']) }}';
                url = url.replace(':status', status);
                url = url.replace(':location', location);
                url = url.replace(':startDate', startDate);
                url = url.replace(':endDate', endDate);
                url = url.replace(':jobs', jobs);

                alert(url);

                window.location.href = url;
            }

            // Schedule create modal view
            function createSchedule(id) {
                var url = "{{ route('recruit.job-applications.create-schedule', ':id') }}";
                url = url.replace(':id', id);
                $('#modelHeading').html('Schedule');
                $.ajaxModal('#scheduleDetailModal', url);
            }

            //click mail setting open modal
            $(document).on('click', '.mail_setting', function() {
                var data1 = '';
                $.ajax({
                    url: "{{ route('recruit.application-setting.create') }}",
                    success: function(data) {
                        data1 = eval(data.mail_setting);
                        var options = '';
                        $.each(data1, function(name, status) {
                            if (status.status == true) {
                                options +=
                                    '<input type="checkbox"  checked style=text-align: center; margin: 6px 15px 13px 0px;" name="checkBoardColumn[]" id="checkbox-' +
                                    name + '" value="' + name + '"  />';
                                options += '<label for="checkbox-' + name +
                                    '" style="text-align: center; margin: 6px 15px 13px 0px;">' +
                                    status.name + '</label>';
                            } else {
                                options +=
                                    '<input type="checkbox" style="text-align: center; margin: 6px 10px 4px 0px;" class = "iCheck-helper" name="checkBoardColumn[]" id="checkbox-' +
                                    name + '" value="' + name + '"  />';
                                options += '<label for="checkbox-' + name +
                                    '" style="text-align: center; margin: 6px 10px 4px 0px;">' +
                                    status.name + '</label>';
                            }
                        });
                        $('#assetNameMenu').html(options);
                        $('#legal_term').val(data.legal_term);
                        $('#ModalLoginForm').modal('show');
                        // return false;
                    }

                });

            });
        </script>
    @endpush
</x-app-layout>
