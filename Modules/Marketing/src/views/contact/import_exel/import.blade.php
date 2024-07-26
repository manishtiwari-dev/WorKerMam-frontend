<x-app-layout>
    @section('title', 'Contact')
    <div class="contact-content">
        <div class="layout-specing">
            <form action="{{ route('marketing.contact-import-upload') }}" id="import-work-report-data-form"
                enctype="multipart/form-data" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="card contact-content-body">

                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h6 class="tx-15 mg-b-0">{{ __('newsletter.import_contacts') }} </h6>
                        </div>
                    </div>

                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label class="form-label">{{ __('newsletter.contact_group') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <select class=" form-control @error('contact_group') is-invalid @enderror select2"
                                            name="contact_group" id="contact_group" aria-label="Default select example"
                                            required>
                                            <option selected disabled value="">
                                                {{ __('newsletter.select_contact_group') }}
                                            </option>
                                           
                                            @if (!empty($group_data))
                                                @foreach ($group_data as $group)
                                                    <option value="{{ $group->id }}" {{ $group->id==$group_id ?'selected' : ''}}>{{ $group->group_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('contact_group')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        <div class="invalid-feedback">
                                            <p>Please select contact group</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="work_report_import" class="form-label">{{ __('newsletter.upload_file') }}({{ __('seo.field_type') }})</label>
                                    <div class="custom-file">
                                        <input  type="file" name="import_file" accept="xls,xlsx,csv" id="work_report_import" class="custom-file-input" required>
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        
                                        <div class="invalid-feedback">
                                            <p>Please upload a file</p>
                                        </div>
                                    </div>
                                      @error('import_file')
                                        <p class="text-danger">{{ $message }}</p>
                                      @enderror
                                </div>
                                
                                <div class="form-group col-lg-12 col-sm-12  p-2 text-lg-left text-md-left">
                                    <a href="{{route('marketing.simple-download-file')}}" class="btn-light btn text-dark "><b>Download Sample File</b></a>
                                </div>

                            </div>
                        </div>
                        <!--end row-->

                        <div class="mb-3">
                            <div class="col-sm-12">
                                <input type="submit" id="import-work-report-form"  class="btn btn-primary"
                                    value="{{ __('seo.upload') }}">
                                <a href="javascript:void()" onclick="history.back()"
                                    class="btn btn-secondary mx-1">{{ __('common.cancel') }} </a>
                            </div>
                        </div>
                        
                    </div>
                </div>
               
            </form>
        </div>
    </div>
</x-app-layout>
