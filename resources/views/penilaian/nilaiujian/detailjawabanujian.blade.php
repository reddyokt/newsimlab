@extends('layouts.master')
@section('title')
    Jawaban Ujian
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .row {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
        }

        .row>[class*='col-'] {
            display: flex;
            flex-direction: column;
        }
    </style>
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Jawaban Ujian
        @endslot
        @slot('title')
            by Kelas
        @endslot
    @endcomponent

    <div class="row">
        @include('flashmessage')
        <div class="col-xs-12 col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Detail Kelas</h4>
                    <p class="card-title-desc">
                        Kelas {{ $idkelas->nama_kelas }} - {{ $matkul->nama_matkul }} <br>
                        Tahun Ajaran : {{ $periode->tahun_ajaran }} -
                        {{ $periode->semester }}<br>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Nama Mahasiswa</h4>
                    @if (
                        !empty($user->profile_picture) &&
                            file_exists(base_path() . '/public/upload/profile_picture/' . $user->profile_picture))
                        <img src="{{ '/../upload/profile_picture/' . $$user->profile_picture }}" alt=""
                            class="avatar-md rounded-circle me-2">
                    @else
                        <img class="avatar-md rounded-circle me-2" src="{{ asset('assets/media/users/default.jpg') }}"
                            alt="user" />
                    @endif
                    <span>
                        {{ $user->name }} <br>
                        {{ $user->email }} {{ $user->phone }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mx-auto d-block text-center">Nilai</h4>
                    @if ($nilaiawal == null)
                        Ujian Awal Belum bisa dinilai
                    @elseif ($nilaiawal->nilai == null)
                        Ujian Awal : 0
                    @elseif($nilaiawal->nilai != null)
                        Ujian Awal : {{ $nilaiawal->nilai }}
                    @endif
                    <br>
                    @if ($nilaiakhir == null)
                        Ujian Akhir Belum bisa dinilai
                    @elseif ($nilaiakhir->nilai == null)
                        Ujian Akhir : 0
                    @elseif ($nilaiakhir->nilai != null)
                        Ujian Akhir : {{ $nilaiakhir->nilai }}
                    @endif
                    <br>
                    @if ($nilailisan == null)
                        Ujian Lisan Belum bisa dinilai
                    @elseif ($nilailisan->nilai_lisan == null)
                        Ujian Lisan : 0
                    @elseif ($nilailisan->nilai_lisan != null)
                        Ujian Lisan : {{ $nilailisan->nilai_lisan }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-primary border-primary">
                    <h4 class="card-title text-white">Ujian Awal</h4>
                </div>
                <div class="card-body">
                    @if ($nilaiawal == null)
                        <h5 class="text-danger">Ujian Awal Belum bisa dinilai</h5>
                    @elseif ($nilaiawal->uraian_jawaban == null)
                        <h5>Jawaban Belum di-Upload</h5>
                    @elseif($nilaiawal->uraian_jawaban != null)
                        {!! $nilaiawal->uraian_jawaban !!}
                    @endif

                    @if ($nilaiawal == null)
                        <span><i class="uil-file-download-alt text-danger"> Tidak ada File
                                Jawaban</i></span>
                    @elseif ($nilaiawal->file_jawaban == null)
                        <span><i class="uil-file-download-alt text-danger"> Tidak ada File
                                Jawaban</i></span>
                    @elseif ($nilaiawal->file_jawaban != null)
                        <a class="mb-3 text-primary" href="{{ '/../upload/jawaban/ujian/' . $nilaiawal->file_jawaban }}"
                            target="_blank">
                            <span><i class="uil-file-download-alt"></i></span>File Jawaban</a>
                    @endif
                    <div class="col-md-2 border rounded bg-primary p-2 mt-4">
                        @if ($nilaiawal == null)
                        @elseif ($nilaiawal->nilai == null)
                            <form action="/ujian/isinilai/{{ $nilaiawal->id_nilai_ujian }}" method="POST">
                                @csrf
                                <input type="number" name="nilai" class="form-control mb-3" min="0"
                                    max="100">
                                <button type="submit" class="btn btn-sm btn-warning">Simpan Nilai
                                </button>
                            </form>
                        @elseif ($nilaiawal->nilai != null)
                            <h4 class="card-title display-3 text-white mx-auto d-block text-center">Nilai <i
                                    class="uil uil-check-circle"></i></h4>
                            <h5 class="display-3 text-white mx-auto d-block text-center"> {{ $nilaiawal->nilai }}
                            </h5>
                            <button class="btn btn-warning btn-sm mx-auto d-block " data-bs-toggle="modal"
                                data-bs-target="#editNilaiPreTest{{ $nilaiawal->id_nilai_ujian }}">Edit !?</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-primary border-primary">
                    <h4 class="card-title text-white">Ujian Akhir</h4>
                </div>
                <div class="card-body">
                    @if ($nilaiakhir == null)
                        <h5 class="text-danger">Ujian Akhir Belum bisa dinilai</h5>
                    @elseif ($nilaiakhir->uraian_jawaban == null)
                        <h5>Jawaban Belum di-Upload</h5>
                    @elseif($nilaiakhir->uraian_jawaban != null)
                        {!! $nilaiakhir->uraian_jawaban !!}
                    @endif

                    @if ($nilaiakhir == null)
                        <span><i class="uil-file-download-alt text-danger"> Tidak ada File
                                Jawaban</i></span>
                    @elseif ($nilaiakhir->file_jawaban == null)
                        <span><i class="uil-file-download-alt text-danger"> Tidak ada File
                                Jawaban</i></span>
                    @elseif ($nilaiakhir->file_jawaban != null)
                        <a class="mb-3 text-primary" href="{{ '/../upload/jawaban/ujian/' . $nilaiakhir->file_jawaban }}"
                            target="_blank">
                            <span><i class="uil-file-download-alt"></i></span>File Jawaban</a>
                    @endif

                    <div class="col-md-2 border rounded bg-primary p-2 mt-3">
                        @if ($nilaiakhir == null)
                        @elseif ($nilaiakhir->nilai == null)
                            <form action="/ujian/isinilai/{{ $nilaiakhir->id_nilai_ujian }}" method="POST">
                                @csrf
                                <input type="number" name="nilai" class="form-control mb-3" min="0"
                                    max="100">
                                <button type="submit" class="btn btn-sm btn-warning">Simpan Nilai
                                </button>
                            </form>
                        @elseif ($nilaiakhir->nilai != null)
                            <h4 class="card-title display-3 text-white mx-auto d-block text-center">Nilai <i
                                    class="uil uil-check-circle"></i></h4>
                            <h5 class="display-3 text-white mx-auto d-block text-center"> {{ $nilaiakhir->nilai }}
                            </h5>
                            <button class="btn btn-warning btn-sm mx-auto d-block " data-bs-toggle="modal"
                                data-bs-target="#editNilaiPostTest{{ $nilaiakhir->id_nilai_ujian }}">Edit !?</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-primary border-primary">
                    <h4 class="card-title text-white">Ujian Lisan</h4>
                </div>
                <div class="card-body">
                    <div class="col-md-2 border rounded bg-primary p-2 mt-3">
                        @if ($nilailisan == null)
                        @elseif ($nilailisan->nilai_lisan == null)
                            <form action="/ujian/isinilailisan/{{ $nilailisan->id_nilai_lisan }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_nilai_lisan" value="{{ $nilailisan->id_nilai_lisan }}">
                                <input type="number" name="nilailisan" class="form-control mb-3" min="0"
                                    max="100">
                                <button type="submit" class="btn btn-sm btn-warning">Simpan Nilai
                                </button>
                            </form>
                        @elseif ($nilailisan->nilai_lisan != null)
                            <h4 class="card-title display-3 text-white mx-auto d-block text-center">Nilai <i
                                    class="uil uil-check-circle"></i></h4>
                            <h5 class="display-3 text-white mx-auto d-block text-center"> {{ $nilailisan->nilai_lisan }}
                            </h5>
                            <button class="btn btn-warning btn-sm mx-auto d-block " data-bs-toggle="modal"
                                data-bs-target="#editNilaiLisan{{ $nilailisan->id_nilai_lisan }}">Edit !?</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="row justify-content-end">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-primary border-primary">
                    <h4 class="card-title text-white">Laporan</h4>
                </div>
                <div class="card-body">
                    @if ($report == null)
                        <h5 class="text-danger">Laporan Belum bisa dinilai</h5>
                    @elseif ($report->uraian_jawaban == null)
                        <h5>Jawaban Belum di-Upload</h5>
                    @elseif($report->uraian_jawaban != null)
                        {!! $report->uraian_jawaban !!}

                        @if ($report == null)
                        @elseif ($report->file_jawaban == null)
                            <span><i class="uil-file-download-alt text-danger"> Tidak ada File
                                    Jawaban</i></span>
                        @elseif ($report->file_jawaban != null)
                            <a class="mb-3 text-primary" href="{{ '/../upload/jawaban/tugas/' . $report->file_jawaban }}"
                                target="_blank">
                                <span><i class="uil-file-download-alt"></i></span>File Jawaban</a>
                        @endif
                    @endif
                    <div class="col-md-2 border rounded bg-primary p-2 mt-4">
                        @if ($report == null)
                        @elseif ($report->nilai == null)
                            <form action="/ujian/isinilai/{{ $report->id_nilai_tugas }}" method="POST">
                                @csrf
                                <input type="number" name="nilai" class="form-control mb-3" min="0"
                                    max="100">
                                <button type="submit" class="btn btn-sm btn-warning">Simpan Nilai
                                </button>
                            </form>
                        @elseif ($report->nilai != null)
                            <h4 class="card-title display-3 text-white mx-auto d-block text-center">Nilai <i
                                    class="uil uil-check-circle"></i></h4>
                            <h5 class="display-3 text-white mx-auto d-block text-center"> {{ $report->nilai }}
                            </h5>
                            <button class="btn btn-warning btn-sm mx-auto d-block " data-bs-toggle="modal"
                                data-bs-target="#editNilaiReport{{ $report->id_nilai_tugas }}">Edit !?</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    @if ($nilaiawal == null)
    @else
        <div class="modal fade" id="editNilaiPreTest{{ $nilaiawal->id_nilai_ujian }}" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Nilai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/ujian/isinilai/{{ $nilaiawal->id_nilai_ujian }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 mx-auto d-block">
                                    <div class="mb-3">
                                        <input name="nilai" type="number" min="0" max="100"
                                            class="form-control font-size-20" value="{{ $nilaiawal->nilai }}"
                                            placeholder="Input nilai">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan Nilai
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($nilaiakhir == null)
    @else
        <div class="modal fade" id="editNilaiPostTest{{ $nilaiakhir->id_nilai_tugas }}" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Nilai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/ujian/isinilai/{{ $nilaiakhir->id_nilai_ujian }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 mx-auto d-block">
                                    <div class="mb-3">
                                        <input name="nilai" type="number" min="0" max="100"
                                            class="form-control font-size-20" value="{{ $nilaiakhir->nilai }}"
                                            placeholder="Input nilai">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan Nilai
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($nilailisan == null)
    @else
        <div class="modal fade" id="editNilaiLisan{{ $nilailisan->id_nilai_lisan }}" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Nilai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/ujian/isinilailisan/{{ $nilailisan->id_nilai_lisan }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 mx-auto d-block">
                                    <div class="mb-3">
                                        <input name="nilai" type="number" min="0" max="100"
                                            class="form-control font-size-20" value="{{ $nilailisan->nilai_lisan }}"
                                            placeholder="Input nilai">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan Nilai
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
