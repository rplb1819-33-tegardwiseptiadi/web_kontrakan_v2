@extends('layout.main')

@section('title', 'EDIT PENGHUNI')

@section('container')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Penghuni</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.occupants.index') }}">Penghuni</a></li>
                    <li class="breadcrumb-item active">Edit Penghuni</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Data Penghuni</h5>

                            <!-- Edit Form -->
                            <form id="formEditPenghuni" class="row g-3"
                                action="{{ route('dashboard.occupants.update', $occupant->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="col-md-8">
                                    <label for="inputName5" class="form-label">Nama Penghuni</label>
                                    <input type="text" name="nama_penghuni" class="form-control" id="inputName5"
                                        value="{{ old('nama_penghuni', $occupant->nama_penghuni) }}"
                                        placeholder="Masukkan Nama Penghuni">
                                </div>

                                <div class="col-md-8">
                                    <label for="inputEmail5" class="form-label">Umur</label>
                                    <input type="number" name="umur_penghuni" class="form-control" id="inputEmail5"
                                        value="{{ old('umur_penghuni', $occupant->umur_penghuni) }}"
                                        placeholder="Masukkan Umur Penghuni">
                                </div>

                                <div class="col-md-8">
                                    <label for="inputPassword5" class="form-label">Jenis Kelamin</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Pria"
                                            id="gridRadios1"
                                            {{ old('jenis_kelamin', $occupant->jenis_kelamin) == 'Pria' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gridRadios1">Pria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Wanita"
                                            id="gridRadios2"
                                            {{ old('jenis_kelamin', $occupant->jenis_kelamin) == 'Wanita' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gridRadios2">Wanita</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="inputPassword5" class="form-label">Status Penghuni</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status_penghuni"
                                            value="Sudah Menikah" id="gridRadios3"
                                            {{ old('status_penghuni', $occupant->status_penghuni) == 'Sudah Menikah' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gridRadios3">Sudah Menikah</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status_penghuni"
                                            value="Belum Menikah" id="gridRadios4"
                                            {{ old('status_penghuni', $occupant->status_penghuni) == 'Belum Menikah' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gridRadios4">Belum Menikah</label>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <label for="inputEmail5" class="form-label">Foto KTP</label>
                                    <div class="col-sm-10"
                                        style="max-width: 400px; max-height: 600px; width: auto; height: auto;">
                                        <img src="{{ asset('assets/upload/gambar_ktp/' . $occupant->gambar_ktp) }}"
                                            class="img-thumbnail" id="previewKTPimg">
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
                                    <button type="submit" class="btn btn-primary" id="btnSimpanPerubahan">Simpan
                                        Perubahan</button>
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

