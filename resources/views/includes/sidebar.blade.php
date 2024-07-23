<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ Route::is('homepage') ? 'active' : '' }}" href="{{ route('homepage') }}">
                <i class="bi bi-grid"></i>
                <span>DASHBOARD</span>
            </a>
        </li><!-- End Dashboard Nav -->

        {{-- Navbar User --}}
        @can('user_management_access')
            <li class="nav-item">
                <a class="nav-link {{ Route::is('dashboard.users.index') || Route::is('dashboard.roles.index') || Route::is('dashboard.permissions.index') ? 'active' : 'collapsed' }}"
                    data-bs-target="#user-management-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person"></i><span>KELOLA AKSES USER</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="user-management-nav"
                    class="nav-content collapse {{ Route::is('dashboard.users.index') || Route::is('dashboard.roles.index') || Route::is('dashboard.permissions.index') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    @can('user_access')
                        <li>
                            <a href="{{ route('dashboard.users.index') }}"
                                class="{{ Route::is('dashboard.users.index') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>DATA USER</span>
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li>
                            <a href="{{ route('dashboard.roles.index') }}"
                                class="{{ Route::is('dashboard.roles.index') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>DATA PERAN USER</span>
                            </a>
                        </li>
                    @endcan
                    @can('permission_access')
                        <li>
                            <a href="{{ route('dashboard.permissions.index') }}"
                                class="{{ Route::is('dashboard.permissions.index') ? 'active' : '' }}">
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
                <a class="nav-link {{ Route::is('dashboard.rents.index') || Route::is('dashboard.transactions.index') || Route::is('dashboard.complaints.index') ? 'active' : 'collapsed' }}"
                    data-bs-target="#data-management-nav" data-bs-toggle="collapse" href="#">
                    <i class="ri-account-box-line"></i><span>KELOLA DATA</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="data-management-nav"
                    class="nav-content collapse {{ Route::is('dashboard.rents.index') || Route::is('dashboard.transactions.index') || Route::is('dashboard.complaints.index') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    @can('kontrakan_access')
                        <li>
                            <a href="{{ route('dashboard.rents.index') }}"
                                class="{{ Route::is('dashboard.rents.index') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>KONTRAKAN</span>
                            </a>
                        </li>
                    @endcan
                    @can('transaksi_access')
                        <li>
                            <a href="{{ route('dashboard.transactions.index') }}"
                                class="{{ Route::is('dashboard.transactions.index') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>TRANSAKSI</span>
                            </a>
                        </li>
                    @endcan
                    @can('keluhan_access')
                        <li>
                            <a href="{{ route('dashboard.complaints.index') }}"
                                class="{{ Route::is('dashboard.complaints.index') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>KELUHAN</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li><!-- End KELOLA DATA Nav -->
        @endcan

        {{-- Navbar Kelola Laporan --}}
        @can('report_access')
            <li class="nav-item">
                <a class="nav-link {{ Route::is('dashboard.laporan_transaksi.index') ? 'active' : 'collapsed' }}"
                    data-bs-target="#report-management-nav" data-bs-toggle="collapse" href="#">
                    <i class="ri-account-box-line"></i><span>KELOLA LAPORAN</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="report-management-nav"
                    class="nav-content collapse {{ Route::is('dashboard.laporan_transaksi.index') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('dashboard.laporan_transaksi.index') }}"
                            class="{{ Route::is('dashboard.laporan_transaksi.index') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>LAPORAN TRANSAKSI</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End KELOLA LAPORAN Nav -->
        @endcan

        {{-- Navbar Aktivitas Log --}}
        @can('activity_log_access')
            <li class="nav-item">
                <a class="nav-link {{ Route::is('dashboard.log_activity.index') ? 'active' : 'collapsed' }}"
                    data-bs-target="#activity-log-nav" data-bs-toggle="collapse" href="#">
                    <i class="ri-account-box-line"></i><span>AKTIVITAS LOG</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="activity-log-nav"
                    class="nav-content collapse {{ Route::is('dashboard.log_activity.index') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('dashboard.log_activity.index') }}"
                            class="{{ Route::is('dashboard.log_activity.index') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>AKTIVITAS USER</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End AKTIVITAS LOG Nav -->
        @endcan
    </ul>
</aside><!-- End Sidebar -->
