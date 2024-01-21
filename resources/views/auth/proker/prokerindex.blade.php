@extends('layouts.master')
@section('title')
    Post
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Post
        @endslot
        @slot('title')
            All Posts
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">              
                    <a href="/proker/create" type="button" class="btn btn-success waves-effect waves-light mb-3">
                        Create New </a>
                    <table id="datatable" class="table table-bordered dt-responsive wrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Nama Program Kerja</th>
                                <th>Waktu Pelaksanaan</th>
                                <th>Anggaran</th>
                                <th>Status</th>
                                <th>Pengusul</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prokerindex as $proker)
                                <tr>
                                    <td>{{ $proker->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($proker->start)->locale('id')->format('l, j F Y')}} ~ {{ \Carbon\Carbon::parse($proker->end)->locale('id')->format('l, j F Y')}}</td>
                                    <td>{{$proker->anggaran}}</td>
                                    <td>{{ $proker->status }}</td>
                                    <td>{{ $proker->username }}</td>
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="/proker/edit/{{ $proker->id_proker }}"
                                                    class="px-2 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="/proker/delete/{{ $proker->id_proker }}"
                                                    class="px-2 text-danger"><i
                                                        class="uil uil-trash-alt font-size-18"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="/proker/detail/{{$proker->id_proker}}" 
                                                    class="px-2 text-warning"><i
                                                        class="uil uil-eye font-size-18"></i></a>
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
