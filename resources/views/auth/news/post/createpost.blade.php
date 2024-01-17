@extends('layouts.master')
@section('title')
    @lang('translation.Form_editor')
@endsection

@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
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
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <img src="">
                                    <label class="form-label" for="feature_image">Upload Feature Image</label>
                                    <input id="feature_image" name="feature_image" type="file" class="form-control"
                                        accept="image/png, image/jpeg, image/jpg"placeholder="#">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <img src="">
                                    <label class="form-label" for="content_image">Upload Content Image</label>
                                    <input id="content_image" name="content_image" type="file" class="form-control"
                                        accept="image/png, image/jpeg, image/jpg"placeholder="#">
                                </div>
                            </div>
                        </div>
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
@endsection
