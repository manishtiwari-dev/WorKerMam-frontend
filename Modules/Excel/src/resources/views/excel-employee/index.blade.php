<x-app-layout>

    @section('title', $pageTitle)
    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')

        <div class="contact-content">
            <div class="contact-content-header mg-b-20 mg-lg-b-25 mg-xl-b-30">
                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item" id="employeeTab"><a href="#employee"
                        class="nav-link  {{ request()->tab == 'employee' || !isset(request()->tab) ? 'active' : '' }}"
                        data-toggle="tab">{{ __('excel.excelEmp') }}</a></li>



                    <li class="nav-item" id="designTab"><a href="#designation"
                            class="nav-link  {{ request()->tab == 'designation'  ? 'active' : '' }}"
                            data-toggle="tab">{{ __('excel.excelDesign') }}</a></li>

                    <li class="nav-item" id="locationTab"><a href="#location"
                            class="nav-link {{ request()->tab == 'location' ? 'active' : '' }}"
                            data-toggle="tab">{{ __('excel.excelLocation') }}</a></li>

                  
                </ul>

            </div>
            <div class="card contact-content-body">
                <div class="tab-content">


                   
                    <div id="employee"  class="tab-pane {{ request()->tab == 'employee' || !isset(request()->tab) ? 'active' : '' }} ">

                        <div class="card-header">
                            {{-- <div class="d-flex align-items-center justify-content-between">
                                <h6 class="tx-15 mg-b-0">Excel Employee</h6>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                               <a href="#Employee" data-toggle="modal" id="add_emp"
                               class="btn btn-sm btn-bg "><i
                                   data-feather="plus"></i>{{ __('excel.excelsEmployeeadd') }}</a>

                            
                               <a href="{{ route('excel.employee-import') }}">
                                   <button class="btn btn-md  btn-primary justify-content-end"><i data-feather="plus"
                                           class="lead_icon mg-r-5"></i>Import</button>
                               </a>
                               @endif
                            </div> --}}

                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="tx-15 mg-b-0"> Employee</h6>

                                <div class="d-flex gap-1">
                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                        <a href="#Employee" data-toggle="modal" id="add_emp"
                                            class="btn btn-sm btn-bg "><i
                                                data-feather="plus"></i>{{ __('excel.excelsEmployeeadd') }}</a>

                                        <a href="{{ route('excel.employee-import') }}"
                                            class="btn btn-sm btn-bg d-flex align-items-center mg-r-5">
                                            <i data-feather="plus"></i>
                                            <span class="d-none d-sm-inline mg-l-5">Import</span></a>
                                    @endif

                                </div>
                            </div>

                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table border table_wrapper">
                                    <thead>
                                        <tr>
                                            <th>{{ __('common.sl_no') }}</th>
                                            <th>{{ __('excel.employee') }}</th>
                                            <th>{{ __('user-manager.designation') }}</th>
                                            <th>{{ __('excel.location') }}</th>
                                            <th>{{ __('common.status') }}</th>
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                <th>{{ __('common.action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($content->excelEmployeeList as $key => $emp)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $emp->employee_name }}</td>
                                                <td>
                                                    @if (!empty($emp->designation_details))
                                                        {{ $emp->designation_details->designation }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (!empty($emp->location_details))
                                                        {{ $emp->location_details->location }}
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox"
                                                            class="custom-control-input emp_toggle_class"
                                                            {{ $emp->status == '1' ? 'checked' : '' }}
                                                            data-id="{{ $emp->id }}"
                                                            id="customSwitches{{ $emp->id }}">
                                                        <label class="custom-control-label"
                                                            for="customSwitches{{ $emp->id }}"></label>
                                                    </div>
                                                </td>
                                                <td class="d-flex align-items-center">
                                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                        <a href="#modalEditEmployee" data-id="{{ $emp->id }}"
                                                            data-toggle="modal"
                                                            class="btn btn-sm btn-white d-flex align-items-center mg-r-5 emp_edit_btn"><i
                                                                data-feather="edit-2"></i><span
                                                                class="d-none d-sm-inline mg-l-5"></span></a>
                                                    @endif
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                    <h5 class="text-center mb-0 py-1">No Record Found !.</h5>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>







                    <div id="designation"
                        class="tab-pane {{ request()->tab == 'designation'  ? 'active' : '' }} ">

                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="tx-15 mg-b-0"> Designation</h6>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                    <a href="#designation_add" data-toggle="modal" class="btn btn-sm btn-bg"><i
                                            data-feather="plus"
                                            class="mg-r-5"></i>{{ __('user-manager.add_designation') }}</a>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table border table_wrapper">
                                    <thead>
                                        <tr>
                                            <th>{{ __('common.sl_no') }}</th>
                                            <th>{{ __('user-manager.designation') }}</th>
                                            <th>{{ __('common.status') }}</th>
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                <th>{{ __('common.action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($content->excelDesignationList as $key => $design)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td id="designTDList">{{ $design->designation }}</td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox"
                                                            class="custom-control-input design_toggle_class"
                                                            {{ $design->status == '1' ? 'checked' : '' }}
                                                            data-id="{{ $design->id }}"
                                                            id="customSwitch1{{ $design->id }}">
                                                        <label class="custom-control-label"
                                                            for="customSwitch1{{ $design->id }}"></label>
                                                    </div>
                                                </td>
                                                <td class="d-flex align-items-center">
                                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                        <a href="#designation_edit"
                                                            class="btn btn-sm btn-white d-flex align-items-center mg-r-5"
                                                            data-id="{{ $design->id }}" id="editmodal"
                                                            data-toggle="modal"><i data-feather="edit-2"></i></a>

                                                        {{-- <a href="#modalEditExcel" data-id="{{ $design->id }}"
                                                        data-toggle="modal"
                                                        class="btn btn-sm btn-white d-flex align-items-center mg-r-5 excel_edit_btn"><i
                                                            data-feather="edit-2"></i><span
                                                            class="d-none d-sm-inline mg-l-5"></span></a> --}}
                                                    @endif
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                    <h5 class="text-center mb-0 py-1">No Record Found !.</h5>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="location" class="tab-pane {{ request()->tab == 'location' ? 'active' : '' }}">

                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="tx-15 mg-b-0">Location</h6>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                    <a href="#location_add" data-toggle="modal"
                                        class="btn btn-sm btn-bg d-flex align-items-center"><i
                                            data-feather="plus"></i><span
                                            class="d-none d-sm-inline mg-l-5">{{ __('excel.excelsLocationadd') }}</span></a>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table border table_wrapper">
                                    <thead>
                                        <tr>
                                            <th>{{ __('common.sl_no') }}</th>
                                            <th>{{ __('excel.location') }}</th>
                                            <th>{{ __('common.status') }}</th>
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                <th>{{ __('common.action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($content->excelLocationList as $key => $loactionList)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td id="locationTDList">{{ $loactionList->location }}</td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox"
                                                            class="custom-control-input location_toggle_class"
                                                            {{ $loactionList->status == '1' ? 'checked' : '' }}
                                                            data-id="{{ $loactionList->id }}"
                                                            id="customSwitch3{{ $loactionList->id }}">
                                                        <label class="custom-control-label"
                                                            for="customSwitch3{{ $loactionList->id }}"></label>
                                                    </div>
                                                </td>
                                                <td class="d-flex align-items-center">
                                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                        <a href="#location_edit"
                                                            class="btn btn-sm btn-white d-flex align-items-center mg-r-5"
                                                            data-id="{{ $loactionList->id }}" id="editLocationmodal"
                                                            data-toggle="modal"><i data-feather="edit-2"></i></a>
                                                    @endif

                                                    {{-- <a href="#modalEditExcel" data-id="{{ $loactionList->id }}"
                                                        data-toggle="modal"
                                                        class="btn btn-sm btn-white d-flex align-items-center mg-r-5 excel_edit_btn"><i
                                                            data-feather="edit-2"></i><span
                                                            class="d-none d-sm-inline mg-l-5"></span></a> --}}
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                    <h5 class="text-center mb-0 py-1">No Record Found !.</h5>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                 
                </div>
            </div>

        </div>
    @endif

    
    <!-- start designation add modal -->
    <div class="modal fade  designation_add" id="designation_add" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('user-manager.add_designation') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="add_userForm" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('user-manager.designation') }}<span
                                        class="text-danger">*</span></label>
                                <input name="designation_name" id="designation_name" type="text"
                                    class="form-control"
                                    placeholder="{{ __('user-manager.designation_placeholder') }}" required>
                                {{-- <div class="invalid-feedback">
                       Please Enter Designation Name
                   </div> --}}
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
    <!-- end designation add modal -->

    <!-- start designation edit modal -->
    <div class="modal fade" id="designation_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('user-manager.update_designation') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_userForm" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <input name="designation_id" id="design_id" type="hidden" class="form-control">
                        <div class="form-row">
                            <div class="form-group col-lg-12">
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
                        <input type="submit" id="update_btn" class="btn btn-primary"
                            value="{{ __('common.update') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end designation edit modal -->

    {{-- start location modal --}}
    <div class="modal fade" id="location_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('excel.excelsLocationadd') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_loactionForm" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('excel.location') }}<span
                                        class="text-danger">*</span></label>
                                <input name="location" id="location_name_store" type="text" class="form-control"
                                    placeholder="{{ __('excel.location') }}" required>
                                {{-- <div class="invalid-feedback">
                   Please Enter Designation Name
               </div> --}}
                                <span class="text-danger">
                                    @error('location')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    Enter Location Name
                                </div>
                            </div>
                        </div>
                        <input type="submit" id="add_loaction_submit_btn" name="send" class="btn btn-primary"
                            value=" {{ __('common.submit') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end location add modal -->

    <!-- start location edit modal -->
    <div class="modal fade" id="location_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('excel.excelsLocationUpdate') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_locationForm" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <input name="id" id="location_id" type="hidden" class="form-control">
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('excel.location') }}<span
                                        class="text-danger">*</span></label>
                                <input name="location" id="location_name" type="text" class="form-control"
                                    placeholder="{{ __('excel.location') }}" required>
                                <span class="text-danger">
                                    @error('location')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    Enter Location Name
                                </div>
                            </div>
                        </div>
                        <input type="submit" id="update_location_btn" class="btn btn-primary"
                            value="{{ __('common.update') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end location edit modal -->

    {{-- start Employee modal  --}}
    <!--start add modal-->
    <div class="modal fade" id="Employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('excel.excelsEmployeeadd') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="empAdd" class="needs-validation mg-b-0" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('excel.employee') }}<span
                                        class="text-danger">*</span></label>
                                <input name="employee_name" id="employee_name" type="text" class="form-control"
                                    placeholder="{{ __('excel.employee') }}" required>
                                <div class="invalid-feedback">
                                    Enter a Employee Name
                                </div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('excel.excelDesign') }} </label>
                                <a href="javascript:;" title="@lang('app.add') @lang('excel.excelDesign')"
                                    id="addExcelDesign" class="btn btn-sm btn-info btn-outline"><i
                                        class="fa fa-plus"></i></a>

                                <select class="form-control" id="designList" name="designation">
                                    <option value="" selected disabled>{{ __('excel.selectDesignation') }}
                                    </option>
                                </select>

                            </div>

                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('excel.location') }} </label>
                                <a href="javascript:;" title="@lang('app.add') @lang('excel.excelsLocation')"
                                    id="addExcelLocation" class="btn btn-sm btn-info btn-outline"><i
                                        class="fa fa-plus"></i></a>
                                <select class="form-control" id="locationList" name="parent">
                                    <option value="" selected disabled>{{ __('excel.selectLocation') }}</option>

                                </select>

                            </div>

                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('excel.type') }} </label>
                                <select class="form-control" id="emp_type" name="parent">
                                    <option value="" selected disabled>{{ __('excel.selectType') }}</option>

                                    <option value="1">Permanent</option>
                                    <option value="2">Contract</option>

                                </select>

                            </div>

                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('excel.salary') }}<span
                                        class="text-danger">*</span></label>
                                <input name="sheetName" id="emp_salary" type="number" class="form-control"
                                    placeholder="{{ __('excel.salary') }}" required>
                                <div class="invalid-feedback">
                                    Enter Salary
                                </div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('excel.food') }}<span
                                        class="text-danger">*</span></label>
                                <input name="sheetName" id="emp_food" type="number" class="form-control"
                                    placeholder="{{ __('excel.food') }}" required>
                                <div class="invalid-feedback">
                                    Enter Food
                                </div>
                            </div>

                        </div>
                        <input type="submit" id="AddEmpData" name="send" class="btn btn-primary"
                            value="{{ __('common.submit') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end add modal-->

    <div class="modal fade" id="modalEditEmployee" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Update</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation novalidate" id="edit_employee" novalidate>
                        <input type="hidden" name="input_field_id" id="edit_excel_field">
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('excel.employee') }}<span
                                        class="text-danger">*</span></label>
                                <input name="employee_name" id="update_employee_name" type="text"
                                    class="form-control" placeholder="{{ __('excel.employee') }}" required>
                                <div class="invalid-feedback">
                                    Enter Employee Name
                                </div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('excel.excelDesign') }} </label>

                                <select class="form-control" id="update_designList" name="designation">
                                    <option value="" selected disabled>{{ __('excel.selectDesignation') }}
                                    </option>
                                </select>

                            </div>

                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('excel.location') }} </label>

                                <select class="form-control" id="update_locationList" name="parent">
                                    <option value="" selected disabled>{{ __('excel.selectLocation') }}
                                    </option>

                                </select>

                            </div>

                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('excel.type') }} </label>
                                <select class="form-control" id="update_emp_type" name="parent">
                                    <option value="" selected disabled>{{ __('excel.selectType') }}</option>

                                    <option value="1">Permanent</option>
                                    <option value="2">Contract</option>

                                </select>

                            </div>

                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('excel.salary') }}<span
                                        class="text-danger">*</span></label>
                                <input name="sheetName" id="update_emp_salary" type="number" class="form-control"
                                    placeholder="{{ __('excel.salary') }}" required>
                                <div class="invalid-feedback">
                                    Enter Salary
                                </div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('excel.food') }}<span
                                        class="text-danger">*</span></label>
                                <input name="sheetName" id="update_emp_food" type="number" class="form-control"
                                    placeholder="{{ __('excel.food') }}" required>
                                <div class="invalid-feedback">
                                    Enter Food
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-12 mt-4" required>
                                <input type="submit" id="update_emp_Account" class="btn btn-primary"
                                    value="Update">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            //designation ajax 
            $(document).ready(function() {

                // start designation-add ajax
                $(document).on('click', "#add_submit_btn", function(e) {
                    e.preventDefault();
                    $('#add_userForm').addClass('was-validated');
                    if ($('#add_userForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            designation: $("#designation_name").val(),
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ route('excel.excelDesign.store') }}",
                            data: data,
                            dataType: "json",

                            success: function(response) {
                                Toaster("success", response.success);
                                console.log(response.data);
                                $('#designList').empty();
                                var options = [];
                                var rData = [];
                                rData = response.data;
                                $.each(rData, function(index, value) {
                                    var selectData = '';
                                    selectData = '<option value="' + value.id + '">' + value
                                        .designation +
                                        '</option>';
                                    options.push(selectData);

                                    $('#designTDList').val(value.designation);

                                });
                                $('#designList').html(options);

                                $('#designation_add').modal('hide');
                            }
                            // success: function(response) {


                            //     if (response.success) {
                            //         Toaster("success", response.success);
                            //         $('#designation_add').modal('hide');
                            //         // window.location.reload();

                            //         // setTimeout(function() {
                            //         //     location.reload(true);
                            //         // }, 3000);
                            //         // window.location.href =
                            //         //     "{{ route('excel.employee.index', ['tab=designation']) }}";

                            //     } else {
                            //         Toaster("error", response.error);
                            //     }


                            //     // Toaster(response);
                            //     // setTimeout(function() {
                            //     //     location.reload();
                            //     // }, 1000)
                            // },
                        });
                    }
                });

                // start designation-edit ajax
                $(document).on("click", "#editmodal", function(e) {
                    e.preventDefault();
                    var designation_id = $(this).data('id');
                    $.ajax({
                        url: "{{ url('excel/excel-designedit') }}/" + designation_id,

                        type: "GET",
                        success: function(response) {
                            console.log(response[0].excelDesination);
                            $('#edit_design_name').val(response[0].excelDesination.designation);
                            $('#design_id').val(response[0].excelDesination.id);
                        }
                    });
                });
                // end designation-edit ajax


                // start designation-update ajax
                $(document).on("click", "#update_btn", function(e) {
                    e.preventDefault();
                    $('#update_userForm').addClass('was-validated');
                    if ($('#update_userForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            id: $("#design_id").val(),
                            designation: $("#edit_design_name").val(),
                        }
                        console.log(data);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ url('excel/designupdate') }}",
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
                                        "{{ route('excel.employee.index', ['tab=designation']) }}";

                                } else {
                                    Toaster("error", response.error);
                                }
                            }
                        });
                    }
                });
                // end designation-update ajax


                // start designation-status ajax
                $('.design_toggle_class').change(function() {
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
                        url: "{{ route('excel.designchangeStatus') }}",
                        data: {
                            'status': status,
                            'id': designation_id
                        },
                        success: function(response) {

                            if (response.success) {
                                Toaster("success", response.success);

                                setTimeout(function() {
                                    location.reload(true);
                                }, 3000);
                                //  window.location.href =
                                //      "{{ route('excel.settings.index') }}";

                            } else {
                                Toaster("error", response.error);
                            }
                        }
                    });
                });
                // end designation-status ajax

            });

            //location ajax
            $(document).ready(function() {

            // start location-add ajax
            $(document).on('click', "#add_loaction_submit_btn", function(e) {
                e.preventDefault();
                $('#add_loactionForm').addClass('was-validated');
                if ($('#add_loactionForm')[0].checkValidity() === false) {
                    event.stopPropagation();
                } else {
                    var data = {
                        location: $("#location_name_store").val(),
                    };
                    console.log(data);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('excel.excelLocation.store') }}",
                        data: data,
                        dataType: "json",

                        success: function(response) {
                            Toaster("success", response.success);

                            console.log(response.data);
                            $('#locationList').empty();
                            var options = [];
                            var rData = [];
                            rData = response.data;
                            $.each(rData, function(index, value) {
                                var selectData = '';
                                selectData = '<option value="' + value.id + '">' + value
                                    .location +
                                    '</option>';
                                options.push(selectData);

                                $('#locationTDList').val(value.location);

                            });
                            $('#locationList').html(options);

                            $('#location_add').modal('hide');
                        }
                       
                    });
                }
            });












            // start location-edit ajax
            $(document).on("click", "#editLocationmodal", function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ url('excel/excel-locationedit') }}/" + id,

                    type: "GET",
                    success: function(response) {
                        console.log(response[0].excelLoactionList);
                        $('#location_name').val(response[0].excelLoactionList.location);
                        $('#location_id').val(response[0].excelLoactionList.id);
                    }
                });
            });
            // end location-edit ajax


            // start location-update ajax
            $(document).on("click", "#update_location_btn", function(e) {
                e.preventDefault();
                $('#update_locationForm').addClass('was-validated');
                if ($('#update_locationForm')[0].checkValidity() === false) {
                    event.stopPropagation();
                } else {
                    var data = {
                        id: $("#location_id").val(),
                        location: $("#location_name").val(),
                    }
                    console.log(data);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('excel/locationupdate') }}",
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
                                    "{{ route('excel.employee.index', ['tab=location']) }}";

                            } else {
                                Toaster("error", response.error);
                            }
                        }
                    });
                }
            });
            // end location-update ajax


            // start location-status ajax
            $('.location_toggle_class').change(function() {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let id = $(this).data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('excel.loactionChangeStatus') }}",
                data: {
                    'status': status,
                    'id': id
                },
                success: function(response) {

                    if (response.success) {
                        Toaster("success", response.success);

                        setTimeout(function() {
                            location.reload(true);
                        }, 3000);
                        //  window.location.href =
                        //      "{{ route('excel.settings.index') }}";

                    } else {
                        Toaster("error", response.error);
                    }
                }
            });
            });
            // end location-status ajax
            });

            //employee ajax
            $(document).ready(function() {

                $('.emp_edit_btn').on('click', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');


                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "GET",
                        url: "{{ url('excel/excel-employeeedit') }}/" + id,

                        //    url: "{{ url('seo/results-edit') }}/" + result_id,
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            var sec = response[0].excelEmployeeList;

                            $("#edit_excel_field").val(sec.id);

                            $("#update_employee_name").val(sec.employee_name),
                                // $("#updatedesignList").val() ?? 0,
                                //  $("#updatelocationList").val() ?? 0,
                                $("#update_emp_type").val(sec.type) ?? 0,
                                $("#update_emp_salary").val(sec.salary) ?? 0,
                                $("#update_emp_food").val(sec.food),




                                // $("#updatedesignList").val(sec.title_name);
                                $('#update_designList option[value="' + sec.designation + '"]')
                                .prop('selected',
                                    true);
                            $("#update_designList").html('');
                            $("#update_locationList").html('');



                            $.each(response[0].excelDesignationList, function(key, value) {
                                let option_html = "<option value='" + value.id + "'>" +
                                    value.designation + "</option>"
                                $("#update_designList").append(option_html);
                                $("#updatedesignList").val(sec.designation);

                            });

                            $.each(response[0].excelLocationList, function(key, value) {
                                let option_html = "<option value='" + value.id + "'>" +
                                    value.location + "</option>"
                                $("#update_locationList").append(option_html);
                                $("#update_locationList").val(sec.location);

                            });


                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                });




                $(document).on("submit", "#modalEditEmployee", function(e) {
                    e.preventDefault();

                    var data = {
                        id: $("#edit_excel_field").val(),

                        employee_name: $("#update_employee_name").val(),
                        designation: $("#update_designList").val() ?? 0,
                        location: $("#update_locationList").val() ?? 0,
                        type: $("#update_emp_type").val() ?? 0,
                        salary: $("#update_emp_salary").val() ?? 0,
                        food: $("#update_emp_food").val(),

                    }

                    console.log(data);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('excel/employeeupdate') }}",

                        data: data,
                        success: function(response) {
                            $('#modalEditEmployee').removeClass('show');
                            $('#modalEditEmployee').css('display', 'none');
                            console.log(response);
                            if (response.success) {
                                Toaster("success", response.success);

                            } else {
                                Toaster("error", response.error);
                            }
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);

                            window.location.href =
                                "{{ route('excel.employee.index', ['tab=employee']) }}";


                        }
                    });

                });







                //store emp start ajax
                $(document).on("submit", "#empAdd", function(e) {
                    e.preventDefault();

                    // let section_type = $("#section_type:checked").val();
                    var formData = {
                        employee_name: $("#employee_name").val(),
                        designation: $("#designList").val() ?? 0,
                        location: $("#locationList").val() ?? 0,
                        type: $("#emp_type").val() ?? 0,
                        salary: $("#emp_salary").val() ?? 0,
                        food: $("#emp_food").val(),
                    };

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('excel.employee.store') }}",

                        type: "POST",
                        data: formData,
                        dataType: "json",
                        success: function(response) {

                            $('#modal1').removeClass('show');
                            $('#modal1').css('display', 'none');
                            if (response.success) {
                                Toaster("success", response.success);

                            } else {
                                Toaster("error", response.error);
                            }

                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);

                            window.location.href =
                                "{{ route('excel.employee.index', ['tab=employee']) }}";

                        },
                        //error: function(xhr, status, error) {
                        //console.log(err);
                        //    var err = JSON.parse(xhr.responseText);
                        //    $('#title_msg').html(err.errors.title);
                        // }

                    });
                });
                //store emp end ajax




                // start emp ajax
                $('.emp_toggle_class').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 0;
                    let id = $(this).data('id');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('excel.employeeChangeStatus') }}",
                        data: {
                            'status': status,
                            'id': id
                        },
                        success: function(response) {

                            if (response.success) {
                                Toaster("success", response.success);

                                setTimeout(function() {
                                    location.reload(true);
                                }, 3000);
                                //  window.location.href =
                                //      "{{ route('excel.settings.index') }}";

                            } else {
                                Toaster("error", response.error);
                            }
                        }
                    });
                });


                $('#addExcelLocation').click(function() {
                    //  var url = "{{ route('recruit.job-type.create') }}";
                    $('.modal-title').html("<i class='icon-plus'></i> @lang('excel.location')");
                    $.ajaxModal('#location_add');
                });

                $('#addExcelDesign').click(function() {
                    //  var url = "{{ route('excel.settings.index', ['tab=designation']) }}";
                    $('.modal-title').html("<i class='icon-plus'></i> @lang('user-manager.add_designation')");
                    $.ajaxModal('#designation_add');
                });

            });


            $('#excelSetting').click(function() {
                window.location.href = "{{ route('excel.employee.index', ['tab=excel']) }}";
            });
            $('#designTab').click(function() {
                window.location.href = "{{ route('excel.employee.index', ['tab=designation']) }}";
            });
            $('#locationTab').click(function() {
                window.location.href = "{{ route('excel.employee.index', ['tab=location']) }}";
            });

            $('#employeeTab').click(function() {
                window.location.href = "{{ route('excel.employee.index', ['tab=employee']) }}";
            });
        </script>

        <!-- DROPDOWN-->
        <script>
            $(document).ready(function() {
                $('#add_emp').click(function() {
                    // alert('drop');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    $.ajax({

                        // url: "{{ route('excel.excelEmployee-create') }}", 
                        url: "{{ url('excel/Employeecreate') }}",

                        type: "POST",
                        success: function(result) {
                            console.log(result[0].excelDesignationList);
                            $.each(result[0].excelDesignationList, function(key, value) {
                                let option_html = "<option value='" + value.id + "'>" +
                                    value.designation + "</option>"
                                $("#designList").append(option_html);
                            });

                            $.each(result[0].excelLocationList, function(key, value) {
                                let option_html = "<option value='" + value.id + "'>" +
                                    value.location + "</option>"
                                $("#locationList").append(option_html);
                            });
                        }
                    });
                });
            });
        </script>
        <!--END DROPDOWN-->
    @endpush

</x-app-layout>
