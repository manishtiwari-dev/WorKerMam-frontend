<x-app-layout>
    @push('scripts')
        <style>
            .mb-20 {
                margin-bottom: 20px
            }
        </style>
    @endpush
    @section('title', $pageTitle)
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">
  
    <div class="row jobs-level">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="icon-badge text-white"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">@lang('modules.dashboard.totalJobs')</span>
                    <span class="info-box-number">{{ number_format($content->totalJobs) }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="icon-badge text-white"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">@lang('modules.dashboard.activeJobs')</span>
                    <span class="info-box-number">{{ number_format($content->activeJobs) }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="icon-badge text-white"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">@lang('modules.dashboard.inactiveJobs')</span>
                    <span class="info-box-number">{{ number_format($content->inactiveJobs) }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="icon-badge text-white"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">@lang('modules.dashboard.totalApplication')</span>
                    <span class="info-box-number">{{ number_format($content->jobApplications) }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="form-group">
                <select name="" id="filter-status" class="form-control">
                    <option value="">@lang('app.filter') @lang('app.status'): @lang('app.viewAll')</option>
                    <option value="active">@lang('app.active')</option>
                    <option value="inactive">@lang('app.inactive')</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <select name="" id="filter-location" class="form-control">
                    <option value="">@lang('app.filter') @lang('menu.locations'): @lang('app.viewAll')</option>
                    @foreach ($content->locations as $location)
                        <option value="{{ $location->id }}">{{ ucwords($location->location) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">{{ __('modules.job') }}</h6>
                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                            <a href="{{ route('recruit.jobs.create') }}"
                                class="btn btn-primary mg-r-5"><i
                                    data-feather="plus"></i><span class="d-none d-sm-inline mg-l-5">
                                    @lang('app.addJob')</span></a>
                        @endif
                    </div>
                </div>
                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                    <div class="card-body">
                        <div class="row clearfix">
                            <div class="col-md-12 mb-20">
                                <a href="{{ route('recruit.questions.index') }}">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="fa fa-plus-circle"></i> @lang('menu.customQuestion')
                                    </button>
                                </a>
                                <a href="{{ route('recruit.jobs.sendEmail') }}">
                                    <button class="btn btn-sm btn-success" type="button">
                                        <i class="fa fa-envelope-o"></i> @lang('menu.sendJobEmails')
                                    </button>
                                </a>

                            </div>
                        </div>

                        <div data-label="Example" class="df-example demo-table">
                            <div class="table-responsive">
                            {{-- <table id="myTable" class="table"> --}}
                            <table id="myTable" class="table table_wrapper">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('modules.jobs.jobTitle')</th>
                                        <th>@lang('menu.locations')</th>
                                        <th>@lang('app.startDate')</th>
                                        <th>@lang('app.endDate')</th>
                                        <th>@lang('app.applicants')</th>
                                        <th>@lang('app.sortOrder')</th>
                                        <th>@lang('app.status')</th>
                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                            <th>@lang('app.action')</th>
                                        @endif
                                    </tr>
                                </thead>
                            </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('Recruit::jobs.refresh')

    @push('scripts')
        <script src="//cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>

        <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

        <script>
            var table = $('#myTable').dataTable({
                responsive: true,
                // processing: true,
                serverSide: true,
                ajax: {
                    'url': '{!! route('recruit.jobs.data') !!}',
                    "data": function(d) {
                        return $.extend({}, d, {
                            "filter_company": $('#filter-company').val(),
                            "filter_status": $('#filter-status').val(),
                            "filter_location": $('#filter-location').val(),
                        });
                    }
                },
                // language: languageOptions(),
                "fnDrawCallback": function(oSettings) {
                    $("body").tooltip({
                        selector: '[data-toggle="tooltip"]'
                    });
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title',
                        width: 30
                    },
                    {
                        data: 'location_id',
                        name: 'location_id'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'end_date',
                        name: 'end_date'
                    },
                    {
                        data: 'applicants',
                        name: 'applicants'
                    },
                    {
                        data: 'sort_order',
                        name: 'sort_order'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                    }
                ]
            });

            new $.fn.dataTable.FixedHeader(table);

            $('#filter-company, #filter-status, #filter-location').change(function() {

                table._fnDraw();
            })

            $('body').on('click', '.open-url', function() {
                var url = $(this).data('row-open-url');
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(url).select();
                document.execCommand("copy");
                $temp.remove();

                $.showToastr('@lang('messages.copiedToClipboard')', 'success')
            });


            $('body').on('click', '.sa-params', function() {
                var id = $(this).data('row-id');
                swal({
                        title: `Are you sure you want to delete this record?`,
                        text: "If you delete this, it will be gone forever.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((isConfirm) => {
                        if (isConfirm) {

                            var url = "{{ route('recruit.jobs.destroy', ':id') }}";
                            url = url.replace(':id', id);

                            var token = "{{ csrf_token() }}";

                            $.ajax({
                                type: 'POST',
                                url: url,
                                data: {
                                    '_token': token,
                                    '_method': 'DELETE'
                                },
                                success: function(response) {
                                    if (response.success) {
                                        Toaster("success", response.success);

                                        setTimeout(function() {
                                            location.reload(true);
                                        }, 3000);
                                        window.location.href =
                                            "{{ route('recruit.jobs.index') }}";

                                    } else {
                                        Toaster("error", response.error);
                                    }
                                }
                            });
                        }
                    });
            });
            //click refresh button  on expire job to refresh job
            $(document).on('click', '.expire_modal', function() {
                var id = $(this).data('row-id');
                var url = "{{ route('recruit.jobs.show', ':id') }}";
                url = url.replace(':id', id);
                var token = "{{ csrf_token() }}";

                $.easyAjax({
                    type: 'POST',
                    url: url,
                    data: {
                        '_token': token,
                        '_method': 'GET'
                    },
                    success: function(response) {
                        var start_date = response.start_date.split("T");
                        var end_date = response.start_date.split("T");
                        $('#date-start').val(start_date[0]);
                        $('#date-end').val(end_date[0]);
                        $('#hidden_id').val(response.id);
                    }
                });

                $('#myModal').modal('show');

            });
        </script>
        <script>
            $(document).ready(function() {
                $('body').on('blur', '.sort_orders', function() {

                    var result_id = $(this).data('id');
                    var sort_order = $(this).val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('recruit.changeSortOrder') }}",
                        data: {
                            result_id: result_id,
                            sort_order: sort_order
                        },
                        dataType: "json",
                        success: function(data) {
                            Toaster('success', data.success);
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
