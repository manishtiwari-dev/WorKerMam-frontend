<x-app-layout>
    @section('title', 'Contact')

    <div class="contact-content">
        <div class="layout-specing">
          
            <form action="{{ route('marketing.contact-add') }}" method="POST" id="add_contact_list_form" class="needs-validation" novalidate>
                @csrf
                <div class="card contact-content-body">
                    <div class="card-header">
                        <h6 class="tx-15 mg-b-0">{{__('newsletter.add_contact_list')}}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.contact_name')}}<span class="text-danger">*
                                    </span></label>
                                <input type="text" class="form-control" id="contact_name"
                                    placeholder="{{__('newsletter.contact_name_placeholder')}}" name="contact_name" required>
                                <div class="invalid-feedback">
                                    {{__('newsletter.contact_name_error')}}
                                </div>
                                <span style="color:red;">
                                    @error('name')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.contact_email')}}<span class="text-danger">*
                                    </span></label>
                                <input type="email" class="form-control" id="contact_email" placeholder="{{__('newsletter.contact_email_placeholder')}}" name="contact_email" required>
                                <div class="invalid-feedback">
                                    {{__('newsletter.contact_email_error')}}
                                </div> 
                                <span style="color:red;">
                                    @error('email')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                        </div>  
                        <div class="form-row">
                            <div class="form-group col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.contact_group')}}</label>
                                <div class="form-icon position-relative"> 
                                    <select class="form-select form-control select2" name="contact_group" id="contact_group"
                                        aria-label="Default select example">
                                        <option selected disabled value="">
                                            {{__('newsletter.select_contact_group')}}
                                        </option>  
                                        @foreach($group_data as $gName)
                                            <option value="{{$gName->id}}" >{{$gName->group_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.company')}}</label>
                                <input type="text" class="form-control" id="company"
                                    placeholder="{{__('newsletter.company_name_placeholder')}}" name="company">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.website')}}</label>
                                <input type="text" class="form-control" id="website"
                                    placeholder="{{__('newsletter.website_name_placeholder')}}" name="website">
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.country')}}</label>
                                <div class="form-icon position-relative">
                                    <select class="form-select form-control select2" name="country" id="country"
                                        aria-label="Default select example">
                                        <option selected disabled value="">
                                            {{__('sender-list.select_country_name')}}
                                        </option>
                                        @foreach($country_data as $country)
                                            <option value="{{$country->countries_id}}">{{$country->countries_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.phone')}}</label>
                                <input type="text" class="form-control" id="phone"
                                    placeholder="{{__('newsletter.phone_placeholder')}}" name="phone">
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <div class="form-icon position-relative">
                                    <label class="form-label">{{__('newsletter.address')}}<span
                                            class="text-danger"></span></label>
                                    <textarea name="address" id="address"
                                        placeholder="{{__('newsletter.address_placeholder')}}" class="form-control"
                                        cols="82" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class=" d-flex gap-3">
                            <div class="col-lg-1 p-0">
                                <input type="submit" class="btn btn-primary" id="ContactSubBtn" value="{{ __('common.submit')}}">
                            </div>
                            <div class="col-lg-1 p-0">
                                <input type="button" onclick="history.back()"  class="btn btn-light" value="{{ __('common.cancel')}}">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).on("click", "#ContactSubBtn", function(e) {
            e.preventDefault();
            $('#add_contact_list_form').addClass('was-validated');
            if ($('#add_contact_list_form')[0].checkValidity() === false) {
                event.stopPropagation();
            } 
            else { 
                $('#add_contact_list_form').submit();
            }
        });
        </script>
    @endpush
</x-app-layout>