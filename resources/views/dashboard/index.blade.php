@extends('layouts.master-layouts')
@section('title')
    @lang('translation.Dashboard')
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .close-icon {
            cursor: pointer;
        }

        #calendar {
            width: 100%;
            /* Fill the width of the container */
            max-width: 800px;
            /* Limit the maximum width */
            margin: 0 auto;
            /* Center the calendar horizontally */
        }
    </style>
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            {{ Session::get('role_name') }}
        @endslot
        @slot('title')
            Dashboard
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            @include('flashmessage')
        </div>
    </div>
    <h5 class="display-6 mb-3 text-primary">Assalamu'alaikum {{ Session::get('name') }}</h5>
    <div class="row">
        @if ($role == 'LBO' || $role == 'KAL' || $role == 'SUP' || $role == 'DPA')
            @if ($events == [])
            @else
                <div class="col-lg-6">
                    <div class="card bg-white border-primary text-primary-50">
                        <div class="card-header">
                            <h5 class="mb-0 text-primary"><i class="uil uil-calendar-alt me-3"></i>Kalender Praktikum</h5>
                        </div>
                        <div class="card-body">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            @endif
        @endif

        @if ($role == 'LBO' || $role == 'KAL' || $role == 'SUP')
            @if ($notifikasi == null)
            @else
                <div class="col-lg-6">
                    <div class="card bg-white border-primary text-primary-50">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 text-primary"><i class="uil uil-notes me-3"></i>Daftar Alat Menunggu di
                                    Kalibrasi</h5>
                                <button type="button" class="btn-close" aria-label="Close" onclick="closeCard()"></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <table id="datatable" class="table table-bordered dt-responsive wrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%; font-size:12px;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Alat</th>
                                            <th scope="col">Deadline Kalibrasi</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($notifikasi as $notif)
                                            <tr>
                                                <td style="width: 5%;">{{ $loop->iteration }}</td>
                                                <td style="width: 30%;">{{ $notif->nama_alat }} - {{ $notif->sub_id_alat }}
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($notif->date_calibration)->isoFormat('dddd, D MMMM Y') }}
                                                    @php
                                                        $now = \Carbon\Carbon::now();
                                                        $countdown = \Carbon\Carbon::parse(
                                                            $notif->date_calibration,
                                                        )->diffInDays($now);
                                                        $colorClass = '';
                                                        if ($countdown >= 10 && $countdown <= 30) {
                                                            $colorClass = 'text-warning'; // Apply orange color
                                                        } elseif ($countdown < 10) {
                                                            $colorClass = 'text-danger'; // Apply red color
                                                        }
                                                    @endphp
                                                    @if ($now < \Carbon\Carbon::parse($notif->date_calibration))
                                                        <span class="{{ $colorClass }}">({{ $countdown }} Hari
                                                            Tersisa)</span>
                                                    @else
                                                        <span class="text-danger">(Expired)</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('alat.viewDetail', ['id_alat' => $notif->id_alat, 'sub_id_alat' => $notif->sub_id_alat]) }}"
                                                                class="px-2 text-primary">
                                                                <i class="uil uil-eye font-size-18"></i>
                                                            </a>

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
            @endif
        @endif
    </div>

    @if ($role == 'MHS')
        @if ($tugaspre == null && $tugaspost == null && $tugasrep == null)
        @else
            <div class="row">
                <div class="col-lg-12">
                    <div class="card bg-white border-primary text-primary-50">
                        <div class="card-body">
                            <h5 class="mb-4 text-primary"><i class="uil uil-notes me-3"></i>Kelas :
                                {{ $kelas->nama_kelas }}
                                |
                                {{ $kelas->matkul->nama_matkul }}
                            </h5>
                            <div class="row">
                                @if ($tugaspre != null)
                                    <div class="col-lg-4">
                                        <div class="card bg-white border-primary text-primary-50">
                                            <div class="card-body">
                                                <h5 class="mb-4 text-primary">
                                                    <i class="uil uil-question-circle me-3"></i>
                                                    Pre Test
                                                    @if ($nilaitugaspre->uraian_jawaban == null)
                                                        <label class="text-danger mt-2"> Anda belum membuat jawaban tugas
                                                            ini!</label>
                                                    @else
                                                        <label class="text-success mt-2"> Anda sudah menjawab tugas
                                                            ini!</label>
                                                    @endif
                                                </h5>
                                                <a href="/mhs/tugas/detail/{{ $tugaspre->id_tugas }}"
                                                    class="btn btn-sm btn-warning">
                                                    View Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                @endif

                                @if ($tugaspost != null)
                                    <div class="col-lg-4">
                                        <div class="card bg-white border-primary text-primary-50">
                                            <div class="card-body">
                                                <h5 class="mb-4 text-primary">
                                                    <i class="uil uil-question-circle me-3"></i>
                                                    Post Test
                                                    @if ($nilaitugaspost->uraian_jawaban == null)
                                                        <label class="text-danger mt-2"> Anda belum membuat jawaban tugas
                                                            ini!</label>
                                                    @else
                                                        <label class="text-success mt-2"> Anda sudah menjawab tugas
                                                            ini!</label>
                                                    @endif
                                                </h5>
                                                <a href="/mhs/tugas/detail/{{ $tugaspost->id_tugas }}"
                                                    class="btn btn-sm btn-warning">
                                                    View Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                @endif

                                @if ($tugasrep != null)
                                    <div class="col-lg-4">
                                        <div class="card bg-white border-primary text-primary-50">
                                            <div class="card-body">
                                                <h5 class="mb-4 text-primary">
                                                    <i class="uil uil-question-circle me-3"></i>
                                                    Laporan
                                                    @if ($nilaitugasrep->uraian_jawaban == null)
                                                        <label class="text-danger mt-2"> Anda belum membuat jawaban tugas
                                                            ini!</label>
                                                    @else
                                                        <label class="text-success mt-2"> Anda sudah menjawab tugas
                                                            ini!</label>
                                                    @endif
                                                </h5>
                                                <a href="/mhs/tugas/detail/{{ $tugasrep->id_tugas }}"
                                                    class="btn btn-sm btn-warning">
                                                    View Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        @endif
    @endif


    <!-- Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="eventDetails"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/moment/moment.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jquery-ui-dist/jquery-ui-dist.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('/assets/js/dashboard.js') }}"></script>
    <script>
        var events = @json($events);
        dashboard.initCalendar(events);
    </script>
@endsection
