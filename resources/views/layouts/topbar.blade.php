<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="/dashboard" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('/assets/images/logo-aisyiyah.png') }}" alt="" height="22" style="align-self: center; margin-top: 20px;">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('/assets/images/A.svg') }}" alt="" height="20">
                    </span>
                </a>

                <a href="/dashboard" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('/assets/images/logo-aisyiyah.png') }}" alt="" height="22" style="align-self: center; margin-top: 20px;">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('/assets/images/A.svg') }}" alt="" height="20">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="uil-search"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="@lang('translation.Search')..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
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

            {{-- <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="uil-bell"></i>
                    <span class="badge bg-danger rounded-pill">3</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="m-0 font-size-16"> @lang('translation.Notifications') </h5>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small"> @lang('translation.Mark_read')</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        @if(isset($notifikasi))
                        @foreach ($notifikasi as $notif )
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 me-3">
                                    <img src="{{ URL::asset('/assets/images/users/avatar-3.jpg') }}" class="rounded-circle avatar-xs" alt="user-pic">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mt-0 mb-1">{{$notif->nama_alat}}</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">@lang('translation.simplified_English')</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> @lang('translation.1_hours_ago')</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        @else
                        @endif
                    </div>
                    
                    <div class="p-2 border-top">
                        <div class="d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                <i class="uil-arrow-circle-right me-1"></i> @lang('translation.View_More')..
                            </a>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(!empty(Auth::user()->profile_picture) && file_exists(base_path() . '/public/upload/profile_picture/'.Session::get('picture')))
                    <img class="rounded-circle header-profile-user" src="{{asset('upload/profile_picture/'.Session::get('picture'))}}" alt="Header Avatar">
                    @else
                    <img class="rounded-circle header-profile-user"  src="{{asset('assets/media/users/default.jpg')}}" alt="user" />
                    @endif
                    <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">{{Session::get('name')}}</span>
                    <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="/profile/{{Session::get('user_id')}}"><i class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i>
                        <span class="align-middle">@lang('translation.View_Profile')</span></a>
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"><i class="uil uil-lock-alt font-size-18 align-middle me-1 text-muted"></i>
                        <span class="align-middle">Change Password</span></a>
                    <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i>
                        <span class="align-middle">@lang('translation.Sign_out')</span></a>
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
</header>

