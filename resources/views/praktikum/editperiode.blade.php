@extends('layouts.master-layouts')
@section('title')
    Edit Periode
@endsection
@section('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Periode
        @endslot
        @slot('title')
           Edit
        @endslot
    @endcomponent

    <div class="row" style="min-height: 800px;">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Isi Data</h4>
                    <p class="card-title-desc">Lengkapi field dibawah ini untuk membuat sebuah Role Baru</p>
                    <form action="/periode/edit/{{$editperiode->id_periode}}" method="POST" id="createnewperiode">
                        @csrf
                        <input type="hidden" value="{{ Auth::id() }}" name="id">

                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label class="form-label">Pilih Tahun Ajaran</label>
                                    <div class="input-group">
                                        <select class="form-control" name="tahun_ajaran" id="tahun_ajaran">
                                            @foreach ($tAjar as $key=> $value )
                                            <option value="{{$value}}" {{$value == $editperiode->tahun_ajaran ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label class="form-label">Pilih Semester</label>
                                    <div class="input-group">
                                        <select class="form-control" name="semester" id="semester" >
                                            @foreach ($semester as $key=> $value )
                                            <option value="{{$value}}" {{$value == $editperiode->semester ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label class="form-label">Start Periode</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="from" name="start" value="{{$editperiode->start}}">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label class="form-label">End Periode</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="to" name="end" value="{{$editperiode->end}}">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
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
@section('script')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#from").datepicker({
                numberOfMonths: 1,
                onSelect: function(selected) {
                    var dt = new Date(selected);
                    dt.setDate(dt.getDate() + 1);
                    $("#to").datepicker("option", "minDate", dt);
                }
            });
            $("#to").datepicker({
                numberOfMonths: 1,
                onSelect: function(selected) {
                    var dt = new Date(selected);
                    dt.setDate(dt.getDate() - 1);
                    $("#from").datepicker("option", "maxDate", dt);
                }
            });
        });
    </script>
@endsection
