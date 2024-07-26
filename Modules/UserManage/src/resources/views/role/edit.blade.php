{{-- @dd($content) --}}
@if (!empty($content->role_list))
    @php
        $perData = $content->permissionArray ?? '';
        $convertedArray = [];
        foreach ($perData as $sectionId => $sectionData) {
            foreach ($sectionData as $permissionId => $permissionData) {
                $convertedArray[$sectionId][$permissionId] = (array) $permissionData;
            }
        }
        //  dd($convertedArray);
    @endphp
    <form action="#" novalidate="" id="updateForm" class="needs-validation" novalidate> <input type="hidden"
            value="{{ $content->role_list->roles_id ?? '' }}" name="updateId">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" mb="20px"><label display="block" mb="5px"
                        for="name"><b><b>NAME:</b></b></label><input id="name" type="text"
                        class="form-control" placeholder="Enter your name" name="role_name"
                        value="{{ $content->role_list->roles_name ?? '' }}">
                </div>
            </div>
        </div>
        <div class="form-group" mb="20px"><label display="block" mb="5px"
                for="permissionList"><b><b>Permission:</b></b></label>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                    <div class="row">
                        @if (!empty($content->module_listItem->permission_list))
                            @foreach ($content->module_listItem->permission_list as $key => $per_list)
                                <div class="col-md-2 text-center text-uppercase"><b>
                                        {{ \App\Helper\Helper::translation($per_list->permissions_name) }}
                                    </b></div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
            <div class="row">
                @if (!empty($content->module_listItem->module_list))
                    @foreach ($content->module_listItem->module_list as $key => $module_list)
                        <div class="col-md-12">
                            <fieldset class="form-fieldset">
                                <legend>
                                    {{ \App\Helper\Helper::translation($module_list->module_name) }}
                                </legend>
                                <div class="row">
                                    @if (!empty($module_list->section_list))
                                        @foreach ($module_list->section_list as $key => $section)
                                            <div class="col-md-3"><label class="">
                                                    <h6>{{ \App\Helper\Helper::translation($section->section_name) }}
                                                    </h6>
                                                </label></div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    @if (!empty($content->module_listItem->permission_list))
                                                        @foreach ($content->module_listItem->permission_list as $key => $per_list)
                                                            <div class="col-md-2"><select
                                                                    name="permission_{{ $section->section_id }}_{{ $per_list->permissions_id }}"
                                                                    class="">

                                                                    <option value="">Select
                                                                    </option>


                                                                    @if (isset($per_list->allow_permission))
                                                                        @php

                                                                            if (isset($convertedArray[$section->section_id][$per_list->permissions_id])) {
                                                                                // Key exists, proceed with using it
                                                                                $permissionTypesId = $convertedArray[$section->section_id][$per_list->permissions_id]['permission_types_id'];
                                                                            } else {
                                                                                // Key does not exist, handle the case accordingly
                                                                            }

                                                                        @endphp
                                                                        @if (isset($convertedArray[$section->section_id][$per_list->permissions_id]))
                                                                            @foreach (json_decode($per_list->allow_permission, true) as $allowKey => $allowValue)
                                                                                @if (!empty($allowValue))
                                                                                    <option value="{{ $allowValue }}"
                                                                                        {{ $permissionTypesId == $allowValue ? 'selected' : '' }}>
                                                                                        {{ ucfirst($allowKey) }}
                                                                                    </option>
                                                                                @endif
                                                                            @endforeach
                                                                        @else
                                                                            @foreach (json_decode($per_list->allow_permission, true) as $allowKey => $allowValue)
                                                                                @if (!empty($allowValue))
                                                                                    <option
                                                                                        value="{{ $allowValue }}">
                                                                                        {{ ucfirst($allowKey) }}
                                                                                    </option>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    @endif

                                                                </select>

                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                            </fieldset>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
        <div class="col-md-4">
            <input type="submit" name="send" class="btn btn-primary updateButton"
                value="{{ __('common.update') }}">
        </div>
    </form>
@endif
@push('scripts')
    {{-- <script>
        $(document).ready(function() {

            // Add sender Ajax Start Here
            $(document).on("click", ".updateButton", function(e) {
                alert('ghh');
                console.log('ghh');
                e.preventDefault();

                // var EditSettingFormData = new FormData();
                // var formData = $('#settingForm').serialize();

                var addData = document.getElementById("updateForm");
                var formData = new FormData(addData);

                console.log(formData);
                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                // });
                // $.ajax({
                //     type: "POST",
                //     url: "{{ url('/user-manage/role/update') }}",
                //     data: formData,
                //     dataType: "json",
                //     cache: false,
                //     contentType: false,
                //     processData: false,
                //     success: function(response) {
                //         // if (response.status == 200) {
                //         //     Notify(response.message, true);

                //         // }

                //         Toaster('success', response.success);
                //         setTimeout(function() {
                //             location.reload(true);
                //         }, 3000);


                //     }
                // });

            });
        });
    </script> --}}
@endpush
