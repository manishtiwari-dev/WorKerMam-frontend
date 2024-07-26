@php
    $api_token = request()->cookie('api_token');
    $userdata = Cache::get('userdata-' . $api_token);
    //  dd($country);
@endphp

<x-app-layout>
    @section('title',"Web Redirector")

    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true') 
    <div class="card contact-content-body">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="tx-15 mg-b-0">{{ __('seo.redirect_list') }}</h6>
                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true') 
                <a href="#add_url" class="btn btn-lg btn-bg d-flex align-items-center mg-r-5 btn-primary"
                    data-bs-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i>
                    <span class=" d-sm-inline mg-l-5">{{ __('seo.add_url') }}</span>
                </a>
                @endif
            </div>
        </div>
      
        <div class="card-body">

            @if ($userdata->role == 'super_admin' || $userdata->role == 'seomanager')
            <div class="row align-item-center mb-3 order-list-wrapper">
                <div class="col-lg-4 col-12 col-md-12">
                    <div class="mb-2 mb-lg-0">
                    <select class="form-select form-control mb-0 d-flex align-items-center mr-3 select2" id="website_dropdown" aria-label="Default select example">
                        <option selected value="">Select website</option>
                        @forelse ($content->website_list as $websites)
                            <option value="{{$websites->subscription_id}}">{{$websites->website_name ?? ''}}</option>
                        @empty
                        @endforelse
                    </select>


                    </div>
                </div>

                <div class="col-lg-6 col-12 col-md-12 mb-2 mb-lg-0">
                    <div class="mb-2 mb-lg-0">
                    <input type="text" id="search" value="" class="form-control fas fa-search"
                        placeholder="Search..." aria-label="Search" name="search">
                    </div>
                </div>
                <div class="col-lg-2 col-12 col-md-12 d-lg-flex d-md-flex  justify-content-end">
                    <div class="align-items-center ">
                        <a class="btn btn-primary btn-block" href="{{route('seo.redirection')}}"
                            role="button"><i class="fa fa-refresh" aria-hidden="true"></i>
                             {{ __('common.reset') }}</a>
                    </div>
                </div>
            </div>
            @else
            <div class="row align-item-center mb-3 order-list-wrapper">
                <div class="col-lg-4 col-12 col-md-12">
                    <div class="mb-2 mb-lg-0">
                    <select class="form-select form-control mb-0 d-flex align-items-center mr-3 select2" id="website_dropdown" aria-label="Default select example">
                        <option selected value="">Select website</option>
                        @forelse ($content->website_list as $websites)
                            <option value="{{$websites[0]->subscription_id}}">{{$websites[0]->website_name ?? ''}}</option>
                        @empty
                        @endforelse
                    </select>


                    </div>
                </div>

                <div class="col-lg-6 col-12 col-md-12 mb-2 mb-lg-0">
                    <div class="mb-2 mb-lg-0">
                    <input type="text" id="search" value="" class="form-control fas fa-search"
                        placeholder="Search..." aria-label="Search" name="search">
                    </div>
                </div>
                <div class="col-lg-2 col-12 col-md-12 d-lg-flex d-md-flex  justify-content-end">
                    <div class="align-items-center ">
                        <a class="btn btn-primary btn-block" href="{{route('seo.redirection')}}"
                            role="button"><i class="fa fa-refresh" aria-hidden="true"></i>
                             {{ __('common.reset') }}</a>
                    </div>
                </div>
            </div>

            @endif




            <div class="table-responsive" id="url_listing">
                
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
                                 @if ($userdata->role == 'super_admin' || $userdata->role == 'seomanager')
                                    @forelse ($content->website_list as $websites)
                                    @if($websites->subscription_id==$redirectData->subscription_id)
                                        {{$websites->website_name}}
                                        @break
                                    @endif
                                    @empty
                                    @endforelse
                                    @else
                                    @forelse ($content->website_list as $websites)
                                    @if($websites[0]->subscription_id==$redirectData->subscription_id)
                                        {{$websites[0]->website_name}}
                                        @break
                                    @endif
                                    @empty
                                    @endforelse
                                    @endif

                                    </td>

                                    <td class="text-truncate">{{$redirectData->redirect_from ?? ''}}</td>
                                    <td class="text-truncate">{{$redirectData->redirect_to ?? ''}}</td>
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
                                        
                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true') 
                                        <a href="#edit_url"
                                            class="btn btn-sm  d-flex align-items-center mg-r-5 px-0 editBtn"
                                            data-bs-toggle="modal" data-id="{{$redirectData->id}}">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                            <span class="d-sm-inline mg-l-5"></span>
                                        </a>
                                        @endif

                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'remove') == 'true') 
                                        <button data-bs-target="#url_delete_modal" data-bs-toggle="modal"
                                            data-id="{{$redirectData->id}}"
                                            class="btn btn-sm  d-flex align-items-center url_delete_btn px-0">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            <span class="d-none d-sm-inline mg-l-5"></span>
                                        </button>
                                        @endif

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

            </div>
        </div>
    </div>
    @endif

    <!---  Add URL Modal Start Here ------------->
    <input type="hidden" value="{{$content->website_url}}" id="website_url">
        <div class="modal fade" id="add_url" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content tx-14">
                    <div class="modal-header align-item-center">
                        <h6 class="modal-title" id="exampleModalLabel">{{ __('seo.add_url') }} </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <form id="add_url_form" class="needs-validation" novalidate>

                          
                            <div class="form-group">
                                <label for="sender_email">{{ __('seo.website') }}<span class="text-danger">*</span></label>
                                <select name="subscription_id" id="subscription_id"
                                class="form-control select2Modal @error('subscription_id') is-invalid @enderror">
                                <option selected disabled value="">{{ __('seo.select_website') }}
                                </option>
                                @if ($userdata->role == 'super_admin' || $userdata->role == 'seomanager')
                                @foreach ($content->website_list as $sub)
                                    <option value="{{ $sub->subscription_id }}">
                                        {{ $sub->website_name }}
                                    </option>
                                @endforeach
                                @else
                                @foreach ($content->website_list as $sub)
                                <option value="{{ $sub[0]->subscription_id }}">
                                    {{ $sub[0]->website_name }}
                                </option>
                            @endforeach
                            @endif

                                </select>
                            
                            </div>

                            <div class="form-group">
                                <label for="redirect_from">{{ __('seo.redirect_from') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control url_input" id="redirect_from" name="redirect_from"
                                    placeholder="{{ __('seo.redirect_from_placeholder') }}" required>
                                <span style="color:red;">
                                    @error('redirect_from')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('seo.redirect_from_error') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="redirect_to">{{ __('seo.redirect_to') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control url_input" id="redirect_to" name="redirect_to"
                                    placeholder="{{ __('seo.redirect_to_placeholder') }}" required>
                                <span style="color:red;">
                                    @error('redirect_to')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                  
                                    {{ __('seo.redirect_to_error') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sender_email">{{ __('seo.url_type') }}<span class="text-danger">*</span></label>
                                <select class="form-select form-control select2Modal" name="redirect_type" id="redirect_type" required aria-label="Default select example">
                                    <option selected value="1">{{ __('seo.permanent_redirection') }}</option>
                                    <option value="2">{{ __('seo.temp_redirection') }} </option>
                                </select>
                                <span style="color:red;">
                                    @error('redirect_to')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                  {{ __('seo.url_type_error') }}
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary"
                                id="addUrlBtn">{{ __('common.submit') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!---  Add URL Modal End Here ------------->
       
    
    <!---  Edit URL List Modal Start Here ------------->
        <div class="modal fade" id="edit_url" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content tx-14">
                    <div class="modal-header align-item-center">
                        <h6 class="modal-title" id="exampleModalLabel"> {{ __('seo.update_url') }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <form id="update_url_form" class="needs-validation" novalidate>
                            <input type="hidden" class="edit_id"  id="edit_id" name="id">
                            <div class="form-group">
                                <label for="sender_email">{{ __('seo.website') }}<span class="text-danger">*</span></label>
                                <select name="subscription_id" id="website_name"
                                class="form-control subscription  select2Modal @error('subscription_id') is-invalid @enderror  "
                                aria-label="Default select example" disabled>
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_redirect_from">{{ __('seo.redirect_from') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control edit_redirect_from url_input" id="edit_redirect_from" name="edit_redirect_from"
                                    placeholder="{{ __('seo.redirect_from_placeholder') }}" required>
                                <span style="color:red;">
                                    @error('redirect_from')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('seo.redirect_from_error') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="edit_redirect_to">{{ __('seo.redirect_to') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control edit_redirect_to url_input" id="edit_redirect_to" name="edit_redirect_to"
                                    placeholder="{{ __('seo.redirect_to_placeholder') }}" required>
                                <span style="color:red;">
                                    @error('redirect_to')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('seo.redirect_to_error') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sender_email">{{ __('seo.url_type') }}<span class="text-danger">*</span></label>
                                <select class="form-select select2Modal form-control edit_redirect_type" name="redirect_type" id="edit_redirect_type" required aria-label="Default select example">
                                    <option selected value="1">{{ __('seo.permanent_redirection') }}</option>
                                    <option value="2">{{ __('seo.temp_redirection') }}</option>
                                </select>
                                <span style="color:red;">
                                    @error('redirect_to')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('seo.url_type_error') }}
                                </div>
                            </div>
                            {{-- <input type="hidden"   id="edit_id" name="id"> --}}
                            <button type="button" class="btn btn-primary"
                                id="updateUrlBtn">{{ __('common.submit') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!---  Edit URL Modal End Here ------------->

    <!--start delete modal-->
    <div class="modal fade" id="url_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-item-center">
                    <h6 class="modal-title" id="exampleModalLabel"> {{ __('seo.delete_redirector') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <h5>{{__('common.delete_confirmation')}}</h5>
                    <input type="hidden" id="delete_id" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary delete_submit_btn" >{{__('common.yes')}}</button>
                    <button type="button" class="btn btn-primary delete_submit_btn"  data-bs-dismiss="modal">{{__('common.no')}}</button>
                </div>
            </div>
        </div>
    </div>


    <!--end delete modal-->

    @push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {

            // $('.selectsearch').select2({
            //     searchInputPlaceholder: 'Search options'
            // });
            // // For Add Modal
            // $('.modal_selectsearch').select2({
            //     searchInputPlaceholder: 'Search options',
            //     dropdownParent: $('#add_url')
            // });
            // // For Edit Modal
            // $('.edit_modal_selectsearch').select2({
            //     searchInputPlaceholder: 'Search options',
            //     dropdownParent: $('#edit_url')
            // });


            
            // Check Is input value is valid url

            $('.url_input').on("keyup", function(e) {
                var typesVal=$(this).val();
                if(typesVal!=''){

                   var website_url= new URL($("#website_url").val()).hostname;
                    function isValidURL(string) {
                        var res = string.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
                        return (res !== null)
                    };

                    if(isValidURL(typesVal)==true)
                    {   
                        var TypedHost=new URL(typesVal).hostname;
                        if(TypedHost!=website_url){
                            $(this).next('span').text('Invalid Url');
                            $('.url_input').parents('form').find('button[type=button]').prop('disabled', true);
                        }
                        else{
                            $(this).next('span').text(' ');
                            $('.url_input').parents('form').find('button[type=button]').prop('disabled', false);
                        }
                    }
               }
            });

             // Add Redirects Ajax Start Here

            $('#addUrlBtn').on("click", function(e) {
                e.preventDefault();
                $('#add_url_form').addClass('was-validated');
                if ($('#add_url_form')[0].checkValidity() === false) {
                    event.stopPropagation();
                } else {
                    var formData = {
                        redirect_from: $("#redirect_from").val(),
                        redirect_to: $("#redirect_to").val(),
                        redirect_type: $("#redirect_type").val(),
                        subscription_id: $("#subscription_id").val(),
                    };
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('seo.redirectionStore') }}",
                        type: "POST",
                        data: formData,
                        dataType: "json",

                        beforeSend: function() {
                            $('#addUrlBtn').addClass('disabled');
                        },

                        success: function(response) {
                            if(response.status==true)
                            Toaster('success', response.message);
                            else
                            Toaster('error', response.message);
                        },

                        complete: function() {
                            setTimeout(function() {
                                location.reload(true);
                            }, 1000);
                        },
                    });
                }
            });
            // Add Redirects Ajax End Here

            // Edit Redirects Ajax Start

            $(document).on("click", ".editBtn", function(e) {
                e.preventDefault();
                var edit_id = $(this).data('id');
                var subsHtml = `<option selected  value="" >{{ __('seo.select_subscriber') }}</option>`;
                $.ajax({
                    url: "{{ route('seo.redirectionEdit') }}",
                    type: "POST",
                    data:{id:edit_id},
                    success: function(response) {
                        $('.edit_redirect_from').val(response.edit_url.data_list.redirect_from);
                        $('.edit_redirect_to').val(response.edit_url.data_list.redirect_to);
                        $('#edit_redirect_type').val(response.edit_url.data_list.redirect_type);
                     //   $('#subscription_id').val(response.edit_url.data_list.subscription_id);

                
                        $.each(response.edit_url.website_list, function(keys, subs) {
                            subsHtml +=
                                `<option  ${subs.subscription_id ==  response.edit_url.data_list.subscription_id ? 'selected' :''}  value="${subs.subscription_id}">${subs.website_name}</option>`;
                        });

                        $(".subscription").html(subsHtml);
                        $('.edit_id').val(response.edit_url.data_list.id);
                    }
                });
            });
            //  Edit Redirects Ajax End  Here

            // Upadate Redirects Ajax Start Here

            $('#updateUrlBtn').on("click", function(e) {
                e.preventDefault();
                $('#update_url_form').addClass('was-validated');
                if ($('#update_url_form')[0].checkValidity() === false) {
                    event.stopPropagation();
                } else {
                    var formData = {
                        redirect_from: $("#edit_redirect_from").val(),
                        redirect_to: $("#edit_redirect_to").val(),
                        redirect_type: $("#edit_redirect_type").val(),
                        subscription_id: $("#website_name").val(),
                        id: $("#edit_id").val(),
                    };


                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('seo.redirectionUpdate') }}",
                        type: "POST",
                        data: formData,
                        dataType: "json",
                        success: function(response) {
                            if(response.status==true)
                            Toaster('success', response.message);
                            else
                            Toaster('error', response.message);

                            setTimeout(function() {
                                location.reload(true);
                            }, 1000);
                        },
                    });
                }
            });

            // Update Redirects Ajax End Here

            //Delete Redirects Ajax Start Here

            $('.url_delete_btn').on("click", function(e) {
                e.preventDefault();
                var delete_id = $(this).data('id');
                $('#delete_id').val(delete_id);  
            });
            $(document).on("click", ".delete_submit_btn", function(e) {
                e.preventDefault();
                var id = $('#delete_id').val();
              
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('seo.redirectionDelete') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                
                        Toaster('success', response.message);
                      
                        setTimeout(function() {
                            location.reload();
                        }, 1000);

                    }
                });
            });

            //Delete Redirects Ajax End Here

            //Web Change Status Ajax Start Here 
    
             $(document).on('change','.urlToggleBtn',function(){

                let id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('seo.redirectionStatus') }}",
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(response) {
                        Toaster('success', response.message);
                    }
                });
            });

            //Web Change Status Ajax End Here 

            // Website and Search Filter Start Here

            $(document).ready(function() {
            
                $("#search").on('keyup', function(e) {
                    if ((this.value).length >= 3 || (this.value).length == 0) {
                        tableWebContent('', this.value);
                    } 
                });

                $("#website_dropdown").on('change', function(e) {
                    tableWebContent(this.value,'');
                });

            });

            function tableWebContent(website = '', search = '') {
                const url = "{{ route('seo.redirectionFilter') }}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        website: website,
                        search: search,
                    },
                    dataType: "json",
                    success: function(result) {
                        $("#url_listing").html(result.html);
                    }
                });
            }

            // Date and Search Filter End Here

        });

    </script>

@endpush

</x-app-layout>
