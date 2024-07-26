<x-app-layout>
    @push('scripts')
        <link rel="stylesheet" href="{{ asset('asset/css/bootstrap-material-datetimepicker.css') }}">

        <link rel="stylesheet" href="https://lab2.invoidea.in/recruit/public/assets/plugins/iCheck/all.css">
        <link rel="stylesheet" href="{{ asset('asset/iCheck/all.css') }}">

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

            .hide-box {
                display: none;
            }
        </style>
    @endpush
    @section('title', 'Job Onboard')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0"> @lang('app.job') @lang('app.onBoard')</h6>
                    </div>
                </div>
                <div class="card-body"> 
                    <form action="{{ route('recruit.job-onboard.update', $onboard->id) }}" class="ajax-form needs-validation"
                        method="POST" id="" novalidate enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
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
                                        <p>{{ ucwords($application->job->location->location) }}</p>
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
                                                <option {{($onboard->department_id == $department->department_id)?'selected' :''}} value="{{ $department->department_id }}">
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
                                                <option {{($onboard->designation_id == $designation->designation_id)?'selected' :''}} value="{{ $designation->designation_id }}">
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
                                                <option {{($onboard->currency_id == $item->currencies_id) ? 'selected' : ''}} value="{{ $item->currencies_id }}">
                                                    {{ $item->currencies_code . ' (' . $item->symbol_left . ')' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('app.salaryOfferedPerMonth')</label>
                                        <input type="number" class="form-control" min="0" name="salary"
                                            value="{{ $onboard->salary_offered }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('app.joinDate')</label>
                                        <input type="text" class="form-control datepicker1" name="join_date"
                                            id=""
                                            value="{{ \Carbon\Carbon::parse($onboard->joining_date)->format('d/m/Y') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('app.employeeWorkStatus')</label>
                                        <select class="m-b-10 form-control" data-placeholder="@lang('app.employeeWorkStatus')"
                                            data-placeholder="@lang('app.employeeWorkStatus')" name="employee_status">
                                            <option @if ($onboard->employee_status == 'part_time') selected @endif value="part_time">
                                                @lang('app.partTime')</option>
                                            <option @if ($onboard->employee_status == 'full_time') selected @endif value="full_time">
                                                @lang('app.fullTime')</option>
                                            <option @if ($onboard->employee_status == 'on_contract') selected @endif
                                                value="on_contract">@lang('app.onContract')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('app.reportTo')</label>
                                        <select class="select2 m-b-10 form-control select2"
                                            data-placeholder="@lang('app.reportTo')"
                                            data-placeholder="@lang('app.reportTo')" name="report_to">
                                             @foreach ($users as $emp)
                                                <option value="{{ $emp->id }}" {{($onboard->reports_to_id == $emp->id) ? 'selected' : ''}}>{{ ucwords($emp->first_name) }}
                                                    
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('app.lastDate')</label>
                                        <input type="text" class="form-control datepicker1" name="last_date"
                                            id=""
                                            value=" {{ \Carbon\Carbon::parse($onboard->accept_last_date)->format('d/m/Y') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="d-block">@lang('app.status')</label>
                                        <select class="m-b-10 form-control" onchange="checkStatus(this.value)"
                                            data-placeholder="@lang('app.status')"
                                            data-placeholder="@lang('app.status')" name="status">
                                            <option @if ($onboard->hired_status == 'accepted') selected @endif value="accepted">
                                                @lang('app.accepted')</option>
                                            <option @if ($onboard->hired_status == 'offered') selected @endif value="offered">
                                                @lang('app.offered')</option>
                                            <option @if ($onboard->hired_status == 'rejected') selected @endif value="rejected">
                                                @lang('app.rejected')</option>
                                            <option @if ($onboard->hired_status == 'canceled') selected @endif value="canceled">
                                                @lang('app.canceled')</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="reasonBox"
                                    class="col-md-12 @if ($onboard->hired_status == 'offered' || $onboard->hired_status == 'accepted') hide-box @endif">
                                    <div class="form-group">
                                        <label class="d-block">@lang('app.reason') {{ $onboard->hired_status }}</label>
                                        <textarea class="form-control" rows="5" name="reason"> </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h4 class="theme-color mt-20">@lang('app.files')</h4>

                                    <div class="row">
                                        @forelse($onboard->files as $file)
                                            <input type="hidden" name="oldImages[{{ $file->id }}]">
                                            <div class="col-md-2 m-b-10" id="fileBox{{ $file->id }}">
                                                <a target="_blank"
                                                    href="{{$file_url}}{{ $file->hash_name }}">
                                                    <div class="card">
                                                        <div class="file-bg">
                                                            <div class="overlay-file-box">
                                                                <div class="user-content">
                                                                    
                                                                        <img class="card-img-top img-responsive"
                                                                            src="{{$file_url}}{{ $file->hash_name }}">
                                                                     
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-block">
                                                            <h6 class="card-title">{{ $file->name }}</h6>
                                                            <a href="javascript:;" data-toggle="tooltip"
                                                                data-original-title="Delete"
                                                                data-file-id="{{ $file->id }}"
                                                                class="btn btn-danger btn-circle sa-params"
                                                                data-pk="thumbnail"><i class="fa fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @empty
                                        @endforelse
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
                                            <button type="button" id="plusButton" class="btn btn-sm btn-info"
                                                style="margin-bottom: 20px">
                                                @lang('app.addMore') @lang('app.files') <i class="fa fa-plus"></i>
                                            </button>
                                        </div>

                                        <div class="col-md-12">
                                            @if (count($questions) > 0)
                                                <h4 class="m-b-0 m-l-10 box-title">@lang('modules.front.questions')</h4>
                                            @endif
                                            @forelse($questions as $question)
                                                <div class="form-group col-md-6">
                                                    <label class="">
                                                        <div class="icheckbox_flat-green" aria-checked="false"
                                                            aria-disabled="false" style="position: relative;">
                                                            <input @if (in_array($question->id, $onboardQuestion)) checked @endif
                                                                type="checkbox" value="{{ $question->id }}"
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
                                </div>
                                <br>
                                <div class="mt-3">

                                </div>
                            </div>
                              <div class="col-sm-12 p-0">
                                    <button type="submit" id="" class="btn btn-primary save-onboard">
                                        Update</button>
                                    <a href="{{ route('recruit.job-onboard.index') }}"
                                        class="btn btn-secondary mx-1">Cancel</a>

                                </div>
                                <!--end col-->
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
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
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
    {{-- Ajax Modal Ends --}}


    @push('scripts')
        <script src="{{ asset('asset/js/moment.js') }}" type="text/javascript"></script>
        <script src="{{ asset('asset/js/icheck.min.js') }}"></script>
        <script src="{{ asset('asset/js/bootstrap-material-datetimepicker.js') }}" type="text/javascript"></script>
        <script>
            $(function() {
                $('.datepicker1').datepicker({
                    dateFormat: 'dd/mm/yy',
                    onSelect: function() {
                        var selected = $(this).datepicker("getDate");
                    }
                });

            });


            $('input[type="checkbox"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
            })
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
            var joinDate = "{{ $application->created_at }}";
            var value = $('#join_date').val();
            $('#last_date').bootstrapMaterialDatePicker({
                minDate: new Date(value),
                // format: 'yyyy-m-d',
                time: false,
                clearButton: true,
            })
            // Datepicker set
            $('#join_date').bootstrapMaterialDatePicker({
                minDate: new Date(joinDate),
                // format: 'yyyy-m-d',
                time: false,
                clearButton: true,
            }).on('change', function(selected) {
                var value = $('#join_date').val();
                $("#last_date").val('');
                $('#last_date').bootstrapMaterialDatePicker('setMinDate', value);

            });

            function checkStatus(val) {
                if (val == 'accepted' || val == 'offered') {
                    $('#reasonBox').hide();
                } else {
                    $('#reasonBox').show();
                }
            }
            

            $('#addDepartment').click(function() {
                var url = "{{ route('recruit.departments.create') }}";
                $('#modelHeading').html('Department');
                $.ajaxModal('#addDepartmentModal', url);
            });

            $('#addDesignation').click(function() {
                var url = "{{ route('recruit.designations.create') }}";
                $('#modelHeading').html('Designation');
                $.ajaxModal('#addDepartmentModal', url);
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

            $('body').on('click', '.sa-params', function() {
                var id = $(this).data('file-id');
                var deleteView = $(this).data('pk');
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover the deleted file!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel please!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function(isConfirm) {
                    if (isConfirm) {

                        var url = "{{ route('recruit.job-onboard.destroy', ':id') }}";
                        url = url.replace(':id', id);

                        var token = "{{ csrf_token() }}";

                        $.easyAjax({
                            type: 'POST',
                            url: url,
                            data: {
                                '_token': token,
                                '_method': 'DELETE',
                                'view': deleteView
                            },
                            success: function(response) {
                                console.log(response);
                                if (response.status == "success") {
                                    $.unblockUI();
                                    $('#fileBox' + id).fadeOut();
                                }
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
