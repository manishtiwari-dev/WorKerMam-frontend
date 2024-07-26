<x-app-layout>
    @section('title', $pageTitle)

    <div class="card contact-content-body">
        <div class="tab-content">
            <div id="website" class="tab-pane show active">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">
                            @if (!empty($content->sheetList->sheet_name))
                                {{ $content->sheetList->sheet_name }}
                            @else
                                Sub Sheet  List                          
                            @endif
                        </h6>
                    </div>
                </div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
             
                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-table">

                            {{-- <form action="{{ route('papachina-product.pc-categories.index') }}" method="get">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <div class="form-icon d-flex position-relative">
                                            @if (!empty($parentData))
                                                <input type="hidden" name="parentId"
                                                    value="{{ $parentData->categories_id }}">
                                            @endif
                                            <input type="search" name="search" id="searchbar" class="form-control"
                                                placeholder="Search Here">
                                            <button class="btn" id="searchBtn" type="submit"><i
                                                    data-feather="search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form> --}}
                            <table class="table border table_wrapper allWebsite" id="website_listing">
                                <thead>
                                    <tr>
                                        <th class="border-bottom col-sm-1">
                                            {{ __('common.sl_no') }}</th>
                                        <th class="border-bottom col-sm-1">
                                            Sub Sheet </th>
                                      
                                        {{-- <th class="border-bottom text-center col-sm-1">
                                            {{ __('common.status') }}</th> --}}

                                        <th class="border-bottom text-center col-sm-1">
                                            {{ __('common.action') }}</th>

                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($content->childList))
                                        @forelse ($content->childList as $key=>$child)
                                            <tr>
                                                <td class="text-left ">
                                                    {{ $key + 1 }}
                                                </td>
                                                <td class="text-left ">
                                                    {{$child->sheet_name}}
                                                </td>
                                                
                                               
                                               
                                               

                                                <td class="align-items-center justify-content-center d-flex gap-2">
                                                    <a href="{{ route('excel.elementValues', $child->id) }}"
                                                        id="website_delete_btn"
                                                        class="btn btn-sm btn-white d-flex align-items-center">
                                                        <i
                                                        data-feather="eye"></i>
                                                        <span class="d-none d-sm-inline mg-l-5"></span>
                                                    </a>


                                                        <span class="d-none d-sm-inline mg-l-5"></span>
                                                    </a>
                                                    
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                    <h5 class="text-center my-2">No Record Found  </h5>
                                                </td>
                                            </tr>
                                        @endforelse
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
                <div>
                    <div class="col-12 my-3">
                        {{-- <div class="d-md-flex align-items-center text-center justify-content-between">
                            <span class="text-muted me-3">Showing {{$current_page}} - {{$total_page}} out of {{$total_records}}</span> 
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script type="text/javascript">
            $('.toggle-class').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let categories_id = $(this).data('categories_id');
                console.log(status)
                console.log(categories_id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('papachina-product/changeStatus') }}",
                    data: {
                        'status': status,
                        'categories_id': categories_id
                    },
                    success: function(response) {
                        Toaster("success", response.success);
                    }
                });
            });
        </script>

        <script type="text/javascript">
            $('.featuretoggle-class').change(function() {
                let is_featured = $(this).prop('checked') === true ? 1 : 0;
                let categories_id = $(this).data('categories_id');
                console.log(is_featured)
                console.log(categories_id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('papachina-product/isFeatureStatus') }}",
                    data: {
                        'is_featured': is_featured,
                        'categories_id': categories_id
                    },
                    success: function(response) {
                        Toaster("success", response.success);
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function() {

                // category sort order update
                $(".inputPassword2").on("blur", function(e) {
                    e.preventDefault();
                    var categories_id = $(this).data('categories_id');
                    var sort_order = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('papachina-product.pcCategrySortOrder') }}",
                        data: {
                            categories_id: categories_id,
                            sort_order: sort_order
                        },
                        dataType: "json",
                        success: function(data) {
                            Toaster("success", response.success);
                        }
                    });
                });

            });
        </script>
    @endpush
</x-app-layout>
