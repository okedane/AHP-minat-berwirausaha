<x-app>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Klasifikasi : {{ $klasifikasiPenilaian->nama_kategori }} ?</h4>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Daftar Usaha</h4>
                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#myModal">Tambah Usaha</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th style="width:20px">No</th>
                            <th>Nama Usaha</th>
                            
                            
                            <th style="text-align: center; width: 100px;" class="no-export">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usaha as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_usaha }}</td>
                                <td>{{ $item->deskripsi }}</td>
                               
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

                                           

                                            <form action="{{ route('usaha.destroy', $item->id) }}" method="POST"
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
                                                            Apakah Anda yakin ingin menghapus usaha
                                                            <strong>{{ $item->nama_usaha }}</strong>?
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
                                                                Data Usaha</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form class="needs-validation"
                                                            action="{{ route('usaha.update', $item->id) }}"
                                                            method="POST" novalidate>
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">

                                                                <!-- label -->
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="nama_usaha">Nama Usaha</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nama_usaha" name="nama_usaha"
                                                                        value="{{ $item->nama_usaha }}" required>
                                                                    <div class="invalid-feedback">Nama Usaha harus
                                                                        diisi.</div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label" for="deskripsi">Deskripsi Usaha</label>
                                                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $item->deskripsi }}</textarea>
                                                                    <div class="invalid-feedback">Deskripsi Usaha harus diisi.</div>
                                                                </div>

                                                                <input type="hidden" name="klasifikasi_penilaian_id"
                                                                    value="{{ $item->klasifikasi_penilaian_id }}"> 
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
   
    <div class="row">
        <div class="col-lg-6">
            <div class="card-body">
                <div>
                    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                        aria-hidden="true" data-bs-scroll="true" data-bs-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Tambah Usaha</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="{{ route('usaha.store') }}"
                                        method="POST" novalidate>
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom01">Nama Usaha</label>
                                            <input type="text" class="form-control" id="validationCustom01"
                                                placeholder="Masukkan nama usaha" name="nama_usaha" required>
                                            <div class="invalid-feedback">
                                                nama usaha harus diisi
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="deskripsi">Deskripsi Usaha</label>
                                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                                            <div class="invalid-feedback">
                                                deskripsi usaha harus diisi
                                            </div>
                                        </div>

                                        <input type="hidden" name="klasifikasi_penilaian_id" value="{{ $klasifikasiPenilaian->id }}">
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
