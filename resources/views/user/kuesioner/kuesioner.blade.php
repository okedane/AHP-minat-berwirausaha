{{-- resources/views/user/kuesioner/kuesioner.blade.php --}}

@extends('components.user.app')
@section('title', 'Kuesioner')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/kuesioner.css') }}">
@endpush

@section('content')

{{--
    ✅ FIX: script ini WAJIB ada dan TIDAK boleh di-comment
    $kriteria dan $skala dikirim dari KuesionerController@kuesioner()
    Tanpa ini, window.KRITERIA kosong → pertanyaan tidak muncul
--}}
<script>
    window.KRITERIA = @json($kriteria);
    window.SKALA    = @json($skala);
</script>

<div style="max-width:720px; margin:0 auto; padding:32px 24px 60px;">

    {{-- HERO BANNER --}}
    <div class="hero">
        <div class="hero-label">Penelitian Akademik</div>
        <h1>Kuesioner Minat Berwirausaha Mahasiswa</h1>
        <p>Universitas Bahaudin Mudhary Madura — Pengukuran menggunakan metode AHP berbasis {{ count($kriteria) }} kriteria utama</p>
        <div class="hero-meta">
            <div class="hero-meta-item">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2
                           M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                {{ collect($kriteria)->sum(fn($k) => count($k['pertanyaan'])) }} Pertanyaan
            </div>
            <div class="hero-meta-item">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <circle cx="12" cy="12" r="10"/>
                    <path stroke-linecap="round" d="M12 6v6l4 2"/>
                </svg>
                ±5 Menit
            </div>
            <div class="hero-meta-item">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ count($kriteria) }} Kriteria AHP
            </div>
        </div>
    </div>

    {{-- PROGRESS BAR --}}
    <div class="progress-wrap">
        <div class="progress-header">
            <span class="progress-label">Progress Pengisian</span>
            <span class="progress-count" id="progress-text">
                Kriteria 1 dari {{ count($kriteria) }}
            </span>
        </div>
        <div class="progress-bar-bg">
            <div class="progress-bar-fill" id="progress-fill"
                 style="width:{{ (1 / max(count($kriteria), 1)) * 100 }}%">
            </div>
        </div>
        <div class="progress-steps" id="progress-steps"></div>
    </div>

    {{-- Route POST untuk submit — dibaca oleh kuesioner.js --}}
    <input type="hidden" id="form-action" value="{{ route('user.kuesioner.store') }}">

    {{-- Area pertanyaan — dirender oleh kuesioner.js --}}
    <div id="questions-area"></div>

    {{-- Tombol navigasi --}}
    <div class="btn-row">
        <button class="btn btn-outline" id="btn-prev"
                onclick="prevKriteria()" style="display:none">
            ← Sebelumnya
        </button>
        <button class="btn btn-primary" id="btn-next"
                onclick="nextKriteria()">
            Selanjutnya →
        </button>
        <button class="btn btn-gold" id="btn-submit"
                onclick="submitKuesioner()" style="display:none">
            ✓ Submit Kuesioner
        </button>
    </div>

</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/kuesioner.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Cek apakah data sudah terinjeksi dengan benar
            if (!window.KRITERIA || window.KRITERIA.length === 0) {
                console.error('KRITERIA kosong! Cek controller dan database.');
                document.getElementById('questions-area').innerHTML =
                    '<div style="padding:20px;color:red;">⚠ Data kriteria tidak ditemukan. Pastikan tabel kriterias sudah diisi.</div>';
                return;
            }
            initKuesioner();
        });
    </script>
@endpush