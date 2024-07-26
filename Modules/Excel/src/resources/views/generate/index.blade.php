<x-app-layout>
    @push('head-script')
        <link rel="stylesheet" href="//cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    @endpush
    @section('title', $pageTitle)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between ">
                        <h6 class="tx-15 mg-b-0">Excel Sheet</h6>
                        
                    </div>
                </div>
                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                    <div class="card-body">
                        <div class="table-responsive m-t-40">
                            <table id="myTable" class="table border table_wrapper ">
                                <thead>
                                    <tr>
                                        <th style="width:25%;">#</th>
                                        <th style="width:25%;">Sheet Name</th>
                                        <th style="width:25%;">Status</th> 
                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                            <th style="width:25%;" >@lang('app.action')</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody> 
                                        @forelse($content->excelsheet as $key => $excel)
                                            <tr>
                                                <td style="width:25%;">{{ $key + 1 }}</td>
                                                <td style="width:25%;">{{ $excel->sheet_name }}</td>
                                                <td style="width:25%;">  {{ $excel->status}}  </td>
                                                <td style="width:25%;">
                                                    <button class="btn btn-primary"><a href="{{ route('excel.generate-excel', [$excel->id]) }}" class="text-white">Generate</a></button>
                                                </td>                                                 
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                    <h5 class="text-center mb-0 py-1">No Record Found !</h4>
                                                </td>
                                            </tr>
                                        @endforelse 
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

   

    <!--End delete modal-->
    @push('scripts')
        
    @endpush


</x-app-layout>
