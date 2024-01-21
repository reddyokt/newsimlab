<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu" style="background-color: #99e7c5">

    <!-- LOGO -->
    <div class="navbar-brand-box" style="background-color: #99e7c5;">
        <a href="/dashboard" class="logo logo-dark">
            <span class="logo-sm">
                <img class="" src="{{ URL::asset('/assets/images/logo-aisyiyah.png') }}" alt="" height="30" style="align-self: center; margin-top: 20px;">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/A.svg') }}" alt="" height="30" style="align-self: center; margin-top: 20px;">
            </span>
        </a>

        <a href="/dashboard" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/logo-aisyiyah.png') }}" alt="" height="10"  style="align-self: center; margin-top: 20px;">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/A.svg') }}" alt="" height="30" style="align-self: center; margin-top: 20px;">
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
                {{-- <li class="menu-title">@lang('translation.Menu')</li> --}}
                @if(in_array('pr0k3r', Session::get('menu')))
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-business-time"></i>
                        <span>Program Kerja<span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/proker">List Proker</a></li>
                    @if(in_array('p3r10d3', Session::get('menu')))
                        <li><a href="/periode">Periode</a></li>
                    @endif
                    </ul>
                </li>
				@endif
                @if(in_array('n3w5', Session::get('menu')))
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-newspaper"></i>
                        <span>News<span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/post">All Post</a></li>
                        <li><a href="/newscategory">News Category</a></li>
                    </ul>
                </li>
                @endif

                @if(in_array('5ur4t', Session::get('menu')))
                <li>
                    <a href="/inbox/{{Session::get('user_id')}}" class="">
                        <i class="uil-envelope"></i>
                        <span>e-Surat</span>
                    </a>
                </li>
                @endif

                @if(in_array('k4d3r', Session::get('menu')))
                <li>
                    <a href="/kader" class="">
                        <i class="uil-users-alt"></i>
                        <span>Kader</span>
                    </a>
                </li>
                @endif

                @if(in_array('4um', Session::get('menu')))
                <li>
                    <a href="/aum" class="">
                        <i class="uil-store"></i>
                        <span>AUM</span>
                    </a>
                </li>
                @endif

                @if(in_array('d0c5', Session::get('menu')))
                <li>
                    <a href="/document" class="waves-effect">
                        <i class="uil-file"></i>
                        <span>Document</span>
                    </a>
                </li>
                @endif

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-apps"></i>
                        {{-- <span>@lang('translation.Contacts')</span> --}}
                        <span>Master Data</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @if(in_array('r0l3', Session::get('menu')))
                            <li><a href="/role">Role Manajemen</a></li>
                        @endif
                        
                        @if(in_array('r0l3', Session::get('menu')))
                        <li><a href="/account">Account Manajemen</a></li>
                        @endif

                        @if(in_array('pd4', Session::get('menu')))
                        <li><a href="/pda">PDA Manajemen</a></li>
                        @endif                

                        @if(in_array('pc4', Session::get('menu')))
                        <li><a href="/pca">PCA Manajemen</a></li>
                        @endif                

                        @if(in_array('r4nt1ng', Session::get('menu')))
                        <li><a href="/ranting">Ranting Manajemen</a></li>
                        @endif                

                        @if(in_array('m47el15', Session::get('menu')))
                        <li><a href="/majelis">Majelis/Lembaga Manajemen</a></li>
                        @endif                

                        @if(in_array('f1l3', Session::get('menu')))
                        <li><a href="/filetype">File Type Manajemen</a></li>
                        @endif                

                        @if(in_array('b1d4ng', Session::get('menu')))
                        <li><a href="/bidangusaha">Bidang Usaha Manajemen</a></li>
                        @endif

                    </ul>
                </li>
            </ul>
        </div>
        {{-- <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">@lang('translation.Menu')</li>

                <li>
                    <a href="{{url('index')}}">
                        <i class="uil-home-alt"></i><span class="badge rounded-pill bg-primary float-end">01</span>
                        <span>@lang('translation.Dashboard')</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-window-section"></i>
                        <span>@lang('translation.Layouts')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">@lang('translation.Vertical')</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="layouts-dark-sidebar">@lang('translation.Dark_Sidebar')</a></li>
                                <li><a href="layouts-compact-sidebar">@lang('translation.Compact_Sidebar')</a></li>
                                <li><a href="layouts-icon-sidebar">@lang('translation.Icon_Sidebar')</a></li>
                                <li><a href="layouts-boxed">@lang('translation.Boxed_Width')</a></li>
                                <li><a href="layouts-preloader">@lang('translation.Preloader')</a></li>
                                <li><a href="layouts-colored-sidebar">@lang('translation.Colored_Sidebar')</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">@lang('translation.Horizontal')</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="layouts-horizontal">@lang('translation.Horizontal')</a></li>
                                <li><a href="layouts-hori-topbar-dark">@lang('translation.Dark_Topbar')</a></li>
                                <li><a href="layouts-hori-boxed-width">@lang('translation.Boxed_Width')</a></li>
                                <li><a href="layouts-hori-preloader">@lang('translation.Preloader')</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="menu-title">@lang('translation.Apps')</li>

                <li>
                    <a href="calendar" class="waves-effect">
                        <i class="uil-calender"></i>
                        <span>@lang('translation.Calendar')</span>
                    </a>
                </li>

                <li>
                    <a href="chat" class=" waves-effect">
                        <i class="uil-comments-alt"></i>
                        <span>@lang('translation.Chat')</span>
                    </a>
                </li>

                <li>
                    <a href="file-manager" class=" waves-effect">
                        <i class="uil-comments-alt"></i>
                        <span class="badge rounded-pill bg-success float-end">@lang('translation.New')</span>
                        <span>@lang('translation.File_Manager')</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-store"></i>
                        <span>@lang('translation.Ecommerce')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="ecommerce-products">@lang('translation.Products')</a></li>
                        <li><a href="ecommerce-product-detail">@lang('translation.Product_Detail')</a></li>
                        <li><a href="ecommerce-orders">@lang('translation.Orders')</a></li>
                        <li><a href="ecommerce-customers">@lang('translation.Customers')</a></li>
                        <li><a href="ecommerce-cart">@lang('translation.Cart')</a></li>
                        <li><a href="ecommerce-checkout">@lang('translation.Checkout')</a></li>
                        <li><a href="ecommerce-shops">@lang('translation.Shops')</a></li>
                        <li><a href="ecommerce-add-product">@lang('translation.Add_Product')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-envelope"></i>
                        <span>@lang('translation.Email')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="email-inbox">@lang('translation.Inbox')</a></li>
                        <li><a href="email-read">@lang('translation.Read_Email')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-invoice"></i>
                        <span>@lang('translation.Invoices')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="invoices-list">@lang('translation.Invoice_List')</a></li>
                        <li><a href="invoices-detail">@lang('translation.Invoice_Detail')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-book-alt"></i>
                        <span>@lang('translation.Contacts')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="contacts-grid">@lang('translation.User_Grid')</a></li>
                        <li><a href="contacts-list">@lang('translation.User_List')</a></li>
                        <li><a href="contacts-profile">@lang('translation.Profile')</a></li>
                    </ul>
                </li>

                <li class="menu-title">@lang('translation.Pages')</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-user-circle"></i>
                        <span>@lang('translation.Authentication')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="auth-login">@lang('translation.Login')</a></li>
                        <li><a href="auth-register">@lang('translation.Register')</a></li>
                        <li><a href="auth-recoverpw">@lang('translation.Recover_Password')</a></li>
                        <li><a href="auth-lock-screen">@lang('translation.Lock_Screen')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-file-alt"></i>
                        <span>@lang('translation.Utility')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-starter">@lang('translation.Starter_Page')</a></li>
                        <li><a href="pages-maintenance">@lang('translation.Maintenance')</a></li>
                        <li><a href="pages-comingsoon">@lang('translation.Coming_Soon')</a></li>
                        <li><a href="pages-timeline">@lang('translation.Timeline')</a></li>
                        <li><a href="pages-faqs">@lang('translation.FAQs')</a></li>
                        <li><a href="pages-pricing">@lang('translation.Pricing')</a></li>
                        <li><a href="pages-404">@lang('translation.Error_404')</a></li>
                        <li><a href="pages-500">@lang('translation.Error_500')</a></li>
                    </ul>
                </li>

                <li class="menu-title">@lang('translation.Components')</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-flask"></i>
                        <span>@lang('translation.UI_Elements')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="ui-alerts">@lang('translation.Alerts')</a></li>
                        <li><a href="ui-buttons">@lang('translation.Buttons')</a></li>
                        <li><a href="ui-cards">@lang('translation.Cards')</a></li>
                        <li><a href="ui-carousel">@lang('translation.Carousel')</a></li>
                        <li><a href="ui-dropdowns">@lang('translation.Dropdowns')</a></li>
                        <li><a href="ui-grid">@lang('translation.Grid')</a></li>
                        <li><a href="ui-images">@lang('translation.Images')</a></li>
                        <li><a href="ui-lightbox">@lang('translation.Lightbox')</a></li>
                        <li><a href="ui-modals">@lang('translation.Modals')</a></li>
                        <li><a href="ui-offcanvas">@lang('translation.Offcanvas')</a></li>
                        <li><a href="ui-rangeslider">@lang('translation.Range_Slider')</a></li>
                        <li><a href="ui-session-timeout">@lang('translation.Session_Timeout')</a></li>
                        <li><a href="ui-progressbars">@lang('translation.Progress_Bars')</a></li>
                        <li><a href="ui-placeholders">@lang('translation.Placeholders')</a></li>
                        <li><a href="ui-sweet-alert">@lang('translation.Sweet_Alert')</a></li>
                        <li><a href="ui-tabs-accordions">@lang('translation.Tabs_Accordions')</a></li>
                        <li><a href="ui-typography">@lang('translation.Typography')</a></li>
                        <li><a href="ui-utilities.html">@lang('translation.Utilities')<span class="badge rounded-pill bg-success float-end">@lang('translation.New')</span></a></li>
                        <li><a href="ui-toasts">@lang('translation.Toasts')</a></li>
                        <li><a href="ui-video">@lang('translation.Video')</a></li>
                        <li><a href="ui-general">@lang('translation.General')</a></li>
                        <li><a href="ui-colors">@lang('translation.Colors')</a></li>
                        <li><a href="ui-rating">@lang('translation.Rating')</a></li>
                        <li><a href="ui-notifications">@lang('translation.Notifications')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="uil-shutter-alt"></i>
                        <span class="badge rounded-pill bg-info float-end">9</span>
                        <span>@lang('translation.Forms')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="form-elements">@lang('translation.Basic_Elements')</a></li>
                        <li><a href="form-validation">@lang('translation.Validation')</a></li>
                        <li><a href="form-advanced">@lang('translation.Advanced_Plugins')</a></li>
                        <li><a href="form-editors">@lang('translation.Editors')</a></li>
                        <li><a href="form-uploads">@lang('translation.File_Upload')</a></li>
                        <li><a href="form-xeditable">@lang('translation.Xeditable')</a></li>
                        <li><a href="form-repeater">@lang('translation.Repeater')</a></li>
                        <li><a href="form-wizard">@lang('translation.Wizard')</a></li>
                        <li><a href="form-mask">@lang('translation.Mask')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-list-ul"></i>
                        <span>@lang('translation.Tables')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="tables-basic">@lang('translation.Bootstrap_Basic')</a></li>
                        <li><a href="tables-datatable">@lang('translation.Datatables')</a></li>
                        <li><a href="tables-responsive">@lang('translation.Responsive')</a></li>
                        <li><a href="tables-editable">@lang('translation.Editable')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-chart"></i>
                        <span>@lang('translation.Charts')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="charts-apex">@lang('translation.Apex')</a></li>
                        <li><a href="charts-chartjs">@lang('translation.Chartjs')</a></li>
                        <li><a href="charts-flot">@lang('translation.Flot')</a></li>
                        <li><a href="charts-knob">@lang('translation.Jquery_Knob')</a></li>
                        <li><a href="charts-sparkline">@lang('translation.Sparkline')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-streering"></i>
                        <span>@lang('translation.Icons')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="icons-unicons">@lang('translation.Unicons')</a></li>
                        <li><a href="icons-boxicons">@lang('translation.Boxicons')</a></li>
                        <li><a href="icons-materialdesign">@lang('translation.Material_Design')</a></li>
                        <li><a href="icons-dripicons">@lang('translation.Dripicons')</a></li>
                        <li><a href="icons-fontawesome">@lang('translation.Font_Awesome')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-location-point"></i>
                        <span>@lang('translation.Maps')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="maps-google">@lang('translation.Google')</a></li>
                        <li><a href="maps-vector">@lang('translation.Vector')</a></li>
                        <li><a href="maps-leaflet">@lang('translation.Leaflet')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-share-alt"></i>
                        <span>@lang('translation.Multi_Level')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="javascript: void(0);">@lang('translation.Level_1.1')</a></li>
                        <li><a href="javascript: void(0);" class="has-arrow">@lang('translation.Level_1.2')</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript: void(0);">@lang('translation.Level_2.1')</a></li>
                                <li><a href="javascript: void(0);">@lang('translation.Level_2.2')</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

            </ul>
        </div> --}}
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
