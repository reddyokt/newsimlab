@extends('layouts.master-layouts')
@section('title')
    Create_Modul
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Modul
        @endslot
        @slot('title')
            Create New Modul
        @endslot
    @endcomponent
    <form action="/modul/create" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12">
                <div id="addkader-accordion" class="custom-accordion">
                    @include('flashmessage')
                    <div class="card">
                        @csrf
                        <input type="hidden" value="{{ Auth::id() }}" name="id">
                        <a href="#addmodul-personaldata-collapse" class="text-dark" data-bs-toggle="collapse"
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
                                        <h6 class="font-size-16 mb-1">Modul Information</h6>
                                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <div id="addmodul-personaldata-collapse" class="collapse show"
                            data-bs-parent="#addproduct-accordion">
                            <div class="p-4 border-top">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Nama Modul</label>
                                            <input id="name" name="name" type="text" class="form-control"
                                                placeholder="Enter  Modul Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" class="control-label">Pilih Mata Kuliah</label>
                                            <select class="select2 form-control" name="matkul" id="matkul"
                                                data-live-search="true">
                                                <option selected disabled>Pilih Mata Kuliah</option>
                                                @foreach ($matkul as $matkul)
                                                    <option value="{{ $matkul->id_matkul }}">{{ $matkul->nama_matkul }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <label class="form-label">Tanggal Praktikum</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="date" name="date">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <a href="#addbahan-organization-collapse" class="text-dark" data-bs-toggle="collapse"
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
                                        <h6 class="font-size-16 mb-1">Bahan-bahan Modul</h6>
                                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <div id="addbahan-organization-collapse" class="collapse show"
                            data-bs-parent="#addproduct-accordion">
                            <div class="p-4 border-top">
                                <div class="flex-grow-1 overflow-hidden">
                                    <h6 class="font-size-16 mb-1" style="display: inline;">Tambah Bahan Modul</h6>
                                    <button type="button" class="add1 btn btn-success btn-sm" id="add_button_bahan"
                                        style="margin-left: 10px;">+</button>
                                </div>
                                <div class="row listbahan">
                                    <div class="row clonebahan">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" class="control-label">Pilih Bahan</label>
                                                <select class="form-control select2 multiple"
                                                    name="bahan[]" data-live-search="true">
                                                    <option selected disabled>Pilih Bahan</option>
                                                    @foreach ($bahan as $item)
                                                        <option value="{{ $item->id_bahan }}">{{ $item->nama_bahan }} - {{$item->rumus}} ( {{$item->fase}} )
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label" for="jumlah_bahan">Jumlah</label>
                                                <input id="jumlah_bahan" name="jumlah_bahan[]" type="number" min="1"
                                                    class="form-control" placeholder="Masukkan Jumlah Bahan">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <a href="#addalat-organization-collapse" class="text-dark" data-bs-toggle="collapse"
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
                                        <h6 class="font-size-16 mb-1">Alat-alat Modul</h6>
                                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <div id="addalat-organization-collapse" class="collapse show"
                            data-bs-parent="#addproduct-accordion">
                            <div class="p-4 border-top">
                                <div class="flex-grow-1 overflow-hidden">
                                    <h6 class="font-size-16 mb-1" style="display: inline;">Tambah Alat Modul</h6>
                                    <button type="button" class="add2 btn btn-success btn-sm" id="add_button_alat"
                                        style="margin-left: 10px;">+</button>
                                </div>
                                <div class="row listalat">
                                    <div class="row clonealat">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Pilih Alat</label>
                                                <select class="select2 form-select form-control select2-multiple"
                                                    name="alat[]" data-live-search="true">
                                                    <option selected disabled>Pilih Alat</option>
                                                    @foreach ($alat as $item)
                                                        <option value="{{ $item->id_alat }}">{{ $item->nama_alat }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label" for="jumlah_alat">Jumlah</label>
                                                <input id="jumlah_alat" name="jumlah_alat[]" type="number"
                                                    min="1" class="form-control"
                                                    placeholder="Masukkan Jumlah Alat">
                                            </div>
                                        </div>
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
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript">
        $(function() {
            // add bahan when
            $('#add_button_bahan').on('click', function() {
                let bahanPicker = $('.clonebahan').first().clone()
                console.log(bahanPicker)
                let wrapper = $('.listbahan')
                console.log('wrapper', wrapper)
                $('.listbahan').append(bahanPicker)
            })

            // add bahan when
            $('#add_button_alat').on('click', function() {
                let alatPicker = $('.clonealat').first().clone()
                console.log(alatPicker)
                let wrapper = $('.listalat')
                console.log('wrapper', wrapper)
                $('.listalat').append(alatPicker)
            })
        });

        $("#date").datepicker({
            numberOfMonths: 1,
            onSelect: function(selected) {
                var dt = new Date(selected);
                dt.setDate(dt.getDate() + 1);
                $("#end").datepicker("option", "minDate", dt);
            }
        });
    </script>
@endsection
