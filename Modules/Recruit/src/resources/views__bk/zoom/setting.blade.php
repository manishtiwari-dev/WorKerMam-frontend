<x-app-layout>
    @push('scripts')
        <link rel="stylesheet" href="{{ asset('asset/css/iCheck/all.css') }}">

        <style>
            .field-icon {
                float: right;
                cursor: pointer;
                margin-left: -25px;
                margin-top: -25px;
                position: relative;
                z-index: 2;
            }

            .hide-box {
                display: none;
            }
        </style>
    @endpush
    @section('title', 'Settings')

    
    <div class="contact-content">
        <div class="contact-content-header mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"><a href="#job-category"
                        class="nav-link {{ request()->tab == 'job-category' || !isset(request()->tab) ? 'active' : '' }} "
                        data-bs-toggle="tab">{{ __('modules.job_category') }}</a></li>
                <li class="nav-item"><a href="#skills" class="nav-link {{ request()->tab == 'skills' ? 'active' : '' }}"
                        data-bs-toggle="tab">{{ __('modules.skills') }}</a></li>
                <li class="nav-item"><a href="#location"
                        class="nav-link {{ request()->tab == 'location' ? 'active' : '' }}"
                        data-bs-toggle="tab">{{ __('modules.location') }}</a></li>
                <li class="nav-item"><a href="#zoom-setting"
                        class="nav-link {{ request()->tab == 'zoom-setting' ? 'active' : '' }}"
                        data-bs-toggle="tab">{{ __('modules.zoom_setting') }}</a></li>
            </ul>

        </div>
        <div class=" contact-content-body">
            <div class="tab-content">
                <div id="job-category"
                    class="tab-pane {{ request()->tab == 'job-category' || !isset(request()->tab) ? 'active' : '' }} ">
                    <div class="row">
                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center justify-content-between ">
                                            <h6 class="tx-15 mg-b-0">{{ __('modules.joblist') }}</h6>
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                                <a href="{{ route('recruit.job-categories.create') }}"
                                                    class="btn btn-sm btn-primary d-flex align-items-center mg-r-5"><i
                                                        data-feather="plus"></i><span class="d-none d-sm-inline mg-l-5">
                                                        @lang('modules.addJobCategory')</span></a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive m-t-40">
                                            <table id="myTable" class="table table_wrapper ">
                                                <thead>
                                                    <tr>
                                                        <th style="width:30%;">#</th>
                                                        <th style="width:30%;">@lang('app.name')</th>
                                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                            <th style="width:40%;" class="text-center">@lang('app.action')
                                                            </th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($content->job_category as $key => $category)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $category->name }}</td>
                                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                                                <td class="d-flex justify-content-center gap-2">
                                                                    <a href="{{ url('recruit/job-categories/' . $category->id . '/edit') }}"
                                                                        class="btn btn-sm  d-flex align-items-center  px-0"><svg
                                                                            viewBox="0 0 24 24" width="24"
                                                                            height="24" stroke="currentColor"
                                                                            stroke-width="2" fill="none"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" class="css-i6dzq1">
                                                                            <path
                                                                                d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                                            </path>
                                                                        </svg><span
                                                                            class="d-sm-inline mg-l-5"></span></a>
                                                            @endif

                                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'remove') == 'true')
                                                                <a href="" id="delete_cate"
                                                                    data-id="{{ $category->id }}" value=""
                                                                    data-toggle="modal"
                                                                    class="btn btn-sm  d-flex align-items-center px-0"><svg
                                                                        viewBox="0 0 24 24" width="24"
                                                                        height="24" stroke="currentColor"
                                                                        stroke-width="2" fill="none"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="css-i6dzq1">
                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                        <path
                                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                        </path>
                                                                    </svg><span
                                                                        class="d-none d-sm-inline mg-l-5"></span></a>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5">
                                                                <h5 class="text-center mb-0 py-1">No Record Found !</h4>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div id="skills" class="tab-pane {{ request()->tab == 'skills' ? 'active' : '' }}">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between ">
                                        <h6 class="tx-15 mg-b-0">{{ __('modules.skills') }}</h6>
                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                            <a href="{{ route('recruit.skills.create') }}"
                                                class="btn btn-sm btn-primary d-flex align-items-center mg-r-5"><i
                                                    data-feather="plus"></i><span class="d-none d-sm-inline mg-l-5">
                                                    @lang('modules.addSkills')</span></a>
                                        @endif
                                    </div>
                                </div>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                                    <div class="card-body">
                                        <div class="table-responsive m-t-40">
                                            <table id="myTable" class="table  table_wrapper ">
                                                <thead>
                                                    <tr>
                                                        <th style="width:25%;">#</th>
                                                        <th style="width:25%;">@lang('app.name')</th>
                                                        <th style="width:25%;">@lang('menu.jobCategories')</th>
                                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                            <th style="width:25%;" class="text-center">@lang('app.action')
                                                            </th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($content->skills as $key => $skill)
                                                        <tr>
                                                            <td style="width:25%;">{{ $key + 1 }}</td>
                                                            <td style="width:25%;">{{ $skill->name }}</td>
                                                            <td style="width:25%;">
                                                                @if (!empty($skill->category))
                                                                    {{ $skill->category->name }}
                                                                @endif
                                                            </td>
                                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                                                <td class="btn btn-sm  d-flex justify-content-center  px-0 gap-2">
                                                                    <a href="{{ url('recruit/skills/' . $skill->id . '/edit') }}"
                                                                        class="btn btn-sm  px-0"><svg
                                                                            viewBox="0 0 24 24" width="24"
                                                                            height="24" stroke="currentColor"
                                                                            stroke-width="2" fill="none"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            class="css-i6dzq1">
                                                                            <path
                                                                                d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                                            </path>
                                                                        </svg><span
                                                                            class="d-sm-inline mg-l-5"></span></a>
                                                            @endif
                                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'remove') == 'true')
                                                                <a href="" id="delete_skill"
                                                                    data-id="{{ $skill->id }}" value=""
                                                                    data-toggle="modal"
                                                                    class="btn btn-sm  d-flex align-items-center px-0"><svg
                                                                        viewBox="0 0 24 24" width="24"
                                                                        height="24" stroke="currentColor"
                                                                        stroke-width="2" fill="none"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="css-i6dzq1">
                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                        <path
                                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                        </path>
                                                                    </svg><span
                                                                        class="d-none d-sm-inline mg-l-5"></span></a>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5">
                                                                <h5 class="text-center mb-0 py-1">No Record Found !
                                                                    </h4>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div id="location" class="tab-pane {{ request()->tab == 'location' ? 'active' : '' }}">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between ">
                                        <h6 class="tx-15 mg-b-0">{{ __('modules.job_location') }}</h6>
                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                            <a href="{{ route('recruit.job-location.create') }}"
                                                class="btn btn-sm btn-primary d-flex align-items-center mg-r-5"><i
                                                    data-feather="plus"></i><span class="d-none d-sm-inline mg-l-5">
                                                    @lang('modules.addJobLocation')</span></a>
                                        @endif
                                    </div>
                                </div>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                                    <div class="card-body">
                                        <div class="table-responsive m-t-40">
                                            <table id="myTable" class="table  table_wrapper ">
                                                <thead>
                                                    <tr>
                                                        <th style="width:20%;">#</th>
                                                        <th style="width:27%;">@lang('menu.locations')</th>
                                                        <th style="width:28%;">@lang('app.country')</th>
                                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                            <th style="width:25%;">@lang('app.action')</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($content->locations as $key => $location)
                                                        <tr>
                                                            <td style="width:20%;">{{ $key + 1 }}</td>
                                                            <td style="width:27%;">{{ $location->location }}</td>
                                                            <td style="width:28%;">
                                                                @if (!empty($location->country))
                                                                    {{ $location->country->countries_name }}
                                                                @endif
                                                            </td>
                                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                                <td style="width:25%;"
                                                                    class="btn btn-sm  d-flex justify-content-center  px-0 gap-2">
                                                                    <a href="{{ url('recruit/job-location/' . $location->id . '/edit') }}"
                                                                        class="btn btn-sm   px-0"><svg
                                                                            viewBox="0 0 24 24" width="24"
                                                                            height="24" stroke="currentColor"
                                                                            stroke-width="2" fill="none"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            class="css-i6dzq1">
                                                                            <path
                                                                                d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                                            </path>
                                                                        </svg><span
                                                                            class="d-sm-inline mg-l-5"></span></a>
                                                            @endif
                                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'remove') == 'true')
                                                                <a href="" id="delete_btn"
                                                                    data-id="{{ $location->id }}" value=""
                                                                    data-toggle="modal"
                                                                    class="btn btn-sm  d-flex align-items-center px-0"><svg
                                                                        viewBox="0 0 24 24" width="24"
                                                                        height="24" stroke="currentColor"
                                                                        stroke-width="2" fill="none"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="css-i6dzq1">
                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                        <path
                                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                        </path>
                                                                    </svg><span
                                                                        class="d-none d-sm-inline mg-l-5"></span></a>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5">
                                                                <h5 class="text-center mb-0 py-1">No Record Found !
                                                                    </h4>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div id="zoom-setting" class="tab-pane {{ request()->tab == 'zoom-setting' ? 'active' : '' }}">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between ">
                                <h6 class="tx-15 mg-b-0">@lang($pageTitle)</h6>
                            </div>
                        </div>
                        <div class="card-body" aria-expanded="true">
                            <div class="panel-body">

                                <form action="{{ route('recruit.setting.updateZoom') }}" method="POST"
                                    id="">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $content->zoom->id ?? '' }}" />
                                    <div class="form-body setting-tab">
                                        <div class="mb-3 d-flex gap-2">
                                            <div class="checkbox icheck">
                                                <label>
                                                    <div class="icheckbox_flat-green" aria-checked="false"
                                                        aria-disabled="false" style="position: relative;">
                                                        <input type="checkbox"
                                                            @if ($content->zoom->enable_zoom ?? '' == 1) checked @endif
                                                            name="enable_zoom" id="enable_zoom" class="flat-red"
                                                            style="position: absolute; opacity: 0;">
                                                        <ins class="iCheck-helper"
                                                            style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                    </div>

                                                </label>
                                            </div>
                                            <label class="required">@lang('modules.zoomsetting.enableSetting')</label>


                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-md-6 ">
                                                <div class="form-group">
                                                    <label class="required">@lang('modules.zoomsetting.zoomapikey')</label>
                                                    <input type="password" name="api_key" id="api_key"
                                                        value="{{ $content->zoom->api_key ?? '' }}"
                                                        class="form-control">
                                                    <span class="fa fa-fw fa-eye field-icon toggle-password me-2"></span>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="required">@lang('modules.zoomsetting.zoomapisecret')</label>
                                                    <input type="password" name="secret_key" id="secret_key"
                                                        value="{{ $content->zoom->secret_key ?? '' }}"
                                                        class="form-control">
                                                    <span class="fa fa-fw fa-eye field-icon toggle-password me-2"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div class="form-group">
                                                    <label>@lang('modules.zoomsetting.openZoomApp')</label>
                                                    <div class="radio-list d-flex gap-2">
                                                        <label class="radio-inline p-0 mb-0">
                                                            <div class="radio radio-info  d-flex gap-2">
                                                                <input type="radio" name="meeting_app"
                                                                    @if ($content->zoom->meeting_app ?? '' == 'zoom_app') checked @endif
                                                                    id="zoom_app" value="zoom_app">
                                                                <label for="zoom_app" class="mb-0">@lang('app.yes')</label>
                                                            </div>
                                                        </label>
                                                        <label class="radio-inline mb-0">
                                                            <div class="radio radio-info  d-flex gap-2">
                                                                <input type="radio" name="meeting_app"
                                                                    @if ($content->zoom->meeting_app ?? '' == 'in_app') checked @endif
                                                                    id="in_app" value="in_app">
                                                                <label for="in_app" class="mb-0">@lang('app.no')</label>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="mail_from_name">@lang('app.webhook')</label>
                                                    <p class="text-info">(@lang('modules.zoomsetting.webhookInfo'))</p>
                                                </div>
                                            </div>

                                        </div>
                                        <!--/row-->
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" id="update-form" class="btn btn-primary">
                                            @lang('app.update')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--start delete modal-->
    <div class="modal fade effect-scale" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('seo.delete_submission') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_location_id" name="input_field_id">
                    <p class="mg-b-0">{{ __('common.delete_confirmation') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('common.no') }}
                    </button>
                    <button type="button" class="btn btn-primary delete_submit_location"
                        id="">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--End delete modal-->


    <!--start delete modal-->
    <div class="modal fade effect-scale" id="delete_skill_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('seo.delete_submission') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_skill_id" name="input_field_id">
                    <p class="mg-b-0">{{ __('common.delete_confirmation') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('common.no') }}
                    </button>
                    <button type="button" class="btn btn-primary delete_submit_skill"
                        id="">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--End delete modal-->

    <!--start delete modal-->
    <div class="modal fade effect-scale" id="delete_category" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('seo.delete_submission') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_job_category_id" name="input_field_id">
                    <p class="mg-b-0">{{ __('common.delete_confirmation') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('common.no') }}
                    </button>
                    <button type="button" class="btn btn-primary delete_submit_category"
                        id="">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--End delete modal-->


    @push('scripts')
        <script src="{{ asset('asset/js/iCheck/icheck.min.js') }}"></script>

        <script>
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

            elems.forEach(function(html) {
                var switchery = new Switchery(html, {
                    size: 'medium'
                });
            });
            $('#enable_zoom').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
            })


            $('body').on('click', '.toggle-password', function() {
                var $selector = $(this).parent().find('input.form-control');
                $(this).toggleClass("fa-eye fa-eye-slash");
                var $type = $selector.attr("type") === "password" ? "text" : "password";
                $selector.attr("type", $type);
            });
        </script>

        <script>
            $(document).ready(function() {

                $(document).on("click", "#delete_btn", function() {
                    var location_id = $(this).attr("data-id");

                    $('#delete_location_id').val(location_id);
                    $('#delete_modal').modal('show');
                });

                $(document).on('click', '.delete_submit_location', function() {
                    var location_id = $('#delete_location_id').val()

                    $('#delete_modal').modal('show');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: "{{ url('recruit/job-location') }}/" + location_id,
                        data: {
                            location_id: location_id,
                            _method: 'DELETE'
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                Toaster("success", response.success);

                                setTimeout(function() {
                                    location.reload(true);
                                }, 3000);
                                window.location.href =
                                    "{{ route('recruit.setting.index', ['tab=location']) }}";

                            } else {
                                Toaster("error", response.error);
                            }
                        }
                    });

                });
            });
        </script>

        <script>
            $(document).ready(function() {

                $(document).on("click", "#delete_skill", function() {
                    var skill_id = $(this).attr("data-id"); 

                    $('#delete_skill_id').val(skill_id);
                    $('#delete_skill_modal').modal('show');
                });

                $(document).on('click', '.delete_submit_skill', function() {
                    var skill_id = $('#delete_skill_id').val()

                    $('#delete_modal').modal('show');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: "{{ url('recruit/skills') }}/" + skill_id,
                        data: {
                            skill_id: skill_id,
                            _method: 'DELETE'
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                Toaster("success", response.success);

                                setTimeout(function() {
                                    location.reload(true);
                                }, 3000);
                                window.location.href =
                                    "{{ route('recruit.setting.index', ['tab=skills']) }}";

                            } else {
                                Toaster("error", response.error);
                            }
                        }
                    });

                });
            });
        </script>

        <script>
            $(document).ready(function() {

                $(document).on("click", "#delete_cate", function() {
                    var category_id = $(this).attr("data-id");

                    $('#delete_job_category_id').val(category_id);
                    $('#delete_category').modal('show');
                });

                $(document).on('click', '.delete_submit_category', function() {
                    var category_id = $('#delete_job_category_id').val()

                    $('#delete_modal').modal('show');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        // url: "{{ url('departmentDestroy') }}/" + department_id,
                        url: "{{ url('recruit/job-categories') }}/" + category_id,
                        data: {
                            category_id: category_id,
                            _method: 'DELETE'
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                Toaster("success", response.success);

                                setTimeout(function() {
                                    location.reload(true);
                                }, 3000);
                                window.location.href =
                                    "{{ route('recruit.setting.index', ['tab=job-category']) }}";

                            } else {
                                Toaster("error", response.error);
                            }
                        }
                    });

                });
            });
        </script>
    @endpush
</x-app-layout>
