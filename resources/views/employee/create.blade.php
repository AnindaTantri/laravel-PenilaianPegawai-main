@extends('layouts.admin.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="{{ route('employees.index') }}"
            class="text-muted fw-light">Data Pegawai</a> <span class="text-muted fw-light">/</span> Tambah Pegawai</h4>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tambah Pegawai Baru</h5>
            <small class="text-muted float-end">Fill this form to add new employee</small>
        </div>
        <div class="card-body">
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="nama">Nama Pegawai</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Employee name"
                            required />
                    </div>
                    <div class="col">
                        <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option selected disabled>Choose gender...</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="jabatan">Jabatan</label>
                        <select class="form-select" id="jabatan" name="jabatan" required>
                            <option selected disabled>Choose position...</option>
                            <option value="dantim">Dantim</option>
                            <option value="personil">Personil</option>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label" for="status">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option selected disabled>Choose status...</option>
                            <option value="asn">ASN</option>
                            <option value="outsourching">Outsourching</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="jumlah_dinas">Jumlah Dinas</label>
                        <input class="form-control" type="number" id="jumlah_dinas" name="jumlah_dinas" value="0">
                    </div>
                    <div class="col">
                        <label class="form-label" for="nilai_dinas">Nilai Dinas</label>
                        <input class="form-control" type="number" id="nilai_dinas" name="nilai_dinas" value="0">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="administrasi">Administrasi Setelah Dinas</label>
                        <select class="form-select" id="administrasi" name="administrasi">
                            <option selected disabled>Choose...</option>
                            <option value="sudah">Sudah</option>
                            <option value="belum">Belum</option>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label" for="kekuatan">Kekuatan</label>
                        <select class="form-select" id="kekuatan" name="kekuatan">
                            <option selected disabled>Choose difficult level...</option>
                            <option value="mudah">Mudah</option>
                            <option value="sedang">Sedang</option>
                            <option value="sulit">Sulit</option>
                        </select>
                    </div>
                </div>
                <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
