<link rel="stylesheet" href="{{ asset('asset/css/bootstrap-material-datetimepicker.css') }}">
<link rel="stylesheet" href="{{ asset('asset/css/bootstrap-wysihtml5.css') }}">

<link rel="stylesheet" href="{{ asset('asset/css/multi-select.css') }}">
<link rel="stylesheet" href="{{ asset('asset/css/iCheck/all.css') }}">

<style>
    .online-radio-button {
        display: inline-flex;
    }
    .select2-dropdown {
         z-index: 1110;
     }
     .select-dropdown .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
         background: transparent;
         border: 0;
         opacity: 1;
         left: 0;
     }
     
.select2-container--default .select2-search--inline .select2-search__field{
    margin-top: 0px !important
}
</style>
   @section('title', 'Interview Schedule')
<div class="modal-header">
    <h4 class="modal-title"><i class="icon-plus"></i> @lang('modules.interviewSchedule.interviewSchedule')</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
</div>
<div class="modal-body">
    <form id="createSchedule"  class="needs-validation ajax-form" method="post"  novalidate> 
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-body">
            <div class="row">
                <div class="col-md-6  col-xs-12">
                    <div class="form-group">
                        <label class="d-block">@lang('modules.interviewSchedule.candidate')</label>
                        <select class=" m-b-10 form-control select2" data-placeholder="@lang('modules.interviewSchedule.chooseCandidate')" name="candidates" required>
                            <option value="">@lang('modules.interviewSchedule.chooseCandidate')</option>
                            @foreach ($candidates as $candidate)
                                <option value="{{ $candidate->id }}">{{ ucwords($candidate->full_name) }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            <p>This Field Is Required</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="form-group  select-dropdown">
                        <label class="d-block ">@lang('modules.interviewSchedule.employee')</label>
                        <select class="form-select form-control select2" data-placeholder="@lang('modules.interviewSchedule.chooseEmployee')" name="employees[]" multiple="multiple" required> 

                            @foreach ($users as $emp)
                                <option value="{{ $emp->id }}">
                                    {{ ucwords($emp->first_name) }}{{ ucwords($emp->last_name) }}

                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            <p>This Field Is Required</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 col-md-3 ">
                    <div class="form-group">
                        <label class="required">@lang('modules.interviewSchedule.scheduleDate')</label>
                        <input type="text" name="scheduleDate" id="scheduleDate" value="{{ $scheduleDate }}"
                            class="form-control" required>
                            <div class="invalid-feedback">
                                <p>This Field Is Required</p>
                            </div>
                    </div>
                   
                </div>

                <div class="col-xs-5 col-md-3">
                    <div class="form-group chooseCandidate bootstrap-timepicker timepicker">
                        <label class="">@lang('modules.interviewSchedule.scheduleTime')</label>
                        <input type="text" name="scheduleTime" id="scheduleTime" class="form-control" required>
                        <div class="invalid-feedback">
                            <p>This Field Is Required</p>
                        </div>
                    </div> 
                </div>
                {{-- @if($zoom_setting->enable_zoom == 1) --}}
                    <div class="col-xs-6 col-md-3 ">
                        <div class="form-group" id="end_date_section" style="display: none">
                            <label class="">@lang('modules.interviewSchedule.endDate')</label>
                            <input type="text" name="end_date" id="end_date" value="{{ $scheduleDate }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-5 col-md-3">
                        <div class="form-group chooseCandidate bootstrap-timepicker timepicker" id="end_time_section"
                            style="display: none">
                            <label class="">@lang('modules.interviewSchedule.endTime')</label>
                            <input type="text" name="end_time" id="end_time" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-5 col-md-3">
                        <label>@lang('modules.interviewSchedule.interviewType')</label>
                        <div class="form-group online-radio-button">
                            <div class="">
                                <input type="radio" name="interview_type" id="interview_typeOnline" value="online">
                                <label for="interview_typeOnline" class=""> @lang('modules.meetings.online') </label>
                            </div>
                            <div class="" style="margin-left: 21px;">
                                <input type="radio" name="interview_type" id="interview_type" value="offline" checked>
                                <label for="interview_type" class=""> @lang('modules.meetings.offline') </label>
                            </div>
                        </div>
                    </div>
                {{-- @endif --}}

            </div>
            <div class="row" id="repeat-fields" style="display: none">

                <div class="col-xs-6 col-md-12">
                    <div class="form-group">
                        <label class="d-block">@lang('modules.interviewSchedule.interviewTitle')</label>
                        <input type="text" name="meeting_title" id="meeting_title" class="form-control">
                    </div>
                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                        <div class="m-b-10">
                            <label class="control-label">@lang('modules.zoommeeting.hostVideoStatus')</label>
                        </div>
                        <div class="radio radio-inline">
                            <input type="radio" name="host_video" id="host_video1" value="1">
                            <label for="host_video1" class=""> @lang('app.enable') </label>
                        </div>
                        <div class="radio radio-inline ">
                            <input type="radio" name="host_video" id="host_video2" value="0" checked>
                            <label for="host_video2" class=""> @lang('app.disable') </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="m-b-10">
                            <label class="control-label">@lang('modules.zoommeeting.participantVideoStatus')</label>
                        </div>
                        <div class="radio radio-inline">
                            <input type="radio" name="participant_video" id="participant_video1" value="1">
                            <label for="participant_video1" class=""> @lang('app.enable') </label>
                        </div>
                        <div class="radio radio-inline ">
                            <input type="radio" name="participant_video" id="participant_video2" value="0"
                                checked>
                            <label for="participant_video2" class=""> @lang('app.disable') </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">@lang('modules.interviewSchedule.host')</label>
                       
                        <select class=" form-control" id="created_by" name="created_by">
                            @foreach ($users as $emp)
                                <option value="{{ $emp->id }}">
                                    {{ ucwords($emp->first_name) }} {{ $emp->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label class="">
                        <div class="icheckbox_flat-green" aria-checked="false" aria-disabled="false"
                            style="position: relative;">
                            <input type="checkbox" value="1" name="send_reminder" class="flat-red"
                                id="send_reminder" style="position: absolute; opacity: 0;">
                            <ins class="iCheck-helper"
                                style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                        </div>
                        @lang('modules.zoommeeting.reminder')
                    </label>

                </div>
                <div class="col-md-12" id="reminder-fields" style="display: none;">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('modules.zoommeeting.remindBefore')</label>
                                <input type="number" min="1" value="1" name="remind_time"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-3">
                            <div class="form-group repeat_type_dropdown">
                                <label>&nbsp;</label>
                                <select name="remind_type" id="" class="form-control">
                                    <option value="day">@lang('modules.zoommeeting.day')</option>
                                    <option value="hour">@lang('modules.zoommeeting.hour')</option>
                                    <option value="minute">@lang('modules.zoommeeting.minute')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12 ">
                    <div class="form-group">
                        <label>@lang('modules.interviewSchedule.comment')</label>
                        <textarea type="text" name="comment" id="comment" placeholder="@lang('modules.interviewSchedule.comment')" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
<div class="modal-footer">
    <button type="button" class="btn dark btn-outline" data-dismiss="modal">@lang('app.close')</button>
    <button type="button" class="btn btn-success save-schedule">@lang('app.submit')</button>
</div>

<script src="{{ asset('asset/js/icheck.min.js') }}"></script>
<script src="{{ asset('asset/js/moment.js') }}" type="text/javascript"></script>

{{-- 
<script src="{{ asset('assets/node_modules/multiselect/js/jquery.multi-select.js') }}"></script>  --}}

<script type="text/javascript" charset="utf8" src="{{ asset('asset/js/bootstrap-material-datetimepicker.js') }}">
</script>
<script>
    
    // Select 2 init.
     $('.select2').select2({});
    // Datepicker set
    $('#scheduleDate').bootstrapMaterialDatePicker({
        time: false,
        clearButton: true,
        minDate: new Date()
    });
    $('#end_date').bootstrapMaterialDatePicker({
        time: false,
        clearButton: true,
        minDate: new Date()
    });

    // Timepicker Set
    $('#scheduleTime').bootstrapMaterialDatePicker({
        date: false,
        shortTime: true, // look it
        format: 'HH:mm',
        switchOnClick: true
    });
    $('#end_time').bootstrapMaterialDatePicker({
        date: false,
        shortTime: true, // look it
        format: 'HH:mm',
        switchOnClick: true
    });
    // Save Interview Schedule
    $('.save-schedule').click(function() {
        $('#createSchedule').addClass('was-validated');
        if ($('#createSchedule')[0].checkValidity() === false) {
            event.stopPropagation();
        } else {
            
        $.ajax({
            url: '{{ route('recruit.interview-schedule.store') }}',
            container: '#createSchedule',
            type: "POST",
            data: $('#createSchedule').serialize(),
            success: function(response) {

                if (response.success) {

                    Toaster('success' , response.success);

                    setTimeout(function() {
                        location.reload(true);
                    }, 3000);
                    window.location.href =
                        "{{ route('recruit.interview-schedule.index') }}";

                } else {
                    Toaster('error',response.error);
                }
            }
        })
    }
    })
    $('#send_reminder').on('ifChecked', function(event) {
        $('#reminder-fields').show();
    });

    $('#send_reminder').on('ifUnchecked', function(event) {
        $('#reminder-fields').hide();
    });
    $('#send_reminder').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
    })
    $('input[type=radio][name=interview_type]').change(function() {
        if (this.value == 'online') {
            $('#repeat-fields').show();
            $('#end_time_section').show();
            $('#end_date_section').show();
        } else {
            $('#repeat-fields').hide();
            $('#end_date_section').hide();
            $('#end_time_section').hide();
        }
    })
</script>
