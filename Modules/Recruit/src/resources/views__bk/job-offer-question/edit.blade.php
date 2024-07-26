<x-app-layout>
    @section('title', $Title)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h4 class="card-title">Update Onboard Offer</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        
                            <form action="{{route('recruit.job-onboard-questions.update', $content->id)}}" class="ajax-form needs-validation" method="POST" id="userForm" novalidate>
                            @csrf
                            {{ method_field('PUT') }}

                            <input name="_method" type="hidden" value="PUT">

                        <div id="education_fields"></div>
                        <div class="row">
                            <div class="col-md-6 nopadding">
                                <div class="form-group">
                                     <label for="address" class="form-level">@lang('menu.question')<span
                                                class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" name="question" value="{{ $content->question }}" class="form-control" placeholder="@lang('menu.jobCategories') @lang('app.name')" required>
                                        <div class="invalid-feedback">
                                            <p>Please enter offer question</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">@lang('app.required')</label>
                                    <select name="required" class="form-control">
                                        <option @if($content->required == 'yes') selected @endif value="yes">@lang('app.yes')</option>
                                        <option @if($content->required == 'no') selected @endif  value="no">@lang('app.no')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">@lang('app.type')</label>
                                    <select name="type" class="form-control">
                                        <option @if($content->type == 'text') selected @endif value="text">@lang('app.text')</option>
                                        <option @if($content->type == 'file') selected @endif value="file">@lang('app.file')</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"></i> @lang('app.save')</button>
                        
                        <a href="{{ route('recruit.job-onboard-questions.index') }}" class="btn btn-secondary mx-1">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
@push('scripts')
<script>
    
</script>
@endpush
</x-app-layout>