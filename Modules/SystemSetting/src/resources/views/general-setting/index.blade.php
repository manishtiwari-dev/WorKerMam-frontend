<x-app-layout>
    @section('title', $pageTitle)
    {{-- @dd($pageAccess) --}}

    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')

        @php

            $currency = !empty($content->helperData->currency) ? $content->helperData->currency : '';
            $language = !empty($content->helperData->language) ? $content->helperData->language : '';
            $country = !empty($content->helperData->country) ? $content->helperData->country : '';
            $timezone = !empty($content->helperData->timezone) ? $content->helperData->timezone : '';
            $timeformat = !empty($content->helperData->timeformat) ? $content->helperData->timeformat : '';
            $dateformat = !empty($content->helperData->dateformat) ? $content->helperData->dateformat : '';
            $payment_methods = !empty($content->helperData->payment_methods) ? $content->helperData->payment_methods : '';
            $shipping_methods = !empty($content->helperData->shipping_methods) ? $content->helperData->shipping_methods : '';
            $taxGroup = !empty($content->helperData->taxGroup) ? $content->helperData->taxGroup : '';

        @endphp

        <div class="card contact-content-body">
            <div class="tab-content">
                <div class="card-header">
                    <h6 class="tx-15 mg-b-0">Setting List</h6>

                </div>
                <div class="card-body">
                    <form action="" class="needs-validation" id="settingForm" method="POST" novalidate
                        enctype="multipart/form-data">


                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @if (!empty($content->data_list))
                                @foreach ($content->data_list as $key => $list)
                                    <li class="nav-item">
                                        <a class="nav-link @if ($key == 0) active @endif"
                                            id="category-tab-{{ $list->group_id }}" data-bs-toggle="tab"
                                            href="#setting-content-{{ $list->group_id }}" role="tab"
                                            aria-controls="home" aria-selected="true">{{ $list->group_name }}</a>
                                    </li>
                                @endforeach
                            @endif

                        </ul>

                        <div class="tab-content bd bd-gray-300 bd-t-0 pd-20 border-0 px-0" id="myTabContent">
                            @if (!empty($content->data_list))
                                @foreach ($content->data_list as $key => $list)
                                    <div class="tab-pane fade show @if ($key == 0) active @endif"
                                        id="setting-content-{{ $list->group_id }}" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="form-row">
                                            @if (!empty($list->settings))
                                                @foreach ($list->settings as $key => $sett)
                                                    @php

                                                        $imageName = $sett->setting_key . '_image';

                                                        $optionValuesAry = '';
                                                        if ($sett->setting_options != '' && $sett->setting_options != null && $sett->option_type == 'dropdown') {
                                                            $optionString = $sett->setting_options;
                                                            $optionValuesAry = explode(',', $optionString);
                                                        } else {
                                                            $optionValuesAry = '';
                                                        }

                                                        $defaultValue = $sett->setting_value;

                                                    @endphp
                                                    <div class="form-group col-lg-6 ">

                                                        <label class="form-label">
                                                            {{ \App\Helper\Helper::translation($sett->setting_name) }}</label>
                                                        @if ($sett->setting_key == 'time_zone')
                                                            <select class="form-control  select2  " id=""
                                                                name="{{ $sett->setting_key }}">
                                                                <option selected disable value="" disabled>
                                                                    Select
                                                                </option>

                                                                @if (!empty($timezone))
                                                                    @foreach ($timezone as $key => $data)
                                                                        @php
                                                                            $selected = $data->label == $defaultValue ? 'selected' : '';
                                                                        @endphp

                                                                        <option value="{{ $data->value }}"
                                                                            {{ $selected }}>
                                                                            {{ $data->label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif($sett->setting_key == 'default_currency')
                                                            <select
                                                                class="form-control  select2 @error('countries_id') is-invalid @enderror "
                                                                id="" name="{{ $sett->setting_key }}">
                                                                <option selected disable value="" disabled>
                                                                    Select
                                                                </option>

                                                                @if (!empty($currency))
                                                                    @foreach ($currency as $key => $data)
                                                                        @php
                                                                            $selected = $data->value == $defaultValue ? 'selected' : '';
                                                                        @endphp
                                                                        <option value="{{ $data->value }}"
                                                                            {{ $selected }}>
                                                                            {{ $data->label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif($sett->setting_key == 'payment_method_enable')
                                                            <select
                                                                class="form-control  select2 
                                                             "
                                                                multiple="multiple" id=""
                                                                name="{{ $sett->setting_key }}[]">

                                                                @if (!empty($payment_methods))
                                                                    @foreach ($payment_methods as $key => $data)
                                                                        @php
                                                                            $valueArray = explode(',', $defaultValue);

                                                                            $isValueInArray = in_array($data->value, $valueArray);
                                                                            if ($isValueInArray) {
                                                                                $select = 'selected';
                                                                            } else {
                                                                                $select = '';
                                                                            }

                                                                        @endphp

                                                                        <option value="{{ $data->value }}"
                                                                            {{ $select }}>
                                                                            {{ $data->label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif($sett->setting_key == 'shipping_method_enable')
                                                            <select class="form-control  select2  " multiple="multiple"
                                                                id="" name="{{ $sett->setting_key }}[]">


                                                                @if (!empty($shipping_methods))
                                                                    @foreach ($shipping_methods as $key => $data)
                                                                        @php
                                                                            $valueArray = explode(',', $defaultValue);

                                                                            $isValueInArray = in_array($data->value, $valueArray);
                                                                            if ($isValueInArray) {
                                                                                $select = 'selected';
                                                                            } else {
                                                                                $select = '';
                                                                            }

                                                                        @endphp
                                                                        <option value="{{ $data->value }}"
                                                                            {{ $select }}>
                                                                            {{ $data->label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif($sett->setting_key == 'time_format')
                                                            <select
                                                                class="form-control 
                                                             select2  "
                                                                id="" name="{{ $sett->setting_key }}">
                                                                <option selected disable value="" disabled>
                                                                    Select
                                                                </option>

                                                                @if (!empty($timeformat))
                                                                    @foreach ($timeformat as $key => $data)
                                                                        @php
                                                                            $selected = $data->value == $defaultValue ? 'selected' : '';
                                                                        @endphp

                                                                        <option value="{{ $data->value }}"
                                                                            {{ $selected }}>
                                                                            {{ $data->label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif($sett->setting_key == 'date_format')
                                                            <select class="form-control  select2  " id=""
                                                                name="{{ $sett->setting_key }}">
                                                                <option selected disable value="" disabled>
                                                                    Select
                                                                </option>

                                                                @if (!empty($dateformat))
                                                                    @foreach ($dateformat as $key => $data)
                                                                        @php
                                                                            $selected = $data->value == $defaultValue ? 'selected' : '';
                                                                        @endphp
                                                                        <option value="{{ $data->value }}"
                                                                            {{ $selected }}>
                                                                            {{ $data->label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif($sett->setting_key == 'other_supported_currency')
                                                            <select class="form-control  select2  " multiple="multiple"
                                                                id="" name="{{ $sett->setting_key }}[]">

                                                                @if (!empty($currency))
                                                                    @foreach ($currency as $key => $data)
                                                                        @php
                                                                            $valueArray = explode(',', $defaultValue);

                                                                            $isValueInArray = in_array($data->value, $valueArray);
                                                                            if ($isValueInArray) {
                                                                                $select = 'selected';
                                                                            } else {
                                                                                $select = '';
                                                                            }

                                                                        @endphp

                                                                        <option value="{{ $data->value }}"
                                                                            {{ $select }}>
                                                                            {{ $data->label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif($sett->setting_key == 'other_supported_language')
                                                            <select class="form-control  select2  " multiple="multiple"
                                                                id="" name="{{ $sett->setting_key }}[]">


                                                                @if (!empty($language))
                                                                    @foreach ($language as $key => $data)
                                                                        @php
                                                                            $valueArray = explode(',', $defaultValue);

                                                                            $isValueInArray = in_array($data->value, $valueArray);
                                                                            if ($isValueInArray) {
                                                                                $select = 'selected';
                                                                            } else {
                                                                                $select = '';
                                                                            }

                                                                        @endphp

                                                                        <option value="{{ $data->value }}"
                                                                            {{ $select }}>
                                                                            {{ $data->label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif($sett->setting_key == 'default_language')
                                                            <select
                                                                class="form-control 
                                                             select2  "
                                                                id="" name="{{ $sett->setting_key }}">
                                                                <option selected disable value="" disabled>
                                                                    Select
                                                                </option>

                                                                @if (!empty($language))
                                                                    @foreach ($language as $key => $data)
                                                                        @php
                                                                            $selected = $data->value == $defaultValue ? 'selected' : '';
                                                                        @endphp
                                                                        <option value="{{ $data->value }}"
                                                                            {{ $selected }}>
                                                                            {{ $data->label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif($sett->setting_key == 'default_country')
                                                            <select class="form-control  select2 " id=""
                                                                name="{{ $sett->setting_key }}">
                                                                <option selected disable value="" disabled>
                                                                    Select
                                                                </option>

                                                                @if (!empty($country))
                                                                    @foreach ($country as $key => $data)
                                                                        @php
                                                                            $selected = $data->value == $defaultValue ? 'selected' : '';
                                                                        @endphp
                                                                        <option value="{{ $data->value }}"
                                                                            {{ $selected }}>
                                                                            {{ $data->label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif($sett->setting_key == 'other_operational_country')
                                                            <select class="form-control  select2   " multiple="multiple"
                                                                id="" name="{{ $sett->setting_key }}[]">

                                                                @if (!empty($country))
                                                                    @foreach ($country as $key => $data)
                                                                        @php
                                                                            $valueArray = explode(',', $defaultValue);

                                                                            $isValueInArray = in_array($data->value, $valueArray);
                                                                            if ($isValueInArray) {
                                                                                $select = 'selected';
                                                                            } else {
                                                                                $select = '';
                                                                            }

                                                                        @endphp

                                                                        <option value="{{ $data->value }}"
                                                                            {{ $select }}>
                                                                            {{ $data->label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif($sett->setting_key == 'country')
                                                            <select class="form-control  select2  " id=""
                                                                name="{{ $sett->setting_key }}">
                                                                <option selected disable value="" disabled>
                                                                    Select
                                                                </option>

                                                                @if (!empty($country))
                                                                    @foreach ($country as $key => $data)
                                                                        @php
                                                                            $selected = $data->value == $defaultValue ? 'selected' : '';
                                                                        @endphp
                                                                        <option value="{{ $data->value }}"
                                                                            {{ $selected }}>
                                                                            {{ $data->label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif($sett->setting_key == 'business_country')
                                                            <select class="form-control  select2  " id=""
                                                                name="{{ $sett->setting_key }}">
                                                                <option selected disable value="" disabled>
                                                                    Select
                                                                </option>

                                                                @if (!empty($country))
                                                                    @foreach ($country as $key => $data)
                                                                        @php
                                                                            $selected = $data->value == $defaultValue ? 'selected' : '';
                                                                        @endphp
                                                                        <option value="{{ $data->value }}"
                                                                            {{ $selected }}>
                                                                            {{ $data->label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif($sett->setting_key == 'landing_conatct_country')
                                                            <select class="form-control  select2 " id=""
                                                                name="{{ $sett->setting_key }}">
                                                                <option selected disable value="" disabled>
                                                                    Select
                                                                </option>

                                                                @if (!empty($country))
                                                                    @foreach ($country as $key => $data)
                                                                        @php
                                                                            $selected = $data->value == $defaultValue ? 'selected' : '';
                                                                        @endphp
                                                                        <option value="{{ $data->value }}"
                                                                            {{ $selected }}>
                                                                            {{ $data->label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif($sett->setting_key == 'tax_group')
                                                            <select class="form-control  select2 " id=""
                                                                name="{{ $sett->setting_key }}">
                                                                <option selected disable value="" disabled>
                                                                    Select
                                                                </option>

                                                                @if (!empty($taxGroup))
                                                                    @foreach ($taxGroup as $key => $data)
                                                                        @php
                                                                            $selected = $data->value == $defaultValue ? 'selected' : '';
                                                                        @endphp
                                                                        <option value="{{ $data->value }}"
                                                                            {{ $selected }}>
                                                                            {{ $data->label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif($sett->setting_key == 'per_page_item')
                                                            <select class="form-control  select2  " id=""
                                                                name="{{ $sett->setting_key }}">
                                                                <option selected disable value="" disabled>
                                                                    Select
                                                                </option>
                                                                @if (!empty($optionValuesAry))
                                                                    @foreach ($optionValuesAry as $label)
                                                                        @php
                                                                            $selected = $label == $defaultValue ? 'selected' : '';
                                                                        @endphp
                                                                        <option value="{{ $label }}"
                                                                            {{ $selected }}>
                                                                            {{ $label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif($sett->setting_key == 'tax_type')
                                                            <select class="form-control  select2  " id=""
                                                                name="{{ $sett->setting_key }}">
                                                                <option selected disable value="" disabled>
                                                                    Select
                                                                </option>
                                                                @if (!empty($optionValuesAry))
                                                                    @foreach ($optionValuesAry as $label)
                                                                        @php
                                                                            $selected = $label == $defaultValue ? 'selected' : '';
                                                                        @endphp
                                                                        <option value="{{ $label }}"
                                                                            {{ $selected }}>
                                                                            {{ $label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif ($sett->setting_key == 'enable_tax')
                                                            <select class="form-control  select2 " id=""
                                                                name="{{ $sett->setting_key }}">
                                                                <option selected disable value="" disabled>
                                                                    Select
                                                                </option>
                                                                @if (!empty($optionValuesAry))
                                                                    @foreach ($optionValuesAry as $label)
                                                                        @php
                                                                            $selected = $label == $defaultValue ? 'selected' : '';
                                                                        @endphp
                                                                        <option value="{{ $label }}"
                                                                            {{ $selected }}>
                                                                            {{ $label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif ($sett->setting_key == 'enable_tax')
                                                            <select class="form-control  select2 " id=""
                                                                name="{{ $sett->setting_key }}">
                                                                <option selected disable value="" disabled>
                                                                    Select
                                                                </option>
                                                                @if (!empty($optionValuesAry))
                                                                    @foreach ($optionValuesAry as $label)
                                                                        @php
                                                                            $selected = $label == $defaultValue ? 'selected' : '';
                                                                        @endphp
                                                                        <option value="{{ $label }}"
                                                                            {{ $selected }}>
                                                                            {{ $label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif ($sett->setting_key == 'invoice_send_reminder')
                                                            <select class="form-control  select2  " id=""
                                                                name="{{ $sett->setting_key }}">
                                                                <option selected disable value="" disabled>
                                                                    Select
                                                                </option>
                                                                @if (!empty($optionValuesAry))
                                                                    @foreach ($optionValuesAry as $label)
                                                                        @php
                                                                            $selected = $label == $defaultValue ? 'selected' : '';
                                                                        @endphp
                                                                        <option value="{{ $label }}"
                                                                            {{ $selected }}>
                                                                            {{ $label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif ($sett->setting_key == 'invoice_tax_number')
                                                            <select class="form-control  select2  " id=""
                                                                name="{{ $sett->setting_key }}">
                                                                <option selected disable value="" disabled>
                                                                    Select
                                                                </option>
                                                                @if (!empty($optionValuesAry))
                                                                    @foreach ($optionValuesAry as $label)
                                                                        @php
                                                                            $selected = $label == $defaultValue ? 'selected' : '';
                                                                        @endphp
                                                                        <option value="{{ $label }}"
                                                                            {{ $selected }}>
                                                                            {{ $label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif ($sett->setting_key == 'invoice_type')
                                                            <select class="form-control  select2  " id=""
                                                                name="{{ $sett->setting_key }}">
                                                                <option selected disable value="" disabled>
                                                                    Select
                                                                </option>
                                                                @if (!empty($optionValuesAry))
                                                                    @foreach ($optionValuesAry as $label)
                                                                        @php
                                                                            $selected = $label == $defaultValue ? 'selected' : '';
                                                                        @endphp
                                                                        <option value="{{ $label }}"
                                                                            {{ $selected }}>
                                                                            {{ $label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif ($sett->setting_key == 'invoice_reminder_interval')
                                                            <select class="form-control  select2  " id=""
                                                                name="{{ $sett->setting_key }}">
                                                                <option selected disable value="" disabled>
                                                                    Select
                                                                </option>
                                                                @if (!empty($optionValuesAry))
                                                                    @foreach ($optionValuesAry as $label)
                                                                        @php
                                                                            $selected = $label == $defaultValue ? 'selected' : '';
                                                                        @endphp
                                                                        <option value="{{ $label }}"
                                                                            {{ $selected }}>
                                                                            {{ $label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        @elseif ($sett->setting_key == 'invoice_reminder_times')
                                                            <select class="form-control  select2  " id=""
                                                                name="{{ $sett->setting_key }}">
                                                                <option selected disable value="" disabled>
                                                                    Select
                                                                </option>
                                                                @if (!empty($optionValuesAry))
                                                                    @foreach ($optionValuesAry as $label)
                                                                        @php
                                                                            $selected = $label == $defaultValue ? 'selected' : '';
                                                                        @endphp
                                                                        <option value="{{ $label }}"
                                                                            {{ $selected }}>
                                                                            {{ $label }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            {{-- textarea --}}
                                                        @elseif ($sett->option_type == 'textarea')
                                                            <textarea name="{{ $sett->setting_key }}" id="" class="form-control " value="" rows="8"
                                                                cols="40">
                                                            {{ $sett->setting_value }}
                                                        </textarea>
                                                            {{-- end text area --}}
                                                            {{-- Images Related --}}
                                                        @elseif ($sett->option_type == 'image')
                                                            @php
                                                                $valueImage = $sett->{$imageName};

                                                            @endphp

                                                            <input class="form-control select-file"
                                                                accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xls,.xlsx,.rtf"
                                                                type="file" name="{{ $sett->setting_key }}"
                                                                onchange="previewImage(event,`frame`)">

                                                            @if (!empty($valueImage))
                                                                <img src="{{ $valueImage }}" alt=""
                                                                    class="img-fluid mt-2" height="70px;"
                                                                    width="60">
                                                            @endif
                                                            {{-- end images related --}}
                                                        @else
                                                            <input name="{{ $sett->setting_key }}" type="text"
                                                                class="form-control" placeholder=""
                                                                value="{{ $sett->setting_value }}">
                                                        @endif


                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>

                                    </div>
                                @endforeach
                            @endif
                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                <div class="d-flex gap-3">
                                    <div class="p-0">
                                        <input type="submit" name="send"
                                            class="btn btn-primary UpdateSettingButton"
                                            value="{{ __('common.update') }}">
                                    </div>

                                </div>
                            @endif

                        </div>

                    </form>
                </div>
            </div>
        </div>

    @endif
    @push('scripts')
        <script>
            function previewImage(event, id) {
                var input = event.target;
                var image = document.getElementById(id);
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        image.src = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(document).on('submit', '.DataForm', function(event) {
                event.preventDefault();
                $('.DataForm').addClass('was-validated');
                if ($('.DataForm')[0].checkValidity() === false) {
                    event.stopPropagation();
                } else {
                    $('.DataForm')[0].submit()
                }
            });


            $(document).on("click", ".UpdateSettingButton", function(e) {
                e.preventDefault();

                // var EditSettingFormData = new FormData();
                // var formData = $('#settingForm').serialize();

                var profileimage = document.getElementById("settingForm");
                var formData = new FormData(profileimage);

                console.log(formData);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('/system-setting/appSetting/update') }}",
                    data: formData,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // if (response.status == 200) {
                        //     Notify(response.message, true);
                        //     setTimeout(function() {
                        //         location.reload(true);
                        //     }, 3000);
                        // }

                        Toaster('success', response.success);


                    }
                });

            });
        </script>
    @endpush

</x-app-layout>
