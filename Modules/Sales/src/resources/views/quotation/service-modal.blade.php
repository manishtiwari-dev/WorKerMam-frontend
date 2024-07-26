<style>
    .hide-box {
        display: none;
    }
</style>
<!--start add modal-->
<div class="modal-header">
    <h4 class="modal-title"><i class="icon-plus"></i> Add Service</h4>
    <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
</div>
<div class="modal-body">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Item Name</th>
                    <th>SAC/HSN Code</th>
                    <th>Price</th> 
                    <th>Tax Group</th> 
                    <th>@lang('app.action')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($serviceData as $key=>$service)
                
                    <tr id="dept-{{ $service->id }}">
                        <input type="hidden" name="tax" id="tax_group_id_data{{ $service->id }}"  value="{{ $service->tax_group_id }}">
                        <td>{{ $key + 1 }}</td>
                        <td id="service_name{{ $service->id }}">{{ ucwords($service->item_name) }}</td>

                        <td id="item_saccode{{ $service->id }}">{{ ucwords($service->item_saccode) }}</td>
                        <td id="item_price{{ $service->id }}">{{ ucwords($service->item_price) }}</td>
                        <td>{{ $service->tax_group_name->tax_group_name ?? '' }}</td>
                        <td >
                            {{-- <a href="javascript:;" data-dept-id="{{ $service->id }}"
                                class="btn btn-sm btn-danger btn-rounded delete-department"><i class="fa fa-times"></i>
                            </a> --}}
                            <a href="javascript:;" data-service-id="{{ $service->id }}"
                                class="btn btn-sm btn-info btn-rounded edit-department"><i class="fa fa-pencil"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">@lang('messages.notFound')</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <hr>
    <form id="serviceFormStore" method="POST" class="needs-validation novalidate" novalidate>
        @csrf
        <div class="card-body px-0">
            <div data-label="Example" class="df-example demo-forms">
                <fieldset class="form-fieldset">
                    <legend>{{ __('crm.services_info') }}</legend>
                    <div class="form-row">
                        <input type="hidden" name="edit_id" id="edit_id">
                        <div class="form-group col-md-4 col-lg-4 col-12">
                            <label class="form-label">{{ __('crm.service_name') }} <span
                                    class="text-danger mg-l-5">*</span></label>
                            <input type="text" class="form-control" name="service_name"
                                placeholder="{{ __('crm.service_name_placeholder') }}" id="service_name" required>
                            <div class="invalid-feedback">
                                {{ __('crm.service_name_error') }}
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-lg-4 col-12">
                            <label class="form-label">{{ __('crm.item_saccode') }} <span
                                    class="text-danger mg-l-5">*</span></label>
                            <input type="text" class="form-control" id="item_saccode" name="item_saccode"
                                placeholder="{{ __('crm.sac_code_placeholder') }}" required>
                            <div class="invalid-feedback">
                                {{ __('crm.sac_code_error') }}
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-lg-4 col-12">
                            <label class="form-label">{{ __('crm.item_price') }} <span
                                    class="text-danger mg-l-5">*</span></label>
                            <input type="text" class="form-control" id="item_price" name="item_price"
                                placeholder="{{ __('crm.item_price_placeholder') }}" required>
                            <div class="invalid-feedback">
                                {{ __('crm.item_price_error') }}
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-lg-4 col-12">
                            <label class="form-label">{{ __('crm.tax_group') }} <span
                                    class="text-danger mg-l-5"></span></label>
                            <select class="form-control" name="tax_group" id="tax_group" id="tax_group">
                                <option value="" selected disabled>
                                    {{ __('crm.tax_group_placeholder') }}</option>
                                @if (!empty($TaxGroup))
                                    @foreach ($TaxGroup as $taxgrp_data)
                                        <option value="{{ $taxgrp_data->tax_group_id }}">
                                            {{ $taxgrp_data->tax_group_name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="invalid-feedback">
                                {{ __('crm.tax_group_error') }}
                            </div>
                        </div>
                    </div>
                </fieldset>

            </div>
        </div>

        <div class="btnclass">
            <div>
                <input type="button" id="save-service" class="btn btn-primary" value="Submit">
                <button type="button" id="update-service" class="btn btn-primary hide-box">
                    @lang('app.update')</button>

            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </form>
</div> 
<!--end add modal-->

<script>
    // Save department
    $('#save-service').click(function(e) {
        e.preventDefault();
        $('#serviceFormStore').addClass('was-validated');
        if ($('#serviceFormStore')[0].checkValidity() === false) {
            event.stopPropagation();
        } else {
            $.ajax({
                url: '{{ route('sales.servicesAdd') }}',
                container: '#serviceFormStore',
                type: "POST",
                data: $('#serviceFormStore').serialize(),
                success: function(response) {
                    Toaster("success", response.message);
                    $("#addDepartmentModal").modal('hide');
                    
                }

            });
        }
    });


    // Delete Department
    $('body').on('click', '.delete-department', function() {
        var id = $(this).data('dept-id');
        swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((isConfirm) => {
                if (isConfirm) { 
                    
                    var url = "{{ route('sales.ServiceDelete', ':id') }}"; // Using the route name 'ServiceDelete'
                    url = url.replace(':id', id);

                    var token = "{{ csrf_token() }}";

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            '_token': token, 
                            'id' : id
                        },
                        success: function(response) {
                            console.log(response.success);
                            if (response.success) {  
                                $('#dept-' + id).fadeOut(); 
                            }
                        }
                    });
                }
            });
    });

    // Edit department
    $('body').on('click', '.edit-department', function() {
        var id = $(this).data('service-id');
        $('#edit_id').val(id); // Set id in edit id field
        $('#service_name').val($('#service_name' + id).html()); // Set name field by edit name
        $('#item_saccode').val($('#item_saccode' + id).html()); 
        $('#item_price').val($('#item_price' + id).html());  
 
        var tax_group = $('#tax_group_id_data' + id).val(); 
        $('#tax_group').val(tax_group);
        $('#tax_group option[value="' + tax_group + '"]').attr('selected', 'selected');

        $('#update-service').show();
        $('#save-service').hide();
    });


    // Update department
    $('#update-service').click(function() {

    var id = $('#edit_id').val();
    var url = "{{ route('sales.ServiceUpdate', ':id') }}";
    url = url.replace(':id', id);
    var token = '{{ csrf_token() }}';

    var service_name = $('#service_name').val();
    var item_saccode = $('#item_saccode').val();
    var item_price = $('#item_price').val();
    var tax_group = $('#tax_group').val();

    $.ajax({
        url: url,
        container: '#createdepartment',
        type: "POST",
        data: {
            '_token': token, 
            'id' : id,
            'item_saccode': item_saccode,
            'service_name': service_name,
            'item_price':item_price,
            'tax_group': tax_group
        },
        success: function(response) { 
            Toaster("success", response.success);
                    $("#addDepartmentModal").modal('hide');
        }
    });

    });

    // Edit department

</script>