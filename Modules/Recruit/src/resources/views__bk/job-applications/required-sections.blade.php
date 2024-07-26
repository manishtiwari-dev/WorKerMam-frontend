<div class="row">  
    @if ($section_visibility->profile_image == 'yes')
    
        <div class="col-md-6 pb-4 pt-4">
            <div class="form-group">
                <h6>
                    <strong>
                        @lang('modules.front.photo')
                    </strong>
                </h6>
                <input class="select-file" data-allowed-file-extensions=".png,.jpg,.jpeg" type="file" name="image_file"><br>
                <span class="required">@lang('modules.front.photoFileType')</span>
            </div>
            @if (!empty($application) && !is_null($application->photo_url))
                <p>
                    <a target="_blank"
                        href="{{ $application->photo_url }}"
                        class="btn btn-sm btn-primary">@lang('app.view')</a>
                </p>
            @endif
        </div>
    @endif

    @if ($section_visibility->resume == 'yes')
        <div class="col-md-6 pb-4 pt-4">
            <div class="form-group">
                <h5 class="">@lang('modules.front.resume')</h5>
                <input class="select-file" accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xls,.xlsx,.rtf" type="file"
                    name="resume"><br>
                <span class="required">@lang('modules.front.resumeFileType')</span>
            </div> 
            @if (!empty($application) && $application->resume_url)
                <p>
                    <a target="_blank"
                        href="{{ $application->resume_url }}"
                        class="btn btn-sm btn-primary">
                        @lang('app.view')
                    </a>
                </p>
            @endif
        </div>
    @endif



    @if ($section_visibility->cover_letter == 'yes')
        <div class="col-md-6 pb-4 pt-4">
            <div class="form-group">
                <h5>@lang('modules.front.coverLetter')</h5>
                <textarea class="form-control" name="cover_letter" rows="4">{{  $application->cover_letter ?? '' }}</textarea>
            </div>
        </div>
    @endif


</div>
