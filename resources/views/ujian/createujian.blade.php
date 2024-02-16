@extends('layouts.master')
@section('title')
    Create Ujian 

@endsection

@section('css')
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
            Ujian
        @endslot
        @slot('title')
            Create Ujian @if ($ujian->jenis == 'awal') Awal
                         @else Akhir
                         @endif
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="/ujian/create/{{$ujian->id_ujian}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <input type="hidden" value="{{ Auth::id() }}" name="id">
                                    <input type="hidden" value="{{$ujian->jenis}}" name="jenis">
                                    <input type="hidden" value="{{$ujian->id_ujian}}" name="id_ujian">
                                    <input type="hidden" value="{{$ujian->id_kelas}}" name="id_kelas">
                                    <input type="hidden" value="{{$ujian->klsuji->nama_kelas}}" name="kelas">
                                    <input type="hidden" value="{{$ujian->klsuji->matkul->nama_matkul}}" name="matkul">
                                    <input type="hidden" value="{{$ujian->klsuji->periode->tahun_ajaran}}" name="periode">                                    
                                    <input type="hidden" value="{{$ujian->klsuji->periode->id_periode}}" name="id_periode">                                    
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-12">
                                <textarea class="col-md-12 form-control" id="body" name="body"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label class="form-label" for="ujian_file">Upload Soal/Gambar</label>
                                <input class="form-control" type="file" name="ujian_file" id="ujian_file" 
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
            </form>
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
