@php
    $indexurl = Request::segment(1);
    $role = App\Helper\Helper::role_slug();
    $api_token = request()->cookie('api_token');
    
    $userdata = Cache::get('userdata-' . $api_token);

     $country=  (array)$content->websiteCountryList;
    //  dd($country);
@endphp
<style>
    .pull-left button {
        float: right;
        margin: 1rem 0 0.6rem;
    }

    .btns {
        margin: 0 10px !important;
    }

    .table_btn {
        margin: 0 4px;
    }
</style>
<x-app-layout>
@section('title', $pageTitle)

    @push('scripts')
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    @endpush
    
    <div class="card">
        <div class="tab-content">
            <div class="card-header quotation_form">
                <h6 class="tx-15 mg-b-0">{{ __('seo.daily_work') }}</h6>
            </div>
            
            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table  table_wrapper" id="table">
                        <thead>
                            <tr>
                                <th class="">{{ __('common.sl_no') }}</th>

                                <th class="" style="min-width: 150px;"> {{ __('seo.website_url') }}</th>
                                <th class="" style="min-width: 80px;">{{ __('seo.country') }}</th>
                                <th class="text-center" style="min-width: 150px;">{{ __('seo.start_date') }}</th>
                                <th class="text-center">{{ __('common.status') }}</th>
                                <th class="text-center">{{ __('common.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Start -->

                            @if ($userdata->role == 'super_admin' || $userdata->role == 'seomanager')
                            @if (!empty($content->website_listing))
                                @foreach ($content->website_listing as $key => $web)
                                    <tr>
                                        <td class="px-3">{{ $key + 1 }}</td>

                                        <td class="px-3"><a href="https://{{ $web->website_url }}"
                                                target="_blank">{{ $web->website_url }}</a></td>
                                        <td class="px-3">
                                            @foreach ($web->parentName as $data)
                                                {{ $data->countries_name }}
                                            @endforeach
                                        </td>
                                        <td class="px-3 text-center ">{{ date('d M , Y', strtotime($web->start_date ?? '')) }}</td>
                                        <td class="px-0">
                                            <div class="form-check form-switch">
                                                <div class="custom-control custom-switch">
                                                    <span class="badge  {{ $web->status == 1 ? 'text-bg-success' : 'text-bg-danger' }}">{{ $web->status == 1 ? 'Active' : 'Deactive' }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                        <td class="align-items-center justify-content-center gap-2 d-flex">
                                            <div class="d-flex align-items-center px-3">
                                                <a href="{{ url('seo/daily-work/' . $web->id . '/edit') }}"
                                                    class="btn btn-sm btn-bg d-flex align-items-center mg-r-5   table_btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                               @else

                               @if (!empty($content->website_listing))
                               @foreach ($content->website_listing as $key => $web)
                                   <tr>
                                    {{-- @dd($country['1'][0]->countries_name) --}}

                                       <td class="px-3">{{ $key + 1 }}</td>

                                       <td class="px-3"><a href="https://{{ $web[0]->website_url }}"
                                               target="_blank">{{ $web[0]->website_url }}</a></td>
                                       <td class="px-3">
                                        @if(!empty($country[$web[0]->id]))
                                               {{ $country[$web[0]->id][0]->countries_name }}
                                           @endif
                                       </td>

                                       <td class="px-3 text-center ">{{ $web[0]->start_date }}</td>
                                       <td class="px-0">
                                           <div class="form-check form-switch">
                                               <div class="custom-control custom-switch">


                                                   <span
                                                       class="badge badge-pill {{ $web[0]->status == 1 ? 'badge-success' : 'badge-danger' }}">{{ $web[0]->status == 1 ? 'Active' : 'Deactive' }}</span>
                                               </div>
                                           </div>
                                       </td>
                                       @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                       <td>
                                           <div class="d-flex align-items-center px-3">
                                               <a href="{{ url('seo/daily-work/' . $web[0]->id . '/edit') }}"
                                                   class="btn btn-sm btn-bg d-flex align-items-center mg-r-5   table_btn">{{ __('common.update') }}</a>
                                           </div>
                                       </td>
                                       @endif
                                   </tr>
                               @endforeach
                           @endif
                               @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            //  website status ajax start
            $('.toggle-class').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let website_id = $(this).data('id');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('seo.dailyWorkStatus') }}",
                    data: {
                        'status': status,
                        'website_id': website_id
                    },
                    success: function(response) {

                        Toaster(response.work_report);
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
