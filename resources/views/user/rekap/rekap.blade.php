@extends('components.user.app')
@section('title', 'Rekap Hasil')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/kuesioner.css') }}">
@endpush

@section('content')

<div style="max-width:900px; margin:0 auto; padding:32px 24px 60px;">

    {{-- HEADER --}}
    <div class="rekap-header">
        <div>
            <div style="font-size:20px; font-weight:700; color:#2c3e30;">
                Rekap Hasil Kuesioner
            </div>
            <div style="font-size:12px; color:#5a6e5f; margin-top:2px;">
                Diperbarui: {{ now()->format('d F Y') }}
                &nbsp;·&nbsp;
                Total: {{ $rekap->total() }} pengisian
            </div>
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-num hijau">{{ $stats['tinggi'] }}</div>
            <div class="stat-label">Minat Tinggi</div>
        </div>
        <div class="stat-card">
            <div class="stat-num gold">{{ $stats['sedang'] }}</div>
            <div class="stat-label">Minat Sedang</div>
        </div>
        <div class="stat-card">
            <div class="stat-num coklat">{{ $stats['rendah'] }}</div>
            <div class="stat-label">Minat Rendah</div>
        </div>
    </div>

    {{-- TABEL --}}
    <div class="rekap-table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nilai Akhir</th>
                    <th>Kategori</th>
                    <th>Rekomendasi Utama</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rekap as $row)
                    @php
                        $kat = $row->klasifikasiPenilaian?->nama_kategori ?? '-';
                        $katLower = strtolower($kat);
                    @endphp
                    <tr>
                        <td style="color:#9aaa9e; font-weight:600;">
                            {{ $loop->iteration + ($rekap->currentPage() - 1) * $rekap->perPage() }}
                        </td>
                        <td style="font-weight:700; color:#1a5c2e;">
                            {{ number_format($row->nilai_akhir, 3) }}
                        </td>
                        <td>
                            <span class="kat-badge {{ $katLower }}">
                                {{ $kat }}
                            </span>
                        </td>
                        <td style="font-size:12px; color:#5a6e5f;">
                            {{-- Ambil usaha pertama dari relasi --}}
                            {{ $row->klasifikasiPenilaian?->usahas?->first()?->nama_usaha ?? '-' }}
                        </td>
                        <td style="font-size:11px; color:#9aaa9e;">
                            {{ $row->created_at->format('d M Y H:i') }}
                        </td>
                        <td>
                            <a href="{{ route('user.hasil.show', $row->id) }}"
                               style="font-size:12px; color:#1a5c2e; font-weight:600; text-decoration:none;">
                                Detail →
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6"
                            style="text-align:center; padding:48px; color:#9aaa9e; font-size:14px;">
                            Anda belum pernah mengisi kuesioner.
                            <br><br>
                            <a href="{{ route('user.kuesioner') }}" class="btn btn-primary"
                               style="display:inline-flex;">
                                Isi Kuesioner Sekarang →
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    @if($rekap->hasPages())
        <div style="margin-top:20px;">
            {{ $rekap->links() }}
        </div>
    @endif

</div>
@endsection