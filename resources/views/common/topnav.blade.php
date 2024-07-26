<div class="content-search">
    <!-- <i data-feather="search"></i>
    <input type="search" class="form-control" placeholder="Search..."> -->
</div>
@php
    $api_token = App\Helper\Helper::getCurrentuserToken();
    $userdata = Cache::get('userdata-' . $api_token)->user;
    $userdataList = Cache::get('userdata-' . $api_token);
 
   // dd( $userdataList);
    if (!empty($userdataList->currentClockIn->clock_in_time)) {
        $date = $userdataList->currentClockIn->clock_in_time;
        $timeSet = date('h:i A', strtotime($date));
        $currentTime = date('h:i A', strtotime($userdataList->timezone));
    }

@endphp

<nav class="nav">
    <div class="d-flex align-items-center nav-right gap-4">


        @if (!empty($userdataList->is_hrm_module))
        <div id="clock" class="d-flex gap-3">
            <p class="mb-0 text-lg-end text-md-end f-18 fw-bold text-dark-grey d-grid align-items-center">
                <input type="hidden" id="current-latitude" value="{{ $userdataList->locationData->latitude }}"
                    name="current_latitude">
                <input type="hidden" id="current-longitude" value="{{ $userdataList->locationData->longitude }}"
                    name="current_longitude">
                {{ $currentTime ?? '' }}
                @if (!is_null($userdataList->currentClockIn))
                    <span class="f-11 font-weight-normal text-lightest">

                        clockInAt -
                        {{ $timeSet ?? '' }}
                    </span>
                @endif
            </p>

            @if (is_null($userdataList->currentClockIn))
                <a href="#clock-in" data-bs-toggle="modal" class="btn btn-primary btn-bg"><i
                        data-feather="log-in"></i>Clock
                    In</a>
            @endif

            @if (!is_null($userdataList->currentClockIn) && is_null($userdataList->currentClockIn->clock_out_time))
                <a href="#clock" id="clock-out" data-bs-toggle="modal" class="btn btn-sm btn-danger"><i
                        data-feather="log-in"></i>Clock
                    Out</a>
            @endif

        </div>
         @endif


        <div class="dropdown dropdown-notification mt-2"><a href="https://app.e-nnovation.net"
                class="dropdown-link new-indicator" data-toggle="dropdown"><svg width="24" height="24"
                    viewBox="0 0 24 24" fill="white" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-bell ">
                    <g>
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </g>
                </svg><span>12</span></a>
            <div class="dropdown-menu dropdown-menu-right dropdown-notification-sub">
                <div class="dropdown-header d-flex align-items-center justify-content-between">Notifications<p
                        class="tx-right mb-0"> Clear All</p>
                </div>
                <a class="dropdown-item" href="/">
                    <div class="media">
                        <div class="avatar avatar-sm avatar-online"><img src="https://via.placeholder.com/350"
                                class="rounded-circle" alt=""></div>
                        <div class="media-body mg-l-15">
                            <p>Login Activity<br><strong>User Login from. Current ip : 122.160.115.240</strong>
                                <br><span><time datetime="1674082860000">Thu Jan 19 2023 04:31:00 GMT+0530</time></span>
                            </p>
                        </div>
                    </div>
                </a>

                <div class="dropdown-footer"><a href="/">View All Notifications</a></div>
            </div>
        </div>

        <div class="dropdown dropdown-profile">
            <a href="https://app.e-nnovation.net" class="dropdown-link" data-toggle="dropdown" data-display="static">
                <div class="avatar avatar-sm">
                    @php
                        if (!empty($userdataList->profileImg)) {
                            $profileImg = $userdataList->profileImg;
                        } else {
                            $profileImg = 'https://e-nnovation.net/backend/public/storage/images/profile_avatar.png';
                        }
                    @endphp
                    <img src="{{ $profileImg }}" class="rounded-circle" alt="">

                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-profile-sub tx-13">
                <div class="avatar avatar-lg mg-b-15">

                    <img src="{{ $profileImg }}" class="rounded-circle" alt="">
                </div>
                <h6 class="tx-semibold mg-b-5">{{ $userdata->first_name . $userdata->last_name }}</h6><a
                    class="dropdown-item" href="https://app.e-nnovation.net/user/edit/{{ $userdata->id }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="white" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 ">
                        <g>
                            <path d="M12 20h9"></path>
                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                        </g>
                    </svg>Edit Profile</a><a class="dropdown-item"
                    href="https://app.e-nnovation.net/account-setting"><svg width="24" height="24"
                        viewBox="0 0 24 24" fill="white" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-edit-3 ">
                        <g>
                            <path d="M12 20h9"></path>
                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                        </g>
                    </svg>Account Setting</a>
                <a class="dropdown-item" href="https://app.e-nnovation.net/logout"><svg width="24" height="24"
                        viewBox="0 0 24 24" fill="white" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                        <g>
                            <path d="M12 20h9"></path>
                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                        </g>
                    </svg>{{ __('Log Out') }}</a>

            </div>
        </div>


    </div>
    {{-- Clock Modal --}}
    <div class="modal fade" id="clock-in" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" size="xl">
        <div class="modal-dialog" role="document">

            <div class="modal-content tx-14">

                <div class="modal-header">

                    <h6 class="modal-title" id="exampleModalLabel">Clock In</h6>

                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <form class="needs-validation" method="POST" id="userForm" novalidate>

                        {{-- <input name="task_id" id="task_id" type="hidden" class="form-control"> --}}

                        <div class="form-row">

                            <div class="form-group col-lg-12">

                                <label class="form-label">Working From<span class="text-danger">*</span></label>

                                <select name="working_from" id="working_from" class="form-control select2Modal ">
                                    <option selected disabled value="">Select
                                    </option>
                                    <option value="Office">Office</option>
                                    <option value="Home">Home</option>

                                </select>

                                <div class="invalid-feedback">
                                </div>

                            </div>

                        </div>

                        <input type="submit" id="attendSubmit" name="send" class="btn btn-primary"
                            value="Submit">
                        <a href="#" class="btn btn-light mx-1">Cancel </a>

                    </form>

                </div>

            </div>

        </div>
    </div>
    {{-- end modal --}}


    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
        </script>

        <script>
            // start aad modal ajax

            $(document).ready(function() {


                $(document).on('click', "#attendSubmit", function(e) {

                    e.preventDefault();

                    $('#userForm').addClass('was-validated');

                    if ($('#userForm')[0].checkValidity() === false) {

                        event.stopPropagation();

                    } else {
                        var workingFrom = $('#working_from').val();
                        var currentLatitude = document.getElementById("current-latitude").value;
                        var currentLongitude = document.getElementById("current-longitude").value;
                        var token = "{{ csrf_token() }}";


                        console.log(workingFrom);

                        $.ajaxSetup({

                            headers: {

                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                            }

                        });

                        $.ajax({
                            url: "{{ route('hrm.attendances.store_clock_in') }}",
                            type: "POST",

                            container: '#userForm',
                            data: {
                                working_from: workingFrom,
                                currentLatitude: currentLatitude,
                                currentLongitude: currentLongitude,
                                _token: token
                            },
                            success: function(response) {
                                console.log(response);
                                //  alert(response);
                                if (response.success)
                                    Toaster('success', response.message);
                                else
                                    Toaster('error', response.message);

                            },
                            complete: function() {
                                setTimeout(function() {
                                    location.reload(true);
                                }, 3000);
                            },
                        });

                    }

                });

            });
            //end modal


            $(document).ready(function() {
                $('#datetimepicker').datetimepicker({
                    format: ' hh:mm',
                    defaultDate: moment(),
                });


                $(document).on("click", "#clockin", function(e) {
                    e.preventDefault();

                    var time = $(".inClock").val();
                    console.log(time);
                    $('#clockInat').text(`Clock In At` + time);


                });



            });

            $(document).ready(function() {
                $("#clockOut").hide();

            });
        </script>
        <script type="text/javascript">
            @if (!is_null($userdataList->currentClockIn))
                $('#clock-out').click(function() {

                    var token = "{{ csrf_token() }}";
                    var currentLatitude = document.getElementById("current-latitude").value;
                    var currentLongitude = document.getElementById("current-longitude").value;

                    console.log(currentLatitude);
                    $.ajax({
                        url: "{{ route('hrm.attendances.update_clock_in') }}",
                        type: "GET",
                        data: {
                            currentLatitude: currentLatitude,
                            currentLongitude: currentLongitude,
                            _token: token,
                            id: '{{ $userdataList->currentClockIn->id }}'
                        },
                        success: function(response) {
                            if (response.success)
                                Toaster('success', response.message);
                            else
                                Toaster('error', response.message);
                        },

                        complete: function() {
                            setTimeout(function() {
                                location.reload(true);
                            }, 1000);
                        },

                    });
                });
            @endif
        </script>
    @endpush




</nav>
