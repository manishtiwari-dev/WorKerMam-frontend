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
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0">
                    <li class="breadcrumb-item"><a href="{{ url('hrm/attendance') }}">{{ __('hrm.attendence') }}</a></li>
                </ol>
            </nav>
            <div class="card contact-content-body">
                <form action="" id="userForm" method="POST" class="needs-validation" enctype="multipart/form-data"
                    novalidate>
                    @csrf
                    <div class="card-header d-flex align-items-center justify-content-between py-2 px-3">
                        <h6 class="tx-15 mg-b-0">{{ __('hrm.mark_attendence') }}</h6>

                    </div>
                    <div class="card-body">
                        <div data-label="Example" class="df-example demo-forms">
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label class="form-label">Time<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="text" id="check_in" name="clock_in_time"
                                            class="form-control @error('check_in') is-invalid @enderror"
                                            placeholder="{{ __('campaign.chose_from_time') }}"
                                            aria-label="Recipient's username" aria-describedby="basic-addon2"
                                            required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary"
                                                onclick="showpickers('check_in',24)" type="button"><i
                                                    class="fa fa-clock-o"></i></button>
                                        </div>
                                    </div>
                                    <div class="timepicker"></div>
                                    <span class="text-danger">
                                        @error('check_in')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        {{ __('campaign.from_time_error') }}
                                    </div>
                                </div>
                              
                                <div class="form-group col-md-6">
                                    <label class="form-label">Predefined<span class="text-danger mg-l-5">*</span></label>
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

                             
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <div class="form-icon position-relative">
                                        <input class="form-control" type="text" placeholder="Event" name="website_url"
                                            value="">
                                          
                                        @error('website_url')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group col-md-6">
                                    <label class="form-label">Attachment</label></br />
                                    {{-- <input type="file" name="image" /> --}}
                                    <input class="select-file" accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xls,.xlsx,.rtf"
                                        type="file" name="image">
                                    <img src="" alt="tag" height="150px;">
                                </div>
                             
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <div class="form-icon position-relative">
                                        <input class="form-control" type="text" placeholder="Message" name="website_url"
                                            value="">
                                          
                                        @error('website_url')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                               
                             
                            </div>
                        </div>

                    </div>
                    <div class="">
                        <div class="col-sm-12 mb-3 mx-3 p-0">
                            <input type="submit" id="submit" name="send" class="btn btn-primary"
                                value="Submit">
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
