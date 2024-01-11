@extends('layouts.master')
@section('title')
    @lang('translation.Basic_Elements')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <style>
        .add {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Kader
        @endslot
        @slot('title')
            Create New Kader
        @endslot
    @endcomponent
    <form action="/kader/create" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12">
                <div id="addkader-accordion" class="custom-accordion">
                    @include('flashmessage')
                    <div class="card">
                        @csrf
                        <input type="hidden" value="{{ Auth::id() }}" name="id">
                        <a href="#addkader-personaldata-collapse" class="text-dark" data-bs-toggle="collapse"
                            aria-expanded="true" aria-controls="addkader-personaldata-collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-xs">
                                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                01
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Kader Information - Personal Data</h5>
                                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <div id="addproduct-personaldata-collapse" class="collapse show"
                            data-bs-parent="#addproduct-accordion">
                            <div class="p-4 border-top">
                                <form>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="name">Nama Lengkap</label>
                                                <input id="name" name="name" type="text" class="form-control"
                                                    placeholder="Enter  Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">

                                            <div class="mb-3">
                                                <label class="form-label" for="phone">Phone</label>
                                                <input id="phone" name="phone" type="text" class="form-control"
                                                    placeholder="Enter phone">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="price">Email</label>
                                                <input id="email" name="email" type="text" class="form-control"
                                                    type="email" placeholder="Enter email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" class="control-label">Pilih Pekerjaan</label>
                                                <select class="select2 form-control select2-multiple" name="pekerjaan"
                                                    id="pekerjaan" data-live-search="true">
                                                    @foreach ($pekerjaan as $key => $value)
                                                        <option value="{{ $value->id_pekerjaan }}">
                                                            {{ $value->nama_pekerjaan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" class="control-label">Pilih Pendidikan
                                                    Terakhir</label>
                                                <select class="select2 form-control select2-multiple" name="pendidikan">
                                                    <option value="SMP">SMP</option>
                                                    <option value="SMA">SMA</option>
                                                    <option value="S1" selected>S1</option>
                                                    <option value="S2">S2</option>
                                                    <option value="S3">S3</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="image">Profile Picture</label>
                                                <input id="image" name="image" type="file" class="form-control"
                                                    accept="image/png, image/jpeg, application/pdf"placeholder="#">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <a href="#addkader-aisyiyah-collapse" class="text-dark" data-bs-toggle="collapse"
                            aria-expanded="true" aria-controls="addproduct-billinginfo-collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-xs">
                                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                02
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Kader Information - Aisyiyah Data</h5>
                                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <div id="addkader-aisyiyah-collapse" class="collapse show"
                            data-bs-parent="#addproduct-accordion">
                            <div class="p-4 border-top">
                                <form>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="nbm">NBM</label>
                                                <input id="nbm" name="nbm" data-parsley-type="number"
                                                    data-parsley-maxlength="7" class="form-control"
                                                    placeholder="Enter  NMB">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="nba">NBA</label>
                                                <input id="nba" name="nba" data-parsley-type="number"
                                                    data-parsley-maxlength="7" class="form-control"
                                                    placeholder="Enter  NBA">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" class="control-label">Pilih PDA</label>
                                                <select class="select2 form-select form-control select2-multiple"
                                                    name="pda" id="pda" data-live-search="true">
                                                    @foreach ($pda as $key => $value)
                                                        <option value="{{ $value->pda_id }}">
                                                            {{ $value->pda_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6" id="divpca" style="display: none">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label" class="control-label">Pilih PCA</label>
                                                <select class="form-select form-control" name="pca" id="pca"
                                                    data-control="select2"
                                                    data-placeholder="{{ __('account.placeholder_pca') }}">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <a href="#addkader-orgexperience-collapse" class="text-dark" data-bs-toggle="collapse"
                            aria-expanded="true" aria-controls="addproduct-billinginfo-collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-xs">
                                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                03
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Kader Information - Organization Experience</h5>
                                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <div id="addkader-orgexperience-collapse" class="collapse show"
                            data-bs-parent="#addkader-accordion">
                            <div class="p-4 border-top">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <h6 style="display: inline;">Pengalaman Organisasi Internal
                                            <button type="button" class="btn btn-success btn-md add"> Tambah Pengalaman<span class="mdi mdi-plus"></span></button> </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row appending_div">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="position">Posisi/Jabatan</label>
                                                <input class="form-control" type="text" name="position[]">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="position">Tahun Mulai</label>
                                                <input class="form-control" type="text" name="startyear[]">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="position">Tahun Selesai</label>
                                                <input class="form-control" type="text" name="endyear[]">
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!----tombol--------->
                    <div class="row mb-4">
                        <div class="col ms-auto">
                            <div class="d-flex flex-wrap gap-3">
                                <button type="submit" class="btn btn-primary waves-effect waves-light"
                                    id="sa-add-success">Simpan</button>
                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-----end-tombol----->
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script src="{{ asset('assets/js/account.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var i = 1;
            $('.add').on('click', function() {
                var field = '<br><div class="row appending_div"><div class="col-lg-4"><div class="mb-3"><label class="form-label" for="position">Posisi/Jabatan</label><input class="form-control" type="text" name="position[]"></div></div><div class="col-lg-4"><div class="mb-3"><label class="form-label" for="position">Tahun Mulai</label><input class="form-control" type="text" name="startyear[]"></div></div><div class="col-lg-4"><div class="mb-3"><label class="form-label" for="position">Tahun Selesai</label><input class="form-control" type="text" name="endyear[]"></div></div></div>';
                $('.appending_div').append(field);
            })
        })

    </script>
@endsection
