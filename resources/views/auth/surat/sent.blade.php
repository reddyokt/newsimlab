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
            Sent
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
                    <a href="/inbox/{{Session::get('user_id')}}"><i class="mdi mdi-email-outline font-size-16 align-middle me-2"></i>
                        Inbox <span class="ms-1 float-end">({{count($inbox)}})</span></a>
                    <a href="/sent/{{Session::get('user_id')}}"><i class="mdi mdi-email-check-outline font-size-16 align-middle me-2"></i>
                        Sent <span class="ms-1 float-end">({{count($sent)}})</span></a></a>
                    <a href="#"><i class="mdi mdi-trash-can-outline font-size-16 align-middle me-2"></i>Trash</a>
                </div>
            </div>
            <!-- End Left sidebar -->
            <!-- Right Sidebar -->
            <div class="email-rightbar mb-3">
                {{-- {{ dd($sent) }} --}}
                <div class="card">
                    <div class="btn-toolbar p-3" role="toolbar">
                    </div>
                    @foreach ($sent as $sent)
                        <ul class="message-list">
                            <li class="">
                                <div class="col-mail" style="margin-left:20px;">
                                        <a href="/sent/read/{{$sent->id_detail}}" class="title">To : {{ $sent->kepada }} </a>
                                </div>
                                <div class="col-mail col-mail-2">
                                    <a href="#" class="subject">{{ $sent->subject }}</a>
                                    <div class="date">{{ \Carbon\Carbon::parse($sent->created_at)->locale('id')->format('l,d/m/Y')}}</div>
                                </div>
                            </li>
                        </ul>
                        <hr>
                    @endforeach

                </div> <!-- card -->

                <div class="row">
                    <div class="col-7">
                        Showing 1 - 20
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
    <script src="{{ URL::asset('/assets/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/email-editor.init.js') }}"></script>
@endsection
