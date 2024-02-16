@extends('layouts.master')
@section('title')
    Nilai Ujian
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Nilai Ujian
        @endslot
        @slot('title')
            by Kelas
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Kelas</h4>
                    <p class="card-title-desc">
                        Kelas {{ $idkel->nama_kelas }} - {{ $matkul->nama_matkul }} <br>
                        Tahun Ajaran : {{ $periode->tahun_ajaran }} -
                        {{ $periode->semester }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Dosen Pengampu</h4>
                    @if (
                        !empty($userdosen->profile_picture) &&
                            file_exists(base_path() . '/public/upload/profile_picture/' . $userdosen->profile_picture))
                        <img src="{{ '/../upload/profile_picture/' . $userdosen->profile_picture }}" alt=""
                            class="avatar-md rounded-circle me-2">
                    @else
                        <img class="avatar-md rounded-circle me-2" src="{{ asset('assets/media/users/default.jpg') }}"
                            alt="user" />
                    @endif
                    <span>
                        {{ $dosen->nama_dosen }} <br>
                        {{ $dosen->email }}<br>
                        {{ $dosen->phone }}

                    </span>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Asisten Lab</h4>
                    @if (
                        !empty($useraslab->profile_picture) &&
                            file_exists(base_path() . '/public/upload/profile_picture/' . $useraslab->profile_picture))
                        <img src="{{ '/../upload/profile_picture/' . $useraslab->profile_picture }}" alt=""
                            class="avatar-md rounded-circle me-2">
                    @else
                        <img class="avatar-md rounded-circle me-2" src="{{ asset('assets/media/users/default.jpg') }}"
                            alt="user" />
                    @endif
                    <span>
                        @if ($aslab->id_aslab == null)
                            <a href="#">
                                <p class="text-danger">Asisten Lab belum ditunjuk!</p>
                            </a>
                        @else
                            {{ $aslab->nama_aslab }} <br>
                            {{ $useraslab->email }}<br>
                            {{ $useraslab->phone }}<br>
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row">
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
                                    @foreach ($mhs as $x)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $x->mhs->nim }}</td>
                                                <td><a href="{{ route('nilaiujianperkelas',['id_mahasiswa_kelas'=>$x->id_mahasiswa_kelas,'id_kelas'=>$idkel->id_kelas])}}" target="_blank"> {{ $x->mhs->nama_mahasiswa }}</td>
                                                    
                                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
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
                                    @foreach ($mhs as $x)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $x->mhs->nim }}</td>
                                            <td><a href="{{ route('nilaiujianperkelas', ['id_mahasiswa_kelas' => $x->id_mahasiswa_kelas, 'id_kelas' => $idkel->id_kelas]) }}"
                                                    target="_blank"> {{ $x->mhs->nama_mahasiswa }}</td>
                                            <td>
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
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
