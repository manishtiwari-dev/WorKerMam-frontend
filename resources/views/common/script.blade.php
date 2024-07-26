<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
{{-- <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="{{ asset('lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('lib/parsleyjs/parsley.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script src="{{ asset('lib/jqueryui/jquery-ui.min.js') }}"></script>
<script src="https://unpkg.com/feather-icons"></script>

<script src="{{ asset('asset/js/datepicker/tpicker.js') }}" defer></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>

   {{-- Pusher Notify --}}
<script src="//js.pusher.com/3.1/pusher.min.js" defer></script>

<script src="{{ asset('asset/js/custom.js') }}" defer></script>

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
