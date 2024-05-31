@extends('layout.main')

@section('title', 'DATA USER')

@section('container')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Kelola User</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">User</li>
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
                                    <h5 class="card-title">Data <span>| User</span></h5>

                                    {{-- Tombol Tambah --}}
                                    @can('kontrakan_create')
                                        <div class="btn_tambah">
                                            <a href="{{ route('dashboard.users.create') }}" class="btn btn-success">
                                                <i class="bi bi-person-plus"></i>
                                                Tambah Data
                                            </a>
                                        </div>
                                    @endcan

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama User</th>
                                                <th scope="col">Level User</th>
                                                <th scope="col">Email User</th>
                                                <th scope="col">Jenis Kelamin</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($users as $pengguna)
                                                <tr>
                                                    <td scope="row">{{ $loop->iteration }}</td>
                                                    <td>{{ $pengguna->name }}</td>
                                                    <td>{{ $pengguna->role->name }}</td>
                                                    <td>{{ $pengguna->email }}</td>
                                                    <td>
                                                        @if ($pengguna->jenis_kelamin == 'Pria')
                                                            <button type="button"
                                                                class="btn btn-success">{{ $pengguna->jenis_kelamin }}</button>
                                                        @elseif ($pengguna->jenis_kelamin == 'Wanita')
                                                            <button type="button"
                                                                class="btn btn-primary">{{ $pengguna->jenis_kelamin }}</button>
                                                        @endif
                                                    </td>
                                                    <!-- <td><span class="badge bg-success">Approved</span></td> -->
                                                    <td>
                                                        <div class="button-container">
                                                            {{-- Tombol Edit --}}
                                                            @can('user_edit')
                                                                <a href="{{ route('dashboard.users.edit', $pengguna->id) }}">
                                                                    <button type="button" class="btn btn-warning">
                                                                        <i class="bi bi-pencil-square"></i>
                                                                        EDIT
                                                                    </button>
                                                                </a>
                                                            @endcan
                                                            {{-- Tombol Detail --}}
                                                            @can('user_show')
                                                                <a href="{{ route('dashboard.users.show', $pengguna->id) }}">
                                                                    <button type="button" class="btn btn-primary">
                                                                        <i class="bi bi-eye"></i>
                                                                        DETAIL
                                                                    </button>
                                                                </a>
                                                            @endcan
                                                            {{-- Tombol Hapus --}}
                                                            @can('user_delete')
                                                                <form
                                                                    action="{{ route('dashboard.users.destroy', $pengguna->id) }}"
                                                                    method="POST" style="display: inline;"
                                                                    id="delete-form-{{ $pengguna->id }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-name="{{ $pengguna->name }}"
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

    </main><!-- End #main -->

@endsection 

@push('addon-script')
{{-- kode sweetalert tombol delete  user --}}
<script>
    function confirmDelete(button) {
        var form = button.closest('form');
        var name = button.getAttribute('data-name');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            html: `<p style="font-size: 14px;">Anda akan menghapus data peran user <br> bernama <strong>${name}</strong>.</p>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            customClass: {
                title: 'swal-title-custom',
                htmlContainer: 'swal-html-custom'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>

