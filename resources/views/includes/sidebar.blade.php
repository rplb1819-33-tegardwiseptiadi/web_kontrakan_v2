<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Route::is('homepage') ? 'active' : '' }}"
                href="{{ route('homepage') }}">
                <i class="bi bi-grid"></i>
                <span>DASHBOARD</span>
            </a>
        </li><!-- End Dashboard Nav -->

        {{-- Navbar User --}}
        @can('user_management_access')
            <li class="nav-item">
                <a class="nav-link collapsed {{ Route::is('dashboard.users.index') ? 'active' : '' }}"
                    data-bs-target="#forms-nav" data-bs-toggle="collapse" href="">
                    <i class="bi bi-person"></i><span>KELOLA AKSES USER</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @can('user_access')
                        <li>
                            <a href="{{ route('dashboard.users.index') }}">
                                <i class="bi bi-circle"></i><span>DATA USER</span>
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li>
                            <a href="{{ route('dashboard.roles.index') }}">
                                <i class="bi bi-circle"></i><span>DATA PERAN USER</span>
                            </a>
                        </li>
                    @endcan
                    @can('permission_access')
                        <li>
                            <a href="{{ route('dashboard.permissions.index') }}">
                                <i class="bi bi-circle"></i><span>DATA AKSES USER</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li><!-- End Forms Nav -->
        @endcan

        {{-- Navbar Kelola Data --}}
        @can('data_management_access')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#data-nav" data-bs-toggle="collapse" href="#">
                    <i class="ri-account-box-line"></i><span>KELOLA DATA</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="data-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    <li>
                        {{-- @can('penghuni_access')
                            <a href="{{ route('dashboard.occupants.index') }}">
                                <i class="bi bi-circle"></i><span>PENGHUNI</span>
                            </a>
                        @endcan --}}
                        @can('kontrakan_access')
                            <a href="{{ route('dashboard.rents.index') }}">
                                <i class="bi bi-circle"></i><span>KONTRAKAN</span>
                            </a>
                        @endcan
                        @can('transaksi_access')
                            <a href="{{ route('dashboard.transactions.index') }}">
                                <i class="bi bi-circle"></i><span>TRANSAKSI</span>
                            </a>
                        @endcan
                    
                        @can('keluhan_access')
                            <a href="{{ route('dashboard.complaints.index') }}">
                                <i class="bi bi-circle"></i><span>KELUHAN</span>
                            </a>
                        @endcan
                    </li>
                </ul>
            </li><!-- End KELOLA DATA Nav -->
        @endcan

        {{-- start laporan --}}
        @can('report_access')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="ri-account-box-line"></i><span>KELOLA LAPORAN</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                    <li>
                        <a href="{{ route('dashboard.laporan_transaksi.index') }}">
                            <i class="bi bi-circle"></i><span>LAPORAN TRANSAKSI</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End KELOLA LAPORAN Nav -->
        @endcan

        @can('activity_log_access')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#aktivitas-nav" data-bs-toggle="collapse" href="#">
                    <i class="ri-account-box-line"></i><span>AKTIVITAS LOG</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="aktivitas-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li> 
                        <a href="{{ route('dashboard.log_activity.index') }}">
                            <i class="bi bi-circle"></i><span>AKTIVITAS USER</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End KELOLA LAPORAN Nav -->
        @endcan
    </ul>


</aside><!-- End Sidebar-->
