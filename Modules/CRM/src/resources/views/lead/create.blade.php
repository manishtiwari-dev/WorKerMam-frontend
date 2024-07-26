<x-app-layout>
    @section('title', 'Lead')
    <style>
        .tagselect .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            background: transparent;
            border: 0;
            opacity: 1;
            left: 0;
        }
    </style>
    <div class="contact-content">
        <div class="layout-specing">
            <div class="card contact-content-body">
                <form action="{{ route('crm.lead.store') }}" method="post" id="leadForm" class="needs-validation"
                    novalidate>
                    <!--------- Primary contact info area start here ------------>
                    <div class="card-header d-flex align-items-center justify-content-between py-2 px-3">
                        <h6 class="tx-15 mg-b-0">{{ __('crm.add_lead') }}</h6>
                    </div>
                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <fieldset class="form-fieldset">
                                <legend>{{ __('crm.primary_contact_info') }}</legend>
                                <div class="card-body pb-0">
                                    <div class="form-row">
                                        <div class="form-group col-md-4 col-4">
                                            <label for="date">{{ __('crm.date') }}</label>
                                            <input name="leave_date" value="{{\Carbon\Carbon::now()->format('m/d/Y')}}" id="from_date" type=""
                                                class="form-control @error('start_date') is-invalid @enderror datepicker1"
                                                placeholder="{{ __('seo.start_date_placeholder') }}"  >
                                        </div>
                                        <div class="form-group col-md-4 col-4">
                                            <label for="source_id">{{ __('crm.source') }}</label>
                                            <select class="form-select form-control select2" id="source_id" name="source_id"
                                                required>
                                                <option selected disable value="" disabled>
                                                    {{ __('crm.source_select') }}
                                                </option>

                                                @if (!empty($leadsource))
                                                    @foreach ($leadsource as $ls_data)
                                                        <option value="{{ $ls_data->source_id }}">
                                                            {{ $ls_data->source_name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="invalid-feedback">
                                                {{ __('crm.source_error') }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-4">
                                            <label for="industry_id">{{ __('crm.industry_type_group') }}</label>
                                            <select class="form-select form-control select2" name="industry_id" id="industry_id"
                                                required>
                                                <option selected disable value="" disabled>
                                                    {{ __('crm.industry_select') }}
                                                </option>

                                                @if (!empty($industrydata))
                                                    @foreach ($industrydata as $iData)
                                                        <option value="{{ $iData->id }}">
                                                            {{ $iData->group_name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="invalid-feedback">
                                                {{ __('crm.industry_error') }}
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-4 col-4">
                                            <div class="form-icon position-relative  mb-3 tagselect">
                                                <label> {{ __('crm.tags') }} </label>
                                                <select class="form-select form-control tagSelect select2"
                                                    multiple="multiple" id="tags"
                                                    aria-label="Default select example" name="tags[]">
                                                    <option value="" disabled>{{ __('crm.select_tag') }}</option>
                                                    @if ($crmtags != null)
                                                        @foreach ($crmtags as $key => $value)
                                                            <option value="{{ $value->tags_id }}">
                                                                {{ $value->tags_name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-4">
                                            <label for="contact_name">{{ __('crm.contact_name') }}</label>
                                            <input type="text" class="form-control" id="contact_name"
                                                name="contact_name" placeholder="{{ __('crm.contact_placeholder') }}"
                                                value="{{ old('contact_name') }}" required>
                                            <div class="invalid-feedback">
                                                {{ __('crm.name_error') }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-4">
                                            <label for="contact_email">{{ __('crm.contact_email') }}</label>
                                            <input type="email" class="form-control" id="contact_email"
                                                placeholder="{{ __('crm.email_placeholder') }}" name="contact_email"
                                                value="{{ old('contact_email') }}">
                                            <div class="invalid-feedback">
                                                {{ __('crm.email_error') }}
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4 col-4">
                                            <label for="phone">{{ __('crm.contact_phone') }}</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                placeholder="{{ __('crm.phone_placeholder') }}"
                                                value="{{ old('phone') }}">
                                            <div class="invalid-feedback">
                                                {{ __('crm.contact_name_error') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <!--end row-->
                    </div>
                    <!--------- Primary contact info area end here ------------>
                    <!--------- Additional contact info area start here ------------>
                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">

                            <fieldset class="form-fieldset">
                                <legend>{{ __('crm.additional_contact_info') }}</legend>
                                <div class="card-body pb-0">
                                    <div class="form-row">
                                        <div class="form-group col-md-6 col-6">
                                            <label for="company_name">{{ __('crm.company_name') }}</label>
                                            <input type="text" class="form-control" id="company_name" name="company"
                                                placeholder="Company Name" value="{{ old('company_name') }}">
                                            <div class="invalid-feedback">
                                                {{ __('crm.company_name_error') }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-6">
                                            <label for="website">{{ __('crm.website') }}</label>
                                            <input type="text" class="form-control" id="website" name="website"
                                                placeholder="{{ __('crm.website_placeholder') }} "
                                                value="{{ old('website') }}">
                                            <div class="invalid-feedback">
                                                {{ __('crm.website_error') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 col-6">
                                            <label for="website">{{ __('crm.street_address') }}</label>
                                            <input type="text" class="form-control" id="street_address"
                                                name="street_address"
                                                placeholder="{{ __('crm.street_address_placeholder') }}"
                                                value="{{ old('street_address') }}">
                                            <div class="invalid-feedback">
                                                {{ __('crm.street_address_error') }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-6">
                                            <label for="city">{{ __('crm.city') }}</label>
                                            <input type="text" class="form-control" id="city" name="city"
                                                placeholder="{{ __('crm.city_placeholder') }}"
                                                value="{{ old('city') }}">
                                            <div class="invalid-feedback">
                                                {{ __('crm.city_error') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 col-6">
                                            <label for="state">{{ __('crm.state') }}</label>
                                            <input type="text" class="form-control" id="state" name="state"
                                                placeholder="{{ __('crm.state_placeholder') }}"
                                                value="{{ old('state') }}">
                                            <div class="invalid-feedback">
                                                {{ __('crm.state_error') }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-6">
                                            <label for="source">{{ __('crm.zip') }}</label>
                                            <input type="text" class="form-control" id="zipcode" name="zipcode"
                                                placeholder="{{ __('crm.zip_placeholder') }}"
                                                value="{{ old('zipcode') }}">
                                            <div class="invalid-feedback">
                                                {{ __('crm.zip_error') }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label for="industry">{{ __('crm.country') }}</label>
                                            <select class="form-select form-control select2" id="country_code"
                                                name="countries_id">
                                                <option selected disable value="" disabled>
                                                    {{ __('crm.country_select') }}
                                                </option>
                                                @if (!empty($countrydata))
                                                    @foreach ($countrydata as $countries)
                                                        <option value="{{ $countries->countries_id }}">
                                                            {{ $countries->countries_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="invalid-feedback">
                                                {{ __('crm.country_error') }}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </fieldset>
                        </div>
                        <!--end row-->
                    </div>
                    <!--------- Additional contact info area start here ----------->
                    <!--------- Social contact info area start here ------------>
                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">

                            <fieldset class="form-fieldset">
                                <legend>{{ __('crm.social_contact_info') }}</legend>
                                <div class="card-body pb-0">
                                    <div class="" id="addMore">
                                        <div class="row">
                                            <div class="form-group col-md-5 col-5">
                                                <label for="website">{{ __('crm.social_type') }}</label>
                                                <select class="form-select form-control select2" name="social_type[]"
                                                    id="social_type">
                                                    <option selected disable value="" disabled>
                                                        {{ __('crm.social_type_select') }}</option>
                                                    <option value="1">WHATSAPP</option>
                                                    <option value="2">FACEBOOK</option>
                                                    <option value="3">INSTAGRAM</option>
                                                    <option value="4">LINKEDIN</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    {{ __('crm.social_type_select') }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-5 col-5">
                                                <label for="street_address">{{ __('crm.social_link') }}</label>
                                                <input type="text" class="form-control" id="social_link"
                                                    placeholder="{{ __('crm.social_placeholder') }}"
                                                    name="social_link[]" value="">
                                                <div class="invalid-feedback">
                                                    {{ __('crm.social_link_select') }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-2 col-2 plusbtn">
                                                <button class="btn btn-primary " type="button" id="add_more"><i
                                                        data-feather="plus"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <!--end row-->
                                </div>
                            </fieldset>
                        </div>
                        <!--end row-->
                    </div>
                    <div class="">
                        <div class="col-sm-12 mb-3 mx-3 p-0">
                            <input type="submit" id="submit" name="send" class="btn btn-primary"
                                value="Submit">
                            <a href="{{ route('crm.lead.index') }}" class="btn btn-secondary mx-1">Cancel</a>
                        </div>
                        <!--end col-->
                    </div>

                    <!--------- Social contact info area start here ----------->
                </form>

                <!--script start-->
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(function() {
                $('.datepicker1').datepicker({
                    multidate: true,
                    format: 'dd/mm/yy'
                    // onSelect: function() {
                    //     var selected = $(this).datepicker("getDate");
                    // }
                });

            });
            $('.select2').select2({});
            $(document).ready(function() {
                var i = 1;
                $('#add_more').click(function(e) {
                    e.preventDefault();
                    i++;
                    html = `<div class="row" id="row${i}">
                            <div class="form-group col-md-5 col-5">
                                <select class="form-select form-control select2" name="social_type[]" id="social_type">
                                    <option selected disable value="" disabled>{{ __('crm.social_type_select') }}</option>
                                    <option value="1">WHATSAPP</option>
                                    <option value="2">FACEBOOK</option>
                                    <option value="3">INSTAGRAM</option>
                                    <option value="4">LINKEDIN</option>
                                </select>
                                <div class="invalid-feedback">
                                    {{ __('crm.social_type_select') }}
                                </div>
                            </div>
                            <div class="form-group col-md-5 col-5">
                                <input type="text" class="form-control" id="social_link" placeholder="{{ __('crm.source') }}Social Link" name="social_link[]" value="" >
                                <div class="invalid-feedback">
                                    {{ __('crm.social_link_select') }}
                                </div>
                            </div>
                            <div class="form-group col-md-2 col-2">
                                <div class="btn_remove btn btn-danger" id="${i}" type="button">X</div>
                            </div>
                        </div>`;
                    $('#addMore').append(html);
                });

                $(document).on('click', '.btn_remove', function() {
                    var button_id = $(this).attr("id");
                    $('#row' + button_id + '').remove();
                });

                $(document).on('click', '.remove', function() {
                    var button_id = $(this).attr("id");
                    $('#row' + button_id + '').remove();
                });
                $('#addLeadBtn').on("click", function() {
                    $('#leadForm').addClass('was-validated');
                    if ($('#leadForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        $('#leadForm').submit();
                    }
                });
            });
        </script>
        
    @endpush
    <!-- script end-->
</x-app-layout>
