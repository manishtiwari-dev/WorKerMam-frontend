<x-app-layout>
    @php
        $main_arr = [
            'title' => '',
            'sublist' => [
                [
                    'name' => 'SEO',
                    'link' => url('/submission'),
                ],
                [
                    'name' => '/Submission Url',
                    'link' => url('/role'),
                ],
            ],
        ];
    @endphp
@section('title', 'Submission Url')


    <div class="contact-content">
        <div class="layout-specing">
           
              <div class="card contact-content-body">
                <form action="{{ route('seo.submission-url.update', $seosubmissionwebsites->id) }}" id="userForm"
                    method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('put')
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h6 class="tx-15 mg-b-0">{{ __('seo.update_submission_form') }}</h6>
                        </div>
                    </div>

                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.website') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <select class="form-select form-control select2" id="website" name="website_id"
                                            aria-label="Default select example" required>

                                            <option selected disabled value="">{{ __('seo.select_website') }}
                                            </option>

                                            @foreach ($websites as $website)
                                                @php
                                                    $selected = '';
                                                    if ($website->id == $seosubmissionwebsites->website_id) {
                                                        $selected = 'selected';
                                                    }
                                                @endphp

                                                <option value="{{ $website->id }}" {{ $selected }}>
                                                    {{ $website->website_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            <p>Please select website</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.task_title') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <select class="form-select form-control select2" id="seo_task_id" name="seo_task_id"
                                            aria-label="Default select example" required>
                                            <option>{{ __('seo.select_task') }}</option>
                                            @foreach ($seotask as $seotasklist)
                                                @php
                                                    $selected = '';
                                                    if ($seotasklist->id == $seosubmissionwebsites->seo_task_id) {
                                                        $selected = 'selected';
                                                    }
                                                @endphp

                                                <option value="{{ $seotasklist->id }}" {{ $selected }}>
                                                    {{ $seotasklist->seo_task_title }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            <p>Please select task title</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.website_url') }}<span
                                            class="text-danger">*</span></label>
                                    <input name="website_url" id="website_url" type="text"
                                        value="{{ $seosubmissionwebsites->website_url }}" class="form-control "
                                        placeholder="{{ __('seo.website_url_placeholder') }}" required>
                                    <div class="invalid-feedback">
                                        <p>Please enter website url</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.username') }} </label>
                                    <input type="text" name="username" id="website_username" class="form-control @error('website_username') is-invalid @enderror"
                                        placeholder="{{ __('seo.username_placeholder') }}"
                                        value="{{ $seosubmissionwebsites->username }}" required>

                                        <div class="invalid-feedback">
                                            <p>Please enter username</p>
                                        </div>
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.email') }} </label>
                                    <input type="text" name="email" value="{{ $seosubmissionwebsites->email }}"
                                        id="email" class="form-control"
                                        placeholder="{{ __('seo.email_placeholder') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('seo.password') }} <span
                                            class="text-danger"></span></label>
                                    <input type="text" name="password"
                                        value="{{ $seosubmissionwebsites->password }}" id="website_password"
                                        class="form-control" placeholder="{{ __('seo.password_placeholder') }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label class="form-label">{{ __('seo.da') }} </label>
                                    <input type="text" name="da" id="da" class="form-control"
                                        placeholder="{{ __('seo.da_placeholder') }}"
                                        value="{{ $seosubmissionwebsites->da }}">
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="form-label">{{ __('seo.spam_score') }} </label>
                                    <input type="text" name="spam_score"
                                        value="{{ $seosubmissionwebsites->spam_score }}" id="website_spam_score"
                                        class="form-control" placeholder="{{ __('seo.spam_score_placeholder') }}">
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="form-label">{{ __('seo.do_follow') }} </label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                            {{ $seosubmissionwebsites->dofollow == 1 ? 'checked' : '' }}
                                            class="custom-control-input website_toggle_class" data-id=""
                                            id="customSwitch1">

                                        <input type="hidden" name="dofollow" id="do_follow">

                                        <label class="custom-control-label" for="customSwitch1"></label>
                                    </div>
                                </div>


                                <div class="form-group col-md-2">
                                    <label class="form-label">{{ __('seo.book_mark') }} </label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                            {{ $seosubmissionwebsites->book_mark == 1 ? 'checked' : '' }}
                                            class="custom-control-input toggle_class" data-id=""
                                            id="customSwitch2">

                                        <input type="hidden" name="book_mark" id="book_mark">

                                        <label class="custom-control-label" for="customSwitch2"></label>
                                    </div>
                                </div>




                            </div>


                        </div>
                        <!--end row-->


                        <div class="mt-3">
                            <div class="col-sm-12 p-0">
                                <input type="submit" id="submit" name="send" class="btn btn-primary" value="Update">
                                <a href="{{ route('seo.submission-url.index') }}"
                                    class="btn btn-light mx-1">{{ __('common.cancel') }}
                                </a>
                            </div>
                            <!--end col-->
                        </div>
                    </div>
                </div>
           
            <!--end row-->
            </form>
        </div>
    </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.website_toggle_class').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 0;

                    $("#do_follow").val(status);
                });


                $('.toggle_class').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 0;

                    $("#book_mark").val(status);
                });
                
            });
        </script>
    @endpush

</x-app-layout>
