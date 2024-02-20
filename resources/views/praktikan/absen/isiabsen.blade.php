@extends('layouts.master')
@section('title')
    Isi Absen
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
           Isi  Absen
        @endslot
        @slot('title')
            by Modul
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('flashmessage')
                <div class="card-body">
                    <div class="modal-body">
                        <form action="/absen/modul/{{ $absen->id_modulkelas }}" method="POST" id="createabsen">
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
                                                @foreach ($mhs->absmod as $xxx)
                                                    <tr>
                                                        <td>
                                                            @if ($xxx->isAbsen == 0)
                                                                <input type="checkbox" value="{{ $xxx->id_absen }}"
                                                                    name="id_absen[]">
                                                            @elseif ($xxx->isAbsen == 1)
                                                                <input type="checkbox" value="{{ $xxx->id_absen }}"
                                                                    name="id_absen_not[]" checked>
                                                            @endif
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
                                                            @if ($xxx->isAbsen == 0)
                                                                Tidak Hadir
                                                            @else
                                                                Hadir
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
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- Center Modal example -->
    @foreach ($kelas->modulkelas as $x)
    
        <div class="modal fade" id="absenModul-{{ $x->id_modulkelas }}" tabindex="-1" role="dialog"
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
                                            {{-- <tbody>
                                                @foreach ($x->absmod as $xxx)
                                                    <tr>
                                                        <td>
                                                            @if ($xxx->isAbsen == 0)
                                                                <input type="checkbox" value="{{ $xxx->id_absen }}"
                                                                    name="id_absen[]">
                                                            @elseif ($xxx->isAbsen == 1)
                                                                <input type="checkbox" value="{{ $xxx->id_absen }}"
                                                                    name="id_absen_not[]" checked>
                                                            @endif
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
                                                            @if ($xxx->isAbsen == 0)
                                                                Tidak Hadir
                                                            @else
                                                                Hadir
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody> --}}
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
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
