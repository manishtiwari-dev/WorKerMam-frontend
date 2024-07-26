<style>
	.pos-relative {
		position: relative;
	}
	.float-left {
		float: left !important;
	}
	.avatar-xl {
		width: 150px;
		height: 150px;
	} 
</style>
<x-app-layout>
    @section('title', 'Staff')

	
	<div class="card">  
		<!------ All document, designation, department data set in hidden input field --------->  
		<input type="hidden" id="totalStaffDetails" value="{{json_encode($staff_details)}}">
		<input type="hidden" id="totalDesignation" value="{{json_encode($designation)}}">
		<input type="hidden" id="totalDepartment" value="{{json_encode($department)}}">
        <input type="hidden" id="countryList" value="{{json_encode($country)}}">
        <input type="hidden" id="education" value="{{ json_encode($education) }}">
        <input type="hidden" id="totalEduData" value="{{json_encode($documentation)}}">
		<!------ All document data set in hidden input field --------->

		<div class="tab-content">
			<div class="card-header d-flex align-items-center justify-content-between px-3">
				<h5 class="tx-15 mb-0">Staff Information</h5>
				<nav class="nav nav-with-icon tx-13 gap-2">
                    <button type="submit" id="" data-id="{{ $staff_details->staff_id }}" data-bs-target="#staffPerformance" data-bs-toggle="modal" class="btn btn-primary btn-sm staffPerfor">Performance</button>
					<button type="submit" id="staffVerify" data-id="{{ $staff_details->staff_id }}" data-bs-target="#staffVerifyModal" data-bs-toggle="modal" class="btn btn-primary btn-sm">Verified</button>
					<button type="submit" id="staffTermBtn" data-id="{{ $staff_details->staff_id }}" data-bs-target="#staffTerminationModal" data-bs-toggle="modal" class="btn btn-primary btn-sm">Terminated</button>
				</nav>
			</div>
			<div>
				<!---- Basic Information data form start here ------------>
				<div class="card">
					<div class="row">
						<div class="col-sm-3 col-md-3 col-lg-3 py-3"> 
							<div class="bg-white p-3">
                                <div class="staff-image">
                                     @if(!empty($staff_details->staff_photo))
								    <img src="{{$staff_details->staff_photo}}" alt="" class="img-fluid mx-2" style="border-radius: 50%;border: 1px solid #ccc">
                                    @else
                                    <img src="https://p.kindpng.com/picc/s/252-2524695_dummy-profile-image-jpg-hd-png-download.png" alt="" class="img-fluid mx-2" style="border-radius: 50%;border: 1px solid #ccc">
                                    @endif
							    </div>
                                <input type="file" id="upload-input" accept="image/*" style="display: none;" />
							     
                            </div>
						</div>
						<div class="col-sm-9 col-md-9 col-lg-9 border-left p-3">  
							<div class="card ">
								<div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
									<h6 class="tx-uppercase tx-semibold mg-b-0">Basic Information</h6>
									<nav class="nav nav-with-icon tx-13">

									<a href="#" data-bs-target="#basicInfoEditModal" data-id="{{$staff_details->staff_id}}" id="editBasicInfoModal" data-bs-toggle="modal" class="nav-link btn btn-primary btn-sm py-1 px-2 text-black tx-13"><i data-feather="edit-2"></i>Edit</a>
									</nav>

								</div><!-- card-header -->
								<div class="card-body pd-25">
								<div class="row d-flex justify-content-between ">
									<div class="col-6 col-sm-12 col-md-6 d-flex justify-content-between mb-2">
										<h6>Employee Id:</h6>
										<p class="mb-0">{{$staff_details->employee_id}}</p>
									</div>

                                    <div class="col-6 col-sm-12 col-md-6 d-flex justify-content-between mb-2">
										<h6>Department:</h6>
                                        @if(!empty($staff_details->department->dept_name ?? ''))
										    <p class="mb-0">{{$staff_details->department->dept_name ?? ''}}</p>
                                        @endif
									</div> 

								</div>
								<div class="row d-flex justify-content-between ">
									 

                                    <div class="col-6 col-sm-12 col-md-6 d-flex justify-content-between mb-2">
										<h6>Employee Name :</h6> 
										<p class="mb-0">{{$staff_details->staff_name}}</p>
									</div>

                                    <div class="col-6 col-sm-12 col-md-6 d-flex justify-content-between mb-2">
										<h6>Designation :</h6> 
										<p class="mb-0">{{$staff_details->designation->designation_name ?? ''}}</p>
									</div>
								</div>


								<div class="row d-flex justify-content-between ">
									 
                                    <div class="col-6 col-sm-12 col-md-6 d-flex justify-content-between mb-2">
										<h6>Email :</h6> 
										<p class="mb-0">{{$staff_details->staff_email}}</p>
									</div>

                                    <div class="col-6 col-sm-12 col-md-6 d-flex justify-content-between mb-2">
										<h6>Date of Joining :</h6> 
										<p class="mb-0">{{$staff_details->date_of_joining ?? ''}}</p>
									</div>
									
								</div>


								<div class="row d-flex justify-content-between ">
                                    <div class="col-6 col-sm-12 col-md-6 d-flex justify-content-between mb-0">
										<h6>Date of Birth :</h6> 
										<p class="mb-0">{{$staff_details->date_of_birth ?? ''}}</p>
									</div>
									<div class="col-6 col-sm-12 col-md-6 d-flex justify-content-between mb-2">
										<h6>Date of Leaving :</h6> 
										<p class="mb-0">{{$staff_details->date_of_leaving ?? ''}}</p>
									</div>
								</div>

								<div class="row d-flex justify-content-between ">

                                    <div class="col-6 col-sm-12 col-md-6 d-flex justify-content-between mb-2">
										<h6>Gender :</h6> 
										<p class="mb-0">
											@if($staff_details->gender == '1')
												Male
											@elseif($staff_details->gender == '2')
												Female
											@elseif($staff_details->gender == '3')
												Transgender
											@endif
										</p>
									</div> 

                                    <div class="col-6 col-sm-12 col-md-6 d-flex justify-content-between mb-2">
										<h6>Salary :</h6> 
										<p  class="mb-0">{{$staff_details->salary ?? ''}}</p>
									</div> 
									
								</div>
                                <div class="row d-flex justify-content-between ">
                                    <div class="col-6 col-sm-12 col-md-6 d-flex justify-content-between mb-2">
										<h6>Phone:</h6> 
										<p  class="mb-0">{{$staff_details->staff_phone ?? ''}}</p>
									</div>
									<div class="col-6 col-sm-12 col-md-6 d-flex justify-content-between mb-2">
										<h6>Matrital Status:</h6> 
										<p  class="mb-0">
											@if($staff_details->marital_status == '1')
												Married
											@elseif($staff_details->marital_status == '0')
												Unmarried
											@endif
										</p>
									</div>
									 
								</div>
								<div class="row d-flex justify-content-between ">
									<div class="col-6 col-sm-12 col-md-6 d-flex justify-content-between mb-2">
										<h6>Verification Status :</h6> 
										<p class="mb-0">
											@if($staff_details->verification_status == 1)
												<span class="badge bg-success">Verified</span> 
											@else
												<span class="badge bg-danger">Pending</span>
											@endif
										</p>
									</div>
									<div class="col-6 col-sm-12 col-md-6 d-flex justify-content-between mb-2">
										<h6>Status :</h6> 
										<p class="mb-0">
											@if($staff_details->status == '2')
												<span class="badge bg-danger">Terminated</span>
											@else
												<span class="badge bg-success">Working</span>
											@endif
										</p>
									</div>
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!---- Basic Information data form end here ------------>


                <div class="row d-flex mt-3"> 
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card mg-b-20 mg-lg-b-25">
                            <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                                <h6 class="tx-uppercase tx-semibold mg-b-0">Reports</h6>
                                <div class="d-flex gap-2">
                                    <div>P : Present</div>
                                    <div>L : Leave</div>
                                    <div>PL : Paid Leave</div>
                                    <div>S : Salary</div>
                                </div>
                            </div><!-- card-header --> 
                            <div class="table-responsive">
                                <table class="table  table_wrapper">
                                    <thead> 
                                        <tr class="text-center">
                                            <th></th>
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
                                        @if(!empty($monthWiseData))
                                        @foreach ($monthWiseData as $monthWise)  
                                            <tr>
                                                <td>{{ $monthWise->year }}</td>  
                                                @foreach($monthWise->list as $month) 
                                                <td>
                                                    <table class="border" width="100">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div>P : </div>
                                                                        <div> &nbsp;<b> {{ $month->present }}</b></div>
                                                                    </div>
                                                                </td>
                                
                                                            </tr>
                                                            <tr>
                                                                <td>  
                                                                    <div class="d-flex">
                                                                        <div>L : </div>
                                                                        <div>  &nbsp;<b> {{ $month->leave }}</b></div>
                                                                    </div>
                                                                </td>
                                
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div>PL : </div>
                                                                        <div> &nbsp;<b>  {{ $month->paid_leave }}</b></div>
                                                                    </div>
                                                                </td>
                                
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div>S :</div>
                                                                        <div> &nbsp;<b>{{ $month->salaryAmt }}</b></div>
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
                                        
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!---- staff performance start here -------->
				<div class="row d-flex mt-3"> 
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card mg-b-20 mg-lg-b-25">
                            <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                                <h6 class="tx-uppercase tx-semibold mg-b-0">Staff Performance</h6>
                                <nav class="nav nav-with-icon tx-13">
                                    <a href="#" data-bs-target="#staffPerformance" id="" data-bs-toggle="modal" data-id="{{ $staff_details->staff_id }}" class="nav-link btn btn-primary btn-sm py-1 px-2 text-black tx-13 staffPerfor"><i data-feather="plus"></i>Add</a>
 
                                </nav>
                            </div><!-- card-header -->  
                            @if($staff_details->staff_remark)
                                @foreach($staff_details->staff_remark as $remark)
                                @if($remark->remark_type == 3)
                                    <div class="card-body pb-0">
                                        <div class="col-12 d-flex justify-content-between">
                                            @php  
                                                if($remark->remark_grade == 0){
                                                    $remark_grade = 'NA';
                                                }else if($remark->remark_grade == 1){
                                                    $remark_grade = 'Very Poor';
                                                }else if($remark->remark_grade == 2){
                                                    $remark_grade = 'Poor';
                                                }else if($remark->remark_grade == 3){
                                                    $remark_grade = 'Good';
                                                }else if($remark->remark_grade == 4){
                                                    $remark_grade = 'Very Good';
                                                }else if($remark->remark_grade == 5){
                                                    $remark_grade = 'Excellent';
                                                }else{
                                                    $remark_grade = '';
                                                }
                                            @endphp  
                                            <h6>{{$remark_grade}}</h6>
                                            <p>{{$remark->remark_details}}</p>
                                            <p class="d-flex">
                                                <a href="#PerformanceEditModal" data-id="{{$remark->remark_id}}" data-bs-toggle="modal" id="" class="PerforEditModalBtn btn btn-sm btn-white d-flex align-items-center mg-r-5"><i data-feather="edit-2"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            @endif
                                     
                        </div>
                    </div>
                    <!----staff performance end here --------> 

                    <!---- staff salary start here -------->                
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card mg-b-20 mg-lg-b-25">
                            <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                                <h6 class="tx-uppercase tx-semibold mg-b-0">Staff Salary</h6>
                                <nav class="nav nav-with-icon tx-13">
                                
                                <a href="#" data-bs-target="#staffRemuneration" id="" data-bs-toggle="modal" data-id="{{ $staff_details->staff_id }}" class="nav-link btn btn-primary btn-sm py-1 px-2 text-black tx-13 staffRemunerationAdd"><i data-feather="plus"></i>Add</a>


                                </nav>
                            </div><!-- card-header -->  
                            @if($staff_details->staff_remuneration)
                            @foreach($staff_details->staff_remuneration as $remuneration) 
                                <div class="card-body pb-0">
                                    <div class="col-12 d-flex justify-content-between"> 
                                        <p>{{ $remuneration->remuneration_date  ?? 'NULL' }}</p>
                                        <h6>{{($remuneration->remuneration_type == 1)?'Salary':'Bonus'}}</h6>
                                        <p>{{$remuneration->remuneration_value}}</p>
                                        <p class="d-flex"> 
                                            <a href="#RemunerationEditModal" data-id="{{$remuneration->remuneration_id}}" data-bs-toggle="modal" id="" class="RemunerationEditBtn btn btn-sm btn-white d-flex align-items-center mg-r-5"><i data-feather="edit-2"></i></a>
                                        </p>
                                    </div>
                                </div> 
                            @endforeach
                        @endif
                        </div>
                    </div> 
				</div>
				<!----staff salary end here -------->

                 <!---- staff Bank Detailsa start here -------->
				<div class="row d-flex mt-3"> 
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card mg-b-20 mg-lg-b-25">
                            <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                                <h6 class="tx-uppercase tx-semibold mg-b-0">Bank Details</h6>
                                <nav class="nav nav-with-icon tx-13">
                                    <a href="#" data-bs-target="#BankDetailsAddModal" id="" data-bs-toggle="modal" data-id="{{ $staff_details->staff_id }}" class="nav-link btn btn-primary btn-sm py-1 px-2 text-black tx-13 staffBankDetails"><i data-feather="plus"></i>Add</a>
 
                                </nav>
                            </div><!-- card-header -->  
                            @if($staff_details->hrm_staff_bank_details)
                                @foreach($staff_details->hrm_staff_bank_details as $bank_details) 
                                    <div class="card-body pb-0">
                                        <div class="col-12 d-flex justify-content-between"> 
                                            <p>{{ \Carbon\Carbon::parse($bank_details->created_at)->format('Y-m-d') }}</p>
                                            <h6>{{$bank_details->account_name}}</h6>
                                            <p>{{$bank_details->account_number}}</p>
                                            <p>{{$bank_details->bank_name}}</p>
                                            <p>{{$bank_details->bank_indetifier_coder}}</p>
                                            <p>{{$bank_details->bank_branch}}</p>
                                            <p class="d-flex">
                                                <a href="#BankDetailsEditModal" data-id="{{$bank_details->id}}" data-bs-toggle="modal" id="" class="bankDetailsEditModalBtn btn btn-sm btn-white d-flex align-items-center mg-r-5"><i data-feather="edit-2"></i></a>
                                            </p>
                                        </div>
                                    </div> 
                                @endforeach
                            @endif
                                     
                        </div>
                    </div>
                    <!----staff Bank Detailsa end here --------> 
 
				</div>
				<!----staff Bank Detailsa end here -------->


				<!---- Permanent and Present Address start here -------->
				<div class="row d-flex mt-3">
					@if($staff_details->staff_address)
					<input type="hidden" value="{{json_encode($staff_details->staff_address)}}" id="totalAddressData">
						@foreach($staff_details->staff_address as $address)
							@if($address->address_type == '1') 
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="card mg-b-20 mg-lg-b-25">
										<div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
											<h6 class="tx-uppercase tx-semibold mg-b-0">Permanent Address</h6>
											<nav class="nav nav-with-icon tx-13">
											<a href="#" data-bs-target="#addressModal" data-id="{{$address->address_id}}" id="permanent_address" data-bs-toggle="modal" class="nav-link btn btn-primary btn-sm py-1 px-2 text-black tx-13"><i data-feather="edit-2"></i>Edit</a>
											</nav>
										</div><!-- card-header -->
                                        @if(!empty($address->street_address) || !empty($address->city) || !empty($address->state) || !empty($address->country) ||  !empty($address->postcode))
										<div class="card-body">
											<div class="col-12">
                                               
												<p class="mg-b-3 tx-color-02"><span class="tx-medium tx-color-01">{{$address->street_address}}</span>, {{$address->city}}, {{$address->state}},</p> 
												<span class="d-block tx-13 tx-color-03">{{$address->country->countries_name ?? ''}},  {{$address->postcode}}</span>
                                               
											</div>
										</div>
                                        @endif
									</div>
								</div>
							@else
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="card mg-b-20 mg-lg-b-25">
										<div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
											<h6 class="tx-uppercase tx-semibold mg-b-0">Present Address</h6>
											<nav class="nav nav-with-icon tx-13">
											<a href="#" data-bs-target="#addressModal" id="present_address" data-id="{{$address->address_id}}" data-bs-toggle="modal" class="nav-link btn btn-primary btn-sm py-1 px-2 text-black tx-13"><i data-feather="edit-2"></i>Edit</a>
											</nav>
										</div><!-- card-header -->
                                        @if(!empty($address->street_address) || !empty($address->city) || !empty($address->state) || !empty($address->country) ||  !empty($address->postcode))
										<div class="card-body">
											<div class="col-12 ">
												<p class="mg-b-3 tx-color-02"><span class="tx-medium tx-color-01">{{$address->street_address}}</span>, {{$address->city}}, {{$address->state}},</p> 
												<span class="d-block tx-13 tx-color-03">{{$address->country->countries_name ?? ''}},  {{$address->postcode}}</span>
											</div>
										</div>
                                        @endif
									</div>
								</div>
							@endif
						@endforeach
					@endif
				</div>
				<!---- Permanent and Present Address end here -------->
				<!---- Staff Education  and document section section start here -------->
				<div class="row d-flex">
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="card mg-b-20 mg-lg-b-25">
							<div class="card-header d-flex align-items-center justify-content-between">
								<h6 class="tx-uppercase tx-semibold mg-b-0">Education</h6> 
								<nav class="nav nav-with-icon tx-13"> 
									<a href="#" data-bs-target="#EducationAddModal" id="AddEduModalBtn" data-bs-toggle="modal" class="nav-link btn btn-primary btn-sm py-1 px-2 text-black tx-13"><i data-feather="plus"></i>Add</a>
								</nav>
							</div><!-- card-header -->

							@if($staff_details->staff_qualification)
								@foreach($staff_details->staff_qualification as $education)
									<div class="card-body pb-0">
										<div class="col-12 d-flex justify-content-between">
											<h6>{{$education->education->education_name ?? ''}}</h6>
											<p>{{$education->university_name}}</p>
											<p class="d-flex">{{$education->admission_at}} - {{$education->passing_at}}  &nbsp;
												<a href="#educationEditModal" data-id="{{$education->education_id}}" data-bs-toggle="modal" id="" class="EduEditModalBtn btn btn-sm btn-white d-flex align-items-center mg-r-5"><i data-feather="edit-2"></i></a>
											</p>
										</div>
									</div>
								@endforeach
							@endif
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="card mg-b-20 mg-lg-b-25">
							<div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
								<h6 class="tx-uppercase tx-semibold mg-b-0">Document</h6>
							</div><!-- card-header -->
							<div class="row px-3 py-3">
							@if($staff_details->staff_document)
								@foreach($staff_details->staff_document as $document)
                           
									<div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                        <a href=""><span>{{$document->doc_info->document_name ?? ''}}</span></a> 

                                        <form action="{{ route('hrm.download-image') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $document->document_file }}" name="imagFile"/> 
                                            <button class="btn btn-primary">Download</button>
                                        </form>
 

                                          
									</div>
								@endforeach
							@endif
							</div>
							
						</div>
					</div>
				</div>
				<!---- Staff Education section section end here --------> 
				<!---- Staff Work exeperience section start here -------->
				
					<div class="row d-flex"> 
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="card mg-b-20 mg-lg-b-25">
								<div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
									<h6 class="tx-uppercase tx-semibold mg-b-0">Work Experience</h6>
									<nav class="nav nav-with-icon tx-13"> 
										<a href="#" data-bs-target="#workInfoAddModal" id="workInfoAddModalBtn" data-id="{{ $staff_details->staff_id }}" data-bs-toggle="modal" class="nav-link btn btn-primary btn-sm py-1 px-2 text-black tx-13"><i data-feather="plus"></i>Add</a>
                                        
									</nav>
								</div> 
                                @if(!empty($staff_details->staff_experiance))
                                    <div class="row">
                                    <input type="hidden" id="TotalWorkExpData" value="{{ json_encode($staff_details->staff_experiance)}}">
                                        @foreach($staff_details->staff_experiance as $experience)  
                                            <div class="col-lg-6 border-right">
                                                <div class="card-body border-bottom">
                                                    <div class="media-body pd-t-25 pd-sm-t-0 pd-sm-l-25">
                                                        <div class="d-flex justify-content-between">
                                                            <h5 class="mg-b-5">{{$experience->company_name}}</h5>
                                                            <a href="#workInfoModal"  data-id="{{$experience->experience_id}}" data-bs-toggle="modal" id="staffWorkExpBtn" class=" btn btn-sm btn-white d-flex align-items-center mg-r-5"><i data-feather="edit-2"></i></a>

                                                            {{-- <a href="#" data-bs-target="#workInfoModal" id="present_address" data-id="{{$experience->experience_id}}" data-bs-toggle="modal" id="staffWorkExpBtn" class="nav-link btn btn-primary btn-sm py-1 px-2 text-black tx-13"><i data-feather="edit-2"></i>Edit</a> --}}

                                                        </div>
                                                        @if(!empty($experience->company_designation) || !empty($experience->company_address) )
                                                            <p class="mg-b-3 tx-color-02">
                                                                <span class="tx-medium tx-color-01">{{$experience->company_designation}}</span>, {{$experience->company_address}}</p>
                                                        @endif

                                                        @if(!empty($experience->date_of_joining) || !empty($experience->date_of_leaving))                                                            
                                                            <span class="d-block tx-13 tx-color-03">{{$experience->date_of_joining}} - {{$experience->date_of_leaving}}</span>

                                                        @endif
    
                                                        <ul class="pd-l-10 mg-0 mg-t-20 tx-13">
                                                            @if(!empty($experience->contact_name))<li>{{$experience->contact_name}}</li>@endif
                                                            @if(!empty($experience->contact_email))<li>{{$experience->contact_email}}</li>@endif
                                                            @if(!empty($experience->contact_phone))<li>{{$experience->contact_phone}}</li>@endif
                                                            @if(!empty($experience->reason_for_leaving))<li>{{$experience->reason_for_leaving}}</li> @endif
                                                        </ul>
                                                        
                                                    </div> 
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
							</div>
						</div> 
					</div> 
				<!---- Staff Work exeperience section end here -------->
			</div>         
		</div> 
	</div> 

	<!----- Work Experience Add modal start here ------------>
	<div class="modal fade" id="workInfoAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Work Experience</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="AdduserForm" novalidate enctype="multipart/form-data">
                        <input name="staff_id" id="workExpstaff_id" type="hidden">
                        <input name="updateType" id="updateType" value="new" type="hidden">
                        <input name="updateSection" id="updateSection" value="workexp" type="hidden">

                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label">Company Name<span class="text-danger">*</span></label>
                                <input name="company_name"   id="company_name" type="text" class="form-control" placeholder="Company Name" required>
                                <div class="invalid-feedback">
                                    Please Enter Company Name
                                </div> 
                            </div>
							<div class="form-group col-lg-6">
                                <label class="form-label"> Company Designation</label>
                                <input name="company_designation"   id="company_designation" type="text" class="form-control" placeholder="Company Designation" >
								<div class="invalid-feedback">
                                    Enter Comany Designation
                                </div> 
                            </div>
                        </div>
						<div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label"> Company Address<span class="text-danger">*</span></label>
                                <input name="company_address"  id="company_address" type="text" class="form-control" placeholder="Comapny Address" required>
                                <div class="invalid-feedback">
                                    Please Enter Company Address
                                </div> 
                            </div>
							<div class="form-group col-lg-6">
                                <label class="form-label">Conatct Name<span class="text-danger">*</span></label>
                                <input name="contact_name"   id="contact_name" type="text" class="form-control" placeholder="Conatct Name" required>
                                <div class="invalid-feedback">
                                    Please Enter Contact Name
                                </div> 
                            </div>
                        </div>
						<div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label">Contact Email<span class="text-danger">*</span></label>
                                <input name="contact_email"  id="contact_email" type="text" class="form-control" placeholder="Contact Email" required>
                                <div class="invalid-feedback">
                                    Please Enter Contact Email
                                </div>
                            </div>
							<div class="form-group col-lg-6">
                                <label class="form-label"> Contact Phone<span class="text-danger">*</span></label>
                                <input name="contact_phone"   id="contact_phone" type="text" class="form-control" placeholder="Contact Phone" required>
                                <div class="invalid-feedback">
                                    Please Enter Contact Phone
                                </div>
                            </div>
                        </div>
						<div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label">Date Of Joining</label>
                                <input name="date_of_joining" id="date_of_joining" type="date" class="form-control" placeholder="Date Of Joining">
                                 
                            </div>
							<div class="form-group col-lg-6">
                                <label class="form-label">Date Of Leaving</label>
                                <input name="date_of_leaving"   id="date_of-leaving" type="date" class="form-control" placeholder="Date Of Leaving">
                                 
                            </div>
                        </div>
						<div class="form-row">
							<div class="form-group col-lg-12">
                                <label class="form-label">Reason For Leaving<span class="text-danger">*</span></label>
                                <input name="reason_for_leaving"  id="reason_for_leaving" type="text" class="form-control" placeholder="Reason For Leaving" required>
                                <div class="invalid-feedback">
                                    Please Enter Reason For Leaving
                                </div>
                            </div>
						</div>
						<div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label">Document Type</label>
                                <select name="document_type" id="document_type" class="form-control form-select" required></select>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
							<div class="form-group col-lg-6">
                                <label class="form-label">Document Upload</label>
                                <input name="document_upload"  id="document_upload" type="file" class="form-control" placeholder="Document Upload">
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                    <input type="submit" id="workExpSubBtn" name="send" class="btn btn-primary" value="{{__('common.submit')}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----- Work Experience Add modal end here ------------>
	<!----- Work Experience Edit modal start here ------------>
    <div class="modal fade" id="workInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Work Experience</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="EdituserForm" novalidate>

                        <input name="updateSection" id="updateSection" value="workexp" type="hidden" >
                        <input name="experience_id" id="experience_id" type="hidden" >
                        <input type="hidden" id="work_staff_id" name="staff_id">

                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label">Company Name<span class="text-danger">*</span></label>
                                <input name="company_name"   id="edit_comany_name" type="text" class="form-control" placeholder="Company Name" required>
                                <div class="invalid-feedback">
                                    Please Enter Company Name
                                </div>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
							<div class="form-group col-lg-6">
                                <label class="form-label"> Company Designation<span class="text-danger">*</span></label>
                                <input name="company_designation"   id="edit_company_designation" type="text" class="form-control" placeholder="Company Designation">
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
						<div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label"> Company Address<span class="text-danger">*</span></label>
                                <input name="company_address"  id="edit_comany_address" type="text" class="form-control" placeholder="Comapny Address" required>
                                <div class="invalid-feedback">
                                   Please Enter Company Address
                                </div>
                                 
                            </div>
							<div class="form-group col-lg-6">
                                <label class="form-label">Conatct Name<span class="text-danger">*</span></label>
                                <input name="contact_name"   id="edit_contact_name" type="text" class="form-control" placeholder="Conatct Name" required>
                                <div class="invalid-feedback">
                                    Please Enter Contact Name
                                </div>
                                 
                            </div>
                        </div>
						<div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label">Contact Email<span class="text-danger">*</span></label>
                                <input name="contact_email"  id="edit_contact_email" type="text" class="form-control" placeholder="Contact Email" required>
                                <div class="invalid-feedback">
                                    Please Enter Contact Email
                                </div> 
                            </div>
							<div class="form-group col-lg-6">
                                <label class="form-label"> Contact Phone</label>
                                <input name="contact_phone"   id="edit_contact_phone" type="text" class="form-control" placeholder="Contact Phone" required>
                                <div class="invalid-feedback">
                                     Please Enter Contact Phone
                                </div>
                                 
                            </div>
                        </div>
						<div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label">Date Of Joining</label>
                                <input name="date_of_joining" id="edit_date_of_joining" type="date" class="form-control" placeholder="Date Of Joining" >
                                <div class="invalid-feedback">
                                    {{__('user-manager.name_error')}}
                                </div>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
							<div class="form-group col-lg-6">
                                <label class="form-label">Date Of Leaving</label>
                                <input name="date_of_leaving"   id="edit_date_of-leaving" type="date" class="form-control" placeholder="Date Of Leaving">
                               
                                
                            </div>
                        </div>
						<div class="form-row">
							<div class="form-group col-lg-12">
                                <label class="form-label">Reason For Leaving</label>
                                <input name="reason_for_leaving"  id="edit_reason_for_leaving" type="text" class="form-control" placeholder="Reason For Leaving" required> 
                                <div class="invalid-feedback">
                                    Please Enter Reason For Leaving
                                </div>
                                </span>
                            </div>
						</div>
						<div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label">Document Type</label>
                                <select name="document_type" id="edit_document_type" class="form-select form-control"></select>
                                 
                            </div>
							<div class="form-group col-lg-6">
                                <label class="form-label">Document Upload</label>
                                <input name="document_upload"  id="edit_document_upload" type="file" class="form-control" placeholder="Document Upload"> 
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                    <input type="submit" id="staffWorkSubBtn" name="send" class="btn btn-primary" value="{{__('common.submit')}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----- Work Experience Edit modal end here ------------>
	<!----- Address modal start here ------------>
    <div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="userForm" novalidate>
                        <input name="permanent_addressId" id="permanent_addressId" type="hidden">
                        <input type="hidden" name="present_addressId" id="present_addressId">
                        <input type="hidden" id="staff_editId">
                        <input type="hidden" id="caseTypeAdd" value="address">
                        <input type="hidden" id="addressId" > 
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label">Contact Number</label>
                                <input name="contact_number"   id="contact_number" type="text" class="form-control" placeholder="Contact Number"  >
                                <div class="invalid-feedback">
                                    Enter Comany Name
                                </div>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
							<div class="form-group col-lg-6">
                                <label class="form-label"> Street Address</label>
                                <input name="street_address"   id="street_address" type="text" class="form-control" placeholder="Street Address"  >
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
						<div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label">City</label>
                                <input name="city"  id="city" type="text" class="form-control" placeholder="City"  >
                                <div class="invalid-feedback">
                                    Enter Company Address
                                </div>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
							<div class="form-group col-lg-6">
                                <label class="form-label">State</label>
                                <input name="state" id="state" type="text" class="form-control" placeholder="State"  >
                                <div class="invalid-feedback">
                                    {{__('user-manager.name_error')}}
                                </div>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
						<div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label">Country</label>
                                <select name="counytry" id="country_id" class="form-control form-select">
                                    
                                </select>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
							<div class="form-group col-lg-6">
                                <label class="form-label">Postcode</label>
                                <input name="postcode"   id="postcode" type="text" class="form-control" placeholder="Postcode"  >
                                <div class="invalid-feedback">
                                    {{__('user-manager.name_error')}}
                                </div>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    	<input type="button" id="UpdateStaffAddressBtn" name="send" class="btn btn-primary " value="{{__('common.submit')}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----- Address modal end here ------------>
	<!----- Education Add modal start here ------------>
    <div class="modal fade" id="educationAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Education</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="AddEducationForm" novalidate> 
                        <input type="hidden" id="edu_staff_id" name="staff_id" value="{{ $staff_details->staff_id }}">
                        <input type="hidden" id="updateType" name="updateType" value="new">
                        <input type="hidden" id="caseTypeEdu" name="updateSection" value="education">

                        <div class="form-row">
                            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                <label class="form-label">Education</label>
                                <select name="education_id" id="educationList" class="form-control form-control"></select>
                                <div class="invalid-feedback">
                                    Enter Education
                                </div>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
							<div class="form-group col-lg-4 col-md-4 col-sm-12">
                                <label class="form-label">University Name</label>
                                <input name="university_name" id="university_name" type="text" class="form-control" placeholder="University Name" required>
								<div class="invalid-feedback">
                                    Enter University Name
                                </div>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
							<div class="form-group col-lg-4 col-md-4 col-sm-12">
                                <label class="form-label">Admission Year</label>
                                <select class="form-select form-control" id="addmission_year" name="addmission_year">
									<option selected disabled value="">Select Passing Year</option>
									@for($i='1973'; $i<='2027'; $i++)
										<option value="{{$i}}">{{$i}}</option>
									@endfor
								</select>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div> 
						<div class="form-row">
							<div class="form-group col-lg-4 col-md-4 col-sm-12">
                                <label class="form-label">Passing Year</label>
                                <select class="form-select form-control" id="passing_year" name="passing_year">
									<option selected disabled value="">Select Passing Year</option>
									@for($i='1973'; $i<='2027'; $i++)
										<option value="{{$i}}">{{$i}}</option>
									@endfor
								</select>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                <label class="form-label">Document Type</label>
                                <select name="document_type" id="add_document_type" class="form-select form-control" required></select>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
							<div class="form-group col-lg-4 col-md-4 col-sm-12">
                                <label class="form-label">Document Upload</label>
                                <input name="document_upload" id="document_upload" type="file" class="form-control" placeholder="Document Upload">
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    	<input type="submit" id="addEduSubBtn" name="send" class="btn btn-primary" value="{{__('common.submit')}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----- Education Add modal end here ------------>
	<!----- Education Edit modal start here ------------>
    <div class="modal fade" id="educationEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Education</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="imageUploadForm" novalidate enctype="multipart/form-data">
                        <input type="hidden" id="education_id" name="education_id">
                        <div class="form-row">
                            <div class="form-group col-lg-4 col-md-4 col-sm-6">
                                <label class="form-label">Education</label>
                                <select name="education_id" id="edit_education" class="form-control form-control"></select> 
                                <div class="invalid-feedback">
                                    Enter Education
                                </div>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
							<div class="form-group col-lg-4 col-md-4 col-sm-6">
                                <label class="form-label">University Name</label>
                                <input name="university_name" id="edit_university_name" type="text" class="form-control" placeholder="University Name" required>
								<div class="invalid-feedback">
                                    Enter University Name
                                </div>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
							<div class="form-group col-lg-4 col-md-4 col-sm-6">
                                <label class="form-label">Admission Year</label>
                                <select class="form-select form-control" id="edit_addmission_year" name="addmission_year">
									<option selected disabled value="">Select Passing Year</option>
									@for($i='1973'; $i<='2027'; $i++)
										<option value="{{$i}}">{{$i}}</option>
									@endfor
								</select>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
						<div class="form-row">
							<div class="form-group col-lg-4 col-md-4 col-sm-6">
                                <label class="form-label">Passing Year</label>
                                <select class="form-select form-control" id="edit_passing_year" name="passing_year">
									<option selected disabled value="">Select Passing Year</option>
									@for($i='1973'; $i<='2027'; $i++)
										<option value="{{$i}}">{{$i}}</option>
									@endfor
								</select>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-6">
                                <label class="form-label">Document Type</label>
                                <select name="document_type" id="edit_eduDocument_type" class="form-select form-control" required></select>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
							<div class="form-group col-lg-4 col-md-4 col-sm-6">
                                <label class="form-label">Document Upload</label>
                                <input name="document_upload" id="edit_eduDocument_upload" type="file" class="form-control" placeholder="Document Upload">
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <input type="hidden" id="caseTypeEdu" name="updateSection" value="education"> 
                        <input type="hidden" id="edu_staff_id" name="staff_id" value="{{ $staff_details->staff_id }}">
                        <input type="hidden" id="qualification_id" name="qualification_id">
                    	<input type="submit" id="UpdateStaffEduBtn" name="send" class="btn btn-primary " value="{{__('common.submit')}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----- Education Edit modal end here ------------>
	<!----- Basic Information Edit modal start here ------------->
	<div class="modal fade" id="basicInfoEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Edit Basic Information</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <form class="needs-validation" id="AddStaffDetails" novalidate enctype="multipart/form-data">
                        <input name="staff_id" id="staff_editIds" type="hidden" class="form-control">
                        <input type="hidden" id="caseTypeBasic" name="updateSection" value="basic_info">
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label">Profile</label>
                                <input name="profileimg"  id="profile" type="file" class="form-control" >
                                 
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label">Employee Id</label>
                                <input name="employee_id"   id="employee_id" type="text" class="form-control" placeholder="Employee Id" required>
                                 
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label">Staff Name<span class="text-danger">*</span></label>
                                <input name="staff_name"   id="staff_name" type="text" class="form-control" placeholder="Staff Name" required>
                                <div class="invalid-feedback">
                                    Enter Staf Name
                                </div>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div> 
                            <div class="form-group col-lg-6">
                                <label class="form-label">Staff Email<span class="text-danger">*</span></label>
                                <input name="staff_email" id="staff_email" type="text" class="form-control" placeholder="Staff Email" required>
								<div class="invalid-feedback">
                                    Enter Staff Email
                                </div>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label"> Staff Phone</label>
                                <input name="staff_phone"  id="staff_phone" type="text" class="form-control" placeholder="Staff Phone">
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label">Gender</label>
                                <select name="gender" id="gender" class="form-control form-select">
                                    <option selected disable value="" disabled>Select Gender</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                    <option value="3">Transgender</option>
                                </select>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label">Date Of Birth</label>
                                <input name="date_of_birth"   id="date_of_birth" type="date" class="form-control" placeholder="Date Of Birth">
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div> 
                            <div class="form-group col-lg-6">
                                <label class="form-label">Department<span class="text-danger">*</span></label>
                                <select name="department_id" id="edit_department" class="form-select form-control"></select>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label">Designation<span class="text-danger">*</span></label>
                                <select name="designation_id" id="edit_designation" class="form-select form-control"></select>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div> 
                            <div class="form-group col-lg-6">
                                <label class="form-label">Marital Status</label>
                                 <select name="marital_status" id="marital_status" class="form-select form-control">
									<option value="" selected disabled>Select Marital Status</option>
									<option value="1">Married</option>
									<option value="0">Unmarried</option>
								 </select>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div> 
                            <div class="form-group col-lg-6">
                                <label class="form-label">Date Of Joining </label>
                                <input name="date_of_joining"  id="basic_date_of_joining" type="date" class="form-control" placeholder="Reason For Leaving">
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
							<div class="form-group col-lg-6">
                                <label class="form-label">Date Of Leaving </label>
                                <input name="date_of_leaving"  id="date_of_leaving" type="date" class="form-control" placeholder="Date Of Leaving">
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
							
                            <div class="form-group col-lg-6">
                                <label class="form-label">Salary</label>
                                <input name="salary"  id="salary" type="text" class="form-control" placeholder="Salary">
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div> 
							
                        </div>  
                        <div class="col-lg-12 px-2">
                          <input type="submit" id="UpdateStaffBasInfoBtn" name="send" class="btn btn-primary " value="{{__('common.update')}}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
	<!----- Basic Information Edit modal start here ------------>


     <!----- Staff HRMStaffRemuneration modal start here ------------>
	<div class="modal fade" id="staffRemuneration" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Remuneration</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="Remuneration" novalidate>
                        <input name="remuneration_typeId" id="remuneration_typeId" type="hidden">
                        <div class="form-row">
                            <div class="form-group col-lg-6 px-2">
                                <label class="form-label">Remuneration Type<span class="text-danger">*</span></label>
                                <select class="form-control" name="remuneration_type" id="remuneration_type" required> 
                                    <option value="1">Salary</option>
                                    <option value="2">Bonus</option> 
                                </select>
                                <div class="invalid-feedback">
                                    Please Select Date
                                </div>
                                
                            </div> 
                            <div class="form-group col-lg-6 px-2">
                                <label class="form-label">Remuneration Date</label>
                                <input type="date" name="remuneration_date" class="form-control" placeholder="Select Date" id="remuneration_date" />   
                                 
                            </div> 
                            <div class="form-group col-lg-6 px-2">
                                <label class="form-label">Remuneration Value<span class="text-danger">*</span></label>
                                <input type="number" name="remuneration_value" class="form-control" placeholder="Select Remuneration Value" id="remuneration_value" required/>   
                                <div class="invalid-feedback">
                                    Please Enter Remuneration Value
                                </div>
                            </div>
                        </div>
                    <input type="button" id="addRemunerationBtn" name="send" class="btn btn-primary" value="{{__('common.submit')}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----- Staff HRMStaffRemuneration modal end here ------------>


    <div class="modal fade" id="RemunerationEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Staff Performance</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="userForm" novalidate>
                        <input name="remuneration_typeId" id="Editremuneration_typeId" type="hidden">
                        <input name="staffId" id="EditstaffRemId" type="hidden">
                        <div class="form-row">
                            <div class="form-group col-lg-6 px-2">
                                <label class="form-label">Remuneration Type<span class="text-danger">*</span></label>
                                <select class="form-control" name="remuneration_type"  id="Editremuneration_type" required> 
                                    <option value="1">Salary</option>
                                    <option value="2">Bonus</option> 
                                </select>
                                
                            </div> 
                            <div class="form-group col-lg-6 px-2">
                                <label class="form-label">Remuneration Date</label>
                                <input type="date" name="remuneration_date" class="form-control" placeholder="Select Date" id="Editremuneration_date" />   
                                 
                            </div> 
                            <div class="form-group col-lg-6 px-2">
                                <label class="form-label">Remuneration Value<span class="text-danger">*</span></label>
                                <input type="number" name="remuneration_value" class="form-control" placeholder="Select Remuneration Value" id="Editremuneration_value" required/>   
                                 
                            </div>
                        </div>
                        <input type="button" id="EditRemunerationBtn" name="send" class="btn btn-primary" value="{{__('common.submit')}}">
                    </form>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Start edit bank details modal -->
    <div class="modal fade" id="BankDetailsEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Update Bank Details</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form class="needs-validation" id="userForm" novalidate>
                        <input name="edit_bankStaffId" id="edit_bankStaffId" type="hidden">
                        <input name="edit_bankDetailsId" id="edit_bankDetailsId" type="hidden">
                        <div class="form-row">
                            <div class="form-group col-md-6 col-12">
                                <label for="account_name">Account Name</label>
                                <input type="text" class="form-control" id="edit_account_name" name="account_name" placeholder="Account Name" value="{{old('account_name')}}"> 
                            </div>  
                            <div class="form-group col-md-6 col-12">
                                <label for="account_number">Account Number</label>
                                <input type="text" class="form-control" id="edit_account_number" name="account_number" placeholder="Account Number" value="{{old('account_number')}}"> 
                            </div>  
                            <div class="form-group col-md-6 col-12">
                                <label for="bank_name">Bank Name</label>
                                <input type="text" class="form-control" id="edit_bank_name" name="bank_name" placeholder="Bank Name" value="{{old('bank_name')}}">
                                <div class="invalid-feedback">
                                    Enter Bank Name
                                </div>
                            </div> 
                            <div class="form-group col-md-6 col-12">
                                <label for="bank_indetifier_coder">Bank Indetifier Coder</label>
                                <input type="text" class="form-control" id="edit_bank_indetifier_coder" name="edit_bank_indetifier_coder" placeholder="Bank Indetifier Coder" value="{{old('bank_indetifier_coder')}}">
                                <div class="invalid-feedback">
                                    Enter Bank Indetifier Coder
                                </div>
                            </div> 
                        </div>


                        <div class="form-row">
                             
                            <div class="form-group col-md-6 col-12">
                                <label for="bank_branch">Bank Branch</label>
                                <input type="text" class="form-control" id="edit_bank_branch" name="bank_branch" placeholder="Bank Branch" value="{{old('bank_branch')}}">
                                <div class="invalid-feedback">
                                    Enter Bank Branch
                                </div>
                            </div>   
                        </div>
                    <input type="button" id="updateBankDetailsBtn" name="send" class="btn btn-primary" value="{{__('common.submit')}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End bank details Modal -->


    <div class="modal fade" id="PerformanceEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Staff Performance</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="userForm" novalidate>
                        <input name="Perverify_staffId" id="EditPerverify_staffId" type="hidden">
                        <input name="EditPerverify_RemarkId" id="EditPerverify_RemarkId" type="hidden">

                        
                        <div class="form-row">
                            <div class="form-group col-lg-12 px-2">
                                <label class="form-label">Grade</label>
                                <select class="form-control" name="grade" id="EditperGrade">
                                    <option value="0">NA</option>
                                    <option value="1">Very Poor</option>
                                    <option value="2">Poor</option>
                                    <option value="3">Good</option>
                                    <option value="4">Very Good</option>
                                    <option value="5">Excellent</option> 
                                </select>
                                
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-12 px-2">
                                <label class="form-label">Remark Details</label>
                                <textarea name="staffRemark" id="EditPerstaffRemark" cols="10" rows="3" class="form-control" placeholder="Remark Details"></textarea>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    <input type="button" id="staffPerEditBtn" name="send" class="btn btn-primary" value="{{__('common.submit')}}">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Start Add Stafff Bank Details Modal -->
    
    <div class="modal fade" id="BankDetailsAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top modal-lg" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Bank Details</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="BankDetailsBtn" novalidate>
                        <input name="bankStaffId" id="bankStaffId" type="hidden">
                        <div class="form-row">
                            <div class="form-group col-md-6 col-12">
                                <label for="account_name">Account Name</label>
                                <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Name" value="{{old('account_name')}}" required> 
                                <div class="invalid-feedback">
                                    Please Enter Account Name
                                </div>
                            </div>  
                            <div class="form-group col-md-6 col-12">
                                <label for="account_number">Account Number</label>
                                <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Account Number" value="{{old('account_number')}}" required> 
                                <div class="invalid-feedback">
                                    Please Enter Account Number
                                </div>
                            </div>  
                            <div class="form-group col-md-6 col-12">
                                <label for="bank_name">Bank Name</label>
                                <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Bank Name" value="{{old('bank_name')}}" required>
                                <div class="invalid-feedback">
                                    Please Enter Bank Name
                                </div>
                            </div> 
                            <div class="form-group col-md-6 col-12">
                                <label for="bank_indetifier_coder">Bank Indetifier Coder</label>
                                <input type="text" class="form-control" id="bank_indetifier_coder" name="bank_indetifier_coder" placeholder="Bank Indetifier Coder" value="{{old('bank_indetifier_coder')}}" required>
                                <div class="invalid-feedback">
                                    Please Enter Bank Indetifier Coder
                                </div>
                            </div> 
                        </div>


                        <div class="form-row">
                             
                            <div class="form-group col-md-6 col-12">
                                <label for="bank_branch">Bank Branch</label>
                                <input type="text" class="form-control" id="bank_branch" name="bank_branch" placeholder="Bank Branch" value="{{old('bank_branch')}}" required>
                                <div class="invalid-feedback">
                                    Please Enter Bank Branch
                                </div>
                            </div>   
                        </div>
                    <input type="button" id="AddStaffBankDetails" name="send" class="btn btn-primary" value="{{__('common.submit')}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add Staff Bank Details Modal -->


     <!----- Staff Performance modal start here ------------>
	<div class="modal fade" id="staffPerformance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Staff Performance</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="userForm" novalidate>
                        <input name="Perverify_staffId" id="Perverify_staffId" type="hidden">
                        <div class="form-row">
                            <div class="form-group col-lg-12 px-2">
                                <label class="form-label">Grade</label>
                                <select class="form-control" name="grade" id="perGrade">
                                    <option value="0">NA</option>
                                    <option value="1">Very Poor</option>
                                    <option value="2">Poor</option>
                                    <option value="3">Good</option>
                                    <option value="4">Very Good</option>
                                    <option value="5">Excellent</option> 
                                </select>
                                
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-12 px-2">
                                <label class="form-label">Remark Details</label>
                                <textarea name="staffRemark" id="PerstaffRemark" cols="10" rows="3" class="form-control" placeholder="Remark Details"></textarea>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    <input type="button" id="staffPerBtn" name="send" class="btn btn-primary" value="{{__('common.submit')}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----- Staff Performance modal end here ------------>

    <!----- Staff Verification modal start here ------------>
	<div class="modal fade" id="staffVerifyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Staff Verification</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="userForm" novalidate>
                        <input name="verify_staffId" id="verify_staffId" type="hidden">
                        <div class="form-row">
                            <div class="form-group col-lg-12 px-2">
                                <label class="form-label">Remark Details</label>
                                <textarea name="staffRemark" id="staffRemark" cols="10" rows="3" class="form-control" placeholder="Remark Details"></textarea>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    <input type="button" id="staffVerBtn" name="send" class="btn btn-primary" value="{{__('common.submit')}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----- Staff Verification modal end here ------------>

    <!----- Staff Terminate modal start here ------------>
	<div class="modal fade" id="staffTerminationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top  " role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Staff Termination</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="userForm" novalidate>
                        <input name="termination_staffId" id="termination_staffId" type="hidden">
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">Termination Reason</label>
                                <select name="termination_reason" id="termination_reason" aria-placeholder="Termination Reason" class="form-control form-select">
                                    <option value="" selected disabled>Select termination Reason</option>
                                    <option value="1">Left</option>
                                    <option value="2">Resigned</option>
                                    <option value="3">Fired</option>
                                    <option value="4">Other</option>
                                </select>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">Date of Leaving</label>
                                <input type="date" id="ter_date_of_leaving" class="form-control">
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label class="form-label">Remark Details<span class="text-danger">*</span></label>
                                <textarea name="remark_details" id="ter_remark_details" cols="10" rows="2" class="form-control" placeholder="Remark Details"></textarea>
                                <span class="text-danger">
                                    @error('dept_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-row  mb-3">
                           <div class="form-group col-lg-12">
                               <label class="form-check-label" for="rehire">Rehire</label>
                               <select name="rehire" id="rehire" class="form-select form-control">
                                  <option value="1">Yes</option>
                                  <option value="2">Maybe</option>
                                  <option value="3">No</option>
                               </select>
                           </div>
                          </div>
                          <div class="col-lg-12 px-2">
                             <input type="button" id="terminSubBtn" name="send" class="btn btn-primary" value="{{__('common.submit')}}">
                          </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!----- Staff Terminate modal end here ------------>
@push('scripts') 
 
	<script>
		$(document).ready(function(){ 

            $(document).on("click", ".PerforEditModalBtn", function(e) {
                e.preventDefault();
                var performance_id = $(this).data('id');
                $.ajax({
                    url: "{{ url('hrm/perform') }}/" + performance_id,
                    data: {
                        performance_id: performance_id
                    },
                    type: "POST",
                    dataType: "json",
                    success: function(response) {
                        var data = response.responseData;
                        console.log(data);

                        $("#EditPerverify_RemarkId").val(data.remark_id);
                        $("#EditPerverify_staffId").val(data.staff_id);
                        $("#EditperGrade").val(data.remark_grade);
                        $("#EditPerstaffRemark").val(data.remark_details);
                        
                        
                         
                    }
                });
            });

            
            $(document).on("click", ".bankDetailsEditModalBtn", function(e) {
                e.preventDefault();
                var bank_details_id = $(this).data('id');
                $.ajax({
                    url: "{{ url('hrm/bank-details') }}/" + bank_details_id,
                    data: {
                        bank_details_id: bank_details_id
                    },
                    type: "POST",
                    dataType: "json",
                    success: function(response) {
                        var data = response.responseData;
                          
                        $("#edit_bankStaffId").val(data.staff_id);
                        $("#edit_bankDetailsId").val(data.id);
                        $("#edit_account_name").val(data.account_name);
                        $("#edit_account_number").val(data.account_number);
                        $("#edit_bank_name").val(data.bank_name);
                        $("#edit_bank_indetifier_coder").val(data.bank_indetifier_coder);
                        $("#edit_bank_branch").val(data.bank_branch);
                        
                        
                         
                    }
                });
            });           
            

            //Staff Performance edit modal jquery
            $('#staffPerEditBtn').on("click",function(e){ 
                e.preventDefault();
                var data = {
                    staff_id : $('#EditPerverify_staffId').val(),
                    remark_id : $('#EditPerverify_RemarkId').val(),
                    grade: $('#EditperGrade').val(),
                    remark_details: $('#EditPerstaffRemark').val(),
                } 
                console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('hrm.staff-performance-update')}}",
                    data: data,
                    dataType: "json",
                    success: function(response) {  
                        Toaster("success", response.success);
                        
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000); 
                    }
                });
            });


            
            $(document).on('click', '#staffWorkExpBtn', function(e) {
				e.preventDefault();
				var experience_id = $(this).data('id');
                
                total_data = $('#totalEduData').val();
				var docData = $.parseJSON(total_data);
                let html_content = '';
                    $.each(docData, function(index, value) { 
                        if(value.document_type == '4')
                        html_content += '<option value="'+ value.document_id +'">'+ value.document_name +'</option>';
                    });
                    $('#edit_document_type').html(html_content);
				total_data = $('#TotalWorkExpData').val();
				var workData = $.parseJSON(total_data);
				$.each(workData, function(index, value) { 
					if(value.experience_id == experience_id){
                        console.log(value);
                        $('#experience_id').val(value.experience_id);
						$('#edit_comany_name').val(value.company_name);
						$('#edit_company_designation').val(value.company_designation);
						$('#edit_comany_address').val(value.company_address);
						$('#edit_contact_name').val(value.contact_name);
						$('#edit_contact_email').val(value.contact_email);
						$('#edit_contact_phone').val(value.contact_phone);
						$('#edit_date_of_joining').val(value.date_of_joining);
						$('#edit_date_of-leaving').val(value.date_of_leaving);
						$('#edit_reason_for_leaving').val(value.reason_for_leaving);
                        $('#work_staff_id').val(value.staff_id);
                        $('#edit_document_type').val(value.document_type);
					}
				});
			});

			// Permanent address data show in edit modal
			$('#permanent_address').on("click",function(e){
				e.preventDefault();
				var address_id = $('#permanent_address').data('id');
				var total_address = $('#totalAddressData').val();
				var addressData = $.parseJSON(total_address); 
                var country = $('#countryList').val();
				var country_list = $.parseJSON(country);
                let html_content = '';
                    $.each(country_list, function(index, value) { 
                        html_content += '<option value="'+ value.countries_id +'">'+ value.countries_name +'</option>';
                    });
                    $('#country_id').html(html_content);
				$.each(addressData, function(index, value) {
					if(value.address_id == address_id){
                        $('#staff_editId').val(value.staff_id); 
                        $('#addressId').val(value.address_id);
						$('#contact_number').val(value.phone_no);
						$('#street_address').val(value.street_address);
						$('#city').val(value.city);
						$('#state').val(value.state);
						$('#country_id').val(value.countries_id);
						$('#postcode').val(value.postcode);
					}
				});
			});

			// Present Adress data show in edit modal
			$('#present_address').on("click",function(e){
				e.preventDefault();
				var address_id = $('#present_address').data('id');
                $('#staff_editId').val(address_id);
				var total_address = $('#totalAddressData').val();
				var addressData = $.parseJSON(total_address); 
                var country = $('#countryList').val();
				var country_list = $.parseJSON(country);
                let html_content = '';
                    $.each(country_list, function(index, value) { 
                        html_content += '<option value="'+ value.countries_id +'">'+ value.countries_name +'</option>';
                    });
                    $('#country_id').html(html_content);
				$.each(addressData, function(index, value) {
					if(value.address_id == address_id){
                        $('#staff_editId').val(value.staff_id); 
                        $('#addressId').val(value.address_id);
						$('#contact_number').val(value.phone_no);
						$('#street_address').val(value.street_address);
						$('#city').val(value.city);
						$('#state').val(value.state);
						$('#country_id').val(value.countries_id);
						$('#postcode').val(value.postcode);
					}
				});
			}); 

			// Add Education Modal jquery 
			$('#AddEduModalBtn').on("click",function(){
				var totalDocData = $('#totalEduData').val();
				var docData = $.parseJSON(totalDocData);
				let html_content= '';
					jQuery.each(docData, function(key,value){
                        if(value.document_type == '3'){
                            html_content += '<option value="'+ value.document_id +'">'+ value.document_name +'</option>';
                        }
					});
				$('#add_document_type').html(html_content);  
                var education = $('#education').val();
                var eduList = $.parseJSON(education); 
                let html= '';
                    jQuery.each(eduList, function(key,value){
                        html += '<option value="'+ value.education_id +'">'+ value.education_name +'</option>';
                    });
                $('#educationList').html(html);
			});

			// Edit Education Modal jquery 
			$('.EduEditModalBtn').on("click",function(){
				var totalDocData = $('#totalEduData').val();
				var docData = $.parseJSON(totalDocData);
				let html_content= '';
					jQuery.each(docData, function(key,value){
                        if(value.document_type == '3'){
                            html_content += '<option value="'+ value.document_id +'">'+ value.document_name +'</option>';
                        }
					});
				$('#edit_eduDocument_type').html(html_content);  
                var education = $('#education').val();
                var eduList = $.parseJSON(education);
                let html= '';
                    jQuery.each(eduList, function(key,value){
                        html += '<option value="'+ value.education_id +'">'+ value.education_name +'</option>';
                    });
                $('#edit_education').html(html);  
				var education_id = $(this).data('id');
                $('#education_id').val(education_id);
				var eduData = $('#totalStaffDetails').val();
				var filterData = $.parseJSON(eduData); 
				$.each(filterData.staff_qualification,function(key,value){
					if(value.education_id == education_id){
                        console.log(value);
						$('#edit_education').val(value.education.education_id);
						$('#edit_university_name').val(value.university_name);
						$('#edit_addmission_year').val(value.admission_at);
						$('#edit_passing_year').val(value.passing_at);
						$('#edit_eduDocument_type').val(value.staff_doc_id); 
                        $('#qualification_id').val(value.qualification_id)
					}
				});
			});

			// Edit Basic information modal Data 
			$('#editBasicInfoModal').on("click",function(){
				var staff_id = $('#editBasicInfoModal').data('id'); 
				var totalDesgData = $('#totalDesignation').val();
				var desgData = $.parseJSON(totalDesgData); 
				var totalDeptData = $('#totalDepartment').val();
				var deptData = $.parseJSON(totalDeptData); 
				let html= '';
					jQuery.each(desgData, function(key,value){
						html += '<option value="'+ value.designation_id +'">'+ value.designation_name +'</option>';
					});
				$('#edit_designation').html(html);  
				let html_content = '';
					jQuery.each(deptData, function(key,value){
						html_content += '<option value="'+ value.department_id +'">'+ value.dept_name +'</option>';
					});
				$('#edit_department').html(html_content);  
				var staff_details = $('#totalStaffDetails').val();
				var StaffDetail = $.parseJSON(staff_details); 
                console.log(StaffDetail);
                $('#staff_editId').val(staff_id);
                $('#staff_editIds').val(staff_id);
				$('#staff_name').val(StaffDetail.staff_name);
				$('#employee_id').val(StaffDetail.employee_id);
				$('#staff_email').val(StaffDetail.staff_email);
				$('#staff_phone').val(StaffDetail.staff_phone);
				$('#edit_department').val(StaffDetail.department_id);
				$('#edit_designation').val(StaffDetail.designation.designation_id);
				$('#marital_status').val(StaffDetail.marital_status); 
				$('#date_of_birth').val(StaffDetail.date_of_birth);
				$('#basic_date_of_joining').val(StaffDetail.date_of_joining);
				$('#date_of_leaving').val(StaffDetail.date_of_leaving);
				$('#salary').val(StaffDetail.salary); 
                $('#gender').val(StaffDetail.gender); 
			});	
            
            //update Staff Basic Information jquery
            
            $('#AddStaffDetails').submit(function(e){  
                e.preventDefault() ;
            // $('#UpdateStaffBasInfoBtn').on("click",function(e){   
                var updateSection =  $('#caseTypeBasic').val(); 
 

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('hrm.updateStaff')}}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(response) {  
                        Toaster(response);
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000); 
                    }
                });
            });

            // update Address Modal jquery here 
            $('#UpdateStaffAddressBtn').on("click",function(e){    
                var data ={
                    updateSection: $('#caseTypeAdd').val(),
                    address_id : $('#addressId').val(),
                    staff_id : $('#staff_editId').val(),
                    contact_number : $('#contact_number').val(),
                    street_address : $('#street_address').val(),
                    city : $('#city').val(),
                    state : $('#state').val(),
                    country : $('#country_id').val(),
                    postcode : $('#postcode').val(), 
                } 
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('hrm.updateStaff')}}",
                    data: data,
                    dataType: "json",
                    success: function(response) {  
                        Toaster(response);
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000); 
                    }
                });
            });

            
            //update Staff Education jquey here
            // $('#UpdateStaffEduBtn').on("click",function(e){ 
            $('#imageUploadForm').submit(function(e){  
                e.preventDefault() ;
                var data ={
                    staff_id : $('#edu_staff_id').val(),
                    updateSection: $('#caseTypeEdu').val(),
                    education_id : $('#edit_education').val(),
                    university_name : $('#edit_university_name').val(),
                    addmission_year : $('#edit_addmission_year').val(),
                    passing_year : $('#edit_passing_year').val(),
                    document_type : $('#edit_eduDocument_type').val(),
                    document_upload : $('#edit_eduDocument_upload').val(),  
                    qualification_id : $('#qualification_id').val(),
                } 
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('hrm.updateStaff')}}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {  
                        Toaster(response);
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000); 
                    }
                });
            });

            //Edit work Exeperience Modal jquery
            // $('#staffWorkSubBtn').on("click",function(e){
            $('#EdituserForm').submit(function(e){ 
                e.preventDefault();

                var form = $("#EdituserForm")[0];
                if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add('was-validated');
                return;
                }
                
                var experience_id = $('#experience_id').val();
              

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('hrm.updateStaff')}}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(response) {  
                        Toaster(response);
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000); 
                    }
                });
            });

            //Add Education Modal jquery
 
            // $('#addEduSubBtn').on("click",function(e){   
            $('#AddEducationForm').submit(function(e){  
                e.preventDefault() ; 
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('hrm.updateStaff')}}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {  
                        Toaster(response);
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000); 
                    }
                });
            });

            //Add work Experience modal jquery
            $('#workInfoAddModalBtn').on("click",function(){
                staff_id = $(this).data('id');
                $('#workExpstaff_id').val(staff_id);
                total_data = $('#totalEduData').val();
				var docData = $.parseJSON(total_data);
                let html_content = '';
                    $.each(docData, function(index, value) { 
                        if(value.document_type == '4')
                        html_content += '<option value="'+ value.document_id +'">'+ value.document_name +'</option>';
                    });
                    $('#document_type').html(html_content); 
            });

            //Add work Exeperience modal submit jquery
            // $('#AdduserForm').on("click",function(){ 
            $('#AdduserForm').submit(function(e){  
                e.preventDefault() ; 
                var form = $("#AdduserForm")[0];
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.add('was-validated');
                    return;
                }
 

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('hrm.updateStaff')}}",
                    data:  new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {  
                        Toaster(response);
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000); 
                    }
                });
            });

            //staff id send in staff verification modal
            $('#staffVerify').on("click",function(){ 
                var staff_id = $(this).data('id'); 
                $('#verify_staffId').val(staff_id);
            });

            //Staff Verification modal jquery
            $('#staffVerBtn').on("click",function(e){ 
                e.preventDefault();
                var data = {
                    staff_id : $('#verify_staffId').val(),
                    remark_details: $('#staffRemark').val(),
                } 
                console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('hrm.verifyStaff')}}",
                    data: data,
                    dataType: "json",
                    success: function(response) {  
                        Toaster(response);
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000); 
                    }
                });
            });
 

            $(document).on("click", ".RemunerationEditBtn", function(e) {
                e.preventDefault();
                var remuneration_id = $(this).data('id');
                $.ajax({
                    url: "{{ url('hrm/remuneration') }}/" + remuneration_id,
                    data: {
                        remuneration_id: remuneration_id
                    },
                    type: "POST",
                    dataType: "json",
                    success: function(response) {
                        var data = response.responseData;
                        console.log(data);

                        $("#Editremuneration_value").val(data.remuneration_value);
                        $("#Editremuneration_type").val(data.remuneration_type);
                        $("#Editremuneration_typeId").val(data.remuneration_id);
                        $("#Editremuneration_date").val(data.remuneration_date);
                        $("#EditstaffRemId").val(data.staff_id);       
                        
                         
                    }
                });
            });
 
            //Staff Performance edit modal jquery
            $('#EditRemunerationBtn').on("click",function(e){ 
                e.preventDefault();

                var data = {
                    staff_id : $('#EditstaffRemId').val(),
                    remuneration_type: $('#Editremuneration_type').val(),
                    remuneration_value: $('#Editremuneration_value').val(),
                    remuneration_date: $('#Editremuneration_date').val(),
                    remuneration_id: $('#Editremuneration_typeId').val(),
                } 

                console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('hrm.staff-remuneration-update')}}",
                    data: data,
                    dataType: "json",
                    success: function(response) {  
                        Toaster("success", response.success);
                        
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000); 
                    }
                });
            });

            //staff id send in staff Performance modal
            $('.staffRemunerationAdd').on("click",function(){ 
                var staff_id = $(this).data('id'); 
                $('#remuneration_typeId').val(staff_id);
            });

            //staff id send in staff Performance modal
            $('.staffBankDetails').on("click",function(){ 
                var staff_id = $(this).data('id'); 
                $('#bankStaffId').val(staff_id);
            });   

            //Staff Performance edit modal jquery
            $('#updateBankDetailsBtn').on("click",function(e){ 
                e.preventDefault(); 

                var data = {
                    staff_id : $('#edit_bankStaffId').val(),
                    bank_details_id: $('#edit_bankDetailsId').val(),
                    account_name: $('#edit_account_name').val(),
                    account_number: $('#edit_account_number').val(),
                    bank_name: $('#edit_bank_name').val(),
                    bank_indetifier_coder: $('#edit_bank_indetifier_coder').val(),
                    bank_branch: $('#edit_bank_branch').val(),
                } 

                console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('hrm.bank-details-update')}}",
                    data: data,
                    dataType: "json",
                    success: function(response) {  
                        Toaster("success", response.success);
                        
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000); 
                    }
                });
            });         

            
            //Staff Performance modal jquery
            $('#AddStaffBankDetails').on("click",function(e){ 
                e.preventDefault();
 
                var form = $("#BankDetailsBtn")[0];
                if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add('was-validated');
                return;
                }

                var data = {
                    staff_id : $('#bankStaffId').val(),
                    account_name: $('#account_name').val(),
                    account_number: $('#account_number').val(),
                    bank_name: $('#bank_name').val(),
                    bank_indetifier_coder: $('#bank_indetifier_coder').val(),
                    bank_branch: $('#bank_branch').val(),
                } 
                console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('hrm.staff-bank-details')}}",
                    data: data,
                    dataType: "json",
                    success: function(response) {  
                        Toaster("success", response.success);
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000); 
                    }
                });
            });
            
             //Staff Performance modal jquery
             $('#addRemunerationBtn').on("click",function(e){ 
                e.preventDefault(); 
                var form = $("#Remuneration")[0];
                if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add('was-validated');
                return;
                }


                var data = {
                    staff_id : $('#remuneration_typeId').val(),
                    remuneration_type: $('#remuneration_type').val(),
                    remuneration_date: $('#remuneration_date').val(),
                    remuneration_value: $('#remuneration_value').val(),
                } 
                console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('hrm.staff-remuneration')}}",
                    data: data,
                    dataType: "json",
                    success: function(response) {  
                        Toaster("success", response.success);
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000); 
                    }
                });
            });

            //Staff Performance modal jquery
            $('#staffPerBtn').on("click",function(e){ 
                e.preventDefault();
                var data = {
                    staff_id : $('#Perverify_staffId').val(),
                    grade: $('#perGrade').val(),
                    remark_details: $('#PerstaffRemark').val(),
                } 
                console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('hrm.staff-performance')}}",
                    data: data,
                    dataType: "json",
                    success: function(response) {  
                        Toaster("success", response.success);
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000); 
                    }
                });
            });

            
            //staff id send in staff Performance modal
            $('.staffPerfor').on("click",function(){ 
                var staff_id = $(this).data('id'); 
                $('#Perverify_staffId').val(staff_id);
            });

            //staff id send in staff verification modal
            $('#staffTermBtn').on("click",function(){ 
                var staff_id = $(this).data('id'); 
                $('#termination_staffId').val(staff_id);
            });

            //Staff Verification modal jquery
            $('#terminSubBtn').on("click",function(e){ 
                e.preventDefault();
                var data = {
                    staff_id : $('#termination_staffId').val(),
                    termination_reason: $('#termination_reason').val(),
                    date_of_leaving : $('#ter_date_of_leaving').val(),
                    remark_details : $('#ter_remark_details').val(),
                    rehire : $('#rehire').val(), 
                }  
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('hrm.terminateStaff')}}",
                    data: data,
                    dataType: "json",
                    success: function(response) {  
                        Toaster(response);
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000); 
                    }
                });
            });

		});
	</script>
@endpush
</x-app-layout>
