<x-app-layout>
    @section('title',  $pageTitle)
    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true') 
    <div class="card contact-content-body">
        <div class="tab-content">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="tx-15 mb-0">{{ __('sales.order_list') }}</h6>
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
                                <a class="btn btn-primary px-5" href="{{ route('sales.orders.index') }}"
                                    role="button">{{ __('common.reset') }}</a>
                            </div>
                        </div>
                    </div>
                <!--Filter End-->


                <div class="table-responsive" id="order_listing">
                    <table class="table  table_wrapper ">
                        <thead>
                            <tr>
                                <th class="border-bottom" style="min-width:60px;">{{ __('sales.sl_no') }}</th>
                                <th class="border-bottom" style="min-width: 150px;">{{ __('sales.date') }}</th>
                                <th class="border-bottom" style="min-width: 150px;">{{ __('sales.customer_name') }}</th>
                                <th class="border-bottom" style="min-width: 150px;">{{ __('sales.order_number') }}
                                </th>
                                <th class="border-bottom" style="min-width: 100px;">{{ __('sales.grand_total') }}</th>
                                <th class="border-bottom" style="min-width: 100px;">{{ __('sales.payment_status') }}

                                <th class="border-bottom" style="min-width: 100px;">{{ __('sales.order_status') }}
                                </th>
                                <th class="text-center border-bottom" style="min-width: 70px;">{{ __('sales.action') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody id="Search_Tr">

                            <!-- Start -->
                            @if (!empty($content->order_list))
                                @foreach ($content->order_list as $key => $order)
                                    <tr>
                                        <td>{{$content->current_page * $content->per_page + $key+1 - $content->per_page}}</td>  
                                        <td class="">
                                            {{ date('d-M-Y', strtotime($order->created_at ?? '')) }}
                                        </td>

                                        <td class="">{{ $order->user->first_name??'' }}{{ $order->user->last_name??'' }}
                                        </td>
                                        <td class=""> {{ $order->order_number }}</td>
                                        <td class="">{{ $order->grand_total }}</td>

                                        <td class="">
                                            @if ($order->payment_status == 0)
                                                <span class="badge badge-pill text-bg-warning">Pending</span>
                                            @elseif($order->payment_status == 1)
                                                <span class="badge badge-pill text-bg-success">Paid</span>
                                            @else
                                                <span class="badge badge-pill text-bg-danger">Failed</span>
                                            @endif
                                        </td>
                                     
                                        <td>
                                            @if(sizeof($content->order_status)>0)
                                                @foreach($content->order_status as $ordStatus)
                                                @if ($order->order_status == $ordStatus->id)
                                                    <span class="badge badge-pill text-bg-warning">{{$ordStatus->order_status}}</span>
                                                @endif
                                                @endforeach
                                            @endif
                                        </td>

                                        <td class="align-items-center justify-content-center d-flex gap-2">
                                            <a href="{{url('sales/orders/details/'.$order->order_number) }}"
                                                class="btn btn-sm  d-flex align-items-center mg-r-5 px-0">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>

                                            <a href="{{route('sales.OrderStatus',$order->order_number) }}"
                                                class="btn btn-sm  d-flex align-items-center px-0">
                                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            
                                <tr><td colspan="8" class="text-center"><h5>{{__('common.no_record')}}</h5></td></tr>
                            @endif
                        </tbody>
                    </table>
                    <!--Pagination Start-->
                    {!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'sales.orders.index',['start_date'=>$content->start_date,'end_date'=>$content->end_date]) !!}
                    <!--Pagination End-->
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
    @endif
 


    <!--start delete modal-->
    <div class="modal fade effect-scale" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('crm.delete_quotation') }}</h6>
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
                        {{ __('common.no') }}
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

    <script>
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
            })

            $("#search").on('keyup', function(e) {
                if ((this.value).length >= 3 || (this.value).length == 0) {
                    tableWebContent('', '', this.value);
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


        function tableWebContent(startDate='', endDate='',search='') {

            const url = "{{route('sales.orderfilter')}}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    search:search,
                },
                dataType: "json",
                success: function(result) {
                    $("#order_listing").html(result.html);
                }
            });
        }
    </script>

    <!--end status ajax-->
    <script type="text/javascript">
        // change status in ajax code start
        // $('.toggle_status').change(function(e) {
        //     e.preventDefault();
        //     // alert('hihyu');
        //     let status = $(this).prop('checked') === true ? 1 : 0;
        //     let staff_id = $(this).data('id');
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax({
        //         type: "POST",
        //         dataType: "json",
        //         url: "{{ url('employee-status-change') }}",
        //         data: {
        //             'status': status,
        //             'staff_id': staff_id
        //         },
        //         success: function(data) {
        //             // location.reload();
        //             Toaster(' Employee Status Change Successfully');
        //         }
        //     });
        // });
        // chenge status in ajax code end  
    </script>
    @endpush
</x-app-layout>
