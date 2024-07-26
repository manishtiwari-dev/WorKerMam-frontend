<x-app-layout>
    @section('title', 'Work Report')

    <div class="contact-content">
        <div class="layout-specing"> 
            <form action="{{ route('crm.lead-import-store') }}" id="import-work-report-data-form"
                enctype="multipart/form-data" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="card contact-content-body">

                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h6 class="tx-15 mg-b-0">{{ __('crm.import_crm_lead') }} </h6>
                        </div>
                    </div>

                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="source_id">{{ __('crm.source') }}</label>
                                    <select class="form-select form-control select2" id="source_id"
                                        name="source_id" required>
                                        <option selected disable value="" disabled>{{ __('crm.source_select') }}
                                        </option>
                                        @if (!empty($leadsource))
                                            @foreach ($leadsource as $ls_data)
                                                <option value="{{ $ls_data->source_id }}"> {{ $ls_data->source_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ __('crm.source_error') }}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="industry_id">{{ __('crm.industry_type_group') }}</label>
                                    <select class="form-select form-control select2" name="industry_id"
                                        id="industry_id" required>
                                        <option selected disable value="" disabled>{{ __('crm.industry_select') }}
                                        </option>
                                        
                                        @if (!empty($industrydata))
                                            @foreach ($industrydata as $iData)
                                                <option value="{{ $iData->id }}"> {{ $iData->group_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ __('crm.industry_error') }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label
                                        class="form-label">{{ __('crm.upload_file') }}({{ __('crm.field_type') }})</label>
                                    <input type="file" name="import_lead_crm"
                                        data-allowed-file-extensions="xls xlsx csv txt" id=""
                                        class="form-control" required>
                                    <div class="invalid-feedback">
                                        Please Choose File
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-lg-12 col-sm-12  p-2 text-lg-left text-md-left">
                                <a href="{{route('crm.simple-download-file')}}"><b>Download Sample File</b></a>
                            </div>

                        </div>
                        <!--end row-->
                    </div>


                </div>
                <div class="mt-3">
                    <div class="col-sm-12 p-0">
                        <input type="submit" id="import-crm-lead-form" name="send" class="btn btn-primary"
                            value="{{ __('crm.upload') }}">
                        <a href="{{ route('crm.lead.index') }}" class="btn btn-light mx-1">{{ __('common.cancel') }}
                        </a>
                    </div>
                    <!--end col-->
                </div>
            </form>
        </div>
    </div>


</x-app-layout>
