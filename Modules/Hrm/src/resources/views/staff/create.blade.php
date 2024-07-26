<style>
    .btn-size {
        margin-right: 5px !important;
        font-size: 12px !important;
    }
</style>
<x-app-layout>
    @section('title', 'Staff')

    <form action="{{route('hrm.staff.store')}}" id="staffFrom" class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
        <div class="tab-content mt-4" id="myTabContent">
            <!------ Personal Information Tab Start Here---------> 
            <!---- Primary Information data form start here ------------>
            <div class="card">
                <div class="tab-content">
                    <div class="card-header d-flex align-items-center justify-content-between px-3">
                        <h5 class="tx-15 mb-0">Primary Information</h5>
                    </div>
                    <div class="card-body pb-0">
                        <div class="form-row">
                            <div class="form-group col-md-4 col-12">
                                <label for="user_type">User Type</label>
                                <select class="form-select form-control select2" id="user_type" name="user_type" required>
                                    <option selected disable value="" disabled>Select User Type</option> 
                                    <option value="new">{{Trans('NEW')}}</option>
                                    <option value="existing">
                                    {{Trans('EXISTING')}}
                                    </option>
                                </select>
                                <div class="invalid-feedback">
                                        Select User Type
                                </div>
                            </div>

                            <!---- If User type is new then this input is showing othewise hide ------>
                            <div class="form-group col-md-4 col-12 d-none" id="users">
                                <label for="user_type">User</label>
                                <select class="form-select form-control select2" id="User" name="user_id" required>
                                    <option selected disable value="" disabled>Select User</option>  
                                    @if(!empty($user_list))
                                        @foreach($user_list as $userdata)
                                            <option value="{{$userdata->id}}">{{$userdata->first_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="invalid-feedback">
                                    Select User 
                                </div>
                            </div>
                            <!-------- hidden input field --------------->

                            <div class="form-group col-md-4 col-12" id="StaffRole">
                                <label for="role_name">Role</label>
                                <select class="form-select form-control select2" id="role_name" name="role_name" required>
                                    <option selected disable value="" disabled>Select Role</option> 
                                        @if(!empty($role_list))
                                            @foreach ($role_list as $list)
                                                <option value="{{ $list->roles_id }}"> {{ $list->roles_name }}</option>
                                            @endforeach
                                        @endif
                                </select>
                                <div class="invalid-feedback">
                                    Select Role 
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-12">
                                <label for="department_id">Department</label>
                                <select class="form-select form-control select2" id="department_id" name="department_id" required>
                                    <option selected disable value="" disabled>Select Department</option> 
                                    @if(!empty($department_list))
                                    @foreach ($department_list as $dl_data)
                                        <option value="{{ $dl_data->department_id }}"> {{ $dl_data->dept_name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <div class="invalid-feedback">
                                    Select department 
                                </div>
                            </div>
                        </div>
                        <div class="form-row" id="StaffDetail">
                            <div class="form-group col-md-4 col-12">
                                <label for="name">Staff Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Staff Name" value="{{old('name')}}" required>
                                <div class="invalid-feedback">
                                    Enter Staff Name
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-12">
                                <label for="email">Staff Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Staff Email" value="{{old('email')}}" required>
                                <div class="invalid-feedback">
                                    Enter Staff Email
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-12">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="{{old('password')}}" required>
                                <div class="invalid-feedback">
                                   Enter Password
                                </div>
                            </div>
                        </div>
                        <div class="form-row">  
                            <div class="form-group col-md-4 col-12">
                                <label for="industry">Designation</label>
                                <select class="form-select form-control select2" id="designation_id" name="designation_id" required>
                                    <option selected disable value="" disabled>Select Designation</option> 
                                    @if(!empty($designation_list))
                                    @foreach ($designation_list as $dg_data)
                                        <option value="{{ $dg_data->designation_id }}"> {{ $dg_data->designation_name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <div class="invalid-feedback">
                                    Select Designation
                                </div>
                            </div> 
                            <div class="form-group col-md-4 col-12">
                                <label for="date_of_joining">Date Of Joining</label>
                                <input type="date" class="form-control" id="date_of_joining" name="staff_date_of_joining" placeholder="{{ __('crm.contact_placeholder') }}" value="{{old('date_of_joining')}}" required>
                                <div class="invalid-feedback">
                                    Select Joining Date
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-12">
                                <label for="salary">Salary</label>
                                <input type="number" class="form-control" id="salary" name="salary" placeholder="Salary" value="{{old('salary')}}" required>
                                <div class="invalid-feedback">
                                    Enter salary
                                </div>
                            </div>
                        </div> 
                    </div>         
                </div> 
            </div> 
            <!---- Primary Information data form end here ------------>
            <!---- Personal Information data form start here ------------>
            <div class="card mt-3">
                <div class="tab-content">
                    <div class="card-header d-flex align-items-center justify-content-between px-3">
                        <h5 class="tx-15 mb-0">Personal Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4 col-12">
                                <label for="phone_no">Staff Photo</label>
                                <input type="file" class="form-control" id="staff_photo" name="staff_photo" placeholder="Staff Photo" value="">
                                <div class="invalid-feedback">
                                    Upload Staff Photo
                                </div>
                            </div>   

                            <div class="form-group col-md-4 col-12">
                                <label for="identity_proof">Identity Proof (@if(!empty($identity_doc)) @foreach($identity_doc as $key => $docData)  @endforeach {{$docData->document_name}}@if($key > 0)/@endif @endif)</label>
                                <input type="file" class="form-control" id="identity_proof" name="identity_proof" placeholder="Identity Proof" value="">
                                <div class="invalid-feedback">
                                    Upload Identity Proof
                                </div>
                            </div>  
                            <div class="form-group col-md-4 col-12">
                                <label for="address_proof">Address Proof (@if(!empty($address_doc)) @foreach($address_doc as $key => $docData)  @endforeach {{$docData->document_name}} @if($key > 0)/@endif @endif)</label>
                                <input type="file" class="form-control" id="address_proof" name="address_proof" placeholder="Address Proof" value="">
                                <div class="invalid-feedback">
                                    Upload Address Proof
                                </div>
                            </div>  

                            <div class="form-group col-md-4 col-12">
                                <label for="gender">Gender</label>
                                <select class="form-select form-control select2" id="gender" name="gender">
                                    <option selected disable value="" disabled>Select Gender</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                    <option value="3">Transgender</option>
                                </select>
                                <div class="invalid-feedback">
                                    Select Gender
                                </div>
                            </div>  
                            <div class="form-group col-md-4 col-12">
                                <label for="date_of_birth">Date Of Birth</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" placeholder=">Date Of Birth" value="{{old('date_of_birth')}}">
                                <div class="invalid-feedback">
                                    Enter Date of Birth
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-12">
                                <label for="street_address">Street Address</label>
                                <input type="text" class="form-control" id="street_address" name="street_address" placeholder="Street Address" value="{{old('street_address')}}">
                                <div class="invalid-feedback">
                                    Enter Street Address
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-12">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{old('city')}}">
                                <div class="invalid-feedback">
                                    Enter City
                                </div>
                            </div> 
                            <div class="form-group col-md-4 col-12">
                                <label for="state">State</label>
                                <input type="text" class="form-control" id="state" name="state" placeholder="State" value="{{old('state')}}">
                                <div class="invalid-feedback">
                                        Enter State
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-12">
                                <label for="countries_id">Country</label>
                                <select class="form-select form-control select2" id="countries_id" name="countries_id">
                                    <option selected disable value="" disabled>Select Country</option>  
                                    @if(!empty($country_list))
                                        @foreach ($country_list as $country)
                                            <option value="{{ $country->countries_id }}"> {{ $country->countries_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="invalid-feedback">
                                    Select Country
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-12">
                                <label for="postcode">Postcode</label>
                                <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Postcode" value="{{old('contact_name')}}">
                                <div class="invalid-feedback">
                                    Enter Postcode
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-12">
                                <label for="phone_no">Contact Number</label>
                                <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Contact Number" value="{{old('phone_no')}}">
                                <div class="invalid-feedback">
                                    Enter Contact Name
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-12 d-flex gap-2">
                                <input type="checkbox" name="address_type" value="1" class="form-check" id="diffrentAddress"><span class="ml-2"> Different Permanent Address</span>
                            </div>
                        </div>
                        <div class="permanent-address mt-4" style="display: none;">
                            <div class="form-row" >
                                
                                <div class="form-group col-md-4 col-12">
                                    <label for="permanent_street_address">Street Adddress</label>
                                    <input type="text" class="form-control" id="permanent_street_address" name="permanent_street_address" placeholder="Street Address" value="{{old('permanent_street_address')}}">
                                    <div class="invalid-feedback">
                                            Enter Street Address
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-12">
                                    <label for="permanent_city">City</label>
                                    <input type="text" class="form-control" id="permanent_city" name="permanent_city" placeholder="City" value="{{old('permanent_city')}}">
                                    <div class="invalid-feedback">
                                        Enter City
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-12">
                                    <label for="permanent_state">State</label>
                                    <input type="text" class="form-control" id="permanent_state" name="permanent_state" placeholder="State" value="{{old('permanent_state')}}">
                                    <div class="invalid-feedback">
                                        Enter State
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-12">
                                    <label for="permanent_countries_id">Country</label>
                                    <select class="form-select form-control select2" id="permanent_countries_id" name="permanent_countries_id">
                                        <option selected disable value="" disabled>Select Country</option> 
                                        @if(!empty($country_list))
                                            @foreach ($country_list as $country)
                                                <option value="{{ $country->countries_id }}"> {{ $country->countries_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">
                                        Select Country
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-12">
                                    <label for="permanent_postcode">Postcode</label>
                                    <input type="text" class="form-control" id="permanent_postcode" name="permanent_postcode" placeholder="Postcode" value="{{old('permanent_postcode')}}">
                                    <div class="invalid-feedback">
                                        Enter Postcode
                                    </div>
                                </div> 
                               
                                
                                
                                <div class="form-group col-md-4 col-12">
                                    <label for="permanent_phone_no">Alternative Contact Number</label>
                                    <input type="text" class="form-control" placeholder="Contact Number" id="permanent_phone_no" name="permanent_phone_no" value="{{old('permanent_phone_no')}}">
                                    <div class="invalid-feedback">
                                            Enter Contact Numeber
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>         
                </div> 
            </div>
            <!---- Personal Information data form end here ------------> 
            <!------ Personal Information Tab End Here--------->


             <!------ Qualification Information Tab Start Here---------> 
             <div class="card mt-3">
                <div class="tab-content">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="tx-15 mb-0">Bank Details</h5> 
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4 col-12">
                                <label for="account_name">Account Name</label>
                                <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Name" value="{{old('account_name')}}">
                                <div class="invalid-feedback">
                                    Enter Account Name
                                </div>
                            </div>  
                            <div class="form-group col-md-4 col-12">
                                <label for="account_number">Account Number</label>
                                <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Account Number" value="{{old('account_number')}}">
                                <div class="invalid-feedback">
                                    Enter Account Number
                                </div>
                            </div>  
                            <div class="form-group col-md-4 col-12">
                                <label for="bank_name">Bank Name</label>
                                <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Bank Name" value="{{old('bank_name')}}">
                                <div class="invalid-feedback">
                                    Enter Bank Name
                                </div>
                            </div> 
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-4 col-12">
                                <label for="bank_indetifier_coder">Bank Indetifier Coder</label>
                                <input type="text" class="form-control" id="bank_indetifier_coder" name="bank_indetifier_coder" placeholder="Bank Indetifier Coder" value="{{old('bank_indetifier_coder')}}">
                                <div class="invalid-feedback">
                                    Enter Bank Indetifier Coder
                                </div>
                            </div>  
                            <div class="form-group col-md-4 col-12">
                                <label for="bank_branch">Bank Branch</label>
                                <input type="text" class="form-control" id="bank_branch" name="bank_branch" placeholder="Bank Branch" value="{{old('bank_branch')}}">
                                <div class="invalid-feedback">
                                    Enter Bank Branch
                                </div>
                            </div>  
                            
                        </div>
                    </div>
                    
                </div>   
            </div>
            <!------ Qualification Information Tab End Here--------->


             
            <!------ Qualification Information Tab Start Here---------> 
            <div class="card mt-3">
                <div class="tab-content">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="tx-15 mb-0">Education Information</h5>
                            <div class="d-flex gap-2">
                                <button type="button" id="append" class="btn btn-sm btn-primary"><i data-feather="plus"></i></button> 
                            </div>
                        </div>
                    </div>
                    {{-- <input type="hidden" id="education_rowCount" name="edu_rowCount"> --}}
                    <div class="card-body" id="qualification_append">
                        <div class="div_remove">
                            <div class="form-row justify-content-end">
                                <div class="form-group rem mb-0">
                                    <a href="#" class="btn btn-sm btn-danger py-1 px-3" id="remove_Edurow_1">x</a>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-4">
                                    <label for="education_id">Education</label>
                                    <select class="form-select form-control select2" id="education_id" name="education_id[]">
                                        <option selected disabled value="">Select Education</option>
                                        @if(!empty($education_list))
                                            @foreach($education_list as $eduList)
                                                <option value="{{$eduList->education_id}}">{{$eduList->education_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">
                                       Please Select Education
                                    </div>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="education.0.university_name">Institute Name</label>
                                    <input type="text" name="university_name[]" id="university_name" class="form-control" placeholder="Institute Name">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="education.0.admission_at">Admission Year</label>
                                    <select class="form-select form-control select2" id="admission_at" name="admission_at[]">
                                        <option selected disabled value="">Select Admission Year</option>
                                        @for($i='1973'; $i<='2027'; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-4">
                                    <label for="education.0.passing_at">Passing Year</label>
                                    <select class="form-select form-control select2" id="passing_at" name="passing_at[]">
                                        <option selected disabled value="">Select Passing Year</option>
                                        @for($i='1973'; $i<='2027'; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group col-lg-4">  
                                    <label for="education.0.document_type">Document Type</label>
                                    <select class="form-select form-control select2" id="document_type" name="education_document_type[]">
                                        <option selected disabled value="">Select Document Type</option>
                                        @if(!empty($qualification))
                                            @foreach($qualification as $docData)
                                                <option value="{{$docData->document_id}}">{{$docData->document_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="customFile">Document Upload</label>
                                    <input type="file" class="form-control" id="customFile" name="education_document[]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
            <!------ Qualification Information Tab End Here--------->

            <!------ Work Experiance Tab Start Here--------->
            <div class="card mt-3">
                <div class="tab-content">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="tx-15 mb-0">Work Information</h5>
                            <div class="d-flex">
                                <button type="button" id="work_append" class="btn btn-sm btn-primary mg-r-5"><i data-feather="plus">+</i></button> 
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="work_rowCount" id="work_rowCount">
                    <div class="card-body pb-0 " id="work_experiance_append">
                        <div>
                            <div class="form-row justify-content-end">
                                <div class="form-group rem mb-0">
                                    <a href="#" class="btn btn-sm btn-danger py-1 px-3">x</a>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-4 col-12">
                                    <label for="workexp.0.company_name">Company Name</label>
                                    <input name="company_name[]" class="form-control" id="company_name" placeholder="Company Name">
                                </div>
                                <div class="form-group col-lg-4 col-12">
                                    <label for="workexp.0.company_designation">Company Designation</label>
                                    <input name="company_designation[]" id="company_designation" class="form-control" placeholder="Company Designation">
                                </div>
                                <div class="form-group col-lg-4 col-12">
                                    <label for="workexp.0.company_address">Company Address</label>
                                    <input name="company_address[]" id="company_address" class="form-control" placeholder="Company Address">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-4 col-12">
                                    <label for="workexp.0.contact_name">Contact Name</label>
                                    <input name="contact_name[]" id="contact_name[]" class="form-control" placeholder="Contact Name">
                                </div>
                                <div class="form-group col-lg-4 col-12">
                                    <label for="workexp.0.contact_email">Contact Email</label>
                                    <input name="contact_email[]" id="contact_email[]" class="form-control" placeholder="Contact Email">
                                </div>
                                <div class="form-group col-lg-4 col-12">
                                    <label for="workexp.0.contact_phone">Contact Phone</label>
                                    <input name="contact_phone[]" id="contact_phone[]" class="form-control" placeholder="Contact Phone">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-4 col-12">
                                    <label for="workexp.0.date_of_joining">Date Of Joining</label>
                                    <input type="date" name="work_date_of_joining[]" id="work_date_of_joining[]" class="form-control" placeholder="Date Of Joining"> 
                                </div>
                                <div class="form-group col-lg-4 col-12">
                                    <label for="workexp.0.date_of_leaving">Date Of Leaving</label>
                                    <input type="date" name="work_date_of_leaving[]" id="work_date_of_leaving[]" class="form-control" placeholder="Date Of Leaving">
                                </div>
                                <div class="form-group col-lg-4 col-12">
                                    <label for="reason_for_leaving">Reason For Leaving</label>
                                    <input name="reason_for_leaving[]" class="form-control" id="reason_for_leaving[]" placeholder="Reason For Leaving">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6 col-12">
                                    <label for="document_type">Document Type</label>
                                    <select class="form-select form-control select2" id="document_type[]" name="work_document_type[]">
                                        <option selected disabled value="">Select Document Type</option>
                                        @if(!empty($doc_types))
                                            @foreach($doc_types as $docData)
                                                <option value="{{$docData->document_id}}">{{$docData->document_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-lg-6 col-12"> 
                                    <label for="fileupload">Document Upload</label>
                                    <input type="file" class="form-control" id="customFile" name="expWork_document[]">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body py-0">
                        <div class="row">
                            <div class="">
                                <div class="col-sm-12 mb-3 mx-2 p-0">
                                    <input type="submit" id="submit" name="send" class="btn btn-primary" value="Submit">
                                    <a href="{{ route('hrm.staff.index') }}" class="btn btn-secondary mx-1">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>  
            </div>
            <!------ Work Experiance Tab End Here--------->
        </div>
    </form>
@push('scripts')
<script>
    $(document).ready(function() {
        //append qualification information
        let i = 2;
        $("#append").on("click",function(){
            $("#qualification_append").append(`<div class="card card-header mt-2 div_remove" >
                <div class="form-row justify-content-end">
                    <div class="form-group rem mb-0">
                        <a href="#" class="btn btn-sm btn-danger py-1 px-3" id="remove_Edurow_${i}">x</a>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-4 col-12">
                        <label for="education.0.education_id">Education</label>
                        <select class="form-select form-control select2" id="education_id" name="education_id[]" required>
                            <option selected disabled value="">Select Education</option>
                            <option value="1">10th</option>
                            <option value="2">12th</option>
                            <option value="3">Graduation</option>
                            <option value="4">Post Graduation</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-4 col-12">
                        <label for="education.0.university_name">University Name</label>
                        <input type="text" name="university_name[]" id="university_name_${i}" class="form-control" placeholder="University Name">
                    </div>
                    <div class="form-group col-lg-4 col-12">
                        <label for="education.0.admission_at">Admission Year</label>
                        <select class="form-select form-control select2" id="admission_at_${i}" name="admission_at[]">
                            <option selected disabled value="">Select Admission Year</option>
                            @for($i='1973'; $i<='2027'; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-4 col-12">
                        <label for="education.0.passing_at">Passing Year</label>
                        <select class="form-select form-control select2" id="passing_at_${i}" name="passing_at[]">
                            <option selected disabled value="">Select Passing Year</option>
                            @for($i='1973'; $i<='2027'; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-lg-4 col-12">
                        <label for="education.0.document_type">Document Type</label>
                        <select class="form-select form-control select2" id="education_document_type_${i}" name="education_document_type[]">
                            <option selected disabled value="">Select Document Type</option>
                            <option value="1">10th</option>
                            <option value="2">12th</option>
                            <option value="3">Graduation</option>
                            <option value="4">Post Graduation</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="customFile">Document Upload</label>
                        <input type="file" class="form-control" id="education_document_${i}" name="education_document[]">
                    </div>
                </div>
            </div>`);
            $('#education_rowCount').val(i);
            i++;
        });

        //remove qualification information & work experiance 
        $(document).on("click",".rem", function(){
           $(this).parent('div').parent('div').remove();
        });

		// append work experiance information 
        let j = 2;
		$("#work_append").on("click",function(){
            $("#work_experiance_append").append(` <div class="card card-header mt-2 row_id_${j}" >
                            <div class="form-row justify-content-end">
                                <div class="form-group rem mb-0">
                                    <a href="#" class="btn btn-sm btn-danger py-1 px-3">x</a>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-4 col-12">
                                    <label for="company_name">Company Name</label>
                                    <input name="company_name[]" class="form-control" id="company_name" placeholder="Company Name">
                                </div>
                                <div class="form-group col-lg-4 col-12">
                                    <label for="company_designation">Company Designation</label>
                                    <input name="company_designation[]" id="company_designation_${j}" class="form-control" placeholder="Company Designation">
                                </div>
                                <div class="form-group col-lg-4 col-12">
                                    <label for="company_address">Company Address</label>
                                    <input name="company_address[]" id="company_address_${j}" class="form-control" placeholder="Company Address">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-4 col-12">
                                    <label for="contact_name">Contact Name</label>
                                    <input name="contact_name[]" id="contact_name_${j}" class="form-control" placeholder="Contact Name">
                                </div>
                                <div class="form-group col-lg-4 col-12">
                                    <label for="contact_email">Contact Email</label>
                                    <input name="contact_email[]" id="contact_email_${j}" class="form-control" placeholder="Contact Email">
                                </div>
                                <div class="form-group col-lg-4 col-12"
                                    <label for="contact_phone">Contact Phone</label>
                                    <input name="contact_phone[]" id="contact_phone" class="form-control" placeholder="Contact Phone">
                                </div>
                            </div>
							<div class="form-row">
                                <div class="form-group col-lg-4 col-12">
                                    <label for="date_of_joining">Date Of Joining</label>
                                    <input type="date" name="work_date_of_joining[]" id="work_date_of_joining" class="form-control" placeholder="Date Of Joining"> 
                                </div>
                                <div class="form-group col-lg-4 col-12">
                                    <label for="date_of_leaving">Date Of Leaving</label>
                                    <input type="date" name="work_date_of_leaving[]" id="work_date_of_leaving" class="form-control" placeholder="Date Of Leaving">
                                </div>
                                <div class="form-group col-lg-4 col-12">
                                    <label for="reason_for_leaving">Reason For Leaving</label>
                                    <input name="reason_for_leaving[]" class="form-control" id="reason_for_leaving" placeholder="Reason For Leaving">
                                </div>
                            </div>
							<div class="form-row">
                                <div class="form-group col-lg-6 col-12">
                                    <label for="document_type">Document Type</label>
                                    <select class="form-select form-control select2" id="document_type" name="work_document_type[]">
                                        <option selected disabled value="">Select Document Type</option>
                                        <option value="1">10th</option>
                                        <option value="2">12th</option>
                                        <option value="3">Graduation</option>
                                        <option value="4">Post Graduation</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6 col-12">
                                    <label for="fileupload">Document Upload</label>
                                    <input type="file" class="form-control" id="customFile" name="expWork_document[]">
                                </div>
                            </div>
                        </div>`);
                        $('#work_rowCount').val(j);
                        j++;
		              });

        //Different Permanent Address
        $("#diffrentAddress").on("click",function() {
            $(".permanent-address").toggle();
        }); 

        $(".btnNext").on("click",function(){
            $('.nav-tabs > .active').removeClass('active').next('li').addClass('active').find('a').trigger('click');
         
        });

        $('.btnPrevious').click(function(){
            $('.nav-tabs > .active').removeClass('active').prev('li').addClass('active').find('a').trigger('click'); 
        });


        //
        $('#subBtn').on("click",function(e){
            e.preventDefault();  
            $('#staffFrom').addClass('was-validated');
            $("#staffFrom").validate({
                    focusInvalid: false,
                    invalidHandler: function(form, validator) {

                        if (!validator.numberOfInvalids())
                            return;

                        $('html, body').animate({
                            scrollTop: $(validator.errorList[0].element).offset().top
                        }, 2000);

                    }
                });
            $(".form-control:valid").css({
                "border-color": "#ced4da",
                "box-shadow": "none",
                "background-image": "none",
            });
            if ($('#staffFrom')[0].checkValidity() === false) {
                event.stopPropagation();
            } 
            else{
                $('#staffFrom').removeClass('was-validated')
                $('#staffFrom').submit();
            }
        });

        //user type change jquery
        $('#user_type').on('change', function() {
            var userType = $('#user_type').val();
            console.log(userType);
            if(userType == 'existing'){
                $('#StaffDetail,#StaffRole').addClass('d-none'); 
                $('#users').removeClass('d-none');
                $('#role_name,#name,#email,#password').removeAttr('required');
                $('#User').attr('required',true);
            }
            else{
                $('#StaffDetail,#StaffRole').removeClass('d-none'); 
                $('#role_name,#name,#email,#password').attr('required',true);
                $('#User').removeAttr('required');
                $('#users').addClass('d-none');
            }
        });
    });  
</script>
@endpush
</x-app-layout>
