<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('lib/parsleyjs/parsley.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="{{ asset('asset/js/dashforge.js') }}"></script>
<script src="{{ asset('asset/js/dashforge.aside.js') }}"></script>
<script src="{{ asset('lib/jqueryui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('asset/js/datepicker/tpicker.js') }}"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

{{-- <script src="{{ asset('lib/jquery.flot/jquery.flot.js') }}"></script>
<script src="{{ asset('lib/jquery.flot/jquery.flot.stack.js') }}"></script>
<script src="{{ asset('lib/jquery.flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('lib/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('lib/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('lib/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
{{-- <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script> --}}
{{-- <script src="{{ asset('asset/js/dashforge.sampledata.js') }}"></script> --}}


{{-- <link rel="stylesheet" href="{{ asset('asset/css/sweetalert.min.js') }}"> --}}

{{-- <!-- append theme customizer -->
<script src="{{ asset('lib/js-cookie/js.cookie.js') }}"></script>
<script src="{{ asset('asset/js/dashforge.settings.js') }}"></script> --}}

{{-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> --}}
<!-- Select2 JS -->




{{-- toaster massage validation  --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
    integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
{{-- toaster massage closed --}}


{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script> --}}

<script src="{{ asset('asset/js/custom.js') }}"></script>

<script>
    $(document).ready(function() {
        @if (Session::has('success'))
            Toaster('success', '{{ Session::get('success') }}');
        @endif
        @if (Session::has('error'))
            Toaster('error', '{{ Session::get('error') }}');
        @endif
        let errorContent = '';
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                errorContent += '{{ $error }}';
            @endforeach

            Toaster('error', errorContent);
        @endif
    });
</script>


