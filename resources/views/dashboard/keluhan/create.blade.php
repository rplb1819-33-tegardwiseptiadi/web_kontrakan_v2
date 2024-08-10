 @extends('layout.main')

 @section('title', 'TAMBAH KELUHAN')

 @section('container')
     <main id="main" class="main">
         <div class="pagetitle">
             <h1>Tambah Keluhan</h1>
             <nav>
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                     <li class="breadcrumb-item"><a href="{{ route('dashboard.complaints.index') }}">Keluhan</a></li>
                     <li class="breadcrumb-item active">Tambah Keluhan</li>
                 </ol>
             </nav>
         </div><!-- End Page Title -->
         <section class="section">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-body">
                             <h5 class="card-title" style="text-align: center;">INPUT DATA KELUHAN</h5>
                             <!-- Multi Columns Form -->
                             <form id="formTambahKomplain" class="row g-3"
                                 action="{{ route('dashboard.complaints.store') }}" method="POST"
                                 enctype="multipart/form-data">
                                 @csrf
                                 {{-- user_id --}}
                                 @if (auth()->user()->role_id == 1)
                                     <div class="col-md-8 offset-md-2 offset-md-2">
                                         <label for="inputUser" class="form-label">Pengguna</label>
                                         <select class="form-select" id="inputUser" name="user_id">
                                             <option selected value="">PILIH PENGHUNI</option>
                                                  @foreach ($users as $user)
                                                      @if ($user->role->name != 'administrator')
                                                          {{-- Periksa nama role --}}
                                                          <option value="{{ $user->id }}">
                                                              {{ $user->name }}
                                                          </option>
                                                      @endif
                                                  @endforeach
                                         </select>
                                         @error('user_id')
                                             <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                     </div>
                                 @else
                                     <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                     <div class="col-md-8 offset-md-2">
                                         <label for="inputUser" class="form-label">Pengguna</label>
                                         <input type="text" class="form-control" id="inputUser"
                                             value="{{ auth()->user()->name }}" disabled>
                                     </div>
                                 @endif


                                 {{-- rent_id --}}
                                 <div class="col-md-8 offset-md-2">
                                     <label for="inputRent" class="form-label">ID Kontrakan</label>
                                     <select class="form-select" id="inputRent" name="rent_id">
                                         <option value="">Pilih Kontrakan</option>
                                         @foreach ($rents as $rent)
                                             <option value="{{ $rent->id }}"
                                                 {{ old('rent_id') == $rent->id ? 'selected' : '' }}>
                                                 {{ $rent->id }} - {{ $rent->nama_kontrakan }}
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
                                     <textarea class="form-control" id="inputComplaint" name="keluhan" rows="3">{{ old('keluhan') }}</textarea>
                                     @error('keluhan')
                                         <span class="text-danger">{{ $message }}</span>
                                     @enderror
                                 </div>

                                   {{-- tgl keluhan --}}
                                      <div class="col-md-8 offset-md-2">
                                          <label for="validationDefault01" class="form-label">Tanggal Keluhan :</label>
                                          <input type="date" name="tgl_keluhan" class="form-control"
                                              id="validationDefault01" value="{{ old('tgl_keluhan') }}">
                                          <div class="col-lg-7" style="margin-top:10px;">
                                              @if ($errors->has('tgl_keluhan'))
                                                  <div class="alert alert-danger alert-dismissible fade show"
                                                      role="alert">
                                                      {{ $errors->first('tgl_keluhan') }}
                                                      <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                          aria-label="Close"></button>
                                                  </div>
                                              @endif
                                          </div>
                                      </div>

                                 {{-- gambar_keluhan --}}
                                 <div class="col-md-8 offset-md-2">
                                     <label for="inputImage" class="form-label">Foto Keluhan</label>
                                     <div class="col-sm-10"
                                         style="max-width: 400px; max-height: 600px; width: auto; height: auto;">
                                         <img src="" class="img-thumbnail d-none" id="previewKELUHANimg">
                                     </div>
                                     <div class="col-sm-12">
                                         <div class="custom-file">
                                             <input type="file" name="gambar_keluhan"
                                                 class="custom-file-input @error('gambar_keluhan') is-invalid @enderror"
                                                 id="gambarKELUHAN">
                                             @error('gambar_keluhan')
                                                 <div class="invalid-feedback">{{ $message }}</div>
                                             @enderror
                                         </div>
                                     </div>
                                 </div>

                                 {{-- Status Keluhan --}}
                                 <div class="col-md-8 offset-md-2">
                                     @if (auth()->user()->role_id == 1)
                                     <label class="form-label">Status Keluhan</label>
                                         <div class="form-check">
                                             <input class="form-check-input" type="radio" name="status_keluhan"
                                                 id="status1" value="Sudah Divalidasi"
                                                 {{ old('status_keluhan') == 'Sudah Divalidasi' ? 'checked' : '' }}>
                                             <label class="form-check-label" for="status1">
                                                 Sudah Divalidasi
                                             </label>
                                         </div>
                                         <div class="form-check">
                                             <input class="form-check-input" type="radio" name="status_keluhan"
                                                 id="status2" value="Belum Divalidasi"
                                                 {{ old('status_keluhan') == 'Belum Divalidasi' ? 'checked' : '' }}>
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

                                 {{-- Submit button --}}
                                 <div class="text-center">
                                     <button type="submit" class="btn btn-success">
                                         <i class="bi bi-person-plus"></i> Tambah Data
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
