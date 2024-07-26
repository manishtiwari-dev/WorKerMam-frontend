<x-app-layout>
    @section('title', 'Import Job Application')

    <div class="contact-content">
        <div class="layout-specing">
            <form action="{{route('recruit.job-application-import-store')}}" id="import-work-report-data-form" enctype="multipart/form-data" method="POST"
                class="needs-validation" novalidate>
                @csrf
                <div class="card contact-content-body">

                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h6 class="tx-15 mg-b-0">Import Job Application</h6>
                        </div>
                    </div>

                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <div class="form-row">
                                <div class="form-group col-md-6">

                                    <label class="form-label">Jobs <span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">

                                        <select class=" form-control @error('jobs') is-invalid @enderror selectsearch"
                                            name="jobs" id="jobs" aria-label="Default select example" required>
                                            <option selected disabled value="">Select Jobs
                                            </option>
                                            @if (!empty($jobs))
                                                @foreach ($jobs as $job)
                                                    <option value="{{ $job->id }}">
                                                        {{ $job->title }}({{ $job->location->location ?? '' }})</option>
                                                @endforeach
                                            @endif

                                        </select>
                                        <div class="invalid-feedback">
                                            <p>Please select jobs</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label class="form-label">Upload File ({{ __('seo.field_type') }})</label>
                                    <input type="file" name="import_file"
                                        data-allowed-file-extensions="xls xlsx csv txt"
                                        id="job-application_report_import" class="form-control ps-5 dropify">
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>


                </div>
                <div class="mt-3">
                    <div class="col-sm-12 p-0">
                        <input type="submit" id="import-work-report-form" name="send" class="btn btn-primary"
                            value="{{ __('seo.upload') }}">
                        <a href="{{ route('recruit.job-applications.index') }}"
                            class="btn btn-light mx-1">{{ __('common.cancel') }} </a>
                    </div>
                    <!--end col-->
                </div>
            </form>
        </div>
    </div>


    @push('scripts')
        <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
        <script>
            $('.dropify').dropify();
        </script>
        <script>
            $('.selectsearch').select2({
                searchInputPlaceholder: 'Search options'
            });
        </script>
    @endpush

</x-app-layout>
