@extends('layouts.master-layouts')
@section('title')
    Edit_Pertemuan
@endsection
@section('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Pertemuan
        @endslot
        @slot('title')
            Edit {{ $data->nama_pertemuan }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('flashmessage')
                <div class="card-body">

                    <h4 class="card-title">Isi Data</h4>
                    <p class="card-title-desc">Lengkapi field dibawah ini untuk mengedit Pertemuan</p>
                    <form action="/pertemuan/edit/{{ $data->id_pertemuan }}" method="POST" id="editpertemuan">
                        @csrf
                        <input type="hidden" value="{{ Auth::id() }}" name="id">
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <label class="form-label">Tanggal Pertemuan</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="start" name="start">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <label class="form-label">Pilih Modul</label>
                                        <div class="p-4 border-top">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h6 class="font-size-16 mb-1" style="display: inline;">Tambah  Modul</h6>
                                                <button type="button" class="add1 btn btn-success btn-sm" id="add_button_bahan"
                                                    style="margin-left: 10px;">+</button>
                                            </div>
                                            <div class="row listbahan">
                                                <div class="row clonebahan">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" class="control-label">Pilih Modul</label>
                                                            <select class="select2 form-select form-control select2-multiple"
                                                                name="modul[]" data-live-search="true">
                                                                <option selected disabled>Pilih Modul</option>
                                                                @foreach ($modul as $modul)
                                                                    <option value="{{ $modul->id_modul }}">{{ $modul->modul_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label" for="eduyear">Jumlah</label>
                                                            <input id="jumlah_bahan" name="jumlah_bahan[]" type="number"
                                                                min="1" class="form-control"
                                                                placeholder="Masukkan Jumlah Bahan">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#start").datepicker({
                numberOfMonths: 1,
                onSelect: function(selected) {
                    var dt = new Date(selected);
                    dt.setDate(dt.getDate() + 1);
                    $("#end").datepicker("option", "minDate", dt);
                }
            });
            $("#end").datepicker({
                numberOfMonths: 1,
                onSelect: function(selected) {
                    var dt = new Date(selected);
                    dt.setDate(dt.getDate() - 1);
                    $("#start").datepicker("option", "maxDate", dt);
                }
            });
        });
    </script>
@endsection
