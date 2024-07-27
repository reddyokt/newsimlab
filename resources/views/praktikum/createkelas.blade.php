@extends('layouts.master-layouts')
@section('title')
    Create_Kelas
@endsection
@section('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Kelas
        @endslot
        @slot('title')
            Add New
        @endslot
    @endcomponent

    @if ($noperiode == 1)
        <div class="row">
            <div class="col-lg-12">
                <h5>Tidak ada Periode Aktif!, Silahkan buat periode terlebih dahulu</h5>
            </div>
        </div>
    @else
        <div class="row" style="min-height: 800px;">
            <div class="col-12">
                <div class="card">
                    @include('flashmessage')
                    <div class="card-body">
                        <h4 class="card-title">Isi Data</h4>
                        <p class="card-title-desc">Lengkapi field dibawah ini untuk membuat sebuah Kelas Baru</p>
                        <p class="badge bg-soft-success font-size-12" value="{{ $periode->id_periode }}">
                            Periode Aktif :
                            {{ $datestart->format('l, j F Y') }} ~
                            {{ $dateend->format('l, j F Y') }}
                        </p>
                        <form action="/kelas/create" method="POST" id="createnewkelas">
                            @csrf
                            <input type="hidden" value="{{ Auth::id() }}" name="id">
                            <input type="hidden" value="{{ $periode->id_periode }}" name="id_periode">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <label class="form-label">Nama Kelas Praktikum</label>
                                        <div class="input-group">
                                            <input class="form-group form-control" type="text" id="name"
                                                name="name" placeholder="masukkan nama kelas" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Pilih Dosen Pengampu</label>
                                        <div class="input-group">
                                            <select class="form-control" name="dosen" id="dosen">
                                                <option selected disabled>Pilih Dosen Pengampu</option>
                                                <@foreach ($dosen as $dosen)
                                                    <option value="{{ $dosen->id_dosen }}">{{ $dosen->nama_dosen }}</option>
    @endforeach
    </select>
    </div>
    </div>
    </div>
    <div class="col-md-3">
        <div class="col-md-12">
            <label class="form-label">Pilih Mata Kuliah</label>
            <div class="input-group">
                <select class="form-control" name="matkul" id="matkul">
                    <option selected disabled>Pilih Mata Kuliah</option>
                    <@foreach ($matkul as $matkul)
                        <option value={{ $matkul->id_matkul }}>{{ $matkul->nama_matkul }}</option>
                        @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="col-md-12">
            <label class="form-label">Jumlah Pertemuan</label>
            <div class="input-group">
                <input class="form-group form-control" type="nums" id="jumlah" name="jumlah"
                    placeholder="masukkan jumlah">
            </div>
        </div>
    </div>
    </div>

    <div class="col-md-6" id="divkode" style="display: none;">
        <div class="col-md-12 mb-3">
            <label class="form-label" class="control-label">Kode Matkul</label>
            <select class="form-select form-control form-select-solid" name="kode" id="kode" data-control="select2"
                data-placeholder="{{ __('account.placeholder_kode') }}">
            </select>
            <input type="hidden" class="row" name="id_modul[]" id="modul">
        </div>
    </div>

    <div class="d-flex flex-wrap gap-3">
        <button type="submit" class="btn btn-primary waves-effect waves-light" id="sa-add-success">Simpan</button>
    </div>
    </form>
    </div>
    </div>
    </div> <!-- end col -->
    </div>
    <!-- end row -->
    @endif
@endsection

@section('script')
    <script src="{{ asset('assets/js/account.js') }}"></script>
@endsection
