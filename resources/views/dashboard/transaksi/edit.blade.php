<!-- ini adalah konten dari halaman Dashboard Staff -->
<!-- biar bisa menggunakan templat dari folder layout dengan nama file main -->
@extends('layout.main')

@section('title', 'EDIT TRANSAKSI')

@section('container')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Transaksi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.transactions.index') }}">Transaksi</a></li>
                    <li class="breadcrumb-item active">Edit Data Transaksi</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" style="text-align: center;">EDIT DATA TRANSAKSI</h5>
                                <!-- Multi Columns Form -->
                                <form id="formEditTransaksi" class="row g-3"
                                    action="{{ route('dashboard.transactions.update', $transaction->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    {{-- Nama Transaksi --}}
                                    <div class="col-md-8 offset-md-2  ">
                                        <label for="selectNamaUser" class="form-label">Transaksi Atas Nama:</label>
                                        <input type="text" class="form-control"
                                            value="{{ old('nama_user', $transaction->user->name) }}" readonly>
                                        <input type="hidden" name="user_id"
                                            value="{{ old('user_id', $transaction->user->id) }}">
                                        <div class="col-lg-7" style="margin-top:10px;">
                                            @if ($errors->has('user_id'))
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    {{ $errors->first('user_id') }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- tgl transaksi --}}
                                    <div class="col-md-8 offset-md-2">
                                        <label for="validationDefault01" class="form-label">Tanggal Transaksi:</label>
                                        <input type="date" name="tgl_transaksi" class="form-control"
                                            id="validationDefault01"
                                            value="{{ old('tgl_transaksi', $transaction->tgl_transaksi) }}">
                                        <div class="col-lg-7" style="margin-top:10px;">
                                            @if ($errors->has('tgl_transaksi'))
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    {{ $errors->first('tgl_transaksi') }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Nama Kontrakan --}}
                                    <div class="col-md-8 offset-md-2">
                                        <label for="selectNamaKontrakan" class="form-label">Nama Kontrakan:</label>
                                        <select id="selectNamaKontrakan" class="form-select" name="rent_id">
                                            <option selected value="{{ old('rent_id', $transaction->rent->id) }}">
                                                {{ old('rent_id', $transaction->rent->nama_kontrakan) }}</option>
                                            @if ($allFull)
                                                <option disabled value="">KONTRAKAN TIDAK TERSEDIA (PENUH)</option>
                                            @else
                                                @foreach ($rents as $rent)
                                                    @if ($rent->status_kontrakan != 'Penuh' && $rent->status_kontrakan != 'Booking')
                                                        <option value="{{ $rent->id }}">{{ $rent->nama_kontrakan }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="col-lg-7" style="margin-top:10px;">
                                            @if ($errors->has('rent_id'))
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    {{ $errors->first('rent_id') }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Tipe Kontrakan --}}
                                    <div class="col-md-8 offset-md-2">
                                        <label for="labeljeniskontrakan" class="form-label">Tipe Kontrakan:</label>
                                        <input type="text" class="form-control" id="labeljeniskontrakan"
                                            value="{{ old('tipe_kontrakan', $transaction->rent->tipe_kontrakan) }}"
                                            readonly>
                                    </div>

                                    {{-- Harga Perbulan --}}
                                    <div class="col-md-8 offset-md-2">
                                        <label for="harga_perbulan" class="form-label">Harga (/Bulan):</label>
                                        <input type="number" class="form-control" id="harga_perbulan" name="harga_perbulan"
                                            readonly value="{{ old('harga_perbulan', $transaction->harga_perbulan) }}">
                                    </div>

                                    {{-- Lama Sewa (Bulan) --}}
                                    <div class="col-md-8 offset-md-2">
                                        <label for="jml_sewa_bulan" class="form-label">Lama Sewa (Bulan):</label>
                                        <input type="number" name="jml_sewa_bulan" class="form-control" id="jml_sewa_bulan"
                                            value="{{ old('jml_sewa_bulan', $transaction->jml_sewa_bulan) }}">
                                        <div class="col-lg-7" style="margin-top:10px;">
                                            @if ($errors->has('jml_sewa_bulan'))
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    {{ $errors->first('jml_sewa_bulan') }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Total Harga --}}
                                    <div class="col-md-8 offset-md-2">
                                        <label for="total_harga" class="form-label">Total Harga:</label>
                                        <input type="number" name="total_harga" class="form-control" id="total_harga"
                                            readonly value="{{ old('total_harga', $transaction->total_harga) }}">
                                    </div>

                                    {{-- Input Uang Bayar Sewa --}}
                                    <div class="col-md-8 offset-md-2" id="input_uang_bayar">
                                        <label for="total_bayar" class="form-label">Input Uang Bayar:</label>
                                        <input type="number" name="total_bayar" class="form-control" id="total_bayar"
                                            value="{{ old('total_bayar', $transaction->total_bayar) }}">
                                    </div>

                                    {{-- Kembalian --}}
                                    <div class="col-md-8 offset-md-2">
                                        <label for="kembalian" class="form-label">Kembalian:</label>
                                        <input type="number" name="kembalian" class="form-control" id="kembalian"
                                            value="{{ old('kembalian', $transaction->kembalian) }}" readonly>
                                    </div>

                                    {{-- status transaksi --}}
                                    <div class="col-md-8 offset-md-2">
                                        <label class="pt-0 form-label">STATUS TRANSAKSI</label>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status_transaksi"
                                                id="gridRadios1" value="Sudah Divalidasi"
                                                {{ old('status_transaksi', $transaction->status_transaksi) == 'Sudah Divalidasi' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gridRadios1">
                                                Sudah Divalidasi
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status_transaksi"
                                                id="gridRadios2" value="Belum Divalidasi"
                                                {{ old('status_transaksi', $transaction->status_transaksi) == 'Belum Divalidasi' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gridRadios2">
                                                Belum Divalidasi
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-8 offset-md-2">
                                        <label for="inputEmail5" class="form-label">Foto Transaksi</label>
                                        <div class="col-sm-10"
                                            style="max-width: 400px; max-height: 600px; width: auto; height: auto;">
                                            <img src="{{ asset('assets/upload/gambar_transaksi/' . $transaction->gambar_transaksi) }}"
                                                class="img-thumbnail" id="previewTRANSAKSIimg">
                                        </div>

                                        <div class="col-sm-12 offset-md-2">
                                            <div class="custom-file">
                                                <input type="file" name="gambar_transaksi"
                                                    class="custom-file-input @error('gambar_transaksi') is-invalid @enderror"
                                                    id="gambarTRANSAKSI">
                                                @error('gambar_transaksi')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6" style="margin-left: 30%;">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-save"></i>
                                            Edit Data
                                        </button>
                                        <a class="btn btn-danger" href="{{ route('dashboard.transactions.index') }}">
                                            <i class="bi bi-x-lg"></i>
                                            Kembali
                                        </a>
                                    </div>

                                </form><!-- End Multi Columns Form -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection


<!-- Your HTML content here -->

@push('addon-script')
    <!-- Pastikan Anda menyertakan SweetAlert2 di halaman Anda -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // AJAX untuk mengambil data kontrakan
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

            // Menghitung total harga dan kembalian saat input berubah
            $("#jml_sewa_bulan, #total_bayar").on("input", function() {
                hitungTotalHarga();
                hitungKembalian();
            });

            function hitungTotalHarga() {
                let lama_sewa = $("#jml_sewa_bulan").val();
                let harga_per_bulan = $("#harga_perbulan").val();
                let total_harga = lama_sewa * harga_per_bulan;
                $("#total_harga").val(total_harga);
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
                } else if (kembalian >= total_harga) {
                    const success_msg = $(`
                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert" id="success_uang_bayar">
                    Uang Anda cukup.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`);
                    $("#input_uang_bayar").append(success_msg);
                }

                $("#kembalian").val(kembalian);
            }

            // Konfirmasi saat submit form
            $("#formEditTransaksi").on("submit", function(e) {
                e.preventDefault(); // Mencegah form dari pengiriman default

                // Mengambil nama pengguna dari input teks
                const userName = $("input[name='user_id']").prev("input[type='text']").val();

                Swal.fire({
                    title: 'Konfirmasi',
                    html: `Apakah Anda yakin ingin mengubah transaksi atas nama <strong>${userName}</strong>?`, // Gunakan backticks dan ${} untuk interpolasi
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Ubah!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim formulir jika pengguna mengonfirmasi
                        $(this).off('submit').submit();
                    }
                });
            });

        });
    </script>
@endpush
