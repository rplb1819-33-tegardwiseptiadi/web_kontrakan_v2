@extends('layout.main')

@section('title', 'HOME PAGE')

@section('container')


    <main id="main" class="main">
        {{-- // Dalam controller atau view
        @php
            dd(Auth::user()->role->id);
        @endphp --}}


        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- User Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Users <span>| Total</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>145</h6>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End User Card -->

                        <!-- Kontrakan Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Rents<span>| Total</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-house"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>145</h6>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Kontrakan Card -->

                        <!-- Transaksi Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Transactions <span>| Total</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>$3,264</h6>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Transaksi Card -->

                        <!-- Keluhan Card -->
                        <div class="col-xxl-4 col-xl-6">
                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">Complaints <span>| This Year</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>1244</h6>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div><!-- End Keluhan Card -->

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-12">

                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Data <span>| Riwayat Keluhan</span></h5>
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Penghuni</th>
                                        <th scope="col">Nama Kontrakan</th>
                                        <th scope="col">Keluhan</th>
                                        <th scope="col">Status Keluhan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($complaints as $keluhan)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $keluhan->user?->name }}</td>
                                            <td>{{ $keluhan->rent?->nama_kontrakan }}</td>
                                            <td>{{ $keluhan->keluhan }}</td>
                                            <td>
                                                @if ($keluhan->status_keluhan == 'Sudah Divalidasi')
                                                    <button type="button"
                                                        class="btn btn-success">{{ $keluhan->status_keluhan }}</button>
                                                @elseif ($keluhan->status_keluhan == 'Belum Divalidasi')
                                                    <button type="button"
                                                        class="btn btn-danger">{{ $keluhan->status_keluhan }}</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>

                        </div>

                    </div>

                </div><!-- End Right side columns -->

            </div>
        </section>

    </main><!-- End #main -->

@endsection
