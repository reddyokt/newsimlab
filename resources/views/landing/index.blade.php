@extends('layouts-landing.master')
@section('title')
@endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <section class="wrapper bg-soft-primary">
        <div class="container pt-10 pb-15 pt-md-14 pb-md-20">
            <div class="row gx-lg-8 gx-xl-12 gy-10 mb-5 align-items-center">
                <div class="col-md-10 offset-md-1 offset-lg-0 col-lg-4 text-center text-lg-start order-2 order-lg-0"
                    data-cues="slideInDown" data-group="page-title" data-delay="600">
                    <h1 class="display-1 mb-5 mx-md-n5 mx-lg-0">Sistem Informasi Laboratorium.</h1>
                    <p class="lead fs-lg mb-7">Teknik Kimia, Fakultas Teknik <br> Universitas Muhammadiyah Jakarta</p>
                </div>
                <!-- /column -->
                <div class="col-lg-8" data-cue="slideInDown">
                    <figure><img class="w-auto" src="{{ asset('landing/assets/img/bg-image-3.svg') }}" alt="" />
                    </figure>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light">
        <div class="container py-14 py-md-16 pb-md-17">
            <div class="row gx-md-5 gy-5 mt-n18 mt-md-n21 mb-14 mb-md-10">
                <div class="col-md-6 col-xl-3">
                    <div class="card shadow-lg card-border-bottom border-soft-yellow">
                        <div class="card-body">
                            <img src="{{ asset('landing/assets/img/1.svg') }}"
                                class="svg-inject icon-svg icon-svg-md text-yellow mb-3" alt="" />
                            <h4>Laboratorium Proses Kimia dan Bioproses</h4>
                            <p class="mb-2">Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida
                                at eget metus cras justo.</p>

                        </div>
                        <!--/.card-body -->
                    </div>
                    <!--/.card -->
                </div>
                <!--/column -->
                <div class="col-md-6 col-xl-3">
                    <div class="card shadow-lg card-border-bottom border-soft-green">
                        <div class="card-body">
                            <img src="{{ asset('landing/assets/img/2.svg') }}"
                                class="svg-inject icon-svg icon-svg-md text-green mb-3" alt="" />
                            <h4>Laboratorium Kimia Analisis dan Kimia Fisika</h4>
                            <p class="mb-2">Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida
                                at eget metus cras justo.</p>

                        </div>
                        <!--/.card-body -->
                    </div>
                    <!--/.card -->
                </div>
                <!--/column -->
                <div class="col-md-6 col-xl-3">
                    <div class="card shadow-lg card-border-bottom border-soft-orange">
                        <div class="card-body">
                            <img src="{{ asset('landing/assets/img/3.svg') }}"
                                class="svg-inject icon-svg icon-svg-md text-orange mb-3" alt="" />
                            <h4>Laboratorium Kimia Proses</h4>
                            <p class="mb-2">Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida
                                at eget metus cras justo.</p>

                        </div>
                        <!--/.card-body -->
                    </div>
                    <!--/.card -->
                </div>
                <!--/column -->
                <div class="col-md-6 col-xl-3">
                    <div class="card shadow-lg card-border-bottom border-soft-blue">
                        <div class="card-body">
                            <img src="{{ asset('landing/assets/img/4.svg') }}"
                                class="svg-inject icon-svg icon-svg-md text-blue mb-3" alt="" />
                            <h4>Laboratorium Unit Operasi Kimia</h4>
                            <p class="mb-2">Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida
                                at eget metus cras justo.</p>

                        </div>
                        <!--/.card-body -->
                    </div>
                    <!--/.card -->
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
            <div class="row gx-lg-8 gx-xl-12 gy-10 mb-4 mb-md-5 align-items-center">
                <section class="wrapper bg-light">
                    <div class="container py-14 py-md-16">
                        <div class="row">
                            <div class="col-lg-10 col-xl-9 col-xxl-8 mx-auto text-center">
                                <h2 class="fs-15 text-uppercase text-muted mb-3">Penggunaan Lab</h2>
                                <h3 class="display-4 mb-15 mb-md-6 px-lg-10">Untuk Penelitian Mahasiswa, Dosen, dan Umum</h3>
                            </div>
                            <!--/column -->
                        </div>
                        <!--/.row -->
                        <div class="pricing-wrapper position-relative">
                            <div class="shape bg-dot primary rellax w-16 h-18" data-rellax-speed="1"
                                style="top: 2rem; right: -2.4rem;"></div>
                            <div class="shape rounded-circle bg-line red rellax w-18 h-18 d-none d-lg-block"
                                data-rellax-speed="1" style="bottom: 0.5rem; left: -2.5rem;"></div>

                            <div class="row gy-6 mt-3 mt-md-5">
                                <div class="col-md-6 col-lg-4">
                                    <div class="pricing card text-center">
                                        <div class="card-body">
                                            <img src="{{ asset('landing/assets/img/5.svg') }}"
                                                class="svg-inject icon-svg icon-svg-lg text-primary mb-3" alt="" />
                                            <h4 class="card-title">Dosen</h4>
                                            <div class="prices text-dark">
                                                <div class="price price-show"><span class="price-currency">Rp.</span><span
                                                        class="price-value">400K</span>
                                                </div>
                                                <div class="price price-hide price-hidden"><span
                                                        class="price-currency">Rp.</span><span class="price-value">400K</span>
                                                    <span class="price-duration"></span>
                                                </div>
                                            </div>
                                            <!--/.prices -->
                                            <ul class="icon-list bullet-bg bullet-soft-primary mt-7 mb-8 text-start">
                                                <li class="text-danger"><i class="uil uil-exclamation text-danger"></i><span ><strong>Wajib Memiliki JSA </strong> </span>
                                                </li>
                                                <li class="text-danger"><i class="uil uil-exclamation text-danger"></i><span ><strong>Extra Charges</strong> Sabtu & Ahad
                                                    </span></li>
                                            </ul>
                                            <a href="/form-daftar-penelitian/dosen" class="btn btn-primary rounded-pill">Daftar</a>
                                        </div>
                                        <!--/.card-body -->
                                    </div>
                                    <!--/.pricing -->
                                </div>
                                <!--/column -->
                                <div class="col-md-6 col-lg-4 popular">
                                    <div class="pricing card text-center">
                                        <div class="card-body">
                                            <img src="{{ asset('landing/assets/img/6.svg') }}"
                                                class="svg-inject icon-svg icon-svg-lg text-primary mb-3" alt="" />
                                            <h4 class="card-title">Mahasiswa</h4>
                                            <div class="prices text-dark">
                                                <div class="price price-show"><span class="price-currency">Rp.</span><span
                                                        class="price-value">200K</span>
                                                </div>
                                                <div class="price price-hide price-hidden"><span
                                                        class="price-currency">Rp.</span><span
                                                        class="price-value">200</span>
                                                    <span class="price-duration">yr</span>
                                                </div>
                                            </div>
                                            <!--/.prices -->
                                            <ul class="icon-list bullet-bg bullet-soft-primary mt-7 mb-8 text-start">
                                                <li class="text-danger"><i class="uil uil-exclamation text-danger"></i><span ><strong>Wajib Memiliki JSA </strong> </span>
                                                </li>
                                                <li class="text-danger"><i class="uil uil-exclamation text-danger"></i><span ><strong>Extra Charges</strong> Sabtu & Ahad
                                                    </span></li>
                                            </ul>
                                            <a href="/form-daftar-penelitian/mahasiswa" class="btn btn-primary rounded-pill">Daftar</a>
                                        </div>
                                        <!--/.card-body -->
                                    </div>
                                    <!--/.pricing -->
                                </div>
                                <!--/column -->
                                <div class="col-md-6 offset-md-3 col-lg-4 offset-lg-0">
                                    <div class="pricing card text-center">
                                        <div class="card-body">
                                            <img src="{{ asset('landing/assets/img/7.svg') }}"
                                                class="svg-inject icon-svg icon-svg-lg text-primary mb-3"
                                                alt="" />
                                            <h4 class="card-title">Umum</h4>
                                            <div class="prices text-dark">
                                                <div class="price price-show"><span class="price-currency">Rp.</span><span
                                                        class="price-value">500K</span></div>
                                                <div class="price price-hide price-hidden"><span
                                                        class="price-currency">Rp.</span><span
                                                        class="price-value">499</span> <span
                                                        class="price-duration">yr</span></div>
                                            </div>
                                            <!--/.prices -->
                                            <ul class="icon-list bullet-bg bullet-soft-primary mt-7 mb-8 text-start">
                                                <li class="text-danger"><i class="uil uil-exclamation text-danger"></i><span ><strong>Wajib Memiliki JSA </strong> </span>
                                                </li>
                                                <li class="text-danger"><i class="uil uil-exclamation text-danger"></i><span ><strong>Extra Charges</strong> Sabtu & Ahad
                                                    </span></li>
                                            </ul>
                                            <a href="/form-daftar-penelitian/umum" class="btn btn-primary rounded-pill">Daftar</a>
                                        </div>
                                        <!--/.card-body -->
                                    </div>
                                    <!--/.pricing -->
                                </div>
                                <!--/column -->
                            </div>
                            <!--/.row -->
                        </div>
                        <!--/.pricing-wrapper -->
                    </div>
                    <!-- /.container -->
                </section>
                <!-- /section -->
            </div>
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-soft-primary">
        <div class="container pt-10 pb-15 pt-md-14 pb-md-20">
            <div class="card mb-4">
                <div class="card-body" style="overflow:auto">
                    <h3 class="display-6 mb-1 pe-xl-1 text-center">Tanggal Praktikum</h3>
                    <table id="datatable" class="table table-bordered dt-responsive wrap text-center"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Modul Praktikum</th>
                                <th scope="col">Tanggal Praktikum</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal as $dt)
                                <tr>
                                    <td style="width: 5%;">{{ $loop->iteration }}</td>
                                    <td>
                                        Kelas {{ $dt->kels->nama_kelas }} Tahun Ajaran {{ $dt->periode->tahun_ajaran }} -
                                        {{ $dt->periode->semester }}
                                    </td>
                                    <td>{{ $dt->moduls->modul_name }}</td>
                                    <td>
                                        @if ($dt->tanggal_praktek == null)
                                            Tanggal Praktek Belum ditentukan
                                        @else
                                            {{ \Carbon\Carbon::parse($dt->tanggal_praktek)->isoFormat('dddd, D MMMM Y') }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
