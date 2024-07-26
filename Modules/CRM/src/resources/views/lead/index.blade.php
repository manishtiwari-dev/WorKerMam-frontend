<x-app-layout>
    @section('title', $pageTitle)

    <style>
        .ui-datepicker {
            z-index: 1051; 
        }

    </style>

@if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
    <!--Listing Start-->
    <div class="card contact-content-body">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="tx-15 mg-b-0">{{ __('crm.lead_list') }}</h6>
                <div class="d-flex gap-1">
                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true') 
                        <!-- Button HTML (to Trigger Modal) -->
                        <button type="button" class="btn btn-primary d-flex align-items-center" id="addButton">
                            <i  data-feather="plus"></i><span class="mg-l-5 ">{{ __('crm.add_lead') }}</span>
                        </button>
                    @endif
                    <a href="{{ route('crm.lead-import-create') }}">
                        <button class="btn btn-md  btn-primary "><i data-feather="plus"
                                class="lead_icon mg-r-5"></i>{{ __('crm.import_lead') }}</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <input type="hidden" value="" id="current_source">
            <!--Filter Start-->
            <div class="card-header row align-item-center mb-3 p-0  order-list-wrapper">
                <!--Sub Source Start-->
                <div class="col-lg-4">
                    <div class="form-icon position-relative ">
                        <!-- <label>{{ __('crm.source') }}</label> -->
                        <select class="form-select form-control select2" name="source_name" id="source_name"
                            aria-label="Default select example">
                            <option selected value="">All Source</option>
                            @if (!empty($content->sourcelist))
                                @foreach ($content->sourcelist as $source)
                                    <option value="{{ $source->source_id }}">
                                        {{ $source->source_name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <!--Sub Source End-->
                <!--Approval Status Start-->
                <div class="col-lg-4">
                    <div class="form-icon position-relative  ">
                        <!-- <label> {{ __('crm.group') }} </label> -->
                        <select class="form-select form-control category select2" id="category"
                            aria-label="Default select example" name="category">
                            <option selected value="">All Group</option>
                            @if (!empty($content->crmindustrylist))
                                @foreach ($content->crmindustrylist as $industry)
                                    <option value="{{ $industry->id }}">
                                        {{ $industry->group_name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <!--Approval Status End-->


                <!--Sub Source Start-->
                <div class="col-lg-4">
                    <div class="form-icon position-relative mb-3">
                        <!-- <label>Agent</label> -->
                        <select class="form-select form-control select2" name="agent_details" id="agent_details"
                            aria-label="Default select example">
                            <option value="" selected>All Agents</option>
                            @if (!empty($content->crmagentlist))
                                @foreach ($content->crmagentlist as $crmagentlist)
                                    <option value="{{ $crmagentlist->agent_id }}">
                                        {{ $crmagentlist->agent_name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <!--Sub Source End-->

                <!--Search Start-->
                <div class="col-lg-4 mb-3 mb-lg-0 mb-md-0">
                    <!-- <label>Search</label> -->
                    <input type="text" id="searchbar" value="{{ $search ?? '' }}"
                        class="form-control fas fa-search" placeholder="Search..." aria-label="Search"
                        name="search">
                </div>
                <!--Search End-->

                <!--Approval Status Start-->
                <div class="col-lg-3">
                    <div class="form-icon position-relative   tagselect">
                        <!-- <label> {{ __('crm.tags') }} </label> -->
                        <select class="form-select form-control select2" multiple="multiple" id="tags"
                            aria-label="Default select example" name="tags">
                            <option value="" selected>All Tags</option>
                            @if ($content->crmtags != null)
                                @foreach ($content->crmtags as $key => $value)
                                    <option value="{{ $value->tags_id }}">
                                        {{ $value->tags_name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <!--Approval Status End-->

                <!--Date Start-->
                <div class="col-lg-3">
                    <div class="form-icon position-relative">
                        <!-- <label>
                            {{ __('seo.date') }}
                        </label> -->
                        <input type="text" id="datatableRange" name="datatableRange" class="form-control"
                            placeholder="{{ __('common.daterange_placeholder') }}" />
                    </div>
                </div>
                <!--Date End-->
 
                <div class="col-lg-2">
                    <div class="form-icon position-relative">
                        <a class="btn btn-primary " href="" role="button"><i class="fa fa-refresh"
                                aria-hidden="true"></i> {{ __('common.reset') }}</a>
                    </div>
                </div>

            </div>
            <!--Filter End-->
            <div class="table-responsive" id="lead_listing">
                <table class="table  table_wrapper" id="">
                    <thead>
                        <tr>
                            <th>{{ __('common.sl_no') }}</th>
                            <th>{{ __('crm.date') }}</th>
                            <th>{{ __('crm.client_details') }}</th>
                            {{-- <th>{{ __('crm.tags') }}</th> --}}
                            <th>{{ __('crm.group') }}</th>
                            <th>{{ __('crm.source') }}</th>
                            <th class="text-center wd-10p">{{ __('common.action') }}</th>
                        </tr>
                    </thead>
                    <tbody id="Search_Tr">
                        @if (!empty($content->crmleadlist))
                            @forelse ($content->crmleadlist as $key => $crmlead)
                                <td>{{ $content->current_page * $content->per_page + $key + 1 - $content->per_page }}
                                </td>

                                <td style="width: 120px;">
                                    {{ \Carbon\Carbon::parse($crmlead->created_at)->format('Y-m-d') }}
                                </td>

                                <td>
                                    <h6 class="tx-semibold mg-b-0"><a
                                            href="{{ route('crm.lead-followup.show', [$crmlead->lead_id]) }}">{{ $crmlead->contact_name }}</a>
                                    </h6>
                                    @if(!empty($crmlead->phone))
                                        <span class="tx-color-03">{{ $crmlead->phone ?? '' }}</span> <br />
                                    @endif
                                    @if(!empty($crmlead->contact_email))
                                        <span class="tx-color-03">{{ $crmlead->contact_email ?? '' }}</span><br />
                                    @endif
                                    @if (!empty($crmlead->crm_lead_to_tag))
                                        @foreach ($crmlead->crm_lead_to_tag as $key => $crmTag)
                                            <span class="badge"
                                                style="background-color: {{ $crmTag->tags_color ?? '' }}">{{ $crmTag->tags_name ?? '-' }}</span>
                                            @if ($key == 1)
                                                <br />
                                            @endif
                                        @endforeach
                                    @endif
                                </td>

                        
                                <td>
                                    <select class="form-select form-control source_group dropdown-class select2"
                                        data-group="{{ $crmlead->lead_id }}" name="group_name" id="group_name">
                                        <option disabled selected value="">Select</option>
                                        @if (!empty($content->crmindustrylist))
                                            @foreach ($content->crmindustrylist as $group)
                                                <option value="{{ $group->id }}"
                                                    {{ $crmlead->industry_id == $group->id ? 'selected' : '' }}>
                                                    {{ $group->group_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>

                                <td>

                                    <select class="form-select source_data dropdown-class select2" name="source_data" id="source_data"
                                        data-source="{{ $crmlead->lead_id }}">
                                        <option disabled selected value="">Select</option>
                                        @if (!empty($content->sourcelist))
                                            @foreach ($content->sourcelist as $source)
                                                <option value="{{ $source->source_id }}"
                                                    {{ $crmlead->source_id == $source->source_id ? 'selected' : '' }}>
                                                    {{ $source->source_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                                <td class="align-items-center justify-content-center d-flex gap-2">

                                    <a href="{{ route('crm.lead-followup.show', [$crmlead->lead_id]) }}"
                                        class="btn btn-sm  mg-r-5 px-0"><i
                                            data-feather="eye"></i></a> 

                                    <a href="#UpdateLeadEdit" data-id="{{ $crmlead->lead_id }}" data-bs-toggle="modal"
                                        class="btn btn-sm  result_edit_btn px-0"><i
                                            data-feather="edit-2"></i><span
                                            class="d-none d-sm-inline mg-l-5"></span></a>

                                </td>
                                </tr>
                            @empty
                                <h1>No Record Found !</h1>
                            @endforelse
                        @endif
                    </tbody>
                </table>
                {!! \App\Helper\Helper::make_pagination(
                    $content->total_records,
                    $content->per_page,
                    $content->current_page,
                    $content->total_page,
                    'crm.lead.index',
                    ['start_date' => $content->start_date, 'end_date' => $content->end_date,'search'=>$content->search,'source_name'=>$content->source_name,'tags'=>$content->tags,'crm_agent'=>$content->crm_agent],
                ) !!}
            </div>

        </div>
    </div>
    <!--Listing End--->

    @endif


    <!-------------------------------------Modals-------------------------------------------------------->

    <!--Start Add Modal-->
    <div class="modal fade add-lead-wrapper" id="addLeadCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('crm.add_lead') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('crm.lead.store') }}" method="post" id="leadForm" class="needs-validation"
                        novalidate>
                        @csrf 
                            <div data-label="Example" class="df-example demo-forms">
                                <fieldset class="form-fieldset">
                                    <legend>{{ __('crm.primary_contact_info') }}</legend> 
                                        <div class="form-row">
                                            <div class="form-group col-md-4 col-6">
                                              <div>  <label for="date" class="tx-14">{{ __('crm.date') }}</label></div>
                                                <input type="text" name="date"
                                                    value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}"
                                                    class="form-control  datepicker1"
                                                    placeholder="{{ __('crm.select') }}">
                                            </div>
                                            <div class="form-group col-md-4 col-6">
                                               <div> <label for="source_id" class="tx-14">{{ __('crm.source') }}</label></div>
                                                <select class="form-select form-control select2Modal" name="source_id" required>
                                                    <option selected disable value="" disabled>
                                                        {{ __('crm.source_select') }}
                                                    </option>

                                                    @if (!empty($content->sourcelist))
                                                        @foreach ($content->sourcelist as $ls_data)
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
                                            <div class="form-group col-md-4 col-6">
                                               <div> <label for="industry_id" class="tx-14">{{ __('crm.industry_type_group') }}</label></div>
                                                <select class="form-select form-control select2Modal" name="industry_id"
                                                    id="" required>
                                                    <option selected disable value="" disabled>
                                                        {{ __('crm.industry_select') }}
                                                    </option>

                                                    @if (!empty($content->crmindustrylist))
                                                        @foreach ($content->crmindustrylist as $iData)
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
                                        
                                            <div class="form-group col-md-4 col-6">
                                                <div><label for="contact_name" class="tx-14">{{ __('crm.contact_name') }}</label></div>
                                                <input type="text" class="form-control" id=""
                                                    name="contact_name"
                                                    placeholder="{{ __('crm.contact_placeholder') }}"
                                                    value="{{ old('contact_name') }}" required>
                                                <div class="invalid-feedback">
                                                    {{ __('crm.name_error') }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4 col-6">
                                                <div><label for="contact_email" class="tx-14">{{ __('crm.contact_email') }}</label></div>
                                                <input type="email" class="form-control" id=""
                                                    placeholder="{{ __('crm.email_placeholder') }}"
                                                    name="contact_email" value="{{ old('contact_email') }}">
                                                <div class="invalid-feedback">
                                                    {{ __('crm.email_error') }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4 col-6">
                                                <div><label for="phone" class="tx-14">{{ __('crm.contact_phone') }}</label></div>
                                                <input type="text" class="form-control" id="" name="phone"
                                                    placeholder="{{ __('crm.phone_placeholder') }}"
                                                    value="{{ old('phone') }}">
                                                <div class="invalid-feedback">
                                                    {{ __('crm.contact_name_error') }}
                                                </div>
                                            </div>
                                       
                                            <div class="form-group col-lg-4 col-6">
                                                <div class="form-icon position-relative  mb-3 tagselect">
                                                  <div>  <label class="tx-14"> {{ __('crm.tags') }} </label></div>
                                                    <select class="form-select form-control select2"
                                                        multiple="multiple" aria-label="Default select example"
                                                        name="tags[]">
                                                        <option value=""  disabled>{{ __('crm.select_tag') }}</option>
                                                        @if (!empty($content->crmtags))
                                                            @foreach ($content->crmtags as $key => $value)
                                                                <option value="{{ $value->tags_id }}">
                                                                    {{ $value->tags_name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4 col-6">
                                                <div><label for="note" class="tx-14">{{ __('crm.note') }}</label></div>
                                                <textarea name="note" class="form-control" placeholder="Please Enter Note"></textarea>

                                            </div>
                                        </div> 
                                </fieldset>
                            </div>
                            
                        <!--------- Primary contact info area end here ------------>

                        <!--------- Additional contact info area start here ------------> 
                            <div data-label="Example" class="df-example demo-forms mt-4">
                                <fieldset class="form-fieldset">
                                    <legend>{{ __('crm.additional_contact_info') }}</legend> 
                                        <div class="form-row">
                                            <div class="form-group col-md-6 col-6">
                                                <label for="company_name">{{ __('crm.company_name') }}</label>
                                                <input type="text" class="form-control" id=""
                                                    name="company" placeholder="Company Name"
                                                    value="{{ old('company_name') }}">
                                                <div class="invalid-feedback">
                                                    {{ __('crm.company_name_error') }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 col-6">
                                                <label for="website">{{ __('crm.website') }}</label>
                                                <input type="text" class="form-control" id=""
                                                    name="website" placeholder="{{ __('crm.website_placeholder') }} "
                                                    value="{{ old('website') }}">
                                                <div class="invalid-feedback">
                                                    {{ __('crm.website_error') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 col-6">
                                                <label for="website">{{ __('crm.street_address') }}</label>
                                                <input type="text" class="form-control" id=""
                                                    name="street_address"
                                                    placeholder="{{ __('crm.street_address_placeholder') }}"
                                                    value="{{ old('street_address') }}">
                                                <div class="invalid-feedback">
                                                    {{ __('crm.street_address_error') }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 col-6">
                                                <label for="city">{{ __('crm.city') }}</label>
                                                <input type="text" class="form-control" id=""
                                                    name="city" placeholder="{{ __('crm.city_placeholder') }}"
                                                    value="{{ old('city') }}">
                                                <div class="invalid-feedback">
                                                    {{ __('crm.city_error') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 col-6">
                                                <label for="state">{{ __('crm.state') }}</label>
                                                <input type="text" class="form-control" id=""
                                                    name="state" placeholder="{{ __('crm.state_placeholder') }}"
                                                    value="{{ old('state') }}">
                                                <div class="invalid-feedback">
                                                    {{ __('crm.state_error') }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 col-6">
                                                <label for="source">{{ __('crm.zip') }}</label>
                                                <input type="text" class="form-control" id=""
                                                    name="zipcode" placeholder="{{ __('crm.zip_placeholder') }}"
                                                    value="{{ old('zipcode') }}">
                                                <div class="invalid-feedback">
                                                    {{ __('crm.zip_error') }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 col-12 mb-4">
                                                <label for="countries_id">{{ __('crm.country_select') }}</label>
                                                <select class="form-select select2Modal" id=""
                                                    name="countries_id">
                                                    <option selected disable value="" disabled>
                                                        {{ __('crm.country_select') }}
                                                    </option>
                                                    @if (!empty($content->countrydata))
                                                        @foreach ($content->countrydata as $countries)
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
  
                                </fieldset>
                            </div>
                        <!--------- Additional contact info area start here ----------->

                        <!--------- Social contact info area start here ------------> 
                            <div data-label="Example" class="df-example demo-forms mt-4">
                                <fieldset class="form-fieldset">
                                    <legend>{{ __('crm.social_contact_info') }}</legend> 
                                        <div class="addMore" id="">
                                            <div class="row">
                                                <div class="form-group col-md-5 col-5">
                                                    <label for="website">{{ __('crm.social_type') }}</label>
                                                    <select class="form-select form-control " name="social_type[]"
                                                        id="">
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
                                                    <input type="text" class="form-control" id=""
                                                        placeholder="{{ __('crm.social_placeholder') }}"
                                                        name="social_link[]" value="">
                                                    <div class="invalid-feedback">
                                                        {{ __('crm.social_link_select') }}
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-2 col-2 plusbtn mt-lg-4">
                                                    <button class="btn btn-primary add_more_social" type="button"
                                                        id="add_more"><i data-feather="plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                </fieldset>
                            </div>

                            <div class="row mt-3">
                                <div class="col-sm-12 ">
                                    <input type="submit" id="submit" name="send" class="btn btn-primary"
                                        value="Submit">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        <!--------- Social contact info area end here ----------->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End Add Modal-->

    <!--Client delete modal start here-->
    <div class="modal fade effect-scale" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Delete Lead</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="deleteClient" name="input_field_id">
                    <p class="mg-b-0">{{ __('common.delete_confirmation') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('common.no') }}
                    </button>
                    <button type="button" class="btn btn-primary deleteConfirmBtn">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--Client delete modal end here-->

    <!--CRM Lead Update Modal-->
    
    <div class="modal fade" id="UpdateLeadEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('crm.update_lead') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('crm.leadUpdate') }}" method="post" id="leadForm"
                        class="needs-validation" novalidate>
                        @csrf 
                            <input type="hidden" name="leadId" id="leadId" />
                            <div data-label="Example" class="df-example demo-forms">
                                <fieldset class="form-fieldset">
                                    <legend>{{ __('crm.primary_contact_info') }}</legend> 
                                        <div class="form-row">
                                            <div class="form-group col-md-4 col-6">
                                                <label for="date">{{ __('crm.date') }}</label>
                                                <input type="text" name="date"
                                                    class="form-control  datepicker1"
                                                    placeholder="{{ __('crm.select') }}" id="datepickerDate">
                                            </div>
                                            <div class="form-group col-md-4 col-6">
                                                <label for="source_id">{{ __('crm.source') }}</label>
                                                <select class="form-select form-control select2Modal" id="source_id"
                                                    name="source_id" required>
                                                    <option selected disable value="" disabled>
                                                        {{ __('crm.source_select') }}
                                                    </option>

                                                    @if (!empty($content->sourcelist))
                                                        @foreach ($content->sourcelist as $ls_data)
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
                                            <div class="form-group col-md-4 col-6">
                                                <label for="industry_id">{{ __('crm.industry_type_group') }}</label>
                                                <select class="form-select form-control select2Modal" name="industry_id"
                                                    id="industry_id" required>
                                                    <option selected disable value="" disabled>
                                                        {{ __('crm.industry_select') }}
                                                    </option>

                                                    @if (!empty($content->crmindustrylist))
                                                        @foreach ($content->crmindustrylist as $iData)
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
                                            <div class="form-group col-md-4 col-6">
                                                <label for="contact_name">{{ __('crm.contact_name') }}</label>
                                                <input type="text" class="form-control" id="contact_name"
                                                    name="contact_name"
                                                    placeholder="{{ __('crm.contact_placeholder') }}"
                                                    value="{{ old('contact_name') }}" required>
                                                <div class="invalid-feedback">
                                                    {{ __('crm.name_error') }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4 col-6">
                                                <label for="contact_email">{{ __('crm.contact_email') }}</label>
                                                <input type="email" class="form-control" id="contact_email"
                                                    placeholder="{{ __('crm.email_placeholder') }}"
                                                    name="contact_email" value="{{ old('contact_email') }}">
                                                <div class="invalid-feedback">
                                                    {{ __('crm.email_error') }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4 col-6">
                                                <label for="phone">{{ __('crm.contact_phone') }}</label>
                                                <input type="text" class="form-control" id="phone"
                                                    name="phone" placeholder="{{ __('crm.phone_placeholder') }}"
                                                    value="{{ old('phone') }}">
                                                <div class="invalid-feedback">
                                                    {{ __('crm.contact_name_error') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-4 col-6">
                                                <div class="form-icon position-relative  mb-3 tagselect">
                                                    <label> {{ __('crm.tags') }} </label>
                                                    <select class="form-select form-control tags_data select2Modal"
                                                        multiple="multiple" aria-label="Default select example"
                                                        name="tags[]" id="tag_select_edit">
                                                        <option value="" disabled>{{ __('crm.select_tag') }}
                                                        </option>
                                                        @if (!empty($content->crmtags))
                                                            @foreach ($content->crmtags as $key => $value)
                                                                <option value="{{ $value->tags_id }}">
                                                                    {{ $value->tags_name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4 col-6">
                                                <label for="note">{{ __('crm.note') }}</label>
                                                <textarea name="note" class="form-control" id="LeadNote" placeholder="Please Enter Note"></textarea>

                                            </div>
                                        </div> 
                                </fieldset>
                            </div>
                            <!--end row--> 
                        <!--------- Primary contact info area end here ------------>

                        <!--------- Additional contact info area start here ------------> 
                            <div data-label="Example" class="df-example demo-forms my-4">
                                <fieldset class="form-fieldset">
                                    <legend>{{ __('crm.additional_contact_info') }}</legend> 
                                        <div class="form-row">
                                            <div class="form-group col-md-6 col-6">
                                                <label for="company_name">{{ __('crm.company_name') }}</label>
                                                <input type="text" class="form-control" id="company_name"
                                                    name="company" placeholder="Company Name"
                                                    value="{{ old('company_name') }}">
                                                <div class="invalid-feedback">
                                                    {{ __('crm.company_name_error') }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 col-6">
                                                <label for="website">{{ __('crm.website') }}</label>
                                                <input type="text" class="form-control" id="website"
                                                    name="website"
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
                                                <input type="text" class="form-control" id="city"
                                                    name="city" placeholder="{{ __('crm.city_placeholder') }}"
                                                    value="{{ old('city') }}">
                                                <div class="invalid-feedback">
                                                    {{ __('crm.city_error') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 col-6">
                                                <label for="state">{{ __('crm.state') }}</label>
                                                <input type="text" class="form-control" id="state"
                                                    name="state" placeholder="{{ __('crm.state_placeholder') }}"
                                                    value="{{ old('state') }}">
                                                <div class="invalid-feedback">
                                                    {{ __('crm.state_error') }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 col-6">
                                                <label for="source">{{ __('crm.zip') }}</label>
                                                <input type="text" class="form-control" id="zipcode"
                                                    name="zipcode" placeholder="{{ __('crm.zip_placeholder') }}"
                                                    value="{{ old('zipcode') }}">
                                                <div class="invalid-feedback">
                                                    {{ __('crm.zip_error') }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 col-12">

                                                <label for="countries_id">{{ __('crm.country_select') }}</label>
                                                <select class="form-select form-control select2Modal" id="country_code"
                                                    name="countries_id">
                                                    <option selected disable value="" disabled>
                                                        {{ __('crm.country_select') }}
                                                    </option>
                                                    @if (!empty($content->countrydata))
                                                        @foreach ($content->countrydata as $countries)
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
                                </fieldset>
                            </div>
                            <!--end row--> 
                        <!--------- Additional contact info area start here ----------->
                        <!--------- Social contact info area start here ------------> 
                            <div data-label="Example" class="df-example demo-forms">

                                <fieldset class="form-fieldset">
                                    <legend>{{ __('crm.social_contact_info') }}</legend> 

                                        <div class="addMoreAjax" id="">
                                            <!-- <div class="row">
                                                <div class="form-group col-md-5 col-5">
                                                    <label for="website">{{ __('crm.social_type') }}</label>
                                                    <select class="form-select form-control" name="social_type[]"
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
                                                    <button class="btn btn-primary add_more_social" type="button"
                                                        id="add_more"><i data-feather="plus"></i></button>
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="addMore" id="">
                                            <div class="row">
                                                <div class="form-group col-md-5 col-5">
                                                    <label for="website">{{ __('crm.social_type') }}</label>
                                                    <select class="form-select form-control " name="social_type[]"
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
                                                <div class="form-group col-md-2 col-2 plusbtn mt-lg-4">
                                                    <button class="btn btn-primary add_more_social" type="button"
                                                        id="add_more"><i data-feather="plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end row--> 
                                </fieldset>
                            </div>
                            <!--end row--> 
                        <div class="row mt-3">
                            <div class="col-sm-12 mb-3 mx-3 p-0">
                                <input type="submit" id="submit" name="send" class="btn btn-primary"
                                    value="Submit">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            <!--end col-->
                        </div>
                        <!--------- Social contact info area start here ----------->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--CRM LEAD Update modal end-->

    @push('scripts')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>
        <script>
          
            // $(function() {
            //     $('.datepicker1').datepicker({
            //         dateFormat: 'dd/mm/yy',
            //         onSelect: function() {
            //             var selected = $(this).datepicker("getDate");
            //         }
            //     });
            // });

            $(document).ready(function() {
                $("#addButton").click(function() {
                    $("#addLeadCreate").modal('show');
                    $('.select2Modal').select2({
                        dropdownParent: $('#addLeadCreate')
                    });
                    $('.datepicker1').datepicker({
                        dateFormat: 'dd/mm/yy'
                    });
                });
            });

            $(document).ready(function() {

                $(document).on('click', '.result_edit_btn', function(e) {

                    $('.select2Modal').select2({
                        dropdownParent: $('#UpdateLeadEdit')
                    });

                    e.preventDefault();
                    $(".addMoreAjax").empty();
                    var lead_id = $(this).data('id');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "GET",

                        url: "{{ url('crm/lead-edit') }}/" + lead_id,
                        data: {
                            lead_id: lead_id
                        },
                        dataType: "json",
                        success: function(response) {
                           // tag_select_edit
                            console.log(response);
                            var data = response[0].lead;
                            $("#contact_name").val(data.contact_name);
                            $("#contact_email").val(data.contact_email);
                            $("#phone").val(data.phone);
                            $("#leadId").val(data.lead_id);
                            $("#LeadNote").val(data.note);

                            var crm_lead_tag = response[0].crmleadtotag; 
                            if(crm_lead_tag != ''){
                                $.each(crm_lead_tag, function(index, crm_lead) {  
                                    $("#tag_select_edit option[value=" + crm_lead.tags_id + "]").attr('selected', 'selected');
                                });
                            }else{ 
                                $("#tag_select_edit option").removeAttr("selected");
                            }

                             
                            // var html = ``;
                            // $.each(response[0].crmtags, function(index, value) { 
                            //     var selected = ''; 
                            //     $.each(data.crm_lead_to_tag, function(key, tag) { 
                            //         if(value.tags_id == tag.tags_id){
                            //             var selected = 'selected';
                            //         }
                            //     });                                  
                            //      html += `<option value="${value.tags_id}" ${selected}>${value.tags_name}</option>`;
                            // });
                            // $(".selectDrop").append(html);
                            
                            const createdAt = data.created_at;
                            const date = new Date(createdAt);

                            // Create a function to format the date as "d/m/Y"
                            function formatDate(date) {
                                const day = date.getDate();
                                const month = date.getMonth() + 1; // Months are zero-based
                                if(day<10){
                                    var d='0'+day; 
                                }else{
                                    var d=day; 
                                }
                                if(month<10){
                                    var m='0'+month; 
                                }else{
                                    var m= month; 
                                }
                                const year = date.getFullYear();
                                return `${d}/${m}/${year}`;

                            }
                            const formattedDate = formatDate(date);

                            $("#datepickerDate").val(formattedDate)
                            $('#source_id').find('option').each(function() {
                                if ($(this).val() == data.source_id) {
                                    $(this).prop('selected', true);
                                }
                            });
                            $('#industry_id').find('option').each(function() {
                                if ($(this).val() == data.industry_id) {
                                    $(this).prop('selected', true);
                                }
                            });

                            var lead = data.crm_lead_contact;

                            $.each(lead, function(index, lcontact) {
                                $("#company_name").val(lcontact.company_name);
                                $("#website").val(lcontact.website);
                                $("#street_address").val(lcontact.street_address);
                                $("#city").val(lcontact.city);
                                $("#state").val(lcontact.state);
                                $("#zipcode").val(lcontact.zipcode);

                                $('#country_code').find('option').each(function() {
                                    if ($(this).val() == lcontact.countries_id) {
                                        $(this).prop('selected', true);
                                    }
                                });
                            }); 

                            var social = data.socialLink;
                            var html = ``;

                            $.each(social, function(index, lcontact) {
                                var selected_socialType = lcontact.social_type;
                                var selected_socialLink = lcontact.social_link;

                                html += `<div class="row">
                                        <div class="form-group col-md-5 col-6">
                                            <label for="website">{{ __('crm.social_type') }}</label>
                                            <select class="form-select form-control " name="social_type[]"
                                                id="social_type">
                                                <option selected disable value="" disabled>
                                                    {{ __('crm.social_type_select') }}</option>

                                                <option value="1"
                                                    ${selected_socialType == 1 ? 'selected' : '' }>
                                                    WHATSAPP</option>
                                                <option value="2"
                                                    ${selected_socialType == 2 ? 'selected' : '' }>
                                                    FACEBOOK</option>
                                                <option value="3"
                                                    ${ selected_socialType == 3 ? 'selected' : '' }>
                                                    INSTAGRAM</option>
                                                <option value="4"
                                                    ${selected_socialType == 4 ? 'selected' : '' }>
                                                    LINKEDIN</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                {{ __('crm.social_type_select') }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5 col-6">
                                            <label for="social_link">{{ __('crm.social_link') }}</label>
                                            <input type="text" class="form-control" id="social_link"
                                                placeholder="{{ __('crm.social_placeholder') }}" name="social_link[]"
                                                value="${selected_socialLink ?? '' }">
                                            <div class="invalid-feedback">
                                                {{ __('crm.social_link_select') }}
                                            </div>
                                        </div>
                                    </div>`;
                            });

                            $(".addMoreAjax").append(html);

                            $('.tags_data').select2({
                                dropdownParent: $('#UpdateLeadEdit')
                            });


                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                        }
                    });
                });
            });
        </script>
        <script>
        
            // $('.lead_toggle_class').change(function() {
            //     let status = $(this).prop('checked') === true ? 1 : 0;
            //     let status_id = $(this).data('id');
            //     console.log(status_id);
            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            //     $.ajax({
            //         type: "POST",
            //         dataType: "json",
            //         url: "{{ url('crm/lead-status') }}",
            //         data: {
            //             'status': status,
            //             'status_id': status_id
            //         },
            //         success: function(response) {
            //             // console.log(response);
            //             Toaster('success', response.success);
            //         }
            //     });
            // });

            $(document).on('change', '.source_data', function(e) {
                let source_id = $(this).val();
                let lead_id = $(this).data("source");

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('crm/source-update') }}",
                    data: {
                        'source_id': source_id,
                        'lead_id': lead_id,
                    },
                    success: function(response) {
                        Toaster('success', response.success);
                    }
                });
            });
            $(document).on('change', '.source_group', function(e) {
                let group_id = $(this).val();
                let lead_id = $(this).data("group");

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('crm/group-update') }}",
                    data: {
                        'group_id': group_id,
                        'lead_id': lead_id,
                    },
                    success: function(response) {
                        Toaster('success', response.success);
                    }
                });
            });

            // status follow up

            $(document).on('change', '.follow_up_status', function(e) {
                let status_id = $(this).val();
                let lead_id = $(this).data("id");
                console.log(lead_id);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url:"{{ url('crm/lead-status') }}",
                    data: {
                        'status_id': status_id,
                        'lead_id': lead_id,
                    },
                    success: function(response) {
                        Toaster('success', response.success);
                    }
                });
            });


            //update lead tags
            $(document).ready(function() {
                $(document).on('change', '.lead_tags', function(e) {
                    var data = {
                        tag_id: $(this).val(),
                        lead_id: $(this).data('leadtag'),
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ url('crm/lead-tag-update') }}",
                        data: data,
                        success: function(response) {
                            console.log(response);
                            Toaster('success', response.success);
                        }
                    });
                });
            });
            //end
            $(document).ready(function() {

                $(document).on("click", "#deleteBtn", function() {
                    var client_id = $(this).attr("data-id");
                    $('#deleteClient').val(client_id);
                });
                $(document).on('click', '.deleteConfirmBtn', function() {
                    var client_id = $('#deleteClient').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('crm/clients') }}/" + client_id,
                        data: {
                            client_id: client_id,
                            _method: 'DELETE'
                        },
                        dataType: "json",
                        success: function(response) {
                            Toaster(response.success);

                        }
                    });

                });
            });
            $('.agent_name').change(function() {

                let value = $(this).val();
                let lead_id = $(this).data("lead");

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('crm/agent-update') }}",
                    data: {
                        'value': value,
                        'lead_id': lead_id,
                    },
                    success: function(response) {
                        Toaster('success', response.success);
                    }
                });
            });
            $(function() {
                // tableWebContent();
                var start = moment();
                var end = moment();

                function cb(start, end) {
                    $('#datatableRange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }

                $('#datatableRange').daterangepicker({
                    autoUpdateInput: false,
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last 6 Month': [moment().subtract(6, 'month'), moment()],
                        'Last Year': [moment().subtract(1, 'year'), moment()]
                    },
                    locale: {
                        format: 'YYYY-MM-D'
                    }
                }, cb);

                cb(start, end);
            });
            $(document).ready(function() {
                $('input[name="datatableRange"]').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                        'YYYY-MM-DD'));
                    ajaxSubmitData();
                });

                $("#searchbar").on('keyup', function(e) {

                    tableWebContent('', '', this.value, '', '', '');
                });

                $("#category").on('change', function(e) {
                    tableWebContent('', '', '', this.value, '', '');
                })

                $("#agent_details").on('change', function(e) {
                    tableWebContent('', '', '', '', this.value, '');
                })


                $(".tagSelect").on('change', function(e) {
                    tableWebContent('', '', '', '', '', $(this).val());
                })

                $("#source_name").on('change', function(e) {
                    tableWebContent('', '', '', '', '', '', $(this).val());
                })



            });

            function ajaxSubmitData() {
                var dateRangePicker = $('#datatableRange').data('daterangepicker');
                var startDate = $('#datatableRange').val();

                if (startDate == '') {
                    startDate = null;
                    endDate = null;
                } else {
                    startDate = dateRangePicker.startDate.format('YYYY-MM-DD');
                    endDate = dateRangePicker.endDate.format('YYYY-MM-DD');
                }

                if (startDate != '' && endDate != '')
                    $("#customer_listing").html('');

                $("#customer_listing").html('');
                tableWebContent(startDate, endDate);
            }

            function tableWebContent(startDate = '', endDate = '', search = '', category = '', agent_id = '', tag_select = '',
                source_name = '') {

                const url = "{{ route('crm.lead-filter') }}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        start_date: startDate,
                        end_date: endDate,
                        search: search,
                        category: category,
                        agent_id: agent_id,
                        tag_select: tag_select,
                        source_name: source_name,
                    },
                    dataType: "json",
                    success: function(result) {
                        $("#lead_listing").html(result.html);
                    }
                });
            }
        </script>
        <script>
          
            $(document).ready(function() {
                var i = 1;
                $('.add_more_social').click(function(e) {
                    e.preventDefault();
                    i++;
                    html = `<div class="row" id="row${i}">
                            <div class="form-group col-md-5 col-5">
                                <select class="form-select form-control " name="social_type[]" id="social_type">
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
                    $('.addMore').append(html);
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
</x-app-layout>
