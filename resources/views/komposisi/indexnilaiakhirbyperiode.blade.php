@extends('layouts.master-layouts')
@section('title')
    Nilai Akhir
@endsection

@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Nilai Akhir
        @endslot
        @slot('title')
            by Periode
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('flashmessage')
                    <div class="row mb-2">
                        <div class="col-md-6">
                            {{-- <div class="mb-3">
                                <a href="/aslab/create" class="btn btn-success waves-effect waves-light"><i
                                        class="mdi mdi-plus me-2"></i> Add New</a>
                            </div> --}}
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="table-responsive mb-4">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive wrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Nama Mahasiswa</th>
                                    <th scope="col">Nilai Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $dt)
                                    <tr>
                                        <td style="width: 5%;">{{ $loop->iteration }}</td>
                                        <td>Kelas {{ $dt->maskel->nama_kelas }} - {{ $dt->maskel->matkul->nama_matkul }}
                                        </td>
                                        <td>{{ $dt->mhs->nim }}</td>
                                        <td>{{ $dt->mhs->nama_mahasiswa }}</td>
                                        <td>{{ $dt->nilaiakhir }}</td>
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
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $(document).ready(function() {
                    // Destroy the existing DataTable if it exists
                    if ($.fn.DataTable.isDataTable('#datatable-buttons')) {
                        $('#datatable-buttons').DataTable().destroy();
                    }

                    $(function() {
                        $('[data-toggle="tooltip"]').tooltip()
                    });

                    $(document).ready(function() {
                        // Destroy the existing DataTable if it exists
                        if ($.fn.DataTable.isDataTable('#datatable-buttons')) {
                            $('#datatable-buttons').DataTable().destroy();
                        }

                        // Initialize the DataTable with custom settings
                        $('#datatable-buttons').DataTable({
                            dom: 'Bfrtip',
                            buttons: [{
                                    extend: 'pdfHtml5',
                                    title: 'Nilai Akhir - SimLAB-FTUMJ \n Tahun Ajaran {{ $periode->tahun_ajaran }}| {{$periode->semester}}', // Set the title of the PDF file
                                    customize: function(doc) {
                                        // Add the logo image above the title
                                        doc.content.unshift({
                                            image: '{{ $logoBase64 }}',
                                            width: 100, // Adjust the width of the logo as needed
                                            alignment: 'center',
                                            margin: [0, 10, 0,
                                                5] // Adjust margins as needed
                                        });

                                        // Find the table element in the document content
                                        var table = doc.content.find(el => el.table);

                                        // If the table element is found, proceed with customization
                                        if (table) {
                                            // Adjust the widths of the columns as needed
                                            table.table.widths = ['5%', '30%', '20%', '25%', '20%'];

                                            // Apply center alignment to the "Nilai Akhir" column
                                            table.table.body.forEach(function(row) {
                                                row[4].alignment = 'center';
                                            });
                                        }

                                        // Add current time and generator name below the table
                                        var now = new Date();
                                        var currentTime = now.toLocaleString('en-US');
                                        var generatorName = '{{ Session::get('username') }}';

                                        // Concatenate "Generated on" and "Generated by" inline
                                        var generatedText = 'Generated on: ' + currentTime +
                                            ' | Generated by: ' + generatorName;

                                        // Add the combined text to the PDF content
                                        doc.content.push({
                                            text: generatedText,
                                            margin: [0, 10, 0,
                                            0], // Adjust margins as needed
                                            alignment: 'center',
                                            fontSize: 10
                                        });
                                    }
                                },
                                'excelHtml5' // Add button for exporting to Excel
                            ],
                            // Add sorting by "Kelas" column (index 1)
                            "order": [
                                [1, "asc"]
                            ]
                        });
                    });
                });
    </script>
@endsection
