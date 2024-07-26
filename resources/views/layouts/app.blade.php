<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title class="noprint"> @yield('title') | {{ config('app.name', 'WorkerMan') }}</title>
    @include('common.headerlink')
</head>

<body>



    <aside class="aside aside-fixed noprint">
        @include('common.sidebar')
    </aside>
    <div class="content ht-100v pd-0">
        <div class="content-header noprint">

            @include('common.topnav')
        </div>
        <div class="content-body ">

            {{ $slot }}
        </div>

        
        <x-modal />
        @include('common.footer')
        @include('common.script')
        @stack('scripts')

    </div>
    <script>
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
        $.ajaxModal = function(selector, url, onLoad) {

            $(selector).removeData('bs.modal').modal({
                show: true
            });
            $(selector + ' .modal-content').removeData('bs.modal').load(url);

            // Trigger to do stuff with form loaded in modal
            $(document).trigger("ajaxPageLoad");

            // Call onload method if it was passed in function call
            if (typeof onLoad != "undefined") {
                onLoad();
            }

            // Reset modal when it hides
            $(selector).on('hidden.bs.modal', function() {
                $(this).find('.modal-body').html('Loading...');
                $(this).find('.modal-footer').html(
                    '<button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancel</button>'
                );
                $(this).data('bs.modal', null);
            });
        };
    </script>
</body>

</html>
