@extends('layout.main')

@section('title', 'EDIT KELUHAN')

@section('container')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Keluhan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.complaints.index') }}">Keluhan</a></li>
                    <li class="breadcrumb-item active">Edit Keluhan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">EDIT DATA KELUHAN</h5>
                            <!-- Multi Columns Form -->
                            <form id="formEditKomplain" class="row g-3"
                                action="{{ route('dashboard.complaints.update', $complaint->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- user_id --}}
                                <div class="col-md-8 offset-md-2">
                                    <label for="inputUser" class="form-label">Nama User</label>
                                    @if (auth()->user()->role_id == 1)
                                        <select class="form-select" id="inputUser" name="user_id">
                                            <option value="">Pilih User</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ old('user_id', $complaint->user_id) == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input type="text" id="userName" class="form-control"
                                            value="{{ auth()->user()->name }}" readonly>
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        <input type="hidden" id="userNameHidden" value="{{ auth()->user()->name }}">
                                    @endif
                                    @error('user_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>



                                {{-- rent_id --}}
                                <div class="col-md-8 offset-md-2">
                                    <label for="inputRent" class="form-label">Nama Kontrakan</label>
                                    <select class="form-select" id="inputRent" name="rent_id">
                                        <option value="">Pilih Kontrakan</option>
                                        @foreach ($rents as $rent)
                                            <option value="{{ $rent->id }}"
                                                {{ $complaint->rent_id == $rent->id ? 'selected' : '' }}>
                                                {{ $rent->nama_kontrakan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('rent_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- keluhan --}}
                                <div class="col-md-8 offset-md-2">
                                    <label for="inputComplaint" class="form-label">Keluhan</label>
                                    <textarea class="form-control" id="inputComplaint" name="keluhan" rows="3">{{ $complaint->keluhan }}</textarea>
                                    @error('keluhan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                {{-- Tanggal Keluhan --}}
                                <div class="col-md-8 offset-md-2">
                                    <label for="inputComplaint" class="form-label">Tanggal Keluhan</label>
                                    <input type="text" class="form-control" id="inputComplaint" name="tgl_keluhan"
                                        rows="3"
                                        @if (auth()->user()->role_id != 1) value="{{ $complaint->tgl_keluhan }}" readonly @endif
                                        value="{{ $complaint->tgl_keluhan }}">
                                    @error('tgl_keluhan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                {{-- Status Keluhan --}}
                                <div class="col-md-8 offset-md-2">
                                    @if (auth()->user()->role_id == 1)
                                    <label class="form-label">Status Keluhan</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status_keluhan"
                                                id="status1" value="Sudah Divalidasi"
                                                {{ $complaint->status_keluhan == 'Sudah Divalidasi' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status1">
                                                Sudah Divalidasi
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status_keluhan"
                                                id="status2" value="Belum Divalidasi"
                                                {{ $complaint->status_keluhan == 'Belum Divalidasi' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status2">
                                                Belum Divalidasi
                                            </label>
                                        </div>
                                    @else
                                        <input type="hidden" name="status_keluhan" value="Belum Divalidasi">
                                    @endif
                                    @error('status_keluhan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                {{-- gambar_keluhan --}}
                                <div class="col-md-8 offset-md-2">
                                    <label for="inputEmail5" class="form-label">Foto Keluhan</label>
                                    <div class="mb-3">
                                        <img src="{{ asset('assets/upload/gambar_keluhan/' . $complaint->gambar_keluhan) }}"
                                            class="img-thumbnail" id="previewKELUHANimg"
                                            style="max-width: 100%; height: auto;">
                                    </div>
                                    <div class="mb-3">
                                        <input type="file" name="gambar_keluhan"
                                            class="form-control @error('gambar_keluhan') is-invalid @enderror"
                                            id="gambarKELUHAN" @if (auth()->user()->role_id != 1) disabled @endif>
                                        @error('gambar_keluhan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>



                                {{-- Submit button --}}
                                <div class="col-md-8 offset-md-2 text-center">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="bi bi-save"></i>
                                        Edit Data
                                    </button>
                                    <a href="{{ route('dashboard.complaints.index') }}" class="btn btn-danger">
                                        <i class="bi bi-x-lg"></i> Kembali
                                    </a>
                                </div>
                            </form><!-- End Multi Columns Form -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- kode alert keluhan --}}
        @include('includes.scriptsComplaint')
    </main><!-- End #main -->
@endsection
