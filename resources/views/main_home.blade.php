<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>KONSU APP | MAIN HOME</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets_landingpage/img/logo/Logo.png') }}" rel="icon">
    <link href="{{ asset('assets_landingpage/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets_landingpage/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_landingpage/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_landingpage/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_landingpage/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_landingpage/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_landingpage/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_landingpage/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets_landingpage/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Arsha
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center">
            <a href="#home" class="logo me-auto" style="display: flex; align-items: center;">
                <img src="{{ asset('assets_landingpage/img/logo/Logo.png') }}" alt="" class="img-fluid">
                <h1 class="logo-text" style="color:white; margin:10px">KONSU APP</h1>
            </a>


            <!-- Uncomment below if you prefer to use an image logo -->
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#home">Home</a></li>
                    <li><a class="nav-link scrollto" href="#properties">Properties</a></li>
                    <li><a class="nav-link scrollto" href="#staff">Staff</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#why">Why KONSU APP</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    <li><a class="getstarted scrollto" href="{{ route('login') }}">Have An Account ?</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <h1>Selamat Datang di Kontrakan Supadi</h1>
                    <h2> 
                        Temukan kenyamanan dan keamanan di kontrakan kami. Nikmati pengalaman tinggal yang tak
                        terlupakan dengan layanan terbaik dari kami.
                    </h2>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="{{ route('login') }}" class="btn-get-started scrollto">Pesan Sekarang</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                    <img src="{{ asset('assets_landingpage/img/hero-img.png')}}" class="img-fluid animated"
                        alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->


    <main id="main">

        <!-- ======= Properties Section ======= -->
        <section id="properties" class="portfolio">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Properties</h2>
                    <p>Selamat datang di Kontrakan Supadi! Temukan hunian nyaman dan aman dengan fasilitas lengkap yang
                        siap memenuhi kebutuhan Anda.
                        <br>
                        Jelajahi pilihan unit kontrakan kami yang terletak di lokasi strategis dan lingkungan yang
                        ramah.
                        <br>
                        Dari unit kecil yang cocok untuk mahasiswa hingga rumah yang luas untuk keluarga, kami memiliki
                        berbagai pilihan yang sesuai dengan kebutuhan Anda.
                        <br>
                        Tawaran terbatas, jadi segera pesan sebelum kehabisan! Nikmati pengalaman tinggal yang
                        menyenangkan dan nyaman di Kontrakan Supadi.
                        <br>
                        Pesan sekarang dan rasakan kenyamanan tinggal di tempat terbaik!
                    </p>
                </div>

              <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
    <li data-filter="*" class="filter-active">Semua</li>
    <li data-filter=".filter-tahunan">Tahunan</li>
    <li data-filter=".filter-bulanan">Bulanan</li>
</ul>

<div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
    @foreach ($rents as $rent)
        <div class="col-lg-4 col-md-6 portfolio-item filter-{{ strtolower($rent->tipe_kontrakan) }}">
            <div class="portfolio-img">
                <img src="{{ asset('assets/upload/gambar_kontrakan/' . $rent->gambar_kontrakan) }}" class="img-fluid" alt="">
            </div>
            <div class="portfolio-info">
                <h4>{{ $rent->nama_kontrakan }}</h4>
                <p>{{ $rent->tipe_kontrakan }}</p>
                <p>Rp {{ $rent->harga_kontrakan }}</p>
                <a href="{{ route('login') }}" class="details-link" title="More Details" style="font-size:15px; margin-top:18px">
                    <i class="bi bi-eye"></i> View More
                </a>
            </div>
        </div>
    @endforeach
</div>


            </div>
        </section><!-- End PropertiesSection -->



        <!-- ======= Team Section ======= -->
        <section id="staff" class="team section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Staff KONSU APP</h2>
                    <p>
                        Anda akan dilayani oleh staff terbaik di KONSU APP! Kami bangga memiliki tim yang berkomitmen
                        untuk menyediakan pelayanan pelanggan yang luar biasa. Dengan pengetahuan yang mendalam dan
                        keahlian di bidangnya, staff kami akan memberikan bantuan yang Anda butuhkan untuk memilih
                        produk dengan tepat, memberikan saran teknis, dan menjamin kepuasan Anda. Percayakan kebutuhan
                        komputasi Anda kepada staff berkualitas terbaik di KONSU APP dan nikmati pengalaman belanja yang
                        menyenangkan!

                    </p>
                </div>

                <div class="row">

                    <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="member d-flex align-items-start">
                            <div class="pic"><img src="{{ asset('assets_landingpage/img/staff/ceo.jpg') }}"
                                    class="img-fluid" alt=""></div>
                            <div class="member-info">
                                <h4>Supadi</h4>
                                <span>Pemilik Kontrakan</span>
                                <p>Saya berkomitmen untuk menyediakan tempat tinggal yang nyaman dan aman bagi setiap
                                    penghuni.</p>
                                <p>Dengan mendengarkan kebutuhan Anda dan terus meningkatkan layanan, kami memastikan
                                    Anda merasa seperti di rumah sendiri.</p>
                                <div class="social">
                                    <a href="https://www.instagram.com/tegar_dwi_04/"><i
                                            class="ri-instagram-fill"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="member d-flex align-items-start">
                            <div class="pic"><img src="{{ asset('assets_landingpage/img/staff/ceo.jpg') }}"
                                    class="img-fluid" alt=""></div>
                            <div class="member-info">
                                <h4>Tegar Dwi Septiadi</h4>
                                <span>Developer Web Full Stack</span>
                                <p>Saya bertanggung jawab untuk memastikan platform kami berjalan lancar dan memberikan
                                    pengalaman pengguna terbaik.</p>
                                <p>Dengan memperhatikan setiap detail dan mendengarkan masukan Anda, saya berusaha untuk
                                    terus meningkatkan fitur dan kemudahan penggunaan situs ini.</p>
                                <div class="social">
                                    <a href="https://www.instagram.com/tegar_dwi_04/"><i
                                            class="ri-instagram-fill"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </section><!-- End Team Section -->


        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Tentang Kami</h2>
                </div>

                <div class="row content">
                    <div class="col-lg-6">
                        <p style="text-align: justify;">
                            Selamat datang di Kontrakan Supadi, tempat tinggal yang mengutamakan kenyamanan dan keamanan
                            Anda. Kami adalah tim yang berdedikasi untuk menyediakan hunian berkualitas dengan fasilitas
                            lengkap di lingkungan yang bersahabat.
                        </p>
                        <p style="text-align: justify;">
                            Di Kontrakan Supadi, Anda akan menemukan berbagai pilihan unit kontrakan, mulai dari kamar
                            yang nyaman untuk mahasiswa hingga rumah luas yang cocok untuk keluarga. Setiap unit
                            dirancang untuk memberikan kenyamanan dan kemudahan bagi penghuninya.
                        </p>
                        <p style="text-align: justify;">
                            Kami percaya bahwa tempat tinggal yang nyaman dan aman haruslah mudah diakses oleh semua
                            orang. Oleh karena itu, Kontrakan Supadi menawarkan harga yang kompetitif dan berbagai
                            penawaran spesial yang menguntungkan bagi Anda. Selain itu, kami juga menyediakan pelayanan
                            pelanggan terbaik dengan tim profesional yang siap membantu menjawab pertanyaan dan
                            memberikan saran yang Anda butuhkan.
                        </p>
                    </div>

                    <div class="col-lg-6 pt-4 pt-lg-0" style="text-align: justify;">
                        <p>
                            Kontrakan Supadi berkomitmen untuk memberikan pengalaman tinggal yang aman, nyaman, dan
                            menyenangkan. Kami terus mengembangkan layanan dan fasilitas kami untuk memastikan Anda
                            mendapatkan pengalaman tinggal terbaik.
                        </p>
                        <p>
                            Kami sangat menghargai kepercayaan Anda sebagai penghuni kami. Dengan Kontrakan Supadi, kami
                            ingin menjadi mitra yang dapat diandalkan dalam menyediakan tempat tinggal yang memenuhi
                            kebutuhan Anda. Selamat datang di Kontrakan Supadi, tempat tinggal yang menghadirkan
                            kenyamanan dan keamanan di ujung jari Anda!
                        </p>
                        <a href="#why" class="btn-learn-more">Mengapa Kontrakan Supadi?</a>
                    </div>
                </div>


            </div>
        </section><!-- End About Us Section -->

        <!-- ======= Why Us Section ======= -->
        <section id="why" class="why-us section-bg">
            <div class="container-fluid" data-aos="fade-up">
                <div class="section-title">
                    <h2>WHY KONSU APP ?</h2>
                </div>
                <div class="row">

                    <div
                        class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch order-2 order-lg-1">

                        <div class="content">
                            <h3>Mengapa Memilih
                                <strong>Kontrakan Supadi?</strong>
                            </h3>
                            <p>
                                Berikut adalah alasan mengapa Kontrakan Supadi menjadi pilihan terbaik untuk tempat
                                tinggal Anda:
                            </p>
                        </div>

                        <div class="accordion-list">
                            <ul>
                                <li>
                                    <a data-bs-toggle="collapse" class="collapse"
                                        data-bs-target="#accordion-list-1"><span>01</span>Fasilitas Lengkap <i
                                            class="bx bx-chevron-down icon-show"></i><i
                                            class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-1" class="collapse show"
                                        data-bs-parent=".accordion-list">
                                        <p>
                                            Kontrakan Supadi menawarkan berbagai fasilitas lengkap untuk kenyamanan
                                            Anda, termasuk akses internet cepat, keamanan 24 jam, area parkir luas, dan
                                            fasilitas umum seperti taman dan ruang bersantai.
                                        </p>
                                    </div>
                                </li>

                                <li>
                                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2"
                                        class="collapsed"><span>02</span> Lokasi Strategis <i
                                            class="bx bx-chevron-down icon-show"></i><i
                                            class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                                        <p>
                                            Terletak di lokasi strategis yang dekat dengan pusat perbelanjaan, sekolah,
                                            dan transportasi umum, Kontrakan Supadi memudahkan akses ke berbagai tempat
                                            penting di sekitar Anda.
                                        </p>
                                    </div>
                                </li>

                                <li>
                                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3"
                                        class="collapsed"><span>03</span> Keamanan dan Kepercayaan <i
                                            class="bx bx-chevron-down icon-show"></i><i
                                            class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                                        <p>
                                            Kami menjaga keamanan dan privasi Anda dengan sistem keamanan yang canggih
                                            dan tim keamanan yang siap siaga. Kepercayaan Anda adalah prioritas kami.
                                        </p>
                                    </div>
                                </li>

                                <li>
                                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-4"
                                        class="collapsed"><span>04</span> Harga Terjangkau <i
                                            class="bx bx-chevron-down icon-show"></i><i
                                            class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-4" class="collapse" data-bs-parent=".accordion-list">
                                        <p>
                                            Kontrakan Supadi menawarkan harga sewa yang kompetitif dengan kualitas
                                            layanan yang tinggi. Kami juga menyediakan berbagai penawaran spesial untuk
                                            memberikan nilai terbaik bagi Anda.
                                        </p>
                                    </div>
                                </li>

                            </ul>
                        </div>

                    </div>


                    <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img"
                        style='background-image: url("{{ asset('assets_landingpage/img/why-us.png') }}");'
                        data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
                </div>

            </div>
        </section><!-- End Why Us Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Contact</h2>
                    <p>Hubungi Kami Apakah Anda memiliki pertanyaan, komentar, atau masukan? Kami senang mendengarnya!
                        Silakan hubungi kami melalui salah satu metode di bawah ini, dan tim kami akan dengan senang
                        hati membantu Anda.</p>
                </div>

                <div class="row">

                    <div class="col-lg-5 d-flex align-items-stretch">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Location:</h4>
                                <p>Harapan Baru 1, Gang. Hj. Namung
                                    <br>
                                    PROPERTIES KONSU APP (Kontrakan Supadi Application)
                                    <br>
                                    Kp. Rawa Bebek RT.06, RW.08, No.91, Kec. Bekasi Barat, Kota Bekasi, Jawa Barat
                                    173179
                                </p>
                            </div>

                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>Email:</h4>
                                <p>kontrakanSupadi@gmail.com</p>
                            </div>

                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>Call:</h4>
                                <p>+62 813-1745-3587 (Supadi)</p>
                                <p>+62 822-9877-6320 (Tegar Dwi Septiadi)</p>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3906.966620357398!2d106.99057576638707!3d-6.245458740548811!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698c37f29327b9%3A0xc9c318795dbb5a8!2sBEKASI%20CYBER%20PARK%20MALL!5e0!3m2!1sen!2sid!4v1684936096119!5m2!1sen!2sid"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>


                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="container footer-bottom clearfix">
            <div class="copyright">
                &copy;2024 Copyright <strong><span>KONSU APP Web Application</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets_landingpage/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets_landingpage/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets_landingpage/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets_landingpage/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets_landingpage/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets_landingpage/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('assets_landingpage/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets_landingpage/js/main.js') }}"></script>


    @include('sweetalert::alert')

</body>

</html>
