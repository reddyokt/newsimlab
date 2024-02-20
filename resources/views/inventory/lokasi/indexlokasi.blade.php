@extends('layouts.master')
@section('title')
    Lemari/Lokasi
@endsection

@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Lemari/Lokasi
        @endslot
        @slot('title')
            Lemari/Lokasi List
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <a href="#" data-bs-toggle="modal" data-bs-target=".addLokasi"
                            style="display: inline; padding:3px;" class="text-primary">
                            <i class="uil-map-marker-plus text-primary"></i> Add Lokasi</a>
                        <a href="#" data-bs-toggle="modal" data-bs-target=".addLemari" class="text-success">
                            <i class="uil-grid text-success"></i> Add Lemari</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('flashmessage')
                    <div class="row mb-2">
                        <h5 class="mb-2">Lokasi</h5>
                        <!-- end row -->
                        <div class="table-responsive mb-4">
                            <table id="datatable" class="table table-bordered dt-responsive wrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size:12px;">
                                <thead>
                                    <tr>
                                        <th scope="col">Nomor</th>
                                        <th scope="col">Nama Lokasi</th>
                                        <th scope="col">List Lemari</th>
                                        <th scope="col" style="width: 200px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lokasi as $lokasi)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $lokasi->nama_lokasi }}</td>
                                            <td>
                                                <ul class="list-unstyled product-desc-list text-muted">
                                                    @foreach ($lokasi->lemari as $x)
                                                        @if ($x->id_lokasi == null)
                                                            <li>
                                                                <p>belum ada data lemari</p>
                                                            </li>
                                                        @else
                                                            <li><i class="mdi mdi-circle-medium me-1 align-middle"></i>
                                                                <a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#editLemari-{{ $x->id_lemari }}"
                                                                    class="px-2 text-primary">Lemari
                                                                    {{ $x->nama_lemari }}</a>
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item">
                                                        <a href="/lokasi/edit" class="px-2 text-primary"><i
                                                                class="uil uil-pen font-size-18"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="/lokasi/delete" class="px-2 text-danger"><i
                                                                class="uil uil-trash-alt font-size-18"></i></a>
                                                    </li>
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
    </div>

    <!-- Center Modal example -->
    <div class="modal fade addLokasi" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="/lokasi/create" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Lokasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <label for="code" class="form-label col-form-label">Nama Lokasi</label>
                            <div class="col-lg-12">
                                <input class="form-control" type="text" id="lokasi" name="lokasi"
                                    placeholder="masukkan nama lokasi" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save
                            changes</button>
                        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- Center Modal example -->
    <div class="modal fade addLemari" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="/lemari/create" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Lemari</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <label for="code" class="form-label col-form-label">Nama Lemari</label>
                            <div class="col-lg-12">
                                <input class="form-control" type="text" id="lemari" name="lemari"
                                    placeholder="masukkan nama lokasi" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="code" class="form-label col-form-label">Pilih Lokasi</label>
                            <div class="col-lg-12">
                                <select class="form-control" name="id_lokasi">
                                    <option selected disabled>Pilih Lokasi</option>
                                    @foreach ($lokasis as $lokasi => $value)
                                        <option value="{{ $value->id_lokasi }}">{{ $value->nama_lokasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save
                            changes</button>
                        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- Center Modal example -->
    @foreach ($lokasiss as $lokasi)
        @foreach ($lokasi->lemari as $x)
            <div class="modal fade" id="editLemari-{{ $x->id_lemari }}" tabindex="-1" role="dialog"
                aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="/lemari/edit/{{ $x->id_lemari }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Lemari</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-lg-12">
                                    <label for="code" class="form-label col-form-label">Nama Lemari</label>
                                    <div class="col-lg-12">
                                        <input class="form-control" type="text" id="lemari" name="lemari"
                                            placeholder="masukkan nama lokasi" value="{{$x->nama_lemari}} {{$x->id_lokasi}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label for="code" class="form-label col-form-label">Pilih Lokasi</label>
                                    <div class="col-lg-12">
                                        <select class="form-control" name="id_lokasi">
                                            @foreach ($lokasis as $lokasi => $value)
                                                <option value="{{ $value->id_lokasi }} {{$x->id_lokasi == $value->id_lokasi ? 'selected' : ''}}">{{ $value->nama_lokasi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save
                                    changes</button>
                                <button type="button" class="btn btn-light waves-effect"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-dialog -->
            </div>
        @endforeach
    @endforeach
    </div>
    </div>
@endsection
@section('script')
    <!-- Plugins js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
