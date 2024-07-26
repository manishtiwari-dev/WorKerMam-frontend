@php
    $api_token = App\Helper\Helper::getCurrentuserToken();
    $userdata = Cache::get('userdata-' . $api_token);
    
@endphp
<x-app-layout>
    @section('title', 'Leave')

    <div class="contact-content">
        <div class="layout-specing">
           
            <div class="card contact-content-body">
                <form action="{{ url('hrm/leave/update/' . $data_list->id) }}" id="userForm" method="POST"
                    class="needs-validation" novalidate>
                    @csrf
                    <div class="card-header d-flex align-items-center justify-content-between py-3 px-3">
                        <h6 class="tx-15 mb-0">{{ __('hrm.edit_leave') }}</h6>
                    </div>
                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <div class="form-row">
                                @if (!empty($userdata->userType == 'subscriber'))
                                    @if ($role_name == 'admin' || $role_name == 'super_admin')
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label class="form-label">Employee </label>
                                            <select class="form-control selectsearch select2 @error('id') is-invalid @enderror "
                                                id="user_id" name="user_id">
                                                <option selected disable value="" disabled>
                                                    {{ __('hrm.user_id_select') }}</option>

                                                @if (!empty($user_list))
                                                    @foreach ($user_list as $user)
                                                        <option
                                                            value="{{ $user->staff_id }}"
                                                            {{ $user->staff_id == $data_list->staff_id ? 'selected' : '' }}>
                                                            {{ $user->staff_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                        </div>
                                    @else
                                        <input name="user_id" value="{{ $userdata->userId }}" id="from_date"
                                            type="hidden">
                                    @endif
                                @else
                                    <input name="user_id" value="{{ $userdata->userId }}" id="from_date"
                                        type="hidden">
                                @endif

                           
                                <div class="form-group col-md-6 col-lg-6">
                                    <label class="form-label">{{ __('hrm.select_date') }} <span
                                            class="text-danger mg-l-5">*</span></label>
                                    <input name="leave_date"
                                        value="{{ \Carbon\Carbon::parse($data_list->leave_date)->format('m/d/Y') }}"
                                        id="from_date" type=""
                                        class="form-control @error('start_date') is-invalid @enderror datepicker1"
                                        placeholder="{{ __('seo.start_date_placeholder') }}" required>

                                    <div class="invalid-feedback">
                                        {{ __('hrm.from_date_error') }}
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-lg-6 ">
                                    <label class="form-label">{{ __('hrm.leave_type') }} <span
                                            class="text-danger mg-l-5">*</span></label>
                                    <select
                                        class="form-control select2 @error('leave_type_id') is-invalid @enderror "
                                        id="leave_type_id" name="leave_type_id" required>
                                        <option selected disable value="" disabled>
                                            {{ __('hrm.leave_type_select') }}</option>

                                        @if (!empty($leave_type))
                                            @foreach ($leave_type as $type)
                                                <option value="{{ $type->leave_type_id }}"
                                                    {{ $type->leave_type_id == $data_list->leave_type_id ? 'selected' : '' }}>
                                                    {{ $type->leave_type_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    <div class="invalid-feedback">
                                        {{ __('hrm.leave_type_error') }}
                                    </div>
                                </div> 

                                <div class="form-group col-md-6 col-lg-6">
                                    <label class="form-label">{{ __('hrm.reason') }} <span
                                            class="text-danger mg-l-5">*</span></label>

                                    <textarea name="reason" rows="1" value="" class="form-control" required>{{ $data_list->reason }}</textarea>
                                    <div class="invalid-feedback">
                                        {{ __('hrm.reason_error') }}
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-lg-6">
                                    <label class="form-label">{{ __('hrm.status') }} <span
                                            class="text-danger mg-l-5">*</span></label>
                                    <select class="form-control select2 @error('id') is-invalid @enderror "
                                        id="status" name="status"
                                         >
                                    <option value ="">    {{ __('hrm.select_status') }}</option>
                                    <option value =" pending" {{ $data_list->status == 'pending' ? 'selected' : '' }}>
                                    Pending
                                    </option>
                                    <option value="approved"
                                        {{ $data_list->status == 'approved' ? 'selected' : '' }}>
                                        Approved
                                    </option>
                                    <option value="rejected"
                                        {{ $data_list->status == 'rejected' ? 'selected' : '' }}>
                                        Rejected
                                    </option>

                                    </select>
                                    <div class="invalid-feedback">
                                        {{ __('hrm.reason_error') }}
                                    </div>
                                </div> 
                            </div>
                        </div>

                        
                            <div class="col-sm-12 px-2">
                                <input type="submit" id="submit" name="send" class="btn btn-primary" value="Submit">
                                <a href="{{ url('hrm/leave') }}" class="btn btn-secondary mx-1">Cancel</a>
                            </div>
                        

                    </div>
                  
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(function() {


                $(".datepicker1").datepicker({
                    multidate: true,
                    format: "dd-mm-yyyy"
                });

                // $('.datepicker1').datepicker({

                //      format: 'dd/mm/yyyy'
                // //   //  dateFormat: 'dd/mm/yy',
                //     // onSelect: function() {
                //     //     var selected = $(this).datepicker("getDate");
                //     // }
                // });

            });
        </script>
        <script type="text/javascript">
        

            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict'
                var forms = document.querySelectorAll('.needs-validation')
                // Loop over them and prevent submission
                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
            })()
        </script>
    @endpush
</x-app-layout>
