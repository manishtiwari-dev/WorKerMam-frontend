<x-app-layout>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">{{ __('modules.addQuestion') }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('recruit.questions.store') }}" class="ajax-form needs-validation" method="POST"
                        id="userForm" novalidate>
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address" class="required">@lang('menu.question')</label>
                                    <input type="text" name="question"
                                        class="form-control  @error('question') is-invalid @enderror"
                                        value="{{ old('question') }}" placeholder="@lang('menu.question')" required>
                                    <div class="invalid-feedback">
                                        <p>Please enter question name</p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address">@lang('app.required')</label>
                                    <select name="required" class="form-control" required>
                                        <option value="yes">@lang('app.yes')</option>
                                        <option value="no">@lang('app.no')</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>Please select address</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type">@lang('app.type')</label>
                                    <select name="type" class="form-control" required>
                                        <option value="text">@lang('app.text')</option>
                                        <option value="file">@lang('app.file')</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>Please select type</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="col-sm-12 p-0">
                                <button type="submit" id="" class="btn btn-primary">
                                    Submit</button>
                                <a href="{{ route('recruit.questions.index') }}"
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
    @endpush

</x-app-layout>
