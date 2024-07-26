<x-app-layout>
@section('title', 'Job Onboard')
    <div class="row">
        <div class="col-12">
            <div class="card">
                 <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h4 class="card-title mb-4"> @lang('app.job') @lang('app.onBoard')
                        @if ($onboard->hired_status == 'accepted')
                            <label class="badge bg-success">@lang('app.accepted')</label>
                        @elseif($onboard->hired_status == 'offered')
                            <label class="badge bg-warning">@lang('app.offered')</label>
                        @elseif($onboard->hired_status == 'canceled')
                            <label class="badge bg-danger">@lang('app.canceled')</label>
                        @else
                            <label class="badge bg-danger">@lang('app.rejected')</label>
                        @endif
                    </h4>
                    </div>
                </div>
                <div class="card-body">
                    
                    <form id="createSchedule" class="ajax-form" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6  col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('modules.interviewSchedule.candidate') @lang('app.name')</label>
                                        <p>{{ $application->full_name }}</p>
                                        <input type="hidden" name="candidate_id" value="{{ $application->id }}">
                                    </div>
                                </div>
                                <div class="col-md-6  col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('modules.interviewSchedule.candidate') @lang('app.phone') </label>
                                        <p>{{ $application->phone }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('modules.interviewSchedule.candidate') @lang('app.email')</label>
                                        <p>{{ $application->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6  col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('app.job') @lang('app.location') </label>
                                        <p>{{ ucwords($application->job->location->location) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6  col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('app.department') </label>      
                                            <p>{{ ucwords($onboard->department->dept_name ?? '') }}</p>
                                       
                                    </div>
                                </div>
                                <div class="col-md-6  col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('app.designation') </label> 
                                            <p>{{ ucwords($onboard->designation->designation_name ??'') }}</p> 
                                    </div>
                                </div>
                                <div class="col-md-6  col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('app.salaryOfferedPerMonth') </label> 
                                        <p>{{ $onboard->currency ? $onboard->currency->symbol_left : '' }}
                                            {{ $onboard->salary_offered }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6  col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('app.acceptLastDate') </label>
                                        <p>{{   Carbon\Carbon::parse($onboard->accept_last_date)->format('d-m-Y')}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6  col-xs-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('app.reportTo') </label>   
                                            <p>{{ ucwords($onboard->reportto->first_name ?? '') }}</p> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="d-block">View Offer</label>
                                       <button class="btn btn-primary"> <a target="_blank" href="{{$website_url}}/{{ ucwords($onboard->offer_code) }}" class="text-white">View Offer</a></button>
                                        <p></p>
                                    </div>
                                </div>
                                @if (count($answers) > 0)
                                    <div class="col-md-6">
                                        <h4>@lang('modules.front.additionalDetails')</h4>
                                        @forelse($answers as $answer)
                                            <strong>
                                                {{ $answer->question->question }}
                                            </strong><br>
                                            @if ($answer->question->type == 'text')
                                                <p class="text-muted">{{ ucfirst($answer->answer) }}</p>
                                            @else
                                                @if (!is_null($answer->file))
                                                    <a target="_blank" href="{{ $answer->file_url }}"
                                                        class="btn btn-sm btn-primary mb-2">@lang('app.view')
                                                        @lang('app.file')</a><br>
                                                @endif
                                            @endif
                                        @empty
                                        @endforelse
                                    </div>
                                @endif 
                                <div class="col-md-6">
                                    @if ($onboard->hired_status == 'accepted' && !is_null($onboard->sign))
                                        <div class="form-group">
                                            <label class="d-block">@lang('app.signature') </label>
                                            <!--  -->
                                        </div>
                                    @elseif($onboard->hired_status == 'rejected' && !is_null($onboard->reason))
                                        <div class="form-group">
                                            <label class="d-block">@lang('app.reason') </label>
                                            <p>{{ ucwords($onboard->reason) }}</p>
                                        </div>
                                    @endif
                                </div>
                                
                                @if (sizeof($onboard->files) > 0)
                                    <div class="col-md-12">
                                        <h4 class="theme-color mt-20">@lang('app.files')</h4>

                                        <div class="row">
                                            @forelse($onboard->files as $file)
                                                <input type="hidden" name="oldImages[{{ $file->id }}]">
                                                <div class="col-md-2 m-b-10" id="fileBox{{ $file->id }}">
                                                    <a target="_blank"
                                                        href="{{$file_url}}{{ $file->hash_name }}">
                                                        <div class="card">
                                                            <div class="file-bg">
                                                                <div class="overlay-file-box">
                                                                    <div class="user-content"> 
                                                                            <img class="card-img-top img-responsive"
                                                                                src="{{$file_url}}{{ $file->hash_name }}">
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-block">
                                                                <h6 class="card-title text-primary mt-3">{{ $file->name }}</h6>
                                                                <a href="javascript:;" data-toggle="tooltip"
                                                                    data-original-title="Delete"
                                                                    data-file-id="{{ $file->id }}"
                                                                    class="btn btn-danger btn-circle sa-params"
                                                                    data-pk="thumbnail"><i class="fa fa-times"></i></a>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>
                                @endif
                                
                                
                            </div>

                            <br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@push('scripts')
    <script>
        $('body').on('click', '.sa-params', function() { 
            var id = $(this).data('file-id');
            var deleteView = $(this).data('pk');
            swal({
                title: `Are you sure?`,
                text: "You will not be able to recover the deleted file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((isConfirm) => {
                if (isConfirm) {

                    var url = "{{ route('recruit.job-onboard.destroy', ':id') }}";
                    url = url.replace(':id', id);

                    var token = "{{ csrf_token() }}";

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            '_token': token,
                            '_method': 'DELETE',
                            'view': deleteView
                        },
                        success: function(response) {
                            console.log(response);
                            Toaster('success' , response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);
                            // if (response.status == "success") {
                            //     $.unblockUI();
                            //     $('#fileBox' + id).fadeOut();
                            // }
                        }
                    });
                }
            });
        });
    </script>
@endpush
</x-app-layout>
