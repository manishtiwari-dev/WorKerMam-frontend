<x-app-layout>
    @section('title', 'Transaction Calendar')
    <!--calendar css-->
    <link rel="stylesheet" href="{{ asset('asset/css/fullcalendar/bootstrap/main.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/fullcalendar/core/main.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/fullcalendar/daygrid/main.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/fullcalendar/timegrid/main.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/fullcalendar/list/main.css') }}">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <span class="d-none panel-heading">Expense Calendar</span>

                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript" charset="utf8" src="{{ asset('asset/js/fullcalendar/core/main.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('asset/js/fullcalendar/daygrid/main.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('asset/js/fullcalendar/timegrid/main.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('asset/js/fullcalendar/interaction/main.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('asset/js/fullcalendar/list/main.js') }}"></script>



        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('expense_calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: ['interaction', 'dayGrid', 'timeGrid'],

                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth, timeGridWeek, timeGridDay'
                    },
                    defaultView: 'dayGridMonth',
                    //defaultDate: '2019-08-12',
                    navLinks: true,
                    editable: true,
                    eventLimit: true,
                    eventBackgroundColor: "#F44336",
                    eventBorderColor: "#F44336",
                    timeFormat: 'h:mm',
                    events: [],
                    eventRender: function(info) {
                        $(info.el).addClass('ajax-modal');
                        $(info.el).data("title", "View Income");

                        /*var dotEl = info.el.getElementsByClassName('fc-event-dot')[0];
                        if (dotEl) {
                        if(info.event.extendedProps.status == 'pending'){
                            dotEl.style.backgroundColor = '#FF5B5C';
                        }else if(info.event.extendedProps.status == 'completed'){
                            dotEl.style.backgroundColor = '#5A8DEE'; 
                        }else if(info.event.extendedProps.status == 'cancelled'){
                            dotEl.style.backgroundColor = '#d63031';
                        }else if(info.event.extendedProps.status == 'confirmed'){
                            dotEl.style.backgroundColor = '#39DA8A'; 
                        }
                        }*/
                    },
                    eventClick: function(info) {
                        info.jsEvent.preventDefault();
                    }
                });

                calendar.render();
            });
        </script> --}}
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
                
                foreach ($transactions as $event) {
                    if (!empty($event->txn_title)) {
                        $events = $event->txn_title . ' -  ' . $event->amount;
                    } else {
                        $events = $event->dr_cr . ' -  ' . $event->amount;
                    }
                
                    if ($event->dr_cr == 'cr') {
                        $color = 'event-green';
                    }else if($event->dr_cr == 'dr'){
                        $color = 'event-red';
                    }else {
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
                        // alert(eventDate);
                    }
                });

                calendar.render();
            });
        </script>
    @endpush
</x-app-layout>
