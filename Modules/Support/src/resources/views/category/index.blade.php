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
    @section('title', 'Category')

    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
        <div class="card contact-content-body">
            <div class="tab-content">
                <div class="card-header d-flex align-items-center justify-content-between py-2 px-3">
                    <h6 class="tx-15 mg-b-0">Category List</h6>
                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                        <div class="d-flex gap-3">
                            <a href="{{ route('manage-landing.category.create') }}" class="btn btn-md  btn-primary align-items-center "><i
                                    data-feather="plus"></i>Add Category</a>

                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table  table_wrapper rounded px-3">
                            <thead>
                                <tr>
                                    <th class="border-bottom">#</th>
                                    <th class="border-bottom">Category Name</th>
                                    <th class=" border-bottom">Display</th>
                                    <th class="border-bottom">Priority</th>
                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                        <th class="border-bottom">Status</th>
                                        <th class="border-bottom">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($content->categorylist as $key => $category)
                                    <tr>
                                        <td class="">{{ $key + 1 }}</td>
                                        <td class="">{{ $category->category_name }}</td>
                                        <td class="">{{ $category->display }}</td>
                                        <td class="">{{ $category->priority ?? '' }}</td>
                                        <td class="">{{ $category->status == 1 ? 'Active' : 'InActive' }}</td>
                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                            <td class="d-flex ">
                                                <a href="{{ url('manage-landing/category/' . $category->id . '/edit') }}"
                                                    class="btn btn-sm  d-flex align-items-center mg-r-5"><svg
                                                        viewBox="0 0 24 24" width="24" height="24"
                                                        stroke="currentColor" stroke-width="2" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="css-i6dzq1">
                                                        <path
                                                            d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                        </path>
                                                    </svg><span class="d-sm-inline mg-l-5"></span></a>

                                                    <a href="#delete_modal" data-toggle="modal" id="delete_btn"
                                                    data-id="{{ $category->id }}"
                                                    class="btn btn-sm  table_btn py-1 px-2 delete_btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-trash">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                    </svg>
    
                                                    <span class="d-none d-sm-inline mg-l-5"></span>
                                                </a>
    

                                
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <h5 class="text-center mb-0 py-1">No Record Found !.</h5>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!--start delete modal-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel5">Delete Category </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>{{ __('common.delete_confirmation') }}</h6>
                    <input type="hidden" id="deleteExpenseId" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('common.no') }}
                    </button>
                    <button type="submit" class="btn btn-primary expenseDelBtn">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--end delete modal-->

    @push('scripts')
        <script>
            $(document).on("click", "#delete_btn", function() {
                var artical_id = $(this).val();
                $('#deleteExpenseId').val(artical_id);
            });

            //delete modal confirmation data start here
            $(document).on('click', '.expenseDelBtn', function() {
                var category_id = $('#deleteExpenseId').val();
                console.log(category_id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('manage-landing.category-delete') }}",
                    data: {
                        category_id: category_id,
                    },
                    dataType: "json",
                    success: function(response) {
                        Toaster('success', response.success);
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000);
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
