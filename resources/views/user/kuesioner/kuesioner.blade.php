@extends('components.user.app')
@section('title', 'Kuesioner')

@section('content')
<!-- ══ KUESIONER PAGE ══ -->
<div class="page active" id="page-kuesioner">
  <div class="container">

    <!-- Hero Banner -->
    <div class="hero">
      <div class="hero-label">Penelitian Akademik</div>
      <h1>Kuesioner Minat Berwirausaha Mahasiswa</h1>
      <p>Universitas Bahaudin Mudhary Madura — Pengukuran menggunakan metode AHP berbasis 5 kriteria utama</p>
      <div class="hero-meta">
        <div class="hero-meta-item">
          <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
          </svg>
          20 Pertanyaan
        </div>
        <div class="hero-meta-item">
          <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <circle cx="12" cy="12" r="10" />
            <path stroke-linecap="round" d="M12 6v6l4 2" />
          </svg>
          ±5 Menit
        </div>
        <div class="hero-meta-item">
          <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          5 Kriteria AHP
        </div>
      </div>
    </div>

    <!-- Progress -->
    <div class="progress-wrap">
      <div class="progress-header">
        <span class="progress-label">Progress Pengisian</span>
        <span class="progress-count" id="progress-text">Kriteria 1 dari 5</span>
      </div>
      <div class="progress-bar-bg">
        <div class="progress-bar-fill" id="progress-fill" style="width:20%"></div>
      </div>
      <div class="progress-steps" id="progress-steps"></div>
    </div>

    <!-- Questions -->
    <div id="questions-area"></div>

    <!-- Navigation -->
    <div class="btn-row">
      <button class="btn btn-outline" id="btn-prev" onclick="prevKriteria()">
        ← Sebelumnya
      </button>
      <button class="btn btn-primary" id="btn-next" onclick="nextKriteria()">
        Selanjutnya →
      </button>
      <button class="btn btn-gold" id="btn-submit" style="display:none" onclick="submitKuesioner()">
        ✓ Submit Kuesioner
      </button>
    </div>

  </div>
</div>

<!-- ══ HASIL PAGE ══ -->


<!-- ══ REKAP PAGE ══ -->

@endsection