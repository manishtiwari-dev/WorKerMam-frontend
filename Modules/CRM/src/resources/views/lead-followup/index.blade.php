<x-app-layout>
    @section('title', $pageTitle)
    <style>
        .tagselect .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            background: transparent;
            border: 0;
            opacity: 1;
            left: 0;
        }
    </style>
    <div class="card mt-3">
        <div class="tab-content">
            <div class="card-header d-flex align-items-center justify-content-between py-2 px-3">
                <h5 class="tx-15 mb-0">Lead Followup</h5>

            </div>
            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                <div class="card-body">

                    <!--Filter Start-->
                    <div class="row align-item-center mb-3 order-list-wrapper">
                        <div class="col-lg-4">
                            <div class="form-icon position-relative mb-3">
                                <!-- <label>{{ __('crm.source') }}</label> -->
                                <select class="form-select form-control select2" name="source_name" id="source_name"
                                    aria-label="Default select example">
                                    <option selected value="">All Source</option>
                                    @if (!empty($content->sourcelist))
                                        @foreach ($content->sourcelist as $source)
                                            <option value="{{ $source->source_id }}">
                                                {{ $source->source_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-icon position-relative mb-3">
                                <!-- <label> {{ __('FollowUp Status') }} </label> -->
                                <select class="form-select form-control followup select2" id="followup"
                                    aria-label="Default select example" name="followup">
                                    <option selected value="">All Group</option>
                                    @if (!empty($content->crmLeadStatus))
                                        @foreach ($content->crmLeadStatus as $crmStatus)
                                            <option value="{{ $crmStatus->status_id }}">
                                                {{ $crmStatus->status_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <!--Approval Status Start-->
                        <div class="col-lg-4">
                            <div class="form-icon position-relative  mb-3 tagselect">
                                <!-- <label> {{ __('crm.tags') }} </label> -->
                                <select class="form-select form-control tagSelect select2" multiple="multiple"
                                    id="tags" aria-label="Default select example" name="tags">
                                    <option value="" selected>{{ __('All Tags') }}</option>
                                    @if (!empty($content->crmtags))
                                        @foreach ($content->crmtags as $key => $value)
                                            <option value="{{ $value->tags_id }}">
                                                {{ $value->tags_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <!--Approval Status End-->
                        <div class="col-lg-4">
                            <!-- <label>Search</label> -->
                            <input type="text" id="searchbar" value="{{ $search ?? '' }}"
                                class="form-control fas fa-search" placeholder="Search..." aria-label="Search"
                                name="search">
                        </div>
                        <div class="col-lg-3">
                            <div class="form-icon position-relative  mb-3 ">
                                <!-- <label> {{ __('seo.date') }} </label> -->
                                <input type="text" id="datatableRange" name="datatableRange" class="form-control"
                                    placeholder="{{ __('common.daterange_placeholder') }}" />
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-icon position-relative mb-3">
                                <!-- <label>{{ __('crm.agent_name') }}</label> -->
                                <select class="form-select form-control select2" name="agent_details" id="crm_agent"
                                    aria-label="Default select example">
                                    <option value="" selected>{{ __('All Agent') }}</option>
                                    @if (!empty($content->crmagentlist))
                                        @foreach ($content->crmagentlist as $crmagentlist)
                                            <option value="{{ $crmagentlist->agent_id }}">
                                                {{ $crmagentlist->agent_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-icon position-relative mb-3">
                                <a class="btn btn-primary px-5" href="{{ route('crm.lead-followup.index') }}"
                                    role="button">{{ __('common.reset') }}</a>
                            </div>
                        </div>
                    </div>
                    <!--Filter End-->

                    <div class="table-responsive" id="followup_listing">
                        <table class="table  table_wrapper  px-3">
                            <thead>
                                <tr>
                                    <th class="border-bottom" style="min-width:70px;">{{ __('common.sl_no') }}</th>
                                    <th class="border-bottom" style="">{{ __('crm.date') }}
                                    </th>

                                    <th class="border-bottom" style="">{{ __('crm.source') }}
                                    </th>
                                    <th class="border-bottom" style="">{{ __('crm.source_id') }}
                                    </th>
                                    <th class="border-bottom" style="min-width: 150px;">{{ __('crm.contact_details') }}
                                    </th>
                                    <th class="border-bottom" style="min-width: 150px;">{{ __('crm.last_followup') }}
                                    </th>
                                    <th class="border-bottom" style="min-width: 100px;">
                                        {{ __('crm.next_followup') }}
                                    </th>
                                    <th class="border-bottom text-center">
                                        {{ __('crm.followup_status') }}
                                    </th>
                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                        <th class="text-center border-bottom" style="min-width: 70px;">
                                            {{ __('common.action') }}
                                        </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="Search_Tr">
                                @if (!empty($content->lead_list))
                                    @foreach ($content->lead_list as $key => $leads)
                                        {{-- <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <h6 class="tx-semibold mg-b-0">{{ $leads->contact_name }}</h6>
                                                <span class="tx-color-03">{{ $leads->contact_email }}</span><br />

                                            </td>
                                            <td>
                                                {{ $leads->crm_lead_followup->last_followup ?? '' }}
                                            </td>
                                            <td>
                                                {{ $leads->crm_lead_followup->next_followup ?? '' }}
                                            </td>
                                            <td>
                                                {{ $leads->crm_lead_followup->crm_lead_status->status_name ?? '' }}
                                            </td>
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                <td class="d-flex align-items-center gap-2 justify-content-center">
                                                    <a href="{{ route('crm.lead.show', [$leads->lead_id]) }}"
                                                        class="btn btn-sm btn-white d-flex align-items-center mg-r-5"><i
                                                            data-feather="eye"></i></a>
                                                </td>
                                            @endif
                                        </tr> --}}
                                        <tr>
                                            <td>{{ $content->current_page * $content->per_page + $key + 1 - $content->per_page }}
                                            </td>

                                            <td> {{ \Carbon\Carbon::parse($leads->created_at)->format('d/m/Y') }}</td>
                                            <td>
                                                @if ($leads->source == 1)
                                                    General
                                                @elseif($leads->source == 2)
                                                    Enquiry
                                                @elseif($leads->source == 3)
                                                    Quotation
                                                @else
                                                    Order
                                                @endif
                                            </td>
                                            <td>
                                                @if ($leads->source == 1)
                                                    -
                                                @elseif($leads->source == 2)
                                                    @if (!empty($leads->enquiry))
                                                        {{ $leads->enquiry->enquiry_no }}
                                                    @endif
                                                    {{-- @elseif($leads->source == 3)
                                                    @if (!empty($leads->quotation))
                                                        {{ $leads->quotation->quotation_no }}
                                                    @endif --}}
                                                    {{-- @elseif($leads->source == 4)
                                                    @if (!empty($leads->order))
                                                        {{ $leads->order->order_number }}
                                                    @endif --}}
                                                @endif
                                            </td>
                                            <td>
                                                <h6 class="tx-semibold mg-b-0">
                                                    {{ $leads->crm_lead->contact_name ?? '' }}</h6>
                                                <span
                                                    class="tx-color-03">{{ $leads->crm_lead->contact_email ?? '' }}</span><br />
                                            </td>
                                            <td>
                                                {{ $leads->last_followup ?? '' }}
                                            </td>
                                            <td>
                                                {{ $leads->next_followup ?? '' }}
                                            </td>
                                            {{-- @dd($content->crmLeadStatus) --}}
                                            <td>
                                                <select class="form-select form-control follow_up_status select2"
                                                    id="followup" data-id="{{ $leads->source_id }}" data-type="{{$leads->source}}"
                                                    data-lead="{{ $leads->lead_id }}"
                                                    data-followup="{{ $leads->followup_id }}"
                                                    aria-label="Default select example" name="followup">
                                                    <option selected value="">All Status</option>
                                                    @if (!empty($content->crmLeadStatus))
                                                        @foreach ($content->crmLeadStatus as $crmStatus)
                                                            <option value="{{ $crmStatus->status_id }}" 
                                                                @if(!empty($crmStatus->crm_lead_follow_up)) {{ $crmStatus->crm_lead_follow_up->followup_status == $leads->followup_status ? 'selected' : '' }} @endif>
                                                                {{ $crmStatus->status_name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>

                                            </td>
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                <td class="d-flex align-items-center gap-2 justify-content-center">
                                                    <a href="{{ route('crm.lead-followup.show', [$leads->lead_id]) }}"
                                                        class="btn btn-sm d-flex align-items-center mg-r-5">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <!--Pagination Start-->
                        {!! \App\Helper\Helper::make_pagination(
                            $content->total_records,
                            $content->per_page,
                            $content->current_page,
                            $content->total_page,
                            'crm.lead-followup.index',
                            [
                                'start_date' => $content->start_date,
                                'end_date' => $content->end_date,
                                'search' => $content->search,
                                'source_name' => $content->source_name,
                                'followup' => $content->followup,
                                'tags' => $content->tags,
                                'crm_agent' => $content->crm_agent,
                            ],
                        ) !!}
                        <!--Pagination End-->
                    </div>
            @endif
        </div>

    </div>
    <!--end row-->
    </div>
    <!--Lead delete modal start here-->
    <div class="modal fade effect-scale" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Delete Lead</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <input type="hidden" id="deleteLeadId" name="input_field_id">
                    <p class="mg-b-0">{{ __('common.delete_confirmation') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('common.no') }}
                    </button>
                    <button type="button" class="btn btn-primary deleteConfirmBtn">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--Lead delete modal end here-->

    <!--  start modal store -->
    <div class="modal fade" id="followup_date_add" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('crm.add_followup') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form method="POST" id="followupdate_add_userForm" class="needs-validation mg-b-0" novalidate>
                        @csrf

                        <div class="form-row">

                            <div class="form-group col-lg-6">
                                <input type="hidden" name="source_id" id="source_id" />
                                <input type="hidden" name="source_type" id="source_type" />
                                <label class="form-label">{{ __('crm.followupdate') }}<span
                                        class="text-danger">*</span></label>
                                <input type="hidden" name="client_lead_id" id="client_lead_id" value="" />
                                <input type="hidden" name="client_followup_id" id="client_followup_id" value="" />

                                <input name="followupdate" id="followupdate" type="text"
                                    class="form-control followupdatePick"
                                    placeholder="{{ __('crm.followupdate_placeholder') }}"
                                    value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}" required>

                                <span class="text-danger">
                                    @error('followupdate')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('crm.followupdate_error') }}
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('crm.followupStatus') }}<span
                                        class="text-danger">*</span></label>
                                <select class="form-select form-control followupStatus select2" id="followupStatus"
                                    name="followupStatus" required>
                                    <option selected value="">Select Status</option>
                                    @if (!empty($content->crmLeadStatus))
                                        @foreach ($content->crmLeadStatus as $crmStatus)
                                            <option value="{{ $crmStatus->status_id }}">
                                                {{ $crmStatus->status_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="text-danger">
                                    @error('followupStatus')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('crm.followupStatus_error') }}
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('crm.nextfollowUp') }}<span
                                        class="text-danger"></span></label>
                                <input name="nextfollowUp" id="nextfollowUp" type="text" class="form-control followupdatePick"
                                    placeholder="{{ __('crm.nextfollowUp_placeholder') }}" >
                               
                                <div class="invalid-feedback">
                                    {{ __('crm.nextfollowUp_error') }}
                                </div>
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('crm.followupNote') }}<span
                                        class="text-danger"></span></label>
                                <textarea name="followupNote" id="followupNote" class="form-control"
                                    placeholder="{{ __('crm.followupNote_placeholder') }}" ></textarea> 
                                <div class="invalid-feedback">
                                    {{ __('crm.followupNote_error') }}
                                </div>
                            </div>
                        </div>
                        <input type="submit" id="followup_submit" name="send" class="btn btn-primary"
                            value="{{ __('common.submit') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal store end -->

    @push('scripts')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>

        <script type="text/javascript">
            $('.select2').select2({});
            $(function() {
                $(".alert").delay(2000).fadeOut("slow");
            });
        </script>
        <script>
            $('.lead_id').on('keyup', function() {
                var data = $('.lead_id').val();
                alert(data);
            });
            $(".lead_id").keyup(function() {
                alert("g");
            });
        </script>

        <script type="text/javascript">
            // change status in ajax code start
            $('.follow_status').change(function() {

                let status = $(this).val();
                //  var lead_id = $('.lead_id').val();
                var lead_id = $(this).data('id');
                console.log(lead_id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('crm/lead-followup') }}",
                    data: {
                        status: status,
                        lead_id: lead_id
                    },
                    success: function(data) {
                        Toaster(' Lead Status Changed ');
                    }
                });
            });
            // chenge status in ajax code end  
        </script>
        <script>
            $(document).ready(function() {

                $(document).on("click", "#deleteBtn", function() {
                    var lead_id = $(this).val();
                    $('#deleteLeadId').val(lead_id);
                });
                $(document).on('click', '.deleteConfirmBtn', function() {
                    var lead_id = $('#deleteLeadId').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('crm/lead-followup') }}/" + lead_id,
                        data: {
                            lead_id: lead_id,
                            _method: 'DELETE'
                        },
                        dataType: "json",
                        success: function(response) {
                            Toaster(response.success);
                            $('.flash-message').html(response.success);
                            $('.flash-message').addClass('alert alert-success');
                            $('#department_edit').modal('hide');
                            $("#department").load(location.href + " #department");

                            $('.flash-message').fadeOut(3000, function() {
                                location.reload(true);
                            });
                        }
                    });

                });


                // status follow up

                $(document).on('change', '.follow_up_status', function(e) {

                    var source_id = $(this).data('id');
                    var lead_id = $(this).data('lead');
                    var followup_id = $(this).data('followup');

                    
                    console.log(lead_id);
                    var source_type = $(this).data('type');
                    $("#source_id").val(source_id);
                    $("#client_lead_id").val(lead_id);
                    $("#client_followup_id").val(followup_id);

                    $("#source_type").val(source_type);
                    $("#followup_date_add").modal('show');


                    $('.followupdatePick').datepicker({
                        multidate: true,
                        dateFormat: 'dd/mm/yy',
                    });



                    // let status_id = $(this).val();
                    // let lead_id = $(this).data("id");
                    // console.log(lead_id);

                    // $.ajaxSetup({
                    //     headers: {
                    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //     }
                    // });
                    // $.ajax({
                    //     type: "POST",
                    //     dataType: "json",
                    //     url:"{{ url('crm/lead-status') }}",
                    //     data: {
                    //         'status_id': status_id,
                    //         'lead_id': lead_id,
                    //     },
                    //     success: function(response) {
                    //         Toaster('success', response.success);
                    //     }
                    // });
                });


            });

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

                $("#searchbar").on('keyup', function(e) {

                    tableWebContent('', '', this.value, '', '');
                });

                $("#crm_agent").on('change', function(e) {

                    tableWebContent('', '', '', $(this).val(), '');
                });

                $(".tagSelect").on('change', function(e) {

                    tableWebContent('', '', '', '', $(this).val());
                });

                $("#source_name").on('change', function(e) {
                    tableWebContent('', '', '', '', '', $(this).val());
                });

                $("#followup").on('change', function(e) {
                    tableWebContent('', '', '', '', '', '', $(this).val());
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
                    $("#customer_listing").html('');

                $("#customer_listing").html('');
                tableWebContent(startDate, endDate);
            }

            function tableWebContent(startDate = '', endDate = '', search = '', agent_id = '', tagSelect = '', source_name = '',
                followup = '') {

                const url = "{{ route('crm.followup-filter') }}";
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
                        agent_id: agent_id,
                        tagSelect: tagSelect,
                        source_name: source_name,
                        followup: followup,

                    },
                    dataType: "json",
                    success: function(result) {
                        $("#followup_listing").html(result.html);
                    }
                });
            }
        </script>

        <script>
            $(document).ready(function() {
                $(document).submit("#followup_submit", function(e) {
                    e.preventDefault();
                    $('#followupdate_add_userForm').addClass('was-validated');
                    if ($('#followupdate_add_userForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            source: $("#source_type").val(),
                            source_id: $("#source_id").val(),
                            lead_id: $("#client_lead_id").val(),
                            followup_id: $("#client_followup_id").val(),
                            last_followup: $("#followupdate").val(),
                            next_followup: $("#nextfollowUp").val(),
                            followup_status: $("#followupStatus").val(),
                            followup_note: $("#followupNote").val(),
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ url('crm/client-followup-store') }}",
                            data: data,
                            dataType: "json",
                            success: function(response) {
                                // $('#industry_add_modal').trigger("reset");
                                Toaster('success', response.success);
                                $('#followup_date_add').modal('hide');
                                $('#followupdate_add_userForm').trigger('reset')

                                setTimeout(function() {
                                    location.reload(true);
                                }, 3000);



                            },
                            error: function(response) {
                                var errors = data.responseJSON;
                                console.log(errors);
                            }
                        });
                    }
                });
            });
        </script>
    @endpush

</x-app-layout>
