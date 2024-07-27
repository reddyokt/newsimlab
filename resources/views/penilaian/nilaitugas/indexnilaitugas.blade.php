@extends('layouts.master-layouts')
@section('title')
    Nilai Tugas
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@if ($noperiode == 1)
<div class="row">
    <div class="col-lg-12">
        <h5 class="text-danger">Tidak ada Periode Aktif!, Tidak bisa buat Kelompok. Silahkan buat
            periode dan kelas terlebih dahulu</h5>
    </div>
</div>
@else
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Nilai Tugas
        @endslot
        @slot('title')
            All Kelas
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('flashmessage')
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
                                <th>Nama Modul</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $key => $x)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $x->periode->semester }} -
                                        {{ $x->periode->tahun_ajaran }}</td>
                                    <td>Kelas {{ $x->nama_kelas }} -
                                        {{ $x->matkul->nama_matkul }}</td>
                                    {{-- <td>{{ $kelompok->nama_kelompok }}</td> --}}
                                    <td>
                                        <ul class="list-unstyled product-desc-list text-muted">
                                            @foreach ($x->modulkelas as $x)
                                                <li><a href="/nilaitugas/modul/{{$x->id_modulkelas}}"><i class="mdi mdi-circle-medium me-1 align-middle"></i>
                                                    {{ $x->moduls->modul_name }}</a>
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
        </div>
    </div>

@endif
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
