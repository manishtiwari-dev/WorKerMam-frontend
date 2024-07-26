@php
    
    $api_token = App\Helper\Helper::getCurrentuserToken();
    $userdata = Cache::get('userdata-' . $api_token);
    
@endphp

<x-app-layout>
    @section('title', 'Salary')
    <div class="contact-content">
        <div class="layout-specing">
            <div class="card contact-content-body">
                <form action="{{ route('hrm.import-store') }}" id="userForm" method="POST" class="needs-validation"
                    novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="card-header d-flex align-items-center justify-content-between py-3  px-3">
                        <h6 class="tx-15 mb-0">{{ __('hrm.staff_import') }}</h6>
                    </div>
                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <div class="form-row row align-items-center">
                            <div class="form-group col-md-6 col-lg-6">
                                    <label class="form-label">{{ __('hrm.import') }} <span
                                                class="text-danger mg-l-5">*</span></label>
                                     <input type="file" name="importFile" class="form-control" required/>

                                    <div class="invalid-feedback">
                                          {{ __('hrm.import_error') }}
                                    </div>
                              </div>
                              <div class="form-group col-md-6 col-lg-6  justify-content-center">
                                <div class="d-flex gap-2 align-items-center">
                                    <div>For sample File</div>
                                    <a href="{{ route('hrm.download-file') }}" class="btn btn-primary ">Download Now</a>
                                </div>
                               </div>   
                            </div>
                        </div>
                        <div class="">
                            <div class="col-sm-12 mb-3 mx-3 p-0">
                                <input type="submit" id="submit" name="send" class="btn btn-primary" value="Submit"> 
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script> 
            
        </script> 
    @endpush
</x-app-layout>
