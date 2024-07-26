<x-app-layout>
    @section('title',  $pageTitle)

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    
    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
    <div class="card">
        <div class="tab-content">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between ">
                    <h6 class="tx-15 mg-b-0">{{ __('campaign.campaign_list') }}</h6>
                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                    <a href="{{ route('marketing.campaign.create') }}"
                        class="btn btn-sm btn-bg d-flex align-items-center mg-r-5 btn-primary"><i data-feather="plus"></i><span
                            class="d-sm-inline mg-l-5">{{ __('campaign.add_campaign') }}</span></a>
                            @endif
                </div>
            </div>
            <div class="card-body ">
                <!--Filter Start-->
                <div class="row align-item-center mb-3 order-list-wrapper">
                    <div class="col-lg-5">
                        <div class="form-icon position-relative d-flex mb-2 mb-lg-0 mb-md-0">
                            <p class="mb-0 d-md-flex d-lg-flex d-none d-md-block d-lg-block text-dark-grey align-items-center mr-3 ">
                                {{ __('seo.date') }}
                            </p>
                            <input type="text" id="datatableRange" name="datatableRange"
                                class="form-control"
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
                            <a class="btn btn-primary px-5" href="{{ route('marketing.campaign.index') }}"
                                role="button">{{__('common.reset')}}</a>
                        </div>
                    </div>
                </div>
                <!--Filter End-->

                <div class="table-responsive" id="campaign_listing">

                    <table class="table  table_wrapper" id="table">
                        <thead>
                            <tr>
                                <th class="">{{ __('common.sl_no') }}</th>
                                <th class="text-center">Start Date</th>
                                <th class="text-center">{{ __('campaign.campaign_name') }}</th>
                                <th class="text-center">Source</th>
                                <th class="text-center">No. Of Contacts</th>
                                <th class="text-center">Sender Name</th>
                                <th class="text-center">{{ __('common.status') }}</th>
                                <th class="text-center">{{ __('common.action') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            <!-- Start -->
                            @if (!empty($content->data))
                                @foreach ($content->data as $key => $campaign)
                       
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">
                                            {{ date('d-M-Y', strtotime($campaign->start_date ?? '')) }}
                                        </td>
                                        
                                        <td class="text-center">
                                            <a href="javascript:void(0)"  data-bs-target="#modal_{{$campaign->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                 {{ $campaign->campaign_name }}
                                            </a>
                                        </td>
                                        <td class="text-center">
                                          @if($campaign->source==1)
                                            <span class="badge badge-pill text-bg-primary">Customer</span>
                                          @elseif($campaign->status==2)
                                             <span class="badge badge-pill text-bg-primary">Lead</span>
                                          @else
                                            <span class="badge badge-pill text-bg-primary">Marketing Contact</span>
                                          @endif
                                        </td>
                                        <td class="text-center">
                                            @if(!empty($campaign->campaign_email))
                                            {{count($campaign->campaign_email)}}
                                            @endif
                                        </td>
                                    
                                        <td class="text-center">
                                            <span class="badge text-bg-info">{{$campaign->sender_name  ?? ''}}</span>
                                        </td>
                          
                                        <td class="text-center">
                                          @if($campaign->status==0)
                                            <span class="badge badge-pill text-bg-danger">InActive</span>
                                          @elseif($campaign->status==1)
                                             <span class="badge badge-pill text-bg-success">Active</span>
                                          @else
                                            <span class="badge badge-pill text-bg-primary">Completed</span>
                                          @endif

                                        </td>
                                        <td class="align-items-center justify-content-center d-flex gap-2">
                                            <a href="{{ url('marketing/campaign/view/' . $campaign->id) }}"
                                                class="btn btn-sm d-flex align-items-center px-0 mg-r-5">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')

                                            <a href="{{ url('marketing/campaign/edit/' . $campaign->id) }}"
                                                id="editmodal" value="{{ $campaign->id }}"
                                                class="btn btn-sm d-flex align-items-center px-0">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                       <!-- Modals Start-->
                                        <div class="modal fade" id="modal_{{$campaign->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{$campaign->campaign_subject}}</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    {{$campaign->description}}
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div> 
                                       <!-- Modals End-->
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8">
                                        <h5 class="text-center mb-0 py-1">{{ __('common.no_record') }}</h5>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                     <!--Pagination Start-->
                     {!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'marketing.campaign.index',['start_date'=>$content->start_date,'end_date'=>$content->end_date]) !!}
                     <!--Pagination End-->

                </div>
            </div>
        </div>
    </div>
    @endif
    <!--end container-->


    <!--start delete modal-->
    <div class="modal fade effect-scale" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('campaign.delete_campaign') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value='' id="delete_designation_id" name="input_field_id">
                    <p class="mg-b-0">{{ __('user-manager.are_you_sure') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('common.no') }}
                    </button>
                    <button type="submit" class="btn btn-primary delete_submit_btn">{{ __('common.yes') }}</button>
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
            $(document).ready(function() {

                // Delete Ajax Start

                $(document).on("click", "#delete_btn", function() {
                    var campaign_id = $(this).attr('value');
                    $('#delete_designation_id').val(campaign_id);
                    $('#delete_modal').modal('show');
                });
                $(document).on('click', '.delete_submit_btn', function() {
                    var campaign_id = $('#delete_designation_id').val();

                    $('#delete_modal').modal('hide');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('marketing/campaign-delete') }}",
                        data: {
                            campaign_id: campaign_id
                        },
                        dataType: "json",
                        success: function(response) {
                             Toaster('success' , response.success);
                            location.reload();
                        }
                    });

                });
                //End of delete ajax



                //  Change Status Start
                $('.toggle-class').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 0;
                    let campaign_id = $(this).data('id');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('marketing.campaign-status') }}",
                        data: {
                            'status': status,
                            'campaign_id': campaign_id
                        },
                        success: function(response) {
                            Toaster('success' , response.success);
                        }
                    });
                });
                //Change Status End


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

              
                $('input[name="datatableRange"]').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                    ajaxSubmitData();
                })

                $("#search").on('keyup', function(e) {
                    if ((this.value).length >= 3 || (this.value).length == 0) {
                        tableWebContent('', '', this.value);
                    } 
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
                        $("#order_listing").html('');

                    $("#order_listing").html('');
                    tableWebContent(startDate, endDate);
                }


                function tableWebContent(startDate = '', endDate = '', search = '') {

                    const url = "{{ route('marketing.campaignFilter') }}";
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
                            $("#campaign_listing").html(result.html);
                        }
                    });
                }

            });
        </script>
    @endpush
</x-app-layout>
