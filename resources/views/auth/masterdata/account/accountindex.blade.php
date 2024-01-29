@extends('layouts.master')
@section('title')
    Account
@endsection

@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Account
        @endslot
        @slot('title')
            Account List
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
                                <a href="/account/create" class="btn btn-success waves-effect waves-light"><i
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
                                <th scope="col">Nomor</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Phone number/Email</th>
                                <th scope="col">Role</th>
                                <th scope="col" style="width: 200px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accountindex as $acc)
                                <tr>
                                    <td>{{ $acc['nomor'] }}</td>
                                    <td style="width: 40%;">
                                        @if (
                                            !empty($acc['profile_picture']) &&
                                                file_exists(base_path() . '/public/upload/profile_picture/' . $acc['profile_picture']))
                                            <img src="{{ '/../upload/profile_picture/' . $acc['profile_picture'] }}"
                                                alt="" class="avatar-sm rounded-circle me-2">
                                        @else
                                            <img class="avatar-sm rounded-circle me-2"
                                                src="{{ asset('assets/media/users/default.jpg') }}" alt="user" />
                                        @endif
                                        <span><a href="#" class="text-body">{{ $acc['name'] }}</a></span>
                                    </td>
                                    <td>{{ $acc['username'] }}</td>
                                    <td style="width: 30%;">
                                        <p> Phone : {{ $acc['phone'] }} </p>
                                        <p> Email : {{ $acc['email'] }} </p>                                    
                                    </td>
                                    <td style="width: 20%;">
                                        {{ $acc['role_name'] }} <br> {{ $acc['pda_name'] }}
                                    </td>
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="{{ url('account/edit/' . Crypt::encrypt($acc['user_id'])) }}"
                                                    class="px-2 text-primary"><i
                                                        class="uil uil-pen font-size-18"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="{{ url('account/delete/' . Crypt::encrypt($acc['user_id'])) }}"
                                                    class="px-2 text-danger"><i
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
