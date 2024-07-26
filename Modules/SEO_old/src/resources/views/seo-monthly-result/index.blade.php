@php
    $api_token = request()->cookie('api_token');
    
    $userdata = Cache::get('userdata-' . $api_token);
    
@endphp

<x-app-layout>
    @section('title', $pageTitle)

    @if (Session::has('error'))
        <p class="alert alert-danger">{{ Session::get('error') }}</p>
    @endif
    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
        <div class="card ">
            <div class="tab-content">
                <form id="save-website-data" action="" class="g-3 needs-validation" novalidate method="post">
                    <div class="card-header justify-content-between d-lg-flex">
                        @if ($userdata->userType != 'subscriber')
                            <div class="col-lg-3 ">
                                <div class="d-flex align-items-center mb-lg-0 mb-2 gap-2">
                                    <label class="mb-0">{{ __('seo.website') }}</label>
                                    <select class=" form-control mx-3 select2" name="website_id" id="website_id" required>
                                        <option selected="" value="" disabled>{{ __('seo.select') }}</option>
                                        @foreach ($content->web_setting as $web)
                                            <option data-content="{{ ucfirst($web->website_name) }}"
                                                value="{{ $web->id }}">{{ ucfirst($web->website_name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @else
                            {{-- @dd($web_setting_list) --}}
                            <input type="hidden" name="website_id" id="website_id"
                                value="@if (!empty($content->web_setting_list->id)) {{ $content->web_setting_list->id }} @endif" />

                        @endif


                        <div class="col-lg-3">
                            <div class="d-flex align-items-center mb-lg-0 mb-2 gap-2">
                                <label class="mb-0">{{ __('seo.month') }}</label>
                                <select class="form-select form-control mx-3 select2" name="month" id="month">
                                    <option selected="" value="" disabled>select</option>
                                    <option @if ($content->month == '1') selected @endif value="1">
                                        {{ __('seo.january') }}</option>
                                    <option @if ($content->month == '2') selected @endif value="2">
                                        {{ __('seo.february') }}</option>
                                    <option @if ($content->month == '3') selected @endif value="3">
                                        {{ __('seo.march') }}</option>
                                    <option @if ($content->month == '4') selected @endif value="4">
                                        {{ __('seo.april') }}</option>
                                    <option @if ($content->month == '5') selected @endif value="5">
                                        {{ __('seo.may') }}</option>
                                    <option @if ($content->month == '6') selected @endif value="6">
                                        {{ __('seo.june') }}</option>
                                    <option @if ($content->month == '7') selected @endif value="7">
                                        {{ __('seo.july') }}</option>
                                    <option @if ($content->month == '8') selected @endif value="8">
                                        {{ __('seo.august') }}</option>
                                    <option @if ($content->month == '9') selected @endif value="9">
                                        {{ __('seo.september') }}</option>
                                    <option @if ($content->month == '10') selected @endif value="10">
                                        {{ __('seo.october') }}</option>
                                    <option @if ($content->month == '11') selected @endif value="11">
                                        {{ __('seo.november') }}</option>
                                    <option @if ($content->month == '12') selected @endif value="12">
                                        {{ __('seo.december') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="d-flex align-items-center mb-lg-0 mb-2 gap-2">
                                <label class="mb-0">{{ __('seo.year') }}</label>
                                <select class="form-select form-control mx-3 select2" name="year" id="year" required>
                                    <option selected="" value="" disabled>{{ __('seo.select') }}</option>
                                    @for ($i = 2021; $i <= $content->year; $i++)
                                        <option {{ $content->year == $i ? 'selected' : '' }}>{{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 d-flex justify-content-end d-flex gap-3">
                            <div class="align-items-center mr-2 mb-lg-0 mb-2">
                                <input type="submit" id="get_details" class="btn btn-primary get_details"
                                    value="Get Details">
                            </div>

                            <div class="align-items-center">
                                 
                            <form action="{{ route('seo.export-monthly-result') }}" method="POST">
                                @csrf

                                <input type="hidden" name="web_site" id="website_monthly"
                                    value="@if (!empty($web_setting_list->id)) {{ $web_setting_list->id }} @endif" />
                                <input type="hidden" name="monthly" id="monthly" />
                                <input type="hidden" name="yearly" id="yearly" /> 

                                <input type="submit" id="export_monthly" class="btn btn-primary"
                                    value="{{ __('seo.export') }}">
                            </form> 
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" id="table_bind">
                            <table class="table  table_wrapper">
                                <thead>
                                    <tr>
                                        <th class="  border-bottom ">{{ __('seo.title') }}</th>
                                        <th class=" text-centerborder-bottom ">{{ __('seo.sub_title') }}
                                        </th>
                                        <th class=" text-centerborder-bottom">
                                            {{ __('seo.result') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3">
                                            <h5 class="text-center mb-0 py-1">{{ __('common.no_record') }}</h4>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="mt-2 d-none" id="date-hide">
                            <input type="button" id="get_details" class="btn btn-primary website-form" value="Update">
                        </div>
                    </div>

                </form>

            </div>
        </div>
    @endif
    <!--end container-->

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.get_details').on('click', function(e) {
                    e.preventDefault();
                    var data = {
                        website_id: $("#website_id").val(),
                        month: $("#month").val(),
                        year: $("#year").val(),
                    };


                    var y = new Date();
                    years = y.getFullYear();
                    var Months = new Date().getMonth() + 1;

                    if (data.year == years && data.month > Months) {
                        toastr.error('No data available of Future Select');
                    } else if (data.year > years && data.month > Months) {
                        toastr.error('No data available of Future Select m');
                    } else if (data.year > years) {
                        toastr.error('No data available of Future Select m');
                    } else {


                        if (data.website_id != null) {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                type: "POST",
                                url: "{{ route('seo.get-monthly-result') }}",
                                data: data,
                                dataType: "json",
                                success: function(response) {
                                    var html = `<div class="table-responsive">
                                    <table class=" table mb-0">
                                    <thead>
                                        <tr>
                                            <th class="  border-bottom ">{{ __('seo.title') }}</th>
                                            <th class=" text-centerborder-bottom ">{{ __('seo.sub_title') }}</th>
                                            <th class=" text-centerborder-bottom ">{{ __('common.result') }}</th>
                                        </tr>
                                    </thead><tbody>`;

                                    $.each(response.seo_title, function(key, parentData) {
                                        console.log(parentData);
                                        html += `<tr>
                                            <td>${parentData.title_name}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>`;
                                        if (parentData.child != '') {
                                            $.each(parentData.child, function(childKey,
                                                child) {
                                                if (parentData.id == child
                                                    .parent_id) {

                                                    var result_value = '';
                                                    if (response.seo_result[child
                                                            .id] !=
                                                        null)

                                                        var result_value = response
                                                            .seo_result[child.id];

                                                    html += `<tr>
                                                        <td></td>
                                                        <td>${child.title_name} </td>
                                                        <td><input type="text" class="form-control height-35 f-14" name="result_value[]" value="${result_value}">
                                                        <input type="hidden" name="title_id[]" value="${child.id}">
                                                        </td>
                                                </tr>`;
                                                }

                                            });
                                        }
                                    });
                                    html += `</tbody>
                                </table>
                                </div>`;
                                    $('#date-hide').removeClass("d-none");
                                    $("#table_bind").html(html);
                                }
                            });

                        } else {
                            Toaster("error", "Please Select Website");
                        }
                    }
                });
            });
        </script>

        <script>
            $('.website-form').on('click', function(e) {
                e.preventDefault();
                const url = "{{ route('seo.save-website-update') }}";
                $.ajax({
                    url: url,
                    container: '#save-website-data',
                    type: "POST",
                    data: $('#save-website-data').serialize(),
                    success: function(response) {
                        //Toaster(response.success);
                        if (response.success) {
                            Toaster("success", response.success);
                        } else {
                            Toaster("error", response.error);
                        }
                        location.reload();
                    }
                })
            });


            $("#export_monthly").click(function(e) {
                e.preventDefault();

                $('#save-website-data').attr('action', "{{ route('seo.export-monthly-result') }}");

                var website = $("#website_id").val();
                if (website == null) {
                    toastr.error('Please Select Website');
                } else {

                    var website = $("#website_id").val();
                    var year = $("#year").val();
                    var month = $("#month").val();


                    $("#monthly").val(month);
                    $("#yearly").val(year);
                    $("#website_monthly").val(website);

                    $("#save-website-data").submit();
                }

            });

            $(".form-control:valid").css({
                    "border-color": "#ced4da",
                    "box-shadow": "none",
                    "background-image": "none",
                }

            );
        </script>
    @endpush
</x-app-layout>
