@extends('layout.main')

@section('title', 'DATA KONTRAKAN')

@section('container')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Kelola Kontrakan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kontrakan</li>
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
                                    <h5 class="card-title">Data <span>| Kontrakan</span></h5>

                                    {{-- Tombol Tambah --}}
                                    @can('kontrakan_create')
                                        <div class="btn_tambah">
                                            <a href="{{ route('dashboard.rents.create') }}" class="btn btn-success">
                                                <i class="bi bi-person-plus"></i>
                                                Tambah Data
                                            </a>
                                        </div>
                                    @endcan

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Kontrakan</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Status Kontrakan</th>
                                                <th scope="col">Kapasitas</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($rents as $kontrakan)
                                                <tr>
                                                    <td scope="row">{{ $loop->iteration }}</td>
                                                    <td>{{ $kontrakan->nama_kontrakan }}</td>
                                                    <td>Rp {{ number_format($kontrakan->harga_kontrakan, 2, ',', '.') }}</td>
                                                    <td>
                                                        @if ($kontrakan->status_kontrakan == 'Kosong')
                                                            <button type="button"
                                                                class="btn btn-success">{{ $kontrakan->status_kontrakan }}</button>
                                                        @elseif ($kontrakan->status_kontrakan == 'Penuh')
                                                            <button type="button"
                                                                class="btn btn-danger">{{ $kontrakan->status_kontrakan }}</button>
                                                        @elseif ($kontrakan->status_kontrakan == 'Booking')
                                                            <button type="button"
                                                                class="btn btn-warning">{{ $kontrakan->status_kontrakan }}</button>
                                                        @elseif ($kontrakan->status_kontrakan == 'Diperbaiki')
                                                            <button type="button"
                                                                class="btn btn-dark">{{ $kontrakan->status_kontrakan }}</button>
                                                        @endif
                                                    </td>
                                                    <td>{{ $kontrakan->kapasitas_kontrakan }} Orang</td>
                                                    <!-- <td><span class="badge bg-success">Approved</span></td> -->
                                                    <td>
                                                        <div class="button-container">
                                                            {{-- Tombol Edit --}}
                                                            @can('kontrakan_edit')
                                                                <a href="{{ route('dashboard.rents.edit', $kontrakan->id) }}">
                                                                    <button type="button" class="btn btn-warning ">
                                                                        <i class="bi bi-pencil-square"></i>
                                                                        EDIT
                                                                    </button>
                                                                </a>
                                                            @endcan
                                                            {{-- Tombol Detail --}}
                                                            @can('kontrakan_show')
                                                                <a href="{{ route('dashboard.rents.show', $kontrakan->id) }}">
                                                                    <button type="button" class="btn btn-primary ">
                                                                        <i class="bi bi-eye"></i>
                                                                        DETAIL
                                                                    </button>
                                                                </a>
                                                            @endcan
                                                            {{-- Tombol Hapus --}}
                                                            @can('kontrakan_delete')
                                                                <form
                                                                    action="{{ route('dashboard.rents.destroy', $kontrakan->id) }}"
                                                                    method="POST" style="display: inline;"
                                                                    id="delete-form-{{ $kontrakan->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-name="{{ $kontrakan->nama_kontrakan }}"
                                                                        onclick="confirmDelete(this)">
                                                                        <i class="bi bi-trash3"></i>
                                                                        HAPUS
                                                                    </button>
                                                                </form>
                                                            @endcan
                                                        </div>
                                </div>
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

        {{-- kode alert kontrakan --}}
        @include('includes.scriptsRent')
    </main><!-- End #main -->

@endsection
