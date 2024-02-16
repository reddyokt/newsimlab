@extends('layouts.master')
@section('title')
    @lang('translation.Starter_Page')
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Tugas
        @endslot
        @slot('title')
            Preview Tugas
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="col-xl-10 mx-auto d-block">
                <div class="card">
                    <div class="card-body  bg-secondary bg-gradient">
                        <h1 class="card-title text-center text-white" style="font-size: 22px;">Soal Tugas
                            @if ($detailtugas->jenis == 'pre_test')
                                Pre Test
                            @elseif ($detailtugas->jenis == 'post_test')
                                Post Test
                            @endif
                            <h6 class="card-subtitle font-14 text-white text-center mb-1">Kelas
                                {{ $detailtugas->tgskls->nama_kelas }} - {{ $detailtugas->tgskls->matkul->nama_matkul }} -
                                {{ $detailtugas->tgsmdl->moduls->modul_name }}
                            </h6>

                            @if ($detailtugas->status == 'approved')
                                <button class="btn btn-sm btn-primary mx-auto d-block border-white">
                                    <a href="/publishTugas/{{ $detailtugas->id_tugas }}"
                                        onclick="return confirm('Yakin akan publish tugas ini?!')"
                                        class="px-2 text-white"><i class="uil uil-play-circle font-size-12"></i> Publish
                                        this</a>
                                </button>
                            @elseif ($role == 'SUP' || ($role == 'DPA' && $detailtugas->status == 'waiting'))
                                <form action="/tugas/validasi/{{ $detailtugas->id_tugas }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_kelas" value="{{ $detailtugas->tgskls->id_kelas }}">
                                    <input type="hidden" name="id_periode" value="{{ $detailtugas->tgskls->periode->id_periode }}">
                                    <input type="hidden" name="id_modulkelas" value="{{ $detailtugas->tgsmdl->id_modulkelas }}">
                                    <button class="btn btn-sm btn-success mx-auto d-block border-white" type="submit"
                                        onclick="return confirm('Yakin akan setujui tugas ini?!')"
                                        class="px-2 text-white"><i class="uil uil-check-circle font-size-12"></i> Approve
                                        this</a>
                                    </button>
                                </form>
                            @endif
                    </div>
                    {{-- <hr> --}}
                    <div class="card-body col-xl-8 mx-auto d-block">
                        <p class="card-text">{!! $detailtugas->uraian_tugas !!}</p>
                    </div>
                    <div class="card-footer col-xl-12 bg-secondary bg-gradient">
                        @if ($detailtugas->file_tugas != Null)
                        <div class="col-xl-8 mx-auto d-block">
                            <a class="mb-3 text-white" href="{{ '/../upload/tugas/' . $detailtugas->file_tugas }}"
                                target="_blank">
                                <span><i class="uil-file-download-alt"></i></span>File attachment</a>
                        </div>
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('landing/assets/js/theme.js') }}"></script>
@endsection
