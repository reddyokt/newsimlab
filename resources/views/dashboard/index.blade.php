@extends('layouts.master')
@section('title')
    @lang('translation.Dashboard')
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .close-icon {
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            {{ Session::get('role_name') }}
        @endslot
        @slot('title')
            Dashboard
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            @include('flashmessage')
        </div>
    </div>
    
    @if ($role == 'MHS' || 'SUP')
        @if ($tugaspre == null && $tugaspost == null && $tugasrep == null)
        @else
            <div class="row">
                <div class="col-lg-12">
                    <div class="card bg-white border-primary text-primary-50">
                        <div class="card-body">
                            <h5 class="mb-4 text-primary"><i class="uil uil-notes me-3"></i>Kelas : {{ $kelas->nama_kelas }}
                                |
                                {{ $kelas->matkul->nama_matkul }}
                            </h5>
                            <div class="row">
                                @if ($tugaspre != null)
                                    <div class="col-lg-4">
                                        <div class="card bg-white border-primary text-primary-50">
                                            <div class="card-body">
                                                <h5 class="mb-4 text-primary">
                                                    <i class="uil uil-question-circle me-3"></i>
                                                    Pre Test
                                                    @if ($nilaitugaspre->uraian_jawaban == null)
                                                        <label class="text-danger mt-2"> Anda belum membuat jawaban tugas
                                                            ini!</label>
                                                    @else
                                                        <label class="text-success mt-2"> Anda sudah menjawab tugas
                                                            ini!</label>
                                                    @endif
                                                </h5>
                                                <a href="/mhs/tugas/detail/{{ $tugaspre->id_tugas }}"
                                                    class="btn btn-sm btn-warning">
                                                    View Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                @endif

                                @if ($tugaspost != null)
                                    <div class="col-lg-4">
                                        <div class="card bg-white border-primary text-primary-50">
                                            <div class="card-body">
                                                <h5 class="mb-4 text-primary">
                                                    <i class="uil uil-question-circle me-3"></i>
                                                    Post Test
                                                    @if ($nilaitugaspost->uraian_jawaban == null)
                                                        <label class="text-danger mt-2"> Anda belum membuat jawaban tugas
                                                            ini!</label>
                                                    @else
                                                        <label class="text-success mt-2"> Anda sudah menjawab tugas
                                                            ini!</label>
                                                    @endif
                                                </h5>
                                                <a href="/mhs/tugas/detail/{{ $tugaspost->id_tugas }}"
                                                    class="btn btn-sm btn-warning">
                                                    View Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                @endif

                                @if ($tugasrep != null)
                                    <div class="col-lg-4">
                                        <div class="card bg-white border-primary text-primary-50">
                                            <div class="card-body">
                                                <h5 class="mb-4 text-primary">
                                                    <i class="uil uil-question-circle me-3"></i>
                                                    Laporan
                                                    @if ($nilaitugasrep->uraian_jawaban == null)
                                                        <label class="text-danger mt-2"> Anda belum membuat jawaban tugas
                                                            ini!</label>
                                                    @else
                                                        <label class="text-success mt-2"> Anda sudah menjawab tugas
                                                            ini!</label>
                                                    @endif
                                                </h5>
                                                <a href="/mhs/tugas/detail/{{ $tugasrep->id_tugas }}"
                                                    class="btn btn-sm btn-warning">
                                                    View Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        @endif
    @endif

@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script>
        $('#newpass, #confnewpass').on('keyup', function() {
            if ($('#newpass').val() == $('#confnewpass').val()) {
                $('#message').html('Password Konfirmasi Cocok').css('color', 'green');
            } else
                $('#message').html('Password Konfirmasi Tidak Cocok').css('color', 'red');
        });
    </script>
    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
@endsection
