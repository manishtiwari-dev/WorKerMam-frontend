<x-app-layout>
    @section('title', 'Add Customer')

    <div class="contact-content">
        <div class="layout-specing">
            <div class="card contact-content-body">
                <form action="{{ route('sales.customer.store') }}" id="userForm" method="POST" class="needs-validation"
                    novalidate>
                    @csrf
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h6 class="tx-15 mg-b-0">{{ __('crm.add_customer') }}</h6>

                    </div>
                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms pt-2">
                            <fieldset class="form-fieldset">
                                <legend>{{ __('crm.primary_contact_info') }}</legend>
                                <div class="form-row row">
                                    <div class="form-group col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.lead') }}</label>
                                        <select class="form-control form-select select2 @error('lead_id') is-invalid @enderror "
                                            name="lead_id" id="cust_lead_id">
                                            <option selected value="" >Select Lead</option>
                                            @forelse ($lead as $leads)
                                                <option value="{{ $leads->lead_id }}">
                                                    {{ $leads->contact_name }} - {{$leads->contact_email }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                        <div class="invalid-feedback">
                                            {{ __('crm.source_error') }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.customer_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            placeholder="{{ __('crm.customer_name_placeholder') }}" required>
                                        <div class="invalid-feedback">
                                            {{ __('crm.customer_name_error') }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.email') }}<span class="text-danger">*</span></label>
                                        <input type="email" id="email" class="form-control"
                                            placeholder="{{ __('crm.customer_email_placeholder') }}" name="email"
                                            required>
                                        <div class="invalid-feedback">
                                            {{ __('crm.customer_email_error') }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.contact_phone') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ __('crm.phone_placeholder') }}" name="contact"
                                            id="contact_phone">
                                        <div class="invalid-feedback">
                                            {{ __('crm.contact_name_error') }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.website') }}</label>
                                        <input type="text" class="form-control" id="website" name="website"
                                            placeholder="{{ __('crm.website_placeholder') }}">
                                        <div class="invalid-feedback">
                                            {{ __('crm.website_error') }}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-12">
                                        <label class="form-label">{{ __('crm.company_name') }}</label>
                                        <input type="text" class="form-control" id="company_name" name="company_name"
                                            placeholder="{{ __('crm.company_name_placeholder') }}">
                                        <div class="invalid-feedback">
                                            {{ __('crm.company_name_error') }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.gender') }}</label>
                                        <select class="form-select form-control select2 @error('lead_id') is-invalid @enderror"
                                            name="gender" id="gender">
                                            <option selected value="" disabled>
                                                {{ __('crm.gender_select') }}</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            <option value="3">Other</option>

                                        </select>
                                        <div class="invalid-feedback">
                                            {{ __('crm.gender_select') }}
                                        </div>
                                    </div>


                                    <input type="hidden" name="cust" value="1">
                                    <div class="form-group col-lg-4 col-md-6  col-12">
                                        <label class="form-label">Tax Id</label>
                                        <input type="text" name="tax_id" placeholder="Enter Tax Id" class="form-control">
                                    </div>

                                </div>
                            </fieldset>

                        </div>
                    </div>


                    <div class="card-body mt-2">
                        <div data-label="Example" class="df-example demo-forms pt-2">
                            <fieldset class="form-fieldset">
                                <legend>{{ __('crm.address_info') }}</legend>
                                <div class="form-row row">

                                    <div class="form-group col-lg-4 col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.street_address') }}</label>
                                        <input type="text" class="form-control" name="street_address"
                                            placeholder="{{ __('crm.street_address_placeholder') }}" id="street_address"
                                            value="">
                                        <div class="invalid-feedback">
                                            {{ __('crm.street_address_error') }}
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.city') }}</label>
                                        <input type="text" class="form-control" id="city" name="city"
                                            placeholder="{{ __('crm.city_placeholder') }}">
                                        <div class="invalid-feedback">
                                            {{ __('crm.city_error') }}
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.state') }}</label>
                                        <input type="text" class="form-control" id="state" name="state"
                                            placeholder="{{ __('crm.state_placeholder') }}">
                                        <div class="invalid-feedback">
                                            {{ __('crm.state_error') }}
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.country') }}</label>
                                        <select
                                            class="form-control select2 @error('countries_id') is-invalid @enderror "
                                            name="countries_id" id="countries_id">
                                            <option selected disable disabled value="">
                                                    {{ __('crm.country_select') }}</option>
                                            @if (!empty($country))
                                            @foreach ($country as $countries)
                                            <option value="{{ $countries->countries_id }}">
                                                {{ $countries->countries_name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.zip') }}</label>
                                        <input type="text" class="form-control" id="zipcode" name="zipcode"
                                            placeholder="{{ __('crm.zip_placeholder') }}">
                                        <div class="invalid-feedback">
                                            {{ __('crm.zip_error') }}
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-4 col-md-4 col-lg-4 col-12">
                                        <label class="form-label">Phone</label>
                                        <input type="text" class="form-control" name="phone" placeholder="Phone">
                                    </div>

                                </div>
                            </fieldset>

                        </div>
                        <div class="btnclass mt-3">
                        <div class="col-sm-12 px-0">
                            <input type="submit" id="submit" class="btn btn-primary" value="Submit">
                            <a href="{{ route('sales.customer.index') }}" class="btn btn-secondary mx-1">Cancel</a>
                        </div>
                        <!--end col-->
                    </div>
                    </div>

                    
                    <!--end row-->
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        $(function () {
            $('#datepicker1').datepicker({
                dateFormat: 'dd-mm-yy',
            });

        });


        $(document).ready(function () {
            $(document).on('change', "#cust_lead_id", function (e) {
                e.preventDefault();
                var data = {
                    lead_id: $("#cust_lead_id").val(),
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('sales.customerDetails') }}",
                    data: data,
                    dataType: "json",

                    success: function (response) {
                        console.log(response);
                        if(response.datalist != ''){
                            var data = response.datalist[0];
                            $("#first_name").val(data.contact_name ?? '');
                            $("#email").val(data.contact_email ?? '');
                            // $("#gender").val(data.crmlead_customer.gender ?? '');
                            $("#contact_phone").val(data.phone ?? '');
                            if(data.crm_lead_contact != ''){
                            $("#website").val(data.crm_lead_contact[0].website ?? '');
                            $("#company_name").val(data.crm_lead_contact[0].company_name ?? '');
                            $("#street_address").val(data.crm_lead_contact[0].street_address ?? '');
                            $("#city").val(data.crm_lead_contact[0].city ?? '');
                            $("#state").val(data.crm_lead_contact[0].state ?? '');
                            $("#zipcode").val(data.crm_lead_contact[0].zipcode ?? '');
                            // $("#countries_id option:selected").val(data.crm_lead_contact[0].countries_id);
                            $("#countries_id option[value=" + data.crm_lead_contact[0].countries_id + "]").attr('selected', 'selected');
                            }
                        }else{ 
                                $("#first_name").val('');
                                $("#email").val(''); 
                                $("#contact_phone").val('');
                                $("#website").val('');
                                $("#company_name").val('');
                                $("#street_address").val('');
                                $("#city").val('');
                                $("#state").val('');
                                $("#zipcode").val('');  
                                $("#countries_id option[value=" + data.crm_lead_contact[0].countries_id + "]");
                                
                            }
                    },

                });
            });
        });


        
    </script>
    @endpush
</x-app-layout>