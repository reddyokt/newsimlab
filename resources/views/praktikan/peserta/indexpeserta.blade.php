@extends('layouts.master-layouts')
@section('title')
    Peserta
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Peserta
        @endslot
        @slot('title')
            All Peserta
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
                            <h5 class="text-danger">Tidak ada Periode Aktif!, Tidak bisa import Peserta. Silahkan buat periode terlebih dahulu</h5>
                        </div>
                    </div>
                    @else
                    <form action="/peserta/import" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class=" form-group mb-1" style="font-size:12px;">
                            <select class="form-control" name="id_periode" id="id_periode" required>
                                    <option value="{{ $periode->id_periode }}">{{ $periode->tahun_ajaran }} | {{ $periode->semester }}
                                    </option>
                            </select>
                            @error('periode_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                        </div>
                        <div class="form-group row mb-3" style="font-size:12px;">
                            <div class="col">
                                <input
                                    accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                    class="form-control" type="file" id="dataimport" name="dataimport" required>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-success float-start " role="button">Import Data</button>
                        <a href="{{ asset('template/template_import_peserta_praktikum.xlsx') }}"
                            class="btn btn-sm btn-warning float-end " role="button">Template Excel</a>
                    </form>
                    @endif
                </div>
            </div>
            <div class="card">
                @include('flashmessage')
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive wrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Periode</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Kelas Praktikum</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peserta as $key => $peserta)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$peserta->semester}} - {{$peserta->tahun_ajaran}}</td>
                                    <td>{{$peserta->nim}}</td>
                                    <td>{{$peserta->nama}}</td>
                                    <td>{{$peserta->matkul}}</td>
                                    <td> </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
