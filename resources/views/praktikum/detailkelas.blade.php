@extends('layouts.master')
@section('title')
    Detail Kelas
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            UI Elements
        @endslot
        @slot('title')
            Detail Kelas
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Kelas</h4>
                    <p class="card-title-desc">
                        Kelas {{ $detail->nama_kelas }} - {{ $detail->matkul->nama_matkul }} <br>
                        Tahun Ajaran : {{ $detail->periode->tahun_ajaran }} - {{ $detail->periode->semester }}<br>
                        Jumlah Modul : {{ count($detail->modulkelas) }}<br>
                        Jumlah Mahasiswa : {{ count($mhskelas) }}
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
                            <a href="#" data-bs-toggle="modal" data-bs-target="#kelasAslab{{ $detail->id_kelas }}">
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
                                <span class="d-block d-sm-none"><i class="uil-users-alt"></i></span>
                                <span class="d-none d-sm-block">Mahasiswa</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#navtabs-modul" role="tab">
                                <span class="d-block d-sm-none"><i class="uil-book-open"></i></span>
                                <span class="d-none d-sm-block">Modul</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#navtabs-tugas" role="tab">
                                <span class="d-block d-sm-none"><i class="uil-medal"></i></span>
                                <span class="d-none d-sm-block">Tugas</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#navtabs-ujian" role="tab">
                                <span class="d-block d-sm-none"><i class="uil-star"></i></span>
                                <span class="d-none d-sm-block">Ujian</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane active" id="navtabs-mhs" role="tabpanel">
                            <div class="row" style="overflow: auto;">
                                <div class="col-lg-12">
                                    <table id="datatable" class="table table-bordered dt-responsive wrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Periode</th>
                                                <th>Kelas Praktikum</th>
                                                <th>Nama Kelompok</th>
                                                <th>Anggota Kelompok</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detailmhs->kelompok as $key => $kelompok)
                                                <tr>
                                                    <td style="width:2%;">{{ $loop->iteration }}</td>
                                                    <td>{{ $detail->periode->semester }} -
                                                        {{ $detail->periode->tahun_ajaran }}</td>
                                                    <td>Kelas {{ $kelompok->nama_kelas }} -
                                                        {{ $detail->matkul->nama_matkul }}</td>
                                                    <td>{{ $kelompok->nama_kelompok }}</td>
                                                    <td>
                                                        <ul class="list-unstyled product-desc-list text-muted">
                                                            @foreach ($kelompok->mhskelas as $x)
                                                                <li><i class="mdi mdi-circle-medium me-1 align-middle"></i>
                                                                    {{ $x->mhs->nama_mahasiswa }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item">
                                                                <a href="/kelompok/edit/{{ $kelompok->id_kelompok }}"
                                                                    class="px-2 text-primary"><i
                                                                        class="uil uil-pen font-size-18"></i></a>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <a href="/kelompok/delete/{{ $kelompok->id_kelompok }}"
                                                                    class="px-2 text-danger"><i
                                                                        class="uil uil-trash-alt font-size-18"></i></a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="navtabs-modul" role="tabpanel">
                            <div class="row" style="overflow: auto;">
                                <div class="col-lg-12">
                                    <table id="datatable-buttons" class="table table-bordered dt-responsive wrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Kelas</th>
                                                <th>Nama Modul</th>
                                                <th>Alat</th>
                                                <th>Bahan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detailmodul->modulkelas as $modulkelas)
                                                <tr>
                                                    <td style="width:2%;">{{ $loop->iteration }}</td>
                                                    <td>{{ $modulkelas->kels->matkul->nama_matkul }}</td>
                                                    <td>{{ $modulkelas->moduls->modul_name }}</td>
                                                    <td>
                                                        <ul class="list-unstyled product-desc-list text-muted">
                                                            @foreach ($modulkelas->moduls->alat as $x)
                                                                <li><i class="mdi mdi-circle-medium me-1 align-middle"></i>
                                                                    {{ $x->alats->nama_alat }} =
                                                                    {{ $x->jumlah }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <ul class="list-unstyled product-desc-list text-muted">
                                                            @foreach ($modulkelas->moduls->bahan as $x)
                                                                <li><i class="mdi mdi-circle-medium me-1 align-middle"></i>
                                                                    {{ $x->bahans->nama_bahan }}({{ $x->bahans->rumus }})
                                                                    =
                                                                    {{ $x->jumlah }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td id="tooltip-container">
                                                        <ul class="list-inline mb-0 text-center">
                                                            <li class="list-inline-item">
                                                                @if ($modulkelas->isUsed == 'No')
                                                                    <a href="/modul/finish/{{ $modulkelas->id_modulkelas }}"
                                                                        class="px-2 text-success"
                                                                        data-bs-container="#tooltip-container"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        title="Report & Finish"><i
                                                                            class="uil uil-check-circle font-size-18"></i></a>
                                                                @else
                                                                    <p class="text-success">done</p>
                                                                @endif
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="navtabs-tugas" role="tabpanel">
                            <div class="row" style="overflow: auto;">
                                <div class="col-lg-12">
                                    <table class="table table-bordered" style="border:1px; border-bottom:1px;">
                                        <thead style="text-align: center;">
                                            <tr style="border: 1px;">
                                                <th style="width: 2%;">#</th>
                                                <th>Nama Modul</th>
                                                <th>Nama Tugas</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detailtugas->modulkelas as $x)
                                                <tr>
                                                    <td style="width:2%; text-align:center; vertical-align:middle;">
                                                        {{ $loop->iteration }}</td>
                                                    <td style="text-align:center; vertical-align:middle;">
                                                        {{ $x->moduls->modul_name }}
                                                    </td>
                                                    {{-- <td>
                                                        <ul class="list-unstyled product-desc-list text-muted">
                                                            @foreach ($x->tgs as $xx)
                                                                <li class="list text-center">

                                                                    @if ($xx->jenis == 'pre_test')
                                                                        Pre Test
                                                                    @elseif ($xx->jenis == 'post_test')
                                                                        Post Test
                                                                    @elseif ($xx->jenis == 'report')
                                                                        Laporan
                                                                    @endif
                                                                </li>
                                                                <hr style="width: 100%; border-color:black;">
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <ul class="list-unstyled product-desc-list text-muted">
                                                            @foreach ($x->tgs as $xx)
                                                                <li class="list text-center">
                                                                    @if ($xx->uraian_tugas != null && $xx->status == 'approved')
                                                                        Tugas Sudah di Approved, siap di
                                                                        publish!.
                                                                    @elseif ($xx->uraian_tugas != null && $xx->status == 'waiting')
                                                                        Tugas belum di Approved!.
                                                                    @elseif ($xx->uraian_tugas == null && $xx->status == 'draft')
                                                                        Tugas belum di buat!.
                                                                    @elseif ($xx->uraian_tugas != null && $xx->status == 'used')
                                                                        Tugas belum di publis!.
                                                                    @endif
                                                                </li>
                                                                <hr style="width: 100%; border-color:black;">
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <ul class="list-unstyled product-desc-list text-muted">
                                                            @foreach ($x->tgs as $xx)
                                                                <li class="list text-center">
                                                                    @if ($xx->uraian_tugas != null && $xx->status == 'approved')
                                                                        <a href="/tugas/detail/{{ $xx->id_tugas }}"><i
                                                                                class="uil uil-eye text-success"
                                                                                data-toggle="tooltip" data-placement="top"
                                                                                title="Lihat Detail"></i>
                                                                        </a>
                                                                    @elseif ($xx->uraian_tugas != null && $xx->status == 'waiting')
                                                                        <a href="/tugas/create/{{ $xx->id_tugas }}"><i
                                                                                class="uil uil-eye text-warning"
                                                                                data-toggle="tooltip" data-placement="top"
                                                                                title="Lihat Detail"></i>
                                                                        </a>
                                                                    @elseif ($xx->uraian_tugas == null && $xx->status == 'draft')
                                                                        <a href="/tugas/create/{{ $xx->id_tugas }}"><i
                                                                                class="uil uil-pen text-success"
                                                                                data-toggle="tooltip" data-placement="top"
                                                                                title="Buat Tugas"></i>
                                                                        </a>
                                                                    @endif
                                                                </li>
                                                                <hr style="width: 100%; border-color:black;">
                                                            @endforeach
                                                        </ul>
                                                    </td> --}}
                                                    <td style="border: 1px;">
                                                        <table class="table table-striped mb-0"
                                                            style="width: 100%; text-align:center; border:1px;">
                                                            @foreach ($x->tgs as $xx)
                                                                <tr style="width: 100%; text-align:center; border:1px;">
                                                                    <td>
                                                                        @if ($xx->jenis == 'pre_test')
                                                                            Pre Test
                                                                        @elseif ($xx->jenis == 'post_test')
                                                                            Post Test
                                                                        @elseif ($xx->jenis == 'report')
                                                                            Laporan
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="table table-striped mb-0"
                                                            style="width: 100%; text-align:center; border:1px;">
                                                            @foreach ($x->tgs as $xx)
                                                                <tr style="width: 100%; text-align:center; border:1px;">
                                                                    <td>
                                                                        @if ($xx->uraian_tugas != null && $xx->status == 'approved')
                                                                            Tugas Sudah di Approved, siap di
                                                                            publish!.
                                                                        @elseif ($xx->uraian_tugas != null && $xx->status == 'waiting')
                                                                            Tugas belum di Approved!.
                                                                        @elseif ($xx->uraian_tugas == null && $xx->status == 'draft')
                                                                            Tugas belum di buat!.
                                                                        @elseif ($xx->uraian_tugas != null && $xx->status == 'used')
                                                                            Tugas belum sudah dipublish!.
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="table table-striped mb-0"
                                                            style="width: 100%; text-align:center; border:1px;">
                                                            @foreach ($x->tgs as $xx)
                                                                <tr style="width: 100%; text-align:center; border:1px;">
                                                                    <td>

                                                                        @if ($xx->uraian_tugas != null && $xx->status == 'approved')
                                                                            <a href="/tugas/detail/{{ $xx->id_tugas }}"><i
                                                                                    class="uil uil-eye text-success"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title="Lihat Detail"></i>
                                                                            </a>
                                                                        @elseif ($xx->uraian_tugas != null && $xx->status == 'used')
                                                                            <a href="/tugas/detail/{{ $xx->id_tugas }}"><i
                                                                                    class="uil uil-eye text-success"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title="Lihat Detail"></i>
                                                                            </a>
                                                                        @elseif ($xx->uraian_tugas != null && $xx->status == 'waiting')
                                                                            <a href="/tugas/create/{{ $xx->id_tugas }}"><i
                                                                                    class="uil uil-eye text-warning"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title="Lihat Detail"></i>
                                                                            </a>
                                                                        @elseif ($xx->uraian_tugas == null && $xx->status == 'draft')
                                                                            <a href="/tugas/create/{{ $xx->id_tugas }}"><i
                                                                                    class="uil uil-pen text-success"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title="Buat Tugas"></i>
                                                                            </a>
                                                                        @endif

                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- <div class="card bg-white border-primary text-primary-50">
                                            <div class="card-body">
                                                <h5 class="mb-4 text-primary"><i
                                                        class="uil uil-notes me-3"></i>{{ $x->moduls->modul_name }}</h5>
                                                <div class="row">
                                                    @foreach ($x->tgs as $xx)
                                                        <div class="col-lg-4">
                                                            <div class="card bg-white border-primary text-primary-50">
                                                                <div class="card-body">
                                                                    @if ($xx->uraian_tugas == null && $xx->status == 'draft')
                                                                        <h5 class="mb-4 text-danger">
                                                                        @elseif ($xx->uraian_tugas != null)
                                                                            <h5 class="mb-4 text-primary">
                                                                    @endif
                                                                    <i class="uil uil-question-circle me-3"></i>
                                                                    @if ($xx->jenis == 'pre_test')
                                                                        Pre Test
                                                                    @elseif ($xx->jenis == 'post_test')
                                                                        Post Test
                                                                    @elseif ($xx->jenis == 'report')
                                                                        Laporan
                                                                    @endif
                                                                    </h5>
                                                                    </h5>
                                                                    @if ($xx->uraian_tugas == null && $xx->status == 'draft')
                                                                        <p> Belum ada tugas dibuat </p>
                                                                        <a href="/tugas/create/{{ $xx->id_tugas }}"
                                                                            class="btn btn-sm btn-danger">
                                                                            Buat Tugas
                                                                        </a>
                                                                    @elseif($xx->uraian_tugas != null && $xx->status == 'waiting')
                                                                        <p> Tugas belum di approve </p>
                                                                        <a href="/tugas/detail/{{ $xx->id_tugas }}"
                                                                            class="btn btn-sm btn-warning">
                                                                            View Detail
                                                                        </a>
                                                                    @elseif($xx->uraian_tugas != null && $xx->status == 'approved')
                                                                        <p> Tugas sudah di approve, siap di publish </p>
                                                                        <a href="/tugas/detail/{{ $xx->id_tugas }}"
                                                                            class="btn btn-sm btn-success">
                                                                            View Detail
                                                                        </a>
                                                                    @elseif($xx->uraian_tugas != null && $xx->status == 'used')
                                                                        <p> Tugas sedang ditayangkan </p>
                                                                        <a href="/tugas/detail/{{ $xx->id_tugas }}"
                                                                            class="btn btn-sm btn-success">
                                                                            View Detail
                                                                        </a>
                                                                        <a href="{{ route('takedowntugas', ['id_kelas' => $xx->id_kelas, 'id_tugas' => $xx->id_tugas]) }}"
                                                                            class="btn btn-sm btn-danger">
                                                                            Take down!
                                                                        </a>
                                                                    @elseif($xx->uraian_tugas != null && $xx->status == 'unused')
                                                                        <p> Tugas sedang selesai </p>
                                                                        <a href="/tugas/detail/{{ $xx->id_tugas }}"
                                                                            class="btn btn-sm btn-success">
                                                                            View Detail
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div> --}}
                                </div>
                            </div>
                            <hr>
                        </div>

                        <div class="tab-pane" id="navtabs-ujian" role="tabpanel">
                            <div class="row">
                                @foreach ($detailujian->ujian as $x)
                                    <div class="col-lg-6">
                                        <div class="card bg-white border-primary text-primary-50">
                                            <div class="card-body">
                                                @if ($x->uraian_tugas == null)
                                                    <h5 class="mb-4 text-danger"><i class="uil uil-notes me-3"></i>
                                                    @elseif ($x->uraian_tugas != null)
                                                        <h5 class="mb-4 text-primary"><i class="uil uil-notes me-3"></i>
                                                @endif
                                                @if ($x->jenis == 'awal')
                                                    Ujian Awal
                                                @elseif ($x->jenis == 'akhir')
                                                    Ujian Akhir
                                                @endif
                                                </h5>
                                                @if ($x->uraian_ujian == null && $x->status == 'draft')
                                                    <p> Belum ada soal ujian dibuat </p>
                                                    <a href="/ujian/create/{{ $x->id_ujian }}"
                                                        class="btn btn-sm btn-primary">
                                                        Buat
                                                        Ujian
                                                    </a>
                                                @elseif($x->uraian_ujian != null && $x->status == 'waiting')
                                                    <p> Ujian belum di approve </p>
                                                    <a href="/ujian/detail/{{ $x->id_ujian }}"
                                                        class="btn btn-sm btn-success">
                                                        View
                                                        Detail
                                                    </a>
                                                @elseif($x->uraian_ujian != null && $x->status == 'approved')
                                                    <p> Ujian sudah di approve </p>
                                                    <a href="/ujian/detail/{{ $x->id_ujian }}"
                                                        class="btn btn-sm btn-success">
                                                        View
                                                        Detail
                                                    </a>
                                                    <a href="/publishUjian/{{ $x->id_ujian }}"
                                                        class="btn btn-sm btn-warning">
                                                        Publish Ujian
                                                    </a>
                                                @elseif($x->uraian_ujian != null && $x->status == 'used')
                                                    <p> Ujian sedang ditayangkan </p>
                                                    <a href="/ujian/detail/{{ $x->id_ujian }}"
                                                        class="btn btn-sm btn-success">
                                                        View
                                                        Detail
                                                    </a>
                                                    <a href="/publishUjian/{{ $x->id_ujian }}"
                                                        class="btn btn-sm btn-warning">
                                                        Publish Ujian
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Center Modal example -->
    <div class="modal fade" id="kelasAslab{{ $detailx->id_kelas }}" tabindex="-1" role="dialog"
        aria-labelledby="myMediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Asisten Lab</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/kelas/aslab/{{ $detail->id_kelas }}" method="POST" id="createkelompok">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <select class="select2 form-control" name="aslab" id="aslab"
                                        data-live-search="true">
                                        <option selected disabled>Pilih Asisten Lab</option>
                                        @foreach ($aslab as $xx)
                                            <option value="{{ $xx->id_aslab }}"> {{ $xx->nama_aslab }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                    </form>
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
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
