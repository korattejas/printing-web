@extends('admin.layouts.main')
@section('title', 'Permissions')

@section('breadcrumb')
    {{-- <li class="breadcrumb-item"><a href="#">Form Elements</a></li> --}}
    {{-- <li class="breadcrumb-item active">Analytics</li> --}}
@stop

@push('top_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('admin/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('admin/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('admin/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('admin/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
@endpush

@push('css')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('admin/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('admin/app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">

@endpush

<!-- Page content --->
@section('content')
    <!-- Ajax Sourced Server-side -->
    <section id="column-search-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">Permission Data</h4>
                        <a href="{{ route('permission.create') }}" class="btn btn-primary mb-1">Add New
                            Permission</a>
                    </div>

                    <div class="card-datatable">
                        <table class="dt-column-search table dataTable" id="permission-table">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Guard Name</th>
                                <th data-search="false">Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--/ Ajax Sourced Server-side -->
@endsection

@push('top_js')
    <script src="{{ asset('admin/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('admin/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/app-assets/vendors/js/tables/datatable/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('admin/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
@endpush

@push('js')
    <script src="{{ asset('admin/app-assets/js/scripts/pages/modal-add-role.js') }}"></script>
    <script src="{{ asset('admin/app-assets/js/scripts/pages/app-access-roles.js') }}"></script>
    {{--    <script src="{{ asset('admin/app-assets/js/scripts/tables/table-datatables-advanced.js') }}"></script>--}}

    <script>
        const sweetalert_delete_title = "Delete Permission?";
        const form_url = '/permission';
        datatable_url = '/getDataTablePermission';
        $(document).ready(function () {
            $('#permission-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.getDataTablePermission') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'guard_name', name: 'guard_name'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                order: [[0, 'DESC']],
            });
        });

    </script>
    <script src="{{ asset('admin/app-assets/js/core/datatable.js') }}?v={{time()}}"></script>

@endpush
