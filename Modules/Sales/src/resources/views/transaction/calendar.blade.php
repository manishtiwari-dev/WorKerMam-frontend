<x-app-layout>
    @section('title', 'Transaction Calendar')
    <!--calendar css-->
    <link rel="stylesheet" href="{{ asset('asset/css/fullcalendar/bootstrap/main.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/fullcalendar/core/main.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/fullcalendar/daygrid/main.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/fullcalendar/timegrid/main.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/fullcalendar/list/main.css') }}">
    {{-- @dd($pageCalendarAccess) --}}

    @if (\App\Helper\Helper::CheckPermission($pageCalendarAccess, 'view') == 'true')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <span class="d-none panel-heading">Expense Calendar</span>
                    <!-- Dropdowns for month and year -->
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h6 class="tx-15 mb-0">Transaction Calender</h6>
                            </div>
                            <div class="col-lg-4 d-flex gap-2">
                                @php
                                    $currentmonth = date('m');
                                @endphp
                                <select id="changeMonth" class="form-control select2">
                                    <!-- Populate options with month names -->
                                    <!-- Make sure to handle this dynamically in your code -->
                                    <option value="" selected disabled>Select Month</option>
                                    <option value="0" {{ $currentmonth == '01' ? 'selected' : '' }}>Jaunary
                                    </option>
                                    <option value="1" {{ $currentmonth == '02' ? 'selected' : '' }}>February
                                    </option>
                                    <option value="2" {{ $currentmonth == '03' ? 'selected' : '' }}>March</option>
                                    <option value="3" {{ $currentmonth == '04' ? 'selected' : '' }}>April</option>
                                    <option value="4" {{ $currentmonth == '05' ? 'selected' : '' }}>May</option>
                                    <option value="5" {{ $currentmonth == '06' ? 'selected' : '' }}>June</option>
                                    <option value="6" {{ $currentmonth == '07' ? 'selected' : '' }}>July</option>
                                    <option value="7" {{ $currentmonth == '08' ? 'selected' : '' }}>August
                                    </option>
                                    <option value="8" {{ $currentmonth == '09' ? 'selected' : '' }}>September
                                    </option>
                                    <option value="9" {{ $currentmonth == '10' ? 'selected' : '' }}>October
                                    </option>
                                    <option value="10" {{ $currentmonth == '11' ? 'selected' : '' }}>November
                                    </option>
                                    <option value="11" {{ $currentmonth == '12' ? 'selected' : '' }}>December
                                    </option>
                                    <!-- ...and so on -->
                                </select>
                                @php
                                    $currentYear = date('Y');
                                @endphp
                                <select class="form-control select2" name="year" id="changeYear" required>
                                    <option value="" selected disabled>Select Year</option>
                                    @for ($i = $currentYear - 5; $i <= $currentYear + 15; $i++)
                                        <option value="{{ $i }}"
                                            {{ $i == $currentYear ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-3">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @push('scripts')
        <script type="text/javascript" charset="utf8" src="{{ asset('asset/js/fullcalendar/core/main.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('asset/js/fullcalendar/daygrid/main.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('asset/js/fullcalendar/timegrid/main.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('asset/js/fullcalendar/interaction/main.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('asset/js/fullcalendar/list/main.js') }}"></script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js'></script>
        <style>
            .event-red {
                background-color: red;
            }

            .event-green {
                background-color: green;
            }

            .event-aqua {
                background-color: rgb(101, 114, 101);
            }
        </style>
        <script>
            @php
                $date = [];
                $occassion = $events_ary = [];

                foreach ($content->transactions as $event) {
                    if (!empty($event->txn_title)) {
                        $events = $event->txn_title . ' -  ' . $event->amount;
                    } else {
                        $events = $event->dr_cr . ' -  ' . $event->amount;
                    }

                    if ($event->dr_cr == 'cr') {
                        $color = 'event-green';
                    } elseif ($event->dr_cr == 'dr') {
                        $color = 'event-red';
                    } else {
                        $color = 'event-aqua';
                    }

                    $events_ary_ele = [
                        'title' => $events,
                        'start' => $event->txn_date,
                        'className' => $color,
                    ];
                    array_push($events_ary, $events_ary_ele);
                }

                $events_ary = json_encode($events_ary);

            @endphp
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
                    }
                });

                calendar.render();

                // Change the calendar view on button click 
                $(document).on('change', '#changeMonth, #changeYear', function() {
                    var selectedMonth = document.getElementById('changeMonth').value;
                    var selectedYear = document.getElementById('changeYear').value;

                    if (calendar) {
                        var currentDate = new Date(selectedYear, selectedMonth, 1);
                        calendar.gotoDate(currentDate);
                    } else {
                        console.error('Calendar object is null or undefined.');
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
