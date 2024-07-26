<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card rounded shadow">
                        <form action="{{ route('custom-form.store') }}" method="post" class="needs-validation"
                            novalidate>
                            @csrf
                            <div class="card-header bg-transparent px-4 py-2">
                                    <h4 class="mb-0">{{ __('settings.add_custom_form')}}</h4>
                            </div>
                            <div class=" border-0 customer_form">
                                <div class="row g-3">
                                    <div class="col-sm-4">
                                        <label for="formName" class="form-label">{{ __('settings.form_name')}}</label>
                                        <input type="text" class="form-control" name="form_name" id="formName"
                                            placeholder="{{ __('settings.form_name_placeholder')}}" value="" required>
                                        <div class="invalid-feedback">
                                        {{ __('settings.form_name_error')}}
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="formshortcode" class="form-label">{{ __('settings.form_shortcode')}}</label>
                                        <input type="text" class="form-control" name="form_shortcode"
                                            id="formshortcode" placeholder="{{ __('settings.form_sortcode_placeholder')}}" value="" required>
                                        <div class="invalid-feedback">
                                        {{ __('settings.form_sortcode_error')}}
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="country" class="form-label">{{ __('settings.form_type_select')}}</label>
                                        <select class="form-select form-control" name="form_type" id=""
                                            required>
                                            <option value="">{{ __('settings.form_type_select')}} </option>
                                            <option value="1">Enquiry</option>
                                            <option value="2">Lead</option>
                                            <option value="3">Quotation</option>
                                            <option value="4">Ticket</option>
                                        </select>
                                        <div class="invalid-feedback">
                                        {{ __('settings.form_type_select')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" border rounded customer_form mx-4 mb-5 mt-4">
                                <div class="card-header bg-transparent px-4 py-2 d-flex justify-content-between">
                                    <h4 class="mb-0">{{ __('settings.form_field')}}</h4>
                                </div>
                                <div class="row g-3 mt-2" id="add">
                                    <div class="col-lg-2 col-sm-12">
                                        <input type="text" class="form-control" name="field_label[]"
                                            id="Street Address" placeholder="{{ __('settings.field_label_placeholder')}}" value="" required>
                                        <div class="invalid-feedback">
                                        {{ __('settings.field_label_error')}}
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        <select class="form-select form-control" name="field_type[]" id=""
                                            required>
                                            <option value=""> {{ __('settings.field_type_select')}}</option>
                                            <option value="text">Text</option>
                                            <option value="checkbox">Checkbox</option>
                                            <option value="dropdown">Dropdown</option>
                                            <option value="radio">Radio</option>
                                            <option value="email">Email</option>
                                            <option value="textarea">Textarea</option>
                                        </select>
                                        <div class="invalid-feedback">
                                        {{ __('settings.field_type_selected')}}
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        <input type="text" class="form-control" name="field_class[]" id="fieldclass"
                                            placeholder="{{ __('settings.field_class_placeholder')}}" value="" required>
                                        <div class="invalid-feedback">
                                        {{ __('settings.field_class_error')}}
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-sm-12">
                                        <input type="number" class="form-control" name="sort_order[]" id="shortorder"
                                            placeholder="{{ __('settings.sort_order_placeholder')}}" value="" required>
                                        <div class="invalid-feedback">
                                        {{ __('settings.sort_order_error')}}
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        <select class="form-select form-control" name="required[]" id=""
                                            required>
                                            <option value="">Required</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        <div class="invalid-feedback">
                                        {{ __('settings.required_select')}}
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        <button class="w-10 btn btn-primary right " id="addbuttom" type="button">{{ __('settings.add_more_field')}} </button>
                                        
                                           
                                    </div>
                                    <div class="col-lg-1 col-sm-12 ">
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2 col-3 mx-4" id="button">
                                <button class="btn btn-primary" type="Submit"> {{ __('common.submit')}}</button>
                            </div>
                    </div>
                    </form>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div>
    </div>
    <!--end container-->

    <!-- this is use toggle button -->
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {

                $("#addbuttom").on("click", function() {

                    $("#add").append(`
                        <div class="row g-2 mt-1">
                                            <div class="col-lg-2 col-sm-12">
                                              
                                                <input type="text" class="form-control"
                                                id="Street Address" name="field_label[]" placeholder="{{ __('settings.field_label_placeholder')}}" value="" required="">
                                                <div class="invalid-feedback">
                                                {{ __('settings.field_label_error')}}
                                                 </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-12">
                                               
                                                <select class="form-select form-control" id="selectfield" name="field_type[]"required="">
                                                    <option value="">{{ __('settings.field_type_select')}}</option>
                                                    <option value="text">Text</option>
                                                    <option value="checkbox">Checkbox</option>
                                                    <option value="dropdown">Dropdown</option>
                                                    <option value="radio">Radio</option>
                                                    <option value="email">Email</option>
                                                    <option value="textarea">Textarea</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                {{ __('settings.field_type_selected')}}
                                                 </div>

                                            </div>
                                            
        
                                            <div class="col-lg-2 col-sm-12">
                                               
                                                <input type="text" class="form-control" id="fieldclass" name="field_class[]" placeholder="{{ __('settings.field_class_placeholder')}}" value="" required="">
                                                <div class="invalid-feedback">
                                                {{ __('settings.field_class_error')}} 
                                                 </div>
                                                
                                            </div>
                                            <div class="col-lg-1 col-sm-12">
                                               
                                                <input type="number" class="form-control" id="shortorder"  name="sort_order[]"placeholder="{{ __('settings.form_sortcode_placeholder')}}" value="" required="">
                                                <div class="invalid-feedback">
                                                {{ __('settings.form_sortcode_error')}}
                                                 </div>
                                                
                                            </div>
                                            <div class="col-lg-2 col-sm-12">
                                                <select class="form-select form-control" id="selectfield" name="required[]" required="">
                                                  <option value="">REQUIRED</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                {{ __('settings.required_select')}}
                                                 </div>
                                                
                                                
                                            </div>
                                            <div class="col-lg-1 col-sm-12 pt-2 remove" style="margin-top:auto;margin-bottom:20px" >
                                                    <div class="btn_remove" >X</div>
                                            </div>
                                            
                                           
                                        </div>

                                            `);

                });
            });
            $(document).on('click', '.remove', function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
            });
        </script>
    @endpush
</x-app-layout>
