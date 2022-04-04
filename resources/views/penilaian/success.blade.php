@extends('layouts.employee.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card mb-4">
        <div class="card-body text-center">
            <h3 class="card-title text-primary text-uppercase">Penilaian Berhasil dilakukan</h3>
            <p class="mb-1">Terima kasih atas partisipasi Anda</p>
            <a href="{{ route('homepage') }}" class="btn btn-primary mt-2">Kembali ke halaman
                utama</a>
        </div>
    </div>

</div>
@endsection
