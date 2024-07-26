<style>
    .hide-box {
        display: none;
    }
</style> 
<div class="modal-header">
    <h4 class="modal-title"><i class="icon-plus"></i> Posting Website</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="submission_update" class="needs-validation" novalidate>
        {{ csrf_field() }}

        <div data-label="Example" class="df-example demo-forms">
            <div class="form-row">
                <input type="hidden" name="sl_no" id="sl_no_id" value="{{  $sl_no }}">
                <div class="form-group col-md-6">
                    <label class="form-label">{{ __('seo.website') }} <span class="text-danger">*</span></label>
                    <div class="form-icon position-relative">
                        <select class="form-select form-control select2Modal @error('website') is-invalid @enderror"
                            id="website" name="website_id" aria-label="Default select example" required disabled>
                            <option selected value>{{ __('seo.select_website') }}</option>
                            @if (!empty($websites))
                                @foreach ($websites as $website)
                                    <option value="{{ $website->id }}"
                                        {{ $web_name == $website->website_name ? 'selected' : '' }}>
                                        {{ $website->website_name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <div class="invalid-feedback">
                            <p>Please select website</p>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label">{{ __('seo.task_title') }} <span class="text-danger">*</span></label>
                    <div class="form-icon position-relative">
                        <select class="form-select form-control select2Modal @error('seotask') is-invalid @enderror"
                            id="seo_task_id" name="seo_task_id" aria-label="Default select example" required disabled>
                            <option selected value>{{ __('seo.select_task') }}</option>
                            @if ($seotask)
                                @foreach ($seotask as $seotasklist)
                                    <option value="{{ $seotasklist->id }}"
                                        {{ $task_id == $seotasklist->id ? 'selected' : '' }}>
                                        {{ $seotasklist->seo_task_title }}</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="invalid-feedback">
                            <p>Please select task title</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="form-label">{{ __('seo.website_url') }} <span class="text-danger">*</span></label>
                    <input name="website_url" id="website_url" type="text"
                        class="form-control @error('website_url') is-invalid @enderror"
                        value="{{ old('website_url') }}" placeholder="{{ __('seo.website_url_placeholder') }}"
                        onblur="extractBaseUrl(this)" required>
                    <div class="invalid-feedback">
                        <p>Please enter website url</p>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label">{{ __('seo.username') }} </label>
                    <input type="text" name="username" value="{{ old('website_username') }}" id="website_username"
                        class="form-control" placeholder="{{ __('seo.username_placeholder') }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="form-label">{{ __('seo.email') }} </label>
                    <input type="text" name="email" value="{{ old('email') }}" id="email"
                        class="form-control" placeholder="{{ __('seo.email_placeholder') }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label">{{ __('seo.password') }} <span class="text-danger">*</span></label>
                    <input type="text" name="password" value="{{ old('password') }}" id="website_password"
                        class="form-control @error('website_password') is-invalid @enderror"
                        placeholder="{{ __('seo.password_placeholder') }}" required>
                    <div class="invalid-feedback">
                        <p>Please enter password</p>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label class="form-label">{{ __('seo.da') }} </label>
                    <input type="number" name="da" value="{{ old('da') }}" id="da"
                        class="form-control" placeholder="{{ __('seo.da_placeholder') }}" onblur="DomainVal(this)">
                    <p id="error-message" class="text-danger"></p>
                </div>

                <div class="form-group col-md-3">
                    <label class="form-label">{{ __('seo.spam_score') }} </label>
                    <input type="text" name="spam_score" value="{{ old('spam_score') }}" id="website_spam_score"
                        class="form-control" placeholder="{{ __('seo.spam_score_placeholder') }}"
                        onblur="spamVal(this)">
                    <p id="error-message-spam-score" class="text-danger"></p>
                </div>

                <div class="form-group col-md-3">
                    <label class="form-label">{{ __('seo.do_follow') }} </label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input website_toggle_class" data-id="" id="customSwitch1">
                        <input type="hidden" value="0" name="do_follow" id="do_follow">
                        <label class="custom-control-label" for="customSwitch1"></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="col-sm-12 mb-3 mx-3 p-0">
                <button type="button" id="" class="btn btn-primary save-department">
                    Submit</button>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </form>
</div>
