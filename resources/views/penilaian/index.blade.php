@extends('layouts.admin.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Penilaian Pegawai</h4>
    <div class="card">
        <div class="card-header"></div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Nama Pegawai</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>Total Nilai</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($pegawai as $item)
                        <tr>
                            <td><strong>{{ $item->nama }}</strong></td>
                            <td class="text-capitalize">{{ $item->jabatan }}</td>
                            <td class="text-uppercase">{{ $item->status }}</td>
                            <td>{{ round($item->total, 1) }} / 5</td>
                            <td>
                                <a href="{{ route('penilaian.show', $item->id) }}">
                                    <i class="bx bx-detail me-1"></i>Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
