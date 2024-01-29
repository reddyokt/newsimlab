@extends('layouts.master')
@section('title')
    Update Program Kerja
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/owl-carousel/owl-carousel.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/magnific-popup/magnific-popup.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .container {
            max-width: 500px;
        }

        dl,
        ol,
        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .imgPreview img {
            padding: 8px;
            max-width: 200px;
        }
    </style>
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Program Kerja
        @endslot
        @slot('title')
            Update
        @endslot
    @endcomponent
    <div class="row mb-3">
        @include('flashmessage')
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <div class="clearfix"></div>
                    </div>
                    <div class="text-muted">
                        <h5 class="font-size-16">Program Kerja</h5>
                        <div class="table-responsive mt-4">
                            <div>
                                <p class="mb-1">Name Program Kerja :</p>
                                <h5 class="font-size-16">{{ $proker->proker_name }}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Waktu Program Kerja :</p>
                                <h5 class="font-size-16">
                                    {{ \Carbon\Carbon::parse($proker->prokerstart)->locale('id')->format('j F Y') }} ~
                                    {{ \Carbon\Carbon::parse($proker->prokerend)->locale('id')->format('j F Y') }}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Pengusul :</p>
                                <h5 class="font-size-16">PDA {{ $proker->pda_name }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <div class="dropdown float-end">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="text-muted">
                        <h5 class="font-size-16">Gallery Program Kerja</h5>
                        <div class="table-responsive mt-4">
                            <div>
                                @foreach ($prokerimage as $prokers)
                                    @if ($prokers->images_proker != null)
                                        <div class="zoom-gallery">
                                            <a class="mxauto d-block text-center mb-1"
                                                href="{{ '/../upload/proker/gallery/' . $prokers->images_proker }}"
                                                title="Project 1">
                                                <img src="{{ '/../upload/proker/gallery/' . $prokers->images_proker }}"
                                                    alt="" width="200">
                                            </a>
                                        </div>
                                    @else
                                        <img src="{{ URL::asset('assets/media/Image_not_available.png') }}" alt=""
                                            class="img-fluid mx-auto d-block">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card mb-0">
                <!-- Tab content -->
                <div class="tab-content p-4">
                    <div class="tab-pane active" id="about" role="tabpanel">
                        <div>
                            <div>
                                <h5 class="font-size-16 mb-4">Deskripsi</h5>
                                <p>{!! $proker->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Time Line Program Kerja</h4>
                    <div class="">
                        <ul class="verti-timeline list-unstyled">

                            @foreach ($prokerdetail as $proker)
                                <li class="event-list">
                                    <div class="event-date text-primar">
                                        {{ \Carbon\Carbon::parse($proker->created_at)->locale('id')->format('j M y') }}<br>
                                        {{ \Carbon\Carbon::parse($proker->created_at)->locale('id')->format('h:i:s') }}
                                    </div>
                                    <h5>{{ $proker->initial }}</h5><span>
                                        <p>oleh : {{ $proker->name }}</p>
                                    </span>
                                    <p class="text-muted">{{ $proker->note_update }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card p-4">
                <div class="card-body">
                    <h4 class="card-title">Update Program Kerja</h4>
                    <p class="card-title-desc">Lengkapi field dibawah ini untuk meng-update Program Kerja</p>
                    <form action="/proker/update/{{ $update->id_proker }}" method="POST" id="createnewperiode"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ Auth::id() }}" name="id">
                        <input type="hidden" value="Update" name="initial">

                        <input type="hidden" value="{{ $update->id_proker }}" name="id_proker">

                        <div class="mb-3 row">
                            <label class="form-label" for="username">Masukkan Catatan Update</label>
                            <div class="col-md-12">
                                <textarea class="col-md-12 form-control" name="description"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label class="form-label" for="address">Upload Foto-foto Update</label>
                                <input class="form-control" type="file" name="images[]" id="images"
                                    multiple="multiple" accept="image/png, image/jpeg, image/jpg">
                            </div>
                            <div class="col-md-12">
                                <div class="user-image mb-3 text-center">
                                    <div class="imgPreview"></div>
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
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/owl-carousel/owl-carousel.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/timeline.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/magnific-popup/magnific-popup.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/lightbox.init.js') }}"></script>
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
            $('#images').on('change', function() {
                multiImgPreview(this, 'div.imgPreview');
            });
        });
    </script>
@endsection
