{{-- kode sweetalert tombol delete  user --}}
    <script>
        function confirmDelete(button) {
            var form = button.closest('form');
            var name = button.getAttribute('data-name');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                html: `<p style="font-size: 14px;">Anda akan menghapus data peran user <br> bernama <strong>${name}</strong>.</p>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    title: 'swal-title-custom',
                    htmlContainer: 'swal-html-custom'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>


{{-- Konfirmasi tambah data --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Preview image for KTP
        let gambarKTPInput = document.getElementById('gambarKTP');
        let previewKTPimg = document.getElementById('previewKTPimg');

        if (gambarKTPInput) {
            gambarKTPInput.addEventListener('change', function() {
                let file = gambarKTPInput.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        previewKTPimg.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        }

        // Preview image for Profile
        let gambarPROFILEInput = document.getElementById('gambarPROFILE');
        let previewPROFILEimg = document.getElementById('previewPROFILEimg');

        if (gambarPROFILEInput) {
            gambarPROFILEInput.addEventListener('change', function() {
                let file = gambarPROFILEInput.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        previewPROFILEimg.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        }


        let formTambahUser = document.getElementById('formTambahUser');

        formTambahUser.addEventListener('submit', function(event) {
            // Ambil nilai dari setiap input
            let name = formTambahUser.querySelector('input[name="name"]').value.trim();
            let email = formTambahUser.querySelector('input[name="email"]').value.trim();
            let password = formTambahUser.querySelector('input[name="password"]').value.trim();
            let umur = formTambahUser.querySelector('input[name="umur"]').value.trim();
            let jenis_kelamin = formTambahUser.querySelector('input[name="jenis_kelamin"]:checked');
            let status_penghuni = formTambahUser.querySelector('select[name="status_penghuni"]').value;
            let gambar_ktp = formTambahUser.querySelector('input[name="gambar_ktp"]').files.length;
            let gambar_profil = formTambahUser.querySelector('input[name="gambar_profil"]').files
                .length;
            let role_id = formTambahUser.querySelector('select[name="role_id"]').value;

            // Cek apakah semua input telah diisi
            if (name !== "" && email !== "" && password !== "" && umur !== "" && jenis_kelamin &&
                status_penghuni !== "" && gambar_ktp && gambar_profil > 0 && role_id !== "") {
                event.preventDefault(); // Mencegah pengiriman formulir secara otomatis

                // Tampilkan konfirmasi
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    html: '<p style="font-size: 14px;">Anda akan menambah data user baru <br> yang bernama <strong>' +
                        name + ' </strong></p>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, tambahkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        formTambahUser.submit(); // Kirim formulir jika pengguna menekan "Ya"
                    }
                });
            }
            
        });
    });
</script>

{{-- Konfirmasi edit data --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let formEditUser = document.getElementById('formEditUser');

        formEditUser.addEventListener('submit', function(event) {
            // Ambil nilai dari setiap input
            let name = formEditUser.querySelector('input[name="name"]').value.trim();
            let email = formEditUser.querySelector('input[name="email"]').value.trim();
            let umur = formEditUser.querySelector('input[name="umur"]').value.trim();
            let jenis_kelamin = formEditUser.querySelector('input[name="jenis_kelamin"]:checked');
            let status_penghuni = formEditUser.querySelector('select[name="status_penghuni"]').value;
            let role_id = formEditUser.querySelector('select[name="role_id"]').value;

            // Cek apakah semua input yang wajib diisi sudah diisi
            if (name !== "" && email !== "" && umur !== "" && jenis_kelamin && status_penghuni !== "" &&
                role_id !== "") {
                event.preventDefault(); // Mencegah pengiriman formulir secara otomatis

                // Tampilkan konfirmasi
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    html: '<p style="font-size: 14px;">Anda akan mengupdate data user <br> yang bernama <strong>' +
                        name + ' </strong></p>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, update!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        formEditUser.submit(); // Kirim formulir jika pengguna menekan "Ya"
                    }
                });
            }
        });
    });
</script>



{{-- style untuk notif alert --}}
<style>
    .swal-title-custom {
        font-size: 18px;
    }

    .swal-html-custom {
        font-size: 14px;
    }
</style>
