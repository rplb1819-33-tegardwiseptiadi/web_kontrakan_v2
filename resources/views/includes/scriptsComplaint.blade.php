{{-- Script untuk konfirmasi sebelum menambahkan data --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let form = document.getElementById('formTambahKomplain');

        form.addEventListener('submit', function(event) {
            // Validasi formulir
            let inputUser = form.querySelector('select[name="user_id"]').value.trim();
            let inputRent = form.querySelector('select[name="rent_id"]').value.trim();
            let inputComplaint = form.querySelector('textarea[name="keluhan"]').value.trim();
            let gambarKeluhan = form.querySelector('input[name="gambar_keluhan"]').files.length;
            let statusKeluhanSudah = form.querySelector(
                'input[name="status_keluhan"][value="Sudah Divalidasi"]').checked;
            let statusKeluhanBelum = form.querySelector(
                'input[name="status_keluhan"][value="Belum Divalidasi"]').checked;

            // Cek apakah semua input diisi dan status keluhan dipilih
            if (inputUser !== "" && inputRent !== "" && inputComplaint !== "" && gambarKeluhan > 0 && (
                    statusKeluhanSudah || statusKeluhanBelum)) {
                event.preventDefault(); // Mencegah pengiriman formulir secara otomatis
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    html: '<p style="font-size: 14px;">Anda akan menambah data komplain baru.</p>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, tambahkan!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Kirim formulir jika pengguna menekan "Ya"
                    }
                });
            }
        });
    });
</script>



{{-- alert edit confirm --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let form = document.getElementById('formEditKomplain');

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman form secara otomatis

            let userName = '';
            let roleId = {{ auth()->user()->role_id }};
            
            console.log('Role ID:', roleId); // Debug roleId

            if (roleId == 1) {
                // Jika role_id adalah 1, ambil nama dari dropdown
                let selectedOption = document.querySelector('select[name="user_id"] option:checked');
                userName = selectedOption ? selectedOption.textContent.trim() : '';
            } else {
                // Jika role_id bukan 1, ambil nama dari input teks readonly
                userName = document.getElementById('userNameHidden').value.trim();
            }

            console.log('User Name:', userName); // Debug userName

            Swal.fire({
                title: 'Konfirmasi',
                html: `Apakah Anda yakin ingin mengupdate keluhan atas nama <strong>${userName}</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Update!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Kirim formulir jika pengguna mengonfirmasi
                }
            });
        });
    });
</script>



{{-- kode sweetalert tombol delete kkeluhan --}}
<script>
    function confirmDelete(button) {
        var form = button.closest('form');
        var name = button.getAttribute('data-name');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            html: `<p style="font-size: 14px;">Anda akan menghapus data keluhan bernama <strong>${name}</strong>.</p>`,
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
