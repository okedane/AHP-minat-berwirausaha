<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"></h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Pertanyaan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
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
            <div class="card-body">
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
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

                                        <!-- Gunakan div container untuk menyusun tombol secara horizontal -->
                                        <div class="d-flex align-items-center gap-2">
                                            <button type="button" data-bs-target="#editModal{{ $item->id }}"
                                                data-bs-toggle="modal"
                                                class="btn btn-soft-primary waves-effect waves-light"
                                                style="padding: 3px 6px;">
                                                <i class="mdi mdi-pencil font-size-16 align-middle"></i>
                                            </button>

                                            <a href="{{ route('skala-penilaian.index', $item->id) }}"
                                                class="btn btn-soft-primary waves-effect waves-light"
                                                style="padding: 3px 6px;">
                                                <i class="mdi mdi-eye font-size-16 align-middle"></i>
                                            </a>

                                           

                                            <form action="{{ route('pertanyaan.delete', $item->id) }}" method="POST"
                                                id="deleteForm{{ $item->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" style="padding: 3px 6px;"
                                                    class="btn btn-soft-danger waves-effect waves-light"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $item->id }}">
                                                    <i class="mdi mdi-trash-can font-size-16 align-middle"></i>
                                                </button>
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
                                                                        @foreach ($kriterias as $item)
                                                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
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
        <!-- end cardaa -->
    </div> <!-- end col -->
    {{-- </div>
    </div> --}}
    <div class="row">
        <div class="col-lg-6">
            <div class="card-body">
                <div>
                    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                        aria-hidden="true" data-bs-scroll="true" data-bs-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Tambah Pertanyaan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="{{ route('pertanyaan.store') }}"
                                        method="POST" novalidate>
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom01">Pertanyaan</label>
                                            <input type="text" class="form-control" id="validationCustom01"
                                                placeholder="Masukkan Pertanyaan" name="pertanyaan" required>
                                            <div class="invalid-feedback">
                                                Pertanyaan harus diisi
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-select" class="form-label">
                                                Pilih Kriteria
                                            </label>
                                            <select class="form-select" id="example-select" name="kriteria_id">
                                                @foreach ($kriterias as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end preview-->
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>


</x-app>
