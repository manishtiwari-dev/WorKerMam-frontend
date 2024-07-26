<table class="table  table_wrapper">
    <thead>
        <tr>
            <th>{{__('common.sl_no')}}</th>
            <th>Website</th>
            <th>{{ __('seo.redirect_from') }}</th>
            <th>{{ __('seo.redirect_to') }}</th>
            <th>{{ __('seo.type') }}</th>
            <th>{{ __('seo.status') }}</th>
            <th>{{ __('common.date') }}</th>
            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
            <th class="wd-10p text-center">
                {{__('common.action')}}
            </th>
            @endif
        </tr>
    </thead>
    <tbody>
        @if(sizeof($content->data)>0)
            @foreach($content->data as $key=>$redirectData)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        @forelse ($content->website_list as $websites)
                            @if($websites->subscription_id==$redirectData->subscription_id)
                                {{$websites->website_name}}
                                @break
                            @endif
                        @empty
                        @endforelse
                    </td>
                    <td>{{$redirectData->redirect_from ?? ''}}</td>
                    <td>{{$redirectData->redirect_to ?? ''}}</td>
                    <td>{!!$redirectData->redirect_type==1 ? '<span class="badge bg-primary text-white">Permanent Redirection</span>' : '<span class="badge bg-warning text-dark">Temp. Redirection</span>'!!}</td>
                
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox"
                                class="custom-control-input urlToggleBtn"
                                {{ $redirectData->status == '1' ? 'checked' : '' }}
                                data-id="{{ $redirectData->id }}"
                                id="customSwitch{{ $redirectData->id }}">
                            <label class="custom-control-label"
                                for="customSwitch{{ $redirectData->id }}"></label>
                        </div>
                    </td>

                    <td>  {{ date('d M,Y', strtotime($redirectData->created_at ?? '')) }}</td>
                    <td class="align-items-center justify-content-center d-flex gap-2">
                        <a href="#edit_url"
                            class="btn btn-sm d-flex align-items-center px-0 mg-r-5 editBtn"
                            data-toggle="modal" data-id="{{$redirectData->id}}">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            <span class="d-sm-inline mg-l-5"></span>
                        </a>

                        <a href="#url_delete_modal" data-toggle="modal"
                            data-id="{{$redirectData->id}}"
                            class="btn btn-sm d-flex align-items-center px-0 url_delete_btn">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                            <span class="d-none d-sm-inline mg-l-5"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        @else
        <tr>
            <td colspan="6">
                <h5 class="text-center mb-0 py-1">{{ __('common.no_record') }}</h5>
            </td>
        </tr>
        @endif
    </tbody>
</table>

  <!--Pagination Start-->
  {!! \App\Helper\Helper::make_pagination(
    $content->total_records,
    $content->per_page,
    $content->current_page,
    $content->total_page,
    'seo.redirection',
    ['start_date'=>$content->start_date,'end_date'=>$content->end_date]
) !!}
<!--Pagination End-->