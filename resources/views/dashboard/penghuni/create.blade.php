@extends('layout.main')

@section('title', 'TAMBAH PENGHUNI')

@section('container')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tambah Penghuni</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.occupants.index') }}">Penghuni</a></li>
                    <li class="breadcrumb-item active">Tambah Penghuni</li>
                </ol>
            </nav>

        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Multi Columns Form</h5>

                            <!-- Multi Columns Form -->
                            <form id="formTambahPenghuni" class="row g-3" action="{{ route('dashboard.occupants.store') }}"
                                method="POST" enctype="multipart/form-data">

                                @csrf <!-- Menyertakan token CSRF -->
                                {{-- nama penghuni --}}
                                <div class="col-md-8">
                                    <label for="inputName5" class="form-label">Nama Penghuni</label>
                                    <input type="text" name="nama_penghuni" class="form-control" id="inputName5"
                                        placeholder="Masukkan Nama Penghuni" value="{{ old('nama_penghuni') }}">

                                </div>
                                <div class="col-lg-7">
                                    @if ($errors->has('nama_penghuni'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $errors->first('nama_penghuni') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>
                                
                                {{-- role id --}}
                                <div class="col-md-8">
                                    <label for="inputName5" class="form-label">Level Akun</label>
                                    <input type="text" class="form-control" id="inputName5"
                                        value="Penghuni" readonly> 
                                </div>
                                <div class="col-lg-7">
                                    @if ($errors->has('nama_penghuni'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $errors->first('nama_penghuni') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>


                                <div class="col-md-8">
                                    <label for="inputEmail5" class="form-label">Umur</label>
                                    <input type="number" name="umur_penghuni" class="form-control" id="inputEmail5"
                                        value="{{ old('umur_penghuni') }}">
                                </div>
                                <div class="col-lg-7">
                                    @if ($errors->has('umur_penghuni'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $errors->first('umur_penghuni') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="inputPassword5" class="form-label">Jenis Kelamin</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Pria"
                                            id="gridRadios1" {{ old('jenis_kelamin') == 'Pria' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gridRadios1">Pria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Wanita"
                                            {{ old('jenis_kelamin') == 'Wanita' ? 'checked' : '' }} id="gridRadios2">
                                        <label class="form-check-label" for="gridRadios2">Wanita</label>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    @if ($errors->has('jenis_kelamin'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $errors->first('jenis_kelamin') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="inputPassword5" class="form-label">Status Penghuni</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status_penghuni"
                                            id="gridRadios3" value="Sudah Menikah"
                                            {{ old('status_penghuni') == 'Sudah Menikah' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gridRadios3">Sudah Menikah</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status_penghuni"
                                            id="gridRadios4" value="Belum Menikah"
                                            {{ old('status_penghuni') == 'Belum Menikah' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gridRadios4">Belum Menikah</label>
                                    </div>
                                    <div class="col-lg-7">
                                        @if ($errors->has('status_penghuni'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ $errors->first('status_penghuni') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <label for="inputEmail5" class="form-label">Foto KTP</label>
                                    <div class="col-sm-10"
                                        style="max-width: 400px; max-height: 600px; width: auto; height: auto;">
                                        <img src="" class="img-thumbnail d-none" id="previewKTPimg">
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="custom-file">
                                            <input type="file" name="gambar_ktp"
                                                class="custom-file-input @error('gambar_ktp') is-invalid @enderror"
                                                id="gambarKTP">
                                            @error('gambar_ktp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">Tambah
                                        Data</button>

                                    <a href="{{ route('dashboard.occupants.index') }}" class="btn btn-danger">Kembali</a>
                                </div>
                            </form><!-- End Multi Columns Form -->

                        </div>
                    </div>

                </div>


            </div>
        </section>
    </main><!-- End #main -->

@endsection

@push('addon-script')
    {{-- kode alert penghuni --}}
    @include('includes.scriptsOccupant')
@endpush
