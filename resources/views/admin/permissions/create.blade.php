@extends('admin.layouts.main')
@section('title', 'Permission')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('permission.index') }}">Permission</a></li>
    <li class="breadcrumb-item active">create</li>
@stop

@push('top_css')
{{--    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">--}}
@endpush

@push('css')
{{--    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">--}}
@endpush

<!-- Page content --->
@section('content')
    <!-- Basic Vertical form layout section start -->
    <section id="basic-vertical-layouts">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Permission Form</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" data-parsley-validate="" id="addEditForm" class="form form-vertical"
                              role="form">
                            @csrf
                            <input type="hidden" name="edit_value" value="0">
                            <input type="hidden" id="form-method" value="add">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Permission Name</label>
                                        <input type="text" id="permission_name" class="form-control"
                                               name="permission_name" placeholder="Permission Name"/>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="basicSelect">Select Guard</label>
                                        <select class="form-select" name="guard_name" id="basicSelect">
                                            <option>-- SELECT GUARD --</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Web">Web</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
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

@endpush

@push('js')
    <script>
        const form_url = 'permission';
        const redirect_url = 'permission';
    </script>
@endpush
