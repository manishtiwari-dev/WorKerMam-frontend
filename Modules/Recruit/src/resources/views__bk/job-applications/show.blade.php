  <link rel="stylesheet" href="{{ asset('asset/css/plugins/jquery-bar-rating-master/fontawesome-stars.css') }}">
  <style>
      .right-panel-box {
          overflow-y: scroll;
          max-height: 34rem;
      }

      .resume-button {
          text-align: center;
          margin-top: 1rem
      }

      .select2-dropdown {
          z-index: 1110;
      }

      .select-dropdown .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
          background: transparent;
          border: 0;
          opacity: 1;
          left: 0;
      }
  </style>

  <div class="r-panel-body p-3 skills-container">
      <div class="row font-12">
          <div class="col-4 text-center">
              @if (!empty($application->photo))
                  <img src="{{ $file_url }}{{ $application->photo }}" class="img-circle img-fluid">
              @else
                  <img src="{{ $application->photo_url }}" class="img-circle img-fluid">
              @endif

              <p class="text-muted resume-button mr-6" id="resume-{{ $application->id }}">
                  @if ($application->resume_url)
                      <a target="_blank" href="{{ $resume_url }}{{ $application->resume_url }}"
                          class="btn btn-sm btn-primary">
                          @lang('app.view') @lang('modules.jobApplication.resume')
                      </a>
                  @endif
              </p>
              <div class="stars stars-example-fontawesome text-center">
                  <select id="example-fontawesome" name="rating" autocomplete="off">
                      <option value=""></option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                  </select>
              </div>
              @if ($application->status->status == 'hired' && is_null($application->onboard))
                  <p class="text-muted resume-button">
                      <a href="{{ route('recruit.job-onboard.create') }}?id={{ $application->id }}"
                          class="btn btn-sm btn-success">@lang('app.startOnboard')</a>
                  </p>
              @endif
              <div class="text-muted resume-button">
                  <a href="javascript:archiveApplication({{ $application->id }})" class="btn btn-sm btn-info">
                      @lang('modules.jobApplication.archiveApplication')
                  </a>
              </div>
              <div class="text-muted resume-button">
                  <a href="javascript:deleteApplication({{ $application->id }})" class="btn btn-sm btn-danger">
                      @lang('modules.jobApplication.deleteApplication')
                  </a>
              </div>
              {{-- @endif --}}
          </div>

          <div class="col-8 right-panel-box">
              <div class="col-sm-12">
                  <div class="row">
                      <div class="col-sm-6">
                          <strong>@lang('app.name')</strong><br>
                          <p class="text-muted">{{ ucwords($application->full_name) }}</p>
                      </div>

                      <div class="col-sm-6">
                          <strong>@lang('app.email')</strong><br>
                          <p class="text-muted">{{ $application->email }}</p>
                      </div>
                  </div>
              </div>
              <div class="col-sm-12">
                  <div class="row">
                      <div class="col-sm-6">
                          <strong>@lang('app.phone')</strong><br>
                          <p class="text-muted">{{ $application->phone }}</p>
                      </div>

                      @if (!is_null($application->gender))
                          <div class="col-sm-6">
                              <strong>@lang('app.gender')</strong><br>
                              <p class="text-muted" id="gender-{{ $application->id }}">
                                  {{ ucfirst($application->gender) }}</p>
                          </div>
                      @endif
                  </div>
              </div>

              <div class="col-sm-12">
                  <div class="row">
                      @if (!is_null($application->dob))
                          <div class="col-sm-6">
                              <strong>@lang('app.dob')</strong><br>
                              <p class="text-muted" id="dob-{{ $application->id }}">
                                  {{ \Carbon\Carbon::parse($application->dob)->format('d-m-Y') }}</p>
                          </div>
                      @endif
                      @if (!is_null($application->address))
                          <div class="col-sm-6 col-md-4">
                              <strong>@lang('app.address')</strong><br>
                              <p class="text-muted" id="address-{{ $application->id }}">{{ $application->address }}
                              </p>
                          </div>
                      @endif
                  </div>
              </div>



              @if (!is_null($application->country))
                  <div class="col-sm-12">
                      <div class="row">
                          <div class="col-md-6">
                              <strong>@lang('app.city')</strong><br>
                              <p class="text-muted" id="city-{{ $application->id }}">{{ $application->city }}</p>
                          </div>
                          <div class="col-md-6">
                              <strong>@lang('app.state')</strong><br>
                              <p class="text-muted" id="state-{{ $application->id }}">{{ $application->state }}</p>
                          </div>
                          <div class="col-md-6">
                              <strong>@lang('app.country')</strong><br>
                              <p class="text-muted" id="country-{{ $application->id }}">{{ $application->country }}
                              </p>
                          </div>

                          <div class="col-md-6">
                              <strong>Zip</strong><br>
                              <p class="text-muted" id="zip-{{ $application->id }}">{{ $application->zip_code }}</p>
                          </div>


                      </div>
                  </div>
              @endif

              <div class="col-sm-12">
                  <div class="row">
                      <div class="col">
                          <strong>@lang('modules.jobApplication.appliedAt')</strong><br>
                          <p class="text-muted">
                              {{ Carbon\Carbon::parse($application->created_at)->format('d M, Y H:i') }}
                          </p>
                      </div>
                      <div class="col">
                          <strong>@lang('modules.jobApplication.appliedFor')</strong><br>
                          @if (!empty($application->job))
                              <p class="text-muted">
                                  {{ ucwords($application->job->title ?? '') . ' (' . ucwords($application->job->location->location ?? '') . ')' }}
                              </p>
                          @endif
                      </div>
                  </div>
              </div>
              @if (!is_null($application->cover_letter))
                  <div class="col-sm-6">
                      <div class="row">
                          <div class="col">
                              <strong>@lang('modules.jobs.coverLetter')</strong><br>
                              <p class="text-muted">{{ $application->cover_letter }}</p>
                          </div>
                      </div>
                  </div>
              @endif
              <div class="col-sm-12">
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
                                  class="btn btn-sm btn-primary mb-2">@lang('app.view') @lang('app.file')</a><br>
                          @endif
                      @endif
                  @empty
                  @endforelse
              </div>
              @if (!is_null($application->schedule))
                  <hr>

                  <h5>@lang('modules.interviewSchedule.scheduleDetail')</h5>
                  <div class="col-sm-6">
                      <strong>@lang('modules.interviewSchedule.scheduleDate')</strong><br>
                      <p class="text-muted">
                          {{ Carbon\Carbon::parse($application->schedule->schedule_date)->format('d M, Y H:i') }}</p>
                  </div>
                  {{-- @if ($zoom_setting->enable_zoom == 1) --}}
                  <div class="col-sm-6">
                      <strong>@lang('modules.interviewSchedule.interviewType')</strong><br>
                      <p class="text-muted">
                          {{ $application->schedule->interview_type == 'online' ? 'Online' : 'offline' }}</p>
                  </div>
                  {{-- @endif --}}
                  <div class="row">
                      <div class="col-sm-6">
                          <strong>@lang('modules.interviewSchedule.assignedEmployee')</strong><br>
                      </div>
                      <div class="col-sm-6">
                          <strong>@lang('modules.interviewSchedule.employeeResponse')</strong><br>
                      </div>
                      @forelse($application->schedule->employee as $key => $emp)
                          <div class="col-sm-6">
                              <p class="text-muted">{{ ucwords($emp->user->first_name ?? '') }}</p>
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

              @if (isset($application->schedule->comments) == 'interview' && count($application->schedule->comments) > 0)
                  <hr>

                  <h5>@lang('modules.interviewSchedule.comments')</h5>
                  @forelse($application->schedule->comments as $key => $comment)
                      <div class="col-sm-12">
                          <p class="text-muted"><b>{{ $comment->user->name ?? '' }}</b> {{ $comment->comment }}</p>
                      </div>
                  @empty
                  @endforelse

              @endif
              <div class="col-sm-12">
                  <p class="text-muted">
                      @if (!is_null($application->skype_id))
                          <span class="skype-button rounded" data-contact-id="live:{{ $application->skype_id }}"
                              data-text="Call"></span>
                      @endif
                  </p>
              </div>
              <div class="row">
                  @if ($application->status->status == 'interview' && is_null($application->schedule))
                      <div class="col-sm-6">
                          <p class="text-muted">
                              <a onclick="createSchedule('{{ $application->id }}')" href="javascript:;"
                                  class="btn btn-sm btn-info">@lang ('modules.interviewSchedule.scheduleInterview')</a>
                          </p>
                      </div>
                  @endif
              </div>
          </div>
          <div class="col-12" id="skills-container">
              <hr>
              <div class="form-group mb-2 select-dropdown">
                  <h5>@lang('modules.jobApplication.skills')</h5>
                  <select name="skills[]" id="skills" class="form-control select2" multiple="multiple">
                      @foreach ($skills as $skill)
                          <option @if (!is_null($application->skills) && in_array($skill->id, $application->skills)) selected @endif value="{{ $skill->id }}">
                              {{ $skill->name }}</option>
                      @endforeach
                  </select>
              </div>
              <a href="javascript:addSkills({{ $application->id }});" id="add-skills"
                  class="btn btn-sm btn-outline-success">
                  @if (!is_null($application->skills) && sizeof($application->skills) > 0)
                      @lang('modules.jobApplication.updateSkills')
                  @else
                      @lang('modules.jobApplication.addSkills')
                  @endif
              </a>
          </div>
          <div class="col-12 mt-3">
              <h5>@lang('modules.jobApplication.applicantNotes')</h5>
          </div>

          <div id="applicant-notes" class="col-sm-12">
              <ul class="list-unstyled">
                  @foreach ($application->notes as $key => $notes)
                      <li class="media mb-3" id="note-{{ $notes->id }}">
                          <div class="media-body">
                              <h6 class="mt-0 mb-1">{{ ucwords($notes->user->name ?? '') }}
                                  <span class="pull-right font-italic font-weight-light"><small>
                                          {{ Carbon\Carbon::parse($notes->created_at)->format('d-m-Y') }} </small>

                                      <a href="javascript:;" class="edit-note" data-note-id="{{ $notes->id }}"><i
                                              class="fa fa-edit ml-2" title="Edit"></i></a>
                                      <a href="javascript:;" class="delete-note" data-note-id="{{ $notes->id }}"
                                          title="Delete"><i class="fa fa-trash ml-1 text-danger"></i></a>
                                  </span>
                              </h6>
                              <small class="note-text">{{ ucfirst($notes->note_text) }}</small>
                              <div class="note-textarea"></div>
                          </div>
                      </li>
                  @endforeach
              </ul>
          </div>

          <div class="col-sm-12">
              <div class="form-group mb-2">
                  <textarea name="note" id="note_text" cols="30" rows="2" class="form-control"></textarea>
              </div>
              <a href="javascript:;" id="add-note" class="btn btn-sm btn-outline-primary">@lang('modules.jobApplication.addNote')</a>
          </div>




      </div>

  </div>

  <script src="{{ asset('asset/js/jquery.barrating.min.js') }}" type="text/javascript"></script>
  <script>
      $('#example-fontawesome').barrating({
          theme: 'fontawesome-stars',
          showSelectedRating: false,
          onSelect: function(value, text, event) {
              if (event !== undefined && value !== '') {
                  var url = "{{ route('recruit.job-applications.rating-save', ':id') }}";
                  url = url.replace(':id', {{ $application->id }});
                  var token = '{{ csrf_token() }}';
                  var id = {{ $application->id }};
                  $.ajax({
                      type: 'Post',
                      url: url,
                      container: '#example-fontawesome',
                      data: {
                          'rating': value,
                          '_token': token
                      },
                      success: function(response) {
                          $('#example-fontawesome_' + id).barrating('set', value);
                          Toaster('success', response.status);
                      }
                  });
              }

          }
      });
      @if ($application->rating !== null)
          $('#example-fontawesome').barrating('set', {{ $application->rating }});
      @endif
  </script>
  <script>
      $('.select2').select2();

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
                  if (response.status) {
                      //  $('#job_application').modal('hide');
                      Toaster('success', response.status);
                      if (typeof table !== 'undefined') {
                          table._fnDraw();
                      } else {
                          loadData();
                      }

                      //  setTimeout(function() {
                      //      location.reload(true);
                      //  }, 3000);
                  }
              }
          })

      }

      function deleteApplication(applicationId) {
          swal({
                  title: `Are you sure you want to delete this record?`,
                  text: "If you delete this, it will be gone forever.",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
              })
              .then((isConfirm) => {
                  if (isConfirm) {

                      var url = "{{ route('recruit.job-applications.destroy', ':id') }}";
                      url = url.replace(':id', applicationId);

                      var token = '{{ csrf_token() }}';

                      $.ajax({
                          type: 'POST',
                          url: url,
                          data: {
                              '_token': token,
                              '_method': 'DELETE'
                          },
                          success: function(response) {
                              if (response.success) {
                                  $('#job_application').modal('hide');
                                  Toaster('success', response.success);

                                  setTimeout(function() {
                                      location.reload(true);
                                  }, 3000);
                              }
                          }
                      });
                  }
              });
      }

      function archiveApplication(applicationId) {
          swal({
                  title: `Are you sure?`,
                  text: "You can view archived application in Candidate Database. Do you want to archive it?",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,

              })
              .then((isConfirm) => {
                  if (isConfirm) {

                      var url = "{{ route('recruit.job-applications.archiveJobApplication', ':id') }}";
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
                              Toaster('success', 'Application Archived Successfully.');

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
          var id = {{ $application->id }};
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
  @if (!is_null($application->skype_id))
      <script src="https://swc.cdn.skype.com/sdk/v1/sdk.min.js"></script>
  @endif
