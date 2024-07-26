<x-app-layout>
    @section('title', 'Template List')

    <div class="contact-content">
        <div class="layout-specing">
           
            <form action="{{ route('marketing.template-list.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="card contact-content-body">
                    <div class="card-header">
                        <h6 class="tx-15 mg-b-0">{{__('newsletter.add_template_list')}}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-lg-12 col-sm-12">
                                <label class="form-label">{{ __('newsletter.subject')}}
                                <span class="text-danger">*</span></label>
                                <input name="subject" type="text" class="form-control" placeholder="{{ __('newsletter.subject_placeholder')}}" required>
                                <div class="invalid-feedback">
                                    {{ __('newsletter.subject_error')}}
                                </div>
                                <span class="text-danger">
                                    @error('subject')
                                    {{ $message }}
                                    @enderror
                                </span>
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
                        <div class=" d-md-flex gap-3 ">
                            <div class="d-flex gap-3">
                                <div class="mb-2 mb-md-0">
                                    <button type="submit" name="editor" class="btn btn-primary" value="pro">{{ __('common.edit_pro_editor')}}</button>
                                </div>
                                <div class="mb-2 mb-md-0">
                                    <button type="submit" name="editor" class="btn btn-primary" value="text">{{ __('common.edit_text_editor')}}</button>
                                </div>
                            </div>
                            <div class="mb-2 mb-md-0">
                                <a class="btn btn-primary" href="{{route('marketing.template-list.index')}}" role="button">{{ __('common.cancel')}}</a>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
        
        @push('scripts')
        {{-- <script type="text/javascript" src="{{asset('assets/js/ckeditor.js')}}"></script> --}}
        <script>

        $(document).ready(function() {
            $("form").submit(function() { 
                var val = $("input[type=submit][clicked=true]").val();
            });
        });

        // ClassicEditor.create(document.querySelector('#editor'))
        //     //ckeditor height code
        //     .then( editor => {
        //         editor.editing.view.change( writer => {
        //             writer.setStyle( 'height', '200px', editor.editing.view.document.getRoot() );
        //         } );
        //     } )
        //     .catch(error => {
        //         console.error(error);
        //     });
        </script>
        @endpush
</x-app-layout>