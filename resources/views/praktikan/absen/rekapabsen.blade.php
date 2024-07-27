@extends('layouts.master-layouts')
@section('title')
    Absen Kelas {{$kelas->nama_kelas}} - {{$kelas->matkul->nama_matkul}} | Periode {{$kelas->periode->tahun_ajaran}} | {{$kelas->periode->semester}}
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
            Rekap
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('flashmessage')
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-bordered dt-responsive wrap"
                        style="border-collapse: collapse; border-spacing: 10; width: 100%;">
                        
                        <thead>
                            <tr>
                                <th colspan="3" class="text-center">Kelas {{$kelas->nama_kelas}} - {{$kelas->matkul->nama_matkul}}</th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Nama Mahasiswa</th>
                                <th>Rekap</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rekap as $rek)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td style="width:40%">
                                        {{ $rek->mhs->nim }} - {{ $rek->mhs->nama_mahasiswa }}
                                    </td>
                                    <td>
                                        Hadir : {{$rek->absensimhs()->where("isAbsen", "=", 'Hadir')->count()}}
                                        Tidak Hadir : {{$rek->absensimhs()->where("isAbsen", "=", 'Tidak Hadir')->count()}}
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
