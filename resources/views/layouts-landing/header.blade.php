<header class="wrapper bg-white">
    <nav class="navbar navbar-expand-lg center-logo transparent navbar-light bg-white">
      <div class="container flex-lg-row flex-nowrap align-items-center">
        <div class="navbar-brand w-100">
          <a href="./index.html">
            <img src="{{URL::asset('landing/assets/img/aisyiyah_dki.png')}}" srcset="{{URL::asset('landing/assets/img/aisyiyah_dki.png')}}" alt="" />
          </a>
        </div>
        <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
          <div class="offcanvas-header d-lg-none">
            <h3 class="text-white fs-30 mb-0">Aisyiyah DKI Jakarta</h3>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div id="nav" class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
            <ul class="navbar-nav">
              <li class="nav-item"><a class="nav-link scroll active" href="{{'/'}}">Home</a></li>
              <li class="nav-item"><a class="nav-link scroll" href="{{'#about'}}">About</a></li>
              <li class="nav-item"><a class="nav-link scroll" href="{{'#blog'}}">Berita</a></li>
              <li class="nav-item"><a class="nav-link scroll" href="{{'#contact'}}">Contact</a></li>
            </ul>
            <!-- /.navbar-nav -->
            <div class="offcanvas-footer d-lg-none">
              <div>
                <a href="mailto:first.last@email.com" class="link-inverse">info@email.com</a>
                <br /> 00 (123) 456 78 90 <br />
                <nav class="nav social social-white mt-4">
                  <a href="#"><i class="uil uil-twitter"></i></a>
                  <a href="#"><i class="uil uil-facebook-f"></i></a>
                  <a href="#"><i class="uil uil-dribbble"></i></a>
                  <a href="#"><i class="uil uil-instagram"></i></a>
                  <a href="#"><i class="uil uil-youtube"></i></a>
                </nav>
                <!-- /.social -->
              </div>
            </div>
            <!-- /.offcanvas-footer -->
          </div>
          <!-- /.offcanvas-body -->
        </div>
        <!-- /.navbar-collapse -->
        <div class="navbar-other w-100 d-flex ms-auto">
          <ul class="navbar-nav flex-row align-items-center ms-auto">
            {{-- <li class="nav-item dropdown language-select text-uppercase">
              <a class="nav-link dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">En</a>
              <ul class="dropdown-menu">
                <li class="nav-item"><a class="dropdown-item" href="#">En</a></li>
                <li class="nav-item"><a class="dropdown-item" href="#">De</a></li>
                <li class="nav-item"><a class="dropdown-item" href="#">Es</a></li>
              </ul>
            </li> --}}
            <li class="nav-item d-none d-md-block">
              <a href="/login" class="btn btn-sm btn-primary rounded-pill">Login</a>
            </li>
            <li class="nav-item d-lg-none">
              <button class="hamburger offcanvas-nav-btn"><span></span></button>
            </li>
          </ul>
          <!-- /.navbar-nav -->
        </div>
        <!-- /.navbar-other -->
      </div>
      <!-- /.container -->
    </nav>
    <!-- /.navbar -->
</header>

<script>
      $(document).ready(function(){
      $('.nav li').click(function(){
          $('.nav li').removeClass('active');
          $(this).addClass('active');
      });
  });
</script>