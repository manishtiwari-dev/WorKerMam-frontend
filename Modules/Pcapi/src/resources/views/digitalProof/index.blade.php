<x-app-layout>
    {{-- @section('title', $pageTitle) --}}

    <div class="card contact-content-body">
        <div class="card-header py-2">
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="tx-15 mg-b-0">Digital Proof Request</h6>
               
            </div>
        </div>
        <div class="card-body">

            <!--Filter Start-->
            <div class="row align-item-center mb-3 order-list-wrapper">
                {{-- <div class="col-lg-5">
                        <div class="form-icon position-relative d-flex mb-2 mb-lg-0 mb-md-0">
                            <p class="fw-500 mb-0 d-md-flex d-lg-flex d-none d-md-block d-lg-block text-dark-grey align-items-center mr-3 ">
                                {{ __('seo.date') }}
                            </p>
                            <input type="text" id="datatableRange" name="datatableRange" class="form-control"
                                placeholder="{{ __('common.daterange_placeholder') }}" />
                        </div>
                    </div> --}}

                <div class="col-lg-5 mb-2 mb-lg-0 mb-md-0">
                    <input type="text" id="search" value="" class="form-control fas fa-search"
                        placeholder="Search..." aria-label="Search" name="search">
                </div>
                {{-- <div class="col-lg-2 d-flex">
                        <div class="align-items-center ">
                            <a class="btn btn-primary px-5" href="{{ route('sales.customer.index') }}"
                                role="button">{{ __('common.reset') }}</a>
                        </div>
                    </div> --}}
            </div>
            <!--Filter End-->

            <div class="table-responsive" id="customer_listing">
                <table class="table  table_wrapper">
                    <thead>
                        <tr>
                            <th>{{ __('common.sl_no') }}</th>
                            <th>{{ __('common.date') }}</th>
                            <th>Proof Id</th>
                            <th>Customer</th>
                            <th class="text-center">Product</th>
                            <th class="wd-10p text-center">
                                {{ __('common.action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($content->customer_list))
                        @foreach ($content->customer_list as $key => $customer) 
                        <tr>
                            <td>{{$content->current_page * $content->per_page + $key+1 - $content->per_page}}</td>
                            <td>{{date('d-M-Y', strtotime($customer->created_at ?? '-'))}}</td>
                            <td>
                               
                            </td>
                            <td>
                                {{ $customer->first_name }}
                            </td>
                            <td>

                            </td>

                            <td class="text-center">
                                <a href="javascript:void(0)" class="btn btn-sm  table_btn py-1 px-2"
                                id="viewBtn" data-toggle="modal"
                                data-id="{{$customer->customer_id}}">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span class="d-sm-inline mg-l-5"></span>
                            </a>

                                {{-- <a href="{{ route('papachina-product.digitalProofdetails', 1) }}" class="btn btn-sm"><i
                                        class="fa fa-eye" aria-hidden="true"></i></a> --}}
                            </td>
                        </tr>
                        @endforeach
                        @endif

                    </tbody>
                </table>

                {{-- <!--Pagination Start-->
                  {!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'sales.customer.index',['start_date'=>$content->start_date,'end_date'=>$content->end_date]) !!}
                  <!--Pagination End--> --}}

            </div>
        </div>
    </div>

    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Digital Proof Request Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex">
                        <h6>Proof Request Date: </h6>
                        <p class="view-customer-date"></p>
                      </div>

                      <div class="d-flex">
                        <h6>Customer Name : </h6>
                        <p class="view-customer-name"></p>
                      </div>

                      <div class="d-flex">
                        <h6>Customer Email : </h6>
                        <p class="view-customer-email"></p>
                      </div>


                      <div class="d-flex">
                        <h6>Product Name : </h6>
                        <p class="view-meta-desc"></p>
                      </div>

                      <div class="d-flex">
                        <h6>Product Color : </h6>
                        <p class="view-meta-desc"></p>
                      </div>
                  
                  
                  
{{--                    
                    <span>
                       
                    </span> --}}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>
        <script>
            // change status in ajax code start
            $(document).on("click", "#viewBtn", function(e) {
                    e.preventDefault();
                    var view_id = $(this).data('id');  
                    $.ajax({
                      

                        url: "{{ route('papachina-product.digitalProofdetails') }}",
                        type: "POST",
                        data: {
                            id: view_id
                        },
                        
                        success: function(response) {
                             if (response.view_customer != null) {
                                
                                 $('.view-customer-date').text(response.view_customer.created_at);
                                 $('.view-customer-name').text(response.view_customer.first_name);
                                 $('.view-customer-email').text(response.view_customer.email);
                             }
                            
                            $('#viewModal').modal('show');
                        }
                    });
                });

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
                    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                        'YYYY-MM-DD'));
                    ajaxSubmitData();
                });

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

                if (startDate != '' && endDate != '')
                    $("#customer_listing").html('');

                $("#customer_listing").html('');
                tableWebContent(startDate, endDate);
            }

            function tableWebContent(startDate = '', endDate = '', search = '') {
                const url = "{{ route('sales.customer-filter') }}";
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
                        search: search,
                    },
                    dataType: "json",
                    success: function(result) {
                        $("#customer_listing").html(result.html);
                    }
                });
            }

            // Delete Ajax Start 

            $(document).ready(function() {
                $(document).on("click", "#delete_btn", function() {
                    var customer_id = $(this).val();
                    $('#delete_department_id').val(customer_id);
                    $('#delete_modal').modal('show');
                });
                $(document).on('click', '.delete_submit_btn', function() {
                    var customer_id = $('#delete_department_id').val();

                    $('#delete_modal').modal('show');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        // url: "{{ url('departmentDestroy') }}/" + department_id,
                        url: "{{ url('sales/customer') }}/" + customer_id,
                        data: {
                            customer_id: customer_id,
                            _method: 'DELETE'
                        },
                        dataType: "json",
                        success: function(response) {
                            Toaster(response.success);
                            $('#delete_modal').modal('hide');
                            $('.flash-message').html(response.success);
                            $('.flash-message').addClass('alert alert-success');
                            $('#department_edit').modal('hide');
                            $("#customer_table").load(location.href + " #customer_table");

                            $('.flash-message').fadeOut(3000, function() {
                                location.reload(true);
                            });
                        }
                    });

                });
            });
        </script>
        <!--end delete ajax-->
    @endpush
</x-app-layout>
