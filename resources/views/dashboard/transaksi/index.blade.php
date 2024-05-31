@extends('layout.main')

@section('title', 'DATA TRANSAKSI')

@section('container')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Kelola Transaksi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Transaksi</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <div class=" row">
                            <div class="col-sm-8">
                                @if (session('status'))
                                    <div class="alert alert-success" style="text-align: center; font-size:20px;">
                                        {{ session('status') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Data <span>| Transaksi</span></h5>
                                    {{-- Tombol Edit --}}
                                    @can('transaksi_create')
                                        <div class="btn_tambah">
                                            <a href="{{ route('dashboard.transactions.create') }}" class="btn btn-success">
                                                 <i class="bi bi-person-plus"></i>
                                                Tambah Data
                                            </a>
                                        </div>
                                    @endcan
                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Penghuni</th>
                                                <th scope="col">Nama Kontrakan</th>
                                                <th scope="col">Tgl Transaksi</th>
                                                <th scope="col">Status Transaksi</th>
                                                <th scope="col">Total Bayar</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transactions as $transaksi)
                                                @if (auth()->user()->role_id == 1 || auth()->user()->name == $transaksi->user?->name)
                                                    <tr>
                                                        <td scope="row">{{ $loop->iteration }}</td>
                                                        <td>{{ $transaksi->user?->name }}</td>
                                                        <td>{{ $transaksi->rent?->nama_kontrakan }}</td>
                                                        <td>{{ $transaksi->tgl_transaksi }}</td>
                                                        <td>
                                                            @if ($transaksi->status_transaksi == 'Sudah Divalidasi')
                                                                <button type="button"
                                                                    class="btn btn-success">{{ $transaksi->status_transaksi }}</button>
                                                            @elseif ($transaksi->status_transaksi == 'Belum Divalidasi')
                                                                <button type="button"
                                                                    class="btn btn-danger">{{ $transaksi->status_transaksi }}</button>
                                                            @endif
                                                        </td>
                                                        <td>{{ $transaksi->total_harga }}</td>
                                                        <td>
                                                            <div class="button-container">
                                                                {{-- Tombol Edit --}}
                                                                @can('transaksi_edit')
                                                                    <a
                                                                        href="{{ route('dashboard.transactions.edit', $transaksi->id) }}">
                                                                        <button type="button" class="btn btn-warning">
                                                                            <i class="bi bi-pencil-square"></i>
                                                                            EDIT
                                                                        </button>
                                                                    </a>
                                                                @endcan
                                                                @can('transaksi_show')
                                                                    <a
                                                                        href="{{ route('dashboard.transactions.show', $transaksi->id) }}">
                                                                        <button type="button" class="btn btn-primary">
                                                                            <i class="bi bi-eye"></i>
                                                                            DETAIL
                                                                        </button>
                                                                    </a>
                                                                @endcan

                                                                {{-- Tombol Print --}}
                                                                @can('transaksi_print')
                                                                    @if ($transaksi->status_transaksi == 'Sudah Divalidasi')
                                                                        <button type="button" class="btn btn-danger"
                                                                            onclick="printTransaction('{{ route('dashboard.transaction.print', $transaksi->id) }}', '{{ $transaksi->user->name }}')">
                                                                            <i class="bi bi-printer"></i>
                                                                            PRINT
                                                                        </button>
                                                                    @elseif ($transaksi->status_transaksi == 'Belum Divalidasi')
                                                                    @endif
                                                                    @endcan
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">No data available</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!-- End Recent Sales -->


                    </div>
                </div><!-- End Left side columns -->

            </div>
        </section>
    </main><!-- End #main -->

@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      function printTransaction(url, namaUser) {
    event.preventDefault(); // Prevent default event

    Swal.fire({
        title: 'Apakah Anda yakin?',
        html: '<p style="font-size: 14px;">Ingin Print Transaksi Atas Nama <br><strong>' + namaUser + '</strong></p>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Print!',
        cancelButtonText: 'Tidak, Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch PDF.');
                }
                return response.blob();
            })
            .then(blob => {
                const downloadUrl = window.URL.createObjectURL(blob);
                const link = document.createElement('a');
                const fileName = 'Kwitansi_' + namaUser.replace(/ /g, '_') + '.pdf';
                link.href = downloadUrl;
                link.setAttribute('download', fileName);
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                Swal.fire(
                    'Print Berhasil',
                    'Data transaksi sudah di print!',
                    'success'
                );
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire(
                    'Error',
                    'Gagal mencetak transaksi.',
                    'error'
                );
            });
        }
    });
}

    </script>
@endpush
