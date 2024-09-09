<header id="page-topbar" style="background-color: teal;">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ url('/dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('landing/assets/img/logo-simlab-light.svg') }}" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('landing/assets/img/logo-simlab-light.svg') }}" alt=""
                            height="50">
                    </span>
                </a>

                <a href="{{ url('/dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('landing/assets/img/logo-simlab-light.svg') }}" alt=""
                            height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('landing/assets/img/logo-simlab-light.svg') }}" alt=""
                            height="50">
                    </span>
                </a>
            </div>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="uil-search"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="@lang('translation.Search')..."
                                    aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="uil-minus-path"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (
                        !empty(Auth::user()->profile_picture) &&
                            file_exists(base_path() . '/public/upload/profile_picture/' . Session::get('picture')))
                        <img class="rounded-circle header-profile-user"
                            src="{{ asset('upload/profile_picture/' . Session::get('picture')) }}" alt="Header Avatar">
                    @else
                        <img class="rounded-circle header-profile-user"
                            src="{{ asset('assets/media/users/default.jpg') }}" alt="user" />
                    @endif
                    <span
                        class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">{{ Str::ucfirst(Auth::user()->name) }}</span>
                    <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="#"><i
                            class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span
                            class="align-middle">@lang('translation.View_Profile')</span></a>
                    <a class="dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span
                            class="align-middle">@lang('translation.Sign_out')</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="uil-cog"></i>
                </button>
            </div>

        </div>
    </div>
    <div class="container-fluid">
        <div class="topnav">
            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/dashboard') }}">
                                <i class="uil-home-alt me-2"></i> @lang('translation.Dashboard')
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="javascript: void(0);" class="nav-link dropdown-toggle arrow-none">
                                <i class="fas fa-business-time"></i>
                                <span>Praktikum<span>
                            </a>
                            <div class="dropdown-menu" aria-expanded="true">
                                @if (in_array('p3r10d3', Session::get('menu')))
                                    <a class="nav-link dropdown-toggle arrow-none" href="/periode">Periode</a>
                                @endif
                                <a class="nav-link dropdown-toggle arrow-none" href="/kelas">Kelas</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="javascript: void(0);" class="nav-link dropdown-toggle arrow-none">
                                <i class="uil-users-alt"></i>
                                <span>Praktikan<span>
                            </a>
                            <div class="dropdown-menu" aria-expanded="true">
                                <a class="nav-link dropdown-toggle arrow-none" href="/peserta">Peserta Aktif</a>
                                <a class="nav-link dropdown-toggle arrow-none" href="/kelompok">Kelompok</a>
                                <a class="nav-link dropdown-toggle arrow-none" href="/absen">Absen</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="javascript: void(0);" class="nav-link dropdown-toggle arrow-none">
                                <i class="uil-comment-alt-edit"></i>
                                <span>Penilaian<span>
                            </a>
                            <div class="dropdown-menu" aria-expanded="true">
                                <a class="nav-link dropdown-toggle arrow-none" href="/nilaitugas">Nilai Tugas</a>
                                <a class="nav-link dropdown-toggle arrow-none" href="/nilaiujian">Nilai Ujian</a>
                                <a class="nav-link dropdown-toggle arrow-none" href="/nilaiakhir">Nilai Akhir</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="javascript: void(0);" class="nav-link dropdown-toggle arrow-none">
                                <i class="uil-window-section"></i>
                                <span>Inventory<span>
                            </a>
                            <div class="dropdown-menu" aria-expanded="true">
                                <a class="nav-link dropdown-toggle arrow-none" href="/alat">Alat Praktikum</a>
                                <a class="nav-link dropdown-toggle arrow-none" href="/bahan">Bahan Praktikum</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="javascript: void(0);" class="nav-link dropdown-toggle arrow-none">
                                <i class="uil-dna"></i>
                                <span>Transaksi<span>
                            </a>
                            <div class="dropdown-menu" aria-expanded="true">
                                <a class="nav-link dropdown-toggle arrow-none" href="/analisa">Rekap Analisa</a>
                                <a class="nav-link dropdown-toggle arrow-none" href="/penelitian">Rekap Penelitian</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="javascript: void(0);" class="nav-link dropdown-toggle arrow-none">
                                <i class="uil-apps"></i>
                                <span>Master Data</span>
                            </a>
                            <div class="dropdown-menu" aria-expanded="true">
                                <a class="nav-link dropdown-toggle arrow-none" href="/komposisi">Komposisi Nilai</a>
                                <a class="nav-link dropdown-toggle arrow-none" href="/matkul">Mata Kuliah
                                    Praktikum</a>
                                <a class="nav-link dropdown-toggle arrow-none" href="/modul">Modul Praktikum</a>
                                <a class="nav-link dropdown-toggle arrow-none" href="/dosen">Dosen</a>
                                <a class="nav-link dropdown-toggle arrow-none" href="/laboran">Laboran</a>
                                <a class="nav-link dropdown-toggle arrow-none" href="/aslab">Asisten Lab</a>
                                <a class="nav-link dropdown-toggle arrow-none" href="/lokasi">Lokasi/Lemari</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="/landingproperty" class="nav-link dropdown-toggle arrow-none">
                                <i class="uil-comment-alt-image"></i>
                                <span>Landing Page</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
