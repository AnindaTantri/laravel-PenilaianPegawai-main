@extends('layouts.employee.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Content types -->
    <div class="card mb-4">
        <div class="card-body text-center">
            <h3 class="card-title text-primary text-uppercase">{{ $penugasan->nama }}</h3>
            <h6 class="mb-1">
                Penugasan
                <span class="text-capitalize">{{ $penugasan->kategori }}</span>
                di
                <span class="text-capitalize">{{ $penugasan->jenis }}</span>
                pada {{ date('d F Y', strtotime($penugasan->tanggal)) }}
            </h6>
            <a href="{{ route('homepage') }}" class="btn btn-primary mt-2">Kembali ke halaman
                utama</a>
        </div>
    </div>

    <h4 class="mt-4 mb-1">Penilaian Pegawai</h4>
    <p class="mb-3">Silahkan lakukan penilaian dengan jujur</p>

    <div class="row">
        <!-- Modern Wizard -->
        <div class="col-12 mb-4">
            <div id="wizard-validation" class="bs-stepper mt-2">
                <div class="bs-stepper-header">
                    <div class="step" data-target="#data-diri-validation">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle">1</span>
                            <span class="bs-stepper-label mt-1">
                                <span class="bs-stepper-title">Data Penilai & Pegawai</span>
                                <span class="bs-stepper-subtitle">Isi data diri penilai dan pegawai</span>
                            </span>
                        </button>
                    </div>
                    <div class="line">
                        <i class="bx bx-chevron-right"></i>
                    </div>
                    <div class="step" data-target="#penilaian-validation">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle">2</span>
                            <span class="bs-stepper-label mt-1">
                                <span class="bs-stepper-title">Penilaian</span>
                                <span class="bs-stepper-subtitle">Nilai sesuai kinerja pegawai</span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="bs-stepper-content">
                    <form id="wizard-validation-form" onSubmit="return false">
                        <input type="hidden" value="{{ $penugasan->id }}" id="penugasan_id">
                        <!-- Account Details -->
                        <div id="data-diri-validation" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">Data Penilai & Pegawai</h6>
                                <small>Isi data diri Anda dan data diri pegawai yang ingin Anda nilai</small>
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="formValidationNamaPenilai">Nama Anda</label>
                                    <select name="formValidationNamaPenilai" id="formValidationNamaPenilai"
                                        class="select2" required onchange="getJabatanPenilai(this)">
                                        <option selected disabled>Choose your name...</option>
                                        @foreach($penugasan->pegawai as $penilai)
                                            <option value="{{ $penilai->id }}">{{ $penilai->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="jabatan_penilai">Jabatan Anda</label>
                                    <input type="text" name="jabatan_penilai" id="jabatan_penilai" class="form-control text-uppercase"
                                        placeholder="Jabatan penilai" readonly />
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="formValidationNamaPegawai">Nama Pegawai yang akan
                                        Anda
                                        Nilai</label>
                                    <select name="formValidationNamaPegawai" id="formValidationNamaPegawai"
                                        class="select2" required onchange="getJabatanPegawai(this)">
                                        <option selected disabled>Choose employee...</option>
                                        @foreach($penugasan->pegawai as $pegawai)
                                            <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="jabatan_pegawai">Jabatan Pegawai yang akan Anda
                                        Nilai</label>
                                    <input type="text" name="jabatan_pegawai" id="jabatan_pegawai" class="form-control text-uppercase"
                                        placeholder="Jabatan pegawai" readonly/>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <button class="btn btn-label-secondary btn-prev" disabled>
                                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <button class="btn btn-primary btn-next">
                                        <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                        <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Personal Info -->
                        <div id="penilaian-validation" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">Penilaian</h6>
                                <small>Nilai sesuai kinerja pegawai</small>
                            </div>
                            <div class="row g-3" id="nilai">
                                <!-- Etika -->
                                <div id="nilai_etika">
                                    <div class="col-sm-12">
                                        <label class="form-label" for="etika">Etika</label>
                                        <div class="d-flex justify-content-around">
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="etika" class="form-check-input" type="radio" value="1"
                                                    id="etikaSangatKurang">
                                                <label class="form-check-label" for="etikaSangatKurang"> Sangat Kurang
                                                </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="etika" class="form-check-input" type="radio" value="2"
                                                    id="etikaKurang">
                                                <label class="form-check-label" for="etikaKurang"> Kurang </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="etika" class="form-check-input" type="radio" value="3"
                                                    id="etikaCukup">
                                                <label class="form-check-label" for="etikaCukup"> Cukup </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="etika" class="form-check-input" type="radio" value="4"
                                                    id="etikaBaik">
                                                <label class="form-check-label" for="etikaBaik"> Baik </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="etika" class="form-check-input" type="radio" value="5"
                                                    id="etikaSangatBaik">
                                                <label class="form-check-label" for="etikaSangatBaik"> Sangat Baik
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <!-- Disiplin -->
                                <div id="nilai_disiplin">
                                    <div class="col-sm-12">
                                        <label class="form-label" for="disiplin">Disiplin</label>
                                        <div class="d-flex justify-content-around">
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="disiplin" class="form-check-input" type="radio" value="1"
                                                    id="disiplinSangatKurang">
                                                <label class="form-check-label" for="disiplinSangatKurang"> Sangat
                                                    Kurang </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="disiplin" class="form-check-input" type="radio" value="2"
                                                    id="disiplinKurang">
                                                <label class="form-check-label" for="disiplinKurang"> Kurang </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="disiplin" class="form-check-input" type="radio" value="3"
                                                    id="disiplinCukup">
                                                <label class="form-check-label" for="disiplinCukup"> Cukup </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="disiplin" class="form-check-input" type="radio" value="4"
                                                    id="disiplinBaik">
                                                <label class="form-check-label" for="disiplinBaik"> Baik </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="disiplin" class="form-check-input" type="radio" value="5"
                                                    id="disiplinSangatBaik">
                                                <label class="form-check-label" for="disiplinSangatBaik"> Sangat Baik
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <!-- Tanggung Jawab -->
                                <div id="nilai_tanggungjawab">
                                    <div class="col-sm-12">
                                        <label class="form-label" for="tanggung_jawab">Tanggung Jawab</label>
                                        <div class="d-flex justify-content-around">
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="tanggung_jawab" class="form-check-input" type="radio"
                                                    value="1" id="tanggungjawabSangatKurang">
                                                <label class="form-check-label" for="tanggungjawabSangatKurang"> Sangat
                                                    Kurang </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="tanggung_jawab" class="form-check-input" type="radio"
                                                    value="2" id="tanggungjawabKurang">
                                                <label class="form-check-label" for="tanggungjawabKurang"> Kurang
                                                </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="tanggung_jawab" class="form-check-input" type="radio"
                                                    value="3" id="tanggungjawabCukup">
                                                <label class="form-check-label" for="tanggungjawabCukup"> Cukup </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="tanggung_jawab" class="form-check-input" type="radio"
                                                    value="4" id="tanggungjawabBaik">
                                                <label class="form-check-label" for="tanggungjawabBaik"> Baik </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="tanggung_jawab" class="form-check-input" type="radio"
                                                    value="5" id="tanggungjawabSangatBaik">
                                                <label class="form-check-label" for="tanggungjawabSangatBaik"> Sangat
                                                    Baik
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <!-- Team Work -->
                                <div id="nilai_teamwork">
                                    <div class="col-sm-12">
                                        <label class="form-label" for="teamwork">Team Work</label>
                                        <div class="d-flex justify-content-around">
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="teamwork" class="form-check-input" type="radio" value="1"
                                                    id="teamworkSangatKurang">
                                                <label class="form-check-label" for="teamworkSangatKurang"> Sangat
                                                    Kurang </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="teamwork" class="form-check-input" type="radio" value="2"
                                                    id="teamworkKurang">
                                                <label class="form-check-label" for="teamworkKurang"> Kurang </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="teamwork" class="form-check-input" type="radio" value="3"
                                                    id="teamworkCukup">
                                                <label class="form-check-label" for="teamworkCukup"> Cukup </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="teamwork" class="form-check-input" type="radio" value="4"
                                                    id="teamworkBaik">
                                                <label class="form-check-label" for="teamworkBaik"> Baik </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="teamwork" class="form-check-input" type="radio" value="5"
                                                    id="teamworkSangatBaik">
                                                <label class="form-check-label" for="teamworkSangatBaik"> Sangat Baik
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <!-- Problem Solve -->
                                <div id="nilai_problemsolve">
                                    <div class="col-sm-12">
                                        <label class="form-label" for="problemsolve">Problem Solve</label>
                                        <div class="d-flex justify-content-around">
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="problemsolve" class="form-check-input" type="radio"
                                                    value="1" id="problemsolveSangatKurang">
                                                <label class="form-check-label" for="problemsolveSangatKurang"> Sangat
                                                    Kurang </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="problemsolve" class="form-check-input" type="radio"
                                                    value="2" id="problemsolveKurang">
                                                <label class="form-check-label" for="problemsolveKurang"> Kurang
                                                </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="problemsolve" class="form-check-input" type="radio"
                                                    value="3" id="problemsolveCukup">
                                                <label class="form-check-label" for="problemsolveCukup"> Cukup </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="problemsolve" class="form-check-input" type="radio"
                                                    value="4" id="problemsolveBaik">
                                                <label class="form-check-label" for="problemsolveBaik"> Baik </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="problemsolve" class="form-check-input" type="radio"
                                                    value="5" id="problemsolveSangatBaik">
                                                <label class="form-check-label" for="problemsolveSangatBaik"> Sangat
                                                    Baik </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <!-- Kejujuran -->
                                <div id="nilai_kejujuran">
                                    <div class="col-sm-12">
                                        <label class="form-label" for="kejujuran">Kejujuran</label>
                                        <div class="d-flex justify-content-around">
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="kejujuran" class="form-check-input" type="radio" value="1"
                                                    id="kejujuranSangatKurang">
                                                <label class="form-check-label" for="kejujuranSangatKurang"> Sangat
                                                    Kurang </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="kejujuran" class="form-check-input" type="radio" value="2"
                                                    id="kejujuranKurang">
                                                <label class="form-check-label" for="kejujuranKurang"> Kurang </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="kejujuran" class="form-check-input" type="radio" value="3"
                                                    id="kejujuranCukup">
                                                <label class="form-check-label" for="kejujuranCukup"> Cukup </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="kejujuran" class="form-check-input" type="radio" value="4"
                                                    id="kejujuranBaik">
                                                <label class="form-check-label" for="kejujuranBaik"> Baik </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="kejujuran" class="form-check-input" type="radio" value="5"
                                                    id="kejujuranSangatBaik">
                                                <label class="form-check-label" for="kejujuranSangatBaik"> Sangat Baik
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <!-- Kepatuhan -->
                                <div id="nilai_kepatuhan">
                                    <div class="col-sm-12">
                                        <label class="form-label" for="kepatuhan">Kepatuhan</label>
                                        <div class="d-flex justify-content-around">
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="kepatuhan" class="form-check-input" type="radio" value="1"
                                                    id="kepatuhanSangatKurang">
                                                <label class="form-check-label" for="kepatuhanSangatKurang"> Sangat
                                                    Kurang </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="kepatuhan" class="form-check-input" type="radio" value="2"
                                                    id="kepatuhanKurang">
                                                <label class="form-check-label" for="kepatuhanKurang"> Kurang </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="kepatuhan" class="form-check-input" type="radio" value="3"
                                                    id="kepatuhanCukup">
                                                <label class="form-check-label" for="kepatuhanCukup"> Cukup </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="kepatuhan" class="form-check-input" type="radio" value="4"
                                                    id="kepatuhanBaik">
                                                <label class="form-check-label" for="kepatuhanBaik"> Baik </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="kepatuhan" class="form-check-input" type="radio" value="5"
                                                    id="kepatuhanSangatBaik">
                                                <label class="form-check-label" for="kepatuhanSangatBaik"> Sangat Baik
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <!-- Inisiatif -->
                                <div id="nilai_inisiatif">
                                    <div class="col-sm-12">
                                        <label class="form-label" for="inisiatif">Inisiatif</label>
                                        <div class="d-flex justify-content-around">
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="inisiatif" class="form-check-input" type="radio" value="1"
                                                    id="inisiatifSangatKurang">
                                                <label class="form-check-label" for="inisiatifSangatKurang"> Sangat
                                                    Kurang </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="inisiatif" class="form-check-input" type="radio" value="2"
                                                    id="inisiatifKurang">
                                                <label class="form-check-label" for="inisiatifKurang"> Kurang </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="inisiatif" class="form-check-input" type="radio" value="3"
                                                    id="inisiatifCukup">
                                                <label class="form-check-label" for="inisiatifCukup"> Cukup </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="inisiatif" class="form-check-input" type="radio" value="4"
                                                    id="inisiatifBaik">
                                                <label class="form-check-label" for="inisiatifBaik"> Baik </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="inisiatif" class="form-check-input" type="radio" value="5"
                                                    id="inisiatifSangatBaik">
                                                <label class="form-check-label" for="inisiatifSangatBaik"> Sangat Baik
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <!-- Komunikasi -->
                                <div id="nilai_komunikasi">
                                    <div class="col-sm-12">
                                        <label class="form-label" for="komunikasi">Komunikasi</label>
                                        <div class="d-flex justify-content-around">
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="komunikasi" class="form-check-input" type="radio" value="1"
                                                    id="komunikasiSangatKurang">
                                                <label class="form-check-label" for="komunikasiSangatKurang"> Sangat
                                                    Kurang </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="komunikasi" class="form-check-input" type="radio" value="2"
                                                    id="komunikasiKurang">
                                                <label class="form-check-label" for="komunikasiKurang"> Kurang </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="komunikasi" class="form-check-input" type="radio" value="3"
                                                    id="komunikasiCukup">
                                                <label class="form-check-label" for="komunikasiCukup"> Cukup </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="komunikasi" class="form-check-input" type="radio" value="4"
                                                    id="komunikasiBaik">
                                                <label class="form-check-label" for="komunikasiBaik"> Baik </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="komunikasi" class="form-check-input" type="radio" value="5"
                                                    id="komunikasiSangatBaik">
                                                <label class="form-check-label" for="komunikasiSangatBaik"> Sangat Baik
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <!-- Perencanaan -->
                                <div id="nilai_perencanaan">
                                    <div class="col-sm-12">
                                        <label class="form-label" for="perencanaan">Perencanaan</label>
                                        <div class="d-flex justify-content-around">
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="perencanaan" class="form-check-input" type="radio"
                                                    value="1" id="perencanaanSangatKurang">
                                                <label class="form-check-label" for="perencanaanSangatKurang"> Sangat
                                                    Kurang </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="perencanaan" class="form-check-input" type="radio"
                                                    value="2" id="perencanaanKurang">
                                                <label class="form-check-label" for="perencanaanKurang"> Kurang </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="perencanaan" class="form-check-input" type="radio"
                                                    value="3" id="perencanaanCukup">
                                                <label class="form-check-label" for="perencanaanCukup"> Cukup </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="perencanaan" class="form-check-input" type="radio"
                                                    value="4" id="perencanaanBaik">
                                                <label class="form-check-label" for="perencanaanBaik"> Baik </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="perencanaan" class="form-check-input" type="radio"
                                                    value="5" id="perencanaanSangatBaik">
                                                <label class="form-check-label" for="perencanaanSangatBaik"> Sangat Baik
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <!-- Kepemimpinan -->
                                <div id="nilai_kepemimpinan">
                                    <div class="col-sm-12">
                                        <label class="form-label" for="kepemimpinan">Kepemimpinan</label>
                                        <div class="d-flex justify-content-around">
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="kepemimpinan" class="form-check-input" type="radio"
                                                    value="1" id="kepemimpinanSangatKurang">
                                                <label class="form-check-label" for="kepemimpinanSangatKurang"> Sangat
                                                    Kurang </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="kepemimpinan" class="form-check-input" type="radio"
                                                    value="2" id="kepemimpinanKurang">
                                                <label class="form-check-label" for="kepemimpinanKurang"> Kurang
                                                </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="kepemimpinan" class="form-check-input" type="radio"
                                                    value="3" id="kepemimpinanCukup">
                                                <label class="form-check-label" for="kepemimpinanCukup"> Cukup </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="kepemimpinan" class="form-check-input" type="radio"
                                                    value="4" id="kepemimpinanBaik">
                                                <label class="form-check-label" for="kepemimpinanBaik"> Baik </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="kepemimpinan" class="form-check-input" type="radio"
                                                    value="5" id="kepemimpinanSangatBaik">
                                                <label class="form-check-label" for="kepemimpinanSangatBaik"> Sangat
                                                    Baik
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <!-- Inovasi -->
                                <div id="nilai_inovasi">
                                    <div class="col-sm-12">
                                        <label class="form-label" for="inovasi">Inovasi</label>
                                        <div class="d-flex justify-content-around">
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="inovasi" class="form-check-input" type="radio" value="1"
                                                    id="inovasiSangatKurang">
                                                <label class="form-check-label" for="inovasiSangatKurang"> Sangat
                                                    Kurang </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="inovasi" class="form-check-input" type="radio" value="2"
                                                    id="inovasiKurang">
                                                <label class="form-check-label" for="inovasiKurang"> Kurang
                                                </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="inovasi" class="form-check-input" type="radio" value="3"
                                                    id="inovasiCukup">
                                                <label class="form-check-label" for="inovasiCukup"> Cukup </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="inovasi" class="form-check-input" type="radio" value="4"
                                                    id="inovasiBaik">
                                                <label class="form-check-label" for="inovasiBaik"> Baik </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="inovasi" class="form-check-input" type="radio" value="5"
                                                    id="inovasiSangatBaik">
                                                <label class="form-check-label" for="inovasiSangatBaik"> Sangat
                                                    Baik
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <!-- Analisa Pemikiran -->
                                <div id="nilai_analisapemikiran">
                                    <div class="col-sm-12">
                                        <label class="form-label" for="analisapemikiran">Analisa Pemikiran</label>
                                        <div class="d-flex justify-content-around">
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="analisapemikiran" class="form-check-input" type="radio"
                                                    value="1" id="analisapemikiranSangatKurang">
                                                <label class="form-check-label" for="analisapemikiranSangatKurang">
                                                    Sangat
                                                    Kurang </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="analisapemikiran" class="form-check-input" type="radio"
                                                    value="2" id="analisapemikiranKurang">
                                                <label class="form-check-label" for="analisapemikiranKurang"> Kurang
                                                </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="analisapemikiran" class="form-check-input" type="radio"
                                                    value="3" id="analisapemikiranCukup">
                                                <label class="form-check-label" for="analisapemikiranCukup"> Cukup
                                                </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="analisapemikiran" class="form-check-input" type="radio"
                                                    value="4" id="analisapemikiranBaik">
                                                <label class="form-check-label" for="analisapemikiranBaik"> Baik
                                                </label>
                                            </div>
                                            <div class="form-check form-check-primary mt-3">
                                                <input name="analisapemikiran" class="form-check-input" type="radio"
                                                    value="5" id="analisapemikiranSangatBaik">
                                                <label class="form-check-label" for="analisapemikiranSangatBaik"> Sangat
                                                    Baik
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-12 d-flex justify-content-between mt-2">
                                    <button class="btn btn-primary btn-prev">
                                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <button class="btn btn-success btn-next btn-submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Modern Wizard -->
    </div>

</div>
@endsection

@push('style')
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />

@endpush

@push('script')
    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}">
    </script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script
        src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}">
    </script>
    <script
        src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}">
    </script>
    <script
        src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}">
    </script>
    <script src="{{ asset('assets/js/form-wizard-numbered.js') }}"></script>
    <script src="{{ asset('assets/js/form-wizard-validation.js') }}"></script>

    <script>
        const getJabatanPenilai = (e) => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let pegawai = document.getElementById('formValidationNamaPenilai').value
            let jabatan = document.getElementById('jabatan_penilai')

            $.ajax({
                type: 'GET',
                dataType: "json",
                url: '/jabatanPegawai/' + pegawai,
                success: function (data) {
                  jabatan.value = data.jabatan
                },
                timeout: 10000
            });
        }

        const getJabatanPegawai = (e) => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let pegawai = document.getElementById('formValidationNamaPegawai').value
            let jabatan = document.getElementById('jabatan_pegawai')

            // personil
            let kepatuhan = document.getElementById('nilai_kepatuhan')
            let inisiatif = document.getElementById('nilai_inisiatif')
            let komunikasi = document.getElementById('nilai_komunikasi')
            // dantim
            let perencanaan = document.getElementById('nilai_perencanaan')
            let kepemimpinan = document.getElementById('nilai_kepemimpinan')
            let inovasi = document.getElementById('nilai_inovasi')
            let analisapemikiran = document.getElementById('nilai_analisapemikiran')

            $.ajax({
                type: 'GET',
                dataType: "json",
                url: '/jabatanPegawai/' + pegawai,
                success: function (data) {
                  jabatan.value = data.jabatan
                  if (jabatan.value === 'personil') {
                    perencanaan.style.display = 'none'
                    kepemimpinan.style.display = 'none'
                    inovasi.style.display = 'none'
                    analisapemikiran.style.display = 'none'
                    kepatuhan.style.display = 'block'
                    inisiatif.style.display = 'block'
                    komunikasi.style.display = 'block'
                  } else if (jabatan.value === 'dantim') {
                    perencanaan.style.display = 'block'
                    kepemimpinan.style.display = 'block'
                    inovasi.style.display = 'block'
                    analisapemikiran.style.display = 'block'
                    kepatuhan.style.display = 'none'
                    inisiatif.style.display = 'none'
                    komunikasi.style.display = 'none'
                  }
                },
                timeout: 10000
            });
        }
    </script>
@endpush
