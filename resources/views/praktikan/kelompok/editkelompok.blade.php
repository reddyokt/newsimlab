@extends('layouts.master')
@section('title')
    Edit Kelompok
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Edit
        @endslot
        @slot('title')
            Edit Kelompok
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('flashmessage')
                <div class="card-body">
                    <h5> Data Kelompok </h5>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" class="control-label">Nama Kelas</label>
                                <select class="select2 form-control" name="id_kelas" id="matkuls" data-live-search="true">
                                    @foreach ($kelas as $value)
                                        <option
                                            value="{{ $value->id_kelas }} {{ $value->id_kelas == $edit->id_kelas ? 'selected' : '' }}">
                                            Kelas {{ $value->nama_kelas }} |
                                            {{ $value->nama_matkul }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="name">Nama Kelompok</label>
                                <input id="name" name="name" type="text" class="form-control"
                                    value="{{ $edit->nama_kelompok }}" placeholder="Masukkan nama kelompok">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($peserta == null)
            @else
                <div class="card" style="background: #F2D2BD">
                    <form action="/kelompok/tambahmhs/{{$edit->id_kelompok}}" method="POST" id="tambahMhs">
                        @csrf
                        <div class="card-body">
                            <input type="hidden" value="{{ $edit->id_kelas }}" name="id_kelas">
                            <input type="hidden" value="{{ $edit->id_kelompok }}" name="id_kelompok">
                            <h5>Mahasiswa Belum Memiliki Kelompok</h5>
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
                                            <td><input type="checkbox" value="{{ $peserta->id }}" name="id_mhs[]">
                                            </td>
                                            <td> {{ $peserta->nim }} </td>
                                            <td> {{ $peserta->nama }} </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success waves-effect waves-light">Tambahkan ke
                                Kelompok</button>
                        </div>
                    </form>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h5>Daftar Mahasiswa di Kelompok ini</h5>
                    <table id="datatable" class="table table-bordered dt-responsive wrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($edit->mhskelas as $kelompok)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kelompok->mhs->nim }}</td>
                                    <td>{{ $kelompok->mhs->nama_mahasiswa }}</td>
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="/kelompok/deletemhs/{{ $kelompok->id_mahasiswa_kelas }}"
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
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
