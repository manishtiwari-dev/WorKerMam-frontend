
<x-app-layout> 
    @section('title',  $pageTitle)

    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
    <div class="card contact-content-body">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                @if(!empty($content->group_name))
                    <h6 class="tx-15 mg-b-0">{{$content->group_name}}</h6>
                @else
                    <h6 class="tx-15 mg-b-0"></h6>
                @endif
                <div class="d-flex">
                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')  
                <a href="{{route('marketing.contact-create',['id'=>$content->group_id])}}" class="btn btn-sm btn-bg"><i data-feather="plus" class="mg-r-5"></i>{{__('newsletter.add_contact')}}</a>
                <a href="{{ route('marketing.contact-import',['id'=>$content->group_id]) }}" class="btn btn-sm btn-bg mg-l-5"> <i data-feather="plus"></i> Import</a>
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
                <input type="hidden" value="{{$content->group_id}}" id="current_group_id">
              <!--Filter Start-->
              <div class="row align-item-center mb-3 order-list-wrapper">
                <div class="col-lg-5">
                    <div class="form-icon position-relative d-flex mb-2 mb-lg-0 mb-md-0">
                        <p class="mb-0 d-md-flex d-lg-flex d-none d-md-block d-lg-block text-dark-grey align-items-center mr-3 ">
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
                        <a class="btn btn-primary px-5" href="{{ route('marketing.contact-group',['id'=>$content->group_id] )}}"
                            role="button">{{ __('common.reset') }}</a>
                    </div>
                </div>
            </div>
            <!--Filter End-->

            <div class="table-responsive" id="contactList_listing"> 
                <table class="table  table_wrapper">
                    <thead>
                        <tr>
                            <th>{{ __('common.sl_no') }}</th>
                            <th>{{__('newsletter.contact_name')}}</th>
                            <th>{{__('newsletter.contact_email')}}</th>
                            <th>Last Mail Sent</th>
                             <th>Subs Status</th>
                             <th>Approval Status</th>
                             <th>Email Status</th>
                            <th class="text-center wd-10p">{{ __('common.action') }}</th>
                        </tr>
                    </thead>  
                    <tbody> 
                     
                        @forelse($content->data_list as $key=>$contact)
                          
                            @if(!empty($contact->contact_details))
                            
                            <tr>       
                                <td>{{$content->current_page * $content->per_page + $key+1 - $content->per_page}}</td>                                  <td>{{$contact->contact_details->contact_name ?? ''}}</td>
                                <td>{{$contact->contact_details->contact_email ?? ''}}</td>
                                    
                                <td>
                                    @if(!empty($contact->contact_details->contactNewsData))
                                      {{ date('d-M-Y', strtotime($contact->contact_details->newsletter_sent_date ?? '')) }}
                                    @else
                                        ---
                                    @endif
                                    </td>
                                <td>
                                    @if(!empty($contact->contact_details->contactNewsData))
                                        @if($contact->contact_details->contactNewsData->subscription_status==0)
                                         Not Subscribed
                                        @elseif($contact->contact_details->contactNewsData->subscription_status==1) 
                                        Subscribed
                                        @else
                                        Unsubscribed
                                        @endif
                                    @else
                                   ---
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($contact->contact_details->contactNewsData))
                                        @if($contact->contact_details->contactNewsData->approval_status==0)
                                        Pending
                                        @elseif($contact->contact_details->contactNewsData->approval_status==1) 
                                        Approved
                                        @elseif($contact->contact_details->contactNewsData->approval_status==2) 
                                        Stop
                                        @else
                                        Blocked
                                        @endif
                                    @else
                                    ---
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($contact->contact_details->contactNewsData))
                                        @if($contact->contact_details->contactNewsData->email_status==0)
                                        Junk
                                        @elseif($contact->contact_details->contactNewsData->email_status==1) 
                                        Valid
                                        @elseif($contact->contact_details->contactNewsData->email_status==2) 
                                        Invalid
                                        @else
                                        Bounce
                                        @endif
                                    @else
                                    ---
                                    @endif
                                </td>
                                <td class="d-flex align-items-center">
                                    <a href="{{route('marketing.contact-edit',$contact->contact_id)}}" class="btn btn-sm btn-white d-flex align-items-center mg-r-5" id=""><i data-feather="edit-2"></i>
                                    </a>
                                    <button class="btn btn-sm btn-white d-flex align-items-center mg-r-5" id="delete_btn" data-bs-target="#delete_modal" data-bs-toggle="modal" value="{{$contact->contact_id}}"><i data-feather="trash"></i></button>
                                </td>
                            </tr>
                           @else
                           <tr>
                                <td colspan="5">
                                    <h5 class="text-center my-2">{{__('common.no_record')}}</h5>
                                </td> 
                           </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="5">
                                    <h5 class="text-center my-2">{{__('common.no_record')}}</h5>
                                </td> 
                            </tr>
                        @endforelse
                    </tbody>
                </table>
             
                   <!--Pagination Start-->
                   {!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'marketing.contact-group',['id'=>$content->group_id,'start_date'=>$content->start_date,'end_date'=>$content->end_date]) !!}
                   <!--Pagination End-->

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

    @push('scripts') 

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>

    <script>
        
        //delete contact id transfer in delete modal ajax start here
        $(document).on("click", "#delete_btn", function() {
            var contact_id = $(this).val(); 
            $('#deleteContactId').val(contact_id); 
        });

        //delete modal confirmation data start here
        $(document).on('click','.contactDelBtn', function() { 
            var contact_id = $('#deleteContactId').val(); 
            console.log(contact_id);
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
                        id: $('#current_group_id').val(),

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