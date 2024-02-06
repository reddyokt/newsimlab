@extends('layouts.master')
@section('title')
    Kelompok
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Kelompok Aktif
        @endslot
        @slot('title')
            All Kelompok
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('flashmessage')
                <div class="card-body">
                    @if ($noperiode == 1)
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="text-danger">Tidak ada Periode Aktif!, Tidak bisa buat Kelompok. Silahkan buat
                                    periode dan kelas terlebih dahulu</h5>
                            </div>
                        </div>
                    @else
                        <form action="/kelompok/create" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex flex-wrap gap-3">
                                <button type="button" class="btn btn-primary waves-effect waves-light"
                                    data-bs-toggle="modal" data-bs-target=".modalkelompok">Buat Kelompok</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-body">
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
                            @foreach ($pesertakelompok as $key => $kelompok)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kelompok->kelas->periode->semester }} -
                                        {{ $kelompok->kelas->periode->tahun_ajaran }}</td>
                                    <td>Kelas {{ $kelompok->kelas->nama_kelas }} -
                                        {{ $kelompok->kelas->matkul->nama_matkul }}</td>
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
                                                    class="px-2 text-primary"><i class="uil uil-pen font-size-18"></i></a>
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
    </div>
    <!-- Center Modal example -->
    <div class="modal fade modalkelompok" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buat Kelompok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    @if ($peserta == null)
                        <p class="text-center text-danger">Tidak ada Mahasiswa tersedia/Semua Mahasiswa telah memiliki Kelompok</p>
                    @else
                        <form action="/kelompok/create" method="POST" id="createkelompok">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" class="control-label">Pilih Kelas</label>
                                        <select class="select2 form-control" name="id_kelas" id="matkuls"
                                            data-live-search="true">
                                            <option selected disabled>Pilih Kelas</option>
                                            @foreach ($kelas as $kelas)
                                                <option value="{{ $kelas->id_kelas }}">Kelas {{ $kelas->nama_kelas }} |
                                                    {{ $kelas->nama_matkul }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Nama Kelompok</label>
                                        <input id="name" name="name" type="text" class="form-control"
                                            placeholder="Masukkan nama kelompok">
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="tblmhs">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" class="control-label">Pilih Mahasiswa</label>
                                        <table id="mhs" class="table table-bordered dt-responsive wrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>NIM</th>
                                                    <th>Nama Mahasiswa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($peserta as $peserta)
                                                    <tr>
                                                        <td><input type="checkbox" value="{{ $peserta->id }}"
                                                                name="id_mhs[]">
                                                        </td>
                                                        <td> {{ $peserta->nim }} </td>
                                                        <td> {{ $peserta->nama }} </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan
                                    Kelompok</button>
                            </div>
                    @endif
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
@endsection
