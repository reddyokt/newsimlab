@extends('layouts.master')
@section('title')
    Alat_Praktikum
@endsection

@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/magnific-popup/magnific-popup.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Alat Praktikum
        @endslot
        @slot('title')
            Alat Praktikum List
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
                                <a href="/alat/create" class="btn btn-success waves-effect waves-light"><i
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
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Merk</th>
                                    <th scope="col">Ukuran</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Lokasi</th>

                                    <th scope="col" style="width: 200px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alat as $alat)
                                    <tr>
                                        <td style="width: 5%;">{{ $loop->iteration }}</td>
                                        <td style="width: 30%;">
                                            @if (!empty($alat->images) && file_exists(base_path() . '/public/upload/inventory/alat/' . $alat->images))
                                                <a class="image-popup-vertical-fit"
                                                    href="{{ '/../upload/inventory/alat/' . $alat->images }}">
                                                    <img class="img-fluid avatar-sm rounded-circle me-2" alt=""
                                                        src="{{ '/../upload/inventory/alat/' . $alat->images }}"
                                                        width="145">
                                                </a>
                                            @else
                                                <img class="avatar-sm rounded-circle me-2"
                                                    src="{{ asset('assets/media/users/default.jpg') }}" alt="user" />
                                            @endif
                                            <span><a href="#" class="text-body">{{ $alat->nama }}</a></span>

                                        </td>
                                        <td>{{ $alat->jenis }}</td>
                                        <td>{{ $alat->merk }}</td>
                                        <td>{{ $alat->ukuran }}</td>
                                        <td>{{ $alat->jumlah }}</td>
                                        <td style="width: 30%;">
                                            Lokasi : {{ $alat->lokasi }}<br>
                                            Lemari : {{ $alat->lemari }}<br>
                                            Baris/Kolom : {{ $alat->baris }}/{{ $alat->kolom }}
                                        </td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="/alat/edit/" class="px-2 text-primary"><i
                                                            class="uil uil-pen font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="/alat/delete/" class="px-2 text-danger"><i
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