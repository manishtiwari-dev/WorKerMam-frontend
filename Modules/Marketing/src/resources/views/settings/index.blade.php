<x-app-layout>
    @section('title', $pageTitle)
    <div class="contact-content">
        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
            <div class="card contact-content-body">
                <div class="tab-content">
                    <div id="senderList" class="tab-pane show active">
                        <div class="card-header d-flex align-items-center justify-content-between py-2 px-3">
                            <h6 class="tx-15 mg-b-0">{{ __('sender-list.sender_list') }}</h6>
                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                <a href="#add_server" class="btn btn-sm btn-primary btn-bg d-flex align-items-center mg-r-5" data-bs-toggle="modal">
                                    <i data-feather="plus"></i>
                                    <span class=" d-sm-inline mg-l-5">{{ __('sender-list.add_sender') }}</span>
                                </a>
                            @endif
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive" id="sender_listing">
                                <table id="example1" class="table table_wrapper">
                                    <thead>
                                        <tr>
                                            <th class="wd-10p">{{ __('common.sl_no') }}</th>
                                            <th class="wd-20p">{{ __('sender-list.sender_name') }}</th>
                                            <th class="wd-25p">{{ __('sender-list.sender_email') }}</th>
                                            <th class="wd-20p">{{ __('sender-list.reply_name') }}</th>
                                            <th class="wd-25p">{{ __('sender-list.reply_email') }}</th>
                                            <th class="wd-15p">{{ __('common.status') }}</th>
                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                            <th class="wd-10p text-center">{{ __('common.action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if (!empty($content->data))
                                            @foreach ($content->data as $key => $sender)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $sender->sender_name }}</td>
                                                    <td>{{ $sender->sender_email }}</td>
                                                    <td>{{ $sender->reply_name ?? ''}}</td>
                                                    <td>{{ $sender->reply_email ?? ''}}</td>
                                                    <td>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox"
                                                                class="custom-control-input senderToggleBtn"
                                                                {{ $sender->status == '1' ? 'checked' : '' }}
                                                                data-id="{{ $sender->id }}"
                                                                id="customSwitch{{ $sender->id }}">
                                                            <label class="custom-control-label"
                                                                for="customSwitch{{ $sender->id }}"></label>
                                                        </div>
                                                    </td>
                                                    <td class="align-items-center justify-content-center d-flex gap-2">
                                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                                            <a href="#edit_sender"
                                                                class="btn btn-sm  d-flex align-items-center px-0 mg-r-5 editBtn"
                                                                data-bs-toggle="modal" data-id="{{ $sender->id }}"><i
                                                                    data-feather="edit-2"></i><span
                                                                    class="d-sm-inline mg-l-5"></span></a>
                                                        @endif
                                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'remove') == 'true')
                                                            <a href="#sender_delete_modal" data-bs-toggle="modal"
                                                                data-id="{{ $sender->id }}"
                                                                class="btn btn-sm px-0 d-flex align-items-center sender_delete_btn"><i
                                                                    data-feather="trash"></i><span
                                                                    class="d-none d-sm-inline mg-l-5"></span></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else

                                        <tr>
                                            <td colspan="8">
                                                <h5 class="text-center mb-0 py-1">{{ __('common.no_record') }}</h5>
                                            </td>
                                        </tr>

                                        @endif
                                    </tbody>
                                </table>

                                <!--Pagination Start-->
                                {!! \App\Helper\Helper::make_pagination(
                                    $content->total_records,
                                    $content->per_page,
                                    $content->current_page,
                                    $content->total_page,
                                    'marketing.sender-list.index',
                                    ['start_date'=>$content->start_date,'end_date'=>$content->end_date]
                                ) !!}
                                <!--Pagination End-->

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endif

        <!---  Add Server Modal Start Here ------------->
        <div class="modal fade" id="add_server" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content tx-14">
                    <div class="modal-header align-item-center py-2">
                        <h4 class="modal-title" id="exampleModalLabel">{{ __('sender-list.add_sender') }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addSender_form" class="needs-validation" novalidate>
                            <div class="form-group">
                                <label for="sender_name">{{ __('sender-list.sender_name') }}</label>
                                <input type="text" class="form-control" id="sender_name" name="sender_name"
                                    placeholder="{{ __('sender-list.enter_sender_name') }}" required>
                                <span style="color:red;">
                                    @error('source_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.sender_name_error') }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sender_email">{{ __('sender-list.sender_email') }}</label>
                                <input type="email" class="form-control" id="sender_email" name="sender_email"
                                    placeholder="{{ __('sender-list.enter_sender_email') }}" required>
                                <span style="color:red;">
                                    @error('source_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.sender_email_error') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="reply_name">{{ __('sender-list.reply_name') }}</label>
                                <input type="text" class="form-control" id="reply_name" name="reply_name"
                                    placeholder="{{ __('sender-list.enter_reply_name') }}" required>
                                <span style="color:red;">
                                    @error('reply_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.reply_name_error') }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reply_email">{{ __('sender-list.reply_email') }}</label>
                                <input type="email" class="form-control" id="reply_email" name="reply_email"
                                    placeholder="{{ __('sender-list.enter_reply_email') }}" required>
                                <span style="color:red;">
                                    @error('reply_email')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.reply_email_error') }}
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary"
                                id="addSenderBtn">{{ __('common.submit') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!---  Add Server Modal End Here ------------->


        <!---  Edit Sender List Modal Start Here ------------->
        <div class="modal fade" id="edit_sender" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content tx-14">
                    <div class="modal-header align-item-center">
                        <h6 class="modal-title" id="exampleModalLabel">{{ __('sender-list.update_sender') }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="update_sender_data" class="needs-validation" novalidate>
                            <input type="hidden" id="editSender_id">
                            <div class="form-group">
                                <label for="sender_name">{{ __('sender-list.sender_name') }}</label>
                                <input type="text" class="form-control sender_name" name="sender_name"
                                    placeholder="{{ __('sender-list.enter_sender_name') }}" required>
                                <span style="color:red;">
                                    @error('source_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.sender_name_error') }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sender_email">{{ __('sender-list.sender_email') }}</label>
                                <input type="email" class="form-control sender_email" name="sender_email"
                                    placeholder="{{ __('sender-list.enter_sender_email') }}" required>
                                <span style="color:red;">
                                    @error('source_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.sender_email_error') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="reply_name">{{ __('sender-list.reply_name') }}</label>
                                <input type="text" class="form-control reply_name" name="reply_name"
                                    placeholder="{{ __('sender-list.enter_reply_name') }}" required>
                                <span style="color:red;">
                                    @error('reply_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.reply_name_error') }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reply_email">{{ __('sender-list.reply_email') }}</label>
                                <input type="email" class="form-control reply_email" name="reply_email"
                                    placeholder="{{ __('sender-list.enter_reply_email') }}" required>
                                <span style="color:red;">
                                    @error('reply_email')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.reply_email_error') }}
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary"
                                id="updateSenderBtn">{{ __('common.submit') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!---  Edit Server Modal End Here ------------->

        <!--Sender delete modal Start-->
        <div class="modal fade effect-scale" id="sender_delete_modal" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header align-item-center">
                        <h6 class="modal-title">{{ __('sender-list.delete_sender') }}</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="deleteSenderId" name="input_field_id">
                        <p class="mg-b-0">{{ __('common.delete_confirmation') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('common.no') }}
                        </button>
                        <button type="button" class="btn btn-primary senderDelBtn">{{ __('common.yes') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Sender delete modal End-->
   </div>
        @push('scripts')


            <script>
                $(document).ready(function() {
                    // Add sender Ajax Start Here


                    $('#addSenderBtn').on("click", function(e) {
                        e.preventDefault();
                        $('#addSender_form').addClass('was-validated');
                        if ($('#addSender_form')[0].checkValidity() === false) {
                            event.stopPropagation();
                        } else {

                            $('#addSenderBtn').attr('disabled','true');
                            var formData = {
                                sender_name: $("#sender_name").val(),
                                sender_email: $("#sender_email").val(),
                                reply_name: $("#reply_name").val(),
                                reply_email: $("#reply_email").val(),
                            };
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url: "{{ url('marketing/sender-add') }}",
                                type: "POST",
                                data: formData,
                                dataType: "json",
                                success: function(response) {
                                    Toaster('success', response.success);
                                    setTimeout(function() {
                                        location.reload(true);
                                    }, 1000);
                                },
                            });
                        }
                    });
                    // Add sender Ajax End Here

                    // Edit Sender Ajax Start

                    $(document).on("click", ".editBtn", function(e) {
                        e.preventDefault();
                        var sender_edit_id = $(this).data('id');
                        $.ajax({
                            url: "sender-list/" + sender_edit_id + "/edit",
                            type: "GET",
                            success: function(response) {
                                console.log(response.edit_sender.sender_name);
                                $('.sender_name').val(response.edit_sender.sender_name);
                                $('.sender_email').val(response.edit_sender.sender_email);
                                $('.reply_name').val(response.edit_sender.reply_name);
                                $('.reply_email').val(response.edit_sender.reply_email);
                                $('#editSender_id').val(response.edit_sender.id);
                            }
                        });
                    });
                    //  Edit Sender Ajax End  Here

                    // Upadate Sender Ajax Start Here

                    $('#updateSenderBtn').on("click", function(e) {
                        e.preventDefault();
                        $('#update_sender_data').addClass('was-validated');
                        if ($('#update_sender_data')[0].checkValidity() === false) {
                            event.stopPropagation();
                        } else {
                            $('#updateSenderBtn').attr('disabled','true');
                            var formData = {
                                sender_id: $("#editSender_id").val(),
                                sender_name: $(".sender_name").val(),
                                sender_email: $(".sender_email").val(),
                                reply_name: $(".reply_name").val(),
                                reply_email: $(".reply_email").val(),
                            };

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url: "{{ url('marketing/sender-update') }}",
                                type: "POST",
                                data: formData,
                                dataType: "json",
                                success: function(response) {
                                    Toaster('success', response.success);
                                    setTimeout(function() {
                                        location.reload(true);
                                    }, 1000);
                                },
                            });
                        }
                    });

                    // Update Sender Ajax End Here

                    //Delete Sender Ajax Start Here

                    $('.sender_delete_btn').on("click", function(e) {
                        e.preventDefault();
                        var delete_id = $(this).data('id');
                        $('#deleteSenderId').val(delete_id);
                    });
                    $(document).on("click", ".senderDelBtn", function() {
                        var id = $('#deleteSenderId').val();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: "POST",
                            url: "{{ url('marketing/sender-delete') }}",
                            data: {
                                id: id
                            },
                            dataType: "json",
                            success: function(response) {
                                Toaster('success', response.success);
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);

                            }
                        });
                    });

                    //Delete Sender Ajax End Here


                    //Sender List Change Status Ajax Start Here 
                    $('.senderToggleBtn').change(function() {
                        let status = $(this).prop('checked') === true ? 1 : 0;
                        let sender_id = $(this).data('id');
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "{{ route('marketing.sender-status') }}",
                            data: {
                                status: status,
                                sender_id: sender_id
                            },
                            success: function(response) {
                                Toaster('success', response.success);
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            }
                        });
                    });

                    //Sender List Change Status Ajax End Here 
                });
            </script>
        @endpush
</x-app-layout>
