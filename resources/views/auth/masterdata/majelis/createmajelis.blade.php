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
            Majelis & Lembaga
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
                    <p class="card-title-desc">Lengkapi field dibawah ini untuk membuat sebuah Role Baru</p>
                    <form action="/majelis/create" method="POST" id="createnewmajelis">
                        @csrf
                        <input type="hidden" value="{{ Auth::id() }}" name="id">

                        <div class="mb-3 row align-middle" >
                            <label class="col-md-2 col-form-label">Pilih Majelis/Lembaga?</label>
                            {{-- <span class="col-md-2 col-form-label">Pilih Majelis/Lembaga?</span> --}}
                            <div class="form-check col-md-1">
                                <input class="form-check-input" type="radio" name="majelis/lembaga" id="formRadios1" checked value="majelis">
                                <label class="form-check-label" for="formRadios1">
                                    Majelis
                                </label>
                            </div>
                            <div class="form-check col-md-1">
                                <input class="form-check-input" type="radio" name="majelis/lembaga" id="formRadios2" value="lembaga">
                                <label class="form-check-label" for="formRadios2">
                                    Lembaga
                                </label>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="role_name" class="col-md-2 col-form-label">Nama Majelis/Lembaga</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="role_name" name="role_name"
                                    placeholder="masukkan Nama Majelis/Lembaga" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="code" class="col-md-2 col-form-label">CODE</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="code" name="code"
                                    placeholder="masukkan CODE" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="description" class="col-md-2 col-form-label">Description</label>
                            <div class="col-md-10">
                                <input class="form-control" type="description" id="description" name="description"
                                    placeholder="masukkan deskripsi Majelis/Lembaga" required>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-3">
                            {{-- <button type="submit" class="btn btn-primary waves-effect waves-light w-md">Submit</button> --}}
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
    <!-- Sweet Alerts js -->
    <script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Range slider init js-->
    <script src="{{ URL::asset('/assets/js/pages/sweet-alerts.init.js') }}"></script>
@endsection
