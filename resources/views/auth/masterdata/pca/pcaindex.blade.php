@extends('layouts.master')
@section('title')
    PCA
@endsection

@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') PDA @endslot
        @slot('title') PDA List @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('flashmessage')
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <a href="/pca/create" class="btn btn-success waves-effect waves-light"><i
                                        class="mdi mdi-plus me-2"></i> Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mb-4">
                        <table id="datatable" class="table table-bordered dt-responsive wrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col">Nomor</th>
                                    <th scope="col">Nama PCA</th>
                                    <th scope="col">Kecamatan Administrative</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col" style="width: 200px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pcaindex as $pca )
                                <tr>
                                    <td style="width:2%;">{{$pca['nomor']}}</td>
                                    <td>{{$pca['pca_name']}} <br>
                                        - PDA {{ $pca['pda_name'] }}
                                    </td>
                                    <td>{{$pca['name']}}</td>

                                    <td style="width:40%;">
                                    @if ($pca['address'] != Null)
                                    {{$pca['address']}}
                                    @else
                                    <p>Alamat belum diisi</p>
                                    @endif
                                    </td>

                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="{{url('pca/edit/'. Crypt::encrypt($pca['pca_id']))}}" class="px-2 text-primary"><i
                                                        class="uil uil-pen font-size-18"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="{{url('pca/delete/'. Crypt::encrypt($pca['pca_id']))}}" class="px-2 text-danger"><i
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
    <!-- end row -->

@endsection
@section('script')
    <!-- Plugins js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
