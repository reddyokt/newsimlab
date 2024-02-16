<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="/dashboard" class="logo logo-dark">
            <span class="logo-sm">
                <img class="" src="{{ URL::asset('landing/assets/img/simlab-ftumj.svg') }}" alt=""
                    height="30" style="align-self: center; margin-top: 20px;">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('landing/assets/img/simlab.svg') }}" alt="" height="30"
                    style="align-self: center; margin-top: 20px;">
            </span>
        </a>

        <a href="/dashboard" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('landing/assets/img/simlab-ftumj.svg') }}" alt="" height="10"
                    style="align-self: center; margin-top: 20px;">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('landing/assets/img/simlab.svg') }}" alt="" height="30"
                    style="align-self: center; margin-top: 20px;">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-business-time"></i>
                        <span>Praktikum<span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        @if(in_array('p3r10d3', Session::get('menu')))
                            <li><a href="/periode">Periode</a></li>                                                   
                        @endif
                        <li><a href="/kelas">Kelas</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-users-alt"></i>
                        <span>Praktikan<span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/peserta">Peserta Aktif</a></li>
                        <li><a href="/kelompok">Kelompok</a></li>
                        <li><a href="/absen">Absen</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-comment-alt-edit"></i>
                        <span>Penilaian<span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/nilaitugas">Nilai Tugas</a></li>
                        <li><a href="/nilaiujian">Nilai Ujian</a></li>
                        <li><a href="/nilaiakhir">Nilai Akhir</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-window-section"></i>
                        <span>Inventory<span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/alat">Alat Praktikum</a></li>
                        <li><a href="/bahan">Bahan Praktikum</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-apps"></i>
                        <span>Master Data</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/komposisi">Komposisi Nilai</a></li>
                    </ul>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/modul">Modul Praktikum</a></li>
                    </ul>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/dosen">Dosen</a></li>
                    </ul>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/laboran">Laboran</a></li>
                    </ul>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/aslab">Asisten Lab</a></li>
                    </ul>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/lokasi">Lokasi/Lemari</a></li>
                    </ul>
                </li>

                <li>
                    <a href="/landingproperty" class="waves-effect">
                        <i class="uil-comment-alt-image"></i>
                        <span>Landing Page</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Left Sidebar End -->
