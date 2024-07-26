<x-app-layout>
    @section('title', 'Lead')

    @if (!empty($lead) && !empty($leadSource) && !empty($industry) && !empty($socialLink) && !empty($country))
        <form action="{{ route('crm.lead-followup.update', $lead->lead_id) }}" method="post" id="leadForm"
            class="needs-validation" novalidate>
            @csrf
            @method('put')
            <!--------- Primary contact info area start here ------------>
            <div class="card">
                <div class="tab-content">
                    <div class="card-header d-flex align-items-center justify-content-between py-3 px-3">
                        <h5 class="tx-15 mb-0">{{ __('crm.primary_contact_info') }}</h5>

                    </div>
                    <div class="card-body pb-0">
                        <div class="form-row">
                            <div class="form-group col-md-6 col-6">
                                <label for="source">{{ __('crm.source') }}</label>
                                <select class="form-select form-control select2" id="source_id" name="source_id" required>
                                    <option selected disable value="" disabled>{{ __('crm.source_select') }}
                                    </option>

                                    @if (!empty($leadSource))
                                        @foreach ($leadSource as $ls_data)
                                            @php
                                                $selected = '';
                                                if ($ls_data->source_id == $lead->source_id) {
                                                    $selected = 'selected';
                                                }
                                            @endphp

                                            <option value="{{ $ls_data->source_id }}" {{ $selected }}>
                                                {{ $ls_data->source_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="invalid-feedback">
                                    {{ __('crm.source_error') }}
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label for="industry">{{ __('crm.industry_type_group') }}</label>
                                <select class="form-select form-control select2" name="industry_id" id="industry_id" required>
                                    <option selected disable value="" disabled>{{ __('crm.industry_select') }}
                                    </option>

                                    @if (!empty($industry))
                                        @foreach ($industry as $iData)
                                            @php
                                                $selected = '';
                                                if ($iData->industry_id == $lead->industry_id) {
                                                    $selected = 'selected';
                                                }
                                            @endphp

                                            <option value="{{ $iData->industry_id }}" {{ $selected }}>
                                                {{ $iData->industry_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="invalid-feedback">
                                    {{ __('crm.industry_error') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 col-4">@dd($lead)
                                <label for="inputEmail4">{{ __('crm.contact_name') }}</label>
                                <input type="text" class="form-control" id="contact_name" name="contact_name"
                                    placeholder="{{ __('crm.contact_placeholder') }}"
                                    value="{{ $lead->contact_name }}" required>
                                <div class="invalid-feedback">
                                    {{ __('crm.name_error') }}
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-4">
                                <label for="username">{{ __('crm.contact_email') }}</label>
                                <input type="email" class="form-control" id="contact_email"
                                    placeholder="{{ __('crm.email_placeholder') }}" name="contact_email"
                                    value="{{ $lead->contact_email }}" required="">
                                <div class="invalid-feedback">
                                    {{ __('crm.email_error') }}
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-4">
                                <label for="username">{{ __('crm.contact_phone') }}</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="{{ __('crm.phone_placeholder') }}" value="{{ $lead->phone }}"
                                    required>
                                <div class="invalid-feedback">
                                    {{ __('crm.contact_name_error') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
            <!--------- Primary contact info area end here ------------>
            <!--------- Additional contact info area start here ------------>
            <div class="card mt-4">
                <div class="tab-content">
                    <div class="card-header d-flex align-items-center justify-content-between py-3 px-3">
                        <h5 class="tx-15 mb-0">{{ __('crm.additional_contact_info') }}</h5>
                    </div>
                    <div class="card-body pb-0">
                        <div class="form-row">

                            @foreach ($lead->crm_lead_contact as $lcontact)
                                @php
                                    $selected_website = $lcontact->website;
                                    $selected_address = $lcontact->street_address;
                                    $selected_city = $lcontact->city;
                                    $selected_state = $lcontact->state;
                                    $selected_zipcode = $lcontact->zipcode;
                                    $selected_countryId = $lcontact->countries_id;
                                    
                                @endphp
                            @endforeach

                            <div class="form-group col-md-6 col-6">
                                <label for="website">{{ __('crm.website') }}</label>
                                <input type="text" class="form-control" id="website" name="website"
                                    placeholder="{{ __('crm.website_placeholder') }} "
                                    value="{{ $selected_website }}">
                                <div class="invalid-feedback">
                                    {{ __('crm.website_error') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6 col-6">
                                <label for="street_address">{{ __('crm.street_address') }}</label>
                                <input type="text" class="form-control" id="street_address" name="street_address"
                                    placeholder="{{ __('crm.street_address_placeholder') }}"
                                    value="{{ $selected_address }}">
                                <div class="invalid-feedback">
                                    {{ __('crm.street_address_error') }}
                                </div>
                            </div>

                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-6 col-6">
                                <label for="city">{{ __('crm.city') }}</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    placeholder="{{ __('crm.city_placeholder') }}" value="{{ $selected_city }}">
                                <div class="invalid-feedback">
                                    {{ __('crm.city_error') }}
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label for="state">{{ __('crm.state') }}</label>
                                <input type="text" class="form-control" id="state" name="state"
                                    placeholder="{{ __('crm.state_placeholder') }}" value="{{ $selected_state }}">
                                <div class="invalid-feedback">
                                    {{ __('crm.state_error') }}
                                </div>
                            </div>

                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-6 col-6">
                                <label for="source">{{ __('crm.zip') }}</label>
                                <input type="text" class="form-control" id="zipcode" name="zipcode"
                                    placeholder="{{ __('crm.zip_placeholder') }}" value="{{ $selected_zipcode }}">
                                <div class="invalid-feedback">
                                    {{ __('crm.zip_error') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6 col-6">
                                <label for="industry">{{ __('crm.country') }}</label>
                                <select class="form-select form-control select2" id="country_code" name="country_code">
                                    <option selected disable value="" disabled>{{ __('crm.country_select') }}
                                    </option>
                                    <option value="">No country</option>
                                    @if (!empty($country))
                                        @foreach ($country as $countries)
                                            @php
                                                $selected = '';
                                                if ($countries->countries_id == $selected_countryId) {
                                                    $selected = 'selected';
                                                }
                                            @endphp

                                            <option value="{{ $countries->countries_id }}" {{ $selected }}>
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
                </div>
                <!--end row-->
            </div>
            <!--------- Additional contact info area start here ----------->
            <!--------- Social contact info area start here ------------>
            <div class="card mt-4">
                <div class="tab-content">
                    <div class="card-header d-flex align-items-center justify-content-between py-3 px-3">
                        <h5 class="tx-15 mb-0">{{ __('crm.social_contact_info') }}</h5>
                    </div>
                    <div class="card-body pb-0">
                        <div class="" id="addMore">
                            <div class="row">

                                @foreach ($lead->socialLink as $lcontact)
                                    @php
                                        $selected_socialType = $lcontact->social_type;
                                        $selected_socialLink = $lcontact->social_link;
                                        
                                    @endphp
                                @endforeach

                                <div class="form-group col-md-5 col-5">
                                    <label for="website">{{ __('crm.social_type') }}</label>
                                    <select class="form-select form-control select2" name="social_type[]" id="social_type">
                                        <option selected disable value="" disabled>
                                            {{ __('crm.social_type_select') }}</option>

                                        <option value="1" {{ $selected_socialType == 1 ? 'selected' : '' }}>
                                            WHATSAPP</option>
                                        <option value="2" {{ $selected_socialType == 2 ? 'selected' : '' }}>
                                            FACEBOOK</option>
                                        <option value="3" {{ $selected_socialType == 3 ? 'selected' : '' }}>
                                            INSTAGRAM</option>
                                        <option value="4" {{ $selected_socialType == 4 ? 'selected' : '' }}>
                                            LINKEDIN</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ __('crm.social_type_select') }}
                                    </div>
                                </div>
                                <div class="form-group col-md-5 col-5">
                                    <label for="street_address">{{ __('crm.social_link') }}</label>
                                    <input type="text" class="form-control" id="social_link"
                                        placeholder="{{ __('crm.source') }}Social Link" name="social_link[]"
                                        value="{{ $selected_socialLink }}">
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
                        <div class="">
                            <div class="col-sm-12 mb-3 mx-3 p-0">
                                <input type="submit" id="submit" name="send" class="btn btn-primary"
                                    value="Submit">
                                <a href="{{ route('crm.lead-followup.index') }}"
                                    class="btn btn-secondary mx-1">Cancel</a>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                </div>
                <!--end row-->
            </div>
            <!--------- Social contact info area start here ----------->
        </form>
    @endif
    <!-- script start -->
    @push('scripts')
        <script>
            $(document).ready(function() {
                var i = 1;
                $('#add_more').click(function(e) {
                    e.preventDefault();
                    i++;
                    html = `<div class="row" id="row${i}">
                        <div class="form-group col-md-5 col-5">
                            <select class="form-select form-control select2" name="social_type[]" id="social_type" >
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
