<x-app-layout>
    @section('title', 'General Setting')

    <div class="contact-content">
        <div class="layout-specing">
           
            <div class="card contact-content-body">
                <form action="{{ url('seo/task-store') }}" id="userForm" method="POST" class="needs-validation"
                    novalidate>
                    @csrf
                    <div class="card-header d-flex align-items-center justify-content-between py-3 px-3">
                        <h6 class="tx-15 mg-b-0">{{ __('seo.add_task_title') }}</h6>

                    </div>
                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.task_title') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input name="seo_task_title" data-error="{{ __('seo.task_title_error') }}"
                                            value="{{ old('seo_task_title') }}" id="seo_task_title" type="text"
                                            class="form-control @error('seo_task_title') is-invalid @enderror"
                                            placeholder="{{ __('seo.task_title_placeholder') }}" required>
                                        <div class="invalid-feedback">
                                            <p>{{ __('seo.task_title_error') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.task_priority') }}<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select form-control select2 @error('task_priority') is-invalid @enderror"
                                        data-error="{{ __('seo.task_priority_error') }}" name="task_priority"
                                        aria-label="Default select example" required>
                                        <option selected disabled value="">{{ __('seo.select_task_priority') }}
                                        </option>
                                        @for ($priority = 1; $priority <= 20; $priority++)
                                            <option value="{{ $priority }}">{{ $priority }}</option>
                                        @endfor
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>{{ __('seo.select_task_priority') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.task_frequency') }} <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select form-control select2 @error('task_frequency') is-invalid @enderror"
                                        data-error="{{ __('seo.task_frequency_error') }}" name="task_frequency"
                                        aria-label="Default select example" required>

                                        <option selected disabled value="">{{ __('seo.select_task_frequency') }}
                                        </option>
                                        <option value="1">{{ __('seo.daily') }} </option>
                                        <option value="2">{{ __('seo.weekly_once') }}</option>
                                        <option value="3">{{ __('seo.weekly_twice') }} </option>
                                        <option value="4">{{ __('seo.weekly_thrice') }} </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>{{ __('seo.select_task_frequency') }}</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.no_of_submission') }} </label>
                                    <select class="form-select form-control  select2 @error('no_of_submission') is-invalid @enderror"
                                        name="no_of_submission" aria-label="Default select example" required>
                                        <option selected disabled value="">
                                            {{ __('seo.select_no_of_submission') }} </option>
                                        @for ($sub = 1; $sub <= 100; $sub++)
                                            <option value="{{ $sub }}">{{ $sub }}</option>
                                        @endfor
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>{{ __('seo.select_no_of_submission') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="col-sm-12 mb-3 mx-3 p-0">
                                <input type="submit" id="submit" name="send" class="btn btn-primary" value="Submit">
                                <a href="{{ route('seo.workReport') }}?tab=task" class="btn btn-secondary mx-1">Cancel</a>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                        
                    </div>
                 
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
    @endpush
</x-app-layout>
