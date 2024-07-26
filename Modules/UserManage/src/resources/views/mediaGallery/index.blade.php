@php
    $current_url = url()->current();
    $show = 0;
@endphp


@push('style')
    <link rel="stylesheet" href="{{ asset('asset/css/dashforge.filemgr.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet">

    <style>
        .card-body.dropzone {
            background: #e3e6ff;
            border-radius: 13px;
            max-width: 550px;
            margin-left: auto;
            margin-right: auto;
            border: 2px dotted #1833FF;
            margin-top: 50px;
        }
    </style>
@endpush

<x-app-layout>

    @section('title', 'Media Gallery')

    <div class="card contact-content-body">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="tx-15 mg-b-0">{{ __('user-manager.media_upload') }}</h6>
            </div>
        </div>
        <div class="card-body">
            <div id="dropzone">
                <form action="{{ url('website-setting/media/store') }}" class="dropzone" id="file-upload"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="dz-message">
                        Drag and Drop Single/Multiple Files Here<br>
                    </div>
                </form>
            </div>


            <div class="row row-xs">
                @if (!empty($data))
                    @foreach ($data as $key => $img)
                        <div class=" col-sm-2  my-3 d-flex">

                            <div class="card card-file image_card">
                                <div class="dropdown-file">
                                    <a href="" class="dropdown-link" data-bs-toggle="dropdown">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-more-vertical">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="12" cy="5" r="1"></circle>
                                            <circle cx="12" cy="19" r="1"></circle>
                                        </svg>
                                        {{-- <i
                                            data-feather="more-vertical"></i>
                                         --}}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#modalViewDetails" data-id="{{ $img->images_id }}"
                                            data-bs-toggle="modal" class="dropdown-item details result_edit_btn"><i
                                                data-feather="info"></i>View Details</a>
                                        <a href="#media_delete" id="media_del_btn" data-id="{{ $img->images_id }}"
                                            data-bs-toggle="modal" class="dropdown-item delete"><i
                                                data-feather="trash"></i>Delete</a>
                                    </div>
                                </div><!-- dropdown -->
                                <div class="card-file-thumb tx-danger">
                                    <img src="{{ $img->media_image }}" class="card-img-top img-fluid"
                                        alt="{{ $img->images_ori_name }}">
                                </div>

                                <div class="card-body border-top">
                                    <h6><a href="" class="link-02">
                                            @if (!empty($img->images_ori_name))
                                                {{ $img->images_ori_name }}
                                            @else
                                                {{ $img->images_name }}.{{ $img->images_ext }}
                                            @endif
                                        </a></h6>

                                </div>
                            </div>
                        </div><!-- col -->
                    @endforeach
                @endif
            </div>

            <!--Pagination Start-->
            {!! \App\Helper\Helper::make_pagination(
                $total_records,
                $per_page,
                $current_page,
                $total_page,
                'website-setting.media',
            ) !!}
            <!--Pagination End-->

        </div>
    </div>

    {{-- modal start --}}

    <div class="modal fade effect-scale" id="modalViewDetails" tabindex="-1" role="dialog" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog   modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body pd-20 pd-sm-30">
                    <button type="button" class="close pos-absolute t-15 r-20" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>

                    <h5 class="tx-18 tx-sm-20 mg-b-30">View Details</h5>

                    <div class="row mg-b-10">
                        <div class="col-4">IMAGE NAME:</div>

                        <div class="col-8" id="image_name"></div>

                    </div><!-- row -->

                    <div class="row mg-b-10">
                        <div class="col-4">AVAILABLE SIZE:</div>
                        <div class="col-8" id="img_size"></div>
                    </div><!-- row -->
                    <div class="row mg-b-10">
                        <div class="col-4">IMAGE URL:</div>
                        <div class="col-8 ">

                            {{-- <input class="col-10 ur  form-control" type="url" id="img_url"
                                aria-describedby="inputGroup-sizing-default" style="height: 40px;"> --}}
                            <textarea rows="2" class=" ur form-control " id="img_url"></textarea>
                        </div>

                    </div><!-- row -->
                    <div class="row ">
                        <div class="col-4 message"></div>
                        <div class="col-8">
                            <button class="cpy" onclick="myFunction()"><i class="fa fa-clone"
                                    style="font-size: 1rem;"></i></button>

                        </div>
                    </div><!-- row -->


                    <div class="row mg-b-10">
                        <div class="col-4">IMAGE UPDATED:</div>
                        <div class="col-8" id="img_date"></div>
                    </div><!-- row -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mg-sm-l-5" data-bs-dismiss="modal">Close</button>
                </div><!-- modal-footer -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->

    <!--media delete modal-->
    <div class="modal fade effect-scale" id="media_delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('user-manager.delete_media') }}</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_task_id" name="input_field_id">
                    <p class="mg-b-0">{{ __('common.delete_confirmation') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('common.no') }}</button>
                    <button type="button" class="btn btn-primary img_delete_yes">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end media --}}

    @push('styles')
        <style>
            /* pop up css */
            .ur {
                border: none;

                border-bottom-left-radius: 4px;
                border-top-left-radius: 4px;
            }

            .cpy {
                border: none;
                background-color: #e6e2e2;
                border-bottom-right-radius: 4px;
                border-top-right-radius: 4px;
                cursor: pointer;
            }

            .ur.focus,
            .ur:focus {
                outline: 0;
                box-shadow: none !important;
            }

            .message {
                font-size: 11px;
                color: #ee5535;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
        <script>
            Dropzone.autoDiscover = false;
            var dropzone = new Dropzone('#file-upload', {
                parallelUploads: 3,
                thumbnailHeight: 150,
                thumbnailWidth: 150,
                maxFilesize: 5,
                filesizeBase: 1500,
                thumbnail: function(file, dataUrl) {
                    if (file.previewElement) {
                        file.previewElement.classList.remove("dz-file-preview");
                        var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
                        for (var i = 0; i < images.length; i++) {
                            var thumbnailElement = images[i];
                            thumbnailElement.alt = file.name;
                            thumbnailElement.src = dataUrl;
                        }
                        setTimeout(function() {
                            file.previewElement.classList.add("dz-image-preview");
                        }, 1);
                    }
                },
                success: function(response) {
                    console.log(response);
                },
            });
        </script>

        <script type="text/javascript" href="{{ asset('asset/js/dashforge.filemgr.js') }}"></script>

        <script type="text/javascript">
            $('.selectsearch').select2({
                searchInputPlaceholder: 'Search options'
            });


            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict'
                var forms = document.querySelectorAll('.needs-validation')
                // Loop over them and prevent submission
                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
            })()
        </script>

        <script>
            //modal edit title ajax
            $(document).ready(function() {

                $('.result_edit_btn').on('click', function(e) {
                    e.preventDefault();
                    var images_id = $(this).data('id');
                    console.log(images_id);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "GET",

                        url: "{{ url('website-setting/media/view') }}/" + images_id,
                        data: {
                            images_id: images_id
                        },
                        dataType: "json",
                        success: function(response) {

                            $.each(response.media_list, function(key, value) {
                                //console.log(value);
                                $("#image_name").html(value.images_name);
                                $("#img_size").html(value.images_size);
                                $("#img_url").val(value.media_image);
                                $("#img_date").html(value.updated_at);
                            });

                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                });

                $(document).on("click", "#media_del_btn", function() {
                    var task_id = $(this).data('id');

                    $('#delete_task_id').val(task_id);
                    // $('#delete_modal1').modal('show');
                });

                $(document).on('click', '.img_delete_yes', function() {
                    var images_id = $('#delete_task_id').val();

                    // $('#task_delete').modal('hide');
                    // alert(task_id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('website-setting/media/delete') }}/" + images_id,
                        data: {
                            images_id: images_id,
                            //  _method: 'DELETE'
                        },
                        dataType: "json",
                        success: function(response) {
                            $('#media_delete').removeClass('show');
                            $('#media_delete').css('display', 'none');
                            Toaster(response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);
                            window.location.href = "{{ route('website-setting.media') }}";

                        }
                    });

                });



                // $('form').submit(function(e) {
                //     e.preventDefault();
                //     var data;

                //     data = new FormData();
                //  //   data.append( 'fileInfo', input.files[0] );

                //  data.append("fileInfo",$('input[name="fileInfo"]').files[0]);

                //  //   data.append('fileInfo', $('#file')[0].files[0]);

                //   alert(data);
                //     $.ajax({
                //         url: "{{ url('media/store') }}",
                //         data: data,
                //         processData: false,
                //         type: 'POST',
                //         success: function(data) {
                //             alert(data);
                //         }
                //     });


                // });



            });

            function myFunction() {
                var copyText = document.getElementById("img_url");

                // Select the text field
                copyText.select();
                copyText.setSelectionRange(0, 99999); // For mobile devices

                // Copy the text inside the text field
                navigator.clipboard.writeText(copyText.value);

                $(".message").text("link copied");
            }

            // function myFunction() {
            //     // Get the element by ID
            //     var imgUrlElement = document.getElementById("img_url");

            //     // Get the content of the element
            //     var copyText = imgUrlElement.innerText;

            //     console.log(copyText);
            //     // Create an input element
            //     var inputElement = document.createElement("input");

            //     // Set the input value to the content you want to copy
            //     inputElement.value = copyText;

            //     // Append the input element to the document
            //     document.body.appendChild(inputElement);

            //     // Select the text inside the input field
            //     inputElement.select();

            //     // Copy the text inside the input field
            //     document.execCommand("copy");

            //     // Remove the input element from the document
            //     document.body.removeChild(inputElement);

            //     // Update your message using jQuery
            //     $(".message").text("Link copied");
            // }
        </script>
    @endpush
</x-app-layout>
