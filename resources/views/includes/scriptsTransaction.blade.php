<script>
    $("#selectNamaKontrakan").on("change", function() {
        let rent_id = $(this).val();
        $.ajax({
            url: "/api/transaksi/" + rent_id,
            dataType: "json",
            success: function(data) {
                console.log(data);
                $("#labeljeniskontrakan").val(data.tipe_kontrakan);
                $("#harga_perbulan").val(data.harga_kontrakan);
                hitungTotalHarga();
            },
            error: function(xhr) {
                console.log(xhr.responseJSON);
            }
        });
    });

    $("#jml_sewa_bulan").on("input", function() {
        hitungTotalHarga();
    });

    $("#total_bayar").on("input", function() {
        hitungKembalian();
    });

    function hitungTotalHarga() {
        let lama_sewa = $("#jml_sewa_bulan").val();
        let harga_per_bulan = $("#harga_perbulan").val();
        let total_harga = lama_sewa * harga_per_bulan;
        $("#total_harga").val(total_harga);
        hitungKembalian();
    }

    function hitungKembalian() {
        const total_harga = $("#total_harga").val();
        const bayar = $("#total_bayar").val();
        const kembalian = bayar - total_harga;

        $("#error_uang_bayar").remove();
        $("#success_uang_bayar").remove();

        if (kembalian < 0) {
            const err_msg = $(`
                <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert" id="error_uang_bayar">
                    Jumlah Input Uang Pembayaran Kurang !!!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`);
            $("#input_uang_bayar").append(err_msg);
        } else if (kembalian > 0) {
            const success_msg = $(`
                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert" id="success_uang_bayar">
                    Uang Anda cukup.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`);
            $("#input_uang_bayar").append(success_msg);
        } else if (kembalian => total_harga) {
            const success_msg = $(`
                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert" id="success_uang_bayar">
                    Uang Anda cukup.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`);
            $("#input_uang_bayar").append(success_msg);
        }

        $("#kembalian").val(kembalian);
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let form = document.getElementById('formTambahTransaksi');

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir secara otomatis

            // Ambil nilai dari input
            let totalHarga = parseFloat(document.getElementById('total_harga').value);
            let bayar = parseFloat(document.getElementById('total_bayar').value);

            // Cek apakah jumlah bayar kurang dari total harga
            if (bayar < totalHarga) {
                // Jika kurang, tampilkan pesan kesalahan
                Swal.fire({
                    title: 'Kesalahan!',
                    text: 'Jumlah uang bayar kurang dari total harga.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    customClass: {
                        title: 'swal-title-custom',
                        htmlContainer: 'swal-html-custom'
                    }
                });
            } else {
                // Jika jumlah bayar mencukupi, konfirmasi penambahan data
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    html: '<p style="font-size: 14px;">Anda akan menambahkan data transaksi baru.</p>',
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



{{-- style untuk notif alert --}}
<style>
    .swal-title-custom {
        font-size: 18px;
    }

    .swal-html-custom {
        font-size: 14px;
    }
</style>
