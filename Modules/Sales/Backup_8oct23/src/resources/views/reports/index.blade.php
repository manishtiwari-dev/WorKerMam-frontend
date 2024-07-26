<x-app-layout>
    @section('title', 'Generate Monthly Reports')
    <div class="">
        
        <div class="tab-content">
            <form action="{{ route('accounts.report.store') }}" method="post" class="needs-validation" novalidate
                enctype="multipart/form-data">
                @csrf
                <div class="card-header d-flex align-items-center justify-content-between">
                 
                    <h6 class="tx-15 mb-0">Generate Monthly Reports</h6>
                

                </div>
                <div class="card-body">     
                    <div class="row">
                        <div class="col-md-3">
                            @php
                                $currentmonth = date('m'); 
                            @endphp
                            <label for="month" class="form-label">{{ __('sales.month') }}<span class="text-danger">*</span></label>
                            <select class="form-control select2" name="month" id="month" required>
                                <option value="" selected disabled>Select Month</option>
                                <option value="01" {{($currentmonth == '01')?'selected':''}} >Jaunary</option>
                                <option value="02" {{($currentmonth == '02')?'selected':''}}>February</option>
                                <option value="03" {{($currentmonth == '03')?'selected':''}}>March</option>
                                <option value="04" {{($currentmonth == '04')?'selected':''}}>April</option>
                                <option value="05" {{($currentmonth == '05')?'selected':''}}>May</option>
                                <option value="06" {{($currentmonth == '06')?'selected':''}}>June</option>
                                <option value="07" {{($currentmonth == '07')?'selected':''}}>July</option>
                                <option value="08" {{($currentmonth == '08')?'selected':''}}>August</option>
                                <option value="09" {{($currentmonth == '09')?'selected':''}}>September</option>
                                <option value="10" {{($currentmonth == '10')?'selected':''}}>October</option>
                                <option value="11" {{($currentmonth == '11')?'selected':''}}>November</option>
                                <option value="12" {{($currentmonth == '12')?'selected':''}}>December</option>
                            </select>
                            <div class="invalid-feedback">
                                Please Select Month
                            </div>
                             
                        </div>
                        <div class="col-md-3">
                            <label for="year" class="form-label">{{ __('sales.year') }}<span class="text-danger">*</span></label>
                            @php
                                $currentYear = date('Y');
                            @endphp
                            <select class="form-control select2" name="year" id="year" required>
                                <option value="" selected disabled>Select Year</option>
                                @for($i=$currentYear-5; $i<=$currentYear+15; $i++)
                                <option value="{{$i}}" {{($i==$currentYear)?'selected':''}}>{{$i}}</option>
                                @endfor
                            </select>
                            <div class="invalid-feedback">
                                Please Select Year
                            </div>
                             
                        </div>
                        <div class="col-md-2 mt-4">
                            <input type="submit" id="submit" name="send" class="btn btn-primary"
                                value="Generate">
                            
                        </div>
                    </div>
                </div> 
            </form>
        </div>

        <div class="tab-content mt-3">
            <form action="{{ route('accounts.annual-report.generate') }}" method="post" class="needs-validation" novalidate
                enctype="multipart/form-data">
                @csrf
                <div class="card-header d-flex align-items-center justify-content-between">
                 
                    <h6 class="tx-15 mb-0">Generate Annual Reports</h6>
                

                </div>
                <div class="card-body">     
                    <div class="row">
                         
                        <div class="col-md-3">
                            <label for="year" class="form-label">{{ __('sales.year') }}<span class="text-danger">*</span></label>
                            @php
                                $currentYear = date('Y');
                            @endphp
                            <select class="form-control select2" name="year" id="year" required>
                                <option value="" selected disabled>Select Year</option>
                                @for($i=$currentYear-5; $i<=$currentYear+15; $i++)
                                <option value="{{$i}}" {{($i==$currentYear)?'selected':''}}>{{$i}}</option>
                                @endfor
                            </select>
                            <div class="invalid-feedback">
                                Please Select Year
                            </div>
                             
                        </div>
                        <div class="col-md-2 mt-4">
                            <input type="submit" id="submit" name="send" class="btn btn-primary"
                                value="Generate">
                            
                        </div>
                    </div>
                </div> 
            </form>
        </div>
    </div>



    <!-- this is use toggle button -->
    @push('scripts')
      
       <script>
        $('.select2').select2({});
       </script>
    @endpush
</x-app-layout>
