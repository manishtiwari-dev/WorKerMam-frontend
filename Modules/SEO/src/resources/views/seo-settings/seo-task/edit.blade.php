<x-app-layout>
    @section('title', 'General Setting')

    <div class="contact-content">
        <div class="layout-specing">
            
            <div class="card contact-content-body">
                <form action="{{ url('seo/task-update/' . $seotask->id) }}" id="userForm" method="POST"
                    class="needs-validation" novalidate>
                    @csrf
                    <!-- {{ method_field('PUT') }} -->
                    <div class="card-header d-flex align-items-center justify-content-between py-3 px-3">
                        <h6 class="tx-15 mg-b-0">{{ __('seo.update_task_title') }}</h6>

                    </div>
                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.task_title') }} <span
                                            class="text-danger">*</span></label>
                                    <input name="seo_task_title" data-error="{{ __('seo.task_title_error') }}"
                                        id="seo_task_title" value="{{ $seotask->seo_task_title }}" type="text"
                                        class="form-control " placeholder="{{ __('seo.task_title_placeholder') }}"
                                        required>
                                    <div class="invalid-feedback">
                                        <p>{{ __('seo.task_title_error') }}</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.task_priority') }}<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select form-control select2"
                                        data-error="{{ __('seo.task_priority_error') }}" name="task_priority"
                                        value="{{ $seotask->task_priority }}" aria-label="Default select example"
                                        required>
                                        <option selected disabled value="">{{ __('seo.select_task_priority') }}
                                        </option>
                                        @for ($priority = 1; $priority <= 20; $priority++)
                                            @php
                                                $selected = '';
                                                if ($priority == $seotask->task_priority) {
                                                    $selected = 'selected';
                                                }
                                            @endphp
                                            <option value="{{ $priority }}" {{ $selected }}>
                                                {{ $priority }}</option>
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
                                    <select class="form-select form-control select2"
                                        data-error="{{ __('seo.task_frequency_error') }}" name="task_frequency"
                                        aria-label="Default select example" required>

                                        <option selected disabled value="">{{ __('seo.select_task_frequency') }}
                                        </option>
                                        <option value="1" {{ $seotask->task_frequency == '1' ? 'selected' : '' }}>
                                            Daily</option>
                                        <option value="2" {{ $seotask->task_frequency == '2' ? 'selected' : '' }}>
                                            Weekly Once</option>
                                        <option value="3" {{ $seotask->task_frequency == '3' ? 'selected' : '' }}>
                                            Weekly Twice</option>
                                        <option value="4" {{ $seotask->task_frequency == '4' ? 'selected' : '' }}>
                                            Weekly Thrice</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>{{ __('seo.select_task_frequency') }}</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.no_of_submission') }} </label>
                                    <select class="form-select form-control select2" name="no_of_submission"
                                        aria-label="Default select example  required">
                                        <option selected disabled value="">
                                            {{ __('seo.select_no_of_submission') }}</option>
                                        @for ($sub = 1; $sub <= 100; $sub++)
                                            @php
                                                $selected = '';
                                                if ($sub == $seotask->no_of_submission) {
                                                    $selected = 'selected';
                                                }
                                            @endphp
                                            <option value="{{ $sub }}" {{ $selected }}>
                                                {{ $sub }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.status') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="status" class="form-control  select2 @error('status') is-invalid @enderror"
                                        name="status" aria-label="Default select example  required">
                                        <option selected disabled value="">{{ __('seo.select_status') }}
                                        </option>
                                        <option value="1" {{ $seotask->status == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ $seotask->status == 0 ? 'selected' : '' }}>Deactive
                                        </option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="">
                            <div class="col-sm-12 mb-3 mx-3 p-0">
                                <input type="submit" id="submit" name="send" class="btn btn-primary" value="Update">
                                <a href="{{ route('seo.workReport', ['tab=task']) }}"
                                    class="btn btn-secondary mx-1">Cancel</a>
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
