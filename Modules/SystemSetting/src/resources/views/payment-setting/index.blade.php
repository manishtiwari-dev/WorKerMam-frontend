<x-app-layout>
    @section('title', $pageTitle)

    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')

        <div class="card contact-content-body">
            <div class="tab-content">
                <div class="card-header">
                    <h6 class="tx-15 mg-b-0">Payment Setting</h6>

                </div>
                <div class="card-body">
                    <form action="" id="settingForm" class="needs-validation" method="POST" novalidate>



                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @if (!empty($content->data_list))
                                @foreach ($content->data_list as $key => $list)
                                    <li class="nav-item">
                                        <a class="nav-link @if ($key == 0) active @endif"
                                            id="category-tab-{{ $list->payment_method_id }}" data-bs-toggle="tab"
                                            href="#setting-content-{{ $list->payment_method_id }}" role="tab"
                                            aria-controls="home" aria-selected="true">{{ $list->method_name }}</a>
                                    </li>
                                @endforeach
                            @endif

                        </ul>

                        <div class="tab-content bd bd-gray-300 bd-t-0 pd-20 border-0 px-0" id="myTabContent">
                            {{-- @dd($data->language); --}}
                            @if (!empty($content->data_list))
                                @foreach ($content->data_list as $key => $list)
                                    <div class="tab-pane fade show @if ($key == 0) active @endif"
                                        id="setting-content-{{ $list->payment_method_id }}" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="form-row">
                                            @if (!empty($list->payment_methods_details))
                                                @foreach ($list->payment_methods_details as $key => $details)
                                                    @php
                                                        $optionValuesAry = '';
                                                        if ($details->setting_options != '' && $details->setting_options != null && $details->option_type == 'dropdown') {
                                                            $optionString = $details->setting_options;
                                                            $optionValuesAry = explode(',', $optionString);
                                                        } else {
                                                            $optionValuesAry = '';
                                                        }

                                                        $defaultValue = $details->method_value;

                                                    @endphp
                                                    <div class="form-group col-lg-6 ">
                                                        <label class="form-label">
                                                            {{ \App\Helper\Helper::translation($details->method_key) }}</label>

                                                        @if ($details->method_key == 'PAYPAL_MODE')
                                                            <select
                                                                class="form-control department select2 @error('countries_id') is-invalid @enderror "
                                                                id="" name="{{ $details->method_key }}">
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
                                                        @elseif ($details->method_key == 'STRIPE_MODE')
                                                            <select
                                                                class="form-control department select2 @error('countries_id') is-invalid @enderror "
                                                                id="" name="{{ $details->method_key }}">
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
                                                        @else
                                                            <input name="{{ $details->method_key }}" type="text"
                                                                class="form-control"
                                                                placeholder="{{ $details->method_key }}"
                                                                value="{{ $details->method_value }}">
                                                        @endif



                                                        <div class="invalid-feedback">

                                                        </div>


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
                                        <input type="submit" name="send" class="btn btn-primary UpdateSettingButton"
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
            // function previewImage(event, id) {
            //     var input = event.target;
            //     var image = document.getElementById(id);
            //     if (input.files && input.files[0]) {
            //         var reader = new FileReader();
            //         reader.onload = function(e) {
            //             image.src = e.target.result;
            //         }
            //         reader.readAsDataURL(input.files[0]);
            //     }
            // }


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
                    url: "{{ url('/system-setting/paymentSetting/update') }}",
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
