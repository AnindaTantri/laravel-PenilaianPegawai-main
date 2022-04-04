@extends('layouts.admin.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Data Penugasan</h4>
    <div class="card">
        <div class="card-header">
            <a href="{{ route('penugasan.create') }}" class="btn btn-primary"><i
                    class="bx bx-plus"></i> Tambah Penugasan</a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Jenis Penugasan</th>
                        <th>Kategori Penugasan</th>
                        <th>Nama Penugasan</th>
                        <th>Tanggal</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($data as $item)
                        <tr>
                            <td class="text-capitalize">{{ $item->jenis }}</></td>
                            <td class="text-capitalize">{{ $item->kategori }}</td>
                            <td class="text-capitalize"><strong>{{ $item->nama }}</strong></td>
                            <td>{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#detail{{ $item->id }}">
                                    <i class="bx bx-detail me-1"></i>Detail
                                </a> |
                                <a href="{{ route('penugasan.edit', $item->id) }}">
                                    <i class="bx bx-edit-alt me-1"></i>Edit
                                </a> |
                                <form action="{{ route('penugasan.destroy', $item->id) }}"
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
                                            <dt class="col-sm-5">Jenis Penugasan</dt>
                                            <dd class="col-sm-7 text-capitalize">{{ $item->jenis }}</dd>

                                            <dt class="col-sm-5">Kategori Penugasan</dt>
                                            <dd class="col-sm-7 text-capitalize">{{ $item->kategori }}</dd>

                                            <dt class="col-sm-5">Nama Penugasan</dt>
                                            <dd class="col-sm-7">{{ $item->nama }}</dd>

                                            <dt class="col-sm-5">Tanggal Penugasan</dt>
                                            <dd class="col-sm-7">{{ date('d M Y', strtotime($item->tanggal)) }}</dd>

                                            <dt class="col-sm-5">Jumlah ASN</dt>
                                            <dd class="col-sm-7">{{ $item->jumlah_asn }}</dd>

                                            <dt class="col-sm-5">Jumlah Outsourching</dt>
                                            <dd class="col-sm-7">{{ $item->jumlah_outsourching }}</dd>

                                            <dt class="col-sm-5">Jumlah Titik Acara</dt>
                                            <dd class="col-sm-7">{{ $item->jumlah_titik_acara }}</dd>

                                            <dt class="col-sm-5">Tingkat Kesulitan</dt>
                                            <dd class="col-sm-7 text-capitalize">{{ $item->tingkat_kesulitan }}</dd>

                                            <dt class="col-sm-5">Pegawai</dt>
                                            <dd class="col-sm-7">
                                                @if (!$item->pegawai->isEmpty())
                                                    <ul>
                                                        @foreach ($item->pegawai as $pegawai)
                                                            <li>{{ $pegawai->nama }}</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    Belum ada pegawai
                                                @endif
                                            </dd>
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
