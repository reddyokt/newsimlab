@extends('layouts.master')
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
                @include('flashmessage')
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive wrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kelas</th>
                                <th>Nama Modul</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allkelas as $kelas)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>Kelas {{$kelas->nama_kelas}} - {{$kelas->matkul->nama_matkul}}</td>
                                    <td>
                                        <ul class="list-unstyled product-desc-list text-muted">
                                            @foreach ($kelas->matkul->modul as $x)
                                                    <li><a href="/absen/modul/{{$x->id_modul}}" data-bs-toggle="modal" data-bs-target="#absenmodul{{$x->id_modul}}"><i class="mdi mdi-circle-medium me-1 align-middle"></i>
                                                            {{ $x->modul_name }}</a>
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
        <div class="modal fade" id="absenmodul{{$x->id_modul}}" tabindex="-1" role="dialog" aria-labelledby="myMediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Isi Absensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                        <form action="/absen/modul/{{$x->id_modul}}" method="POST" id="createabsen">
                            @csrf
                            <div class="row" id="tblmhs">
                                <input type="text" name="id_kelas" value="{{$kelas->id_kelas}}">
                                <input type="text" name="id_kelas" value="{{$x->id_modul}}">
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kelas->mhskelas as $kelas)
                                                    <tr>
                                                        <td><input type="checkbox" value="{{ $kelas->id_mahasiswa}}"
                                                                name="id_mhs[]">
                                                        </td>
                                                        <td> {{ $kelas->mhs->nim }} </td>
                                                        <td> {{ $kelas->mhs->nama_mahasiswa }} </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                                
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light" style="float: right;">Simpan
                                Absen</button>
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
