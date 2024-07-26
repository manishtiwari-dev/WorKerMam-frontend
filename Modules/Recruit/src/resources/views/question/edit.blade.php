<x-app-layout>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">{{ __('modules.updateQuestion') }}</h6>
                    </div>
                </div>
                <div class="card-body">

                    <form action="{{ route('recruit.questions.update', $question->id) }}"
                        class="ajax-form needs-validation" method="POST" id="userForm" novalidate>
                        @csrf
                        {{ method_field('PUT') }}

                        <input name="_method" type="hidden" value="PUT">

                        <div id="education_fields"></div>
                        <div class="row">
                            <div class="col-sm-4 nopadding">
                                <div class="form-group">
                                    <label for="address" class="required">@lang('menu.question')</label>
                                    <input type="text" name="question" value="{{ $question->question }}"
                                        class="form-control @error('question') is-invalid @enderror"
                                        placeholder="@lang('menu.jobCategories') @lang('app.name')" required>
                                    <div class="invalid-feedback">
                                        <p>Please enter question name</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address">@lang('app.required')</label>
                                    <select name="required" class="form-control">
                                        <option @if ($question->required == 'yes') selected @endif value="yes">
                                            @lang('app.yes')</option>
                                        <option @if ($question->required == 'no') selected @endif value="no">
                                            @lang('app.no')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type">@lang('app.type')</label>
                                    <select name="type" class="form-control">
                                        <option @if ($question->type == 'text') selected @endif value="text">
                                            @lang('app.text')</option>
                                        <option @if ($question->type == 'file') selected @endif value="file">
                                            @lang('app.file')</option>
                                    </select>
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
