<x-app-layout>
    @section('title', 'General Setting')
    <style>
        .skillselect .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            background: transparent;
            border: 0;
            opacity: 1;
            left: 0;
        }
    </style>
    <div class="contact-content">
        <div class="layout-specing">
           
            
            <div class="card">
                <form id="save-website-data" method="post">

                <div class="tab-content">
                    <div class="card-header">
                        <div class="row">
                            <h6 class="tx-15 mg-b-0">{{ $website_listing->website_name }}</h6>
                        </div>
                    </div>

                    <div class="card-body d-flex pb-0">
                        <label class="form-label  my-2">Assign User</label>
                        <div class=" col-md-4 d-flex skillselect">
                            <select class="form-select form-control  select2" multiple="multiple" id="tags"
                            aria-label="Default select example"  name="user_id[]">
                            <option disabled value="">{{ __('seo.select_user') }}
                            </option>
                            @foreach ($userlist as $user)
                                <option value="{{ $user->id }}">
                                      @if(!empty($website_listing->assign_user))
                                    @foreach ($website_listing->assign_user as $assigneduser)
                                    <option value="{{ $user->id }}"
                                        {{ $user->id == $assigneduser->user_id ? 'selected' : '' }}>
                                        {{ $user->first_name }}</option>
                                    @endforeach   
                                    @endif
                            @endforeach
                        </select>
                            {{-- <select class=" form-control @error('countries_id') is-invalid @enderror select2"
                                name="user_id[]" multiple="multiple" aria-label="Default select example" required>
                               
                            </select> --}}
                        </div>
                    </div>



                    <div class="card-body">
                        {{-- <form id="save-website-data" method="post"> --}}


                            <div class="table-responsive" id="department">
                                <table class="table  table_wrapper">
                                    <thead>
                                        <tr>
                                            <th class="wd-10p">{{ __('common.sl_no') }}</th>
                                            <th class="wd-20p">{{ __('seo.task_title') }}</th>
                                            <th class="wd-10p">{{ __('seo.submission_no') }}</th>
                                            <th class="wd-20p">{{ __('seo.task_frequency') }}</th>
                                            <th class="wd-10p">{{ __('common.status') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @php
                                            $k = 1;
                                        @endphp

                                        @foreach ($seo_task_listing as $key => $seo_task)
                                            <tr>
                                                <td class="">{{ $k++ }}</td>
                                                <td>{{ ucwords($seo_task->seo_task_title) }}</td>
                                                <td class="">
                                                    @php
                                                        $submission_no = $seo_task->no_of_submission;
                                                    @endphp


                                                    <select class="form-select form-control select-picker select2"
                                                        id="status" name="no_of_submission_{{ $seo_task->id }}"
                                                        aria-label="Default select example">
                                                        <option selected for="Select">{{ __('seo.select') }}</option>

                                                        @for ($a = 1; $a <= $submission_no; $a++)
                                                            <option value="{{ $a }}"
                                                                @if (!empty($seo_task->taskData)) {{ $a == $seo_task->taskData->no_of_submission ? 'selected' : '' }} @endif>
                                                                {{ $a }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </td>

                                                <td>
                                                    @if (!empty($seo_task->task_frequency == 1))
                                                        Daily
                                                    @elseif(!empty($seo_task->task_frequency == 2))
                                                        Weekly Once
                                                    @elseif(!empty($seo_task->task_frequency == 3))
                                                        Weekly Twice
                                                    @elseif(!empty($seo_task->task_frequency == 4))
                                                        Weekly Thrice
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        @php
                                                            if ($seo_task->taskData != null) {
                                                                $checked = $seo_task->taskData->status;
                                                            } else {
                                                                $checked = $seo_task->status;
                                                            }
                                                        @endphp
                                                        <input type="checkbox"
                                                        {{-- name="task_active_{{ $seo_task->id }}" --}}
                                                            class="custom-control-input task_toggle_class"
                                                            {{ $checked == '1' ? 'checked' : '' }}
                                                            data-id="{{ $seo_task->id }}"
                                                            id="customSwitch{{ $seo_task->id }}">
                                                        <label class="custom-control-label"
                                                            for="customSwitch{{ $seo_task->id }}"></label>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                        <input type="hidden" name="website_id" value="{{ $website_listing->id }}">
                                    </tbody>

                                </table>
                            </div>
                            <div class="mt-3 px-2 ">
                                <div class="col-sm-12 p-0">
                                    <input type="button" class="btn btn-primary  save-website-form" form-id=""
                                        value="{{ __('common.update') }}" />

                                    <a href="{{ route('seo.workReport') }}" class="btn btn-secondary mx-1">Cancel</a>
                                </div>
                            </div>

                        {{-- </form> --}}
                    </div>

                </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $('.select2').select2({
                searchInputPlaceholder: 'Select User'
            });


            $(document).ready(function() {
                $('.save-website-form').click(function() {
                    const url = "{{ route('seo.task_manage_update', $website_listing->id) }}";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url,
                        container: '#save-website-data',
                        type: "POST",
                        data: $('#save-website-data').serialize(),
                        success: function(response) {
                            console.log(response);
                            if (response.success) {
                                toastr.success(response.success);
                            } else {
                                toastr.error(response.error);
                            }
                            location.reload();

                        }
                    })
                });



                //task status change jquery
                $('.task_toggle_class').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 0;
                    let task_id = $(this).data('id');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('seo.changeTaskManageStatus') }}",
                        data: {
                            'status': status,
                            'id': task_id
                        },
                        success: function(response) {
                            // console.log(response);
                            Toaster(response.success);
                        }
                    });
                });






            });
        </script>
    @endpush


</x-app-layout>
