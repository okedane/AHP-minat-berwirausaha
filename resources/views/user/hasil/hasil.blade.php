@extends('components.user.app')

@section('title', 'Hasil')

@section('content')
<div class="page" id="page-hasil">
  <div class="container">

    <div id="hasil-empty" class="empty-state">
      <div class="empty-icon">📋</div>
      <p>Isi kuesioner terlebih dahulu untuk melihat hasil analisis.</p>
      <br>
      <button class="btn btn-primary" onclick="switchPage('kuesioner', document.querySelectorAll('.nav-tab')[0])">
        Mulai Kuesioner →
      </button>
    </div>

    <div id="hasil-content" style="display:none">
      <!-- Hasil hero -->
      <div class="hasil-hero" id="hasil-hero">
        <span class="hasil-icon" id="hasil-icon">🌟</span>
        <div class="hasil-kategori-label">Kategori Minat Wirausaha</div>
        <div class="hasil-kategori" id="hasil-kategori">—</div>
        <div class="hasil-score" id="hasil-score">Nilai: —</div>
        <p class="hasil-desc" id="hasil-desc">—</p>
      </div>

      <!-- Rekomendasi -->
      <div class="nilai-section">
        <div class="nilai-title">
          🏪 Rekomendasi Jenis Usaha
        </div>
        <div class="rekomen-grid" id="rekomen-grid"></div>
      </div>

      <!-- Nilai per kriteria -->
      <div class="nilai-section">
        <div class="nilai-title">
          📊 Nilai Per Kriteria
        </div>
        <div id="nilai-kriteria-bars"></div>
      </div>

      <div class="btn-row" style="justify-content:center; margin-top:24px;">
        <button class="btn btn-outline" onclick="switchPage('rekap', document.querySelectorAll('.nav-tab')[2])">
          Lihat Rekap →
        </button>
      </div>
    </div>

  </div>
</div>
@endsection