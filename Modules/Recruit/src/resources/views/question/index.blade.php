<x-app-layout>
@section('title', $pageTitle)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">{{ __('modules.question') }}</h6>
                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                        <a href="{{ route('recruit.questions.create') }}"
                            class="btn btn-sm btn-bg btn btn-primary"><i data-feather="plus"></i><span
                                class="d-none d-sm-inline mg-l-5"> @lang('modules.addQuestion')</span></a>
                        @endif
                    </div>
                </div>
                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                <div class="card-body">
                    <div class="table-responsive mt-2">
                        <table id="myTable" class="table  table_wrapper ">
                            <thead>
                                <tr>
                                    <th style="width:25px;">#</th>
                                    <th style="width:25px;">@lang('app.question')</th>
                                    <th style="width:25px;">@lang('app.required')</th>
                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                    <th style="width:25px;">@lang('app.action')</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($content->questions))
                                    @foreach ($content->questions as $key => $question)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $question->question }}</td>
                                            <td>{{ $question->required }}</td>
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                            <td class="d-flex justify-content-center">
                                                <a href="{{ url('recruit/questions/' . $question->id . '/edit') }}"
                                                    class="btn btn-sm btn-white d-flex align-items-center mg-r-5"><svg
                                                        viewBox="0 0 24 24" width="24" height="24"
                                                        stroke="currentColor" stroke-width="2" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="css-i6dzq1">
                                                        <path
                                                            d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                        </path>
                                                    </svg><span class="d-sm-inline mg-l-5"></span></a>

                                                <a href="javascript:void(0)" id="delete_btn_question" data-id="{{ $question->id }}"
                                                    value="" data-bs-dismiss="modal" data-bs-toggle="modal"
                                                    class="btn btn-sm btn-white d-flex align-items-center"><svg
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
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>


    <!--start delete modal-->
    <div class="modal fade effect-scale" id="delete_modal_question" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('seo.delete_submission') }}</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_question_id" name="input_field_id">
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

    @push('scripts')
        <script>
            $(document).ready(function() {

                $(document).on("click", "#delete_btn_question", function(event) {
                    event.preventDefault();
                    var question_id = $(this).attr("data-id");

                    $('#delete_question_id').val(question_id);
                    $('#delete_modal_question').modal('show');
                });

                $(document).on('click', '.delete_submit_btn', function() {
                    var question_id = $('#delete_question_id').val()
 

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST", 
                        url: "{{ url('recruit/questions') }}/" + question_id,
                        data: {
                            question_id: question_id,
                            _method: 'DELETE'
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                Toaster(response.success);

                                setTimeout(function() {
                                    location.reload(true);
                                }, 3000);
                                window.location.href =
                                    "{{ route('recruit.questions.index') }}";

                            } else {
                                Toaster(response.error);
                            }
                        }
                    });

                });
            });
        </script>
    @endpush

</x-app-layout>
