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
                    <td>{{$content->current_page * $content->per_page + $key+1 - $content->per_page}}</td>                     <td>{{date('d-M-Y', strtotime($customer->created_at ?? ''))}}</td>
                    <td>
                        <h6 class="mg-b-0">{{ $customer->first_name }}</h6> <span class="">{{ $customer->company_name }}</span><br />
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
                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                    <td class="text-center">
                        <a href="{{ route('sales.customer.edit',$customer->customer_id) }}"
                            class="btn btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </td>
                    @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6">
                    <h5 class="text-center mb-0 py-1">No Record Found !.</h5>
                </td>
            </tr>
        @endif
    </tbody>
</table>

  <!--Pagination Start-->
  {!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'sales.customer.index',['start_date'=>$content->start_date,'end_date'=>$content->end_date]) !!}
  <!--Pagination End-->