@extends('layouts.master-layouts')
@section('title')
    @lang('translation.Starter_Page')
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Ujian
        @endslot
        @slot('title')
            Preview Ujian
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="col-xl-10 mx-auto d-block">
                <div class="card">
                    <div class="card-body  bg-secondary bg-gradient">
                        <h1 class="card-title text-center text-white" style="font-size: 22px;">Soal Ujian
                            @if ($detailujian->jenis == 'awal')
                                Awal
                            @elseif ($detailujian->jenis == 'akhir')
                                Akhir
                            @endif
                            <h6 class="card-subtitle font-14 text-white text-center mb-1">Kelas
                                {{ $detailujian->klsuji->nama_kelas }} - {{ $detailujian->klsuji->matkul->nama_matkul }}
                            </h6>

                            @if ($detailujian->status == 'approved')
                                <button class="btn btn-sm btn-primary mx-auto d-block border-white">
                                    <a href="/publishUjian/{{ $detailujian->id_ujian }}"
                                        onclick="return confirm('Yakin akan publish ujian ini?!')"
                                        class="px-2 text-white"><i class="uil uil-play-circle font-size-12"></i> Publish this</a>
                                </button>
                            @elseif ($role == 'SUP' || ($role == 'DPA' && $detailujian->status == 'waiting'))
                                <button class="btn btn-sm btn-success mx-auto d-block border-white">
                                    <a href="/validasiUjian/{{ $detailujian->id_ujian }}"
                                        onclick="return confirm('Yakin akan setujui ujian ini?!')"
                                        class="px-2 text-white"><i class="uil uil-check-circle font-size-12"></i> Approve
                                        this</a>
                                </button>
                            @endif
                    </div>
                    {{-- <hr> --}}
                    <div class="card-body col-xl-8 mx-auto d-block">
                        <p class="card-text">{!! $detailujian->uraian_ujian !!}</p>
                    </div>
                    <div class="card-footer col-xl-12 bg-secondary bg-gradient">
                        <div class="col-xl-8 mx-auto d-block">
                        <a class="mb-3 text-white" href="{{ '/../upload/ujian/' . $detailujian->file_ujian }}" target="_blank">
                            <span><i class="uil-file-download-alt"></i></span>File attachment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('landing/assets/js/theme.js') }}"></script>
@endsection
