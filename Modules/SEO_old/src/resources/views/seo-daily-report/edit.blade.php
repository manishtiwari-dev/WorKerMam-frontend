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
                        class="btn btn-sm btn-bg d-flex align-items-center mg-r-5 btn-primary"><i class="fa fa-cog"
                            aria-hidden="true"></i><span class=" d-sm-inline mg-l-5">Duplicate Checker</span></a>

                </div>
            </div>

            @foreach ($seo_task_listing as $key => $listing)
                @if ($listing->no_of_submission)
                    @php
                        $sl_no = 0;
                        $count_report = 0;
                    @endphp

                    <div class="card-body mt-3 table-wrapper">
                        <h5 class="pb-2 tx-14 border-bottom mb-3">
                            @if ($listing->seotaskresult != null)
                                {{ $listing->seotaskresult->seo_task_title }}
                            @endif
                        </h5>
                        <form id="save-website-data-{{ $listing->id }}" method="post"
                            class="needs-validation novalidate" novalidate>
                            <input type="hidden" name="website_id" value="{{ $website_listing->id }}">
                            <input type="hidden" name="seo_task_id" id="taskID" value="{{ $listing->seo_task_id }}">
                            <input type="hidden" name="total_report" value="{{ $listing->no_of_submission }}">
                            <div class="table-responsive" id="department">
                                <table class="table  table_wrapper">
                                    <thead>
                                        <tr> 
                                            <th class="border-bottom "> {{ __('common.sl_no') }}</th>
                                            <th class="border-bottom " style="min-width: 220px;">
                                                {{ __('seo.website_url') }}
                                            </th>
                                            <th class="border-bottom " style="min-width: 220px;">
                                                {{ __('seo.posting_website') }}
                                            </th>
                                            <th class="border-bottom ">{{ __('seo.landing_url') }}</th>
                                            <th class="border-bottom ">{{ __('seo.do_follow') }}</th>
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

                                                    <input
                                                        class="form-control web_url website_url_{{ $sl_no }}_{{ $listing->seo_task_id }}"
                                                        data-id="{{ $listing->seotaskresult->id }}" type="text"
                                                        id=" websiteUrl" name="website_url_{{ $sl_no }}"
                                                        value="{{ $report->url ?? '' }}">
                                                    @error('website_url')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>

                                                <td class="d-flex">
                                                    <div class="col-md-9">

                                                        <select
                                                            class="select2   show-menu-arrow   @error('postingWebsite_{{ $sl_no }}') is-invalid @enderror"
                                                            id="postingWebsite_{{ $sl_no }}_{{ $listing->seo_task_id }}"
                                                            name="postingWebsite_{{ $sl_no }}"
                                                            data-live-search="true" title="{{ __('seo.select') }}">
                                                            <option selected disabled value="">Select</option>
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
                                                        <a href="javascript:voide(0);"
                                                            title="@lang('app.add') @lang('modules.jobs.jobType')" id=""
                                                            class="btn btn-sm  btn-outline addpostingurl"
                                                            data-id="{{ $listing->seotaskresult->id }}"><i
                                                                class="fa fa-plus"></i></a>

                                                        <input type="hidden" name="web_name" id="web_name"
                                                            value="{{ $website_name }}" />
                                                    </div>
                                                </td>
                                                <td class="">
                                                    <input class="form-control landingUrl" type="text"
                                                        name="landing_url_{{ $sl_no }}"
                                                        value="{{ $report->landing_url ?? '' }}"
                                                        data-landingId="{{ $report->id }}" data-seo_task_id="{{ $listing->seotaskresult->id  }}" data-website_id="{{ $website_name }}">
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox"
                                                            class="custom-control-input website_toggle_class"
                                                            {{ $report->linktype == 1 ? 'checked' : '' }}
                                                            id="customSwitch_{{ $listing->seo_task_id }}_{{ $sl_no }}"
                                                            name="do_follow_{{ $sl_no }}">

                                                        <input type="hidden" name="do_follow_{{ $sl_no }}"
                                                            id="do_follow">

                                                        <label class="custom-control-label"
                                                            for="customSwitch_{{ $listing->seo_task_id }}_{{ $sl_no }}"></label>

                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach

                                        @php
                                            $submission_no = $listing->no_of_submission - $count_report;
                                        @endphp
                                        @if ($submission_no)
                                            @for ($a = 1; $a <= $submission_no; $a++)
                                                @php
                                                    $sl_no++;
                                                @endphp
                                                <tr>
                                                    <td class="">{{ $sl_no }}</td>
                                                    <td class="">

                                                        <input
                                                            class="form-control web_url website_url_{{ $sl_no }}_{{ $listing->seo_task_id }}"
                                                            data-id="{{ $listing->seotaskresult->id }}" type="text"
                                                            name="website_url_{{ $sl_no }}"
                                                            id="website_url_{{ $sl_no }}">
                                                        @error('website_url')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </td>
                                                    <td class="d-flex">
                                                        <div class="col-md-9">

                                                            <select
                                                                class="select2  show-menu-arrow form-control   @error('postingWebsite_{{ $sl_no }}') is-invalid @enderror"
                                                                id="postingWebsite_{{ $sl_no }}_{{ $listing->seo_task_id }}"
                                                                name="postingWebsite_{{ $sl_no }}"
                                                                title="{{ __('seo.select') }}" data-live-search="true">
                                                                @if (!empty($listing->website_submission))
                                                                    @foreach ($listing->website_submission as $submission)
                                                                        @if (!empty($submission) && !empty($submission->website_url))
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
                                                                    class="btn btn-sm  btn-outline addpostingurl border"
                                                                    data-id="{{ $listing->seotaskresult->id }}"><i
                                                                        class="fa fa-plus"></i></a>
                                                            @endif

                                                            <input type="hidden" name="web_name" id="web_name"
                                                                value="{{ $website_name }}" />
                                                        </div>

                                                    </td>
                                                    <td class="">
                                                        <input class="form-control landingUrl" type="text"
                                                            name="landing_url_{{ $sl_no }}" />
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox"
                                                                class="custom-control-input dofollow_toggle_class"
                                                                data-id=""
                                                                id="customSwitchss_{{ $listing->seo_task_id }}_{{ $sl_no }}"
                                                                name="do_follow_{{ $sl_no }}">

                                                            <input type="hidden"
                                                                name="do_follow_{{ $sl_no }}" id="do_follow"
                                                                value="">

                                                            <label class="custom-control-label"
                                                                for="customSwitchss_{{ $listing->seo_task_id }}_{{ $sl_no }}"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endfor
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">

                                <input type="button" class="btn btn-primary  save-website-form tx-13"
                                    form-id="{{ $listing->id }}" value="{{ __('common.update') }}" />
                            </div>
                        </form>
                    </div>
                @endif

            @endforeach
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

    @push('scripts')
        <script>
            $('.addpostingurl').click(function() {
                var task_id = $(this).attr("data-id");
                var web_name = $("#web_name").val();
                var url = "{{ route('seo.work-posting-update') }}?id=" + task_id + "&" + "web_name=" + web_name
                $('.modal-title').html("<i class='icon-plus'></i> Add Posting Website");
                $.ajaxModal('#addPostingModal', url);
                $('#addPostingModal').modal('show');

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

                            setTimeout(function() {
                                location.reload(true);
                            }, 1500);

                        }
                    })

                });
            });

            $(document).ready(function() {
                $('.dofollow_toggle_class').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 0;

                    $("#do_follow").val(status);
                });
            });
        </script>

        <script>
            var i = 0;

            $(document).on("click", ".save-department", function() {
                var task_id = $("#seo_task_id").val();

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
                    book_mark: $("#book_mark").val(),
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
                            var da = ('#postingWebsite_' + i + '_' + task_id);

                            var options = [];
                            var rData = [];
                            rData = response.data;
                            var html = ``;

                            $('#postingWebsite_' + i + '_' + task_id).empty();
                            $.each(rData, function(index, value) {


                                var newitemID = value.id;
                                var data = value.website_url;
                                html +=
                                    `<option value="${value.id}" selected="">${value.website_url}</option>`;

                            });

                            $("#postingWebsite_" + i + '_' + task_id).append(html);


                            $('#addPostingModal').modal('hide');

                            toastr.success(response.success);
                        }
                    });
                }
            }); 

            $(document).ready(function() {
                $('.website_toggle_class').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 0;
                    console.log(status);
                    $("#do_follow").val(status);
                });

                $(".web_url").on("blur", function() {
                    let currentWebUrl = $(this).val();
                    if (!currentWebUrl.startsWith("https://")) {
                        $(this).val("https://" + currentWebUrl);
                    }
 
                });


                $(".landingUrl").on("blur", function() {

                    let landingField = $(this); 
                    let landing_Url = landingField.val();
                    if (!landing_Url.startsWith("https://")) {
                        $(this).val("https://" + landing_Url);
                    }
                    let reportId = landingField.data('landingid');

                    let website_id = landingField.data('website_id');
                    let seo_task_id = landingField.data('seo_task_id');
 

                    if (landing_Url.length > 0) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ route('seo.landingUrlCheck') }}",
                            data: {
                                landing_url: landing_Url,
                                reportId: reportId,
                                website_id: website_id,
                                seo_task_id: seo_task_id,
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data.success) { 
                                    
                                    toastr.success(data.success);
                                    landingField.val('');
                                } else {

                                }
                            }
                        });
                    }


                });

            });


            function extractBaseUrl(input) {
                const url = input.value.trim();

                var extractedDomain = extractDomain(url);

                input.value = extractedDomain;
            }


            function extractDomain(url) {
                var domain = new URL(url).hostname;
                return domain;
            }

            function DomainVal(input) {

                const inputValue = input.value;

                var errorMessage = $('#errorMsg');

                if (parseInt(inputValue) > 100) {
                    errorMessage.show();
                } else {
                    errorMessage.hide();
                }

            };

            function spamVal(input) {

                const inputValue = input.value;

                var errorMessage = $('#errorSpamMsg');

                if (parseInt(inputValue) > 10) {
                    errorMessage.show();
                } else {
                    errorMessage.hide();
                }

            };
        </script>
    @endpush
</x-app-layout>
