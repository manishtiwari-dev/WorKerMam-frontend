

<x-guest-layout>
 <!-- Hero Start --> 
 <style>
 .footer {
    font-size: 12px;
    line-height:5;
    letter-spacing: .3px;
    background-color: #fafbfc;
    color: #637388;
    border-top: 1px solid rgba(72,94,144,.16);
    text-transform: uppercase;
   text-align: center;
}
.btn-brand-02 {
    background-color: #042893;
    border-color: #042893;
    color: #fff;
}

.button {
    padding: 8px 15px;
    border-radius: 5px;
    font-size: 15px;
}
.btn:hover {
    color: #b9b4b4;
}
.danger-button {
    background-color: rgba(228,63,82,.9);
    color: #fff;
    border-color: #e43f52;
}
.page-wrapper .page-content{
    overflow-x:inherit;
    min-height: calc(100vh - 61px)!important;
}
 </style>
 
 <div class="login-page-wrapper ">
    <div class="page-wrapper">
        <div class="page-content">
            <div class="container layout-specing">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-6">
                        <div class="me-lg-5">   
                            <img src="{{asset('assets/images/ForgotePassword.jpg')}}" class="img-fluid d-block mx-auto" alt="">
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="card login-page shadow rounded border-0">
                            <div class="card-body">
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <h5 class="mb-3 text-center">Reset your password</h5>

                                    <p class="text-muted">Please enter your email address. You will receive a link
                                        to create a new password via email.</p>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"  class="bi bi-envelope-fill feather feather-user fea icon-sm icons" viewBox="0 0 16 16">
                                                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                                                    </svg> --}}
                                                    <input type="email" class="form-control" name="email" :value="old('email')" required autofocus id="email" placeholder="name@example.com">
                                                    @error('email')
                                                    <strong class="text-danger mb-5">{{ $message }}</strong>
                                                    @enderror
                                            </div>
                                        </div>
                                    <button class="btn btn-primary w-100" type="submit">Send</button>
                                    </form>
                            </div>
                        </div><!---->
                    </div> <!--end col-->
                </div><!--end row-->
            </div> <!--end container-->
          

        </div><!--end section-->
        <footer class="footer ml-0">
                <div>
                    <span>@ <time datetime="1670502888510">2022</time> WorkerMan</span>
                </div>
            </footer>
    </div>
</div>
</x-guest-layout>