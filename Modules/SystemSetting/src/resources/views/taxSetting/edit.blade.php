<x-app-layout>
    @section('title', 'Tax Setting')
    <style>
        .tagselect .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            background: transparent;
            border: 0;
            opacity: 1;
            left: 0;
        }
    </style>
    <div class="contact-content">
        <div class="layout-specing">
            <div class="card contact-content-body">

                {{-- @dd($taxperlist->tax_id) --}}
                @if (!empty($tax_per))
                    <form action="{{ route('system-setting.taxUpdate', $tax_per->tax_group_id) }}" method="post"
                        id="leadForm" class="needs-validation" novalidate>
                        @csrf
                        {{-- @method('put') --}}
                        <!--------- Primary contact info area start here ------------>
                        <div class="card-header d-flex align-items-center justify-content-between py-3 px-3">
                            <h6 class="tx-15 mg-b-0"> {{ $tax_group_name }}</h6>
                        </div>

                        <!--------- Social contact info area start here ------------>

                        <div class="card-body ">
                            <div class="" id="addMore">
                                {{-- <div class="" > --}}
                                <div class="d-flex justify-content-end mb-lg-0 mb-3">

                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-primary btn-outline add_more" type="button"
                                            id=""><i data-feather="plus"></i>Add
                                            More</button>

                                    </div>

                                </div>
                                <input type="hidden" value="{{ json_encode($taxPercent) }}" id="dbtaxPercentData">

                                {{-- @dd($taxPercent) --}}

                                @if (!empty($tax_per->tax_info))
                                    @foreach ($tax_per->tax_info as $key => $taxperlist)
                                        {{-- @dd($taxperlist->tax_id) --}}

                                        @php
                                            $selected_taxType = $taxperlist->tax_type_id;
                                            $selected_taxPer = $taxperlist->tax_percent;
                                            $selected_tax_id = $taxperlist->tax_id;
                                            //    @dd($tax_id)
                                        @endphp
                                        <input type="hidden" value="{{ json_encode($tax_type_list) }}"
                                            id="dbtaxTypeData">

                                        <input type="hidden" value="{{ $tax_per->tax_group_id }}" name="group_id">
                                        <div class="row" id="selectrow{{ $key + 1 }}">
                                            <div class="form-group col-md-4 col-5">
                                                <label for="website"
                                                    id="labelName">{{ __('user-manager.tax_name') }}</label>
                                                <select class="form-select form-control"
                                                    name="tax_type_id_{{ $selected_tax_id }}" id="tax_type">
                                                    <option selected disable value="" disabled>
                                                        {{ __('user-manager.tax_name_selcet') }}</option>
                                                    @foreach ($tax_type_list as $taxTypelist)
                                                        <option value={{ $taxTypelist->id }}
                                                            {{ $taxTypelist->id == $selected_taxType ? 'selected' : '' }}>
                                                            {{ $taxTypelist->tax_name }}</option>
                                                    @endforeach

                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select the text type
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4 col-5">
                                                <label for="social_link">{{ __('user-manager.tax_percent') }}</label>
                                                <input type="number" class="form-control" id="social_link"
                                                    placeholder="" name="tax_percent_{{ $selected_tax_id }}"
                                                    value="{{ $selected_taxPer ?? '' }}" required>
                                                <div class="invalid-feedback">
                                                    {{ __('user-manager.tax_percent_select') }}
                                                </div>
                                            </div>
                                            {{-- <div class="form-group col-md-2 col-2 plusbtn">
                                                                <button class="btn btn-primary add_more" type="button" id=""><i
                                                                        data-feather="plus"></i></button>
                                                            </div> --}}

                                            <div class="form-group col-md-4 col-2 plusbtn ">
                                                <div class="remove  btn btn-danger" id={{ $key + 1 }}
                                                    type="button">X</div>
                                            </div>

                                        </div>
                                    @endforeach
                                @else
                                    {{-- @php
                                                $k = 1;
                                               @endphp --}}
                                    <div class="row">

                                        <input type="hidden" value="{{ $tax_per->tax_group_id }}" name="group_id">
                                        <input type="hidden" value="{{ json_encode($tax_type_list) }}"
                                            id="dbtaxTypeData">
                                        <div class="form-group col-md-4 col-4">
                                            <label for="website">{{ __('user-manager.tax_name') }}</label>
                                            <select class="form-select form-control" name="tax_type_id[]"
                                                id="tax_type">
                                                <option selected disable value="" disabled>
                                                    {{ __('user-manager.tax_name_select') }}</option>
                                                @if (!empty($tax_type_list))
                                                    @foreach ($tax_type_list as $taxTypelist)
                                                        <option value={{ $taxTypelist->id }}>
                                                            {{ $taxTypelist->tax_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select the text type

                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-4">
                                            <label for="social_link">{{ __('user-manager.tax_percent') }}</label>
                                            <input type="number" class="form-control" id="social_link"
                                                placeholder="{{ __('user-manager.tax_percent') }}" name="tax_percent[]"
                                                required>
                                            <div class="invalid-feedback">
                                                {{ __('user-manager.tax_percent_select') }}
                                            </div>
                                        </div>

                                        {{-- <div class="form-group col-md-2 col-2 plusbtn">
                                                    <div class="btn_remove  btn btn-danger" id={{ $k++}} type="button">X</div>
                                                </div>  --}}
                                        {{-- 
                                                <div class="form-group col-md-2 col-2 plusbtn">
                                                    <button class="btn btn-primary add_more" type="button" id=""><i
                                                            data-feather="plus"></i></button>
                                                </div>  --}}
                                    </div>
                                @endif

                                {{-- </div> --}}
                            </div>
                            <!--end row-->
                        </div>
                        <!--end row-->
                        <div class="col-sm-12 p-0 mt-3">
                            <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Submit">
                            <a href="{{ route('system-setting.tax-setting') }}"
                                class="btn btn-secondary mx-1">Cancel</a>
                        </div>
                        <!--end col-->
                        <!--------- Social contact info area start here ----------->
                    </form>
                @endif

            </div>
        </div>
    </div>
    <!-- script start -->
    @push('scripts')
        <script>
            var global_tax_html = "";
            var global_tax_per_html = "";

            $('.select2').select2({});
            $(document).ready(function() {
                var i = 0;
                $('.add_more').click(function(e) {
                    e.preventDefault();
                    i++;


                    // var result = $global_tax_per_html;
                    // console.log(result) ;

                    //         if(global_tax_per_html !== ''){
                    //             $.each(global_tax_per_html, function(key, value) {
                    //             //    console.log(key) ;
                    //             html = `<div class="row taxPerList" id="row${i}">
            //             <div class="form-group col-md-4 col-4">
            //                 <select class="form-select form-control" name="tax_type_id_${value.tax_grp_id}" id="social_type" >
            //                     ${global_tax_html} 

            //                 </select>
            //                 <div class="invalid-feedback">
            //                     {{ __('user-manager.tax_name_select') }}
            //                 </div>
            //             </div>
            //             <div class="form-group col-md-4 col-4">
            //                 <input type="number" class="form-control" id="social_link" placeholder="{{ __('user-manager.tax_percent') }}" name="tax_percent[]" value="" >
            //                 <div class="invalid-feedback">
            //                     {{ __('user-manager.tax_percent_select') }}
            //                 </div>
            //             </div>
            //             <div class="form-group col-md-2 col-2">
            //                 <div class="btn_remove btn btn-danger" id="${i}" type="button">X</div>
            //             </div>
            //         </div>`;

                    //     });  
                    //  }


                    html = `<div class="row" id="row${i}">
                        <div class="form-group col-md-4 col-5">
                            <select class="form-select form-control" name="tax_type_id[]" id="social_type" >
                                ${global_tax_html} 
                                
                            </select>
                            <div class="invalid-feedback">
                                {{ __('user-manager.tax_name_select') }}
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-5">
                            <input type="number" class="form-control" id="social_link" placeholder="{{ __('user-manager.tax_percent') }}" name="tax_percent[]" value="" required>
                            <div class="invalid-feedback">
                                {{ __('user-manager.tax_percent_select') }}
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-2 ">
                            <div class="btn_remove btn btn-danger" id="${i}" type="button">X</div>
                        </div>
                    </div>`;




                    $('#addMore').append(html);
                });


                function tax_grp_dropdown(tax_grp_id = '') {
                    var total_data = $('#dbtaxTypeData').val();
                    var DBtaxType = jQuery.parseJSON(total_data);
                    var taxperdata = $('#dbtaxPercentData').val();
                    var DBtaxPer = jQuery.parseJSON(taxperdata);
                    //    console.log(DBtaxPer);

                    var tax_typeHtml = `<option  value="" > {{ __('user-manager.tax_name_select') }}</option>`;
                    var tax_result = [];

                    for (var i = 0; i < Object.keys(DBtaxType).length; i++) {
                        tax_typeHtml +=
                            `<option data="${DBtaxType[i].id}" ${tax_grp_id==DBtaxType[i].id ? 'selected':''} value="${DBtaxType[i].id}">${DBtaxType[i].tax_name}</option>`;
                    }

                    global_tax_html = tax_typeHtml;
                    global_tax_per_html = DBtaxPer;



                }



                $(document).ready(function() {
                    tax_grp_dropdown();
                });

                // Show Selected Dropdown of tax group when click add more 
                $(document).on('change', '#tax_type', function(e) {
                    tax_grp_dropdown($(this).val());
                });







                $(document).on('click', '.btn_remove', function() {
                    var button_id = $(this).attr("id");

                    console.log(button_id);
                    $('#row' + button_id + '').remove();
                });

                $(document).on('click', '.remove', function() {
                    var button_id = $(this).attr("id");
                    $('#selectrow' + button_id + '').remove();
                });
                $('#addLeadBtn').on("click", function() {
                    $('#leadForm').addClass('was-validated');
                    if ($('#leadForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        $('#leadForm').submit();
                    }
                });


                $(' label:gt(1)').remove();





            });
        </script>
        <script>
            $('.selectsearch').select2({

            });
        </script>
    @endpush

    <!-- script end-->
</x-app-layout>
