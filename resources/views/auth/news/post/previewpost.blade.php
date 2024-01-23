@extends('layouts.master')
@section('title')
    @lang('translation.Starter_Page')
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Post
        @endslot
        @slot('title')
            Preview Post
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="col-xl-10 mx-auto d-block">
                <div class="card">
                    <div class="card-body mb-3">
                        <h1 class="card-title text-center" style="font-size: 22px;">{{ $preview->news_title }}</h1>
                        <h6 class="card-subtitle font-14 text-primary text-center mb-1">Category: {{ $preview->category }}</h6>
                        <h6 class="card-subtitle font-14 text-primary text-center mb-3">Status: {{ $preview->status }}</h6>

                        @if ($preview->status == 'published')
                            <button class="btn btn-sm btn-danger mx-auto d-block">
                                <a href="/downPost/{{ $preview->news_id }}" onclick="return confirm('Yakin akan take down berita ini?!')"
                                class="px-2 text-white"><i class="uil uil-times-circle font-size-12"></i> Take Down</a>
                                </button>
                        @elseif ($role == "SUP" || $role == "PWA1" && $preview->status == 'waiting')
                            <button class="btn btn-sm btn-success mx-auto d-block">
                                <a href="/validasiPost/{{ $preview->news_id }}" onclick="return confirm('Yakin akan publish berita ini?!')"
                                class="px-2 text-white"><i class="uil uil-check-circle font-size-12"></i> Publish this</a>
                                </button>
                        @endif

                    </div>
                    <hr><!-- end cardbody -->
                    <img class="mx-auto d-block w-50" src="{{ '/../upload/feature_image/' . $preview->feature_image }}" alt="Card image cap">
                    <div class="card-body col-xl-8 mx-auto d-block">
                        <p class="card-text">{!! $preview->news_body !!}</p>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('landing/assets/js/theme.js') }}"></script>
@endsection
