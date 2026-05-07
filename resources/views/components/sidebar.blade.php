<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu </li>

                <li>
                    <a href="{{route('admin.dashboard.index')}}" class="waves-effect">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('kriteria.index')}}" class="waves-effect">
                        <i data-feather="grid"></i>
                        <span data-key="t-dashboard">Kriteria</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('pertanyaan.index')}}" class="waves-effect">
                        <i data-feather="help-circle"></i>
                        <span data-key="t-dashboard">Pertanyaan</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('rekap.index')}}" class="waves-effect">
                        <i data-feather="pie-chart"></i>
                        <span data-key="t-dashboard">Rekap Penilaian</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-icons">Management Akun</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="">User</a></li>
                        <li><a href="">Admin</a></li>
                    </ul>
                </li>

            </ul>


        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
