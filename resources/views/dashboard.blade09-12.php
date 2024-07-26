
@php
$submission = App\Models\SeoSubmissionWebsites::all()->count();
$user = App\Models\User::all()->count();
$customer = Modules\CRM\Models\Customer::all()->count();
$date  = \Carbon\Carbon::now()->subDays(7);
$seoWorklist = App\Models\WorkReport::where('created_at', '>=', $date)->get();

@endphp
<x-app-layout> 
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-muted mb-1">{{__('common.welcome', ['Name'=> Auth::user()->name])}}</h6>
                    <h5 class="mb-0">{{__('common.dashboard')}}</h5>
                </div>

               <!--  <div class="mb-0 position-relative">
                    <select class="form-select form-control" id="dailychart">
                        <option selected="">This Month</option>
                        <option value="aug">August</option>
                        <option value="jul">July</option>
                        <option value="jun">June</option>
                    </select>
                </div>  -->               
                
            </div>
        
            <div class="row row-cols-xl-5 row-cols-md-2 row-cols-1">
                <div class="col mt-4 w-25">
                    <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow px-2 py-3">
                        <div class="d-flex align-items-center">
                            <div class="icon text-center rounded-pill">
                                <i class="uil uil-user-circle fs-4 mb-0"></i>
                            </div>
                            <div class="flex-1 ms-1">
                                <h6 class="mb-0 text-muted">Total Submission Url</h6>
                                <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value" data-target="{{$submission}}">8000</span></p>
                            </div>
                        </div>
                    </a>
                </div><!--end col-->
                
               <!--  <div class="col mt-4">
                    <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow px-2 py-3">
                        <div class="d-flex align-items-center">
                            <div class="icon text-center rounded-pill">
                                <i class="uil uil-user-circle fs-4 mb-0"></i>
                            </div>
                            <div class="flex-1 ms-1">
                                <h6 class="mb-0 text-muted">User</h6>
                                <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value" data-target="{{$user}}">1</span></p>
                            </div>
                        </div>

                    </a>
                </div> -->
                <!--end col-->
                
                <!-- <div class="col mt-4">
                    <a href="#!" class="features feature-primary d-flex justify-content-between align-items-center rounded shadow px-2 py-3">
                        <div class="d-flex align-items-center">
                            <div class="icon text-center rounded-pill">
                                <i class="uil uil-user-circle fs-4 mb-0"></i>
                            </div>
                            <div class="flex-1 ms-1">
                                <h6 class="mb-0 text-muted">Customer</h6>
                                <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value" data-target="{{$customer}}">1</span></p>
                            </div>
                        </div>
                    </a>
                </div>-->
 
                <!--end col-->
                
            </div><!--end row-->

            {{-- <div class="row">
                <div class="col-xl-8 col-lg-7 mt-4">
                    <div class="card shadow border-0 px-4 py-3 rounded">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-bold">Seo Work</h6> <br><br>
                            
                        </div>

                        <div id="dashboard" class="apex-chart">
                            <table class="table table-center bg-white mb-0">
                                <thead>
                                    
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!--end col-->

           
            </div><!--end row--> --}}

            
        </div>
    </div><!--end container-->   
</x-app-layout>