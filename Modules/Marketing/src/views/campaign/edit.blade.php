<x-app-layout>
    @section('title', 'Campaign')

    <div class="contact-content">
        <div class="layout-specing">
         
            <div class="card contact-content-body">
                <form id="add_userForm" action="{{ route('marketing.campaign-update') }}" method="POST" class="needs-validation" novalidate>
                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h6 class="tx-15 mg-b-0">{{ __('campaign.update_campaign') }} </h6>
                        </div>
                    </div>
                    <input type="hidden" value="{{$data->id}}" name="campaign_id">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('campaign.campaign_name') }}<span
                                        class="text-danger">*</span></label>
                                <input name="name" id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="{{ __('campaign.campaign_name_placeholder') }}" value="{{$data->campaign_name ?? ''}}" required>
                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.campaign_name_error') }}
                                </div>
                            </div>
        
                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('campaign.campaign_subject') }}<span
                                        class="text-danger">*</span></label>
                                <input name="subject" id="subject" type="text"
                                    class="form-control @error('subject') is-invalid @enderror"
                                    placeholder="{{ __('campaign.campaign_subject_placeholder') }}" value={{$data->campaign_subject ?? ''}} required>
                                <span class="text-danger">
                                    @error('subject')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.campaign_subject_error') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('campaign.template') }}<span
                                        class="text-danger">*</span></label>
                                <select class="form-select form-control select2 @error('campaign_template') is-invalid @enderror"
                                    name="campaign_template" id="campaign_template" aria-label="Default select example"required>
                                    <option selected disabled value="">
                                        {{ __('campaign.select_template') }}
                                    </option>
                                    @if (!empty($data->template_data))
                                        @foreach ($data->template_data as $template)
                                            <option value="{{ $template->id }}" @if($template->id == $data->template_id) selected @endif>
                                                {{ $template->subject }}
                                            </option>
                                        @endforeach
                                    @endif
        
                                </select>
                                <span class="text-danger">
                                    @error('campaign_template')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.template_error') }}
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('campaign.sender') }}<span
                                        class="text-danger">*</span></label>
                                <select class="form-select form-control select2 @error('sender_id') is-invalid @enderror"
                                    name="sender_id" id="sender_id" aria-label="Default select example"required>
                                    <option selected disabled value="">
                                        {{ __('campaign.select_sender') }}
                                    </option>
                                    @if (!empty($data->sender_data))
                                        @foreach ($data->sender_data as $sender)
                                            <option value="{{ $sender->id }}" @if($sender->id == $data->sender_id) selected @endif>
                                                {{ $sender->sender_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="text-danger">
                                    @error('sender_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.sender_error') }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('campaign.source') }}<span
                                        class="text-danger">*</span></label>
                                <select class="form-select form-control select2 @error('source') is-invalid @enderror"
                                    name="source" id="source" required>
                                    <option selected disabled value="">
                                    {{__('campaign.select_source')}}
                                    </option>
                                    <option value="1" @if($data->source==1) selected @endif>{{__('campaign.customer')}}</option>
                                    <option value="2" @if($data->source==2) selected @endif>{{__('campaign.lead')}}</option>
                                    <option value="3" @if($data->source==3) selected @endif>{{__('campaign.imported_contact')}}</option>
                                </select>
                                <span class="text-danger">
                                    @error('source')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.source_id_error') }}
                                </div>
                            </div>
        
                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('campaign.Note') }}</label>
                                <input name="description" id="description" type="text"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="{{ __('campaign.enter_description') }}" value=" {{$data->description ??''}}" >
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
                            <div class="form-group col-lg-4">
                                <label class="form-label">{{ __('campaign.start_date') }}<span class="text-danger">*</span></label>
                                <input name="start_date" id="start_date" type="text" value="{{$data->start_date ?? ''}}"
                                    class="form-control @error('start_date') is-invalid @enderror"
                                    placeholder="{{ __('campaign.chose_start_date') }}" required>
                                <span class="text-danger">
                                    @error('start_date')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.start_date_error') }}
                                </div>
                            </div>
                        
                            <div class="form-group col-lg-4">
                                <label class="form-label">{{ __('campaign.from_time') }}<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="text" id="from_time" value="{{$data->from_time ?? ''}}" name="from_time" class="form-control @error('from_time') is-invalid @enderror" placeholder="{{ __('campaign.chose_from_time') }}" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                    <div class="input-group-append">
                                      <button class="btn btn-outline-secondary"  onclick="showpickers('from_time',24)" type="button"><i class="fa fa-clock-o"></i></button>
                                    </div>
                                  </div>
                                  <div class="timepicker"></div> 
                                  <span class="text-danger">
                                    @error('from_time')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.from_time_error') }}
                                </div>
                            </div>

                            <div class="form-group col-lg-4">
                                <label class="form-label">{{ __('campaign.to_time') }}<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="text" id="to_time" value="{{$data->to_time ?? ''}}" name="to_time" class="form-control @error('to_time') is-invalid @enderror" placeholder="{{ __('campaign.chose_to_time') }}" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                    <div class="input-group-append">
                                      <button class="btn btn-outline-secondary"  onclick="showpickers('to_time',24)" type="button"><i class="fa fa-clock-o"></i></button>
                                    </div>
                                  </div>
                                  <div class="timepicker"></div> 
                                  <span class="text-danger">
                                    @error('to_time')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.to_time_error') }}
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('campaign.time_zone') }}<span
                                        class="text-danger">*</span></label>
                                <select class="form-select form-control select2 @error('time_zone') is-invalid @enderror"
                                    name="time_zone" id="sender_id" aria-label="Default select example"required>
                                    <option  disabled value="">
                                        {{ __('campaign.select_time_zone') }}
                                    </option>
                                    @if (!empty($data->DbTimeZones))
                                        @foreach ($data->DbTimeZones as $tmZones)
                                            <option value="{{ $tmZones->timezone_location }}" @if($tmZones->timezone_location==$data->time_zone) selected @endif>
                                                {{ $tmZones->timezone_location }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="text-danger">
                                    @error('time_zone')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.time_zone_error') }}
                                </div>
                            </div>

                            @if (!empty($data->group_ids))
                                <div class="form-group col-lg-6">
                                    <label class="form-label">{{ __('campaign.campaign_group') }}<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select select2 form-control group @error('group') is-invalid @enderror" multiple
                                        name="group[]" id="group" >
                                            @foreach ($data->group_data as $group)
                                                @php
                                                $groupArray=explode(",",$data->group_ids);   
                                                @endphp
                                                <option value="{{ $group->id }}"  @if(in_array($group->id, $groupArray)) selected @endif>
                                                    {{ $group->group_name }}
                                                </option>
                                            @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('group')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        {{ __('campaign.group_error') }}
                                    </div>
                                </div>
                            @endif
                         
                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('common.status') }}<span
                                        class="text-danger">*</span></label>
                                <select class="form-select form-control select2 @error('status') is-invalid @enderror"
                                    name="status" id="status" required>
                                    <option selected disabled value="">
                                    Select Status
                                    </option>
                                    <option value="0" @if($data->status==0) selected @endif>{{ __('campaign.inactive') }}</option>
                                    <option value="1" @if($data->status==1) selected @endif>{{ __('campaign.active') }}</option>
                                    <option value="2" @if($data->status==2) selected @endif>{{ __('campaign.completed') }}</option>
                                </select>
                                <span class="text-danger">
                                    @error('status')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('campaign.status_error') }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <div class="col-sm-12 p-0">
                                <input type="submit" id="submit" name="send" class="btn btn-primary" value="Submit">
                                <a href="javascript:void(0)" onclick="history.back()" class="btn btn-secondary mx-1">Cancel</a>
                            </div>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
       <!--end col-->
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