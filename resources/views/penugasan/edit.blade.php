@extends('layouts.admin.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="{{ route('penugasan.index') }}"
            class="text-muted fw-light">Data Penugasan</a> <span class="text-muted fw-light">/</span> Edit Penugasan
    </h4>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Edit Penugasan</h5>
            <small class="text-muted float-end">Fill this form to edit a duty</small>
        </div>
        <div class="card-body">
            <form action="{{ route('penugasan.update', $penugasan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="jenis">Jenis Penugasan</label>
                        <select class="form-select" id="jenis" name="jenis" required onchange="pilihKategori(this.value)" onload="pilihKategori(this.value)">
                            <option disabled>Choose type of duty...</option>
                            <option value="dinas harian" {{ $penugasan->jenis == 'dinas harian' ? 'selected' : '' }}>Dinas Harian</option>
                            <option value="dalam kota" {{ $penugasan->jenis == 'dalam kota' ? 'selected' : '' }}>Dalam Kota</option>
                            <option value="luar kota" {{ $penugasan->jenis == 'luar kota' ? 'selected' : '' }}>Luar Kota</option>
                            <option value="luar negeri" {{ $penugasan->jenis == 'luar negeri' ? 'selected' : '' }}>Luar Negeri</option>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label" for="kategori">Kategori Penugasan</label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <option disabled>Choose category of duty...</option>
                            @if ($penugasan->jenis == 'dinas harian')
                                <option value="{{ $penugasan->kategori }}" selected>{{ $penugasan->kategori }}</option>
                            @elseif ($penugasan->jenis == 'dalam kota')
                                <option value="Resmi" {{ $penugasan->kategori == 'Resmi' ? 'selected' : '' }}>Resmi</option>
                                <option value="Non Resmi" {{ $penugasan->kategori == 'Non Resmi' ? 'selected' : '' }}>Non Resmi</option>
                            @elseif ($penugasan->jenis == 'luar kota' || $penugasan->jenis == 'luar negeri')
                                <option value="Tim Pendahulu" {{ $penugasan->kategori == 'Tim Pendahulu' ? 'selected' : '' }}>Tim Pendahulu</option>
                                <option value="Tim Utama" {{ $penugasan->kategori == 'Tim Utama' ? 'selected' : '' }}>Tim Utama</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="nama">Nama Penugasan</label>
                    <input class="form-control" type="text" id="nama" name="nama" value="{{ $penugasan->nama }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="tanggal">Tanggal Penugasan</label>
                    <input class="form-control" type="date" id="tanggal" name="tanggal" value="{{ $penugasan->tanggal }}" required>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="jumlah_asn">Jumlah ASN</label>
                        <input class="form-control" type="number" id="jumlah_asn" name="jumlah_asn" value="{{ $penugasan->jumlah_asn }}">
                    </div>
                    <div class="col">
                        <label class="form-label" for="jumlah_outsourching">Jumlah Outsourching</label>
                        <input class="form-control" type="number" id="jumlah_outsourching" name="jumlah_outsourching" value="{{ $penugasan->jumlah_outsourching }}">
                    </div>
                    <div class="col">
                        <label class="form-label" for="jumlah_titik_acara">Jumlah Titik Acara</label>
                        <input class="form-control" type="number" id="jumlah_titik_acara" name="jumlah_titik_acara" value="{{ $penugasan->jumlah_titik_acara }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="tingkat_kesulitan">Tingkat Kesulitan</label>
                    <select class="form-select" id="tingkat_kesulitan" name="tingkat_kesulitan">
                        <option disabled>Choose difficult level...</option>
                        <option value="mudah" {{ $penugasan->tingkat_kesulitan == 'mudah' ? 'selected' : '' }}>Mudah</option>
                        <option value="sedang" {{ $penugasan->tingkat_kesulitan == 'sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="susah" {{ $penugasan->tingkat_kesulitan == 'susah' ? 'selected' : '' }}>Sulit</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label" for="pegawai">Pegawai</label>
                    <select class="form-select js-example-basic-multiple" multiple id="pegawai" name="pegawai[]">
                        <option disabled>Choose employee...</option>
                        @foreach ($pegawai as $item)
                            <option value="{{ $item->id }}" 
                                @foreach ($penugasan->pegawai as $peg) 
                                    {{ $item->id == $peg->id ? 'selected' : '' }}    
                                @endforeach
                            >
                                {{ $item->nama }}
                            </option>
                        @endforeach
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
            console.log(str)
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
                    pegawai.innerHTML = str
                },
                timeout: 10000
            });

        });

    </script>
@endpush
