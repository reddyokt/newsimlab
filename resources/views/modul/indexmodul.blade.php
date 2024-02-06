@extends('layouts.master')
@section('title')
    Modul
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Modul
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
                    <a href="/modul/create" type="button" class="btn btn-success waves-effect waves-light mb-3">
                        Create Modul</a>
                    <table id="datatable" class="table table-bordered dt-responsive wrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kelas</th>
                                <th>Nama Modul</th>
                                <th>Alat</th>
                                <th>Bahan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modul as $modul)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$modul->matkul->nama_matkul}}</td>
                                    <td>{{$modul->modul_name}}</td>
                                    <td>
                                        <ul class="list-unstyled product-desc-list text-muted">
                                            @foreach ($modul->alat as $x)
                                                    <li><i class="mdi mdi-circle-medium me-1 align-middle"></i>
                                                            {{ $x->alats->nama_alat }} = {{$x->jumlah}}
                                                    </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled product-desc-list text-muted">
                                            @foreach ($modul->bahan as $x)
                                                    <li><i class="mdi mdi-circle-medium me-1 align-middle"></i>
                                                            {{ $x->bahans->nama_bahan }}({{$x->bahans->rumus }}) = {{$x->jumlah}}
                                                    </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="/modul/edit/{{$modul->id_modul}}"
                                                        class="px-2 text-primary"><i
                                                            class="uil uil-pen font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="/modul/delete/{{$modul->id_modul}}"
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
