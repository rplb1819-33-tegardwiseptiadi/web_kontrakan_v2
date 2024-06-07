@extends('layout.main')

@section('title', 'DETAIL dashboard.rents')

@section('container')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Detail Kontrakan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.rents.index') }}">Kontrakan</a></li>
                    <li class="breadcrumb-item active">Detail Kontrakan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center;">DETAIL DATA KONTRAKAN</h5>

                            <!-- Edit Form -->
                            <form class="row g-3">
                                <div class="col-md-8 offset-md-2">
                                    <label for="inputName5" class="form-label">Nama kontrakan</label>
                                    <input type="text" name="nama_kontrakan" class="form-control" id="inputName5"
                                        value="{{ $rent->nama_kontrakan }}" readonly>
                                </div>

                                <div class="col-md-8 offset-md-2">
                                    <label for="inputEmail5" class="form-label">Tipe Kontrakan</label>
                                    <input type="text" name="tipe_kontrakan" class="form-control" id="inputEmail5"
                                        value="{{ $rent->tipe_kontrakan }}" readonly>
                                </div>

                                <div class="col-md-8 offset-md-2">
                                    <label for="inputEmail5" class="form-label">Kapasitas Kontrakan</label>
                                    <input type="text" name="kapasitas_kontrakan" class="form-control" id="inputEmail5"
                                        value="{{ $rent->kapasitas_kontrakan }} orang" readonly>
                                </div>

                                <div class="col-md-8 offset-md-2">
                                    <label for="inputEmail5" class="form-label">Harga Kontrakan</label>
                                    <input type="text" name="harga_kontrakan" class="form-control" id="inputEmail5"
                                        value="Rp {{ number_format($rent->harga_kontrakan, 2, ',', '.') }}" readonly>
                                </div>

                                <div class="col-md-8 offset-md-2">
                                    <label for="inputEmail5" class="form-label">Status Kontrakan</label>
                                    <input type="text" name="status_kontrakan" class="form-control" id="inputEmail5"
                                        value="{{ $rent->status_kontrakan }}" readonly>
                                </div>

                                <div class="col-md-8 offset-md-2">
                                    <label for="inputEmail5" class="form-label">Alamat Kontrakan</label>
                                    <input type="text" name="alamat_kontrakan" class="form-control" id="inputEmail5"
                                        value="{{ $rent->alamat_kontrakan }}" readonly>
                                </div>
 
                                <div class="col-md-8 offset-md-2">
                                    <label for="inputEmail5" class="form-label">Foto Kontrakan</label>
                                    <div class="col-sm-10"
                                        style="max-width: 400px; max-height: 600px; width: auto; height: auto;">
                                        <img src="{{ asset('assets/upload/gambar_kontrakan/' . $rent->gambar_kontrakan) }}"
                                            class="img-thumbnail" id="previewKONTRAKANimg">
                                        <input type="text" name="nama_barang" class="form-control"
                                            id="validationDefault01" value="{{ $rent->gambar_kontrakan }}" readonly>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('dashboard.rents.index') }}" class="btn btn-danger">
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
