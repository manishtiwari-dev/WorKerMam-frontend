<style>
    .hide-box {
        display: none;
    }
</style>
<div class="modal-header">
    <h4 class="modal-title"><i class="icon-plus"></i> @lang('user-manager.tax-group')</h4>
    <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
</div>
<div class="modal-body">


    {{-- <hr> --}}
    <form id="createdepartment" class="ajax-form" method="post">
        {{ csrf_field() }}
        <div class="form-body">
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="form-group">
                        <label>@lang('user-manager.tax-group-name')</label>
                        <input type="text" name="tax_group_name" id="tax_name" class="form-control">
                        <input type="hidden" name="edit_id" id="edit_id">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" id="save-department" class="btn btn-primary">
                Submit</button>
            <button type="button" id="update-department" class="btn btn-primary hide-box">
                @lang('app.update')</button>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
        <script>
            // Select 2 init.
            $(".select2").select2({
                formatNoMatches: function() {
                    return "{{ __('messages.noRecordFound') }}";
                }
            });

            // Save tax group
            $('#save-department').click(function() {

                $.ajax({
                    url: '{{ route('system-setting.tax-group.store') }}',
                    container: '#createdepartment',
                    type: "POST",
                    data: $('#createdepartment').serialize(),
                    success: function(response) {
                        console.log(response.status);
                        Toaster("success", response.success);
                        setTimeout(function() {
                            location.reload(true);
                        }, 3000);
                        window.location.href =
                            "{{ route('system-setting.tax-setting') }}";

                        $('#job_type').empty();
                        var options = [];
                        var rData = [];
                        rData = response.data;
                        $.each(rData, function(index, value) {
                            var selectData = '';
                            selectData = '<option value="' + value.tax_group_id + '">' + value
                                .tax_group_name +
                                '</option>';
                            options.push(selectData);
                        });
                        $('#job_type').html(options);
                        // $('#job_type').select2();
                        $('#addDepartmentModal').modal('hide');
                    }

                })
            })

            // Update tax group
            $('#update-department').click(function() {

                var id = $('#edit_id').val();
                var url = "{{ route('system-setting.tax-group.update', ':id') }}";
                url = url.replace(':id', id);
                var token = '{{ csrf_token() }}';
                var name = $('#tax_name').val();


                $.ajax({
                    url: url,
                    container: '#createdepartment',
                    type: "POST",
                    data: {
                        '_token': token,
                        '_method': 'PUT',
                        'tax_group_name': name
                    },
                    success: function(response) {
                        var options = [];
                        var rData = [];
                        rData = response.data;
                        console.log(rData);
                        $.each(rData, function(index, value) {
                            var selectData = '';
                            selectData = '<option value="' + value.tax_group_id + '">' + value
                                .tax_group_name +
                                '</option>';
                            options.push(selectData);
                        });

                        $('#job_type').html(options);
                        // $('#job_type').select2();
                        $('#addDepartmentModal').modal('hide');
                        $('#deptName' + id).html(name); // Set name in table row
                        $('#edit_id').val(''); // Set edit id field blank
                        $('#tax_name').val(''); // Set name field blank
                        $('#update-department').hide();
                        $('#save-department').show();
                    }
                });

            });

            // Edittax group
            $('body').on('click', '.edit-department', function() {
                var id = $(this).data('dept-id');
                $('#edit_id').val(id); // Set id in edit id field
                $('#tax_name').val($('#deptName' + id).html()); // Set name field by edit name
                $('#update-department').show();
                $('#save-department').hide();
            });


            // // Delete tax group
            $('body').on('click', '.delete-department', function() {
                var id = $(this).data('dept-id');
                console.log(id);
                swal({
                        title: `Are you sure you want to delete this record?`,
                        text: "If you delete this, it will be gone forever.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((isConfirm) => {
                        if (isConfirm) {

                            var url = "{{ route('system-setting.tax-group.destroy', ':id') }}";
                            url = url.replace(':id', id);

                            var token = "{{ csrf_token() }}";

                            $.ajax({
                                type: 'POST',
                                url: url,
                                data: {
                                    '_token': token,
                                    '_method': 'DELETE',
                                },
                                success: function(response) {
                                    console.log(response.success);
                                    if (response.success) {
                                        $('#job_type').empty();
                                        // $.unblockUI();
                                        $('#dept-' + id).fadeOut();
                                        var options = [];
                                        var rData = [];
                                        rData = response.data;
                                        $.each(rData, function(index, value) {
                                            var selectData = '';
                                            selectData = '<option value="' + value
                                                .tax_group_id + '">' +
                                                value.tax_group_name + '</option>';
                                            options.push(selectData);
                                        });


                                        $('#job_type').html(options);
                                    }
                                }
                            });
                        }
                    });
            });
        </script>
        {{--         
  <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>@lang('user-manager.tax-group-name')</th>
                <th>@lang('app.action')</th>
            </tr>
        </thead>
        {{-- @dd($content->taxGroup) --}}
        {{-- <tbody>
            @forelse($content->taxGroup  as $key=>$taxGroup)
                <tr id="dept-{{ $taxGroup->tax_group_id }}">
                    <td>{{ $key + 1 }}</td>
                    <td id="deptName{{ $taxGroup->tax_group_id }}">{{ ucwords($taxGroup->tax_group_name) }}</td>
                    <td>
                        <a href="javascript:;" data-dept-id="{{ $taxGroup->tax_group_id }}"
                            class="btn btn-sm btn-danger btn-rounded delete-department"><i class="fa fa-times"></i>
                        </a>
                        <a href="javascript:;" data-dept-id="{{ $taxGroup->tax_group_id }}"
                            class="btn btn-sm btn-info btn-rounded edit-department"><i class="fa fa-pencil"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">@lang('messages.notFound')</td>
                </tr>
            @endforelse
        </tbody> --}}
        {{-- </table>
</div> --}}
