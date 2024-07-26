<x-app-layout>
    @section('title', 'Template List')

<div class="contact-content">
    <div class="layout-specing">
        <form action="{{ url('marketing/template-list-update/'.$data->id) }}" method="POST" class="needs-validation" novalidate> 
            @csrf
            <div class="card contact-content-body">
                <div class="card-header">  
                    <h6 class="tx-15 mg-b-0">{{__('newsletter.update_data_list')}}</h6>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-lg-12 col-sm-12">
                            <label class="form-label">{{ __('newsletter.subject')}}
                            <span class="text-danger">*</span></label>
                            <input name="subject" id="update_subject" value="{{$data->subject ?? ''}}" type="text" class="form-control"
                             placeholder="{{ __('newsletter.subject_placeholder')}}" required>
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
                            <label class="form-label">{{ __('settings.datas_content')}}<span class="text-danger">*</span></label>
                            <textarea cols="40" rows="10" name="content" id="editor" class="form-control document" required>{{$data->content ?? ''}}</textarea>
                            <div class="invalid-feedback">
                            {{ __('settings.data_contect_error')}}
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
                            <input type="submit" id="update_btn" name="send" class="btn btn-primary" value="{{ __('common.update')}}">
                        </div>
                        <div class="col-lg-1 p-0">
                            <a href="{{route('marketing.template-list.index')}}"><input type="button" id="update_btn" name="send" class="btn btn-light" value="{{ __('common.cancel')}}"></a>
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