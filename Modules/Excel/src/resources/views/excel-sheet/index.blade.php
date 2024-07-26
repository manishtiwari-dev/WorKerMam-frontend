<x-app-layout>

    @section('title', $pageTitle)
    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')

        <div class="contact-content">
            <div class="contact-content-header mg-b-20 mg-lg-b-25 mg-xl-b-30">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" id="excelSetting"><a href="#excel-setting"
                            class="nav-link  {{ request()->tab == 'excel' || !isset(request()->tab) ? 'active' : '' }}"
                            data-toggle="tab">{{ __('excel.excelSheet') }}</a></li>

                    <li class="nav-item" id="sheetTab"><a href="#sheetElement"
                            class="nav-link {{ request()->tab == 'sheetElement' ? 'active' : '' }}"
                            data-toggle="tab">{{ __('excel.sheetElement') }}</a></li>

                </ul>

            </div>
            <div class="card contact-content-body">
                <div class="tab-content">

                    <div id="excel-setting"
                        class="tab-pane {{ request()->tab == 'excel' || !isset(request()->tab) ? 'active' : '' }} ">

                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="tx-15 mg-b-0">Sheet</h6>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                    <a href="#excelSheet" data-toggle="modal"
                                        class="btn btn-sm btn-bg d-flex align-items-center"><i
                                            data-feather="plus"></i><span
                                            class="d-none d-sm-inline mg-l-5">{{ __('excel.excelsheetadd') }}</span></a>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table border table_wrapper">
                                    <thead>
                                        <tr>
                                            <th>{{ __('excel.parentSheet') }}</th>
                                            <th>{{ __('excel.subSheet') }}</th>
                                            <th>{{ __('common.status') }}</th>
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                <th>{{ __('common.action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($content->parentlist as $key => $excel)
                                            <tr>
                                                <td>{{ ucwords($excel->sheet_name) }}</td>
                                                <td></td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox"
                                                            class="custom-control-input result_toggle_class"
                                                            {{ $excel->status == '1' ? 'checked' : '' }}
                                                            data-id="{{ $excel->id }}"
                                                            id="customSwitch2{{ $excel->id }}">
                                                        <label class="custom-control-label"
                                                            for="customSwitch2{{ $excel->id }}"></label>
                                                    </div>
                                                </td>
                                                <td class="d-flex align-items-center">
                                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                        <a href="#modalEditExcel" data-id="{{ $excel->id }}"
                                                            data-toggle="modal"
                                                            class="btn btn-sm btn-white d-flex align-items-center mg-r-5 excel_edit_btn"><i
                                                                data-feather="edit-2"></i><span
                                                                class="d-none d-sm-inline mg-l-5"></span></a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @foreach ($excel->child as $key => $child)
                                                <tr>
                                                    <td></td>
                                                    <td>{{ ucwords($child->sheet_name) }}</td>
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
                                                    <td class="d-flex align-items-center">
                                                        <a href="#modalEditExcel" data-id="{{ $child->id }}"
                                                            data-toggle="modal"
                                                            class="btn btn-sm btn-white d-flex align-items-center mg-r-5 excel_edit_btn"><i
                                                                data-feather="edit-2"></i><span
                                                                class="d-none d-sm-inline mg-l-5"></span></a>
                                                    </td>
                                                </tr>
                                            @endforeach
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

                    <div id="sheetElement" class="tab-pane {{ request()->tab == 'sheetElement' ? 'active' : '' }}">

                        <div class="card-header">

                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="tx-15 mg-b-0"> Sheet Element </h6>

                                <div class="d-flex gap-1">
                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                        <a href="#Employee" data-toggle="modal" id="add_emp"
                                            class="btn btn-sm btn-bg "><i data-feather="plus"></i>Add Sheet Element</a>
                                    @endif

                                </div>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class="form-row">
                                <div class="form-group  col-md-4">
                                    <select class="form-control" id="parentList" name="parent">
                                        <option value="" selected disabled>{{ __('excel.selectParent') }}
                                        </option>
                                        @if (!empty($content->parentlist))
                                            @foreach ($content->parentlist as $parent)
                                                <option value="{{ $parent->id }}">{{ $parent->sheet_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <select class="form-control" id="sub_sheet" name="sub_sheet">
                                        <option value="" selected disabled>Select
                                        </option>

                                    </select>
                                    </select>
                                </div>

                            </div>

                            <div class="table-responsive">
                                <table class="table border table_wrapper" id="attendence_listing">
                                    <thead>
                                        @php
                                            $alphabet = range('A', 'Z');
                                        @endphp

                                        <tr>
                                            <th>Row</th>
                                            @foreach ($alphabet as $value)
                                                <th>{{ $value }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                            $i = 0;
                                        @endphp
                                        @for ($i = 1; $i <= 100; $i++)
                                            <tr>

                                                <td>{{ $i }}</td>

                                                <td></td>

                                            </tr>
                                        @endfor

                                        <tr>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    @endif

    <!--start add modal-->
    <div class="modal fade" id="excelSheet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('excel.excelsheetadd') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="parentAdd" class="needs-validation mg-b-0" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('excel.parentTitle') }} </label>
                                <select class="form-control" id="parent" name="parent">
                                    <option value="" selected disabled>{{ __('excel.selectParent') }}</option>
                                    @if (!empty($content->parentlist))
                                        @foreach ($content->parentlist as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->sheet_name }}</option>
                                        @endforeach
                                    @endif
                                </select>

                            </div>
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('excel.sheetName') }}<span
                                        class="text-danger">*</span></label>
                                <input name="sheetName" id="sheetName" type="text" class="form-control"
                                    placeholder="{{ __('excel.sheetNamePlace') }}" required>
                                <div class="invalid-feedback">
                                    {{ __('excel.sheetNameError') }}
                                </div>
                            </div>
                        </div>
                        <input type="submit" id="AddSheetData" name="send" class="btn btn-primary"
                            value="{{ __('common.submit') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end add modal-->

    {{-- start Employee modal  --}}
    <!--start add modal-->
    <div class="modal fade" id="Employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add Sheet Element</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="empAdd" class="needs-validation mg-b-0" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label">Element <span class="text-danger">*</span></label>
                                <input name="element_value" id="element_value" type="text" class="form-control"
                                    placeholder="Element" required>
                                <div class="invalid-feedback">
                                    Enter a Element
                                </div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label class="form-label">Parent Sheet</label>
                                <select class="form-control" id="parentName" name="parent">
                                    <option value="" selected disabled>{{ __('excel.selectParent') }}</option>
                                    @if (!empty($content->parentlist))
                                        @foreach ($content->parentlist as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->sheet_name }}</option>
                                        @endforeach
                                    @endif
                                </select>

                            </div>

                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('excel.SubSheet') }} </label>
                                <select class="form-control" id="subSheetName" name="parent" required>
                                    <option value="" selected disabled>{{ __('excel.selectParent') }}</option>

                                </select>

                                <div class="invalid-feedback">
                                    Please Select Sub Sheet
                                </div>

                            </div>

                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('excel.Row') }} </label>
                                <input name="row_position" id="row_position" type="text" class="form-control"
                                    placeholder="Element" required>
                                <div class="invalid-feedback">
                                    Enter a Row
                                </div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('excel.Column') }} </label>
                                <input name="column_position" id="column_position" type="text"
                                    class="form-control" placeholder="Element" required>
                                <div class="invalid-feedback">
                                    Enter a Column
                                </div>

                            </div>

                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('excel.type') }} </label>
                                <select class="form-control" id="value_type" name="value_type">
                                    <option value="" selected disabled>{{ __('excel.selectType') }}</option>

                                    <option value="1">Static</option>
                                    <option value="2">Dynamic</option>

                                </select>

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

    <!-------------- Edit expense Account Modal --------------->
    <div class="modal fade" id="modalEditExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Update Sheet</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation novalidate" id="edit_excel" novalidate>
                        <input type="hidden" name="input_field_id" id="edit_excel_field">
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('excel.parentTitle') }} </label>
                                <select class="form-control" id="parents" name="parent">
                                    <option value="" selected disabled>{{ __('excel.selectParent') }}</option>
                                    @if (!empty($content->parentlist))
                                        @foreach ($content->parentlist as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->sheet_name }}</option>
                                        @endforeach
                                    @endif
                                </select>

                            </div>
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('excel.sheetName') }}<span
                                        class="text-danger">*</span></label>
                                <input name="sheetName" id="sheetNames" type="text" class="form-control"
                                    placeholder="{{ __('excel.sheetNamePlace') }}" required>
                                <div class="invalid-feedback">
                                    {{ __('excel.sheetNameError') }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 mt-4" required>
                                <input type="submit" id="update_expense_Account" class="btn btn-primary"
                                    value="Update">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--------------Edit expense Account Modal end here --------------->

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
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('excel.employee') }}<span
                                        class="text-danger">*</span></label>
                                <input name="employee_name" id="update_employee_name" type="text"
                                    class="form-control" placeholder="{{ __('excel.employee') }}" required>
                                <div class="invalid-feedback">
                                    Enter Employee Name
                                </div>
                            </div>

                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('excel.excelDesign') }} </label>

                                <select class="form-control" id="update_designList" name="designation">
                                    <option value="" selected disabled>{{ __('excel.selectDesignation') }}
                                    </option>
                                </select>

                            </div>

                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('excel.location') }} </label>

                                <select class="form-control" id="update_locationList" name="parent">
                                    <option value="" selected disabled>{{ __('excel.selectLocation') }}
                                    </option>

                                </select>

                            </div>

                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('excel.type') }} </label>
                                <select class="form-control" id="update_emp_type" name="parent">
                                    <option value="" selected disabled>{{ __('excel.selectType') }}</option>

                                    <option value="1">Permanent</option>
                                    <option value="2">Contract</option>

                                </select>

                            </div>

                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('excel.salary') }}<span
                                        class="text-danger">*</span></label>
                                <input name="sheetName" id="update_emp_salary" type="number" class="form-control"
                                    placeholder="{{ __('excel.salary') }}" required>
                                <div class="invalid-feedback">
                                    Enter Salary
                                </div>
                            </div>

                            <div class="form-group col-lg-12">
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
            $(document).ready(function() {
                // add expense ajax open
                $(document).on('click', "#AddSheetData", function(e) {
                    e.preventDefault();
                    $('#parentAdd').addClass('was-validated');
                    if ($('#parentAdd')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            parent: $("#parent").val(),
                            sheetName: $("#sheetName").val(),
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ route('excel.settings.store') }}",
                            data: data,
                            dataType: "json",

                            success: function(response) {
                                // console.log();
                                if (response.status == 1) {
                                    Toaster('success', response.success);
                                    $('#add_modal').trigger("reset");
                                    setTimeout(function() {
                                        location.reload(true);
                                    }, 3000);

                                    window.location.href =
                                        "{{ route('excel.settings.index') }}";
                                } else {
                                    Toaster('error', response.success);
                                }
                            },
                            error: function(response) {
                                var errors = data.responseJSON;
                                // console.log(errors);
                            }
                        });
                    }
                });

                $('.excel_edit_btn').on('click', function(e) {
                    e.preventDefault();

                    var excel_id = $(this).data('id');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "GET",

                        url: "{{ url('excel/excel-edit') }}/" + excel_id,
                        data: {
                            excel_id: excel_id
                        },
                        dataType: "json",
                        success: function(response) {
                            // console.log(response);
                            var sec = response[0].excelsheet;

                            $("#edit_excel_field").val(sec.id);
                            $("#sheetNames").val(sec.sheet_name);
                            if (sec.parent_id != '0') {
                                $("#update_title").val(sec.title_name);
                                $("#parents").html('');
                                let html = `<option>Select Parents</option>`;
                                $.each(response[0].excel, function(key, value) {

                                    html += `<option value=${value.id}>
                                        ${value.sheet_name }</option>`;

                                });
                                $("#parents").append(html);
                                $("#parents").val(sec.parent_id);
                            }


                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            // console.log(errors);
                        }
                    });
                });

                $(document).on("submit", "#edit_excel", function(e) {
                    e.preventDefault();
                    var data = {
                        id: $("#edit_excel_field").val(),
                        parent: $("#parents").val(),
                        sheetName: $("#sheetNames").val(),
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('excel/excel-update') }}",
                        data: data,
                        success: function(response) {
                            $('#modalEditexpense').removeClass('show');
                            $('#modalEditexpense').css('display', 'none');
                            Toaster('success', response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);

                            window.location.href =
                                "{{ route('excel.settings.index') }}";


                        }
                    });

                });

                //result parent title status change jquery
                $('.result_toggle_class').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 0;
                    let sheet_id = $(this).data('id');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('excel.changeStatus') }}",
                        data: {
                            'status': status,
                            'sheet_id': sheet_id
                        },
                        success: function(response) {
                            // console.log(response);
                            Toaster('success', response.success);

                        }
                    });
                });
            });



            //  //employee ajax
            //  $(document).ready(function() {

            //      $('.emp_edit_btn').on('click', function(e) {
            //          e.preventDefault();
            //          var id = $(this).data('id');


            //          $.ajaxSetup({
            //              headers: {
            //                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //              }
            //          });
            //          $.ajax({
            //              type: "GET",
            //              url: "{{ url('excel/excel-employeeedit') }}/" + id,

            //              //    url: "{{ url('seo/results-edit') }}/" + result_id,
            //              data: {
            //                  id: id
            //              },
            //              dataType: "json",
            //              success: function(response) {
            //                  console.log(response);
            //                  var sec = response[0].excelEmployeeList;

            //                  $("#edit_excel_field").val(sec.id);

            //                  $("#update_employee_name").val(sec.employee_name),
            //                      // $("#updatedesignList").val() ?? 0,
            //                      //  $("#updatelocationList").val() ?? 0,
            //                      $("#update_emp_type").val(sec.type) ?? 0,
            //                      $("#update_emp_salary").val(sec.salary) ?? 0,
            //                      $("#update_emp_food").val(sec.food),




            //                      // $("#updatedesignList").val(sec.title_name);
            //                      $('#update_designList option[value="' + sec.designation + '"]')
            //                      .prop('selected',
            //                          true);
            //                  $("#update_designList").html('');
            //                  $("#update_locationList").html('');



            //                  $.each(response[0].excelDesignationList, function(key, value) {
            //                      let option_html = "<option value='" + value.id + "'>" +
            //                          value.designation + "</option>"
            //                      $("#update_designList").append(option_html);
            //                      $("#updatedesignList").val(sec.designation);

            //                  });

            //                  $.each(response[0].excelLocationList, function(key, value) {
            //                      let option_html = "<option value='" + value.id + "'>" +
            //                          value.location + "</option>"
            //                      $("#update_locationList").append(option_html);
            //                      $("#update_locationList").val(sec.location);

            //                  });


            //              },
            //              error: function(data) {
            //                  var errors = data.responseJSON;
            //                  console.log(errors);
            //              }
            //          });
            //      });




            //      $(document).on("submit", "#modalEditEmployee", function(e) {
            //         e.preventDefault();

            //         var data = {
            //             id: $("#edit_excel_field").val(),

            //             employee_name: $("#update_employee_name").val(),
            //         designation: $("#update_designList").val() ?? 0,
            //         location: $("#update_locationList").val() ?? 0,
            //         type: $("#update_emp_type").val() ?? 0,
            //         salary: $("#update_emp_salary").val() ?? 0,
            //         food: $("#update_emp_food").val(),

            //         }

            //         console.log(data);
            //         $.ajaxSetup({
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             }
            //         });
            //         $.ajax({
            //             type: "POST",
            //             url: "{{ url('excel/employeeupdate') }}",

            //             data: data,
            //             success: function(response) {
            //                 $('#modalEditEmployee').removeClass('show');
            //                 $('#modalEditEmployee').css('display', 'none');
            //                 console.log(response);
            //                 if (response.success) {
            //                          Toaster("success", response.success);

            //                  } else {
            //                      Toaster("error",response.error);
            //                  }                            setTimeout(function() {
            //                     location.reload(true);
            //                 }, 3000);

            //                 window.location.href = "{{ route('excel.settings.index', ['tab=employee']) }}";


            //             }
            //         });

            //     });




            $(document).ready(function() {

                //start add dropdown


                $('#parentName').change(function() {
                    //  let id = $(this).data('id');
                    let id = $("#parentName").val();
                    // console.log(id);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('excel.excel-create') }}",
                        data: {
                            'parent': id
                        },
                        success: function(result) {
                            // console.log(result[0].excelelmentsheet);

                            $.each(result[0].excelelmentsheet, function(key, value) {
                                let option_html = "<option value='" + value.id + "'>" +
                                    value.sheet_name + "</option>"
                                $("#subSheetName").append(option_html);
                            });
                        }
                    });
                });


                //end add dropdown



                //store elment start ajax
                $(document).on("submit", "#empAdd", function(e) {
                    e.preventDefault();

                    var formData = {
                        element_value: $("#element_value").val(),
                        sheet_id: $("#subSheetName").val() ?? 0,
                        row_position: $("#row_position").val() ?? 0,
                        column_position: $("#column_position").val() ?? 0,
                        value_type: $("#value_type").val(),
                    };

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('excel.elementStore') }}",

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
                                "{{ route('excel.settings.index', ['tab=sheetElement']) }}";

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
                $('#parentList').change(function() {
                    //  let id = $(this).data('id');
                    let id = $("#parentList").val();
                    // console.log(id);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $("#sub_sheet").empty();
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('excel.excel-create') }}",
                        data: {
                            'parent': id
                        },
                        success: function(result) {
                            // console.log(result);

                            $.each(result[0].excelelmentsheet, function(key, value) {
                                let option_html = "<option value='" + value.id + "'>" +
                                    value.sheet_name + "</option>"
                                $("#sub_sheet").append(option_html);
                            });
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





            $(document).ready(function() {

                $('#sub_sheet').on('change', function(e, data) {
                    ajaxSubsmisstionData();
                });
            });


            function ajaxSubsmisstionData() {
                var sub_sheet = $('#sub_sheet').val();
                $("#sheetElement").html('');
                tableWebContent(sub_sheet);
            }

            function tableWebContent(sub_sheet) {
                const url = "{{ route('excel.elementList') }}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        sheet_id: sub_sheet,
                    },
                    dataType: "json",
                    success: function(result) { 

                        console.log(result);
                        // console.log(result);

                        // var sheetElements=result[0].excelElementList;
                        // var sheetValues=   Object.values(sheetElements);

                        // var html = `<table class="table table-center bg-white  mb-0">
                        // <thead>
                        //     <th class="wd-15p" style="">Row</th>`;
                        // const alphabet = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O",
                        //     "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z" ];

                        // $.each(alphabet, function(date, value) {
                        //     html += ` <th>${ value }</th>`;
                        // });

                        // html += `</thead>`;
                        // for (let i = 1; i <= 100; i++) {
                        // html += `<tr> <td>${ i }</td> `;
                        //     $.each(result[0].allList, function(key, values) {
                        // html += `<td> </td>`;
                        //     });
                        // html += `</tr>`; 
                        // }
                        // html += `</table> </div>`;

                        $("#sheetElement").html(result.view);
                    }
                });

            }

            $('#excelSetting').click(function() {
                window.location.href = "{{ route('excel.settings.index', ['tab=excel']) }}";
            });
            $('#sheetTab').click(function() {
                window.location.href = "{{ route('excel.settings.index', ['tab=sheetElement']) }}";
            });
        </script>

        {{-- <!-- DROPDOWN-->
         <script>
             $(document).ready(function() {
                 $('#add_emp').on('change', function(e, data)(function() {
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
                            //  console.log(result.excelDesignationList);
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
         <!--END DROPDOWN--> --}}
    @endpush

</x-app-layout>
