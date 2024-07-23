<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register Account</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('assets_bootstrap_login/images/icons/favicon.ico') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets_bootstrap_login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets_bootstrap_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets_bootstrap_login/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_bootstrap_login/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets_bootstrap_login/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets_bootstrap_login/vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_bootstrap_login/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets_bootstrap_login/vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_bootstrap_login/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_bootstrap_login/css/main.css') }}">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100"
            style="background-image: url('{{ asset('assets_bootstrap_login/images/background/bg-01.jpg') }}');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form class="login100-form validate-form" method="POST" action="{{ route('register') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <img src="{{ asset('assets_bootstrap_login/images/logo/Logo.png') }}" alt="Gambar Anda"
                        style="display: block; margin: 0 auto; width:250px; height:auto;">
                    <span class="login100-form-title p-b-10" style="font-family: 'Lucida Handwriting'; margin:20px">
                        REGISTER
                    </span>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Name is required">
                        <span class="label-input100">Nama Pengguna</span>
                        <input class="input100 @error('name') is-invalid @enderror" type="text" name="name"
                            placeholder="Type your name" value="{{ old('name') }}">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="wrap-input100 validate-input m-b-23" data-validate="Email is required">
                        <span class="label-input100">Email</span>
                        <input class="input100 @error('email') is-invalid @enderror" type="email" name="email"
                            placeholder="Type your email" value="{{ old('email') }}">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="wrap-input100 validate-input m-b-23">
                        <span class="label-input100">Umur</span>
                        <input class="input100 @error('umur') is-invalid @enderror" type="number" name="umur"
                            placeholder="Type your age" value="{{ old('umur') }}">
                        <span class="focus-input100" data-symbol="&#xf1c4;"></span>
                        @error('umur')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="wrap-input100 validate-input m-b-23" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100 @error('password') is-invalid @enderror" type="password" name="password"
                            placeholder="Type your password">
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="wrap-input100 validate-input m-b-23" data-validate="Konfirmasi Password is required">
                        <span class="label-input100">Konfirmasi Password</span>
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                        <input class="input100" type="password" name="password_confirmation"
                            placeholder="Confirm your password" required>
                    </div>


                    <div class="wrap-input100 validate-input m-b-23" data-validate="Jenis Kelamin is required">
                        <span class="label-input100">Jenis Kelamin</span>
                        <div class="row" style="margin-left: 15px;"> <!-- Adjust margin-left value as needed -->
                            <div class="col-lg-10">
                                <div class="form-check">
                                    <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                        type="radio" name="jenis_kelamin" id="gridRadios1" value="Pria"
                                        {{ old('jenis_kelamin') == 'Pria' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="gridRadios1">
                                        Pria
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                        type="radio" name="jenis_kelamin" id="gridRadios2" value="Wanita"
                                        {{ old('jenis_kelamin') == 'Wanita' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="gridRadios2">
                                        Wanita
                                    </label>
                                </div>
                                @error('jenis_kelamin')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="wrap-input100 validate-input m-b-23" data-validate="Status Penghuni is required">
                        <span class="label-input100">Status Penghuni</span>
                        <select class="input100 @error('status_penghuni') is-invalid @enderror" name="status_penghuni"
                            required>
                            <option value="">Pilih Status Penghuni</option>
                            <option value="Sudah Menikah"
                                {{ old('status_penghuni') == 'Sudah Menikah' ? 'selected' : '' }}>Sudah Menikah
                            </option>
                            <option value="Belum Menikah"
                                {{ old('status_penghuni') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah
                            </option>
                        </select>
                        @error('status_penghuni')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Gambar Profile is required">
                        <span class="label-input100">Gambar Profil</span>
                        <div class="mt-2">
                            <img id="previewPROFILEimg" src="#" alt="Preview" class="img-fluid d-none">
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('gambar_profil') is-invalid @enderror"
                                id="gambarPROFILE" name="gambar_profil" accept="image/*" required>
                            <label class="custom-file-label" for="gambarPROFILE">Pilih gambar...</label>
                        </div>
                        @error('gambar_profil')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="wrap-input100 validate-input m-b-23" data-validate="Gambar KTP is required">
                        <span class="label-input100">Gambar KTP</span>
                        <div class="mt-2">
                            <img id="previewKTPimg" src="#" alt="Preview" class="img-fluid d-none">
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('gambar_ktp') is-invalid @enderror"
                                id="gambarKTP" name="gambar_ktp" accept="image/*" required>
                            <label class="custom-file-label" for="gambarKTP">Pilih gambar...</label>
                        </div>
                        @error('gambar_ktp')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <input type="hidden" name="role_id" value="2">
                    <div class="text-right p-t-8 p-b-31">
                        <a href="{{ route('login') }}">
                            Sudah Punya Akun? Yuk Login Dulu
                        </a>
                    </div>
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Register
                            </button>
                        </div>
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

    {{-- untuk preview gambar profile --}}
    <script>
        const previewImg = (target, imgPreviewPlace, labelPlace) => {
            const input = document.querySelector(target);
            if (input.files && input.files[0]) {
                // Ganti teks label dengan nama file
                document.querySelector(labelPlace).textContent = input.files[0].name;

                // Ubah URL gambar preview
                const reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                reader.onload = (e) => document.querySelector(imgPreviewPlace).src = e.target.result;

                // Tampilkan gambar preview dan label
                document.querySelector(imgPreviewPlace).classList.remove("d-none");
            }
        }

        $("#gambarPROFILE").on("change", function() {
            previewImg("#gambarPROFILE", "#previewPROFILEimg", "label[for='gambarPROFILE']");
        });

        $("#gambarKTP").on("change", function() {
            previewImg("#gambarKTP", "#previewKTPimg", "label[for='gambarKTP']");
        });
    </script>
</body>
</html>
