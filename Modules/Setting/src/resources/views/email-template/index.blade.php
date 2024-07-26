<x-app-layout>   
<div class="container-fluid">
    <div class="layout-specing">
        <div class="row">
            <div class="col-md-12 col-lg-12 my-0">
                <div class="card rounded shadow pb-1">
                    <div class=" border-0 quotation_form">
                        <div class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                            <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('settings.email_templte_list')}}</h5>
                            <div >
                                <button class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#create_modal_id" id="add_btn_id"><i data-feather="plus" class="lead_icon mg-r-5"></i>{{ __('settings.add_email_template')}}</button></a>
                            </div>
                        </div>  
                    </div>          
                    <div class="p-4 mt-1">
                        <div class="table-responsive shadow rounded">
                            <table class="table table-center bg-white mb-0">
                                <thead>
                                    <tr>
                                        <th class="border-bottom p-3">{{ __('common.sl_no')}}</th>
                                        <th class="border-bottom p-3" style="min-width: 220px;">{{ __('settings.template_subject')}}</th>
                                        <th class="border-bottom p-3" style="min-width: 220px;">{{ __('common.status')}}</th>
                                        <th class="text-left border-bottom p-3">{{ __('common.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($template_list))
                                    @foreach($template_list as $key=>$template)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <td>{{$template->template_subject}}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                              <input data-id="{{$template->template_id}}" class="form-check-input toggle-class" role="switch" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $template->status ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td id="action">
                                            <div class="d-flex align-items-center"> 
                                                <a href="javascript:void(0)" class="btn btn-primary btn-xs btn-icon table_btn edit_btn" data-bs-toggle="modal" data-bs-target="#edit_modal" data-id="{{$template->template_id}}"><i class="uil uil-edit"></i></a>
                                                <a href="javascript:void(0)" id="delete_btn"  data-id="{{$template->template_id}}" data-toggle="modal" data-target="#delete_modal" class="btn btn-danger btn-xs btn-icon del_btn"><i class="uil uil-trash-alt"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 <!--paginaion open -->
                 <div class="row text-center px-2  mb-4" id="pagination_setting_group">
                    <div class="col-12 mt-4">
                        <div class="d-md-flex align-items-center text-center justify-content-between">
                            <span class="text-muted me-3">Showing {{$template_list->currentPage();}} -
                                {{$template_list->lastItem();}} out of {{$template_list->total()}}</span>
                            <ul class="pagination mb-0 justify-content-center mt-4 mt-sm-0">
                                {{ $template_list->links() }}
                            </ul>
                        </div>
                    </div>
                </div><!--paginaion close --> 
            </div><!--end col-->
        </div> <!--end row-->     
    </div>
</div>
<!--end container-->
   
    <!--start createForm modal-->
        <div class="modal fade" id="create_modal_id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="mb-0">{{ __('settings.add_templates')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <form id="create_form_id" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="groupid" class="form-label">{{ __('settings.group_name')}}<span class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <select class="form-select"  id="groupid" name="groupid" aria-label="Default select example"  required>
                                        <option selected disabled value="">{{ __('settings.group_name_select')}}</option>
                                        @foreach($email_group as $email)
                                        <option  value="{{$email->group_id}}" {{$email->group_id == $id ? 'selected' : '' }}>{{$email->group_name ?? ''}}</option>
                                        @endforeach    
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ __('settings.group_name_select')}}
                                        </div>
                                </div>
                                
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('settings.templates_subject')}}<span class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <input name="templatesubject" id="templatesubject" type="text" class="form-control" placeholder="{{ __('settings.templates_subject_placeholder')}}" required>
                                    <div class="invalid-feedback">
                                    {{ __('settings.template_subject_error')}}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{ __('settings.templates_content')}}<span class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <textarea cols="40" rows="10" name="template_content" id="editor1" class="form-control" required></textarea>                                   
                                    <div class="invalid-feedback">
                                    {{ __('settings.template_contect_error')}}
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <input type="submit" id="submit_btn_id" name="send" class="btn btn-primary" value="{{ __('common.submit')}}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--end createForm modal-->

    <!--start editForm modal-->
    <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="mb-0">{{ __('settings.update_templates')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <form id="edit_form_id" class="needs-validation" novalidate>
                        <input type="hidden" class="form-control " value="" name="template_id_input" id="template_id">
                        <div class="mb-3">
                            <label for="group_id" class="form-label">{{ __('settings.group_name')}}<span class="text-danger">*</span></label>
                            <div class="form-icon position-relative">
                                <select class="form-select" id="group_id" name="group_id" aria-label="Default select example"  required>
                                    @foreach($email_group as $email)
                                    <option value="{{$email->group_id}}">{{$email->group_name ?? ''}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                {{ __('settings.group_name_select')}} 
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('settings.templates_subject')}}<span class="text-danger">*</span></label>
                            <div class="form-icon position-relative">
                                <input name="templatesubject" id="update_template_subject" type="text" class="form-control" placeholder="{{ __('settings.templates_subject_placeholder')}}" required>
                                <div class="invalid-feedback">
                                {{ __('settings.template_subject_error')}}
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('settings.templates_content')}}<span class="text-danger">*</span></label>
                            <div class="form-icon position-relative" id="outer_div">
                                <textarea  cols="80" rows="10" name="template_content" id="update_template_content" class="form-control document" required>
                                </textarea>
                                <div class="invalid-feedback">
                                {{ __('settings.template_contect_error')}}
                            </div>
                        </div>
                        <div class="pt-3 ">
                            <button type="submit" id="update_btn" name="send" class="btn btn-primary">{{ __('common.update')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!--end editForm modal-->
   
    <!--start delete modal-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('settings.delete_email_template')}} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <h5> Are you sure want to delete ?</h5>
                    <input type="hidden" id="delete_temp_id" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('settings.close')}}</button>
                    <button type="submit"  class="btn btn-primary delete_temp">{{ __('common.delete')}} </button>
                </div>
            </div>
        </div>
    </div> <!--end delete modal-->

@push('scripts')
<script type="text/javascript" src="{{asset('assets/js/ckeditor.js')}}"></script>

<!--start toggle-->
<script>
    $('.toggle-class').change(function() {

        var status = $(this).prop('checked') == true ? 1 : 0; 
        var temp_id = $(this).data('id');
        console.log('change');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{route('templateChangeStatus')}}",
            data: {'status': status, 'temp_id': temp_id},
            success: function(response){
                Toaster('Status Changed Successfully')
            },
              error: function(response) {
                var errors = response.responseJSON;
                console.log(errors);
            }
        });
    });
</script><!--end toggle-->

<!--start create form ajax-->
<script>
    $(document).ready(function() {
            
            $("#submit_btn_id").click(function(e){
            e.preventDefault();

            var data = {
                template_subject: $("#templatesubject").val(),
                template_content: $("#editor1").val(),
                group_id: $("#groupid").val(),
            };
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{route('email-template-data.store')}}",
                data: data,
                dataType: "json",
                success: function(response) {
                    $('#create_form_id').trigger("reset");
                    $('#create_modal_id').modal('hide');
                    Toaster('Template Added Successfully!');
                              setTimeout(function () {
                                location.reload(true);
                                }, 3000);
                    
                },
            });
        });
    });
</script><!--end createForm ajax-->

<!--start editForm ajax-->
<script>
    $(document).ready(function(){
        $(".edit_btn").on("click",function(e) {
            e.preventDefault();
            var temp_id = $(this).data('id');
            
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
            url: "{{route('ajax-template-edit')}}",
            type: "GET",
            data: {temp_id:temp_id},
            success: function(response) {
                console.log(response.data);
                $('#group_id').val(response.data.group_id); 
                $('#template_id').val(response.data.template_id);
                $('#update_template_subject').val(response.data.template_subject); 
                $('#update_template_content').html(response.data.template_content); 
                try {
                    ClassicEditor.create(document.querySelector('#update_template_content'))
                    .catch(error => {
                        console.error(error);
                    });
                }catch(err){

                }
            },
            error: function(response) {
                var errors = response.responseJSON;
                console.log(errors);
            }
            });
        });
    });
</script><!--end editForm ajax-->

<!--start update ajax-->
<script>
    $(document).ready(function() {
        $(document).on("submit", "#edit_form_id", function(e) {
            e.preventDefault();
            var temp_id = $("#template_id").val();
            var data = {
                template_id: temp_id,
                group_id: $("#group_id").val(),
                template_subject: $('#update_template_subject').val(),
                template_content: $('#update_template_content').val(),
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{route('ajax-templateUpdate')}}",
                data: data,
                dataType: "json",
                success: function(response) {
                     $('#edit_modal').modal('hide');
                    Toaster('Template Updated Successfully!');
                              setTimeout(function () {
                                location.reload(true);
                                }, 3000);
                },
            });
        });
    });
</script><!--end update ajax-->

<!-- start delete ajax-->
<script>
    $(document).ready(function(){
        $('.del_btn').on('click', function(e){
         e.preventDefault();
         var temp_id = $(this).data('id');
         var  temp_id = $('#delete_temp_id').val(temp_id);
         $('#delete_modal').modal('show');
        });
        $(document).on("click", ".delete_temp", function() {
            var temp_id = $('#delete_temp_id').val();
            $('#delete_modal').modal('hide');
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            $.ajax({
                type: "POST",
                url: "{{route('templateDelete')}}",
                data: {
                    temp_id: temp_id
                },
                dataType: "json",
                success: function(response) {
                    
                    $('#delete_modal').modal('hide');
                   Toaster('Template Deleted Successfully!');
                              setTimeout(function () {
                                location.reload(true);
                                }, 3000);
                }
            });
        });
    });
</script><!--end delete ajax-->
@endpush
</x-app-layout>
