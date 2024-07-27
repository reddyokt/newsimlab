@extends('layouts.master-layouts')
@section('title')
    Modul Kelas
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Modul
        @endslot
        @slot('title')
            {{-- Kelas {{ $kelas->nama_kelas }} - {{ $kelas->matkul }} --}}
        @endslot
    @endcomponent

    <div class="row">
        @include('flashmessage')
        @foreach ($kelas as $x)
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="/tanggal/create/{{ $x->id_modulkelas }}" method="POST">
                            @csrf
                            <p style="font-weight: 800;"> Nama Kelas : {{ $x->nama_kelas }} - {{ $x->matkul }} </p>
                            <p style="font-weight: 800;"> Nama Modul : {{ $x->modul }} </p>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Praktek</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control datepicker" placeholder="dd M, yyyy"
                                            data-date-format="dd M, yyyy" data-date-container='#datepicker'
                                            data-provide="datepicker" id="datepicker{{ $x->id_modulkelas }}" name="tanggal" required>

                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light"
                                id="sa-add-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/datepicker/datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>

    <script>
        $(function() {
            $(".datepicker").datepicker();
        });
    </script>
@endsection
