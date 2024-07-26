<x-app-layout>
    <style>
        .bootstrap-select.show-menu-arrow.open>.dropdown-toggle,
        .bootstrap-select.show-menu-arrow.show>.dropdown-toggle {
            z-index: 0 !important;
        }
    </style>
      @section('title', 'Daily Work')
    <div class="card">
        <div class="tab-content">

            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="tx-15 mg-b-0">{{ $website_name }}</h6>


                </div>
            </div>



            {{-- @foreach ($seo_task_listing as $key => $listing)
                @if ($listing->no_of_submission) --}}

            <div class="card-body">
                <form id="save-website-data-{{ $website_listing->id }}" method="post">
                    <input type="hidden" name="website_id" value="{{ $website_listing->id }}">

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <div class="form-icon position-relative">
                            <select class="form-select form-control select2" name="seo_task_id" id="seolist">
                                <option value="0">{{ __('seo.select_task') }}</option>
                                @if (!empty($seotask))
                                    @foreach ($seotask as $seo)
                                        {{-- @foreach ($seo->seo_setting as $seolist) --}}
                                        <option value="{{$seo->id ?? ''}}">
                                            {{ ucfirst($seo->seo_task_title ?? '') }}</option>
                                        {{-- @endforeach --}}
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-icon position-relative">
                            {{-- <input class="form-control" type="text" placeholder="Website Url" name="website_url"
                                value=""> --}}
                                <textarea name="website_url" rows="2" class="form-control"></textarea>
                            @error('website_url')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group col-md-4">
                        <div class="form-icon position-relative">
                            <input type="button" class="btn btn-primary  save-website-form"
                            form-id="{{ $website_listing->id }}" value="Check" />
                        </div>
                    </div>


                </div>

              
            </form>

            <div id="">
                <p id="check_task" style="color:green; font-size:20px;"></p>
            </div>


            </div>
           
        </div>
    </div>
    @push('scripts')
    <script>


            $(document).ready(function() {
                $('.save-website-form').click(function() {
                    const url = "{{ route('seo.duplicate-checker-update', $website_listing->id) }}";
                    var formID = $(this).attr('form-id');
                  //  var other_data =$('#save-website-data-' + formID).serialize();
                
                     console.log(formID);

                 
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url,
                        formID: formID,
                        container: '#save-website-data-' + formID,
                        type: "POST",
                        data: $('#save-website-data-' + formID).serialize(),
                   
                        success: function(response) {
                            console.log(response.webStatus);
                           
                              var responseHtml='';
                              $.each(response.webStatus, function (key, value) {
                                responseHtml+=`<p>${key} : ${value} </p>`;
                             
                            });

                               $('#check_task').html(responseHtml);
                            
                            
                          // location.reload();

                        }
                    })

                });
            });

        </script>

    @endpush


</x-app-layout>
