@extends('layout.main')

@section('title', 'PRINT LAPORAN BULANAN')

@section('container')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>PRINT DATA LAPORAN TRANSAKSI</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('dashboard.laporan_transaksi.index') }}">Data Laporan Transaksi</a></li>
          <li class="breadcrumb-item active">Print Data Laporan Transaksi</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="row">
            <div class="col-sm-8">
              @if (session('status'))
                <div class="alert alert-success" style="text-align: center; font-size:20px;">
                  {{ session('status') }}
                </div>
              @endif
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <form action="#" class="form-row" id="formLaporan" method="POST">
                @csrf
                <h3 style="text-align:center; margin:10px">
                  PRINT LAPORAN TRANSAKSI BULANAN
                </h3>
                <div class="col-md-10 mx-auto" style="margin:10px">
                  <div class="form-group">
                    <label for="tglAwal">Tanggal Awal <span class="text-red">*</span>:</label>
                    <input type="date" name="tgl_awal" id="tglAwal" class="form-control">
                  </div>
                  @error('tgl_awal')
                    <span style="color:red;">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-md-10 mx-auto" style="margin:10px">
                  <div class="form-group">
                    <label for="tglAkhir">Tanggal Akhir <span class="text-red">*</span>:</label>
                    <input type="date" name="tgl_akhir" id="tglAkhir" class="form-control">
                  </div>
                  @error('tgl_akhir')
                    <span style="color:red;">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-md-7 mx-auto" style="margin:10px">
                  <button type="submit" class="btn btn-danger col-md-12" style="font-size:20px" id="submitBtn">
                    <i class="bi bi-printer"></i> Cetak Laporan Pertanggal
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

@endsection

@push('addon-script')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
      const form = $("#formLaporan");

      function submit(e) {
          e.preventDefault();
          const tglAwal = $('#tglAwal').val();
          const tglAkhir = $('#tglAkhir').val();

          if (!tglAwal || !tglAkhir) {
              Swal.fire(
                  'Error',
                  'Tanggal awal dan tanggal akhir harus diisi!',
                  'error'
              );
              return;
          }

          Swal.fire({
              title: 'Apakah Anda yakin?',
              text: `Ingin mencetak laporan dari tanggal ${tglAwal} sampai ${tglAkhir}?`,
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, Cetak!',
              cancelButtonText: 'Batal'
          }).then((result) => {
              if (result.isConfirmed) {
                  let url = "{{ route('dashboard.laporan_transaksi.print-data-laporan-pertanggal') }}";
                  const formData = new FormData();
                  formData.append('tgl_awal', tglAwal);
                  formData.append('tgl_akhir', tglAkhir);
                  formData.append('_token', '{{ csrf_token() }}');

                  // Debug URL and Form Data
                  console.log('Requesting URL:', url);
                  console.log('Form Data:', Object.fromEntries(formData));

                  // Mengirim permintaan fetch untuk menghasilkan dan mengunduh PDF
                  fetch(url, {
                      method: 'POST',
                      body: formData
                  })
                  .then(response => {
                      // Debug response status
                      console.log('Response Status:', response.status);
                      if (!response.ok) {
                          throw new Error('Gagal membuat PDF.');
                      }
                      return response.blob();
                  })
                  .then(blob => {
                      const downloadUrl = window.URL.createObjectURL(blob);
                      const link = document.createElement('a');
                      const fileName = `laporan_transaksi_${tglAwal}_sampai_${tglAkhir}.pdf`;
                      link.href = downloadUrl;
                      link.setAttribute('download', fileName);
                      document.body.appendChild(link);
                      link.click();
                      document.body.removeChild(link);
                      
                      Swal.fire(
                          'Berhasil',
                          'Laporan transaksi sudah dicetak!',
                          'success'
                      );
                  })
                  .catch(error => {
                      console.error('Error:', error);
                      Swal.fire(
                          'Error',
                          'Gagal mencetak laporan transaksi.',
                          'error'
                      );
                  });
              }
          });
      }

      $('#submitBtn').on("click", submit);
  </script>
@endpush
