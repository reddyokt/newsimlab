@extends('layouts.master')
@section('title')
    @lang('translation.Dashboard')
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .close-icon {
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            {{ Session::get('role_name') }}
        @endslot
        @slot('title')
            Dashboard
        @endslot
    @endcomponent


@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script>
        $('#newpass, #confnewpass').on('keyup', function() {
            if ($('#newpass').val() == $('#confnewpass').val()) {
                $('#message').html('Password Konfirmasi Cocok').css('color', 'green');
            } else
                $('#message').html('Password Konfirmasi Tidak Cocok').css('color', 'red');
        });
    </script>
    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
@endsection
