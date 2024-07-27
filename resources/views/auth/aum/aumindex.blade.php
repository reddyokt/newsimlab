@extends('layouts.master-layouts')
@section('title')
    AUM
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            AUM
        @endslot
        @slot('title')
            AUM List
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
                                <a href="/aum/create" class="btn btn-success waves-effect waves-light"><i
                                        class="mdi mdi-plus me-2"></i> Add New</a>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-inline float-md-end mb-3">
                                <div class="search-box ms-2">
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="table-responsive mb-4">
                        <table id="datatable" class="table table-centered dt-responsive-wrap mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama AUM</th>
                                    <th scope="col">Bidang Usaha</th>
                                    <th scope="col">Pengelolaan</th>
                                    <th scope="col">Kepemilikan</th>
                                    <th scope="col">Status</th>
                                    {{-- <th scope="col">Address</th> --}}
                                    <th scope="col" style="width: 200px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($aumindex as $aum)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="width: 30%;">{{$aum->aum_name}}</td>
                                        <td>{{$aum->bidangusaha}}</td>
                                        <td>
                                            @if ($aum->ranting_id != Null)
                                                Ranting {{$aum->ranting_name}}
                                            @elseif ($aum->pca_id !=Null)
                                                PCA {{$aum->pca_name}}
                                            @else
                                                PDA {{$aum->pda_name}}
                                            @endif
                                        </td>
                                        <td>{{$aum->kepemilikan_name}}</td>
                                        <td> @if ($aum->status == 'Yes')
                                            <div class="badge bg-pill bg-soft-success font-size-12">Active</div>
                                            @else
                                            <div class="badge bg-pill bg-soft-danger font-size-12">Not Active</div>
                                            @endif
                                        </td>
                                        {{-- <td style="width: 30%;">{{$aum->address}}</td> --}}
                                        <td style="width: 15%">
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="{{ url('aum/detail/' . Crypt::encrypt($aum->id_aum)) }}"
                                                        class="px-2 text-warning"><i
                                                            class="uil uil-eye font-size-14"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="{{ url('aum/edit/' . Crypt::encrypt($aum->id_aum)) }}"
                                                        class="px-2 text-primary"><i
                                                            class="uil uil-pen font-size-14"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="{{ url('aum/delete/' . Crypt::encrypt($aum->id_aum)) }}"
                                                        class="px-2 text-danger"><i
                                                            class="uil uil-trash-alt font-size-14"></i></a>
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
                                {{-- <p class="mb-sm-0">Showing 1 to 10 of {{$filetypeindex->count()}} entries</p> --}}
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
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
@endsection
