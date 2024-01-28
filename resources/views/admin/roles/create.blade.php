@extends('admin.layouts.main')
@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Role</a></li>
    <li class="breadcrumb-item active">create</li>
@stop

@push('top_css')
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
@endpush

@push('css')
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
@endpush

<!-- Page content --->
@section('content')

    <!-- Basic Inputs start -->
    <section id="basic-input">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Basic Inputs</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="basicInput">Basic Input</label>
                                    <input type="text" class="form-control" id="basicInput" placeholder="Enter email" />
                                </div>
                            </div>

                            <div class="card-header">
                                <h4 class="card-title">Basic Checkboxes</h4>
                            </div>
                            <div class="card-body">
                                <div class="demo-inline-spacing">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="checked" checked />
                                        <label class="form-check-label" for="inlineCheckbox1">Checked</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="unchecked" />
                                        <label class="form-check-label" for="inlineCheckbox2">Unchecked</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="checked-disabled" checked disabled />
                                        <label class="form-check-label" for="inlineCheckbox3">Checked disabled</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="unchecked-disabled" disabled />
                                        <label class="form-check-label" for="inlineCheckbox4">Unchecked disabled</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Inputs end -->

    <!-- Basic Checkbox start -->
    {{-- <section id="basic-checkbox">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Basic Checkboxes</h4>
                    </div>
                    <div class="card-body">
                        <div class="demo-inline-spacing">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="checked" checked />
                                <label class="form-check-label" for="inlineCheckbox1">Checked</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="unchecked" />
                                <label class="form-check-label" for="inlineCheckbox2">Unchecked</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="checked-disabled" checked disabled />
                                <label class="form-check-label" for="inlineCheckbox3">Checked disabled</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="unchecked-disabled" disabled />
                                <label class="form-check-label" for="inlineCheckbox4">Unchecked disabled</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Basic Checkbox end -->
@endsection

@push('top_js')
    {{-- top js --}}
@endpush

@push('js')
    {{-- js --}}
@endpush
