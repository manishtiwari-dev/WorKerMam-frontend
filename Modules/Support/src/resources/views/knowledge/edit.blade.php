<x-app-layout>
    @section('title', 'Add Artical')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">{{ __('support.editArticle') }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('manage-landing.knowledge.update', $artical->id) }}" class="ajax-form needs-validation"
                        method="POST" id="userForm" novalidate enctype="multipart/form-data">
                       @csrf
                    @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title" class="required">{{ __('support.title') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="title"
                                        class="form-control  @error('title') is-invalid @enderror"
                                        value="{{$artical->title}}" placeholder="{{ __('support.titlePlaceholder') }}"
                                        required>
                                    <div class="invalid-feedback">
                                        <p>{{ __('support.titleError') }}</p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category" class="category">{{ __('support.category') }}<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="category" required>
                                        <option value="" selected disabled>{{ __('support.categoryPlaceholder') }}
                                        </option>
                                        @if(!empty($categorylist))
                                            @foreach($categorylist as $category)
                                                <option {{($artical->category_id==$category->id) ? 'selected': ''}} value="{{$category->id}}">{{$category->category_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>{{ __('support.categoryError') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address" class="required">{{ __('support.description') }}<span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror summernote" id="" name="description"
                                        rows="15" placeholder="{{ __('support.descPlaceholder') }}" required>{{$artical->message}}</textarea>
                                    <div class="invalid-feedback">
                                        <p>{{ __('support.descriptionError') }}</p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                @php
                                    $imageUrl = $artical->featureimage;
                                @endphp
                                <label for="file" class="form-label mt-3">{{ __('support.featureImage') }} </label>
                                <input type="file"  class="form-control dropify" data-height="100"
                                    name="featureImage" data-default-file="{{ $file_url }}{{ $imageUrl ?? '' }}">
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="tags" class="required">{{ __('support.tags') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="tags"
                                        class="form-control  @error('tags') is-invalid @enderror"
                                        value="{{ $artical->tags }}" placeholder="{{ __('support.tagPlaceholder') }}"
                                        required>
                                    <div class="invalid-feedback">
                                        <p>{{ __('support.tagError') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <label for="file" class="form-label mt-3">{{ __('support.uploadFile') }} </label>
                                <input type="file" class="form-control dropify" data-height="100" name="uploadImage">
                            </div>
                            {{-- <div class="col-md-12 mt-3">
                                <label for="file" class="form-label mt-3">{{ __('common.status') }} </label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" {{($artical->status == 'publish' ) ? "checked":""}} value="publish" name="status"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Publish</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio"  {{($artical->status == 'unpublish' ) ? "checked":""}} id="customRadio2" value="unpublish" name="status"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">UnPublish</label>
                                </div>

                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" value="1" {{($artical->privatemode == 1 ) ? "checked":""}} name="privacy">
                                    <label class="custom-control-label" for="customCheck1">Privacy Mode</label>
                                </div>
                            </div> --}}
                            

                            <div class="card mt-3">
                                <h6 class="tx-15 mg-b-0">
                                    Status
                                </h6>
                                <div class="card-header pb-0">
                                    <div class="form-row">
                                        <div class="form-group d-flex gap-4 mb-0">

                                            <div>
                                                <input type="radio" id="customRadio1" {{($artical->status == 'publish' ) ? "checked":""}} name="status" value="publish"
                                                    checked>
                                                <label for="Choice1">Publish </label>
                                            </div>
                                            <div>
                                                <input type="radio" id="customRadio2"  {{($artical->status == 'unpublish' ) ? "checked":""}}name="status"
                                                    value="unpublish">
                                                <label for="Choice2">UnPublish</label>
                                            </div>


                                            <div class="invalid-feedback">
                                                {{ __('hrm.reason_error') }}
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-6 col-sm-12 ">


                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12 mt-1">
                                <div>
                                    <input type="radio" id="customRadio3" name="pc_price"  {{($artical->privatemode == 1 ) ? "checked":""}} value="1">
                                    <label for="Choice3">Privacy Mode</label>
                                </div>

                            </div>

                            
                        </div>
                        <div class="mt-3">
                            <div class="col-sm-12 p-0">
                                <button type="submit" id="" class="btn btn-primary">
                                    Submit</button>
                                <a href="{{ route('manage-landing.knowledge.index') }}"
                                    class="btn btn-secondary mx-1">Cancel</a>

                            </div>
                            <!--end col-->

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

        <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">

        <script>
            $('.dropify').dropify();

            $('.summernote').summernote({
                height: 400
            });
        </script>
    @endpush
</x-app-layout>
