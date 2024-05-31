{{-- kode konfirmasi tambah data --}}
{{-- ketika semua value form sudah diisi  --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let form = document.getElementById('formTambahKontrakan');

        form.addEventListener('submit', function(event) {
            // Validasi formulir
            let namaKontrakan = form.querySelector('input[name="nama_kontrakan"]').value.trim();
            let statusKontrakanKosong = form.querySelector('input[name="status_kontrakan"][value="Kosong"]').checked;
            let statusKontrakanBooking = form.querySelector('input[name="status_kontrakan"][value="Booking"]').checked;
            let statusKontrakanPenuh = form.querySelector('input[name="status_kontrakan"][value="Penuh"]').checked;
            let statusKontrakanDiperbaiki = form.querySelector('input[name="status_kontrakan"][value="Diperbaiki"]').checked;
            let tipeKontrakanBulanan = form.querySelector('input[name="tipe_kontrakan"][value="Bulanan"]').checked;
            let tipeKontrakanTahunan = form.querySelector('input[name="tipe_kontrakan"][value="Tahunan"]').checked;
            let kapasitasKontrakan = form.querySelector('input[name="kapasitas_kontrakan"]').value.trim();
            let hargaKontrakan = form.querySelector('input[name="harga_kontrakan"]').value.trim();
            let alamatKontrakan = form.querySelector('input[name="alamat_kontrakan"]').value.trim();
            let gambarKontrakan = form.querySelector('input[name="gambar_kontrakan"]').files.length;

            // Cek apakah semua input diisi dan jenis kontrakan dipilih
            if (namaKontrakan !== "" && ((tipeKontrakanBulanan || tipeKontrakanTahunan) && (statusKontrakanKosong || statusKontrakanBooking || statusKontrakanPenuh || statusKontrakanDiperbaiki)) && kapasitasKontrakan !== "" && hargaKontrakan !== "" && alamatKontrakan !== "" && gambarKontrakan > 0) {
                event.preventDefault(); // Mencegah pengiriman formulir secara otomatis
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    html: '<p style="font-size: 14px;">Anda akan menambah data kontrakan baru <br> yang bernama <strong>' + namaKontrakan + '</strong></p>',
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

{{-- kode sweetalert tombol confirm edit kontrakan --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let form = document.getElementById('formEditKontrakan');

        form.addEventListener('submit', function(event) {
            // Validasi formulir
            let namaKontrakan = form.querySelector('input[name="nama_kontrakan"]').value.trim();
            let statusKontrakanKosong = form.querySelector('input[name="status_kontrakan"][value="Kosong"]').checked;
            let statusKontrakanBooking = form.querySelector('input[name="status_kontrakan"][value="Booking"]').checked;
            let statusKontrakanPenuh = form.querySelector('input[name="status_kontrakan"][value="Penuh"]').checked;
            let statusKontrakanDiperbaiki = form.querySelector('input[name="status_kontrakan"][value="Diperbaiki"]').checked;
            let tipeKontrakanBulanan = form.querySelector('input[name="tipe_kontrakan"][value="Bulanan"]').checked;
            let tipeKontrakanTahunan = form.querySelector('input[name="tipe_kontrakan"][value="Tahunan"]').checked;
            let kapasitasKontrakan = form.querySelector('input[name="kapasitas_kontrakan"]').value.trim();
            let hargaKontrakan = form.querySelector('input[name="harga_kontrakan"]').value.trim();
            let alamatKontrakan = form.querySelector('input[name="alamat_kontrakan"]').value.trim();

            // Cek apakah semua input diisi dan jenis kontrakan dipilih
            if (namaKontrakan !== "" && ((tipeKontrakanBulanan || tipeKontrakanTahunan) && (statusKontrakanKosong || statusKontrakanBooking || statusKontrakanPenuh || statusKontrakanDiperbaiki)) && kapasitasKontrakan !== "" && hargaKontrakan !== "" && alamatKontrakan !== "") {
                event.preventDefault(); // Mencegah pengiriman formulir secara otomatis
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    html: '<p style="font-size: 14px;">Anda akan mengubah data kontrakan <strong>' + namaKontrakan + '</strong>.</p>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, simpan!',
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


{{-- kode sweetalert tombol delete kontrakan --}}
<script>
    function confirmDelete(button) {
        var form = button.closest('form');
        var name = button.getAttribute('data-name');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            html: `<p style="font-size: 14px;">Anda akan menghapus data kontrakan bernama <strong>${name}</strong>.</p>`,
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