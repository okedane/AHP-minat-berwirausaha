<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Plugin CSS -->
    <link href="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- Preloader CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    {{-- <script>
        const routes = {
            usersIndex: "{{ route('users.index') }}",
            pegawaiIndex: "{{ route('pegawai.index') }}",
            unitKerjaIndex: "{{ route('unitKerja.index') }}"
        };
    </script> --}}
</head>
<style>
    .map-container {
        height: 400px;
        width: 100%;
        border: 2px solid #ddd;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .coordinates-display {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        border: 1px solid #dee2e6;
    }

    .coordinate-value {
        font-weight: bold;
        color: #495057;
    }

    .location-buttons {
        margin-bottom: 20px;
    }

    .location-buttons .btn {
        margin-right: 10px;
        margin-bottom: 5px;
    }

    .radius-circle {
        fill-opacity: 0.2;
        stroke-width: 2;
    }

    .page-title-box {
        padding: 20px 0;
    }

    .breadcrumb {
        background: none;
        padding: 0;
    }

    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: 1px solid rgba(0, 0, 0, 0.125);
    }

    .table th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }

    .btn-soft-primary {
        color: #556ee6;
        background-color: rgba(85, 110, 230, 0.1);
        border-color: transparent;
    }

    .btn-soft-danger {
        color: #f46a6a;
        background-color: rgba(244, 106, 106, 0.1);
        border-color: transparent;
    }

    .marker-popup {
        font-size: 14px;
    }

    .current-location-marker {
        background-color: #007bff;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
    }
</style>

<body data-sidebar="dark" data-sidebar-size="lg" class="sidebar-enable">
    <div id="layout-wrapper">`
        <x-header></x-header>
        <x-sidebar></x-sidebar>

        <div class="main-content">
            {{ $slot }}
            <x-footer></x-footer>
        </div>

        <x-toast></x-toast>

    </div>

    <x-right-sidebar></x-right-sidebar>

    <div class="rightbar-overlay"></div>

    <!-- JavaScript -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/libs/pace-js/pace.min.js') }}"></script> --}}

    <!-- Apexcharts -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Plugins js -->
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}">
    </script>

    <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- Datatable -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

    <script src="{{ asset('assets/libs/pristinejs/pristine.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/bootstrap-toasts.init.js') }}"></script>

    @if (session('success') || session('error'))
        <script>
            window.onload = function() {
                var toast = new bootstrap.Toast(document.getElementById('liveToast'));
                toast.show();
            };
        </script>
    @endif

    {{-- <script>
        // Fungsi toggle mata
        function setupPasswordToggle(inputId, buttonId, iconId) {
            const input = document.getElementById(inputId);
            const button = document.getElementById(buttonId);
            const icon = document.getElementById(iconId);

            button.addEventListener('click', function() {
                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                icon.classList.toggle('mdi-eye-outline', !isPassword);
                icon.classList.toggle('mdi-eye-off-outline', isPassword);
            });
        }

        // Jalankan toggle password
        setupPasswordToggle('current_password', 'toggleCurrent', 'iconCurrent');
        setupPasswordToggle('password1', 'togglePassword1', 'toggleIcon1');
        setupPasswordToggle('password2', 'togglePassword2', 'toggleIcon2');

        // Validasi konfirmasi password
        document.getElementById('submitBtn').addEventListener('click', function(e) {
            const password = document.getElementById('password1').value;
            const confirmPassword = document.getElementById('password2').value;
            const confirmInput = document.getElementById('password2');
            const confirmError = document.getElementById('confirmError');

            if (password !== confirmPassword) {
                e.preventDefault(); // hentikan submit
                confirmInput.classList.add('is-invalid');
                confirmError.style.display = 'block';
            } else {
                confirmInput.classList.remove('is-invalid');
                confirmError.style.display = 'none';
            }
        });
    </script> --}}

    <script>
        // Fungsi toggle mata
        function setupPasswordToggle(inputId, buttonId, iconId) {
            const input = document.getElementById(inputId);
            const button = document.getElementById(buttonId);
            const icon = document.getElementById(iconId);

            if (input && button && icon) {
                button.addEventListener('click', function() {
                    const isPassword = input.type === 'password';
                    input.type = isPassword ? 'text' : 'password';
                    icon.classList.toggle('mdi-eye-outline', !isPassword);
                    icon.classList.toggle('mdi-eye-off-outline', isPassword);
                });
            }
        }

        // Jalankan toggle untuk semua password field
        setupPasswordToggle('current_password', 'toggleCurrent', 'iconCurrent');
        setupPasswordToggle('password1', 'togglePassword1', 'toggleIcon1');
        setupPasswordToggle('password2', 'togglePassword2', 'toggleIcon2');

        // Validasi konfirmasi password saat submit
        const submitBtn = document.getElementById('submitBtn');
        if (submitBtn) {
            submitBtn.addEventListener('click', function(e) {
                const password = document.getElementById('password1')?.value;
                const confirmPassword = document.getElementById('password2')?.value;
                const confirmInput = document.getElementById('password2');
                const confirmError = document.getElementById('confirmError');

                if (password !== confirmPassword) {
                    e.preventDefault(); // hentikan submit
                    if (confirmInput) confirmInput.classList.add('is-invalid');
                    if (confirmError) confirmError.style.display = 'block';
                } else {
                    if (confirmInput) confirmInput.classList.remove('is-invalid');
                    if (confirmError) confirmError.style.display = 'none';
                }
            });
        }
    </script>




    {{-- <script>
        function handleSearch(event) {
            event.preventDefault();
            const query = document.getElementById('searchInput').value.toLowerCase();

            if (query === "user" || query === "users") {
                window.location.href = "{{ route('users.index') }}";
            } else if (query === "pegawai" || query === "pegawau") {
                window.location.href = "{{ route('pegawai.index') }}";
            } else if (query === "unitkerja" || query === "unit kerja") {
                window.location.href = "{{ route('unitKerja.index') }}";
            } else {
                alert("Halaman tidak ditemukan");
            }
        }
    </script> --}}

    <script>
        $(document).ready(function() {
            $('#pegawaiSelect').select2({
                placeholder: "Pilih Pegawai",
                allowClear: true,
                minimumResultsForSearch: 0
            });
        });
    </script>
    <!-- <script>
        $(document).ready(function() {
            // Force sidebar to be default size
            document.body.setAttribute('data-sidebar-size', 'lg');
            document.body.classList.remove('vertical-collpsed');
            
            // Check the default radio button
            let defaultSizeRadio = document.getElementById('sidebar-size-default');
            if (defaultSizeRadio) {
                defaultSizeRadio.checked = true;
            }
        });
    </script> -->
</body>

</html>
