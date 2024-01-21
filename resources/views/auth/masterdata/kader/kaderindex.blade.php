@extends('layouts.master')
@section('title')
    Kader
@endsection

@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Kader
        @endslot
        @slot('title')
            Kader List
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
                                <a href="/kader/create" class="btn btn-success waves-effect waves-light"><i
                                        class="mdi mdi-plus me-2"></i> Add New</a>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="table-responsive mb-4">
                        {{-- <table class="table table-centered table-wrap mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Nomor</th>
                                    <th scope="col">Nama Kader</th>
                                    <th scope="col">Phone number</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Asal Ranting</th>
                                    <th scope="col" style="width: 200px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kaderindex as $kader)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if (!empty($kader['pp']) && file_exists(base_path() . '/public/upload/kader/profile_picture/' . $kader->pp))
                                                <img src="{{ '/../upload/kader/profile_picture/' . $kader->pp }}"
                                                    alt="" class="avatar-md rounded-circle me-2">
                                            @else
                                                <img class="avatar-md rounded-circle me-2"
                                                    src="{{ asset('assets/media/users/default.jpg') }}" alt="user" />
                                            @endif
                                            <a href="#" class="text-body">{{ $kader['kader_name'] }}</a>
                                        </td>
                                        <td>{{ $kader['kader_phone'] }}</td>
                                        <td>{{ $kader['kader_email'] }}</td>
                                        <td>{{ $kader['ranting_name'] }}</td>
                                        <td>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="{{ url('kader/edit/' . Crypt::encrypt($kader['kader_id'])) }}"
                                                        class="px-2 text-primary"><i
                                                            class="uil uil-pen font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="{{ url('kader/delete/' . Crypt::encrypt($kader['kader_id'])) }}"
                                                        class="px-2 text-danger"><i
                                                            class="uil uil-trash-alt font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="/kader/detail/{{$kader->kader_id}}" 
                                                        class="px-2 text-warning"><i
                                                            class="uil uil-eye font-size-18"></i></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> --}}

                        <table id="datatable" class="table table-bordered dt-responsive wrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">Nomor</th>
                                    <th scope="col">Nama Kader</th>
                                    <th scope="col">Phone number</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Asal Ranting</th>
                                    <th scope="col" style="width: 200px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kaderindex as $kader)
                                    <tr>
                                        <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                                        <td>
                                            @if (!empty($kader['pp']) && file_exists(base_path() . '/public/upload/kader/profile_picture/' . $kader->pp))
                                                <img src="{{ '/../upload/kader/profile_picture/' . $kader->pp }}"
                                                    alt="" class="avatar-md rounded-circle me-2">
                                            @else
                                                <img class="avatar-md rounded-circle me-2"
                                                    src="{{ asset('assets/media/users/default.jpg') }}" alt="user" />
                                            @endif
                                            <a href="#" class="text-body">{{ $kader['kader_name'] }}</a>
                                        </td>
                                        <td style="vertical-align: middle;">{{ $kader['kader_phone'] }}</td>
                                        <td style="vertical-align: middle;">{{ $kader['kader_email'] }}</td>
                                        <td style="vertical-align: middle;">{{ $kader['ranting_name'] }}</td>
                                        <td style="vertical-align: middle;">
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="{{ url('kader/edit/' . Crypt::encrypt($kader['kader_id'])) }}"
                                                        class="px-2 text-primary"><i
                                                            class="uil uil-pen font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="{{ url('kader/delete/' . Crypt::encrypt($kader['kader_id'])) }}"
                                                        class="px-2 text-danger"><i
                                                            class="uil uil-trash-alt font-size-18"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="/kader/detail/{{$kader->kader_id}}" 
                                                        class="px-2 text-warning"><i
                                                            class="uil uil-eye font-size-18"></i></a>
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
