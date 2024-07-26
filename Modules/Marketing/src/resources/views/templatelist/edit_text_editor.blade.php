<x-app-layout>
    @section('title', 'Template List')

    <div class="contact-content">
        <div class="layout-specing">
            
            <form action="{{ route('marketing.pro.template.builder.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <input type="hidden" name="id" value="{{ $data->id }}">
                <input type="hidden" name="editor_type" value="1">
                
                <div class="card contact-content-body">
                    <div class="card-header">
                        <h6 class="tx-15 mg-b-0">{{__('settings.edit_template')}}</h6>
                    </div>
                    <div class="card-body">
                        
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label justify-content-between" for="subject">{{ __('settings.templates_subject')}}<span class="text-danger">*</span></label>
                                
                                <input type="text" class="form-control" name="subject" id="subject" value="{{ $data->subject }}"  placeholder="{{ __('newsletter.subject_placeholder')}}">
                                
                                <div class="invalid-feedback">
                                {{ __('settings.template_subject_error')}}
                                </div>
                                <span class="text-danger">
                                @error('content')
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
                                {{ __('settings.template_contect_error')}}
                                </div>
                                <span class="text-danger">
                                @error('content')
                                    {{ $message }}
                                @enderror
                                </span>
                            </div>
                        </div>

                        <div class="mt-3 d-flex">
                            <div class="col-lg-1 p-0">
                                <button type="submit" class="btn btn-primary" value="text">{{ __('common.submit')}}</button>
                            </div>

                             <div class="col-lg-1 p-0">
                                <button type="submit" class="btn btn-secondary" onclick="history.back()" value="text">{{ __('common.cancel')}}</button>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
        
        @push('scripts')
        <script type="text/javascript" src="{{asset('assets/js/ckeditor.js')}}"></script>
        <script>

        $(document).ready(function() {
            $("form").submit(function() { 
                var val = $("input[type=submit][clicked=true]").val();
            });
        });

        ClassicEditor.create(document.querySelector('#editor'))
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