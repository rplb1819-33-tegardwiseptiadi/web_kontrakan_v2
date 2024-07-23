@extends('layout.main')

@section('title', 'DATA LAPORAN TRANSAKSI')

@section('container')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Laporan Transaksi Bulanan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Laporan Transaksi</li>
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
                                    <div class="btn_print">
                                        <a href="{{ route('dashboard.laporan_transaksi.print-laporan-form') }}"
                                            class="btn btn-danger">
                                            <i class="bi bi-printer"></i>
                                            Print Data
                                        </a>

                                    </div>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Penghuni</th>
                                                <th scope="col">Tgl Transaksi</th>
                                                <th scope="col">Status Transaksi</th>
                                                <th scope="col">Nama Kontrakan</th>
                                                <th scope="col">Tipe Kontrakan</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Lama Sewa</th>
                                                <th scope="col">Total Harga</th>
                                                <th scope="col">Total Bayar</th>
                                                <th scope="col">Kembalian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transactions as $transaksi)
                                                <tr>
                                                    <td scope="row">{{ $loop->iteration }}</td>
                                                    <td>{{ $transaksi->user?->name }}</td>
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
                                                    <td>{{ $transaksi->rent?->nama_kontrakan }}</td>
                                                    <td>{{ $transaksi->rent?->tipe_kontrakan }}</td>
                                                    <td> Rp{{ number_format($transaksi->rent?->harga_kontrakan, 2, ',', '.') }}
                                                    </td>

                                                    @if ($transaksi->rent->tipe_kontrakan == 'Bulanan')
                                                        <td>{{ $transaksi->jml_sewa_bulan }} Bulan</td>
                                                    @endif
                                                    @if ($transaksi->rent->tipe_kontrakan == 'Tahunan')
                                                        <td>{{ $transaksi->jml_sewa_bulan }} Tahun</td>
                                                    @endif

                                                    <td> Rp{{ number_format($transaksi->total_harga, 2, ',', '.') }}
                                                    </td>
                                                    <td> Rp{{ number_format($transaksi->total_bayar, 2, ',', '.') }}
                                                    </td>
                                                    <td> Rp{{ number_format($transaksi->kembalian, 2, ',', '.') }}
                                                    </td>

                                                </tr>
                                            @empty
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
