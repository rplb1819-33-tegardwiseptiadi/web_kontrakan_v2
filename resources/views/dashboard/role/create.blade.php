@extends('layout.main')

@section('title', 'TAMBAH DATA PERAN USER')

@section('container')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Tambah Peran User</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.roles.index') }}">Peran User</a></li>
                    <li class="breadcrumb-item active">Tambah Peran User</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center;">INPUT DATA PERAN USER</h5>

                            <form class="row g-3" id="roleForm" action="{{ route('dashboard.roles.store') }}"
                                method="POST">
                                @csrf
                                <div class="col-md-8 offset-md-2">
                                    <label for="validationDefault01" class="form-label">PERAN :</label>
                                    <input type="text" name="name" class="form-control" id="validationDefault01"
                                        placeholder="Isi Nama Peran">
                                    @if ($errors->has('name'))
                                        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                            {{ $errors->first('name') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-8 offset-md-2">
                                    <label for="inputState" class="form-label">HAK AKSES :</label>
                                    <select name="permissions[]" id="multipleSelect" multiple
                                        placeholder="Select Permissions" data-search="false"
                                        data-silent-initial-value-set="true">
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}">{{ $permission->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('permissions')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-6" style="margin-left: 30%;">
                                    <button class="btn btn-success" type="submit">
                                        <i class="bi bi-person-plus"></i>
                                        Tambah Data
                                    </button>
                                    <a class="btn btn-danger" href="{{ route('dashboard.roles.index') }}">
                                        <i class="bi bi-x-lg"></i>
                                        Kembali
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection

{{-- kode alert user --}}
@include('includes.scriptsRoles')
