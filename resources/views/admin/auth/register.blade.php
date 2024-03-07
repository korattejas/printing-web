@extends('admin.layouts.admin_guest')
@php($title = 'Register')
@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-basic px-2">
                    <div class="auth-inner my-2">
                        <!-- Login basic -->
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="#" class="brand-logo">
                                    <h2 class="brand-text text-primary ms-1">Employee Register</h2>
                                </a>
                                <form method="POST" data-parsley-validate="" id="registerForm"
                                      class="form form-vertical"
                                      role="form">
                                    @csrf
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Employee Name</label>
                                        <input type="text" id="employee_name" class="form-control"
                                               name="employee_name" placeholder="Employee Name" required/>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Employee Code</label>
                                        <input type="text" id="employee_code" class="form-control"
                                               name="employee_code" placeholder="Employee Code" required/>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">First Name</label>
                                        <input type="text" id="first_name" class="form-control"
                                               name="first_name" placeholder="First Name" required/>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Last Name</label>
                                        <input type="text" id="last_name" class="form-control"
                                               name="last_name" placeholder="Last Name" required/>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Username</label>
                                        <input type="text" id="username" class="form-control"
                                               name="username" placeholder="Username" required/>
                                    </div>
                                    <div class="mb-1">
                                        <label for="login-email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                               placeholder="admin@example.com" aria-describedby="login-email"
                                               tabindex="1"
                                               autofocus required/>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Phone</label>
                                        <input type="number" id="phone" class="form-control"
                                               name="phone" placeholder="Phone" required/>
                                    </div>
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label">Password</label>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input type="password" class="form-control form-control-merge" id="password"
                                                   name="password" tabindex="2" required/>
                                            <span class="input-group-text cursor-pointer"><i
                                                    data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Address</label>
                                        <textarea class="form-control"
                                                  name="address"
                                                  rows="3"
                                                  placeholder="Address"
                                                  required></textarea>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="country">Country</label>
                                        <select id="country" class="form-select" name="country" required>
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="state">State</label>
                                        <select id="state" class="form-select" name="state" required>
                                            <option value="">Select State</option>
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="city">City</label>
                                        <select id="city" class="form-select" name="city" required>
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-vertical">Zip</label>
                                        <input type="number" id="zip" class="form-control"
                                               name="zip" placeholder="Zip" required/>
                                    </div>
                                    <button class="btn btn-primary w-100" tabindex="4">Sign Up</button>
                                </form>
                            </div>
                        </div>
                        <!-- /Login basic -->
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection



