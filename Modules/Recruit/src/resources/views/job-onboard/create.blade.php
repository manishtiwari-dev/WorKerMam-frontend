<x-app-layout>
    @push('scripts')
        <link rel="stylesheet" href="{{ asset('asset/css/bootstrap-material-datetimepicker.css') }}">


        <link rel="stylesheet" href="{{ asset('asset/css/switchery.min.css') }}">

        <link rel="stylesheet" href="{{ asset('asset/css/iCheck/all.css') }}">

        <style>
            .p-10 {
                padding: 10px;
            }

            .select-file {
                height: 40px;
                padding: 6px !important;
            }

            .form-control {
                height: 40px !important;
            }

            .ml-10 {
                margin-left: 10px;
            }
        </style>
    @endpush

    @section('title', 'Job Onboard')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">@lang('app.job') @lang('app.onBoard')</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('recruit.job-onboard.store') }}" class="ajax-form needs-validation"
                        method="POST" id="userForm" novalidate enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6  col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('modules.interviewSchedule.candidate') @lang('app.name')</label>
                                        <p>{{ $application->full_name }}</p>
                                        <input type="hidden" name="candidate_id" value="{{ $application->id }}">
                                    </div>
                                </div>
                                <div class="col-md-6  col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('modules.interviewSchedule.candidate') @lang('app.phone') </label>
                                        <p>{{ $application->phone }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('modules.interviewSchedule.candidate') @lang('app.email')</label>
                                        <p>{{ $application->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6  col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('app.job') @lang('app.location') </label>
                                        <p>{{ ucwords($application->job->location->location ?? '') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('app.department')
                                        </label>
                                        <select class="select2 m-b-10 form-control select2 "
                                            data-placeholder="@lang('app.choose') @lang('app.department')"
                                            data-placeholder="@lang('app.department')" name="department" id="department">
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->department_id }}">
                                                    {{ ucwords($department->dept_name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('app.designation')
                                        </label>
                                        <select class="select2 m-b-10 form-control select2 "
                                            data-placeholder="@lang('app.choose') @lang('app.designation')"
                                            data-placeholder="@lang('app.designation')" name="designation" id="designation">
                                            @foreach ($designations as $designation)
                                                <option value="{{ $designation->designation_id }}">
                                                    {{ ucwords($designation->designation_name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">

                                    <div class="form-group">
                                        <label for="address">@lang('app.currency')</label>
                                        <select name="currency_id" id="currency_id" class="form-control select2">
                                            @foreach ($currencies as $item)
                                                <option value="{{ $item->currencies_id }}">
                                                    {{ $item->currencies_code . ' (' . $item->symbol_left . ')' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block required">@lang('app.salaryOfferedPerMonth')<span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('salary') is-invalid @enderror"
                                            min="0" name="salary" value="" required>
                                        <div class="invalid-feedback">
                                            <p>The salary field is required.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block required">@lang('app.joinDate')<span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control datepicker @error('join_date') is-invalid @enderror"
                                            name="join_date" id="" value="" required>

                                        <div class="invalid-feedback">
                                            <p>The join date field is required.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('app.employeeWorkStatus')</label>
                                        <select class="m-b-10 form-control" data-placeholder="@lang('app.employeeWorkStatus')"
                                            data-placeholder="@lang('app.employeeWorkStatus')" name="employee_status">
                                            <option value="part_time">@lang('app.partTime')</option>
                                            <option value="full_time">@lang('app.fullTime')</option>
                                            <option value="on_contract">@lang('app.onContract')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('app.reportTo')</label>
                                        <select class="select2 m-b-10 form-control select2"
                                            data-placeholder="@lang('app.reportTo')" data-placeholder="@lang('app.reportTo')"
                                            name="report_to">
                                            @foreach ($users as $emp)
                                                <option value="{{ $emp->id }}">{{ ucwords($emp->first_name) }}

                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block required">@lang('app.lastDate')<span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control datepicker @error('last_date') is-invalid @enderror"
                                            name="last_date" id="last_date" value="" required>
                                        <div class="invalid-feedback">
                                            <p>The join date field is required.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">@lang('app.sendOfferEmail') </label>
                                        <div class="col-sm-4">
                                            <div class="switchery-demo">
                                                <input id="nexmo_status" name="send_email" type="checkbox"
                                                    value="yes" class="js-switch change-language-setting"
                                                    data-color="#99d683" data-size="small" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row p-10">
                                    <label class="d-block ml-10">@lang('app.offer') @lang('app.files') </label>
                                    <div id="addMoreBox1" class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div id="dateBox" class="form-group ">
                                                            <input type="text" name="name[]"
                                                                class="form-control file-input"
                                                                placeholder="@lang('app.file') @lang('app.name')">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <input class="form-control select-file file-input"
                                                                accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xls,.xlsx,.rtf"
                                                                type="file" name="file[]"><br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1" style="margin-top: 66px">

                                            </div>
                                        </div>
                                    </div>
                                    <div id="insertBefore"></div>
                                    <div class="clearfix">

                                    </div>

                                    <div class="col-md-12">
                                        <button type="button" id="plusButton" class="btn btn-sm btn-primary"
                                            style="margin-bottom: 20px">
                                            @lang('app.addMore') <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    @if (count($questions) > 0)
                                        <h4 class="col-md-12 m-b-0 m-l-10 box-title">Questions</h4><br />
                                    @endif
                                    @forelse($questions as $question)
                                        <div class="form-group">
                                            <label class="">
                                                <div class="col-md-12 ml-2 icheckbox_flat-green" aria-checked="false"
                                                    aria-disabled="false" style="position: relative;">
                                                    <input type="checkbox" value="{{ $question->id }}"
                                                        name="question[]" class="flat-red"
                                                        style="position: absolute; opacity: 0;">
                                                    <ins class="iCheck-helper"
                                                        style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                </div>
                                                {{ ucfirst($question->question) }} @if ($question->required == 'yes')
                                                    (@lang('app.required'))
                                                @endif
                                            </label>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                            <br>

                            <div class="mt-3">
                                <div class="col-sm-12 p-0">
                                    <button type="submit" id="" class="btn btn-primary save-onboard">
                                        Submit</button>
                                    <a href="{{ route('recruit.job-onboard.index') }}"
                                        class="btn btn-secondary mx-1">Cancel</a>

                                </div>
                                <!--end col-->

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Ajax Modal Start for --}}
    <div class="modal fade bs-modal-md in" id="addDepartmentModal" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="icon-plus"></i> @lang('app.department')</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true"><i
                            class="fa fa-times"></i></button>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- Ajax Modal Ends --}}


    @push('scripts')
        <script src="{{ asset('asset/js/moment.js') }}" type="text/javascript"></script>
        <script src="{{ asset('asset/js/icheck.min.js') }}"></script>
        <script src="{{ asset('asset/js/bootstrap-material-datetimepicker.js') }}" type="text/javascript"></script>

        <script src="{{ asset('asset/js/switchery/switchery.min.js') }}"></script>


        <script>
            $('input[type="checkbox"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
            })

            $(function() {
                $('.datepicker').datepicker({
                    dateFormat: 'dd/mm/yy',
                    onSelect: function() {
                        var selected = $(this).datepicker("getDate");
                    }
                });

            });


            // Select 2 init.
            $(".select2").select2({
                formatNoMatches: function() {
                    return "{{ __('messages.noRecordFound') }}";
                }
            });
            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());

            });
            // Datepicker set
            var joinDate = "{{ $application->created_at }}";
            // Datepicker set
            $('#join_date').bootstrapMaterialDatePicker

            ({
                minDate: new Date(joinDate),
                // format: 'yyyy-m-d',
                time: false,
                clearButton: true,
            }).on('change', function(selected) {
                var value = $('#join_date').val();
                $("#last_date").val('');
                // $('#last_date').bootstrapMaterialDatePicker('destroy');
                $('#last_date').bootstrapMaterialDatePicker({
                    minDate: new Date(value),
                    // format: 'yyyy-m-d',
                    time: false,
                    clearButton: true,
                });

            });
            // Save Interview Schedule
            $('.save-onboard').click(function() {
                $.easyAjax({
                    url: '{{ route('recruit.job-onboard.store') }}',
                    container: '#createSchedule',
                    type: "POST",
                    file: true,
                    success: function(response) {
                        if (response.status == 'success') {
                            // window.location.reload();
                        }
                    }
                })
            })

            $('#addDepartment').click(function() {
                var url = "{{ route('recruit.departments.create') }}";
                $('.modal-title').html("<i class='icon-plus'></i> @lang('app.department')");
                $.ajaxModal('#addDepartmentModal', url);
                $('#addDepartmentModal').modal('show');
            });
 

            var $insertBefore = $('#insertBefore');
            var $i = 0;

            // Add More Inputs
            $('#plusButton').click(function() {

                $i = $i + 1;
                var indexs = $i + 1;
                $(' <div id="addMoreBox' + indexs + '" class="col-md-12"> ' +
                    '<div class="row">' +
                    '<div class="col-md-11">' +
                    '<div class="row">' +
                    '<div class="col-md-5">' +
                    '<div id="dateBox" class="form-group ">' +
                    '<input type="text" name="name[' + $i +
                    ']" class="form-control file-input" placeholder="@lang('app.file') @lang('app.name')">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-5">' +
                    '<div class="form-group">' +
                    '<input class="form-control select-file file-input" accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xls,.xlsx,.rtf" type="file" name="file[]"><br>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-1">' +
                    '<button type="button"  onclick="removeBox(' + indexs +
                    ')"  class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>' +
                    '</div>' +
                    '</div>').insertBefore($insertBefore);

            });

            // Remove fields
            function removeBox(index) {
                $('#addMoreBox' + index).remove();
            }
        </script>
    @endpush
</x-app-layout>
