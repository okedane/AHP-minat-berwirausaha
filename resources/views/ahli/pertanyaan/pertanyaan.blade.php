<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Daftar Pertanyaan</h4>
                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#myModal">Tambah Pertanyaan</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Kriteria -->
            <div class="row mb-3">
                <div class="col-12">
                    <form method="GET" action="{{ route('pertanyaan.index') }}">
                        <select class="form-select" name="kriteria_id" onchange="this.form.submit()">
                            <option value="">Semua Kriteria</option>
                            @foreach ($kriterias as $kriteria)
                            <option value="{{ $kriteria->id }}"
                                {{ request('kriteria_id') == $kriteria->id ? 'selected' : '' }}>
                                {{ $kriteria->nama }}
                            </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th style="width:20px">No</th>
                            <th>Pertanyaan</th>
                            <th>Kriteria</th>
                            <th style="text-align: center; width: 100px;" class="no-export">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pertanyaans as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->pertanyaan }}</td>
                            <td>{{ $item->kriteria->nama }}</td>
                            <td style="text-align: center; width: 100px;">
                                <div class="d-flex justify-content-center gap-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="#" data-bs-target="#editModal{{ $item->id }}"
                                            data-bs-toggle="modal"
                                            class="btn btn-sm btn-info"
                                            title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <button type="button"
                                            class="btn btn-sm btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $item->id }}"
                                            title="Hapus">
                                            <i class="mdi mdi-trash-can"></i>
                                        </button>

                                        <form action="{{ route('pertanyaan.delete', $item->id) }}" method="POST"
                                            id="deleteForm{{ $item->id }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <!-- Modal Konfirmasi Hapus -->
                                        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">
                                                            Konfirmasi
                                                            Penghapusan</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus pertanyaan
                                                        <strong>{{ $item->pertanyaan }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="document.getElementById('deleteForm{{ $item->id }}').submit();">Hapus</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <div>
                                        <!-- Edit Modal -->
                                        <div id="editModal{{ $item->id }}" class="modal fade" tabindex="-1"
                                            aria-labelledby="editModalLabel" aria-hidden="true"
                                            data-bs-scroll="true" data-bs-backdrop="static">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit
                                                            Data pertanyaan</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form class="needs-validation"
                                                        action="{{ route('pertanyaan.update', $item->id) }}"
                                                        method="POST" novalidate>
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">

                                                            <!-- Nama -->
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="nama">Pertanyaan</label>
                                                                <input type="text" class="form-control"
                                                                    id="pertanyaan" name="pertanyaan"
                                                                    value="{{ $item->pertanyaan }}" required>
                                                                <div class="invalid-feedback">Pertanyaan harus
                                                                    diisi.</div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="example-select" class="form-label">
                                                                    Pilih Kriteria
                                                                </label>
                                                                <select class="form-select" id="example-select" name="kriteria_id">
                                                                    @foreach ($kriterias as $k)
                                                                    <option value="{{ $k->id }}"
                                                                        {{ $item->kriteria_id == $k->id ? 'selected' : '' }}>
                                                                        {{ $k->nama }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                class="btn btn-secondary waves-effect"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                            <button type="submit"
                                                                class="btn btn-primary waves-effect waves-light">Simpan
                                                                Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div><!-- /.modal -->
                                    </div> <!-- end preview-->
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- ... rest of your modals ... -->
</x-app>