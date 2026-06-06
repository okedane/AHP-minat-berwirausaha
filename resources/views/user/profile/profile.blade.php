    @extends('components.user.app')
    @section('title', 'Profil Saya')

    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/kuesioner.css') }}">

    <style>

    </style>
    @endpush

    @section('content')


    <div class="profile-wrap">

        {{-- ── HERO ── --}}
        <div class="profile-hero">
            <div class="profile-avatar">
                {{ strtoupper(substr($profile->nama_lengkap ?? auth()->user()->name ?? 'U', 0, 1)) }}
            </div>
            <div class="profile-hero-info">
                <p class="profile-hero-name">
                    {{ $profile->nama_lengkap ?? auth()->user()->name ?? 'Belum diisi' }}
                </p>

                @if($profile)
                <span class="profile-hero-badge">
                    {{ $profile->prodi }} · {{ $profile->angkatan ?? '-' }}
                </span>
                @else
                <span class="profile-hero-badge">Profil belum diisi</span>
                @endif
            </div>
        </div>

        {{-- ── INFO CARDS ── --}}
        @if($profile)
        <div class="info-grid">
            <div class="info-card">
                <div class="info-card-label">Nama Lengkap</div>
                <div class="info-card-value">{{ $profile->nama_lengkap }}</div>
            </div>
            <div class="info-card">
                <div class="info-card-label"> Email</div>
                <div class="info-card-value" style="font-size:13px;">{{ auth()->user()->email }}</div>
            </div>
            <div class="info-card">
                <div class="info-card-label"> Program Studi</div>
                <div class="info-card-value">{{ $profile->prodi }}</div>
            </div>
            <div class="info-card">
                <div class="info-card-label"> Fakultas</div>
                @if($profile->fakultas)
                <div class="info-card-value">{{ $profile->fakultas }}</div>
                @else
                <div class="info-card-empty">Belum diisi</div>
                @endif
            </div>
        </div>
        @endif

        {{-- FORM UBAH PASSWORD --}}
        <div class="form-card">
            <div class="form-card-title">
                Ubah Password
            </div>

            <form action="{{ route('user.password.update') }}" method="POST">
                @csrf

                {{-- Password Lama --}}
                <div class="form-group">
                    <label>Password Lama</label>

                    <div class="password-container">
                        <input
                            type="password"
                            id="current_password"
                            name="current_password"
                            required>

                        <button
                            type="button"
                            class="toggle-password"
                            onclick="togglePassword('current_password','eye1')">
                            <i id="eye1" class="ti ti-eye-off"></i>
                        </button>
                    </div>

                    @error('current_password')
                    <div class="form-error" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password Baru --}}
                <div class="form-group">
                    <label>Password Baru</label>

                    <div class="password-container">
                        <input
                            type="password"
                            id="new_password"
                            name="new_password"
                            required>

                        <button
                            type="button"
                            class="toggle-password"
                            onclick="togglePassword('new_password','eye2')">
                            <i id="eye2" class="ti ti-eye-off"></i>
                        </button>
                    </div>

                    @error('new_password')
                    <div class="form-error" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div class="form-group">
                    <label>Konfirmasi Password Baru</label>

                    <div class="password-container">
                        <input
                            type="password"
                            id="new_password_confirmation"
                            name="new_password_confirmation"
                            required>

                        <button
                            type="button"
                            class="toggle-password"
                            onclick="togglePassword('new_password_confirmation','eye3')">
                            <i id="eye3" class="ti ti-eye-off"></i>
                        </button>
                    </div>

                    @error('new_password_confirmation')
                    <div class="form-error" style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
        </div>

        <button type="submit" class="btn btn-primary">
            Ubah Password
        </button>
        </form>
    </div>
    </div>
    @endsection