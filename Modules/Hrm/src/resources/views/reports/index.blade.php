<x-app-layout>
    @section('title', 'Reports')
    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
        <div class="card contact-content-body">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="tx-15 mg-b-0">{{ __('hrm.report_list') }}</h6> 
                    
                    <div class="d-flex gap-2">
                        <div>P : Present</div>
                        <div>L : Leave</div>
                        <div>PL : Paid Leave</div>
                        <div>S : Salary</div>
                        <div class="mb-3 gap-3">
                            <a class="btn btn-sm btn-bg  btn-primary" onclick="exportReports()">{{ __('hrm.export') }}</a>
                        </div>
                    </div> 
                </div>
            </div>
            
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group  col-md-4">
                        <select class="form-control select2" id="user_id" name="user_id">
                            <option value="all">All</option>
                            @if (!empty($content->stafflist))
                                @foreach ($content->stafflist as $key => $user_list)
                                    <option value="{{ $user_list->staff_id }}">{{ $user_list->staff_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                      
                    <div class="form-group   col-md-4">
                        <select class="form-control select2" name="year" id="year">
                            <option value="all">All Year</option>
                            @for($i=2020; $i<=2040; $i++)
                                <option @if ($i == $content->year) selected @endif value="{{ $i }}">
                                    {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
    
                </div>
                <div class="table-responsive reportList" id="reportList">
                    <table class="table  table_wrapper">
                        <thead> 
                            <tr class="text-center">
                                <th>Employee</th>
                                <th>Jan</th>
                                <th>Feb</th>
                                <th>Mar</th>
                                <th>Apr</th>
                                <th>May</th>
                                <th>Jun</th>
                                <th>Jul</th>
                                <th>Aug</th>
                                <th>Sep</th>
                                <th>Oct</th>
                                <th>Nov</th>
                                <th>Dec</th>
                                <th>Total</th>
    
                            </tr>
                        </thead>

                        <tbody>
                               @foreach($content->monthWiseData as $monthWise)
                                <tr>
                                    <td>{{ $monthWise->staff_name }}</td> 
                                    @foreach ($monthWise->list as $record) 
                                    <td>
                                        <table class="border" width="100">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div>&nbsp;P : </div>
                                                            <div> &nbsp;<b> {{ $record->attend }}</b></div>
                                                        </div>
                                                    </td>
                    
                                                </tr>
                                                <tr>
                                                    <td>  
                                                        <div class="d-flex">
                                                            <div>&nbsp;L : </div>
                                                            <div>  &nbsp;<b> {{ $record->leave }}</b></div>
                                                        </div>
                                                    </td>
                    
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div>&nbsp;PL : </div>
                                                            <div> &nbsp;<b> {{ $record->paid_leave }}</b></div>
                                                        </div>
                                                    </td>
                    
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div>&nbsp;S :</div>
                                                            <div> &nbsp;<b>{{ $record->salaryAmt }}</b></div>
                                                        </div>
                                                    </td>
                    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    @endforeach 
                                    <td>
                                        <table class="border" width="100">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div>&nbsp;P : </div>
                                                            <div> &nbsp;<b> {{ $monthWise->total['0']->TP }}</b></div>
                                                        </div>
                                                    </td>
                    
                                                </tr>
                                                <tr>
                                                    <td>  
                                                        <div class="d-flex">
                                                            <div>&nbsp;L : </div>
                                                            <div>  &nbsp;<b> {{ $monthWise->total['0']->TL }}</b></div>
                                                        </div>
                                                    </td>
                    
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div>&nbsp;PL : </div>
                                                            <div> &nbsp;<b> {{ $monthWise->total['0']->TPL }}</b></div>
                                                        </div>
                                                    </td>
                    
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div>&nbsp;S :</div>
                                                            <div> &nbsp;<b>{{ $monthWise->total['0']->TS }}</b></div>
                                                        </div>
                                                    </td>
                    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                               @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    @endif
 
    @push('scripts')
    <script>
        $(document).ready(function() {

            $('#user_id,#year').on('change', function(e, data) {

                if ($('#user_id').val() != "all") {

                    ajaxSubsmisstionData();
                }  else if ($('#year').val() != "all") {

                    ajaxSubsmisstionData();
                } else {

                    ajaxSubsmisstionData();
                }

            });
        });


        function ajaxSubsmisstionData() {
            var user_id = $('#user_id').val(); 
            var year = $('#year').val(); 
            tableWebContent(user_id, year);
        }

        function tableWebContent(user_id, year) {

        const url = "{{ route('hrm.report-employee') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: "POST",
            data: {
                user_id: user_id, 
                year: year,
            },
            dataType: "json",
            success: function(result) {
                console.log(result[0]);
                var recordData = result[0];

                var html = ` <table class="table  table_wrapper">
                        <thead>  
                            <tr>
                                <th>Employee</th>
                                <th>Jan</th>
                                <th>Feb</th>
                                <th>Mar</th>
                                <th>Apr</th>
                                <th>May</th>
                                <th>Jun</th>
                                <th>Jul</th>
                                <th>Aug</th>
                                <th>Sep</th>
                                <th>Oct</th>
                                <th>Nov</th>
                                <th>Dec</th>
    
                            </tr>
                        </thead>

                        <tbody>`;  
                               $.each(recordData.monthWiseData, function(key, monthWise){
                                html += `<tr>
                                    <td>${ monthWise.staff_name }</td>`; 
                                    $.each(monthWise.list, function(key, record){
                                   html+=`<td>
                                        <table class="border" width="100">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div>P : </div>
                                                            <div> &nbsp;<b>${record.attend}</b></div>
                                                        </div>
                                                    </td>
                    
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex ">
                                                            <div>L : </div>
                                                            <div> &nbsp; <b>${ record.leave }</b></div>
                                                        </div>
                                                    </td>
                    
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex ">
                                                            <div>PL : </div>
                                                            <div> &nbsp;<b>${ record.paid_leave}</b></div>
                                                        </div>
                                                    </td>
                    
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex ">
                                                            <div>S : </div>
                                                            <div> &nbsp;<b>${record.salaryAmt}</b></div>
                                                        </div>
                                                    </td>
                    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>`;
                                });
                                html+=`</tr>`;
                            });
                        html+=`</tbody>
                    </table> `;


                $("#reportList").html(html);
            }
        });
        }
    </script>

    <script>
        function exportReports() {

            var staff = $("#user_id").val();
            var month = $("#month").val();
            var year = $('#year').val(); 




            var url =
                '{{ route('hrm.reportExport') }}';
            // url = url.replace(':staff', staff);
            // url = url.replace(':month', month);
            // url = url.replace(':year', year); 



            window.location.href = url;
        }
    </script>
    @endpush

</x-app-layout>

