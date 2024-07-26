<x-app-layout>
    <style>
        .skillselect .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            background: transparent;
            border: 0;
            opacity: 1;
            left: 0;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('asset/css/iCheck/all.css') }}">
    @php
        $requiredColumns = [
            'gender' => __('modules.front.gender'),
            'dob' => __('modules.front.dob'),
            'country' => __('modules.front.country'),
            'address' => __('app.address'),
        ];
        $sectionVisibility = [
            'profile_image' => __('modules.jobs.profileImage'),
            'resume' => __('modules.jobs.resume'),
            'cover_letter' => __('modules.jobs.coverLetter'),
            'terms_and_conditions' => __('modules.jobs.termsAndConditions'),
        ];
        
        $detailsVisibility = [
            'show_salary' => __('modules.jobs.Salary'),
            'show_work_experience' => __('modules.jobs.work_experience'),
            'show_job_type' => __('modules.jobs.job_type'),
            'show_job_location' => __('modules.jobs.location'),
            'show_job_category' => __('modules.jobs.job_category'),
            'show_job_skills' => __('modules.jobs.skill'),
            'show_closing_date' => __('modules.jobs.Date'),
        ];
        
    @endphp
    @section('title', 'Jobs')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">{{ __('modules.updateJobs') }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('recruit.jobs.update', $job->id) }}" class="ajax-form needs-validation"
                        method="POST" id="" novalidate>
                        @csrf
                        {{ method_field('PUT') }}

                        <div class="row">


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">@lang('modules.jobs.jobTitle')<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title"
                                        value="{{ $job->title }}" required>
                                    <div class="invalid-feedback">
                                        <p>Please enter job title</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">@lang('modules.jobs.slug')<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="slug"
                                        value="{{ $job->slug }}" required>
                                    <div class="invalid-feedback">
                                        <p>Please enter slug</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">@lang('modules.jobs.jobDescription')<span class="text-danger">*</span></label>
                                    <textarea required class="form-control summernote" id="" name="job_description" rows="15"
                                        placeholder="Enter text ...">{!! $job->job_description !!}</textarea>
                                    <div class="invalid-feedback">
                                        <p>Please enter job description</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">@lang('modules.jobs.jobRequirement')<span class="text-danger">*</span></label>
                                    <textarea class="form-control summernote" id="" name="job_requirement" rows="15"
                                        placeholder="Enter text ..." required>{!! $job->job_requirement !!}</textarea>
                                    <div class="invalid-feedback">
                                        <p>Please enter job requirment</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{-- @dd($locations) --}}
                                    <label for="address">@lang('menu.locations')<span class="text-danger">*</span></label>
                                    <select name="location_id" id="location_id"
                                        class="form-control select2 custom-select" required>

                                        @foreach ($locations as $location)
                                            <option @if ($location->id == $job->location_id) selected @endif
                                                value="{{ $location->id }}">
                                                {{ ucfirst($location->location) . ' (' . $location->country->countries_iso_code_2 . ')' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">@lang('menu.jobCategories')<span class="text-danger">*</span></label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        @foreach ($categories as $category)
                                            <option @if ($category->id == $job->category_id) selected @endif
                                                value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>Please select job category</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 skillselect">
                                <div class="form-group">
                                    {{-- @dd($job) --}}
                                    <label>@lang('menu.skills')</label>
                                    <select class="select2 m-b-10 select2-multiple" id="job_skills"
                                        style="width: 100%; " multiple="multiple"
                                        data-placeholder="@lang('app.add') @lang('menu.skills')" name="skill_id[]">
                                        @foreach ($skills as $skill)
                                            <option
                                                @foreach ($job->skills as $jskill)
                                            @if ($skill->id == $jskill->skill_id)
                                            selected
                                            @endif @endforeach
                                                value="{{ $skill->id }}">{{ ucwords($skill->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">@lang('modules.jobs.totalPositions')<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="total_positions"
                                        id="total_positions" value="{{ $job->total_positions }}" required>
                                    <div class="invalid-feedback">
                                        <p>Please enter total position</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">@lang('app.startDate')<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control datepicker" id=""
                                        value="{{ \Carbon\Carbon::parse($job->start_date)->format('d/m/Y') }}"
                                        name="start_date" required>
                                    <div class="invalid-feedback">
                                        <p>Please select start date</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">@lang('app.endDate')<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control datepicker" id=""
                                        name="end_date"
                                        value="{{ \Carbon\Carbon::parse($job->end_date)->format('d/m/Y') }} "
                                        required>
                                    <div class="invalid-feedback">
                                        <p>Please select end date</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">@lang('app.status')</label>
                                    <select name="status" id="status" class="form-control">
                                        <option @if ($job->status == 'active') selected @endif value="active">
                                            @lang('app.active')</option>
                                        <option @if ($job->status == 'inactive') selected @endif value="inactive">
                                            @lang('app.inactive')</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">@lang('modules.jobs.jobType')</label>
                                    <a href="javascript:;" title="@lang('app.add') @lang('modules.jobs.jobType')"
                                        id="addJobType" class="btn btn-sm btn-info btn-outline"><i
                                            class="fa fa-plus"></i></a>


                                    <select name="job_type_id" id="name" class="form-control" required>

                                        @foreach ($jobTypes as $jobType)
                                            <option @if ($jobType->id == $job->job_type_id) selected @endif
                                                value="{{ $jobType->id }}">{{ $jobType->job_type }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>Please select job type</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">@lang('modules.jobs.workExperience')</label>
                                    <a href="javascript:;" title="@lang('app.add') @lang('modules.jobs.workExperience')"
                                        id="addWorkExperience" class="btn btn-sm btn-info btn-outline"><i
                                            class="fa fa-plus"></i></a>

                                    <select name="work_experience_id" id="name" class="form-control">
                                        <option value="">--</option>
                                        @foreach ($workExperiences as $workExperience)
                                            <option @if ($workExperience->id == $job->work_experience_id) selected @endif
                                                value="{{ $workExperience->id }}">
                                                {{ $workExperience->work_experience }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address" class="required">@lang('modules.jobs.showPayBy')<span
                                            class="text-danger">*</span></label>

                                    <select class="form-control select-picker" name="pay_type" id="paytype"
                                        data-live-search="true">
                                        <option @if ($job->pay_type == 'Range') selected @endif value="Range">
                                            @lang('modules.jobs.range')</option>
                                        <option @if ($job->pay_type == 'Starting') selected @endif value="Starting">
                                            @lang('modules.jobs.startingSalary')</option>
                                        <option @if ($job->pay_type == 'Maximum') selected @endif value="Maximum">
                                            @lang('modules.jobs.maximumSalary')</option>
                                        <option @if ($job->pay_type == 'Exact Amount') selected @endif
                                            value="Exact Amount">@lang('modules.jobs.exactSalary')</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>Please select show pay by</p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12" id="amount_field">
                                <div class="row">
                                    <div class="col-md-6" id="start_amt">
                                        <div class="form-group">
                                            <label for="address" class="required">@lang('modules.jobs.startingSalary')</label>
                                            <input class="form-control" type="number" id="startingSalary"
                                                name="starting_salary" value="{{ $job->starting_salary }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="end_amt">
                                        <div class="form-group">
                                            <label for="address" class="required">@lang('modules.jobs.maximumSalary')</label>
                                            <input class="form-control" type="number" id="maximunSalary"
                                                name="maximum_salary" value="{{ $job->maximum_salary }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pay_according" id="payaccording">
                                <div class="form-group">
                                    <label for="payaccording" class="required">@lang('modules.jobs.rate')</label>
                                    <select class="form-control select-picker" name="pay_according"
                                        id="pay_according" data-live-search="true">
                                        <option value="" disabled selected>--</option>
                                        <option @if ($job->pay_according == 'Hour') selected @endif value="Hour">
                                            @lang('modules.jobs.hour')</option>
                                        <option @if ($job->pay_according == 'Day') selected @endif value="Day">
                                            @lang('modules.jobs.day')</option>
                                        <option @if ($job->pay_according == 'Week') selected @endif value="Week">
                                            @lang('modules.jobs.week')</option>
                                        <option @if ($job->pay_according == 'Month') selected @endif value="Month">
                                            @lang('modules.jobs.month')</option>
                                        <option @if ($job->pay_according == 'Year') selected @endif value="Year">
                                            @lang('modules.jobs.year')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="meta-title">Sort Order<span class="text-danger">*</span></label>
                                    <input type="text" id="sort_order" class="form-control" name="sort_order"
                                        value="{{ $job->sort_order ?? '' }}" required>
                                    <div class="invalid-feedback">
                                        <p>Please enter sort order</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="meta-title">@lang('modules.jobs.metaTitle')<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="meta-title" class="form-control" required
                                        name="meta_title" value="{{ $job->meta_details->title ?? '' }}">
                                    <div class="invalid-feedback">
                                        <p>Please enter meta title</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="meta-description">@lang('modules.jobs.metaDescription')<span
                                            class="text-danger">*</span></label>
                                    <textarea id="meta-description" class="form-control" name="meta_description" rows="3" required>{{ $job->meta_details->description ?? '' }}</textarea>
                                    <div class="invalid-feedback">
                                        <p>Please enter meta description</p>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="col-md-12">
                                @if (count($questions) > 0)
                                    <h4 class="m-b-0 m-l-10 box-title">@lang('modules.front.questions')</h4>
                                @endif
                                @forelse($questions as $question)
                                    <div class="form-group">
                                        <label class="">
                                            <div class="icheckbox_flat-green" aria-checked="false"
                                                aria-disabled="false" style="position: relative;">
                                                <input @if (in_array($question->id, $jobQuestion)) checked @endif
                                                    type="checkbox" value="{{ $question->id }}" name="question[]"
                                                    class="flat-red" style="position: absolute; opacity: 0;">
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

                            <div class="col-md-12">
                                <div id="columns">
                                    <label>@lang('app.askApplicantsFor')</label>
                                    <div class="form-group form-group-inline">
                                        @if ($job->required_columns)
                                            @foreach ($job->required_columns as $key => $value)
                                                <label class="mr-4">
                                                    <div class="icheckbox_flat-green" aria-checked="false"
                                                        aria-disabled="false" style="position: relative;">
                                                        <input @if ($value) checked @endif
                                                            type="checkbox" value="{{ $key }}"
                                                            name="{{ $key }}" class="flat-red"
                                                            style="position: absolute; opacity: 0;">
                                                        <ins class="iCheck-helper"
                                                            style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                    </div>
                                                    {{ ucfirst(__($requiredColumns[$key])) }}
                                                </label>
                                            @endforeach

                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div id="columns">
                                    <label>@lang('modules.jobs.sectionVisibility')</label>
                                    <div class="form-group form-group-inline">
                                        @if ($job->section_visibility)
                                            @foreach ($job->section_visibility as $key => $value)
                                                <label class="mr-4">
                                                    <div class="icheckbox_flat-green" aria-checked="false"
                                                        aria-disabled="false" style="position: relative;">
                                                        <input @if ($value == 'yes') checked @endif
                                                            type="checkbox" value="yes"
                                                            name="{{ $key }}" class="flat-red"
                                                            style="position: absolute; opacity: 0;">
                                                        <ins class="iCheck-helper"
                                                            style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                    </div>
                                                    {{  ucfirst(__($sectionVisibility[$key]??'')) }}
                                                </label>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div id="columns">
                                    <label>@lang('modules.jobs.detailsVisibility')</label>
                                    <div class="form-group form-group-inline">
                                        @if ($job->details_visibility)
                                            @foreach ($job->details_visibility as $key => $value)
                                                <label class="mr-4">
                                                    <div class="icheckbox_flat-green" aria-checked="false"
                                                        aria-disabled="false" style="position: relative;">
                                                        <input @if ($value == 'yes') checked @endif
                                                            type="checkbox" value="yes"
                                                            name="{{ $key }}" class="flat-red"
                                                            style="position: absolute; opacity: 0;">
                                                        <ins class="iCheck-helper"
                                                            style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                    </div>
                                                    {{ ucfirst(__($detailsVisibility[$key])) }}
                                                </label>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="mt-3">
                            <div class="col-sm-12 p-0">
                                <button type="submit" id="" class="btn btn-primary">
                                    Submit</button>
                                <a href="{{ route('recruit.jobs.index') }}" class="btn btn-secondary mx-1">Cancel</a>

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

        <script src="{{ asset('asset/js/iCheck/icheck.min.js') }}"></script>
        <script>
            $('input[type="checkbox"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
            })

            $('.select2').select2({
                placeholder: 'Choose one',
            });

            $(function() {
                $('.datepicker').datepicker({
                    dateFormat: 'dd/mm/yy',
                    onSelect: function() {
                        var selected = $(this).datepicker("getDate");
                    }
                });

            });




            $('#category_id').change(function() {

                var id = $(this).val();

                var url = "{{ route('recruit.job-categories.getSkills', ':id') }}";
                url = url.replace(':id', id);

                $.ajax({
                    url: url,
                    success: function(response) {
                        console.log(response);
                        html = ``;
                        $.each(response.data, function(index, value) {
                            html += `<option selected value='${value.id}'>${value.name}</option>`;
                        });

                        $('#job_skills').html(html);
                        $(".select2").select2();
                    }
                })

            });

            if ($('#paytype').val() != 'Range') {
                $('#end_amt').hide();

                switch ($('#paytype').val()) {
                    case 'Starting':
                        $('#start_amt label').html("{{ __('modules.jobs.startingSalary') }}");
                        break;
                    case 'Maximum':
                        $('#start_amt label').html("{{ __('modules.jobs.maximumSalary') }}");
                        break;
                    case 'Exact Amount':
                        $('#start_amt label').html("{{ __('modules.jobs.exactSalary') }}");
                        break;
                }
            } else {
                $('#start_amt').removeClass('col-md-12');
                $('#start_amt').addClass('col-md-6');

            }

            $('#paytype').change(function() {
                if ($('#paytype').val() != 'Range') {
                    $('#amount_field, #payaccording').show();
                    $('#end_amt').hide();

                    switch ($('#paytype').val()) {
                        case 'Starting':

                            $('#start_amt label').html("{{ __('modules.jobs.startingSalary') }}");
                            break;
                        case 'Maximum':
                            $('#start_amt label').html("{{ __('modules.jobs.maximumSalary') }}");
                            break;
                        case 'Exact Amount':
                            $('#start_amt label').html("{{ __('modules.jobs.exactSalary') }}");
                            break;
                    }
                } else {
                    $('#start_amt label').html("{{ __('modules.jobs.startingSalary') }}");
                    $('#amount_field, #end_amt, #payaccording').show();
                    $('#start_amt').removeClass('col-md-12');
                    $('#start_amt').addClass('col-md-6');
                }

            });


            $(document).ready(function() {

                $('#addJobType').click(function() {
                    var url = "{{ route('recruit.job-type.create') }}";
                    $('.modal-title').html("<i class='icon-plus'></i> @lang('modules.jobs.jobType')");
                    $.ajaxModal('#addDepartmentModal', url);
                    $('#addDepartmentModal').modal('show');
                });

                $('#addWorkExperience').click(function() {
                    var url = "{{ route('recruit.work-experience.create') }}";
                    $('.modal-title').html("<i class='icon-plus'></i> @lang('modules.jobs.workExperience')");
                    $.ajaxModal('#addDepartmentModal', url);
                    $('#addDepartmentModal').modal('show');
                });

            });
        </script>
         <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

        <script type="text/javascript">
            $('.summernote').summernote({
                height: 400
            });
        </script>
        <script>
            // CKEDITOR.replace('job_description');
            // CKEDITOR.replace('job_requirement');

            // CKEDITOR.replace('job_description' {
            //     customConfig: {{ asset('asset/js/') }} 'ckeditor_config.js'
            // });
            // CKEDITOR.replace('job_requirement' {
            //     customConfig: {{ asset('asset/js/') }} 'ckeditor_config.js'
            // });
        </script>
    @endpush
</x-app-layout>
