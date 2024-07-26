<!--start add modal-->
<div class="modal fade" id="source_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">{{ __('crm.add_lead_source') }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <form method="POST" id="source_add_userForm" class="needs-validation mg-b-0" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <label class="form-label">{{ __('crm.source_name') }}<span
                                    class="text-danger">*</span></label>
                            <input name="source_name" id="addsource_name" type="text" class="form-control"
                                placeholder="{{ __('crm.source_name_placeholder') }}" required>
                            <span class="text-danger">
                                @error('source_name')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('crm.source_name_error') }}
                            </div>
                        </div>
                    </div>
                    <input type="submit" id="Add_Source_Submit" name="send" class="btn btn-primary"
                        value="{{ __('common.submit') }}">
                </form>
            </div>
        </div>
    </div>
</div>
<!--end add modal-->

<!-- MOdal start -->
<div class="modal fade" id="status_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">{{ __('crm.add_lead_status') }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <form method="POST" id="status_add_userForm" class="needs-validation mg-b-0" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <label class="form-label">{{ __('crm.status_name') }}<span
                                    class="text-danger">*</span></label>
                            <input name="status_name" id="addstatus_name" type="text" class="form-control"
                                placeholder="{{ __('crm.status_name_placeholder') }}" required>
                            <span class="text-danger">
                                @error('status_name')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('crm.status_name_error') }}
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <label class="form-label">{{ __('crm.status_color') }}<span
                                    class="text-danger"></span></label>
                            <div id="" class="input-group cp4">
                                <input type="text" class="form-control input-lg" id="status_color"
                                    name="status_color" placeholder="{{ __('crm.status_color_placeholder') }}"
                                     />
                                <span class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                            </div>
                            <span class="text-danger">
                                @error('status_color')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('crm.tags_color_error') }}
                            </div>
                        </div>
                    </div>
                    <input type="submit" id="Add_status_submit" name="send" class="btn btn-primary"
                        value="{{ __('common.submit') }}">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal store end -->
>

<!--  start modal store -->
<div class="modal fade" id="industry_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">{{ __('crm.add_lead_group') }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <form method="POST" id="industry_add_userForm" class="needs-validation mg-b-0" novalidate>
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <label class="form-label">{{ __('crm.group_name') }}<span
                                    class="text-danger">*</span></label>
                            <input name="industry_name" id="add_industry_name" type="text" class="form-control"
                                placeholder="{{ __('crm.industry_name_placeholder') }}" required>
                            <span class="text-danger">
                                @error('industry_name')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('crm.industry_name_error') }}
                            </div>
                        </div>
                    </div>
                    <input type="submit" id="industry_submit" name="send" class="btn btn-primary"
                        value="{{ __('common.submit') }}">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal store end -->

<!--  start modal store -->
<div class="modal fade" id="lead_Setting_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">{{ __('crm.add_lead_agent') }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <form method="POST" id="agent_add_userForm" class="needs-validation mg-b-0" novalidate>
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <label class="form-label">{{ __('crm.agent_name') }}<span
                                    class="text-danger">*</span></label>
                            <input name="agent_name" id="agent_name" type="text" class="form-control"
                                placeholder="{{ __('crm.agent_name_placeholder') }}" required>
                            <span class="text-danger">
                                @error('agent_name')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('crm.agent_name_error') }}
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <label class="form-label">{{ __('crm.communication_id') }}<span
                                    class="text-danger"></span></label>
                            <input name="communication" id="communication" type="text" class="form-control"
                                placeholder="{{ __('crm.communication_placeholder') }}">
                            <span class="text-danger">
                                @error('communication')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('crm.communication_error') }}
                            </div>
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="form-label">{{ __('crm.role') }}<span class="text-danger"></span></label>
                            <select class="form-select form-control dept_user_department" id=""
                                name="role">
                                <option selected disable value="" disabled>{{ __('crm.select_dept') }}</option>

                                @if (!empty($content->role_list))
                                    @foreach ($content->role_list as $dept)
                                        <option value="{{ $dept->roles_id }}"> {{ $dept->roles_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="text-danger">
                                @error('role')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('crm.department_name_error') }}
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <label class="form-label">{{ __('crm.user') }}<span class="text-danger"></span></label>
                            <select class="form-select form-control departmentUser" id="" name="user">
                                <option selected disable value="" disabled>{{ __('crm.select_user') }}</option>

                            </select>
                            <span class="text-danger">
                                @error('user')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('crm.user_name_error') }}
                            </div>
                        </div>
                    </div>
                    <input type="submit" id="agent_submit" name="send" class="btn btn-primary"
                        value="{{ __('common.submit') }}">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal store end -->

<!--  start modal store -->
<div class="modal fade" id="lead_tags_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">{{ __('crm.add_tags') }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <form method="POST" id="tags_add_userForm" class="needs-validation mg-b-0" novalidate>
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <label class="form-label">{{ __('crm.tags_name') }}<span
                                    class="text-danger">*</span></label>
                            <input name="tags_name" id="tags_name" type="text" class="form-control"
                                placeholder="{{ __('crm.tags_name_placeholder') }}" required>
                            <span class="text-danger">
                                @error('tags_name')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('crm.tags_name_error') }}
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <label class="form-label">{{ __('crm.tags_color') }}<span
                                    class="text-danger">*</span></label>
                            <div id="cp2" class="input-group">
                                <input type="text" class="form-control input-lg" id="tags_color"
                                    name="tags_color" placeholder="{{ __('crm.tags_color_placeholder') }}"
                                    required />
                                <span class="input-group-append">
                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                </span>
                            </div>
                            <span class="text-danger">
                                @error('tags_color')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('crm.tags_color_error') }}
                            </div>
                        </div>
                    </div>
                    <input type="submit" id="tags_submit" name="send" class="btn btn-primary"
                        value="{{ __('common.submit') }}">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal store end -->

<x-app-layout>
    @section('title', $pageTitle)

    <div class="contact-content">
        <div class="contact-content-header mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" id="leadSource"><a href="#lead-source"
                        class="nav-link {{ request()->tab == 'source' || !isset(request()->tab) ? 'active' : '' }}"
                        data-bs-dismiss="tab">{{ __('crm.lead_source') }}</a></li>
                <li class="nav-item" id="leadStatus"><a href="#lead-status"
                        class="nav-link {{ request()->tab == 'lead-status' ? 'active' : '' }}"
                        data-bs-dismiss="tab">{{ __('crm.lead_status') }}</a></li>
                <li class="nav-item" id="leadIndustry"><a href="#lead-group"
                        class="nav-link {{ request()->tab == 'lead-group' ? 'active' : '' }}"
                        data-bs-dismiss="tab">{{ __('crm.lead_group') }}</a></li>

                <li class="nav-item" id="leadSetting"><a href="#lead-setting"
                        class="nav-link {{ request()->tab == 'lead-setting' ? 'active' : '' }}"
                        data-bs-dismiss="tab">{{ __('crm.lead_agent') }}</a></li>
                <li class="nav-item" id="leadTag"><a href="#lead-tag"
                        class="nav-link {{ request()->tab == 'lead-tag' ? 'active' : '' }}"
                        data-bs-dismiss="tab">{{ __('crm.tags') }}</a></li>
            </ul>

        </div>
        <div class="card contact-content-body">
            <div class="tab-content">
                <div id="lead-source"
                    class="tab-pane {{ request()->tab == 'source' || !isset(request()->tab) ? 'active' : '' }}">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h6 class="tx-15 mg-b-0">{{ __('crm.lead_source_list') }}</h6>
                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                            <button type="button" data-bs-target="#source_add" data-bs-dismiss="modal" data-bs-toggle="modal"
                                    class="btn btn-sm btn-primary d-flex align-items-center"><i
                                        data-feather="plus"></i><span
                                        class="d-none d-sm-inline mg-l-5">{{ __('crm.add_lead_source') }}</span></button>
                            @endif
                        </div>
                    </div>
                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table  table_wrapper">
                                    <thead>
                                        <tr>
                                            <th>{{ __('common.sl_no') }}</th>
                                            <th>{{ __('crm.source_name') }}</th>
                                            <th>{{ __('crm.sort_order') }}</th>
                                            <th>{{ __('common.status') }}</th>
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                <th class="text-center wd-10p">{{ __('common.action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($content->source_list))
                                            @foreach ($content->source_list as $key => $source)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $source->source_name }}</td>
                                                    <td>
                                                        <input type="number"
                                                            class="col-xs-1 source_sort_order width1 text-center"
                                                            data-source_id="{{ $source->source_id }}" placeholder=""
                                                            value="{{ $source->sort_order ?? '' }}"
                                                            style="width:50px;">
                                                    </td>
                                                    <td>

                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox"
                                                                class="custom-control-input source_toggle_class"
                                                                {{ $source->status == '1' ? 'checked' : '' }}
                                                                data-id="{{ $source->source_id }}"
                                                                id="customSwitch{{ $source->source_id }}">
                                                            <label class="custom-control-label"
                                                                for="customSwitch{{ $source->source_id }}"></label>
                                                        </div>
                                                    </td>
                                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                        <td class="d-flex align-items-center justify-content-center">

                                                            <a href="#modalEditResult"
                                                                data-id="{{ $source->source_id }}"
                                                                data-bs-dismiss="modal" data-bs-toggle="modal"
                                                                class="btn btn-sm  d-flex align-items-center mg-r-5 result_edit_btn"><i
                                                                    data-feather="edit-2"></i><span
                                                                    class="d-none d-sm-inline mg-l-5"></span></a>

                                                        </td>
                                                    @endif

                                                </tr>
                                            @endforeach

                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
                <div id="lead-status" class="tab-pane  {{ request()->tab == 'lead-status' ? 'active' : '' }}">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h6 class="tx-15 mg-b-0">{{ __('crm.lead_status_list') }}</h6>
                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                <a href="#status_add" data-bs-dismiss="modal" data-bs-toggle="modal"
                                    class="btn btn-sm btn-primary d-flex align-items-center"><i
                                        data-feather="plus"></i><span
                                        class="d-none d-sm-inline mg-l-5">{{ __('crm.add_lead_status') }}</span></a>
                            @endif
                        </div>
                    </div>
                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table  table_wrapper">
                                    <thead>
                                        <tr>
                                            <th>{{ __('common.sl_no') }}</th>
                                            <th>{{ __('crm.status_name') }}</th>
                                            <th>{{ __('crm.status_color') }}</th>
                                            <th>{{ __('crm.sort_order') }}</th>
                                            <th>{{ __('common.status') }}</th>

                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                <th class="text-center wd-10p">{{ __('common.action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($content->status_list))
                                            @foreach ($content->status_list as $key => $status)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $status->status_name }}</td>
                                                    <td>
                                                        <div id="" class="input-group status_color">
                                                            <input type="text" class="col-xs-1 status_color width1"
                                                                id="status_color"
                                                                data-status_color="{{ $status->status_id }}"
                                                                name="status_color"
                                                                value="{{ $status->status_color ?? '' }}"
                                                                placeholder="Choose Color" style="width:80px;" />
                                                            <span class="input-group-append">
                                                                <span
                                                                    class="input-group-text colorpicker-input-addon"><i></i></span>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="col-xs-1 sort_order width1 text-center"
                                                            data-status_id="{{ $status->status_id }}" placeholder=""
                                                            value="{{ $status->sort_order ?? '' }}"
                                                            style="width:50px;">
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox"
                                                                class="custom-control-input status_toggle_class"
                                                                {{ $status->status == '1' ? 'checked' : '' }}
                                                                data-id="{{ $status->status_id }}"
                                                                id="customSwitcs{{ $status->status_id }}">
                                                            <label class="custom-control-label"
                                                                for="customSwitcs{{ $status->status_id }}"></label>
                                                        </div>
                                                    </td>

                                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                        <td class="text-center">

                                                            <a href="#modalEditStatus"
                                                                data-id="{{ $status->status_id }}"
                                                                data-bs-dismiss="modal" data-bs-toggle="modal"
                                                                class="btn btn-sm   align-items-center mg-r-5 status_edit_btn"><i
                                                                    data-feather="edit-2"></i><span
                                                                    class="d-none d-sm-inline mg-l-5"></span></a>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach

                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                </div>

                <div id="lead-group" class="tab-pane {{ request()->tab == 'lead-group' ? 'active' : '' }}">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h6 class="tx-15 mg-b-0">{{ __('crm.lead_group_list') }}</h6>
                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                <a href="#industry_add" data-bs-dismiss="modal" data-bs-toggle="modal"
                                    class="btn btn-sm btn-primary d-flex align-items-center"><i
                                        data-feather="plus"></i><span
                                        class="d-none d-sm-inline mg-l-5">{{ __('crm.add_lead_group') }}</span></a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                            <div class="table-responsive">
                                <table class="table  table_wrapper">
                                    <thead>
                                        <tr>
                                            <th>{{ __('common.sl_no') }}</th>
                                            <th>{{ __('crm.group_name') }}</th>
                                            <th>{{ __('crm.sort_order') }}</th>
                                            <th>{{ __('common.status') }}</th>
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                <th class="text-center wd-10p">{{ __('common.action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($content->industry_list))
                                            @foreach ($content->industry_list as $key => $industry)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $industry->group_name }}</td>
                                                    <td>
                                                        <input type="number"
                                                            class="col-xs-1 industry_sort_order width1 text-center"
                                                            data-industry_id="{{ $industry->id }}" placeholder=""
                                                            value="{{ $industry->sort_order ?? '' }}"
                                                            style="width:50px;">
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox"
                                                                class="custom-control-input industry_toggle_class"
                                                                {{ $industry->status == '1' ? 'checked' : '' }}
                                                                data-id="{{ $industry->id }}"
                                                                id="customSwitchss{{ $industry->id }}">
                                                            <label class="custom-control-label"
                                                                for="customSwitchss{{ $industry->id }}"></label>
                                                        </div>
                                                    </td>
                                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                        <td class="text-center">

                                                            <a href="#modalindusrtyStatus"
                                                                data-id="{{ $industry->id }}" data-bs-dismiss="modal" data-bs-toggle="modal"
                                                                class="btn btn-sm  d-flex align-items-center mg-r-5 indusrty_edit_btn"><i
                                                                    data-feather="edit-2"></i><span
                                                                    class="d-none d-sm-inline mg-l-5"></span></a>

                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach

                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
                <div id="lead-setting" class="tab-pane {{ request()->tab == 'lead-setting' ? 'active' : '' }}">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h6 class="tx-15 mg-b-0">{{ __('crm.lead_agent') }}</h6>
                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                <a href="#lead_Setting_add" data-bs-dismiss="modal" data-bs-toggle="modal"
                                    class="btn btn-sm btn-primary d-flex align-items-center"><i
                                        data-feather="plus"></i><span
                                        class="d-none d-sm-inline mg-l-5">{{ __('crm.add_lead_agent') }}</span></a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table_wrapper">
                                <thead>
                                    <tr>
                                        <th>{{ __('common.sl_no') }}</th>
                                        <th>{{ __('crm.agent_name') }}</th>
                                        <th>{{ __('crm.communication_id') }}</th>
                                        <th>{{ __('crm.user_name') }}</th>
                                        <th>{{ __('crm.sort_order') }}</th>
                                        <th>{{ __('common.status') }}</th>
                                        <th class="text-center wd-10p">{{ __('common.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($content->agent_list))
                                        @foreach ($content->agent_list as $key => $agent)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $agent->agent_name }}</td>

                                                <td>{{ $agent->communication_id }}</td>
                                                <td>
                                                    @if (!empty($agent->crm_user->staff_name))
                                                        {{ $agent->crm_user->staff_name ?? '' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="number" class="col-xs-1 agent_sort_order width1 text-center"
                                                        data-agent_id="{{ $agent->agent_id }}" placeholder=""
                                                        value="{{ $agent->sort_order ?? '' }}" style="width:50px;">
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox"
                                                            class="custom-control-input agent_toggle_class"
                                                            {{ $agent->status == '1' ? 'checked' : '' }}
                                                            data-id="{{ $agent->agent_id }}"
                                                            id="customSwitchs{{ $agent->agent_id }}">
                                                        <label class="custom-control-label"
                                                            for="customSwitchs{{ $agent->agent_id }}"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#agentstatusedit" data-id="{{ $agent->agent_id }}"
                                                        data-bs-dismiss="modal" data-bs-toggle="modal"
                                                        class="btn btn-sm  align-items-center mg-r-5 agent_edit_btn"><i
                                                            data-feather="edit-2"></i><span
                                                            class="d-none d-sm-inline mg-l-5"></span></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="lead-tag" class="tab-pane {{ request()->tab == 'lead-tag' ? 'active' : '' }}">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h6 class="tx-15 mg-b-0">{{ __('crm.tags') }}</h6>
                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                <a href="#lead_tags_add" data-bs-dismiss="modal" data-bs-toggle="modal"
                                    class="btn btn-sm btn-primary d-flex align-items-center"><i
                                        data-feather="plus"></i><span
                                        class="d-none d-sm-inline mg-l-5">{{ __('crm.add_tags') }}</span></a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table_wrapper">
                                <thead>
                                    <tr>
                                        <th>{{ __('common.sl_no') }}</th>
                                        <th>{{ __('crm.tags_name') }}</th>
                                        <th>{{ __('crm.tags_color') }}</th>
                                        <th>{{ __('crm.sort_order') }}</th>
                                        <th>{{ __('common.status') }}</th>
                                        <th class="text-center wd-10p">{{ __('common.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($content->tag_list))
                                        @foreach ($content->tag_list as $key => $tag)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $tag->tags_name }}</td>
                                                <td>
                                                    <span class="badge"
                                                        style="background-color: {{ $tag->tags_color ?? '' }} ;">{{ $tag->tags_color }}</span>

                                                </td>
                                                <td>
                                                    <input type="number" class="col-xs-1 tags_sort_order width1"
                                                        data-tags_id="{{ $tag->tags_id }}" placeholder=""
                                                        value="{{ $tag->sort_order ?? '' }}" style="width:50px;">
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox"
                                                            class="custom-control-input tags_toggle_class"
                                                            {{ $tag->status == '1' ? 'checked' : '' }}
                                                            data-id="{{ $tag->tags_id }}"
                                                            id="customSwitches{{ $tag->tags_id }}">
                                                        <label class="custom-control-label"
                                                            for="customSwitches{{ $tag->tags_id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#tagstatusedit" data-id="{{ $tag->tags_id }}"
                                                        data-bs-dismiss="modal" data-bs-toggle="modal"
                                                        class="btn btn-sm  align-items-center mg-r-5 tags_edit_btn"><i
                                                            data-feather="edit-2"></i><span
                                                            class="d-none d-sm-inline mg-l-5"></span></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-------------- Edit source Modal --------------->
    <div class="modal fade" id="modalEditResult" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('crm.update_lead_source') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form class="needs-validation novalidate" id="edit_result_title_form" novalidate>
                        <input type="hidden" name="input_field_id" id="edit_input_field">
                        <div class="form-row">
                            <div class="form-group col-lg-12 px-2 mb-0">
                                <label class="form-label">{{ __('crm.source_name') }}<span
                                        class="text-danger">*</span></label>
                                <input name="source_name" id="editsource_name" type="text" class="form-control"
                                    placeholder="{{ __('crm.source_name_placeholder') }}" required>
                                <span class="text-danger">
                                    @error('source_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('crm.source_name_error') }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 mt-4" required>
                                <input type="submit" id="add_title_submit" class="btn btn-primary" value="Update">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--------------Edit source Modal end here --------------->

    <!-------------- Edit status Modal --------------->
    <div class="modal fade" id="modalEditStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('crm.update_lead_ststus') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form class="needs-validation novalidate" id="edit_status_title_form" novalidate>

                        <input name="source_id" id="hidden_status_id" type="hidden" class="form-control">
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('crm.status_name') }}<span
                                        class="text-danger">*</span></label>
                                <input name="status_name" id="edit_status_name" type="text" class="form-control"
                                    placeholder="{{ __('crm.status_name_placeholder') }}" required>
                                <span class="text-danger">
                                    @error('status_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('crm.status_name_error') }}
                                </div>
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('crm.status_color') }}<span
                                        class="text-danger">*</span></label>
                                <div id="" class="input-group cp4">
                                    <input type="text" class="form-control input-lg" id="edit_status_color"
                                        name="status_color" placeholder="{{ __('crm.status_color_placeholder') }}"
                                        required />
                                    <span class="input-group-append">
                                        <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                    </span>
                                </div>
                                <span class="text-danger">
                                    @error('status_color')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('crm.tags_color_error') }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 mt-4" required>
                                <input type="submit" id="add_title_submit" class="btn btn-primary" value="Update">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--------------Edit status Modal end here --------------->

    <!-------------- Edit industry Modal --------------->
    <div class="modal fade" id="modalindusrtyStatus" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('crm.update_lead_industry') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form class="needs-validation novalidate" id="edit_industry_title_form" novalidate>

                        <input name="industry_id" id="hidden_industry_id" type="hidden" class="form-control ps-5">
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('crm.group_name') }}<span
                                        class="text-danger">*</span></label>
                                <input name="industry_name" id="edit_industry_name" type="text"
                                    class="form-control" placeholder="{{ __('crm.industry_name_placeholder') }}"
                                    required>
                                <span class="text-danger">
                                    @error('industry_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('crm.industry_name_error') }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 mt-4" required>
                                <input type="submit" id="add_title_submit" class="btn btn-primary" value="Update">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--------------Edit industry Modal end here --------------->


    <!-------------- Edit agent Modal --------------->
    <div class="modal fade" id="agentstatusedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('crm.update_lead_agent') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form class="needs-validation novalidate" id="edit_agent_title_form" novalidate>

                        <input name="agent_id" id="hidden_agent_id" type="hidden"
                            class="form-control ps-5 hidden_agent_id">
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('crm.agent_name') }}<span
                                        class="text-danger">*</span></label>
                                <input name="agent_name" id="agent_name_data" type="text"
                                    class="form-control agent_name_data"
                                    placeholder="{{ __('crm.agent_name_placeholder') }}" required>
                                <span class="text-danger">
                                    @error('agent_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('crm.agent_name_error') }}
                                </div>
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('crm.communication_id') }}<span
                                        class="text-danger"></span></label>
                                <input name="communication" id="edit_communication" type="text"
                                    class="form-control communication"
                                    placeholder="{{ __('crm.communication_placeholder') }}">
                                <span class="text-danger">
                                    @error('communication')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('crm.communication_error') }}
                                </div>
                            </div>

                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('crm.role') }}<span
                                        class="text-danger"></span></label>
                                <input type="hidden" name="deptHidden" id="deptHidden" />
                                <select class="form-select form-control dept_user_department" id="dept_user"
                                    name="role">
                                    <option selected disable value="" disabled>{{ __('crm.select_dept') }}
                                    </option> 
                                </select>
                                <span class="text-danger">
                                    @error('role')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('crm.role_name_error') }}
                                </div>
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('crm.user') }}<span
                                        class="text-danger"></span></label>
                                <select class="form-select form-control departmentUser" id="dept_userId"
                                    name="user">
                                    <option selected disable value="" disabled>{{ __('crm.select_user') }}
                                    </option>

                                </select>
                                <span class="text-danger">
                                    @error('user')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('crm.user_name_error') }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mt-4" required>
                                <input type="submit" id="add_title_submit" class="btn btn-primary" value="Update">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--------------Edit agent Modal end here --------------->


    <!-------------- Edit tags Modal --------------->
    <div class="modal fade" id="tagstatusedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('crm.update_tags') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form class="needs-validation novalidate" id="edit_tags_form" novalidate>

                        <input name="tags_id" id="hidden_tagss_id" type="hidden" class="form-control ps-5">
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('crm.tags_name') }}<span
                                        class="text-danger">*</span></label>
                                <input name="tags_name" id="tagss_name" type="text" class="form-control"
                                    placeholder="{{ __('crm.tags_name_placeholder') }}" required>
                                <span class="text-danger">
                                    @error('tags_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('crm.tags_name_error') }}
                                </div>
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('crm.tags_color') }}<span
                                        class="text-danger">*</span></label>
                                <div id="cp3" class="input-group">
                                    <input type="text" class="form-control input-lg" id="tagss_color"
                                        name="tags_color" placeholder="{{ __('crm.tags_color_placeholder') }}"
                                        required />
                                    <span class="input-group-append">
                                        <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                    </span>
                                </div>
                                <span class="text-danger">
                                    @error('tags_color')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('crm.tags_color_error') }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mt-4" required>
                                <input type="submit" id="add_title_submit" class="btn btn-primary" value="Update">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--------------Edit tags Modal end here --------------->

    @push('scripts') 

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/js/bootstrap-colorpicker.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/css/bootstrap-colorpicker.css" />
 
        <script>
            $(function() {
                $('#cp2').colorpicker();
            });
            $(function() {
                $('#cp3').colorpicker();
            });

            $(function() {
                $('.cp4').colorpicker();
            });

            $(function() {
                $('.status_color').colorpicker();
            });
        </script>
        <script>
            $(document).ready(function() {

                // category sort order update
                $(".sort_order").on("blur", function(e) {
                    e.preventDefault();
                    var status_id = $(this).data('status_id');
                    var sort_order = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('crm.lead-status-sort-order') }}",
                        data: {
                            status_id: status_id,
                            sort_order: sort_order
                        },
                        dataType: "json",
                        success: function(data) {
                            Toaster("success", data.success);
                        }
                    });
                });


                // source sort order update
                $(".source_sort_order").on("blur", function(e) {
                    e.preventDefault();
                    var source_id = $(this).data('source_id');
                    var sort_order = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('crm.lead-source-sort-order') }}",
                        data: {
                            status_id: source_id,
                            sort_order: sort_order
                        },
                        dataType: "json",
                        success: function(data) {
                            Toaster("success", data.success);
                        }
                    });
                });

                // industry_sort_order sort order update
                $(".industry_sort_order").on("blur", function(e) {
                    e.preventDefault();
                    var industry_id = $(this).data('industry_id');
                    var sort_order = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('crm.lead-industry-sort-order') }}",
                        data: {
                            status_id: industry_id,
                            sort_order: sort_order
                        },
                        dataType: "json",
                        success: function(data) {
                            Toaster("success", data.success);
                        }
                    });
                });


                // tags sort order sort order update
                $(".tags_sort_order").on("blur", function(e) {
                    e.preventDefault();
                    var tags_id = $(this).data('tags_id');
                    var sort_order = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('crm.lead-tags-sortOrder') }}",
                        data: {
                            status_id: tags_id,
                            sort_order: sort_order
                        },
                        dataType: "json",
                        success: function(data) {
                            Toaster("success", data.success);
                        }
                    });
                });

                // agent_sort_order sort order update
                $(".agent_sort_order").on("blur", function(e) {
                    e.preventDefault();
                    var agent_id = $(this).data('agent_id');
                    var sort_order = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('crm.lead-agent-sortOrder') }}",
                        data: {
                            status_id: agent_id,
                            sort_order: sort_order
                        },
                        dataType: "json",
                        success: function(data) {
                            Toaster("success", data.success);
                        }
                    });
                });



                $(".status_color").on("blur", function(e) {
                    e.preventDefault();
                    var color_id = $(this).data('status_color');
                    var status_color = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('crm.lead-status-color') }}",
                        data: {
                            color_id: color_id,
                            status_color: status_color
                        },
                        dataType: "json",
                        success: function(data) {
                            Toaster("success", data.success);
                        }
                    });
                });


            });


            $(document).ready(function() {
                // add source ajax open
                $(document).on('click', "#Add_Source_Submit", function(e) {
                    e.preventDefault();
                    $('#source_add_userForm').addClass('was-validated');
                    if ($('#source_add_userForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            source_name: $("#addsource_name").val(),
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ route('crm.lead-setting.store') }}",
                            data: data,
                            dataType: "json",

                            success: function(response) {
                                console.log();
                                if (response.status == 1) {
                                    Toaster('success', response.success);
                                    $('#add_modal').trigger("reset");
                                    $('#source_add').modal('hide')
                                    setTimeout(function() {
                                        location.reload(true);
                                    }, 3000);

                                    window.location.href =
                                        "{{ route('crm.lead-setting.index', ['tab=source']) }}";
                                } else {
                                    Toaster('error', response.success);
                                }
                            },
                            error: function(response) {
                                var errors = data.responseJSON;
                                console.log(errors);
                            }
                        });
                    }
                });
            });



            //Lead souce status change jquery
            $('.source_toggle_class').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let source_id = $(this).data('id');
                console.log(source_id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('crm/lead-setting-source') }}",
                    data: {
                        'status': status,
                        'source_id': source_id
                    },
                    success: function(response) {
                        // console.log(response);
                        Toaster('success', response.success);
                    }
                });
            });
            //end


            //Lead souce status change jquery
            $('.dept_user_department').change(function() {
                let dept_id = $(this).val();
                $(".departmentUser").empty();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('crm/dept-user') }}",
                    data: {
                        'dept_id': dept_id,
                    },
                    success: function(response) {
                        console.log(response);

                        var html = ``;
                        $.each(response.responseData, function(key, value) {
                            console.log(value);
                            html +=
                                `<option value="${value[0].id}">${value[0].first_name} ${value[0].last_name}</option>`;
                        });

                        $(".departmentUser").append(html);

                    }
                });
            });
            //end
        </script>

        <script>
            //modal edit source ajax
            $(document).ready(function() {
                $('.result_edit_btn').on('click', function(e) {
                    e.preventDefault();

                    var source_id = $(this).data('id');
                    console.log(source_id);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "GET",

                        url: "{{ url('crm/lead-source-edit') }}/" + source_id,
                        data: {
                            source_id: source_id
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            var sec = response[0].source;
                            console.log(sec);

                            $("#edit_input_field").val(sec.source_id);
                            $("#editsource_name").val(sec.source_name);


                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                });
            });

            //   Edit source closed ajax
        </script>

        <script>
            //source update 
            $(document).ready(function() {
                $(document).on("submit", "#edit_result_title_form", function(e) {
                    e.preventDefault();

                    var data = {
                        id: $("#edit_input_field").val(),

                        source_name: $("#editsource_name").val(),

                    }
                    console.log(data);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('crm/lead-setting-update') }}",

                        data: data,
                        success: function(response) {
                            $('#modalEditResult').removeClass('show');
                            $('#modalEditResult').css('display', 'none');
                            Toaster('success', response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);

                            window.location.href =
                                "{{ route('crm.lead-setting.index', ['tab=source']) }}";


                        }
                    });

                });
            });
        </script>

        <!-- 1tab source closed -->

        <!--  2tab status ajax open  -->
        <script>
            $(document).ready(function() {
                $("#status_add_modal").on('click', function(e) {
                    e.preventDefault();
                    $("#status_add").modal('show');
                });
            });
        </script>

        <script>
            // modal add in ajax

            $(document).ready(function() {
                $(document).on("click", "#Add_status_submit", function(e) {
                    e.preventDefault();
                    $('#status_add_userForm').addClass('was-validated');
                    if ($('#status_add_userForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            status_name: $("#addstatus_name").val(),
                            status_color: $("#status_color").val(),
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ url('crm/lead-setting-store-status') }}",
                            data: data,
                            dataType: "json",
                            success: function(response) {
                                if (response.status == 1) {
                                    // toaster
                                    Toaster('success', response.success);
                                    $('#status_add').modal('hide');
                                    $('#status_add_userForm').trigger('reset');
                                    $("#store_status_id").load(location.href + " #store_status_id");
                                    setTimeout(function() {
                                        location.reload(true);
                                    }, 3000);

                                    window.location.href =
                                        "{{ route('crm.lead-setting.index', ['tab=lead-status']) }}";
                                } else {
                                    Toaster('error', response.success);
                                }

                            },
                            error: function(response) {
                                var errors = data.responseJSON;
                                console.log(errors);
                            }
                        });
                    }
                });
            });
            //  modal add closed ajax



            // change status in ajax code start
            $('.status_toggle_class').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let status_id = $(this).data('id');
                console.log(status_id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('crm/lead-setting-status') }}",
                    data: {
                        'status': status,
                        'status_id': status_id
                    },
                    success: function(response) {
                        // console.log(response);
                        Toaster('success', response.success);
                    }
                });
            });
            // change status in ajax code end
        </script>

        <script>
            //modal edit status ajax
            $(document).ready(function() {
                $('.status_edit_btn').on('click', function(e) {
                    e.preventDefault();

                    var status_id = $(this).data('id');
                    console.log(status_id);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "GET",

                        url: "{{ url('crm/lead-status-edit') }}/" + status_id,
                        data: {
                            status_id: status_id
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            var sec = response[0].status;
                            console.log(sec);

                            $("#hidden_status_id").val(sec.status_id);
                            $("#edit_status_name").val(sec.status_name);
                            $("#edit_status_color").val(sec.status_color);


                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                });
            });

            //   Edit status closed ajax
        </script>

        <script>
            //status update 
            $(document).ready(function() {

                $(document).on("submit", "#edit_status_title_form", function(e) {
                    e.preventDefault();

                    var data = {
                        id: $("#hidden_status_id").val(),

                        status_name: $("#edit_status_name").val(),
                        status_color: $("#edit_status_color").val(),

                    }
                    console.log(data);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('crm/lead-setting-update-status') }}",

                        data: data,
                        success: function(response) {
                            $('#modalEditStatus').removeClass('show');
                            $('#modalEditStatus').css('display', 'none');
                            Toaster('success', response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);

                            window.location.href =
                                "{{ route('crm.lead-setting.index', ['tab=lead-status']) }}";


                        }
                    });

                });
            });
        </script>

        <!-- 2tab status closed -->

        <!-- 3tab Industry open in jquery-->
        <script>
            $(document).ready(function() {
                $("#industry_add_modal").on('click', function(e) {
                    e.preventDefault();
                    $("#industry_add").modal('show');
                });
            });
        </script><!-- 3tab Industry closed in jquery-->

        <!-- 3tab Industry openin ajax -->
        <script>
            // modal add industry open ajax
            $(document).ready(function() {
                $(document).submit("#industry_submit", function(e) {
                    e.preventDefault();
                    $('#industry_add_userForm').addClass('was-validated');
                    if ($('#industry_add_userForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            industry_name: $("#add_industry_name").val(),
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ url('crm/lead-setting-store-industry') }}",
                            data: data,
                            dataType: "json",
                            success: function(response) {
                                if (response.status == 1) {
                                    Toaster('success', response.success);
                                    $('#industry_add').modal('hide');
                                    $('#industry_add_userForm').trigger('reset')
                                    $("#industry_table").load(location.href + " #industry_table");
                                    setTimeout(function() {
                                        location.reload(true);
                                    }, 3000);

                                    window.location.href =
                                        "{{ route('crm.lead-setting.index', ['tab=lead-group']) }}";
                                } else {
                                    Toaster('error', response.success);
                                }


                            },
                            error: function(response) {
                                var errors = data.responseJSON;
                                console.log(errors);
                            }
                        });
                    }
                });

                $(document).submit("#agent_submit", function(e) {
                    e.preventDefault();
                    $('#agent_add_userForm').addClass('was-validated');
                    if ($('#agent_add_userForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            agent_name: $("#agent_name").val(),
                            user_id: $(".departmentUser").val(),
                            communication: $("#communication").val(),
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ url('crm/lead-agent-store') }}",
                            data: data,
                            dataType: "json",
                            success: function(response) {
                                if (response.status == 1) {
                                    Toaster('success', response.success);
                                    $('#lead_Setting_add').modal('hide');
                                    $('#agent_add_userForm').trigger('reset')
                                    $("#industry_table").load(location.href + " #industry_table");
                                    setTimeout(function() {
                                        location.reload(true);
                                    }, 3000);

                                    window.location.href =
                                        "{{ route('crm.lead-setting.index', ['tab=lead-setting']) }}";
                                } else {
                                    Toaster('error', response.success);
                                }



                            },
                            error: function(response) {
                                var errors = data.responseJSON;
                                console.log(errors);
                            }
                        });
                    }
                });

                $(document).submit("#tags_submit", function(e) {
                    e.preventDefault();
                    $('#tags_add_userForm').addClass('was-validated');
                    if ($('#tags_add_userForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            tags_name: $("#tags_name").val(),
                            tags_color: $("#tags_color").val(),
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ url('crm/lead-tags-store') }}",
                            data: data,
                            dataType: "json",
                            success: function(response) {
                                if (response.status == 1) {
                                    Toaster('success', response.success);
                                    $('#lead_tags_add').modal('hide');
                                    $('#tags_add_userForm').trigger('reset')

                                    setTimeout(function() {
                                        location.reload(true);
                                    }, 3000);

                                    window.location.href =
                                        "{{ route('crm.lead-setting.index', ['tab=lead-tag']) }}";
                                } else {
                                    Toaster('error', response.success);
                                }


                            },
                            error: function(response) {
                                var errors = data.responseJSON;
                                console.log(errors);
                            }
                        });
                    }
                });
            });
            //  modal add industry closed ajax


            // change status in ajax code start
            $('.industry_toggle_class').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let group_id = $(this).data('id');

                console.log(group_id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('crm/lead-setting-industry') }}",
                    data: {
                        'status': status,
                        'group_id': group_id
                    },
                    success: function(response) {
                        // console.log(response);
                        Toaster('success', response.success);
                    }
                });
            });
            // change status in ajax code end

            // change status in ajax code start
            $('.agent_toggle_class').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let agent_id = $(this).data('id');
                console.log(agent_id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('crm/lead-agent-status') }}",
                    data: {
                        'status': status,
                        'agent_id': agent_id
                    },
                    success: function(response) {
                        // console.log(response);
                        Toaster('success', response.success);
                    }
                });
            });
            // change status in ajax code end

            // change status in ajax code start
            $('.tags_toggle_class').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let tag_id = $(this).data('id');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('crm/lead-tags-status') }}",
                    data: {
                        'status': status,
                        'tag_id': tag_id
                    },
                    success: function(response) {
                        // console.log(response);
                        Toaster('success', response.success);
                    }
                });
            });
            // change status in ajax code end
        </script>

        <script>
            //modal industry status ajax
            $(document).ready(function() {
                $('.indusrty_edit_btn').on('click', function(e) {
                    e.preventDefault();

                    var industry_id = $(this).data('id');
                    console.log(industry_id);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "GET",

                        url: "{{ url('crm/lead-industry-edit') }}/" + industry_id,
                        data: {
                            industry_id: industry_id
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            var sec = response[0].industry;
                            console.log(sec);

                            $("#hidden_industry_id").val(sec.id);
                            $("#edit_industry_name").val(sec.group_name);


                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                });


                $('.agent_edit_btn').on('click', function(e) {
                    e.preventDefault();

                    var agent_id = $(this).data('id');
                    console.log(agent_id);
                    $("#dept_user").empty();
                    $("#dept_userId").empty();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "GET",

                        url: "{{ url('crm/lead-agent-edit') }}/" + agent_id,
                        data: {
                            agent_id: agent_id
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            // $("#dept_user").empty();
                            var sec = response[0].agent;
                            $("#hidden_agent_id").val(sec.agent_id);
                            $("#agent_name_data").val(sec.agent_name);
                            $("#edit_communication").val(sec.communication_id);
                            var staff = response[0].staff;
                            var html = ``;
                            var htmluser = ``;
                            $.each(response[0].dept_list, function(key, value) {
                                html +=
                                    `<option value="${value.roles_id}"  ${(response[0].userId.roles_id == value.roles_id) ? "selected":''} >${value.roles_name}</option>`;
                            });

                            $.each(response[0].userList, function(key, value) {

                                htmluser +=
                                    `<option value="${value[0].id}"  ${(sec.user_id == value[0].id) ? "selected":''} >${value[0].first_name} ${value[0].last_name}</option>`;
                            });

                            $("#dept_user").append(html);

                            $("#dept_userId").append(htmluser);

                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                });


                $('.tags_edit_btn').on('click', function(e) {
                    e.preventDefault();

                    var tags_id = $(this).data('id');
                    console.log(tags_id);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "GET",

                        url: "{{ url('crm/lead-tags-edit') }}/" + tags_id,
                        data: {
                            tags_id: tags_id
                        },
                        dataType: "json",
                        success: function(response) {

                            $("#dept_user").empty();
                            var sec = response[0].tags;
                            console.log(sec);
                            $("#hidden_tagss_id").val(sec.tags_id);
                            $("#tagss_name").val(sec.tags_name);
                            $("#tagss_color").val(sec.tags_color);



                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                });
            });

            //   Edit industry closed ajax
        </script>

        <script>
            //industry update 
            $(document).ready(function() {

                $(document).on("submit", "#edit_industry_title_form", function(e) {
                    e.preventDefault();

                    var data = {
                        id: $("#hidden_industry_id").val(),

                        industry_name: $("#edit_industry_name").val(),

                    }
                    console.log(data);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('crm/lead-setting-update-industry') }}",

                        data: data,
                        success: function(response) {
                            $('#modalindusrtyStatus').removeClass('show');
                            $('#modalindusrtyStatus').css('display', 'none');
                            Toaster('success', response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);
                            window.location.href =
                                "{{ route('crm.lead-setting.index', ['tab=lead-group']) }}";


                        }
                    });

                });

                $(document).on("submit", "#edit_agent_title_form", function(e) {
                    e.preventDefault();

                    var data = {
                        id: $(".hidden_agent_id").val(),
                        agent_name: $(".agent_name_data").val(),
                        user_id: $("#dept_userId").val(),
                        communication: $("#edit_communication").val(),

                    }
                    console.log(data);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('crm/lead-agent-update') }}",

                        data: data,
                        success: function(response) {
                            if (response.status = 1) {
                                $('#agentstatusedit').removeClass('show');
                                $('#agentstatusedit').css('display', 'none');
                                Toaster('success', response.success);
                                setTimeout(function() {
                                    location.reload(true);
                                }, 3000);

                                window.location.href =
                                    "{{ route('crm.lead-setting.index', ['tab=lead-setting']) }}";
                            } else {
                                Toaster('error', response.success);
                            }

                        }
                    });

                });

                $(document).on("submit", "#edit_tags_form", function(e) {
                    e.preventDefault();

                    var data = {
                        id: $("#hidden_tagss_id").val(),
                        tags_name: $("#tagss_name").val(),
                        tags_color: $("#tagss_color").val(),

                    }
                    console.log(data);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('crm/lead-tags-update') }}",

                        data: data,
                        success: function(response) {
                            $('#agentstatusedit').removeClass('show');
                            $('#agentstatusedit').css('display', 'none');
                            Toaster('success', response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);
                            window.location.href =
                                "{{ route('crm.lead-setting.index', ['tab=lead-tag']) }}";


                        }
                    });

                });
            });

            $('#leadSource').click(function() {
                window.location.href = "{{ route('crm.lead-setting.index', ['tab=source']) }}";
            });
            $('#leadStatus').click(function() {
                window.location.href = "{{ route('crm.lead-setting.index', ['tab=lead-status']) }}";
            });
            $('#leadIndustry').click(function() {
                window.location.href = "{{ route('crm.lead-setting.index', ['tab=lead-group']) }}";
            });
            $('#leadSetting').click(function() {
                window.location.href = "{{ route('crm.lead-setting.index', ['tab=lead-setting']) }}";
            });
            $('#leadTag').click(function() {
                window.location.href = "{{ route('crm.lead-setting.index', ['tab=lead-tag']) }}";
            });
        </script>
    @endpush
    {{-- 3tab Industry closed ajax --}}
</x-app-layout>
