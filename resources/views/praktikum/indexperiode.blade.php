@extends('layouts.master')
@section('title')
    Periode
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Periode
        @endslot
        @slot('title')
            All Periode
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('flashmessage')
                <div class="card-body">
                    <a href="/periode/create" type="button" class="btn btn-success waves-effect waves-light mb-3">
                        Create New Periode </a>
                    <table id="datatable" class="table table-bordered dt-responsive wrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tahun Ajaran</th>
                                <th>Semester</th>
                                <th>Rentang Waktu Periode</th>
                                <th>Status</th>
                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periodeindex as $periode)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $periode->tahun_ajaran }}</td>
                                    <td>{{ $periode->semester }}</td>
                                    <td>{{ \Carbon\Carbon::parse($periode->start)->isoFormat('dddd, D MMMM Y')  }} ~
                                        {{ \Carbon\Carbon::parse($periode->end)->isoFormat('dddd, D MMMM Y') }}
                                    </td>
                                    <td>
                                        @if ($periode->isActive == 'Yes')
                                            <div class="badge bg-soft-success font-size-12">Active</div>
                                        @else
                                            <div class="badge bg-soft-danger font-size-12">Not Active</div>
                                        @endif
                                    </td>
                                    <td>
                                        <ul class="list-inline mb-0">

                                            @if ($periode->isActive == 'Yes')
                                                <li class="list-inline-item">
                                                    <a href="/periode/edit/{{ $periode->id_periode }}"
                                                        class="px-2 text-primary"><i
                                                            class="uil uil-pen font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="/periode/delete/{{ $periode->id_periode }}"
                                                        class="px-2 text-danger"><i
                                                            class="uil uil-trash-alt font-size-18"></i></a>
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
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
