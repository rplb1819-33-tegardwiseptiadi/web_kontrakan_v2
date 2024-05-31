@extends('layout.main')

@section('title', 'DATA PENGHUNI')

@section('container')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Kelola Penghuni</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Penghuni</li>
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
                                    <h5 class="card-title">Data <span>| Penghuni</span></h5>
                                    <div class="btn_tambah">
                                        <a href="{{ route('dashboard.occupants.create') }}" class="btn btn-success">
                                            Tambah Data
                                        </a>

                                    </div>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Umur</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($occupants as $penghuni)
                                                <tr>
                                                    <td scope="row">{{ $loop->iteration }}</td>
                                                    <td>{{ $penghuni->nama_penghuni }}</td>
                                                    <td> {{ $penghuni->umur_penghuni }} Tahun
                                                    </td>
                                                    <td>
                                                        @if ($penghuni->status_penghuni == 'Sudah Menikah')
                                                            <button type="button"
                                                                class="btn btn-success">{{ $penghuni->status_penghuni }}</button>
                                                        @elseif ($penghuni->status_penghuni == 'Belum Menikah')
                                                            <button type="button"
                                                                class="btn btn-primary">{{ $penghuni->status_penghuni }}</button>
                                                        @endif
                                                    </td>

                                                    <!-- <td><span class="badge bg-success">Approved</span></td> -->
                                                    <td>
                                                        <div class="button-container">
                                                            <a href="{{ route('dashboard.occupants.edit', $penghuni->id) }}">
                                                                <button type="button" class="btn btn-warning ">
                                                                    <i class="bi bi-pencil-square"></i>
                                                                    EDIT
                                                                </button>
                                                            </a>
                                                            <a href="{{ route('dashboard.occupants.show', $penghuni->id) }}">
                                                                <button type="button" class="btn btn-primary ">
                                                                    <i class="bi bi-eye"></i>
                                                                    DETAIL
                                                                </button>
                                                            </a>
                                                            <form
                                                                action="{{ route('dashboard.occupants.destroy', $penghuni->id) }}"
                                                                method="POST" style="display: inline;"
                                                                id="delete-form-{{ $penghuni->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-danger"
                                                                    data-name="{{ $penghuni->nama_penghuni }}"
                                                                    onclick="confirmDelete(this)">
                                                                    <i class="bi bi-trash3"></i>
                                                                    HAPUS
                                                                </button>
                                                            </form>
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
     </main><!-- End #main -->

@endsection


@push('addon-script')
    {{-- kode alert penghuni --}}
    @include('includes.scriptsOccupant')
@endpush
