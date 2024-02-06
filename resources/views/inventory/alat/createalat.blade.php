@extends('layouts.master')
@section('title')
    Create_Alat_Praktikum
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
        .imgPreview img {
            padding: 8px;
            max-width: 200px;
        }
    </style>
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            ALat Praktikum
        @endslot
        @slot('title')
            Add New
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Isi Data</h4>
                    <p class="card-title-desc">Lengkapi field dibawah ini untuk membuat data Alat Praktikum</p>
                    <form action="/alat/create" method="POST" name="createnewalat" id="createnewalat"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3 row">
                            <input type="hidden" value="{{ Auth::id() }}" name="id">
                            <div class="col-lg-6">
                                <label class="form-label col-form-label">Jenis Alat</label>
                                <div class="form-check form-check-inline">
                                    <input required class="form-group form-check-input" type="radio" name="jenisalat"
                                        id="c2a" value="c2a">
                                    <label class="form-check-label" for="c2a">C2A</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-group form-check-input" type="radio" name="jenisalat"
                                        id="c2b" value="c2b">
                                    <label class="form-check-label" for="c2b">C2B</label>
                                </div>
                            </div>
                        </div>
                            
                        <div class="mb-3 row">
                            <div class="col-lg-6">
                                <label for="name" class="form-label col-form-label">Nama Alat</label>
                                <div class="col-lg-12">
                                    <input class="form-group form-control" type="text" id="name" name="name"
                                        placeholder="masukkan nama alat" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="merk" class="form-label col-form-label">Merk Alat</label>
                                <div class="col-lg-12">
                                    <input class="form-group form-control" type="text" id="merk" name="merk"
                                        placeholder="masukkan merk alat" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-lg-6">
                                <label for="name" class="form-label col-form-label">Ukuran Alat</label>
                                <div class="col-lg-12">
                                    <input class="form-group form-control" type="text" id="ukuran" name="ukuran"
                                        placeholder="masukkan nama alat" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="jumlah" class="form-label col-form-label">Jumlah Alat</label>
                                <div class="col-lg-12">
                                    <input class="form-group form-control" type="number" min="1" id="jumlah" name="jumlah"
                                        placeholder="masukkan jumlah alat" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="address">Pilih Lokasi/Lemari</label>
                                    <select class="form-control" name="lemari_id" >
                                        <option selected disabled> Pilih Lemari</option>
                                        @foreach ($lemari as $value )
                                            <option value="{{$value->id_lemari}}">{{$value->nama_lokasi}} / Lemari {{$value->nama_lemari}} </option>
                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <label class="form-label" for="address">Baris/Kolom Lemari</label>
                                    <div class="col-md-6 mb-1" >
                                        <input class="form-control" placeholder="baris" type="number" min="1" name="baris">
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <input class="form-control" placeholder="kolom" type="number" min="1" name="kolom">
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="address">Upload Foto Alat</label>
                                <input class="form-control" type="file" name="images" id="images"
                                 accept="image/png, image/jpeg, image/jpg">
                            </div>
                            <div class="col-md-6">
                                <div class="user-image mb-3 text-center">
                                    <div class="imgPreview"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap gap-3">
                            <button type="submit" class="btn btn-primary waves-effect waves-light"
                                id="sa-add-success">Simpan </button>

                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
@section('script')
    <script src="{{ asset('assets/js/account.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
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
