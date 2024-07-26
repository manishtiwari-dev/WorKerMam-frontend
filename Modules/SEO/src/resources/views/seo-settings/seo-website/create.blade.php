<x-app-layout>
    @section('title', 'General Setting')

    <div class="contact-content">
        <div class="layout-specing">
           
            <div class="card contact-content-body">
                <form action="{{ route('seo.website.store') }}" id="userForm" method="POST" class="needs-validation"
                    novalidate>

                    <div class="card-header ">
                        <div class="d-flex align-items-center justify-content-between py-2 px-3 ">
                            <h6 class="tx-15 mg-b-0">{{ __('seo.seo_website_form') }} </h6>

                        </div>
                    </div>
                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.website_name') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input name="website_name" value="{{ old('website_name') }}" id="seo_task_title"
                                            type="text"
                                            class="form-control @error('website_name') is-invalid @enderror"
                                            placeholder="{{ __('seo.website_name_placeholder') }}" required>
                                        <div class="invalid-feedback">
                                            <p>{{ __('seo.website_name_error') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.website_url') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input name="website_url" value="{{ old('website_url') }}" id="seo_task_title"
                                            type="text"
                                            class="form-control @error('website_url') is-invalid @enderror"
                                            placeholder="{{ __('seo.website_url_placeholder') }}" required>
                                        <div class="invalid-feedback">
                                            <p>{{ __('seo.website_url_error') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.start_date') }} <span
                                            class="text-danger">*</span></label>
                                    <input name="start_date" value="{{ old('start_date') }}" id="datepicker1"
                                        type="" class="form-control @error('start_date') is-invalid @enderror"
                                        placeholder="{{ __('seo.start_date_placeholder') }}" required>
                                    <div class="invalid-feedback">
                                        <p>{{ __('seo.start_date_error') }}</p>
                                    </div>
                                </div>



                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.country') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="countries_id"
                                        class="form-control select2 @error('countries_id') is-invalid @enderror "
                                        name="country" required>
                                        <option selectedx value="">{{ __('seo.select_country') }} </option>
                                        @foreach ($country_list as $country)
                                            <option value="{{ $country->countries_id }}">
                                                {{ $country->countries_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>{{ __('seo.country_error') }}</p>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.subscriber') }} </label>
                                    <select name="subscription_id"
                                        class="form-control select2 @error('subscription_id') is-invalid @enderror  "
                                        name="subscription_id" aria-label="Default select example">
                                        <option selected disabled value="">{{ __('seo.select_subscriber') }}
                                        </option>
                                        @foreach ($subslist as $sub)
                                            <option value="{{ $sub->subscription_id }}">
                                                {{ $sub->subscriber_business->business_name }}/{{ $sub->subscriber_business->business_unique_id }}/{{ $sub->subscriber_business->business_email }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <!--end row-->
                        <div class="mt-3">
                            <div class="col-sm-12 p-0">
                                <input type="submit" id="submit" name="send" class="btn btn-primary"
                                    value="Submit">
                                <a href="{{ route('seo.workReport') }}" class="btn btn-secondary mx-1">Cancel</a>

                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>

            </div>

            </form>
        </div>
    </div>
    </div>


    @push('scripts')
        <script>
            $(function() {
                $('#datepicker1').datepicker({
                    dateFormat: 'dd/mm/yy',
                    onSelect: function() {
                        var selected = $(this).datepicker("getDate");
                    }
                });

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
