<x-app-layout>
    @section('title', 'Contact')

    <div class="contact-content">
        <div class="layout-specing">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0">
                    <li class="breadcrumb-item"><a href="{{ route('marketing.contact-group-list.index') }}">Contact Group</a></li>
                </ol>
            </nav>
            <form action="{{ route('marketing.contact-import-process') }}" id="import-work-report-data-form"
                enctype="multipart/form-data" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="card contact-content-body">

                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h6 class="tx-15 mg-b-0">{{ __('newsletter.import_contact_group') }} </h6>
                        </div>
                    </div>

                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ __('newsletter.contact_group') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <select
                                            class=" form-control @error('contact_group') is-invalid @enderror select2"
                                            name="contact_group" id="contact_group" aria-label="Default select example"
                                            required>
                                            <option selected disabled value="">
                                                {{ __('newsletter.select_contact_group') }}
                                            </option>

                                            @if (!empty($group_data))
                                                @foreach ($group_data as $group)
                                                    <option value="{{ $group->id }}">{{ $group->group_name }}
                                                    </option>
                                                @endforeach
                                            @endif

                                        </select>
                                        <div class="invalid-feedback">
                                            <p>Please select contact group</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label
                                        class="form-label"> htyuytu {{ __('newsletter.upload_file') }}({{ __('seo.field_type') }})</label>
                                    <input type="file" name="import_file"
                                        data-allowed-file-extensions="xls xlsx csv txt" id="work_report_import"
                                        class="form-control ps-5 dropify" required>
                                </div>

                            </div>


                        </div>
                        <!--end row-->
                    </div>


                </div>
                <div class="mt-3">
                    <div class="col-sm-12 p-0">
                        <input type="submit" id="import-work-report-form" name="send" class="btn btn-primary"
                            value="{{ __('seo.upload') }}">
                        <a href="{{ route('marketing.contact-group-list.index') }}"
                            class="btn btn-light mx-1">{{ __('common.cancel') }} </a>
                    </div>
                    <!--end col-->
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
