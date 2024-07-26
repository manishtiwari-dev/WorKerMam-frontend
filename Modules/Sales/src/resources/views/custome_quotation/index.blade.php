
<x-app-layout>
    @section('title',  $pageTitle)
   @if (\App\Helper\Helper::CheckPermission($pageCustomAccess, 'view') == 'true') 
    <div class="card contact-content-body">
        <div class="tab-content">
            <div class="card-header d-flex align-items-center justify-content-between py-2">
                <h6 class="tx-15 mb-0">{{__('crm.quotation_list')}}</h6>
                @if (\App\Helper\Helper::CheckPermission($pageCustomAccess, 'add') == 'true') 
                <a href="{{ route('sales.create-custome-quote') }}">
                    <button class="btn btn-md  btn-primary "><i data-feather="plus" class="lead_icon mg-r-5"></i>{{__('crm.add_quotation')}}</button></a>
                </a>
                @endif
            </div>
            <div class="card-body">
        
                 <!--Filter Start-->
                <div class="row align-item-center mb-3 order-list-wrapper">
                    <div class="col-lg-5">
                        <div class="form-icon position-relative d-flex mb-2 mb-lg-0 mb-md-0">
                            <p class="mb-0 d-md-flex d-lg-flex d-none d-md-block d-lg-block text-dark-grey align-items-center mr-3 ">
                                {{ __('seo.date') }}
                            </p>
                            <input type="text" id="datatableRange" name="datatableRange" class="form-control"
                                placeholder="{{ __('common.daterange_placeholder') }}" />
                        </div>
                    </div>

                    <div class="col-lg-5 mb-2 mb-lg-0 mb-md-0">
                        <input type="text" id="search" value="{{ $search ?? '' }}" class="form-control fas fa-search"
                            placeholder="Search..." aria-label="Search" name="search">
                    </div>
                    <div class="col-lg-2 d-flex">
                        <div class="align-items-center ">
                            <a class="btn btn-primary px-5" href="{{ route('sales.custom-quote') }}"
                                role="button">{{ __('common.reset') }}</a>
                        </div>
                    </div>
                </div>
                <!--Filter End-->


                <div class="table-responsive" id="quotation_listing">
                    <table class="table  table_wrapper">
                        <thead>
                            <tr>
                                <th class="border-bottom" style="min-width:70px;">{{__('common.sl_no')}}</th>
                                <th class="border-bottom" style="min-width: 150px;">{{__('crm.date')}}</th>
                                <th class="border-bottom" style="min-width: 150px;">{{__('crm.quotation_no')}}</th>
                                <th class="border-bottom" style="min-width: 150px;">{{__('crm.customer_delails')}}</th>
                                <th class="border-bottom" style="min-width: 150px;">{{__('crm.quote_price')}}</th>
                                <th class="border-bottom text-center" style="min-width: 100px;">{{__('common.status')}}</th>
                                <th class="text-center border-bottom" style="min-width: 70px;">{{__('common.action')}}
                                </th>
                            </tr>
                        </thead>
                        <tbody id="Search_Tr">
                           
                            <!-- Start -->
                            @if (!empty($content->quotation_list))
                                @foreach ($content->quotation_list as $key => $quotation)
                                    <tr>
                                        <td class="">{{ $key + 1 }}</td>
                                        <td class="">{{ \Carbon\Carbon::parse($quotation->created_at)->format('d-M-Y')}}</td>
                                        <td class="">{{ $quotation->quotation_no }}</td>               
                                        <td class="">
                                            @if (!empty($quotation->crm_quotation_customer))
                                            <h6 class="tx-15 mg-b-3">{{ $quotation->crm_quotation_customer->first_name }}</h6>
                                            <span class="tx-12">{{$quotation->crm_quotation_customer->email}}</span>
                                            @endif
                                        </td>
                                        <td class="">{{$content->defaultCurrency ?? ''}}{{ $quotation->final_cost }}</td>
                                        
                                        <td class="text-center">
                                        <div class="custom-control custom-switch pl-0">

                                        <select class="form-select form-control change_status" id="customSwitch" name="status_name"  data-id="{{$quotation->quotation_id}}">
                                         <option value ="">{{__('crm.select_status')}}</option>
                                        <option  value ="0" {{$quotation->status == 0 ? 'selected' : '' }}>
                                            Deleted
                                            </option>
                                            <option value="1"  {{$quotation->status == 1 ? 'selected' : '' }}>
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
                                        <a href="{{ url('sales/custom-quote/details/' . $quotation->quotation_id) }}"
                                            value=""
                                            class="btn btn-sm d-flex align-items-center px-0 mg-r-5"><i class="fa fa-eye"></i>
                                        </a>
                                        @if (\App\Helper\Helper::CheckPermission($pageCustomAccess, 'update') == 'true') 
                                        <a href="{{ route('sales.editCustomeQuote', $quotation->quotation_id) }}" class="btn btn-sm table_btn py-1 px-0"><i class="fa fa-pencil" ></i></a>
                                        @endif

                                        </td>
                                    </tr>
                                @endforeach
                             @else
                                <tr>
                                    <td colspan="6">
                                        <h5 class="text-center mb-0 py-1">{{ __('common.no_record') }}</h5>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                 <!--Pagination Start-->
                  {!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'sales.custom-quote',['start_date'=>$content->start_date,'end_date'=>$content->end_date]) !!}
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
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_department_id" name="input_field_id">
                    <p class="mg-b-0">{{ __('common.delete_confirmation') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ __('common.no')}}
                    </button>
                    <button type="button" class="btn btn-primary delete_btn">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
       
        
    @push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>

    <!-- search ajax-->
    <script>
        $(document).ready(function() {
            $("#Search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#Search_Tr tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

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
                tableWebContent('','',this.value);
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


        function tableWebContent(startDate='', endDate='',search='') {

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
                    source:'2',
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