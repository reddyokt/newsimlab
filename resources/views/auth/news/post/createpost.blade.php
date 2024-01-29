@extends('layouts.master')
@section('title')
    Create Post
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
            News
        @endslot
        @slot('title')
            Create News
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="/post/create" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <input type="hidden" value="{{ Auth::id() }}" name="id">
                                    <input class="form-control" type="text" name="title" placeholder="News Title ...">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <select class="form-control" name="category" id="category" data-placeholder="Category ...">
                                        <option selected disabled>Pilih Category</option>
                                        @foreach ($category as $key => $value)
                                            <option value="{{ $value->id_category }}">{{ $value->category }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                <label class="form-label" for="feature_image">Upload Feature Image</label>
                                <input class="form-control" type="file" name="feature_image" id="feature_image" 
                                       accept="image/png, image/jpeg, image/jpg">
                            </div>
                            <div class="col-md-6">
                                <div class="user-image mb-3 text-center">
                                    <div class="imgPreview1"></div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="mb-3 row">
                            <div class="col-md-6">
                                <label class="form-label" for="content_image">Upload Content Image</label>
                                <input class="form-control" type="file" name="content_image[]" id="content_image"
                                    multiple="multiple" accept="image/png, image/jpeg, image/jpg">
                            </div>
                            <div class="col-md-6">
                                <div class="user-image mb-3 text-center">
                                    <div class="imgPreview2"></div>
                                </div>
                            </div>
                        </div> --}}


                        <button type="submit" class="btn btn-primary mt-3">Post it! <i
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
            $('#feature_image').on('change', function() {
                multiImgPreview(this, 'div.imgPreview1');
            });
        });
    </script>
@endsection
