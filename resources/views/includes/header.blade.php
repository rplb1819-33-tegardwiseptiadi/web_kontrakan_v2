<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="{{ asset('assets/img/icon_logo/side_nav.png') }}" alt="">
            <span class="d-none d-lg-block">KONSU</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
        <li class="nav-item d-block d-lg" style="margin:30px;">
            <span id="currentDateTime">
                {{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('dddd, D MMMM YYYY') }},
                {{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->locale('id')->format('H:i') }}
            </span>

            <script>
                function updateDateTime() {
                    var now = new Date();
                    var day = now.toLocaleDateString('id-ID', {
                        weekday: 'long'
                    });
                    var date = now.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    });
                    var time = now.toLocaleTimeString('id-ID', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    var currentDateTime = day + ', ' + date + ', ' + time;
                    document.getElementById('currentDateTime').textContent = currentDateTime;
                }

                setInterval(updateDateTime, 1000); // Memperbarui setiap 1 detik
            </script>
        </li><!-- End Search Icon-->
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">


            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                       <img src="{{ asset('assets/upload/gambar_profil/'. auth()->user()->gambar_profil)  }}" alt="Profile"
                            class="rounded-circle">
                       <span class="d-none d-md-block dropdown-toggle ps-2">Halo {{ auth()->user()->name }}
                    </span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ auth()->user()->name }} </h6>
                        <span>{{ auth()->user()->role->name }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <button class="dropdown-item d-flex align-items-center" type="button" id="logoutBtn">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </button>
                        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
