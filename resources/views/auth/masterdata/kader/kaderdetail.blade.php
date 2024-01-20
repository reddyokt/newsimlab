@extends('layouts.master')
@section('title')
    Kader_Detail
@endsection

@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Kader
        @endslot
        @slot('title')
            Kader Detail
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @foreach ($kaderindex as $kader)
                <div class="card-body">
                    <div class="print" style="float:right;">
                        <a href="/kader/print/{{$kader->kader_id}}" target="_blank">
                            <i class="uil uil-print"></i>
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-xl-5">
                            <div class="product-detail">
                                
                                <div class="row">                                    
                                    
                                        <div class="col-9">
                                            <div class="tab-content position-relative"
                                                id="v-pills-tabContent">                                    
                                                <div class="tab-pane fade show active" id="product-1"
                                                    role="tabpanel">
                                                    <div class="product-img border">
                                                        @if (!empty($kader['pp']) && file_exists(base_path() . '/public/upload/kader/profile_picture/' . $kader->pp))
                                                            <img src="{{ '/../upload/kader/profile_picture/' . $kader->pp }}"
                                                                alt=""
                                                                class="img-fluid mx-auto d-block">
                                                        @else
                                                            <img src="{{ URL::asset('assets/media/users/default.jpg') }}"
                                                                alt=""
                                                                class="img-fluid mx-auto d-block">
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7">
                            <div class="mt-4 mt-xl-3 ps-xl-4">  
                                <h4 class="font-size-20 mb-3">{{ $kader['kader_name'] }}</h4>
                                <div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mt-3">

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
                                            <div class="mt-3">
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
                                                    <li><i
                                                            class="mdi mdi-circle-medium me-1 align-middle"></i><a
                                                            href="{{ '/../upload/kader/nbma/' . $kader->nbma }}" target="_blank">Bukti Upload NBM/NBA</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    @endforeach

                    <div class="mt-4">
                        <h5 class="font-size-14 mb-3">Data Riwayat Kader : </h5>
                        <div class="product-desc">
                            <ul class="nav nav-tabs nav-tabs-custom g-2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="edu-tab" data-bs-toggle="tab"
                                        href="#edu" role="tab">Riwayat Pendidikan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="training-tab" data-bs-toggle="tab"
                                        href="#training" role="tab">Riwayat Pelatihan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="orgint-tab" data-bs-toggle="tab"
                                        href="#orgint" role="tab">Riwayat Organisasi Aisyiyah</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="orgext-tab" data-bs-toggle="tab"
                                        href="#orgext" role="tab">Riwayat Organisasi External</a>
                                </li>
                            </ul>
                            <div class="tab-content border border-top-0 p-4">
                                <div class="tab-pane fade show active" id="edu"  role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-wrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="row" style="width: 20%;">Jenjang</th>
                                                    <th scope="row" style="width: 20%;">Tahun Lulus</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kader_edu as $edu )
                                                <tr>                                                    
                                                    <td>{{$edu->jenjang}}</td>
                                                    <td>{{$edu->eduyear}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="training" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-wrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="row" style="width: 20%;">Type Pelatihan</th>
                                                    <th scope="row" style="width: 20%;">Nama Pelatihan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kader_training as $training )
                                                <tr>                                                    
                                                    <td>{{$training->trainingtype}}</td>
                                                    <td>{{$training->trainingname}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="orgint" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-wrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="row" style="width: 20%;">Tingkat Organisasi</th>
                                                    <th scope="row" style="width: 20%;">Jabatan</th>
                                                    <th scope="row" style="width: 20%;">Tahun Menjabat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kader_orgint as $orgint )
                                                <tr>                                                    
                                                    <td>{{$orgint->orggrade}}</td>
                                                    <td>{{$orgint->orgintjabatan}}</td>
                                                    <td>{{$orgint->orgintstart}} ~ {{$orgint->orgintend}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="orgext" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-wrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="row" style="width: 20%;">Nama Organisasi</th>
                                                    <th scope="row" style="width: 20%;">Jabatan</th>
                                                    <th scope="row" style="width: 20%;">Tahun Menjabat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kader_orgext as $orgext )
                                                <tr>                                                    
                                                    <td>{{$orgext->orgextname}}</td>
                                                    <td>{{$orgext->orgextjabatan}}</td>
                                                    <td>{{$orgext->orgextstart}} ~ {{$orgext->orgextend}}</td>
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


@endsection
@section('script')
    <!-- Plugins js -->
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
@endsection