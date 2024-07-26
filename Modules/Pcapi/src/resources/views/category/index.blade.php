<x-app-layout>
    @section('title', $pageTitle)

    <div class="card contact-content-body">
        <div class="tab-content">
            <div id="website" class="tab-pane show active">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">
                            @if (!empty($content->parentData))
                                {{ $content->parentData->categories_name }}
                            @else
                                Category List
                            @endif
                        </h6>
                    </div>
                </div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                {{-- @if (isset($message))
                    <div class="alert alert-success" role="alert">
                        {{$message}}
                    </div>
                @endif --}}

                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-table">
                            {{-- <form action="{{ route('papachina-product.pc-categories.index') }}" method="get"> --}}
                            <div class="form-row">

                                <div class="form-group col-md-3 px-1">
                                    <div class="form-icon position-relative">
                                        <input type="text" class="form-control" id="input_search" name="search"
                                            placeholder="search">
                                    </div>
                                </div>
                                <small class="text-danger error_alert"></small>

                                {{-- <div class="form-group col-md-3 px-1">
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
                                    </div> --}}
                            </div>
                            {{-- </form> --}}

                            <div class="table-responsive " id="category_details">
                                <table class="table  table_wrapper allWebsite" >
                                    <thead>
                                        <tr>
                                            <th class="border-bottom col-sm-1">
                                                {{ __('common.sl_no') }}</th>
                                            <th class="border-bottom col-sm-2">
                                                Category Name</th>
                                            <th class="border-bottom text-center col-sm-1">
                                                Sort Order</th>
                                            <th class="border-bottom text-center col-sm-1">
                                                {{ __('common.featured') }}</th>
                                            <th class="border-bottom text-center col-sm-1">
                                                {{ __('common.status') }}</th>

                                            <th class="border-bottom text-center col-sm-1">
                                                {{ __('common.action') }}</th>

                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                                        @if (!empty($content->PCCategory_list))
                                            @forelse ($content->PCCategory_list as $key=>$category)
                                                {{-- @dd($category->sortOrder) --}}

                                                <tr>
                                                    <td class="text-left ">
                                                        @php
                                                            $data = (int) $key + 1;
                                                            echo "$data";
                                                        @endphp
                                                    </td>
                                                    <td class="text-left ">
                                                        {{-- @dd($category) --}}
                                                        @if (!empty($category->categorydescription))
                                                            {{ $category->categorydescription->categories_name }}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        {{-- @dd($category->sortOrder) --}}
                                                        <input type="number" class="col-xs-1 inputPassword2 width1 text-center"
                                                            data-categories_id="{{ $category->categories_id }}"
                                                            placeholder="" value="{{ $category->sortOrder }}"
                                                            style="width:50px;">
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="custom-control custom-switch ps-0">
                                                            {{-- {{ $category->isFeatured == '1'? 'checked' : '' }} --}}
                                                            <input type="checkbox"
                                                                class="custom-control-input featuretoggle-class"
                                                                data-categories_id="{{ $category->categories_id }}"
                                                                {{ $category->isFeatured == 'Yes' ? 'checked' : '' }}
                                                                data-id="{{ $category->categories_id }}"
                                                                id="customSwitch{{ $category->categories_id }}">
                                                            <label class="custom-control-label"
                                                                for="customSwitch{{ $category->categories_id }}"></label>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="custom-control custom-switch ps-0">
                                                            <input type="checkbox"
                                                                class="custom-control-input toggle-class"
                                                                data-categories_id="{{ $category->categories_id }}"
                                                                {{ $category->isavailable == 'Yes' ? 'checked' : '' }}
                                                                data-id="{{ $category->categories_id }}"
                                                                id="customSwitch1{{ $category->categories_id }}">
                                                            <label class="custom-control-label"
                                                                for="customSwitch1{{ $category->categories_id }}"></label>
                                                        </div>
                                                    </td>

                                                    <td class="align-items-center justify-content-center d-flex gap-2">
                                                        <a href="{{ route('papachina-product.pc-categories.show', $category->categories_id) }}"
                                                            class="btn btn-sm  d-flex align-items-center px-0"><i
                                                                data-feather="eye"></i><span
                                                                class="d-sm-inline mg-l-5"></span></a>
                                                        <a href="{{ route('papachina-product.productShownew', $category->categories_id) }}"
                                                            id="website_delete_btn"
                                                            class="btn btn-sm  d-flex align-items-center px-0">
                                                            <!-- <i data-feather="repeat"></i> -->
                                                            <i class="fa fa-product-hunt"></i>
                                                            <span class="d-none d-sm-inline mg-l-5"></span>
                                                        </a>
                                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                            <a href="{{ route('papachina-product.pc-categories.edit', $category->categories_id) }}"
                                                                id="catEditId"
                                                                class="btn btn-sm  d-flex align-items-center px-0"><i
                                                                    data-feather="edit-2"></i><span
                                                                    class="d-none d-sm-inline mg-l-5 "></span></a>
                                                        @endif
                                                    </td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5">
                                                        <h5 class="text-center my-2">There are no any category</h5>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                @endif

                   <!--Pagination Start-->
            {!! \App\Helper\Helper::make_pagination(
                $content->total_records,
                $content->per_page,
                $content->current_page,
                $content->total_page,
                'papachina-product.pc-categories.index',
            ) !!}
            <!--Pagination End-->
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
                            Toaster("success", data.success);
                        }
                    });
                });

                $('#input_search').on('keyup', function() {
                    if ((this.value).length >= 3 || (this.value).length == 0) {
                        tableContent( this.value);
                    } 
                });

            });

        

            function tableContent(input_search = '') {

                const url = "{{ route('papachina-product.category-filter') }}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                    
                        input_search: input_search,
                    },
                    dataType: "json",
                    success: function(result) {
                        console.log(result);
                        $("#category_details").html(result.html);
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
