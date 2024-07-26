<x-app-layout>
    @section('title', $pageTitle)

    <div class="contact-content">
        <div class="contact-content-header mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                 
                <li class="nav-item" id="department"><a href="javascript:void(0)"
                    class="nav-link {{ request()->tab == 'department' || !isset(request()->tab) ? 'active' : '' }}"
                    data-bs-dismiss="tab">{{ __('hrm.department') }}</a></li>
 
                
                <li class="nav-item" id="designation"><a href="javascript:void(0)"
                        class="nav-link {{ request()->tab == 'designation' ? 'active' : '' }}"
                        data-bs-dismiss="tab">{{ __('hrm.designation') }}</a></li>


                <li class="nav-item" id="education_type"><a href="javascript:void(0)"
                    class="nav-link {{ request()->tab == 'education_type' ? 'active' : '' }}"
                    data-bs-dismiss="tab">{{ __('hrm.education_type') }}</a></li>

                <li class="nav-item" id="document_type"><a href="javascript:void(0)"
                    class="nav-link {{ request()->tab == 'document_type' ? 'active' : '' }}"
                    data-bs-dismiss="tab">{{ __('hrm.document_type') }}</a></li>

                <li class="nav-item" id="leaveSetting"><a href="javascript:void(0)"
                    class="nav-link {{ request()->tab == 'leave-setting' ? 'active' : '' }}"
                    data-bs-dismiss="tab">{{ __('hrm.leave_type') }}</a></li>
             
                
            </ul>

        </div> 
        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
            <div class="card contact-content-body">
                <div class="tab-content"> 
                    
                    <!-- Department Start -->
                    <div id="department" class="tab-pane {{ request()->tab == 'department' || !isset(request()->tab) ? 'active' : '' }}">

                        <div class="card-header py-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="tx-15 mg-b-0">{{ __('hrm.department_list') }}</h6>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                    <a href="#departmentadd" data-bs-toggle="modal" class="btn btn-sm btn-bg btn-primary"><i
                                    data-feather="plus"></i>{{ __('user-manager.add_department') }}</a>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table  table_wrapper">
                                    <thead>
                                        <tr>
                                            <th>{{ __('common.sl_no') }}</th>
                                            <th>{{ __('hrm.dept_name') }}</th> 
                                            <th>{{ __('hrm.status') }}</th> 
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                <th class="">{{ __('common.action') }}</th>
                                            @endif
 
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @forelse ($content->departments as $key => $department)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $department->dept_name }}</td>
                                                <td  class=" justify-content-center">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input toggle-class"
                                                            {{ $department->status == '1' ? 'checked' : '' }}
                                                            data-id="{{ $department->department_id }}"
                                                            id="customSwitch{{ $department->department_id }}">
                                                        <label class="custom-control-label"
                                                            for="customSwitch{{ $department->department_id }}"></label>
                                                    </div>
                                                </td>
                                                <td class="">
                                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                                        <a href="#department_edit"
                                                            class="btn btn-sm  px-0 d-flex align-items-center mg-r-5"
                                                            data-id="{{ $department->department_id }}" id="editmodal"
                                                            data-bs-toggle="modal"><i data-feather="edit-2"></i>
                                                        </a>
                                                    @endif 
                                                </td>
                                                  
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center"> No Record Found !</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Department End -->

                    <!-- Designation Start -->
                    <div id="designation" class="tab-pane {{ request()->tab == 'designation' ? 'active' : '' }}"> 
                        <div class="card-header py-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="tx-15 mg-b-0">{{ __('hrm.designation_list') }}</h6>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                    <a href="#designation_add" data-bs-toggle="modal" class="btn btn-sm btn-bg btn-primary"><i data-feather="plus" class="mg-r-5"></i>{{ __('user-manager.add_designation') }}</a>
                                @endif
                            </div>
                        </div> 
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table  table_wrapper">
                                    <thead>
                                        <tr>
                                            <th>{{ __('common.sl_no') }}</th>
                                            <th>{{ __('hrm.designation_name') }}</th> 
                                            <th>{{ __('hrm.status') }}</th> 
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                <th class="">{{ __('common.action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @forelse ($content->designations as $key => $designation)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $designation->designation_name }}</td>
                                                
                                                <td  class=" justify-content-center">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input toggle-designation-class"
                                                            {{ $designation->status == '1' ? 'checked' : '' }}
                                                            data-id="{{ $designation->designation_id }}"
                                                            id="designationSwitch1{{ $designation->designation_id }}">
                                                        <label class="custom-control-label"
                                                            for="designationSwitch1{{ $designation->designation_id }}"></label>
                                                    </div>
                                                </td>
                                             
                                                <td class="">
                                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                                        <a href="#designation_edit"
                                                            class="btn btn-sm  d-flex align-items-center px-0 mg-r-5"
                                                            data-id="{{ $designation->designation_id }}" id="editDesignationmodal"
                                                            data-bs-toggle="modal"><i data-feather="edit-2"></i>
                                                        </a>
                                                    @endif 
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center"> No Record Found !</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Designation End -->

                    <!-- Education Type  Start -->
                    <div id="education_type" class="tab-pane {{ request()->tab == 'education_type' ? 'active' : '' }}"> 
                        <div class="card-header py-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="tx-15 mg-b-0">{{ __('hrm.education_list') }}</h6>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                    <a href="javascript:void(0)"
                                    data-bs-toggle="modal" data-bs-target="#addEducationType"
                                        class="btn btn-sm btn-bg d-flex align-items-center mg-r-5 btn-primary"><i
                                            data-feather="plus"></i><span
                                            class="d-sm-inline mg-l-5">{{ __('hrm.add_education_type') }}</span></a>
                                @endif
                            </div>
                        </div> 
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table  table_wrapper">
                                    <thead>
                                        <tr>
                                            <th>{{ __('common.sl_no') }}</th>
                                            <th>{{ __('hrm.education_name') }}</th> 
                                            <th>{{ __('hrm.status') }}</th> 
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                <th class="">{{ __('common.action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @forelse ($content->education_types as $key => $education_type)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $education_type->education_name }}</td> 
                                            <td  class=" justify-content-center">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input toggle-education-class"
                                                        {{ $education_type->status == '1' ? 'checked' : '' }}
                                                        data-id="{{ $education_type->education_id }}"
                                                        id="educationSwitch2{{ $education_type->education_id }}">
                                                    <label class="custom-control-label"
                                                        for="educationSwitch2{{ $education_type->education_id }}"></label>
                                                </div>
                                            </td>   

                                            <td class="">
                                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                                    <a href="#editEducationType"
                                                        class="btn btn-sm  d-flex align-items-center px-0 mg-r-5"
                                                        data-id="{{ $education_type->education_id }}" id="editEducationmodal"
                                                        data-bs-toggle="modal"><i data-feather="edit-2"></i>
                                                    </a>
                                                @endif 
                                            </td>
                                             
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center"> No Record Found !</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Education Type End -->

                    <!-- Document Type Start -->
                    <div id="document_type" class="tab-pane {{ request()->tab == 'document_type' ? 'active' : '' }}"> 
                        <div class="card-header py-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="tx-15 mg-b-0">{{ __('hrm.document_list') }}</h6>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                    <a href="javascript:void(0)"
                                    data-bs-toggle="modal" data-bs-target="#addDocumentType"
                                        class="btn btn-sm btn-bg d-flex align-items-center mg-r-5 btn-primary"><i
                                            data-feather="plus"></i><span
                                            class="d-sm-inline mg-l-5">{{ __('hrm.add_document_type') }}</span></a>
                                @endif
                            </div>
                        </div> 
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table  table_wrapper">
                                    <thead>
                                        <tr>
                                            <th>{{ __('common.sl_no') }}</th>
                                            <th>{{ __('hrm.doc_type') }}</th> 
                                            <th>{{ __('hrm.doc_name') }}</th> 
                                            <th>{{ __('hrm.status') }}</th> 
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                <th class="">{{ __('common.action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @forelse ($content->document_type as $key => $document)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>
                                                @if($document->document_type == "1") 
                                                Identity
                                                @elseif($document->document_type == "2")
                                                Address
                                                @elseif($document->document_type == "3")
                                                Qualification
                                                @else
                                                Experience
                                                @endif 
                                            
                                            </td>


                                            <td>{{ $document->document_name }}</td>
                                            
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input toggle-document-class"
                                                        {{ $document->status == '1' ? 'checked' : '' }}
                                                        data-id="{{ $document->document_id }}"
                                                        id="documentSwitch3{{ $document->document_id }}">
                                                    <label class="custom-control-label"
                                                        for="documentSwitch3{{ $document->document_id }}"></label>
                                                </div>    
                                            </td>
                                            <td>

                                                <a href="#editDocumentType"
                                                class="btn btn-sm  d-flex align-items-center px-0 mg-r-5"
                                                data-id="{{$document->document_id}}" id="editDocumentmodal"
                                                data-bs-toggle="modal"><i data-feather="edit-2"></i>


                                               
                                            </td>
                                             
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center"> No Record Found !</td>
                                        </tr>
                                    @endforelse   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- DepDocument Type End -->

                    <!-- Leave Type Start -->
                    <div id="leave-setting" class="tab-pane {{ request()->tab == 'leave-setting' ? 'active' : '' }}">

                        <div class="card-header py-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="tx-15 mg-b-0">Leave Type List</h6>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                    <a href="{{ url('hrm/setting/leave-create') }}"
                                        class="btn btn-sm btn-bg d-flex align-items-center mg-r-5 btn-primary"><i
                                            data-feather="plus"></i><span
                                            class="d-sm-inline mg-l-5">{{ __('hrm.add_leave_type') }}</span></a>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table  table_wrapper">
                                    <thead>
                                        <tr>
                                            <th>{{ __('common.sl_no') }}</th>
                                            <th>{{ __('hrm.leave_type') }}</th>
                                            <th>{{ __('hrm.no_of_days') }}</th>
                                            <th>{{ __('hrm.max_allowed') }}</th>
                                            <th>{{ __('hrm.information') }}</th>

                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                <th class="">{{ __('common.action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody> 
                                            @forelse ($content->leave_type as $key => $type)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $type->leave_type_name }}</td>
                                                    <td>{{ $type->no_of_days }}</td>
                                                    <td>{{ $type->max_allowed }}</td>
                                                    <td>{{ $type->leave_info }}</td>
                                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                                        <td class="d-flex align-items-center">
                                                            <a href="{{ url('hrm/setting/leave-edit/' . $type->leave_type_id) }}"
                                                                data-task-id="{{ $type->leave_type_id }}"
                                                                class="btn btn-sm d-flex align-items-center mg-r-5"><i
                                                                    data-feather="edit-2"></i><span
                                                                    class="d-none d-sm-inline mg-l-5"></span></a>

                                                        </td>
                                                    @endif
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center"> No Record Found !</td>
                                                </tr>
                                            @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Leave Type End -->
 
                </div>
            </div>
        @endif
    </div>

<!-- Start all add Modal of settings -->

    <!-- Start Add Department Modal --> 
        <div class="modal fade" id="departmentadd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content tx-14">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">{{ __('user-manager.add_department') }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation" method="POST" id="userForm" novalidate>
                            <input name="department_id" id="department_id" type="hidden" class="form-control">
                            <div>
                                <div class="form-group">
                                    <label class="form-label"> {{ __('user-manager.department_name') }}<span
                                            class="text-danger">*</span></label>
                                    <input name="department_name" id="department_name" type="text" class="form-control"
                                        placeholder="{{ __('user-manager.department_name_placeholder') }}" required>
                                    <div class="invalid-feedback">
                                        {{ __('user-manager.name_error') }}
                                    </div>
                                    <span class="text-danger">
                                        @error('dept_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <input type="submit" id="submit" name="send" class="btn btn-primary"
                                value="{{ __('common.submit') }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Add Department Modal -->

    <!-- Start Add addDesignation Modal --> 
        <div class="modal fade" id="designation_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content tx-14">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">{{ __('user-manager.add_designation') }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="add_userForm" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label class="form-label">{{ __('user-manager.designation') }}<span
                                            class="text-danger">*</span></label>
                                    <input name="designation_name" id="designation_name" type="text" class="form-control"
                                        placeholder="{{ __('user-manager.designation_placeholder') }}" required>
                                    
                                    <span class="text-danger">
                                        @error('designation_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        {{ __('user-manager.designation_name_error') }}
                                    </div>
                                </div>
                            </div>
                            <input type="submit" id="add_submit_btn" name="send" class="btn btn-primary"
                                value=" {{ __('common.submit') }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Add addDesignation Modal -->

    <!-- Start Add addEducationType Modal --> 
        <div class="modal fade" id="addEducationType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content tx-14">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">{{ __('hrm.add_education_type') }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <form method="POST" id="addEducationTypeForm" class="needs-validation mg-b-0" novalidate> 
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label class="form-label">{{ __('hrm.education_name') }}<span class="text-danger">*</span></label>
                                    <input name="education_name" id="education_name" type="text" class="form-control" placeholder="{{ __('hrm.education_name_placeholder') }}" required> 
                                    <div class="invalid-feedback">
                                        {{ __('hrm.education_name_error') }}
                                    </div>
                                </div>
                            </div>
                            <input type="submit" id="addEducationTypeSubmit" name="send" class="btn btn-primary"
                                value="{{ __('common.submit') }}">
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    <!-- End Add addEducationType Modal -->

    <!-- Start Add addDocumentType Modal --> 
        <div class="modal fade" id="addDocumentType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content tx-14">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">{{ __('crm.add_lead_status') }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <form method="POST" id="addDocumentTypeForm" class="needs-validation mg-b-0" novalidate> 
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label class="form-label">{{ __('hrm.document_type') }}<span class="text-danger">*</span></label>
                                    <select class="form-control" name="document_type" id="document_type_id" required>
                                        <option value="">Select Document Type</option>
                                        <option value="1">Identity</option>
                                        <option value="2">Address</option>
                                        <option value="3">Qualification</option>
                                        <option value="4">Experience</option> 
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ __('hrm.document_type_error') }}
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="form-label">{{ __('hrm.document_name') }}<span class="text-danger">*</span></label>
                                    <input name="document_name" id="document_name_hrm" type="text" class="form-control" placeholder="{{ __('hrm.document_name_placeholder') }}" required> 
                                    <div class="invalid-feedback">
                                        {{ __('hrm.document_name_error') }}
                                    </div>
                                </div>
                            </div>
                            <input type="submit" id="addDocumentTypeSubmit" name="send" class="btn btn-primary"
                                value="{{ __('common.submit') }}">
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    <!-- End Add addDocumentType Modal -->

<!-- End all add Settings Modal -->


<!-- Start all Edit Modal -->

    <!-- Start Add editDepartment Modal --> 
        <div class="modal fade" id="department_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content tx-14">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">{{ __('user-manager.update_department') }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation" method="POST" id="update_userForm" novalidate>
                            <input name="department_id" id="department_id" type="hidden" class="form-control">
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label class="form-label"> {{ __('user-manager.department_name') }}<span
                                            class="text-danger">*</span></label>
                                    <input name="dept_name" id="dept_name" type="text" class="form-control"
                                        placeholder="{{ __('user-manager.department_name_placeholder') }}" required>
                                    <div class="invalid-feedback">
                                        {{ __('user-manager.name_error') }}
                                    </div>
                                    <span class="text-danger">
                                        @error('dept_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            
                            <input type="Submit" id="update_btn" name="send" class="btn btn-primary"
                                value="{{ __('common.update') }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Add editDepartment Modal -->

    <!-- Start Edit addDesignation Modal --> 
        <div class="modal fade" id="designation_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content tx-14">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">{{ __('user-manager.update_designation') }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="update_designation_form" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <input name="designation_id" id="design_id" type="hidden" class="form-control">
                            <div>
                                <div class="form-group">
                                    <label class="form-label">{{ __('user-manager.designation') }}<span
                                            class="text-danger">*</span></label>
                                    <input name="designation_name" id="edit_design_name" type="text"
                                        class="form-control"
                                        placeholder="{{ __('user-manager.designation_placeholder') }}" required>
                                    <span class="text-danger">
                                        @error('designation_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        {{ __('user-manager.designation_name_error') }}
                                    </div>
                                </div>
                            </div>
                            <input type="submit" id="update_designation_btn" class="btn btn-primary"
                                value="{{ __('common.update') }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Edit addDesignation Modal -->

    <!-- Start Add editEducationType Modal --> 
        <div class="modal fade" id="editEducationType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content tx-14">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">{{ __('hrm.update_education_type') }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <form method="POST" id="update_education_form" class="needs-validation mg-b-0" novalidate> 
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label class="form-label">{{ __('hrm.education_name') }}<span class="text-danger">*</span></label>
                                    <input name="education_name" id="edit_education_name" type="text" class="form-control" placeholder="{{ __('hrm.education_name_placeholder') }}" required> 
                                    <div class="invalid-feedback">
                                        {{ __('hrm.education_name_error') }}
                                    </div>
                                </div>
                                <input type="hidden" name="education_id" id="education_id"/>
                            </div>
                            <input type="submit" id="update_education_btn" name="send" class="btn btn-primary"
                                value="{{ __('common.submit') }}">
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    <!-- End Add editEducationType Modal -->

    <!-- Start Add editDocumentType Modal --> 
        <div class="modal fade" id="editDocumentType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content tx-14">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Update Document Type</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <form method="POST" id="updateDocumentTypeForm" class="needs-validation mg-b-0" novalidate> 
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <input type="hidden" name="edit_document_type_id" id="edit_document_type_id"/>
                                    <label class="form-label">{{ __('hrm.document_type') }}<span class="text-danger">*</span></label>
                                    <select class="form-control" name="document_type" id="edit_document_type_select_id" required>
                                        <option value="">Select Document Type</option>
                                        <option value="1">Identity</option>
                                        <option value="2">Address</option>
                                        <option value="3">Qualification</option>
                                        <option value="4">Experience</option> 
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ __('hrm.document_type_error') }}
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="form-label">{{ __('hrm.document_name') }}<span class="text-danger">*</span></label>
                                    <input name="document_name" id="edit_document_name" type="text" class="form-control" placeholder="{{ __('hrm.document_name_placeholder') }}" required> 
                                    <div class="invalid-feedback">
                                        {{ __('hrm.document_name_error') }}
                                    </div>
                                </div>
                            </div>
                            <input type="submit" id="updateDocumentType" name="send" class="btn btn-primary"
                                value="{{ __('common.submit') }}">
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    <!-- End Add editDocumentType Modal -->

<!-- End All Edit Modal -->
 

<!-- delete department modal -->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel5">{{ __('user-manager.delete_department') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>{{ __('user-manager.are_you_sure') }}</h6>
                    <input type="hidden" id="delete_department_id" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('common.no') }}
                    </button>
                    <button type="submit" class="btn btn-primary delete_submit_btn">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
    
        <script>
            // start aad Department Modal ajax
            $(document).ready(function() {
                $(document).on('click', "#submit", function(e) {
                    e.preventDefault();
                    $('#userForm').addClass('was-validated');
                    if ($('#userForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            dept_name: $("#department_name").val(),
                            dept_details: $("#department_details").val(),
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ route('hrm.department.store') }}",
                            data: data,
                            dataType: "json",
                            success: function(response) {
                                if (response.success) {
                                 Toaster("success", response.success);

                                 setTimeout(function() {
                                     location.reload(true);
                                 }, 3000);
                                 window.location.href =
                                     "{{  route('hrm.setting', ['tab=department']) }}";

                             } else {
                                 Toaster("error", response.error);
                             }


                            },
                        });
                    }
                });
            });

             // start edit modal ajax
             $(document).on("click", "#editmodal", function(e) {
                e.preventDefault();
                var department_id = $(this).data('id');
                $.ajax({
                    url: "department/" + department_id + "/edit",
                    type: "GET",
                    success: function(response) {
                        console.log(response);
                        $('#dept_name').val(response.data.dept_name);
                        $('#department_id').val(response.data.department_id);
                        $('#status').val(response.data.status);
                    }
                });
            });

            //start edit department modal ajax 
             $(document).on("click", "#update_btn", function(e) {
                e.preventDefault();
                $('#update_userForm').addClass('was-validated');
                if ($('#update_userForm')[0].checkValidity() === false) {
                    event.stopPropagation();
                } else {
                    var data = {
                        department_id: $('#department_id').val(),
                        dept_name: $('#dept_name').val(), 
                    }
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('hrm.dptUpdate') }}",
                        data: data,
                        dataType: "json",
                        success: function(response) {

                            if (response.success) {
                                 Toaster("success", response.success);

                                 setTimeout(function() {
                                     location.reload(true);
                                 }, 3000);
                                 window.location.href =
                                     "{{ route('hrm.setting', ['tab=department'])}}";

                             } else {
                                 Toaster("error", response.error);
                             }

 
                        }
                    });
                }
            });

            // change status open
            $('.toggle-class').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let department_id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('hrm.dptStatus') }}",
                    data: {
                        'status': status,
                        'department_id': department_id
                    },
                    success: function(response) {
                     
                        if (response.success) {
                                 Toaster("success", response.success);

                                 setTimeout(function() {
                                     location.reload(true);
                                 }, 3000);
                                 window.location.href =
                                     "{{ route('hrm.setting', ['tab=department'])  }}";

                             } else {
                                 Toaster("error", response.error);
                             }
                    }
                });
            });


            //delete department ajax start here
            $(document).on("click", "#delete_btn", function() {
                var department_id = $(this).data('id');
                $('#delete_department_id').val(department_id);
            });
            $(document).on('click', '.delete_submit_btn', function() {
                var department_id = $('#delete_department_id').val();
                console.log(department_id);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('hrm/dptdestroy') }}/" + department_id,
                    data: {
                        department_id: department_id
                    },
                    dataType: "json",
                    success: function(response) {

                        if (response.success) {
                                 Toaster("success", response.success);

                                 setTimeout(function() {
                                     location.reload(true);
                                 }, 3000);
                                 window.location.href =
                                     "{{  route('hrm.setting', ['tab=department'])  }}";

                             } else {
                                 Toaster("error", response.error);
                             }
  
                    }
                });

            });

        </script>

        <script>
             $(document).ready(function() {
                // start designation-add ajax
                $(document).on('click', "#add_submit_btn", function(e) {
                    e.preventDefault();
                    $('#add_userForm').addClass('was-validated');
                    if ($('#add_userForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            designation_name: $("#designation_name").val(),
                        };
                        console.log(data);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ route('hrm.designation.store') }}",
                            data: data,
                            dataType: "json",
                            success: function(response) {


                                if (response.success) {
                                Toaster("success", response.success);

                                setTimeout(function() {
                                    location.reload(true);
                                }, 3000);
                                window.location.href =
                                    "{{ route('hrm.setting', ['tab=designation']) }}";

                            } else {
                                Toaster("error", response.error);
                            }
                
                            },
                        });
                    }
                });

                // start designation-edit ajax
                $(document).on("click", "#editDesignationmodal", function(e) {
                    e.preventDefault();
                    var designation_id = $(this).data('id');
                    $.ajax({
                        url: "designation/" + designation_id + "/edit",
                        type: "GET",
                        success: function(response) {
                            console.log(response);
                            $('#edit_design_name').val(response.designation_name);
                            $('#design_id').val(response.designation_id);
                        }
                    });
                });
                // end designation-edit ajax

                // start designation-update ajax
                $(document).on("click", "#update_designation_btn", function(e) {
                    e.preventDefault();
                    $('#update_designation_form').addClass('was-validated');
                    if ($('#update_designation_form')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            designation_id: $("#design_id").val(),
                            designation_name: $("#edit_design_name").val(),
                        }
                        console.log(data);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ url('hrm/designation/Update') }}",
                            data: data,
                            dataType: "json",
                            success: function(response) {
                                console.log(response);
                                if (response.success) {
                                 Toaster("success", response.success);

                                 setTimeout(function() {
                                     location.reload(true);
                                 }, 3000);
                                 window.location.href =
                                     "{{  route('hrm.setting', ['tab=designation']) }}";

                             } else {
                                 Toaster("error", response.error);
                             }
                            }
                        });
                    }
                });
                // end designation-update ajax


                // start designation-status ajax
                $('.toggle-designation-class').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 0;
                    let designation_id = $(this).data('id');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('hrm.changedesignationStatus') }}",
                        data: {
                            'status': status,
                            'designation_id': designation_id
                        },
                        success: function(response) {
                           
                            if (response.success) {
                                 Toaster("success", response.success);

                                 setTimeout(function() {
                                     location.reload(true);
                                 }, 3000);
                                 window.location.href = "{{  route('hrm.setting', ['tab=designation'])  }}";

                             } else {
                                 Toaster("error", response.error);
                             }
                        }
                    });
                });
                // end designation-status ajax
            });
        </script>

        <script>
            $(document).ready(function() {
                // start designation-add ajax
                $(document).on('click', "#addEducationTypeSubmit", function(e) {
                    e.preventDefault();
                    $('#addEducationTypeForm').addClass('was-validated');
                    if ($('#addEducationTypeForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            education_name: $("#education_name").val(),
                        };
                        console.log(data);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ route('hrm.education.store') }}",
                            data: data,
                            dataType: "json",
                            success: function(response) {


                                if (response.success) {
                                Toaster("success", response.success);

                                setTimeout(function() {
                                    location.reload(true);
                                }, 3000);
                                window.location.href =
                                    "{{ route('hrm.setting', ['tab=education_type']) }}";

                            } else {
                                Toaster("error", response.error);
                            }
                
                            },
                        });
                    }
                });

                // start education-edit ajax
                $(document).on("click", "#editEducationmodal", function(e) {
                    e.preventDefault();
                    var education_id = $(this).data('id');
                    $.ajax({
                        url: "education/" + education_id + "/edit",
                        type: "GET",
                        success: function(response) {
                            console.log(response);
                            $('#edit_education_name').val(response.education_name);
                            $('#education_id').val(response.education_id);
                        }
                    });
                });
                // end education-edit ajax

                // start education-update ajax
                $(document).on("click", "#update_education_btn", function(e) {
                    e.preventDefault();
                    $('#update_education_form').addClass('was-validated');
                    if ($('#update_education_form')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            education_id: $("#education_id").val(),
                            education_name: $("#edit_education_name").val(),
                        }
                        console.log(data);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ url('hrm/education/Update') }}",
                            data: data,
                            dataType: "json",
                            success: function(response) {
                                console.log(response);
                                if (response.success) {
                                    Toaster("success", response.success);

                                    setTimeout(function() {
                                        location.reload(true);
                                    }, 3000);
                                    window.location.href =
                                        "{{ route('hrm.setting', ['tab=education_type']) }}";

                                } else {
                                    Toaster("error", response.error);
                                }
                            }
                        });
                    }
                });
                // end education-update ajax 

                // start education-status ajax
                $('.toggle-education-class').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 0;
                    let education_id = $(this).data('id');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('hrm.changeeducationStatus') }}",
                        data: {
                            'status': status,
                            'education_id': education_id
                        },
                        success: function(response) {
                            
                            if (response.success) {
                                    Toaster("success", response.success);

                                    setTimeout(function() {
                                        location.reload(true);
                                    }, 3000);
                                    window.location.href =
                                        "{{ route('hrm.setting', ['tab=education_type'])  }}";

                                } else {
                                    Toaster("error", response.error);
                                }
                        }
                    });
                });
                // end designation-status ajax
            });
        </script>

        <script>
            $(document).ready(function() {
                // start designation-add ajax
                $(document).on('click', "#addDocumentTypeSubmit", function(e) {
                    e.preventDefault();
                    $('#addDocumentTypeForm').addClass('was-validated');
                    if ($('#addDocumentTypeForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            document_type_id: $("#document_type_id").val(),
                            document_name: $("#document_name_hrm").val(),
                        };
                        
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ route('hrm.document-type.store') }}",
                            data: data,
                            dataType: "json",
                            success: function(response) {


                                if (response.success) {
                                Toaster("success", response.success);

                                setTimeout(function() {
                                    location.reload(true);
                                }, 3000);
                                window.location.href =
                                    "{{ route('hrm.setting', ['tab=document_type'])  }}";

                            } else {
                                Toaster("error", response.error);
                            }
                
                            },
                        });
                    }
                });

                // start education-edit ajax
                $(document).on("click", "#editDocumentmodal", function(e) {
                    e.preventDefault();
                    var document_id = $(this).data('id');
                    $.ajax({
                        url: "document-type/" + document_id + "/edit",
                        type: "GET",
                        success: function(response) { 
                            $('#edit_document_name').val(response.document_name);
                            $('#edit_document_type_select_id').val(response.document_type);
                            $('#edit_document_type_id').val(response.document_id);
                        }
                    });
                });
                // end education-edit ajax

                // start education-update ajax
                $(document).on("click", "#updateDocumentType", function(e) {
                    e.preventDefault();
                    $('#updateDocumentTypeForm').addClass('was-validated');
                    if ($('#updateDocumentTypeForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            document_name: $("#edit_document_name").val(),
                            document_type: $("#edit_document_type_select_id").val(),
                            document_id: $("#edit_document_type_id").val(),
                        }
                        console.log(data);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ url('hrm/document-type/Update') }}",
                            data: data,
                            dataType: "json",
                            success: function(response) {
                                console.log(response);
                                if (response.success) {
                                    Toaster("success", response.success);

                                    setTimeout(function() {
                                        location.reload(true);
                                    }, 3000);
                                    window.location.href =
                                        "{{ route('hrm.setting', ['tab=document_type'])  }}";

                                } else {
                                    Toaster("error", response.error);
                                }
                            }
                        });
                    }
                });
                // end education-update ajax 

                // start education-status ajax
                $('.toggle-document-class').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 0;
                    let document_id = $(this).data('id');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('hrm.changedocumentTypeStatus') }}",
                        data: {
                            'status': status,
                            'document_id': document_id
                        },
                        success: function(response) {
                            
                            if (response.success) {
                                    Toaster("success", response.success);

                                    setTimeout(function() {
                                        location.reload(true);
                                    }, 3000);
                                    window.location.href =
                                        "{{ route('hrm.setting', ['tab=document_type'])  }}";

                                } else {
                                    Toaster("error", response.error);
                                }
                        }
                    });
                });
                // end designation-status ajax
            });
        </script>

        <script>
            $('#leaveSetting').click(function() {
                window.location.href = "{{ route('hrm.setting', ['tab=leave-setting']) }}";
            }); 
            $('#department').click(function() {
                window.location.href = "{{ route('hrm.setting', ['tab=department']) }}";
            });
            $('#designation').click(function() {
                window.location.href = "{{ route('hrm.setting', ['tab=designation']) }}";
            });
            $('#education_type').click(function() {
                window.location.href = "{{ route('hrm.setting', ['tab=education_type']) }}";
            });
            $('#document_type').click(function() {
                window.location.href = "{{ route('hrm.setting', ['tab=document_type']) }}";
            });
        </script>
    @endpush

</x-app-layout>
