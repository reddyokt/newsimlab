@extends('layouts.master-layouts')
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
                                <th>Pertemuan</th>
                                <th>Dosen Pengampu</th>
                                <th>Asisten Lab</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $data)
                                <tr class="font-size-12">
                                    <td style="width: 2%;">{{ $loop->iteration }}</td>
                                    <td>
                                        Kelas {{ $data->nama_kelas }}
                                        <p>{{ $data->matkul->nama_matkul }} / {{ $data->matkul->kode_matkul }} </p>
                                    </td>
                                    <td>{{ $data->periode->tahun_ajaran }} - {{ $data->periode->semester }}</td>
                                    <td style="width: 30%;">
                                        <ul class="list-unstyled product-desc-list text-muted">
                                            <p class="text-primary">Jumlah Modul = {{ $data->modulkelas->count() }}</p>
                                            @foreach ($data->pertemuan as $x)
                                                <li class="text-primary" ><i
                                                        class="mdi mdi-circle-medium me-1 align-middle"></i>
                                                    {{ $x->nama_pertemuan }} |
                                                    @if ($x->tanggal== null)
                                                        <a href="/kelas/detail/{{ $x->id_kelas }}#navtabs-pertemuan">
                                                            <span class="text-danger">masukkan tanggal
                                                                praktek</span>
                                                        </a>
                                                    @else
                                                        <a href="/tanggal/edit/{{ $x->id_pertemuan }}">
                                                            <span class="text-primary">
                                                                {{ \Carbon\Carbon::parse($x->tanggal)->isoFormat('dddd, D MMMM Y') }}
                                                            </span>
                                                        </a>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td><p class="text-primary">{{ $data->dosen->nama_dosen }} </p></td>
                                    <td>
                                        @if ($data->id_aslab != null)
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#editAslab{{ $data->id_kelas }}">
                                                <p class="text-primary"> {{ $data->aslab->nama_aslab }} </p>
                                            </a>
                                        @else
                                            <a href="/kelas/detail/{{$data->id_kelas}}">
                                                <p class="text-danger">Asisten Lab belum ditunjuk!</p>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="/kelas/detail/{{$data->id_kelas}}" class="px-2 text-success"><i
                                                        class="uil uil-eye font-size-12"></i></a>
                                            </li>
                                            {{-- <li class="list-inline-item">
                                                <a href="/kelas/edit/" class="px-2 text-primary"><i
                                                        class="uil uil-pen font-size-12"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="/kelas/delete/" class="px-2 text-danger"><i
                                                        class="uil uil-trash-alt font-size-12"></i></a>
                                            </li> --}}
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
    @foreach ($kelas as $x => $kelas)
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
