<table class="table  table_wrapper ">
    <thead>
        <tr>
            <th class="border-bottom" style="min-width:70px;">{{ __('sales.sl_no') }}</th>
            <th class="border-bottom" style="min-width: 150px;">{{ __('sales.date') }}</th>
            <th class="border-bottom" style="min-width: 150px;">{{ __('sales.customer_name') }}</th>
            <th class="border-bottom" style="min-width: 150px;">{{ __('sales.order_number') }}
            </th>
            <th class="border-bottom" style="min-width: 150px;">{{ __('sales.grand_total') }}</th>
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

                    <td>{{ $order->user->first_name ?? '' }} {{ $order->user->last_name ?? '' }} </td>
                    <td> {{ $order->order_number }}</td>
                    <td>{{ $order->grand_total }}</td>

                    <td>
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
                        <a href="{{ url('sales/orders/details/' . $order->order_number) }}"
                            value=""
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
{!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'sales.orders.index',['start_date'=>$content->start_date,'end_date'=>$content->end_date])!!}
<!--Pagination End-->