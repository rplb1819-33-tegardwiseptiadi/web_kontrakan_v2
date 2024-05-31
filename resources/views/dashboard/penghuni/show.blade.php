@extends('layout.main')

@section('title', 'DETAIL PENGHUNI')

@section('container')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Detail Penghuni</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.occupants.index') }}">Penghuni</a></li>
                    <li class="breadcrumb-item active">Detail Penghuni</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Detail Data Penghuni</h5>

                            <!-- Edit Form -->
                            <form class="row g-3">
                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">Nama Penghuni</label>
                                    <input type="text" name="nama_penghuni" class="form-control" id="inputName5"
                                        value="{{ $occupant->nama_penghuni }}" readonly>
                                </div>

                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">Level Akun</label>
                                    <input type="text" name="nama_penghuni" class="form-control" id="inputName5"
                                        value="{{ $occupant->user->role->name }}" readonly>
                                </div>


                                <div class="col-md-8">
                                    <label for="inputEmail5" class="form-label">Umur</label>
                                    <input type="text" name="umur_penghuni" class="form-control" id="inputEmail5"
                                        value="{{ $occupant->umur_penghuni }} Tahun" readonly>
                                </div>

                                <div class="col-md-8">
                                    <label for="inputEmail5" class="form-label">Jenis Kelamin</label>
                                    <input type="text" name="jenis_kelamin" class="form-control" id="inputEmail5"
                                        value="{{ $occupant->jenis_kelamin }}" readonly>
                                </div>

                                <div class="col-md-8">
                                    <label for="inputEmail5" class="form-label">Status Penghuni</label>
                                    <input type="text" name="status_penghuni" class="form-control" id="inputEmail5"
                                        value="{{ $occupant->status_penghuni }}" readonly>
                                </div>

                                <div class="col-md-8">
                                    <label for="inputEmail5" class="form-label">Foto KTP</label>
                                    <div class="col-sm-10"
                                        style="max-width: 400px; max-height: 600px; width: auto; height: auto;">
                                        <img src="{{ asset('assets/upload/gambar_ktp/' . $occupant->gambar_ktp) }}"
                                            class="img-thumbnail" id="previewKTPimg">
                                        <input type="text" name="nama_barang" class="form-control"
                                            id="validationDefault01" value="{{ $occupant->gambar_ktp }}" readonly>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('dashboard.occupants.index') }}" class="btn btn-danger">Kembali</a>
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
