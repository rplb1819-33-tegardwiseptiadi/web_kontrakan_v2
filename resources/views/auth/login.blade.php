<!DOCTYPE html>
<html lang="en">

<head>
    <title>LOGIN ACCOUNT</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('assets_bootstrap_login/images/icons/icon.png') }} " />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets_bootstrap_login/vendor/bootstrap/css/bootstrap.min.css') }} ">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets_bootstrap_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }} ">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets_bootstrap_login/fonts/iconic/css/material-design-iconic-font.min.css') }} ">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_bootstrap_login/vendor/animate/animate.css') }} ">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets_bootstrap_login/vendor/css-hamburgers/hamburgers.min.css') }} ">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets_bootstrap_login/vendor/animsition/css/animsition.min.css') }} ">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_bootstrap_login/vendor/select2/select2.min.css') }} ">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets_bootstrap_login/vendor/daterangepicker/daterangepicker.css') }} ">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_bootstrap_login/css/util.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_bootstrap_login/css/main.css') }} ">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100"
            style="background-image: url('{{ asset('assets_bootstrap_login/images/background/bg-01.jpg') }}');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form class="login100-form validate-form" method="POST" action="{{ route('login') }} ">
                    @csrf
                    <img src="{{ asset('assets/img/icon_logo/login.png') }}" alt="Gambar Anda"
                        style="display: block; margin: 0 auto; width:250px; height 500px;">
                    <span class="login100-form-title p-b-10" style="font-family: Lucida Handwriting; margin:20px">
                        LOGIN
                    </span>
                    <div class="wrap-input100 validate-input m-b-20" data-validate="Username Wajib Diisi !!!">
                        <span class="label-input100">Email</span>
                        <input class="input100 @error('email')  is-invalid  @enderror" type="email" name="email"
                            placeholder="Isi Email Anda">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                        {{-- {{$errors}} --}}
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password Wajib Diisi !!!">
                        <span class="label-input100">Password</span>
                        <input class="input100  @error('password')  is-invalid  @enderror" type="password"
                            name="password" placeholder="Isi Password Anda">
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="text-right p-t-12 p-b-15">
                        <a href="{{ route('register') }}">
                            Belum Punya Akun? Yuk Register Dulu
                        </a>
                    </div>

                   
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>

                    <div class="text-right p-t-17 p-b-10">
                        <a href="{{ route('main-home') }}">
                            Kembali Ke Halaman Utama 
                        </a>
                    </div>
                    

                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="{{ asset('assets_bootstrap_login/vendor/jquery/jquery-3.2.1.min.js') }} "></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets_bootstrap_login/vendor/animsition/js/animsition.min.js') }} "></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets_bootstrap_login/vendor/bootstrap/js/popper.js') }} "></script>
    <script src="{{ asset('assets_bootstrap_login/vendor/bootstrap/js/bootstrap.min.js') }} "></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets_bootstrap_login/vendor/select2/select2.min.js') }} "></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets_bootstrap_login/vendor/daterangepicker/moment.min.js') }} "></script>
    <script src="{{ asset('assets_bootstrap_login/vendor/daterangepicker/daterangepicker.js') }} "></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets_bootstrap_login/vendor/countdowntime/countdowntime.js') }} "></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets_bootstrap_login/js/main.js') }} "></script>
  
    @include('sweetalert::alert') 
 
</body>

</html>
