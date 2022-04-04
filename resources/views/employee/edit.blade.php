@extends('layouts.admin.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="{{ route('employees.index') }}"
            class="text-muted fw-light">Data Pegawai</a> <span class="text-muted fw-light">/</span> Edit Pegawai</h4>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Edit Pegawai</h5>
            <small class="text-muted float-end">Fill this form to edit employee</small>
        </div>
        <div class="card-body">
            <form action="{{ route('employees.update', $pegawai->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-4">
                    <div class="col">
                        <label class="form-label" for="nama">Nama Pegawai</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Employee name" value="{{ $pegawai->nama }}"
                            required />
                    </div>
                    <div class="col">
                        <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option disabled>Choose gender...</option>
                            <option value="L" {{ $pegawai->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $pegawai->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="jabatan">Jabatan</label>
                        <select class="form-select" id="jabatan" name="jabatan" required>
                            <option disabled>Choose position...</option>
                            <option value="dantim" {{ $pegawai->jabatan == 'dantim' ? 'selected' : '' }}>Dantim</option>
                            <option value="personil" {{ $pegawai->jabatan == 'personil' ? 'selected' : '' }}>Personil</option>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label" for="status">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option disabled>Choose status...</option>
                            <option value="asn" {{ $pegawai->status == 'asn' ? 'selected' : '' }}>ASN</option>
                            <option value="outsourching" {{ $pegawai->status == 'outsourching' ? 'selected' : '' }}>Outsourching</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="jumlah_dinas">Jumlah Dinas</label>
                        <input class="form-control" type="number" id="jumlah_dinas" name="jumlah_dinas" value="{{ $pegawai->jumlah_dinas }}">
                    </div>
                    <div class="col">
                        <label class="form-label" for="nilai_dinas">Nilai Dinas</label>
                        <input class="form-control" type="number" id="nilai_dinas" name="nilai_dinas" value="{{ $pegawai->nilai_dinas }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="administrasi">Administrasi Setelah Dinas</label>
                        <select class="form-select" id="administrasi" name="administrasi">
                            <option disabled>Choose...</option>
                            <option value="sudah" {{ $pegawai->administrasi == 'sudah' ? 'selected' : '' }}>Sudah</option>
                            <option value="belum" {{ $pegawai->administrasi == 'belum' ? 'selected' : '' }}>Belum</option>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label" for="kekuatan">Kekuatan</label>
                        <select class="form-select" id="kekuatan" name="kekuatan">
                            <option disabled>Choose difficult level...</option>
                            <option value="mudah" {{ $pegawai->kekuatan == 'mudah' ? 'selected' : '' }}>Mudah</option>
                            <option value="sedang" {{ $pegawai->kekuatan == 'sedang' ? 'selected' : '' }}>Sedang</option>
                            <option value="sulit" {{ $pegawai->kekuatan == 'sulit' ? 'selected' : '' }}>Sulit</option>
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
