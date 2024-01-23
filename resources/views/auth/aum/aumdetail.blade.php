@extends('layouts.master')
@section('title')
    Detail AUM
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/owl-carousel/owl-carousel.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/magnific-popup/magnific-popup.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            AUM
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
                        <h5 class="font-size-16">Amal Usaha Muhammadiyah</h5>
                        <div class="table-responsive mt-4">
                            <div>
                                <p class="mb-1">Name AUM:</p>
                                <h5 class="font-size-16">{{ $aum->aum_name }}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Pengelola : </p> 
                                                            @if ($aum->pda_id != Null)
                                                            <h5>PDA {{$aum->pda_name}}</h5>
                                                            @elseif ($aum->pca_id != Null)
                                                            <h5>PCA {{$aum->pca_name}}</h5>
                                                            @elseif ($aum->ranting_id != Null)                                                    
                                                            <h5>Ranting {{$aum->ranting_name}}</h5>
                                                            @endif                                
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Bidang Usaha :</p>
                                <h5 class="font-size-16">{{$aum->bidangusaha}}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Kepemilikan :</p>
                                <h5 class="font-size-16">{{$aum->kepemilikan}}</h5>
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
                                <div class="mt-4">
                                    <p class="mb-1">Alamat :</p>
                                    <h5 class="font-size-16">{{$aum->address}}</h5>
                                </div>
                                <div class="mt-4">
                                    <p class="mb-1">Galerry  :</p>
                                    <div class="zoom-gallery">
                                        @foreach ($aum_image as $image)
                                            @if ($image->images != null)
                                                <a class="border-primary rounded g-2 " href="{{ '/../upload/aum/' . $image->images }}" title="{{$image->images}}">
                                                    <img  src="{{ '/../upload/aum/' . $image->images }}" class="img-fluid" alt="Responsive image" width="40%;"> 
                                                </a>
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
