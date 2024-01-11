@extends('layouts.master')
@section('title')
    @lang('translation.Inbox')
@endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            e-Surat
        @endslot
        @slot('title')
            Inbox
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
                    <a href="#" class="active"><i class="mdi mdi-email-outline font-size-16 align-middle me-2"></i>
                        Inbox <span class="ms-1 float-end">(18)</span></a>
                    <a href="#"><i class="mdi mdi-star-outline font-size-16 align-middle me-2"></i>Starred</a>
                    <a href="#"><i class="mdi mdi-diamond-stone font-size-16 align-middle me-2"></i>Important</a>
                    <a href="#"><i class="mdi mdi-file-outline font-size-16 align-middle me-2"></i>Draft</a>
                    <a href="#"><i class="mdi mdi-email-check-outline font-size-16 align-middle me-2"></i>Sent</a>
                    <a href="#"><i class="mdi mdi-trash-can-outline font-size-16 align-middle me-2"></i>Trash</a>
                </div>


                <h6 class="mt-4">Labels</h6>

                <div class="mail-list mt-1">
                    <a href="#"><span class="mdi mdi-circle-outline text-info float-end"></span>Theme Support</a>
                    <a href="#"><span class="mdi mdi-circle-outline text-warning float-end"></span>Freelance</a>
                    <a href="#"><span class="mdi mdi-circle-outline text-primary float-end"></span>Social</a>
                    <a href="#"><span class="mdi mdi-circle-outline text-danger float-end"></span>Friends</a>
                    <a href="#"><span class="mdi mdi-circle-outline text-success float-end"></span>Family</a>
                </div>

                {{-- <h6 class="mt-4">Chat</h6>

            <div class="mt-2">
                <a href="#" class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-3">
                        <img class="rounded-circle" src="{{URL::asset('assets/images/users/avatar-2.jpg')}}" alt="Generic placeholder image" height="36">
                    </div>

                    <div class="flex-grow-1 chat-user-box overflow-hidden">
                        <p class="user-title m-0">Scott Median</p>
                        <p class="text-muted text-truncate">Hello</p>
                    </div>
                </a>

                <a href="#" class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-3">
                        <img class="rounded-circle" src="{{URL::asset('assets/images/users/avatar-3.jpg')}}" alt="Generic placeholder image" height="36">
                    </div>

                    <div class="flex-grow-1 chat-user-box overflow-hidden">
                        <p class="user-title m-0">Julian Rosa</p>
                        <p class="text-muted text-truncate">What about our next..</p>
                    </div>
                </a>

                <a href="#" class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-3">
                        <img class="rounded-circle" src="{{URL::asset('assets/images/users/avatar-4.jpg')}}" alt="Generic placeholder image" height="36">
                    </div>

                    <div class="flex-grow-1 chat-user-box overflow-hidden">
                        <p class="user-title m-0">David Medina</p>
                        <p class="text-muted text-truncate">Yeah everything is fine</p>
                    </div>
                </a>

                <a href="#" class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-3">
                        <img class="rounded-circle" src="{{URL::asset('assets/images/users/avatar-6.jpg')}}" alt="Generic placeholder image" height="36">
                    </div>

                    <div class="flex-grow-1 chat-user-box overflow-hidden">
                        <p class="user-title m-0">Jay Baker</p>
                        <p class="text-muted text-truncate">Wow that's great</p>
                    </div>
                </a>

            </div> --}}
            </div>
            <!-- End Left sidebar -->


            <!-- Right Sidebar -->
            <div class="email-rightbar mb-3">

                <div class="card">
                    <div class="btn-toolbar p-3" role="toolbar">
                        {{-- <div class="btn-group me-2 mb-2 mb-sm-0">
                        <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-inbox"></i></button>
                        <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-exclamation-circle"></i></button>
                        <button type="button" class="btn btn-primary waves-light waves-effect"><i class="far fa-trash-alt"></i></button>
                    </div> --}}
                        {{-- <div class="btn-group me-2 mb-2 mb-sm-0">
                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-folder"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Updates</a>
                            <a class="dropdown-item" href="#">Social</a>
                            <a class="dropdown-item" href="#">Team Manage</a>
                        </div>
                    </div> --}}
                        {{-- <div class="btn-group me-2 mb-2 mb-sm-0">
                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-tag"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Updates</a>
                            <a class="dropdown-item" href="#">Social</a>
                            <a class="dropdown-item" href="#">Team Manage</a>
                        </div>
                    </div> --}}

                        {{-- <div class="btn-group me-2 mb-2 mb-sm-0">
                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            More <i class="mdi mdi-dots-vertical ms-2"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Mark as Unread</a>
                            <a class="dropdown-item" href="#">Mark as Important</a>
                            <a class="dropdown-item" href="#">Add to Tasks</a>
                            <a class="dropdown-item" href="#">Add Star</a>
                            <a class="dropdown-item" href="#">Mute</a>
                        </div>
                    </div> --}}
                    </div>
                    @foreach ($inbox as $inbox)
                        <ul class="message-list">
                            <li>
                                <div class="col-mail col-mail-1">
                                    <div class="">
                                        <a href="/inbox/read/{{$inbox->id_surat}}" class="title">From : {{ $inbox->dari }} </a>

                                    </div>
                                    <a href="/inbox/read/{{$inbox->id_surat}}" class="title">From : {{ $inbox->dari }} </a>
                                </div>
                                <div class="col-mail col-mail-2">
                                    <a href="#" class="subject">{{ $inbox->subject }}</a>
                                    <div class="col-md-8    date">{{ \Carbon\Carbon::parse($inbox->created_at)->format('l,d/m/Y')}}</div>
                                </div>
                            </li>
                        </ul>
                    @endforeach

                </div> <!-- card -->

                <div class="row">
                    <div class="col-7">
                        Showing 1 - 20 of 1,524
                    </div>
                    <div class="col-5">
                        <div class="btn-group float-end">
                            <button type="button" class="btn btn-sm btn-success waves-effect"><i
                                    class="fa fa-chevron-left"></i></button>
                            <button type="button" class="btn btn-sm btn-success waves-effect"><i
                                    class="fa fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>

            </div> <!-- end Col-9 -->

        </div>

    </div><!-- End row -->

    <!-- Modal -->
    {{-- <div class="modal fade" id="composemodal" tabindex="-1" role="dialog" aria-labelledby="composemodalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="composemodalTitle">New Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create-surat-form" action="{{ url('/surat/create') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <select class="select2 form-control select2-multiple" name="kepada[]" id="kepada"
                            data-placeholder="Kepada ...">
                                @foreach ($user as $key => $value)
                                    <option value="{{ $value->user_id }}">{{ $value->name }} - {{ $value->role_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Subject" name="judul">
                        </div>
                        <div class="mb-3">
                            <textarea id="email-editor" name="area"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send <i
                            class="fab fa-telegram-plane ms-1"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/email-editor.init.js') }}"></script>
@endsection
