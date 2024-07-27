@extends('layouts.master-layouts')
@section('title')
    Absen
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Absen
        @endslot
        @slot('title')
            All Modul
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5> Rekap Absensi </h5>
                    <form action="/rekap" method="POST" id="showrekap">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <select class="select form-control" name="id_kelas" id="id_kelas">
                                    <option selected disabled>Pilih Kelas</option>
                                    @foreach ($allkelas as $klss)
                                        <option value="{{ $klss->id_kelas }}">Kelas {{ $klss->id_kelas }}
                                            {{ $klss->nama_kelas }} -
                                            {{ $klss->matkul->nama_matkul }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary waves-effect waves-light"
                                    id="sa-add-success">Lihat Rekap Kelas</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('flashmessage')
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive wrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 4%;">#</th>
                                <th>Nama Kelas</th>
                                <th>Nama Modul</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allkelas as $kelas)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>Kelas {{ $kelas->nama_kelas }} - {{ $kelas->matkul->nama_matkul }}</td>
                                    <td>
                                        <ul class="list-unstyled product-desc-list text-muted">
                                            @foreach ($kelas->modulkelas as $x)
                                                <li><a href="/absen/modul/{{ $x->id_modulkelas }}" data-bs-toggle="modal"
                                                        data-bs-target="#absenmodul{{ $x->id_modulkelas }}"><i
                                                            class="mdi mdi-circle-medium me-1 align-middle"></i>
                                                        {{ $x->moduls->modul_name }} <span><i class="uil uil-pen"></i>
                                                        </span></a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- Center Modal example -->
    @foreach ($allkelas as $kelas)
        @foreach ($kelas->modulkelas as $x)
            <div class="modal fade" id="absenmodul{{ $x->id_modulkelas }}" tabindex="-1" role="dialog"
                aria-labelledby="myMediumModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Isi Absensi {{ $x->moduls->modul_name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/absen/modul/{{ $x->id_modulkelas }}" method="POST" id="createabsen">
                                @csrf
                                <div class="row" id="tblmhs">
                                    <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
                                    <input type="hidden" name="id_modulkelas" value="{{ $x->id_modulkelas }}">
                                    <input type="hidden" name="id_periode" value="{{ $kelas->periode->id_periode }}">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" class="control-label">List Mahasiswa</label>
                                            <table id="mhs" class="table table-bordered dt-responsive wrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>NIM</th>
                                                        <th>Nama Mahasiswa</th>
                                                        <th>Kehadiran</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($x->absmod as $xxx)
                                                        <tr>
                                                            <td>
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td>
                                                                @foreach ($xxx->absenmhs as $yyy)
                                                                    {{ $yyy->mhs->nim }}
                                                                @endforeach

                                                            </td>
                                                            <td>
                                                                @foreach ($xxx->absenmhs as $yyy)
                                                                    {{ $yyy->mhs->nama_mahasiswa }}
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                @if ($xxx->isAbsen == 'Hadir')
                                                                    <select  name="tidakabsen[]">
                                                                        <option selected disabled>Hadir</option>
                                                                        <option value="{{ $xxx->id_absen }}">Tidak Hadir
                                                                        </option>
                                                                    </select>
                                                                @elseif ($xxx->isAbsen == 'Tidak Hadir')
                                                                    <select  name="absen[]">
                                                                        <option selected disabled>Tidak Hadir</option>
                                                                        <option value="{{ $xxx->id_absen }}">Hadir</option>
                                                                    </select>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light"
                                    style="float: right;">Simpan
                                    Absen</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
