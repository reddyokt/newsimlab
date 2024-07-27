@extends('layouts.master-layouts')
@section('title')
    Alat_Praktikum
@endsection

@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/magnific-popup/magnific-popup.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Alat Praktikum
        @endslot
        @slot('title')
            Alat Praktikum List
        @endslot
    @endcomponent

    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('flashmessage')
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <a href="/alat/create" class="btn btn-success waves-effect waves-light"><i
                                        class="mdi mdi-plus me-2"></i> Add New</a>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="table-responsive mb-4">
                        <table id="datatable" class="table table-bordered dt-responsive wrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size:12px;">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Merk</th>
                                    <th scope="col">Ukuran</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Lokasi</th>

                                    <th scope="col" style="width: 200px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alat as $data)
                                    <tr>
                                        <td style="width: 5%;">{{ $loop->iteration }}</td>
                                        <td style="width: 30%;">
                                            @if (!empty($data->images) && file_exists(base_path() . '/public/upload/inventory/alat/' . $data->images))
                                                <a class="image-popup-vertical-fit"
                                                    href="{{ '/../upload/inventory/alat/' . $data->images }}">
                                                    <img class="img-fluid avatar-sm rounded-circle me-2" alt=""
                                                        src="{{ '/../upload/inventory/alat/' . $data->images }}"
                                                        width="145">
                                                </a>
                                            @else
                                                <img class="avatar-sm rounded-circle me-2"
                                                    src="{{ asset('assets/media/users/no-image.png') }}" alt="user" />
                                            @endif
                                            <span><a href="#" class="text-body">{{ $data->nama }}</a></span>

                                        </td>
                                        <td>{{ $data->jenis }}</td>
                                        <td>{{ $data->merk }}</td>
                                        <td>{{ $data->ukuran }}</td>
                                        <td>{{ $data->jumlah }}</td>
                                        <td style="width: 30%;">
                                            Lokasi : {{ $data->lokasi }}<br>
                                            Lemari : {{ $data->lemari }}<br>
                                            Baris/Kolom : {{ $data->baris }}/{{ $data->kolom }}
                                        </td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="/alat/edit/{{ $data->id_alat }}" class="px-2 text-primary"><i
                                                            class="uil uil-pen font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="/alat/delete/{{ $data->id_alat }}" class="px-2 text-danger"><i
                                                            class="uil uil-trash-alt font-size-18"></i></a>
                                                </li>
                                                @if ($data->jenis == 'c2a')
                                                    <a href="#" class="text-success" data-bs-toggle="modal"
                                                        data-bs-target="#modalAlat-{{ $data->id_alat }}">
                                                        <i class="mdi mdi-qrcode-scan font-size-18"></i>
                                                    </a>
                                                @else
                                                @endif

                                                @if ($data->jenis == 'c2b')
                                                    <li class="list-inline-item">
                                                        <a href="/alat/detail/{{ $data->id_alat }}"
                                                            class="px-2 text-warning"><i
                                                                class="uil uil-eye font-size-18"></i></a>
                                                    </li>
                                                @else
                                                @endif
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    @foreach ($alat as $x)
        <div class="modal fade" id="modalAlat-{{ $x->id_alat }}" tabindex="-1" role="dialog"
            aria-labelledby="myMediumModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">QR Code</h5>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <a href="{{ asset('/upload/qrcodes/' . $x->qrcode) }}" download>
                                <div style="position: relative; text-align: center;">
                                    <img class="text-center mx-auto d-block mb-3"
                                        src="{{ asset('/upload/qrcodes/' . $x->qrcode) }}" width="145"
                                        style="width: 150px;">
                                    <div>
                                        Download QRCODE
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('script')
    <!-- Plugins js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/magnific-popup/magnific-popup.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/lightbox.init.js') }}"></script>
    <script>
        function save2() {
            window.open(canvas.toDataURL('image/png'));
            var gh = canvas.toDataURL('png');

            var a = document.createElement('a');
            a.href = gh;
            a.download = 'image.png';

            a.click()
        }
    </script>
@endsection
