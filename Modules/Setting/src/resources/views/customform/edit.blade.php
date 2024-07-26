<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="d-md-flex justify-content-between align-items-center">
                <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card rounded shadow">
                        <form action="{{ route('custom-form.update', $custom_form->form_id) }}" method="post"
                            class="needs-validation" novalidate>
                            @csrf
                            @method('put')
                            <div class=" border-0 customer_form">
                                <div class="card-header bg-transparent px-4 py-2">
                                    <h4 class="mb-0">{{ __('settings.update_custom_form')}}</h4>
                                </div>
                                <div class="row g-3">
                                    <div class="col-sm-4">
                                        <label for="formName" class="form-label">{{ __('settings.form_name')}}</label>
                                        <input type="text" class="form-control" name="form_name" id="formName"
                                            placeholder="{{ __('settings.form_name_placeholder')}}" value="{{ $custom_form->form_name }}" required>
                                        <div class="invalid-feedback">
                                        {{ __('settings.form_name_error')}}
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="formshortcode" class="form-label">{{ __('settings.form_shortcode')}}</label>
                                        <input type="text" class="form-control" name="form_shortcode"
                                            id="formshortcode" placeholder="{{ __('settings.form_sortcode_placeholder')}}"
                                            value="{{ $custom_form->form_shortcode }}" required>
                                        <div class="invalid-feedback">
                                        {{ __('settings.form_sortcode_error')}}
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="country" class="form-label">{{ __('settings.form_type_select')}}</label>
                                        <select class="form-select form-control" name="form_type" id=""
                                            required>
                                            <option value="{{ $custom_form->form_type }}">{{ __('settings.form_type_select')}}</option>
                                            <option value="1"
                                                {{ $custom_form->form_type == '1' ? 'selected' : '' }}>
                                                Enquiry</option>
                                            <option value="2"
                                                {{ $custom_form->form_type == '2' ? 'selected' : '' }}>Lead
                                            </option>
                                            <option value="3"
                                                {{ $custom_form->form_type == '3' ? 'selected' : '' }}>
                                                Quotation</option>
                                            <option value="4"
                                                {{ $custom_form->form_type == '4' ? 'selected' : '' }}>
                                                Ticket</option>
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
                                            id="Street Address" placeholder="{{ __('settings.field_label_placeholder')}}"
                                            value="{{($custom_form->customformfield->field_label)}}" required>
                                        <div class="invalid-feedback">
                                        {{ __('settings.field_label_error')}}
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        <select class="form-select form-control" name="field_type[]" id=""
                                            required>
                                            <option value="{{ !empty($custom_form->customformfield->field_type) }}">
                                            {{ __('settings.field_type_select')}} </option>
                                            <option value="text"
                                                @if (!empty($custom_form->customformfield)) {{ $custom_form->customformfield->field_type == 'text' ? 'selected' : '' }} @endif>
                                                Text</option>
                                            <option value="checkbox"
                                                @if (!empty($custom_form->customformfield)) {{ $custom_form->customformfield->field_type == 'checkbox' ? 'selected' : '' }} @endif>
                                                Checkbox</option>
                                            <option value="dropdown"
                                                @if (!empty($custom_form->customformfield)) {{ $custom_form->customformfield->field_type == 'dropdown' ? 'selected' : '' }} @endif>
                                                Dropdown</option>
                                            <option value="radio"
                                                @if (!empty($custom_form->customformfield)) {{ $custom_form->customformfield->field_type == 'radio' ? 'selected' : '' }} @endif>
                                                Radio</option>
                                            <option value="email"
                                                @if (!empty($custom_form->customformfield)) {{ $custom_form->customformfield->field_type == 'email' ? 'selected' : '' }} @endif>
                                                Email</option>
                                            <option value="textarea"
                                                @if (!empty($custom_form->customformfield)) {{ $custom_form->customformfield->field_type == 'textarea' ? 'selected' : '' }} @endif>
                                                Textarea</option>
                                        </select>
                                        <div class="invalid-feedback">
                                        {{ __('settings.field_type_selected')}} 
                                        </div>
                                    </div>
                                    {{-- @dd($custom_form->customformfield->field_class); --}}
                                    <div class="col-lg-2 col-sm-12">
                                        <input type="text" class="form-control" name="field_class[]" id="fieldclass"
                                            placeholder="{{ __('settings.field_class_placeholder')}}"
                                            value="@if(!empty($custom_form->customformfield->field_class)){{($custom_form->customformfield->field_class)}}" required @endif>
                                        <div class="invalid-feedback">
                                        {{ __('settings.field_class_error')}}
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-sm-12">
                                        <input type="number" class="form-control" name="sort_order[]" id="shortorder"
                                            placeholder="{{ __('settings.sort_order_placeholder')}}"
                                            value="{{($custom_form->customformfield->sort_order)}}" required>
                                        <div class="invalid-feedback">
                                        {{ __('settings.sort_order_error')}}
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        <select class="form-select form-control" name="required[]" id=""
                                            required>
                                            <option
                                                value="@if (!empty($custom_form->customformfield)) {{ $custom_form->customformfield->required }} @endif">
                                                Required</option>
                                            <option value="1"
                                                @if (!empty($custom_form->customformfield)) {{ $custom_form->customformfield->required == '1' ? 'selected' : '' }} @endif>
                                                Yes</option>
                                            <option value="0"
                                                @if (!empty($custom_form->customformfield)) {{ $custom_form->customformfield->required == '0' ? 'selected' : '' }} @endif>
                                                No</option>
                                        </select>
                                        <div class="invalid-feedback">
                                        {{ __('settings.required_select')}}
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        <button class="w-10 btn btn-primary right" id="addbuttom" type="button"> {{ __('settings.add_more_field')}}
                                        </button>
                        
                                    </div>
                                    <div class="col-lg-1 col-sm-12 ">
                                    </div>
                                </div>
                                <!-- add more update -->
                                @php
                                    $cols = 0;
                                @endphp
                                @if (!empty($custom_form_field))
                                    @foreach ($custom_form_field as $custom_form)
                                        @php
                                            $cols++;
                                            if ($cols == 1) {
                                                continue;
                                            }
                                        @endphp

                                        <div class="row g-2 mt-1">
                                            <div class="col-lg-2 col-sm-12">
                                                <input type="text" class="form-control" id="Street Address"
                                                    name="field_label[]" placeholder="{{ __('settings.field_label_placeholder')}}"
                                                    value="{{ $custom_form->field_label }}" required="">
                                                <div class="invalid-feedback">
                                                {{ __('settings.field_label_error')}}
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-12">

                                                <select class="form-select form-control" id="selectfield"
                                                    name="field_type[]" required="">
                                                    <option value="{{ $custom_form->field_type }}">{{ __('settings.field_type_select')}}
                                                    </option>
                                                    <option value="text"
                                                        {{ $custom_form->field_type == 'text' ? 'selected' : '' }}>
                                                        Text</option>
                                                    <option value="checkbox"
                                                        {{ $custom_form->field_type == 'checkbox' ? 'selected' : '' }}>
                                                        Checkbox</option>
                                                    <option value="dropdown"
                                                        {{ $custom_form->field_type == 'dropdown' ? 'selected' : '' }}>
                                                        Dropdown</option>
                                                    <option value="radio"
                                                        {{ $custom_form->field_type == 'radio' ? 'selected' : '' }}>
                                                        Radio</option>
                                                    <option value="email"
                                                        {{ $custom_form->field_type == 'email' ? 'selected' : '' }}>
                                                        Email</option>
                                                    <option value="textarea"
                                                        {{ $custom_form->field_type == 'textarea' ? 'selected' : '' }}>
                                                        Textarea</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                {{ __('settings.field_type_select')}}
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-12">
                                                <input type="text" class="form-control" id="fieldclass"
                                                    name="field_class[]" placeholder="{{ __('settings.field_class_placeholder')}}"
                                                    value="{{ $custom_form->field_class }}" required="">
                                                <div class="invalid-feedback">
                                                {{ __('settings.field_class_error')}}
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-sm-12">
                                                <input type="number" class="form-control" id="shortorder"
                                                    name="sort_order[]" placeholder="{{ __('settings.sort_order_placeholder')}}"
                                                    value="{{ $custom_form->sort_order }}" required="">
                                                <div class="invalid-feedback">
                                                {{ __('settings.sort_order_error')}}
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-12">
                                                <select class="form-select form-control" id="selectfield"
                                                    name="required[]" required="">
                                                    <option value="{{ $custom_form->required }}">REQUIRED</option>
                                                    <option value="1"
                                                        {{ $custom_form->required == '1' ? 'selected' : '' }}>Yes
                                                    </option>
                                                    <option value="0"
                                                        {{ $custom_form->required == '0' ? 'selected' : '' }}>No
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback">
                                                {{ __('settings.required_select')}}
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-sm-12 mb-3 pt-2 remove" style="margin-top:auto;margin-bottom:20px" >
                                                <div class="btn_remove" >X</div>
                                        </div>
                                    @endforeach
                                @endif
                                <!-- add more update closed -->
                            </div>
                            <div class="d-grid gap-2 col-3 mx-4" id="button">
                                <button class="btn btn-primary" type="Submit">{{ __('common.update')}}</button>
                            </div>
                    </div>
                    </form>
                </div><!--end col-->
                
            </div><!--end row-->     
        </div>
    </div>  <!--end container-->
  

    <!-- this is use toggle button -->
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                // e.preventDefault();
                $("#addbuttom").on("click", function() {

                    $("#add").append(`
                        <div class="row g-2 mt-1">
                        <div class="col-lg-2 col-sm-12">
                        
                        <input type="text" class="form-control"
                        id="Street Address" name="field_label[]" placeholder="{{ __('settings.field_label_placeholder')}}" value="" required="">
                        <div class="invalid-feedback">
                        {{ __('settings.field_label_error')}}.
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
                        <div class="col-lg-1 col-sm-12 mb-3 pt-2 remove" style="margin-top:auto;margin-bottom:20px" >
                         <div class="btn_remove" >X</div>
                        </div>
                        </div> `);

                });
            });
            $(document).on('click', '.remove', function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
            });
        </script>
    @endpush

</x-app-layout>
