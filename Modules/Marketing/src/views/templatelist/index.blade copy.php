<x-app-layout>
    @section('title', 'Template List')

@if(!empty($data->id))
 {{ session()->put('temlategroup',$data->id)}}
@endif
<!--index table start-->
<div class="card contact-content-body">
    <div class="card-header">
        <div class="d-flex align-items-center justify-content-between">
            @if(!empty($data->group_name))
            <h6 class="tx-15 mg-b-0">{{$templategroup->group_name}}</h6>
            @else
            <h6 class="tx-15 mg-b-0">E-mail Templates</h6>
            @endif
            <a href="{{ route('marketing.template-list.create') }}" class="btn btn-sm btn-bg"><i data-feather="plus"></i>{{ __('newsletter.add_template_list')}}</a>
        </div>
    </div>
    <div class="card-body">
        <div class="form-row">
            <div class="form-group mg-l-5">
                <input type="text" class="form-control" id="Search" placeholder="{{ __('newsletter.search_placeholder')}}">
            </div>
        </div>
        <div class="table-responsive">
            @if(!empty($data))  
                <table class="table border table_wrapper" id="template_list_data_reload">
                    <thead>
                        <tr>
                            <th>{{ __('common.sl_no') }}</th>
                            <th>{{ __('common.date') }}</th>
                            <th>{{ __('newsletter.subject')}}</th>
                            <th>{{ __('common.status') }}</th>
                            <th class="text-center wd-10p">{{ __('common.action') }}</th>
                        </tr>
                    </thead>
                    <tbody id="Search_Tr">
                        @if (!empty($data))
                        @foreach ($data as $key => $templategroup)
                        <tr>  
                            <td>{{ $key + 1 }}</td>
                            <td>  {{ date('d-M-Y', strtotime($templategroup->created_at ?? '')) }}</td>
                            <td>{{ $templategroup->subject ?? '' }}</td>
                            <td>
                                <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input toggle-class" {{ $templategroup->status == '1' ? 'checked' : '' }} data-id="{{$templategroup->id}}" id="customSwitch{{$templategroup->id}}">
                                <label class="custom-control-label" for="customSwitch{{$templategroup->id}}"></label>
                                </div>
                            </td>
                            <td class="d-flex align-items-center">
                                <a href="{{ route('marketing.template-list.show', $templategroup->id) }}" target="_blank" class="btn btn-sm btn-white d-flex align-items-center mg-r-5"><i data-feather="eye"></i></a>
                                <a href="{{ route('marketing.template-list.edit', $templategroup->id) }}" class="btn btn-sm btn-white d-flex align-items-center mg-r-5"><i data-feather="edit-2"></i></a>
                                
                                <button data-id="{{ $templategroup->id }}" data-toggle="modal" data-target="#delete_modal" class="btn btn-sm btn-white d-flex align-items-center mg-r-5 del_button"><i data-feather="trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            @else
                <div class="table-responsive">
                    <table class="table border table_wrapper">
                        <thead>
                            <tr>
                                <th>{{ __('common.sl_no') }}</th>
                                <th>{{ __('newsletter.subject') }}</th>
                                <th>{{ __('common.status') }}</th>
                                <th class="text-center wd-10p">{{ __('common.action') }}</th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr>
                                <td>1</td>
                                <td>TEMPLATE LIST</td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input toggle-class" {{'1' == '1' ? 'checked' : '' }} data-id="1" id="customSwitch.'1'">
                                        <label class="custom-control-label" for="customSwitch.'1'"></label>
                                    </div>
                                </td>
                                <td class="d-flex align-items-center">
                                    <a href="{{ route('marketing.template-list.edit','1') }}" class="btn btn-sm btn-white d-flex align-items-center mg-r-5"><i data-feather="edit-2"></i></a>
                                    
                                    <button data-id="1" data-toggle="modal" data-target="#delete_modal" class="btn btn-sm btn-white d-flex align-items-center mg-r-5 del_button"><i data-feather="trash"></i></button>
                                </td>   
                            </tr>
                            <tr>
                                <td colspan="5">
                                <h5 class="text-center mb-0 py-1">No Record Found !</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel5">{{ __('newsletter.delete_template_list')}}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>{{ __('settings.deleted_data')}}</h6>
                <input type="hidden" id="delete_id" name="input_field_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                {{ __('common.no')}}
                </button>
                <button type="submit" class="btn btn-primary deleteBtn">{{ __('common.yes') }}</button>
            </div>
        </div>
    </div>
</div>
   
    @push('scripts') 
        <script>
            // start jquery
            $(document).ready(function() {
                $("#Search").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#Search_Tr tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });

                $(document).ready(function() {
                    setTimeout(function() {

                        $("div.alert").remove();
                    }, 3000);
                });

                $(document).ready(function() {
                    $("#addbutton").on('click', function(e) {
                        e.preventDefault();
                        $("#open_modal").modal('show');
                    });
                });
            });

            // change status in ajax code start
            $('.toggle-class').change(function(e) {
                e.preventDefault();
                let status = $(this).prop('checked') === true ? 1 : 0;
                let id = $(this).data('id');
                console.log(id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('marketing/template-list-status') }}",
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(data) {
                        // $("#template_list_data_reload").load(location.href + " #template_list_data_reload");
                        Toaster(data.success);
                    }
                });
            });

            // chenge status in ajax code end  
            $(document).ready(function() {
                $('.del_button').on('click', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    $('#delete_id').val(id);
                });

                $(document).on("click", ".deleteBtn", function() {
                    var id = $('#delete_id').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('marketing/template-list-delete') }}",
                        data: {
                            id: id,
                        },
                        dataType: "json",
                        success: function(response) {
                            Toaster('Template Deleted Successfully!');
                            setTimeout(function() {
                                location.reload(true);
                            }, 1500);
                            try {
                                ClassicEditor.delete(document.querySelector('.del_button'))
                                    .catch(error => {
                                        console.error(error);
                                    });
                            } catch (err) {

                            }
                        },
                    });
                });
            });
            // end delete modal ajax
        </script>
    @endpush
</x-app-layout>
