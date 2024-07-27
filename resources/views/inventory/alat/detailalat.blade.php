@extends('layouts.master-layouts')
@section('title')
    Detail Alat
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .datepicker-container {
            z-index: 1051 !important;
            /* Ensure datepicker container has higher z-index */
        }

        .modal {
            z-index: 1050 !important;
            /* Ensure modal has higher z-index than datepicker */
        }

        .modal-backdrop {
            z-index: 1040 !important;
            /* Ensure modal backdrop has lower z-index than datepicker */
        }
    </style>
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Detail Alat
        @endslot
        @slot('title')
            {{ $alat->nama_alat }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Alat</h4>
                    <table class="table table-borderless mb-0 w-50">
                        <tbody>
                            <tr>
                                <th scope="row"></th>
                                <td>Nama Alat</td>
                                <td>{{ $alat->nama_alat }}</td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>Merk</td>
                                <td>{{ $alat->merk_alat }}</td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>Ukuran</td>
                                <td>{{ $alat->ukuran_alat }}</td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>Jumlah</td>
                                <td>{{ $alat->jumlah }}</td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>Lokasi</td>
                                <td>{{ $alat->nama_lokasi }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Move the edit button here -->
                    <div class="d-flex justify-content-end mt-3">
                        <a href="/alat/edit/{{ $alat->id_alat }}" class="btn btn-primary btn-md waves-effect waves-light"
                            id="sa-add-success">Edit</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body text-center">
                    @if (!empty($alat->images) && file_exists(base_path() . '/public/upload/inventory/alat/' . $alat->images))
                        <a class="image-popup-vertical-fit" href="{{ '/../upload/inventory/alat/' . $alat->images }}">
                            <img class="img-fluid avatar-xl rounded-circle me-2" alt=""
                                src="{{ '/../upload/inventory/alat/' . $alat->images }}" width="145">
                        </a>
                    @else
                        <img class="avatar-xl rounded-circle me-2" src="{{ asset('assets/media/users/no-image.png') }}"
                            alt="user" />
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        @include('flashmessage')
        @foreach ($detail as $dt)
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body row">
                        <h4 class="card-title text-left mb-3">{{ $dt->nama_alat }} - {{ $dt->sub_id_alat }}</h4>
                        <div class="col-md-6">
                            <table class="table table-borderless mb-0 w-100 ">
                                <tbody>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Condition</td>
                                        <td style="width: 2%;">:</td>
                                        <td style="width: 50%;">{{ $dt->condition }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Deadline Kalibrasi</td>
                                        <td style="width: 2%;">:</td>
                                        <td style="width: 50%;">
                                            @if ($dt->deadline_calibration != null)
                                                {{ \Carbon\Carbon::parse($dt->deadline_calibration)->isoFormat('dddd, D MMMM Y') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Kalibrasi Terakhir</td>
                                        <td style="width: 2%;">:</td>
                                        <td style="width: 50%;">
                                            @if ($dt->last_calibration_at != null)
                                                {{ \Carbon\Carbon::parse($dt->last_calibration_at)->isoFormat('dddd, D MMMM Y') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>File Uploaded</td>
                                        <td style="width: 2%;">:</td>
                                        <td style="width: 50%;">
                                            @if ($dt->file != null)
                                                <a href="{{ asset('upload/inventory/alat/' . $dt->file) }}"
                                                    target="_blank">Download File</a>
                                            @else
                                                No File Uploaded
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Description</td>
                                        <td style="width: 2%;">:</td>
                                        <td style="width: 50%;">{{ $dt->description }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ asset('/upload/qrcodes/' . $dt->qrcode) }}" download>
                                <div style="position: relative; text-align: center;">
                                    <img class="text-center mx-auto d-block mb-3" src="{{ asset('/upload/qrcodes/' . $dt->qrcode) }}" width="145" style="width: 150px;">
                                    <div>
                                        Download QRCODE
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex flex-wrap gap-3">
                                <a href="#"data-bs-toggle="modal"
                                    data-bs-target="#detail-edit-{{ $dt->id_alat }}-{{ $dt->sub_id_alat }}"
                                    class="btn btn-primary btn-md waves-effect
                                    waves-light"
                                    id="sa-add-success">edit </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @foreach ($detail as $xx)
        <div class="modal fade" id="detail-edit-{{ $xx->id_alat }}-{{ $xx->sub_id_alat }}" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center">Edit Data Alat : {{ $xx->nama_alat }} - {{ $xx->sub_id_alat }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form action="/detail/edit/{{ $xx->id_alat }}/{{ $xx->sub_id_alat }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="nama_alat" value="{{ $xx->nama_alat }}">
                        <input type="hidden" name="sub_id_alat" value="{{ $xx->sub_id_alat }}">
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label class="form-label" for="condition">Kondisi Alat</label>
                                    <select class="form-control" name="condition">
                                        @foreach ($condition as $value)
                                            <option value="{{ $xx->condition }}"
                                                {{ $value == $xx->condition ? 'selected' : '' }}>{{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Deadline Kalibrasi</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control datepicker" placeholder="dd M, yyyy"
                                            data-date-format="dd M, yyyy" data-date-container='#datepicker'
                                            data-provide="datepicker" id="datepicker{{ $xx->sub_id_alat }}"
                                            name="tanggal" min="{{ $xx->deadline_calibration }}"
                                            value="{{ $xx->deadline_calibration ? \Carbon\Carbon::parse($xx->deadline_calibration)->format('d F Y') : '' }}">

                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Tanggal Kalibrasi Terakhir</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control datepicker" placeholder="dd M, yyyy"
                                            data-date-format="dd M, yyyy" data-date-container='#datepicker'
                                            data-provide="datepicker" id="datepicker{{ $xx->sub_id_alat }}"
                                            name="tanggal_last" min="{{ $xx->last_calibration_at }}"
                                            value="{{ $xx->last_calibration_at ? \Carbon\Carbon::parse($xx->last_calibration_at)->format('d F Y') : '' }}">

                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload File (PDF or Image)</label>
                                <input type="file" class="form-control" name="file" accept=".pdf, image/*">
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-12">
                                    <label class="label">Masukkan Keterangan</label>
                                    <textarea class="col-md-12 form-control" name="body">{{ $xx->description }}</textarea>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-3">
                                <button type="submit"
                                    class="btn btn-primary btn-md waves-effect
                                waves-light"
                                    id="sa-add-success">Simpan </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/datepicker/datepicker.min.js') }}"></script>
    <script>
        $(function() {
            // Function to initialize datepicker inside modal
            function initDatepicker() {
                $(".datepicker").datepicker();
            }

            // Trigger initDatepicker when modal is fully shown
            $('.modal').on('shown.bs.modal', function() {
                initDatepicker();
            });
        });
    </script>
@endsection
