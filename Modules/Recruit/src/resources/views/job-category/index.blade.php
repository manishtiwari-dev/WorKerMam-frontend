 <x-app-layout>
     @section('title', $pageTitle)
     <div class="row">
         @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
             <div class="col-12">
                 <div class="card">
                     <div class="card-header">
                         <div class="d-flex align-items-center justify-content-between ">
                             <h6 class="tx-15 mg-b-0">{{ __('modules.joblist') }}</h6>
                             @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                 <a href="{{ route('recruit.job-categories.create') }}"
                                     class="btn btn-sm btn-primary d-flex align-items-center mg-r-5"><i
                                         data-feather="plus"></i><span class="d-none d-sm-inline mg-l-5">
                                         @lang('modules.addJobCategory')</span></a>
                             @endif
                         </div>
                     </div>

                     <div class="card-body">
                         <div class="table-responsive m-t-40">
                             <table id="myTable" class="table  table_wrapper ">
                                 <thead>
                                     <tr>
                                         <th style="width:30%;">#</th>
                                         <th style="width:30%;">@lang('app.name')</th>
                                         @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                             <th style="width:40%;" class="text-center">@lang('app.action')</th>
                                         @endif
                                     </tr>
                                 </thead>
                                 <tbody> 
                                         @forelse($content->job_category as $key => $category)
                                             <tr>
                                                 <td>{{ $key + 1 }}</td>
                                                 <td>{{ $category->name }}</td>
                                                 @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                                     <td class="d-flex justify-content-center gap-2">
                                                         <a href="{{ url('recruit/job-categories/' . $category->id . '/edit') }}"
                                                             class="btn btn-sm px-0"><svg
                                                                 viewBox="0 0 24 24" width="24" height="24"
                                                                 stroke="currentColor" stroke-width="2" fill="none"
                                                                 stroke-linecap="round" stroke-linejoin="round"
                                                                 class="css-i6dzq1">
                                                                 <path
                                                                     d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                                 </path>
                                                             </svg><span class="d-sm-inline mg-l-5"></span></a>
                                                 @endif

                                                 @if (\App\Helper\Helper::CheckPermission($pageAccess, 'remove') == 'true')
                                                     <a href="javascript:void(0)" id="delete_btn" data-id="{{ $category->id }}"
                                                         value="" data-bs-dismiss="modal" data-bs-toggle="modal"
                                                         class="btn btn-sm px-0"><svg
                                                             viewBox="0 0 24 24" width="24" height="24"
                                                             stroke="currentColor" stroke-width="2" fill="none"
                                                             stroke-linecap="round" stroke-linejoin="round"
                                                             class="css-i6dzq1">
                                                             <polyline points="3 6 5 6 21 6"></polyline>
                                                             <path
                                                                 d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                             </path>
                                                         </svg><span class="d-none d-sm-inline mg-l-5"></span></a>
                                                     </td>
                                                 @endif
                                             </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5">
                                                <h5 class="text-center mb-0 py-1">No Record Found !</h4>
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
     </div>
     <!--start delete modal-->
     <div class="modal fade effect-scale" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h6 class="modal-title">{{ __('seo.delete_submission') }}</h6>
                     <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <input type="hidden" id="delete_job_category_id" name="input_field_id">
                     <p class="mg-b-0">{{ __('common.delete_confirmation') }}</p>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                         {{ __('common.no') }}
                     </button>
                     <button type="button" class="btn btn-primary delete_submit_btn"
                         id="">{{ __('common.yes') }}</button>
                 </div>
             </div>
         </div>
     </div>

     <!--End delete modal-->
     @push('scripts')
         <script>
             $(document).ready(function() {

                 $(document).on("click", "#delete_btn", function() {
                     var category_id = $(this).attr("data-id");

                     $('#delete_job_category_id').val(category_id);
                     $('#delete_modal').modal('show');
                 });

                 $(document).on('click', '.delete_submit_btn', function() {
                     var category_id = $('#delete_job_category_id').val()

                     $('#delete_modal').modal('show');

                     $.ajaxSetup({
                         headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         }
                     });

                     $.ajax({
                         type: "POST",
                         // url: "{{ url('departmentDestroy') }}/" + department_id,
                         url: "{{ url('recruit/job-categories') }}/" + category_id,
                         data: {
                             category_id: category_id,
                             _method: 'DELETE'
                         },
                         dataType: "json",
                         success: function(response) {
                             if (response.success) {
                                 Toaster("success", response.success);

                                 setTimeout(function() {
                                     location.reload(true);
                                 }, 3000);
                                 window.location.href =
                                     "{{ route('recruit.job-categories.index') }}";

                             } else {
                                 Toaster("error", response.error);
                             }
                         }
                     });

                 });
             });
         </script>
     @endpush
 </x-app-layout>
