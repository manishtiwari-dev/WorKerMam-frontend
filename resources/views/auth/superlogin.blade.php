

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
 </style>
 

 <div class="login-page-wrapper ">
    <div class="page-wrapper">
        <div class="page-content">
            <div class="container layout-specing">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-6">
                        <div class="me-lg-5">   
                            <img src="{{asset('assets/images/Login-Page.png')}}" class="img-fluid d-block mx-auto" alt="">
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="card login-page shadow rounded border-0">
                            <div class="card-body">
                                <h4 class="card-title text-center">SIGN IN</h4>  
                                <form action="{{ url('superadmin/login') }}" method="POST"  class="needs-validation" novalidate>
                                @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                @if (session('error'))
                                                    <div class="alert alert-danger">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif
                                                @if(Session::has('flash_message'))
                                                    <div class="alert alert-danger">
                                                        {{ Session::get('flash_message') }}
                                                    </div>
                                                @endif
                                                <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="user" class="fea icon-sm icons"></i>
                                                     <input type="email"  name="email" :value="old('email')" required autofocus  class="form-control ps-5" id="email" >
                                                       @error('email')
                                                        <strong class="text-danger mb-5">{{ $message }}</strong>
                                                        @enderror
                                                </div>
                                            </div>
                                        </div><!--end col-->
                                        
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                                <div class="form-icon position-relative">
                                                    <i data-feather="key" class="fea icon-sm icons"></i>
                                                    <input type="password" class="form-control ps-5" name="password" required autocomplete="current-password"  id="password" >
                                                    @error('password')
                                                    <strong class="text-danger mb-5">{{ $message }}</strong>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-12">
                                            <div class="d-flex justify-content-between">
                                                <div class="mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" >

                                                        <label class="form-check-label" for="flexCheckDefault">Remember me</label>
                                                    </div>
                                                     
                                                </div>
                                                <p class="forgot-pass mb-0">
                                                @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}" class="text-dark fw-bold">Forgot password ?</a>
                                                @endif
                                                </p>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-12 mb-0">
                                            <div class="d-grid">
                                                <button class="btn btn-brand-02 w-100" type="submit">Sign in</button>
                                            </div>
                                        </div><!--end col-->

                                    </div><!--end row-->
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