<x-app-layout>
    @section('title', 'Contact')

    <div class="contact-content">
        <div class="layout-specing">
            <nav aria-label="breadcrumb ">
                <ol class="breadcrumb bg-transparent px-0">
                    <li class="breadcrumb-item"><a href="#" class="text-dark tx-15">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('marketing.contact-group-list.index')}}" class="text-dark tx-15">Contact Group List</a></li>
                    <li class="breadcrumb-item"><a href="#" class="text-dark tx-15">Contact List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>   
            <form action="{{ route('marketing.contact-update',$data_list->id) }}" method="POST" id="updateContactForm" class="needs-validation" novalidate>
                @csrf  
                {{ method_field('PUT') }}
                <div class="card contact-content-body">
                    <div class="card-header">
                        <h6 class="tx-15 mg-b-0">{{__('newsletter.add_contact_list')}}</h6>
                    </div>
                    <div class="card-body">
                        <input type="hidden" value="{{$data_list->id}}" name="contact_id">
                        <div class="form-row">
                            <div class="form-group col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.contact_name')}}<span class="text-danger">*
                                    </span></label>
                                <input type="text" class="form-control" id="contact_name" placeholder="{{__('newsletter.contact_name_placeholder')}}" value="{{$data_list->contact_name ?? ''}}" name="contact_name" required>
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
                                <input type="email" class="form-control" id="contact_email" placeholder="{{__('newsletter.contact_email_placeholder')}}" value="{{$data_list->contact_email ?? ''}}" name="contact_email" required>
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
                                    <select class="form-select form-control"  name="contact_group" id="contact_group"
                                        aria-label="Default select example">
                                        <option selected disabled value="">
                                            {{__('sender-list.select_country_name')}}
                                        </option>   
                                        @foreach($group_data as $gName)
                                            <option value="{{$gName->id}}" {{ ($gName->id == $data_list->id) ? 'selected' : '' }}>{{$gName->group_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.company')}}</label>
                                <input type="text" class="form-control" id="company" value="{{$data_list->company ?? ''}}" placeholder="{{__('newsletter.company_name_placeholder')}}" name="company">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.website')}}</label>
                                <input type="text" class="form-control" id="website" value="{{$data_list->website ?? ''}}" placeholder="{{__('newsletter.website_name_placeholder')}}" name="website">
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.country')}}</label>
                                <div class="form-icon position-relative">
                                    <select class="form-select form-control" name="country" id="country"
                                        aria-label="Default select example">
                                        <option selected disabled value="">
                                            {{__('sender-list.select_country_name')}}
                                        </option>
                                        @foreach($countrydata as $country)
                                            <option value="{{$country->countries_id}}" {{($country->countries_id == $data_list->countried_id) ? 'selected' : ''}}>{{$country->countries_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.phone')}}</label>
                                <input type="text" class="form-control" id="phone" value="{{$data_list->phone ?? ''}}" placeholder="{{__('newsletter.phone_placeholder')}}" name="phone">
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <div class="form-icon position-relative">
                                    <label class="form-label">{{__('newsletter.address')}}<span class="text-danger"></span></label>
                                    <textarea name="address" id="address" value="" placeholder="{{__('newsletter.address_placeholder')}}" class="form-control" cols="82" rows="3">{{$data_list->address ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 d-flex ">
                            <div class="col-lg-1 p-0">
                                <input type="submit" name="send" class="btn btn-primary" id="ContactUpBtn" value="{{ __('common.update')}}">
                            </div>
                            <div class="col-lg-1 p-0">
                                <a href="{{url()->previous()}}"><input type="button" name="send" class="btn btn-light" value="{{ __('common.cancel')}}"></a> 
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).on("click", "#ContactUpBtn", function(e) {
            e.preventDefault();
            $('#updateContactForm').addClass('was-validated');
            if ($('#updateContactForm')[0].checkValidity() === false) {
                event.stopPropagation();
            } 
            else { 
                $('#updateContactForm').submit();
            }
        });
        </script>
    @endpush
</x-app-layout>