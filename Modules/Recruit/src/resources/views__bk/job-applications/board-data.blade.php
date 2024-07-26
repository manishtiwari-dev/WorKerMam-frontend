 
@foreach ($content->boardColumns as $key => $column)
  <div class="col-lg-4 col-md-6 mb-3  mt-2">
        <div id="task{{ $column->status }}" class="board-column  p-0" data-column-id="{{ $column->id }}"
            data-position="{{ $column->position }}">
            <div class="card" style="margin-bottom:0 !important;">
            <div class="card-body">
                <h4 class="card-title pt-1 pb-1">
                    {{ ucwords($column->status) }}
                    <span class="badge badge-pill badge-primary text-white ml-auto countVal"
                        style="background: {{ $column->color }};" id="columnCount_{{ $column->id }}">
                        {{ $column->application_count }}
                    </span>
                    <span class="pull-right">
                        <a data-toggle="dropdown" href="#">
                            <i class="fa fa-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript:editStatus({{ $column->id }});">
                                <i class="fa fa-edit"></i> @lang('app.edit')
                            </a>
                            @if ($column->id > 5)
                                <a class="dropdown-item" href="javascript:deleteStatus({{ $column->id }});">
                                    <i class="fa fa-trash-o"></i> @lang('app.delete')
                                </a>
                            @endif
                        </div>
                    </span>
                </h4>
                <div class="card-text">
                    <div class="panel-body">
                            <div class="custom-column panel-scroll" data-column-id="{{ $column->id }}"
                                id="drag-container-{{ $column->id }}">
                                @foreach ($column->applications as $application)
                                    <div id="task-card{{ $application->id }}"
                                        class="panel panel-default lobipanel show-detail task-card"
                                        data-widget="control-sidebar" data-slide="true"
                                        data-row-id="{{ $application->id }}" data-column-id="{{ $column->id }}"
                                        data-application-id="{{ $application->id }}" data-sortable="true"
                                        style="border-color: {{ $column->color }};">
                                        <div class="panel-body ui-sortable-handle">
                                            <h5>
                                                @if (!empty($application->photo))
                                                    <img src="{{ $content->file_url }}{{ $application->photo }}"
                                                        alt="user" class="img-circle" width="25">
                                                @else
                                                    <img src="{{ $application->photo_url }}" alt="user"
                                                        class="img-circle" width="25">
                                                @endif
                                                {{ ucwords($application->full_name) }}
                                            </h5>
                                            <div class="stars stars-example-fontawesome">
                                                <select id="example-fontawesome_{{ $application->id }}"
                                                    data-value="{{ $application->rating }}"
                                                    data-id="{{ $application->id }}"
                                                    class="example-fontawesome bar-rating" name="rating"
                                                    autocomplete="off">
                                                    <option value=""></option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                            <h6 class="text-muted">{{ ucwords($application->job->title ?? '') }}</h6>
                                            <div class="pt-2 pb-2 mt-3">

                                                <span class="text-dark font-14">
                                                    @if (!is_null($application->schedule) && $column->id == 3)
                                                        {{ \Carbon\Carbon::parse($application->schedule->schedule_date)->format('d M, Y') }}
                                                    @else
                                                        {{ \Carbon\Carbon::parse($application->created_at)->format('d M, Y') }}
                                                    @endif
                                                </span>

                                                <span id="buttonBox{{ $column->id }}{{ $application->id }}"
                                                    data-timestamp="">

                                                    @if (!is_null($application->schedule) && $column->id == 3)
                                                        <button
                                                            onclick="sendReminder({{ $application->id }}, 'reminder')"
                                                            type="button"
                                                            class="btn btn-sm btn-info notify-button">@lang('app.reminder')</button>
                                                    @endif
                                                    @if (in_array($column->status, ['hired', 'rejected']))
                                                        <button
                                                            onclick="sendReminder({{ $application->id }}, 'notify', '{{ $column->status }}')"
                                                            type="button"
                                                            class="btn btn-sm btn-info notify-button">@lang('app.notify')</button>
                                                    @endif
                                                    {{-- </span> --}}
                                            </div>

                                        </div>

                                    </div>
                                @endforeach
                                <div class="panel panel-default lobipanel" data-sortable="true"></div>

                                @if ($column->application_count > count($column->applications))
                                    <!-- TASK BOARD FOOTER START -->

                                    <div class="d-flex m-3 justify-content-center" id="loadMoreBox{{ $column->id }}">
                                        <a class="f-13 text-dark-grey f-w-500 load-more-application"
                                            data-column-id="{{ $column->id }}"
                                            data-total-tasks="{{ $column->application_count }}"
                                            href="javascript:;">@lang('app.loadmore')</a>
                                    </div>
                                    {{-- </div> --}}
                                    <!-- TASK BOARD FOOTER END -->
                                @endif
                            </div>
                    </div>

                </div>
            </div>
            </div>
        </div>
  </div>
@endforeach
<script>
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

    $('.example-fontawesome').barrating('set', '');

    // Send Reminder and notification to Candidate
    function sendReminder(id, type, status) {
        var msg;
        if (type == 'notify') {
            if (status == 'hired') {
                msg = "@lang('errors.sendHiredNotification')";
            } else {
                msg = "@lang('errors.sendRejectedNotification')";
            }
        } else {
            msg = "@lang('errors.sendInterviewReminder')";
        }
        swal({
                title: `Are you sure?`,
                text: "Do you want to send rejecting confirmation to candidate",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((isConfirm) => {
                if (isConfirm) {

                    var url = "{{ route('recruit.interview-schedule.notify', [':id', ':type']) }}";
                    url = url.replace(':id', id);
                    url = url.replace(':type', type);

                    // update values for all tasks
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            Toaster('success', response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);
                        }
                    });
                }
            });
    }

    $(function() {
        // Getting Data of all colomn and applications
        boardStracture = JSON.parse('{!! $content->boardStracture !!}');

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
                boardColumnIds.push($(el).closest('.board-column').data('column-id'));
                applicationIds.push($(el).data('application-id'));
                prioritys.push($(el).index());
            });

            if (draggingTaskId !== 0) {
                boardStracture[oldParentId] = [...applicationIds, currentApplicationId];
            } else {
                const result = boardStracture[oldParentId].filter(el => el !== currentApplicationId);
                boardStracture[oldParentId] = result;
                boardStracture[currentParentId] = applicationIds;
            }

            if (oldParentId == 3 && currentParentId == 4) {
                $('#buttonBox' + oldParentId + currentApplicationId).show();
                var button = '<button onclick="sendReminder(' + currentApplicationId +
                    ', \'notify\')" type="button" class="btn btn-sm btn-info notify-button">@lang('app.notify')</button>';
                $('#buttonBox' + oldParentId + currentApplicationId).html(button);
                $('#buttonBox' + oldParentId + currentApplicationId).attr('id', 'buttonBox' +
                    currentParentId + currentApplicationId);

            } else if (oldParentId == 4 && currentParentId == 3) {
                var timeStamp = $('#buttonBox' + oldParentId + currentApplicationId).data('timestamp');
                var currentDate = {{ $content->currentDate }};
                if (currentDate < timeStamp) {
                    $('#buttonBox' + oldParentId + currentApplicationId).show();
                    var button = '<button onclick="sendReminder(' + currentApplicationId +
                        ', \'reminder\')" type="button" class="btn btn-sm btn-info notify-button">@lang('app.reminder')</button>';
                    $('#buttonBox' + oldParentId + currentApplicationId).html(button);
                }
                $('#buttonBox' + oldParentId + currentApplicationId).attr('id', 'buttonBox' +
                    currentParentId + currentApplicationId);
            } else {
                $('#buttonBox' + oldParentId + currentApplicationId).hide();
                $('#buttonBox' + oldParentId + currentApplicationId).attr('id', 'buttonBox' +
                    currentParentId + currentApplicationId);
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
                    $('#job_application').modal('hide');
                    Toaster('success', 'Status Update Success');

                    // setTimeout(function() {
                    //     location.reload(true);
                    // }, 3000);
                        console.log(response);
                    // if (draggedTaskId !== 0) {
                        $.each(response.success.columnCountByIds, function(key, value) {
                            $('#columnCount_' + value.id).html((value
                                .status_count));
                            $('#columnCount_' + value.id).parents('.board-column')
                                .find('.lobipanel').css('border-color', value
                                    .color);
                        });
                    // }
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
    })
</script>
