@extends('layout.main')

@section('title', 'DATA KELUHAN')

@section('container')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Kelola Keluhan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Keluhan</li>
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
                                    <h5 class="card-title">Data <span>| Keluhan</span></h5>

                                    {{-- Tombol Tambah --}}
                                    @can('keluhan_create')
                                        <div class="btn_tambah">
                                            <a href="{{ route('dashboard.complaints.create') }}" class="btn btn-success">
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
                                                <th scope="col">Keluhan</th> 
                                                <th scope="col">Status Keluhan</th> 
                                                <th scope="col">Aksi</th>
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
                                                    <!-- <td><span class="badge bg-success">Approved</span></td> -->
                                                    <td>
                                                        <div class="button-container">
                                                            {{-- Tombol Edit --}}
                                                            @can('keluhan_edit')
                                                                <a href="{{ route('dashboard.complaints.edit', $keluhan->id) }}">
                                                                    <button type="button" class="btn btn-warning ">
                                                                        <i class="bi bi-pencil-square"></i>
                                                                        EDIT
                                                                    </button>
                                                                </a>
                                                            @endcan
                                                            {{-- Tombol Detail --}}
                                                            @can('keluhan_show')
                                                                <a href="{{ route('dashboard.complaints.show', $keluhan->id) }}">
                                                                    <button type="button" class="btn btn-primary ">
                                                                        <i class="bi bi-eye"></i>
                                                                        DETAIL
                                                                    </button>
                                                                </a>
                                                            @endcan
                                                            {{-- Tombol Hapus --}}
                                                            @can('keluhan_delete')
                                                                <form
                                                                    action="{{ route('dashboard.complaints.destroy', $keluhan->id) }}"
                                                                    method="POST" style="display: inline;"
                                                                    id="delete-form-{{ $keluhan->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-name="{{ $keluhan->user?->name }}"
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
        @include('includes.scriptsComplaint')
    </main><!-- End #main -->

@endsection
