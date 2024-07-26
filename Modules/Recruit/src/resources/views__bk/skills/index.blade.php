<x-app-layout>
    @push('head-script')
        <link rel="stylesheet" href="//cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    @endpush
    @section('title', $pageTitle)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">{{ __('modules.skills') }}</h6>
                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                            <a href="{{ route('recruit.skills.create') }}"
                                class="btn btn-sm btn-primary d-flex align-items-center mg-r-5"><i
                                    data-feather="plus"></i><span class="d-none d-sm-inline mg-l-5">
                                    @lang('modules.addSkills')</span></a>
                        @endif
                    </div>
                </div>
                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                    <div class="card-body">
                        <div class="table-responsive m-t-40">
                            <table id="myTable" class="table  table_wrapper ">
                                <thead>
                                    <tr>
                                        <th style="width:25%;">#</th>
                                        <th style="width:25%;">@lang('app.name')</th>
                                        <th style="width:25%;">@lang('menu.jobCategories')</th>
                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                            <th style="width:25%;" class="text-center">@lang('app.action')</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody> 
                                        @forelse($content->skills as $key => $skill)
                                            <tr>
                                                <td style="width:25%;">{{ $key + 1 }}</td>
                                                <td style="width:25%;">{{ $skill->name }}</td>
                                                <td style="width:25%;">
                                                    @if (!empty($skill->category))
                                                        {{ $skill->category->name }}
                                                    @endif
                                                </td>
                                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                                    <td class="d-flex justify-content-center gap-2">
                                                        <a href="{{ url('recruit/skills/' . $skill->id . '/edit') }}"
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
                                                    <a href="" id="delete_btn" data-id="{{ $skill->id }}"
                                                        value="" data-toggle="modal"
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
                @endif
            </div>
        </div>
    </div>

    <!--start delete modal-->
    <div class="modal fade effect-scale" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('seo.delete_submission') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_skill_id" name="input_field_id">
                    <p class="mg-b-0">{{ __('common.delete_confirmation') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
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
                    var skill_id = $(this).attr("data-id");

                    $('#delete_skill_id').val(skill_id);
                    $('#delete_modal').modal('show');
                });

                $(document).on('click', '.delete_submit_btn', function() {
                    var skill_id = $('#delete_skill_id').val()

                    $('#delete_modal').modal('show');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: "{{ url('recruit/skills') }}/" + skill_id,
                        data: {
                            skill_id: skill_id,
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
                                    "{{ route('recruit.skills.index') }}";

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