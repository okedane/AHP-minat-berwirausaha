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
                                <!-- <th style="width:140px;">Nilai Akhir</th>
                                <th>Kategori</th>
                                <th>Rekomendasi Utama</th> -->
                                <th style="width:120px;" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rekaps as $index => $rekap)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $rekap['user']->name ?? '-' }}</td>
                                    <!-- <td>
                                        @if(!empty($rekap['nilai_akhir']))
                                            {{ number_format($rekap['nilai_akhir'], 3) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $rekap['kategoriInfo']['nama_kategori'] ?? '-' }}</td>
                                    <td>{{ $rekap['usahasRekomendasi'][0]['nama_usaha'] ?? '-' }}</td> -->
                                    <td class="text-center">
                                        <a href="{{ route('rekap.show', $rekap['user']->id) }}" class="btn btn-soft-primary btn-sm">
                                            <i class="mdi mdi-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Data rekap belum tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app>
