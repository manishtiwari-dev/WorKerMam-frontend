<x-app-layout>
    @section('title', 'Edit Customer')
    <div class="contact-content">
        <div class="layout-specing">

            <div class="card contact-content-body">
                <form action="{{ route('sales.customer.update', $customer->customer_id) }}" id="userForm" method="post"
                    class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="card-header d-flex align-items-center justify-content-between py-2 px-3">
                        <h6 class="tx-15 mg-b-0">{{ __('crm.edit_customer') }}</h6>
                    </div>
                    @if (!empty($customer->crm_customer_address))
                        @foreach ($customer->crm_customer_address as $iData)
                            @php
                                $address = $iData;
                                
                            @endphp
                        @endforeach
                    @endif
                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <fieldset class="form-fieldset">
                                <legend>{{ __('crm.primary_contact_info') }}</legend>
                                <div class="form-row">

                                    <div class="form-group col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.lead') }}</label>
                                        <select class="form-control select2 @error('lead_id') is-invalid @enderror "
                                            name="lead_id" id="cust_lead_id">
                                            <option selected disabled value="" disabled>
                                                {{ __('crm.lead_select') }}</option>

                                            @foreach ($lead_list as $lead)
                                                <option
                                                    value="@if (!empty($lead)) {{ $lead->lead_id }} @endif"
                                                    {{ $customer->lead_id == $lead->lead_id ? 'selected' : '' }}>
                                                    {{ $lead->contact_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            {{ __('crm.source_error') }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.customer_name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control"
                                            value="{{$customer->first_name ?? ''}}"
                                            id="customer_name" name="customer_name"
                                            placeholder="{{ __('crm.customer_name_placeholder') }}" required>

                                        <div class="invalid-feedback">
                                            {{ __('crm.customer_name_error') }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.email') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="email" id="email" class="form-control"
                                            value="{{ $customer->email ?? ''}}"
                                            id="customer_email"
                                            placeholder="{{ __('crm.customer_email_placeholder') }}"
                                            name="customer_email" required>
                                        <div class="invalid-feedback">
                                            {{ __('crm.customer_email_error') }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.contact_phone') }}</label>
                                        <input type="text" class="form-control"
                                            placeholder="{{ __('crm.phone_placeholder') }}" name="contact"
                                            value="{{ $customer->contact ?? ''}}" id="contact_phone">
                                        
                                    </div>

                                    <div class="form-group col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.website') }}</label>
                                        <input type="text" class="form-control"
                                            value="{{ $customer->website ?? ''}}"
                                            id="website" name="website"
                                            placeholder="{{ __('crm.website_placeholder') }}">
                                        <div class="invalid-feedback">
                                            {{ __('crm.website_error') }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.company_name') }}</label>
                                        <input type="text" class="form-control"
                                            value="{{ $customer->company_name ?? ''}}"
                                            id="company_name" name="company_name"
                                            placeholder="{{ __('crm.company_name_placeholder') }}" value="">
                                        <div class="invalid-feedback">
                                            {{ __('crm.company_name_error') }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.gender') }}</label>
                                        <select
                                            class="form-control select2 @error('lead_id') is-invalid @enderror "
                                            name="gender" id="gender" >
                                            <option selected disable value="" disabled>
                                                {{ __('crm.gender_select') }}</option>
                                            <option value="1" {{ $customer->gender == '1' ? 'selected' : '' }}>
                                                Male</option>
                                            <option value="2" {{ $customer->gender == '2' ? 'selected' : '' }}>
                                                Female</option>
                                            <option value="3" {{ $customer->gender == '3' ? 'selected' : '' }}>
                                                Other</option>

                                        </select>
                                        <div class="invalid-feedback">
                                            {{ __('crm.gender_select') }}
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" name="cust" value="1">

                                    <div class="form-group col-lg-4 col-md-6  col-12">
                                        <label class="form-label">Tax Id</label>
                                        <input type="text" name="tax_id" value="{{$customer->tax_id}}" placeholder="Enter Tax Id" class="form-control">
                                    </div>

                                </div>
                            </fieldset>

                        </div>
                    </div>

                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <fieldset class="form-fieldset">
                                <legend>{{ __('crm.address_info') }}</legend>
                                <div class="form-row">
                                     
                                    <div class="form-group col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.street_address') }}</label>
                                        <input type="text" class="form-control"
                                            value="{{$address->street_address ?? ''}}"
                                            id="street_address" name="street_address"
                                            placeholder="{{ __('crm.street_address_placeholder') }}" value="">
                                        <div class="invalid-feedback">
                                            {{ __('crm.street_address_error') }}
                                        </div>
                                    </div> 
                                    <div class="form-group col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.city') }}</label>
                                        <input type="text" class="form-control" id="city"
                                            value="{{$address->city ?? ''}}"
                                            name="city" placeholder="{{ __('crm.city_placeholder') }}">
                                        <div class="invalid-feedback">
                                            {{ __('crm.city_error') }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.state') }}</label>
                                        <input type="text" class="form-control"
                                            value="{{$address->state ?? ''}}"
                                            id="state" name="state"
                                            placeholder="{{ __('crm.state_placeholder') }}" >
                                        <div class="invalid-feedback">
                                            {{ __('crm.state_error') }}
                                        </div>
                                    </div>



                                    <div class="form-group col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.country') }}</label>
                                        <select name="countries_id"
                                            class="form-control select2 @error('countries_id') is-invalid @enderror "
                                            name="countries_id" >
                                            <option selected disable value="" disabled>
                                                {{ __('crm.country_select') }}</option>
                                            @foreach ($country_list as $countries)
                                                <option value="{{ $countries->countries_id }}"
                                                    @if (!empty($address->countries_id)) {{ $address->countries_id == $countries->countries_id ? 'selected' : '' }} @endif>
                                                    {{$countries->countries_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4 col-lg-4 col-12">
                                        <label class="form-label">{{ __('crm.zip') }}</label>
                                        <input type="text"  class="form-control"
                                            value="{{$address->zipcode ?? ''}}"
                                            id="zipcode" name="zipcode"
                                            placeholder="{{ __('crm.zip_placeholder') }}" >
                                        <div class="invalid-feedback">
                                            {{ __('crm.zip_error') }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 col-lg-4 col-12">
                                        <label class="form-label">Phone</label>
                                        <input type="text" class="form-control"
                                            value="{{$address->phone ?? ''}}"
                                            name="phone" placeholder="Phone">
                                    </div>
                                </div>
                            </fieldset>

                        </div>
                        <div class="">
                        <div class="col-sm-12 mt-3 p-0">
                            <input type="submit" id="submit" name="send" class="btn btn-primary"
                                value="Update">
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
            $(function() {
                $('#datepicker1').datepicker({
                    dateFormat: 'dd-mm-yy',
                });
            });
       
             $(document).ready(function() {
                $(document).on('change', "#cust_lead_id", function(e) {
                    e.preventDefault();
                        var data = {
                             lead_id : $("#cust_lead_id").val(),
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

                            success: function(response) {
                                if(response.datalist != ''){
                            var data = response.datalist[0];
                            $("#customer_name").val(data.contact_name ?? '');
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
                                var data = response.datalist[0];
                            $("#customer_name").val(data.contact_name ?? '');
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
