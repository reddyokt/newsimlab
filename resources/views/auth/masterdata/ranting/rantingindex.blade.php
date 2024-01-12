@extends('layouts.master')
@section('title')
    @lang('translation.User_List')
@endsection

@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Ranting @endslot
        @slot('title') Ranting List @endslot
    @endcomponent

    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('flashmessage')
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <a href="/ranting/create" class="btn btn-success waves-effect waves-light"><i
                                        class="mdi mdi-plus me-2"></i> Add New</a>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-inline float-md-end mb-3">
                                <div class="search-box ms-2">
                                    <div class="position-relative">
                                        <input type="text" class="form-control rounded bg-light border-0"
                                            placeholder="Search...">
                                        <i class="mdi mdi-magnify search-icon"></i>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                    <!-- end row -->
                    <div class="table-responsive mb-4">
                        <table class="table table-centered table-wrap mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Nomor</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kelurahan Administrative</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col" style="width: 200px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rantingindex as $ranting )
                                <tr>
                                    <td style="width:2%;">{{$ranting['nomor']}}</td>
                                    <td>Ranting {{$ranting['ranting_name']}}<br>
                                        - PCA {{$ranting['pca_name']}}<br>
                                        -- PDA {{$ranting['pda_name']}}

                                    </td>
                                    <td>{{$ranting['villages']}}</td>

                                    <td style="width:40%;">
                                    @if ($ranting['ranting_address'] != Null)
                                    {{$ranting['ranting_address']}}
                                    @else
                                    <p>Alamat belum diisi</p>
                                    @endif
                                    </td>

                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="{{url('pca/edit/'. Crypt::encrypt($ranting['ranting_id']))}}" class="px-2 text-primary"><i
                                                        class="uil uil-pen font-size-18"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="{{url('pca/delete/'. Crypt::encrypt($ranting['ranting_id']))}}" class="px-2 text-danger"><i
                                                        class="uil uil-trash-alt font-size-18"></i></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <div>
                                <p class="mb-sm-0">Showing 1 to 10 of {{count($rantingindex)}} entries</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection
@section('script')
    <!-- Plugins js -->
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
@endsection
