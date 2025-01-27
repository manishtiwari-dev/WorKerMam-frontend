<html>

<head>
    <title>Pro Email Editor</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('asset/pro-editor/assets/css/demo.css?v=2') }}" rel="stylesheet" />
    <link href="{{ asset('asset/pro-editor/assets/css/email-editor.bundle.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset/pro-editor/assets/css/colorpicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset/pro-editor/assets/css/editor-color.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset/pro-editor/assets/css/style.css') }}" rel="stylesheet" />
    <!--for bootstrap-tour  -->
    <link rel="stylesheet"
        href="{{ asset('asset/pro-editor/assets/vendor/bootstrap-tour/build/css/bootstrap-tour.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/pro-editor/assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">

    <style media="screen">
        #global-loader {
            position: fixed;
            z-index: 50000;
            background: url('{{ asset('asset/giphy.gif') }}') no-repeat 50% 50% rgba(255, 255, 255);
            background-repeat: no-repeat;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            margin: 0 auto;
            z-index: 999999;
        }
    </style>

</head>



<body>

    <div id="global-loader"></div>
    <div class="bal-header">
        <div class="pro-name">
            {{-- <a href="{{url('/')}}">
                <img alt="logo" class="pro-logo" src="{{asset('assets/images/workerman.png')}}" height="75px" width="100px">
            </a> --}}
        </div>

        <div class="bal-user-info">

            <div class="bal-user-name">
                {{ $data->subject ?? 'Pro Email Bulder' }}
            </div>

            <div class="bal-header-controls">
                <a id="bal-button-exit" class="bal-button-exit" href="{{ route('marketing.template-list.index') }}">Back</a>
            </div>
        </div>
    </div>
    {{-- editot start --}}
    <div class="bal-editor-demo 
    @switch(env("EDITOR_STYLE"))
    @case('1') 
    style-1
    @break 
    @case('2') 
    style-2
    @break 
    @case('3') 
    style-3
    @break 
    @default
    style
    @break
    @endswitch
    ">
    </div>
    {{-- editor end --}}
    <div id="previewModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    <h4 class="modal-title">Preview</h4>
                </div>
                <div class="modal-body">
                    <div class="">
                        <label for="">URL : </label> <span class="preview_url"></span>
                    </div>
                    <iframe id="previewModalFrame" width="100%" height="400px"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <script src="{{ asset('asset/pro-editor/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/pro-editor/assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('asset/pro-editor/assets/vendor/jquery-nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!--for ace editor  -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/ace/1.1.01/ace.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ace/1.1.01/theme-monokai.js" type="text/javascript"></script>

    <!--for tinymce  -->

    <script src="{{ asset('asset/pro-editor/assets/vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>

    <script src="{{ asset('asset/pro-editor/assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>

    <script src="{{ asset('asset/pro-editor/assets/js/colorpicker.js') }}"></script>
    <script src="{{ asset('asset/pro-editor/assets/js/bal-email-editor-plugin.js?v=23') }}"></script>

    <!--for bootstrap-tour  -->
    <script src="{{ asset('asset/pro-editor/assets/vendor/bootstrap-tour/build/js/bootstrap-tour.min.js') }}"></script>

    <script>
        $(window).on("load", function(e) {
            setTimeout(function() {
                $("#global-loader").fadeOut("fast");
            }, 4000)
        });

        var _is_demo = false;

        function loadImages() {
            $.ajax({
                url: '{{ route('marketing.pro.template.builder.get.image') }}',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.code == 0) {
                        _output = '';
                        for (var k in data.files) {
                            if (typeof data.files[k] !== 'function') {
                                _output += "<div class='col-sm-3'>" +
                                    "<img class='upload-image-item' src='" + data.directory +'/'+data.files[k] +
                                    "' alt='" + data.files[k] + "' data-url='" + data.directory + data.files[
                                    k] + "'>" +
                                    "</div>";
                            }
                        }
                        $('.upload-images').html(_output);
                    }
                },
                error: function() {}
            });
        }

        var _templateListItems;
        var _templateListItems;

        var _emailBuilder = $('.bal-editor-demo').emailBuilder({
            // new features begin
            showMobileView: true,
            onTemplateDeleteButtonClick: function(e, dataId, parent) {},
            // new features end

            lang: 'en',
            elementJsonUrl: "{{ asset('asset/pro-editor/elements-1.json') }}",
            langJsonUrl: "{{ asset('asset/pro-editor/lang-1.json') }}",
            loading_color1: 'red',
            loading_color2: 'green',
            showLoading: false,

            blankPageHtmlUrl: "{{ asset('asset/pro-editor/templates/template-blank-page.html') }}",
            loadPageHtmlUrl: "{{ asset('asset/pro-editor/templates/template-load-page.html') }}",
            // loadPageHtmlUrl: "{{ asset('pro-editor/templates/saved/21.html') }}",

            //left menu
            showElementsTab: true,
            showPropertyTab: true,
            showCollapseMenu: true,
            showBlankPageButton: true,
            showCollapseMenuinBottom: true,

            //setting items
            showSettingsBar: true,
            showSettingsPreview: false,
            showSettingsExport: true,
            showSettingsSendMail: false,
            showSettingsSave: false,
            showSettingsLoadTemplate: false,

            //show context menu
            showContextMenu: true,
            showContextMenu_FontFamily: true,
            showContextMenu_FontSize: true,
            showContextMenu_Bold: true,
            showContextMenu_Italic: true,
            showContextMenu_Underline: true,
            showContextMenu_Strikethrough: true,
            showContextMenu_Hyperlink: true,

            //show or hide elements actions
            showRowMoveButton: true,
            showRowRemoveButton: true,
            showRowDuplicateButton: true,
            showRowCodeEditorButton: true,
            onElementDragStart: function(e) {
                // console.log('onElementDragStart html');
            },
            onElementDragFinished: function(e, contentHtml) {
                // console.log('onElementDragFinished html');
                //console.log(contentHtml);

            },

            onBeforeRowRemoveButtonClick: function(e) {
                // console.log('onBeforeRemoveButtonClick html');

                /*
                  if you want do not work code in plugin ,
                  you must use e.preventDefault();
                */
                //e.preventDefault();
            },
            onAfterRowRemoveButtonClick: function(e) {
                // console.log('onAfterRemoveButtonClick html');
            },
            onBeforeRowDuplicateButtonClick: function(e) {
                // console.log('onBeforeRowDuplicateButtonClick html');
                //e.preventDefault();
            },
            onAfterRowDuplicateButtonClick: function(e) {
                // console.log('onAfterRowDuplicateButtonClick html');
            },
            onBeforeRowEditorButtonClick: function(e) {
                // console.log('onBeforeRowEditorButtonClick html');
                //e.preventDefault();
            },
            onAfterRowEditorButtonClick: function(e) {
                // console.log('onAfterRowDuplicateButtonClick html');
            },
            onBeforeShowingEditorPopup: function(e) {
                // console.log('onBeforeShowingEditorPopup html');
                //e.preventDefault();
            },
            onBeforeSettingsSaveButtonClick: function(e) {
                // console.log('onBeforeSaveButtonClick html');
                //e.preventDefault();
            },
            onPopupUploadImageButtonClick: function() {
                // console.log('onPopupUploadImageButtonClick html');

                // TODO:IMAGE UPLOAD
                var fd = new FormData();
                var files = $('.input-file')[0].files;

                // Check file selected or not
                if (files.length > 0) {
                    fd.append('file', files[0]);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('marketing.pro.template.builder.image_upload') }}",
                        type: 'post',
                        data: fd,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            loadImages();
                        },
                    });

                } else {
                    alert("Please select a file.");
                }

            },
            onSettingsPreviewButtonClick: function(e, getHtml) {
                // console.log('onPreviewButtonClick html');
                //e.preventDefault();
            },

            onSettingsExportButtonClick: function(e, getHtml) {
                // console.log('onSettingsExportButtonClick html');
                // console.log(getHtml);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('marketing.pro.template.builder.store') }}',
                    data: {
                        content: getHtml,
                        id: {{ $data->id }},
                        subject:"{{ $data->subject }}",
                        editor_type:2,
                    },
                    success: function(data) {
                        swal({
                            title: '{{ $data->subject }} saved',
                            text: "Your email template is saved successfully",
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Okay',
                        });

                        window.location.href = "{{route('marketing.template-list.index')}}";
                    }
                });
                //e.preventDefault();
            },
            onBeforeSettingsLoadTemplateButtonClick: function(e) {

                $('.template-list').html('<div style="text-align:center">Loading...</div>');
            },
            onSettingsSendMailButtonClick: function(e) {
                // console.log('onSettingsSendMailButtonClick html');
                //e.preventDefault();
            },
            onPopupSendMailButtonClick: function(e, _html) {
                // console.log('onPopupSendMailButtonClick html');
                _email = $('.recipient-email').val();
                _element = $('.btn-send-email-template');

                output = $('.popup_send_email_output');
                var file_data = $('#send_attachments').prop('files');
                var form_data = new FormData();
                //form_data.append('attachments', file_data);
                $.each(file_data, function(i, file) {
                    form_data.append('attachments[' + i + ']', file);
                });
                form_data.append('html', _html);
                form_data.append('mail', _email);
            },
            onBeforeChangeImageClick: function(e) {
                // console.log('onBeforeChangeImageClick html');
                loadImages();
            },
            onBeforePopupSelectTemplateButtonClick: function(e) {
                // console.log('onBeforePopupSelectTemplateButtonClick html');

            },
            onBeforePopupSelectImageButtonClick: function(e) {
                // console.log('onBeforePopupSelectImageButtonClick html');

            },
            onPopupSaveButtonClick: function() {
                // console.log('onPopupSaveButtonClick html');
            },
            onUpdateButtonClick: function() {
                // console.log('onUpdateButtonClick html');

            }

        });

        _emailBuilder.setAfterLoad(function(e) {
            _emailBuilder.makeSortable();

            setTimeout(function() {
                _emailBuilder.makeSortable();
                _emailBuilder.makeRowElements();
            }, 1000);

        });
    </script>

</body>

</html>
