<x-app-layout>
    @section('title', $pageTitle)

    <div class="contact-content">
        <div class="contact-content-header mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <ul class="nav nav-tabs gap-1" id="myTab" role="tablist">
                <li class="nav-item"> <a href="#airShipping"
                        class="nav-link {{ request()->tab == 'airShipping' || !isset(request()->tab) ? 'active' : '' }}"
                        data-bs-toggle="tab">Air Shipping</a></li>

                <li class="nav-item"> <a href="#seaShipping"
                        class="nav-link {{ request()->tab == 'seaShipping' ? 'active' : '' }}" data-bs-toggle="tab">
                        Sea Shipping</a></li>

            </ul>
            <a href="" id="contactOptions" class="text-secondary mg-l-auto d-xl-none"><i
                    data-feather="more-horizontal"></i></a>
        </div><!-- contact-content-header -->
        <div class="card contact-content-body">
            <div class="tab-content">
                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                    <div id="airShipping"
                        class="tab-pane show {{ request()->tab == 'airShipping' || !isset(request()->tab) ? 'active' : '' }}">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between ">
                                <h6 class="tx-15 mg-b-0">Custom Shipping Setting</h6>


                            </div>
                        </div>
                        <div class="card-body">
                            <div data-label="Example" class="df-example demo-table">

                                <form action="{{ route('papachina-product.shippingUpdate') }}" method="post"
                                    id="airForm" class="needs-validation" novalidate>
                                    @csrf


                                    <div class="card-body ">
                                        <div class="" id="addMore">
                                            <div class="d-flex justify-content-end mb-lg-0 mb-3">

                                                <div class="d-flex gap-1">
                                                    <button class="btn btn-sm btn-primary btn-outline add_more"
                                                        type="button" id=""><i data-feather="plus"></i>Add
                                                        More</button>

                                                </div>

                                            </div>
                                            <input type="hidden" value="air_shipping" id=""
                                                name="shipping_type">

                                            @if (!empty($content->air_shipping_details))
                                                @foreach ($content->air_shipping_details as $key => $list)
                                                    @php
                                                        $selected_air_shipping_id = $list->air_shipping_id;
                                                        $selected_old_air_start_weight = $list->air_start_weight;
                                                        $selected_old_air_end_weight = $list->air_end_weight;
                                                        $selected_old_air_rate = $list->air_rate;

                                                    @endphp
                                                    {{-- <input type="hidden" value="{{ json_encode($tax_type_list) }}"
                                                    id="dbtaxTypeData"> --}}

                                                    <input type="hidden" value="{{ $selected_air_shipping_id }}"
                                                        name="air_shipping_id[]">
                                                    <div class="row" id="selectrow{{ $key + 1 }}">



                                                        <div class="form-group col-md-3 col-3">
                                                            <label for="social_link" class="air-label">Start
                                                                Weight</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text"
                                                                    id="basic-addon1">kg</span>
                                                                <input type="text"
                                                                    id="start_weight_{{ $selected_air_shipping_id }}"class="form-control start_weight"
                                                                    onkeyup="validateNumbers({{ $selected_air_shipping_id }})"
                                                                    placeholder="" aria-label="Username"
                                                                    aria-describedby="basic-addon1"
                                                                    value="{{ $selected_old_air_start_weight ?? '' }}"
                                                                    name="old_air_start_weight_{{ $selected_air_shipping_id }}"
                                                                    required>
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                please enter a start weight
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3 col-3">
                                                            <label for="social_link" class="air-label">End
                                                                Weight</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text"
                                                                    id="basic-addon1">kg</span>
                                                                <input type="text"
                                                                    id="end_weight_{{ $selected_air_shipping_id }}"
                                                                    class="form-control end_weight"
                                                                    onkeyup="validateNumbers({{ $selected_air_shipping_id }})"
                                                                    placeholder="" aria-label="Username"
                                                                    aria-describedby="basic-addon1"
                                                                    value="{{ $selected_old_air_end_weight ?? '' }}"
                                                                    name="old_air_end_weight_{{ $selected_air_shipping_id }}"
                                                                    required>
                                                                <span
                                                                    class="message_{{ $selected_air_shipping_id }} msg"></span>
                                                            </div>


                                                            <div class="invalid-feedback">
                                                                please enter a start weight
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-3 col-3">
                                                            <label for="social_link" class="air-label">Rate/kg</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text"
                                                                    id="basic-addon1">$</span>
                                                                <input type="text" class="form-control"
                                                                    placeholder="" aria-label="Username"
                                                                    aria-describedby="basic-addon1"
                                                                    value="{{ $selected_old_air_rate ?? '' }}"
                                                                    name="old_air_rate_{{ $selected_air_shipping_id }}"
                                                                    required>
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                please enter a start weight
                                                            </div>
                                                        </div>


                                                        <div class="form-group col-md-3 col-3 plusbtn ">
                                                            <div class="remove  btn btn-danger" id={{ $key + 1 }}
                                                                type="button">X</div>
                                                        </div>

                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="row">

                                                    <div class="form-group col-md-3 col-3">
                                                        <label for="social_link" class="air-label">Start
                                                            Weight</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text"
                                                                id="basic-addon1 start_weight">kg</span>
                                                            <input type="text" class="form-control start_weight_1"
                                                                onkeyup="validateNumbers(1)" placeholder=""
                                                                aria-label="Username" aria-describedby="basic-addon1"
                                                                name="air_start_weight[]" required>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            please enter a start weight
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-3 col-3">
                                                        <label for="social_link" class="air-label">End Weight</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text"
                                                                id="basic-addon2 end_weight">kg</span>
                                                            <input type="text" class="form-control end_weight_1"
                                                                onkeyup="validateNumbers(1)" placeholder=""
                                                                aria-label="Username" aria-describedby="basic-addon1"
                                                                name="air_end_weight[]" required>

                                                            <span class="message_1 msg"></span>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            please enter a start weight
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-3 col-3">
                                                        <label for="social_link" class="air-label">Rate/kg</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">$</span>
                                                            <input type="text" class="form-control" placeholder=""
                                                                aria-label="Username" aria-describedby="basic-addon1"
                                                                name="air_rate[]" required>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            please enter a start weight
                                                        </div>
                                                    </div>



                                                </div>
                                            @endif

                                            {{-- </div> --}}
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end row-->
                                    <div class="col-sm-12 p-0 mt-3">

                                        {{-- <button onclick="validateNumbers()" class="btn btn-primary">Update</button> --}}

                                        <input type="submit" id="submit" name="submit" class="btn btn-primary"
                                            value="Update">

                                    </div>
                                    <!--end col-->
                                    <!--------- Social contact info area start here ----------->
                                </form>

                            </div><!-- df-example -->
                        </div>
                    </div>
                @endif
                <div id="seaShipping" class="tab-pane {{ request()->tab == 'seaShipping' ? 'active' : '' }}">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h6 class="tx-15 mg-b-0">Custom Shipping Setting</h6>

                        </div>
                    </div>
                    <div class="card-body">

                        <div data-label="Example" class="df-example demo-table">

                            <form action="{{ route('papachina-product.shippingUpdate') }}" method="post"
                                id="seaForm" class="needs-validation" novalidate>

                                @csrf
                                {{-- @method('put') --}}


                                <div class="card-body ">
                                    <div class="" id="addSeaMore">
                                        {{-- <div class="" > --}}
                                        <div class="d-flex justify-content-end mb-lg-0 mb-3">

                                            <div class="d-flex gap-1">
                                                <button class="btn btn-sm btn-primary btn-outline add_sea_more"
                                                    type="button" id=""><i data-feather="plus"></i>Add
                                                    More</button>

                                            </div>

                                        </div>
                                        <input type="hidden" value="sea_shipping" id=""
                                            name="shipping_type">

                                        @if (!empty($content->sea_shipping_details))
                                            @foreach ($content->sea_shipping_details as $key => $list)
                                                @php
                                                    $selected_sea_shipping_id = $list->sea_shipping_id;
                                                    $selected_old_cbm_low_range = $list->cbm_low_range;
                                                    $selected_old_cbm_high_range = $list->cbm_high_range;
                                                    $selected_old_sea_rate = $list->sea_rate;

                                                @endphp

                                                <input type="hidden" value="{{ $selected_sea_shipping_id }}"
                                                    name="sea_shipping_id[]">
                                                <div class="row" id="selectrow{{ $key + 1 }}">



                                                    <div class="form-group col-md-3 col-3">
                                                        <label for="social_link" class="sea-label">Start
                                                            Volume</label>
                                                        <div class="input-group mb-3">

                                                            <input type="text" class="form-control" placeholder=""
                                                                aria-label="Username" aria-describedby="basic-addon1"
                                                                value="{{ $selected_old_cbm_low_range ?? '' }}"
                                                                name="old_cbm_low_range_{{ $selected_sea_shipping_id }}"
                                                                required>
                                                            <span class="input-group-text"
                                                                id="basic-addon1">CBM</span>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            please enter a start weight
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-3 col-3">
                                                        <label for="social_link" class="sea-label">End Volume</label>
                                                        <div class="input-group mb-3">

                                                            <input type="text" class="form-control" placeholder=""
                                                                aria-label="Username" aria-describedby="basic-addon1"
                                                                value="{{ $selected_old_cbm_high_range ?? '' }}"
                                                                name="old_cbm_high_range_{{ $selected_sea_shipping_id }}"
                                                                required>
                                                            <span class="input-group-text"
                                                                id="basic-addon1">CBM</span>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            please enter a start weight
                                                        </div>
                                                    </div>

                                                    <div class="fform-group col-md-3 col-3">
                                                        <label for="social_link" class="sea-label">Rate/CBM</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">$</span>
                                                            <input type="text" class="form-control" placeholder=""
                                                                aria-label="Username" aria-describedby="basic-addon1"
                                                                value="{{ $selected_old_sea_rate ?? '' }}"
                                                                name="old_sea_rate_{{ $selected_sea_shipping_id }}"
                                                                required>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            please enter a start weight
                                                        </div>
                                                    </div>


                                                    <div class="form-group col-md-3 col-3 plusbtn ">
                                                        <div class="remove  btn btn-danger" id={{ $key + 1 }}
                                                            type="button">X</div>
                                                    </div>

                                                </div>
                                            @endforeach
                                        @else
                                            <div class="row">


                                                <div class="form-group col-md-3 col-3">
                                                    <label for="social_link" class="sea-label">Start Volume</label>
                                                    <div class="input-group mb-3">

                                                        <input type="text" class="form-control" placeholder=""
                                                            aria-label="Username" aria-describedby="basic-addon1"
                                                            name="cbm_low_range[]" required>
                                                        <span class="input-group-text" id="basic-addon1">CBM</span>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        please enter a start weight
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3 col-3">
                                                    <label for="social_link" class="sea-label">End Volume</label>
                                                    <div class="input-group mb-3">

                                                        <input type="text" class="form-control" placeholder=""
                                                            aria-label="Username" aria-describedby="basic-addon1"
                                                            name="cbm_high_range[]" required>
                                                        <span class="input-group-text" id="basic-addon1">CBM</span>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        please enter a start weight
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-3 col-3">
                                                    <label for="social_link" class="sea-label">Rate/CBM</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">$</span>
                                                        <input type="text" class="form-control" placeholder=""
                                                            aria-label="Username" aria-describedby="basic-addon1"
                                                            name="sea_rate[]" required>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        please enter a start weight
                                                    </div>
                                                </div>

                                            </div>
                                        @endif


                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end row-->
                                <div class="col-sm-12 p-0 mt-3">
                                    <input type="submit" id="submit" name="submit" class="btn btn-primary"
                                        value="Update">

                                </div>
                                <!--end col-->
                                <!--------- Social contact info area start here ----------->
                            </form>
                        </div><!-- df-example -->
                    </div>
                </div><!-- tab-pane -->


            </div><!-- tab-content -->
        </div><!-- contact-content-body -->

    </div><!-- contact-content -->

    @push('styles')
        <style>
            .msg {
                font-size: 13px;
                color: #ee5535;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>


        <!--end task delete ajax-->
        <script>
            var global_tax_html = "";
            var global_tax_per_html = "";
            $(document).ready(function() {
                var i = 0;
                $('.add_more').click(function(e) {
                    e.preventDefault();
                    // $(' .air-label:gt(2)').remove();
                    i++;
                    html = `<div class="row" id="row${i}">
                       
                        <div class="form-group col-md-3 col-3">
                                                  
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon start_weight">kg</span>
                                                        <input type="text" id="start_weight_${i}" class="form-control start_weight" placeholder="" onkeyup="validateNumbers(${i})"
                                                            aria-label="Username" aria-describedby="basic-addon1"
                                                            name="air_start_weight[]" required>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        please enter a start weight
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3 col-3">
                                                  
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">kg</span>
                                                        <input type="text" id="end_weight_${i}"  onkeyup="validateNumbers(${i})"class="form-control end_weight" placeholder=""
                                                            aria-label="Username" aria-describedby="basic-addon1"
                                                            name="air_end_weight[]" required>
                                                             <span
                                                                    class="message_${i} msg"></span>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        please enter a start weight
                                                    </div>
                                                </div>

                         

                           <div class="form-group col-md-3 col-3">
                                                 
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">$</span>
                                                        <input type="text" class="form-control" placeholder=""
                                                            aria-label="Username" aria-describedby="basic-addon1"
                                                            name="air_rate[]" required>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        please enter a start weight
                                                    </div>
                                                </div>



                        <div class="form-group col-md-3 col-3 ">
                            <div class="btn_remove btn btn-danger" id="${i}" type="button">X</div>
                        </div>
                    </div>`;




                    $('#addMore').append(html);
                });


                $(' .air-label:gt(2)').remove();

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








            });
        </script>


        <script>
            $(document).ready(function() {
                var i = 0;
                $(' .sea-label:gt(2)').remove();
                $('.add_sea_more').click(function(e) {
                    e.preventDefault();
                    i++;
                    html = `<div class="row" id="row${i}">
                       
                        <div class="form-group col-md-3 col-3">
                                                  
                                                    <div class="input-group mb-3">
                                                    
                                                        <input type="text" class="form-control" placeholder=""
                                                            aria-label="Username" aria-describedby="basic-addon1"
                                                            name="cbm_low_range[]" required>
                                                             <span class="input-group-text" id="basic-addon1">CBM</span>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        please enter a start weight
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3 col-3">
                                                  
                                                    <div class="input-group mb-3">
                                                      
                                                        <input type="text" class="form-control" placeholder=""
                                                            aria-label="Username" aria-describedby="basic-addon1"
                                                            name="cbm_high_range[]" required>
                                                             <span class="input-group-text" id="basic-addon1">CBM</span>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        please enter a start weight
                                                    </div>
                                                </div>

                         

                           <div class="form-group col-md-3 col-3">
                                                 
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">$</span>
                                                        <input type="text" class="form-control" placeholder=""
                                                            aria-label="Username" aria-describedby="basic-addon1"
                                                            name="sea_rate[]" required>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        please enter a start weight
                                                    </div>
                                                </div>



                        <div class="form-group col-md-3 col-3 ">
                            <div class="btn_remove btn btn-danger" id="${i}" type="button">X</div>
                        </div>
                    </div>`;




                    $('#addSeaMore').append(html);
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
            });

            function validateNumbers(i) {
                var start_weight = $('#start_weight_' + i).val();
                var end_weight = $('#end_weight_' + i).val();
                // var start_weight = parseFloat(document.getElementById('start_weight').value);
                console.log(end_weight);
                // var end_weight = parseFloat(document.getElementById('end_weight').value);


                if ((isNaN(start_weight) || isNaN(end_weight)) || (start_weight >= end_weight) && end_weight !== null) {
                    //  $('#end_weight_' + i).val('');
                    $(".message_" + i).text("end weight must be higher than the start weight");

                }
                // else if (start_weight <= end_weight) {
                //     $(".message_" + i).empty();

                // }
            }
        </script>
    @endpush
</x-app-layout>
