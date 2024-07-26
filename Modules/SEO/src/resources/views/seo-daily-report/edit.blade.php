<x-app-layout>
    <style>
        .bootstrap-select.show-menu-arrow.open>.dropdown-toggle,
        .bootstrap-select.show-menu-arrow.show>.dropdown-toggle {
            z-index: 0 !important;
        }
    </style>

    @section('title', 'Daily Work')
    <div class="card">
        <div class="tab-content">

            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="tx-15 mg-b-0">{{ $website_name }}</h6> 
                    <a href="{{ route('seo.duplicate-checker', $website_listing->id) }}"
                        class="btn btn-sm btn-bg d-flex align-items-center mg-r-5"><i data-feather="plus"></i><span
                            class="d-none d-sm-inline mg-l-5">Duplicate Checker</span></a>

                </div>
            </div> 
            <div class="card-header">
                <div class="col-md-12">
                    <input type="hidden" name="website_task_id" id="website_task_id" value="{{ $website_listing->id }}">
                    <div class="d-flex">
                        <div class="col-3">
                        <h5>Filter By Task</h5>
                        </div>
                        <div class="col-6">
                        <select class="form-control" id="taskSearch"> 
                            <option>Select Task</option>
                            @foreach ($seo_task_listing as $key => $listing)
                            @if ($listing->no_of_submission)
                            @if ($listing->seotaskresult != null)
                            <option value="{{ $listing->seotaskresult->id }}">{{ $listing->seotaskresult->seo_task_title }}</option>
                            @endif
                            @endif
                            @endforeach
                        </select>
                        </div>
                    </div>
                </div>
            </div>
            <div id="posting-webiste-data">
            @foreach ($seo_task_listing as $key => $listing)
                @if ($listing->no_of_submission)
                    @php
                        $sl_no = 0;
                        $count_report = 0;
                    @endphp
                    <div class="card-body">
                        <h5>
                            @if ($listing->seotaskresult != null)
                                {{ $listing->seotaskresult->seo_task_title }}
                            @endif
                        </h5>
                       
                    </div>
                    <div class="card-body">
                        <form id="save-website-data-{{ $listing->id }}" method="post">
                            <input type="hidden" name="website_id" value="{{ $website_listing->id }}">
                            <input type="hidden" name="seo_task_id" value="{{ $listing->seo_task_id }}">
                            <input type="hidden" name="total_report" value="{{ $listing->no_of_submission }}" ?>
                            <div class="" id="department">
                                <table class="table border table_wrapper">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom p-3"> {{ __('common.sl_no') }}</th>
                                            <th class="border-bottom p-3" style="min-width: 220px;">
                                                {{ __('seo.website_url') }}
                                            </th>
                                            <th class="border-bottom p-3" style="min-width: 220px;">
                                                {{ __('seo.posting_website') }}
                                            </th>
                                            <th class="border-bottom p-3">{{ __('seo.landing_url') }}</th>
                                            <th class="border-bottom p-3">{{ __('seo.do_follow') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($listing->work_report as $report)
                                            @php
                                                $sl_no++;
                                                $count_report = count((array) $listing->work_report);
                                            @endphp

                                            <tr>
                                                <td class="">{{ $sl_no }}</td>
                                                <td>
                                                    <input type="hidden" name="update_id_{{ $sl_no }}"
                                                        value="{{ $report->id ?? '' }}">
                                                    <input class="form-control" type="text"
                                                        name="website_url_{{ $sl_no }}"
                                                        value="{{ $report->url ?? '' }}">
                                                    @error('website_url')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>

                                                <td class="d-flex">
                                                    <div class="col-md-9"> 
                                                        <select class="selectsearch show-menu-arrow"
                                                            id="postingWebsite_{{ $sl_no }}_{{ $listing->seo_task_id }}"
                                                            name="postingWebsite_{{ $sl_no }}"
                                                            data-live-search="true" title="{{ __('seo.select') }}">
                                                            @foreach ($listing->website_submission as $submission)
                                                                <option
                                                                    @if ($report->submission_websites_id == $submission->id) selected @endif
                                                                    value="{{ $submission->id }}">
                                                                    {{ $submission->website_url }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a href="javascript:;"
                                                            title="@lang('app.add') @lang('modules.jobs.jobType')" id=""
                                                            class="btn btn-sm btn-info btn-outline addpostingurl"
                                                            data-id="{{ $listing->seotaskresult->id }}" data-no="{{ $sl_no }}"><i
                                                                class="fa fa-plus"></i></a>
                                                                  

                                                        <input type="hidden" name="web_name" id="web_name"
                                                            value="{{ $website_name }}" />
                                                    </div>
                                                </td>
                                                <td class="">
                                                    <input class="form-control" type="text"
                                                        name="landing_url_{{ $sl_no }}"
                                                        value="{{ $report->landing_url ?? '' }}">
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox"
                                                            class="custom-control-input dofollo_toggle_class"
                                                            {{ $report->linktype == 1 ? 'checked' : '' }}
                                                            id="customSwitch_{{ $report->id }}_{{ $listing->seo_task_id }}"
                                                            name="do_follow_{{ $sl_no }}">

                                                        <label class="custom-control-label"
                                                            for="customSwitch_{{ $report->id }}_{{ $listing->seo_task_id }}"></label>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach

                                        @php
                                            $submission_no = $listing->no_of_submission - $count_report;
                                        @endphp
                                        @if ($submission_no)
                                            @for ($a = 1; $a <= $submission_no; $a++)
                                            
                                                <tr>
                                                    <td class="">{{ $a + $sl_no }}</td>
                                                    <td class="">
                                                        <input class="form-control" type="text"
                                                            name="website_url_{{ $a + $sl_no }}">
                                                        @error('website_url')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </td>
                                                    <td class="d-flex">
                                                        <div class="col-md-9">


                                                            <select class="selectsearch show-menu-arrow form-control"
                                                                id="postingWebsite_{{ $a + $sl_no }}_{{ $listing->seo_task_id }}"
                                                                name="postingWebsite_{{ $a + $sl_no }}"
                                                                title="{{ __('seo.select') }}" data-live-search="true">
                                                                @if (!empty($listing->website_submission))
                                                                    @foreach ($listing->website_submission as $submission) 
                                                                        @if (!empty($submission))
                                                                            <option value="{{ $submission->id }}">
                                                                                {{ $submission->website_url }}
                                                                            </option>
                                                                        @endif 
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            @if (!empty($listing->seotaskresult->id))
                                                                <a href="javascript:;"
                                                                    title="@lang('app.add') @lang('modules.jobs.jobType')"
                                                                    id=""
                                                                    class="btn btn-sm btn-info btn-outline addpostingurl"
                                                                    data-id="{{ $listing->seotaskresult->id }}" data-no="{{ $a + $sl_no }}"><i
                                                                        class="fa fa-plus"></i></a>
                                                            @endif

                                                           

                                                            <input type="hidden" name="web_name" id="web_name"
                                                                value="{{ $website_name }}" />
                                                        </div>

                                                    </td>
                                                    <td class="">
                                                        <input class="form-control" type="text"
                                                            name="landing_url_{{ $a + $sl_no }}" />
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox"
                                                                class="custom-control-input dofollo_toggle_class"
                                                                data-id=""
                                                                id="customSwitchss_{{ $a + $sl_no }}_{{ $listing->seo_task_id }}"
                                                                name="do_follow_{{ $a + $sl_no }}">

                                                            <label class="custom-control-label"
                                                                for="customSwitchss_{{ $a + $sl_no }}_{{ $listing->seo_task_id }}"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endfor
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3 px-2 text-center">
                                <input type="button" class="btn btn-primary  save-website-form"
                                    form-id="{{ $listing->id }}" value="{{ __('common.update') }}" />
                            </div>
                        </form>
                    </div>
                @endif

            @endforeach
            </div>
        </div>
    </div>




    {{-- Ajax Modal Start for --}}
    <div class="modal fade bs-modal-md in" id="addPostingModal" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="icon-plus"></i> Add Posting Website</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                            class="fa fa-times"></i></button>
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


    @push('scripts')
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>

        <script>
            $(document).ready(function() {

            $(document).on("click", '.addpostingurl', function() {

            //$('.addpostingurl').click(function() {
                // var data = {
                var task_id = $(this).attr("data-id");
                var sl_no = $(this).data("no"); 
               
                var web_name = $("#web_name").val();
               
                // };
                var url = "{{ route('seo.work-posting-update') }}?id=" + task_id + "&" + "web_name=" + web_name + "&" + "sl_no=" + sl_no
                $('.modal-title').html("<i class='icon-plus'></i> Add Posting Website");
                $.ajaxModal('#addPostingModal', url);
                $('#addPostingModal').modal('show');
            });
        });




            $(document).ready(function() {
                $('.selectsearch').selectpicker();
                //  $(".selectsearch").selectize();
            });

            $(document).ready(function() {
                $('.save-website-form').click(function() {
                    const url = "{{ route('seo.work-report-update', $website_listing->id) }}";
                    var formID = $(this).attr('form-id');


                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url,
                        formID: formID,
                        container: '#save-website-data-' + formID,
                        type: "POST",
                        data: $('#save-website-data-' + formID).serialize(),
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.success);
                            } else {
                                toastr.error(response.error);
                            }
                            location.reload();

                        }
                    })

                });
            });

            $(document).ready(function() {
                $('#taskSearch').change(function() {
                    const url = "{{ route('seo.task-search') }}";
                    
                    var data = {
                            task_id: $(this).val(), 
                            website_id: $("#website_task_id").val(), 
                        };

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url, 
                        type: "POST",
                        data: data,
                        success: function(response) {
                            console.log(response.html);
                            $("#posting-webiste-data").empty();
                             $("#posting-webiste-data").html(response.html);
                        }
                    })

                });
            });




            // $(document).ready(function() {
            //     $('.dofollo_toggle_class').change(function() {
            //         let status = $(this).prop('checked') === true ? 1 : 0;

            //         $("#do_follo").val(status);
            //     });
            // });
            // $(document).ready(function() {
            //     $('.dofollow_toggle_class').change(function() {
            //         let status = $(this).prop('checked') === true ? 1 : 0;

            //         $("#do_follows").val(status);
            //     });
            // });
        </script>


        <script>
            $(document).ready(function() {
                $('.website_toggle_class').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 2;

                    $("#do_follow").val(status);
                });
            });

            var i = 0;
            $(document).on("click", ".save-department", function() {
                var task_id = $("#seo_task_id").val();
                var sl_no_id = $("#sl_no_id").val();
                i++;
                var data = {
                    website_id: $("#website").val(),
                    seo_task_id: $("#seo_task_id").val(),
                    website_url: $("#website_url").val(),
                    website_username: $("#website_username").val(),
                    email: $("#email").val(),
                    website_password: $("#website_password").val(),
                    da: $("#da").val(),
                    spam_score: $("#website_spam_score").val(),
                    do_follow: $("#do_follow").val(),
                };
                $('#submission_update').addClass('was-validated');
                if ($('#submission_update')[0].checkValidity() === false) {
                    event.stopPropagation();
                } else {


                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('seo.work-posting-store') }}",
                        data: data,
                        dataType: "json", 
                        success: function(response) {
                            console.log(response);
                            var da = ('#postingWebsite_' + sl_no_id + '_' + task_id);

                            var options = [];
                            var rData = [];
                            rData = response.data;
                            var html =``;
                            
                            $('#postingWebsite_' + sl_no_id + '_' + task_id).empty();
                            $.each(rData, function(index, value) {


                            var newitemID = value.id;
                            var data = value.website_url;

                            html += `<option value="${newitemID}"  >${data}</option>`;

                            });

                            $("#postingWebsite_" + sl_no_id + '_' + task_id).append(html);

                            $('#addPostingModal').modal('hide');

                            $("#postingWebsite_" +  sl_no_id + '_' + task_id).selectpicker("refresh");

                            //  location.reload();
                            toastr.success(response.success);
                        }
                    });
                }

            });

            $(document).ready(function() {
                $('.website_toggle_class').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 0;

                    $("#do_follow").val(status);
                });
            });

 
            function extractBaseUrl(input) {
                // Get the value from the input field
                var inputUrl = $(input).val();

                // Extract the base URL
                var baseUrl = new URL(inputUrl).origin;

                // Display the base URL in the modal
                $("#website_url").val(baseUrl);
            } 

 
            function DomainVal(input) {
                // Get the input value
                var inputValue = $(input).val();

                // Convert the input value to a number
                var numericValue = parseFloat(inputValue);

                // Check if the value is greater than 100
                if (isNaN(numericValue) || numericValue > 100) {
                    // Display error message
                    $('#error-message').text('Please enter a value less than or equal to 100.').show();
                } else {
                    // Hide error message
                    $('#error-message').hide();
                }
            }

            function spamVal(input) {
                // Get the input value
                var inputValue = $(input).val();

                // Convert the input value to a number
                var numericValue = parseFloat(inputValue);

                // Check if the value is greater than 100
                if (isNaN(numericValue) || numericValue > 10) {
                    // Display error message
                    $('#error-message-spam-score').text('Please enter a value less than or equal to 10.').show();
                } else {
                    // Hide error message
                    $('#error-message-spam-score').hide();
                }
            }

        </script>
    @endpush
</x-app-layout>
