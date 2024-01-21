@extends('layouts.master')
@section('title')
    @lang('translation.Inbox')
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            e-Surat
        @endslot
        @slot('title')
            Send
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <!-- Left sidebar -->
            <div class="email-leftbar card">
                <a href="/surat/create" type="button" class="btn btn-danger waves-effect waves-light">
                    Compose </a>
                </button>
                <div class="mail-list mt-4">
                    <a href="/inbox/{{ Session::get('user_id') }}"><i
                            class="mdi mdi-email-outline font-size-16 align-middle me-2"></i>
                        Inbox <span class="ms-1 float-end">({{ count($inbox) }})</span></a>
                    {{-- <a href="#"><i class="mdi mdi-star-outline font-size-16 align-middle me-2"></i>Starred</a>
                    <a href="#"><i class="mdi mdi-diamond-stone font-size-16 align-middle me-2"></i>Important</a>
                    <a href="#"><i class="mdi mdi-file-outline font-size-16 align-middle me-2"></i>Draft</a> --}}
                    <a href="/sent/{{ Session::get('user_id') }}"><i
                            class="mdi mdi-email-check-outline font-size-16 align-middle me-2"></i>
                        Sent <span class="ms-1 float-end">({{ count($sent) }})</span></a></a>
                    <a href="#"><i class="mdi mdi-trash-can-outline font-size-16 align-middle me-2"></i>Trash</a>
                </div>
            </div>
            <!-- End Left sidebar -->

            <!-- Right Sidebar -->
            <div class="email-rightbar mb-3">

                <div class="card">
                    <div class="btn-toolbar p-3" role="toolbar">
                        <div class="btn-group me-2 mb-2 mb-sm-0">
                            <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Option <i class="mdi mdi-dots-vertical ms-2"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Mark as Done</a>
                            </div>
                        </div>
                    </div>
                    {{-- {{ dd($readsend) }} --}}
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-4">
                            <div class="flex-shrink-0 me-3">
                                @foreach ( $readsend as $read )
                                <img class="rounded-circle avatar-sm"
                                    src="{{ '/../upload/profile_picture/' . $read->photo }}"
                                    alt="Generic placeholder image">
                            </div>
                            <div class="flex-grow-1">
                                    <h5 class="font-size-14 my-1">Kepada : {{ $read->kepada }}</h5>
                                    <small class="text-muted">{{ $read->role_name }}</small>

                            </div>
                        </div>

                        <h4 class="font-size-16">{{ $read->subject }}</h4>

                        {!! $read->body !!}


                        <div class="row">
                            <div class="col-xl-2 col-6">
                                <div class="card border shadow-none">
                                    <a href="{{ '/upload/attachment/' . $read->uploaded_file }}" class="fw-medium" target="_blank">Download<i class="uil-file-download-alt"></i></a>
                                    <div class="py-2 text-center">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="/surat/disposisi/{{ $read->id_detail }}" class="btn btn-secondary waves-effect mt-4"><i
                                class="mdi mdi-reply"></i> Disposisi</a>
                    </div>
                    @endforeach

                </div>
            </div>

        </div>

    </div><!-- End row -->

@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/email-editor.init.js') }}"></script>
@endsection
