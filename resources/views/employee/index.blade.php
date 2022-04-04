@extends('layouts.admin.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Data Pegawai</h4>
    <div class="card">
        <div class="card-header">
            <a href="{{ route('employees.create') }}" class="btn btn-primary"><i
                    class="bx bx-plus"></i> Tambah Pegawai</a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Nama Pegawai</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>Jumlah Dinas</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($data as $item)
                        <tr>
                            <td><strong>{{ $item->nama }}</strong></td>
                            <td class="text-capitalize">{{ $item->jabatan }}</td>
                            <td class="text-uppercase">{{ $item->status }}</td>
                            <td>{{ $item->jumlah_dinas }}</td>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#detail{{ $item->id }}">
                                    <i class="bx bx-detail me-1"></i>Detail
                                </a> |
                                <a href="{{ route('employees.edit', $item->id) }}">
                                    <i class="bx bx-edit-alt me-1"></i>Edit
                                </a> |
                                <form action="{{ route('employees.destroy', $item->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#" onclick="this.closest('form').submit();return false;">
                                        <i class="bx bx-trash me-1"></i>Delete</a>
                                    </a>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Detail -->
                        <div class="modal fade" id="detail{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Detail Pegawai</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <dl class="row">
                                            <dt class="col-sm-5">Nama Pegawai</dt>
                                            <dd class="col-sm-7">{{ $item->nama }}</dd>

                                            <dt class="col-sm-5">Jenis Kelamin</dt>
                                            <dd class="col-sm-7">{{ $item->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</dd>

                                            <dt class="col-sm-5">Jabatan</dt>
                                            <dd class="col-sm-7 text-capitalize">{{ $item->jabatan }}</dd>

                                            <dt class="col-sm-5">Status</dt>
                                            <dd class="col-sm-7 text-uppercase">{{ $item->status }}</dd>

                                            <dt class="col-sm-5">Jumlah Dinas</dt>
                                            <dd class="col-sm-7">{{ $item->jumlah_dinas }}</dd>

                                            <dt class="col-sm-5">Nilai Dinas</dt>
                                            <dd class="col-sm-7">{{ $item->nilai_dinas }}</dd>

                                            <dt class="col-sm-5">Administrasi Setelah Dinas</dt>
                                            <dd class="col-sm-7 text-capitalize">{{ $item->administrasi }}</dd>

                                            <dt class="col-sm-5">Kekuatan</dt>
                                            <dd class="col-sm-7 text-capitalize">{{ $item->kekuatan }}</dd>
                                        </dl>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
