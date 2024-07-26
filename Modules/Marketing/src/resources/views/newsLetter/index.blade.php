<x-app-layout>
    @section('title', $pageTitle)
    <div class="contact-content">
        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
            <div class="card contact-content-body">
                <div class="tab-content">
                    <div id="senderList" class="tab-pane show active">
                        <div class="card-header d-flex align-items-center justify-content-between py-2 px-3">
                            <h6 class="tx-15 mg-b-0">Subscription List</h6>
                            {{-- @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                <a href="#add_server"
                                    class="btn btn-sm btn-primary btn-bg d-flex align-items-center mg-r-5"
                                    data-bs-toggle="modal">
                                    <i data-feather="plus"></i>
                                    <span class=" d-sm-inline mg-l-5">{{ __('sender-list.add_sender') }}</span>
                                </a>
                            @endif --}}
                        </div>
                        <div class="card-body">
                            <div class="form-row">

                                <div class="form-group col-md-3">
                                    <div class="form-icon position-relative">
                                        <input type="text" class="form-control" id="input_search" name="search"
                                            placeholder="search">
                                    </div>
                                </div>
                                <small class="text-danger error_alert"></small>


                            </div>
                            <div class="table-responsive" id="newsletter_details">
                                <table id="example1" class="table table_wrapper">
                                    <thead>
                                        <tr>
                                            <th class="wd-10p">{{ __('common.sl_no') }}</th>
                                            <th class="wd-20p">Date</th>
                                            <th class="wd-25p">Email</th>
                                            <th class="wd-25p">Name</th>
                                            <th class="wd-15p">{{ __('common.status') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @dd($content) --}}
                                        @if (!empty($content->data))
                                            @foreach ($content->data as $key => $list)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($list->created_at)->format('d-M-Y') }}
                                                    </td>
                                                    <td>{{ $list->customer_email }}</td>
                                                    <td>{{ $list->customer_name }}</td>
                                                    <td>
                                                        @switch($list->status)
                                                            @case(0)
                                                                <p>NotSubscribed</p>
                                                            @break

                                                            @case(1)
                                                                <p>Subscribed</p>
                                                            @break

                                                            @case(2)
                                                                <p>UnSubscribed</p>
                                                            @break

                                                            @case(3)
                                                                <p>Blocked</p>
                                                            @break

                                                            @default
                                                                <p>-</p>
                                                        @endswitch
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
                                    'marketing.subscription.index',
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
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



                $('#input_search').on('keyup', function() {
                    if ((this.value).length >= 3 || (this.value).length == 0) {
                        tableContent(this.value);
                    }
                });

            });



            function tableContent(input_search = '') {

                const url = "{{ route('marketing.newsletterFilter') }}";
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
                        $("#newsletter_details").html(result.html);
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
