<x-login.layout>
    <x-toast />
    <div class="row g-0">
        <div class="col-xxl-3 col-lg-4 col-md-5">
            <div class="auth-full-page-content d-flex p-sm-5 p-4">
                <div class="w-100">
                    <div class="d-flex flex-column h-100">
                        <div class="mb-4 mb-md-5 text-center">
                            <a href="index.html" class="d-block auth-logo">
                                <img src="{{ asset('assets/images/logo-sm.svg') }}" alt="" height="100"> <span
                                    class="logo-txt">Melita</span>
                            </a>
                        </div>

                        <div class="auth-content my-auto">
                            <div class="text-center">
                                <h5 class="mb-0">Welcome Back !</h5>
                                <p class="text-muted mt-2">Sign in to continue to Melita.</p>
                            </div>
                            <form class="mt-4 pt-2" method="POST" action="{{ route('login-proses') }}" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" placeholder="Enter email"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <label class="form-label">Password</label>
                                        </div>
                                    </div>
                                    <div class="input-group auth-pass-inputgroup">
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            placeholder="Enter password" aria-label="Password"
                                            aria-describedby="password-addon">

                                        <button class="btn btn-light shadow-none ms-0" type="button"
                                            id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="">
                                    <div class="">
                                        <a href="{{ route('forgot') }}" class="text-muted">Forgot password?</a>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <button class="btn w-100 waves-effect waves-light" type="submit"
                                        style="background-color: #ff797a; border-color: #ff797a; color: #fff;">
                                        Log In
                                    </button>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-outline-secondary w-100" type="reset">
                                        Reset
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="mt-4 mt-md-5 text-center">
                            <p class="mb-0">©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Melita . Crafted with <i class="mdi mdi-heart text-danger"></i>
                                Dani
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end auth full page content -->
        </div>
        <!-- end col -->
        <div class="col-xxl-9 col-lg-8 col-md-7">
            <div class="auth-bg pt-md-5 p-4 d-flex">
                <div class="bg-overlay" style="background-color: #ff797a;"></div>
                <ul class="bg-bubbles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
                <!-- end bubble effect -->
                <div class="row justify-content-center align-items-center">
                    <div class="col-xl-7">
                        <div class="p-0 p-sm-4 px-xl-0">
                            <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">

                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="testi-contain text-white">
                                            <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                            <h4 class="mt-4 fw-medium lh-base text-white">“Melita Kitchen bukan sekadar
                                                tempat makan, tapi pengalaman kuliner yang memanjakan lidah dan hati.
                                                Menu variatif dan pelayanan ramah membuat saya ingin selalu kembali.”
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <div class="testi-contain text-white">
                                            <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                            <h4 class="mt-4 fw-medium lh-base text-white">“Sistem penilaian karyawan
                                                berbasis MOORA yang diterapkan di Melita Kitchen sangat adil dan
                                                transparan. Kinerja kami dihargai secara objektif, memotivasi untuk
                                                terus berkembang.”</h4>


                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <div class="testi-contain text-white">
                                            <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                            <h4 class="mt-4 fw-medium lh-base text-white">“Bekerja di Melita Kitchen
                                                memberikan saya kesempatan untuk bertumbuh. Penilaian berkala dengan
                                                metode MOORA membuat kontribusi setiap karyawan terasa bermakna.”</h4>

                                        </div>
                                    </div>
                                </div>
                                <!-- end carousel-inner -->
                            </div>
                            <!-- end review carousel -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
</x-login.layout>
