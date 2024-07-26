@php
    
    $api_token = App\Helper\Helper::getCurrentuserToken();
    $userdata = Cache::get('userdata-' . $api_token);
    
@endphp
<style>
    .skillselect .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        background: transparent;
        border: 0;
        opacity: 1;
        left: 0;
    }
</style>
<x-app-layout>
    @section('title', 'Attendence')

    <div class="contact-content">
        <div class="layout-specing">

            <div class="card contact-content-body">
                <form action="" id="userForm" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="card-header d-flex align-items-center justify-content-between py-2 px-3">
                        <h6 class="tx-15 mg-b-0">FeedBack</h6>

                    </div>
                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">Customer<span class="text-danger mg-l-5">*</span></label>
                                    <select
                                        class="form-control department @error('leave_type_id') is-invalid @enderror "
                                        id="leave_type_id" name="" required>
                                        <option selected disable value="" disabled>
                                            Please Customer Select</option>

                                        <option value="">
                                        </option>

                                    </select>

                                    <div class="invalid-feedback">

                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <div class="form-icon position-relative">

                                        <textarea name="website_url" rows="2" class="form-control"></textarea>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="">
                        <div class="col-sm-12 mb-3 mx-3 p-0">
                            <input type="submit" id="submit" name="send" class="btn btn-primary" value="Submit">
                            <a href="" class="btn btn-secondary mx-1">Cancel</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(function() {
                $('.datepicker1').datepicker({
                    multidate: true,
                    format: 'dd/mm/yy',
                    onSelect: function() {
                        var selected = $(this).datepicker("getDate");
                    }


                });

            });


            $(document).ready(function() {
                $("#months").click(function(event) {
                    $("#select_date").hide();
                    $(".year").show();
                    $(".month").show();

                });
            });
            //select date
            $(document).ready(function() {
                $("#date_select").click(function(event) {

                    $(".year").hide();
                    $(".month").hide();
                    $("#select_date").show();

                });
            });
        </script>

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

     
    @endpush
</x-app-layout>
