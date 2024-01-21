@extends('layouts-landing.master')
@section('title')
@endsection

@section('content')

<section class="wrapper bg-light">
    <div class="container py-14 py-md-16">
      <h2 class="display-4 mb-3 text-center">Berita 'Aisyiyah DKI Jakarta</h2>                  
      <div class="swiper-container blog grid-view mb-6" data-margin="30" data-dots="true" data-items-xl="3" data-items-md="2" data-items-xs="1" id="blog">
        <div class="swiper">
          <div class="swiper-wrapper">
            @foreach ($postLanding as $post )
            <div class="swiper-slide">
              <article>
                <figure class="overlay overlay-1 hover-scale rounded mb-5"><a href="#"> <img src="./assets/img/photos/b4.jpg" alt="" /></a>
                  <figcaption>
                    <h5 class="from-top mb-0">Read More</h5>
                  </figcaption>
                </figure>
                <div class="post-header">
                  <div class="post-category text-line">
                    <a href="#" class="hover" rel="category">{{$post->category}}</a>
                  </div>
                  <!-- /.post-category -->
                  <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href="./blog-post.html">{{$post->news_title}}</a></h2>
                </div>
                <!-- /.post-header -->
                <div class="post-footer">
                  <ul class="post-meta">
                    <li class="post-date"><i class="uil uil-calendar-alt"></i><span>{{$post->created_at}}</span></li>
                  </ul>
                  <!-- /.post-meta -->
                </div>
                <!-- /.post-footer -->
              </article>
              <!-- /article -->
            </div>
            <!--/.swiper-slide -->
          </div>
          @endforeach
          <!--/.swiper-wrapper -->
        </div>
        <!-- /.swiper -->
      </div>
      <!-- /.swiper-container -->
    </div>
    <!-- /.container -->
  </section>

  @endsection