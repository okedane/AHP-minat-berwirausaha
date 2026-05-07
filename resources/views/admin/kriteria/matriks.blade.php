<x-app>
    <x-slot:title>Matriks Perbandingan Kriteria</x-slot:title>
    <div class="page-content">
        <div class="container-fluid">

            <div class="row mb-3">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Matriks Perbandingan Kriteria</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('kriteria.index') }}">Kriteria</a></li>
                                <li class="breadcrumb-item active">Matriks</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('kriteria.matriks.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Matriks Perbandingan Kriteria</h4>
                        {{-- <a href="{{ route('kriteria.index') }}" class="btn btn-outline-secondary btn-sm">← Kembali</a> --}}
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-bordered text-end align-middle">
                                <thead class="text-center">
                                    <tr>
                                        <th>Kriteria</th>
                                        @foreach ($kriterias as $col)
                                            <th>{{ $col->kode }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kriterias as $i => $row)
                                        <tr>
                                            <th class="text-start">{{ $row->kode }}</th>
                                            @foreach ($kriterias as $j => $col)
                                                <td>
                                                    @if ($row->id === $col->id)
                                                        <input type="text" class="form-control text-end bg-light"
                                                            value="1" disabled>
                                                    @elseif ($i < $j)
                                                        {{-- Input manual --}}
                                                        <input type="number" step="0.0001" min="0.0001" required
                                                            name="matriks[{{ $row->id }}][{{ $col->id }}]"
                                                            class="form-control text-end"
                                                            value="{{ old("matriks.$row->id.$col->id", $matriks[$row->id][$col->id] ?? '') }}">
                                                    @else
                                                        {{-- Ambil nilai kebalikan dari database --}}
                                                        <input type="text" class="form-control text-end bg-light"
                                                            value="{{ $matriks[$row->id][$col->id] ?? '-' }}" disabled>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>


                            </table>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-outline-success mt-2 btn-sm">
                                <i class="mdi mdi-content-save me-1"></i> Simpan Matriks
                            </button>
                        </div>
                    </div>

                    {{-- Tabel normalisasi --}}
                    @if ($lengkap && $hasil)
                        <h5 class="mt-4">Normalisasi Matriks</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered text-end align-middle">
                                <thead class="text-center">
                                    <tr>
                                        <th>Kriteria</th>
                                        @foreach ($kriterias as $col)
                                            <th>{{ $col->kode }}</th>
                                        @endforeach
                                        <th>Bobot</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kriterias as $row)
                                        <tr>
                                            <th class="text-start">{{ $row->kode }}</th>
                                            @foreach ($kriterias as $col)
                                                <td>{{ number_format($hasil['normalisasi'][$row->id][$col->id], 3) }}</td>
                                            @endforeach
                                            <td class="fw-bold">{{ number_format($hasil['rataRata'][$row->id], 3) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-warning mt-4">
                            ⚠️ Silakan lengkapi dan simpan matriks perbandingan terlebih dahulu
                            untuk melihat hasil normalisasi dan konsistensi.
                        </div>
                    @endif
                    @if ($lengkap && $konsistensi && $konsistensi['ci'] >= 0)
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="mb-3">Hasil Konsistensi</h5>
                                <ul>
                                    <li>λ Max: <strong>{{ number_format($konsistensi['lambda_max'], 4) }}</strong></li>
                                    <li>CI (Consistency Index): <strong>{{ number_format($konsistensi['ci'], 4) }}</strong>
                                    </li>
                                    <li>CR (Consistency Ratio): <strong>{{ number_format($konsistensi['cr'], 4) }}</strong>
                                        @if ($konsistensi['cr'] >= 0 && $konsistensi['cr'] <= 0.1)
                                            <span class="text-success"> (Konsisten ✅)</span>
                                        @else
                                            <span class="text-danger"> (Tidak Konsisten ❌)</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif

                </div>
            </form>
        </div>
    </div>
</x-app>
