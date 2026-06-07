<x-app>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">kriteria</span>
                                    <h4 class="mb-3">
                                        <span class="counter-value" data-target="{{ $total_kriteria }}"></span>
                                    </h4>
                                </div>
                                <div class="col-6">
                                    <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">pertanyaan</span>
                                    <h4 class="mb-3">
                                        <span class="counter-value" data-target="{{ $total_pertanyaan }}"></span>
                                    </h4>
                                </div>

                                <div class="col-6">
                                    <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->


                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Klasifikasi</span>
                                    <h4 class="mb-3">
                                        <span class="counter-value" data-target="{{ $klasifikasi }}"></span>
                                    </h4>
                                </div>
                                <div class="col-6">
                                    <div id="mini-chart2" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Mahasiswa</span>
                                    <h4 class="mb-3">
                                        <span class="counter-value" data-target="{{ $total_user }}"></span>
                                    </h4>
                                </div>
                                <div class="col-6">
                                    <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row-->

        </div>
        <!-- container-fluid -->
    </div>
</x-app>

