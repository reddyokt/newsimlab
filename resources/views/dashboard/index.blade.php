@extends('layouts.master')
@section('title')
    @lang('translation.Dashboard')
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            {{Session::get('role_name')}}
        @endslot
        @slot('title')
            Dashboard
        @endslot
    @endcomponent

    <div class="row">
        @include('flashmessage')
        <div class="col-md-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                    <i class="uil-user   font-size-20"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{$allData['totalKader']}}</span></h4>
                        <p class="text-muted mb-0">Total Kader</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                   <div class="float-end mt-2">
                    <i class="uil-store font-size-20"></i>
                   </div>
                   <div>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{$allData['totalAum']}}</span></h4>
                        <p class="text-muted mb-0">Total AUM Aktif</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->
    </div> <!-- end row-->

    <div class="row">
        <input type="hidden" value="{{Session::get('role_code')}}" id="roleCode">
        @if(in_array(Session::get('role_code'), ['SUP','PWA1']))
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">    
                    <h4 class="card-title mb-4">Kader Aktif per PDA</h4>
                    <div class="mt-3">
                        <input type="hidden" class="totalPDA" value="{{$allData['totalPDA']}}"/>
                        <input type="hidden" class="pdaList" value="{{$allData['pdaList']}}"/>
                        <div id="sales-analytics-chart" data-colors='["--bs-primary", "#dfe2e6", "--bs-warning"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
        @endif

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">AUM aktif per PDA</h4>
                    <div class="mt-3">
                        <input type="hidden" class="totalPDAAum" value="{{$allData['totalPDAAum']}}"/>
                        <input type="hidden" class="pdaList" value="{{$allData['pdaList']}}"/>
                        <div id="aum-chart" data-colors='["--bs-success", "#dfe2e6", "--bs-warning"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>                                
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end Col -->
    </div> <!-- end row-->

@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/modal.init.js') }}"></script>
    <script>
        $('#newpass, #confnewpass').on('keyup', function() {
            if ($('#newpass').val() == $('#confnewpass').val()) {
                $('#message').html('Password Konfirmasi Cocok').css('color', 'green');
            } else
                $('#message').html('Password Konfirmasi Tidak Cocok').css('color', 'red');
        });
    </script>
@endsection
