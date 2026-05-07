<x-login.layout>

    <div class="row g-0">
        <div class="col-xxl-3 col-lg-4 col-md-5">
            <div class="auth-full-page-content d-flex p-sm-5 p-4">
                <div class="w-100">
                    <div class="d-flex flex-column h-100">
                        <div class="mb-4 mb-md-5 text-center">
                            <a href="index.html" class="d-block auth-logo">
                                <img src="assets/images/logo-sm.svg" alt="" height="28"> <span
                                    class="logo-txt">Minia</span>
                            </a>
                        </div>
                        <div class="auth-content my-auto">
                            <div class="text-center">

                                <div class="avatar-lg mx-auto">
                                    <div class="avatar-title rounded-circle bg-light">
                                        <i class="bx bxs-envelope h2 mb-0 text-primary"></i>
                                    </div>
                                </div>
                                <div
                                    class="p-2 mt-4>

                                    <h4>Verify your email</h4>
                                    <p class="mb-5">
                                    Please enter the 6 digit code sent to
                                    </p>

                                    @if (session('error'))
                                        <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif
                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif

                                    <form action="{{ route('verify-code-proses') }}" method="POST" class="my-4">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="code" class="form-label">Verification Code</label>
                                            <input type="text" name="code" id="code"
                                                class="form-control @error('code') is-invalid @enderror" maxlength="6"
                                                placeholder="Enter Your Code" required autofocus>
                                            @error('code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn w-100 waves-effect waves-light" type="submit"
                                                style="background-color: #ff797a; border-color: #ff797a; color: #fff;">
                                                Submit
                                            </button>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-grd-voilet text-white"
                                                    style="background-color: #ff797a; border-color: #ff797a; color: #fff;>Verify
                                                    Code</button>
                                                <a href="{{ route('login') }}"
                                                    class="btn btn-light">Back to Login</a>
                                            </div>
                                        </div>

                                    </form>

                                    @push('scripts')
                                        <script>
                                            // Auto move to next input
                                            document.querySelectorAll('.two-step').forEach((input, idx, arr) => {
                                                input.addEventListener('input', function() {
                                                    if (this.value.length === 1 && idx < arr.length - 1) {
                                                        arr[idx + 1].focus();
                                                    }
                                                });
                                            });

                                            // On submit, join all code[] into code_full
                                            document.querySelector('form').addEventListener('submit', function(e) {
                                                let code = '';
                                                document.querySelectorAll('input[name="code[]"]').forEach(function(input) {
                                                    code += input.value;
                                                });
                                                document.getElementById('code_full').value = code;
                                            });
                                        </script>
                                    @endpush


                                </div>

                            </div>

                            <div class="mt-5 text-center">
                                <p class="text-muted mb-0">Didn't receive an email ? <a href="#"
                                        class="text-primary fw-semibold"> Resend </a> </p>
                            </div>
                        </div>
                        <div class="mt-4 mt-md-5 text-center">
                            <p class="mb-0">©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Minia . Crafted with <i class="mdi mdi-heart text-danger"></i>
                                by Themesbrand
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
                </ul>
                <!-- end bubble effect -->
                <div class="row justify-content-center align-items-center">
                    <div class="col-xl-7">
                        <div class="p-0 p-sm-4 px-xl-0">
                            <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                {{-- <div
                                    class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                    <button type="button" data-bs-target="#reviewcarouselIndicators"
                                        data-bs-slide-to="0" class="active" aria-current="true"
                                        aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#reviewcarouselIndicators"
                                        data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#reviewcarouselIndicators"
                                        data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div> --}}
                                <!-- end carouselIndicators -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="testi-contain text-white">
                                            <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                            <h4 class="mt-4 fw-medium lh-base text-white">“Melita Kitchen bukan sekadar
                                                tempat makan, tapi pengalaman kuliner yang memanjakan lidah dan hati.
                                                Menu variatif dan pelayanan ramah membuat saya ingin selalu kembali.”
                                            </h4>

                                            {{-- <div class="mt-4 pt-3 pb-5">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-1.jpg"
                                                            class="avatar-md img-fluid rounded-circle" alt="...">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3 mb-4">
                                                        <h5 class="font-size-18 text-white">Richard Drews
                                                        </h5>
                                                        <p class="mb-0 text-white-50">Web Designer</p>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <div class="testi-contain text-white">
                                            <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                            <h4 class="mt-4 fw-medium lh-base text-white">“Sistem penilaian karyawan
                                                berbasis MOORA yang diterapkan di Melita Kitchen sangat adil dan
                                                transparan. Kinerja kami dihargai secara objektif, memotivasi untuk
                                                terus berkembang.”</h4>

                                            {{-- <div class="mt-4 pt-3 pb-5">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-2.jpg"
                                                            class="avatar-md img-fluid rounded-circle" alt="...">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3 mb-4">
                                                        <h5 class="font-size-18 text-white">M Nurul Amin
                                                        </h5>
                                                        <p class="mb-0 text-white-50">Manager Utama</p>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <div class="testi-contain text-white">
                                            <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                            <h4 class="mt-4 fw-medium lh-base text-white">“Bekerja di Melita Kitchen
                                                memberikan saya kesempatan untuk bertumbuh. Penilaian berkala dengan
                                                metode MOORA membuat kontribusi setiap karyawan terasa bermakna.”</h4>

                                            {{-- <div class="mt-4 pt-3 pb-5">
                                                <div class="d-flex align-items-start">
                                                    <img src="assets/images/users/avatar-3.jpg"
                                                        class="avatar-md img-fluid rounded-circle" alt="...">
                                                    <div class="flex-1 ms-3 mb-4">
                                                        <h5 class="font-size-18 text-white">Rossy</h5>
                                                        <p class="mb-0 text-white-50">Manager
                                                        </p>
                                                    </div>
                                                </div>
                                            </div> --}}
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
