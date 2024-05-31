{{-- kode konfirmasi tambah data --}}
{{-- ketika semua value form sudah diisi  --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let form = document.getElementById('formTambahPenghuni');

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir secara otomatis
            
            // Validasi formulir
            let namaPenghuni = form.querySelector('input[name="nama_penghuni"]').value.trim();
            let umurPenghuni = form.querySelector('input[name="umur_penghuni"]').value.trim();
            let jenisKelaminPria = form.querySelector('input[name="jenis_kelamin"][value="Pria"]').checked;
            let jenisKelaminWanita = form.querySelector('input[name="jenis_kelamin"][value="Wanita"]').checked;
            let statusPenghuniSudahMenikah = form.querySelector('input[name="status_penghuni"][value="Sudah Menikah"]').checked;
            let statusPenghuniBelumMenikah = form.querySelector('input[name="status_penghuni"][value="Belum Menikah"]').checked;
            let gambarKTP = form.querySelector('input[name="gambar_ktp"]').files.length;

            // Cek apakah semua input diisi dan jenis kelamin dipilih
            if (namaPenghuni !== "" && umurPenghuni !== "" && (jenisKelaminPria || jenisKelaminWanita) && (statusPenghuniSudahMenikah || statusPenghuniBelumMenikah) && gambarKTP > 0) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    html: '<p style="font-size: 14px;">Anda akan menambah data penghuni baru <br> yang bernama <strong>' + namaPenghuni + ' </strong></p>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, tambahkan!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        title: 'swal-title-custom',
                        htmlContainer: 'swal-html-custom'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Kirim formulir jika pengguna menekan "Ya"
                    }
                });
            }
        });
    });
</script>


{{-- kode confirm edit penghuni --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    let form = document.getElementById('formEditPenghuni');
    let btnSimpan = document.getElementById('btnSimpanPerubahan');

    if (btnSimpan) {
        btnSimpan.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir secara otomatis
            
            // Validasi formulir
            let namaPenghuni = form.querySelector('input[name="nama_penghuni"]').value.trim();
            let umurPenghuni = form.querySelector('input[name="umur_penghuni"]').value.trim();
            let jenisKelaminPria = form.querySelector('input[name="jenis_kelamin"][value="Pria"]').checked;
            let jenisKelaminWanita = form.querySelector('input[name="jenis_kelamin"][value="Wanita"]').checked;
            let statusPenghuniSudahMenikah = form.querySelector('input[name="status_penghuni"][value="Sudah Menikah"]').checked;
            let statusPenghuniBelumMenikah = form.querySelector('input[name="status_penghuni"][value="Belum Menikah"]').checked;
            let gambarKTP = form.querySelector('input[name="gambar_ktp"]').files.length;

            // Cek apakah semua input diisi dan jenis kelamin dipilih
            if (namaPenghuni !== "" && umurPenghuni !== "" && (jenisKelaminPria || jenisKelaminWanita) && (statusPenghuniSudahMenikah || statusPenghuniBelumMenikah)) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    html: '<p style="font-size: 14px;">Anda akan mengubah data penghuni <strong>' + namaPenghuni + '</strong>.</p>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, simpan perubahan!',
                    cancelButtonText: 'Tidak',
                    customClass: {
                        title: 'swal-title-custom',
                        htmlContainer: 'swal-html-custom'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Kirim formulir jika pengguna menekan "Ya"
                    }
                });
            } else {
                Swal.fire({
                    title: 'Form tidak lengkap!',
                    text: 'Mohon lengkapi semua field sebelum menyimpan.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    }
});
</script> 
 
{{-- kode sweetalert tombol delete penghuni --}}
<script>
    function confirmDelete(button) {
        var form = button.closest('form');
        var name = button.getAttribute('data-name');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            html: `<p style="font-size: 14px;">Anda akan menghapus data penghuni bernama <strong>${name}</strong>.</p>`,
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

{{-- style untuk notif alert --}}
<style>
    .swal-title-custom {
        font-size: 18px;
    }

    .swal-html-custom {
        font-size: 14px;
    }
</style>