@extends('layouts.master')
@section('title')
    @lang('translation.Basic_Elements')
@endsection
@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Account
        @endslot
        @slot('title')
            Edit Account
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div id="addproduct-accordion" class="custom-accordion">
                @include('flashmessage')
                <div class="card">
                <form action="/account/edit/{{$data->user_id}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <input type="hidden" value="{{ $data->user_id }}" name="id">
                    <a href="#addproduct-billinginfo-collapse" class="text-dark" data-bs-toggle="collapse"
                        aria-expanded="true" aria-controls="addproduct-billinginfo-collapse">
                        <div class="p-4">

                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-xs">
                                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                            01
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-16 mb-1">Account Information</h5>
                                    <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                </div>

                            </div>

                        </div>
                    </a>
                    <div id="addproduct-billinginfo-collapse" class="collapse show" data-bs-parent="#addproduct-accordion">
                        <div class="p-4 border-top">
                            <form>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Nama Lengkap</label>
                                            <input id="name" name="name" type="text" class="form-control"
                                                value="{{$data->name}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Username</label>
                                            <input id="username" name="username" type="text" class="form-control"
                                                value="{{$data->username}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="price">Phone</label>
                                            <input id="phone" name="phone_number" type="text" class="form-control"
                                                value="{{$data->phone}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="price">Email</label>
                                            <input id="email" name="email" type="text" class="form-control"
                                                value="{{$data->email}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="image">Profile Picture</label>
                                            <input id="image" name="image" type="file" class="form-control" accept="image/png, image/jpeg, application/pdf">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" class="control-label">Pilih Role</label>
                                            <select class="select2 form-control select2-multiple" name="role"
                                                data-placeholder="Choose ...">
                                                @foreach($roleList as $key=>$value)
                                                <option value="{{$value->id}}" {{$value->id == $data->role_id ? 'selected' : ''}}>{{$value->role_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="hidden" value="{{$data['profile_picture']}}" name="old_image">
                                            {{-- <label class="form-label" for="image">Your Profile Picture</label> <br> --}}
                                            <img src="{{ '/../upload/profile_picture/' . $data['profile_picture'] }}"
                                            class="avatar-lg me-2">
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col ms-auto">
                        <div class="d-flex flex-wrap gap-3">
                            <button type="submit" class="btn btn-primary waves-effect waves-light"
                                id="sa-add-success">Simpan</button>
                        </div>
                    </div>
                </form> <!-- end col -->
                </div> <!-- end row-->
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script>
@endsection
