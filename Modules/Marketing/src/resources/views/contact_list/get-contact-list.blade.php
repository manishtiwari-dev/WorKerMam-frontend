<x-app-layout>
    @section('title', 'Contact')

   {{-- @dd($data_list); --}}
    <div class="container-fluid">
        <div class="layout-specing tab_table">
            <!-- Tabs content -->
            <div class="tab-content" id="ex1-content">
                <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                    <div class="table-responsive shadow rounded" id="website_table">
                        <div class=" border-0 quotation_form">
                            <div class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0" id="">@if(!empty($data_list->group_details)){{$data_list->group_details->group_name}}@endif</h5>

                                <div>
                                    <a href="{{ route('marketing.contact-list.index') }}">
                                        <button class="btn btn-primary ">{{__('common.goback')}}</button></a>
                                </div>
                            </div>
                        </div>
                        @if(!empty($data_list))
                        <table class="table table-center bg-white mb-0">
                            <thead>
                                <tr>
                                    <th class="border-bottom p-3">{{ __('common.sl_no') }}</th>
                                    <th class="border-bottom p-3" style="min-width: 220px;">{{ __('sender-list.contact_name') }}</th>                                    
                                    <th class="border-bottom p-3" style="min-width: 220px;">{{ __('sender-list.contact_email') }}</th>
                                    
                                    <th class="text-center border-bottom p-3">{{ __('common.status') }}</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Start -->
                                @if (!empty($data_list->contact_details))
                                @foreach ($data_list as $key => $contact)
                                <tr>
                                    <th class="p-3">{{$key+1}}</th>                                   
                                    <td class="p-3">@if(!empty($contact->ContactList->contact_name)){{$contact->ContactList->contact_name}}@endif</td>
                                    <td class="p-3">@if(!empty($contact->ContactList->contact_email)){{$contact->ContactList->contact_email}}@endif</td>

                                    <td>
                                        <div class="form-check form-switch mx-auto pl-0 ps-5">
                                          <input id="loader" data-id="{{ $contact->id }}" class="form-check-input mx-auto toggle_class" type="checkbox" data-bs-toggle="toggle" data-on="Active" data-off="InActive" {{ $contact->status ? 'checked' : '' }}>
                                         </div>
                                    </td>
                                    
                                </tr>
                                @endforeach
                                @endif                              
                                <!-- End -->

                            </tbody>
                        </table>
                        @else
                        <div class="s-b-n-header my-4" id="website_listing">
                            <h4 class="text-center">No Record Found !. </h4>
                        </div>
                        @endif
                    </div>

                    <!-- {{-- <div class="row text-center px-2 md-4 mb-4 " id="website_table1">
                        <!-- PAGINATION START -->
                        <div class="col-12 mt-4">
                            <div class="d-md-flex align-items-center text-center justify-content-between">
                                <span class="text-muted me-3">Showing {{$web_setting->currentPage();}} -
                                    {{$web_setting->lastItem();}} out of {{$web_setting->total()}}</span>
                                <ul class="pagination mb-0 justify-content-center mt-4 mt-sm-0">
                                    {{ $web_setting->links() }}
                                </ul>
                            </div>
                        </div>
                        <!-- PAGINATION END --> --}} -->
                    </div>
                    <!--end row-->
                </div>
                <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                    <div class="table-responsive shadow rounded " id="seo-task-table">
                        <div class=" border-0 quotation_form">
                            <div
                                class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('seo.task_list') }}</h5>
                                <div>
                                    {{-- <a href="{{ route('seo-task.create') }}" class="btn-primary">
                                        <i class="fa fa-plus"></i> {{ __('seo.add_task') }}
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                        <table class="table table-center bg-white mb-0">
                            <thead>
                                <tr>
                                    <th class="border-bottom p-3">{{ __('common.sl_no') }}</th>
                                    <th class="border-bottom p-3">{{ __('seo.task_priority') }}</th>
                                    <th class="border-bottom p-3" style="min-width: 220px;">{{ __('seo.task_title') }}
                                    </th>
                                    <th class="border-bottom p-3" style="min-width: 220px;">
                                        {{ __('seo.no_of_submission') }}</th>
                                    <th class="text-center border-bottom p-3">{{ __('seo.task_frequency') }}</th>
                                    <th class="text-center border-bottom p-3">{{ __('common.status') }}</th>
                                    <th class="text-center border-bottom p-3">{{ __('common.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Start -->
                                @if (!empty($seotask))
                                @foreach ($seotask as $key => $task)
                                <tr>
                                    <th class="p-3">{{ ++$key }}</th>
                                    <td class="p-3">{{ ucwords($task->task_priority) }}</td>
                                    <td class="p-3">{{ ucwords($task->seo_task_title) }}</td>
                                    <td class="p-3">{{ ucwords($task->no_of_submission) }}</td>
                                    <td class="text-center p-3">
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
                                    <td class="text-center p-3"><i
                                            class="{{ $task->status == '1' ? 'badge bg-primary' : 'badge bg-danger' }}">
                                            {{ $task->status == '1' ? 'Active' : 'Inactive' }}</i></td>
                                    <td class="text-cente d-flex  p-3">
                                        <a href="{{ url('seo-task/' . $task->id . '/edit') }}"
                                            data-task-id="{{ $task->id }}"
                                            class="btn btn-primary btn-xs btn-icon table_btn planLoginbtn"><i
                                                class="uil uil-edit"></i></a>
                                        <button type="button" id="task_id" value="{{ $task->id }}"
                                            class="btn btn-danger btn-xs btn-icon"><i
                                                class="uil uil-trash-alt"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                <!-- End -->

                            </tbody>
                        </table>
                    </div>


                </div>
                <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                    <div class="table-responsive shadow rounded " id="store_status_id">
                        <div class=" border-0 quotation_form">
                            <div
                                class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('seo.result_list') }}</h5>
                                <div>
                                    <!-- <a href="{{ route('seo-result.index') }}" class="btn-primary">
                                        <i class="fa fa-plus"></i> {{ __('seo.add_title') }}
                                    </a> -->
                                    <button data-bs-toggle="modal" data-bs-target="#add_title_modal"
                                        class=" btn-md btn-primary" id="add_result_title"><i data-feather="plus"
                                            class="lead_icon mg-r-5"></i>Add Result Title</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-center bg-white mb-0">
                            <thead>
                                <tr>
                                    <th class="border-bottom p-3">{{ __('seo.title') }}</th>
                                    <th class="border-bottom p-3">{{ __('seo.sub_title') }}</th>
                                    <th class="border-bottom p-3">{{ __('common.status') }}</th>
                                    <th class="text-center border-bottom p-3">{{ __('common.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Start -->
                                @if (!empty($seoresult))
                                @foreach ($seoresult as $key => $result)
                                <tr>
                                    <td class="p-3">{{ ucwords($result->title_name) }}</td>
                                    <td></td>
                                    <td class="p-3"><i
                                            class="{{ $result->status == '1' ? 'badge bg-primary' : 'badge bg-danger' }}">
                                            {{ $result->status == '1' ? 'Active' : 'Inactive' }}</i></td>
                                    <td class="text-cente d-flex  p-3">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#edit_title_modal" data-id="{{$result->id}}"
                                            class="btn btn-primary btn-xs btn-icon table_btn edit_btn"><i
                                                class="uil uil-edit"></i></a>
                                        <button type="button" id="parent_delete_id" value="{{ $result->id }}"
                                            class="btn btn-danger btn-xs btn-icon delete_result_id"><i
                                                class="uil uil-trash-alt"></i></button>
                                    </td>

                                </tr>
                                @foreach ($result->child as $key => $child)
                                <tr>
                                    <td class="p-3"></td>
                                    <td class="p-3">{{ ucwords($child->title_name) }}</td>
                                    <td class="p-3"><i
                                            class="{{ $child->status == '1' ? 'badge bg-primary' : 'badge bg-danger' }}">
                                            {{ $child->status == '1' ? 'Active' : 'Inactive' }}</i></td>
                                    <td class="text-cente d-flex p-3">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#edit_title_modal" data-id="{{$child->id}}"
                                            class="btn btn-primary btn-xs btn-icon table_btn edit_btn"><i
                                                class="uil uil-edit planLoginbtn"></i></a>
                                        <button type="button" id="delete_child" value="{{ $child->id }}"
                                            class="btn btn-danger btn-xs btn-icon delete_result_id"><i
                                                class="uil uil-trash-alt "></i></button>
                                    </td>

                                </tr>
                                @endforeach
                                @endforeach
                                @endif
                                <!-- End -->

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Tabs content -->
        </div>
   
    @push('scripts')
    <script type="text/javascript">
        // change status in ajax code start
            $('.toggle_class').change(function(e) {
                e.preventDefault();
                let status = $(this).prop('checked') === true ? 1 : 0;
                let id = $(this).data('id');
       
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{route('marketing.ChangeContactToGroupStatus')}}",
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(data) {
                        // $("#template_list_data_reload").load(location.href + " #template_list_data_reload");
                        // location.reload();
                        Toaster('Contact To Group Status Changed ');
                    }
                });
            });
    
        // chenge status in ajax code end  
        </script>
    @endpush

</x-app-layout>