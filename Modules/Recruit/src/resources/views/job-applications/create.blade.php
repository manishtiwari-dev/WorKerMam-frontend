<x-app-layout>
    @section('title', $pageTitle)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">{{ __('modules.AddJobApplication') }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($content->jobs) == 0)
                        <div class="alert alert-danger alert-dismissible fade show">
                            <h4 class="alert-heading"><i class="fa fa-warning"></i> Warning!</h4>
                            <p>You do not have any job created. You need to create the job first to add the job
                                application.
                                <a href="{{ route('recruit.jobs.create') }}" class="btn btn-info btn-sm m-l-15"
                                    style="text-decoration: none;"><i class="fa fa-plus-circle"></i> @lang('app.createNew')
                                    @lang('menu.jobs')</a>
                            </p>
                        </div>
                    @else
                        <form action="{{ route('recruit.job-applications.store') }}" class="ajax-form needs-validation"
                            method="POST" id="userForm" novalidate enctype="multipart/form-data">
                            @csrf

                            <fieldset class="form-fieldset">
                                <legend>@lang('modules.front.personalInformation')</legend>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">@lang('menu.jobs')</label>
                                            <select name="job_id" id="job_id" onchange="getQuestions(this.value)"
                                                class="select2 form-control" required>
                                                @foreach ($content->jobs as $job)
                                                    <option value="{{ $job->id }}">
                                                        {{ ucwords($job->title) . ' (' . ucwords($job->location->location ?? '') . ')' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                <p>Please select job</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label required">@lang('app.email')</label>
                                            <input class="form-control" type="email" name="email"
                                                placeholder="@lang('app.email')" required>
                                            <div class="invalid-feedback">
                                                <p>Please enter email</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label required">@lang('app.name')</label>
                                            <input class="form-control" type="text" name="full_name"
                                                placeholder="@lang('app.name')" required>
                                            <div class="invalid-feedback">
                                                <p>Please enter full name</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label required">@lang('app.phone')</label>
                                            <input class="form-control" type="tel" name="phone"
                                                placeholder="@lang('app.phone')" required>
                                            <div class="invalid-feedback">
                                                <p>Please enter job phone</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </fieldset>


                            <fieldset class="form-fieldset mt-3">
                                <legend>@lang('modules.front.other_information')</legend>
                                <div id="show-columns">
                                    @include('Recruit::job-applications.required-columns', [
                                        'job' => $content->jobs[0],
                                        'gender' => $content->gender,
                                    ])
                                </div>
                                <div id="show-sections">
                                    @include('Recruit::job-applications.required-sections', [
                                        'section_visibility' => $content->jobs[0]->section_visibility,
                                    ])
                                </div>
                            </fieldset>
                            <fieldset class="form-fieldset mt-3">
                                <legend>@lang('modules.front.additionalDetails')</legend>
                                <div class="col-md-4" id="questionBoxTitle">

                                </div>
                                <div class="col-md-8 pt-4" id="questionBox">

                                </div>
                            </fieldset>

                            <button type="submit" id="" class="btn btn-primary mt-3">
                                Submit</button>
                            <a href="{{ route('recruit.job-applications.index') }}"
                                class="btn btn-secondary mx-1 mt-3">Cancel</a>


                        </form>
                    @endif
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

            let country = "";
            let state = "";
        </script>
        <script src="{{ asset('asset/js/location.js') }}"></script>
       
        <script>  

            var datepicker = $('.dob').datepicker({ 
                dateFormat: 'dd/mm/yy',
                onSelect: function() {
                    var selected = $(this).datepicker("getDate");
                }
            });


            $('.select2').select2({
                width: '100%'
            });

            $('#save-form').click(function() {
                $.ajax({
                    url: '{{ route('recruit.job-applications.store') }}',
                    container: '#createForm',
                    type: "POST",
                    redirect: true,
                    file: true,
                    data: $('#createForm').serialize(),
                    error: function(response) {
                        handleFails(response);
                    }
                })
            });

            var val = $('#job_id').val(); // get Current Selected Job
            if (val != '' && typeof val !== 'undefined') {
                getQuestions(val); // get Questions by question on page load
            }

            // get Questions on change Job
            function getQuestions(id) {
                var url = "{{ route('recruit.job-applications.question', ':id') }}";
                url = url.replace(':id', id);

                $.ajax({
                    type: 'GET',
                    url: url,
                    container: '#createForm',
                    success: function(response) {
                        console.log(response.data);
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

                                $('.select2').select2({
                                    width: '100%'
                                });

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
                    $('#createForm').find(".has-error").find(".help-block").remove();
                    $('#createForm').find(".has-error").removeClass("has-error");

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

                        var ele = $('#createForm').find("[name='" + key + "']");

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
