<x-app-layout>
    @section('title', 'Job Locations')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">{{ __('modules.updateJobLocation') }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('recruit.job-location.update', $location->id) }}"
                        class="ajax-form needs-validation" method="POST" id="" novalidate>
                        @csrf
                        {{ method_field('PUT') }}

                        <input name="_method" type="hidden" value="PUT">

                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="address">@lang('app.country')</label>
                                    <select name="country_id" id="country_id"
                                        class="form-control select2 custom-select @error('country_id') is-invalid @enderror">
                                        @if (!empty($countries))
                                        <option selected disabled>Select Country</option>
                                            @foreach ($countries as $country)
                                             
                                                <option @if ($country->countries_id == $location->country_id) selected @endif
                                                    value="{{ $country->countries_id }}">
                                                    {{ ucfirst($country->countries_name) }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>Please select country name</p>
                                    </div>
                                </div>

{{-- 
                                <div class="form-group">
                                    <label for="address">@lang('app.country')</label>
                                    <select name="country_id" id="country_id"
                                        class="form-control select2 custom-select @error('country_id') is-invalid @enderror">
                                        @if (!empty($countries))
                                        <option selected disabled>select country</option>
                                            @foreach ($countries as $country)
                                             
                                                <option @if ($country->countries_id == $location->country_id) selected @endif
                                                    value="{{ $country->countries_id }}">
                                                    {{ ucfirst($country->countries_name) }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>Please select country name</p>
                                    </div>
                                </div> --}}

                            </div>
                        </div>


                        <div id="education_fields"></div>
                        <div class="row">
                            <div class="col-sm-9 nopadding">
                                <div class="form-group">
                                    <input type="text" name="location"
                                        class="form-control  @error('locations') is-invalid @enderror"
                                        value="{{ $location->location }}"
                                        placeholder="@lang('menu.locations') @lang('app.name')" required>
                                    <div class="invalid-feedback">
                                        <p>Please enter job location name</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="col-sm-12 p-0">
                                <button type="submit" id="" class="btn btn-primary">
                                    Submit</button>
                                <a href="{{ route('recruit.setting.index', ['tab=location']) }}"
                                    class="btn btn-secondary mx-1">Cancel</a>
                            </div>
                            <!--end col-->
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/node_modules/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript">
        </script>

        <script> 
            $(".select2").select2();
            
        </script>
@endpush

</x-app-layout>
