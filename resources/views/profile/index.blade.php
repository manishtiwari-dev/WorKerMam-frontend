<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="col-md-12">
                <div class="card rounded shadow">
                    <form action="{{ route('profile-update', $profiledata->id) }}" id="userForm" method="POST"
                        class="needs-validation" novalidate>
                        @csrf
                      
                        <div class="card-header bg-transparent px-4 py-2">
                            <h5 class="text-md-start text-center mb-0">Update Profile</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class=" bg-transparent px-4 py-2 mb-3">
                                    <label class="form-label">{{__('user-manager.name')}}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input name="name" id="name" value="{{ $profiledata->name }}" type="text"
                                            class="form-control" placeholder="Enter Name" required>
                                        <div class="invalid-feedback">
                                            {{__('user-manager.please_enter_name')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="bg-transparent px-4 py-2 mb-3">
                                    <label class="form-label">{{__('user-manager.email')}}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input name="email" id="email" value="{{ $profiledata->email }}" type="email"
                                            class="form-control" placeholder="Enter email" required>
                                        <div class="invalid-feedback">
                                            {{__('user-manager.please_enter_email')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            {{-- @php
                            dd($role_list);
                            @endphp --}}
                        </div>
                        <!--end row-->
                        <div class="row">
                            <div class="col-sm-12 my-2 mx-4">
                                <input type="submit" id="submit" name="send" class="btn btn-primary"
                                    value="{{__('common.update')}}">
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                    <div class="row">
                        <div class="col-md-12 mt-4 pt-2">
                            <div class="d-flex justify-content-between">
                                <div class="mb-3 my-4 mx-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="showpasswordform">
                                        <label class="form-check-label" for="showpasswordform">
                                            <h5>{{__('user-manager.changepass')}}</h5>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('change-password-profile') }}" method="post" id="change_password_form"
                                class="needs-validation" novalidate style="display: none;">
                                @csrf
                                <input type="hidden" value="{{$profiledata->id}}" name="user_id">
                                <div class="row">
                                    {{-- <div class="col-lg-6">
                                        <div class="mb-3 my-4 mx-4">
                                            <label class="form-label">{{__('user-manager.old_pass')}}:</label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="key" class="fea icon-sm icons"></i>
                                                <input type="password" name="old_password" id="old_password"
                                                    class="form-control ps-5" placeholder="Old password" required>
                                                @error('old_password')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> --}}
                                    <!--end col-->
                                    <div class="col-lg-8">
                                        <div class="col-lg-6 d-block">
                                            <div class="mb-3 my-4 mx-4">
                                                <label class="form-label">{{__('user-manager.new_pass')}}:</label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="key" class="fea icon-sm icons"></i>
                                                    <input type="password" name="new_password" id="new_password"
                                                        class="form-control ps-5" placeholder="New password" required>
                                                    @error('new_password')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6 ">
                                            <div class="mb-3 my-4 mx-4">
                                                <label class="form-label">{{__('user-manager.confirm_pass')}}:</label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="key" class="fea icon-sm icons"></i>
                                                    <input type="password" name="password_confirmation"
                                                        id="password_confirmation" class="form-control ps-5"
                                                        placeholder="Re-type New password" required>
                                                    @error('password_confirmation')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--end col-->
                                    <div class="col-lg-12 my-4 mx-4">
                                        <button type="submit"
                                            class="btn btn-primary">{{__('user-manager.save_pass')}}</button>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        //update Profile Data
        $(document).ready(function() {

            // Show Password form

            $(document).on("click", "#showpasswordform", function(e) {
                $('#change_password_form').toggle(1000);
            });

            // Change Password Validation  change_password_form

            $('#change_password_form').validate({
                rules: {
                    old_password: {
                        required: true,
                    },
                    new_password: {
                        required: true
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#new_password"
                    },
                },
                messages: {
                    old_password: {
                        required: "Please enter old password",
                        minlength: "Please enter valid password"
                    },
                    new_password: {
                        required: "Please enter new password",
                    },
                    password_confirmation: {
                        required: "Please enter confirm password",
                        equalTo: "Password and confirm password should be same"
                    },
                },

                highlight: function(element) {
                    $(element).closest('.cls').removeClass('success').addClass('error');
                },

            });

            // notification ajax
            $('input[name="setting"]').on('click', function() {
                if ($(this).val() == 5) {
                    $('input[name="setting"]').not(this).prop('checked', false);
                }
            });

            $("#btnSettingSave").click(function() {
                var selectedSetting = new Array();
                $('input[name="setting"]:checked').each(function() {
                    selectedSetting.push(this.value);
                });

            });
        });
    </script>
    @endpush
</x-app-layout>