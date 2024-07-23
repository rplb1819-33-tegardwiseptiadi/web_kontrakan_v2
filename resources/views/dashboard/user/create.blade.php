    @extends('layout.main')

    @section('title', 'TAMBAH DATA USER')

    @section('container')
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Tambah User</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">User</a></li>
                        <li class="breadcrumb-item active">Tambah User</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" style="text-align: center;">INPUT DATA USER</h5>

                                <!-- Multi Columns Form -->
                                <form id="formTambahUser" class="row g-3" action="{{ route('dashboard.users.store') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Name -->
                                    <div class="col-md-8 offset-md-2">
                                        <label for="inputName" class="form-label">Nama</label>
                                        <input type="text" name="name" class="form-control" id="inputName"
                                            placeholder="Masukkan Nama" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                                {{ $errors->first('name') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-8 offset-md-2">
                                        <label for="inputEmail" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="inputEmail"
                                            placeholder="Masukkan Email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                                {{ $errors->first('email') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Password -->
                                    <div class="col-md-8 offset-md-2">
                                        <label for="inputPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="inputPassword"
                                            placeholder="Masukkan Password">
                                        @if ($errors->has('password'))
                                            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                                {{ $errors->first('password') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Umur -->
                                    <div class="col-md-8 offset-md-2">
                                        <label for="inputUmur" class="form-label">Umur</label>
                                        <input type="number" name="umur" class="form-control" id="inputUmur"
                                            placeholder="Masukkan Umur" value="{{ old('umur') }}">
                                        @if ($errors->has('umur'))
                                            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                                {{ $errors->first('umur') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Jenis Kelamin -->
                                    <div class="col-md-8 offset-md-2">
                                        <label for="inputGender" class="form-label">Jenis Kelamin</label>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="jenis_kelamin" value="Pria"
                                                {{ old('jenis_kelamin') == 'Pria' ? 'checked' : '' }} id="genderPria">
                                            <label class="form-check-label" for="genderPria">Pria</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="jenis_kelamin" value="Wanita"
                                                {{ old('jenis_kelamin') == 'Wanita' ? 'checked' : '' }} id="genderWanita">
                                            <label class="form-check-label" for="genderWanita">Wanita</label>
                                        </div>
                                        @if ($errors->has('jenis_kelamin'))
                                            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                                {{ $errors->first('jenis_kelamin') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Status Penghuni -->
                                    <div class="col-md-8 offset-md-2">
                                        <label for="inputStatusPenghuni" class="form-label">Status Penghuni</label>
                                        <select name="status_penghuni" id="inputStatusPenghuni" class="form-select">
                                            <option value="Sudah Menikah"
                                                {{ old('status_penghuni') == 'Sudah Menikah' ? 'selected' : '' }}>Sudah Menikah
                                            </option>
                                            <option value="Belum Menikah"
                                                {{ old('status_penghuni') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah
                                            </option>
                                        </select>
                                        @if ($errors->has('status_penghuni'))
                                            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                                {{ $errors->first('status_penghuni') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Gambar KTP -->
                                    <div class="col-md-8 offset-md-2">
                                        <label for="inputEmail5" class="form-label">Gambar KTP</label>
                                        <div class="col-sm-10"
                                            style="max-width: 400px; max-height: 600px; width: auto; height: auto;">
                                            <img src="" class="img-thumbnail " id="previewKTPimg">
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
                                   
                                    <!-- Gambar Profile -->
                                    <div class="col-md-8 offset-md-2">
                                        <label for="inputEmail5" class="form-label">Gambar Profil</label>
                                        <div class="col-sm-10"
                                            style="max-width: 400px; max-height: 600px; width: auto; height: auto;">
                                            <img src="" class="img-thumbnail " id="previewPROFILEimg">
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="custom-file">
                                                <input type="file" name="gambar_profil"
                                                    class="custom-file-input @error('gambar_profil') is-invalid @enderror"
                                                    id="gambarPROFILE">
                                                @error('gambar_profil')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
    
                                    <!-- Role -->
                                    <div class="col-md-8 offset-md-2">
                                        <label for="inputRole" class="form-label">Role</label>
                                        <select name="role_id" id="inputRole" class="form-select">
                                            @foreach ($roles as $role)
                                                @if ($role->name !== 'administrator')
                                                    <option value="{{ $role->id }}"
                                                        {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                        {{ $role->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('role_id'))
                                            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                                {{ $errors->first('role_id') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success">
                                        <i class="bi bi-person-plus"></i>
                                        Tambah Data
                                        </button>
                                        
                                        <a href="{{ route('dashboard.users.index') }}" class="btn btn-danger">
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
        </main><!-- End #main -->
    @endsection

    {{-- kode alert user --}}
    @include('includes.scriptsUser')
