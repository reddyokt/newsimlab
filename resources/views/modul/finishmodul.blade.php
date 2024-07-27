@extends('layouts.master-layouts')
@section('title')
    Praktikum Report
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .container {
            max-width: 500px;
        }
        dl, ol, ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .imgPreview1 img {
            padding: 8px;
            max-width: 200px;
        }
        /* .imgPreview2 img {
            padding: 8px;
            max-width: 200px;
        } */
    </style>
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Report
        @endslot
        @slot('title')
            by Modul
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Kelas</h4>
                    <p class="card-title-desc">
                        Kelas {{ $kelas->nama_kelas }} - {{ $matkul->nama_matkul }} <br>
                        Tahun Ajaran : {{ $periode->tahun_ajaran }} -
                        {{ $periode->semester }}<br>
                        Nama Modul : {{ $modul->modul_name }}<br>
                        Tanggal Praktek : {{$modulkelas->tanggal_praktek}}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Dosen Pengampu</h4>
                    @if (!empty($userdosen->profile_picture) &&
                            file_exists(base_path() . '/public/upload/profile_picture/' . $userdosen->profile_picture))
                        <img src="{{ '/../upload/profile_picture/' . $userdosen->profile_picture }}"
                            alt="" class="avatar-md rounded-circle me-2">
                    @else
                        <img class="avatar-md rounded-circle me-2" src="{{ asset('assets/media/users/default.jpg') }}"
                            alt="user" />
                    @endif
                    <span>
                        {{ $dosen->nama_dosen }} <br>
                        {{ $userdosen->email }}<br>
                        {{ $userdosen->phone }}

                    </span>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Asisten Lab</h4>
                    @if (
                        !empty($useraslab->profile_picture) &&
                            file_exists(base_path() . '/public/upload/profile_picture/' . $useraslab->profile_picture))
                        <img src="{{ '/../upload/profile_picture/' . $useraslab->profile_picture }}"
                            alt="" class="avatar-md rounded-circle me-2">
                    @else
                        <img class="avatar-md rounded-circle me-2" src="{{ asset('assets/media/users/default.jpg') }}"
                            alt="user" />
                    @endif
                    <span>
                        {{ $aslab->nama_aslab }} <br>
                        {{ $useraslab->email }}<br>
                        {{ $useraslab->phone }}

                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#navtabs-mhs" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Report</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane active" id="navtabs-mhs" role="tabpanel">
                            <form action="/modul/finish/{{$modulkelas->id_modulkelas}}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ Auth::id() }}" name="id">
                                <input type="hidden" value="{{$modulkelas->id_modulkelas}}" name="id_modulkelas">
                                <input type="hidden" value="{{$kelas->id_kelas}}" name="id_kelas">
                                <input type="hidden" value="{{$modul->modul_name}}" name="modul">                           
                                <input type="hidden" value="{{$modulkelas->id_periode}}" name="id_periode">

                                <div class="mb-3 row">
                                    <div class="col-md-12">
                                        <textarea class="col-md-12 form-control" id="body" name="body"></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="report_file">Upload Foto</label>
                                        <input class="form-control" type="file" name="report_file" id="report_file" 
                                               accept="image/png, image/jpeg, image/jpg, application/pdf">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="user-image mb-3 text-center">
                                            <div class="imgPreview1"></div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Save it! <i
                                        class="fab fa-telegram-plane ms-1"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/ckeditor/ckeditor.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-editor.init.js') }}"></script>
    <script>
        ClassicEditor.defaultConfig = {
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    '|',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'insertTable',
                    '|'
                ]
            },
            table: {
                contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
            },
            language: 'en'
        };

        ClassicEditor
            .create(document.querySelector('#body'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        $(function() {
            // Multiple images preview with JavaScript
            var multiImgPreview = function(input, imgPreviewPlaceholder) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(
                                imgPreviewPlaceholder);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
            $('#ujian_file').on('change', function() {
                multiImgPreview(this, 'div.imgPreview1');
            });
        });
    </script>
@endsection
