@php

    $api_token = request()->cookie('api_token');

    $userdata = Cache::get('userdata-' . $api_token);

@endphp
<x-app-layout>
    @section('title', $pageTitle)
    <div class="card contact-content-body">

        <div class="tab-content">

            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                <div id="website" class="tab-pane show active">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h6 class="tx-15 mg-b-0">{{ __('seo.work_report') }}</h6>
                            <div class="d-flex gap-1">
                                <form action="{{ route('seo.work-report.export') }}" method="POST">
                                    <input type="hidden" name="start_date" id="start_date" />
                                    <input type="hidden" name="end_date" id="end_date" />
                                    <input type="hidden" name="website" id="hide_website" />

                                    <button type="submit" id="export_submit"
                                        class="btn btn-sm btn-bg d-flex align-items-center mg-r-5 btn-primary">
                                        <i class="fa fa-cloud-download" aria-hidden="true"></i>
                                        <span class=" d-sm-inline mg-l-5">{{ __('seo.export') }}</span>
                                    </button>
                                </form>

                                @if ($userdata->userType != 'subscriber')
                                    <a href="{{ route('seo.work-report.import') }}"
                                        class="btn btn-sm btn-bg d-flex align-items-center mg-r-5 btn-primary">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        <span class=" d-sm-inline mg-l-5">{{ __('seo.import') }}</span>
                                    </a>
                                @else
                                    <input type="hidden" name="website_id" id="website_monthly" />
                                @endif

                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-table">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <div class="form-icon position-relative d-flex">
                                        <h5 class="mb-0 d-flex text-dark-grey align-items-center mr-3">
                                            {{ __('seo.date') }}
                                        </h5>
                                        <input type="text" id="datatableRange" name="datatableRange"
                                            class="form-control" placeholder="Start Date To End Date" />
                                    </div>
                                </div>
                                @if ($userdata->userType != 'subscriber')

                                    @if ($userdata->role == 'super_admin' || $userdata->role == 'seomanager')
                                        <div class="form-group col-md-3">
                                            <div class="form-icon position-relative d-flex ">
                                                <p class="mb-0 d-flex text-dark-grey align-items-center mr-3">
                                                    {{ __('seo.website') }}</p>
                                                <select class="form-control select2" name="website_name"
                                                    id="website_name">
                                                    <option selected value="0">{{ __('seo.all_website') }}</option>
                                                    @if (!empty($content->seo_task))
                                                        @foreach ($content->seo_task as $key => $website)
                                                            <option value="{{ $website->id }}"
                                                                {{ request()->website == $website->id ? 'selected' : '' }}>
                                                                {{ $website->website_name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    @else
                                        <div class="form-group col-md-3">
                                            <div class="form-icon position-relative d-flex ">
                                                <p class="mb-0 d-flex text-dark-grey align-items-center mr-3">
                                                    {{ __('seo.website') }}</p>
                                                <select class="form-control select2" name="website_name"
                                                    id="website_name">
                                                    <option selected value="0">{{ __('seo.all_website') }}
                                                    </option>
                                                    @if (!empty($content->seo_task))
                                                        @foreach ($content->seo_task as $key => $website)
                                                            <option value="{{ $website[0]->id }}"
                                                                {{ request()->website == $website[0]->id ? 'selected' : '' }}>
                                                                {{ $website[0]->website_name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <input type="hidden" name="website_name" id="website_id"
                                        value="@if (!empty($web_setting_list->id)) {{ $web_setting_list->id }} @endif" />

                                @endif

                            </div>
                            <div class="table-responsive ">
                                <table class="table  table_wrapper allWebsite" id="website_listing">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p" style="">Task</th>
                                                                
                                            <th class="wd-20p">Website Url</th>
                                            <th class="wd-20p">Posting URL</th>
                                            <th class="wd-20p">Landing URL</th>
                                            <th class="wd-20p" style="">Date</th>

                                        </tr>
                                    </thead>
                                    <tbody class="FilterRespose">
                                        <tr>
                                            <td colspan="5">
                                                <h5 class="text-center mb-0 py-1">{{ __('common.no_record') }}</h4>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>

        <script>
           
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
        <script type="text/javascript">
            $(function() {
                // tableWebContent();


                var start = moment();
                var end = moment();

                function cb(start, end) {
                    $('#datatableRange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

                }

                $('#datatableRange').daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last 6 Month': [moment().subtract(6, 'month'), moment()],
                        'Last Year': [moment().subtract(1, 'year'), moment()]
                    },
                    locale: {
                        format: 'YYYY-MM-D'
                    }
                }, cb);

                cb(start, end);
            });

            $(document).ready(function() {
                @php
                    if (request()->website) {
                        echo 'ajaxSubsmisstionData()';
                    }
                @endphp

                const website_id = $('#website_name').val();
                $('#datatableRange,#website_name').on('change', function(e, data) {
                    ajaxSubsmisstionData();
                });
            });

            $("#export_submit").click(function() {
                var dateRangePicker = $('#datatableRange').data('daterangepicker');
                var startDate = $('#datatableRange').val();
                var website_id = $('#website_name').val();


                if (startDate == '') {
                    startDate = null;
                    endDate = null;
                } else {
                    startDate = dateRangePicker.startDate.format('YYYY-MM-DD');
                    endDate = dateRangePicker.endDate.format('YYYY-MM-DD');
                }


                $("#start_date").val(startDate);
                $("#end_date").val(endDate);
                $("#hide_website").val(website_id);

            });
            // $(document).ready(function() {

            // const website_id = $('#website_name').val();
            // $('#datatableRange,#website_name').on('change', function(e, data) {
            function ajaxSubsmisstionData() {
                var dateRangePicker = $('#datatableRange').data('daterangepicker');
                var startDate = $('#datatableRange').val();
                var website_id = $('#website_name').val();

                if (startDate == '') {
                    startDate = null;
                    endDate = null;
                } else {
                    startDate = dateRangePicker.startDate.format('YYYY-MM-DD');
                    endDate = dateRangePicker.endDate.format('YYYY-MM-DD');
                }


                if (startDate != '' && website_id != '' && endDate != '')
                    $("#website_listing").html('');




                $('#reset-filters').click(function() {
                    $('#filter-form')[0].reset();
                    $('.filter-box .select-picker').selectpicker("refresh");
                    $('#reset-filters').addClass('d-none');
                });

                $("#website_listing").html('');




                tableWebContent(website_id, startDate, endDate);
            }
            //     });
            // });


            function tableWebContent(website_id, startDate, endDate) {

                const url = "{{ route('seo.work-report-url') }}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        website_id: website_id,
                        startDate: startDate,
                        endDate: endDate,

                    },
                    dataType: "json",
                    success: function(result) {
                        console.log(result);
                        var html = `
                            <table class="table table-center bg-white mb-0">
                            <thead>
                            <th class="wd-15p" style="">Task</th>
                                                                
                            <th class="wd-20p">Website Url</th>
                            <th class="wd-20p">Posting URL</th>
                            <th class="wd-20p">Landing URL</th>
                            <th class="wd-20p" style="">Date</th>
                            </thead>
                            </table>
                            `;

                        $.each(result.work_report.seo_task, function(seokey, values) {
                            var seo_id = [];
                            $.each(result.work_report.work_report, function(key, value) {

                                seo_id.push(value.seo_task_id);
                            });


                            if (seo_id.indexOf(values.id) !== -1) {
                                html += `<tr>
                                        <td class="text-black">${values.seo_task_title}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        </tr>`;
 
                                $.each(result.work_report.work_report, function(key, value) {
                                    if (value.seo_setting.seo_task_title != '') {

                                    }

                                    var task_task_title = value.seo_setting.seo_task_title;
                                    if (task_title != null) {
                                        var task_title = value.seo_setting.seo_task_title;
                                    } else {
                                        var task_title = '';
                                    }

                                    var char_value='';
                                    if (value.seo_task_id == values.id){
                                        char_value = value.url;

                                        var web_url = value.submission_website != null ? value
                                            .submission_website.website_url : '';
                                        var land_url = value.landing_url != null ? value.landing_url :
                                            ''
                                        var char = 20;
                                        html += `<tr>
                                            <td></td>
                                            <td>
                                                <a data-toggle="tooltip" data-placement="top" title="${web_url}" href="${web_url}" target="_blank">   ${web_url.slice(0, char) + (web_url.length > char ? "..." : "")} </a>
                                            </td>
                                            <td>
                                                <a data-toggle="tooltip" data-placement="top" title="${value.url}" href="${value.url}" target="_blank"> ${char_value.slice(0, char) + (char_value.length > char ? "..." : "")} </a>
                                            </td>

                                            <td>
                                                <a data-toggle="tooltip" data-placement="top" title="${land_url}" href="${(value.landing_url != null) ? value.landing_url : ''}" target="_blank">  ${land_url.slice(0, char) + (land_url.length > char ? "..." : "")} </a>
                                            </td>
                                            <td>
                                                ${(value.submission_date != null) ? value.submission_date : ''}
                                            </td>
                                        </tr>
                                            `;
                                    }
                                    
                                });

                            }

                            if (seokey === (result.work_report.seo_task).length - 1) {
                                if (seo_id.indexOf(values.id) == -1) {

                                    html += `<tr>
                                            <td colspan="8">
                                                <h5 class="text-center mb-0 py-1">No Record Found</h5>
                                            </td>
                                        </tr>`;
                                }
                            }

                        });

                        html += `</table>
                    </div>`;

                        $("#website_listing").html(html);
                    }

                });

            }

            function inputData() {
                var website_id = '';
                // alert(startDate);
                var currentDate = new Date();

                function pad2(n) {
                    return (n < 10 ? '0' : '') + n;
                }
                var date = new Date();
                var month = pad2(date.getMonth() + 1); //months (0-11)
                var day = pad2(date.getDate()); //day (1-31)
                var year = date.getFullYear();

                var formattedDate = year + "-" + month + "-" + day;

                const url = "{{ route('seo.work-report-url') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        website_id: website_id,
                        startDate: formattedDate,

                    },
                    dataType: "json",
                    success: function(result) {

                        var html = `<table class="table table-center bg-white mb-0">
                            <thead>
                            <th class="wd-20p" style="">Date</th>
                            <th class="wd-20p" style="">Task</th>
                                                                
                            <th class="wd-30p">Posting URL</th>
                            <th class="wd-30p">Landing URL</th>
                            </thead>
                            </table>`;


                        $.each(result.work_report, function(key, value) {

                            // if(value.website_id == website_id ||website_id != ''){

                            html += `<tr>
                                    <td class="px-3">${value.formattedDate}</td>
                                    <td class="px-3">${value.seo_setting.seo_task_title}</td>
                                    
                                    <td class="px-3">${(value.submission_website != null) ? value.submission_website.website_url : null}</td>
                                    <td class="px-3">${value.landing_url}</td>
                                    </tr class="px-3">`;

                        });
                        $(".allWebsite").html(html);


                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
