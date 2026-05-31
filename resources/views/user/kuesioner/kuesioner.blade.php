@extends('components.user.app')
@section('title', 'Kuesioner')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/kuesioner.css') }}">
@endpush

@section('content')

<div style="max-width:720px; margin:0 auto; padding:32px 24px 60px;">

    ```
    {{-- HERO BANNER --}}
    <div class="hero">
        <div class="hero-label">Penelitian Akademik</div>

        <h1>Kuesioner Minat Berwirausaha Mahasiswa ICA</h1>

        <p>
            Universitas Bahaudin Mudhary Madura —
            Pengukuran menggunakan metode AHP berbasis
            {{ count($kriteria) }} kriteria utama
        </p>

        <div class="hero-meta">

            <div class="hero-meta-item">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2
                    M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>

                {{ collect($kriteria)->sum(fn($k) => count($k['pertanyaan'])) }}
                Pertanyaan
            </div>

            <div class="hero-meta-item">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.5">
                    <circle cx="12" cy="12" r="10" />
                    <path stroke-linecap="round" d="M12 6v6l4 2" />
                </svg>
                ±5 Menit
            </div>

            <div class="hero-meta-item">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                {{ count($kriteria) }} Kriteria AHP
            </div>

        </div>
    </div>

    {{-- ERROR VALIDASI --}}
    @if ($errors->any())
    <div class="alert alert-danger" style="margin-top:20px;">
        <ul style="margin:0;padding-left:18px;">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- FORM KUESIONER --}}
    <form action="{{ route('user.kuesioner.store') }}" method="POST">
        @csrf

        @foreach($kriteria as $i => $k)

        <div class="question-card"
            style="background:#fff;border-radius:16px;padding:24px;margin-top:24px;box-shadow:0 4px 12px rgba(0,0,0,.08);">

            <div style="margin-bottom:20px;">
                <span style="
                    display:inline-block;
                    padding:6px 12px;
                    border-radius:999px;
                    background:#eef2ff;
                    color:#4338ca;
                    font-size:12px;
                    font-weight:600;
                ">
                    {{ $k['kode'] }}
                </span>

                <h3 style="margin-top:10px;">
                    {{ $k['nama'] }}
                </h3>
            </div>

            @forelse($k['pertanyaan'] as $j => $pertanyaan)

            <div style="
                    padding:16px 0;
                    border-top:1px solid #eee;
                ">

                <p style="
                        font-weight:600;
                        margin-bottom:14px;
                    ">
                    {{ $loop->iteration }}.
                    {{ $pertanyaan }}
                </p>

                <div style="
                        display:flex;
                        flex-direction:column;
                        gap:10px;
                    ">

                    @foreach($skala as $s)

                    <label style="
                                display:flex;
                                align-items:center;
                                gap:10px;
                                cursor:pointer;
                            ">

                        <input
                            type="radio"
                            name="jawaban[{{ $i }}][{{ $j }}]"
                            value="{{ $s['nilai'] }}"
                            required>

                        <span>
                            {{ $s['label'] }}
                        </span>

                    </label>

                    @endforeach

                </div>

            </div>

            @empty

            <div style="
                    padding:16px;
                    border-radius:12px;
                    background:#fff3cd;
                    color:#856404;
                ">
                Belum ada pertanyaan pada kriteria ini.
            </div>

            @endforelse

        </div>

        @endforeach

        <div style="
        margin-top:32px;
        display:flex;
        justify-content:center;
    ">
            <button
                type="submit"
                class="btn btn-gold"
                style="
                padding:14px 28px;
                font-size:16px;
                font-weight:600;
            ">
                ✓ Submit Kuesioner
            </button>
        </div>

    </form>
    ```

</div>

@endsection