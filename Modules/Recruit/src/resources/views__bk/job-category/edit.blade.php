<x-app-layout>
     @section('title', 'Job Category')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">{{ __('modules.updatejobcategory') }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('recruit.job-categories.update', $jobcategory->id) }}"
                        class="ajax-form needs-validation" method="POST" id="createForm" novalidate>
                        @csrf
                        {{ method_field('PUT') }}

                        <div id="education_fields">
                            <div class="row">
                                <div class="col-sm-9 nopadding">
                                    <div class="form-group mb-0">
                                        <label for="name">@lang('menu.jobCategories') @lang('app.name')<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="name" value="{{ $jobcategory->name }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="@lang('menu.jobCategories') @lang('app.name')" required>
                                            <div class="invalid-feedback">
                                                <p>Please enter job category name</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="mt-3">
                            <div class="col-sm-12 p-0">
                                <button type="submit" class="btn btn-primary">
                                    Submit</button>
                                <a href="{{ route('recruit.setting.index', ['tab=job-category']) }}"
                                    class="btn btn-secondary mx-1">Cancel</a>

                            </div>
                            <!--end col-->

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
