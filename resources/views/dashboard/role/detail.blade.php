@extends('layout.main')

@section('title', 'DETAIL DATA PERAN USER')

@section('container')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Detail Akses User</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Transaksi</a></li>
                    <li class="breadcrumb-item active">Detail Akses User</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center;">DETAIL DATA PERAN USER</h5>

                            <div class="col-md-8 mt-2 offset-md-2">
                                <div class="col-md-10">
                                    <label for="inputEmail5" class="form-label">Nama Akses</label>
                                    <input type="text" name="status_penghuni" class="form-control" id="inputEmail5"
                                        value="{{ $role->name }}" readonly>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8 offset-md-1">
                                        <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama Akses</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($role->permissions()->get() as $izin)
                                                    <tr>
                                                        <td scope="row">{{ $loop->iteration }}</td>
                                                        <td> {{ $izin->title }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-6" style="margin-left: 50%;">
                                        <a class="btn btn-danger" href="{{ route('dashboard.roles.index') }}">
                                            <i class="bi bi-x-lg"></i>
                                            Kembali
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

@endsection
