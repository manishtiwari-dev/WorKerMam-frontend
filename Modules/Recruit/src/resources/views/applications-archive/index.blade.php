<x-app-layout>
    @push('scripts')
        <style>
            [type="checkbox"]:not(:checked),
            [type="checkbox"]:checked {
                position: absolute;
                left: auto !important;
            }

            .ml {
                margin-left: 503px;
            }

            @media (min-width: 992px) {
                .job_application .modal-dialog {
                    max-width: 800px;
                }
            }
        </style>
        <link rel="stylesheet" href="//cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    @endpush

    @section('title', 'Candidate Database')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row clearfix">
                        <div class="col-md-12 mb-4 d-md-flex justify-content-between">
                            <div id="search-container" class="d-flex w-50">
                                <input id="skill" class="form-control mr-2" type="text" name="skill"
                                    placeholder="@lang('modules.applicationArchive.enterSkill')">
                                <a href="javascript:;" class="d-none">
                                    <i class="fa fa-times-circle-o"></i>
                                </a>
                            </div>
                            
                            <div class="d-flex gap-2 mt-2">
                                <button type="button" class="btn btn-primary deleteButton"
                                    id="deleteAllSelectedRecords">delete</button>

                                <a class="pull-right" onclick="exportJobApplication()">
                                    <button class="btn  btn-primary" type="button">
                                        <i class="fa fa-upload"></i> @lang('menu.export')
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped ">
                            <thead>

                                <tr>
                                    <th>
                                        <input type="checkbox" id="chkCheckAll" style="position: initial;">
                                    </th>
                                    <th>@lang('modules.jobApplication.applicantName')</th>
                                    <th>@lang('menu.jobs')</th>
                                    <th>@lang('menu.locations')</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
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
        
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Load DataTables FixedHeader extension -->
    <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
        <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

        <script>
            var table;
            loadTable();

            function redrawTable() {
                table._fnDraw();
            }

            function loadTable() {
                table = $('#myTable').dataTable({
                    responsive: true,
                    // processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax: {
                        url: "{!! route('recruit.candidate-database.data') !!}",
                        data: function(d) {
                            return $.extend({}, d, {
                                skill: $('#skill').val()
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
                            data: 'select_orders',
                            name: 'select_orders',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'full_name',
                            name: 'full_name', 
                        },
                        {
                            data: 'title',
                            name: 'title', 
                        },
                        {
                            data: 'location',
                            name: 'location', 
                        },
                    ]
                });
                new $.fn.dataTable.FixedHeader(table);
            }
            $(function(e) {
                $("#deleteAllSelectedRecords").hide();

                $('#chkCheckAll').click(function() {
                    var checkboxes = $('input[name="check[]"]').length;
                    $('.checkBoxClass').prop('checked', $(this).prop('checked'));
                    if (checkboxes > 0 && this.checked) {
                        $("#deleteAllSelectedRecords").show();
                    } else {
                        $("#deleteAllSelectedRecords").hide();
                    }
                });
                $('#deleteAllSelectedRecords').click(function(e) {
                    e.preventDefault();

                    var rowdIds = $("#myTable input:checkbox:checked").map(function() {
                        return $(this).val();
                    }).get();
                    swal({
                            title: `Are you sure you want to delete this record?`,
                            text: "If you delete this, it will be gone forever.",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((isConfirm) => {
                            if (isConfirm) {
                                var url =
                                    "{{ route('recruit.candidate-database.deleteRecords', ':rowdIds') }}";
                                url = url.replace(':rowdIds', rowdIds);

                                var token = "{{ csrf_token() }}";
                                $.ajax({
                                    type: 'POST',
                                    url: url,
                                    data: {
                                        '_token': token
                                    },
                                    success: function(response) {
                                        if (response.status == "success") {
                                            Toaster('success', 'Record Successfully Deleted.')
                                            table._fnDraw();
                                        }
                                    }
                                });
                            }
                        });
                });
            });

            $(function(e) {
                var counterChecked = 0;
                $('body').on('change', 'input[name="check[]"]', function() {
                    this.checked ? counterChecked++ : counterChecked--;
                    counterChecked > 0 ? $('#deleteAllSelectedRecords').show() : $('#deleteAllSelectedRecords')
                        .hide();

                });
            });

            function exportJobApplication() {
                var skillVal = $('#skill').val();

                if (skillVal == '') {
                    skillVal = undefined
                }

                var url = "{{ route('recruit.candidate-database.export', ':skill') }}";
                url = url.replace(':skill', skillVal);

                window.location.href = url;
            }

            // search($('#skill'), 500, 'table');

            table.on('click', '.show-detail', function() {
                $('#job_application').modal('show');

                var id = $(this).data('row-id');
                var url = "{{ route('recruit.candidate-database.show', ':id') }}";
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
