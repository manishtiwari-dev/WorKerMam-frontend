<x-app-layout>
    @section('title', $pageTitle)

    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
    <div class="card contact-content-body">
        <div class="tab-content">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="tx-15 mg-b-0">Add On Manager</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  table_wrapper  px-3">
                        <thead>
                            <tr>
                                <th class="border-bottom ">#</th>
                                <th class="border-bottom " style="min-width: 220px;">Add On</th>
                                <th class=" border-bottom ">Version</th>
                                <th class="border-bottom ">Status</th>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                <th class="border-bottom">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($content->add_on))
                                @foreach ($content->add_on as $key => $data)
                                    <tr>
                                        <td class="">{{ $key + 1 }}</td>
                                        <td class="">{{ $data->addon_name }}</td>
                                        <td class="">{{ @$data->version }}</td>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox"
                                                    class="custom-control-input toggle-class"
                                                    {{  $data->add_on_manager->status == '1' ? 'checked' : '' }}
                                                    data-id="{{ $data->id }}"
                                                    id="customSwitch{{ $data->id }}">
                                                <label class="custom-control-label"
                                                    for="customSwitch{{ $data->id }}"></label>
                                            </div>
                                        </td>
                                      
                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                        <td class="">

                                            <a href="#papachina_edit"
                                            class="btn btn-sm  table_btn py-1 px-2" id="papachina_editmodal"
                                            data-toggle="modal" data-id="{{ $data->id }}">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                            <span class="d-sm-inline mg-l-5"></span>
                                            </a>

                                            {{-- <a href="#papachina_edit" data-id="{{ $data->id }}"
                                                id="papachina_editmodal" data-toggle="modal"
                                                class="d-flex align-items-center gap-2 justify-content-center"><i
                                                    data-feather="eye"></i><span
                                                    class="d-none d-sm-inline mg-l-5"></span></a> --}}
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Edit modal start here -->
    <div class="modal fade" id="papachina_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-14">
                <form id="addon_update_userForm" class="needs-validation" novalidate>

                    <div class="modal-header">
                        <h6 class="modal-title tx-16" id="exampleModalLabel">PapaChina Api Setting</h6>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input name="add_on_id" id="hidden_addOn_id" type="hidden" class="form-control">

                        <div class="card ">
                            <div class="tab-content">
                                <div class="card-header d-flex align-items-center justify-content-between p-0">
                                    <h5 class="tx-14 mb-1">Profit Percent Setting</h5>
                                </div>
                                <div class="card-body py-0 border">

                                    <div class=" row">

                                        <div class="col-sm-12 col-form-label profit_per border-bottom d-flex gap-3">
                                            <label class="form-label mb-0 tx-13">Profit Margin Type <span
                                                    class="text-danger mg-l-5"></label>
                                            <div class="d-flex align-items-center gap-1">
                                                <input type="radio" class="single_profit" id="profit_margin_type"
                                                name="pc_profit_margin_type" value="single">
                                                <label for="Choice1" class="mb-0 tx-13">Single</label>
                                            </div>

                                            <div class="d-flex align-items-center gap-1"><input type="radio" class="mul_profit" id="mul_margin_type"
                                                name="pc_profit_margin_type" value="multiple">
                                            <label for="Choice2" class="mb-0 tx-13">Multiple</label></div>

                                        </div>
                                        <!-- <div class="col-sm-4 col-form-label ">
                                        </div> -->

                                        <div class="form-icon col-sm-12 single_margin my-2" id="">
                                            <input type="number" step="0.01" name="pc_profit_margin"
                                                class="form-control" id="profit_percent" value="">
                                        </div>

                                        <div class="form-icon col-sm-12 multple_qty  mb-2" id="">
                                            <div class="table-responsive mt-2">
                                                <table class="table   table_wrapper ">
                                                    <tr>
                                                        <th class="text-black tx-13">QTY</th>
                                                        @for ($i = 1; $i <= 10; $i++)
                                                            <th class=" text-black" style="min-width:10px;">
                                                                Qty{{ $i }}</th>
                                                        @endfor
                                                    </tr>

                                                    <tr>
                                                        <td>Profit(%)</td>
                                                        @for ($i = 1; $i <= 10; $i++)
                                                            <td class="text-center p-0">
                                                                <input type="number"
                                                                    name="pc_profit_margin_qty_{{ $i }}"
                                                                    class="form-control col-xs-1  width1 margin_qty_{{ $i }}"
                                                                    placeholder="" required>

                                                                <span class="text-danger">
                                                                    @error('pc_profit_margin_qty_{{ $i }}')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </span>

                                                                {{-- <div class="invalid-feedback">
                                                                    <p>Enter Qty</p>
                                                                </div> --}}

                                                            </td>
                                                        @endfor

                                                    </tr>

                                                </table>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <!--end row-->
                        </div>

                        <div class="card mt-2">
                          
                                <div class="card-header d-flex align-items-center justify-content-between  px-0 pt-3 mb-0">
                                    <h5 class="tx-14 mb-0">Shipping Setting</h5>
                                </div>
                                <div class="border pt-3 px-3">
                                    <div class="col-lg-12 px-0" id="addMore">
                                        @if (!empty($content->country))
                                            {{-- @dd($country) --}}
                                            @foreach ($content->country as $key => $data)
                                                <div class="row ship-country-{{ $data->countries_id }}">
                                                    {{-- @dd($data) --}}

                                                    <div class="form-group col-md-4 col-6">
                                                        <label for="website" class="tx-13">{{ __('crm.country') }}</label>
                                                        <input type="text" class="form-control" id=""
                                                            value="{{ $data->countries_name }}" value=""
                                                            readonly="readonly">

                                                        <div class="invalid-feedback">
                                                            {{ __('crm.social_type_select') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4 col-6">
                                                        <label for="website"  class="tx-13">Shipping Option</label>

                                                        <select
                                                            class="form-select form-control shipping-{{ $data->countries_id }}"
                                                            name="pc_shipping_option_{{ $data->countries_id }}"
                                                            id="shipping" required="">
                                                            <option value="air_shipping">Air Shipping</option>

                                                            <option value="sea_shipping">Sea Shipping</option>

                                                        </select>

                                                    </div>

                                                    <div class="form-group col-md-4 col-12  sea_port-{{ $data->countries_id }}"
                                                        style="display:none">
                                                        <label for="website"  class="tx-13">Sea Port</label>

                                                        <select
                                                            class="form-select form-control seaPort-{{ $data->countries_id }}"
                                                            name="pc_sea_port_{{ $data->countries_id }}"
                                                            id="" required="">

                                                        </select>

                                                    </div>

                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                   
                                    <!--end row-->
                                </div>
                                <div>
                                        <div class="col-sm-12 px-0 pt-3">
                                            {{-- <input type="submit" id="papachina_update_btn" name="send"
                                                class="btn btn-primary" value="Submit"> --}}

                                            <button type="button" class="btn btn-primary"
                                                id="addon_update_btn">{{ __('common.submit') }}</button>

                                            <a href="{{ route('add-on.add-on-manager') }}"
                                                class="btn btn-secondary mx-1">Cancel</a>
                                        </div>
                                        <!--end col-->
                                    </div>
                            <!--end row-->
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Edit modal end here -->
    @push('scripts')
        <script type="text/javascript">
            var country_list = "";
            $('.toggle-class').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('add-on.addOnChangeStatus') }}",
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(response) {
                        console.log(response);
                        Toaster('success' , response.success);
                    }
                });
            });
            // modal edit open ajax 
            $(document).on("click", "#papachina_editmodal", function(e) {

                e.preventDefault();
                var addon_id = $(this).data('id');
                console.log(addon_id);
                $('#papachina_edit').modal('show');
                $.ajax({
                    url: "{{ url('add-on/add-on-manager/edit') }}/" + addon_id,
                    type: "GET",
                    success: function(response) {

                        console.log(response);

                        var shippingData = response.data.settinglist;

                        var qty_id = 'margin_qty';

                        console.log(pro_qty);

                        var countryData = response.data.country;
                        var seoPortHtml = `<option selected  value="" >{{ __('crm.select') }}</option>`;

                        if (response.status == 400) {
                            $('#errorlist').html("");
                            $('#errorlist').addClass("alert alert-danger");
                            $('#errorlist').append('<li>' + response.message + '</li>');

                        } else {

                            //    console.log(shippingData.pc_profit_margin_qty_1);
                            $('#profit_percent').val(shippingData.pc_profit_margin);

                            if (shippingData.pc_profit_margin_type == 'multiple') {
                                $('#mul_margin_type').prop('checked', 'true');
                                $(".single_margin").hide();
                                $(".multple_qty").show();

                            } else {
                                $('#profit_margin_type').prop('checked', 'true');
                                $(".multple_qty").hide();
                                $(".single_margin").show();
                            }


                            for (var i = 1; i <= 10; i++) {
                                var pro_qty = 'pc_profit_margin_qty_' + String(i);
                                $('.margin_qty_' + i).val(shippingData[pro_qty]);

                            }



                            $.each(response.data.country, function(key, country) {
                                //  console.log(country.countries_id);
                                var cid = (country.countries_id);
                                var s_op_key = "pc_shipping_option_" + cid;
                                var s_port_key = "pc_sea_port_" + cid;

                                $(".ship-country-" + cid).find('.sea_port').val(shippingData[
                                    s_port_key]);
                                $(".ship-country-" + cid).find('.shipping-' + cid +
                                    ' option[value="' +
                                    shippingData[s_op_key] + '"]').prop('selected',
                                    true);

                                $.each(country.seapoprt, function(keys, seaport) {
                                    seoPortHtml +=
                                        `<option  ${seaport.seaport_id ==  shippingData[s_port_key]  ? 'selected' :''}  value="${seaport.seaport_id}">${seaport.seaport_name}</option>`;
                                });

                                $(".seaPort-" + cid).html(seoPortHtml);

                                if (shippingData[s_op_key] == 'sea_shipping') {

                                    $(".sea_port-" + cid).show();

                                } else {
                                    $(".sea_port-" + cid).hide();

                                }


                                $(".shipping-" + cid).change(function(event) {
                                    var value = $(this).val();
                                    if (value == 'air_shipping') {
                                        $(".sea_port-" + cid).hide();
                                    } else if (value == 'sea_shipping') {
                                        $(".sea_port-" + cid).show();
                                    }

                                });

                            });

                            $('#hidden_addOn_id').val(addon_id);
                        }
                    }
                });
            });


            if ($(".single_profit").is(":checked")) {
                $(".multple_qty").hide();

            } else {
                $(".single_margin").show();
            }


            //hide and show profit margin
            $(document).ready(function() {
                $(".single_profit").click(function(event) {

                    $(".multple_qty").hide();
                    $(".single_margin").show();

                });

                $(".mul_profit").click(function(event) {

                    $(".single_margin").hide();
                    $(".multple_qty").show();


                });
            });


            //end show profit margin
        </script>

        <!--update shipping  ajax-->
        <script>
            $(document).on("click", "#addon_update_btn", function(e) {
                e.preventDefault();
              
                // $('#').addClass('was-validated');
                // if ($('#')[0].checkValidity() === false) {
                //     event.stopPropagation();
                // }
                
                    var fd = new FormData();
                    var other_data = $('#addon_update_userForm').serialize();
                
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('add-on.add-on-managerUpdate') }}",

                        type: "POST",
                        data: other_data,
                        dataType: "json",
                        success: function(response) {

                            $('#modal1').removeClass('show');
                            $('#modal1').css('display', 'none');
                        

                            // if (response.status == 1) {
                            //      Toaster('success',response.success);

                            // }

                            Toaster('success', response.success);

                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);

                            window.location.href = "{{ route('add-on.add-on-manager') }}";

                        },


                    });
              
            });
        </script>
        <!--end update  ajax-->


      
    @endpush
</x-app-layout>
