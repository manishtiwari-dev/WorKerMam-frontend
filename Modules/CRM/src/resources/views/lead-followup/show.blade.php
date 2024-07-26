<x-app-layout>
    @section('title', $pageTitle)

    <div class="container pd-x-0 tx-13">
        <div class="d-lg-flex gap-2">
            <div class="profile-sidebar profile-sidebar-two col-lg-3">
                <div class="card card-body border-0"> 
                        <div class="">

                            <ul class="list-unstyled media-list mg-b-15">
                                <li class="media align-items-center">
                                    <div class="media-body pd-l-15"> 
                                    </div>
                                </li>
                            </ul>
                            <div>
                                <label
                                    class="tx-sans tx-14  tx-color-01 tx-spacing-1 mg-b-15">Contact
                                    Information</label>
                                <ul class="list-unstyled profile-info-list">
                                    <li class="mb-2 tx-12">
                                        Name : <span class="tx-color-03"> {{ $content->crm_list->contact_name }}</span>
                                    </li>
                                    @if (!empty($content->crm_list->street_address))
                                        <li class="tx-12">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-briefcase">
                                                <rect x="2" y="7" width="20" height="14"
                                                    rx="2" ry="2"></rect>
                                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                            </svg> <span class="tx-color-03">
                                                {{ $content->crm_list->street_address ?? '' }}</span>
                                        </li>
                                    @endif
                                    @if (!empty($content->crm_list->state) || !empty($content->crm_list->city) || !empty($content->crm_list->zipcode))
                                        <li class="tx-12">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-home">
                                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                            </svg> <span class="tx-color-03">{{ $content->crm_list->state }} ,
                                                {{ $content->crm_list->city }} ,
                                                {{ $content->crm_list->zipcode }}</span>
                                        </li>
                                    @endif
                                    @if (!empty($content->crm_list->phone))
                                        <li class="tx-12 mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-phone">
                                                <path
                                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                                </path>
                                            </svg> <a href=""> {{ $content->crm_list->phone ?? '' }} </a>
                                        </li>
                                    @endif
                                    @if (!empty($content->crm_list->contact_email))
                                        <li class="tx-12"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-mail">
                                                <path
                                                    d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                                </path>
                                                <polyline points="22,6 12,13 2,6"></polyline>
                                            </svg> <a href="">{{ $content->crm_list->contact_email ?? '' }}</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="tagselect  mg-t-30">
                                <label
                                    class="tx-sans tx-14 tx-color-01 tx-spacing-1 mg-b-15">Tags</label>
                                <select class="form-control select2" multiple="multiple"
                                    data-id="{{ $content->crm_list->lead_id }}" id="lead_tags">
                                    <option disable disabled>{{ __('crm.select_tag') }}
                                    </option>
                                    @if (!empty($content->crm_list->crm_tags))
                                        @foreach ($content->crm_list->crm_tags as $crm_tag)
                                            @php
                                                $selected = '';
                                                foreach ($content->crm_list->crmlead->crm_lead_to_tag as $key => $tag) {
                                                    if ($crm_tag->tags_id == $tag->tags_id) {
                                                        $selected = 'selected';
                                                    }
                                                }
                                            @endphp
                                            <option value="{{ $crm_tag->tags_id }}" {{ $selected }}>
                                                {{ $crm_tag->tags_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div>
                                <label
                                    class="tx-sans tx-14 tx-color-01 tx-spacing-1">Clients
                                    Details</label>
                                <ul class="list-unstyled profile-info-list">
                                    @if (!empty($content->crm_list->agent_name))
                                        <span class="tx-12 tx-color-03">{{ __('crm.agent') }} :</span>
                                        <li class="mb-2"> {{ $content->crm_list->agent_name ?? '' }}</li>
                                    @endif
                                    @if (!empty($content->crm_list->category))
                                        <span class="tx-12 tx-color-03">{{ __('crm.category') }} : </span>
                                        <li>{{ $content->crm_list->category }}</li>
                                    @endif

                                </ul>
                            </div>
                            <div class="d-flex">
                                <div class="profile-skillset flex-fill text-lg-center border">
                                    <h5 class="mb-0"><a href="" class="link-01">{{ $content->crm_list->orderCount }}</a>
                                    </h5>
                                    <label class="tx-12">{{ __('crm.order') }}</label>
                                </div>
                                <div class="profile-skillset flex-fill text-lg-center border">
                                    <h5  class="mb-0"><a href="" class="link-01">{{ $content->crm_list->enquiryCount }}</a>
                                    </h5>
                                    <label class="tx-12">{{ __('crm.enquiry') }}</label>
                                </div>
                                <div class="profile-skillset flex-fill text-lg-center border">
                                    <h5 class="mb-0"><a href="" class="link-01">{{ $content->crm_list->Quotation }}</a>
                                    </h5>
                                    <label class="tx-12">{{ __('crm.quote') }}</label>
                                </div>
                            </div>
                            <div class="mg-t-30">
                                <label
                                    class="tx-sans tx-14 tx-color-01 tx-spacing-1 mg-b-15">Social
                                    Channel</label>
                                <ul class="list-unstyled profile-info-list">

                                    @if (!empty($content->crm_list->socialist))
                                        @foreach ($content->crm_list->socialist as $social)
                                            @php
                                                if ($social->social_type == 1) {
                                                    $typeSocial = 'WHATSAPP';
                                                } elseif ($social->social_type == 2) {
                                                    $typeSocial = 'FACEBOOK';
                                                } elseif ($social->social_type == 3) {
                                                    $typeSocial = 'INSTAGRAM';
                                                } else {
                                                    $typeSocial = 'LINKEDIN';
                                                }
                                            @endphp
                                            <li> <a href="{{ $social->social_link }}"> {{ $typeSocial }} </a>
                                            </li>
                                        @endforeach
                                    @endif

                                </ul>
                            </div>
                        </div><!-- col -->
                    
                </div><!-- row -->

            </div><!-- profile-sidebar -->
            <div class="card-body mg-t-40 mg-lg-t-0 pd-lg-x-10 media-height col-lg-9" >
                <div  class="profile-update-option bg-white ht-50 bd d-flex justify-content-end mg-b-20 mg-lg-b-25 rounded">
                    <div class="d-flex align-items-center pd-x-20 mg-r-auto">
                        Lead Details
                    </div>
                    <div class="wd-50 bd-l d-flex align-items-center justify-content-center">
                        <a href="{{ route('crm.lead.edit', [$content->crm_list->lead_id]) }}" class="link-03"
                            data-bs-toggle="tooltip" title="" data-original-title="Publish Photo"><svg
                                xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" data-feather="edit-2">
                                <rect x="3" y="3" width="18" height="18" rx="2"
                                    ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg></a>
                    </div>

                    <div class="wd-50 bd-l d-flex align-items-center justify-content-center">
                        <a href="" class="link-03" data-bs-toggle="tooltip" title=""
                            data-original-title="Write an Article"><svg xmlns="http://www.w3.org/2000/svg"
                                width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" data-feather="mail">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg></a>
                    </div>
                </div>

                <div class="card mg-b-20 mg-lg-b-25">
                    <div class="card-header p-0">
                        <div class="contact-content">
                            <div class="contact-content-header">
                                <nav class="nav nav-tabs gap-1">
                                    <a href="#followup" class="nav-link active position-relative"
                                        data-bs-toggle="tab">FollowUp</span></a>
                                    <a href="#note" class="nav-link position-relative" data-bs-toggle="tab">Note</a>
                                    <a href="#ticket" class="nav-link position-relative" data-bs-toggle="tab">Ticket</a>
                                    <a href="#enquiry" class="nav-link position-relative"
                                        data-bs-toggle="tab">Enquiry</a>
                                    <a href="#quote" class="nav-link position-relative"
                                        data-bs-toggle="tab">Quotation</a>
                                    <a href="#order" class="nav-link position-relative"
                                        data-bs-toggle="tab">Order</span></a>
                                </nav>
                            </div><!-- contact-content-header -->

                            <div class="contact-content-body ps ps--active-y">
                                <div class="tab-content">
                                    <div id="followup" class="tab-pane show active">
                                        <div class="d-flex align-items-center justify-content-between px-2 py-3">
                                            <h6 class="mg-b-0">FollowUp</h6>
                                            <button type="button" data-id="0" data-type="1"
                                                class="btn btn-lg btn-primary  d-flex align-items-center FollowUpModal"><i
                                                    data-feather="plus"></i></button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-dashboard mg-b-0">
                                                <thead>
                                                    <tr>
                                                        <th>Source</th>
                                                        <th>Source ID</th>
                                                        <th>Last Followup</th>
                                                        <th>Next Followup</th>
                                                        <th>Followup Status</th>
                                                        <!-- <th>Note</th> -->
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (!empty($content->crm_list->crmLeadfollowup))
                                                        @foreach ($content->crm_list->crmLeadfollowup as $crmLead) 
                                                            <tr>
                                                                <td>
                                                                    @if ($crmLead->source == 1)
                                                                        General
                                                                    @elseif($crmLead->source == 2)
                                                                        Enquiry
                                                                    @elseif($crmLead->source == 3)
                                                                        Quotation
                                                                    @else
                                                                        Order
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($crmLead->source == 1)
                                                                        -
                                                                    @elseif($crmLead->source == 2)
                                                                        @if (!empty($crmLead->enquiry))
                                                                            {{ $crmLead->enquiry->enquiry_no }}
                                                                        @endif
                                                                    @elseif($crmLead->source == 3)
                                                                        @if (!empty($crmLead->quotation))
                                                                            {{ $crmLead->quotation->quotation_no }}
                                                                        @endif
                                                                    @elseif($crmLead->source == 4)
                                                                        @if (!empty($crmLead->order))
                                                                            {{ $crmLead->order->order_number }}
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td>{{ $crmLead->last_followup }}</td>
                                                                <td>{{ $crmLead->next_followup }}</td>
                                                                <td>
                                                                    <span class="badge"
                                                                        style="background-color: {{ $crmLead->crm_lead_status->status_color ?? '' }} ;">{{ $crmLead->crm_lead_status->status_name ?? '' }}</span>
                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                        data-id="{{ $crmLead->followup_id }}"
                                                                        data-type="2"
                                                                        class="btn btn-lg folloupview"><i
                                                                            data-feather="eye"></i></button>
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="note" class="tab-pane">
                                        <div class="d-flex align-items-center justify-content-between px-2 py-3">
                                            <h6 class="mg-b-0"> Note</h6>
                                            <a href="#followupNotesModal" data-bs-toggle="modal"
                                                class="btn btn-sm btn-primary d-flex align-items-center"><i
                                                    data-feather="plus"></i></a>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-dashboard mg-b-0">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Note Details</th>
                                                        <th>Note Visibility</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (!empty($content->crm_list->crmleadnotelist))
                                                        @foreach ($content->crm_list->crmleadnotelist as $crmleadnote)
                                                            <tr>
                                                                <td>{{ \Carbon\Carbon::parse($crmleadnote->created_at)->format('d/m/Y') }}
                                                                </td>
                                                                <td>{{ $crmleadnote->note_details }}</td>
                                                                <td>{{ $crmleadnote->note_visibility }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- tab-pane -->
                                    <div id="ticket" class="tab-pane">
                                        <div class="d-flex align-items-center justify-content-between px-2 py-3">
                                            <h6 class="mg-b-0">Ticket</h6>
                                            <a href="#" data-bs-toggle="modal"
                                                class="btn btn-sm btn-primary d-flex align-items-center"><i
                                                    data-feather="plus"></i></a>
                                        </div>

                                    </div><!-- tab-pane -->
                                    <div id="enquiry" class="tab-pane">
                                        <div class="d-flex align-items-center justify-content-between px-2 py-3">
                                            <h6 class="mg-b-0"> Enquiry</h6>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-dashboard mg-b-0">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Enquiry Id</th>
                                                        <th>Message</th>
                                                        <th>Last Followup</th>
                                                        <th>Next Followup</th>
                                                        <th>Followup Status</th>
                                                        <th>Update</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (!empty($content->crm_list->enquiryDetails))
                                                        @foreach ($content->crm_list->enquiryDetails as $enquiry)
                                                            <tr>
                                                                <td>{{ \Carbon\Carbon::parse($enquiry->created_at)->format('d/m/Y') }}
                                                                </td>
                                                                <td><a
                                                                        href="{{ route('sales.enquiry.show', $enquiry->enquiry_id) }}">{{ $enquiry->enquiry_no }}</a>
                                                                </td>
                                                                <td>{{ $enquiry->message }}</td>
                                                                <td>{{ $enquiry->followupstatus->last_followup ?? '-' }}
                                                                </td>
                                                                <td>{{ $enquiry->followupstatus->next_followup ?? '-' }}
                                                                </td>
                                                                <td>
                                                                    <span class="badge"
                                                                        style="background-color: {{ $enquiry->followupstatus->crm_lead_status->status_color ?? '' }} ;">{{ $enquiry->followupstatus->crm_lead_status->status_name ?? 'Pending' }}</span>
                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                        data-id="{{ $enquiry->enquiry_id }}"
                                                                        data-type="2"
                                                                        class="btn btn-lg btn-primary enquiryModal"><i
                                                                            data-feather="plus"></i></button>
                                                                    <button type="button"
                                                                        data-id="{{ $enquiry->enquiry_id }}"
                                                                        data-type="2"
                                                                        class="btn btn-lg btn-white enquiryView"><i
                                                                            data-feather="eye"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="quote" class="tab-pane">
                                        <div class="d-flex align-items-center justify-content-between px-2 py-3">
                                            <h6 class="mg-b-0">Quotation</h6>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-dashboard mg-b-0">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Quotation Id</th>
                                                        <th>Quotation Total</th>
                                                        <th>Last Followup</th>
                                                        <th>Next Followup</th>
                                                        <th>Followup Status</th>
                                                        <th>Update</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (!empty($content->crm_list->quotationDetails))
                                                        @foreach ($content->crm_list->quotationDetails as $quotation)
                                                            <tr>
                                                                <td>{{ \Carbon\Carbon::parse($quotation->created_at)->format('d/m/Y') }}
                                                                </td>
                                                                <td><a
                                                                        href="{{ url('sales/quotation/details/' . $quotation->id) }}">{{ $quotation->quotation_no }}</a>
                                                                </td>
                                                                <td>{{ $quotation->subtotal }}</td>
                                                                <td>{{ $quotation->followupstatus->last_followup ?? '-' }}
                                                                </td>
                                                                <td>{{ $quotation->followupstatus->next_followup ?? '-' }}
                                                                </td>
                                                                <td>{{ $quotation->followupstatus->crm_lead_status->status_name ?? 'Pending' }}
                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                        data-id="{{ $quotation->id }}"
                                                                        data-type="3"
                                                                        class="btn btn-lg btn-primary quotationModal"><i
                                                                            data-feather="plus"></i></button>
                                                                    <button type="button"
                                                                        data-id="{{ $quotation->id }}"
                                                                        data-type="3"
                                                                        class="btn btn-lg btn-white quotationView"><i
                                                                            data-feather="eye"></i></button>
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="order" class="tab-pane">
                                        <div class="d-flex align-items-center justify-content-between px-2 py-3">
                                            <h6 class="mg-b-0"> Order</h6>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-dashboard mg-b-0">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Order Id</th>
                                                        <th>Order Total</th>
                                                        <th>Last Followup</th>
                                                        <th>Next Followup</th>
                                                        <th>Followup Status</th>
                                                        <th>Update</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (!empty($content->crm_list->ordertDetails))
                                                        @foreach ($content->crm_list->ordertDetails as $order)
                                                            <tr>
                                                                <td>
                                                                    {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
                                                                </td>
                                                                <td> 
                                                                    <a href="#">{{ $order->order_number }}</a>
                                                                </td>
                                                                <td>{{ $order->sub_total }}</td>
                                                                <td>{{ $order->followupstatus->last_followup ?? '-' }}
                                                                </td>
                                                                <td>{{ $order->followupstatus->next_followup ?? '-' }}
                                                                </td>
                                                                <td>{{ $order->followupstatus->crm_lead_status->status_name ?? 'Pending' }}
                                                                </td>
                                                                <td class="d-flex gap-2">
                                                                    <button type="button"
                                                                        data-id="{{ $order->order_id }}"
                                                                        data-type="4"
                                                                        class="btn btn-lg orderModal px-2 py-1"><i
                                                                            data-feather="plus"></i></button>
                                                                    <button type="button"
                                                                        data-id="{{ $order->order_id }}"
                                                                        data-type="4"
                                                                        class="btn btn-lg orderView px-2 py-1"><i
                                                                            data-feather="eye"></i></button>
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div><!-- tab-content -->
                            </div><!-- contact-content-body -->
                        </div>
                    </div><!-- card-header -->
                </div><!-- card -->
            </div><!-- media-body -->
        </div><!-- media -->
    </div><!-- container -->
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
                                <input type="hidden" name="client_lead_id" id="client_lead_id"
                                    value="{{ $content->crm_list->lead_id }}" />
                                <input name="followupdate" id="followupdate" type="text" class="form-control followupdatePick" placeholder="{{ __('crm.followupdate_placeholder') }}"  value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}" required>
                                
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
                                    <option selected disable value="" disabled>
                                        {{ __('crm.select_followupStatus') }}</option>
                                    @if (!empty($content->crm_list->leadstatuslist))
                                        @foreach ($content->crm_list->leadstatuslist as $key => $leadstatus)
                                            <option value="{{ $leadstatus->status_id }}">
                                                {{ $leadstatus->status_name }}
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
                                        class="text-danger">*</span></label>
                                <input name="nextfollowUp" id="nextfollowUp" type="text" class="form-control followupdatePick"
                                    placeholder="{{ __('crm.nextfollowUp_placeholder') }}" required>
                                
                                <div class="invalid-feedback">
                                    {{ __('crm.nextfollowUp_error') }}
                                </div>
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('crm.followupNote') }}<span
                                        class="text-danger"></span></label>
                                <textarea name="followupNote" id="followupNote" class="form-control"
                                    placeholder="{{ __('crm.followupNote_placeholder') }}" required></textarea> 
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
    <!--  start modal store -->
    <div class="modal fade" id="followupView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Followup Details</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <div class="table-responsive followupTable">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal store end -->
    <!--  start modal store -->
    <div class="modal fade" id="followupNotesModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('crm.addNotes') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form method="POST" id="note_add_userForm" class="needs-validation mg-b-0" novalidate>
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">{{ __('crm.note_details') }}<span
                                        class="text-danger">*</span></label>
                                <textarea name="note_details" id="note_details" class="form-control" placeholder="{{ __('crm.note_placeholder') }}"
                                    required></textarea>
                                <span class="text-danger">
                                    @error('note_details')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('crm.note_error') }}
                                </div>
                            </div>
                            <div class="form-group col-lg-12">
                                <input type="hidden" name="note_lead_id" id="note_lead_id"
                                    value="{{ $content->crm_list->lead_id }}" />
                                <label class="form-label">{{ __('crm.note_visibility') }}<span
                                        class="text-danger">*</span></label>
                                <select class="form-select form-control note_visibility " id="note_visibility"
                                    name="note_visibility" required>
                                    <option selected disable value="" disabled>
                                        {{ __('crm.select_note_visibility') }}</option>
                                    <option value="public"> Public </option>
                                    <option value="private"> Private </option>
                                </select>
                                <span class="text-danger">
                                    @error('note_visibility')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('crm.note_visibility_error') }}
                                </div>
                            </div>
                        </div>
                        <input type="submit" id="note_submit" name="send" class="btn btn-primary"
                            value="{{ __('common.submit') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal store end -->


    @push('scripts')
        <script>
            

            $(document).ready(function() {
                $(".folloupview").on("click", function(e) {
                    e.preventDefault();
                    var data = {
                        followup_id: $(this).data('id'),
                    };
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('crm/get-followup') }}",
                        data: data,
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            $(".followupTable").empty();
                            var html = `<table class="table table-dashboard mg-b-0">
                                            <thead>
                                                <tr>
                                                    <th>Followup Date</th>
                                                    <th>Followup Status</th>
                                                    <th>Note</th>
                                                </tr>
                                            </thead>
                                            <tbody>`;
                            $.each(response.followuplist, function(key, followup) {
                                console.log(followup);
                                html += `<tr>
                                                        <td>${ followup.followup_at} </td>
                                                        <td>${followup.crm_lead_status.status_name}</td>
                                                        <td>${ followup.followup_note}</td>

                                                    </tr>`;
                            });
                            html += `</tbody> 
                                        </table>`;

                            $(".followupTable").append(html);
                            $("#followupView").modal('show');
                        },
                        error: function(response) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $(".orderModal").click(function() {
                    var source_id = $(this).data('id');
                    var source_type = $(this).data('type');
                    $("#source_id").val(source_id);
                    $("#source_type").val(source_type);
                    $("#followup_date_add").modal('show');
                });
                $(".quotationModal").click(function() {
                    var source_id = $(this).data('id');
                    var source_type = $(this).data('type');
                    $("#source_id").val(source_id);
                    $("#source_type").val(source_type);
                    $("#followup_date_add").modal('show');
                });
                $(".enquiryModal").click(function() {
                    var source_id = $(this).data('id');
                    var source_type = $(this).data('type');
                    $("#source_id").val(source_id);
                    $("#source_type").val(source_type);
                    $("#followup_date_add").modal('show');
                });
                $(".FollowUpModal").click(function() {
                    var source_id = $(this).data('id');
                    var source_type = $(this).data('type');
                    $("#source_id").val(source_id);
                    $("#source_type").val(source_type);
                    $("#followup_date_add").modal('show');
                    
                    $('.followupdatePick').datepicker({
                        multidate: true,
                        format: 'dd/mm/yy' 
                    });

                });

               
            });
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
        <script>
            $(document).ready(function() {
                $(".enquiryView").on("click", function(e) {
                    e.preventDefault();
                    var data = {
                        enquiry_id: $(this).data('id'),
                        type: $(this).data('type'),
                    };

                    followupviewDetails(data);
                });

                $(".quotationView").on("click", function(e) {
                    e.preventDefault();
                    var data = {
                        enquiry_id: $(this).data('id'),
                        type: $(this).data('type'),
                    };

                    followupviewDetails(data);
                });

                $(".orderView").on("click", function(e) {
                    e.preventDefault();
                    var data = {
                        enquiry_id: $(this).data('id'),
                        type: $(this).data('type'),
                    };

                    followupviewDetails(data);
                });


                function followupviewDetails(data) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('crm/get-followupHistory') }}",
                        data: data,
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            $(".followupTable").empty();
                            var html = `<table class="table table-dashboard mg-b-0">
                                            <thead>
                                                <tr>
                                                    <th>Followup Date</th>
                                                    <th>Followup Status</th>
                                                    <th>Note</th>
                                                </tr>
                                            </thead>
                                            <tbody>`;
                            $.each(response.followuplist, function(key, followup) {
                                console.log(followup);
                                html += `<tr>
                                                        <td>${ followup.followup_at} </td>
                                                        <td>${followup.crm_lead_status.status_name}</td>
                                                        <td>${ followup.followup_note}</td>

                                                    </tr>`;
                            });
                            html += `</tbody> 
                                        </table>`;

                            $(".followupTable").append(html);
                            $("#followupView").modal('show');
                        },
                        error: function(response) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                }
            });
        </script>
        <script>
            $(document).ready(function() {
                $(document).submit("#note_submit", function(e) {
                    e.preventDefault();
                    $('#note_add_userForm').addClass('was-validated');
                    if ($('#note_add_userForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            note_details: $("#note_details").val(),
                            note_visibility: $("#note_visibility").val(),
                            lead_id: $("#note_lead_id").val(),
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ url('crm/client-note-store') }}",
                            data: data,
                            dataType: "json",
                            success: function(response) {
                                // $('#industry_add_modal').trigger("reset");
                                Toaster('success', response.success);
                                $('#followupNotesModal').modal('hide');
                                $('#note_add_userForm').trigger('reset')

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


            //update lead tags
            $(document).ready(function() {
                $('#lead_tags').change(function() {
                    var data = {
                        tag_id: $(this).val(),
                        lead_id: $(this).data('id'),
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ url('crm/lead-tag-update') }}",
                        data: data,
                        success: function(response) {
                            console.log(response);
                            Toaster('success', response.success);
                        }
                    });
                });
            });
            //end
        </script>
    @endpush
</x-app-layout>
