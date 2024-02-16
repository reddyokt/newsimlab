@extends('layouts-landing.master')
@section('title')
@endsection

@section('css')
    {{-- <link href="{{ URL::asset('/assets/libs/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" /> --}}
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
                                <h2 class="fs-15 text-uppercase text-muted mb-3">Sewa Lab</h2>
                                <h3 class="display-4 mb-15 mb-md-6 px-lg-10">Kami Menyewakan Laboratorium untuk Umum dan
                                    Internal Kampus.</h3>
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
                                            <h4 class="card-title">Basic Plan</h4>
                                            <div class="prices text-dark">
                                                <div class="price price-show"><span class="price-currency">$</span><span
                                                        class="price-value">9</span> <span class="price-duration">mo</span>
                                                </div>
                                                <div class="price price-hide price-hidden"><span
                                                        class="price-currency">$</span><span class="price-value">99</span>
                                                    <span class="price-duration">yr</span>
                                                </div>
                                            </div>
                                            <!--/.prices -->
                                            <ul class="icon-list bullet-bg bullet-soft-primary mt-7 mb-8 text-start">
                                                <li><i class="uil uil-check"></i><span><strong>1</strong> Project </span>
                                                </li>
                                                <li><i class="uil uil-check"></i><span><strong>100K</strong> API Access
                                                    </span></li>
                                                <li><i class="uil uil-check"></i><span><strong>100MB</strong> Storage
                                                    </span></li>
                                                <li><i class="uil uil-times bullet-soft-red"></i><span> Weekly
                                                        <strong>Reports</strong> </span></li>
                                                <li><i class="uil uil-times bullet-soft-red"></i><span> 7/24
                                                        <strong>Support</strong></span></li>
                                            </ul>
                                            <a href="#" class="btn btn-primary rounded-pill">Choose Plan</a>
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
                                            <h4 class="card-title">Premium Plan</h4>
                                            <div class="prices text-dark">
                                                <div class="price price-show"><span class="price-currency">$</span><span
                                                        class="price-value">19</span> <span class="price-duration">mo</span>
                                                </div>
                                                <div class="price price-hide price-hidden"><span
                                                        class="price-currency">$</span><span class="price-value">199</span>
                                                    <span class="price-duration">yr</span>
                                                </div>
                                            </div>
                                            <!--/.prices -->
                                            <ul class="icon-list bullet-bg bullet-soft-primary mt-7 mb-8 text-start">
                                                <li><i class="uil uil-check"></i><span><strong>5</strong> Projects </span>
                                                </li>
                                                <li><i class="uil uil-check"></i><span><strong>100K</strong> API Access
                                                    </span></li>
                                                <li><i class="uil uil-check"></i><span><strong>200MB</strong> Storage
                                                    </span></li>
                                                <li><i class="uil uil-check"></i><span> Weekly
                                                        <strong>Reports</strong></span></li>
                                                <li><i class="uil uil-times bullet-soft-red"></i><span> 7/24
                                                        <strong>Support</strong></span></li>
                                            </ul>
                                            <a href="#" class="btn btn-primary rounded-pill">Choose Plan</a>
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
                                            <h4 class="card-title">Corporate Plan</h4>
                                            <div class="prices text-dark">
                                                <div class="price price-show"><span class="price-currency">$</span><span
                                                        class="price-value">49</span> <span
                                                        class="price-duration">mo</span></div>
                                                <div class="price price-hide price-hidden"><span
                                                        class="price-currency">$</span><span
                                                        class="price-value">499</span> <span
                                                        class="price-duration">yr</span></div>
                                            </div>
                                            <!--/.prices -->
                                            <ul class="icon-list bullet-bg bullet-soft-primary mt-7 mb-8 text-start">
                                                <li><i class="uil uil-check"></i><span><strong>20</strong> Projects </span>
                                                </li>
                                                <li><i class="uil uil-check"></i><span><strong>300K</strong> API Access
                                                    </span></li>
                                                <li><i class="uil uil-check"></i><span><strong>500MB</strong> Storage
                                                    </span></li>
                                                <li><i class="uil uil-check"></i><span> Weekly
                                                        <strong>Reports</strong></span></li>
                                                <li><i class="uil uil-check"></i><span> 7/24
                                                        <strong>Support</strong></span></li>
                                            </ul>
                                            <a href="#" class="btn btn-primary rounded-pill">Choose Plan</a>
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
        <div class="container py-1 pt-md-1 pb-md-6">
            <h3 class="display-6 mb-1 pe-xl-1 text-center">Tanggal Praktikum</h3>
            <div class="card p-5 mb-4">
                <div class="row align-items-center counter-wrapper gy-6 text-center">
                    <table class="table table-bordered">
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
                                        Kelas  {{ $dt->nama_kelas }} Tahun Ajaran {{ $dt->tahun_ajaran }} - {{ $dt->semester }}
                                    </td>
                                    <td>{{ $dt->modul_name }}</td>
                                    <td>
                                        @if ($dt->tanggal_praktek == null)
                                            Tanggal Praktek Belum ditentukan
                                        @else
                                            {{ $dt->tanggal_praktek }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--/.row -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /section -->
    {{-- <section class="wrapper bg-light">
    <div class="container py-14 py-md-16 pb-md-17">
        <div class="grid mb-14 mb-md-18 mt-3">
            <div class="row isotope gy-6 mt-n19 mt-md-n22">
                <div class="item col-md-6 col-xl-3">
                    <div class="card shadow-lg card-border-bottom border-soft-primary">
                        <div class="card-body">
                            <span class="ratings five mb-3"></span>
                            <blockquote class="icon mb-0">
                                <p>“Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta. Cras mattis consectetur.”</p>
                                <div class="blockquote-details">
                                    <div class="info ps-0">
                                        <h5 class="mb-1">Coriss Ambady</h5>
                                        <p class="mb-0">Financial Analyst</p>
                                    </div>
                                </div>
                            </blockquote>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/column -->
                <div class="item col-md-6 col-xl-3">
                    <div class="card shadow-lg card-border-bottom border-soft-primary">
                        <div class="card-body">
                            <span class="ratings five mb-3"></span>
                            <blockquote class="icon mb-0">
                                <p>“Fusce dapibus, tellus ac cursus tortor mauris condimentum fermentum massa justo sit amet purus sit amet fermentum.”</p>
                                <div class="blockquote-details">
                                    <div class="info ps-0">
                                        <h5 class="mb-1">Cory Zamora</h5>
                                        <p class="mb-0">Marketing Specialist</p>
                                    </div>
                                </div>
                            </blockquote>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/column -->
                <div class="item col-md-6 col-xl-3">
                    <div class="card shadow-lg card-border-bottom border-soft-primary">
                        <div class="card-body">
                            <span class="ratings five mb-3"></span>
                            <blockquote class="icon mb-0">
                                <p>“Curabitur blandit tempus porttitor. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor eu rutrum. Nulla vitae libero.”</p>
                                <div class="blockquote-details">
                                    <div class="info ps-0">
                                        <h5 class="mb-1">Nikolas Brooten</h5>
                                        <p class="mb-0">Sales Manager</p>
                                    </div>
                                </div>
                            </blockquote>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/column -->
                <div class="item col-md-6 col-xl-3">
                    <div class="card shadow-lg card-border-bottom border-soft-primary">
                        <div class="card-body">
                            <span class="ratings five mb-3"></span>
                            <blockquote class="icon mb-0">
                                <p>“Etiam adipiscing tincidunt elit convallis felis suscipit ut. Phasellus rhoncus eu tincidunt auctor nullam rutrum, pharetra augue.”</p>
                                <div class="blockquote-details">
                                    <div class="info ps-0">
                                        <h5 class="mb-1">Coriss Ambady</h5>
                                        <p class="mb-0">Financial Analyst</p>
                                    </div>
                                </div>
                            </blockquote>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.grid-view -->
        <div class="projects-tiles">
            <div class="project grid grid-view">
                <div class="row gx-md-8 gx-xl-12 gy-10 gy-md-12 isotope">
                    <div class="item col-md-6 mt-md-7 mt-lg-15">
                        <div class="project-details d-flex justify-content-center align-self-end flex-column ps-0 pb-0">
                            <div class="post-header">
                                <h2 class="display-4 mb-4 pe-xxl-15">Check out some of our recent projects below.</h2>
                                <p class="lead fs-lg mb-0">We love to turn ideas into beautiful things.</p>
                            </div>
                            <!-- /.post-header -->
                        </div>
                        <!-- /.project-details -->
                    </div>
                    <!-- /.item -->
                    <div class="item col-md-6">
                        <figure class="lift rounded mb-6"><a href="@@webRoot/single-project3.html"> <img src="@@webRoot/assets/img/photos/rp1.jpg" srcset="@@webRoot/assets/img/photos/rp1@2x.jpg 2x" alt="" /></a></figure>
                        <div class="post-category text-line mb-2 text-violet">Stationary</div>
                        <h2 class="post-title h3">Ipsum Ultricies Cursus</h2>
                    </div>
                    <!-- /.item -->
                    <div class="item col-md-6">
                        <figure class="lift rounded mb-6"><a href="@@webRoot/single-project2.html"> <img src="@@webRoot/assets/img/photos/rp2.jpg" srcset="@@webRoot/assets/img/photos/rp2@2x.jpg 2x" alt="" /></a></figure>
                        <div class="post-category text-line mb-2 text-leaf">Invitation</div>
                        <h2 class="post-title h3">Mollis Ipsum Mattis</h2>
                    </div>
                    <!-- /.item -->
                    <div class="item col-md-6">
                        <figure class="lift rounded mb-6"><a href="@@webRoot/single-project.html"> <img src="@@webRoot/assets/img/photos/rp3.jpg" srcset="@@webRoot/assets/img/photos/rp3@2x.jpg 2x" alt="" /></a></figure>
                        <div class="post-category text-line mb-2 text-purple">Notebook</div>
                        <h2 class="post-title h3">Magna Tristique Inceptos</h2>
                    </div>
                    <!-- /.item -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.project -->
        </div>
        <!-- /.projects-tiles -->
    </div>
    <!-- /.container -->
</section> --}}
    <!-- /section -->
    {{-- <section class="wrapper bg-soft-primary">
    <div class="container py-14 py-md-17">
        <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
            <div class="col-lg-7">
                <figure><img class="w-auto" src="@@webRoot/assets/img/illustrations/i5.png" srcset="@@webRoot/assets/img/illustrations/i5@2x.png 2x" alt="" /></figure>
            </div>
            <!--/column -->
            <div class="col-lg-5">
                <h3 class="display-4 mb-7">Got any questions? Don't hesitate to get in touch.</h3>
                <div class="d-flex flex-row">
                    <div>
                        <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-location-pin-alt"></i> </div>
                    </div>
                    <div>
                        <h5 class="mb-1">Address</h5>
                        <address>Moonshine St. 14/05 Light City, London</address>
                    </div>
                </div>
                <div class="d-flex flex-row">
                    <div>
                        <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-phone-volume"></i> </div>
                    </div>
                    <div>
                        <h5 class="mb-1">Phone</h5>
                        <p>00 (123) 456 78 90</p>
                    </div>
                </div>
                <div class="d-flex flex-row">
                    <div>
                        <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-envelope"></i> </div>
                    </div>
                    <div>
                        <h5 class="mb-1">E-mail</h5>
                        <p class="mb-0"><a href="mailto:sandbox@email.com" class="link-body">sandbox@email.com</a></p>
                    </div>
                </div>
            </div>
            <!--/column -->
        </div>
        <!--/.row -->
    </div>
    <!-- /.container -->
</section> --}}
    <!-- /section -->
@endsection
{{-- @section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/moment/moment.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jquery-ui-dist/jquery-ui-dist.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/fullcalendar/fullcalendar.min.js') }}"></script>

    <!-- Calendar init -->
    <script src="{{ URL::asset('/assets/js/pages/calendar.init.js') }}"></script>
@endsection --}}
