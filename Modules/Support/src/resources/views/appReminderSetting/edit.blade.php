<x-app-layout>
    @section('title', 'App Reminder')

    <div class="contact-content">
        <div class="layout-specing">
           
       
                <form action="{{ route('manage-landing.app-reminder.update', $data->id) }}" class="ajax-form needs-validation"
                    method="POST" id="userForm" novalidate>
                    @csrf
                    @method('PUT')
             
                <div class="card contact-content-body">
                    <div class="card-header">
                        <h6 class="tx-15 mg-b-0">Update</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                          

                            <div class="form-group  col-lg-4 col-sm-4">
                                <label class="form-label">Source<span
                                        class="text-danger mg-l-5">*</span></label>
                                <select class="form-control selectsearch @error('source') is-invalid @enderror "  id="source" name="source" >
                                <option value ="">Select</option>
                                    <option value ="1"    {{($data->source == 1) ? 'selected' : ''}}>
                                        Subscription
                                    </option>
                                    <option value="2"    {{($data->source == 1) ? 'selected' : ''}}>
                                        Payment/Invoice
                                    </option>
    
    
                                </select>
                                <div class="invalid-feedback">
                                  Please Select source
                                </div>
                            </div>


                            <div class="form-group col-lg-4 col-sm-4">
                                <label class="form-label">Interval
                                <span class="text-danger">*</span></label>
                                <input name="interval" type="number" class="form-control" placeholder="Intervel" value="{{$data->interval ?? ''}}" required>
                                <div class="invalid-feedback">
                                   Please Enter the interval
                                </div>
                                <span class="text-danger">
                                    @error('interval')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>



                            <div class="form-group col-lg-4 col-sm-4">
                                <label class="form-label">{{ __('newsletter.subject')}}
                                <span class="text-danger">*</span></label>
                                <input name="subject" type="text" class="form-control" placeholder="{{ __('newsletter.subject_placeholder')}}" value="{{$data->subject ?? ''}}" required>
                                <div class="invalid-feedback">
                                    {{ __('newsletter.subject_error')}}
                                </div>
                                <span class="text-danger">
                                    @error('subject')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>



                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label justify-content-between">{{ __('settings.templates_content')}}<span class="text-danger">*</span></label>
                                <textarea cols="40" rows="10" name="content" id="editor" class="form-control" required>
                                    {!! $data->content !!}
                                </textarea>
                                <div class="invalid-feedback">
                              Please enter Content
                                </div>
                                <span class="text-danger">
                                @error('content')
                                    {{ $message }}
                                @enderror
                                </span>
                            </div>
                        </div>



                        <div class="">
                            <div class="col-sm-12 mb-3 mx-3 p-0">
                                <input type="submit" id="submit" name="send" class="btn btn-primary"
                                    value="Submit">
                                <a href="{{ route('manage-landing.app-reminder.index') }}" class="btn btn-secondary mx-1">Cancel</a>
                            </div>
                        </div>


                        {{-- <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label justify-content-between">{{ __('settings.templates_content')}}<span class="text-danger">*</span> <a class="btn btn-primary" href="{{route('template.pro-editor')}}">Edit in pro-editor</a></label>
                                <textarea cols="40" rows="10" name="content" id="editor" class="form-control"></textarea>
                                <div class="invalid-feedback">
                                {{ __('settings.template_contect_error')}}
                                </div>
                                <span class="text-danger">
                                    @error('content')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div> --}}



                    


                        {{-- <div class="mt-3 d-flex justify-content-between">
                            <div class="col-lg-3 p-0">
                                <button type="submit" name="editor" class="btn btn-primary" value="pro">{{ __('common.edit_pro_editor')}}</button>
                            </div>
                            <div class="col-lg-3 p-0">
                                <button type="submit" name="editor" class="btn btn-primary" value="text">{{ __('common.edit_text_editor')}}</button>
                            </div>
                            <div class="col-lg-3 p-0">
                                <a class="btn btn-primary" href="{{route('marketing.template-list.index')}}" role="button">{{ __('common.cancel')}}</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
        
        @push('scripts')
        <script>

        $(document).ready(function() {
            $("form").submit(function() { 
                var val = $("input[type=submit][clicked=true]").val();
            });
        });

       
        </script>
        <script type="text/javascript" src="{{asset('assets/js/ckeditor.js')}}"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                 //ckeditor height code
                .then( editor => {
                    editor.editing.view.change( writer => {
                        writer.setStyle( 'height', '200px', editor.editing.view.document.getRoot() );
                    } );
                } )
                
                .catch(error => {
                    console.error(error);
                });
        </script>
        @endpush
</x-app-layout>