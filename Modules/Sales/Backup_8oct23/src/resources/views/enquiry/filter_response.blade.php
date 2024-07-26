@php
    
    $api_token = request()->cookie('api_token');
    
    $userdata = Cache::get('userdata-' . $api_token);
    
@endphp

<table class="table table_wrapper" id="template_list_data_reload">
    <thead>
        <tr>
            <th>{{ __('common.sl_no') }}</th>
            <th>{{ __('common.date') }}</th>
            <th>{{ __('crm.enquiry_no') }}</th>
            <th>{{ __('crm.enquiry_customer_name') }}</th>
            <th>{{ __('crm.enquiry_customer_email') }}</th>
            {{-- <th>{{ __('common.status') }}</th> --}}
            <th class="text-center wd-10p">{{ __('common.action') }}</th>
        </tr>
    </thead>
    <tbody id="Search_Tr">
        @if (!empty($enquiry_list))
            @foreach ($enquiry_list as $key => $enquiry)
                <tr>
                    <td>{{$current_page * $per_page + $key+1 - $per_page}}</td>
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


                    {{-- <td>{{ $enquiry->customers_name }}</td>
                    <td>{{ $enquiry->email_address }}</td> --}}

                    <td class="d-flex align-items-center">
                        <a href="{{ route('sales.enquiry.show', $enquiry->enquiry_id) }}"
                            class="btn btn-sm d-flex align-items-center mg-r-5">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5">
                    <h5 class="text-center mb-0 py-1">No Record Found !.</h5>
                </td>
            </tr>
        @endif
    </tbody>
</table>


<!--Pagination Start-->
{!! \App\Helper\Helper::make_pagination(
    $total_records,
    $per_page,
    $current_page,
    $total_page,
    'sales.enquiry.index',
    ['start_date' => $start_date, 'end_date' => $end_date],
) !!}
<!--Pagination End-->
