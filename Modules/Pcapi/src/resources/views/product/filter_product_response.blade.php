    <table class="table  table_wrapper " id="">
        <thead>
            <tr>
                <th class="border-bottom col-sm-1">
                    {{ __('common.sl_no') }}</th>

                   
                <th class="border-bottom col-sm-1">
                    Product Model</th>
                <th class="border-bottom col-sm-2">
                    Product Name</th>
                <th class="border-bottom text-center col-sm-1">
                    Sort Order</th>
                <th class="border-bottom text-center col-sm-1">
                    {{ __('common.status') }}</th>

                <th class="text-center border-bottom col-sm-1">
                    {{ __('common.action') }}
                </th>

            </tr>
        </thead>
        <tbody>
            @forelse ($content->PcProducts_list as $key=>$product)
                <tr>
                  
                    <td>{{$content->current_page * $content->per_page + $key+1 - $content->per_page}}</td>

                    <td class="text-left "> {{ $product->products_model }}</td>
                    <td class="text-left ">
                        @if (!empty($product->productdescription))
                            @php $product_desc = $product->productdescription[0]; @endphp
                            {{ $product_desc->products_name ?? '' }}
                        @endif
                    </td>
                    <td class="text-center">
                        <input type="number" class="col-xs-1 inputPassword2 width1"
                            data-id="{{ $product->products_id }}" placeholder=""
                            value="{{ $product->sortOrder }}" style="width:50px;">
                    </td>
                    <th scope="col" class="text-center">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input toggle-class"
                                {{ $product->isavailable == 'Yes' ? 'checked' : '' }}
                                data-id="{{ $product->products_id }}"
                                id="customSwitch{{ $product->products_id }}">
                            <label class="custom-control-label"
                                for="customSwitch{{ $product->products_id }}"></label>
                        </div>
                    </th>

                    <td class="align-items-center justify-content-center gap-2 d-flex">
                     
                        <a href="{{ route('papachina-product.pc-products.show', $product->products_id) }}"
                            value=""
                            class="btn btn-sm  d-flex align-items-center mg-r-5 px-0">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>

                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                        <a href="{{ route('papachina-product.pc-products.edit', $product->products_id) }}"
                            value=""
                            class="btn btn-sm  d-flex align-items-center mg-r-5 px-0">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        @endif 
                        
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <h5 class="text-center my-2">No Record Found</h5>
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>
    <!--Pagination Start-->
{!! \App\Helper\Helper::make_pagination(
    $content->total_records,
    $content->per_page,
    $content->current_page,
    $content->total_page,
    'papachina-product.pc-products.index',
   
) !!}
<!--Pagination End-->


