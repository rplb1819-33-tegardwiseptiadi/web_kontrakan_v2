  <!-- ini adalah konten dari halaman Dashboard Staff -->
  <!-- biar bisa menggunakan templat dari folder layout dengan nama file main -->
  @extends('layout.main')


  @section('title', 'TAMBAH TRANSAKSI')

  @section('container')

      <main id="main" class="main">

          <div class="pagetitle">
              <h1>Tambah Transaksi</h1>
              <nav>
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                      <li class="breadcrumb-item"><a href="{{ route('dashboard.transactions.index') }}">Transaksi</a></li>
                      <li class="breadcrumb-item active">Tambah Data Transaksi</li>
                  </ol>
              </nav>
          </div><!-- End Page Title -->

          <section class="section dashboard">
              <div class="row">
                  <!-- Left side columns -->
                  <div class="col-lg-12">
                      <div class="row">

                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title" style="text-align: center;">INPUT DATA TRANSAKSI</h5>
                                  <!-- Multi Columns Form -->
                                  <form class="row g-3" action="{{ route('dashboard.transactions.store') }}" method="POST"
                                      enctype="multipart/form-data">
                                      @csrf

                                      {{-- Nama Transaksi  --}}
                                      <div class="col-md-8 offset-md-2">
                                          <label for="selectNamaPenghuni" class="form-label">Transaksi Atas Nama
                                              :</label>
                                          @if (auth()->user()->role_id == 1)
                                              {{-- Tampilkan dropdown untuk memilih penghuni --}}
                                              <select id="selectNamaPenghuni" class="form-select" name="user_id">
                                                  <option selected value="">PILIH PENGHUNI</option>
                                                  @foreach ($users as $user)
                                                      <option value="{{ $user->id }}">
                                                          {{ $user->name }}
                                                      </option>
                                                  @endforeach
                                              </select>
                                          @elseif (auth()->user()->role_id == 2)
                                              {{-- Tampilkan input readonly untuk tipe kontrakan berdasarkan username yang login --}}
                                              <input type="text" class="form-control" value="{{ auth()->user()->name }}"
                                                  readonly>
                                              <input type="hidden" name="user_id" class="form-control"
                                                  value="{{ auth()->user()->id }}" readonly>

                                          @endif
                                          <div class="col-lg-7" style="margin-top:10px;">
                                              @if ($errors->has('user_id'))
                                                  <div class="alert alert-danger alert-dismissible fade show"
                                                      role="alert">
                                                      {{ $errors->first('user_id') }}
                                                      <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                          aria-label="Close"></button>
                                                  </div>
                                              @endif
                                          </div>
                                      </div>

                                      {{-- tgl transaksi --}}
                                      <div class="col-md-8 offset-md-2">
                                          <label for="validationDefault01" class="form-label">Tanggal Transaksi :</label>
                                          <input type="date" name="tgl_transaksi" class="form-control"
                                              id="validationDefault01" value="{{ old('tgl_transaksi') }}">
                                          <div class="col-lg-7" style="margin-top:10px;">
                                              @if ($errors->has('tgl_transaksi'))
                                                  <div class="alert alert-danger alert-dismissible fade show"
                                                      role="alert">
                                                      {{ $errors->first('tgl_transaksi') }}
                                                      <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                          aria-label="Close"></button>
                                                  </div>
                                              @endif
                                          </div>
                                      </div>
                                      {{-- Nama Kontrakan --}}
                                      <div class="col-md-8 offset-md-2">
                                          <label for="selectNamaKontrakan" class="form-label">Nama Kontrakan :</label>
                                          <select id="selectNamaKontrakan" class="form-select" name="rent_id">
                                              <option selected value="">PILIH KONTRAKAN</option>
                                              @if ($allFull)
                                                  <option disabled value="">KONTRAKAN TIDAK TERSEDIA (PENUH /
                                                      DIPERBAIKI / DIBOOKING)</option>
                                              @else
                                                  @foreach ($rents as $rent)
                                                      @if ($rent->status_kontrakan != 'Penuh')
                                                          <option value="{{ $rent->id }}">{{ $rent->nama_kontrakan }}
                                                          </option>
                                                      @endif
                                                  @endforeach
                                              @endif
                                          </select>
                                          <div class="col-lg-7" style="margin-top:10px;">
                                              @if ($errors->has('rent_id'))
                                                  <div class="alert alert-danger alert-dismissible fade show"
                                                      role="alert">
                                                      {{ $errors->first('rent_id') }}
                                                      <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                          aria-label="Close"></button>
                                                  </div>
                                              @endif
                                          </div>
                                      </div>

                                      {{-- Tipe Kontrakan --}}
                                      <div class="col-md-8 offset-md-2">
                                          <label for="labeljeniskontrakan" class="form-label">Tipe Kontrakan :</label>
                                          <input type="text" class="form-control" id="labeljeniskontrakan" readonly>
                                      </div>

                                      {{-- Harga Perbulan --}}
                                      <div class="col-md-8 offset-md-2">
                                          <label for="harga_perbulan" class="form-label">Harga (/Bulan) :</label>
                                          <input type="number" class="form-control" id="harga_perbulan"
                                              name="harga_perbulan" readonly value="('harga_perbulan') }}">
                                      </div>

                                      {{-- Lama Sewa (Bulan) --}}
                                      <div class="col-md-8 offset-md-2">
                                          <label for="jml_sewa_bulan" class="form-label">Lama Sewa (Bulan) :</label>
                                          <input type="number" name="jml_sewa_bulan" class="form-control"
                                              id="jml_sewa_bulan" value="{{ old('jml_sewa_bulan') }}">
                                          <div class="col-lg-7" style="margin-top:10px;">
                                              @if ($errors->has('jml_sewa_bulan'))
                                                  <div class="alert alert-danger alert-dismissible fade show"
                                                      role="alert">
                                                      {{ $errors->first('jml_sewa_bulan') }}
                                                      <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                          aria-label="Close"></button>
                                                  </div>
                                              @endif
                                          </div>
                                      </div>

                                      {{-- Total Harga --}}
                                      <div class="col-md-8 offset-md-2">
                                          <label for="total_harga" class="form-label">Total Harga :</label>
                                          <input type="number" name="total_harga" class="form-control" id="total_harga"
                                              readonly value="{{ old('total_harga') }}">
                                      </div>

                                      {{-- Input Uang Bayar Sewa --}}
                                      <div class="col-md-8 offset-md-2" id="input_uang_bayar">
                                          <label for="total_bayar" class="form-label">Input Uang Bayar :</label>
                                          <input type="number" name="total_bayar" class="form-control" id="total_bayar"
                                              value="{{ old('total_bayar') }}">
                                      </div>

                                      {{-- Kembalian --}}
                                      <div class="col-md-8 offset-md-2">
                                          <label for="kembalian" class="form-label">Kembalian :</label>
                                          <input type="number" name="kembalian" class="form-control" id="kembalian"
                                              readonly>
                                      </div>

                                      {{-- status transaksi --}}
                                      <div class="col-md-8 offset-md-2">
                                          <label class="pt-0 form-label">STATUS TRANSAKSI</label>

                                          @if (auth()->user()->role_id == 1)
                                              {{-- Tampilkan radio button untuk admin --}}
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="status_transaksi"
                                                      id="gridRadios1" value="Sudah Divalidasi" checked>
                                                  <label class="form-check-label" for="gridRadios1">
                                                      Sudah Divalidasi
                                                  </label>
                                              </div>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="status_transaksi"
                                                      id="gridRadios2" value="Belum Divalidasi">
                                                  <label class="form-check-label" for="gridRadios2">
                                                      Belum Divalidasi
                                                  </label>
                                              </div>
                                          @elseif (auth()->user()->role_id == 2)
                                              {{-- Tampilkan radio button untuk penghuni --}}
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="status_transaksi"
                                                      id="gridRadios2" value="Belum Divalidasi" checked>
                                                  <label class="form-check-label" for="gridRadios2">
                                                      Belum Divalidasi
                                                  </label>
                                              </div>
                                          @endif
                                      </div>


                                      <div class="col-md-8 offset-md-2">
                                          <label for="inputEmail5" class="form-label">Foto Transaksi</label>
                                          <div class="col-sm-8"
                                              style="max-width: 400px; max-height: 600px; width: auto; height: auto;">
                                              <img src="" class="img-thumbnail d-none" id="previewTRANSAKSIimg">
                                          </div>

                                          <div class="col-sm-8 offset-md-2">
                                              <div class="custom-file">
                                                  <input type="file" name="gambar_transaksi"
                                                      class="custom-file-input @error('gambar_transaksi') is-invalid @enderror"
                                                      id="gambarTRANSAKSI">
                                                  @error('gambar_transaksi')
                                                      <div class="invalid-feedback">{{ $message }}</div>
                                                  @enderror
                                              </div>
                                          </div>
                                      </div>

                                      <div class="col-6" style="margin-left: 30%;">
                                          <button class="btn btn-success" type="submit">
                                              <i class="bi bi-person-plus"></i>
                                              Tambah Data
                                          </button>
                                          <a class="btn btn-danger" href="{{ route('dashboard.transactions.index') }}">
                                              <i class="bi bi-x-lg"></i>
                                              Kembali
                                          </a>
                                      </div>

                                  </form><!-- End Multi Columns Form -->
                              </div>
                          </div>

                      </div>
                  </div>
              </div>
          </section>
      </main><!-- End #main -->
  @endsection

  <!-- Your HTML content here -->

  @push('addon-script')
      <script>
          $("#selectNamaKontrakan").on("change", function() {
              let idRent = $(this).val();
              $.ajax({
                  url: "", // Update this with the correct URL endpoint
                  data: {
                      id: idRent
                  },
                  dataType: "json",
                  success: function(data) {
                      console.log(data);
                      $("#labeljeniskontrakan").val(data.tipe_kontrakan);
                      $("#harga_perbulan").val(data.harga_kontrakan);
                      hitungTotalHarga();
                  },
                  error: function(xhr) {
                      console.log(xhr.responseJSON);
                  }
              });
          });

          // Your other JavaScript functions here
      </script>
      {{-- kode script dan alert Transaksi --}}
      @include('includes.scriptsTransaction')
  @endpush
