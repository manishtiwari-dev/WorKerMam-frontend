<x-app-layout>
    @section('title', 'General Setting')

    <div class="contact-content">
        <div class="layout-specing">
           
            <div class="card contact-content-body">
                <form action="{{ route('seo.website.update', $web_setting->id) }}" id="userForm" method="POST"
                    class="needs-validation" novalidate>
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="card-header ">
                        <div class="d-flex align-items-center justify-content-between py-3 px-3">
                            <h6 class="tx-15 mg-b-0">{{ __('seo.seo_website_edit') }} </h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.website_name') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input name="website_name" value="{{ $web_setting->website_name }}"
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
                                        <input name="website_url" value="{{ $web_setting->website_url }}"
                                            id="website_url" type="text"
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
                                    <input name="start_date"
                                        value="{{ \Carbon\Carbon::parse($web_setting->start_date)->format('d/m/Y') }}"
                                        id="" type=""
                                        class="form-control datepicker1 @error('start_date') is-invalid @enderror"
                                        placeholder="{{ __('seo.start_date_placeholder') }}" required>
                                    <div class="invalid-feedback">
                                        <p>{{ __('seo.start_date_error') }}</p>
                                    </div>
                                </div>


                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.end_date') }}</label>
                                    <input name="end_date"
                                        value="@if ($web_setting->end_date != null) {{ \Carbon\Carbon::parse($web_setting->end_date)->format('d/m/Y') }} @endif"
                                        id="" type=""
                                        class="form-control datepicker1 @error('end_date') is-invalid @enderror"
                                        placeholder="{{ __('seo.start_date_placeholder') }}">
                                    <div class="invalid-feedback">
                                        <p>{{ __('seo.end_date_error') }}</p>
                                    </div>
                                </div>


                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.country') }} <span
                                            class="text-danger">*</span></label>
                                    <select class=" form-control @error('countries_id') is-invalid @enderror select2"
                                        name="countries_id" aria-label="Default select example" required>
                                        <option selected disabled value="">{{ __('seo.select_country') }}
                                        </option>
                                        @foreach ($country as $con)
                                            <option value="{{ $con->countries_id }}"
                                                {{ $con->countries_id == $web_setting->countries_id ? 'selected' : '' }}>
                                                {{ $con->countries_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>{{ __('seo.country_error') }}</p>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.subscriber') }} </label>
                                    <select name="subscription_id"
                                        class="form-control @error('subscription_id') is-invalid @enderror select2"
                                        name="subscription_id" aria-label="Default select example">
                                        <option selected disabled value="">{{ __('seo.select_subscriber') }}
                                        </option>
                                        @foreach ($subslist as $sub)
                                            <option value="{{ $sub->subscription_id }}"
                                                {{ $sub->subscription_id == $web_setting->subscription_id ? 'selected' : '' }}>
                                                {{ $sub->subscriber_business->business_name }}/{{ $sub->subscriber_business->business_unique_id }}/{{ $sub->subscriber_business->business_email }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.status') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="status"
                                        class="form-control select2 @error('subscription_id') is-invalid @enderror"
                                        name="subscription_id" aria-label="Default select example">
                                        <option selected disabled value="">{{ __('seo.select_status') }}
                                        </option>
                                        <option value="1" {{ $web_setting->status == 1 ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="0" {{ $web_setting->status == 0 ? 'selected' : '' }}>
                                            Deactive</option>
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
                $('.datepicker1').datepicker({
                    dateFormat: 'dd/mm/yy',
                    onSelect: function() {
                        var selected = $(this).datepicker("getDate");
                    }
                });

            });
        </script>
        <script type="text/javascript">
            $('.select2').select2({
                searchInputPlaceholder: 'Search options'
            });


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
