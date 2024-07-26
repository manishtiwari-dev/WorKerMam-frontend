
<x-app-layout> 
    @section('title',  $pageTitle)
    {{-- @dd($content); --}}
    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
    <div class="card contact-content-body">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                @if(!empty($content->source))
                    <h6 class="tx-15 mg-b-0">Source : {{ucfirst($content->source)}}</h6>
                @else
                    <h6 class="tx-15 mg-b-0"></h6>
                @endif
                <div class="d-flex gap-3">
                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')  
                    @if($content->source=="imported")

                        <a href="{{route('marketing.contact-group')}}" class="btn btn-sm btn-bg"><i data-feather="settings" class="mg-r-5"></i>Contact Groups</a>

                        <a href="{{route('marketing.contact-create')}}" class="btn btn-sm btn-bg"><i data-feather="plus" class="mg-r-5"></i>{{__('newsletter.add_contact')}}</a>
                        <a href="{{ route('marketing.contact-import') }}" class="btn btn-sm btn-bg d-flex align-items-center mg-r-5">
                            <i data-feather="plus"></i>
                            <span class="d-none d-sm-inline mg-l-5">{{ __('newsletter.import') }}</span>
                        </a>
                    @endif
                @endif
                </div>
            </div>
        </div>
        @if(Session::has('false'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('false') }}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        @endif
        @if(Session::has('true'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('true') }}
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        @endif

        <div class="card-body">
                <input type="hidden" value="{{$content->source}}" id="current_source">
              <!--Filter Start-->
              <div class="card-header row align-item-center mb-3 p-0  order-list-wrapper">

               <!--Sub Source Start-->
             

                <div class="col-lg-6">
                    <div class="form-icon position-relative mb-3">
                        <label>
                            Source Type 
                        </label>
                        @if($content->source=="customer")
                        <select class="form-select form-control select2" id="SubSource" aria-label="Default select example">
                            <option selected value="customer">All</option>
                            <option value="enquiry" {{$content->subsource=="enquiry" ? "selected": "" }}>Enquiry</option>
                            <option value="order" {{$content->subsource=="order" ? "selected": "" }}>Order</option>
                            <option value="quotation">Quotation</option>
                        </select>
                         @elseif($content->source=="lead")
                         <select class="form-select form-control select2" id="SubSource" aria-label="Default select example">
                            <option selected value="">Select Subsource</option>
                            @forelse ($content->sourceObject as $item)
                            <option value="{{$item->source_id}}" {{$content->subsource==$item->source_id ? "selected": "" }}>{{$item->source_name}}</option>
                            @empty
                            @endforelse
                        </select>
                        @elseif($content->source=="imported")
                         <select class="form-select form-control select2" id="SubSource" aria-label="Default select example">
                            <option selected value="">Select Subsource</option>
                            @forelse ($content->sourceObject as $item)
                            <option value="{{$item->id}}" {{$content->subsource==$item->id ? "selected": "" }}>{{$item->group_name}}</option>
                            @empty
                            @endforelse
                        </select>
                        @else
                        @endif
                    </div>
                </div>
              
            

                <!--Sub Source End-->


                <!--Search Start-->
                <div class="col-lg-6 mb-3 mb-lg-0 mb-md-0">
                    <label>Search</label>
                    <input type="text" id="search" value="{{ $search ?? '' }}" class="form-control fas fa-search"
                        placeholder="Search..." aria-label="Search" name="search">
                </div>
                <!--Search End-->

                  <!--Date Start-->
                <div class="col-lg-6">
                    <div class="form-icon position-relative  mb-3 ">
                        <label>
                            {{ __('seo.date') }}
                        </label>
                        <input type="text" id="datatableRange" name="datatableRange" class="form-control"
                            placeholder="{{ __('common.daterange_placeholder') }}" />
                    </div>
                </div>
                <!--Date End-->


                <!--Approval Status Start-->
                <div class="col-lg-6">
                    <div class="form-icon position-relative  mb-3">
                        <label>
                            Approval Status
                        </label>
                        <select class="form-select form-control statusDropDown select2" id="approvalStatus" aria-label="Default select example">
                            <option selected value="">Select</option>                            
                            <option  value="0">Pending</option>                            
                            <option  value="1">Approved</option>                            
                            <option  value="2">Stop</option>                            
                            <option  value="3">Blocked</option>                            
                        </select>
                    </div>
                </div>
                <!--Approval Status End-->

                <!--Subscriotion Status Start-->
                <div class="col-lg-5">
                    <div class="form-icon position-relative mb-3">
                        <label>
                            Subscriotion Status
                        </label>
                        <select class="form-select form-control statusDropDown select2" id="subsStatus" aria-label="Default select example">
                            <option selected value="">Select</option>                            
                            <option  value="0">Not Subscribed</option>                            
                            <option  value="1">Subscribed</option>                            
                            <option  value="2">Unsubscribed</option>                            
                        </select>
                    </div>
                </div>
                <!--Subscriotion Status End-->

    
                <!--Email Status Start-->
                <div class="col-lg-5">
                    <div class="form-icon position-relative mb-3 ">
                        <label>
                            Email Status
                        </label>
                        <select class="form-select form-control statusDropDown select2" id="emailStatus" aria-label="Default select example">
                            <option selected value="">Select</option>                            
                            <option value="0">Junk</option>                            
                            <option value="1">Valid</option>                            
                            <option value="2">Invalid</option>                            
                            <option value="3">Bounce</option>                            
                        </select>
                    </div>
                </div>
                <!--Email Status End-->

                <div class="col-lg-2 d-flex">
                    <div class="align-items-center reset-btn">
                        <a class="btn btn-primary " href="{{ route('marketing.contact-list',['source'=>$content->source] )}}"
                            role="button"><i class="fa fa-refresh" aria-hidden="true"></i>   {{ __('common.reset') }}</a>
                    </div>
                </div>
                
            </div>
            <!--Filter End-->

            <div class="table-responsive" id="contactList_listing"> 
                <table class="table  table_wrapper">
                    <thead >
                        <tr>
                            <th>{{ __('common.sl_no') }}</th>
                            <th>{{__('newsletter.contact_name')}}</th>
                            <th>{{__('newsletter.contact_email')}}</th>
                            <th>{{ __('contact.last_mail_sent') }}</th>
                             <th>{{ __('contact.subs_status') }}</th>
                             <th>{{ __('contact.approval_status') }}</th>
                             <th>{{ __('contact.email_status') }}</th>
                            <th class="text-center wd-10p">{{ __('common.action') }}</th>
                        </tr>
                    </thead>  
                    <tbody> 
                       
                        @forelse($content->data_list as $key=>$contact)

                            @if(!empty($contact))
                            
                            <tr>       
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$contact->c_name ?? ''}}</td>
                                <td>{{$contact->c_email ?? ''}}</td>
                                    
                                <td>
                                    @if(!empty($contact->contactNewsData))
                                      {{ date('d-M-Y', strtotime($contact->contactNewsData->newsletter_sent_date ?? '')) }}
                                    @else
                                        -
                                    @endif
                                    </td>
                                <td>
                                    @if(!empty($contact->contactNewsData))
                                        @if($contact->contactNewsData->subscription_status==0)
                                        <span class="badge badge-pill text-bg-danger">{{__('contact.not_subscribed')}}</span>
                                        @elseif($contact->contactNewsData->subscription_status==1) 
                                        <span class="badge badge-pill text-bg-success">{{__('contact.subscribed')}}</span>
                                        @else
                                        <span class="badge badge-pill text-bg-warning">{{__('contact.unsubscribed')}}</span>
                                        @endif
                                    @else
                                   -
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($contact->contactNewsData))
                                        @if($contact->contactNewsData->approval_status==0)
                                        <span class="badge badge-pill text-bg-danger">{{__('contact.pending')}}</span>
                                        @elseif($contact->contactNewsData->approval_status==1) 
                                        <span class="badge badge-pill text-bg-success">{{__('contact.approved')}}</span>
                                        @elseif($contact->contactNewsData->approval_status==2) 
                                        <span class="badge badge-pill text-bg-info">{{__('contact.stop')}}</span>
                                        @else
                                        <span class="badge badge-pill text-bg-dark">{{__('contact.blocked')}}</span>
                                        @endif
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($contact->contactNewsData))
                                        @if($contact->contactNewsData->email_status==0)
                                        <span class="badge badge-pill text-bg-primary"> {{__('contact.junk')}}</span>
                                        @elseif($contact->contactNewsData->email_status==1) 
                                        <span class="badge badge-pill text-bg-success"> {{__('contact.valid')}}</span>
                                        @elseif($contact->contactNewsData->email_status==2) 
                                        <span class="badge badge-pill text-bg-dark"> {{__('contact.invalid')}}</span>
                                        @else
                                        <span class="badge badge-pill text-bg-warning"> {{__('contact.bounce')}}</span>
                                        @endif
                                    @else
                                    -
                                    @endif
                                </td>
                                <td class="d-flex align-items-center">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#Modal_{{$contact->c_id}}" class="btn btn-sm  d-flex align-items-center mg-r-5" id="">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                          
                                    @if($content->source=="imported")
                        
                                    <a href="{{route('marketing.contact-edit',$contact->c_id)}}" class="btn btn-sm  d-flex align-items-center mg-r-5" id="">
                                        <i data-feather="edit-2"></i>
                                    </a>
                                    <button class="btn btn-sm  d-flex align-items-center mg-r-5" id="delete_btn" data-bs-target="#delete_modal" data-bs-toggle="modal" value="{{$contact->c_id}}"><i data-feather="trash"></i></button>

                                    @endif
                                </td>
                            </tr>

                           @else
                           <tr>
                                <td colspan="7">
                                    <h5 class="text-center my-2">{{__('common.no_record')}}</h5>
                                </td> 
                           </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="7">
                                    <h5 class="text-center my-2">{{__('common.no_record')}}</h5>
                                </td> 
                            </tr>
                        @endforelse
                    </tbody>
                </table>    
           
                   <!--Pagination Start-->
                   {!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'marketing.contact-list',['source'=>$content->source,'start_date'=>$content->start_date,'end_date'=>$content->end_date]) !!}
                   <!--Pagination End-->

                   @forelse($content->data_list as $key=>$contact)

                   @if(!empty($contact))
                     <!-- Modal Start-->
                     <div class="modal fade" id="Modal_{{$contact->c_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{__('contact.campaign_history')}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if(!empty($contact->contactNewsData) && !empty($contact->contactNewsData->campMailData) )
                                    <table class="table my-3">
                                        <thead class="table-active">
                                            <tr>
                                            <th scope="col">{{__('contact.campaign_name')}}</th>
                                            <th scope="col">{{__('contact.sent_date')}}</th>
                                            <th scope="col">{{__('contact.open_count')}}</th>
                                            <th scope="col">{{__('contact.link_open')}}</th>
                                            <th scope="col">{{__('contact.unsubscribed')}}</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse($contact->contactNewsData->campMailData as $mailData)
                                                @if(!empty($mailData->mailtracker))
                                                    <tr>
                                                    <td>{{$mailData->campaign_detail->campaign_name ?? ''}}</td>
                                                    <td>{{$mailData->mailtracker->sent_date ?? ''}}</td>
                                                    <td>{{$mailData->mailtracker->open_count ?? ''}}</td>
                                                    <td>{{$mailData->mailtracker->link_open ?? ''}}</td>
                                                    <td>{{$mailData->mailtracker->unsub_status==1 ?'Yes':'No'}}</td>
                                                    </tr>
                                                @else
                                                <tr>
                                                    <td colspan="5" class="text-center">{{__('common.no_record')}}</td>
                                                </tr>
                                                @endif
                                            @empty

                                            @endforelse
                                        </tbody>
                                    </table>
                                    
                                @else
                                    <h5 class="text-align-center">{{__('common.no_record')}}</h5>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('common.close')}}</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal End-->
                    @endif
                    @empty
                @endforelse

            </div>
        </div>
    </div>
    @endif



    <!--start delete modal-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel5">{{ __('common.delete') }} {{ __('newsletter.contact') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>{{ __('common.delete_confirmation') }}</h6>
                    <input type="hidden" id="deleteContactId" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ __('common.no')}}
                    </button>
                    <button type="submit" class="btn btn-primary contactDelBtn">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--end delete modal--> 
    <input type="hidden" value="{{$content->subsource ?? ''}}" id="crnt_sub_source">

    @push('scripts') 

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>

    <script>
        $(document).on('change',"#SubSource",function(){
            $("#crnt_sub_source").val($(this).val());
            window.location.href = "?subsource=" + $(this).val();
        });

        //delete contact id transfer in delete modal ajax start here
        $(document).on("click", "#delete_btn", function() {
            var contact_id = $(this).val(); 
            $('#deleteContactId').val(contact_id); 
        }); 

        //delete modal confirmation data start here
        $(document).on('click','.contactDelBtn', function() { 
            var contact_id = $('#deleteContactId').val(); 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); 
            $.ajax({
                type: "POST",
                url : "{{route('marketing.contact-delete')}}",
                data: {
                    contact_id: contact_id,
                },
                dataType: "json", 
                success: function(response) { 
                    Toaster('success',response.success);
                    setTimeout(function() {
                        location.reload(true);
                    },1000); 
                }
            });
        });


        $(document).on("click", "#clicktomove", function(e) {
            e.preventDefault();
                var group_id = $("#edit_template").val();
                if ($(".group_check").is(':checked')) {
                var contact_id = [];
                    $('input[name="checkname[]"]').each(function () {
                        if(this.checked) contact_id.push($(this).val())
                    });  
                }
                else{
                    toastr.error("Please Select Checkbox.");
                } 

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }); 
            $.ajax({
                url:url,
                type: "GET",
                data: {
                    group_id: group_id,
                    contact_id : contact_id,
                },
                dataType: "json",
                success: function(result) {
                    console.log(result);
                    if(result.success){
                        Toaster(result.success);
                        setTimeout(function() {
                        location.reload(true);
                    }, 3000);
                    }else{
                        toastr.error(result.error);
                        setTimeout(function() {
                        location.reload(true);
                    }, 3000);
                    } 
                } 
            });
        });
        

        //  toggle ajax start
        $('.toggle-class').change(function() {
            let blocked = $(this).prop('checked') === true ? 1 : 0;
            let id = $(this).data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
             
                data: {
                    'blocked': blocked,
                    'id': id
                },
                success: function(data) {
                    Toaster(data.success);
                }
            });
        }); 

        function toggle(source) {
            var checkboxes = document.querySelectorAll('.checkbox');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }


            // Ajax Date Filter

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

            // This work On Change of Any Status.
            $(document).on('change',".statusDropDown",function(){
                tableWebContent();
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
                    $("#contactList_listing").html('');

                $("#contactList_listing").html('');
                tableWebContent(startDate, endDate);
            }

           

            function tableWebContent(startDate = '', endDate = '', search = '') {
                
                const url = "{{ route('marketing.contactListFilter') }}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        start_date: startDate,
                        end_date: endDate,
                        search: search,
                        source: $('#current_source').val(),
                        subsource:$("#crnt_sub_source").val(),
                        approvalStatus:$("#approvalStatus").val(),
                        subsStatus:$("#subsStatus").val(),
                        emailStatus:$("#emailStatus").val(),
                    },
                    dataType: "json",
                    success: function(result) {
                        $("#contactList_listing").html(result.html);
                    }
                });
            }

    </script>
    @endpush
</x-app-layout> 