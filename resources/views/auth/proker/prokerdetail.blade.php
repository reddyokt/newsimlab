@extends('layouts.master')
@section('title')
    Detail Program Kerja
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/owl-carousel/owl-carousel.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/magnific-popup/magnific-popup.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Program Kerja
        @endslot
        @slot('title')
            Detail
        @endslot
    @endcomponent
    <div class="row mb-3">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <div class="dropdown float-end">
                            <a class="text-body dropdown-toggle font-size-18" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true">
                                <i class="uil uil-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Edit</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="text-muted">
                        <h5 class="font-size-16">Program Kerja</h5>
                        <div class="table-responsive mt-4">
                            <div>
                                <p class="mb-1">Name Program Kerja :</p>
                                <h5 class="font-size-16">{{ $proker->proker_name }}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Waktu Program Kerja :</p>
                                <h5 class="font-size-16">
                                    {{ \Carbon\Carbon::parse($proker->prokerstart)->locale('id')->format('j F Y') }} ~
                                    {{ \Carbon\Carbon::parse($proker->prokerend)->locale('id')->format('j F Y') }}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Pengusul :</p>
                                <h5 class="font-size-16">PDA {{ $proker->pda_name }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <div class="dropdown float-end">                            
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="text-muted">
                        <h5 class="font-size-16">Gallery Program Kerja</h5>
                        <div class="table-responsive mt-4">
                            <div>

                                @foreach ($prokerdetail as $prokers)
                                    @if ($prokers->proker_image != null)
                                            <div class="zoom-gallery">
                                                <a class="mxauto d-block text-center mb-1 border border-primary rounded" href="{{ '/../upload/proker/gallery/' . $prokers->proker_image }}" title="Project 1">
                                                    <img  src="{{ '/../upload/proker/gallery/' . $prokers->proker_image }}" alt="" width="200"> 
                                                    <span class="mxauto d-block text-center">{{$prokers->initial}}-{{$prokers->proker_image}}</span>
                                                </a>
                                            </div>
                                    @else
                                        <img src="{{ URL::asset('assets/media/Image_not_available.png') }}" alt=""
                                            class="img-fluid mx-auto d-block">
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card mb-0">
                <!-- Tab content -->
                <div class="tab-content p-4">
                    <div class="tab-pane active" id="about" role="tabpanel">
                        <div>
                            <div>
                                <h5 class="font-size-16 mb-4">Deskripsi</h5>
                                <p>{!! $proker->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Time Line Program Kerja</h4>
                    <div class="">
                        <ul class="verti-timeline list-unstyled">

                            @foreach ($prokerdetail as $proker)
                                <li class="event-list">
                                    <div class="event-date text-primar">
                                        {{ \Carbon\Carbon::parse($proker->created_at)->locale('id')->format('j M y') }}</div>
                                    <h5>{{ $proker->initial }}</h5>
                                    <p class="text-muted">{{ $proker->note_update }}</p>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- end row -->
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/owl-carousel/owl-carousel.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/timeline.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/magnific-popup/magnific-popup.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/lightbox.init.js') }}"></script>
@endsection
