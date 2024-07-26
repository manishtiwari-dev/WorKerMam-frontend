<x-app-layout>
    @section('title', 'Order-Details')

    <div class="tab-content">
        <div>
            <div class="card">
                <div class="card-header  d-flex align-items-center justify-content-between">
                    <h6 class="tx-uppercase tx-semibold mg-b-0">Order Details</h6>
                </div>
                <div class="card-body">
                    <div class="row d-flex justify-content-between ">
                        <div class="col-6 col-sm-12 col-md-6 d-flex gap-3">
                            <h6>Order Number:</h6>
                            <p >#{{ $order_details->order_number }}</p>
                        </div>
                        <div class="col-6 col-sm-12 col-md-6 d-flex gap-3">
                            <h6>Order Status :</h6>
                            <p>
                                @if(sizeof($order_status)>0)
                                @foreach($order_status as $statusVal)
                                    @if($order_details->order_status==$statusVal->id)
                                    <span class="badge badge-pill badge-primary p-2">
                                        {{$statusVal->order_status ?? ''}}
                                    </span>
                                    @endif
                                @endforeach
                            @endif
                            </p>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-between ">
                        <div class="col-6 col-sm-12 col-md-6 d-flex gap-3">
                            <h6>Order Date:</h6>
                            <p>{{ (date('d M , Y', strtotime($order_details->created_at ?? '')))}}</p>
                        </div>
                        <div class="col-6 col-sm-12 col-md-6 d-flex gap-3">
                            <h6>Payment Status:</h6>
                            <p>
                                @if ($order_details->payment_status == 0)
                                <span class="badge badge-pill badge-warning p-2">Pending</span>
                                @elseif($order_details->payment_status == 1)
                                    <span class="badge badge-pill badge-success p-2">Paid</span>
                                @else
                                    <span class="badge badge-pill badge-danger p-2">Failed</span>
                                @endif
                            </p>
                        </div>

                    </div>

                    <div class="row d-flex justify-content-between ">
                        <div class="col-6 col-sm-12 col-md-6 d-flex gap-3">
                            <h6>Payment Type:</h6>
                            <p>
                                {{ucfirst($order_details->payment_type ?? '')}}
                            </p>
                        </div>
                        <div class="col-6 col-sm-12 col-md-6 d-flex gap-3">
                            <h6>Grand Total :</h6>
                            <p>
                                {{$order_details->grand_total ?? ''}}
                            </p>
                        </div>
                    </div>

                    @if(!empty($order_details->balance))
                    <div class="row d-flex justify-content-between ">
                        <div class="col-6 col-sm-12 col-md-6 d-flex gap-3">
                            <h6>Deposite:</h6>
                            <p>
                                {{$order_details->deposit ?? ''}}
                            </p>
                        </div>
                        <div class="col-6 col-sm-12 col-md-6 d-flex gap-3">
                            <h6>Balance:</h6>
                            <p>
                                {{$order_details->balance ?? ''}}
                            </p>
                        </div>
                    </div>
                   @endif

                    <div class="table-responsive mg-t-20 card">
                        <table class="table table-invoice border">
                            <thead>
                                <tr>
                                    <th class="">Sl. No.</th>
                                    <th class="wd-40p d-none d-sm-table-cell">{{ __('sales.item') }}</th>
                                    <th class="tx-center">{{ __('sales.unit_price') }}</th>
                                    <th class="tx-center">{{ __('sales.qty') }}</th>
        
                                    @foreach ($order_details->item as $key => $item)
                                      @if (!empty($item->discount))
                                        <th class="tx-center qty" style="width:100p;"> Discount %</th>
                                      @else
                                        <th class="tx-center qty" style="width:100p;"> </th>
                                      @endif
                                      @break
                                    @endforeach
        
                                    @foreach ($order_details->item as $key => $value)
                                      @if (!empty($value->tax_id))
                                          <th class="tx-center qty">TAX %</th>
                                       @else
                                       <th class="tx-center qty"></th>
                                      @endif
                                      @break
                                    @endforeach
        
                                    <th class="tx-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($order_details->item))
                                    @foreach ($order_details->item as $key => $item)
                                        <tr>
                                            <td class="tx-nowrap">{{$key+1}}</td>
                                            <td class="d-none d-sm-table-cell"> 
                                                {{ $item->product_name }}<br/>
                                                @if (!empty($item->attributes))
                                                   @foreach((array)($item->attributes) as $attrkey=>$attrVal)
                                                    @if($attrkey==count((array)($item->attributes))-1)
                                                    <span>{{$attrkey}} : {{$attrVal}}</span>,
                                                    @else
                                                    <span>{{$attrkey}} : {{$attrVal}}</span>
                                                    @endif
                                                   @endforeach
                                                @endif
                                            </td>
                                            <td class="tx-center">{{ $item->unit_price }}</td>
                                            <td class="tx-center">{{ $item->qty }}</td>
                                            
                                            @foreach ($order_details->item as $key => $value)
                                            @if (!empty($value->discount))
                                                <td class="tx-center">{{$item->discount}}</td>
                                            @else
                                                <td class="tx-center"> </td>
                                            @endif
                                            @break
                                            @endforeach
        
                                            @foreach ($order_details->item as $key => $value)
                                            @if (!empty($value->tax_id))  
                                              <td class="tx-center"> {{$item->tax_amount}}</td>
                                            @else
                                              <td class="tx-center"></td>
                                            @endif
                                            @break
                                            @endforeach
        
                                            <td class="tx-right border-0">{{ $item->total_price }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="card mg-b-20 mg-lg-b-25 mt-4">
                    <div class="card-header d-flex align-items-center justify-content-between px-0">
                        <h6 class="tx-uppercase tx-semibold mg-b-0">Update Order Status</h6>
                    </div>
                    <div class="card-body p-0">
                    <form id="statusForm" enctype="multipart/form-data" method="post">
                    <input type="hidden" value="{{$order_details->order_id}}" name="order_id" id="order_id">
                      <div class="form-row ">
                        <div class="form-group col-md-6">
                          <label for="orderstatus">Order Status</label>
                          <select class="form-select form-control selectsearch " name="order_status_id" id="orderstatus" aria-label="Default select example">
                            <option selected disabled value="">Select</option>
                            @if(sizeof($order_status)>0)
                                @foreach($order_status as $statusVal)
                                    <option value="{{$statusVal->id}}" @if($lastordUpdateId==$statusVal->id)  selected @endif>{{$statusVal->order_status ?? ''}}</option>
                                @endforeach
                            @endif
                          </select>                        
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ordernotes">Note</label>
                            <input type="text" id="ordernotes" value="" name="ordernotes" class="form-control" aria-describedby="passwordHelpInline">
                        </div>
                      </div>
                     
                        <!--Slider Form Start-->
                      
                        <div class="form-row d-none" id="sliderForm">
                          <div class="form-group col-md-6 col-lg-6 d-flex flex-column">
                            <label for="shipment_carrier">Shipment Carrier</label>
                             <select class="form-control selectsearch" name="shipment_carrier" id="shipment_carrier">
                                <option selected disabled value="">Select</option>
                                @if(sizeof($shippingMethods)>0)
                                  @foreach($shippingMethods as $shippingVal)
                                      <option value="{{$shippingVal->method_id}}">{{$shippingVal->method_name}}</option>
                                  @endforeach
                                @endif
                             </select>
                          </div>
                          <div class="form-group col-md-6 col-lg-6">
                            <label for="shipment_no">Shipment No.</label>
                            <input type="text" class="form-control" id="shipment_no" name="shipment_no">
                          </div>
                        </div>
    
                     <!-- Slider Form End -->

                        <div class="form-row">
                          <div class="col">
                            <div class="form-group">
                                <label for="attachments">Upload Attachment</label>
                                <input type="file" name="attachments" class="form-control-file" id="attachments">
                              </div>
                          </div>
                          <div class="col">
                            <button type="button" class="btn btn-primary mb-2" id="updateStatus">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    </div>
                      <!--Time Lines Start -->

                    <div class="card mg-b-20 mg-lg-b-25 mt-4">
                        <div class="card-header  px-2 d-flex align-items-center justify-content-between">
                            <h6 class="tx-uppercase tx-semibold mg-b-0">Order Timelines</h6>
                        </div><!-- card-header -->
                        <div class=" tx-13 mt-3 timeline-wrapper card-body px-2" >  
                            @if(sizeof($order_updates)>0)
                                @foreach($order_updates as $updates)
                                    <div class="media d-block d-lg-flex">
                                        <div class="media-body">
                                            <div class="timeline-group tx-13">
                                
                                            <div class="timeline-item">
                                                <div class="timeline-time">{{ date('d M , y', strtotime($updates->created_at ?? '')) }}</div>
                                                <div class="timeline-body">
                                                <h6 class="mg-b-0">Action : {{$updates->status_name}}</h6>
                                                @if(!empty($updates->shipment_status))
                                                <p>Shipment Crrier : {{$updates->shipment_status->shipment_name}}, Shipment No : {{$updates->shipment_status->shipment_no}}</p>
                                                @endif
                                                <p>{{$updates->update_note ?? ''}}</p>
                                                    @if(!empty($updates->attachment))
                                                        <a href="javascript:void(0)" onclick="Download('{{$updates->attachment_url}}')" class="d-block wd-lg-50p">
                                                            @if(in_array($updates->file_extension,['jpg','jpeg','png','gif','svg']))
                                                                <img src="{{$updates->attachment_url}}" class="img-fluid" alt="" height="100px" width="100px">
                                                            @else
                                                                <img src="https://e-nnovation.net/backend/public/storage/01H78P2W//media/1548/1681471134.png" class="img-fluid" alt="" height="100px" width="100px">
                                                            @endif
                                                            <i class="fa fa-external-link" aria-hidden="true"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div><br/>
                                @endforeach
                            @else
                            <div class="timeline-label">There Is No Activity</div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" value="{{json_encode($order_status)}}" id="dbOrdStatusData">
    

    @push('scripts')
        <script>
            function Download(url) {
                window.open(url, '_blank').focus();
            };


            $(document).ready(function() {

                $('.timeline-wrapper').scrollTop($('.timeline-wrapper')[0].scrollHeight);

                $('.selectsearch').select2({
                     searchInputPlaceholder: 'Search options'
                });

                // Show Shipment Form

                var total_data=$('#dbOrdStatusData').val();
                var DBOrderStatus=jQuery.parseJSON(total_data);
                var status_id=0;
                $(document).on('change', '#orderstatus', function(e) {
                    $('#shipment_carrier').prop('selectedIndex',0);
                    $('#shipment_no').val('');
                     status_id=$(this).val();
                    for (var i=0 ; i < Object.keys(DBOrderStatus).length; i++)
                    {
                       if(DBOrderStatus[i].id==status_id)
                       {    
                            if(DBOrderStatus[i].shipment==1)
                            {   
                                $('#sliderForm').removeClass('d-none');
                            }
                            else
                            {   
                                $('#sliderForm').addClass('d-none');
                            }   
                       }
                    }    
                });

                $(document).on('click', '#updateStatus', function(e) {
                    storeOrderStatus(status_id);
                });

                // Order Update Ajax

                function storeOrderStatus(status_id='') {
                    $html = '';
                    const url = "{{route('sales.UpdateOrdStatus')}}";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    var statusForm = document.getElementById("statusForm");
                    var formData = new FormData(statusForm);
                    var image_extensions=['jpg','jpeg','png','gif','svg'];
                
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,

                        success: function(result) {
                            if(result.status=='true')
                            {   
                                $html +=`<div class="media d-block d-lg-flex">
                                    <div class="media-body">
                                        <div class="timeline-group tx-13"> 
                                        <div class="timeline-item">
                                            <div class="timeline-time">${result.data.date}</div>
                                            <div class="timeline-body">
                                            <h6 class="mg-b-0">Action : ${result.data.orderUpdates.status_name}</h6>`;

                                            if(result.data.orderUpdates.shipment_status!=null){
                                               $html+=`<p>Shipment Crrier : ${result.data.orderUpdates.shipment_status.shipment_name}, Shipment No : ${result.data.orderUpdates.shipment_status.shipment_no}</p>`;
                                            }
                                            $html+=`<p>${result.data.orderUpdates.update_note}</p>`;
                                            if(result.data.orderUpdates.attachment!=''){
                                              $html+=`<a href="javascript:void(0)" onclick="Download('${result.data.attachment_url}')" class="d-block wd-lg-50p">`;
                                              if(image_extensions.includes(result.data.extension))
                                                $html+=`<img src="${result.data.attachment_url}" class="img-fluid" alt="" height="100px" width="100px">`;
                                              else
                                                $html+=`<img src="https://e-nnovation.net/backend/public/storage/01H78P2W//media/1548/1681471134.png" class="img-fluid" alt="" height="100px" width="100px">`;

                                                $html+=`<i class="fa fa-external-link" aria-hidden="true"></i></a>`;
                                            }

                                        $html+=`</div>
                                        </div>
                                        </div>
                                    </div>
                                </div><br/>`;

                                $('.timeline-wrapper').append($html);
                                $('.timeline-wrapper').scrollTop($('.timeline-wrapper')[0].scrollHeight);
                                
                                Toaster('success',result.message);
                                $('#statusForm').trigger("reset");
                                console.log(result.data);
                            }
                            else
                            {
                                Toaster('error',result.message);
                                $('#statusForm').trigger("reset");
                            }
                        }
                     });
                }

            });
        </script>
    @endpush
</x-app-layout>
