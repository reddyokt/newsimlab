@extends('layouts-landing.master')
@section('title')
@endsection

@section('content')

<section class="wrapper bg-soft-primary">
    <div class="container pt-10 pb-19 pt-md-14 pb-md-20 text-center">
      <div class="row">
        <div class="col-md-10 col-xl-8 mx-auto">
          <div class="post-header">
            <div class="post-category text-line">
              <a href="#" class="hover" rel="category">{{$postBlog->category}}</a>
            </div>
            <!-- /.post-category -->
            <h1 class="display-6 mb-4">{{$postBlog->news_title}}</h1>
            <ul class="post-meta mb-5">
              <li class="post-date"><i class="uil uil-calendar-alt"></i><span>{{ \Carbon\Carbon::parse($postBlog->created_at)->format('l, d/m/Y') }}</span></li>
              <li class="post-author"><a href="#"><i class="uil uil-user"></i><span>{{$postBlog->author}}</span></a></li>
            </ul>
            <!-- /.post-meta -->
          </div>
          <!-- /.post-header -->
        </div>
        <!-- /column -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </section>
  <!-- /section -->
  <section class="wrapper bg-light">
    <div class="container pb-14 pb-md-16">
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <div class="blog single mt-n17">
            <div class="card">
              <figure class="card-img-top"><img src="{{ '/../upload/feature_image/' . $postBlog->feature_image }}" alt="" /></figure>
              <div class="card-body">
                <div class="classic-view">
                  <article class="post">
                    <div class="post-content mb-5">

                      <div class="row g-4 mt-3 mb-3">
                        <div class="col-md-6">
                            @if ($postBlog->images != Null)
                            <figure class="hover-scale rounded cursor-dark"><a href="{{ '/../upload/feature_image/' . $postBlog->images }}"
                                data-glightbox="title: Heading; description: Purus Vulputate Sem Tellus Quam"
                                data-gallery="post"> <img src="{{ '/../upload/feature_image/' . $postBlog->images }}" alt="" /></a></figure>
                            @else

                            @endif
                        </div>
                        <!--/column -->
                      </div>
                      <!-- /.row -->
                      <p>{!! $postBlog->news_body !!}</p>
                    </div>
                    <!-- /.post-content -->
                    <div class="post-footer d-md-flex flex-md-row justify-content-md-between align-items-center mt-8">
                      <div class="mb-0 mb-md-2">
                        <div class="dropdown share-dropdown btn-group">
                          <button class="btn btn-sm btn-red rounded-pill btn-icon btn-icon-start dropdown-toggle mb-0 me-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil uil-share-alt"></i> Share </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#"><i class="uil uil-twitter"></i>Twitter</a>
                            <a class="dropdown-item" href="#"><i class="uil uil-facebook-f"></i>Facebook</a>
                            <a class="dropdown-item" href="#"><i class="uil uil-linkedin"></i>Linkedin</a>
                          </div>
                          <!--/.dropdown-menu -->
                        </div>
                        <!--/.share-dropdown -->
                      </div>
                    </div>
                    <!-- /.post-footer -->
                  </article>
                  <!-- /.post -->
                </div>
                <!-- /.classic-view -->
                <hr />

                <h3 class="mb-6">Berita Lainnya</h3>
                <div class="swiper-container blog grid-view mb-16" data-margin="30" data-dots="true" data-items-md="4" data-items-xs="1">
                  <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach ( $anotherpost as $ano )

                      <div class="swiper-slide">
                        <article>
                          <figure class="overlay overlay-1 hover-scale rounded mb-5"><a href="/read/post/{{ $ano->slug }}">
                            <img src="{{ '/../upload/feature_image/' . $ano->feature_image }}" alt="" /></a>
                            <figcaption>
                              <h5 class="from-top mb-0">Read More</h5>
                            </figcaption>
                          </figure>
                          <div class="post-header">
                            <div class="post-category text-line">
                              <a href="#" class="hover" rel="category">{{$ano->category}}</a>
                            </div>
                            <!-- /.post-category -->
                            <h2 class="post-title h5 mt-1 mb-3"><a class="link-dark" href="/read/post/{{ $ano->slug }}">
                                {{$ano->news_title}}</a></h2>
                          </div>
                          <!-- /.post-header -->
                          <div class="post-footer">
                            <ul class="post-meta mb-0">
                              <li class="post-date"><i class="uil uil-calendar-alt"></i><span>{{ \Carbon\Carbon::parse($ano->created_at)->format('l, d/m/Y') }}</span></li>
                              {{-- <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>4</a></li> --}}
                            </ul>
                            <!-- /.post-meta -->
                          </div>
                          <!-- /.post-footer -->
                        </article>
                        <!-- /article -->
                      </div>

                        @endforeach
                      <!--/.swiper-slide -->
                    </div>
                    <!--/.swiper-wrapper -->
                  </div>
                  <!-- /.swiper -->
                </div>
                <!-- /.comment-form -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.blog -->
        </div>
        <!-- /column -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </section>
  <!-- /section -->

@endsection
