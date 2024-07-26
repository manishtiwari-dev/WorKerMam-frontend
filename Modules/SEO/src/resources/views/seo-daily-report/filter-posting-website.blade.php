@foreach ($seo_task_listing as $key => $listing)
@if ($listing->no_of_submission)
@if($listing->seotaskresult != '')
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
@endif

@endforeach
 