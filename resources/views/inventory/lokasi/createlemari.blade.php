@extends('layouts.master')
@section('title')
    Create_Lemari
@endsection
@section('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Lemari
        @endslot
        @slot('title')
            Add New
        @endslot
    @endcomponent

    <div class="row" style="min-height: 800px;">
        <div class="col-12">
            <div class="card">
            @include('flashmessage')
                <div class="card-body">
                    <h4 class="card-title">Isi Data</h4>
                    <p class="card-title-desc">Lengkapi field dibawah ini untuk membuat sebuah data Lemari Baru</p>
                    <form action="/kelas/create" method="POST" id="createnewkelas">
                        @csrf
                        <input type="hidden" value="{{ Auth::id() }}" name="id">
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label class="form-label">Pilih Lokasi</label>
                                    <div class="input-group">
                                        <select class="form-control" name="tahun_ajaran" id="tahun_ajaran" >
                                            <@foreach ($lokasi as $lokasi )
                                                <option value="$ta">{{$ta}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label class="form-label">Nama Lemari</label>
                                    <div class="input-group">
                                        <select class="form-control" name="dosen" id="dosen" >
                                            <@foreach ($semester as $semester )
                                            <option value="$semester">{{$semester}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
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
