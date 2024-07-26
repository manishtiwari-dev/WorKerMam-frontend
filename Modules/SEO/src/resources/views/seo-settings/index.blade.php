<x-app-layout>
    @section('title', $pageTitle)

    <div class="contact-content">
        <div class="contact-content-header mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <ul class="nav nav-tabs gap-1" id="myTab" role="tablist">
                <li class="nav-item"> <a href="#website"
                        class="nav-link {{ request()->tab == 'website' || !isset(request()->tab) ? 'active' : '' }}"
                        data-bs-toggle="tab">{{ __('seo.website') }}</a></li>

                <li class="nav-item"> <a href="#task" class="nav-link {{ request()->tab == 'task' ? 'active' : '' }}"
                        data-bs-toggle="tab">{{ __('seo.task_setting') }}</a></li>
                <li class="nav-item "><a href="#result"
                        class="nav-link {{ request()->tab == 'result_title' ? 'active' : '' }}"
                        data-bs-toggle="tab">{{ __('seo.result_title') }}</a></li>
            </ul>
            <a href="" id="contactOptions" class="text-secondary mg-l-auto d-xl-none"><i
                    data-feather="more-horizontal"></i></a>
        </div><!-- contact-content-header -->
        <div class="card contact-content-body">
            <div class="tab-content">
                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                    <div id="website"
                        class="tab-pane show {{ request()->tab == 'website' || !isset(request()->tab) ? 'active' : '' }}">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between ">
                                <h6 class="tx-15 mg-b-0">{{ __('seo.website_list') }}</h6>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                    <a href="{{ route('seo.website.create') }}"
                                        class="btn btn-sm btn-bg d-flex align-items-center mg-r-5 btn-primary">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        <span
                                            class="d-sm-inline mg-l-5">{{ __('seo.add_website') }}</span>
                                    </a>
                                @endif

                            </div>
                        </div>
                        <div class="card-body">
                            <div data-label="Example" class="df-example demo-table">
                                <div class="table-responsive">
                                    <table id="example1" class="table table_wrapper">
                                        <thead>
                                            <tr>
                                                <th class="wd-10p">{{ __('common.sl_no') }}</th>
                                                <th class="wd-20p">{{ __('seo.website_name') }}</th>
                                                <th class="wd-25p">{{ __('seo.website_url') }}</th>
                                                <th class="wd-15p">{{ __('seo.start_date') }}</th>
                                                <th class="wd-15p">{{ __('common.status') }}</th>
                                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                    <th class="text-center">{{ __('common.action') }}</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($content->web_setting->data as $key => $web)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>

                                                    <td>{{ $web->website_name }}</td>
                                                    <td>{{ $web->website_url }}</td>
                                                    <td>{{ $web->start_date }}</td>

                                                    <td>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox"
                                                                class="custom-control-input website_toggle_class"
                                                                {{ $web->status == '1' ? 'checked' : '' }}
                                                                data-id="{{ $web->id }}"
                                                                id="customSwitch{{ $web->id }}">
                                                            <label class="custom-control-label"
                                                                for="customSwitch{{ $web->id }}"></label>
                                                        </div>

                                                    </td>
                                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                        <td class="align-items-center justify-content-center gap-2 d-flex">

                                                            <a href="{{ url('seo/general-setting/manage-task/' . $web->id) }}"
                                                                class="btn btn-sm  px-0 d-flex align-items-center mg-r-5">
                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                            </a>
                                                            <a href="{{ url('seo/general-setting/website-keyword/' . $web->id) }}"
                                                                class="btn btn-sm px-0 d-flex align-items-center mg-r-5">
                                                                <i class="fa fa-key" aria-hidden="true"></i>
                                                            </a>

                                                            <a href="{{ url('seo/general-setting/website-ranking/' . $web->id) }}"
                                                                class="btn btn-sm  px-0 d-flex align-items-center mg-r-5">
                                                                <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                                            </a>

                                                            <a href="{{ route('seo.website.edit', $web->id) }}"
                                                                class="btn btn-sm  px-0 d-flex align-items-center">
                                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                            <span class="d-none d-sm-inline mg-l-5"></span></a>
                                                        </td>
                                                    @endif

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5">
                                                        <h5 class="text-center mb-0 py-1">{{ __('common.no_record') }}</h4>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- df-example -->
                        </div>
                    </div>
                @endif
                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                    <div id="task" class="tab-pane {{ request()->tab == 'task' ? 'active' : '' }}">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="tx-15 mg-b-0">{{ __('seo.task_list') }}</h6>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                    <a href="{{ route('seo.seo-task-create') }}"
                                        class="btn btn-sm btn-bg d-flex align-items-center mg-r-5 btn-primary">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        <span
                                            class="d-sm-inline mg-l-5">{{ __('seo.add_task') }}</span></a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div data-label="Example" class="df-example demo-table">
                                <div class="table-responsive">
                                    <table id="example1" class="table table_wrapper">
                                        <thead>
                                            <tr>
                                                <th class="wd-10p">{{ __('common.sl_no') }}</th>

                                                <th class="wd-10p">{{ __('seo.task_title') }}</th>
                                                <th class="wd-20p">{{ __('seo.submission_no') }}</th>
                                                <th class="wd-23p">{{ __('seo.task_priority') }}</th>
                                                <th class="wd-20p">{{ __('seo.task_frequency') }}</th>
                                                <th class="wd-10p">{{ __('common.status') }}</th>
                                                <th class="wd-10p">Duplicate Checker</th>
                                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                    <th class="wd-10p">{{ __('common.action') }}</th>
                                                @endif
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse ($content->seotask->data as $key => $task)
                                                <tr>

                                                    <td>{{ ++$key }}</td>

                                                    <td>{{ ucwords($task->seo_task_title) }}</td>
                                                    <td>
                                                        <input type="number" class="col-xs-1 no_of_submission width1 text-center"
                                                            data-id="{{ $task->id }}" placeholder=""
                                                            value="{{ $task->no_of_submission }}" style="width:50px;">

                                                    </td>
                                                    <td>
                                                        <input type="number" class="col-xs-1 inputPassword2 width1 text-center"
                                                            data-id="{{ $task->id }}" placeholder=""
                                                            value="{{ $task->task_priority }}" style="width:50px;">
                                                    </td>
                                                    <td>
                                                        @if (!empty($task->task_frequency == 1))
                                                            Daily
                                                        @elseif(!empty($task->task_frequency == 2))
                                                            Weekly Once
                                                        @elseif(!empty($task->task_frequency == 3))
                                                            Weekly Twice
                                                        @elseif(!empty($task->task_frequency == 4))
                                                            Weekly Thrice
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox"
                                                                class="custom-control-input task_toggle_class"
                                                                {{ $task->status == '1' ? 'checked' : '' }}
                                                                data-id="{{ $task->id }}"
                                                                id="customSwitch1{{ $task->id }}">
                                                            <label class="custom-control-label"
                                                                for="customSwitch1{{ $task->id }}"></label>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox"
                                                                class="custom-control-input duplicate_toggle_class"
                                                                {{ $task->duplicate == '1' ? 'checked' : '' }}
                                                                data-id="{{ $task->id }}"
                                                                id="customSwitch6{{ $task->id }}">
                                                            <label class="custom-control-label"
                                                                for="customSwitch6{{ $task->id }}"></label>
                                                        </div>

                                                    </td>

                                                    <td class="align-items-center justify-content-center gap-2 d-flex">
                                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                            <a href="{{ url('seo/task-edit/' . $task->id) }}"
                                                                data-task-id="{{ $task->id }}"
                                                                class="btn btn-sm  d-flex align-items-center mg-r-5 px-0">
                                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                                <span class="d-none d-sm-inline mg-l-5"></span>
                                                            </a>
                                                        @endif
                                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'remove') == 'true')
                                                            <a href="#task_delete" id="task_del_btn"
                                                                data-id="{{ $task->id }}" data-bs-toggle="modal"
                                                                class="btn btn-sm  d-flex align-items-center px-0">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                                <span class="d-none d-sm-inline mg-l-5"></span></a>
                                                        @endif
                                                    </td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5">
                                                        <h5 class="text-center mb-0 py-1">{{ __('common.no_record') }}</h4>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- df-example -->
                        </div>
                    </div><!-- tab-pane -->
                @endif
                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                    <div id="result" class="tab-pane {{ request()->tab == 'result_title' ? 'active' : '' }}">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="tx-15 mg-b-0">{{ __('seo.result_list') }}</h6>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                    <a href="#modal1" data-bs-toggle="modal" id="add_title_btn"
                                        class="btn btn-sm btn-bg d-flex align-items-center mg-r-5 btn-primary">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        <span class="d-sm-inline mg-l-5">{{ __('seo.add_result_title') }}</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div data-label="Example" class="df-example demo-table">
                                <div class="table-responsive">
                                    <table id="example1" class="table  table_wrapper">
                                        <thead>
                                            <tr>
                                                <th class="wd-20p">{{ __('seo.title') }}</th>
                                                <th class="wd-25p">{{ __('seo.sub_title') }}</th>
                                                <th class="wd-20p">{{ __('common.status') }}</th>
                                                <th class="wd-15p">{{ __('seo.sort_order') }}</th>
                                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                    <th class="wd-10p">{{ __('common.action') }}</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($content->seoresult as $key => $result)
                                                {{-- @dd($result); --}}
                                                <tr>
                                                    <td>{{ ucwords($result->title_name) }} <i class="fa fa-arrow-circle-down" aria-hidden="true"></i></td>
                                                    <td></td>
                                                    <td>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox"
                                                                class="custom-control-input result_toggle_class"
                                                                {{ $result->status == '1' ? 'checked' : '' }}
                                                                data-id="{{ $result->id }}"
                                                                id="customSwitch2{{ $result->id }}">
                                                            <label class="custom-control-label"
                                                                for="customSwitch2{{ $result->id }}"></label>
                                                        </div>
                                                    </td>
                                                    <td><input type="number" class="col-xs-1 resultTitle width1 text-center"
                                                            data-id="{{ $result->id }}" placeholder=""
                                                            value="{{ $result->sort_order }}" style="width:50px;">
                                                    </td>
                                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                        <td class="align-items-center justify-content-center gap-2 d-flex">
                                                            <a href="#modalEditResult" data-id="{{ $result->id }}"
                                                                data-bs-toggle="modal"
                                                                class="btn btn-sm  px-0 d-flex align-items-center mg-r-5 result_edit_btn">
                                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                                <span class="d-none d-sm-inline mg-l-5"></span>
                                                            </a>
                                                            <a href="#delete_result_modal"
                                                                data-id="{{ $result->id }}" id="result_delete_btn"
                                                                data-bs-toggle="modal"
                                                                class="btn btn-sm  px-0 d-flex align-items-center">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                                <span class="d-none d-sm-inline mg-l-5"></span>
                                                            </a>
                                                        </td>
                                                    @endif
                                                </tr>
                                                @foreach ($result->child as $key => $child)
                                                    {{-- @dd($child); --}}
                                                    <tr>
                                                        <td></td>
                                                        <td>{{ ucwords($child->title_name) }}</td>
                                                        <td>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox"
                                                                    class="custom-control-input result_toggle_class"
                                                                    {{ $child->status == '1' ? 'checked' : '' }}
                                                                    data-id="{{ $child->id }}"
                                                                    id="customSwitch2{{ $child->id }}">
                                                                <label class="custom-control-label"
                                                                    for="customSwitch2{{ $child->id }}"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="col-xs-1 resultTitle width1 text-center"
                                                                data-id="{{ $child->id }}" placeholder=""
                                                                value="{{ $child->sort_order }}" style="width:50px;">
                                                        </td>
                                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                            <td class="align-items-center justify-content-center gap-2 d-flex">
                                                                <a href="#modalEditResult"
                                                                    data-id="{{ $child->id }}" data-bs-toggle="modal"
                                                                    class="btn btn-sm  d-flex align-items-center mg-r-5 px-0 result_edit_btn">
                                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                                    <span class="d-none d-sm-inline mg-l-5"></span>
                                                                </a>
                                                                <a href="#delete_result_modal"
                                                                    data-id="{{ $child->id }}" id="child_delete"
                                                                    data-bs-toggle="modal"
                                                                    class="btn btn-sm  d-flex align-items-center px-0">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                    <span class="d-none d-sm-inline mg-l-5"></span></a>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @empty
                                                <tr>
                                                    <td colspan="5">
                                                        <h5 class="text-center mb-0 py-1">{{ __('common.no_record') }}</h4>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div><!-- df-example -->
                            </div>
                        </div>
                    </div>
                @endif
            </div><!-- tab-content -->
        </div><!-- contact-content-body -->

    </div><!-- contact-content -->

    <!--Website delete modal-->
    <div class="modal fade effect-scale" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('seo.delete_task') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden_id" name="input_field_id">
                    <p class="mg-b-0">{{ __('common.delete_confirmation') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('common.no') }}
                    </button>
                    <button type="button" class="btn btn-primary delete_btn">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--End delete modal-->

    <!--task delete modal-->
    <div class="modal fade effect-scale" id="task_delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('seo.delete_task') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_task_id" name="input_field_id">
                    <p class="mg-b-0">{{ __('common.delete_confirmation') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('common.no') }}</button>
                    <button type="button" class="btn btn-primary task_delete_yes">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--end delete modal-->

    <!--result delete modal-->
    <div class="modal fade effect-scale" id="delete_result_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('seo.delete_task') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <input type="hidden" id="result_hidden_id" name="input_field_id">
                    <p class="mg-b-0">{{ __('common.delete_confirmation') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('common.no') }}
                    </button>
                    <button type="button" class="btn btn-primary delete_btn">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--End delete modal-->

    <!--------------Add Result Modal --------------->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('seo.add_result_title') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="add_result_title_form" novalidate>

                        <div class="row">
                            <div class="col-sm-12">
                                <label class="form-label">{{ __('seo.title') }}<span
                                        class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <input name="title_name" id="title" type="text" class="form-control"
                                        placeholder="Enter title" required>
                                    <span id="title_msg"></span>
                                    <div class="invalid-feedback">
                                        <p>{{ __('seo.title_error') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mt-4">

                                <label for="section_type" class="form-label">{{ __('seo.section_type') }}</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input section_type is-invalid" type="radio"
                                        name="section_type" id="section_type" value="0" checked>
                                    <label class="form-check-label" for="inlineRadio1">{{ __('seo.parent') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input section_type1 is-invalid" type="radio"
                                        name="section_type" id="section_type1" value="1">
                                    <label class="form-check-label" for="inlineRadio2">{{ __('seo.child') }}</label>
                                </div>
                                <div class=" parent mt-3" style="display:none;">
                                    <label for="parent_section"
                                        class="form-label">{{ __('seo.parent_title') }}</label>
                                    <select class="form-control select2" id="parent_section" name="parent_section">
                                        <option selected disabled value="">{{ __('seo.select_parent_title') }}
                                        </option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mt-4" required>
                                <input type="submit" id="add_title_submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-------------- Add Result Modal end here --------------->

    <!-------------- Edit Result Modal --------------->
    <div class="modal fade" id="modalEditResult" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('seo.update_title') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form class="needs-validation novalidate" id="edit_result_title_form" novalidate>
                        <input type="hidden" name="input_field_id" id="edit_input_field">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="form-label">{{ __('seo.title') }}<span
                                        class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <input name="title" id="update_title" type="text" class="form-control"
                                        placeholder="Enter title" required>
                                    <span style="color:red;">
                                        @error('title')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        <p>{{ __('seo.title_error') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mt-4">

                                <label for="section_type"
                                    class="form-label">{{ __('seo.section_type') }}</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input  section_type is-invalid type" type="radio"
                                        name="section_type" id="update_section_type" value="0">
                                    <label class="form-check-label"
                                        for="inlineRadio1">{{ __('seo.parent') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input  section_type1 is-invalid type" type="radio"
                                        name="section_type" id="update_section_type1" value="1">
                                    <label class="form-check-label" for="inlineRadio2">{{ __('seo.child') }}</label>
                                </div>
                                <div class=" parent mt-3" style="display:none;">
                                    <label for="parent_section"
                                        class="form-label">{{ __('seo.parent_title') }}</label>
                                    <select class="form-control select2" id="update_parent_section" name="parent_section">
                                        <option selected disabled value="">{{ __('seo.select_parent_title') }}
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>{{ __('seo.parent_title_error') }}</p>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label for="parent_section" class="form-label">{{ __('seo.status') }}</label>
                                    <select class="form-control select2" id="status" name="status">
                                        <option selected disabled value="">{{ __('seo.select_status') }}
                                        </option>
                                        <option value="1">Active
                                        </option>
                                        <option value="0">Deactive
                                        </option>
                                    </select>
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
    <!--------------Edit Result Modal end here --------------->

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function() {
                $(".section_type").click(function() {
                    $(".parent").hide();
                });
                $(".section_type1").click(function() {
                    $(".parent").show();

                });

                $("#section_type1").click(function() {
                    $("#parent_section").attr("required", true);

                });

                $("#section_type").click(function() {
                    $("#parent_section").attr("required", false);
                });
            });
        </script>

        <!-- DROPDOWN-->
        <script>
            $(document).ready(function() {
                $('#add_title_btn').click(function() {
                    // alert('drop');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    $.ajax({

                        url: "{{ route('seo.seo-results-create') }}",

                        type: "POST",
                        success: function(result) {
                            console.log(result);
                            $.each(result.seoresult.seoresult, function(key, value) {
                                let option_html = "<option value='" + value.id + "'>" +
                                    value.title_name + "</option>"
                                $("#parent_section").append(option_html);
                            });
                        }
                    });
                });
            });
        </script>
        <!--END DROPDOWN-->

        <!--add result title ajax-->
        <script>
            $(document).on("submit", "#add_result_title_form", function(e) {
                e.preventDefault();

                let section_type = $("#section_type:checked").val();
                var formData = {
                    title: $("#title").val(),
                    parent_section_id: $("#parent_section").val() ?? 0,
                    status: $("#status").val(),
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('seo.seo-results-store') }}",

                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function(response) {

                        $('#modal1').removeClass('show');
                        $('#modal1').css('display', 'none');
                        if (response.success) {
                            Toaster(response.success);

                        } else {
                            Toaster(response.error);
                        }

                        setTimeout(function() {
                            location.reload(true);
                        }, 3000);

                        window.location.href = "{{ route('seo.workReport', ['tab=result_title']) }}";

                    },
                    //error: function(xhr, status, error) {
                    //console.log(err);
                    //    var err = JSON.parse(xhr.responseText);
                    //    $('#title_msg').html(err.errors.title);
                    // }

                });
            });
        </script>
        <!--end add result title ajax-->

        <script>
            //modal edit title ajax
            $(document).ready(function() {

                $('.result_edit_btn').on('click', function(e) {
                    e.preventDefault();
                    var result_id = $(this).data('id');


                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "GET",

                        url: "{{ url('seo/results-edit') }}/" + result_id,
                        data: {
                            result_id: result_id
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            var sec = response.section;
                            //  var mod = response.seoresult;

                            $("#edit_input_field").val(sec.id);
                            $("#update_title").val(sec.title_name);

                            $('#status option[value="' + sec.status + '"]').prop('selected', true);
                            if (sec.parent_id == 0) {
                                $('#update_section_type').prop('checked', 'true');
                            } else {
                                $('#update_section_type1').prop('checked', 'true');

                            }
                            //  console.log("parent",sec.parent_id);
                            if (sec.parent_id != '0') {

                                $("#update_title").val(sec.title_name);
                                $('#status option[value="' + sec.status + '"]').prop('selected',
                                    true);
                                $("#update_parent_section").html('');


                                $.each(response.seoresult, function(key, value) {
                                    console.log(key);
                                    let option_html = "<option value='" + value.id + "'>" +
                                        value.title_name + "</option>";
                                    $("#update_parent_section").append(option_html);
                                    $("#update_parent_section").val(sec.parent_id);
                                    $('.parent').show();
                                });

                            } else {

                                $('.parent').hide();

                            }
                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                });
            });

            //   Edit title closed ajax
        </script>

        <!--update result title jquery-->
        <script>
            $(document).ready(function() {

                $(document).on("submit", "#edit_result_title_form", function(e) {
                    e.preventDefault();

                    var data = {
                        id: $("#edit_input_field").val(),
                        title: $("#update_title").val(),
                        parent_id: $("#update_parent_section").val(),
                        section_type: $('.type').prop('checked') === true ? 0 : 1,
                        status: $("#status").val(),

                    }

                    console.log(data);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('seo/seo-results-update') }}",

                        data: data,
                        success: function(response) {
                            $('#modalEditResult').removeClass('show');
                            $('#modalEditResult').css('display', 'none');
                            console.log(response);
                            Toaster(response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);

                            window.location.href =
                                "{{ route('seo.workReport', ['tab=result_title']) }}";


                        }
                    });

                });
            });
        </script>
        <!--end result title update jquery-->

        <!--task delete ajax -->
        <script>
            $(document).ready(function() {
                $(document).on("click", "#task_del_btn", function() {
                    var task_id = $(this).data('id');

                    $('#delete_task_id').val(task_id);
                    // $('#delete_modal1').modal('show');
                });
                $(document).on('click', '.task_delete_yes', function() {
                    var task_id = $('#delete_task_id').val();

                    // $('#task_delete').modal('hide');
                    // alert(task_id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('seo/task-delete') }}/" + task_id,
                        data: {
                            task_id: task_id,
                            // _method: 'DELETE'
                        },
                        dataType: "json",
                        success: function(response) {
                            $('#task_delete').removeClass('show');
                            $('#task_delete').css('display', 'none');
                            Toaster(response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);
                            window.location.href = "{{ route('seo.workReport', ['tab=task']) }}";

                        }
                    });

                });
                // task priority update
                $(".inputPassword2").on("blur", function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    var task_priority = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('seo.changeTaskPriority') }}",
                        data: {
                            id: id,
                            task_priority: task_priority
                        },
                        dataType: "json",
                        success: function(data) {
                            Toaster('success', data.success);
                        }
                    });
                });

                $(".no_of_submission").on("blur", function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    var no_of_submission = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('seo.changeTaskSubmission') }}",
                        data: {
                            id: id,
                            no_of_submission: no_of_submission
                        },
                        dataType: "json",
                        success: function(data) {
                            Toaster('success', data.success);
                        }
                    });
                });

                //website delete jquery start here
                $(document).on("click", "#website_delete_btn", function() {
                    var seo_id = $(this).data('id');
                    $('#hidden_id').val(seo_id);
                });
                $(document).on('click', '.delete_btn', function() {
                    var seo_id = $('#hidden_id').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('seo.seo-website') }}/" + seo_id,
                        data: {
                            seo_id: seo_id,
                            _method: 'DELETE'
                        },
                        dataType: "json",
                        success: function(response) {
                            $('#delete_modal').removeClass('show');
                            $('#delete_modal').css('display', 'none');
                            Toaster(response.success);
                            $("#website_table").load(location.href + " #website_table");
                            $("#website_table1").load(location.href + " #website_table1");
                            $('#delete_modal').fadeOut(6000, function() {
                                location.reload(true);
                            });
                        }
                    });
                });

                //website status change jquery
                $('.website_toggle_class').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 0;
                    let website_id = $(this).data('id');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('seo.changeWebsiteStatus') }}",
                        data: {
                            'status': status,
                            'website_id': website_id
                        },
                        success: function(response) {
                            // console.log(response);
                            Toaster('success', response.success);
                        }
                    });
                });

                //task status change jquery
                $('.task_toggle_class').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 0;
                    let task_id = $(this).data('id');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('seo.changeTaskStatus') }}",
                        data: {
                            'status': status,
                            'task_id': task_id
                        },
                        success: function(response) {
                            // console.log(response);
                            Toaster('success', response.success);
                        }
                    });
                });

                //task duplicate 
                $('.duplicate_toggle_class').change(function() {
                    let duplicate = $(this).prop('checked') === true ? 1 : 0;
                    let task_id = $(this).data('id');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('seo.changeDuplicateStatus') }}",
                        data: {
                            'duplicate': duplicate,
                            'task_id': task_id
                        },
                        success: function(response) {
                            // console.log(response);
                            Toaster('success', response.success);
                        }
                    });
                });




                //result parent title status change jquery
                $('.result_toggle_class').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 0;
                    let result_id = $(this).data('id');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('seo.changeResultStatus') }}",
                        data: {
                            'status': status,
                            'result_id': result_id
                        },
                        success: function(response) {
                            // console.log(response);
                            Toaster('success', response.success);

                        }
                    });
                });

                //result parent delete jquery start here
                $(document).on("click", "#result_delete_btn", function() {
                    var result_id = $(this).data('id');

                    $('#result_hidden_id').val(result_id);
                });
                $(document).on('click', '.delete_btn', function() {
                    var result_id = $('#result_hidden_id').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('seo/child-delete') }}/" + result_id,
                        data: {
                            result_id: result_id,
                            _method: 'DELETE'
                        },
                        dataType: "json",
                        success: function(response) {
                            $('#delete_result_modal').removeClass('show');
                            $('#delete_result_modal').css('display', 'none');
                            Toaster('success', response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);
                            window.location.href =
                                "{{ route('seo.workReport', ['tab=result_title']) }}";

                        }
                    });
                });

                //result child delete jquery start here
                $(document).on("click", "#child_delete", function() {
                    var delete_child = $(this).data('id');

                    $('#result_hidden_id').val(delete_child);
                });
                $(document).on('click', '.delete_btn', function() {
                    var delete_child = $('#result_hidden_id').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('seo/child-delete') }}/" + delete_child,
                        data: {
                            delete_child: delete_child,

                        },
                        dataType: "json",
                        success: function(response) {
                            $('#delete_result_modal').removeClass('show');
                            $('#delete_result_modal').css('display', 'none');
                            Toaster('success', response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);
                            window.location.href =
                                "{{ route('seo.workReport', ['tab=result_title']) }}";


                        }
                    });
                });

            });



            $(".resultTitle").on("blur", function(e) {
                e.preventDefault();
                var result_id = $(this).data('id');
                var sort_order = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('seo.change_short_order') }}",
                    data: {
                        result_id: result_id,
                        sort_order: sort_order
                    },
                    dataType: "json",
                    success: function(data) {
                        Toaster('success', data.success);
                    }
                });
            });
        </script>
        <!--end task delete ajax-->
    @endpush
</x-app-layout>
