<x-app-layout>
    @section('title', 'Setting')

    <div class="contact-content">
        <div class="layout-specing">
          
            <div class="card contact-content-body">
                <form action="{{ url('hrm/setting/leave-update/' . $leave_type->leave_type_id) }}" id="userForm"
                    method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="card-header d-flex align-items-center justify-content-between py-3 px-3">
                        <h6 class="tx-15 mg-b-0">{{ __('hrm.edit_leave_type') }}</h6>

                    </div>
                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <div class="form-row">
                                <div class="form-group col-md-6 col-6">
                                    <label class="form-label">{{ __('hrm.leave_type') }} <span
                                            class="text-danger mg-l-5">*</span></label>
                                    <input type="text" value="{{ $leave_type->leave_type_name }}"
                                        class="form-control" name="leave_type_name"
                                        placeholder="{{ __('hrm.leave_type_placeholder') }}" required>

                                    <div class="invalid-feedback">
                                        {{ __('hrm.leave_type_name_error') }}
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-6">
                                    <label class="form-label">{{ __('hrm.no_of_days') }} <span
                                            class="text-danger mg-l-5">*</span></label>
                                    <input type="number" class="form-control"
                                        placeholder="{{ __('hrm.no_of_days_placeholder') }}" name="no_of_days"
                                        value="{{ $leave_type->no_of_days }}" required>
                                    <div class="invalid-feedback">
                                        {{ __('hrm.no_of_days_error') }}
                                    </div>
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-6 mb-0">
                                    <label class="form-label">{{ __('hrm.max_allowed') }} <span
                                            class="text-danger mg-l-5">*</span></label>
                                    <input type="number" class="form-control" value="{{ $leave_type->max_allowed }}"
                                        name="max_allowed" placeholder="{{ __('hrm.max_allowed_placeholder') }}"
                                        required>

                                    <div class="invalid-feedback">
                                        {{ __('hrm.max_allowed_error') }}
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-6 mb-0">
                                    <label class="form-label">{{ __('hrm.information') }} </label>

                                    <textarea name="leave_info" rows="1" value="" class="form-control">{{ $leave_type->leave_info }}</textarea>
                                    <div class="invalid-feedback">
                                        {{ __('hrm.leave_info_error') }}
                                    </div>
                                </div>

                            </div>
                        </div>

                            <div class="col-sm-12 px-2 mt-3">
                                <input type="submit" id="submit" name="send" class="btn btn-primary" value="Submit">
                                <a href="{{route('hrm.setting', ['tab=leave-setting'])  }}" class="btn btn-secondary mx-1">Cancel</a>
                            </div>
                            <!--end col-->
                     

                    </div>
                </form>

            </div>
        </div>
    </div>
    @push('scripts')
    @endpush
</x-app-layout>
