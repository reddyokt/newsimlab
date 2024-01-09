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
@slot('pagetitle') Role @endslot
@slot('title') Add New Role @endslot
@endcomponent

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Isi Data</h4>
                <p class="card-title-desc">Lengkapi field dibawah ini untuk membuat sebuah Role Baru</p>
                <form action="/role/add" method="POST" id="addnewrole">
                @csrf
                <input type="hidden" value="{{Auth::id()}}" name="id">
                <div class="mb-3 row">
                    <label for="role_name" class="col-md-2 col-form-label">Nama Role</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" id="role_name" name="role_name" placeholder="masukkan Role Name" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="code" class="col-md-2 col-form-label">CODE</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" id="code" name="code" placeholder="masukkan CODE Role" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="description" class="col-md-2 col-form-label">Description</label>
                    <div class="col-md-10">
                        <input class="form-control" type="description" id="description" name="description" placeholder="masukkan deskripsi Role" required>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-3">
                    {{-- <button type="submit" class="btn btn-primary waves-effect waves-light w-md">Submit</button> --}}
                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="sa-add-success">Simpan</button>
        
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

