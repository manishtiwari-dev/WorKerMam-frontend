@if (count($jobQuestion) > 0)
    @forelse($jobQuestion as $question)
        <div class="row">
            <div class="col-md-12 pb-4 pt-4">
                <div class="form-group">
                    <label class="control-label" for="answer[{{ $question->id }}]">
                        {{ $question->question }}
                    </label><br>
                    @php  
                        $ques_answers = collect($question->answers)->first(); 
                    @endphp

                    @if ($question->type == 'text')
                        <input class="form-control" type="text" id="answer[{{ $question->id }}]"
                            name="answer[{{ $question->id }}]" placeholder="@lang('modules.front.yourAnswer')"
                            value="{{ (!is_null($ques_answers)) ? $ques_answers->answer : null }}">
                    @else
                        @if (is_null($question->answers->first()))
                            <input type="hidden" name="answer[{{ $question->id }}]">
                        @endif
                        <input class="select-file " accept=".png,.jpg,.jpeg,.pdf,.doc,.docx,.xls,.xlsx,.rtf"
                            type="file" id="answer[{{ $question->id }}]" name="answer[{{ $question->id }}]"
                            value="{{ !is_null($question->answers->first()) ? $question->answers->first()->file_url : null }}"><br>
                        <span>@lang('modules.front.resumeFileType')</span><br>
                        @if (!is_null($question->answers->first()))
                            <a target="_blank" href="{{ $question->answers->first()->file_url }}"
                                class="btn btn-sm btn-primary mt-2">@lang('app.view') @lang('app.file')</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @empty
    @endforelse
@endif
