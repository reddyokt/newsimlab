@extends('layouts.master')
@section('title')
    Post
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Post
        @endslot
        @slot('title')
            All Posts
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="/post/add" type="button" class="btn btn-success waves-effect waves-light mb-3">
                        Create New Post </a>
                    <table id="datatable" class="table table-bordered dt-responsive wrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($postindex as $post)
                                <tr>
                                    <td>{{ $post['news_title'] }}</td>
                                    <td>{{ $post['author'] }}</td>
                                    <td>{{ $post['status'] }}</td>
                                    <td>

                                        <ul class="list-inline mb-0">
                                            @if ($post['status'] == 'published')
                                            @elseif ($role == "SUP" || $role == "PWA1" && $post['status'] == 'waiting')
                                            <li class="list-inline-item">
                                                <a href="/validasiPost/{{ $post['news_id'] }}" onclick="return confirm('Yakin akan publish berita ini?!')"
                                                    class="px-2 text-success"><i class="uil uil-check-circle font-size-18"></i></a>
                                            </li>                                            
                                            @else

                                            @endif

                                            <li class="list-inline-item">
                                                <a href="/post/edit/{{ $post['news_id'] }}" class="px-2 text-primary"><i
                                                        class="uil uil-pen font-size-18"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="/post/preview/{{ $post['news_id'] }}" class="px-2 text-warning"><i
                                                        class="uil uil-eye font-size-18"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="/post/delete/{{ $post['news_id'] }}" class="px-2 text-danger"><i
                                                        class="uil uil-trash-alt font-size-18"></i></a>
                                            </li>

                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    {{-- <div class="modal fade validasiPost" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="/changepassword" method="POST">
                    @csrf
                    <div class="modal-header">
                        <i class="dripicons-warning p-2"></i>
                        <h5 class="modal-title">Validasi Berita Ini?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    @foreach ($postindex as $post)
                    <div class="modal-body">
                        @if ($post['feature_image'] == null)
                        <img src="{{ '/../upload/feature_image/ui5.png' }}" class="img-fluid tab-img rounded"
                            style="width: 60%;">
                        <p>No Feature Image uploaded</p>
                    @else
                        <img src="{{ '/../upload/feature_image/' . $post['feature_image'] }}"
                            class="img-fluid tab-img rounded" style="width: 60%;">
                        <p>Feature Image has been uploaded</p>
                    @endif
                    </div>
                    @endforeach
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div> --}}

@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
