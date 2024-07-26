<x-app-layout>
    @section('title', 'Pc Category')

    @php
        $enCate = (array) $data->pcCategory->category_description;
        $seoData = (array) $data->seo;
        $ecmCategory = $data->ecm_category;

        $category_image = $data->category_img;

    @endphp
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    @endpush

    <div class="card contact-content-body">
        <div class="tab-content">
            <div class="card-header">
                @if (!empty($data->language))
                    @foreach ($data->language as $key => $lang)
                        <h6 class="tx-15 mg-b-0">
                            @if (!empty($enCate[$lang->languages_id]))
                                {{ $enCate[$lang->languages_id]->categories_name }}
                            @endif
                        </h6>
                    @endforeach
                @endif

            </div>
            <div class="card-body">
                <form action="{{ route('papachina-product.pc-categories.update', $data->pcCategory->categories_id) }}"
                    method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @if (!empty($data->language))
                            @foreach ($data->language as $key => $lang)
                                <li class="nav-item">
                                    <a class="nav-link @if ($key == 0) active @endif"
                                        id="category-tab-{{ $lang->languages_id }}" data-bs-toggle="tab"
                                        href="#category-content-{{ $lang->languages_id }}" role="tab"
                                        aria-controls="home" aria-selected="true">{{ $lang->languages_name }}</a>
                                </li>
                            @endforeach
                        @endif

                    </ul>

                    <div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="myTabContent">
                        {{-- @dd($data->language); --}}
                        @if (!empty($data->language))
                            @foreach ($data->language as $key => $lang)
                                {{-- @dd($data->pcCategory->category_description) --}}
                                <div class="tab-pane fade show @if ($key == 0) active @endif"
                                    id="category-content-{{ $lang->languages_id }}" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="form-row">
                                        <input name="language" type="hidden" value="{{ $lang->languages_id }}">


                                        <div class="form-group col-lg-12">
                                            <label class="form-label">Category Description</label>
                                            <textarea cols="40" rows="40" name="categories_description_{{ $lang->languages_id }}" id="pc_desc"
                                                class="form-control " value="">{{ $enCate[$lang->languages_id]->categories_description ?? '' }}</textarea>
                                            <div class="invalid-feedback">
                                                Please Enter Product Description
                                            </div>
                                            <span class="text-danger">
                                                @error('products_description')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card p-3 mt-1">
                                        <div class="form-row">
                                            <div class="form-group col-lg-12 col-sm-12">
                                                <label class="form-label">Seo Title</label>
                                                <input name="seometa_title_{{ $lang->languages_id }}" type="text"
                                                    class="form-control" placeholder="Enter Seo Title"
                                                    value="{{ $seoData[$lang->languages_id]->seometa_title ?? '' }}">
                                                <div class="invalid-feedback">
                                                    Please Enter Seo Title
                                                </div>
                                                <span class="text-danger">
                                                    @error('seometa_title')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-12 col-sm-12">
                                                <label class="form-label">Seo meta description</label>
                                                <textarea name="seometa_description_{{ $lang->languages_id }}" type="text" class="form-control" value=""
                                                    placeholder="Enter seo meta description">{{ $seoData[$lang->languages_id]->seometa_desc ?? '' }}</textarea>
                                                <div class="invalid-feedback">
                                                    Please Enter Seo meta description
                                                </div>
                                                <span class="text-danger">
                                                    @error('products_description')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            @endforeach
                        @endif
                    </div>


                    <div class="card p-3 mt-1">
                        <div class="card-header">
                            <h6 class="tx-15 mg-b-0">Category Details</h6>
                        </div>
                        <div class="card-body p-3 mt-1">

                            <div class="form-row">
                                <div class="form-group col-lg-6 col-sm-12">
                                    <label class="form-label">Category Slug</label>
                                    <input name="category_slug" type="text" class="form-control"
                                        placeholder="Enter Category Slug"
                                        value="{{ $ecmCategory->categories_slug ?? '' }}">
                                    @if (!empty($data->language))
                                        @foreach ($data->language as $key => $lang)
                                            @if (!empty($enCate[$lang->languages_id]))
                                                <input type="hidden"
                                                    value="{{ $enCate[$lang->languages_id]->categories_name }}"
                                                    name="cateslug" />
                                            @endif
                                        @endforeach
                                    @endif

                                    <div class="invalid-feedback">
                                        Please Enter Category Slug
                                    </div>
                                    <span class="text-danger">
                                        @error('products_description')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-lg-6 col-sm-12">
                                    <label class="form-label">Sort Order</label>
                                    <input name="sort_order" type="text" class="form-control"
                                        placeholder="Enter Sort Order" value="{{ $ecmCategory->sort_order ?? '' }}"
                                        required>
                                    <div class="invalid-feedback">
                                        Please Enter Sort Order
                                    </div>
                                    <span class="text-danger">
                                        @error('products_description')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-lg-6 col-sm-12">
                                    <label class="form-label">Category Image</label></br />
                                    {{-- <input type="file" name="image" /> --}}
                                    <input class="select-file" accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xls,.xlsx,.rtf"
                                        type="file" name="image">
                                    <img src="{{ $category_image }}" alt="tag" height="150px;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 d-flex gap-3">
                        <div class="col-lg-1 p-0">
                            <input type="submit" name="send" class="btn btn-primary"
                                value="{{ __('common.update') }}">
                        </div>
                        <div class="col-lg-1 p-0">
                            <a href="{{ route('papachina-product.pc-categories.index') }}">
                                <input type="button" name="send" class="btn btn-light"
                                    value="{{ __('common.cancel') }}">
                            </a>
                        </div>
                    </div>



                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        {{-- <script type="text/javascript" src="{{asset('assets/js/ckeditor.js')}}"></script> --}}

        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


        <script>
            $(document).ready(function() {
                $('#pc_desc').summernote({
                    placeholder: 'Enter Category Description',
                    height: 150
                });
            });
            // ClassicEditor
            //     .create(document.querySelector('#editor'))
            //     //ckeditor height code
            //     .then( editor => {
            //         editor.editing.view.change( writer => {
            //             writer.setStyle( 'height', '200px', editor.editing.view.document.getRoot() );
            //         } );
            //     } )
            //     .catch(error => {
            //         console.error(error);
            //     });

            let buttons = $('button[data-toggle="dropdown"]');

            buttons.each((key, value) => {
                $(value).on('click', function(e) {
                    $(this).attr('data-bs-toggle', 'dropdown')
                    console.log()
                    ata('id', 'dropdownMenu');
                })
            })
        </script>
    @endpush
</x-app-layout>
