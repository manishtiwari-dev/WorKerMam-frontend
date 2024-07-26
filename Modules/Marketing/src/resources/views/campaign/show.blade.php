<x-app-layout>
    @section('title', 'Campaign')

    {{-- @dd($data) --}}
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row">
                <div class="col-md-12 col-lg-12 my-0">
                    <div class="card pb-1">
                        <div class=" border-0 quotation_form">
                            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('campaign.campaign_details') }}</h5>
                                <div>
                                    <a href="{{ route('marketing.campaign.create') }}"><button class="btn btn-md btn-primary" id="add_modal"><i data-feather="plus" class="lead_icon mg-r-5"></i>{{ __('campaign.add_campaign') }}</button></a>
                                </div>
                            </div>
                        </div>
                        <div class=" mt-1">
                            <div class="table-responsive" id="department">
                                <table class="table table-center bg-white mb-0">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom p-3">{{ __('campaign.campaign_name') }}</th>
                                            <th class="border-bottom p-3">{{ __('campaign.subject') }}</th>
                                            <th class="border-bottom p-3">{{ __('campaign.sender_name') }}</th>
                                            <th class="border-bottom p-3">Time Zone</th>
                                            <th class="border-bottom p-3">Start Date</th>
                                            <th class="border-bottom p-3">Start Time</th>
                                            <th class="border-bottom p-3">End Time</th>
                                            <th class="text-center border-bottom p-3">{{ __('common.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
                                        <!-- Start -->
                                        <tr>
                                            <td class="p-3">
                                                <a href="javascript:void(0)"  data-bs-target="#Detailmodal" data-toggle="modal" data-bs-target="#exampleModal">
                                                    {{$data->campaign_detail->campaign_name ?? ''}}
                                                </a>
                                            </td>
                                            <td class="p-3">{{$data->campaign_detail->campaign_subject ?? ''}}</td>
                                            <td class="p-3">{{$data->campaign_detail->sender_name ?? ''}}</td>
                                              <td class="p-3">{{$data->campaign_detail->time_zone}}</td>
                                              <td class="p-3">{{$data->campaign_detail->start_date}}</td>
                                              <td class="p-3">{{$data->campaign_detail->from_time}}</td>
                                              <td class="p-3">{{$data->campaign_detail->to_time}}</td>
                                            <td class="p-3 d-flex align-items-center justify-content-between">
                                            <a href="{{ url('marketing/campaign-edit/'.$data->campaign_detail->id) }}" id="editmodal"
                                                    class="btn btn-sm btn-white d-flex align-items-center mg-r-5"><i
                                                    data-feather="edit-2"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- End -->
                                    </tbody>
                                </table>

                                      <!-- Modals Start-->
                                      <div class="modal fade" id="Detailmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{$data->template_detail->subject ?? ''}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                {!! $data->template_detail->content ?? ''!!}
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div> 
                                   <!-- Modals End-->

                            </div>
                        </div>
                    </div>

                    <div class="card  mt-2">

                        <div class=" border-0 quotation_form">
                            <div class="card-header d-flex align-items-center justify-content-between py-3">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('campaign.customer_list') }}</h5>
                                {{-- <div class="form-row">  
                                    <div class="form-group mb-0">
                                        <div class="form-icon d-flex ">
                                            <input type="search" name="search" id="searchbar" class="form-control" placeholder="Search Here.....">
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>

                        <div class="mt-1">
                            <div class="table-responsive" id="department">
                                <table class="table table-center bg-white mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ __('common.sl_no') }}</th>
                                            <th class="text-center">{{ __('campaign.cutsomer_name') }}</th>
                                            <th class="text-center">{{ __('campaign.customer_email') }}</th>
                                            <th class="text-center">Email Status</th>
                                            <th class="text-center">Subs Status</th>
                                            <th class="text-center">Approval Status</th>
                                            <th class="text-center">Verified</th>
                                            <th class="text-center">Newsletter Count</th>
                                            <th class="text-center">Email Open Count</th>
                                            <th class="text-center">Link Open Count</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody id="myTable">
                                        <!-- Start -->
                                        @if(!empty($customer_data->data))
                                        @foreach($customer_data->data as $key=>$customer)
                                        <tr>
                                            <td class="p-3">{{$customer_data->current_page * $customer_data->per_page + $key+1 - $customer_data->per_page}}</td>                                              <td class="text-center">{{$customer->name ?? ''}}</td>
                                            <td class="p-3 text-center">{{$customer->email ?? ''}}</td>
                                            <td class="p-3 text-center">
                                                @if(!empty($customer->news_letter_data))
                                                    @if($customer->news_letter_data->email_status==0)
                                                    Junk
                                                    @elseif($customer->news_letter_data->email_status==1) 
                                                    Valid
                                                    @elseif($customer->news_letter_data->email_status==2) 
                                                    Invalid
                                                    @else
                                                    Bounce
                                                    @endif
                                                @else
                                                -
                                                @endif
                                            </td>

                                            <td class="text-center p-3">
                                                @if(!empty($customer->news_letter_data))
                                                    @if($customer->news_letter_data->subscription_status==0)
                                                     Not Subscribed
                                                    @elseif($customer->news_letter_data->subscription_status==1) 
                                                    Subscribed
                                                    @else
                                                    Unsubscribed
                                                    @endif
                                                @else
                                               -
                                                @endif
                                            </td>

                                            <td class="text-center p-3">
                                                @if(!empty($customer->news_letter_data))
                                                    @if($customer->news_letter_data->approval_status==0)
                                                    Pending
                                                    @elseif($customer->news_letter_data->approval_status==1) 
                                                    Approved
                                                    @elseif($customer->news_letter_data->approval_status==2) 
                                                    Stop
                                                    @else
                                                    Blocked
                                                    @endif
                                                @else
                                                -
                                                @endif
                                            </td>

                                            <td class="text-center p-3">
                                                @if(!empty($customer->news_letter_data))
                                                    {{$customer->news_letter_data->email_verified==0 ?'Yes':'No' }}
                                                @else
                                                -
                                                @endif
                                            </td>

                                            <td class="text-center p-3">
                                                @if(!empty($customer->news_letter_data))
                                                    {{$customer->news_letter_data->newsletter_count}}
                                                @else
                                                -
                                                @endif
                                            </td>

                                            <td class="text-center p-3">
                                                @if(!empty($customer->news_letter_data))
                                                    {{$customer->news_letter_data->email_open_count}}
                                                @else
                                                -
                                                @endif
                                            </td>

                                             <td class="text-center p-3">
                                                @if(!empty($customer->news_letter_data))
                                                    {{$customer->news_letter_data->link_open_count}}
                                                @else
                                                -
                                                @endif
                                            </td>

                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="10" class="p-3">
                                                <h5 class="text-center my-2">{{__('common.no_record')}}</h5>
                                            </td> 
                                        </tr>
                                        @endif
                                    </tbody><!-- End -->
                                </table>
                              

                                    <!--Pagination Start-->
                                    {!! \App\Helper\Helper::make_pagination($customer_data->total,$customer_data->per_page,$customer_data->current_page,'','marketing.campaign-view',['id'=>$data->campaign_detail->id]) !!}
                                    <!--Pagination End-->


                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--end row-->
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function(){
            $("#searchbar").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
           });
        </script>
    @endpush
</x-app-layout>