<x-app-layout>
    @section('title',  $pageTitle)
    <div class="card groupData-content-body">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="tx-15 mg-b-0">{{__('contact.contact_sources')}}</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="contactGroup_listing">
                <table class="table  table_wrapper">
                    <thead>
                        <tr>
                            <th class="text-center">{{__('common.sl_no')}}</th>
                            <th class="text-center">{{__('contact.source_name')}}</th>
                            <th class="text-center">{{__('contact.no_of_contacts')}}</th>
                            <th class="text-center">{{__('contact.active_campaign')}}</th>
                            <th class="text-center">{{__('contact.sent')}}</th>
                            <th class="text-center">{{__('common.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">{{__('contact.customer_contact')}}</td>
                            <td class="text-center">{{$content['customer'] ?? '-'}}</td>
                            <td class="text-center">{{$content['customer_camp_count'] ?? '-'}}</td>
                            <td class="text-center">{{$content['customer_campemail_count'] ?? '-'}}</td>
                            <td class="d-flex align-items-right justify-content-center">
                                <a href="{{route('marketing.contact-list',['source'=>"customer"])}}" class="btn btn-sm  d-flex align-items-center mg-r-5">
                                    <i data-feather="eye"></i>
                                </a>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="text-center">2</td>
                            <td class="text-center">{{__('contact.lead_contact')}}</td>
                            <td class="text-center">{{$content['lead'] ?? '-'}}</td>
                            <td class="text-center">{{$content['lead_camp_count'] ?? '-'}}</td>
                            <td class="text-center">{{$content['lead_campemail_count'] ?? '-'}}</td>
                            <td class="d-flex align-items-center justify-content-center">
                                <a href="{{route('marketing.contact-list',['source'=>"lead"])}}" class="btn btn-sm  d-flex align-items-center mg-r-5">
                                    <i data-feather="eye"></i>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center">3</td>
                            <td class="text-center">{{__('contact.imported_contact')}}</td>
                            <td class="text-center">{{$content['imported'] ?? '-'}}</td>
                            <td class="text-center">{{$content['imported_camp_count'] ?? '-'}}</td>
                            <td class="text-center">{{$content['imported_campemail_count'] ?? '-'}}</td>
                            <td class="d-flex align-items-center justify-content-center">
                                <a href="{{route('marketing.contact-list',['source'=>"imported"])}}" class="btn btn-sm  d-flex align-items-center mg-r-5">
                                    <i data-feather="eye"></i>
                                </a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
