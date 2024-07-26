<x-app-layout>
    
    <link rel="stylesheet" href="{{ asset('asset/css/iCheck/all.css') }}">


    @php
        $required_columns = [
            'gender' => false,
            'dob' => false,
            'country' => false,
            'address' => false,
        ];
        $requiredColumns = [
            'gender' => __('modules.front.gender'),
            'dob' => __('modules.front.dob'),
            'country' => __('modules.front.country'),
            'address' => __('app.address'),
        ];
        
        $section_visibility = [
            'profile_image' => 'yes',
            'resume' => 'yes',
            'cover_letter' => 'yes',
            'terms_and_conditions' => 'yes',
        ];
        
        $sectionVisibility = [
            'profile_image' => __('modules.jobs.profileImage'),
            'resume' => __('modules.jobs.resume'),
            'cover_letter' => __('modules.jobs.coverLetter'),
            'terms_and_conditions' => __('modules.jobs.termsAndConditions'),
        ];
        
        $details_visibility = [
            'show_salary' => 'yes',
            'show_work_experience' => 'yes',
            'show_job_type' => 'yes',
            'show_job_location' => 'yes',
            'show_job_category' => 'yes',
            'show_job_skills' => 'yes',
            'show_closing_date' => 'yes',
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
    @section('title', $title)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">{{ __('modules.addJobs') }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($content->locations) == 0)
                        <div class="alert alert-danger alert-dismissible fade show">
                            <h4 class="alert-heading"><i class="fa fa-warning"></i> Job Location Empty!</h4>
                            <p>You do not have any Location created. You need to create the Job location first to add
                                the job .
                                <a href="{{ route('recruit.job-location.create') }}"
                                    class="btn btn-primary btn-sm m-l-15" style="text-decoration: none;"><i
                                        class="fa fa-plus-circle"></i> @lang('app.createNew')
                                    @lang('menu.locations')
                                </a>
                            </p>
                        </div>
                    @elseif(count($content->categories) == 0)
                        <div class="alert alert-danger alert-dismissible fade show">
                            <h4 class="alert-heading"><i class="fa fa-warning"></i> Job Category Empty!</h4>
                            <p>You do not have any Job Category created. You need to create the Job location first to
                                add
                                the job .
                                <a href="{{ route('recruit.job-categories.create') }}"
                                    class="btn btn-primary btn-sm m-l-15" style="text-decoration: none;"><i
                                        class="fa fa-plus-circle"></i> @lang('app.createNew')
                                    @lang('menu.jobCategories')
                                </a>
                            </p>
                        </div>
                    @else
                        <form action="{{ route('recruit.jobs.store') }}" class="ajax-form needs-validation"
                            method="POST" id="userForm" novalidate>
                            @csrf

                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="address" class="required">@lang('modules.jobs.jobTitle')<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="title" value="{{ $content->job ? $content->job->title : null }}"
                                            required>
                                        <div class="invalid-feedback">
                                            <p>Please enter job title</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="address" class="required">@lang('modules.jobs.jobDescription')<span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control @error('job_description') is-invalid @enderror summernote" id=""
                                            name="job_description" rows="15" placeholder="Enter text ..." required>{!! $content->job ? $content->job->job_description : '' !!}</textarea>

                                        <div class="invalid-feedback">
                                            <p>Please enter job description</p>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="address" class="required">@lang('modules.jobs.jobRequirement')<span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control @error('job_requirement') is-invalid @enderror summernote" id=""
                                            name="job_requirement" rows="15" placeholder="Enter text ..." required>{!! $content->job ? $content->job->job_requirement : '' !!}</textarea>
                                        <div class="invalid-feedback">
                                            <p>Please enter job requirment</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="address">@lang('menu.locations')</label>
                                        <select name="location_id" id="location_id"
                                            class="form-control select2 custom-select">
                                            @foreach ($content->locations as $location)
                                                <option @if ($content->job && $content->job->location_id == $location->id) selected @endif
                                                    value="{{ $location->id }}">
                                                    {{ ucfirst($location->location) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="address" class="required">@lang('menu.jobCategories')<span
                                                class="text-danger">*</span></label>
                                        <select name="category_id" id="category_id"
                                            class="form-control @error('category_id') is-invalid @enderror" required>
                                            <option value="">@lang('app.choose') @lang('menu.jobCategories')</option>
                                            @foreach ($content->categories as $category)
                                                <option @if ($content->job && $content->job->category_id == $category->id) selected @endif
                                                    value="{{ $category->id }}">{{ ucfirst($category->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            <p>Please select job category</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6 skillselect">

                                    <div class="form-group">
                                        <label>@lang('menu.skills')</label>
                                        <select class="select2 m-b-10 @error('skill_id') is-invalid @enderror"
                                            id="job_skills" style="width: 100%; " multiple="multiple"
                                            data-placeholder="@lang('app.add') @lang('menu.skills')" name="skill_id[]"
                                            >
                                            @if ($content->job)
                                                @foreach ($content->skills as $skill)
                                                    <option
                                                        @foreach ($content->job->skills as $jskill) @if ($skill->id == $jskill->skill_id)
                                                    selected @endif @endforeach
                                                        value="{{ $skill->id }}">{{ ucwords($skill->name) }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="invalid-feedback">
                                            <p>Please Select Skill</p>
                                        </div>

                                    </div>


                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="address" class="required">@lang('modules.jobs.totalPositions')<span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="total_positions"
                                            id="total_positions"
                                            value="{{ $content->job ? $content->job->total_positions : null }}"
                                            required>
                                        <div class="invalid-feedback">
                                            <p>Please enter total position</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="address">@lang('app.startDate')<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control datepicker" id=""
                                            value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}" name="start_date"
                                            required>
                                        <div class="invalid-feedback">
                                            <p>Please select start date</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="address">@lang('app.endDate')<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control datepicker" id=""
                                            name="end_date"
                                            value="{{ \Carbon\Carbon::now()->addMonth(1)->format('d/m/Y') }}"
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
                                            <option @if ($content->job && $content->job->status == 'active') selected @endif value="active">
                                                @lang('app.active')</option>
                                            <option @if ($content->job && $content->job->status == 'inactive') selected @endif value="inactive">
                                                @lang('app.inactive')</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address" class="required">@lang('modules.jobs.jobType')</label>
                                        <a href="javascript:;" title="@lang('app.add') @lang('modules.jobs.jobType')"
                                            id="addJobType" class="btn btn-sm border btn-outline"><i
                                                class="fa fa-plus"></i></a>

                                        <select name="job_type_id" id="job_type" class="form-control" required>
                                            <option value="">--</option>
                                            @foreach ($content->jobTypes as $jobType)
                                                <option @if ($content->job && $content->job->job_type_id == $jobType->id) selected @endif
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
                                        <label for="address" class="required">@lang('modules.jobs.workExperience')<span
                                                class="text-danger">*</span></label>
                                        <a href="javascript:;" title="@lang('app.add') @lang('modules.jobs.workExperience')"
                                            id="addWorkExperience" class="btn btn-sm border btn-outline"><i
                                                class="fa fa-plus"></i></a>
                                        <select name="work_experience_id" id="work_experience" class="form-control"
                                            required>
                                            <option value="">--</option>
                                            @foreach ($content->workExperiences as $workExperience)
                                                <option @if ($content->job && $content->job->work_experience_id == $workExperience->id) selected @endif
                                                    value="{{ $workExperience->id }}">
                                                    {{ $workExperience->work_experience }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            <p>Please select Work Experience</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address" class="required">@lang('modules.jobs.showPayBy')<span
                                                class="text-danger">*</span></label>

                                        <select class="form-control select-picker" name="pay_type" id="paytype"
                                            data-live-search="true" required>
                                            <option value="">--</option>
                                            <option @if ($content->job && $content->job->pay_type == 'Range') selected @endif value="Range">
                                                @lang('modules.jobs.range')</option>
                                            <option @if ($content->job && $content->job->pay_type == 'Starting') selected @endif
                                                value="Starting">
                                                @lang('modules.jobs.startingSalary')</option>
                                            <option @if ($content->job && $content->job->pay_type == 'Maximum') selected @endif
                                                value="Maximum">
                                                @lang('modules.jobs.maximumSalary')</option>
                                            <option @if ($content->job && $content->job->pay_type == 'Exact Amount') selected @endif
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
                                                    name="starting_salary"
                                                    value="{{ $content->job ? $content->job->starting_salary : null }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="end_amt">
                                            <div class="form-group">
                                                <label for="address" class="required">@lang('modules.jobs.maximumSalary')</label>
                                                <input class="form-control" type="number" id="maximunSalary"
                                                    name="maximum_salary"
                                                    value="{{ $content->job ? $content->job->maximum_salary : null }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 pay_according" id="payaccording">
                                    <div class="form-group">
                                        <label for="payaccording" class="required">@lang('modules.jobs.rate')</label>
                                        <select class="form-control select-picker" name="pay_according"
                                            id="pay_according" data-live-search="true">
                                            <option value="">--</option>
                                            <option @if ($content->job && $content->job->pay_according == 'Hour') selected @endif value="Hour">
                                                @lang('modules.jobs.hour')</option>
                                            <option @if ($content->job && $content->job->pay_according == 'Day') selected @endif value="Day">
                                                @lang('modules.jobs.day')</option>
                                            <option @if ($content->job && $content->job->pay_according == 'Week') selected @endif value="Week">
                                                @lang('modules.jobs.week')</option>
                                            <option @if ($content->job && $content->job->pay_according == 'Month') selected @endif value="Month">
                                                @lang('modules.jobs.month')</option>
                                            <option @if ($content->job && $content->job->pay_according == 'Year') selected @endif value="Year">
                                                @lang('modules.jobs.year')</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta-title">Sort Order<span class="text-danger">*</span></label>
                                        <input type="text" id="sort_order" class="form-control" name="sort_order"
                                            value="{{ $content->job ? $content->job->sort_order : '' }}" required>
                                        <div class="invalid-feedback">
                                            <p>Please enter sort order</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="meta-title">@lang('modules.jobs.metaTitle')<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="meta-title" class="form-control" name="meta_title"
                                            value="{{ $content->job ? $content->job->meta_details->title : '' }}" required>
                                        <div class="invalid-feedback">
                                            <p>Please enter meta title</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="meta-description">@lang('modules.jobs.metaDescription')<span class="text-danger">*</span></label>
                                        <textarea id="meta-description" class="form-control" name="meta_description" rows="3" required>{{ $content->job ? $content->job->meta_details->description : '' }}</textarea>
                                    
                                     <div class="invalid-feedback">
                                        <p>Please enter Meta Description</p>
                                    </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="col-md-12">
                                    @if (count($content->questions) > 0)
                                        <h4 class="m-b-0 m-l-10 box-title">@lang('modules.front.questions')</h4>
                                    @endif
                                    @forelse($content->questions as $question)
                                        <div class="form-group form-group-inline">
                                            <label class="mr-4">
                                                <div class="icheckbox_flat-green" aria-checked="false"
                                                    aria-disabled="false" style="position: relative;">
                                                    <input type="checkbox" value="{{ $question->id }}"
                                                        name="question[]" class="flat-red" style=" ">
                                                </div>
                                                {{ ucfirst($question->question) }}@if ($question->required == 'yes')
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
                                        <div class="form-group form-group-inline d-flex align-items-center gap-3">
                                            @if ($content->job)
                                                @foreach ($content->job->required_columns as $key => $value)
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
                                            @else
                                            @foreach ($required_columns as $key => $value)
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
                                        <div class="form-group form-group-inline d-flex align-items-center gap-3">
                                            @if ($content->job)
                                                @foreach ($content->job->section_visibility as $key => $value)
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

                                                        {{ ucfirst(__($sectionVisibility[$key])) }}
                                                    </label>
                                                @endforeach
                                            @else
                                                @foreach ($section_visibility as $key => $value)
                                                    <label class="mr-4">
                                                        <div class="icheckbox_flat-green" aria-checked="false"
                                                            aria-disabled="false" style="position: relative;">
                                                            <input type="checkbox" value="yes"
                                                                name="{{ $key }}" class="flat-red"
                                                                style="position: absolute; opacity: 0;">
                                                            <ins class="iCheck-helper"
                                                                style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                        </div>

                                                        {{ ucfirst(__($sectionVisibility[$key])) }}
                                                    </label>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div id="columns">
                                        <label>@lang('modules.jobs.detailsVisibility')</label>
                                        <div class="form-group form-group-inline d-flex align-items-center gap-3">
                                            @if ($content->job)
                                                @foreach ($content->job->details_visibility as $key => $value)
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
                                            @else
                                                @foreach ($details_visibility as $key => $value)
                                                    <label class="mr-4">
                                                        <div class="icheckbox_flat-green" aria-checked="false"
                                                            aria-disabled="false" style="position: relative;">
                                                            <input type="checkbox" value="yes"
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
                                    <a href="{{ route('recruit.jobs.index') }}"
                                        class="btn btn-secondary mx-1">Cancel</a>

                                </div>
                                <!--end col-->

                            </div>

                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Ajax Modal Start for --}} 
    <div class="modal fade" id="addDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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
                    <input type="hidden" id="delete_skill_id" name="input_field_id">
                    <p class="mg-b-0">{{ __('common.delete_confirmation') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('common.no') }}
                    </button>
                    <button type="button" class="btn btn-primary delete_submit_btn"
                        id="">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')       
        <script src="{{ asset('asset/js/iCheck/icheck.min.js') }}"></script>

        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

        <script type="text/javascript">
            $('.summernote').summernote({
                height: 400
            });
        </script>

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





            $('#amount_field, #payaccording').hide();

            @if (!is_null($content->job) && $content->job->pay_type != 'Range')
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
            @elseif (!is_null($content->job) && $content->job->pay_type == 'Range')
                $('#start_amt label').html("{{ __('modules.jobs.startingSalary') }}");
                $('#amount_field, #end_amt, #payaccording').show();
                $('#start_amt').removeClass('col-md-12');
                $('#start_amt').addClass('col-md-6');
            @endif

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
        {{-- 
        <script>
            CKEDITOR.editorConfig = function(config) {
                config.uiColor = '#AADC6E';
                config.dtd.$removeEmpty['i'] = false;
                config.ignoreEmptyParagraph = false;
                config.dtd.$removeEmpty.div = 0
            };
            CKEDITOR.replace('job_description');
            CKEDITOR.replace('job_requirement');
        </script> --}}
    @endpush
</x-app-layout>
