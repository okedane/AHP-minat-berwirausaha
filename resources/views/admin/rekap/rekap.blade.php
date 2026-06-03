<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Rekap Akun User</h4>
                    <form method="GET" action="{{ route('rekap.index') }}" class="d-flex gap-2">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama / email"
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </form>
                </div>

                <div class="card-body">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th style="width:60px;">No</th>
                                <th>Nama</th>
                                <th style="width:100px;" class="text-center">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rekaps as $index => $rekap)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $rekap['user']->name ?? '-' }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-soft-primary btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#detailModal{{ $rekap['user']->id }}">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="detailModal{{ $rekap['user']->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    Detail Rekap - {{ $rekap['user']->name ?? '-' }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Kategori & Nilai Akhir -->
                                                @if (!empty($rekap['kategoriInfo']))
                                                    <div class="mb-4 p-3" style="background:#f8f9fa; border-radius:8px;">
                                                        <h6 style="color:#6b7280; font-size:12px; text-transform:uppercase; font-weight:600; margin-bottom:4px;">Kategori Minat Wirausaha</h6>
                                                        <h3 style="color:#059669; font-weight:700; margin:8px 0 0;">{{ $rekap['kategoriInfo']['nama_kategori'] ?? '-' }}</h3>
                                                        <p style="color:#6b7280; font-size:13px; margin-top:8px;">{{ $rekap['kategoriInfo']['deskripsi'] ?? '' }}</p>
                                                    </div>

                                                    <div class="alert alert-info" role="alert">
                                                        <strong>Nilai Akhir:</strong> {{ number_format($rekap['nilai_akhir'], 3) }}
                                                    </div>
                                                @else
                                                    <div class="alert alert-warning">Belum ada data hasil kuesioner.</div>
                                                @endif

                                                <!-- Rekomendasi Usaha -->
                                                @if (!empty($rekap['usahasRekomendasi']) && count($rekap['usahasRekomendasi']) > 0)
                                                    <div class="mb-4">
                                                        <h6 style="color:#374151; font-weight:600; margin-bottom:12px;">Rekomendasi Usaha</h6>
                                                        <div style="display:grid; gap:10px;">
                                                            @foreach ($rekap['usahasRekomendasi'] as $usaha)
                                                                <div style="padding:12px; border:1px solid #e5e7eb; border-radius:8px; background:#fafafa;">
                                                                    <h6 style="color:#1f2937; font-weight:600; margin:0 0 4px;">{{ $usaha['nama'] }}</h6>
                                                                    <p style="color:#6b7280; font-size:13px; margin:0; line-height:1.4;">{{ $usaha['deskripsi'] }}</p>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif

                                                <!-- Detail Jawaban Per Pertanyaan -->
                                                <!-- @if ($rekap['details']->isNotEmpty())
                                                    <hr style="margin:16px 0;">
                                                    <h6 style="color:#374151; font-weight:600; margin-bottom:12px;">Detail Jawaban</h6>
                                                    <table class="table table-sm table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:50px;">No</th>
                                                                <th>Kriteria</th>
                                                                <th>Pertanyaan</th>
                                                                <th style="width:80px;">Nilai</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($rekap['details'] as $i => $detail)
                                                                <tr>
                                                                    <td>{{ $i + 1 }}</td>
                                                                    <td>{{ $detail['kriteria_nama'] ?? '-' }}</td>
                                                                    <td>{{ $detail['pertanyaan_text'] ?? '-' }}</td>
                                                                    <td>{{ $detail['nilai'] ?? 0 }}</td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="4" class="text-center">Belum ada data jawaban.</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                @endif -->
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Data rekap belum tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app>
