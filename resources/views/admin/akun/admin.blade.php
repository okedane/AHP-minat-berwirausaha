<x-app>
    <x-slot:title>Manajemen Admin</x-slot:title>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <!-- <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Manajemen Admin</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Admin</li>
                            </ol>
                        </div>

                    </div>
                </div> -->
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-Items-center">

                            <h4 class="card-title"></h4>

                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#myModal">Create</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th style="width:20px">No</th>

                                    <th>Name</th>
                                    <th>Email</th>
                                    <th style="text-align: center; width: 100px;" class="no-export">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td style="text-align: center; width: 100px;">
                                            <div class="d-flex justify-content-center gap-2">

                                                <!-- Gunakan div container untuk menyusun tombol secara horizontal -->
                                                <div class="d-flex align-items-center gap-2">
                                                    <button type="button"
                                                        data-bs-target="#editModal{{ $item->id }}"
                                                        data-bs-toggle="modal"
                                                        class="btn btn-soft-primary waves-effect waves-light"
                                                        style="padding: 3px 6px;">
                                                        <i class="mdi mdi-pencil font-size-16 align-middle"></i>
                                                    </button>

                                                    <!-- Tombol Delete -->
                                                    <!-- Tombol Delete dengan Modal Konfirmasi -->
                                                    <form action="{{ route('management-akun.destroy', $item->id) }}"
                                                        method="POST" id="deleteForm{{ $item->id }}">
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
                                                    <div class="modal fade" id="deleteModal{{ $item->id }}"
                                                        tabindex="-1" aria-labelledby="deleteModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel">
                                                                        Konfirmasi
                                                                        Penghapusan</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus pengguna
                                                                    <strong>{{ $item->name }}</strong>?
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
                                                    <!-- sample modal content -->
                                                    <div id="editModal{{ $item->id }}" class="modal fade"
                                                        tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
                                                        data-bs-scroll="true" data-bs-backdrop="static">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="myModalLabel">edit
                                                                        akun</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form class="needs-validation"
                                                                    action="{{ route('management-akun.update', $item->id) }}"
                                                                    method="POST" novalidate>
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="validationCustom01">Name</label>
                                                                            <input type="text" class="form-control"
                                                                                id="validationCustom01"
                                                                                placeholder="Name" name="name"
                                                                                value="{{ $item->name }}" required>
                                                                            <div class="invalid-feedback">
                                                                                Please choose a unique and valid name.
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                for="validationCustom02">Email</label>
                                                                            <input type="email" class="form-control"
                                                                                id="validationCustom02"
                                                                                placeholder="Email" name="email"
                                                                                value="{{ $item->email }}" required>
                                                                            <div class="invalid-feedback">
                                                                                Please choose a unique and valid email.
                                                                            </div>
                                                                        </div>

                                                                        <input type="hidden" name="role" value="admin">


                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="reset"
                                                                        class="btn btn-secondary">Reset</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Simpan</button>
                                                                    </div>
                                                                </form>

                                                            </div>

                                                        </div>
                                                        < </div><!-- /.modal-dialog -->
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
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card-body">
                <div>
                    <!-- sample modal content -->
                    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                        aria-hidden="true" data-bs-scroll="true" data-bs-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">tambah akun</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="{{ route('management-akun.store') }}"
                                        method="POST" novalidate>
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom01">Name</label>
                                            <input type="text" class="form-control" id="validationCustom01"
                                                placeholder="Name" name="name" required>
                                            <div class="invalid-feedback">
                                                Please choose a unique and valid name.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="validationCustom02">Email</label>
                                            <input type="email" class="form-control" id="validationCustom02"
                                                placeholder="Email" name="email" required>
                                            <div class="invalid-feedback">
                                                Please choose a unique and valid email.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="password1">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password1"
                                                    placeholder="Masukkan Password" name="password" required>

                                                <button class="btn btn-outline-secondary" type="button"
                                                    id="togglePassword1">
                                                    <i class="mdi mdi-eye-outline" id="toggleIcon1"></i>
                                                </button>
                                            </div>
                                            <div class="invalid-feedback">
                                                Password harus diisi
                                            </div>
                                        </div>

                                        <!-- Konfirmasi Password -->
                                        <div class="mb-3">
                                            <label class="form-label" for="password2">Konfirmasi Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password2"
                                                    placeholder="Masukkan Ulang Password" name="password_confirmation"
                                                    required>

                                                <button class="btn btn-outline-secondary" type="button"
                                                    id="togglePassword2">
                                                    <i class="mdi mdi-eye-outline" id="toggleIcon2"></i>
                                                </button>
                                            </div>
                                            <div class="invalid-feedback">
                                                Password harus diisi
                                            </div>
                                        </div>
                                        <!-- /.Konfirmasi Password -->
                                        <input type="hidden" name="role" id="role" value="admin">
                                        <div class="modal-footer">
                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div><!-- /.modal-dialog -->
                </div><!--./modal -->
            </div> <!-- end preview-->
        </div><!-- end card-body -->
    </div><!-- end card -->

</x-app>
