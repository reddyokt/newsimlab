@extends('layouts.master-layouts')
@section('title')
    @lang('translation.Starter_Page')
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Tugas
        @endslot
        @slot('title')
            Detail Tugas
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="col-xl-10 mx-auto d-block">
                <div class="card">
                    <div class="card-body  bg-secondary bg-gradient">
                        <h1 class="card-title text-center text-white" style="font-size: 22px;">Soal Tugas
                            @if ($detailtugas->jenis == 'pre_test')
                                Pre Test
                            @elseif ($detailtugas->jenis == 'post_test')
                                Post Test
                            @elseif ($detailtugas->jenis == 'report')
                                Laporan
                            @endif
                            <h6 class="card-subtitle font-14 text-white text-center mb-1">Kelas
                                {{ $detailtugas->tgskls->nama_kelas }} - {{ $detailtugas->tgskls->matkul->nama_matkul }} -
                                {{ $detailtugas->tgsmdl->moduls->modul_name }}
                            </h6>
                    </div>
                    {{-- <hr> --}}
                    <div class="card-body col-xl-8 mx-auto d-block">
                        <p class="card-text">{!! $detailtugas->uraian_tugas !!}</p>
                    </div>
                    <div class="card-footer col-xl-12 bg-secondary bg-gradient">
                        @if ($detailtugas->file_tugas != Null)
                        <div class="col-xl-8 mx-auto d-block">
                            <a class="mb-3 text-white" href="{{ '/../upload/tugas/' . $detailtugas->file_tugas }}"
                                target="_blank">
                                <span><i class="uil-file-download-alt"></i></span>File attachment</a>
                        </div>
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="col-xl-10 mx-auto d-block">
                <div class="card">
                    <div class="card-body  bg-primary bg-gradient">
                        <h1 class="card-title text-center text-white" style="font-size: 22px;">Jawab Tugas
                    </div>
                    <form action="/mhs/tugas/jawab/{{ $nilaitugas->id_nilai_tugas }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <input type="hidden" name="periode" value="{{ $detailtugas->tgskls->periode->id_periode }}">
                        <input type="hidden" name="matkul" value="{{ $matkul->nama_matkul }}">
                        <input type="hidden" name="modul" value="{{$modul->modul_name}}">
                        <div class="card-body col-xl-10 mx-auto d-block">
                            <div class="mb-3 row">
                                <div class="col-md-12">
                                    <textarea class="col-md-12 form-control" id="body" name="body"></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label class="form-label" for="tugas_file">Upload Attachment/Jawaban</label>
                                    <input class="form-control" type="file" name="tugas_file" id="tugas_file"
                                        accept="image/png, image/jpeg, image/jpg, application/pdf">
                                </div>
                                <div class="col-md-6">
                                    <div class="user-image mb-3 text-center">
                                        <div class="imgPreview1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer col-xl-12 bg-primary bg-gradient">
                            <button type="submit" class="btn btn-primary mt-3">Save it! <i
                                    class="fab fa-telegram-plane ms-1"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('landing/assets/js/theme.js') }}"></script>
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
