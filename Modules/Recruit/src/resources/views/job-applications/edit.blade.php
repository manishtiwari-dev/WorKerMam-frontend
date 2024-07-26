<x-app-layout>


    @php
        $gender = [
            'male' => 'Male',
            'female' => 'Female',
            'others' => 'Others',
        ];
    @endphp
    @section('title', $pageTitle)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">{{ __('modules.UpdateJobApplication') }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('recruit.job-applications.update', $content->application->id) }}"
                        class="ajax-form needs-validation" method="POST" id="userForm" novalidate
                        enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}

                        <fieldset class="form-fieldset">
                            <legend>@lang('modules.front.personalInformation')</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">@lang('menu.jobs')</label>
                                        <select name="job_id" id="job_id" onchange="getQuestions(this.value)"
                                            class="select2 form-control">
                                            @foreach ($content->jobs as $job)
                                                <option value="{{ $job->id }}"
                                                    @if ($content->application->job_id === $job->id) selected @endif>
                                                    {{ ucwords($job->title) . ' (' . ucwords($job->location->location ?? '') . ') - ' }}{{ $job->active ? 'Active' : 'Deactive' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">@lang('app.name')</label>
                                        <input class="form-control" type="text"
                                            value="{{ $content->application->full_name }}" name="full_name"
                                            placeholder="@lang('app.name')">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">@lang('app.email')</label>
                                        <input class="form-control" type="email" name="email"
                                            value="{{ $content->application->email }}" placeholder="@lang('app.email')">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">@lang('app.phone')</label>
                                        <input class="form-control" type="tel" name="phone"
                                            value="{{ $content->application->phone }}" placeholder="@lang('app.phone')">
                                    </div>
                                </div>

                            </div>
                        </fieldset>
                        <fieldset class="form-fieldset mt-3">
                            <legend>@lang('modules.front.other_information')</legend>
                            <div id="show-columns">
                                @include('Recruit::job-applications.required-columns', [
                                    'job' => $content->application->job,
                                    'application' => $content->application,
                                    'gender' => $gender,
                                ])
                            </div>
                            <div id="show-sections"> 
                                @include('Recruit::job-applications.required-sections', [
                                    'section_visibility' => $content->jobs[0]->section_visibility,
                                    'application' => $content->application,'file_url'=> $content->file_url, 'resume_url'=>$content->resume_url
                                ])

                            </div>
                        </fieldset>
                        <fieldset class="form-fieldset mt-3">
                            <legend>@lang('modules.front.additionalDetails')</legend>
                            @if (count($content->jobQuestion) > 0)
                                <div class="col-md-4" id="questionBoxTitle">
                                    <h5></h5>
                                </div>


                                <div class="col-md-8 pt-4 b-b" id="questionBox">

                                </div>
                            @endif
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label class="control-label">@lang('app.status')</label>
                                    <select name="status_id" id="status_id" class="select2 form-control">
                                        @foreach ($content->statuses as $status)
                                            <option @if ($content->application->status_id == $status->id) selected @endif
                                                value="{{ $status->id }}">{{ ucwords($status->status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                        <button type="submit" id="save-form" class="btn btn-primary mt-3">

                            @lang('app.save')
                        </button>
                        <a href="{{ route('recruit.job-applications.table') }}"
                            class="btn btn-secondary mx-1 mt-3">Cancel</a>



                    </form>
                </div>
            </div>
        </div>
    </div>



    @push('scripts')
        <script>
            const fetchCountryState = "{{ route('recruit.fetchCountryState') }}";
            const csrfToken = "{{ csrf_token() }}";
            const selectCountry = "@lang('modules.front.selectCountry')";
            const selectState = "@lang('modules.front.selectState')";
            const selectCity = "@lang('modules.front.selectCity')";
            const pleaseWait = "@lang('modules.front.pleaseWait')";

            let country = "{{ $content->application->country }}";
            let state = "{{ $content->application->state }}";
        </script>
        <script src="{{ asset('asset/js/location.js') }}"></script>
        <script>
            $(function() {
                $('.datepicker1').datepicker({
                    dateFormat: 'dd/mm/yy',
                    onSelect: function() {
                        var selected = $(this).datepicker("getDate");
                    }
                });

            });


            var datepicker = $('.dob').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                endDate: (new Date()).toDateString(),
            });

            @if ($content->application->dob)
                datepicker.datepicker('setDate', new Date('{{ $content->application->dob }}'))
            @endif

            $('.select2').select2({
                width: '100%'
            });



            var val = $('#job_id').val(); // get Current Selected Job
            if (val != '' && typeof val !== 'undefined') {
                getQuestions(val); // get Questions by question on page load
            }

            // get Questions on change Job
            function getQuestions(id) {
                var url = "{{ route('recruit.job-applications.question', [':id', $content->application->id]) }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: 'GET',
                    url: url,
                    container: '#editForm',
                    success: function(response) {
                        console.log(response);
                        if (response.data.status == "success") {
                            if (response.data.count > 0) { // Question Found for selected job
                                $('#questionBox').show();
                                $('#questionBoxTitle').show();
                                $('#questionBox').html(response.data.view);
                            } else { // Question Not Found for selected job
                                $('#questionBox').hide();
                                $('#questionBoxTitle').hide();
                            }
                            $('#show-columns').html(response.data.requiredColumnsView);
                            $('#show-sections').html(response.data.requiredSectionsView);
                            if (response.data.requiredColumnsView !== '') {
                                var datepicker = $('.dob').datepicker({
                                    autoclose: true,
                                    format: 'yyyy-mm-dd',
                                    endDate: (new Date()).toDateString(),
                                });
                                if (response.data.application.dob !== null) {
                                    $('.dob').datepicker('setDate', new Date(response.data.application.dob));
                                }

                                $('.select2').select2({
                                    width: '100%'
                                });

                                country = response.data.application.country;
                                state = response.data.application.state;

                                var loc = new locationInfo()
                                loc.getCountries()
                            }
                        }
                    }
                });
            }

            function handleFails(response) {

                if (typeof response.responseJSON.errors != "undefined") {
                    var keys = Object.keys(response.responseJSON.errors);
                    $('#editForm').find(".has-error").find(".help-block").remove();
                    $('#editForm').find(".has-error").removeClass("has-error");

                    for (var i = 0; i < keys.length; i++) {
                        // Escape dot that comes with error in array fields
                        var key = keys[i].replace(".", '\\.');
                        var formarray = keys[i];

                        // If the response has form array
                        if (formarray.indexOf('.') > 0) {
                            var array = formarray.split('.');
                            response.responseJSON.errors[keys[i]] = response.responseJSON.errors[keys[i]];
                            key = array[0] + '[' + array[1] + ']';
                        }

                        var ele = $('#editForm').find("[name='" + key + "']");

                        var grp = ele.closest(".form-group");
                        $(grp).find(".help-block").remove();

                        //check if wysihtml5 editor exist
                        var wys = $(grp).find(".wysihtml5-toolbar").length;

                        if (wys > 0) {
                            var helpBlockContainer = $(grp);
                        } else {
                            var helpBlockContainer = $(grp).find("div:first");
                        }
                        if ($(ele).is(':radio')) {
                            helpBlockContainer = $(grp);
                        }

                        if (helpBlockContainer.length == 0) {
                            helpBlockContainer = $(grp);
                        }

                        helpBlockContainer.append('<div class="help-block">' + response.responseJSON.errors[keys[i]] +
                            '</div>');
                        $(grp).addClass("has-error");
                    }

                    if (keys.length > 0) {
                        var element = $("[name='" + keys[0] + "']");
                        if (element.length > 0) {
                            $("html, body").animate({
                                scrollTop: element.offset().top - 150
                            }, 200);
                        }
                    }
                }
            }
        </script>
    @endpush
</x-app-layout>
