@extends('components.user.app')

@section('title', 'Rekap')

@section('content')
<div class="page" id="page-rekap">
  <div class="container">

    <div class="rekap-header">
      <div>
        <div class="rekap-title">Rekap Hasil Kuesioner</div>
        <div class="rekap-date" id="rekap-date">—</div>
      </div>
      <button class="btn btn-outline" onclick="exportCSV()" style="font-size:12px;padding:8px 16px;">
        ↓ Export CSV
      </button>
    </div>

    <div class="stats-row" id="stats-row">
      <div class="stat-card">
        <div class="stat-num hijau" id="stat-tinggi">0</div>
        <div class="stat-label">Minat Tinggi</div>
      </div>
      <div class="stat-card">
        <div class="stat-num gold" id="stat-sedang">0</div>
        <div class="stat-label">Minat Sedang</div>
      </div>
      <div class="stat-card">
        <div class="stat-num coklat" id="stat-rendah">0</div>
        <div class="stat-label">Minat Rendah</div>
      </div>
    </div>

    <div class="rekap-table-wrap">
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Nilai Akhir</th>
            <th>Kategori</th>
            <th>Rekomendasi Utama</th>
          </tr>
        </thead>
        <tbody id="rekap-tbody">
          <tr>
            <td colspan="5" style="text-align:center;padding:40px;color:#9aaa9e;">
              Belum ada data. Isi kuesioner terlebih dahulu.
            </td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</div>
@endsection