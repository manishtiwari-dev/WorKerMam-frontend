<style>
    @media (min-width: 992px) {
        .job_application .modal-dialog {
            max-width: 800px;
        }
    }
</style>
<x-app-layout>

    @section('title', 'Job Onboard')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">{{ __('modules.jobOnboard') }}</h6>

                    </div>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <div class="form-icon position-relative">
                                <a href="{{ route('recruit.job-onboard-questions.index') }}">
                                    <button class="btn btn-sm btn-primary" type="button">
                                        <i class="fa fa-plus-circle"></i> @lang('menu.customQuestion')
                                    </button>
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="table-responsive m-t-40 data_table_wrapper">
                        <table id="myTable" class="table  table_wrapper">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>@lang('modules.jobApplication.applicantName')</th>
                                    <th>@lang('menu.jobs')</th>
                                    <th>@lang('menu.locations')</th>
                                    <th>@lang('app.joinDate')</th>
                                    <th>@lang('app.acceptLastDate')</th>
                                    <th>@lang('app.status')</th>
                                    <th>@lang('app.action')</th>
                                </tr>
                            </thead>
                            <tbody> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('menu.cancelReason')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="save-cancel-reason" method="post">
                    <div class="col-xs-12 col-md-12 ">
                        <div class="form-group ml-3">
                            <label class="required">@lang('app.remark')</label><br>
                            <textarea type="text" id="cancel_reason" class="form-control rounded-0" name="cancel_reason" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary save-cancel-reason">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!--start delete modal-->
    <div class="modal fade job_application" id="job_application" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">@lang('menu.jobApplications')</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body job-application-details">

                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('asset/js/moment.js') }}" type="text/javascript"></script>
        <script src="{{ asset('asset/js/icheck.min.js') }}"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />

        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

        <!-- Load DataTables FixedHeader extension -->
        <script src="https://cdn.datatables.net/fixedheader/3.4.0/js/dataTables.fixedHeader.min.js"></script>
        <script>
            var table;
            tableLoad('load');

            function tableLoad() {
                table = $('#myTable').dataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    stateSave: true,
                    ajax: '{!! route('recruit.job-onboard.data') !!}',
                    // language: languageOptions(),
                    "fnDrawCallback": function(oSettings) {
                        $("body").tooltip({
                            selector: '[data-toggle="tooltip"]'
                        });
                    },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'full_name',
                            name: 'job_applications.full_name',
                            width: '17%'
                        },
                        {
                            data: 'title',
                            name: 'jobs.title',
                            width: '17%'
                        },
                        {
                            data: 'location',
                            name: 'job_locations.location'
                        },
                        {
                            data: 'joining_date',
                            name: 'joining_date'
                        },
                        {
                            data: 'accept_last_date',
                            name: 'accept_last_date'
                        },
                        {
                            data: 'hired_status',
                            name: 'hired_status'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            width: '15%',
                            searchable: false
                        }
                    ]
                });
                // new $.fn.dataTable.FixedHeader(table);
            }

            $('body').on('click', '.send-offer', function() {
                var id = $(this).data('row-id');
                swal({
                        title: "@lang('errors.areYouSure')",
                        type: "warning",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((isConfirm) => {
                        if (isConfirm) {

                            var url = "{{ route('recruit.job-onboard.send-offer', ':id') }}";
                            url = url.replace(':id', id);

                            var token = "{{ csrf_token() }}";

                            $.ajax({
                                type: 'GET',
                                url: url,
                                container: '#myTable',
                                success: function(response) { 
                                    if (response.success) {
                                        Toaster("success", response.success);
                                        $.unblockUI();
                                        table._fnDraw();
                                    } else {
                                        Toaster("error", response.error);
                                    }
                                }
                            });
                        }
                    });
            });

            // Change status in cancel
            $('body').on('click', '.sa-params', function() {
                $('#exampleModal').modal('show');
                var id = $(this).data('row-id');
                $("#save-cancel-reason").on("submit", function(e) {
                    e.preventDefault();
                    var formData = $(this).serialize();
                    var url = "{{ route('recruit.job-onboard.update-status', ':id') }}";
                    url = url.replace(':id', id);
                    var token = "{{ csrf_token() }}";
                    $.ajax({
                        type: 'GET',
                        url: url,
                        data: formData,
                        container: '#save-cancel-reason',
                        success: function(response) {
                            Toaster("success", response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);
                            if (response.status == "success") {
                                Toaster("success", response.success);
                                $.unblockUI();
                                table._fnDraw();
                            }
                            $('#exampleModal').modal('hide');

                        }
                    });
                });
            });

            table.on('click', '.show-detail', function() {
                $('#job_application').modal('show');

                var id = $(this).data('row-id');
                var url = "{{ route('recruit.job-applications.show', ':id') }}";
                url = url.replace(':id', id);

                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(response) {
                        if (response.status == "success") {
                            $('.job-application-details').html(response.view);
                        }
                    }
                });
            });
        </script>
    @endpush

</x-app-layout>
