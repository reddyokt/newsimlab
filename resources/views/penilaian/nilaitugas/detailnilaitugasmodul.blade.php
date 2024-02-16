@extends('layouts.master')
@section('title')
    Nilai Tugas
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Nilai Tugas
        @endslot
        @slot('title')
            by Modul
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Kelas</h4>
                    <p class="card-title-desc">
                        Kelas {{ $mdlkelas->kels->nama_kelas }} - {{ $mdlkelas->kels->matkul->nama_matkul }} <br>
                        Tahun Ajaran : {{ $mdlkelas->kels->periode->tahun_ajaran }} -
                        {{ $mdlkelas->kels->periode->semester }}<br>
                        Nama Modul : {{ $mdlkelas->moduls->modul_name }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Dosen Pengampu</h4>
                    @if (
                        !empty($detail->dosen->userDosen['profile_picture']) &&
                            file_exists(base_path() . '/public/upload/profile_picture/' . $detail->dosen->userDosen['profile_picture']))
                        <img src="{{ '/../upload/profile_picture/' . $detail->dosen->userDosen['profile_picture'] }}"
                            alt="" class="avatar-md rounded-circle me-2">
                    @else
                        <img class="avatar-md rounded-circle me-2" src="{{ asset('assets/media/users/default.jpg') }}"
                            alt="user" />
                    @endif
                    <span>
                        {{ $detail->dosen['nama_dosen'] }} <br>
                        {{ $detail->dosen->userDosen['email'] }}<br>
                        {{ $detail->dosen->userDosen['phone'] }}

                    </span>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Asisten Lab</h4>
                    @if (
                        !empty($detail->aslab->userAslab['profile_picture']) &&
                            file_exists(base_path() . '/public/upload/profile_picture/' . $detail->aslab->userAslab['profile_picture']))
                        <img src="{{ '/../upload/profile_picture/' . $detail->aslab->userAslab['profile_picture'] }}"
                            alt="" class="avatar-md rounded-circle me-2">
                    @else
                        <img class="avatar-md rounded-circle me-2" src="{{ asset('assets/media/users/default.jpg') }}"
                            alt="user" />
                    @endif
                    <span>
                        @if ($detail->id_aslab == null)
                            <a href="#">
                                <p class="text-danger">Asisten Lab belum ditunjuk!</p>
                            </a>
                        @else
                            {{ $detail->aslab['nama_aslab'] }} <br>
                            {{ $detail->aslab->userAslab['email'] }}<br>
                            {{ $detail->aslab->userAslab['phone'] }}<br>
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#navtabs-mhs" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Mahasiswa</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane active" id="navtabs-mhs" role="tabpanel">
                            <table id="datatable" class="table table-bordered dt-responsive wrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIM</th>
                                        <th>Nama Mahasiswa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datamhs as $x)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $x->nim }}</td>
                                                <td><a href="{{ route('nilaitugaspermodul',['id_mahasiswa_kelas'=>$x->id_mahasiswa_kelas,
                                                    'id_modulkelas'=>$mdlkelas->id_modulkelas]) }}" target="_blank"> {{ $x->nama_mahasiswa }}</td>
                                                    {{-- <td><a href="/nilaitugas/mhs/{{$x->id_mahasiswa_kelas}}" target="_blank"> {{ $x->nama_mahasiswa }}</td> --}}
                                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Center Modal example -->
    {{-- @foreach ($datamhs as $key => $dtm)
        <div class="modal fade" id="nilaiTugas-{{ $dtm->id_mahasiswa_kelas }}" tabindex="-1" role="dialog"
            aria-labelledby="myMediumModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Isi Nilai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/nilai/tugas/{{ $dtm->id_mahasiswa_kelas }}" method="POST" id="createkelompok">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        @if ($dtm->jenis == 'pre_test' && $dtm->nilai != null)
                                            <p> nilai nya 100 </p>
                                        @elseif ($dtm->jenis == 'pre_test' && $dtm->nilai == null)
                                            <label class="form-label" class="control-label">Isi Nilai Pre Test</label>
                                            <input class="form-control" type="number" name="pre_test">
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan
                                    Kelompok</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach --}}
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
