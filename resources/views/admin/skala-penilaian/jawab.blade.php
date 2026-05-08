<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Skala Penilaian : {{ $pertanyaan->pertanyaan }} ?</h4>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Daftar Skala Penilaian</h4>
                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#myModal">Tambah Skala Penilaian</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th style="width:20px">No</th>
                            <th>Label</th>
                            <th>Skor</th>
                            
                            <th style="text-align: center; width: 100px;" class="no-export">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($skalaPenilaians as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->label }}</td>
                                <td>{{ $item->skor }}</td>
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

                                           

                                            <form action="{{ route('skala-penilaian.delete', $item->id) }}" method="POST"
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
                                                            action="{{ route('skala-penilaian.update', $item->id) }}"
                                                            method="POST" novalidate>
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">

                                                                <!-- label -->
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="label">Label</label>
                                                                    <input type="text" class="form-control"
                                                                        id="label" name="label"
                                                                        value="{{ $item->label }}" required>
                                                                    <div class="invalid-feedback">Label harus
                                                                        diisi.</div>
                                                                </div>

                                                                <!-- score -->
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="skor">Skor</label>
                                                                    <input type="text" class="form-control"
                                                                        id="skor" name="skor"
                                                                        value="{{ $item->skor }}" required>
                                                                    <div class="invalid-feedback">Skor harus
                                                                        diisi.</div>
                                                                </div>

                                                                <input type="hidden" name="pertanyaan_id"
                                                                    value="{{ $item->pertanyaan_id }}"> 
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
                                    <form class="needs-validation" action="{{ route('skala-penilaian.store') }}"
                                        method="POST" novalidate>
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom01">Label</label>
                                            <input type="text" class="form-control" id="validationCustom01"
                                                placeholder="Masukkan label" name="label" required>
                                            <div class="invalid-feedback">
                                                label harus diisi
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom01">Skor</label>
                                            <input type="text" class="form-control" id="validationCustom01"
                                                placeholder="Masukkan skor" name="skor" required>
                                            <div class="invalid-feedback">
                                                skor harus diisi
                                            </div>
                                        </div>
                                        <input type="hidden" name="pertanyaan_id" value="{{ $pertanyaan->id }}">
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
