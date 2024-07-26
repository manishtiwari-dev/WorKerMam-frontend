@php
    
    $rankingElements = (array) $ranklisting;
    //  @dd($rankingElements);
@endphp

<x-app-layout>
    @section('title', 'General Setting')

    <div class="contact-content">
        <div class="layout-specing">

            <div class="card">
                <form id="save-website-data" method="post">

                    <div class="tab-content">
                        <div class="card-header">
                            <div class="row">
                                <h6 class="tx-15 mg-b-0">{{ $website_listing->website_name }}</h6>
                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        {{-- <form id="save-website-data" method="post"> --}}
                        <div class="table-responsive  ranktable" id="webrank">
                            <table class="table border table_wrapper  ">
                                <thead>
                                    <tr>
                                        <th class="wd-10p">{{ __('common.sl_no') }}</th>
                                        <th class="wd-20p">{{ __('seo.Keywords') }}</th>
                                        <th class="wd-10p">
                                            @if (!empty($web_keyword_listing))
                                                <input  style="min-width:115px;" name="ranking_date" id="datepicker1" type=""
                                                    class="form-control " placeholder="Ranking Date">
                                            @endif
                                        </th>

                                        @if (!empty($rankDate))
                                            @foreach ($rankDate as $key => $dates)
                                                <th class="wd-10p">
                                                    {{ \Carbon\Carbon::parse($dates->ranking_date)->format('d-m-y') }}
                                                </th>
                                            @endforeach
                                        @endif

                                    </tr>
                                </thead>

                                <tbody>  

                                    
                                    @foreach ($web_keyword_listing as $key => $seo_keyword)
                                       
                                        <tr>
                                            <td class="">{{ $key + 1 }}</td>
                                            <td>{{ $seo_keyword->keywords }}</td>
                                            <td class=""  style="min-width:115px;">

                                                <input type="hidden" name="update_id_{{ $seo_keyword->id }}"
                                                    value="{{ $seo_keyword->id ?? '' }}">
                                                <input class="form-control" type="number"
                                                    name="ranking_position_{{ $seo_keyword->id }}" {{-- value="{{$seo_keyword->ranking_info->ranking_position ?? ''}}" --}}
                                                    min="0"
                                                    placeholder="Ranking Position">
                                            </td>


                                            
                                            @if (!empty($rankDate))
                                                @foreach ($rankDate as $key => $dates)
                                                    @php
                                                    $ranking_position ='';
                                                    @endphp
                                                    @if (!empty($seo_keyword->ranking_info))
                                                        @foreach ($seo_keyword->ranking_info as $rankInfoData)
                                                                
                                                                @php
                                                                if (\Carbon\Carbon::parse($rankInfoData->ranking_date)->format('d-m-y') ==  \Carbon\Carbon::parse($dates->ranking_date)->format('d-m-y')){
                                                                    $ranking_position = $rankInfoData->ranking_position;
                                                                } 
                                                                  
                                                                @endphp
                                                            
                                                        @endforeach
                                                    @endif

                                                    @if($ranking_position)
                                                        <td>{{ $ranking_position}} </td>
                                                    @else    
                                                        <td></td>
                                                    @endif
                                                @endforeach
                                            @endif

                                        </tr>
                                    @endforeach
                                    <input type="hidden" name="website_id" value="{{ $website_listing->id }}">
                                </tbody>

                            </table>
                        </div>
                        <div class="mt-3 px-2 ">
                            <div class="col-sm-12 p-0">
                                <input type="button" class="btn btn-primary  save-website-form" form-id=""
                                    value="{{ __('common.update') }}" />

                                <a href="{{ route('seo.workReport') }}" class="btn btn-secondary mx-1">Cancel</a>
                            </div>
                        </div>

                        {{-- </form> --}}
                    </div>

            </div>
            </form>
        </div>
    </div>
    </div>

    @push('scripts')
        <script>
            $('.select2').select2({
                searchInputPlaceholder: 'Select User'
            });


            $(document).ready(function() {
                $('.save-website-form').click(function() {
                    const url = "{{ route('seo.rankingUpdate', $website_listing->id) }}";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url,
                        container: '#save-website-data',
                        type: "POST",
                        data: $('#save-website-data').serialize(),
                        success: function(response) {
                            console.log(response);
                            if (response.success) {
                                toastr.success(response.success);
                            } else {
                                toastr.error(response.error);
                            }
                            location.reload();

                        }
                    })
                });


            });
        </script>
        <script>
            $(function() {
                $('#datepicker1').datepicker({
                    dateFormat: 'dd/mm/yy',
                    onSelect: function() {
                        var selected = $(this).datepicker("getDate");
                    }
                });

            });
        </script>
    @endpush

</x-app-layout>
