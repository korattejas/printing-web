@extends('admin.layouts.main')
@section('title', 'Employee Leave Record')

@section('breadcrumb')
    {{-- <li class="breadcrumb-item"><a href="#">Form Elements</a></li> --}}
    {{-- <li class="breadcrumb-item active">Analytics</li> --}}
@stop

@push('top_css')

@endpush

@push('css')


@endpush

<!-- Page content --->
@section('content')
    <!-- Ajax Sourced Server-side -->
    <section id="column-search-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">Leave Data</h4>
                        <a href="{{ route('leave-balance.create') }}" class="btn btn-primary mb-1">Add Leave Balance</a>
                    </div>

                    <div class="card-datatable">
                        <table class="table dataTable" id="permission-table">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Leave Type</th>
                                <th>Leave Balance</th>
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

@endpush

@push('js')
    <script>
        const sweetalert_delete_title = "Delete Leave Balance?";
        const form_url = '/leave-balance';
        datatable_url = '/getDatatableLeaveBalance';
        $(document).ready(function () {
            $('#permission-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('getDatatableLeaveBalance') !!}',
                columns: [
                    {data: 'id', name: 'leave_balance.id'},
                    {data: 'leave_type_name', name: 'leave_master.leaveType'},
                    {data: 'leave_balance', name: 'leave_balance.leave_balance'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                order: [[0, 'DESC']],
            });
        });

    </script>
    <script src="{{ asset('admin/app-assets/js/core/datatable.js') }}?v={{time()}}"></script>

@endpush
