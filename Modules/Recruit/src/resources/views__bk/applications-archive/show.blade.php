 <link rel="stylesheet" href="{{ asset('asset/css/plugins/jquery-bar-rating-master/fontawesome-stars.css') }}">
 <style>
     .right-panel-box {
         overflow-y: scroll;
         max-height: 34rem;
     }

     .resume-button {
         text-align: center;
         /* margin-top: 1rem */
         margin-right: 38px;
     }

     .star-center {
         margin-right: 42px;
     }

     .select-dropdown .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
         background: transparent;
         border: 0;
         opacity: 1;
         left: 0;
     }
 </style>

 <div class="r-panel-body p-3">

     <div class="row font-12">
         <div class="col-4 text-center">

             @if (!empty($content->application->photo))
                 <img src="{{ $content->file_url }}{{ $content->application->photo }}" style="border-radius: 50%;"
                     class="img-circle img-fluid">
             @else
                 <img src="{{ $application->photo_url }}" style="border-radius: 50%;" class="img-circle img-fluid">
             @endif


             @if ($content->application->resume_url)
                 <p class="text-muted resume-button">
                     <a target="_blank" href="{{ $content->resume_url }}{{ $content->application->resume_url }}"
                         class="btn btn-sm btn-primary">@lang('app.view') @lang('modules.jobApplication.resume')</a>
                 </p>
             @endif

             <div class="stars stars-example-fontawesome text-center star-center">
                 <select id="example-fontawesome" name="rating" autocomplete="off">
                     <option value=""></option>
                     <option value="1">1</option>
                     <option value="2">2</option>
                     <option value="3">3</option>
                     <option value="4">4</option>
                     <option value="5">5</option>
                 </select>
             </div>
             {{-- @if ($user->cans('delete_job_applications')) --}}
             <div class="text-muted resume-button">
                 <a href="javascript:unarchiveApplication({{ $content->application->id }})" class="btn btn-sm btn-info">
                     @lang('modules.jobApplication.unarchiveApplication')
                 </a>
             </div>
             {{-- @endif --}}
         </div>

         <div class="col-8 right-panel-box">
             <div class="row">
                 <div class="col-sm-6">
                     <strong>@lang('app.name')</strong><br>
                     <p class="text-muted">{{ ucwords($content->application->full_name) }}</p>
                 </div>

                 <div class="col-sm-6">
                     <strong>@lang('app.email')</strong><br>
                     <p class="text-muted">{{ $content->application->email }}</p>
                 </div>
             </div>
             <div class="row">

                 <div class="col-sm-6">
                     <strong>@lang('app.phone')</strong><br>
                     <p class="text-muted">{{ $content->application->phone }}</p>
                 </div>
                 @if (!is_null($content->application->gender))
                     <div class="col-md-6">
                         <strong>@lang('app.gender')</strong><br>
                         <p class="text-muted" id="gender-{{ $content->application->id }}">
                             {{ ucfirst($content->application->gender) }}</p>
                     </div>
                 @endif
             </div>

             <div class="row">
                 @if (!is_null($content->application->dob))
                     <div class="col-md-6">
                         <strong>@lang('app.dob')</strong><br>
                         <p class="text-muted" id="dob-{{ $content->application->id }}">
                             {{ \Carbon\Carbon::parse($content->application->dob)->format('jS F, Y') }}</p>
                     </div>
                 @endif
                 @if (!is_null($content->application->address))
                     <div class="col-sm-6 col-md-4">
                         <strong>@lang('app.address')</strong><br>
                         <p class="text-muted" id="address-{{ $content->application->id }}">
                             {{ $content->application->address }}</p>
                     </div>
                 @endif
             </div>

             @if (!is_null($content->application->country))
                 <div class="row">
                     <div class="col-sm-6">
                         <strong>@lang('app.city')</strong><br>
                         <p class="text-muted" id="city-{{ $content->application->id }}">
                             {{ $content->application->city }}</p>
                     </div>
                     <div class="col-sm-6">
                         <strong>@lang('app.state')</strong><br>
                         <p class="text-muted" id="state-{{ $content->application->id }}">
                             {{ $content->application->state }}</p>
                     </div>
                     <div class="col-sm-6">
                         <strong>@lang('app.country')</strong><br>
                         <p class="text-muted" id="country-{{ $content->application->id }}">
                             {{ $content->application->country }}</p>
                     </div>
                     <div class="col-md-6">
                         <strong>Zip</strong><br>
                         <p class="text-muted" id="zip-{{ $content->application->id }}">
                             {{ $content->application->zip_code }}</p>
                     </div>
                 </div>
             @endif

             <div class="row">
                 <div class="col-sm-6">
                     <strong>@lang('modules.jobApplication.appliedFor')</strong><br>
                     <p class="text-muted">
                         {{ ucwords($content->application->job->title ?? '') . ' (' . ucwords($content->application->job->location->location ?? '') . ')' }}
                     </p>
                 </div>
                 <div class="col-sm-6">
                     <strong>@lang('modules.jobApplication.appliedAt')</strong><br>
                     <p class="text-muted">
                         {{ \Carbon\Carbon::parse($content->application->created_at)->format('d M, Y H:i') }} </p>
                 </div>
             </div>
             @if (!empty($content->answers))
                 <div class="row">
                     <div class="col-sm-12">
                         <h4>@lang('modules.front.additionalDetails')</h4>
                         @forelse($content->answers as $answer)
                             <strong>{{ $answer->question->question }}</strong><br>
                             <p class="text-muted">{{ ucfirst($answer->answer) }}</p>
                         @empty
                         @endforelse
                     </div>
                 </div>
             @endif
             @if (!is_null($content->application->schedule))
                 <hr>

                 <h5>@lang('modules.interviewSchedule.scheduleDetail')</h5>
                 <div class="col-sm-12">
                     <strong>@lang('modules.interviewSchedule.scheduleDate')</strong><br>
                     <p class="text-muted">
                         {{ \Carbon\Carbon::parse($content->application->schedule->schedule_date)->format('d M, Y H:i') }}
                     </p>
                 </div>
                 <div class="row">
                     <div class="col-sm-6">
                         <strong>@lang('modules.interviewSchedule.assignedEmployee')</strong><br>
                     </div>
                     <div class="col-sm-6">
                         <strong>@lang('modules.interviewSchedule.employeeResponse')</strong><br>
                     </div>
                     @forelse($content->application->schedule->employee as $key => $emp)
                         <div class="col-sm-6">
                             <p class="text-muted">{{ ucwords($emp->user->name) }}</p>
                         </div>

                         <div class="col-sm-6">
                             @if ($emp->user_accept_status == 'accept')
                                 <label class="badge badge-success">{{ ucwords($emp->user_accept_status) }}</label>
                             @elseif($emp->user_accept_status == 'refuse')
                                 <label class="badge badge-danger">{{ ucwords($emp->user_accept_status) }}</label>
                             @else
                                 <label class="badge badge-warning">{{ ucwords($emp->user_accept_status) }}</label>
                             @endif
                         </div>
                     @empty
                     @endforelse
                 </div>

             @endif

             @if (isset($content->application->schedule->comments) == 'interview' &&
                     count($content->application->schedule->comments) > 0)
                 <hr>

                 <h5>@lang('modules.interviewSchedule.comments')</h5>
                 @forelse($content->application->schedule->comments as $key => $comment)
                     <div class="col-sm-12">
                         <p class="text-muted"><b>{{ $comment->user->name }}:</b> {{ $comment->comment }}</p>
                     </div>
                 @empty
                 @endforelse

             @endif
             <div class="col-sm-12">
                 <p class="text-muted">
                     @if (!is_null($content->application->skype_id))
                         <span class="skype-button rounded"
                             data-contact-id="live:{{ $content->application->skype_id }}" data-text="Call"></span>
                     @endif
                 </p>
             </div>
             <div class="row">
                 <div class="col-sm-6">
                     <p class="text-muted">
                         <a onclick="createSchedule('{{ $content->application->id }}')" href="javascript:;"
                             class="btn btn-sm btn-info">@lang('modules.interviewSchedule.scheduleInterview')</a>
                     </p>
                 </div>
                 {{-- @endif --}}
             </div>
         </div>
         {{-- @if ($user->cans('edit_job_applications')) --}}
         <div class="col-12" id="skills-container">
             <hr>
             <div class="col-sm-12 mb-3">
                 <h5>@lang('modules.jobApplication.skills')</h5>
             </div>
             <div class="form-group mb-2 select-dropdown">
                 <select name="skills[]" id="skills" class="form-control select2 custom-select" multiple>
                     @forelse ($content->skills as $skill)
                         <option @if (!is_null($content->application->skills) && in_array($skill->id, $content->application->skills)) selected @endif value="{{ $skill->id }}">
                             {{ $skill->name }}</option>
                     @empty
                     @endforelse
                 </select>
             </div>
             <a href="javascript:addSkills({{ $content->application->id }});" id="add-skills"
                 class="btn btn-sm btn-outline-success">
                 @if (!is_null($content->application->skills) && sizeof($content->application->skills) > 0)
                     @lang('modules.jobApplication.updateSkills')
                 @else
                     @lang('modules.jobApplication.addSkills')
                 @endif
             </a>
         </div>
         {{-- @endif --}}
         <hr>
         <div class="col-sm-12 mt-3">
             <h5>@lang('modules.jobApplication.applicantNotes')</h5>
         </div>

         <div id="applicant-notes" class="col-sm-12">
             <ul class="list-unstyled">
                 @foreach ($content->application->notes as $key => $notes)
                     <li class="media mb-3" id="note-{{ $notes->id }}">
                         <div class="media-body">
                             <h6 class="mt-0 mb-1">
                                 <span class="pull-right font-italic font-weight-light"><small>
                                         {{ Carbon\Carbon::parse($notes->created_at)->format('d-m-Y') }} </small>

                                     <a href="javascript:;" class="edit-note" data-note-id="{{ $notes->id }}"><i
                                             class="fa fa-edit ml-2"></i></a>
                                     <a href="javascript:;" class="delete-note"
                                         data-note-id="{{ $notes->id }}"><i
                                             class="fa fa-trash ml-1 text-danger"></i></a>

                                 </span>
                             </h6>
                             <small class="note-text">{{ ucfirst($notes->note_text) }}</small>
                             <div class="note-textarea"></div>
                         </div>
                     </li>
                 @endforeach
             </ul>
         </div>

         {{-- @if ($user->cans('edit_job_applications')) --}}
         <div class="col-sm-12">
             <div class="form-group mb-2">
                 <textarea name="note" id="note_text" cols="30" rows="2" class="form-control"></textarea>
             </div>
             <a href="javascript:;" id="add-note" class="btn btn-sm btn-outline-primary">@lang('modules.jobApplication.addNote')</a>
         </div>
         {{-- @endif --}}



     </div>

 </div>
 {{-- @if ($user->cans('edit_job_applications')) --}}
 <script src="{{ asset('asset/js/jquery.barrating.min.js') }}" type="text/javascript"></script>
 <script>
     $('#example-fontawesome').barrating({
         theme: 'fontawesome-stars',
         showSelectedRating: false,
         onSelect: function(value, text, event) {
             if (event !== undefined && value !== '') {
                 var url = "{{ route('recruit.job-applications.rating-save', ':id') }}";
                 url = url.replace(':id', {{ $content->application->id }});
                 var token = '{{ csrf_token() }}';
                 var id = {{ $content->application->id }};
                 $.ajax({
                     type: 'Post',
                     url: url,
                     container: '#example-fontawesome',
                     data: {
                         'rating': value,
                         '_token': token
                     },
                     success: function(response) {
                         Toaster('success', response.status);
                         $('#example-fontawesome_' + id).barrating('set', value);

                     }
                 });
             }

         }
     });
     @if ($content->application->rating !== null)
         $('#example-fontawesome').barrating('set', {{ $content->application->rating }});
     @endif
 </script>
 {{-- @endif --}}
 <script>
     $('.select2#skills').select2();

     function addSkills(applicationId) {
         let url = "{{ route('recruit.job-applications.addSkills', ':id') }}";
         url = url.replace(':id', applicationId);

         $.ajax({
             url: url,
             type: 'POST',
             container: '#skills-container',
             data: {
                 _token: '{{ csrf_token() }}',
                 skills: $('#skills').val()
             },
             success: function(response) {
                 if (response.status === 'success') {
                     $("body").removeClass("control-sidebar-slide-open");
                     if (typeof table !== 'undefined') {
                         table._fnDraw();
                     } else {
                         loadData();
                     }
                 }
             }
         })
     }

     function unarchiveApplication(applicationId) {
         swal({
                 title: `Are you sure?`,
                 text: "Do you want to unarchive it?",
                 icon: "warning",
                 buttons: true,
                 dangerMode: true,
             })
             .then((isConfirm) => {
                 if (isConfirm) {

                     var url = "{{ route('recruit.job-applications.unarchiveJobApplication', ':id') }}";
                     url = url.replace(':id', applicationId);

                     var token = '{{ csrf_token() }}';

                     $.ajax({
                         type: 'POST',
                         url: url,
                         data: {
                             '_token': token
                         },
                         success: function(response) {
                             $('#job_application').modal('hide');
                             Toaster('success', 'APPLICATION_UNARCHIVED_SUCCESSFULLY');
                             setTimeout(function() {
                                 location.reload(true);
                             }, 3000);

                         }
                     });
                 }
             });
     }

     $('#add-note').click(function() {
         var url = "{{ route('recruit.applicant-note.store') }}";
         var id = {{ $content->application->id }};
         var note = $('#note_text').val();
         var token = '{{ csrf_token() }}';

         $.ajax({
             type: 'POST',
             url: url,
             data: {
                 '_token': token,
                 'id': id,
                 'note': note
             },
             success: function(response) {
                 $('#applicant-notes').html(response.view);
                 $('#note_text').val('');
             }
         });
     });

     $('body').on('click', '.edit-note', function() {
         $(this).hide();
         let noteId = $(this).data('note-id');
         $('body').find('#note-' + noteId + ' .note-text').hide();

         let noteText = $('body').find('#note-' + noteId + ' .note-text').html();
         let textArea = '<textarea id="edit-note-text-' + noteId + '" class="form-control" row="4">' + noteText +
             '</textarea><a class="update-note" data-note-id="' + noteId +
             '" href="javascript:;"><i class="fa fa-check"></i> @lang('app.save')</a>';
         $('body').find('#note-' + noteId + ' .note-textarea').html(textArea);
     });

     $('body').on('click', '.update-note', function() {
         let noteId = $(this).data('note-id');

         var url = "{{ route('recruit.applicant-note.update', ':id') }}";
         url = url.replace(':id', noteId);

         var note = $('#edit-note-text-' + noteId).val();
         var token = '{{ csrf_token() }}';

         $.ajax({
             type: 'POST',
             url: url,
             data: {
                 '_token': token,
                 'noteId': noteId,
                 'note': note,
                 '_method': 'PUT'
             },
             success: function(response) {
                 $('#applicant-notes').html(response.view);
             }
         });
     });

     $('body').on('click', '.delete-note', function() {
         let noteId = $(this).data('note-id');
         swal({
                 title: `Are you sure you want to delete this record?`,
                 text: "If you delete this, it will be gone forever.",
                 icon: "warning",
                 buttons: true,
                 dangerMode: true,
             })
             .then((isConfirm) => {
                 if (isConfirm) {

                     var url = "{{ route('recruit.applicant-note.destroy', ':id') }}";
                     url = url.replace(':id', noteId);

                     var token = '{{ csrf_token() }}';

                     $.ajax({
                         type: 'POST',
                         url: url,
                         data: {
                             '_token': token,
                             '_method': 'DELETE'
                         },
                         success: function(response) {
                             $('#applicant-notes').html(response.view);
                         }
                     });
                 }
             });
     });
 </script>
 @if (!is_null($content->application->skype_id))
     <script src="https://swc.cdn.skype.com/sdk/v1/sdk.min.js"></script>
 @endif
