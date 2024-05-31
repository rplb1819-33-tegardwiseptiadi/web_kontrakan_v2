@extends('layout.main')

@section('title', 'DETAIL KOMPLAIN')

@section('container')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Detail Komplain</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.complaints.index') }}">Komplain</a></li>
                    <li class="breadcrumb-item active">Detail Komplain</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center;">DETAIL KOMPLAIN</h5>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="pengguna" class="form-label">Nama Penghuni</label>
                                        <input type="text" id="pengguna" name="pengguna" class="form-control" value="{{ $complaint->user->name }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="kontrakan" class="form-label">Nama Kontrakan</label>
                                        <input type="text" id="kontrakan" name="kontrakan" class="form-control" value="{{ $complaint->rent->nama_kontrakan }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="keluhan" class="form-label">Keluhan</label>
                                        <textarea id="keluhan" name="keluhan" class="form-control" rows="3" readonly>{{ $complaint->keluhan }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="status" class="form-label">Status Keluhan</label>
                                        <input type="text" id="status" name="status" class="form-control" value="{{ $complaint->status_keluhan }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="foto" class="form-label">Foto Keluhan</label><br>
                                         <img src="{{ asset('assets/upload/gambar_keluhan/' . $complaint->gambar_keluhan) }}"
                                            class="img-thumbnail" id="previewKELUHANimg">
                                        <input type="text" name="foto_keluhan" class="form-control"
                                            id="validationDefault01" value="{{ $complaint->gambar_keluhan }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <a href="{{ route('dashboard.complaints.index') }}" class="btn btn-danger">
                                    <i class="bi bi-x-lg"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection
