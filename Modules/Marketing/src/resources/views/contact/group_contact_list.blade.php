
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
                <a href="{{route('marketing.contact-create',['id'=>$content->group_id])}}" class="btn btn-sm btn-bg btn-primary"><i data-feather="plus" class="mg-r-5"></i>{{__('newsletter.add_contact')}}</a>
                <a href="{{ route('marketing.contact-import',['id'=>$content->group_id]) }}" class="btn btn-sm btn-bg mg-l-5 btn-primary"> <i data-feather="plus"></i> Import</a>
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
            <div class="table-responsive" id="contactList_listing"> 
                <table class="table  table_wrapper">
                    <thead>
                        <tr>
                            <th class="text-center">{{__('newsletter.contact_name')}}</th>
                            <th class="text-center">{{__('newsletter.contact_email')}}</th>
                            <th class="text-center">Phone</th>
                        </tr>
                    </thead>  
                    <tbody>
                        @forelse($content->data_list as $key=>$contact)
                            @if(!empty($contact->contact_details))
                            <tr>       
                                <td class="text-center">{{$contact->contact_details->contact_name ?? ''}}</td>
                                <td class="text-center">{{$contact->contact_details->contact_email ?? ''}}</td>
                                <td class="text-center">{{$contact->contact_details->phone ?? ''}}</td>
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
                {!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'marketing.contact-group-view',['id'=>$content->group_id]) !!}
                <!--Pagination End-->
            
            </div>
        </div>
    </div>
    @endif

</x-app-layout> 