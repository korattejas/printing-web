@extends('admin.layouts.main')
@section('title', 'Subadmin')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">create </a></li>
    <li class="breadcrumb-item active">sub admin</li>
@stop

@push('top_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/vendors.min.css') }}">
@endpush

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
@endpush

<!-- Page content --->
@section('content')
    <!-- Basic Vertical form layout section start -->
    <section id="basic-vertical-layouts">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create sub admin</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.sub-admin.store') }}" method="post" class="form form-vertical">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Name</label>
                                        <input type="text" id="first-name-vertical" class="form-control" name="name"
                                            placeholder="Enter name" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label class="form-label" for="email-id-vertical">Email</label>
                                        <input type="email" id="email-id-vertical" class="form-control" name="email"
                                            placeholder="Enter email" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label class="form-label" for="contact-info-vertical">Mobile number</label>
                                        <input type="number" id="contact-info-vertical" class="form-control" name="mobile_number"
                                            placeholder="Enter mobile number" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label class="form-label" for="password-vertical">Password</label>
                                        <input type="password" id="password-vertical" class="form-control" name="password"
                                            placeholder="Enter password" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary me-1">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Vertical form layout section end -->

@endsection

@push('top_js')
    {{-- page vander js --}}
    <script src="{{ asset('admin/app-assets/vendors/js/vendors.min.js') }}"></script>
@endpush

@push('js')
    {{-- page js --}}
@endpush
