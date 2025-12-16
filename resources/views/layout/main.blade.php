<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    @stack('prepend-style')
    @include('includes.styles')
    @stack('addon-style')
</head>

{{-- @vite('resources/css/app.css') --}}

<body>
    <!-- yield : buat memberi tanda bagian tersebut apa -->
    <!-- include : buat import file -->
    @include('includes.header')
    <!--Ini adalah Konten Utama  -->
    @include('includes.sidebar')


    @yield('container')


    @include('sweetalert::alert')
    @include('includes.sweet-alert')

    @include('includes.footer')
    @include('includes.scripts')





    @stack('addon-script')


    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    {{-- untuk preview gambar penghuni --}}
    <script>
        const previewImg = (target, imgPreviewPlace, labelPlace) => {
            const input = document.querySelector(target);
            if (input.files && input.files[0]) {
                // Ganti teks label dengan nama file
                $(labelPlace).text(input.files[0].name);

                // Ubah URL gambar preview
                const reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                reader.onload = (e) => $(imgPreviewPlace).attr("src", e.target.result);

                // Tampilkan gambar preview dan label
                $(imgPreviewPlace).removeClass("d-none");
            }
        }

        $("#gambarKTP").on("change", function() {
            previewImg("#gambarKTP", "#previewKTPimg", ".custom-file-label");
        });
    </script>

    {{-- Gambar priview keluhan --}}
    <script>
        $(document).ready(function() {
            $('#gambarKELUHAN').change(function() {
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewKELUHANimg').attr('src', e.target.result).removeClass('d-none');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>

    {{-- untuk preview gambar kontrakan --}}
    <script>
        const previewImgKontrakan = (target, imgPreviewPlace, labelPlace) => {
            const input = document.querySelector(target);
            if (input.files && input.files[0]) {
                // Ganti teks label dengan nama file
                $(labelPlace).text(input.files[0].name);

                // Ubah URL gambar preview
                const reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                reader.onload = (e) => $(imgPreviewPlace).attr("src", e.target.result);

                // Tampilkan gambar preview dan label
                $(imgPreviewPlace).removeClass("d-none");
            }
        }

        $("#gambarKONTRAKAN").on("change", function() {
            previewImgKontrakan("#gambarKONTRAKAN", "#previewKONTRAKANimg", ".custom-file-label");
        });
    </script>

    {{-- Script untuk preview gambar transaksi --}}
    <script>
        const previewImgTransaksi = (target, imgPreviewPlace, labelPlace) => {
            const input = document.querySelector(target);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    $(imgPreviewPlace).attr("src", e.target.result);
                    $(labelPlace).text(input.files[0].name);
                    $(imgPreviewPlace).removeClass("d-none");
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#gambarTRANSAKSI").on("change", function() {
            previewImgTransaksi("#gambarTRANSAKSI", "#previewTRANSAKSIimg", ".custom-file-label");
        });
    </script>

    {{-- <script>
    window.csrfToken = "{{ csrf_token() }}";
</script>
 --}}

</body>

</html>
