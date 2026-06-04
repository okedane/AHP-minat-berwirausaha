@extends('components.user.app')
@section('title', 'Profil Saya')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/kuesioner.css') }}">
<style>
/* ─── PROFILE PAGE ───────────────────────────────────── */
:root {
    --hijau:       #1a5c2e;
    --hijau-mid:   #226b38;
    --hijau-light: #e8f5ec;
    --coklat:      #7b3f00;
    --gold:        #c8952a;
    --gold-light:  #fff8e8;
    --gray-50:     #f8faf9;
    --gray-100:    #f0f4f1;
    --gray-200:    #dde5df;
    --gray-400:    #9aaa9e;
    --gray-600:    #5a6e5f;
    --gray-800:    #2c3e30;
    --radius:      16px;
    --radius-sm:   10px;
}

</style>
@endpush

@section('content')

{{-- ── TOAST ── --}}
<div class="toast-wrap" id="toastWrap"></div>

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
            <div class="info-card-label">👤 Nama Lengkap</div>
            <div class="info-card-value">{{ $profile->nama_lengkap }}</div>
        </div>
        <div class="info-card">
            <div class="info-card-label">📧 Email</div>
            <div class="info-card-value" style="font-size:13px;">{{ auth()->user()->email }}</div>
        </div>
        <div class="info-card">
            <div class="info-card-label">🎓 Program Studi</div>
            <div class="info-card-value">{{ $profile->prodi }}</div>
        </div>
        <div class="info-card">
            <div class="info-card-label">🏛 Fakultas</div>
            @if($profile->fakultas)
                <div class="info-card-value">{{ $profile->fakultas }}</div>
            @else
                <div class="info-card-empty">Belum diisi</div>
            @endif
        </div>
        <div class="info-card">
            <div class="info-card-label">📅 Angkatan</div>
            @if($profile->angkatan)
                <div class="info-card-value">{{ $profile->angkatan }}</div>
            @else
                <div class="info-card-empty">Belum diisi</div>
            @endif
        </div>
        <div class="info-card">
            <div class="info-card-label">⏱ Terakhir Diperbarui</div>
            <div class="info-card-value" style="font-size:13px;">
                {{ $profile->updated_at->format('d M Y, H:i') }}
            </div>
        </div>
    </div>
    @endif

    {{-- ── FORM EDIT PROFIL ── --}}
    <div class="form-card">
        <div class="form-card-title">
            ✏️ {{ $profile ? 'Edit Profil' : 'Lengkapi Profil' }}
        </div>

        <form action="{{ route('user.profile.store') }}" method="POST"
              id="profileForm">
            @csrf

            {{-- Nama Lengkap --}}
            <div class="form-group">
                <label class="form-label" for="nama_lengkap">Nama Lengkap *</label>
                <input type="text"
                       id="nama_lengkap"
                       name="nama_lengkap"
                       class="form-input {{ $errors->has('nama_lengkap') ? 'is-invalid' : '' }}"
                       value="{{ old('nama_lengkap', $profile->nama_lengkap ?? '') }}"
                       placeholder="Masukkan nama lengkap Anda"
                       required>
                @error('nama_lengkap')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email (readonly, dari tabel users) --}}
          

            {{-- Prodi & Fakultas --}}
            <div class="form-row">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="prodi">Program Studi *</label>
                    <input type="text"
                           id="prodi"
                           name="prodi"
                           class="form-input {{ $errors->has('prodi') ? 'is-invalid' : '' }}"
                           value="{{ old('prodi', $profile->prodi ?? '') }}"
                           placeholder="Contoh: Informatika"
                           required>
                    @error('prodi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="fakultas">Fakultas</label>
                    <input type="text"
                           id="fakultas"
                           name="fakultas"
                           class="form-input {{ $errors->has('fakultas') ? 'is-invalid' : '' }}"
                           value="{{ old('fakultas', $profile->fakultas ?? '') }}"
                           placeholder="Contoh: FKIK">
                    @error('fakultas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Angkatan --}}
            <div class="form-group" style="margin-top:16px;">
                <label class="form-label" for="angkatan">Angkatan</label>
                <input type="number"
                       id="angkatan"
                       name="angkatan"
                       class="form-input {{ $errors->has('angkatan') ? 'is-invalid' : '' }}"
                       value="{{ old('angkatan', $profile->angkatan ?? '') }}"
                       placeholder="Contoh: 2022"
                       min="2000"
                       max="{{ date('Y') + 1 }}">
                @error('angkatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-save">
                💾 Simpan Profil
            </button>
        </form>
    </div>

</div>

@endsection

@push('scripts')
<script>
// ── TOAST ENGINE ────────────────────────────────────────
function showToast(message, type = 'success') {
    const wrap = document.getElementById('toastWrap');
    const toast = document.createElement('div');
    const icon  = type === 'success' ? '✅' : '❌';

    toast.className = `toast toast-${type}`;
    toast.innerHTML = `<span class="toast-icon">${icon}</span><span>${message}</span>`;
    toast.onclick   = () => dismissToast(toast);
    wrap.appendChild(toast);

    // Auto dismiss setelah 3.5 detik
    setTimeout(() => dismissToast(toast), 3500);
}

function dismissToast(toast) {
    toast.style.animation = 'toastOut .3s ease forwards';
    setTimeout(() => toast.remove(), 300);
}

// ── Tampilkan toast dari session Laravel ────────────────
// @if(session('toast_success'))
//     document.addEventListener('DOMContentLoaded', () => {
//         showToast("{{ session('toast_success') }}", 'success');
//     });
// @endif

// @if(session('toast_error'))
//     document.addEventListener('DOMContentLoaded', () => {
//         showToast("{{ session('toast_error') }}", 'error');
//     });
// @endif

// // ── Toast jika ada error validasi ───────────────────────
// @if($errors->any())
//     document.addEventListener('DOMContentLoaded', () => {
//         showToast('Periksa kembali data yang diisi.', 'error');
//     });
// @endif
</script>
@endpush