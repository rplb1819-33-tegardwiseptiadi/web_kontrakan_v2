<!-- ini adalah konten dari halaman Dashboard Staff -->
<!-- biar bisa menggunakan templat dari folder layout dengan nama file main -->
@extends('layout.main')


<!-- ini adalah title dari halaman Dashboard Kontrakan -->
@section('title', 'DATA LOG ACTIVITY | KUYRAPC')

@section('container')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>DATA LOG ACTIVITY | KUYRAPC</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li> 
                    <li class="breadcrumb-item active">Aktivitas Log</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class=" row">
                        <div class="col-sm-5">
                            @if (session('status'))
                                <div class="alert alert-success" style="text-align: center; font-size:20px;">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">DATA LOG ACTIVITY</h5>


                            <div style=" overflow-x:auto;">

                                <!-- Table with stripped rows -->
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">User ID</th>
                                            <th scope="col">Nama User</th>
                                            <th scope="col">Nama Tabel</th>
                                            <th scope="col">No Tabel</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Waktu Di Tambah</th>
                                            <th scope="col">Waktu Di Ubah</th>
                                            <th scope="col">Waktu Di Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activitylog as $aktivitas)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td style="text-align: center;">ACT-{{ $aktivitas->id }}</td>
                                                <td style="text-align: center;">{{ $aktivitas->user_id }}</td>
                                                <td style="text-align: center;">{{ $aktivitas->user?->name }}</td>
                                                <td style="text-align: center;">{{ $aktivitas->tabel_referensi }}</td>
                                                <td style="text-align: center;">{{ $aktivitas->id_referensi }}</td>
                                                <td style="text-align: center;">{{ $aktivitas->deskripsi }}</td>
                                                <td style="text-align: center;">
                                                    @if ($aktivitas->created_at == '')
                                                        <button type="button" class="btn btn-danger">Waktu Ditambah Belum
                                                            Ada</button>
                                                    @else
                                                        <button type="button"
                                                            class="btn btn-success">{{ $aktivitas->created_at }}</button>
                                                    @endif
                                                </td>
                                                <td style="text-align: center;">
                                                    @if ($aktivitas->updated_at == '')
                                                        <button type="button" class="btn btn-danger">Waktu Diubah Belum
                                                            Ada</button>
                                                    @else
                                                        <button type="button"
                                                            class="btn btn-primary">{{ $aktivitas->updated_at }}</button>
                                                    @endif
                                                </td>
                                                <td style="text-align: center;">
                                                    @if ($aktivitas->deleted_at == '')
                                                        <button type="button" class="btn btn-danger">Waktu Dihapus Belum
                                                            Ada</button>
                                                    @else
                                                        <button type="button"
                                                            class="btn btn-warning">{{ $aktivitas->deleted_at }}</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section> 
    </main><!-- End #main -->

@endsection
