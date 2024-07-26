<table class="table  table_wrapper" id="seo_title">
    <thead>
        <tr>
            {{-- <th class="">{{ __('seo.task_title') }}</th> --}}

            <th class="wd-20p">{{ __('seo.website_url') }}</th>
            <th class=" wd-20p">{{ __('seo.username') }}</th>
            <th class="">{{ __('seo.password') }}</th>
            <th class="">{{ __('seo.do_follow') }}</th>
            <th class="">{{ __('seo.da') }}</th>
            <th class="">{{ __('seo.spam_score') }}</th>
            <th class="">{{ __('common.status') }}</th>
            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                <th class="">{{ __('common.action') }}</th>
            @endif
        </tr>
    </thead>
    <tbody>
        {{-- @dd($content); --}}
        @if (!empty($content->seosubmissionwebsites))
            {{-- @foreach ($content->seotasklist as $key => $task) --}}
                {{-- <tr>
                    <td>{{ $task->seo_task_title }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> --}}
                {{-- @dd($content) --}}

                @if (!empty($content->seosubmissionwebsites))
                    @foreach ($content->seosubmissionwebsites as $key => $seosubmission)
 
                    @php 
                    $id = $seosubmission->id;
                       $editUrl = 'submission-url/' .$id .'/edit';
                       $deleteUrl = $seosubmission->id;
                       @endphp
                        <tr>
                            <td class="d-none"><input type="hidden" value="{{$seosubmission->website_id}}">
                                <input type="hidden" value="{{$seosubmission->seo_task_id}}">
                            </td>
                            <td class="text-break">
                                <a href="{{$seosubmission->website_url}}" class="col-2 text-truncate  {{($seosubmission->dofollow == 1) ? 'text-primary':'text-dark'}}">
                                    {{Str::limit($seosubmission->website_url,20)}}
                                </a>
                            </td>
                            <td>{{$seosubmission->username}}</td>
                            <td>{{$seosubmission->password}}</td>

                            <td>{{$seosubmission->dofollow == 1 ? __('common.yes') :__('common.no')}}</td>
                            <td>{{$seosubmission->da ?? ''}}</td>
                            <td>{{$seosubmission->spam_score ?? ''}}</td>

                            <td>
                                <div class="custom-control custom-switch">
                                    <input data-id="${seosubmission.id}" class="custom-control-input toggle-class"
                                        id="customSwitch{{ $seosubmission->id}}" type="checkbox" {{ $seosubmission->status ==1
                                        ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customSwitch{{ $seosubmission->id}}"></label>
                                </div>
                            </td>
                            <td class="align-items-center justify-content-center gap-2 d-flex">
                                <a href="{{$editUrl}}" class="btn btn-sm  px-0 d-flex align-items-center mg-r-5"><svg
                                        viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                        stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg><span class="d-sm-inline mg-l-5"></span></a>

                                <a href="#delete_modal" id="delete_btn" data-id="{{ $deleteUrl}}" value=""
                                    data-bs-toggle="modal" class="btn btn-sm  px-0 d-flex align-items-center"><svg
                                        viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                        stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="css-i6dzq1">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                    </svg><span class="d-none d-sm-inline mg-l-5"></span></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            {{-- @endforeach --}}
        @else

            <tr>
                <td colspan="8">
                    <h5 class="text-center mb-0 py-1">{{ __('common.no_record') }}</h4>
                </td>

            </tr>
        @endif
    </tbody>
</table>

<!--Pagination Start-->
{!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'seo.submission-url.index',['website_id'=>$content->website_id,'seo_task_id'=>$content->seo_task_id]) !!}
<!--Pagination End-->