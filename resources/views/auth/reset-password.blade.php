<x-login.layout>
    <div class="row g-0">
        <div class="col-xxl-3 col-lg-4 col-md-5">
            <div class="auth-full-page-content d-flex p-sm-5 p-4">
                <div class="w-100">
                    <div class="d-flex flex-column h-100">
                        <div class="mb-4 mb-md-5 text-center">
                            <a href="index.html" class="d-block auth-logo">
                                <img src="assets/images/logo-sm.svg" alt="" height="28"> <span
                                    class="logo-txt">UNIBA</span>
                            </a>
                        </div>
                        <div class="auth-content my-auto">
                            <div class="text-center">
                                <h5 class="mb-0">Reset Password</h5>
                                <p class="text-muted mt-2">Reset Password with Minia.</p>
                            </div>
                            <div class="alert alert-success text-center my-4" role="alert">
                                Enter your Email and instructions will be sent to you!
                            </div>
                            <form class="mt-4" action="{{ route('reset-password-proses') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="New Password" required>
                                        <button type="button" class="input-group-text bg-transparent" id="togglePassword" style="cursor: pointer;">
                                            <i class="mdi mdi-eye-off-outline" id="iconPassword"></i>
                                        </button>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            placeholder="Confirm Password" required>
                                        <button type="button" class="input-group-text bg-transparent" id="togglePasswordConfirmation" style="cursor: pointer;">
                                            <i class="mdi mdi-eye-off-outline" id="iconPasswordConfirmation"></i>
                                        </button>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 mt-4">
                                    <button class="btn btn-primary w-100 waves-effect waves-light"
                                       style="background-color: #006634; border-color: #006634; color: #fff;">Send</button>
                                </div>
                            </form>

                            <script>
                                document.getElementById('togglePassword').addEventListener('click', function(e) {
                                    e.preventDefault();
                                    const input = document.getElementById('password');
                                    const icon = document.getElementById('iconPassword');
                                    if (input.type === 'password') {
                                        input.type = 'text';
                                        icon.classList.remove('mdi-eye-off-outline');
                                        icon.classList.add('mdi-eye-outline');
                                    } else {
                                        input.type = 'password';
                                        icon.classList.remove('mdi-eye-outline');
                                        icon.classList.add('mdi-eye-off-outline');
                                    }
                                });

                                document.getElementById('togglePasswordConfirmation').addEventListener('click', function(e) {
                                    e.preventDefault();
                                    const input = document.getElementById('password_confirmation');
                                    const icon = document.getElementById('iconPasswordConfirmation');
                                    if (input.type === 'password') {
                                        input.type = 'text';
                                        icon.classList.remove('mdi-eye-off-outline');
                                        icon.classList.add('mdi-eye-outline');
                                    } else {
                                        input.type = 'password';
                                        icon.classList.remove('mdi-eye-outline');
                                        icon.classList.add('mdi-eye-off-outline');
                                    }
                                });
                            </script>

                            <div class="mt-5 text-center">
                                <p class="text-muted mb-0">Remember It ? <a href="{{ route('login') }}"
                                        class="text-primary fw-semibold"> Sign In </a> </p>
                            </div>
                        </div>
                        <div class="mt-4 mt-md-5 text-center">
                            <p class="mb-0">©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> UNIBA MADURA . Crafted with <i class="mdi mdi-heart text-danger"></i>
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
                <div class="bg-overlay" style="background-color: #006634;"></div>
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

                                            <h4 class="mt-4 fw-medium lh-base text-white">
                                                "Sistem pendukung keputusan ini membantu mahasiswa mengetahui tingkat minat berwirausaha secara lebih objektif berdasarkan hasil kuesioner dan perhitungan metode AHP."
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <div class="testi-contain text-white">
                                            <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                            <h4 class="mt-4 fw-medium lh-base text-white">
                                                "Dengan adanya sistem ini, proses pengukuran minat berwirausaha mahasiswa menjadi lebih terstruktur, transparan, dan mudah dipahami."
                                            </h4>

                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <div class="testi-contain text-white">
                                            <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                            <h4 class="mt-4 fw-medium lh-base text-white">
                                                "Metode AHP yang diterapkan pada sistem ini mampu membantu dalam menentukan tingkat minat mahasiswa terhadap dunia wirausaha berdasarkan beberapa kriteria penilaian."
                                            </h4>

                                        </div>
                                    </div>

                                </div>
                                <!-- end carousel-inner -->
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
