<x-app-layout>
    @section('title', 'Payment Term')

    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
        <div class="card contact-content-body">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="tx-15 mg-b-0">Payment Term
                    </h6>
                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                        <a href="#add_paymentTerm" class="btn btn-md  btn-primary align-items-center mg-r-5"
                            data-bs-toggle="modal"><i data-feather="plus"></i>
                            <span class="d-none d-sm-inline mg-l-5">Add Payment Term
                            </span>
                        </a>
                    @endif
                </div>
            </div>
            <div class="card-body">

                {{-- <div class="row align-item-center mb-3 order-list-wrapper">
                    <div class="col-lg-4">
                        <input type="text" id="search" value="" class="form-control fas fa-search"
                            placeholder="Search..." aria-label="Search" name="search">
                    </div>
                    <div class="col-lg-2 mt-2 mt-lg-0">
                        <div class="align-items-center ">
                            <a class="btn btn-block btn-lg  btn-primary"
                                href="{{ route('website-setting.custom-link.customUrl') }}" role="button"><i
                                    class="fa fa-refresh" aria-hidden="true"></i>
                                {{ __('common.reset') }}</a>
                        </div>
                    </div>
                </div> --}}

                <div class="table-responsive" id="url_listing">

                    <table class="table  table_wrapper">
                        <thead>
                            <tr>
                                <th>{{ __('common.sl_no') }}</th>
                                <th>Term Name</th>
                                <th>Advance Payment</th>
                                <th>Balance Payment</th>
                                <th>Status </th>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                    <th class="wd-10p text-center">
                                        {{ __('common.action') }}
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if (sizeof($content->data) > 0)
                                @foreach ($content->data as $key => $list)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-truncate">{{ $list->terms_name ?? '' }}</td>
                                        <td class="text-truncate">{{ $list->advance_payment ?? '' }}</td>
                                        <td class="text-truncate">{{ $list->balance_payment ?? '' }}</td>

                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input urlToggleBtn"
                                                    {{ $list->status == '1' ? 'checked' : '' }}
                                                    data-id="{{ $list->terms_id }}"
                                                    id="customSwitch{{ $list->terms_id }}">
                                                <label class="custom-control-label"
                                                    for="customSwitch{{ $list->terms_id }}"></label>
                                            </div>
                                        </td>

                                        <td class="d-flex align-items-center gap-2 justify-content-center">

                                           

                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                                <a href="#edit_url" class="btn btn-sm  table_btn py-1 px-2 editBtn"
                                                    data-bs-toggle="modal" data-id="{{ $list->terms_id }}"><i
                                                        data-feather="edit-2"></i><span
                                                        class="d-sm-inline mg-l-5"></span>
                                                </a>
                                            @endif


                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">
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
                        'website-setting.custom-link.customUrl',
                        ['start_date' => $content->start_date ?? '', 'end_date' => $content->end_date ?? ''],
                    ) !!}
                    <!--Pagination End-->

                </div>
            </div>
        </div>
    @endif

    <!---  Add URL Modal Start Here ------------->
    <div class="modal fade" id="add_paymentTerm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header align-item-center">
                    <h6 class="modal-title" id="exampleModalLabel">Add Payment Term</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_paymentTerm_form" class="needs-validation" novalidate>



                        <div class="form-group">
                            <label for="terms_name">Term Name<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control url_input" id="terms_name" name="terms_name"
                                placeholder="Term Name" required>
                            <span style="color:red;">
                                @error('terms_name')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                               please enter a term name
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="advance_payment">Advance Payment<span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control url_input" id="advance_payment" name="advance_payment"
                                placeholder="Advance Payment" required>
                            <span style="color:red;">
                                @error('advance_payment')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                please enter advance payment 
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="balance_payment">Balance Payment<span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control url_input" id="balance_payment"
                                name="balance_payment" placeholder="Balance Payment" required>
                            <span style="color:red;">
                                @error('balance_payment')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                please enter   balance payment
                            </div>
                        </div>

                     
                        {{-- <div class="form-row">
                            <div class="form-group col-md-6 col-6">
                                <label for="seometa_desc">{{ __('common.status') }}<span
                                        class="text-danger">*</span></label>
                                <select class="form-select form-control" name="web_link_status" id="web_link_status">
                                    <option value="1" selected>Open</option>
                                    <option value="0">Blocked</option>
                                </select>
                                @error('status')
                                    {{ $message }}
                                @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('settings.status') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6 col-6">
                                <label for="seometa_desc">{{ __('settings.noindex') }}<span
                                        class="text-danger">*</span></label>
                                <select class="form-select form-control" name="web_noindex" id="web_noindex">
                                    <option value="1">Yes</option>
                                    <option value="0" selected>No</option>
                                </select>
                                @error('noindex')
                                    {{ $message }}
                                @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('settings.noindex_err') }}
                                </div>
                            </div>

                        </div> --}}

                        <button type="button" class="btn btn-primary"
                            id="addBtn">{{ __('common.submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!---  Add URL Modal End Here ------------->


    <!---  Edit URL List Modal Start Here ------------->
    <div class="modal fade" id="edit_url" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header align-item-center">
                    <h6 class="modal-title" id="exampleModalLabel"> Update Payment Term</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_url_form" class="needs-validation" novalidate>
                        <div class="form-group">
                            <label for="edit_link_name">Term Name<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control edit_terms_name" id="edit_terms_name"
                                name="terms_name" placeholder="Term Name"
                                required>
                            <span style="color:red;">
                                @error('terms_name')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                please enter a term name
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_link_url">Advance Payment<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control edit_link_url " id="edit_advance_payment"
                                name="advance_payment" placeholder="Advance Payment"
                                required>
                            <span style="color:red;">
                                @error('advance_payment')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                please enter advance payment 
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="edit_seometa_title">Balance Payment<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_balance_payment"
                                name="balance_payment"
                                placeholder="Balance Payment" required>
                            <span style="color:red;">
                                @error('balance_payment')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                please enter balance payment
                            </div>
                        </div>

                   
                        <div class="form-row">
                            <div class="form-group col-md-6 col-6">
                                <label for="seometa_desc">{{ __('common.status') }}<span
                                        class="text-danger">*</span></label>
                                <select class="form-select form-control" name="status"
                                    id="edit_status">
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                                </select>
                                @error('status')
                                    {{ $message }}
                                @enderror
                                </span>
                                <div class="invalid-feedback">
                                    please select a status
                                </div>
                            </div>


                           
                        </div>

                        <input type="hidden" class="edit_id" value="">
                        <button type="button" class="btn btn-primary"
                            id="updateUrlBtn">{{ __('common.submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!---  Edit URL Modal End Here ------------->

   

    @push('scripts')
       
        <script>
            $(document).ready(function() {

                // Add sender Ajax Start Here
                $('#addBtn').on("click", function(e) {
                    e.preventDefault();
                    $('#add_paymentTerm_form').addClass('was-validated');
                    if ($('#add_paymentTerm_form')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        $('#addBtn').attr('disabled', 'true');
                        var formData = {
                            terms_name: $("#terms_name").val(),
                            advance_payment: $("#advance_payment").val(),
                            balance_payment: $("#balance_payment").val(),

                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('system-setting.paymentTermStore') }}",
                            type: "POST",
                            data: formData,
                            dataType: "json",

                            success: function(response) {
                                Toaster('success', response.message);
                                setTimeout(function() {
                                    location.reload(true);
                                }, 1000);
                            },
                        });
                    }
                });
                // Add url Ajax End Here

              

                // Edit url Ajax Start

                $(document).on("click", ".editBtn", function(e) {
                    e.preventDefault();
                    var edit_id = $(this).data('id');
                    $.ajax({
                        url: "{{ route('system-setting.paymentTermEdit') }}",
                        type: "POST",
                        data: {
                            terms_id: edit_id
                        },

                        success: function(response) {
                            console.log(response.edit_data);
                            $('.edit_id').val(edit_id);
                            $('.edit_terms_name').val(response.edit_data.terms_name);
                            $('#edit_advance_payment').val(response.edit_data.advance_payment);
                            $('#edit_balance_payment').val(response.edit_data.balance_payment
                                );
                        
                            $("#edit_status").val(response.edit_data.status);



                        }
                    });
                });
                //  Edit url Ajax End  Here

                // Upadate url Ajax Start Here

                $('#updateUrlBtn').on("click", function(e) {
                    e.preventDefault();
                    $('#update_url_form').addClass('was-validated');
                    if ($('#update_url_form')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        $('#updateUrlBtn').attr('disabled', 'true');
                        var formData = {
                            terms_name: $("#edit_terms_name").val(),
                            advance_payment: $("#edit_advance_payment").val(),
                            balance_payment: $("#edit_balance_payment").val(),
                            terms_id: $(".edit_id").val(),
                            status: $("#edit_status").val(),
                        };

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('system-setting.paymentTermUpdate') }}",
                            type: "POST",
                            data: formData,
                            dataType: "json",

                            success: function(response) {
                                Toaster('success', response.message);
                                setTimeout(function() {
                                    location.reload(true);
                                }, 1000);
                            },
                        });
                    }
                });

                // Update Sender Ajax End Here

               


                //Sender List Change Status Ajax Start Here 
                $(document).on("change", ".urlToggleBtn", function(e) {
                    let id = $(this).data('id');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('system-setting.paymentTermchangeStatus') }}",
                        data: {
                            terms_id: id
                        },
                        success: function(response) {
                            Toaster('success', response.message);

                        }
                    });
                });

                //Sender List Change Status Ajax End Here 

                // Search Filter Start Here


           
                // Date and Search Filter End Here

            });
        </script>
    @endpush

</x-app-layout>
