@extends('layouts.master-layouts')
@section('title')
    Nilai Akhir
@endsection

@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/magnific-popup/magnific-popup.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Nilai Akhir
        @endslot
        @slot('title')
            List Nilai Akhir
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @include('flashmessage')
                <div class="card-body">
                    <h5 class="mb-3">Lihat Nilai By Periode</h5>
                    <form action="{{ route('nilaiakhirbyperiode') }}" method="POST">
                        @csrf
                        <div class="form-group mb-1" style="font-size:12px;">
                            <select class="form-control" name="periode" id="periode" required>
                                <option selected disabled>Pilih Periode</option>
                                @foreach ($periode as $x)
                                    <option value="{{ $x->id_periode }}">{{ $x->tahun_ajaran }} |
                                        {{ $x->semester }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-md btn-success" type="submit" style="float: right;">Lihat Nilai</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('flashmessage')
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <h5>List Nilai Mahasiswa Periode Aktif</h5>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="table-responsive mb-4">
                        <table id="datatable" class="table table-bordered dt-responsive wrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size:12px;">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Nama Mahasiswa</th>
                                    <th scope="col">Nilai Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $dt)
                                    <tr>
                                        <td style="width: 5%;">{{ $loop->iteration }}</td>
                                        <td>{{ $dt->mhs->nim }}</td>
                                        <td>{{ $dt->mhs->nama_mahasiswa }}</td>
                                        <td>{{ $dt->nilaiakhir }}</td>
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
