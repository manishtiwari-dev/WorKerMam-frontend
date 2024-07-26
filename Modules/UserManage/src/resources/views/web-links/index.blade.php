<x-app-layout>
    @section('title', 'Web Links')

    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
        <div class="card contact-content-body">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="tx-15 mg-b-0">{{ __('settings.web_links') }}</h6>
                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                        <a href="#add_url" class="btn btn-md  btn-primary align-items-center mg-r-5"
                            data-bs-toggle="modal"><i data-feather="plus"></i>
                            <span class="d-none d-sm-inline mg-l-5">{{ __('seo.add_url') }}</span>
                        </a>
                    @endif
                </div>
            </div>
            <div class="card-body">

                <div class="row align-item-center mb-3 order-list-wrapper">
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
                </div>

                <div class="table-responsive" id="url_listing">

                    <table class="table  table_wrapper">
                        <thead>
                            <tr>
                                <th>{{ __('common.sl_no') }}</th>
                                <th>{{ __('settings.link_name') }}</th>
                                <th>{{ __('settings.link_url') }}</th>
                                <th>{{ __('seo.status') }}</th>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                    <th class="wd-10p text-center">
                                        {{ __('common.action') }}
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if (sizeof($content->data) > 0)
                                @foreach ($content->data as $key => $webLinkdata)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-truncate">{{ $webLinkdata->link_name ?? '' }}</td>
                                        <td class="text-truncate">{{ $webLinkdata->link_url ?? '' }}</td>

                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input urlToggleBtn"
                                                    {{ $webLinkdata->status == '1' ? 'checked' : '' }}
                                                    data-id="{{ $webLinkdata->link_id }}"
                                                    id="customSwitch{{ $webLinkdata->link_id }}">
                                                <label class="custom-control-label"
                                                    for="customSwitch{{ $webLinkdata->link_id }}"></label>
                                            </div>
                                        </td>

                                        <td class="d-flex align-items-center gap-2 justify-content-center">

                                            <a href="javascript:void(0)" class="btn btn-sm  table_btn py-1 px-2"
                                                id="viewBtn" data-toggle="modal"
                                                data-id="{{ $webLinkdata->link_id }}">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                <span class="d-sm-inline mg-l-5"></span>
                                            </a>

                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                                                <a href="#edit_url" class="btn btn-sm  table_btn py-1 px-2 editBtn"
                                                    data-bs-toggle="modal" data-id="{{ $webLinkdata->link_id }}"><i
                                                        data-feather="edit-2"></i><span
                                                        class="d-sm-inline mg-l-5"></span>
                                                </a>
                                            @endif

                                            @if (\App\Helper\Helper::CheckPermission($pageAccess, 'remove') == 'true')
                                                <a href="#url_delete_modal" data-bs-toggle="modal"
                                                    data-id="{{ $webLinkdata->link_id }}"
                                                    class="btn btn-sm  table_btn py-1 px-2 url_delete_btn"><i
                                                        data-feather="trash"></i><span
                                                        class="d-none d-sm-inline mg-l-5"></span>
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
    <div class="modal fade" id="add_url" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header align-item-center">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('seo.add_url') }}</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_url_form" class="needs-validation" novalidate>



                        <div class="form-group">
                            <label for="link_name">{{ __('settings.link_name') }}<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control url_input" id="link_name" name="link_name"
                                placeholder="{{ __('settings.link_name_placeholder') }}" required>
                            <span style="color:red;">
                                @error('link_name')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('settings.link_name') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="link_url">{{ __('settings.link_url') }}<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control url_input" id="link_url" name="link_url"
                                placeholder="{{ __('settings.link_url_placeholder') }}" required>
                            <span style="color:red;">
                                @error('link_url')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('settings.link_url_error') }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="seometa_title">{{ __('settings.seometa_title') }}<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control url_input" id="seometa_title"
                                name="seometa_title" placeholder="{{ __('settings.seometa_title_placeholder') }}">
                            <span style="color:red;">
                                @error('seometa_title')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('settings.seometa_title_error') }}
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="seometa_desc">{{ __('settings.seometa_desc') }}<span
                                    class="text-danger">*</span></label>
                            <textarea rows="4" class="form-control url_input" id="seometa_desc" name="seometa_desc"
                                placeholder="{{ __('settings.seometa_desc_placeholder') }}"></textarea>
                            <span style="color:red;">
                                @error('seometa_desc')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('settings.seometa_desc_error') }}
                            </div>
                        </div>
                        <div class="form-row">
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

                        </div>

                        <button type="button" class="btn btn-primary"
                            id="addUrlBtn">{{ __('common.submit') }}</button>
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
                    <h6 class="modal-title" id="exampleModalLabel"> {{ __('seo.update_url') }}</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_url_form" class="needs-validation" novalidate>
                        <div class="form-group">
                            <label for="edit_link_name">{{ __('settings.link_name') }}<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control edit_link_name" id="edit_link_name"
                                name="edit_link_name" placeholder="{{ __('settings.link_name_placeholder') }}"
                                required>
                            <span style="color:red;">
                                @error('link_name')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('settings.link_name_error') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_link_url">{{ __('settings.link_url') }}<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control edit_link_url " id="edit_link_url"
                                name="edit_link_url" placeholder="{{ __('settings.link_url_placeholder') }}"
                                required>
                            <span style="color:red;">
                                @error('link_url')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('settings.link_url_error') }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="edit_seometa_title">{{ __('settings.seometa_title') }}<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_seometa_title"
                                name="edit_seometa_title"
                                placeholder="{{ __('settings.seometa_title_placeholder') }}">
                            <span style="color:red;">
                                @error('seometa_title')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('settings.seometa_title_error') }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="edit_seometa_desc">{{ __('settings.seometa_desc') }}<span
                                    class="text-danger">*</span></label>
                            <textarea rows="4" class="form-control" id="edit_seometa_desc" name="edit_seometa_desc"
                                placeholder="{{ __('settings.seometa_desc_placeholder') }}"></textarea>
                            <span style="color:red;">
                                @error('seometa_desc')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="invalid-feedback">
                                {{ __('settings.seometa_desc_error') }}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-6">
                                <label for="seometa_desc">{{ __('common.status') }}<span
                                        class="text-danger">*</span></label>
                                <select class="form-select form-control" name="edit_web_link_status"
                                    id="edit_web_link_status">
                                    <option value="1">Open</option>
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
                                <select class="form-select form-control" name="edit_noindex" id="edit_noindex">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                @error('noindex')
                                    {{ $message }}
                                @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{ __('settings.noindex_err') }}
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

    <!--start delete modal-->
    <div class="modal fade" id="url_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-item-center">
                    <h6 class="modal-title" id="exampleModalLabel"> {{ __('settings.web_link') }}</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>{{ __('common.delete_confirmation') }}</h5>
                    <input type="hidden" id="delete_id" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-secondary delete_submit_btn">{{ __('common.yes') }}</button>
                    <button type="button" class="btn btn-primary"
                        data-bs-dismiss="modal">{{ __('common.no') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--end delete modal-->

    <!--View Modal Start-->

    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('settings.link_details') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>
                        <h6>{{ __('settings.link_name') }} : </h6>
                        <p class="view-url-name"></p>
                    </span>
                    <span>
                        <h6>{{ __('settings.link_url') }} : </h6>
                        <p class="view-url-link"></p>
                    </span>
                    <span>
                        <h6>{{ __('settings.seometa_title') }} : </h6>
                        <p class="view-meta-title"></p>
                    </span>
                    <span>
                        <h6>{{ __('settings.seometa_desc') }} : </h6>
                        <p class="view-meta-desc"></p>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!--View Modal End-->

    @push('scripts')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>

        <script>
            $(document).ready(function() {

                // Add sender Ajax Start Here
                $('#addUrlBtn').on("click", function(e) {
                    e.preventDefault();
                    $('#add_url_form').addClass('was-validated');
                    if ($('#add_url_form')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        $('#addUrlBtn').attr('disabled', 'true');
                        var formData = {
                            link_name: $("#link_name").val(),
                            link_url: $("#link_url").val(),
                            seometa_title: $("#seometa_title").val(),
                            seometa_desc: $("#seometa_desc").val(),
                            status: $("#web_link_status").val(),
                            noindex: $("#web_noindex").val(),

                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('website-setting.custom-link.customUrlStore') }}",
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

                // View Ajax Start
                $(document).on("click", "#viewBtn", function(e) {
                    e.preventDefault();
                    var view_id = $(this).data('id');
                    $.ajax({
                        url: "{{ route('website-setting.custom-link.customUrlEdit') }}",
                        type: "POST",
                        data: {
                            link_id: view_id
                        },
                        success: function(response) {
                            if (response.edit_weblinks.web_link != null) {
                                $('.view-url-name').text(response.edit_weblinks.web_link.link_name);
                                $('.view-url-link').text(response.edit_weblinks.web_link.link_url);
                            }
                            if (response.edit_weblinks.seo_meta != null) {
                                $('.view-meta-title').text(response.edit_weblinks.seo_meta
                                    .seometa_title);
                                $('.view-meta-desc').text(response.edit_weblinks.seo_meta
                                    .seometa_desc);
                            }
                            $('#viewModal').modal('show');
                        }
                    });
                });
                // View Ajax End

                // Edit url Ajax Start

                $(document).on("click", ".editBtn", function(e) {
                    e.preventDefault();
                    var edit_id = $(this).data('id');
                    $.ajax({
                        url: "{{ route('website-setting.custom-link.customUrlEdit') }}",
                        type: "POST",
                        data: {
                            link_id: edit_id
                        },

                        success: function(response) {
                            $('.edit_id').val(edit_id);
                            $('.edit_link_name').val(response.edit_weblinks.web_link.link_name);
                            $('.edit_link_url').val(response.edit_weblinks.web_link.link_url);
                            $('#edit_seometa_title').val(response.edit_weblinks.seo_meta
                                .seometa_title);
                            $('#edit_seometa_desc').val(response.edit_weblinks.seo_meta
                                .seometa_desc);
                            $("#edit_web_link_status").val(response.edit_weblinks.web_link.status);
                            $("#edit_noindex").val(response.edit_weblinks.web_link.noindex);



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
                            link_name: $("#edit_link_name").val(),
                            link_url: $("#edit_link_url").val(),
                            seometa_title: $("#edit_seometa_title").val(),
                            seometa_desc: $("#edit_seometa_desc").val(),
                            link_id: $(".edit_id").val(),
                            status: $("#edit_web_link_status").val(),
                            noindex: $("#edit_noindex").val(),
                        };

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('website-setting.custom-link.customUrlUpdate') }}",
                            type: "POST",
                            data: formData,
                            dataType: "json",

                            success: function(response) {
                                Toaster('success', response.success);
                                setTimeout(function() {
                                    location.reload(true);
                                }, 1000);
                            },
                        });
                    }
                });

                // Update Sender Ajax End Here

                //Delete Sender Ajax Start Here

                $('.url_delete_btn').on("click", function(e) {
                    e.preventDefault();
                    var delete_id = $(this).data('id');
                    $('#delete_id').val(delete_id);
                });
                $(document).on("click", ".delete_submit_btn", function(e) {
                    e.preventDefault();
                    var id = $('#delete_id').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: "{{ route('website-setting.custom-link.customUrlDelete') }}",
                        data: {
                            link_id: id
                        },
                        dataType: "json",
                        success: function(response) {
                            Toaster('success', response.success);
                            setTimeout(function() {
                                location.reload();
                            }, 1000);

                        }
                    });
                });

                //Delete Sender Ajax End Here


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
                        url: "{{ route('website-setting.custom-link.customUrlchangeStatus') }}",
                        data: {
                            link_id: id
                        },
                        success: function(response) {
                            Toaster('success', response.message);

                        }
                    });
                });

                //Sender List Change Status Ajax End Here 

                // Search Filter Start Here


                $(document).ready(function() {
                    $("#search").on('keyup', function(e) {
                        tableWebContent(this.value);
                    });
                });


                function tableWebContent(search = '') {
                    const url = "{{ route('website-setting.custom-link.webLinkFilter') }}";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            search: search,
                        },
                        dataType: "json",
                        success: function(result) {
                            $("#url_listing").html(result.html);
                        }
                    });
                }

                // Date and Search Filter End Here

            });
        </script>
    @endpush

</x-app-layout>
