
<x-app-layout>
    @section('title',  $pageTitle)
   @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true') 
    <div class="card contact-content-body">
        <div class="tab-content">
            <div class="card-header d-flex align-items-center justify-content-between py-2">
                <h6 class="tx-15 mb-0">{{__('crm.quotation_list')}}</h6>
                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true') 
                <a href="{{ route('sales.quotation.create') }}">
                    <button class="btn btn-md  btn-primary "><i data-feather="plus" class="lead_icon mg-r-5"></i>{{__('crm.add_quotation')}}</button></a>
                </a>
                @endif
            </div>
            <div class="card-body">

                 <!--Filter Start-->
                    <div class="row align-item-center mb-3 order-list-wrapper">

                        <div class="col-lg-3 mb-2">
                            <label>Invoice Number</label>
                            <input type="text" placeholder="Search..." class="form-control select-filter"
                                name="invoice_number" id="search" value="">
                        </div>

                        <div class="col-lg-3 mb-2">
                            <label>Customer</label>
                           <div>
                            <select class="form-control select2 select-filter" name="client_id" id="cliend_id">
                                    <option value="">All Customer</option>
                                    @if (!empty($content->customer))
                                        @foreach ($content->customer as $ls_data)
                                            <option value="{{ $ls_data->customer_id }}" > {{ $ls_data->first_name }} <br>  {{ $ls_data->company_name }} 
                                                <br> <span style="font-size:3px;">({{ $ls_data->email ?? '' }})</span>
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                           </div>
                        </div>

                        <div class="col-lg-2 mb-2 ">
                            <div class="tagselect">
                                 <label>Status</label>
                                 <select class="form-control select-filter select2" data-placeholder="Invoice Status" name="status"
                                     id="status"> 
                                    <option value ="">{{__('crm.select_status')}}</option>
                                    <option value ="0"> Deleted </option>
                                    <option value="1"> Pending </option>
                                    <option value="2"> Delivered </option>
                                    <option value="3"> Accepted </option>
                                    <option value="4"> Declined </option>
                                 </select>
                            </div>
                        </div>

                        <div class="col-lg-2 mb-2">
                            <label> Date Range </label>
                            <input type="text" id="datatableRange" name="datatableRange" class="form-control"
                                placeholder="{{ __('common.daterange_placeholder') }}" />
                        </div>

                       
                        <div class="col-lg-2 mt-4">
                            <div class="align-items-center ">
                                <a class="btn btn-primary px-5" href="{{ route('sales.quotation.index') }}"
                                    role="button">{{ __('common.reset') }}</a>
                            </div>
                        </div>
                    </div>
                <!--Filter End-->


                <div class="table-responsive" id="quotation_listing">
                    <table class="table  table_wrapper ">
                        <thead>
                            <tr>
                                <th class="border-bottom" style="min-width:70px;">{{__('common.sl_no')}}</th>
                                <th class="border-bottom" style="min-width: 150px;">{{__('crm.date')}}</th>
                                <th class="border-bottom" style="min-width: 150px;">{{__('crm.quotation_no')}}</th>
                                <th class="border-bottom" style="min-width: 150px;">{{__('crm.customer_delails')}}</th>
                                <th class="border-bottom" style="min-width: 150px;">Grand Total</th>
                                <th class="border-bottom" style="min-width: 100px;">{{__('common.status')}}</th>
                                <th class="text-center border-bottom" style="min-width: 70px;">{{__('common.action')}}
                                </th>
                            </tr>
                        </thead>
                        <tbody id="Search_Tr">
                           
                            <!-- Start -->
                            @if (!empty($content->quotation_list))
                                @foreach ($content->quotation_list as $key => $quotation)
                                {{-- @dd($quotation); --}}
                                    <tr>
                                        <td class="">{{ $key + 1 }}</td>
                                        <td class="">{{ \Carbon\Carbon::parse($quotation->created_at)->format('d-M-Y')}}</td>
                                        <td class="">{{ $quotation->quotation_no }}</td>               
                                        <td class="">
                                            @if (!empty($quotation->crm_quotation_customer))
                                            <h6 class="tx-13 mg-b-3">{{ $quotation->crm_quotation_customer->first_name }}</h6>
                                            <span class="tx-12">{{$quotation->crm_quotation_customer->email}}</span>
                                            @endif
                                        </td>
                                        <td class="">{{$content->defaultCurrency ?? ''}} {{ $quotation->final_cost }}</td>
                                        
                                        <td class="">
                                        <div class="custom-control custom-switch pl-0">

                                        <select class="form-select form-control change_status select2" id="customSwitch" name="status_name"  data-id="{{$quotation->id}}">
                                        <option value ="">{{__('crm.select_status')}}</option>
                                        <option  value ="0" {{$quotation->status == 0 ? 'selected' : '' }}>
                                            Deleted
                                            </option>
                                            <option value="1" {{$quotation->status == 1 ? 'selected' : '' }}>
                                            Pending
                                            </option>
                                            <option value="2" {{$quotation->status == 2 ? 'selected' : '' }}>
                                            Delivered
                                            </option>
                                            <option value="3" {{$quotation->status == 3 ? 'selected' : '' }}>
                                            Accepted
                                            </option>
                                            <option value="4" {{$quotation->status == 4 ? 'selected' : '' }}>
                                            Declined
                                            </option>
                                        </select>                                        
                                        </div>
                                        </td>
                                        <td class="d-flex align-items-center gap-2 justify-content-center">
                                        <a href="{{ url('sales/quotation/details/' . $quotation->id) }}"
                                        value=""
                                        class="btn btn-sm btn-white d-flex align-items-center mg-r-5">
                                        <i class="fa fa-eye"></i>
                                        </a>
                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true') 
                                        <a href="{{ route('sales.quotation.edit', $quotation->id) }}" class="btn btn-sm btn-white table_btn py-1 px-2"> <i class="fa fa-pencil" ></i></a>
                                        @endif

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8">
                                        <h5 class="text-center mb-0 py-1">{{__('common.no_record')}}</h5>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                 <!--Pagination Start-->
                  {!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'sales.quotation.index',['start_date'=>$content->start_date,'end_date'=>$content->end_date]) !!}
                  <!--Pagination End-->

                </div>
            </div>         
        </div><!--end row-->
    </div>     
    @endif
    <!--start delete modal-->
    <div class="modal fade effect-scale" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{__('crm.delete_quotation')}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_department_id" name="input_field_id">
                    <p class="mg-b-0">{{ __('common.delete_confirmation') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ __('common.no')}}
                    </button>
                    <button type="button" class="btn btn-primary delete_btn">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
       
        
    @push('scripts')
 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>

    <!-- delete ajax start -->
    <script>
        $(document).ready(function() { 
            $(document).on("click", "#delete_quotation", function() {
                var quotation_id = $(this).val();
                $('#delete_department_id').val(quotation_id);
            });
            $(document).on('click', '.delete_btn', function() {
                var quotation_id = $('#delete_department_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }); 
                $.ajax({
                    type: "POST",
                    url: "{{ url('sales/quotation-delete') }}",
                    data: { quotation_id: quotation_id },
                    dataType: "json",
                    success: function(response) {
                        Toaster(response.success);
                        setTimeout(function() {
                            location.reload(true);
                        }, 300);
                    }
                }); 
            });
        });
    // end delete ajax


        // change status in ajax code start
        $(document).on('change','.change_status',function(e){
            let status = $(this).val();
            var quotation_id =  $(this).data('id');
            console.log(quotation_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('sales/quotation-changeStatus') }}",
                data: {
                    status: status,
                    quotation_id : quotation_id
                },
                success: function(data) {
                    Toaster('success','Status Changed ');
                }
            });
        });
        // chenge status in ajax code end  

        // Date and Search filter start 

        $(function() {
            // tableWebContent();
            var start = moment();
            var end = moment();

            function cb(start, end) {
                $('#datatableRange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#datatableRange').daterangepicker({
                autoUpdateInput: false,
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last 6 Month': [moment().subtract(6, 'month'), moment()],
                    'Last Year': [moment().subtract(1, 'year'), moment()]
                },
                locale: {
                    format: 'YYYY-MM-D'
                }
            }, cb);

            cb(start, end);
        });

        $(document).ready(function() {
            $('input[name="datatableRange"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                ajaxSubmitData();
            });

            $("#search").on('keyup', function(e) {
                if ((this.value).length >= 3 || (this.value).length == 0) {
                    tableWebContent('', '', this.value,'','');
                } 
            });

        });

        function ajaxSubmitData() {
            var dateRangePicker = $('#datatableRange').data('daterangepicker');
            var startDate = $('#datatableRange').val();

            if (startDate == '') {
                startDate = null;
                endDate = null;
            } else {
                startDate = dateRangePicker.startDate.format('YYYY-MM-DD');
                endDate = dateRangePicker.endDate.format('YYYY-MM-DD');
            }

            if (startDate != ''  && endDate != '')
                $("#order_listing").html('');

            $("#order_listing").html('');
            tableWebContent(startDate, endDate);
        }

        $("#cliend_id").on('change', function(e) {   
            var search = $("#search").val(); 
            var status = $("#status").val();
            tableWebContent('', '',search, this.value, status); 
        });

        $("#status").on('change', function(e) {  
            var search = $("#search").val();
            var cliend_id = $("#cliend_id").val();
            tableWebContent('', '',search, cliend_id, this.value); 
        });

        


        function tableWebContent(startDate='', endDate='',search='' , cliend_id='', status='') {

            const url = "{{route('sales.quote-filter')}}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    search:search,
                    source:'1',
                    cliend_id:cliend_id,
                    status:status,
                },
                dataType: "json",
                success: function(result) {
                    $("#quotation_listing").html(result.html);
                }
            });
        }
    </script>

    @endpush 
</x-app-layout>