<x-app>
    <x-slot:title>Detail Rekap</x-slot:title>
    <div class="page-content">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Detail Kriteria</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dt-responsive nowrap w-100" id="datatable-buttons">
                        <thead>
                            <tr>
                                <th style="width:20px">No</th>
                                <th>Nilai Akhir</th>
                                <th>Kategori</th>
                                <th>Rekomendasi Utama</th>
                                <th>Tanggal</th>
                                <!-- <th style="text-align: center; width: 100px;" class="no-export">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kriteria as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nilai_akhir ?? '-' }}</td>
                                    <td>{{ $item->kategori ?? '-' }}</td>
                                    <td>{{ $item->rekomendasi_utama ?? $item->rekomendasi ?? '-' }}</td>
                                    <td>{{ optional($item->created_at)->format('d/m/Y') ?? '-' }}</td>
                                   
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app>