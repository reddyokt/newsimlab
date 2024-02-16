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
            Rekap
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

                                <th>Nama Mahasiswa</th>
                                <th>Rekap</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rekap as $rek)
                                <tr>
                                    <td>
                                        {{ $rek->mhs->nim }} - {{ $rek->mhs->nama_mahasiswa }}
                                    </td>
                                    <td>

                                        Hadir : {{$rek->absensimhs()->where("isAbsen", "=", 1)->count()}} 
                                        Tidak Hadir : {{$rek->absensimhs()->where("isAbsen", "=", 0)->count()}} 
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
