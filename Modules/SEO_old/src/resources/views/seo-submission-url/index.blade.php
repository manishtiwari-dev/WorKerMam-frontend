@php
    $api_token = request()->cookie('api_token');
    $userdata = Cache::get('userdata-' . $api_token);
@endphp

<x-app-layout>
    @section('title', $pageTitle)
    <div class="card">
        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
            <div class="tab-content">

                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">{{ __('seo.submission_list') }}</h6>
                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                            <a href="{{ route('seo.submission-url.create') }}"
                                class="btn btn-sm btn-bg d-flex align-items-center mg-r-5 btn-primary">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                <span class=" d-sm-inline mg-l-5">{{ __('seo.add_submission') }} </span>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-row">
                        @if ($userdata->role == 'super_admin' || $userdata->role == 'seomanager')
                            <div class="form-group col-md-4">
                                <div class="form-icon position-relative">
                                    <select class="form-select form-control select2" name="website_name" id="website_name">
                                        <option selected disabled value="">{{ __('seo.select_website') }}</option>
                                        @if (!empty($content->websitelist))
                                            @foreach ($content->websitelist as $website => $websitename)
                                                <option value="{{ $websitename->id }}"
                                                    {{ request()->website_id == $websitename->id ? 'selected' : '' }}>
                                                    {{ ucfirst($websitename->website_name) }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <small class="text-danger error_alert"></small>
                            </div>
                        @else
                            <div class="form-group col-md-4">
                                <div class="form-icon position-relative select2">
                                    <select class="form-select form-control select2" name="website_name" id="website_name">
                                        <option selected disabled value="">{{ __('seo.select_website') }}</option>
                                        @if (!empty($content->websitelist))
                                            @foreach ($content->websitelist as $website => $websitename)
                                                <option value="{{ $websitename[0]->id }}"
                                                    {{ request()->website_id == $websitename[0]->id ? 'selected' : '' }}>
                                                    {{ ucfirst($websitename[0]->website_name) }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <small class="text-danger error_alert"></small>
                            </div>
                        @endif

                        <div class="form-group col-md-4">
                            <div class="form-icon position-relative">
                                <select class="form-select form-control select2" name="seolist" id="seolist">
                                    <option selected disabled value="">{{ __('seo.select_task') }}</option>
                                    @if (!empty($content->seotasklist))
                                        @foreach ($content->seotasklist as $seotask)
                                            <option data-content="{{ ucfirst($seotask->seo_task_title) }}"
                                                value="{{ $seotask->id }}"
                                                {{ request()->seo_task_id == $seotask->id ? 'selected' : '' }}>
                                                {{ ucfirst($seotask->seo_task_title) }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-icon position-relative">
                                <input type="text" class="form-control" id="input_search" name="search"
                                    placeholder="search">
                            </div>
                        </div>
                       
                    </div>
                    <div class="table-responsive" id="seo_title">
                       
                        <table class="table  table_wrapper">
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
                                @if($urlPage)
                                <tr>

                                    {{-- @if (!empty($content->seotasklist))
                                    @foreach ($content->seotasklist as $key => $task) --}}
                                        {{-- <tr>
                                            <td>{{ $task->seo_task_title }} <i class="fa fa-arrow-circle-down" aria-hidden="true"></i></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr> --}}
                                        {{-- @dd($content->total_records) --}}
                        
                                        @if (!empty($content->seosubmissionwebsites))
                                            @foreach ($content->seosubmissionwebsites as $key => $seosubmission)
                                            @php 
                                            $id = $seosubmission->id;
                                                $editUrl = 'submission-url/' .$id .'/edit';
                                                $deleteUrl = $seosubmission->id;
                                                @endphp
                                                <tr>
                                                    <td class="d-none">
                                                        <input type="hidden" value="{{$seosubmission->website_id}}">
                                                        <input type="hidden" value="{{$seosubmission->seo_task_id}}">
                                                    </td>
                                                    <td class="text-break {{($seosubmission->dofollow == 1) ? 'text-primary':''}} ">
                                                        {{$seosubmission->website_url}}</td>
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
                                                        <a href="{{$editUrl}}" class="btn btn-sm d-flex align-items-center mg-r-5 px-0"><svg
                                                                viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                                                stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                                class="css-i6dzq1">
                                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                            </svg><span class="d-sm-inline mg-l-5"></span></a>
                        
                                                        <a href="#delete_modal" id="delete_btn" data-id="{{ $deleteUrl}}" value=""
                                                            data-bs-toggle="modal" class="btn btn-sm d-flex align-items-center px-0"><svg
                                                                viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                                                stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                                class="css-i6dzq1">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                </path>
                                                            </svg><span class="d-none d-sm-inline mg-l-5"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    {{-- @endforeach
                                @endif --}}
                                </tr>
                                @else

                                <tr>
                                    <td colspan="8">
                                        <h5 class="text-center mb-0 py-1">{{ __('seo.record_not_found') }}</h4>
                                    </td>

                                </tr>

                                @endif
                            </tbody>
                        </table>
                        @if($urlPage)
                         <!--Pagination Start-->
                            {!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'seo.submission-url.index',['website_id'=>$content->website_id,'seo_task_id'=>$content->seo_task_id]) !!}
                         <!--Pagination End-->
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!--start delete modal-->
    <div class="modal fade effect-scale" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('seo.delete_submission') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_department_id" name="input_field_id">
                    <p class="mg-b-0">{{ __('common.delete_confirmation') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('common.no') }}
                    </button>
                    <button type="button" class="btn btn-primary "
                        id="delete_submit_btn">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!--End delete modal-->

    @push('scripts')
        <script type="text/javascript">
            //  website status ajax start
            $(document).on("change", ".toggle-class", function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('seo.submission-status-chenge') }}",
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(response) {
                        Toaster(response.success);
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $(document).on("click", "#delete_btn", function() {
                    var submission_id = $(this).data('id');
                    $('#delete_department_id').val(submission_id);
                });
                $(document).on('click', '#delete_submit_btn', function() {
                    var submission_id = $('#delete_department_id').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('seo/submission-url') }}/" + submission_id,
                        data: {
                            submission_id: submission_id,
                            _method: 'DELETE'
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            Toaster(response);
                            $('#delete_modal').fadeOut(2000, function() {
                                location.reload(true);
                            });
                        }
                    });
                });
            });
        </script>
        <!--end delete ajax-->

        <script type="text/javascript">
            $(document).ready(function() {

                @php
                    if (request()->website) {
                        echo 'ajaxSubsmisstionData()';
                    }
                @endphp

                $('#website_name, #seolist').on('change', function() {

                    var website_id = $('#website_name').val();
                    var seo_task_id = $('#seolist').val();
                    $(".error_alert").text("");
                    if(website_id==null || seo_task_id==null)
                        $(".error_alert").text("Please select website and task.");
                    else
                        ajaxSubsmisstionData();
                });

                $('#input_search').on('keyup', function() {
                    ajaxSubsmisstionData();
                });
            });



            function ajaxSubsmisstionData() {

                var website_id = $('#website_name').val();
                var seo_task_id = $('#seolist').val();

                let status = true;
                let msg = '';
                var input_search = $('#input_search').val();

                if (input_search != '') {
                    if (input_search.length < 3) {
                        $('.toast').toast('show');
                        status = false;
                    } else if (website_id == 0) {
                        $('.toast').toast('show');
                        // Toaster("Please Select Website");
                        status = false;
                    }

                } else {
                    input_search = '';
                }

                $("#seo_title").html('');

                if (status == true)
                    tableContent(website_id, seo_task_id, input_search);
            }

            // function tableContent(website_id, seo_task_id, input_search) {
            //     const url = "{{ route('seo.get-subission-url') }}";
            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            //     $.ajax({
            //         url: url,
            //         type: "POST",
            //         data: {
            //             website_id: website_id,
            //             seo_task_id: seo_task_id,
            //             input_search: input_search,
            //         },
            //         dataType: "json",
            //         beforeSend: function() {
            //             var html = `<div class="preloader-container d-flex justify-content-center align-items-center">
    //                     <div class="spinner-border" role="status" aria-hidden="true"></div>
    //                 </div>`;
            //             $("#seo_title").append(html);
            //         },
            //         success: function(result) {
            //             console.log(result);
            //             var html = `<table id="example1" class="table border table_wrapper">
    //                         <thead>
    //                     <th class="wd-20p">{{ __('seo.task_title') }}</th>

    //                     <th class="wd-25p">{{ __('seo.website_url') }}</th>                                  
    //                     <th class=" wd-15p">{{ __('seo.username') }}</th>
    //                     <th class=" wd-15p">{{ __('seo.password') }}</th>
    //                     <th class=" wd-15p">{{ __('common.status') }}</th>
    //                     <th class="wd-10p" >{{ __('common.action') }}</th>
    //                         </thead>`;

            //             $.each(result.seotasklist, function(key, value) {
            //                 if (value.id == seo_task_id || seo_task_id == '0') {
            //                     html += `<tr>
    //                             <td>${value.seo_task_title}</td>
    //                             <td></td>
    //                             <td></td>
    //                             <td></td>
    //                             <td></td>
    //                             <td></td>
    //                             <td></td>
    //                         </tr>`;
            //                     $.each(result.seosubmissionwebsites, function(seosubmissionlist,
            //                         seosubmission) {
            //                         if (value.id == seosubmission.seo_task_id) {
            //                             var id = [seosubmission.id];
            //                             //, seosubmission.website_id, seosubmission.seo_task_id
            //                             var editUrl = 'submission-url/' + id + '/edit';
            //                             var deleteUrl = seosubmission.id;
            //                             html += `<tr>
    //                                     <td><input type="hidden" value="${seosubmission.website_id}">
    //                                     <input type="hidden" value="${seosubmission.seo_task_id}"></td>
    //                                     <td class="text-break ${(seosubmission.dofollow == 1) ? 'text-primary':''} ">${seosubmission.website_url}</td>
    //                                     <td>${seosubmission.username}</td>
    //                                     <td>${seosubmission.password}</td>
    //                                     <td>
    //                                         <div class="custom-control custom-switch">
    //                                             <input data-id="${seosubmission.id}"
    //                                             class="custom-control-input toggle-class" id="customSwitch${ seosubmission.id}" type="checkbox"
    //                                             ${ seosubmission.status == 1 ? 'checked' : '' }>
    //                                             <label class="custom-control-label" for="customSwitch${ seosubmission.id}"></label>
    //                                         </div>
    //                                     </td>
    //                                     <td class="d-flex align-items-center">
    //                                         <a href="${editUrl}" class="btn btn-sm btn-white d-flex align-items-center mg-r-5"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg><span class="d-sm-inline mg-l-5"></span></a>

    //                                         <a href="#delete_modal" id="delete_btn" data-id="${ deleteUrl}" value="" data-bs-toggle="modal" class="btn btn-sm btn-white d-flex align-items-center"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg><span class="d-none d-sm-inline mg-l-5"></span></a>
    //                                     </td>
    //                                 </tr>`;
            //                         }
            //                     });
            //                 }

            //             });
            //             html += `</table>
    //             `;

            //             $("#seo_title").html(html);
            //         }
            //     });
            // }


            function tableContent(website_id = '', seo_task_id = '', input_search = '') {

                const url = "{{ route('seo.submission-filter') }}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        website_id: website_id,
                        seo_task_id: seo_task_id,
                        input_search: input_search,
                    },
                    dataType: "json",
                    success: function(result) {
                        $("#seo_title").html(result.html);
                    }
                });
            }
        </script>
    
    <!--Unlimited Scrolling-->
  

    @endpush
</x-app-layout>
