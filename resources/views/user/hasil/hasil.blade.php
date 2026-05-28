@extends('components.user.app')
@section('title', 'Hasil Analisis')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/kuesioner.css') }}">
@endpush

@section('content')

@php
$heroClass = match($hasil['kategori']) {
'Tinggi' => 'tinggi',
'Sedang' => 'sedang',
default => 'rendah',
};
$heroIcon = match($hasil['kategori']) {
'Tinggi' => '🌟',
'Sedang' => '📈',
default => '💡',
};
@endphp

<div style="max-width:720px; margin:0 auto; padding:32px 24px 60px;">

  {{-- HERO HASIL --}}
  <div class="hasil-hero {{ $heroClass }}">
    <span class="hasil-icon">{{ $heroIcon }}</span>
    <div class="hasil-kategori-label">Kategori Minat Wirausaha</div>
    <div class="hasil-kategori">{{ $hasil['kategori'] }}</div>
    <div class="hasil-score">
      Nilai Akhir: {{ number_format($hasil['nilai_akhir'], 3) }}
    </div>
    <p class="hasil-desc">{{ $hasil['deskripsi'] }}</p>
  </div>

  {{-- Tanggal --}}
  <div style="text-align:right; font-size:12px; color:#9aaa9e; margin-bottom:16px;">
    Data: {{ now()->format('d M Y') }}
  </div>

  {{-- REKOMENDASI USAHA --}}
  <div class="nilai-section">
    <div class="nilai-title">🏪 Rekomendasi Jenis Usaha</div>
    <div class="rekomen-grid">
      @forelse($hasil['rekomendasi'] as $rek)
      <div class="rekomen-card">
        <div class="rekomen-icon">{{ $rek['icon'] }}</div>
        <div>
          <div class="rekomen-name">{{ $rek['nama'] }}</div>
          <div class="rekomen-desc">{{ $rek['desc'] }}</div>
        </div>
      </div>
      @empty
      <p style="color:#9aaa9e; font-size:13px;">Belum ada rekomendasi tersedia.</p>
      @endforelse
    </div>
  </div>

  {{-- NILAI PER KRITERIA --}}
  <div class="nilai-section">
    <div class="nilai-title">📊 Nilai Per Kriteria</div>
    @foreach($hasil['nilai_per_kriteria'] as $nk)
    <div class="nilai-row">
      <div class="nilai-name">
        {{ $nk['emoji'] ?? '📌' }} {{ $nk['nama'] }}
      </div>
      <div class="nilai-bar-bg">
        <div class="nilai-bar-fill" style="width:{{ ($nk['nilai'] / 5) * 100 }}%"></div>
      </div>
      <div class="nilai-val">{{ number_format($nk['nilai'], 2) }}</div>
    </div>
    @endforeach

    {{-- Total nilai akhir --}}
    <div style="margin-top:16px; padding-top:12px; border-top:1px solid #dde5df;
                    display:flex; justify-content:space-between; align-items:center;">
      <span style="font-size:13px; font-weight:700; color:#2c3e30;">
        Total Nilai Akhir (AHP)
      </span>
      <span style="font-size:18px; font-weight:700; color:#1a5c2e;">
        {{ number_format($hasil['nilai_akhir'], 3) }}
      </span>
    </div>
  </div>

  {{-- TOMBOL --}}
  <div class="btn-row" style="justify-content:center; margin-top:24px;">
    <a href="{{ route('user.kuesioner') }}" class="btn btn-outline">
      ← Isi Ulang
    </a>
    <a href="{{ route('user.rekap') }}" class="btn btn-primary">
      Lihat Rekap →
    </a>
  </div>

</div>
@endsection