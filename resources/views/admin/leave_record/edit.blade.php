@extends('admin.layouts.main')
@section('title', 'Employee Leave Record')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('leave-record.index') }}">Leave</a></li>
    <li class="breadcrumb-item active">Edit</li>
@stop

@push('top_css')
@endpush

@push('css')
@endpush

<!-- Page content --->
@section('content')
    <!-- Basic Vertical form layout section start -->
    <section id="basic-vertical-layouts">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Leave Form</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" data-parsley-validate="" id="addEditForm" class="form form-vertical"
                              role="form">
                            @csrf
                            <input type="hidden" name="edit_value" value="{{encryptId($leave->id)}}">
                            <input type="hidden" id="form-method" value="edit">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Employee Code</label>
                                        <input type="text"
                                               value="{{ auth()->guard('admin')->user()->employee_code ?? '' }}"
                                               id="employee_code" class="form-control"
                                               name="employee_code" placeholder="Employee Code" readonly/>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <div class="form-group">
                                            <label>From Date</label>
                                            <input type="date" class="form-control"
                                                   name="from_date"
                                                   value="{{$leave->from_date}}"
                                                   placeholder="From Date">
                                            <div class="valid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <div class="form-group">
                                            <label>To Date</label>
                                            <input type="date" class="form-control"
                                                   name="to_date"
                                                   value="{{$leave->to_date}}"
                                                   placeholder="To Date">
                                            <div class="valid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="leave_type">Leave Type</label>
                                        <select id="leave_type" class="form-select" name="leave_type">
                                            <option value="">Select Leave Type</option>
                                            @foreach($leaveTypes as $type)
                                                <option
                                                    value="{{ $type->id }}" {{ $type->id == $leave->leave_type ? 'selected' : '' }}>
                                                    {{ $type->leaveType }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Comment</label>
                                        <textarea class="form-control"
                                                  name="comment"
                                                  rows="3"
                                                  placeholder="Comment">{{$leave->comment}}</textarea>
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
        const form_url = 'leave-record';
        const redirect_url = 'leave-record';
    </script>
@endpush
