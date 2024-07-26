<x-app-layout>
    @section('title', $Title)

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h4 class="card-title">Add Onboard Offer</h4>
                    </div>
                </div>
                <div class="card-body">

 
                    <form action="{{route('recruit.job-onboard-questions.store')}}" class="ajax-form needs-validation"
                            method="POST" id="userForm" novalidate>

                        @csrf

                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="address" class="form-level">@lang('menu.question')<span
                                                class="text-danger">*</span></label>
                                    <input type="text" name="question" class="form-control" placeholder="@lang('menu.question')" required>
                                    <div class="invalid-feedback">
                                        <p>Please enter offer Question</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="address">@lang('app.required')</label>
                                    <select name="required" class="form-control">
                                        <option value="yes">@lang('app.yes')</option>
                                        <option value="no">@lang('app.no')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="type">@lang('app.type')</label>
                                    <select name="type" class="form-control">
                                        <option value="text">@lang('app.text')</option>
                                        <option value="file">@lang('app.file')</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" id="" class="btn btn-primary"> SUbmit</button>

                        <a href="{{ route('recruit.job-onboard-questions.index') }}"
                                        class="btn btn-secondary mx-1">Cancel</a>
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