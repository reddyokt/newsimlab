@extends('layouts.master')
@section('title')
 Create_Surat
@endsection

@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Surat
        @endslot
        @slot('title')
            Create Surat
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="/surat/create" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <input type="hidden" value="{{ Auth::id() }}" name="id">
                                    <select class="select2 form-control select2-multiple" name="kepada[]"
                                        multiple="multiple" id="kepada" data-placeholder="Kepada ...">
                                        @foreach ($user as $key => $value)
                                            <option value="{{ $value->user_id }}">{{ $value->name }} -
                                                {{ $value->role_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <input class="form-control" type="text" name="subject" placeholder="Subject ...">
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
                                    <label class="form-label" for="uploaded_file">Upload Lampiran</label>
                                    <input id="uploaded_file" name="uploaded_file" type="file" class="form-control"
                                        accept="image/png, image/jpeg, application/pdf"placeholder="#">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Send <i
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
