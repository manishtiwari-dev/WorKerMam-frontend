<x-app-layout>
    @push('scripts')
    @section('title', 'Job Report')
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">
 

    @endpush


    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box mb-2 mb-lg-0">
                <span class="info-box-icon" style="background-color: #95a5a6;"><i
                        class="icon-badge badge-color"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">@lang('modules.report.jobapplication')</span>
                    <span class="info-box-number">{{ $content->jobApplication }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box  mb-2 mb-lg-0">
                <span class="info-box-icon" style="background-color: #9b59b6;"><i
                        class="icon-badge badge-color"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">@lang('modules.report.job')</span>
                    <span class="info-box-number">{{ $content->job }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box  mb-2 mb-lg-0">
                <span class="info-box-icon" style="background-color: #28a745;"><i
                        class="icon-badge badge-color"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">@lang('modules.report.candidatehired')</span>
                    <span class="info-box-number">{{ $content->candidatesHired }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box  mb-2 mb-lg-0">
                <span class="info-box-icon" style="background-color: #3D8EE8;"><i
                        class="icon-badge badge-color"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">@lang('modules.report.interviewschedule')</span>
                    <span class="info-box-number">{{ $content->interviewScheduled }}</span>
                </div>
            </div>
            <!-- /.info-box-content -->
            <!-- /.info-box -->
        </div>
    </div>
     
    <div class="row mt-4">
        <div class="col-12">
            <div class="card contact-content-body">
            <div class="row clearfix">
                        <div class="col-md-12 mb-20" id="">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="tx-15 mg-b-0">@lang('modules.report.jobapplicationstatus')</h6>
                            </div>
                        </div>
                           
                          <div class="card-body">
                            <canvas id="myChart" width="" height="100px">
                          </div>

                        </div>
                    </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="//cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
        <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

        <script src="{{ asset('asset/js/chart.js/Chart.min.js') }}"></script>
        <script>
            //for pie chart
            var chart = document.getElementById("myChart").getContext('2d');
            var cData = JSON.parse(`<?php echo $content->data1->chart_data; ?>`);
            var keys = [];
            var value = [];
            $.each(cData, function(k, v) {
                value.push(v)
                keys.push(k)
            });
            var myChart = new Chart(chart, {
                type: 'pie',
                data: {
                    labels: keys,
                    datasets: [{
                        backgroundColor: [

                            "#95a5a6",
                            "#9b59b6",
                            "#28a745",
                            "#3D8EE8",
                        ],
                        data: value,
                    }]
                }
            });
        </script>
    @endpush
</x-app-layout>
