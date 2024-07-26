<style>
    .pull-left button {
        float: right;
        margin: 1rem 0 0.6rem;
    }

    .btns {
        margin: 0 10px !important;
    }

    .table_btn {
        margin: 0 4px;
    }
</style>


<x-app-layout>
    @section('title',  $pageTitle)

    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
    <div class="card contact-content-body">
        <div class="tab-content">
            <div class="card-header d-flex align-items-center justify-content-between py-2 px-3">
                <h6 class="tx-15 mg-b-0">Order Status</h6>
            </div>
            <div class="card-body">
                <form id="save-order-data" method="post">

                <div class="table-responsive">
                    <table class="table  table_wrapper rounded px-3">
                        <thead>
                            <tr>
                                <th class="border-bottom ">#</th>
                                <th class="border-bottom " style="min-width: 80px;">Status Name</th>
                                <th class="border-bottom ">Template</th>

                                <th class="border-bottom text-center">Sort Order</th>

                                <th class="border-bottom text-center">Shipment</th>
                                <th class="border-bottom  text-center">Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($content->order_status))
                                @foreach ($content->order_status as $key => $data)
                              
                                    <tr>
                                        <input type="hidden" 
                                        name="order_id"
                                       value="{{ $data->id }}" >

                                        <td class="">{{ $key + 1 }}</td>

                                        <td class="">{{ $data->order_status }}</td>
                                        <td class="" style="width:20%;"> <select class="form-select form-control select-picker "
                                                data-id="{{ $data->id }}"
                                                id="customSwitch" name="template_{{ $data->id }}"
                                                aria-label="Default select example">
                                                {{-- <option selected for="Select">{{ __('seo.select') }}</option> --}}
                                                <option value="">No Template</option>
                                                @if (!empty($template_list))
                                                    @foreach ($template_list as $key => $template)
                                                        <option value="{{$template->template_id }}" {{ $template->template_id == $data->template_id ? 'selected' : '' }}  >
                                                            {{$template->template_subject }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                                {{-- @for ($a = 1; $a <= $submission_no; $a++)
                                                <option value="{{ $a }}"
                                                    @if (!empty($seo_task->taskData)) {{ $a == $seo_task->taskData->no_of_submission ? 'selected' : '' }} @endif>
                                                    {{ $a }}
                                                </option>
                                            @endfor --}}
                                            </select></td>
                                        <td class="text-center">
                                            <input type="number" class="col-xs-1 inputPassword2 width1 text-center"
                                                data-id="{{ $data->id }}" placeholder=""
                                                value="{{ $data->sort_order }}" style="width:50px;">
                                        </td>
                                        <td class="">
                                            <div class="form-check form-switch">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox"
                                                        class="custom-control-input shippmenttoggle-class"
                                                        {{ $data->shipment == '1' ? 'checked' : '' }}
                                                        data-id="{{ $data->id }}"
                                                        id="customSwitch{{ $data->id }}">
                                                    <label class="custom-control-label"
                                                        for="customSwitch{{ $data->id }}"></label>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="">
                                            <div class="form-check form-switch">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input toggle-class"
                                                        {{ $data->status == '1' ? 'checked' : '' }}
                                                        data-id="{{ $data->id }}"
                                                        id="customSwitch1{{ $data->id }}">
                                                    <label class="custom-control-label"
                                                        for="customSwitch1{{ $data->id }}"></label>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 px-2 ">
                    <div class="col-sm-12 p-0">
                        <input type="button" class="btn btn-primary  save-website-form" form-id=""
                            value="{{ __('common.update') }}" />

                     
                    </div>
                </div>

            </form>
            </div>
        </div>
    </div>
    @endif

    @push('scripts')
        <script type="text/javascript">
            var country_list = "";
            $('.toggle-class').change(function() {
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
                    url: "{{ route('website-setting.orderChangeStatus') }}",
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(response) {
                        console.log(response);
                        Toaster('success',response.success);
                    }
                });
            });
        </script>

        <script type="text/javascript">
            $('.shippmenttoggle-class').change(function() {
                let shipment = $(this).prop('checked') === true ? 1 : 0;
                let id = $(this).data('id');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('website-setting.shippmentStatus') }}",
                    data: {
                        'shipment': shipment,
                        'id': id
                    },
                    success: function(response) {
                        // Toaster(response.success);
                        // if (response.status == 'true')
                        //     Toaster('true', response.message);
                        // else
                        //     Toaster('false', response.message);
                     
                        Toaster('success',response.success);
                    }

                });
            });
        </script>

        <script>
            $(document).ready(function() {

                // category sort order update
                $(".inputPassword2").on("blur", function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    var sort_order = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('website-setting.orderStatusSortOrder') }}",
                        data: {
                            id: id,
                            sort_order: sort_order
                        },
                        dataType: "json",
                        success: function(data) {
                            Toaster('success',data.success);
                        }
                    });
                });

            });
        </script>




<script>
    $('.select2').select2({
        searchInputPlaceholder: 'Select User'
    });



    $(document).ready(function() {
        $('.save-website-form').click(function() {
            const url = "{{ route('website-setting.order_template_update') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                container: '#save-order-data',
                type: "POST",
                data: $('#save-order-data').serialize(),
                success: function(response) {
                    console.log(response);
                    if (response.success) {

                   //     Toaster('success',response.success);
                        toastr.success(response.success);
                    } else {
                        toastr.error(response.error);
                       // Toaster('error',response.error);

                    }
                    location.reload();

                }
            })
        });
    });
</script>




 
    @endpush
</x-app-layout>
