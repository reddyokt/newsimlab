@extends('layouts.master-layouts')
@section('title')
    Edit Matkul
@endsection
@section('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Mata Kuliah
        @endslot
        @slot('title')
            Edit
        @endslot
    @endcomponent

    <div class="row" style="min-height: 800px;">
        <div class="col-12">
            <div class="card">
            @include('flashmessage')
                <div class="card-body">
                    <h4 class="card-title">Isi Data</h4>
                    <p class="card-title-desc">Lengkapi field dibawah ini untuk edit Mata Kuliah</p>
                    <form action="/matkul/edit/{{$data->id_matkul}}" method="POST" id="editmatkul">
                        @csrf
                        <input type="hidden" value="{{ Auth::id() }}" name="id">
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <label class="form-label">Nama Mata Kuliah</label>
                                    <div class="input-group">
                                        <input class="form-group form-control" type="text" id="name" name="name"
                                        placeholder="masukkan nama kelas" value="{{$data->nama_matkul}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <label class="form-label">Kode Mata Kuliah</label>
                                    <div class="input-group">
                                        <input class="form-group form-control" type="text" id="kode" name="kode"
                                        placeholder="masukkan kode" value="{{$data->kode_matkul}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <label class="form-label">Jumlah Modul</label>
                                    <div class="input-group">
                                        <input class="form-group form-control" type="nums" id="jumlah" name="jumlah"
                                        placeholder="masukkan jumlah" value="{{$data->jumlah_modul}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex flex-wrap gap-3">
                            <button type="submit" class="btn btn-primary waves-effect waves-light"
                                id="sa-add-success">Simpan</button>

                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection

@section('script')
    <script src="{{ asset('assets/js/account.js') }}"></script>
@endsection
