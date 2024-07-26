<x-app-layout>
    @section('title', 'Template List')

    <div class="contact-content">
        <div class="layout-specing">
        
            <form action="{{ route('marketing.pro.template.builder.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <input type="hidden" name="id" value="{{ $data->id }}">
                <input type="hidden" name="subject" value="{{ $data->subject }}">
                <input type="hidden" name="editor_type" value="1">
                
                <div class="card contact-content-body">
                    <div class="card-header">
                        <h6 class="tx-15 mg-b-0">{{__('newsletter.add_template_group')}}</h6>
                    </div>
                    <div class="card-body">
                        
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label justify-content-between">{{ __('settings.templates_content')}}<span class="text-danger">*</span></label>
                                <textarea cols="40" rows="10" name="content" id="editor" class="form-control" required></textarea>
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

                        <div class="mt-3 d-flex justify-content-between">
                            <div class="col-lg-1 p-0">
                                <button type="submit" class="btn btn-primary" value="text">{{ __('common.submit')}}</button>
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