@extends('layouts-landing.master')
@section('title')
@endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <section class="wrapper bg-dark text-white">
        <div class="container pt-18 pt-md-20 pb-21 pb-md-21 text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1 class="display-1 text-white mb-3">Sign Up</h1>
                    <nav class="d-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb text-white">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sign Up - Umum</li>
                        </ol>
                    </nav>
                    <!-- /nav -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light">
        <div class="container pb-14 pb-md-16">
            <div class="row">
                <div class="col mt-n19">
                    <div class="card shadow-lg">
                        <div class="row gx-0 text-center">
                            <div class="col-lg-6 image-wrapper bg-image bg-cover rounded-top rounded-lg-start d-none d-md-block"
                                data-image-src="{{ asset('landing/assets/img/photos/labss.jpg') }}">
                            </div>
                            <!--/column -->
                            <div class="col-lg-6">
                                <div class="p-10 p-md-11 p-lg-13">
                                    <h2 class="mb-3 text-start">Sign up Penelitian</h2>
                                    <p class="lead mb-6 text-start">Registration takes less than a minute.</p>
                                    <form class="text-start mb-3">
                                        <div class="form-floating mb-4">
                                            <input type="text" class="form-control" placeholder="Name" id="loginName">
                                            <label for="loginName">Name</label>
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input type="text" class="form-control" placeholder="institusi" id="institusi">
                                            <label for="institusi">Institusi</label>
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input type="email" class="form-control" placeholder="Email" id="loginEmail">
                                            <label for="loginEmail">Email</label>
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input type="email" class="form-control" placeholder="Re enter Email" id="loginEmail">
                                            <label for="loginEmail">Re enter Email</label>
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input type="file" class="form-control" placeholder="Upload file JSA" id="filejsa">
                                            <label for="filejsa">Upload file JSA</label>
                                        </div>
                                        <a class="btn btn-primary rounded-pill btn-login w-100 mb-2">Sign Up</a>
                                    </form>
                                    <!-- /form -->
                                    <p class="mb-0">Already have an account? <a href="./signin2.html" class="hover">Sign
                                            in</a></p>
                                    <!--/.social -->
                                </div>
                                <!--/div -->
                            </div>
                            <!--/column -->
                        </div>
                        <!--/.row -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
