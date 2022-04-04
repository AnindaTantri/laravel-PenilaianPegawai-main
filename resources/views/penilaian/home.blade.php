@extends('layouts.employee.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Content types -->
    <div class="card mb-4">
        <div class="d-flex align-items-end row">
            <div class="col-sm-7">
                <div class="card-body">
                    <h5 class="card-title text-primary">Selamat Datang Pegawai Kesekretariatan Presiden! 🎉</h5>
                    <p class="mb-1">
                        Selamat untuk Anda yang masuk ke leaderboard minggu ini. Tingkatkan terus kinerja Anda...
                    </p>
                    <p>Untuk melakukan penilaian antar pegawai, Anda bisa memilih penugasan yang sesuai dengan yang
                        sudah Anda lakukan.</p>
                </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                    <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}"
                        height="140" alt="View Badge User" />
                </div>
            </div>
        </div>
    </div>

    <h4 class="mt-4 mb-3">LeaderBoard</h4>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">Top 5 Pegawai Laki-Laki</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <caption class="ms-4">
                            {{ date('F Y') }}
                        </caption>
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $rankMale = 1
                            @endphp
                            @foreach ($male as $m)   
                                <tr>
                                    <td>{{ $rankMale++ }}</td>
                                    <td><strong>{{ $m->nama }}</strong></td>
                                    <td class="text-uppercase">{{ $m->jabatan }}</td>
                                    <td class="text-uppercase">{{ $m->status }}</td>
                                    <td class="text-center">{{ round($m->total, 1) }} / 5</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">Top 5 Pegawai Perempuan</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <caption class="ms-4">
                            {{ date('F Y') }}
                        </caption>
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $rankFemale = 1
                            @endphp
                            @foreach ($female as $f)   
                                <tr>
                                    <td>{{ $rankFemale++ }}</td>
                                    <td><strong>{{ $f->nama }}</strong></td>
                                    <td class="text-uppercase">{{ $f->jabatan }}</td>
                                    <td class="text-uppercase">{{ $f->status }}</td>
                                    <td class="text-center">{{ round($f->total, 1) }} / 5</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mt-4 mb-1">Penilaian Pegawai</h4>
    <p class="mb-3">Silahkan pilih penugasan yang sudah Anda lakukan</p>

    <div class="row mb-5">
        @foreach($penugasan as $tugas)
            <div class="col-md-6 col-lg-4">
                <div class="card mb-3" style="height: 179px">
                    <div class="card-body">
                        <h5 class="card-title">{{ $tugas->nama }}</h5>
                        <p class="card-text" style="height: 44px">
                            Penugasan 
                            <span class="text-capitalize">{{ $tugas->kategori }}</span> 
                            di 
                            <span class="text-capitalize">{{ $tugas->jenis }}</span> 
                            pada {{ date('d F Y', strtotime($tugas->tanggal)) }}
                        </p>
                        <a href="{{ route('penilaian.create', $tugas->id) }}" class="btn btn-primary">Beri Penilaian</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
