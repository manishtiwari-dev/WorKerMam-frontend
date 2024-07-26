<x-app-layout>
    @section('title', 'Sender List')

    <div class="contact-content">
     
        <div class="card contact-content-body">
            <div class="tab-content">
                <div id="senderList" class="tab-pane show active">
                   <div class="card-header d-flex align-items-center justify-content-between py-2 px-3">
                        <h6 class="tx-15 mg-b-0">{{ __('sender-list.sender_list') }}</h6>
                        <a href="#add_server" class="btn btn-sm btn-bg d-flex align-items-center mg-r-5" data-toggle="modal"><i data-feather="plus"></i><span class="d-none d-sm-inline mg-l-5">{{ __('sender-list.add_sender') }}</span></a>
                   </div>
                    <div class="card-body"> 
                        <div class="table-responsive">
                            <table id="example1" class="table border table_wrapper rounded">
                                <thead>
                                    <tr>
                                        <th class="wd-10p">{{ __('common.sl_no') }}</th>
                                        <th class="wd-20p">{{ __('sender-list.sender_name') }}</th>
                                        <th class="wd-25p">{{ __('sender-list.sender_email') }}</th>
                                        <th class="wd-15p">{{ __('common.status') }}</th>
                                        <th class="wd-10p text-center">{{ __('common.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     
                                    @if (!empty($data)) 
                                    @foreach ($data as $key => $sender)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $sender->sender_name }}</td>
                                        <td>{{ $sender->sender_email }}</td>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input senderToggleBtn" {{ $sender->status == '1' ? 'checked' : '' }} data-id="{{$sender->id}}" id="customSwitch{{$sender->id}}">
                                                <label class="custom-control-label" for="customSwitch{{$sender->id}}"></label>
                                            </div>
                                            
                                        </td> 
                                        <td class="d-flex align-items-center">
                                            <a href="#edit_sender" class="btn btn-sm btn-white d-flex align-items-center mg-r-5" data-toggle="modal" data-id="{{$sender->id}}" id="editBtn"><i data-feather="edit-2"></i><span class="d-sm-inline mg-l-5"></span></a>
                                            <a href="#sender_delete_modal" data-toggle="modal" data-id="{{$sender->id}}" class="btn btn-sm btn-white d-flex align-items-center sender_delete_btn"><i data-feather="trash"></i><span class="d-none d-sm-inline mg-l-5"></span></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- <div id="mailServer" class="tab-pane">
                    <div class="card-header d-flex align-items-center justify-content-between py-2 px-3">
                            <h6 class="tx-15 mg-b-0">{{ __('sender-list.server_list') }}</h6>
                            <a href="#add_mail_server" class="btn btn-sm btn-bg d-flex align-items-center mg-r-5" data-toggle="modal"><i data-feather="plus"></i><span class="d-none d-sm-inline mg-l-5">{{ __('sender-list.add_server') }}</span></a>
                        </div>
                        <div class="card-body">
                            <div data-label="Example" class="df-example demo-table">
                                <div class="table-responsive">
                                    <table id="example1" class="table border table_wrapper rounded">
                                        <thead>
                                            <tr>
                                                <th style="min-width:70px;">{{ __('common.sl_no')}}</th>
                                                <th style="min-width: 150px;">{{__('sender-list.name') }}</th>
                                                <th style="min-width: 150px;">{{__('sender-list.driver') }}</th>
                                                <th style="min-width: 150px;">{{__('sender-list.host') }}</th>
                                                <th style="min-width: 150px;">{{__('sender-list.port') }}</th>
                                                <th style="min-width: 100px;">{{__('common.status')}}</th>
                                                <th class="text-center" style="min-width: 150px;">
                                                    {{ __('common.action') }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Server 1</td>
                                                <td>smtp</td>
                                                <td>host</td>
                                                <td>port</td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input website_toggle_class"  data-id="" id="customSwitch">
                                                        <label class="custom-control-label" for="customSwitch"></label>
                                                    </div>
                                                </td>
                                                <td class="d-flex align-items-center">
                                                    <a href="#edit_mail_server" data-toggle="modal" class="btn btn-sm btn-white d-flex align-items-center mg-r-5"><i data-feather="edit-2"></i><span class="d-sm-inline mg-l-5"></span></a>
                                                    <a href="#mail_delete_modal" id="" data-toggle="modal" data-id="" class="btn btn-sm btn-white d-flex align-items-center"><i data-feather="trash"></i><span class="d-none d-sm-inline mg-l-5"></span></a>
                                                </td>
                                            </tr>
                                            @if (!empty($seotask))
                                                @foreach ($seotask as $key => $task)
                                                    <tr>
                                                        <td>{{ ++$key }}</td>
                                                        <td>{{ ucwords($task->task_priority) }}</td>
                                                        <td>{{ ucwords($task->seo_task_title) }}</td>
                                                        <td>{{ ucwords($task->no_of_submission) }}</td>
                                                        <td>
                                                            @if (!empty($task->task_frequency == 1))
                                                            Daily
                                                            @elseif(!empty($task->task_frequency == 2))
                                                            Weekly Once
                                                            @elseif(!empty($task->task_frequency == 3))
                                                            Weekly Twice
                                                            @elseif(!empty($task->task_frequency == 4))
                                                            Weekly Thrice
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input task_toggle_class" {{ $task->status == '1' ? 'checked' : '' }} data-id="{{$task->id}}" id="customSwitch{{$task->id}}">
                                                                <label class="custom-control-label" for="customSwitch{{$task->id}}"></label>
                                                            </div>
                                                        </td>
                                                        <td class="d-flex align-items-center">
                                                        <a href="{{ url('seo-task/' . $task->id . '/edit') }}"
                                                        data-task-id="{{ $task->id }}" class="btn btn-sm btn-white d-flex align-items-center mg-r-5"><i data-feather="edit-2"></i><span class="d-none d-sm-inline mg-l-5"></span></a>
                                                        <a href="#mail_delete_modal" id="task_del_btn" data-id="{{ $task->id }}" data-toggle="modal" class="btn btn-sm btn-white d-flex align-items-center"><i data-feather="trash"></i><span class="d-none d-sm-inline mg-l-5"></span></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- df-example -->
                        </div>
                    </div><!-- tab-pane -->
                </div><!-- tab-content --> --}}
            </div>
        </div>

    <!---  Add Server Modal Start Here ------------->
    <div class="modal fade" id="add_server" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header align-item-center">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('sender-list.add_sender') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addSender_form" class="needs-validation" novalidate>
                        <div class="form-group">
                            <label for="sender_name">{{ __('sender-list.sender_name') }}</label>
                            <input type="text" class="form-control" id="sender_name" name="sender_name" placeholder="{{ __('sender-list.enter_sender_name') }}" required>
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
                            <input type="email" class="form-control" id="sender_email" name="sender_email" placeholder="{{ __('sender-list.enter_sender_email') }}" required>
                            <span style="color:red;">
                                @error('source_name')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('sender-list.sender_email_error') }}
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" id="addSenderBtn">{{ __('common.submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!---  Add Server Modal End Here ------------->
    <!---  Edit Sender List Modal Start Here ------------->
    <div class="modal fade" id="edit_sender" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header align-item-center">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('sender-list.update_sender') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_sender_data" class="needs-validation" novalidate>
                        <input type="hidden" id="editSender_id">
                        <div class="form-group">
                            <label for="sender_name">{{ __('sender-list.sender_name') }}</label>
                            <input type="text" class="form-control sender_name" name="sender_name" placeholder="{{ __('sender-list.enter_sender_name') }}" required>
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
                            <input type="email" class="form-control sender_email" name="sender_email" placeholder="{{ __('sender-list.enter_sender_email') }}" required>
                            <span style="color:red;">
                                @error('source_name')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('sender-list.sender_email_error') }}
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label for="inputAddress2">{{ __('sender-list.server_name') }}</label>
                            <select class="custom-select" name="select_server_name" id="select_server_name">
                                <option selected value="" disabled>{{ __('sender-list.select_server_name') }}</option>
                                <option value="1">One</option>
                                @if (!empty($server_list))
                                    @foreach ($server_list as $server_name)
                                        <option
                                            value="{{ $server_name->id }}">
                                            {{ $server_name->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <span style="color:red;">
                                @error('stutas')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('sender-list.server_name') }}
                            </div>
                        </div> --}}
                        <button type="submit" class="btn btn-primary" id="editSenderBtn">{{ __('common.submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!---  Edit Server Modal End Here ------------->
    <!--Sender delete modal Start-->
    <div class="modal fade effect-scale" id="sender_delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header align-item-center">
                    <h6 class="modal-title">{{ __('sender-list.delete_sender') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="deleteSenderId" name="input_field_id">
                    <p class="mg-b-0">{{ __('common.delete_confirmation') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ __('common.no')}}
                    </button>
                    <button type="button" class="btn btn-primary senderDelBtn">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--Sender delete modal End-->
    <!---- Add Mail Server Modal start Here--->
    <div class="modal fade" id="add_mail_server" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header align-item-center">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('sender-list.add_server') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body m-1">
                    <form id="mailSender_add_form" class="needs-validation" novalidate>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-6">
                                <label for="server_name">{{ __('sender-list.server_name') }}</label>
                                <input type="email" class="form-control" id="server_name" name="server_name" placeholder="{{ __('sender-list.enter_server_name') }}" required>
                                <span style="color:red;">
                                    @error('status_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.server_name_error') }}
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label for="provider_name">{{ __('sender-list.provider_name') }}</label>
                                <input type="password" class="form-control" name="provider_name" id="provider_name" placeholder="{{ __('sender-list.enter_provider_name') }}" required>
                                <span style="color:red;">
                                    @error('status_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.provider_name_error') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-6">
                                <label for="inputEmail4">{{ __('sender-list.driver') }}</label>
                                <select class="form-select form-control" name="driver" id="driver" required>
                                    <option selected disabled value="">
                                        {{ __('sender-list.select_driver') }}
                                    </option>
                                    <option value="smtp">
                                        {{ __('sender-list.smtp') }}
                                    </option>
                                    <option value="send_mail">
                                        {{ __('sender-list.send_mail') }}
                                    </option>
                                </select>
                                <span style="color:red;">
                                    @error('stutas')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.driver_error') }}
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-6" id="hide_username">
                                <label for="username">{{ __('sender-list.username') }}</label>
                                <input type="password" class="form-control" name="username" id="username" placeholder="{{ __('sender-list.enter_username') }}">
                                <span style="color:red;">
                                    @error('status_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.username_message_error') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-row" id="hide_password">
                            <div class="form-group col-md-6 col-6">
                                <label for="add_password">{{ __('sender-list.password') }}</label>
                                <input type="email" class="form-control" name="add_password" id="add_password" placeholder="Email">
                                <span style="color:red;">
                                    @error('status_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.password_message_error') }}
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-6" id="hide_host">
                                <label for="host">{{ __('sender-list.host') }}</label>
                                <input type="email" class="form-control" name="host" id="host" placeholder="{{ __('sender-list.enter_host') }}">
                                <span style="color:red;">
                                    @error('status_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.host_message_error') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-row" id="hide_port">
                            <div class="form-group col-md-6 col-6">
                                <label for="port">{{ __('sender-list.port') }}</label>
                                <input type="password" class="form-control" name="port" id="port" placeholder="{{ __('sender-list.enter_port') }}">
                                <span style="color:red;">
                                    @error('status_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.port_message_error') }}
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-6" id="hide_encryption">
                                <label for="inputEmail4">{{ __('sender-list.encryption_method') }}</label>
                                <select class="form-select form-control" name="encryption" id="encryption">
                                    <option selected disabled value="">
                                        {{ __('sender-list.select_encryption') }}
                                    </option>
                                    <option value="ssl">
                                        {{ __('sender-list.ssl') }}
                                    </option>
                                    <option value="tls">
                                        {{ __('sender-list.tls') }}
                                    </option>
                                </select>
                                <span style="color:red;">
                                    @error('stutas')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.encryption_message_error') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-6">
                                <label for="from_name">{{ __('sender-list.from_name') }}</label>
                                <input type="text" name="from_name" id="from_name" class="form-control" placeholder="{{ __('sender-list.enter_from_name') }}">
                                <span style="color:red;">
                                    @error('status_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.from_name_message_error') }}
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label for="from_email">{{ __('sender-list.from_email') }}</label>
                                <input type="password" class="form-control" name="from_email" id="from_email" placeholder="{{ __('sender-list.enter_from_email') }}">
                                <span style="color:red;">
                                    @error('status_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.from_email_error') }}
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" id="industry_submit">{{ __('common.submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!---- Add Mail Server Modal End Here ----->
    <!---- Edit Mail Server Modal start Here--->
    <div class="modal fade" id="edit_mail_server" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header align-item-center">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('sender-list.add_server') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body m-1">
                    <form id="editMailServerForm" class="needs-validation" novalidate>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-6">
                                <label for="server_name">{{ __('sender-list.server_name') }}</label>
                                <input type="email" class="form-control" id="server_name" name="server_name" placeholder="{{ __('sender-list.enter_server_name') }}" required>
                                <span style="color:red;">
                                    @error('status_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.server_name_error') }}
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label for="provider_name">{{ __('sender-list.provider_name') }}</label>
                                <input type="password" class="form-control" name="provider_name" id="provider_name" placeholder="{{ __('sender-list.enter_provider_name') }}" required>
                                <span style="color:red;">
                                    @error('status_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.provider_name_error') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-6">
                                <label for="inputEmail4">{{ __('sender-list.driver') }}</label>
                                <select class="form-select form-control" name="driver" id="driver" required>
                                    <option selected disabled value="">
                                        {{ __('sender-list.select_driver') }}
                                    </option>
                                    <option value="smtp">
                                        {{ __('sender-list.smtp') }}
                                    </option>
                                    <option value="send_mail">
                                        {{ __('sender-list.send_mail') }}
                                    </option>
                                </select>
                                <span style="color:red;">
                                    @error('stutas')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.driver_error') }}
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-6" id="hide_username">
                                <label for="username">{{ __('sender-list.username') }}</label>
                                <input type="password" class="form-control" name="username" id="username" placeholder="{{ __('sender-list.enter_username') }}">
                                <span style="color:red;">
                                    @error('status_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.username_message_error') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-row" id="hide_password">
                            <div class="form-group col-md-6 col-6">
                                <label for="add_password">{{ __('sender-list.password') }}</label>
                                <input type="email" class="form-control" name="add_password" id="add_password" placeholder="Email">
                                <span style="color:red;">
                                    @error('status_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.password_message_error') }}
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-6" id="hide_host">
                                <label for="host">{{ __('sender-list.host') }}</label>
                                <input type="email" class="form-control" name="host" id="host" placeholder="{{ __('sender-list.enter_host') }}">
                                <span style="color:red;">
                                    @error('status_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.host_message_error') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-row" id="hide_port">
                            <div class="form-group col-md-6 col-6">
                                <label for="port">{{ __('sender-list.port') }}</label>
                                <input type="password" class="form-control" name="port" id="port" placeholder="{{ __('sender-list.enter_port') }}">
                                <span style="color:red;">
                                    @error('status_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.port_message_error') }}
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-6" id="hide_encryption">
                                <label for="inputEmail4">{{ __('sender-list.encryption_method') }}</label>
                                <select class="form-select form-control" name="encryption" id="encryption">
                                    <option selected disabled value="">
                                        {{ __('sender-list.select_encryption') }}
                                    </option>
                                    <option value="ssl">
                                        {{ __('sender-list.ssl') }}
                                    </option>
                                    <option value="tls">
                                        {{ __('sender-list.tls') }}
                                    </option>
                                </select>
                                <span style="color:red;">
                                    @error('stutas')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.encryption_message_error') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-6">
                                <label for="from_name">{{ __('sender-list.from_name') }}</label>
                                <input type="text" name="from_name" id="from_name" class="form-control" placeholder="{{ __('sender-list.enter_from_name') }}">
                                <span style="color:red;">
                                    @error('status_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.from_name_message_error') }}
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-6">
                                <label for="from_email">{{ __('sender-list.from_email') }}</label>
                                <input type="password" class="form-control" name="from_email" id="from_email" placeholder="{{ __('sender-list.enter_from_email') }}">
                                <span style="color:red;">
                                    @error('status_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('sender-list.from_email_error') }}
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" id="MailServerUptBtn">{{ __('common.submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!---- Edit Mail Server Modal End Here ----->
    <!--Sender delete modal Start-->
    <div class="modal fade effect-scale" id="mail_delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header align-item-center">
                    <h6 class="modal-title">{{ __('sender-list.delete_server') }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_department_id" name="input_field_id">
                    <p class="mg-b-0">{{ __('common.delete_confirmation') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ __('common.no')}}
                    </button>
                    <button type="button" class="btn btn-primary deleteMailServerBtn">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--Sender delete modal End-->

@push('scripts')
    <script>
        $(document).ready(function() {
            // Add sender list modal data strat here
            $('#addSenderBtn').on("click", function(e) {
                e.preventDefault();
                $('#addSender_form').addClass('was-validated');
                if ($('#addSender_form')[0].checkValidity() === false) {
                    event.stopPropagation();
                }
                else{
                    var formData = {
                        sender_name: $("#sender_name").val(),
                        sender_email: $("#sender_email").val(),
                    };
                    console.log(formData);

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
                            console.log(response);
                            Toaster(response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 1000); 
                        },
                    });
                }
            }); 

            // Edit sender list modal data start here //
            $(document).on("click", "#editBtn", function(e) {
                e.preventDefault();
                var sender_edit_id = $(this).data('id');
                $.ajax({
                    url: "sender-list/" + sender_edit_id + "/edit",
                    type: "GET",
                    success: function(response) {
                        console.log(response.edit_sender.sender_name);
                        $('.sender_name').val(response.edit_sender.sender_name);
                        $('.sender_email').val(response.edit_sender.sender_email);
                        $('#editSender_id').val(response.edit_sender.id);
                    }
                });
            }); 

            // update sender list modal data strat here
            $('#editSenderBtn').on("click", function(e) {
                e.preventDefault();
                $('#update_sender_data').addClass('was-validated');
                if ($('#update_sender_data')[0].checkValidity() === false) {
                    event.stopPropagation();
                }
                else{
                    var formData = {
                        sender_id : $("#editSender_id").val(),
                        sender_name: $(".sender_name").val(),
                        sender_email: $(".sender_email").val(),
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
                            Toaster(response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 1000); 
                        },
                    });
                }
            });

            //delete id store in modal
            $('.sender_delete_btn').on("click", function(e){
                e.preventDefault(); 
                var delete_id = $(this).data('id'); 
                $('#deleteSenderId').val(delete_id);
            });
            $(document).on("click", ".senderDelBtn", function() {
                var id = $('#deleteSenderId').val(); 
                console.log(id);
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
                        Toaster(response.success);
                        setTimeout(function(){ 
                            location.reload();
                         }, 1000);

                    }
                });
            });

            //sender list change status start here 
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
                    Toaster(response.success);
                    setTimeout(function(){
                        location.reload();
                    } ,1000);
                }
            });
        });













            //delete sender list data modal strat here 
            $(document).on("click", "#editBtn", function(e) {
                e.preventDefault();
                var sender_edit_id = $(this).data('id');
                $.ajax({
                    url: "marketing/sender-list/" + sender_edit_id + "/edit",
                    type: "GET",
                    success: function(response) {
                        console.log(response.edit_sender.sender_name);
                        $('.sender_name').val(response.edit_sender.sender_name);
                        $('.sender_email').val(response.edit_sender.sender_email);
                        $('#editSender_id').val(response.edit_sender.id);
                    }
                });
            });


            $(document).on("click", "#detete_server_id", function() {
                var deleteId = $(this).val();
                $('#deleteId').val(deleteId);
            });
            $(document).on('click', '.deleteMailServerBtn', function() {
                var deleteId = $('#deleteId').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ url('marketing/server-mail') }}/" + deleteId,
                    data: {
                        deleteId: deleteId,
                        _method: 'DELETE'
                    },
                    dataType: "json",
                    success: function(response) {
                        Toaster(response.success);
                        $('#delete_server_modal').modal('hide');
                        $("#server_mail_table").load(location.href + " #server_mail_table");
                        $("#reload_pagination_server").load(location.href +
                            " #reload_pagination_server");
                        $('.flash-message').fadeOut(3000, function() {
                            location.reload(true);
                        });
                    }
                });
            });
        });
    </script>
    <!--end delete ajax-->
    <script>
        $("#driver").on('change', function() {
            var getdriver = $(this).val();
            if (getdriver == "send_mail") {
                $("#hide_encryption").hide();
                $("#hide_username").hide();
                $("#hide_password").hide();
                $("#hide_port").hide();
                $("#hide_host").hide();

            } else {
                $("#hide_encryption").show();
                $("#hide_username").show();
                $("#hide_password").show();
                $("#hide_port").show();
                $("#hide_host").show();
            }
        });
    </script>
    <script>
        $("#edit_driver").on('change', function() {
            var getdriver = $(this).val();
            if (getdriver == "send_mail") {
                $("#edit_hide_encryption").hide();
                $("#edit_hide_username").hide();
                $("#edit_hide_password").hide();
                $("#edit_hide_port").hide();
                $("#edit_hide_host").hide();

            } else {
                $("#edit_hide_encryption").show();
                $("#edit_hide_username").show();
                $("#edit_hide_password").show();
                $("#edit_hide_port").show();
                $("#edit_hide_host").show();
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on("click", "#delete_btn", function() {
                var sender_id = $(this).data('id');
                $('#delete_department_id').val(sender_id);
            });
            $(document).on('click', '.senderDelBtn', function() {
                var sender_id = $('#delete_department_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('marketing/sender-list') }}/" + sender_id,
                    data: {
                        sender_id: sender_id,
                        _method: 'DELETE'
                    },
                    dataType: "json",
                    success: function(response) {
                        Toaster(response.success);
                        $('#delete_modal').modal('hide');
                        $("#sender_data_reload").load(location.href + " #sender_data_reload");
                        $("#sender_data_reload1").load(location.href + " #sender_data_reload1");
                        $('.flash-message').fadeOut(3000, function() {
                            location.reload(true);
                        });
                    }
                });
            });
        });
    </script>
    <!--end delete ajax-->
    <script>
        $(document).ready(function() {
            $("#add_modal").on('click', function(e) {
                e.preventDefault();
            });
        });

        //  modal add closed ajax

        // $(document).on("click", "#source_editmodal", function(e) {
        //     e.preventDefault();
        //     var sender_edit_id = $(this).val();
        //     alert(sender_edit_id);

        //     $.ajax({
        //         // url: "/sender-list/"+sender_edit_id+"/edit",
        //         url:"{{ route('marketing.sender-list.edit',"+sender_edit_id+") }}",
        //         type: "GET",
        //         success: function(response) {
        //             console.log(response);
        //             $('#edit_sender_name').val(response.edit_sender.sender_name);
        //             $('#edit_email').val(response.edit_sender.sender_email);
        //             $('#edit_sender_name_id').val(response.edit_sender.email_server_id);
        //             $('#hidden_id').val(response.edit_sender.id);
        //         }
        //     });
        // });
        //  modal update code start ajax
        // edit modal ajax 

        


        //  modal update code end ajax

        // change status in ajax code start
        $('.toggle-class').change(function() {
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
                    Toaster(response.success);
                }
            });
        });
        // chenge status in ajax code end
    </script> <!-- 1tab source closed -->
    <!--  2tab status ajax open  -->
    <script>
        $(document).ready(function() {
            $("#status_add_modal").on('click', function(e) {
                e.preventDefault();
            });
        });
    </script>
    <script>
        $('#industry_submit').on("click", function(e) {
            e.preventDefault();
            $('#mailSender_add_form').addClass('was-validated');
            if ($('#mailSender_add_form')[0].checkValidity() === false) {
                event.stopPropagation();
            }
            else{
                var formData = {
                    name: $("#server_name").val(),
                    provider: $("#provider_name").val(),
                    driver: $("#driver").val(),
                    host: $("#host").val(),
                    port: $("#port").val(),
                    username: $("#username").val(),
                    encryption: $("#encryption").val(),
                    sendmail: $("#sendmail").val(),
                    password: $("#add_password").val(),
                    from_name: $("#from_name").val(),
                    from_email: $("#from_email").val(),
                    send_mail: $("#send_mail").val(),
                    pretend: $("#pretend").val(),
                    status: $("#status_string").val(),
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('marketing.server-mail.store') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        Toaster(response.success);
                        $('#status_add').modal('hide');
                        $('#add_server_data').trigger('reset');
                        $("#server_mail_table").load(location.href + " #server_mail_table");
                        $("#reload_pagination_server").load(location.href + " #reload_pagination_server");
                        $('.flash-message').fadeOut(3000, function() {
                            location.reload(true);
                        });
                    },
                });
            }
        });
    </script>
    <script>
        // $(document).on("click", "#editBtn", function(e) {
        //     e.preventDefault();
        //     var server_edit_id = $(this).val();
        //     $.ajax({
        //         url: "server-mail/" + server_edit_id + "/edit",
        //         type: "GET",
        //         success: function(response) {
        //             console.log(response.edit_sender);
        //             $('#edit_sender_name').val(response.edit_sender.name);
        //             $('#edit_provider_name').val(response.edit_sender.provider_name);
        //             $('#edit_driver').val(response.edit_sender.driver);
        //             if (response.edit_sender.driver == "send_mail") {
        //                 $("#edit_hide_encryption").hide();
        //                 $("#edit_hide_username").hide();
        //                 $("#edit_hide_password").hide();
        //                 $("#edit_hide_port").hide();
        //                 $("#edit_hide_host").hide();
        //             } else {
        //                 $("#edit_hide_encryption").show();
        //                 $("#edit_hide_username").show();
        //                 $("#edit_hide_password").show();
        //                 $("#edit_hide_port").show();
        //                 $("#edit_hide_host").show();
        //             }
        //             $('#edit_host').val(response.edit_sender.host);
        //             $('#edit_port').val(response.edit_sender.port);
        //             $('#edit_username').val(response.edit_sender.username);
        //             $('#edit_password').val(response.edit_sender.password);
        //             $('#edit_encryption').val(response.edit_sender.encryption);
        //             $('#edit_from_name').val(response.edit_sender.from_name);
        //             $('#edit_from_email').val(response.edit_sender.from_email);
        //             $('#edit_sendmail').val(response.edit_sender.sendmail);
        //             $('#edit_pretend').val(response.edit_sender.pretend);
        //             $('#server_hidden_id').val(response.edit_sender.id);
        //         }
        //     });
        // });
        // modal edit closed ajax

        // modal update code open ajax
        $('#MailServerUptBtn').on("click", function(e) {
            e.preventDefault();
            $('#editMailServerForm').addClass('was-validated');
            if ($('#editMailServerForm')[0].checkValidity() === false) {
                event.stopPropagation();
            }
            var formData = {
                name: $("#edit_sender_name").val(),
                provider: $("#edit_provider_name").val(),
                driver: $("#edit_driver").val(),
                host: $("#edit_host").val(),
                port: $("#edit_port").val(),
                username: $("#edit_username").val(),
                encryption: $("#edit_encryption").val(),
                sendmail: $("#edit_sendmail").val(),
                password: $("#edit_password").val(),
                from_name: $("#edit_from_name").val(),
                from_email: $("#edit_from_email").val(),
                pretend: $("#edit_pretend").val(),
                server_hidden_id: $("#server_hidden_id").val(),
            };
            console.log(formData);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('marketing.server-update') }}",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function(response) {
                    Toaster(response.success);
                    $("#server_mail_table").load(location.href + " #server_mail_table");
                    $("#reload_pagination_server").load(location.href + " #reload_pagination_server");
                    $('#status_edit').modal('hide');
                    $('.flash-message').fadeOut(3000, function() {
                        location.reload(true);
                    });
                },
            });
        });
        //  modal update code end ajax

        // change status in ajax code start
        $('.toggle-classes').change(function() {
            let server_status = $(this).prop('checked') === true ? 1 : 0;
            let server_id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('marketing.server-status') }}",
                data: {
                    server_status: server_status,
                    server_id: server_id
                },
                success: function(response) {
                    Toaster(response.success);
                }
            });
        });
        // chenge status in ajax code end
    </script> 
@endpush
</x-app-layout>
