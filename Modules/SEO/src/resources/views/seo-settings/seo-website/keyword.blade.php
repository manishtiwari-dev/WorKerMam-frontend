<x-app-layout>
    @section('title', 'General Setting')
    <style>
        .tagselect .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            background: transparent;
            border: 0;
            opacity: 1;
            left: 0;
        }
    </style>
    <div class="contact-content">
        <div class="layout-specing">
            <div class="card contact-content-body">



                @if (!empty($website_listing))
                    <form action="{{ route('seo.keywordUpdate', $website_listing->id) }}" method="post"
                        id="leadForm" class="needs-validation" novalidate>
                        @csrf
                        <div class="card-header d-flex align-items-center justify-content-between py-2 px-3">
                            <h6 class="tx-15 mg-b-0"> {{ $website_name }}</h6>
                        </div>

                        <div class="card-body">
                            <div data-label="Example" class="df-example demo-forms">

                                <div class="card-body pb-0">
                                    <div class="" id="addMore">
                                        <div class="d-flex justify-content-end">

                                            <div class="d-flex gap-1">
                                                <button class="btn btn-sm btn-primary btn-outline add_more"
                                                    type="button" id=""><i data-feather="plus"></i>Add
                                                    More</button>

                                            </div>


                                        </div>
                                        
                                        @if (!empty($website_listing->keyword_info))
                                            @foreach ($website_listing->keyword_info as $key => $kewordlist)


                                                @php
                                                    $selected_websiteUrl = $kewordlist->website_url;
                                                    $selected_keywords = $kewordlist->keywords;
                                                    $selected_id = $kewordlist->id;
                                                    $selected_key = $key + 1;

                                                        // @dd($selected_key)
                                                @endphp
                                               
                                                <input type="hidden" value="{{ $website_listing->id }}"
                                                    name="website_id">
                                                <div class="row" id="selectrow{{ $key + 1 }}">
                                                
                                                    <div class="form-group col-md-4 col-4">

                                                        @if($key < 1)
                                                        <label
                                                            for="website_url">Website Url</label>
                                                        @endif


                                                        <input type="text" class="form-control" id="website_url"
                                                            placeholder="Website Url"
                                                            name="website_url_{{$selected_id}}" value="{{ $selected_websiteUrl ?? '' }}">
                                                        
                                                    </div>

                                                    <div class="form-group col-md-4 col-4">
                                                        @if($key < 1)
                                                        <label
                                                            for="keywords">Keywords</label>
                                                            @endif
                                                        <input type="text" class="form-control" id="keywords"
                                                            placeholder="Keywords"
                                                            name="keywords_{{$selected_id}}" value="{{ $selected_keywords ?? '' }}">
                                                       
                                                    </div>
                                                  

                                                    {{-- <div class="form-group col-md-2 col-2 plusbtn">
                                                        <div class="remove  btn btn-danger" id={{ $key + 1 }}
                                                            type="button">X</div>
                                                    </div> --}}

                                                </div>
                                            @endforeach

                                        @else
                                          
                                            <div class="row">

                                                <input type="hidden" value="{{ $website_listing->id }}"
                                                name="website_id">
                                              
                                                <div class="form-group col-md-4 col-4">
                                                    <label
                                                        for="social_link">Website Url</label>
                                                    <input type="text" class="form-control" id="social_link"
                                                        placeholder="Website Url"
                                                        name="website_url[]">
                                                    <div class="invalid-feedback">
                                                        {{ __('crm.social_link_select') }}
                                                    </div>
                                                </div>


                                                <div class="form-group col-md-4 col-4">
                                                    <label
                                                        for="social_link">Keywords</label>
                                                    <input type="text" class="form-control" id="social_link"
                                                        placeholder="Keywords"
                                                        name="keywords[]">
                                                    <div class="invalid-feedback">
                                                        {{ __('crm.social_link_select') }}
                                                    </div>
                                                </div>

                                              
                                            </div>
                                        @endif

                                      
                                    </div>
                                    <!--end row-->
                                </div>
                            </div>
                            <!--end row-->

                            <div class="">
                                <div class="col-sm-12 mb-3 mx-3 p-0">
                                    <input type="submit" id="submit" name="submit" class="btn btn-primary"
                                        value="Submit">
                                    <a href="{{ route('seo.workReport') }}"
                                        class="btn btn-secondary mx-1">Cancel</a>
                                </div>
                                <!--end col-->
                            </div>
                            
                        </div>
                        
                        <!--------- Social contact info area start here ----------->
                    </form>
                @endif


            </div>
        </div>
    </div>
    <!-- script start -->
    @push('scripts')
        <script>
          
            $('.select2').select2({});
            $(document).ready(function() {
                var i = 0;
                $('.add_more').click(function(e) {
                    e.preventDefault();
                    i++;

              
                            
                    html = `<div class="row" id="row${i}">
                        <div class="form-group col-md-4 col-4">
                            <input type="text" class="form-control" id="social_link" placeholder="{{ __('seo.website_url') }}" name="website_url[]" value="" >
                            <div class="invalid-feedback">
                                {{ __('user-manager.tax_name_select') }}
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-4">
                            <input type="text" class="form-control" id="social_link" placeholder="{{ __('seo.Keywords') }}" name="keywords[]" value="" >
                            <div class="invalid-feedback">
                                {{ __('seo.Keywords') }}
                            </div>
                        </div>
                        <div class="form-group col-md-2 col-2">
                            <div class="btn_remove btn btn-danger" id="${i}" type="button">X</div>
                        </div>
                    </div>`;

                 
                 

                    $('#addMore').append(html);
                });


          


                $(document).on('click', '.btn_remove', function() {
                    var button_id = $(this).attr("id");

                    console.log(button_id);
                    $('#row' + button_id + '').remove();
                });

                $(document).on('click', '.remove', function() {
                    var button_id = $(this).attr("id");
                    $('#selectrow' + button_id + '').remove();
                });
                $('#addLeadBtn').on("click", function() {
                    $('#leadForm').addClass('was-validated');
                    if ($('#leadForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        $('#leadForm').submit();
                    }
                });
            });
        </script>
       
    @endpush

    <!-- script end-->
</x-app-layout>
