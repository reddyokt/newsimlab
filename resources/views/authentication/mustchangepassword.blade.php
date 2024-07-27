@extends('layouts.master-without-nav')
@section('title')
    Must Change Password
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .toggle-password::after {
            content: "\1F441";
        }

        .password-container {
            position: relative;
        }

        .visible::after {
            content: "\1F440";
        }
    </style>
@endsection
@section('content')
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <a href="{{ url('index') }}" class="mb-3 d-block auth-logo">
                            <img src="{{ URL::asset('landing/assets/img/simlab.svg') }}" alt="" height="50"
                                class="logo logo-dark">
                            <img src="{{ URL::asset('landing/assets/img/simlab.svg') }}" alt="" height="50"
                                class="logo logo-light">
                        </a>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    @include('flashmessage')
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Ganti Password</h5>
                            </div>
                            <div class="p-2 mt-4">
                                <form method="POST" action="/postmustchangepassword">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{$data->user_id}}">
                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword">New Password</label>
                                        <div class="password-container">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                id="userpassword" placeholder="Enter password">
                                            <span class="toggle-password"
                                                onclick="togglePasswordVisibility('userpassword')"></span>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword_confirmation">Re-enter New
                                            Password</label>
                                        <div class="password-container">
                                            <input type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                name="password_confirmation" id="userpassword_confirmation"
                                                placeholder="Re-Enter password">
                                            <span class="toggle-password"
                                                onclick="togglePasswordVisibility('userpassword_confirmation')"></span>
                                        </div>
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="email" placeholder="Enter email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>©
                            <script>
                                document.write(new Date().getFullYear())
                            </script> simlab
                        </p>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
@endsection

<script>
    function togglePasswordVisibility(inputId) {
        var passwordField = document.getElementById(inputId);
        var toggleButton = passwordField.nextElementSibling;

        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleButton.classList.add("visible");
        } else {
            passwordField.type = "password";
            toggleButton.classList.remove("visible");
        }
    }
</script>
