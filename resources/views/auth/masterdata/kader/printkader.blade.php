<!doctype html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}

<head>
    <link href="{{ base_path('/assets/336/css/bootstrap.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    {{-- <link href="{{ base_path('/assets/css/icons.css') }}" id="icons-style" rel="stylesheet" type="text/css" /> --}}
    <!-- App Css-->
    {{-- <link href="{{ base_path('/assets/css/app.css') }}" id="app-style" rel="stylesheet" type="text/css" /> --}}
    <style>
        #layout-wrapper{background-color:var(--bs-body-bg);max-width:1300px;margin:0 auto;box-shadow:0 2px 4px rgba(15,34,58,.12)}body[data-layout-size=boxed]
        .main-content{margin-left:250px;overflow:hidden}.main-content .content{padding:0 15px 10px;margin-top:70px}
        .main-content{margin-left:0!important}
        .main-content{margin-left:70px}
        .main-content{margin-left:160px}
        .container-fluid,body[data-layout=horizontal]
        .row{margin:0}
        .tab-content>.active{display:block}
        
        table {
            border-left: 0.01em solid #ccc;
            border-right: 0;
            border-top: 0.01em solid #ccc;
            border-bottom: 0;
            border-collapse: collapse;
        }

        table td,
        table th {
            border-left: 0;
            border-right: 0.01em solid #ccc;
            border-top: 0;
            border-bottom: 0.01em solid #ccc;
        }
    </style>

</head>

<body>
<div id="layout-wrapper">
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            @foreach ($kaderindex as $kader)
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-5">
                                            <div class="product-detail">
                                                <div class="col-12">
                                                    <div class="tab-content position-relative" id="v-pills-tabContent">
                                                        <div class="tab-pane fade show active" id="product-1"
                                                            role="tabpanel">
                                                            <div class="product-img border">

                                                                <img src="{{ public_path('upload/kader/profile_picture/') . $kader->pp }}"
                                                                    alt="" class="img-fluid mx-auto d-block"
                                                                    style="width: 20%;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-7">
                                            <div class="mt-1 mt-xl-3 ps-xl-4">
                                                <h4 class="font-size-20 mb-3">{{ $kader['kader_name'] }}</h4>
                                                
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mt-1">
                                                                <h5 class="font-size-14">Data Pribadi Kader :</h5>
                                                                <ul class="list-unstyled product-desc-list text-muted">
                                                                    <li><i
                                                                            class="mdi mdi-circle-medium me-1 align-middle"></i>Phone
                                                                        : {{ $kader['kader_phone'] }}</li>
                                                                    <li><i
                                                                            class="mdi mdi-circle-medium me-1 align-middle"></i>Email
                                                                        : {{ $kader['kader_email'] }}</li>
                                                                    <li><i
                                                                            class="mdi mdi-circle-medium me-1 align-middle"></i>Gender
                                                                        : {{ $kader['gender'] }}</li>
                                                                    <li><i
                                                                            class="mdi mdi-circle-medium me-1 align-middle"></i>Marital
                                                                        Status : {{ $kader['marital'] }}</li>
                                                                    <li><i
                                                                            class="mdi mdi-circle-medium me-1 align-middle"></i>Jumlah
                                                                        Anak : {{ $kader['anak'] }}</li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mt-1">
                                                                <h5 class="font-size-14">Data Keanggotaan :</h5>
                                                                <ul class="list-unstyled product-desc-list text-muted">
                                                                    <li><i
                                                                            class="mdi mdi-circle-medium me-1 align-middle"></i>Ranting
                                                                        {{ $kader['ranting_name'] }}</li>
                                                                    <li><i
                                                                            class="mdi mdi-circle-medium me-1 align-middle"></i>NBM
                                                                        : {{ $kader['nbm'] }}</li>
                                                                    <li><i
                                                                            class="mdi mdi-circle-medium me-1 align-middle"></i>NBM
                                                                        : {{ $kader['nba'] }}</li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->
                            @endforeach

                            <div class="mt-4">
                                <h2 class="font-size-22 mb-3">Data Riwayat Kader : </h2>
                                <div class="product-desc">
                                    <div class="mb-3">
                                        <h5>Riwayat Pendidikan</h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="row" style="width: 20%;">Jenjang</th>
                                                        <th scope="row" style="width: 20%;">Tahun Lulus</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($kader_edu as $edu)
                                                        <tr>
                                                            <td>{{ $edu->jenjang }}</td>
                                                            <td>{{ $edu->eduyear }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <h5>Riwayat Pelatihan</h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="row" style="width: 20%;">Type Pelatihan</th>
                                                        <th scope="row" style="width: 20%;">Nama Pelatihan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($kader_training as $training)
                                                        <tr>
                                                            <td>{{ $training->trainingtype }}</td>
                                                            <td>{{ $training->trainingname }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <h5>Riwayat Organisasi Aisyiyah</h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="row" style="width: 20%;">Tingkat Organisasi</th>
                                                        <th scope="row" style="width: 20%;">Jabatan</th>
                                                        <th scope="row" style="width: 20%;">Tahun Menjabat</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($kader_orgint as $orgint)
                                                        <tr>
                                                            <td>{{ $orgint->orggrade }}</td>
                                                            <td>{{ $orgint->orgintjabatan }}</td>
                                                            <td>{{ $orgint->orgintstart }} ~ {{ $orgint->orgintend }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <h5>Riwayat Organisasi Eksternal</h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="row" style="width: 20%;">Nama Organisasi</th>
                                                        <th scope="row" style="width: 20%;">Jabatan</th>
                                                        <th scope="row" style="width: 20%;">Tahun Menjabat</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($kader_orgext as $orgext)
                                                        <tr>
                                                            <td>{{ $orgext->orgextname }}</td>
                                                            <td>{{ $orgext->orgextjabatan }}</td>
                                                            <td>{{ $orgext->orgextstart }} ~ {{ $orgext->orgextend }}
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
    <script src="{{ base_path('/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ base_path('/assets/libs/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ base_path('/assets/libs/metismenu/metismenu.min.js') }}"></script>
    <script src="{{ base_path('/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ base_path('/assets/libs/node-waves/node-waves.min.js') }}"></script>
    <script src="{{ base_path('/assets/libs/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ base_path('/assets/libs/jquery-counterup/jquery-counterup.min.js') }}"></script>
    <script src="{{ base_path('/assets/js/app.min.js') }}"></script>
</body>

</html>
