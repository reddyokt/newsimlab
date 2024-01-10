@extends('layouts.master')
@section('title')
    @lang('translation.Basic_Elements')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Document
        @endslot
        @slot('title')
            Add New
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Isi Data</h4>
                    <p class="card-title-desc">Lengkapi field dibawah ini untuk menyimpan sebuah Dokumen Baru</p>
                    <form action="/document/create" method="POST" id="createnewdoc" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ Auth::id() }}" name="id">

                        <div class="mb-3 row">
                            <label for="code" class="col-md-2 col-form-label">Nama Document</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="name" name="name"
                                    placeholder="masukkan name file" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="form-label col-md-2 col-form-label">Pilih Jenis File</label>
                            <div class="col-md-10">
                                <select class="select2 form-control select2-multiple" name="filetype" id="filetype">
                                    @foreach ($filetype as $key => $value)
                                        <option value="{{ $value->id_filetype }}">{{ $value->filename }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="form-label col-md-2 col-form-label" for="uploaded_doc">Upload Berkas File <br> <i
                                    class="text-danger" style="font-size: 10px;">hanya menerima type file pdf, jpeg,
                                    png</i></label>
                            <div class="col-md-10">
                                <input id="uploaded_doc" name="uploaded_doc" type="file" class="form-control"
                                    accept="image/png, image/jpeg, application/pdf" placeholder="#">
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-3">
                            {{-- <button type="submit" class="btn btn-primary waves-effect waves-light w-md">Submit</button> --}}
                            <button type="submit" class="btn btn-primary waves-effect waves-light"
                                id="sa-add-success">Simpan </button>

                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
@section('script')
    <!-- Sweet Alerts js -->
    <script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Range slider init js-->
    <script src="{{ URL::asset('/assets/js/pages/sweet-alerts.init.js') }}"></script>
@endsection
