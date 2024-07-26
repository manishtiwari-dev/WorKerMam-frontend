<x-app-layout>


    @push('scripts')
        <link rel="stylesheet" href="{{ asset('asset/css/lobipanel.min.css') }}">

        <link rel="stylesheet" href="{{ asset('asset/css/bootstrap-material-datetimepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('asset/css/bootstrap-colorpicker.min.css') }}">
         <link rel="stylesheet" href="{{ asset('asset/css/plugins/jquery-bar-rating-master/fontawesome-stars.css') }}">
    @endpush
    @section('title', $pageTitle)
    <!-- <style>
        .board-column .card {
            box-shadow: none;
        }

        .notify-button {
            height: 1.5em;
            font-size: 0.730rem !important;
            line-height: 0.5 !important;
        }

        .panel-scroll {
            height: calc(100vh - 330px);
            overflow-y: scroll
        }

        .mb-20 {
            margin-bottom: 20px
        }

        .datepicker {
            z-index: 9999 !important;
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

        .searchInput {
            width: 50%;
            display: inline
        }

        .searchButton {
            margin-bottom: 4px;
            margin-left: 3px;
        }

        @media (min-width: 992px) {
            .job_application .modal-dialog {
                max-width: 800px;
            }

            .select2-dropdown {
                z-index: 1110;
            }
        }

        .select-dropdown .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            background: transparent;
            border: 0;
            opacity: 1;
            left: 0;
        }

        .ticket-container .select2-container {
            width: 100% !important
        }
    </style> -->
    @section('title', $pageTitle)

    <div class="row mb-2">
        <div class="col-sm-6">
            <a href="javascript:;" id="toggle-filter" class="btn btn-outline btn-success btn-sm toggle-filter">
                <i class="fa fa-sliders"></i> @lang('app.filterResults')
            </a>
            <a href="{{ route('recruit.job-applications.table') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-table"></i> @lang('app.tableView')
            </a>
            
        </div>
        <div class="col-sm-6 mt-lg-0 mt-2">
            <div id="search-container" class="form-group w-50 ms-auto">
                <input id="search" class="form-control" type="text" name="search"
                    placeholder="@lang('modules.jobApplication.enterName')">
                <a href="javascript:;" class="d-none">
                    <i class="fa fa-times-circle-o"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="container-scroll">
        <div class="card ticket-container" id="ticket-filters">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between ">
                    <h6 class="tx-15 mg-b-0">Job Application</h6>
                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                        <div class="d-flex">
                            <a href="{{ route('recruit.job-application-import') }}"
                                class="btn btn-primary btn-sm mg-r-5"><i data-feather="plus"></i><span
                                    class="d-none d-sm-inline mg-l-5"> Import</span></a>

                            <a href="{{ route('recruit.job-applications.create') }}"
                            class="btn btn-primary btn-sm mg-r-5"><i data-feather="plus"></i><span
                                class="d-none d-sm-inline mg-l-5"> @lang('modules.AddJobApplication')</span></a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="input-daterange input-group">
                                <input type="text" class="form-control" id="date-start"
                                    placeholder="Show Results From" value="{{ $content->startDate }}" />
                                <span class="input-group-addon bg-info b-0 text-white p-2 bg-dark">@lang('app.to')</span>
                                <input type="text" class="form-control" value="{{$content->endDate}}" id="date-end" placeholder="Show Results To"
                                      />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="select2" name="jobs" id="jobs" data-style="form-control">
                                <option value="all">@lang('modules.jobApplication.allJobs')</option>
                                @forelse($content->jobs as $job)
                                    <option title="{{ ucfirst($job->title) }}" value="{{ $job->id }}">
                                        {{ ucfirst($job->title) }}</option>
                                @empty
                                @endforelse

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="select2" name="location" id="location" data-style="form-control">
                                <option value="all">@lang('modules.jobApplication.allLocation')</option>
                                @forelse($content->locations as $location)
                                    <option value="{{ $location->id }}">{{ ucfirst($location->location) }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 select-dropdown">
                        <div class="form-group">
                            <select class="select2" name="skill[]" data-placeholder="Select Skills" multiple="multiple"
                                id="skill" data-style="form-control">

                                @forelse($content->skills as $skill)
                                    <option value="{{ $skill->id }}">{{ ucfirst($skill->name) }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="select2" name="question" id="questions" data-style="form-control">
                                <option value="all">@lang('modules.jobApplication.allQuestion')</option>
                                @forelse($content->questions as $question)
                                    <option value="{{ $question->id }}">{{ ucfirst($question->question) }}</option>
                                @empty
                                @endforelse

                            </select>
                        </div>
                    </div>

                    <div class="col-md-4" id="question_value">
                        <div class="form-group">
                            <input type="text" class="form-control" name="question_value" id="question-value"
                                placeholder="Enter question value">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="button" id="apply-filters"
                                class="btn btn-primary btn-sm">@lang('app.apply')</button>  
                        <a class="btn btn-primary btn-sm" href="" role="button"><i class="fa fa-refresh"></i> {{ __('common.reset') }}</a>
                     

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row container-row">

            {{-- @include('Recruit::job-applications.board-data') --}}
        </div>
    </div>
    @include('Recruit::application-setting.modal')

    <!--start delete modal-->
    <div class="modal fade job_application" id="job_application" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">@lang('menu.jobApplications')</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body job-application-details">

                </div>

            </div>
        </div>
    </div>

    {{-- Ajax Modal Start for --}}
    <div class="modal fade bs-modal-md in" id="scheduleDetailModal" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
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
    @include('Recruit::sections.right-sidebar')

    @push('scripts')
        <script src="{{ asset('asset/js/moment.js') }}" type="text/javascript"></script>

        <script src="{{ asset('asset/js/bootstrap-colorpicker.min.js') }}"></script>
        <script src="{{ asset('asset/js/lobipanel.min.js') }}"></script>

        <script src="{{ asset('asset/js/jquery.barrating.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('asset/js/bootstrap-material-datetimepicker.js') }}" type="text/javascript"></script>


        <script>
            $(".select2").select2({
                width: '100%'
            });
            //implementation of load more functionality

            // $('#date-start').datepicker({
            //     format: 'yyyy-mm-dd'
            // })
            // $('#date-end').datepicker({
            //     format: 'yyyy-mm-dd'
            // })

            loadData();

            $('body').on('click', '.load-more-application', function() {
                var columnId = $(this).data('column-id');
                var totalTasks = $(this).data('total-tasks');
                var currentTotalTasks = $('#drag-container-' + columnId + ' .task-card').length;
                var lastelement = $('#drag-container-' + columnId + ' div.task-card:last');

                var startDate = $('#date-start').val();
                var jobs = $('#jobs').val();
                var location = $('#location').val();
                var skill = $('#skill').val();
                var questions = $('#questions').val();
                var search = $('#search').val();
                var question_value = $('#question-value').val();

                if (startDate == '') {
                    startDate = null;
                }

                var endDate = $('#date-end').val();

                if (endDate == '') {
                    endDate = null;
                }

                var url = '{{ route('recruit.job-applications.loadMore') }}?startDate=' + startDate + '&endDate=' +
                    endDate + '&jobs=' + jobs + '&search=' + search + '&location=' +
                    location + '&skill=' + skill + '&questions=' + questions + '&question_value=' + question_value +
                    '&columnId=' + columnId + '&currentTotalRecords=' + currentTotalTasks +
                    '&totalRecord=' + totalTasks;

                $.ajax({
                    url: url,
                    container: '#drag-container-' + columnId,
                    blockUI: true,
                    type: "GET",
                    success: function(response) {
                        lastelement.after(response.view);

                        if (response.load_more == 'show') {
                            $('#loadMoreBox' + columnId).show();

                        } else {
                            $('#loadMoreBox' + columnId).remove();
                        }

                        $("body").tooltip({
                            selector: '[data-toggle="tooltip"]'
                        });

                        $('.example-fontawesome').barrating({
                            theme: 'fontawesome-stars',
                            showSelectedRating: false,
                            readonly: true,

                        });

                        $(function() {
                            $('.bar-rating').each(function() {
                                const val = $(this).data('value');

                                $(this).barrating('set', val ? val : '');
                            });
                        });

                        var oldParentId, currentParentId, oldElementIds = [],
                            i = 1;

                        let draggingTaskId = 0;
                        let draggedTaskId = 0;
                        let missingElementId = 0;
                        let currentApplicationId = 0;

                        $('.lobipanel').on('dragged.lobiPanel', function(e, lobiPanel) {
                            var $parent = $(this).parent(),
                                $children = $parent.children('.show-detail');
                            var pr = $(this).closest('.board-column');

                            if (draggingTaskId !== 0) {
                                oldParentId = pr.data('column-id');
                            }
                            currentParentId = pr.data('column-id');

                            var boardColumnIds = [];
                            var applicationIds = [];
                            var prioritys = [];

                            $children.each(function(ind, el) {
                                boardColumnIds.push($(el).closest('.board-column').data(
                                    'column-id'));
                                applicationIds.push($(el).data('application-id'));
                                prioritys.push($(el).index());
                            });

                            if (draggingTaskId !== 0) {
                                boardStracture[oldParentId] = [...applicationIds,
                                    currentApplicationId
                                ];
                            } else {
                                const result = boardStracture[oldParentId].filter(el => el !==
                                    currentApplicationId);
                                boardStracture[oldParentId] = result;
                                boardStracture[currentParentId] = applicationIds;
                            }

                            if (oldParentId == 3 && currentParentId == 4) {
                                $('#buttonBox' + oldParentId + currentApplicationId).show();
                                var button = '<button onclick="sendReminder(' +
                                    currentApplicationId +
                                    ', \'notify\')" type="button" class="btn btn-sm btn-info notify-button">@lang('app.notify')</button>';
                                $('#buttonBox' + oldParentId + currentApplicationId).html(button);
                                $('#buttonBox' + oldParentId + currentApplicationId).attr('id',
                                    'buttonBox' + currentParentId + currentApplicationId);

                            } else if (oldParentId == 4 && currentParentId == 3) {
                                var timeStamp = $('#buttonBox' + oldParentId + currentApplicationId)
                                    .data('timestamp');
                                var currentDate = {{ $content->currentDate }};
                                if (currentDate < timeStamp) {
                                    $('#buttonBox' + oldParentId + currentApplicationId).show();
                                    var button = '<button onclick="sendReminder(' +
                                        currentApplicationId +
                                        ', \'reminder\')" type="button" class="btn btn-sm btn-info notify-button">@lang('app.reminder')</button>';
                                    $('#buttonBox' + oldParentId + currentApplicationId).html(
                                        button);
                                }
                                $('#buttonBox' + oldParentId + currentApplicationId).attr('id',
                                    'buttonBox' + currentParentId + currentApplicationId);
                            } else {
                                $('#buttonBox' + oldParentId + currentApplicationId).hide();
                                $('#buttonBox' + oldParentId + currentApplicationId).attr('id',
                                    'buttonBox' + currentParentId + currentApplicationId);
                            }

                            var startDate = $('#date-start').val();
                            var jobs = $('#jobs').val();
                            var search = $('#search').val();

                            if (startDate == '') {
                                startDate = null;
                            }

                            var endDate = $('#date-end').val();

                            if (endDate == '') {
                                endDate = null;
                            }
                            // update values for all tasks
                            $.ajax({
                                url: '{{ route('recruit.job-applications.updateIndex') }}',
                                type: 'POST',
                                container: '.container-row',
                                data: {
                                    boardColumnIds: boardColumnIds,
                                    applicationIds: applicationIds,
                                    prioritys: prioritys,
                                    startDate: startDate,
                                    jobs: jobs,
                                    search: search,
                                    endDate: endDate,
                                    draggingTaskId: draggingTaskId,
                                    draggedTaskId: draggedTaskId,
                                    '_token': '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    if (draggedTaskId !== 0) {
                                        $.each(response.columnCountByIds, function(key,
                                            value) {
                                            $('#columnCount_' + value.id).html((
                                                value.status_count));
                                            $('#columnCount_' + value.id)
                                                .parents('.board-column').find(
                                                    '.lobipanel').css(
                                                    'border-color', value.color
                                                );
                                        });
                                    }
                                }
                            });
                            if (draggingTaskId !== 0) {
                                draggedTaskId = draggingTaskId;
                                draggingTaskId = 0;
                            }
                        }).lobiPanel({
                            sortable: true,
                            reload: false,
                            editTitle: false,
                            close: false,
                            minimize: false,
                            unpin: false,
                            expand: false,
                        });

                        var isDragging = 0;
                        $('.lobipanel-parent-sortable').on('sortactivate', function() {
                            $('.board-column > .panel-body').css('overflow-y', 'unset');
                            isDragging = 1;
                        });
                        $('.lobipanel-parent-sortable').on('sortstop', function(e) {
                            $('.board-column > .panel-body').css('overflow-y', 'auto');
                            isDragging = 0;
                        }); 
                        
                        $('.show-detail').click(function(event) { 
                            if ($(event.target).hasClass('notify-button')) {
                                return false;
                            }
                            var id = $(this).data('application-id');
                            draggingTaskId = currentApplicationId = id;

                            if (isDragging == 0) {
                                  $('#job_application').modal('show');

                                var url = "{{ route('recruit.job-applications.show', ':id') }}";
                                url = url.replace(':id', id);

                                $.ajax({
                                    type: 'GET',
                                    url: url,
                                    success: function(response) {
                                        $('.job-application-details').html(response.view);
                                    }
                                });
                            }
                        })
                    }
                });
            });

            //filters
            $('#apply-filters').click(function() {
                loadData();
            });

            //reset filters
            $('#reset-filters').click(function() {
                $('#date-start').val('{{ $content->startDate }}');
                $('#date-end').val('{{ $content->endDate }}');
                $('#jobs').val('all').trigger('change');

                loadData();
            })

            //apply search
            $('#applySearch').click(function() {
                var search = $('#search').val();
                if (search !== undefined && search !== null && search !== "") {
                    loadData();
                }
            })

            $('#date-end').bootstrapMaterialDatePicker({
                weekStart: 0,
                time: false
            });
            $('#date-start').bootstrapMaterialDatePicker({
                weekStart: 0,
                time: false
            }).on('change', function(e, date) {
                $('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
            });

            // Schedule create modal view
            function createSchedule(id) {
                var url = "{{ route('recruit.job-applications.create-schedule', ':id') }}";
                url = url.replace(':id', id);
                $('#modelHeading').html('Schedule');
                $.ajaxModal('#scheduleDetailModal', url);
            }

            // Create application status modal view
            function createApplicationStatus() {
                var url = "{{ route('recruit.application-status.create') }}";

                $('#modelHeading').html('Application Status');
                $.ajaxModal('#scheduleDetailModal', url);
            }

            function deleteStatus(id) {
                const panels = $('.board-column[data-column-id="' + id + '"').find('.lobipanel.show-detail');
                let applicationIds = [];
                panels.each((ind, element) => {
                    applicationIds.push($(element).data('application-id'));
                });

                swal({
                    title: "@lang('errors.areYouSure')",
                    text: "@lang('errors.deleteStatusWarning')",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "@lang('app.delete')",
                    cancelButtonText: "@lang('app.cancel')",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function(isConfirm) {
                    if (isConfirm) {
                        let url = "{{ route('recruit.application-status.destroy', ':id') }}";
                        url = url.replace(':id', id);

                        let data = {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE',
                            applicationIds: applicationIds
                        }

                        $.ajax({
                            url,
                            data,
                            type: 'POST',
                            container: '.container-row',
                            success: function(response) {
                                if (response.status == 'success') {
                                    loadData();
                                }
                            }
                        })
                    }
                });
            }

            function editStatus(id) {
                var url = "{{ route('recruit.application-status.edit', ':id') }}";
                url = url.replace(':id', id);

                $('#modelHeading').html('Application Status');
                $.ajaxModal('#scheduleDetailModal', url);
            }

            function saveStatus() {
                $.ajax({
                    url: "{{ route('recruit.application-status.store') }}",
                    container: '#createStatus',
                    type: "POST",
                    data: $('#createStatus').serialize(),
                    success: function(response) {
                        $('#scheduleDetailModal').modal('hide');
                        loadData();
                    }
                });
            }

            function updateStatus(id) {
                let url = "{{ route('recruit.application-status.update', ':id') }}";
                url = url.replace(':id', id);

                $.ajax({
                    url: url,
                    container: '#updateStatus',
                    type: "POST",
                    data: $('#updateStatus').serialize(),
                    success: function(response) {
                        $('#scheduleDetailModal').modal('hide');
                        Toaster('success', response.success);

                        setTimeout(function() {
                            location.reload(true);
                        }, 3000);
                    }
                });
            }

            function loadData() {
                var startDate = $('#date-start').val();
                var jobs = $('#jobs').val();
                var location = $('#location').val();
                var skill = $('#skill').val();
                var questions = $('#questions').val();
                var search = $('#search').val();
                var question_value = $('#question-value').val();  

                if (startDate == '') {
                    startDate = null;
                }

                var endDate = $('#date-end').val();

                if (endDate == '') {
                    endDate = null;
                }

                var url = '{{ route('recruit.job-applications.index') }}?startDate=' + startDate + '&endDate=' + endDate +
                    '&jobs=' + jobs + '&search=' + search + '&location=' + location + '&skill=' + skill + '&questions=' +
                    questions + '&question_value=' + question_value;

                $.ajax({
                    url: url,
                    container: '.container-row',
                    type: "GET",
                    success: function(response) {

                        $('.container-row').html(response.view);
                    }

                })
            }

            // search($('#search'), 500, 'data');

            $('.toggle-filter').click(function() {
                $('#ticket-filters').toggle('slide');
            });

            $('#question_value').hide();
            $('#questions').change(function() {
                $('#question_value').show();
            });

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
                                    '<input type="checkbox"  checked style=" style="text-align: center; margin: 6px 15px 13px 0px;" name="checkBoardColumn[]" id="checkbox-' +
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
                        return false;
                    }

                });

            });
        </script>
    @endpush

</x-app-layout>