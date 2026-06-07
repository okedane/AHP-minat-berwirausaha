<x-app>
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Ubah Password</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
                                <li class="breadcrumb-item active">Ubah Password</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card --}}
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Ganti Password</h4>
                        </div>
                        <div class="card-body">

                            {{-- Notifikasi Flash --}}
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form method="POST" action="{{ route('admin.password.update') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Password Lama</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="current_password"
                                            name="current_password" required>
                                        <button type="button" class="btn btn-outline-secondary" id="toggleCurrent">
                                            <i class="mdi mdi-eye-outline" id="iconCurrent"></i>
                                        </button>
                                    </div>
                                    @error('current_password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <!-- Password Baru -->
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">Password Baru</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password1" name="new_password"
                                            required>
                                        <button type="button" class="btn btn-outline-secondary" id="togglePassword1">
                                            <i class="mdi mdi-eye-outline" id="toggleIcon1"></i>
                                        </button>
                                    </div>
                                    @error('new_password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Konfirmasi Password -->
                                <div class="mb-3">
                                    <label for="new_password_confirmation" class="form-label">Konfirmasi Password
                                        Baru</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password2"
                                            name="new_password_confirmation" required>
                                        <button type="button" class="btn btn-outline-secondary" id="togglePassword2">
                                            <i class="mdi mdi-eye-outline" id="toggleIcon2"></i>
                                        </button>
                                    </div>
                                    <small id="confirmError" class="text-danger d-none">Konfirmasi password tidak
                                        cocok.</small>
                                </div>


                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app>
