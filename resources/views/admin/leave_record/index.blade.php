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
                        <a href="{{ route('leave-record.create') }}" class="btn btn-primary mb-1">Add Leave</a>
                    </div>

                    <div class="card-datatable">
                        <table class="table dataTable" id="permission-table">
                            <thead>
                            <tr>
                                <th>Id.</th>
                                <th>Leave Type</th>
                                <th>Employee Code</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Total Days</th>
                                <th>Comment</th>
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
        const sweetalert_delete_title = "Delete Leave?";
        const form_url = '/leave-record';
        datatable_url = '/getDatatableLeaveRecord';
        $(document).ready(function () {
            $('#permission-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('getDatatableLeaveRecord') !!}',
                columns: [
                    {data: 'id', name: 'employee_leave_master.id'},
                    {data: 'leave_type_name', name: 'leave_master.leaveType'},
                    {data: 'employee_code', name: 'employee_leave_master.employee_code'},
                    {data: 'from_date', name: 'employee_leave_master.from_date'},
                    {data: 'to_date', name: 'employee_leave_master.to_date'},
                    {data: 'number_of_days', name: 'employee_leave_master.number_of_days'},
                    {data: 'comment', name: 'employee_leave_master.comment'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                order: [[0, 'DESC']],
            });
        });

    </script>
    <script src="{{ asset('admin/app-assets/js/core/datatable.js') }}?v={{time()}}"></script>

@endpush
