@extends('admin.layouts.main')
@section('title', 'Dashboard')
@section('breadcrumb')
@stop

@push('top_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/extensions/toastr.min.css') }}">
@endpush

@push('css')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('admin/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/pages/dashboard-ecommerce.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/plugins/charts/chart-apex.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('admin/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
@endpush

<!-- Page content --->
@section('content')
    <div class="content-body">
        <!-- Dashboard Ecommerce Starts -->
        <section id="dashboard-ecommerce">
            <div class="row match-height">
                <!-- Medal Card -->
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="card card-congratulation-medal">
                        <div class="card-body">
                            <h3>Total Use Leave</h3>
                            <h3 class="mb-75 mt-2 pt-50">
                                <h1><a href="{{ route('leave-record.index') }}">{{$total_use_leave_balance}}</a></h1>
                            </h3>
                            <img src="{{ asset('admin/app-assets/images/illustration/badge.svg') }}"
                                 class="congratulation-medal" alt="Medal Pic"/>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="card card-congratulation-medal">
                        <div class="card-body">
                            <h3>Total Available Leave</h3>
                            <h3 class="mb-75 mt-2 pt-50">
                                <h1><a href="{{ route('leave-record.index') }}">{{$total_available_leave_balance}}</a></h1>
                            </h3>
                            <img src="{{ asset('admin/app-assets/images/illustration/badge.svg') }}"
                                 class="congratulation-medal" alt="Medal Pic"/>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="card card-congratulation-medal">
                        <div class="card-body">
                            <h3>Total Leave</h3>
                            <h3 class="mb-75 mt-2 pt-50">
                                <h1><a href="{{ route('leave-balance.index') }}">{{$total_leave}}</a></h1>
                            </h3>
                            <img src="{{ asset('admin/app-assets/images/illustration/badge.svg') }}"
                                 class="congratulation-medal" alt="Medal Pic"/>
                        </div>
                    </div>
                </div>
                <!--/ Medal Card -->

                <!-- Statistics Card -->
                <div class="col-xl-12 col-md-6 col-12">
                    <div class="card card-statistics">
                        <div class="card-header">
                            <h4 class="card-title">Total Leave Data</h4>
                        </div>
                        <div class="card-body statistics-body">
                            <div class="row">
                                @foreach($get_total_leave_list as $leave_lis)
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-primary me-2">
                                                <div class="avatar-content">
                                                    <i data-feather="trending-up" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{$leave_lis->leaveType}}</h4>
                                                <p class="card-text font-small-4 mb-0">{{$leave_lis->leave_balance}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Statistics Card -->
    </div>
    </section>
    <!-- Dashboard Ecommerce ends -->
    </div>
@endsection

@push('top_js')
    {{-- top js --}}
    <script src="{{ asset('admin/app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
@endpush

@push('js')
    {{-- js --}}
    <script src="{{ asset('admin/app-assets/js/scripts/pages/dashboard-ecommerce.js') }}"></script>
@endpush
