<x-app-layout>
    @push('scripts')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    @endpush
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row ">
                <div class="col-md-12 col-lg-12 lead_list">
                    <div class="card rounded shadow pb-5">
                        <div class=" border-0 quotation_form">
                            <div class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('settings.form_list')}}</h5>
                                <div>
                                    <a href="{{ route('custom-form.create') }}">
                                    <button class="btn btn-md  btn-primary "><i data-feather="plus"
                                                class="lead_icon mg-r-5"></i>{{ __('settings.add_form')}}</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-outline">                        
                            <div class="p-4 mt-3">
                                <div class="table-responsive">
                                    <table class="table table-center bg-white mb-0" id="datatable">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom" style="min-width:70px;">{{ __('common.sl_no')}}</th>
                                                <th class="border-bottom" style="min-width: 150px;">{{ __('settings.form_name')}}</th>
                                                <th class="border-bottom" style="min-width: 200px;">{{ __('settings.form_shortcode')}}</th>
                                                <th class="border-bottom" style="min-width: 100px;">{{ __('common.status')}}</th>
                                                <th class="text-center border-bottom" style="min-width: 150px;">{{ __('common.action')}} 
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="Search_Tr">

                                            <!-- Start -->
                                            @if (!empty($custom_form))
                                                @foreach ($custom_form as $key => $custom)
                                                    <tr>
                                                        <td class="">{{ $key + 1 }}</td>
                                                        <td class="">{{ $custom->form_name }}</td>
                                                        <td class="">{{ $custom->form_shortcode }}</td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input toggle_status"
                                                                    data-on="Active" data-off="InActive" type="checkbox"
                                                                    role="switch" value="{{ $custom->form_id }}"
                                                                    id="flexSwitchCheckDefault" checked>
                                                            </div>
                                                        </td>
                                                        <td class="text-center d-flex justify-content-center p-3">
                                                            <a href="{{ route('custom-form.edit', $custom->form_id) }}"
                                                                class="btn btn-primary btn-xs btn-icon table_btn"><i
                                                                    class="uil uil-edit"></i></a>
                                                            <form
                                                                action="{{ route('custom-form.destroy', $custom->form_id) }}"
                                                                method="POST" class="">

                                                                @csrf
                                                                {{ method_field('DELETE') }}
                                                                <button type="submit" id="button"
                                                                    class="btn btn-danger btn-xs btn-icon"
                                                                    onclick="return confirm('Are you sure you want to delete')"><i
                                                                        class="uil uil-trash-alt"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                          </div>                          
                        </div>
                    </div>
                </div> <!--end col-->
            </div><!--end row-->
        </div>
    </div>
       
        @push('scripts')
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js">
        </script>
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable();
            } );
        </script>
            <script>
                $(document).ready(function() {
                    $("#Search").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $("#Search_Tr tr").filter(function() {
                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                    });
                });
            </script>
            <script>
                // toggle button used in open
                $(function() {
                    $('.toggle_status').change(function() {

                        var status_id = $(this).val();
                        console.log(status_id);

                        $.ajax({
                            type: "GET",
                            dataType: "json",
                            url: "{{ route('change-status') }}",
                            data: {
                                'status_id': status_id
                            },
                            success: function(data) {
                                console.log(data.success)
                                Toaster('Custom Form Changed Status')
                            }
                        });
                    })
                })

            </script>
        @endpush
</x-app-layout>
