@extends('layouts.master')
@section('title')
    Dosen
@endsection

@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/magnific-popup/magnific-popup.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
        Dosen
        @endslot
        @slot('title')
        Dosen List
        @endslot
    @endcomponent

    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('flashmessage')
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <a href="/dosen/create" class="btn btn-success waves-effect waves-light"><i
                                        class="mdi mdi-plus me-2"></i> Add New</a>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="table-responsive mb-4">
                        <table id="datatable" class="table table-bordered dt-responsive wrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size:12px;">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">NIDN</th>
                                    <th scope="col">Nama Dosen</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">No Hp</th>
                                    <th scope="col" style="width: 200px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dosen as $dosen)
                                    <tr>
                                        <td style="width: 5%;">{{ $loop->iteration }}</td>
                                        <td>{{ $dosen->nidn }}</td>
                                        <td>{{ $dosen->nama_dosen }}</td>
                                        <td>{{ $dosen->userDosen->email }}</td>
                                        <td>{{ $dosen->userDosen->phone }}</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="/dosen/edit/{{$dosen->id_dosen}}" class="px-2 text-primary"><i
                                                            class="uil uil-pen font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="/dosen/delete/{{$dosen->id_dosen}}" class="px-2 text-danger"><i
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
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('script')
    <!-- Plugins js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/magnific-popup/magnific-popup.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/lightbox.init.js') }}"></script>
@endsection
