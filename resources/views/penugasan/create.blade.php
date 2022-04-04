@extends('layouts.admin.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="{{ route('penugasan.index') }}"
            class="text-muted fw-light">Data Penugasan</a> <span class="text-muted fw-light">/</span> Tambah Penugasan
    </h4>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tambah Penugasan Baru</h5>
            <small class="text-muted float-end">Fill this form to add new duty</small>
        </div>
        <div class="card-body">
            <form action="{{ route('penugasan.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="jenis">Jenis Penugasan</label>
                        <select class="form-select" id="jenis" name="jenis" onchange="pilihKategori()" required>
                            <option selected disabled>Choose type of duty...</option>
                            <option value="dinas harian">Dinas Harian</option>
                            <option value="dalam kota">Dalam Kota</option>
                            <option value="luar kota">Luar Kota</option>
                            <option value="luar negeri">Luar Negeri</option>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label" for="kategori">Kategori Penugasan</label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <option selected disabled>Choose category of duty...</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="nama">Nama Penugasan</label>
                    <input class="form-control" type="text" id="nama" name="nama" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="tanggal">Tanggal Penugasan</label>
                    <input class="form-control" type="date" id="tanggal" name="tanggal" required>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="jumlah_asn">Jumlah ASN</label>
                        <input class="form-control" type="number" id="jumlah_asn" name="jumlah_asn">
                    </div>
                    <div class="col">
                        <label class="form-label" for="jumlah_outsourching">Jumlah Outsourching</label>
                        <input class="form-control" type="number" id="jumlah_outsourching" name="jumlah_outsourching">
                    </div>
                    <div class="col">
                        <label class="form-label" for="jumlah_titik_acara">Jumlah Titik Acara</label>
                        <input class="form-control" type="number" id="jumlah_titik_acara" name="jumlah_titik_acara">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="tingkat_kesulitan">Tingkat Kesulitan</label>
                    <select class="form-select" id="tingkat_kesulitan" name="tingkat_kesulitan">
                        <option selected disabled>Choose difficult level...</option>
                        <option value="mudah">Mudah</option>
                        <option value="sedang">Sedang</option>
                        <option value="susah">Susah</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label" for="pegawai">Pegawai</label>
                    <select class="form-select js-example-basic-multiple" multiple id="pegawai" name="pegawai[]">
                        <option disabled>Choose employee...</option>
                    </select>
                </div>
                <a href="{{ route('penugasan.index') }}" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });

    </script>

    <script>
        const pilihKategori = () => {
            let jenis = document.getElementById('jenis').value
            let kategori = document.getElementById('kategori')

            var options
            if (jenis === 'dalam kota') {
                options = ['Resmi', 'Non Resmi']
            } else if (jenis === 'luar kota' || jenis === 'luar negeri') {
                options = ['Tim Pendahulu', 'Tim Utama']
            } else {
                options = ['Dinas Harian']
            }
            var str = ""
            for (var opt of options) {
                str += "<option>" + opt + "</option>"
            }
            kategori.innerHTML = str;
        }

        $(document).on('change', '#tingkat_kesulitan', function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let tingkat = document.getElementById('tingkat_kesulitan').value
            let pegawai = document.getElementById('pegawai')

            $.ajax({
                type: 'GET',
                dataType: "json",
                url: '/pegawai/'+$('#tingkat_kesulitan').val(),
                success: function (data) {
                    var str = ""
                    for (var i = 0; i < data.length; i++) {
                        str += `<option value="${data[i].id}">${data[i].nama}</option>`
                    }
                    console.log(str)
                    pegawai.innerHTML = str
                },
                timeout: 10000
            });

        });

    </script>
@endpush
