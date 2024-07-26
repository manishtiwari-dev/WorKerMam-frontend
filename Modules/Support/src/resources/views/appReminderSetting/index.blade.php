<x-app-layout>
    @section('title', $pageTitle)

    {{-- @if (!empty($content->data->id))
 {{ session()->put('temlategroup',$content->data->id)}}
@endif --}}
    <!--index table start-->
    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
        <div class="card contact-content-body">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    {{-- @if (!empty($content->data->group_name))
                <h6 class="tx-15 mg-b-0">{{$content->templategroup->group_name}}</h6>
            @else
                <h6 class="tx-15 mg-b-0">{{__('newsletter.template_list')}}</h6>
            @endif --}}
                    <h6 class="tx-15 mg-b-0">App Reminder Setting</h6>

                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                        <a href="{{ route('manage-landing.app-reminder.create') }}" class="btn btn-sm btn-bg"><i
                                data-feather="plus"></i>Add Reminder</a>
                    @endif
                </div>
            </div>
            <div class="card-body">

                <!--Filter Start-->
                <div class="row align-item-center mb-3 order-list-wrapper">
                    <div class="col-lg-5">
                    <div class="form-icon position-relative d-flex mb-2 mb-lg-0 mb-md-0">
                        <p class="mb-0 d-md-flex d-lg-flex d-none d-md-block d-lg-block text-dark-grey align-items-center mr-3 ">
                            {{ __('seo.date') }}
                        </p>
                        <input type="text" id="datatableRange" name="datatableRange" class="form-control"
                            placeholder="{{ __('common.daterange_placeholder') }}" />
                    </div>
                </div>

                    <div class="col-lg-5 mb-2 mb-lg-0 mb-md-0">
                        <input type="text" id="search" value="{{ $search ?? '' }}"
                            class="form-control fas fa-search" placeholder="Search..." aria-label="Search"
                            name="search">
                    </div>
                    <div class="col-lg-2 d-flex">
                        <div class="align-items-center ">
                            <a class="btn btn-primary px-5" href="{{ route('manage-landing.app-reminder.index') }}"
                                role="button">{{ __('common.reset') }}</a>
                        </div>
                    </div>
                </div>
                <!--Filter End-->

                <div class="table-responsive" id="emailtemplate_listing">
                    <table class="table border table_wrapper" id="template_list_data_reload">
                        <thead>
                            <tr>
                                <th>{{ __('common.sl_no') }}</th>
                                <th>Source</th>
                                <th>{{ __('newsletter.subject') }}</th>
                                <th>{{ __('common.status') }}</th>
                                <th class="text-center wd-10p">{{ __('common.action') }}</th>
                            </tr>
                        </thead>
                        <tbody id="Search_Tr">
                            @if (!empty($content->data))
                                @foreach ($content->data as $key => $remindData)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td> {{ $remindData->source == '1' ? 'Subscription' : 'Payment/Invoice' }}</td>
                                        <td>{{ $remindData->subject ?? '' }}</td>
                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input toggle-class"
                                                    {{ $remindData->status == '1' ? 'checked' : '' }}
                                                    data-id="{{ $remindData->id }}"
                                                    id="customSwitch{{ $remindData->id }}">
                                                <label class="custom-control-label"
                                                    for="customSwitch{{ $remindData->id }}"></label>
                                            </div>
                                        </td>
                                        <td class="d-flex align-items-center">

                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                                <a href="{{ route('manage-landing.app-reminder.edit', $remindData->id) }}"
                                                    class="btn btn-sm btn-white d-flex align-items-center mg-r-5"><i
                                                        data-feather="edit-2"></i></a>
                                            @endif

                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'remove') == 'true')
                                                <button data-id="{{ $remindData->id }}" data-toggle="modal"
                                                    data-target="#delete_modal"
                                                    class="btn btn-sm btn-white d-flex align-items-center mg-r-5 del_button"><i
                                                        data-feather="trash"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">
                                        <h5 class="text-center mb-0 py-1">No Record Found !</h5>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    {{-- <!--Pagination Start-->
              {!! \App\Helper\Helper::make_pagination($content->total_records,$content->per_page,$content->current_page,$content->total_page,'manage-landing.app-reminder.index', ) !!}
              <!--Pagination End--> --}}

                </div>
            </div>
        </div>
    @endif

    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel5">Delete App Reminder</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>{{ __('settings.deleted_data') }}</h6>
                    <input type="hidden" id="delete_id" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('common.no') }}
                    </button>
                    <button type="submit" class="btn btn-primary deleteBtn">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>

        <script>
            // start jquery
            $(document).ready(function() {
                $("#Search").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#Search_Tr tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });

                $(document).ready(function() {
                    setTimeout(function() {

                        $("div.alert").remove();
                    }, 3000);
                });

                $(document).ready(function() {
                    $("#addbutton").on('click', function(e) {
                        e.preventDefault();
                        $("#open_modal").modal('show');
                    });
                });
            });

            // change status in ajax code start
            $('.toggle-class').change(function(e) {
                e.preventDefault();
                let status = $(this).prop('checked') === true ? 1 : 0;
                let id = $(this).data('id');
                console.log(id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('manage-landing/app-reminder-status') }}",
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(data) {
                        // $("#template_list_data_reload").load(location.href + " #template_list_data_reload");
                        Toaster('success', data.success);
                    }
                });
            });

            // chenge status in ajax code end  
            $(document).ready(function() {
                $('.del_button').on('click', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    $('#delete_id').val(id);
                });

                $(document).on("click", ".deleteBtn", function() {
                    var id = $('#delete_id').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('manage-landing/app-reminder-delete') }}",
                        data: {
                            id: id,
                        },
                        dataType: "json",
                        success: function(response) {
                            Toaster('success', 'App Reminder Deleted Successfully!');
                            setTimeout(function() {
                                location.reload(true);
                            }, 1500);
                            try {
                                ClassicEditor.delete(document.querySelector('.del_button'))
                                    .catch(error => {
                                        console.error(error);
                                    });
                            } catch (err) {

                            }
                        },
                    });
                });
            });
            // end delete modal ajax


              // Ajax Date Filter

              $(function() {
                // tableWebContent();
                var start = moment();
                var end = moment();

                function cb(start, end) {
                    $('#datatableRange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }

                $('#datatableRange').daterangepicker({
                    autoUpdateInput: false, 
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last 6 Month': [moment().subtract(6, 'month'), moment()],
                        'Last Year': [moment().subtract(1, 'year'), moment()]
                    },
                    locale: {
                        format: 'YYYY-MM-D'
                    }
                }, cb);

                cb(start, end);
            });

            $(document).ready(function() {

                $('input[name="datatableRange"]').on('apply.daterangepicker', function(ev, picker) {
                   $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                   ajaxSubmitData();
                });

                $("#search").on('keyup', function(e) {
                    tableWebContent('', '', this.value);
                });

            });

            function ajaxSubmitData() {
                var dateRangePicker = $('#datatableRange').data('daterangepicker');
                var startDate = $('#datatableRange').val();

                if (startDate == '') {
                    startDate = null;
                    endDate = null;
                } else {
                    startDate = dateRangePicker.startDate.format('YYYY-MM-DD');
                    endDate = dateRangePicker.endDate.format('YYYY-MM-DD');
                }

                if (startDate != '' && endDate != '')
                    $("#order_listing").html('');

                $("#order_listing").html('');
                tableWebContent(startDate, endDate);
            }


            function tableWebContent(startDate = '', endDate = '', search = '') {

                const url = "{{ route('manage-landing.ReminderFilter') }}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        start_date: startDate,
                        end_date: endDate,
                        search: search,
                    },
                    dataType: "json",
                    success: function(result) {
                        $("#emailtemplate_listing").html(result.html);
                    }
                });
            }


        </script>
    @endpush
</x-app-layout>
