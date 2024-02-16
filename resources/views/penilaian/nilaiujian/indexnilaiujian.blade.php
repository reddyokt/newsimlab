@extends('layouts.master')
@section('title')
    Nilai Ujian
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
                Nilai Ujian
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelas as $key => $x)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $x->periode->semester }} -
                                            {{ $x->periode->tahun_ajaran }}</td>
                                        <td>
                                            <a href="/nilaiujian/kelas/{{ $x->id_kelas }}">
                                                Kelas {{ $x->nama_kelas }} -
                                                {{ $x->matkul->nama_matkul }}
                                            </a>
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
