<style>
    .required:after {
        content: " *";
        color: red;
    }
</style>
<div class="row mt-2">
    @if (!is_null($job->required_columns))
        @if ($job->required_columns->gender)
            <div class="col-md-6 mt-3">
                <label class="control-label">@lang('modules.front.gender')</label>
                <div class="form-group">
                    <div class="form-inline">
                        @foreach ($gender as $key => $value)
                            <div class="form-check form-check-inline">
                                <input @if (!empty($application) && $key == $application->gender) checked @endif class="form-check-input"
                                    type="radio" name="gender" id="{{ $key }}" value="{{ $key }}">
                                <label class="form-check-label" for="{{ $key }}">{{ ucFirst($value) }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if ($job->required_columns->dob)
            <div class="col-md-6 mt-3">
                <div class="form-group mb-4">
                    <label class="control-label">@lang('modules.front.dob')</label>
                    <input class="form-control dob" type="text" name="dob" placeholder="@lang('modules.front.dob')"
                        autocomplete="none">
                    <div class="invalid-feedback">
                        <p>Please Select DOB</p>
                    </div>
                </div>
            </div>
        @endif




 
        @if ($job->required_columns->country)
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label class="control-label">@lang('modules.front.country')</label>
                    <select class="form-control select2 countries" name="country" id="countryId">
                        <option value="0">@lang('modules.front.selectCountry')</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">State</label>
                    <select class="form-control select2 states" name="state" id="stateId">
                        <option value="0">@lang('modules.front.selectState')</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group  mb-4">
                    <label class="control-label">City</label>
                    <input class="form-control" type="text" name="city" id="cityId"
                        placeholder="@lang('modules.front.selectCity')" value="{{ !empty($application) ? $application->city : '' }}">
                </div>
            </div>
        @endif
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">ZipCode</label>
                    <input class="form-control" type="text" name="zip_code"
                        value="{{ !empty($application) ? $application->zip_code : '' }}" id="zipCode"
                        placeholder="@lang('modules.front.zipCode')">
                </div>
            </div>
         
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label class="control-label">@lang('app.address')</label>
                    <textarea class="form-control" name="address"rows="4" cols="50" placeholder="@lang('app.address')">{{ !empty($application) ? $application->address : '' }}</textarea>
                    <div class="invalid-feedback">
                        <p>Please enter address</p>
                    </div>
                </div>
            </div> 
    @endif
</div>

    <script>
        var datepicker = $('.dob').datepicker({
            dateFormat: 'dd/mm/yy',
            onSelect: function() {
                var selected = $(this).datepicker("getDate");
            }
        });
    </script>
    
