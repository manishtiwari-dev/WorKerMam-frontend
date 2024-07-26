@php
    
    $api_token = request()->cookie('api_token');
    
    $userdata = Cache::get('userdata-' . $api_token);
    
@endphp

<x-app-layout>
    @section('title', 'Work Report')

    <div class="contact-content">
        <div class="layout-specing">
           
            <form action="{{ route('seo.work-report.import.store') }}" id="import-work-report-data-form"
                enctype="multipart/form-data" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="card contact-content-body">

                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h6 class="tx-15 mg-b-0">{{ __('seo.import_work_report') }} </h6>
                        </div>
                    </div>

                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <div class="form-row">
                                @if ($userdata->role == 'super_admin' || $userdata->role == 'seomanager')
                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.website_name') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <select
                                            class=" form-control @error('website_id') is-invalid @enderror select2"
                                            name="website_id" id="website_id" aria-label="Default select example"
                                            required>
                                            <option selected disabled value="">{{ __('common.select_website') }}
                                            </option>
                                            @foreach ($website_list as $website)
                                                <option value="{{ $website->id }}">
                                                    {{ $website->website_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            <p>Please select website</p>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.website_name') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <select
                                            class=" form-control @error('website_id') is-invalid @enderror select2"
                                            name="website_id" id="website_id" aria-label="Default select example"
                                            required>
                                            <option selected disabled value="">{{ __('common.select_website') }}
                                            </option>
                                            @foreach ($website_list as $website)
                                                <option value="{{ $website[0]->id }}">
                                                    {{ $website[0]->website_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            <p>Please select website</p>
                                        </div>
                                    </div>
                                </div>
                                @endif




                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.seo_task') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <select
                                            class="form-control @error('seo_task_id') is-invalid @enderror select2"
                                            name="seo_task_id" id="seo_task_id" aria-label="Default select example"
                                            required>
                                            <option selected disabled value="">Select Task</option>
                                            @foreach ($seo_task_list as $seo_list)
                                                <option value="{{ $seo_list->id }}">{{ $seo_list->seo_task_title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            <p>Please select task</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label
                                        class="form-label">{{ __('seo.upload_file') }}({{ __('seo.field_type') }})</label>
                                    <input type="file" name="import_file"
                                        data-allowed-file-extensions="xls xlsx csv txt" id="work_report_import"
                                        class="form-control  dropify">
                                </div>
                            </div>
                        </div>
                        <!--end row-->

                        <div class="mt-3">
                            <div class="col-sm-12 p-0">
                                <input type="submit" id="import-work-report-form" name="send" class="btn btn-primary"
                                    value="{{ __('seo.upload') }}">
                                <a href="{{ route('seo.work-report.index') }}"
                                    class="btn btn-light mx-1">{{ __('common.cancel') }} </a>
                            </div>
                            <!--end col-->
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>



</x-app-layout>
