<x-app-layout>
     @section('title', 'Job Category')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">{{ __('modules.addjobcategory') }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('recruit.job-categories.store') }}" class="ajax-form needs-validation"
                        method="POST" id="createForm" novalidate>
                        @csrf

                        <div id="education_fields">
                            <div class="row">
                                <div class="col-sm-9 nopadding">
                                    <div class="form-group">
                                        <label for="name">@lang('menu.jobCategories') @lang('app.name')<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group gap-2">
                                            <input type="text" name="name[]"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="@lang('menu.jobCategories') @lang('app.name')" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button" id="add-more"><i
                                                        class="fa fa-plus"></i></button>
                                            </div>
                                            <div class="invalid-feedback">
                                                <p>Please enter job category name</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="col-sm-12 p-0">
                                <button type="submit" id="" class="btn btn-primary py-2">
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


    @push('scripts')
        <script>
            var room = 1;

            $('#add-more').click(function() {
                room++;

                var divtest = `
            <div class="row removeclass${room}">
                <div class="col-sm-9 nopadding">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="name[]" class="form-control  @error('name') is-invalid @enderror" placeholder="@lang('menu.jobCategories') @lang('app.name')">
                            <div class="input-group-append ">
                                <button class="btn btn-danger" type="button" onclick="remove_education_fields(${room});">
                                    <i class="fa fa-minus"></i>
                                </button>
                                 <div class="invalid-feedback">
                                                <p>Please enter job category name</p>
                                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>`;

                $('#education_fields').append(divtest);
                $(`.removeclass${room} input`).focus();
            })

            function remove_education_fields(rid) {
                $('.removeclass' + rid).remove();
            }
        </script>
    @endpush
</x-app-layout>
