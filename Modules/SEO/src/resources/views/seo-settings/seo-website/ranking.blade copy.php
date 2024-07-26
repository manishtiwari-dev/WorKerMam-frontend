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
                                <div class="form-group">
                                    <h6 class="tx-15 mg-b-0">{{ $website_listing->website_name }}</h6>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        {{-- <form id="save-website-data" method="post"> --}}

                        <div class="table-responsive" id="department">
                            <table class="table border table_wrapper">
                                <thead>
                                    <tr>
                                        <th class="wd-10p">{{ __('common.sl_no') }}</th>
                                        <th class="wd-20p">{{ __('seo.Keywords') }}</th>
                                        <th class="wd-10p">
                                            @if (!empty($web_keyword_listing))
                                                <input name="ranking_date" id="datepicker1" type=""
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

                                    @php
                                        $k = 1;
                                    @endphp

                                    @foreach ($web_keyword_listing as $key => $seo_keyword)
                                    {{-- @dd($seo_keyword) --}}

                                 
                    
                                        <tr>
                                            <td class="">{{ $key + 1 }}</td>
                                            <td>{{ $seo_keyword->keywords }}</td>
                                            <td class="">

                                                <input type="hidden" name="update_id_{{ $seo_keyword->id }}"
                                                    value="{{ $seo_keyword->id ?? '' }}">
                                                <input class="form-control" type="number"
                                                    name="ranking_position_{{ $seo_keyword->id }}"
                                                    {{-- value="{{$seo_keyword->ranking_info->ranking_position ?? ''}}" --}}
                                                    placeholder="Ranking Position"
                                                    >
                                             </td>
                                           
                                           
                                             {{-- @dd($rankDate) --}}

                                            @foreach ($rankDate as $key => $dates)
                                            @if (!empty($rankingElements))
                                                @foreach ($rankingElements as $keys => $values)
                                                    @foreach ($values as $k => $val)
                                                       
                                                        @if (($k == $dates->ranking_date) && ($keys== $seo_keyword->id) ) 
                                                            <td>  {{ $val ?? '' }}</td>
                                                        @else
                                                        <td>  </td>
                                                        @endif
                                                      
                                                    @endforeach

                                                @endforeach
                                            @endif

                                            @endforeach
    

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
