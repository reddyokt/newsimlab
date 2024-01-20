@extends('layouts.master')
@section('title')
    Create_Account
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
            Create New Account
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div id="addproduct-accordion" class="custom-accordion">
                @include('flashmessage')
                <div class="card">
                    <form action="/account/create" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ Auth::id() }}" name="id">
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
                        <div id="addproduct-billinginfo-collapse" class="collapse show"
                            data-bs-parent="#addproduct-accordion">
                            <div class="p-4 border-top">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Nama Lengkap</label>
                                            <input id="name" name="name" type="text" class="form-control"
                                                placeholder="Enter your  Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="username">Username</label>
                                            <input id="username" name="username" type="text" class="form-control"
                                                placeholder="Enter your username">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="price">Phone</label>
                                            <input id="phone_number" name="phone_number" type="text" class="form-control"
                                                placeholder="Enter your Phone number">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input id="email" name="email" type="email" class="form-control"
                                                placeholder="Enter your email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="image">Profile Picture</label>
                                            <input id="image" name="image" type="file" class="form-control"
                                                accept="image/png, image/jpeg, application/pdf"placeholder="#">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="role">Pilih Role</label>
                                            <select class="form-select form-control form-select-solid" name="role"
                                                id="role">
                                                @foreach ($roleList as $key => $value)
                                                    <option value="{{ $value->id }}">{{ $value->role_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="divpda" style="display: none">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label" class="control-label">Pilih PDA</label>
                                                <select class="form-select form-control form-select-solid" name="pda"
                                                    id="pda" data-control="select2"
                                                    data-placeholder="{{ __('account.placeholder_pda') }}">
                                                </select>
                                            </div>
                                        </div>
                                        <div id="divmajelis" style="display: none">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label" class="control-label">Pilih Majelis</label>
                                                <select class="form-select form-control form-select-solid" name="majelis"
                                                    id="majelis" data-control="select2"
                                                    data-placeholder="{{ __('account.placeholder_majelis') }}">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
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
    <script src="{{ asset('assets/js/account.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script>
@endsection
