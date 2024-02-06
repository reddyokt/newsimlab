@extends('layouts.master')
@section('title')
    Kelas
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Kelas
        @endslot
        @slot('title')
            All Kelas
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('flashmessage')
                <div class="card-body">
                    <a href="/kelas/create" type="button" class="btn btn-success waves-effect waves-light mb-3">
                        Create Kelas</a>
                    <table id="datatable" class="table table-bordered dt-responsive wrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kelas</th>
                                <th>Tahun Ajaran / Semester</th>
                                <th>Modul</th>
                                <th>Dosen Pengampu</th>
                                <th>Asisten Lab</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $kelas)
                                <tr class="font-size-12">
                                    <td style="width: 2%;">{{ $loop->iteration }}</td>
                                    <td>
                                        Kelas {{ $kelas->nama_kelas }}
                                        <p>{{ $kelas->matkul->nama_matkul }} / {{ $kelas->matkul->kode_matkul }} </p>
                                    </td>
                                    <td>{{ $kelas->periode->tahun_ajaran }} - {{ $kelas->periode->semester }}</td>
                                    <td style="width: 30%;">
                                        <ul class="list-unstyled product-desc-list text-muted">
                                            <p class="text-primary">Jumlah Modul = {{ $kelas->modulkelas->count() }}</p>
                                            @foreach ($kelas->modulkelas as $x)
                                                <li class="text-primary" ><i
                                                        class="mdi mdi-circle-medium me-1 align-middle"></i>
                                                    {{ $x->moduls->modul_name }} |
                                                    @if ($x->tanggal_praktek == null)
                                                        <a href="/tanggal/create/{{ $kelas->id_kelas }}">
                                                            <span class="text-danger">masukkan tanggal
                                                                praktek</span>
                                                        </a>
                                                    @else
                                                        <a href="/tanggal/edit/{{ $kelas->id_kelas }}">
                                                            <span class="text-primary">
                                                                {{ \Carbon\Carbon::parse($x->tanggal_praktek)->locale('id')->format('j F Y') }}
                                                            </span>
                                                        </a>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td><p class="text-primary">{{ $kelas->dosen->nama_dosen }} </p></td>
                                    <td>
                                        @if ($kelas->id_aslab != null)
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#editAslab{{ $kelas->id_kelas }}">
                                                <p class="text-primary"> {{ $kelas->aslab->nama_aslab }} </p>
                                            </a>
                                        @else
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#kelasAslab{{ $kelas->id_kelas }}">
                                                <p class="text-danger">Asisten Lab belum ditunjuk!</p>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="/kelas/detail/{{$kelas->id_kelas}}" class="px-2 text-success"><i
                                                        class="uil uil-eye font-size-12"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="/kelas/edit/" class="px-2 text-primary"><i
                                                        class="uil uil-pen font-size-12"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="/kelas/delete/" class="px-2 text-danger"><i
                                                        class="uil uil-trash-alt font-size-12"></i></a>
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
    <!-- Modal -->
    @foreach ($kelasx as $x => $kelas)
        <!-- Center Modal example -->
        <div class="modal fade" id="kelasAslab{{ $kelas->id_kelas }}" tabindex="-1" role="dialog"
            aria-labelledby="myMediumModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Asisten Lab</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/kelas/aslab/{{ $kelas->id_kelas }}" method="POST" id="createkelompok">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <select class="select2 form-control" name="aslab" id="aslab"
                                            data-live-search="true">
                                            <option selected disabled>Pilih Asisten Lab</option>
                                            @foreach ($aslab as $xx)
                                                {{-- {{dd($xx)}} --}}
                                                <option value="{{ $xx->id_aslab }}"> {{ $xx->nama_aslab }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Center Modal example -->
        <div class="modal fade" id="editAslab{{ $kelas->id_kelas }}" tabindex="-1" role="dialog"
            aria-labelledby="myMediumModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Asisten Lab</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/kelas/aslab/{{ $kelas->id_kelas }}" method="POST" id="createkelompok">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <select class="select2 form-control" name="aslab" id="aslab"
                                            data-live-search="true">
                                            @foreach ($aslab as $xxx)
                                                <option value="{{ $xxx->id_aslab }} {{ $xxx->id_aslab == $kelas->id_aslab ? 'selected' : '' }}"> {{ $xxx->nama_aslab }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
