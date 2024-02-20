@extends('layouts.master')
@section('title')
    Jawaban Tugas
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Jawaban Tugas
        @endslot
        @slot('title')
            by Modul
        @endslot
    @endcomponent

    <div class="row">
        @include('flashmessage')
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Detail Kelas</h4>
                    <p class="card-title-desc">
                        Kelas {{ $kelas->nama_kelas }} - {{ $matkul->nama_matkul }} <br>
                        Tahun Ajaran : {{ $periode->tahun_ajaran }} -
                        {{ $periode->semester }}<br>
                        Nama Modul : {{ $modul->modul_name }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
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
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mx-auto d-block text-center">Nilai</h4>
                    @if ($pre_test == null)
                        Pre Test Belum bisa dinilai
                    @elseif ($pre_test->nilai == null)
                        Pre Test : 0
                    @elseif($pre_test->nilai != null)
                        Pre Test : {{ $pre_test->nilai }}
                    @endif
                    <br>
                    @if ($post_test == null)
                        Post Test Belum bisa dinilai
                    @elseif ($post_test->nilai == null)
                        Post Test : 0
                    @elseif ($post_test->nilai != null)
                        Post Test : {{ $post_test->nilai }}
                    @endif
                    <br>
                    @if ($report == null)
                        Laporan Belum bisa dinilai
                    @elseif ($report->nilai == null)
                        Laporan : 0
                    @elseif ($report->nilai != null)
                        Laporan : {{ $report->nilai }}
                    @endif
                    <br>
                    @if ($subject == null)
                        Nilai Subjectif Belum bisa dinilai
                    @elseif ($subject->nilai == null)
                        Subjektif : 0
                    @elseif ($subject->nilai != null)
                        Subjektif : {{ $subject->nilai }}
                    @endif
                    <br>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-primary border-primary">
                    <h4 class="card-title text-white">Pre Test</h4>
                </div>
                <div class="card-body">
                    @if ($pre_test == null)
                        <h5 class="text-danger">Pre Test Belum bisa dinilai</h5>
                    @elseif ($pre_test->uraian_jawaban == null)
                        <label class="text-primary">Uraian Jawaban</label>
                        <h5>Jawaban Belum di-Upload</h5>
                    @elseif($pre_test->uraian_jawaban != null)
                        <label class="text-primary">Uraian Jawaban</label>
                        {!! $pre_test->uraian_jawaban !!}
                    @endif

                    @if ($pre_test == null)
                        <span><i class="uil-file-download-alt text-danger"> Tidak ada File
                                Jawaban</i></span>
                    @elseif ($pre_test->file_jawaban == null)
                        <span><i class="uil-file-download-alt text-danger"> Tidak ada File
                                Jawaban</i></span>
                    @elseif ($pre_test->file_jawaban != null)
                        <a class="mb-3 text-primary" href="{{ '/../upload/jawaban/tugas/' . $pre_test->file_jawaban }}"
                            target="_blank">
                            <span><i class="uil-file-download-alt"></i></span>File Jawaban</a>
                    @endif
                    <div class="col-md-12 mt-4">
                        @if ($pre_test == null)
                        @elseif ($pre_test->nilai == null)
                            <div class="col-md-2 p-2 border border-primary rounded" style="float: right;">
                                <form action="/tugas/isinilai/{{ $pre_test->id_nilai_tugas }}" method="POST">
                                    @csrf
                                    <h4 class="card-title display-3 text-primary text-center">Masukkan Nilai</h4>
                                    <input type="number" name="nilai" class="form-control mb-3" min="0"
                                        max="100">
                                    <button type="submit" class="btn btn-sm btn-warning" style="width: 100%;">Simpan Nilai
                                    </button>
                                </form>
                            </div>
                        @elseif ($pre_test->nilai != null)
                            <div class="col-md-2 p-2 border border-primary rounded" style="float: right;">
                                <h4 class="card-title display-3 text-primary text-center">Nilai <i
                                        class="uil uil-check-circle"></i>
                                </h4>
                                <h5 class="display-3 text-primary text-center"> {{ $pre_test->nilai }}
                                </h5>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editNilaiPreTest{{ $pre_test->id_nilai_tugas }}"
                                    style="width: 100%;">Edit !?</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-primary border-primary">
                    <h4 class="card-title text-white">Post Test</h4>
                </div>
                <div class="card-body">
                    @if ($post_test == null)
                        <h5 class="text-danger">Pre Test Belum bisa dinilai</h5>
                    @elseif ($post_test->uraian_jawaban == null)
                        <label class="text-primary">Uraian Jawaban</label>
                        <h5>Jawaban Belum di-Upload</h5>
                    @elseif($post_test->uraian_jawaban != null)
                        <label class="text-primary">Uraian Jawaban</label>
                        {!! $post_test->uraian_jawaban !!}
                    @endif

                    @if ($post_test == null)
                        <span><i class="uil-file-download-alt text-danger"> Tidak ada File
                                Jawaban</i></span>
                    @elseif ($post_test->file_jawaban == null)
                        <span><i class="uil-file-download-alt text-danger"> Tidak ada File
                                Jawaban</i></span>
                    @elseif ($post_test->file_jawaban != null)
                        <a class="mb-3 text-primary" href="{{ '/../upload/jawaban/tugas/' . $post_test->file_jawaban }}"
                            target="_blank">
                            <span><i class="uil-file-download-alt"></i></span>File Jawaban</a>
                    @endif

                    <div class="col-md-12 mt-4">
                        @if ($post_test == null)
                        @elseif ($post_test->nilai == null)
                            <div class="col-md-2 p-2 border border-primary rounded" style="float: right;">
                                <form action="/tugas/isinilai/{{ $post_test->id_nilai_tugas }}" method="POST">
                                    @csrf
                                    <h4 class="card-title display-3 text-primary text-center">Masukkan Nilai</h4>
                                    <input type="number" name="nilai" class="form-control mb-3" min="0"
                                        max="100">
                                    <button type="submit" class="btn btn-sm btn-warning" style="width: 100%;">Simpan Nilai
                                    </button>
                                </form>
                            </div>
                        @elseif ($post_test->nilai != null)
                            <div class="col-md-2 p-2 border border-primary rounded" style="float: right;">
                                <h4 class="card-title display-3 text-primary text-center">Nilai <i
                                        class="uil uil-check-circle"></i>
                                </h4>
                                <h5 class="display-3 text-primary text-center"> {{ $post_test->nilai }}
                                </h5>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editNilaiPostTest{{ $post_test->id_nilai_tugas }}"
                                    style="width: 100%;">Edit !?</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-primary border-primary">
                    <h4 class="card-title text-white">Laporan</h4>
                </div>
                <div class="card-body">
                    @if ($report == null)
                        <h5 class="text-danger">Laporan Belum bisa dinilai</h5>
                    @elseif ($report->uraian_jawaban == null)
                        <label class="text-primary">Uraian Jawaban</label>
                        <h5>Jawaban Belum di-Upload</h5>
                    @elseif($report->uraian_jawaban != null)
                        <label class="text-primary">Uraian Jawaban</label>
                        {!! $report->uraian_jawaban !!}
                    @endif

                    @if ($report == null)
                        <span><i class="uil-file-download-alt text-danger"> Tidak ada File
                                Jawaban</i></span>
                    @elseif ($report->file_jawaban == null)
                        <span><i class="uil-file-download-alt text-danger"> Tidak ada File
                                Jawaban</i></span>
                    @elseif ($report->file_jawaban != null)
                        <a class="mb-3 text-primary" href="{{ '/../upload/jawaban/tugas/' . $report->file_jawaban }}"
                            target="_blank">
                            <span><i class="uil-file-download-alt"></i></span>File Jawaban</a>
                    @endif

                    <div class="col-md-12 mt-4">
                        @if ($report == null)
                        @elseif ($report->nilai == null)
                            <div class="col-md-2 p-2 border border-primary rounded" style="float: right;">
                                <form action="/tugas/isinilai/{{ $report->id_nilai_tugas }}" method="POST">
                                    @csrf
                                    <h4 class="card-title display-3 text-primary text-center">Masukkan Nilai</h4>
                                    <input type="number" name="nilai" class="form-control mb-3" min="0"
                                        max="100">
                                    <button type="submit" class="btn btn-sm btn-warning" style="width: 100%;">Simpan
                                        Nilai
                                    </button>
                                </form>
                            </div>
                        @elseif ($report->nilai != null)
                            <div class="col-md-2 p-2 border border-primary rounded" style="float: right;">
                                <h4 class="card-title display-3 text-primary text-center">Nilai <i
                                        class="uil uil-check-circle"></i>
                                </h4>
                                <h5 class="display-3 text-primary text-center"> {{ $report->nilai }}
                                </h5>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editNilaiReport{{ $report->id_nilai_tugas }}"
                                    style="width: 100%;">Edit !?</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-primary border-primary">
                    <h4 class="card-title text-white">Penilaian Subjektif</h4>
                </div>
                <div class="card-body">
                    @if ($subject == null)
                        <h5 class="text-danger">Penilaian Subjektif Belum bisa dilakukan</h5>
                    @endif
                    <div class="col-md-12 p-2">
                        @if ($subject == null)
                        @elseif ($subject->nilai == null)
                            <form action="/subjektif/isinilai/{{ $subject->id_nilai_subjektif }}" method="POST">
                                @csrf
                                <div class="col-md-12 mb-2">
                                    <label class="text-primary">Uraian Penilaian</label>
                                    <textarea class="col-md-12 form-control" id="body" name="body"></textarea>
                                </div>
                                <div class="col-md-2">
                                    <label class="text-primary">Masukkan Nilai Subjektif</label>
                                    <input type="number" name="nilai" class="form-control mb-3" min="0"
                                        max="100">
                                </div>
                                <button type="submit" class="btn btn-sm btn-warning">Simpan Nilai
                                </button>
                            </form>
                        @elseif ($subject->nilai != null)
                            @if ($subject->uraian != null)
                                <label class="text-primary">Uraian Penilaian</label>
                                {!! $subject->uraian !!}
                            @else
                            @endif
                            <div class="col-md-2 p-2 border border-primary rounded" style="float: right;">
                                <h4 class="card-title display-3 text-primary">Nilai <i class="uil uil-check-circle"></i>
                                </h4>
                                <h5 class="display-3 text-primary text-center"> {{ $subject->nilai }}
                                </h5>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editNilaiSubject{{ $subject->id_nilai_subjektif }}"
                                    style="width: 100%;">Edit !?</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<!------------------------------------------Modal---------------------------------------------------------------------------->
@if ($pre_test == null)
@else
    <div class="modal fade" id="editNilaiPreTest{{ $pre_test->id_nilai_tugas }}" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Nilai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/tugas/isinilai/{{ $pre_test->id_nilai_tugas }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 mx-auto d-block">
                                <div class="mb-3">
                                    <input name="nilai" type="number" min="0" max="100"
                                        class="form-control font-size-20" value="{{ $pre_test->nilai }}"
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

@if ($post_test == null)
@else
    <div class="modal fade" id="editNilaiPostTest{{ $post_test->id_nilai_tugas }}" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Nilai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/tugas/isinilai/{{ $post_test->id_nilai_tugas }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 mx-auto d-block">
                                <div class="mb-3">
                                    <input name="nilai" type="number" min="0" max="100"
                                        class="form-control font-size-20" value="{{ $post_test->nilai }}"
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

@if ($report == null)
@else
    <div class="modal fade" id="editNilaiReport{{ $report->id_nilai_tugas }}" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Nilai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/tugas/isinilai/{{ $report->id_nilai_tugas }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 mx-auto d-block">
                                <div class="mb-3">
                                    <input name="nilai" type="number" min="0" max="100"
                                        class="form-control font-size-20" value="{{ $report->nilai }}"
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

@if ($subject == null)
@else
    <div class="modal fade" id="editNilaiSubject{{ $subject->id_nilai_subjektif }}" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Nilai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/subjektif/isinilai/{{ $subject->id_nilai_subjektif }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 mx-auto d-block">
                                <div class="mb-3">
                                    <input name="nilai" type="number" min="0" max="100"
                                        class="form-control font-size-20" value="{{ $subject->nilai }}"
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

@section('script')
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/ckeditor/ckeditor.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-editor.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/modal.init.js') }}"></script>
    <script>
        ClassicEditor.defaultConfig = {
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    '|',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'insertTable',
                    '|'
                ]
            },
            table: {
                contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
            },
            language: 'en'
        };

        ClassicEditor
            .create(document.querySelector('#body'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
