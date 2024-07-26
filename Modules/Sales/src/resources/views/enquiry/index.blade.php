@php
    
    $api_token = request()->cookie('api_token');
    
    $userdata = Cache::get('userdata-' . $api_token);
    
@endphp

<x-app-layout>
    @section('title', $pageTitle)
    <!--index table start-->

    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
        <div class="card contact-content-body">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="tx-15 mg-b-0">{{ __('crm.enquiry_list') }}</h6>
                </div>
            </div>
            <div class="card-body">
                <!--Filter Start-->
                <div class="row align-item-center mb-3 order-list-wrapper">
                    <div class="col-lg-5">
                        <div class="form-icon position-relative d-flex mb-2 mb-lg-0 mb-md-0">
                            <p
                                class="mb-0 d-md-flex d-lg-flex d-none d-md-block d-lg-block text-dark-grey align-items-center mr-3 ">
                                {{ __('seo.date') }}
                            </p>
                            <input type="text" id="datatableRange" name="datatableRange" class="form-control"
                                placeholder="{{ __('common.daterange_placeholder') }}" />
                        </div>
                    </div>

                    <div class="col-lg-5 mb-2 mb-lg-0 mb-md-0">
                        <input type="text" id="search" value="{{ $search ?? '' }}"
                            class="form-control fas fa-search" placeholder="Search..." aria-label="Search"
                            name="search">
                    </div>
                    <div class="col-lg-2 d-flex">
                        <div class="align-items-center ">
                            <a class="btn btn-primary px-5" href="{{ route('sales.enquiry.index') }}"
                                role="button">{{ __('common.reset') }}</a>
                        </div>
                    </div>
                </div>
                <!--Filter End-->


                <div class="table-responsive" id="enquiry_listing">
                    @if (!empty($content->enquiry_list))
                        <table class="table  table_wrapper" id="template_list_data_reload">
                            <thead>
                                <tr>
                                    <th class="border-bottom">{{ __('common.sl_no') }}</th>
                                    <th class="border-bottom">{{ __('common.date') }}</th>
                                    <th class="border-bottom">{{ __('crm.enquiry_no') }}</th>
                                    <th class="border-bottom">{{ __('crm.enquiry_customer_name') }}</th>
                                    <th class="border-bottom">{{ __('crm.enquiry_customer_email') }}</th>
                                    {{-- <th class="border-bottom">{{ __('common.status') }}</th> --}}
                                    <th class="border-bottom text-center wd-10p">{{ __('common.action') }}</th>
                                </tr>
                            </thead>
                            <tbody id="Search_Tr">
                                @if (!empty($content->enquiry_list))
                                @forelse ($content->enquiry_list as $key => $enquiry)

                                {{-- @foreach ($content->enquiry_list as $key => $enquiry) --}}
                                        <tr>
                                            {{-- <td>{{ $key + 1 }}</td> --}}
                                            <td>{{ $content->current_page * $content->per_page + $key + 1 - $content->per_page }}</td>
                                            <td>
                                                {{ date('d-M-Y', strtotime($enquiry->created_at ?? '')) }}
                                            </td>
                                            <td>{{ $enquiry->enquiry_no }}</td>
                                            @if ($userdata->userType != 'subscriber')
                                                <td>{{ $enquiry->customer_name }}</td>
                                            @else
                                                <td>{{ $enquiry->customers_name }}</td>
                                            @endif

                                            @if ($userdata->userType != 'subscriber')
                                                <td>{{ $enquiry->customer_email }}</td>
                                            @else
                                                <td>{{ $enquiry->email_address }}</td>
                                            @endif

                                            <td class="d-flex align-items-center justify-content-center">
                                                <a href="{{ route('sales.enquiry.show', $enquiry->enquiry_id) }}"
                                                    class="btn btn-sm d-flex align-items-center mg-r-5">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        @empty
                                        <h1>No Record Found !</h1>
                                    @endforelse




                                    {{-- @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">
                                            <h5 class="text-center mb-0 py-1">No Record Found !.</h5>
                                        </td>
                                    </tr> --}}
                                @endif
                            </tbody>
                        </table>
                        
                        {!! \App\Helper\Helper::make_pagination(
                            $content->total_records,
                            $content->per_page,
                            $content->current_page,
                            $content->total_page,
                            'sales.enquiry.index',
                            ['start_date' => $content->start_date, 'end_date' => $content->end_date],
                        ) !!}

                    @endif

                    {{-- <!--Pagination Start-->
                    {!! \App\Helper\Helper::make_pagination(
                        $content->total_records,
                        $content->per_page,
                        $content->current_page,
                        $content->total_page,
                        'sales.enquiry.index',
                        ['start_date' => $content->start_date, 'end_date' => $content->end_date],
                    ) !!}
                    <!--Pagination End--> --}}







                </div>
            </div>

        </div>
    @endif

    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel5">{{ __('newsletter.delete_template_list') }}</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>{{ __('settings.deleted_data') }}</h6>
                    <input type="hidden" id="delete_id" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('common.no') }}
                    </button>
                    <button type="submit" class="btn btn-primary deleteBtn">{{ __('common.yes') }}</button>
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
                    $("#enquiry_listing").html('');

                $("#enquiry_listing").html('');
                tableWebContent(startDate, endDate);
            }



            function tableWebContent(startDate = '', endDate = '', search = '') {

                const url = "{{ route('sales.enquiry-filter') }}";
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

                        $("#enquiry_listing").html(result.html);
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
