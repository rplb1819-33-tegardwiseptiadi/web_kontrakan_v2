@extends('layout.main')

@section('title', 'DETAIL DATA USER')

@section('container')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Detail User</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Transaksi</a></li>
                    <li class="breadcrumb-item active">Detail User</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center;">DETAIL DATA USER</h5>

                            <!-- Edit Form -->
                            <form class="row g-3">
                                <div class="col-md-5">
                                    <label for="inputName5" class="form-label">Nama User</label>
                                    <input type="text" name="nama_penghuni" class="form-control" id="inputName5"
                                        value="{{ $user->name }}" readonly>
                                </div>
                                <div class="col-md-5">
                                    <label for="inputEmail5" class="form-label">Role User</label>
                                    <input type="text" name="status_penghuni" class="form-control" id="inputEmail5"
                                        value="{{ $user->role->name }}" readonly>
                                </div>
                                <div class="col-md-5">
                                    <label for="inputEmail5" class="form-label">Email User</label>
                                    <input type="text" name="status_penghuni" class="form-control" id="inputEmail5"
                                        value="{{ $user->email }}" readonly>
                                </div>
                                <div class="col-md-5">
                                    <label for="inputEmail5" class="form-label">Umur</label>
                                    <input type="text" name="status_penghuni" class="form-control" id="inputEmail5"
                                        value="{{ $user->umur }} Tahun" readonly>
                                </div>
                                <div class="col-md-5">
                                    <label for="inputEmail5" class="form-label">Jenis Kelamin</label>
                                    <input type="text" name="status_penghuni" class="form-control" id="inputEmail5"
                                        value="{{ $user->jenis_kelamin }}" readonly>
                                </div>
                                <div class="col-md-5">
                                    <label for="inputEmail5" class="form-label">Status</label>
                                    <input type="text" name="umur_penghuni" class="form-control" id="inputEmail5"
                                        value="{{ $user->status_penghuni }}" readonly>
                                </div>

                                <div class="col-md-5">
                                    <label for="inputEmail5" class="form-label">Foto User</label>
                                    <div class="col-sm-10"
                                        style="max-width: 400px; max-height: 600px; width: auto; height: auto;">
                                        <img src="{{ asset('assets/upload/gambar_ktp/' . $user->gambar_ktp) }}"
                                            class="img-thumbnail" id="previewTRANSAKSIimg">
                                        <input type="text" name="nama_barang" class="form-control"
                                            id="validationDefault01" value="{{ $user->gambar_ktp }}" readonly>
                                    </div>
                                </div>


                                <div class="text-center">
                                    <a href="{{ route('dashboard.users.index') }}" class="btn btn-danger">
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
