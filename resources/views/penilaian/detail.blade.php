@extends('layouts.admin.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
      <a href="{{ route('penilaian.index') }}" class="text-muted fw-light">Penilaian Pegawai</a>
        <span class="text-muted fw-light"> / </span> Detail Penilaian Pegawai
    </h4>
    <div class="row">
        <!-- User Sidebar -->
        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
            <!-- User Card -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class=" d-flex align-items-center flex-column">
                            <img class="img-fluid rounded my-4" src="{{ asset('assets/img/avatars/pegawai.png') }}" height="110"
                                width="110" alt="User avatar" />
                            <div class="user-info text-center">
                                <h4 class="mb-2">{{ $data[0]->nama }}</h4>
                                <span class="badge bg-label-secondary">{{ $data[0]->jabatan }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around flex-wrap mb-2 pb-2">
                        <div class="d-flex align-items-start mt-3 gap-3">
                            <span class="badge bg-label-primary p-2 rounded"><i
                                    class='bx bx-award bx-sm'></i></span>
                            <div>
                                <h5 class="mb-0">
                                  @if ($data[0]->jabatan == 'personil')
                                      {{ round((
                                        $data[0]->etika + 
                                        $data[0]->disiplin + 
                                        $data[0]->tanggung_jawab + 
                                        $data[0]->teamwork + 
                                        $data[0]->problem_solve + 
                                        $data[0]->kejujuran + 
                                        $data[0]->kepatuhan + 
                                        $data[0]->inisiatif + 
                                        $data[0]->komunikasi) / 9, 1) }}
                                  @else
                                      {{ round((
                                        $data[0]->etika + 
                                        $data[0]->disiplin + 
                                        $data[0]->tanggung_jawab + 
                                        $data[0]->teamwork + 
                                        $data[0]->problem_solve + 
                                        $data[0]->kejujuran + 
                                        $data[0]->perencanaan + 
                                        $data[0]->kepemimpinan + 
                                        $data[0]->inovasi + 
                                        $data[0]->analisa_pemikiran) / 10, 1) }}
                                  @endif
                                  /5
                                </h5>
                                <span>{{ $data[0]->count }} kali dinilai</span>
                            </div>
                        </div>
                    </div>
                    <h5 class="pb-2 border-bottom mb-4">Details</h5>
                    <div class="info-container">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <span class="fw-bold me-2">Nama:</span>
                                <span>{{ $data[0]->nama }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Jenis Kelamin: </span>
                                <span>{{ $data[0]->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Jabatan:</span>
                                <span class="text-capitalize">{{ $data[0]->jabatan }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Status:</span>
                                <span class="text-capitalize">{{ $data[0]->status }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Kekuatan:</span>
                                <span class="text-capitalize">{{ $data[0]->kekuatan }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /User Card -->
        </div>
        <!--/ User Sidebar -->


        <!-- User Content -->
        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
            <!-- Penilaian table -->
            <div class="card mb-4">
                <h5 class="card-header">Penilaian Pegawai</h5>
                <div class="table-responsive mb-3">
                    <table class="table border-top">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Kriteria Penilaian</th>
                                <th class="text-nowrap">Total Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>Etika</td>
                            <td>
                              <div class="d-flex justify-content-between align-items-center mb-1">
                                <span>{{ round($data[0]->etika, 1) }}/5</span>
                              </div>
                              <div class="progress mb-1" style="height: 8px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ round($data[0]->etika, 1) / 5 * 100 }}%;" aria-valuenow="{{ round($data[0]->etika, 1) }}"
                                  aria-valuemin="0" aria-valuemax="5"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>Disiplin</td>
                            <td>
                              <div class="d-flex justify-content-between align-items-center mb-1">
                                <span>{{ round($data[0]->disiplin, 1) }}/5</span>
                              </div>
                              <div class="progress mb-1" style="height: 8px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ round($data[0]->disiplin, 1) / 5 * 100 }}%;" aria-valuenow="{{ round($data[0]->disiplin, 1) }}"
                                  aria-valuemin="0" aria-valuemax="5"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>Tanggung Jawab</td>
                            <td>
                              <div class="d-flex justify-content-between align-items-center mb-1">
                                <span>{{ round($data[0]->tanggung_jawab, 1) }}/5</span>
                              </div>
                              <div class="progress mb-1" style="height: 8px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ round($data[0]->tanggung_jawab, 1) / 5 * 100 }}%;" aria-valuenow="{{ round($data[0]->tanggung_jawab, 1) }}"
                                  aria-valuemin="0" aria-valuemax="5"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>Teamwork</td>
                            <td>
                              <div class="d-flex justify-content-between align-items-center mb-1">
                                <span>{{ round($data[0]->teamwork, 1) }}/5</span>
                              </div>
                              <div class="progress mb-1" style="height: 8px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ round($data[0]->teamwork, 1) / 5 * 100 }}%;" aria-valuenow="{{ round($data[0]->teamwork, 1) }}"
                                  aria-valuemin="0" aria-valuemax="5"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>5</td>
                            <td>Problem Solve</td>
                            <td>
                              <div class="d-flex justify-content-between align-items-center mb-1">
                                <span>{{ round($data[0]->problem_solve, 1) }}/5</span>
                              </div>
                              <div class="progress mb-1" style="height: 8px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ round($data[0]->problem_solve, 1) / 5 * 100 }}%;" aria-valuenow="{{ round($data[0]->problem_solve, 1) }}"
                                  aria-valuemin="0" aria-valuemax="5"></div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>6</td>
                            <td>Kejujuran</td>
                            <td>
                              <div class="d-flex justify-content-between align-items-center mb-1">
                                <span>{{ round($data[0]->kejujuran, 1) }}/5</span>
                              </div>
                              <div class="progress mb-1" style="height: 8px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ round($data[0]->kejujuran, 1) / 5 * 100 }}%;" aria-valuenow="{{ round($data[0]->kejujuran, 1) }}"
                                  aria-valuemin="0" aria-valuemax="5"></div>
                              </div>
                            </td>
                          </tr>
                          @if ($data[0]->jabatan == 'personil')
                            <tr>
                              <td>7</td>
                              <td>Kepatuhan</td>
                              <td>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                  <span>{{ round($data[0]->kepatuhan, 1) }}/5</span>
                                </div>
                                <div class="progress mb-1" style="height: 8px;">
                                  <div class="progress-bar" role="progressbar" style="width: {{ round($data[0]->kepatuhan, 1) / 5 * 100 }}%;" aria-valuenow="{{ round($data[0]->kepatuhan, 1) }}"
                                    aria-valuemin="0" aria-valuemax="5"></div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>8</td>
                              <td>Inisiatif</td>
                              <td>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                  <span>{{ round($data[0]->inisiatif, 1) }}/5</span>
                                </div>
                                <div class="progress mb-1" style="height: 8px;">
                                  <div class="progress-bar" role="progressbar" style="width: {{ round($data[0]->inisiatif, 1) / 5 * 100 }}%;" aria-valuenow="{{ round($data[0]->inisiatif, 1) }}"
                                    aria-valuemin="0" aria-valuemax="5"></div>
                                </div>
                              </td>inisiatif
                            </tr>
                            <tr>
                              <td>9</td>
                              <td>Komunikasi</td>
                              <td>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                  <span>{{ round($data[0]->komunikasi, 1) }}/5</span>
                                </div>
                                <div class="progress mb-1" style="height: 8px;">
                                  <div class="progress-bar" role="progressbar" style="width: {{ round($data[0]->komunikasi, 1) / 5 * 100 }}%;" aria-valuenow="{{ round($data[0]->komunikasi, 1) }}"
                                    aria-valuemin="0" aria-valuemax="5"></div>
                                </div>
                              </td>
                            </tr>
                          @else
                            <tr>
                              <td>7</td>
                              <td>Perencanaan</td>
                              <td>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                  <span>{{ round($data[0]->perencanaan, 1) }}/5</span>
                                </div>
                                <div class="progress mb-1" style="height: 8px;">
                                  <div class="progress-bar" role="progressbar" style="width: {{ round($data[0]->perencanaan, 1) / 5 * 100 }}%;" aria-valuenow="{{ round($data[0]->perencanaan, 1) }}"
                                    aria-valuemin="0" aria-valuemax="5"></div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>8</td>
                              <td>Kepemimpinan</td>
                              <td>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                  <span>{{ round($data[0]->kepemimpinan, 1) }}/5</span>
                                </div>
                                <div class="progress mb-1" style="height: 8px;">
                                  <div class="progress-bar" role="progressbar" style="width: {{ round($data[0]->kepemimpinan, 1) / 5 * 100 }}%;" aria-valuenow="{{ round($data[0]->kepemimpinan, 1) }}"
                                    aria-valuemin="0" aria-valuemax="5"></div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>9</td>
                              <td>Inovasi</td>
                              <td>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                  <span>{{ round($data[0]->inovasi, 1) }}/5</span>
                                </div>
                                <div class="progress mb-1" style="height: 8px;">
                                  <div class="progress-bar" role="progressbar" style="width: {{ round($data[0]->inovasi, 1) / 5 * 100 }}%;" aria-valuenow="{{ round($data[0]->inovasi, 1) }}"
                                    aria-valuemin="0" aria-valuemax="5"></div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>10</td>
                              <td>Analisa Pemikiran</td>
                              <td>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                  <span>{{ round($data[0]->analisa_pemikiran, 1) }}/5</span>
                                </div>
                                <div class="progress mb-1" style="height: 8px;">
                                  <div class="progress-bar" role="progressbar" style="width: {{ round($data[0]->analisa_pemikiran, 1) / 5 * 100 }}%;" aria-valuenow="{{ round($data[0]->analisa_pemikiran, 1) }}"
                                    aria-valuemin="0" aria-valuemax="5"></div>
                                </div>
                              </td>
                            </tr>
                          @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /Penilaian table -->
        </div>
        <!--/ User Content -->
    </div>

</div>
@endsection

@push('style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-user-view.css') }}" />
@endpush

@push('script')
  <script src="{{ asset('assets/js/modal-edit-user.js') }}"></script>
  <script src="{{ asset('assets/js/app-user-view.js') }}"></script>
  <script src="{{ asset('assets/js/app-user-view-account.js') }}"></script>
@endpush