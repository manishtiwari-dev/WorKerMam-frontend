<table class="table  table_wrapper">
    <thead>
        <tr>
            <th class="border-bottom" style="min-width:70px;">{{__('common.sl_no')}}</th>
            <th class="border-bottom" style="min-width: 150px;">{{__('crm.date')}}</th>
            <th class="border-bottom" style="min-width: 150px;">{{__('crm.quotation_no')}}</th>
            <th class="border-bottom" style="min-width: 150px;">{{__('crm.customer_delails')}}</th>
            <th class="border-bottom" style="min-width: 150px;">{{__('crm.quote_price')}}</th>
            <th class="border-bottom" style="min-width: 100px;">{{__('common.status')}}</th>
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
                        {{ $quotation->crm_quotation_customer->first_name }}<br>{{$quotation->crm_quotation_customer->email}}
                        @endif
                    </td>
                    <td class="">{{ $quotation->final_cost }}</td>
                    
                    <td class="">
                    <div class="custom-control custom-switch pl-0">

                    <select class="form-select form-control change_status" id="customSwitch" name="status_name"  data-id="{{$quotation->quotation_id}}">

                   
                     <option value ="">
                     {{__('crm.select_status')}}</option>
                    <option value ="0" {{$quotation->status == 0 ? 'selected' : '' }}>
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
                    <td class="align-items-center justify-content-center d-flex gap-2">
                    <a href="{{ url('sales/quotation/details/' . $quotation->quotation_id) }}"
                            value=""class="btn btn-sm d-flex align-items-center px-0 mg-r-5">
                            <i class="fa fa-eye"></i>
                        </a>
                           @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true') 
                        <a href="{{ route('sales.quotation.edit', $quotation->quotation_id) }}" class="btn btn-sm table_btn py-1 px-0">
                            <i class="fa fa-pencil" ></i>
                        </a>
                      @endif

                    </td>
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
{!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'sales.quotation.index',['start_date'=>$content->start_date,'end_date'=>$content->end_date]) !!}
<!--Pagination End-->