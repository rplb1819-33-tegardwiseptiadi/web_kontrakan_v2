@extends('layout.main')

@section('title', 'TAMBAH KONTRAKAN')

@section('container')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tambah Kontrakan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.rents.index') }}">Kontrakan</a></li>
                    <li class="breadcrumb-item active">Tambah Kontrakan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center;">INPUT DATA KONTRAKAN</h5>

                            <!-- Multi Columns Form -->
                            <form id="formTambahKontrakan" class="row g-3" action="{{ route('dashboard.rents.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- nama kontrakan --}}
                                <div class="col-md-8 offset-md-2">
                                    <label for="inputName5" class="form-label">Nama Kontrakan</label>
                                    <input type="text" name="nama_kontrakan" class="form-control" id="inputName5"
                                        placeholder="Masukkan Nama Kontrakan" value="{{ old('nama_kontrakan') }}">
                                </div>
                                <div class="col-lg-8 offset-md-2">
                                    @if ($errors->has('nama_kontrakan'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $errors->first('nama_kontrakan') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>
 
                                    {{-- Status Kontrakan --}}
                                    <div class="col-md-8 offset-md-2">
                                        <label for="inputPassword5" class="form-label">Status</label>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="status_kontrakan"
                                                value="Kosong" {{ old('status_kontrakan') == 'Kosong' ? 'checked' : '' }}
                                                id="gridRadios3">
                                            <label class="form-check-label" for="gridRadios3">Kosong</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="status_kontrakan"
                                                value="Booking" {{ old('status_kontrakan') == 'Booking' ? 'checked' : '' }}
                                                id="gridRadios4">
                                            <label class="form-check-label" for="gridRadios4">Booking</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="status_kontrakan"
                                                value="Penuh" {{ old('status_kontrakan') == 'Penuh' ? 'checked' : '' }}
                                                id="gridRadios5">
                                            <label class="form-check-label" for="gridRadios5">Penuh</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="status_kontrakan"
                                                value="Diperbaiki"
                                                {{ old('status_kontrakan') == 'Diperbaiki' ? 'checked' : '' }}
                                                id="gridRadios8 offset-md-2">
                                            <label class="form-check-label" for="gridRadios6">Diperbaiki</label>
                                        </div>
                                    <div class="col-lg-8 offset-md-1">
                                        @if ($errors->has('status_kontrakan'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ $errors->first('status_kontrakan') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif 
                                    </div>
                                    </div>

                                    {{-- Tipe Kontrakan --}}
                                    <div class="col-md-8 offset-md-2">
                                        <label for="inputPassword5" class="form-label">Tipe Kontrakan</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipe_kontrakan"
                                                value="Bulanan" id="gridRadios1"
                                                {{ old('tipe_kontrakan') == 'Bulanan' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gridRadios1">Bulanan</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipe_kontrakan"
                                                value="Tahunan" {{ old('tipe_kontrakan') == 'Tahunan' ? 'checked' : '' }}
                                                id="gridRadios2">
                                            <label class="form-check-label" for="gridRadios2">Tahunan</label>
                                        </div>
                                        <div class="col-lg-8 offset-md-1">
                                            @if ($errors->has('tipe_kontrakan'))
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    {{ $errors->first('tipe_kontrakan') }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
 

                                {{-- kapasitas --}}
                                <div class="col-md-8 offset-md-2">
                                    <label for="inputEmail5" class="form-label">Kapasitas Kontrakan</label>
                                    <input type="number" name="kapasitas_kontrakan" class="form-control"
                                        id="inputEmail5" placeholder="Masukkan Kapasitas Kontrakan"
                                        value="{{ old('kapasitas_kontrakan') }}">
                                </div>
                                <div class="col-lg-8 offset-md-2">
                                    @if ($errors->has('kapasitas_kontrakan'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $errors->first('kapasitas_kontrakan') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>

                                {{-- harga --}}
                                <div class="col-md-8 offset-md-2">
                                    <label for="inputEmail5" class="form-label">Harga Kontrakan</label>
                                    <input type="number" name="harga_kontrakan" class="form-control" id="inputName5"
                                        placeholder="Masukkan Harga Kontrakan" value="{{ old('harga_kontrakan') }}">
                                </div>
                                <div class="col-lg-8 offset-md-2">
                                    @if ($errors->has('harga_kontrakan'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $errors->first('harga_kontrakan') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>


                                {{-- alamat kontrakan --}}
                                <div class="col-md-8 offset-md-2">
                                    <label for="inputPassword5" class="form-label">Alamat Kontrakan</label>
                                    <input type="text" class="form-control" id="inputEmail5"
                                        placeholder="Masukkan Alamat Kontrakan"
                                        name="alamat_kontrakan"value="{{ old('alamat_kontrakan') }}">
                                </div>
                                <div class="col-lg-8 offset-md-2">
                                    @if ($errors->has('alamat_kontrakan'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $errors->first('alamat_kontrakan') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>

                                {{-- gambar kontrakan --}}
                                <div class="col-md-8 offset-md-2">
                                    <label for="inputEmail5" class="form-label">Foto Kontrakan</label>
                                    <div class="col-sm-10"
                                        >
                                        <img src="" class="img-thumbnail d-none" style="max-width: 300px; max-height: 300px;" id="previewKONTRAKANimg">
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="custom-file">
                                            <input type="file" name="gambar_kontrakan"
                                                class="custom-file-input @error('gambar_kontrakan') is-invalid @enderror"
                                                id="gambarKONTRAKAN">
                                            @error('gambar_kontrakan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div> 


                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">
                                    <i class="bi bi-person-plus"></i>
                                    Tambah Data
                                    </button>
                                    <a href="{{ route('dashboard.rents.index') }}" class="btn btn-danger">
                                    <i class="bi bi-x-lg"></i>
                                    Kembali
                                    </a>
                                </div>
                            </form><!-- End Multi Columns Form -->

                        </div>
                    </div>

                </div>


            </div>
        </section>

     {{-- kode alert kontrakan --}}
        @include('includes.scriptsRent')
    </main><!-- End #main -->

@endsection

