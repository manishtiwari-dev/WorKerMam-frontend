<x-app-layout>
    @section('title', 'Campaign')

    <div class="contact-content">
        <div class="layout-specing">
            {{--  --}}
            <div class="card contact-content-body">
                <form id="add_userForm" action="{{ route('marketing.campaign.store') }}" class="needs-validation"  method="POST" novalidate>
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h6 class="tx-15 mg-b-0">{{ __('campaign.add_campaign') }} </h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label class="form-label">{{ __('campaign.campaign_name') }}<span
                                        class="text-danger">*</span></label>
                                <input name="campaign_name" id="name" type="text"
                                    class="form-control @error('campaign_name') is-invalid @enderror"
                                    placeholder="{{ __('campaign.campaign_name_placeholder') }}" required>
                                <span class="text-danger">
                                    {{-- @error('campaign_name')
                                        {{ $message }}
                                    @enderror --}}
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.campaign_name_error') }}
                                </div>
                            </div>
        
                            <div class="form-group col-lg-6 col-md-6">
                                <label class="form-label">{{ __('campaign.campaign_subject') }}<span
                                        class="text-danger">*</span></label>
                                <input name="campaign_subject" id="subject" type="text"
                                    class="form-control @error('campaign_subject') is-invalid @enderror"
                                    placeholder="{{ __('campaign.campaign_subject_placeholder') }}" required>
                                <span class="text-danger">
                                    {{-- @error('campaign_subject')
                                        {{ $message }}
                                    @enderror --}}
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.campaign_subject_error') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label class="form-label">{{ __('campaign.template') }}<span
                                        class="text-danger">*</span></label>
                                <select class="form-select form-control select2 @error('template_id') is-invalid @enderror"
                                    name="template_id" id="campaign_template" aria-label="Default select example"required>
                                    <option selected disabled value="">
                                        {{ __('campaign.select_template') }}
                                    </option>
                                    @if (!empty($template_data))
                                        @foreach ($template_data as $template)
                                            <option value="{{ $template->id }}">
                                                {{ $template->subject }}
                                            </option>
                                        @endforeach
                                    @endif
        
                                </select>
                                <span class="text-danger">
                                    {{-- @error('template_id')
                                        {{ $message }}
                                    @enderror --}}
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.template_error') }}
                                </div>
                            </div>
                      
                            <div class="form-group col-lg-6 col-md-6">
                                <label class="form-label">{{ __('campaign.sender') }}<span
                                        class="text-danger">*</span></label>
                                <select class="form-select form-control select2 @error('sender_id') is-invalid @enderror"
                                    name="sender_id" id="sender_id" aria-label="Default select example"required>
                                    <option selected disabled value="">
                                        {{ __('campaign.select_sender') }}
                                    </option>
                                    @if (!empty($sender_data))
                                        @foreach ($sender_data as $sender)
                                            <option value="{{ $sender->id }}">
                                                {{ $sender->sender_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="text-danger">
                                    {{-- @error('sender_id')
                                        {{ $message }}
                                    @enderror --}}
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.sender_error') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label class="form-label">{{ __('campaign.source') }}<span class="text-danger">*</span></label>
                                <select class="form-select form-control select2  @error('source') is-invalid @enderror"
                                    name="source" id="source" required>
                                    <option selected disabled value="">
                                    {{__('campaign.select_source')}}
                                    </option>
                                    <option value="1">{{__('campaign.customer')}}</option>
                                    <option value="2">{{__('campaign.lead')}}</option>
                                    <option value="3">{{__('campaign.imported_contact')}}</option>
                                </select>
                                <span class="text-danger">
                                    {{-- @error('source')
                                        {{ $message }}
                                    @enderror --}}
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.source_id_error') }}
                                </div>
                            </div>
        
                            <div class="form-group col-lg-6 col-md-6">
                                <label class="form-label">{{ __('campaign.Note') }}</label>
                                <input name="description" id="description" type="text"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="{{ __('campaign.enter_description') }}" >
                                <span class="text-danger">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.description_error') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-4 col-md-4 ">
                                <label class="form-label">{{ __('campaign.start_date') }}<span class="text-danger">*</span></label>
                                <input name="start_date" id="start_date" type="text"
                                    class="form-control @error('start_date') is-invalid @enderror"
                                    placeholder="{{ __('campaign.chose_start_date') }}" required>
                                <span class="text-danger">
                                    {{-- @error('start_date')
                                        {{ $message }}
                                    @enderror --}}
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.start_date_error') }}
                                </div>
                            </div>
                        
                            <div class="form-group col-lg-4 col-md-4">
                                <label class="form-label">{{ __('campaign.from_time') }}<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="from_time" name="from_time" class="form-control @error('from_time') is-invalid @enderror" placeholder="{{ __('campaign.chose_from_time') }}" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                    <div class="input-group-append">
                                      <button class="btn btn-outline-secondary"  onclick="showpickers('from_time',24)" type="button"><i class="fa fa-clock-o"></i></button>
                                    </div>
                                  </div>
                                  <div class="timepicker"></div> 
                                  <span class="text-danger">
                                    {{-- @error('from_time')
                                        {{ $message }}
                                    @enderror --}}
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.from_time_error') }}
                                </div>
                            </div>

                            <div class="form-group col-lg-4 col-md-4">
                                <label class="form-label">{{ __('campaign.to_time') }}<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="to_time" name="to_time" class="form-control @error('to_time') is-invalid @enderror" placeholder="{{ __('campaign.chose_to_time') }}" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                    <div class="input-group-append">
                                      <button class="btn btn-outline-secondary"  onclick="showpickers('to_time',24)" type="button"><i class="fa fa-clock-o"></i></button>
                                    </div>
                                  </div>
                                  <div class="timepicker"></div> 
                                  <span class="text-danger">
                                    {{-- @error('to_time')
                                        {{ $message }}
                                    @enderror --}}
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.to_time_error') }}
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-6 col-md-12">
                                <label class="form-label">{{ __('campaign.time_zone') }}<span
                                        class="text-danger">*</span></label>
                                <select class="form-select form-control select2 @error('time_zone') is-invalid @enderror"
                                    name="time_zone" id="sender_id" aria-label="Default select example"required>
                                    <option selected disabled value="">
                                        {{ __('campaign.select_time_zone') }}
                                    </option>
                                    @if (!empty($time_zones))
                                        @foreach ($time_zones as $tmZones)
                                            <option value="{{ $tmZones->timezone_location }}">
                                                {{ $tmZones->timezone_location }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="text-danger">
                                    {{-- @error('time_zone')
                                        {{ $message }}
                                    @enderror --}}
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.time_zone_error') }}
                                </div>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 d-none campaign_group_div">
                                <label class="form-label">{{ __('campaign.campaign_group') }}</label>
                                <select class="form-select select2 form-control group @error('group_ids') is-invalid @enderror" multiple
                                    name="group_ids[]" id="group">
                                    @if (!empty($group_data))
                                        @foreach ($group_data as $group)
                                            <option value="{{ $group->id }}">
                                                {{ $group->group_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="text-danger">
                                    {{-- @error('group_ids')
                                        {{ $message }}
                                    @enderror --}}
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.group_error') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 mb-3">
                            <input type="submit" id="submit" name="send" class="btn btn-primary" value="Submit">
                            <a href="javascript:void(0)" onclick="history.back()" class="btn btn-secondary mx-1">Cancel</a>
                        </div>

                    </div>
                </form>    
            </div>
        </div>
    </div>


@push('scripts')
    <script>
    
        // Date Picker
        $('#start_date').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            dateFormat: 'yy-mm-dd'
        });

        // Time Picker
        // $('#to_time').timepicker();


        $("#source").change(function(event){
            if($(this).val()=='3')
            {   
                $('.campaign_group_div').removeClass('d-none');
                $('#group').attr('required','true');
            }
            else
            {
                $('.campaign_group_div').addClass('d-none');
                $('#group').removeAttr('required');
            }
        });
    </script>  
@endpush
</x-app-layout>