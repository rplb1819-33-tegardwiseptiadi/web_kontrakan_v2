@extends('layout.main')

@section('title', 'DETAIL TRANSAKSI')

@section('container')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Detail Transaksi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                      <li class="breadcrumb-item"><a href="{{ route('dashboard.transactions.index') }}">Transaksi</a></li>
                    <li class="breadcrumb-item active">Detail Transaksi</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center;">DETAIL DATA TRANSAKSI</h5>

                            <!-- Edit Form -->
                            <form class="row g-3"> 
                                    <div class="col-md-5">
                                        <label for="inputName5" class="form-label">Transaksi Atas Nama</label>
                                        <input type="text" name="nama_penghuni" class="form-control" id="inputName5"
                                            value="{{ $transaction->user->name }}" readonly>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="inputEmail5" class="form-label">Tanggal Transaksi</label>
                                        <input type="text" name="status_penghuni" class="form-control" id="inputEmail5"
                                            value="{{ $transaction->tgl_transaksi }}" readonly>
                                    </div>  
                                    <div class="col-md-10">
                                        <label for="inputEmail5" class="form-label">Status Transaksi</label>
                                        <input type="text" name="status_penghuni" class="form-control" id="inputEmail5"
                                            value="{{ $transaction->status_transaksi }}" readonly>
                                    </div>  
                                    <div class="col-md-5">
                                        <label for="inputEmail5" class="form-label">Nama Kontrakan</label>
                                        <input type="text" name="umur_penghuni" class="form-control" id="inputEmail5"
                                            value="{{ $transaction->rent->nama_kontrakan }}" readonly>
                                    </div>

                                    <div class="col-md-5">
                                        <label for="inputEmail5" class="form-label">Jenis Kontrakan</label>
                                        <input type="text" name="jenis_kelamin" class="form-control" id="inputEmail5"
                                            value="{{ $transaction->rent->tipe_kontrakan }}" readonly>
                                    </div>
 
                                    <div class="col-md-5">
                                        <label for="inputEmail5" class="form-label">Harga (/Bulan)</label>
                                        <input type="text" name="status_penghuni" class="form-control" id="inputEmail5"
                                            value="Rp {{ number_format($transaction->harga_perbulan, 2, ',', '.') }}" readonly>
                                    </div>

                                    <div class="col-md-5">
                                        <label for="inputEmail5" class="form-label">Lama Sewa (/Bulan)</label>
                                        <input type="text" name="status_penghuni" class="form-control" id="inputEmail5"
                                            value="{{ $transaction->jml_sewa_bulan }} Bulan" readonly>
                                    </div> 


                                <div class="col-md-10">
                                    <label for="inputEmail5" class="form-label">Total Harga</label>
                                    <input type="text" name="status_penghuni" class="form-control" id="inputEmail5"
                                        value="Rp {{ number_format($transaction->total_harga, 2, ',', '.') }}" readonly>
                                </div>
                                <div class="col-md-10">
                                    <label for="inputEmail5" class="form-label">Total Bayar</label>
                                    <input type="text" name="status_penghuni" class="form-control" id="inputEmail5"
                                        value="Rp {{ number_format($transaction->total_bayar, 2, ',', '.') }}" readonly>
                                </div>

                                <div class="col-md-10">
                                    <label for="inputEmail5" class="form-label">Kembalian</label>
                                    <input type="text" name="status_penghuni" class="form-control" id="inputEmail5"
                                        value="Rp {{ number_format($transaction->kembalian, 2, ',', '.') }}" readonly>
                                </div>

                                <div class="col-md-10">
                                    <label for="inputEmail5" class="form-label">Bukti Bayar</label>
                                    <div class="col-sm-10"
                                        style="max-width: 400px; max-height: 600px; width: auto; height: auto;">
                                        <img src="{{ asset('assets/upload/gambar_transaksi/' . $transaction->gambar_transaksi) }}"
                                            class="img-thumbnail" id="previewTRANSAKSIimg">
                                        <input type="text" name="nama_barang" class="form-control"
                                            id="validationDefault01" value="{{ $transaction->gambar_transaksi }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('dashboard.transactions.index') }}" class="btn btn-danger">
                                     <i class="bi bi-x-lg"></i>
                                    Kembali
                                    </a>
                                </div>
                        </div>

                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>

            </div>
            </div>
        </section>

    </main><!-- End #main -->

@endsection
