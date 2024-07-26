<x-guest-layout>
<!-- Hero Start -->
        <section class="bg-home bg-circle-gradiant d-flex align-items-center">
            <div class="bg-overlay bg-overlay-white"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card form-signin p-4 rounded shadow">
                            <form action="{{ route('register') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                <a href="index.html"><img src="assets/images/logo-icon.png" class="avatar avatar-small mb-4 d-block mx-auto" alt=""></a>
                                <h5 class="mb-3 text-center">Register your account</h5>
                            
                                <div class="form-floating mb-2">
                                    <input type="text" id="name" name="name" :value="old('name')" required autofocus class="form-control">
                                    <label for="name" :value="__('Name')" >Name</label>
                                </div>
                                 @error('name')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror

                                <div class="form-floating mb-2">
                                    <input type="email"  name="email" :value="old('email')" required class="form-control" id="email" placeholder="name@example.com">
                                    <label for="email" :value="__('Email')" >Email Address</label>
                                </div>
                                @error('email')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror

                            <!-- Password -->
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" required autocomplete="new-password" class="form-control" id="password" placeholder="Password">
                                    <label for="password" :value="__('Password')">Password</label>
                                </div>
                                @error('password')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror


                                <!-- Confirm Password -->
                                 <div class="form-floating mb-3">
                                    <input type="password" name="password_confirmation" required autocomplete="new-password" class="form-control" id="password_confirmation" required placeholder="Password">
                                    <label for="password_confirmation" :value="__('Confirm Password')">Confirm Password</label>
                                </div>
                                @error('password_confirmation')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">I Accept <a href="#" class="text-primary">Terms And Condition</a></label>
                                </div>
                
                                <button class="btn btn-primary w-100" type="submit">{{ __('Register') }}</button>

                                <div class="col-12 text-center mt-3">
                                    <p class="mb-0 mt-3"><small class="text-dark me-2">Already have an account ?</small> <a href="{{ route('login') }}" class="text-dark fw-bold">Sign in</a></p>
                                </div><!--end col-->

                                <p class="mb-0 text-muted mt-3 text-center">© <script>document.write(new Date().getFullYear())</script> Landrick.</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!--end container-->
        </section><!--end section-->
        <!-- Hero End -->
</x-guest-layout>