<x-app-layout>
    @section('title',  $pageTitle)

    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
    <div class="card contact-content-body">
        <div class="card-header py-2">
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="tx-15 mg-b-0">{{ __('crm.customer_list') }}</h6>
                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                <a href="{{route('sales.customer.create')}}" class="btn btn-sm btn-bg btn-primary"><i data-feather="plus" class="mg-r-5"></i>{{
                    __('crm.add_customer') }}</a>
                    @endif
            </div>
        </div>
        <div class="card-body">
        
             <!--Filter Start-->
                <div class="row align-item-center mb-3 order-list-wrapper">
                    <div class="col-lg-5">
                        <div class="form-icon position-relative d-flex mb-2 mb-lg-0 mb-md-0">
                            <p class="fw-500 mb-0 d-md-flex d-lg-flex d-none d-md-block d-lg-block text-dark-grey align-items-center mr-3 ">
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
                            <a class="btn btn-primary px-5" href="{{ route('sales.customer.index') }}"
                                role="button">{{ __('common.reset') }}</a>
                        </div>
                    </div>
                </div>
            <!--Filter End-->


            <div class="table-responsive" id="customer_listing">
                <table class="table  table_wrapper">
                    <thead>
                        <tr>
                            <th>{{__('common.sl_no')}}</th>
                            <th>{{__('common.date')}}</th>
                            <th>{{__('crm.customer_details')}}</th>
                            <th>{{__('crm.contact_details')}}</th>
                            <th class="text-center">{{__('crm.enquiry')}}</th>
                            <th class="text-center">{{__('crm.quote')}}</th>
                            <th class="text-center">{{__('crm.order')}}</th> 
                            <th>{{__('common.status')}}</th> 
                            <th>Guest</th>
                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                            <th class="wd-10p text-center">
                                {{__('common.action')}}
                            </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody> 
                        @if(!empty($content->customer_list))
                        @foreach($content->customer_list as $key=>$customer)  
                        <tr>
                            <td>{{$content->current_page * $content->per_page + $key+1 - $content->per_page}}</td>              <td>{{date('d-M-Y', strtotime($customer->created_at ?? '-'))}}</td>
                            <td>
                                <h6 class=" mg-b-0">{{ $customer->first_name }}</h6> <span class="">{{ $customer->company_name }}</span><br />
                            </td>

                            <td>
                                <h6 class="mg-b-0">{{ $customer->contact }}</h6> <span class="">{{ $customer->email }}</span><br />
                            </td>


                            <td class="text-center">@if(!empty($customer->webenqcustomer))
                                {{count($customer->webenqcustomer)}}
                                @else
                                -
                                @endif
                            </td>
                            <td class="text-center">
                                @if(!empty($customer->webquotecustomer))
                                {{count($customer->webquotecustomer)}}
                                @else
                                -
                                @endif
                            </td>
                            <td class="text-center">
                                @if(!empty($customer->webordercustomer))
                                {{count($customer->webordercustomer)}}
                                @else
                                -
                                @endif
                            </td> 
                            <td>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input toggle-class" {{
                                        $customer->status == '1' ? 'checked' : '' }}
                                    data-id="{{$customer->customer_id}}" id="customSwitch{{$customer->customer_id}}">
                                    <label class="custom-control-label"
                                        for="customSwitch{{$customer->customer_id}}"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input guest-toggle" {{
                                        $customer->is_guest == '0' ? 'checked' : '' }}
                                    data-id="{{$customer->customer_id}}" id="guestSwitch{{$customer->customer_id}}">
                                    <label class="custom-control-label"
                                        for="guestSwitch{{$customer->customer_id}}"></label>
                                </div>
                            </td>
                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                            <td class="text-center">
                                <a href="{{ route('sales.customer.edit',$customer->customer_id) }}"
                                    class="btn btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        @endif

                    </tbody>
                </table>

                  <!--Pagination Start-->
                  {!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'sales.customer.index',['start_date'=>$content->start_date,'end_date'=>$content->end_date]) !!}
                  <!--Pagination End-->

            </div>
        </div>
    </div>
    @endif

    <!--start delete modal-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure want to delete ?</h5>
                    <input type="hidden" id="delete_department_id" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                    <button type="submit" class="btn btn-primary delete_submit_btn">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!--end delete modal-->
    @push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>
    <script>    

    // change status in ajax code start

            $(document).on('change','.toggle-class',function(e){
            e.preventDefault();
            let id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('sales.change-status') }}",
                data: {
                    'cutomer_id': id,
                },
                success: function (data) {
                    Toaster('success',data.success);
                }
            });
        });

        
        $(document).on('change','.guest-toggle',function(e){
            e.preventDefault();
            let id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('sales.change-guest-user') }}",
                data: {
                    'cutomer_id': id,
                },
                success: function (data) {
                    Toaster('success',data.success);
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
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
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

            if (startDate != ''  && endDate != '')
                $("#customer_listing").html('');

            $("#customer_listing").html('');
            tableWebContent(startDate, endDate);
        }

        function tableWebContent(startDate='', endDate='',search='') {
            const url = "{{route('sales.customer-filter')}}";
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
                    $("#customer_listing").html(result.html);
                }
            });
        }
        
        // Delete Ajax Start 

        $(document).ready(function () {
            $(document).on("click", "#delete_btn", function () {
                var customer_id = $(this).val();
                $('#delete_department_id').val(customer_id);
                $('#delete_modal').modal('show');
            });
            $(document).on('click', '.delete_submit_btn', function () {
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
                    url: "{{ url('sales/customer')}}/" + customer_id,
                    data: {
                        customer_id: customer_id,
                        _method: 'DELETE'
                    },
                    dataType: "json",
                    success: function (response) {
                        Toaster(response.success);
                        $('#delete_modal').modal('hide');
                        $('.flash-message').html(response.success);
                        $('.flash-message').addClass('alert alert-success');
                        $('#department_edit').modal('hide');
                        $("#customer_table").load(location.href + " #customer_table");

                        $('.flash-message').fadeOut(3000, function () {
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