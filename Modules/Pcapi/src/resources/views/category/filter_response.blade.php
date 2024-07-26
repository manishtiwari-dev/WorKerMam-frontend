<table class="table  table_wrapper allWebsite" id="category_details">
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
        {{-- @dd($content->PCCategory_list) --}}

        @if (!empty($content->PCCategory_list))
            @forelse ($content->PCCategory_list as $key=>$category)

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
                        <div class="custom-control custom-switch">
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
                        <div class="custom-control custom-switch">
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
                            class="btn btn-sm  d-flex align-items-center mg-r-5 px-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                
                                <span
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
                                class="btn btn-sm  d-flex align-items-center px-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                    <span
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
<!--Pagination Start-->
{!! \App\Helper\Helper::make_pagination(
    $content->total_records,
    $content->per_page,
    $content->current_page,
    $content->total_page,
    'papachina-product.pc-categories.index',
) !!}
<!--Pagination End-->