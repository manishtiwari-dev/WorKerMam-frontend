<x-app-layout>
    @section('title', 'Report')
    {{-- @dd($content) --}}
    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
        <div class="">

            <div class="tab-content">
                <form action="{{ route('accounts.report.store') }}" method="post" class="needs-validation" novalidate
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-header d-flex align-items-center justify-content-between">

                        <h6 class="tx-15 mb-0">Monthly Report</h6>


                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                @php
                                    $currentmonth = date('m');
                                @endphp
                                <label for="month" class="form-label">{{ __('sales.month') }}<span
                                        class="text-danger">*</span></label>
                                <select class="form-control select2" name="month" id="month" required>
                                    <option value="" selected disabled>Select Month</option>
                                    <option value="01" {{ $currentmonth == '01' ? 'selected' : '' }}>Jaunary
                                    </option>
                                    <option value="02" {{ $currentmonth == '02' ? 'selected' : '' }}>February
                                    </option>
                                    <option value="03" {{ $currentmonth == '03' ? 'selected' : '' }}>March</option>
                                    <option value="04" {{ $currentmonth == '04' ? 'selected' : '' }}>April</option>
                                    <option value="05" {{ $currentmonth == '05' ? 'selected' : '' }}>May</option>
                                    <option value="06" {{ $currentmonth == '06' ? 'selected' : '' }}>June</option>
                                    <option value="07" {{ $currentmonth == '07' ? 'selected' : '' }}>July</option>
                                    <option value="08" {{ $currentmonth == '08' ? 'selected' : '' }}>August</option>
                                    <option value="09" {{ $currentmonth == '09' ? 'selected' : '' }}>September
                                    </option>
                                    <option value="10" {{ $currentmonth == '10' ? 'selected' : '' }}>October
                                    </option>
                                    <option value="11" {{ $currentmonth == '11' ? 'selected' : '' }}>November
                                    </option>
                                    <option value="12" {{ $currentmonth == '12' ? 'selected' : '' }}>December
                                    </option>
                                </select>
                                <div class="invalid-feedback">
                                    Please Select Month
                                </div>

                            </div>
                            <div class="col-md-3">
                                <label for="year" class="form-label">{{ __('sales.year') }}<span
                                        class="text-danger">*</span></label>
                                @php
                                    $currentYear = date('Y');
                                @endphp
                                <select class="form-control select2" name="year" id="years" required>
                                    <option value="" selected disabled>Select Year</option>
                                    @for ($i = $currentYear - 5; $i <= $currentYear + 15; $i++)
                                        <option value="{{ $i }}"
                                            {{ $i == $currentYear ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                                <div class="invalid-feedback">
                                    Please Select Year
                                </div>

                            </div>
                            <div class="col-md-2 mt-4">
                                <input type="submit" id="submit" name="send" class="btn btn-primary"
                                    value="Generate Report">

                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Monthly repots Start --}}
            <div class="card-body mt-3">
                @php
                    $monthName = date('F'); // Get the full month name
                    $abbreviatedMonths = [
                        'January' => 'Jan',
                        'February' => 'Feb',
                        'March' => 'Mar',
                        'April' => 'Apr',
                        'May' => 'May',
                        'June' => 'Jun',
                        'July' => 'Jul',
                        'August' => 'Aug',
                        'September' => 'Sep',
                        'October' => 'Oct',
                        'November' => 'Nov',
                        'December' => 'Dec',
                    ];
                @endphp
                <h4 id="section1" class="mg-b-10 mt-3">
                    <p id="monthlyReport">{{ $abbreviatedMonths[$monthName] }} {{ $currentYear }} Report</p>
                </h4>
                <div data-label="Example" class="df-example">
                    <div class="ht-250 ht-lg-300"><canvas id="chartBar1"></canvas></div>
                </div>
            </div>
            {{-- Monthly Report end --}}

            <div class="tab-content mt-3">
                <form action="{{ route('accounts.annual-report.generate') }}" method="post" class="needs-validation"
                    novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="card-header d-flex align-items-center justify-content-between">

                        <h6 class="tx-15 mb-0">Annual Report</h6>


                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-3">
                                <label for="year" class="form-label">{{ __('sales.year') }}<span
                                        class="text-danger">*</span></label>
                                @php
                                    $currentYear = date('Y');
                                @endphp
                                <select class="form-control select2" name="year" id="annualyear" required>
                                    <option value="" selected disabled>Select Year</option>
                                    @for ($i = $currentYear - 5; $i <= $currentYear + 15; $i++)
                                        <option value="{{ $i }}"
                                            {{ $i == $currentYear ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                                <div class="invalid-feedback">
                                    Please Select Year
                                </div>

                            </div>
                            <div class="col-md-2 mt-4">
                                <input type="submit" id="submit" name="send" class="btn btn-primary"
                                    value="Generate Report">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        {{-- Yearly repots Start --}}
        <div class="card-body mt-3">
            <h4 id="section1" class="mg-b-10">
                <p id="annualReport">{{ $currentYear }} Report</p>
            </h4>

            <div data-label="Example" class="df-example">
                <div class="ht-250 ht-lg-300"><canvas id="chartBar"></canvas></div>
            </div>
        </div>
        {{-- Yearly Report end --}}

        @php
            if (!empty($content)) {
                $daysReport = $content->dayWiseData ?? '';
                $ExpdaysWiseData = $content->ExpdaysWiseData ?? '';
                $annualIncArr = $content->annualIncArr ?? '';
                $annualExpArr = $content->annualExpArr ?? '';

                $eventsExpenseArr = json_encode($ExpdaysWiseData);
                $eventsIncomeArr = json_encode($daysReport);
                $IncomeArr = json_encode($annualIncArr);
                $ExpenseArr = json_encode($annualExpArr);
            }

        @endphp


        <!-- this is use toggle button -->
        @push('scripts')
            {{-- repors chart js --}}
            <script src="{{ asset('lib/chart.js/Chart.bundle.min.js') }}"></script>

            <script>
                function getTotalDaysInCurrentMonth() {
                    const currentDate = new Date();
                    const currentMonth = currentDate.getMonth();
                    const currentYear = currentDate.getFullYear();

                    const lastDayOfCurrentMonth = new Date(currentYear, currentMonth + 1, 0);

                    return lastDayOfCurrentMonth.getDate();
                }
            </script>

            <script>
                $('.select2').select2({});

                const daysInMonth = getTotalDaysInCurrentMonth();

                var incomeArr = @php echo $eventsIncomeArr @endphp;
                var expenseArr = @php echo $eventsExpenseArr @endphp;
                graphArr(daysInMonth, incomeArr, expenseArr);


                $(document).on('change', '#month, #years', function() {
                    const selectedMonth = parseInt($("#month").val(), 10);
                    const selectedYear = parseInt($("#years").val(), 10);
                    const daysInMonth = new Date(new Date().getFullYear(), selectedMonth, 0).getDate();
                    var monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    var date = new Date(2000, selectedMonth - 1, 1);
                    var NameMonth = monthNames[date.getMonth()];
                    var value = NameMonth + ' ' + selectedYear + ' Report';
                    $("#monthlyReport").text(value);

                    const url = "{{ route('accounts.report-chart') }}";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            selectedMonth: selectedMonth,
                            selectedYear: selectedYear,
                        },
                        dataType: "json",
                        success: function(result) {
                            console.log(result);
                            graphArr(daysInMonth, result.content.dayWiseData, result.content.ExpdaysWiseData);

                        }
                    });

                });



                function graphArr(daysInMonth, incomeArr, expenseArr) {
                    const myArray = [];
                    for (let i = 1; i <= daysInMonth; i++) {
                        myArray.push(i);
                    }



                    // Bar chart
                    $(function() {
                        'use strict'

                        var ctxLabel = myArray;
                        var ctxData1 = incomeArr;
                        var ctxData2 = expenseArr;
                        var ctxColor1 = '#0c8842';
                        var ctxColor2 = '#dc3545';

                        var ctx1 = document.getElementById('chartBar1').getContext('2d');


                        if (window.myChart != undefined) {
                            window.myChart.destroy();
                        }
                        // No chart exists on this canvas, create a new chart
                        window.myChart = new Chart(ctx1, {
                            type: 'bar',
                            data: {
                                labels: ctxLabel,
                                datasets: [{
                                    data: ctxData1,
                                    backgroundColor: ctxColor1
                                }, {
                                    data: ctxData2,
                                    backgroundColor: ctxColor2
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                legend: {
                                    display: false,
                                    labels: {
                                        display: false
                                    }
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }


                            }
                        });





                    });
                };

                var AnnIncomeArr = @php echo $IncomeArr @endphp;
                var AnnExpenseArr = @php echo $ExpenseArr @endphp;
                grapAnnual(AnnIncomeArr, AnnExpenseArr);

                $(document).on('change', '#annualyear', function() {
                    const selectedAnnYear = parseInt($(this).val(), 10);
                    var value = selectedAnnYear + ' Report';
                    $("#annualReport").text(value);
                    const url = "{{ route('accounts.report-Ann-chart') }}";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            selectedAnnYear: selectedAnnYear
                        },
                        dataType: "json",
                        success: function(result) {
                            grapAnnual(result.content.annualIncArr, result.content.annualExpArr);
                        }
                    });

                });

                function grapAnnual(AnnIncomeArr, AnnExpenseArr) {
                    $(function() {
                        'use strict'

                        var ctxLabel = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                        var ctxData1 = AnnIncomeArr;
                        var ctxData2 = AnnExpenseArr;
                        var ctxColor1 = '#0c8842';
                        var ctxColor2 = '#dc3545';
                        // Bar chart
                        var ctx1 = document.getElementById('chartBar').getContext('2d');
                        if (window.myAnnChart != undefined) {
                            window.myAnnChart.destroy();
                        }
                        // No chart exists on this canvas, create a new chart

                        window.myAnnChart = new Chart(ctx1, {
                            type: 'bar',
                            data: {
                                labels: ctxLabel,
                                datasets: [{
                                    data: ctxData1,
                                    backgroundColor: ctxColor1
                                }, {
                                    data: ctxData2,
                                    backgroundColor: ctxColor2
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                legend: {
                                    display: false,
                                    labels: {
                                        display: false
                                    }
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }


                            }
                        });


                    });
                };
            </script>
        @endpush









    @endif









</x-app-layout>
