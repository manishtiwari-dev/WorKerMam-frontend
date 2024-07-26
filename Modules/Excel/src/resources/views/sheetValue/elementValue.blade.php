<x-app-layout>
    @section('title', 'Setting')

    <div class="contact-content">
        <div class="layout-specing">

            <div class="card">
                <div class="tab-content">
                    <div class="card-header">
                        <div class="row">
                            <div class="form-group">
                                <h6 class="tx-15 mg-b-0">{{ $sheetList->sheet_name }}</h6>
                            </div>

                        </div>
                    </div>

                    <div class="card-body">
                        <form id="save-website-data" method="post">
                            <input type="hidden" name="sheet_id" value="{{ $sheetList->id }}">

                            <div class="table-responsive" id="department">
                                <table class="table border table_wrapper">
                                    <thead>
                                        <tr>
                                            <th class="wd-10p">{{ __('common.sl_no') }}</th>
                                            <th class="wd-20p">Element Value</th>

                                        </tr>
                                    </thead>

                                    <tbody>

                                        @php
                                            $k = 1;
                                        @endphp

                                        @foreach ($valueList as $key => $value)
                                            <tr>

                                                <td class="">{{ $key + 1 }}</td>
                                                <td> <input class="form-control" style="width: 220px;" type="text"
                                                        name="element_value_{{ $value->id }}"
                                                        value="{{ $value->element_value ?? '' }}">
                                                </td>

                                                {{-- 

  @if (!@empty($value->element_value))
                                                    <input class="form-control" style="width: 220px;"
                                                     type="text"
                                                    name="element_value_{{ $value->id }}"
                                                    value="{{ $value->element_value ?? '' }}">
                                                    @else
<input class="form-control" style="width: 220px;"
                                                     type="text"
                                                    name="element_value_{{ $value->id }}"
                                                   >
                                                   @endif --}}

                                            </tr>
                                        @endforeach
                                        {{-- <input type="hidden" name="website_id" value="{{ $website_listing->id }}"> --}}
                                    </tbody>

                                </table>
                            </div>
                            <div class="mt-3 px-2 ">
                                <div class="col-sm-12 p-0">
                                    <input type="button" class="btn btn-primary  save-website-form" form-id=""
                                        value="{{ __('common.update') }}" />

                                    <a href="{{ route('excel.sheet-value.index') }}"
                                        class="btn btn-secondary mx-1">Cancel</a>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $('.select2').select2({
                searchInputPlaceholder: 'Select User'
            });



            $(document).ready(function() {
                $('.save-website-form').click(function() {
                    const url = "{{ route('excel.elementUpdate', $sheetList->id) }}";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url,
                        container: '#save-website-data',
                        type: "POST",
                        data: $('#save-website-data').serialize(),
                        success: function(response) {
                            console.log(response);
                            if (response.success) {
                                toastr.success(response.success);
                            } else {
                                toastr.error(response.error);
                            }
                            location.reload();

                        }
                    })
                });



            });
        </script>
    @endpush

</x-app-layout>
