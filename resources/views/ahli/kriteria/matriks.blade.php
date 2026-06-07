<x-app>
    <x-slot:title>Matriks Perbandingan Kriteria</x-slot:title>
    <div class="page-content">
        <div class="container-fluid">
            {{-- Header --}}
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

            <form action="{{ route('kriteria.matriks.store') }}" method="POST">
                @csrf
                <div class="card">
                    {{-- Input Matriks --}}
                    <div class="card-header">
                        <h4 class="card-title mb-0">Matriks Perbandingan Kriteria</h4>
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
                                            <input type="text" class="form-control text-end bg-light" value="1" disabled>
                                            @elseif ($i < $j)
                                                <input type="number" step="0.0001" min="0.0001" required
                                                name="matriks[{{ $row->id }}][{{ $col->id }}]"
                                                class="form-control text-end"
                                                value="{{ old("matriks.$row->id.$col->id", $matriks[$row->id][$col->id] ?? '') }}">
                                                @else
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

                    {{-- Normalisasi --}}
                    @if ($lengkap && $hasil)
                    <div class="card-body border-top pt-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="mdi mdi-vector-square me-2"></i>
                            <h5 class="mb-0">Normalisasi Matriks</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover text-end align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-start">Kriteria</th>
                                        @foreach ($kriterias as $col)
                                        <th class="text-center">{{ $col->kode }}</th>
                                        @endforeach
                                        <th class="text-center">Bobot</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kriterias as $row)
                                    <tr>
                                        <th class="text-start">{{ $row->kode }}</th>
                                        @foreach ($kriterias as $col)
                                        <td>{{ number_format($hasil['normalisasi'][$row->id][$col->id], 3) }}</td>
                                        @endforeach
                                        <td class="fw-bold bg-light">{{ number_format($hasil['rataRata'][$row->id], 3) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div class="card-body border-top pt-4">
                        <div class="alert alert-info mb-0 d-flex align-items-center">
                            <i class="mdi mdi-information me-2"></i>
                            Lengkapi dan simpan matriks untuk melihat normalisasi dan konsistensi.
                        </div>
                    </div>
                    @endif

                    {{-- Konsistensi --}}
                    @if ($lengkap && $konsistensi && $konsistensi['ci'] >= 0)
                    <div class="card-body border-top">
                        <div class="d-flex align-items-center mb-3">
                            <i class="mdi mdi-check-circle me-2"></i>
                            <h5 class="mb-0">Hasil Konsistensi</h5>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="p-3 bg-light rounded">
                                    <small class="text-muted">λ Max</small>
                                    <p class="mb-0 fs-6 fw-bold">{{ number_format($konsistensi['lambda_max'], 4) }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 bg-light rounded">
                                    <small class="text-muted">CI</small>
                                    <p class="mb-0 fs-6 fw-bold">{{ number_format($konsistensi['ci'], 4) }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded @if ($konsistensi['cr'] <= 0.1) bg-success bg-opacity-10 @else bg-danger bg-opacity-10 @endif">
                                    <small class="text-muted">CR</small>
                                    <p class="mb-0 fs-6 fw-bold">{{ number_format($konsistensi['cr'], 4) }}
                                        @if ($konsistensi['cr'] <= 0.1)
                                            <span class="badge bg-success ms-2">Konsisten</span>
                                            @else
                                            <span class="badge bg-danger ms-2">Tidak Konsisten</span>
                                            @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-app>