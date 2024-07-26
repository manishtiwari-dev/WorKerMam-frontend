<x-app-layout>
    @section('title', $pageTitle)
    
    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
        <div class="card contact-content-body">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="tx-15 mg-b-0">{{ __('hrm.holyday_list') }}</h6>

                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                        <div>
                            <a href="{{ route('hrm.holiday.create') }}" class="btn btn-sm btn-bg btn-primary"><i
                                data-feather="plus"></i>{{ __('hrm.add_holyday') }}
                        </a>
                            <a href="#modal1" data-bs-toggle="modal" id="add_title_btn" class="btn btn-sm btn-bg mg-r-5 btn-primary"><i
                                    data-feather="plus"></i><span
                                    class="d-none d-sm-inline mg-l-5">{{ __('hrm.mark_default_holyday') }}</span></a>

                            
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-body">

                <div id='calendar'></div>
            </div>
            <!--Pagination Start-->

            <!--Pagination End-->
        </div>
    @endif

    <!--------------Add Result Modal --------------->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('hrm.mark_holiday') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="add_holiday" novalidate>

                        <div class="row">
                            <div class="col-sm-12">
                                <label class="form-label">{{ __('hrm.mark_day_for_holiday') }}<span
                                        class="text-danger">*</span></label>
                                <div class="form-icon position-relative mt-2">
                                    <div class="row">
                                        <div class="col-md-6 border">
                                            @forelse ($content->holidaysArray as $key => $holidayData)
                                                <label class="form-label mb-0 py-2">{{ $holidayData }}</label>
                                                <input type="checkbox" name="office_holiday_days[]"
                                                    id="{{ $key }}" value="{{ $key }}">
                                                <div class="invalid-feedback">
                                                    <p>{{ __('seo.title_error') }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-md-6 border">

                                            @forelse ($content->holSatArray as $key => $holiSatData)
                                                <label class="form-label  mb-0 py-2">{{ $holiSatData }}</label>
                                                <input type="checkbox" name="office_saturday_days[]"
                                                    id="{{ $key }}" value="{{ $key }}">
                                                <div class="invalid-feedback">
                                                    <p>{{ __('seo.title_error') }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-12 mt-3" required>
                                <input type="button" id="holiday_submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!--------------Add Result Modal --------------->
    <div class="modal fade" id="fullcalender" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Holiday Details</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Events</th>
                                    <th>@lang('app.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                <input type="hidden" id="eventsid" name="id" />
                                <tr>
                                    <td id="events"></td>
                                    <td>
                                        <a href="javascript:;"
                                            class="btn btn-sm btn-danger btn-rounded delete-department"><i
                                                class="fa fa-times"></i>
                                        </a>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <!-------------- Add Result Modal end here --------------->

    @push('scripts')
        @php
            $date = [];
            $occassion = $events_ary = [];
            
            foreach ($content->events as $event) {
                $events_ary_ele = [
                    'title' => $event->occassion,
                    'start' => $event->date,
                    'id' => $event->id,
                ];
                array_push($events_ary, $events_ary_ele);
            }
            
            $events_ary = json_encode($events_ary);
            
        @endphp

        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {

                    initialView: 'dayGridMonth', 
                    events: @php echo $events_ary @endphp,
                    eventClick: function(info) {
                        var eventDate = info.event.title;
                        var id = info.event.id;
                        $('#events').text(eventDate);
                        $('#eventsid').val(id);
                        $("#fullcalender").modal("show");
                        // alert(eventDate);
                    }
                });

                calendar.render();
            });
        </script>

        <script>
            $(document).on("click", "#holiday_submit", function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('hrm.markDayHoliday') }}",
                    type: "POST",
                    data: $('#add_holiday').serialize(),
                    success: function(response) {
                        console.log(response);
                        $('#modal1').removeClass('show');
                        $('#modal1').css('display', 'none');
                        if (response.success) {
                            Toaster('success' , response.success);

                        } else {
                            Toaster('error' , response.error);
                        }

                        setTimeout(function() {
                            location.reload(true);
                        }, 3000);

                        window.location.href = "{{ route('hrm.holiday.index') }}";

                    },


                });
            });


            $('body').on('click', '.delete-department', function() {
                var id = $("#eventsid").val();
                swal({
                        title: `Are you sure you want to delete this record?`,
                        text: "If you delete this, it will be gone forever.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((isConfirm) => {
                        if (isConfirm) {

                            var url = "{{ route('hrm.holiday.destroy', ':id') }}";
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
                                     Toaster('success' , response);
                                    setTimeout(function() {
                                        location.reload(true);
                                    }, 2000);

                                }
                            });
                        }
                    });
            });
        </script>
    @endpush

</x-app-layout>
